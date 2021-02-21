<?php

/*
 * App Core Class
 * Creates URL & loads core controller
 */

class Core
{
    protected $currentController = STARTCONTROLLER;
    protected $currentMethod = STARTMETHOD;
    protected $params = [];

    // <Core construct>
    public function __construct()
    {
        /* See if statement:
         * 1. start page     Example: (min)  http://localhost/bolkun                (default controller, default method)
         *                                   http://localhost/[root_dir]
         *                   Example: (max)  http://localhost/bolkun/1
         *                                   http://localhost/[root_dir]/[params]
         * 2. index page     Example: (min)  http://localhost/bolkun/index          (default controller, ... is views dirs)
         *                                   http://localhost/[root_dir]/[method]
         *                   Example: (norm) http://localhost/bolkun/index/.../benchmark
         *                                   http://localhost/[root_dir]/.../[method]
         *                   Example: (max)  http://localhost/bolkun/index/.../devs/2
         *                                   http://localhost/[root_dir]/.../[method]/[params]
         * 3. core page
         * 4. others         Example: (min)  http://localhost/bolkun/users/list
         *                                   http://localhost/[root_dir]/[controller]/[method]
         *                   Example: (norm) http://localhost/bolkun/users/.../upload
         *                                   http://localhost/[root_dir]/[controller]/.../[method]
         *                   Example: (max)  http://localhost/bolkun/pages/.../upload/18
         *                                   http://localhost/[root_dir]/[controller]/.../[method]/[params]
         */
        // exploded array after bolkun ( [0] => index, [1] => 2 )
        $url = $this->getUrl();

        if ($url == NULL || is_numeric($url[0])) {
            // set default $currentController
            if (file_exists('../app/controllers/' . $this->currentController . '.php')) {
                require_once '../app/controllers/' . $this->currentController . '.php';
                // define object of a class
                $this->currentController = new $this->currentController;
            } else {
                die("Core: controller file " . $this->currentController . ".php not found 1!");
            }

            // check default $currentMethod
            if (!method_exists($this->currentController, $this->currentMethod)) {
                die("Core: method " . STARTMETHOD . " in controller " . STARTCONTROLLER . " not exists 1!");
            }

            // set $params
            if ($url != NULL) {
                if (is_numeric($url[0])) {
                    array_push($this->params, $url[0]);
                }
            }

            // Call a callback with array of params
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        } elseif ($url[0] == 'index') {
            // set default $currentController
            if (file_exists('../app/controllers/' . $this->currentController . '.php')) {
                require_once '../app/controllers/' . $this->currentController . '.php';
                // define object of a class
                $this->currentController = new $this->currentController;
            } else {
                die("Core: controller file " . $this->currentController . ".php not found 2!");
            }

            // set $currentMethod and $params
            $lastElement = end($url);
            if (is_numeric($lastElement)) {   // if last element of url is a number, than it`s a parameter
                array_push($this->params, $lastElement);
                // set before last url element as $currentController
                $this->currentMethod = $url[count($url) - 2];
            } else {
                // set last url element as $currentController
                $this->currentMethod = $lastElement;
            }

            // check $currentMethod
            if (!method_exists($this->currentController, $this->currentMethod)) {
                die("Core: method " . STARTMETHOD . " in controller " . STARTCONTROLLER . " not exists 2!");
            }

            // Call a callback with array of params
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        } elseif ($url[0] == 'core') {
            // This elseif must be present due to tinymce errors 'Uncaught SyntaxError: Unexpected identifier' with
            // plugin.min.js
            die();
        } else {
            // set $currentController
            $this->currentController = ucwords($url[0]);  // Example: users to Users
            if (file_exists('../app/controllers/' . $this->currentController . '.php')) {
                require_once '../app/controllers/' . $this->currentController . '.php';
                // define object of a class
                $this->currentController = new $this->currentController;
            } else {
                die("Core: controller file " . $this->currentController . ".php not found 3!");
            }

            // set $currentMethod and $params
            $lastElement = end($url);
            if (is_numeric($lastElement)) {   // if last element of url is a number, than it`s a parameter
                array_push($this->params, $lastElement);
                // set before last url element as $currentController
                $this->currentMethod = $url[count($url) - 2];
            } else {
                // set last url element as $currentController
                $this->currentMethod = $lastElement;
            }

            // check $currentMethod
            if (!method_exists($this->currentController, $this->currentMethod)) {
                die("Core: method " . STARTMETHOD . " in controller " . STARTCONTROLLER . " not exists 3!");
            }

            // Call a callback with array of params
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }
    }

    public function getUrl()
    {
        if (isset($_GET['url'])) {
            // delete spaces or other special symbols from the end od the string
            $url = rtrim($_GET['url'], '/');
            // The FILTER_SANITIZE_URL removes all illegal URL characters from a string
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // split array into parts
            $url = explode('/', $url);
            return $url;
        }
    }
}
