<?php
/*
 * App Core Class
 * Creates URL & loads core controller
 * URL FORMAT - /controller/method/params
 */
class Core {
    protected $currentController = STARTPAGE;
    protected $currentMethod = '';
    protected $params = [];

    // <Core construct>
    public function __construct()
    {
        //print_r($this->getUrl());
        $url = $this->getUrl();
        //delete duplicates from array
        if($url == NULL){
            redirect('users/login');
        } else {
            $url_unique = array_unique($url);
        }
        if(count($url) !== count($url_unique)){
            $page = '';
            foreach ($url_unique as $dir){
                $page .= $dir . '/';
            }
            redirect($page);
        }
        $lastElement = end($url);

        // Look in controllers for controller(first index or value)
        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
            $this->currentController = ucwords($url[0]);
        }

        require_once '../app/controllers/' . $this->currentController . '.php';

        $this->currentController = new $this->currentController;

        // Check for last part of url
        if($lastElement != $url[0]){
            // Check to see if method exists in controller
            if(method_exists($this->currentController, $lastElement)){
                $this->currentMethod = $lastElement;
                unset($lastElement);
            }
        } else if(count($url) == 0 || count($url) == 1) {
            $this->currentMethod = 'index';
        }
        // Incorrect url
        if($this->currentMethod == ''){
            die();
        }

        // Get params
        $this->params = $url ? array_values($url) : []; // if params set or not then leave array leer

        // Call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

        //Clear vars
        unset($url);
        unset($url_unique);
        unset($lastElement);
    }

    public function getUrl()
    {
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}