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
        $this->usersModel = $this->model('User');
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


    // Add a new post
    public function add()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'post_title' => trim($_POST['post_title']),
                'post_body' => trim($_POST['post_body']),
                'user_id' => $_SESSION['user_id'],
                'errors' => [
                    'post_title' => '',
                    'post_body' => ''
                ]
            ];

            // Validate data
            if(empty($data['post_title']))
            {
                $data['errors']['post_title'] = 'Please enter title';
            }

            // Validate body
            if(empty($data['post_body']))
            {
                $data['errors']['post_body'] = 'Please enter a body';
            }

            // Make sure no errors
            if(empty($data['errors']['post_title']) && empty($data['errros']['post_body']))
            {
                // Save the post
                if($this->postsModel->addPost($data))
                {
                    flash('post_message', 'Post Added');
                    redirect('posts');
                }
                else
                {
                    die('Something went wrong');
                }
            }
            else
            {
                // Load the view with errors
                $this->view('posts/add', $data);
            }
        }
        else
        {
            $data = [
                'post_title' => '',
                'post_body' => ''
            ];
    
            $this->view('posts/add', $data);
        }
        
    }

    // Edit a post
    public function edit($id)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'post_title' => trim($_POST['post_title']),
                'post_body' => trim($_POST['post_body']),
                'user_id' => $_SESSION['user_id'],
                'errors' => [
                    'post_title' => '',
                    'post_body' => ''
                ]
            ];

            // Validate data
            if(empty($data['post_title']))
            {
                $data['errors']['post_title'] = 'Please enter title';
            }

            // Validate body
            if(empty($data['post_body']))
            {
                $data['errors']['post_body'] = 'Please enter a body';
            }

            // Make sure no errors
            if(empty($data['errors']['post_title']) && empty($data['errros']['post_body']))
            {
                // Save the post
                if($this->postsModel->updatePost($data))
                {
                    flash('post_message', 'Post Edited');
                    redirect('posts');
                }
                else
                {
                    die('Something went wrong');
                }
            }
            else
            {
                // Load the view with errors
                $this->view('posts/edit', $data);
            }
        }
        else
        {
            // Get existing post from model
            $post = $this->postsModel->getPostById($id);

            // Check for owner
            if($_SESSION['user_id'] != $post->user_id)
                redirect('posts');

            $data = [
                'id' => $id,
                'post_title' => $post->title,
                'post_body' => $post->body
            ];

            $this->view('posts/edit', $data);
        }
        
    }

    // Show specific post info
    public function show($id)
    {
        // Get post data
        $post = $this->postsModel->getPostById($id);
        $user = $this->usersModel->getUserById($post->user_id);
        
        $data = [
            'post' => $post,
            'user' => $user
        ];

        $this->view('posts/show', $data);
    }

    // Delete posts from db
    public function delete($id)
    {
        
        // Get existing post from model
        $post = $this->postsModel->getPostById($id);
            
        // Check for owner
        if($_SESSION['user_id'] != $post->user_id)
            redirect('posts');

        if($this->postsModel->deletePostById($id))
        {
            flash('post_message', 'Post Deleted');
            redirect('posts');
        }
        else
            redirect('404.html');
    }
}

?>