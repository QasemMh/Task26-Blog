<?php
require __DIR__ . "/bootstrap.php";

function  __Exit()
{
    header("Content-Type: application/json");
    header("HTTP/1.1 400 Bad Request");
    echo json_encode(["error" => "invalid param, {Controller}/{method}/{id}"]);
}


$uriResult = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uriResult);



//if no controller called then exit
isset($uri[3]) ? define("CONTROLLER", strtolower($uri[3])) : __Exit();
//action method
isset($uri[4]) ? define("ACTION", strtolower($uri[4])) : "";
//id
isset($uri[5]) ? define("ID", (int)$uri[5]) : "";


//check if USER controller is called
// api/users
// api/users/create
// api/users/update/{id}
// api/users/delete/{id}
if (CONTROLLER == "users") {
    //require controller
    require_once PROJECT_ROOT_PATH . "\Controller\UsersController.php";
    $users = new UsersController();

    //ACTION is Action method >>  api/users/{ActionMethod}/{ID}
    //ID is id
    if (defined("ACTION")) :
        //if equal create, then create user
        if (ACTION === "create") :
            $users->Create();
        //else, it is mean the action method(details,update,delete) is call
        // all these methods required {ID}
        else :
            //check if {ID} is set
            if (defined("ID")) :
                //choose action method
                //api/users/{ACTION_METHOD}/{ID}
                switch (ACTION):
                    case "details":
                        $users->Details(ID);
                        break;
                    case "update":
                        $users->Update(ID);
                        break;
                    case "delete":
                        $users->Delete(ID);
                        break;
                endswitch;
            //if {ID} not set
            else :
                __Exit();
            endif;
        endif;
    //if there no action method called then its mean get all data: INDEX
    //http://localhost:81/POB-TASKS/task23/api/users
    else :
        $users->Index();
    endif;

    exit();
}



//check if category controller is called
// api/category
// api/category/create
// api/category/update/{id}
// api/category/delete/{id}
if (CONTROLLER == "category") {
    //require controller
    require_once PROJECT_ROOT_PATH . "\Controller\categoryController.php";
    $category = new categoryController();

    //ACTION is Action method >>  api/category/{ActionMethod}/{ID}
    //ID is id
    if (defined("ACTION")) :
        //if equal create, then create user
        if (ACTION === "create") :
            $category->Create();
        //else, it is mean the action method(details,update,delete) is call
        // all these methods required {ID}
        else :
            //check if {ID} is set
            if (defined("ID")) :
                //choose action method
                //api/category/{ACTION_METHOD}/{ID}
                switch (ACTION):
                    case "details":
                        $category->Details(ID);
                        break;
                    case "update":
                        $category->Update(ID);
                        break;
                    case "delete":
                        $category->Delete(ID);
                        break;
                endswitch;
            //if {ID} not set
            else :
                __Exit();
            endif;
        endif;
    //if there no action method called then its mean get all data: INDEX
    //http://localhost:81/POB-TASKS/task23/api/category
    else :
        $category->Index();
    endif;

    exit();
}



//check if post controller is called
// api/post
// api/post/create
// api/post/update/{id}
// api/post/delete/{id}
if (CONTROLLER == "post") {
    //require controller
    require_once PROJECT_ROOT_PATH . "\Controller\postController.php";
    $post = new PostController();

    //ACTION is Action method >>  api/post/{ActionMethod}/{ID}
    //ID is id
    if (defined("ACTION")) :
        //if equal create, then create user
        if (ACTION === "create") :
            $post->Create();
        //else, it is mean the action method(details,update,delete) is call
        // all these methods required {ID}
        else :
            //check if {ID} is set
            if (defined("ID")) :
                //choose action method
                //api/post/{ACTION_METHOD}/{ID}
                switch (ACTION):
                    case "details":
                        $post->Details(ID);
                        break;
                    case "update":
                        $post->Update(ID);
                        break;
                    case "delete":
                        $post->Delete(ID);
                        break;
                endswitch;
            //if {ID} not set
            else :
                __Exit();
            endif;
        endif;
    //if there no action method called then its mean get all data: INDEX
    //http://localhost:81/POB-TASKS/task23/api/post
    else :
        $post->Index();
    endif;

    exit();
}



//check if Comment controller is called
// api/comments
// api/comments/create
// api/comments/delete/{id}

// api/comments/post/{post id}
if (CONTROLLER == "comments") {
    //require controller
    require_once PROJECT_ROOT_PATH . "\Controller\CommentController.php";
    $comment = new CommentController();

    //ACTION is Action method >>  api/comment/{ActionMethod}/{ID}
    //ID is id
    if (defined("ACTION")) :
        //if equal create, then create user
        if (ACTION === "create") :
            $comment->Create();
        //else, it is mean the action method(details,update,delete) is call
        // all these methods required {ID}
        else :
            //check if {ID} is set
            if (defined("ID")) :
                //choose action method
                //api/comments/{ACTION_METHOD}/{ID}
                switch (ACTION):
                    case "details":
                        $comment->Details(ID);
                        break;
                    case "delete":
                        $comment->Delete(ID);
                        break;
                    case "post":
                        $comment->PostComments(ID);
                        break;
                endswitch;
            //if {ID} not set
            else :
                __Exit();
            endif;
        endif;
    //if there no action method called then its mean get all data: INDEX
    //http://localhost:81/POB-TASKS/task23/api/comments
    else :
        $comment->Index();
    endif;

    exit();
}

//check if user message controller is called
// api/message
// api/message/create
// api/message/update/{id}
// api/message/delete/{id}
if (CONTROLLER == "message") {
    //require controller
    require_once PROJECT_ROOT_PATH . "\Controller\UserMsgController.php";
    $userMsg = new userMsgController();

    //ACTION is Action method >>  api/message/{ActionMethod}/{ID}
    //ID is id
    if (defined("ACTION")) :
        //if equal create, then create user
        if (ACTION === "create") :
            $userMsg->Create();
        //else, it is mean the action method(details,update,delete) is call
        // all these methods required {ID}
        else :
            //check if {ID} is set
            if (defined("ID")) :
                //choose action method
                //api/message/{ACTION_METHOD}/{ID}
                switch (ACTION):
                    case "details":
                        $userMsg->Details(ID);
                        break;
                    case "update":
                        $userMsg->Update(ID);
                        break;
                    case "delete":
                        $userMsg->Delete(ID);
                        break;
                endswitch;
            //if {ID} not set
            else :
                __Exit();
            endif;
        endif;
    //if there no action method called then its mean get all data: INDEX
    //http://localhost:81/POB-TASKS/task23/api/message
    else :
        $userMsg->Index();
    endif;

    exit();
}







/* */

//check if Home controller is called
// api/home
// api/home/create
// api/home/update
// api/home/delete
if (CONTROLLER == "home") {
    //require controller
    require_once PROJECT_ROOT_PATH . "\Controller\HomeController.php";
    $home = new HomeController();
    //ACTION is Action method >>  api/home/{ActionMethod}
    if (defined("ACTION")) {
        //if equal create, then create user
        if (ACTION === "create")
            $home->Create();
        else if (ACTION == "update")
            $home->Update();
        else if (ACTION == "delete")
            $home->Delete();
        else __Exit();
    } else {
        $home->Index();
    }
    exit();
}
//check if about controller is called
// api/about
// api/about/create
// api/about/update
// api/about/delete
if (CONTROLLER == "about") {
    //require controller
    require_once PROJECT_ROOT_PATH . "\Controller\AboutController.php";
    $about = new AboutController();
    //ACTION is Action method >>  api/about/{ActionMethod}
    if (defined("ACTION")) {
        //if equal create, then create user
        if (ACTION === "create")
            $about->Create();
        else if (ACTION == "update")
            $about->Update();
        else if (ACTION == "delete")
            $about->Delete();
        else __Exit();
    } else {
        $about->Index();
    }
    exit();
}
if (CONTROLLER == "contact") {
    //require controller
    require_once PROJECT_ROOT_PATH . "\Controller\ContactController.php";
    $contact = new ContactController();
    //ACTION is Action method >>  api/contact/{ActionMethod}
    if (defined("ACTION")) {
        //if equal create, then create user
        if (ACTION === "create")
            $contact->Create();
        else if (ACTION == "update")
            $contact->Update();
        else if (ACTION == "delete")
            $contact->Delete();
        else __Exit();
    } else {
        $contact->Index();
    }
    exit();
}

__Exit();
