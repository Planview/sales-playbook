<?php

class BaseController extends Controller {

    protected $permission;

    /**
     * Constructor, applies filters
     */
    public function __construct() {
        if (!is_null($this->permission))
        {
            $this->beforeFilter("can:{$this->permission}");
        }
        $this->beforeFilter('csrf', ['on' => ['post', 'put', 'delete']]);
    }

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
