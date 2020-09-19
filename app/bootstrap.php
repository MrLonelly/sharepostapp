<?php

    // Load Config
    require_once 'config/config.php';

    // Loat helpers
    require_once 'helpers/url_helper.php';
    require_once 'helpers/sessions_helper.php';

    // Autoload Core Libraries
    spl_autoload_register(function($className){
        require_once 'libraries/' . $className . '.class.php';
    });
?>