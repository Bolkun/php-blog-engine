<?php

class Tasks extends Controller
{
    public function __construct()
    {
        $this->pageModel = $this->model('Task');
        $this->userModel = $this->model('User');
    }
    /*
     * All Pages start ▼
     */
    public function index()
    {
        $data = [
            'title' => "Aufgaben",
        ];
        $this->view('tasks/index', $data);
    }

    public function active()
    {
        $data = [
            'title' => "Aufgaben in der Bearbeitung",
        ];
        $this->view('tasks/active', $data);
    }

    public function add()
    {
        $data = [
            'title' => "Neue Aufgabe erstellen",
        ];
        $this->view('tasks/add', $data);
    }

    public function complete()
    {
        $data = [
            'title' => "Beendete Aufgaben",
        ];
        $this->view('tasks/complete', $data);
    }

    public function search()
    {
        $data = [
            'title' => "Aufgaben suchen",
        ];
        $this->view('tasks/search', $data);
    }

    public function restore()
    {
        $data = [
            'title' => "Wiederkehrende Aufgaben",
        ];
        $this->view('tasks/restore', $data);
    }
}