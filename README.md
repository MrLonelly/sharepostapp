
# sharepostapp
SharePost application built on my opensource test MVC [(link to MVC)](https://github.com/MrLonelly/lonellymvc)

# Files

Project file tree :
```
sharepostapp
├── app
│   ├── bootstrap.php
│   ├── config
│   │   └── config.php
│   ├── controllers
│   │   ├── Pages.class.php
│   │   ├── Posts.class.php
│   │   └── Users.class.php
│   ├── helpers
│   │   ├── sessions_helper.php
│   │   └── url_helper.php
│   ├── libraries
│   │   ├── Controller.class.php
│   │   ├── Core.class.php
│   │   └── Database.class.php
│   ├── models
│   │   ├── Post.class.php
│   │   └── User.class.php
│   └── views
│       ├── 404.html
│       ├── include
│       │   ├── footer.php
│       │   ├── header.php
│       │   └── navbar.php
│       ├── pages
│       │   ├── about.php
│       │   └── index.php
│       ├── posts
│       │   ├── add.php
│       │   ├── edit.php
│       │   ├── index.php
│       │   └── show.php
│       └── users
│           ├── login.php
│           └── register.php
├── public
│   ├── css
│   │   └── main.css
│   ├── index.php
│   └── js
│       └── main.js
└── README.md

14 directories, 28 files

```

Social network built over the MVC, was added 2 aditional controllers and models (Users and Posts)

#### UserController
```PHP
	public function __construct()
    {
	    // Gets the model of user
        $this->userModel = $this->model('User');
    }
	
	// Register the user
    public function register()

	// Login the user
    public function login()

    // Create sessions
    public function createUserSession($user)
    
    // Logout the user
    public function logout()

```

#### PostsController
```PHP
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

		// Gets users and posts model
        $this->postsModel = $this->model('Post');
        $this->usersModel = $this->model('User');
    }

    // Main post page
    public function index()

    // Add a new post
    public function add()

    // Edit a post
    public function edit($id)

    // Show specific post info
    public function show($id)

    // Delete posts from db
    public function delete($id)
```

# About author
## Student şi Part-Time worker
- 🔭 Studying deep web
- 🌱 I'm  constantly growing
- 👯 Open for new jobs
- 🥅 2020 Goals: Learn more about Web Development
- ⚡ Fun fact: I'm using vim (old-fag)

### Connect with me:

[<img align="left" alt="MrLonelly | Twitter" width="22px" src="https://cdn.jsdelivr.net/npm/simple-icons@v3/icons/twitter.svg" />][twitter]
[<img align="left" alt="MrLonelly | LinkedIn" width="22px" src="https://cdn.jsdelivr.net/npm/simple-icons@v3/icons/linkedin.svg" />][linkedin]
[<img align="left" alt="MrLonelly | Instagram" width="22px" src="https://cdn.jsdelivr.net/npm/simple-icons@v3/icons/instagram.svg" />][instagram]

[twitter]: https://twitter.com/mr_l0n3lly
[instagram]: https://www.instagram.com/apavalac/
[linkedin]: https://www.linkedin.com/in/andrei-pavalachi-270b3a167/
