<?php
class Controller
{
    protected $controller;
    protected $action;
    protected $id;
    protected $db;
    protected $module;

    function __construct($controller, $action, $id)
    {
        $this->controller = $controller;
        $this->action     = $action;
        $this->id         = $id;
        $model_path       = BASE_PATH."/app/models/".$controller."_model.php";
        if (is_file($model_path))
        {
            require_once $model_path;
            $model    = ucfirst($controller)."Model";
            $this->db = new $model();
        }
    }

    function render($view, $params = array())
    {
        $view_path = BASE_PATH."/app/views/".$view.".php";
        if (file_exists($view_path))
        {
            if (!empty($params))
            {
                foreach ($params as $key => $value)
                    $$key = $value;
            }
            include($view_path);
        }
    }

    function render_action($action, $message=array())
    {
        $key = array_keys($message);
        if (!empty($key) && $key[0] == "notify")
            header("Location: "."$action?notify=".$message['notify'], TRUE, 302);
        else if (!empty($key) && $key[0] == "error")
            header("Location: "."$action?error=".$message['error'], TRUE, 302);
        else if (!empty($key) && $key[0] == "success")
            header("Location: "."$action?success=".$message['success'], TRUE, 302);
        else
            header("Location: $action", TRUE, 302);
    }

    # those method will puts some info about what are you doing
    function show_message()
    {
        if (!empty($_GET['error']))
            return "<div class=\"error\">".$_GET['error']."</div>";
        else if (!empty($_GET['notify']))
            return "<div class=\"notice\">".$_GET['notify']."</div>";
        else if (!empty($_GET['success']))
            return "<div class=\"success\">".$_GET['success']."</div>";
    }

    function load($class)
    {
        $class_name = ucfirst($class);
        $this->module[$class] = new $class_name;
    }
}
?>
