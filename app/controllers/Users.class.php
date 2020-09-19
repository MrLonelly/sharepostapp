<?php

class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        // Check request method
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // Process the form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => 'Register',
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'errors' => [
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => ''
                ]
            ];

            // Validate email
            if(empty($data['email']))
            {
                $data['errors']['email'] = 'Email cannot be empty';
            }
            elseif(strpos($data['email'], '@') === false)
            {
                $data['errors']['email'] = 'Email must contain @';
            }
            elseif($this->userModel->findUserByEmail($data['email']))
            {
                $data['errors']['email'] = 'Email already registered';
            }

            // Validate name
            if(empty($data['name']))
            {
                $data['errors']['name'] = 'Name cannot be empty';
            }

            // Validate password
            if(empty($data['password']))
            {
                $data['errors']['password'] = 'Password cannot be empty';
            }
            elseif(strlen($data['password']) < 8)
            {
                $data['errors']['password'] = 'Password must be atleast 8 chars';
            }

            // Validate confirm_password
            if(empty($data['confirm_password']))
            {
                $data['errors']['confirm_password'] = 'Confir password cannot be empty';
            }
            elseif ($data['confirm_password'] != $data['password'])
            {
                $data['errors']['confirm_password'] = 'Passwords do not match';
            }

            // Check if no errors
            if(empty($data['errors']['name']) && empty($data['errors']['email']) && empty($data['errors']['password']) && empty($data['errors']['confirm_password']))
            {
                // Validated
                
                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register User
                if($this->userModel->register($data))
                {
                    flash('register_success', 'You are now registered and can login');
                    redirect('users/login');
                }
                else
                {
                    $data['errors']['global'] = 'Something went wrong';

                    $this->view('users/register');
                }
            }
            else
            {
                $this->view('users/register', $data);   
            }
        }
        else
        {
            // Load form and init data
            
            $data = [
                'title' => 'Register',
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'errors' => [
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => ''
                ]
            ];

            // Loat view
            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        // Check request method
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // Process the form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => 'Login',
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'errors' => [
                    'email' => '',
                    'password' => '',
                ]
            ];

            // Validate email
            if(empty($data['email']))
            {
                $data['errors']['email'] = 'Email cannot be empty';
            }
            elseif(strpos($data['email'], '@') === false)
            {
                $data['errors']['email'] = 'Email must contain @';
            }

            // Validate password
            if(empty($data['password']))
            {
                $data['errors']['password'] = 'Password cannot be empty';
            }

            if($this->userModel->findUserByEmail($data['email']))
            {
                // User found
            }
            else
            {
                $data['errors']['email'] = 'Wrong email or password';
            }
            // Make sure data no errors
            if(empty($data['errors']['email']) && empty($data['errors']['password']))
            {
                // Check and login the user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if($loggedInUser)
                {
                    // Create sessions variables
                    $this->createUserSession($loggedInUser);
                }
                else
                {
                    $data['errors']['password'] = 'Wrong password';

                    $this->view('users/login', $data);
                }
            }
            else
            {
                // Load view
                $this->view('users/login', $data);
            }
        }
        else
        {
            // Load form and init data
            
            $data = [
                'title' => 'Login',
                'email' => '',
                'password' => '',
                'errors' => [
                    'email' => '',
                    'password' => ''
                ]
            ];

            // Loat view
            $this->view('users/login', $data);
        }
    }

    // Create sessions
    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name']   = $user->name;
        $_SESSION['user_email'] = $user->email;

        redirect('posts');
    }


    // Logout the user
    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);

        session_destroy();

        redirect('pages/index');
    }
}

?>