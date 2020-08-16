<?php

/*
 * Base Controller
 * Loads the models and views
 */

class Controller
{
    // Load controller
    public function controller($controller)
    {
        // Require controller file
        require_once '../app/controllers/' . $controller . '.php';

        // Instantiate controller
        return new $controller();
    }

    // Load model
    public function model($model)
    {
        // Require model file
        require_once '../app/models/' . $model . '.php';

        // Instantiate model
        return new $model();
    }

    // Load view
    public function view($view, $data = [])
    {
        // Check for view file
        if(file_exists('../app/views/' . $view . '.php')){
            require_once '../app/views/' . $view . '.php';
        } else {
            // View does not exist
            die('View does not exist');
        }
    }
}