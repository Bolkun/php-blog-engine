<?php

// All Vars For Automation
/*
CONTROLLER_CLASS         = Examples
MODEL_CLASS              = Example
MODEL_CLASS_TO_LOWERCASE = example
PAGE_NAME                = index
PAGE_PATH                = examples/index
*/

class Examples extends Controller
{
    public function __construct()
    {
        $this->exampleModel = $this->model('Example');
    }
    /*
     * All Pages ▼
     */
    public function index()
    {
        $data = [
            'title' => "Example",
        ];
        $this->view('examples/index', $data);
    }
}