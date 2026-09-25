<?php

require_once dirname(__DIR__) . '/app/bootstrap.php';

spl_autoload_register(function ($class) {
    $class = ltrim($class, '\\');
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $class .= '.php';

    require_once APP_ROOT . DIRECTORY_SEPARATOR . $class;
});

header('Content-Type: text/html; charset=UTF-8');

$fileNotFound = false;

if(isset($_SESSION['logged'])){
    $controllerName = isset($_GET['target']) ? $_GET['target'] : 'index';
    $methodName = isset($_GET['action']) ? $_GET['action'] : 'main';
}
else{
    $controllerName = isset($_GET['target']) ? $_GET['target'] : 'index';
    $methodName = isset($_GET['action']) ? $_GET['action'] : 'index';
}

$controllerClassName = '\\Controller\\' . ucfirst($controllerName) . ucfirst('controller');

$controllerFile = APP_ROOT . DIRECTORY_SEPARATOR .
    str_replace('\\', DIRECTORY_SEPARATOR, $controllerClassName) . '.php';
// var_dump($controllerFile);

if(isset($_GET['err'])){
    $error = htmlentities($_GET['err']);
    $controller = new Controller\IndexController();
    $controller->error($error);
}
elseif(!file_exists($controllerFile)){
    $fileNotFound = true;
}
elseif (class_exists($controllerClassName)) {
    $contoller = new $controllerClassName();

    if(!(($controllerName === "index" || $controllerName === "user")  &&
        ($methodName === "index" || $methodName === "login" || $methodName === "register" ))){
        if(!isset($_SESSION["logged"])){
            $controller = new Controller\IndexController();
            $controller->error(401);
        }
        else{
            if (method_exists($contoller, $methodName)) {
                $controller = new Controller\IndexController();
                $contoller->$methodName();
            }
            else{
                $controller = new Controller\IndexController();
                $controller->error(404);
            }
        }
    }
    elseif (method_exists($contoller, $methodName)) {
        if(isset($_SESSION['logged']) && ($controllerName === "index")  &&
            ($methodName === "login" || $methodName === "register")){
            header('location:'.URL_ROOT.'/index/main');
        }
        $contoller->$methodName();
    }
    else {
        $controller = new Controller\IndexController();
        $controller->login();
    }
}
else {
    $fileNotFound = true;
}

if ($fileNotFound) {
    header("location:". URL_ROOT);
}

//var_dump($_GET);
