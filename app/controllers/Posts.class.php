<?php

class Posts extends Controller
{

    // Construct where user auth is checked
    public function __construct()
    {
        if(!isLoggedIn())
        {
            redirect('users/login');
        }

        $this->postsModel = $this->model('Post');
    }

    // Main post page
    public function index()
    {
        // Get posts
        $posts = $this->postsModel->getPosts();

        $data = [
            'posts' => $posts
        ];

        $this->view('posts/index', $data);
    }
}

?>