<?php

class Admins extends Controller
{
    public function __construct()
    {
        $this->pageModel = $this->model('Admin');
    }
    /*
     * All Pages ▼
     */
    public function devs()
    {
        // Only for Admin
        if(isAdminLoggedIn() === true){
            $properties = [
                "browser" => "Browser: Google Chrome",
                "php" => "PHP: v7.3.10 (This server use PHP v". phpversion() . ")",
                "mysql" => "Database: MySQL (PDO connection required)",
                "jquery" => "jQuery: v3.4.1",
                "bootstrap" => "Bootstrap: v4.4.1",
            ];
            $data = [
                'title' => "Development",
                'properties' => $properties,
            ];
            $this->view('admins/devs/index', $data);
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }
    /*****************************************************************************************************************/
    public function tests()
    {
        // Only for Admin
        if(isAdminLoggedIn() === true){
            $data = [
                'title' => "Tests",
            ];
            $this->view('admins/tests/index', $data);
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

    public function benchmark()
    {
        // Only for Admin
        if(isAdminLoggedIn() === true){
            /*
             * Write Loop: foreach() vs for() vs while()
             */
            //foreach()
            $aHash = benchmark_prepare();
            $time = microtime(true);
            foreach($aHash as $key=>$val) $aHash[$key] = "a";
            $timeResult = microtime(true) - $time;

            $writeLoop = [
                'title' => "Rewrite Loop: foreach() vs for() vs while()",
                'description' => "What is the best way to rewrite hash array with new values in a loop? <br>Given is a Hash array filled with one character and with 100000 elements",
                'loopForEach' => 'foreach($aHash as $key=>$val) $aHash[$key] = "a"',
                'loopForEachTime' => $timeResult . " ms",
            ];
            // Read Loop: foreach() vs for() vs while()

            $readLoop = [
                'title' => "Read Loop: foreach() vs for() vs while()",
                'description' => "What is the best way to loop a hash array? <br>Given is a Hash array with 100 elements, 24byte key and 10k data per entry",


            ];
            $data = [
                'title' => "Performance Testing",
                'writeLoop' => $writeLoop,
                'readLoop' => $readLoop,

            ];
            $this->view('admins/tests/benchmark', $data);
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

    public function date_helper()
    {
        // Only for Admin
        if(isAdminLoggedIn() === true){
            $this->view('admins/tests/helpers/date_helper');
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }
    /*****************************************************************************************************************/
    public function users()
    {
        // Only for Admin
        if(isAdminLoggedIn() === true){
            $data = [
                'title' => "Users",
            ];
            $this->view('admins/users/index', $data);
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

    public function add()
    {
        // Only for Admin
        if(isAdminLoggedIn() === true){
            $data = [
                'title' => "Neue Mitarbeiter erstellen",
            ];
            $this->view('admins/users/add', $data);
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

    public function delete()
    {
        // Only for Admin
        if(isAdminLoggedIn() === true){
            $data = [
                'title' => "Mitarbeiter entfernen",
            ];
            $this->view('admins/users/delete', $data);
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

    public function info()
    {
        // Only for Admin
        if(isAdminLoggedIn() === true){
            $data = [
                'title' => "Mitarbeiter persönliche Informationen",
            ];
            $this->view('admins/users/info', $data);
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

    public function list()
    {
        // Only for Admin
        if(isAdminLoggedIn() === true){
            $data = [
                'title' => "Mitarbeiter Liste",
            ];
            $this->view('admins/users/list', $data);
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }
    /*****************************************************************************************************************/
    public function pages_newEditDelete()
    {
        // Only for Admin
        if(isAdminLoggedIn() === true){
            $data = [
                'title' => "New/Edit/Delete",
            ];
            $this->view('admins/pages/pages_newEditDelete', $data);
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }
    /*****************************************************************************************************************/

}