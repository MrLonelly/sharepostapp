<?php

class Pages extends Controller
{
    public function __construct()
    {
        $this->_postModel = $this->model('Post');
    }

    public function index()
    {

        $posts = $this->_postModel->getPosts();

        $data = [
            'title' => SITENAME,
            'description' => 'Simple social network built on the LonellyMVC PHP framework'
        ];

        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About',
            'description' => 'App to share posts with other users'
        ];

        $this->view('pages/about', $data);
    }
}

?>