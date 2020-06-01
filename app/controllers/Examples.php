<?php

class Examples extends Controller
{
    public function __construct()
    {
        $this->exampleModel = $this->model('Example');
    }
    /*
     * All Pages ▼
     */
    public function index() /* [.:FUNCTION_START:.] */
    {
        // EDIT PAGE
        if(!empty($_POST['ajax_drag_id'])){

        } else {
            $data = [
                'title' => "index",
            ];
        }
        $this->view('examples/index', $data);
    } /* [.:FUNCTION_END:.] */

    public function test()
    {
        // EDIT PAGE
        if(!empty($_POST['ajax_drag_id'])){

        } else {
            $data = [
                'title' => "test",
            ];
        }
        $this->view('examples/test', $data);
    }

    public function love()
    {
        // EDIT PAGE
        if(!empty($_POST['ajax_drag_id'])){

        } else {
            $data = [
                'title' => "love",
            ];
        }
        $this->view('examples/love', $data);
    }

    /* [.:NEW_FUNCTION:.] */
}