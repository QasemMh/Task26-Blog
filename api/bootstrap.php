<?php
define("PROJECT_ROOT_PATH", __DIR__);


// include main configuration file
require_once PROJECT_ROOT_PATH . "\inc\config.php";

// include the base controller file
require_once PROJECT_ROOT_PATH . "\controller\baseController.php";


// include database  file
require_once PROJECT_ROOT_PATH . "\models\database.php";

// include the models file


require_once PROJECT_ROOT_PATH . "\Models\Users.php";
require_once PROJECT_ROOT_PATH . "\Models\Category.php";
require_once PROJECT_ROOT_PATH . "\Models\Post.php";
require_once PROJECT_ROOT_PATH . "\Models\PostComment.php";
require_once PROJECT_ROOT_PATH . "\Models\Home.php";
require_once PROJECT_ROOT_PATH . "\Models\About.php";
require_once PROJECT_ROOT_PATH . "\Models\Contact.php";
