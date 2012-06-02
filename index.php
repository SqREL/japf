<?php
# db config
define("DB_HOST", "localhost");
define("DB_USER", "");
define("DB_PASSWORD", "");
define("DB_NAME", "");

# default controller and action. Will be called if no
# controller or acrion will be set manualy
define("DEFAULT_CONTROLLER", "products");
define("DEFAULT_ACTION", "index");

# path to the folder with this app
define('BASE_PATH',   dirname(__FILE__));

# class autoload definition
function __autoload($class_name)
{
    $global_class = BASE_PATH."/system/classes/" . strtolower($class_name) .".php";
    $controller_class = BASE_PATH."/app/controllers/". strtolower($class_name) ."_controller.php";
    if (is_file($controller_class))
        require_once $controller_class;
    elseif (is_file($global_class))
        require_once $global_class;
}

#connect to DB
if (!mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)) {
    echo "Error while connecting to DB. Check config in ".BASE_PATH."index.php";
        exit;
    }
mysql_select_db(DB_NAME);

# start application
$init = new Init();
$init->start();

?>
