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
    public function index()
    {
        // EDIT PAGE
        if(!empty($_POST['ajax_drag_id'])){

        } else {
            $data = [
                'title' => "index",
            ];
        }
        $this->view('examples/index', $data);
    } /* index function end */

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
    } /* test function end */

    /* [.:NEW_FUNCTION:.] */
}