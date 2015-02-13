<?php

use LaravelBook\Ardent\Ardent;
use Symfony\Component\HttpFoundation\File\File as SymfonyFile;
use Illuminate\Support\MessageBag;

class Upload extends Ardent
{
    const ASSETS_DIR = 'assets';

    protected $filePointer;

    protected $allowSave = true;

    public $uploadValidationErrors;

    public static $rules = [
        'name'      => 'required',
        'directory' => 'required',
        'filename'  => 'required|unique:uploads',
        'mime'      => 'required'
    ];

    protected $fillable = [
        'name', 'filename', 'mime', 'directory'
    ];

    protected $fileInfo;

    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
        $this->uploadValidationErrors = new MessageBag;
    }

    public function file()
    {
        // \Log::info($this->original['id']);
        if (null === $this->id) {
            throw new Exception("No File Available", 1);
        } elseif (null === $this->fileInfo) {
            $this->fileInfo = new SymfonyFile($this->filePath());
        }

        return $this->fileInfo;
    }

    public function filePointer()
    {
        if (null === $this->filePointer) {
            $filePath = str_finish(public_path(), '/') .
                str_finish($this->directory, '/') .
                $this->filename;

            $this->filePointer = fopen($filePath);
        }

        return $this->filePointer;
    }

    public static function assetsPath($directory = null)
    {
        if (null === $directory) {
            $directory = self::ASSETS_DIR;
        }

        $filePath = str_finish(public_path(), '/') .
            str_finish($directory, '/');

        return $filePath;
    }

    public static function assetsUrl($directory = null)
    {
        if (null === $directory) {
            $directory = self::ASSETS_DIR;
        }

        return URL::asset($directory);
    }

    public function filePath()
    {
        return self::assetsPath($this->directory) . $this->filename;
    }

    public function fileUrl()
    {
        return str_finish(self::assetsUrl($this->directory), '/') . $this->filename;
    }

    public static function fromInput($input, $name)
    {
        $fileObject = new Upload(self::setupInputFile($input));
        $fileObject->name = $name;

        return $fileObject;
    }

    protected function deleteFile()
    {
        return unlink($this->filePath());
    }

    protected static function setupInputFile($input)
    {
        if (!(Input::hasFile($input) && Input::file($input)->isValid())) {
            $this->addFileError('The upload was not successful');

            return [];
        }

        $file = Input::file($input);

        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

        $filename = self::uniqueFileName($filename, $extension);

        $mime = $file->getMimeType();

        $destPath = self::assetsPath();

        $file->move($destPath, $filename);

        return [
            'filename'  => $filename,
            'directory' => self::ASSETS_DIR,
            'mime'      => $mime
        ];
    }

    public static function unaccent($string)
    {
        if (extension_loaded('intl') === true) {
            $string = Normalizer::normalize($string, Normalizer::FORM_KD);
        }

        if (strpos($string = htmlentities($string, ENT_QUOTES, 'UTF-8'), '&') !== false) {
            $string = html_entity_decode(
                preg_replace(
                    '~&([a-z]{1,2})(?:acute|caron|cedil|circ|grave|lig|orn|ring|slash|tilde|uml);~i',
                    '$1',
                    $string
                ),
                ENT_QUOTES,
                'UTF-8'
            );
        }

        return $string;
    }

    public static function slugify($string, $slug = '-', $extra = null)
    {
        return strtolower(
            trim(
                preg_replace(
                    '~[^0-9a-z' . preg_quote($extra, '~') . ']+~i',
                    $slug,
                    self::unaccent($string)
                ),
                $slug
            )
        );
    }

    public static function uniqueFileName($filename, $extension, $directory = null)
    {
        if (null === $directory) {
            $directory = self::assetsPath();
        }

        $filename = basename($filename, $extension);
        $filename = self::slugify($filename) . '.' . $extension;

        if (file_exists($directory . $filename)) {
            $i = $j = 0;

            while (file_exists($directory . $filename)) {
                $search = $i === 0 ? '.' : "-{$j}.";
                $filename = str_replace($search, "-{$i}.", $filename);
                $j = $i++;
            }
        }

        return $filename;
    }

    public function beforeDelete()
    {
        $this->deleteFile();
    }

    public function replaceFromInput($input)
    {
        if (!(Input::hasFile($input) && Input::file($input)->isValid())) {
            $this->addFileError('The upload was not successful');

            return $this;
        }

        $new = Input::file($input);

        if ($this->mime !== $new->getMimeType()) {
            $this->addFileError('The MIME types must match in order to ' .
                'replace a file.');
            $this->allowSave = false;

            return $this;
        }


        $current = $this->file();
        $path =  $current->getPath() . '/';

        $old = self::uniqueFileName(
            $current->getFilename(),
            $current->getExtension(),
            $path
        );

        $oldRenamed = rename($this->filepath(), $path . $old);

        if (!$oldRenamed) {
            $this->addFileError('The old file could not be renamed.');

            return $this;
        }

        $new->move($path, $this->filename);

        unlink($path . $old);

        return $this;
    }

    public function addFileError($message) {
        $this->uploadValidationErrors->add('file', $message);
        $this->allowSave = false;
    }

    public function afterValidate($upload)
    {
        if ($upload->errors()->has('filename') ||
                $upload->errors()->has('mime') ||
                $upload->errors()->has('directory')) {
            $upload->addFileError('The file could not be saved.');
        }
    }

    public function beforeSave($upload)
    {
        if (!$upload->allowSave) {
            $upload->errors()->merge($this->uploadValidationErrors);
            return false;
        }

        return true;
    }

    public function afterSave($upload)
    {
        $upload->fileInfo = new SymfonyFile($upload->filePath());
    }
}
