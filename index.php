<?php

require_once "framework/core/framework.php";
Framework::init();

$page = isset($_GET['page'])?$_GET['page']:'main';
$act = isset($_REQUEST['act'])?$_REQUEST['act']:'index'; //the method from the page controller
$id = isset($_REQUEST['id'])?$_REQUEST['id']:null;
$object = isset($_REQUEST['object'])?$_REQUEST['object']:null; //if it uses methods not from the page controller

//create current page object
if (isset($page)) {
    $page_object_name = ucfirst($page) . "Controller";
	if (!file_exists('app/controllers/' . $page_object_name . '.php')) {
		$page_object_name = "NopageController";
	}
    $controller = ucfirst($page_object_name);
        require_once (CONTROLLER . $controller . ".php");
        $page_object = new $controller();

        if(($object) && $object !== $page){
            $objController = $object . 'Controller';
            require_once (CONTROLLER . $objController . '.php');
            $obj_object = new $objController();
            if(($act) && (method_exists($obj_object, $act))){
                $obj_object->$act($id);
            }
        }

        if (($act) && (method_exists($page_object, $act))) {
            $page_object->$act($id);
        } else {
            $page_object->index($id);
        }
} 




// require "framework/core/framework.php";


// Framework::run();



// $mainDir = "http://localhost/scrum_it_v1/";
// $rootPath = $_SERVER["DOCUMENT_ROOT"]."/scrum_it_v1/";
// //define('WEBROOT', str_replace("index.php", "", $_SERVER["SCRIPT_NAME"]));
// //define('ROOT', $rootPath);
// require(ROOT . 'app/config/core.php');

// error_reporting(0);
// //$uploadDir = $rootPath.'upload/';
// //$libDir = $rootPath."lib/";
// // $mainPath = dirname(__FILE__) . '/../';
// // $siteName = 'bgrf';

//  $debug = 1;
// if ($debug) {
//     error_reporting(E_ERROR);
// //    error_reporting(E_ALL);
//     ini_set('display_errors', 1);
//     ini_set('html_errors', 0);
// } else {
//     error_reporting(false);
//     ini_set('display_errors', 0);
//     ini_set('html_errors', 0);
// }



// $page = isset($_GET['page'])?$_GET['page']:'main';
// $act = isset($_REQUEST['act'])?$_REQUEST['act']:'index';
// $id = isset($_REQUEST['id'])?$_REQUEST['id']:null;

// //create current page object
// if (isset($page)) {
//     $page_object_name = ucfirst($page) . "Controller";
// 	if (!file_exists('php/' . $page_object_name . '.php')) {
// 		$page_object_name = "NopageController";
// 	}
// 	$controller = ucfirst($page_object_name);
//         $page_object = new $controller($dbconn);
//         if (($act) && (method_exists($page_object, $act))) {
//             $page_object->$act($id);
//         } else {
//             $page_object->index($id);
//         }
// } 


?>