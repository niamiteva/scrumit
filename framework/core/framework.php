<?php
    class Framework {


    public static function run() {

        echo "run()";
  
        self::init();
        //self::autoload();
        //self::dispatch();
    }


    public static function init() {
            
        // Define path constants

        define("DS", DIRECTORY_SEPARATOR);
        define("ROOT", getcwd() . DS);
        define("APP", ROOT . 'app' . DS);
        define("FRAMEWORK", ROOT . "framework" . DS);
        define("SRC", ROOT . "src" . DS);

        define("CONFIG", APP . "config" . DS);
        define("CONTROLLER", APP . "controllers" . DS);
        define("MODEL", APP . "models" . DS);
        define("VIEW", APP . "views" . DS);

        define("CORE", FRAMEWORK . "core" . DS);
        define('DB', FRAMEWORK . "database" . DS);
        define("LIB", FRAMEWORK . "libraries" . DS);
        define("HELPER", FRAMEWORK . "helpers" . DS);
        define("UPLOAD", SRC . "uploads" . DS);

        // Define platform, controller, action, for example:
        // index.php?p=admin&c=Goods&a=add
        define("PLATFORM", isset($_REQUEST['p']) ? $_REQUEST['p'] : 'home');
        //define("CONTROLLER", isset($_REQUEST['c']) ? $_REQUEST['c'] : 'Index');
        define("ACTION", isset($_REQUEST['a']) ? $_REQUEST['a'] : 'index');

        define("CURR_CONTROLLER", CONTROLLER . PLATFORM . DS);
        define("CURR_VIEW", VIEW . PLATFORM . DS);

        // Load core classes
        require_once (CONFIG . 'core.php');

        // Load configuration file
        //$GLOBALS['core'] = include CONFIG . "core.php";

        // Start session
        session_start();
    }

}
?>