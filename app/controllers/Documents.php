<?php

class Documents extends Controller
{
    public function __construct()
    {
        $this->pageModel = $this->model('Document');
        $this->userModel = $this->model('User');
    }
    /*
     * All Pages ▼
     */
    public function index()
    {
        $data = [
            'title' => "Dokumente",
        ];
        $this->view('documents/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => "Dokument einfügen",
        ];
        $this->view('documents/add', $data);
    }

    public function delete()
    {
        $data = [
            'title' => "Dokument entfernen",
        ];
        $this->view('documents/add', $data);
    }

    public function extras()
    {
        $data = [
            'title' => "Dokument sonstiges",
        ];
        $this->view('documents/extras', $data);
    }

    public function guideline()
    {
        $data = [
            'title' => "Richtlinienliste",
        ];
        $this->view('documents/guideline', $data);
    }

    public function list()
    {
        $data = [
            'title' => "Dokumentliste",
        ];
        $this->view('documents/list', $data);
    }
}