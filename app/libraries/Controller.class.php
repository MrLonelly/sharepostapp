<?php

    /* 
     * Base controller
     * Loads model and views
     * 
     */

    Class Controller
    {
        // Load model
        public function model($model)
        {
            // Require model file
            require_once APPROOT . '/models/' . $model . '.class.php';

            return new $model;
        }

        // Load view
        public function view($view, $data = [])
        {
            // Check for the view file
            if(file_exists('../app/views/' . $view . '.php'))
            {
                require_once '../app/views/' . $view . '.php';
            }
            else
            {
                require_once '../app/views/404.html';
            }
        }
    }

?>