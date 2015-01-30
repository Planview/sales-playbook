<?php

use LaravelBook\Ardent\Ardent;

class Upload extends Ardent
{
    const ASSETS_DIR = 'assets';

    protected $filePointer;

    public static $rules = [
        'name'      => 'required',
        'directory' => 'required',
        'filename'  => 'required|unique:uploads',
        'mime'      => 'required'
    ];

    protected $fillable = [
        'name', 'filename', 'mime', 'directory'
    ];

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
        if (!(Input::hasFile($input) && Input::file($input)->isValid()))
            return [];

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
        return $this->fill(self::setupInputFile());
    }
}
