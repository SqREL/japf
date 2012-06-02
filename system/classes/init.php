<?php
class Init
{
    protected $controller;
    protected $action;
    protected $id;

    function __construct()
    {

    }

    #start app
    function start()
    {
        if (!empty($_GET['route']))
        {
            $routes = trim($_GET['route'], "/");
            $routes = explode("/", $routes);
        } else
            $routes = null;
        switch (count($routes))
        {
        case 0:
            $this->controller = DEFAULT_CONTROLLER;
            $this->action     = DEFAULT_ACTION;
            $this->id         = null;
            break;
        case 1:
            $this->controller = $routes[0];
            $this->action     = DEFAULT_ACTION;
            $this->id         = null;
            break;
        case 2:
            $this->controller = $routes[0];
            $this->action     = $routes[1];
            $this->id         = null;
            break;
        case 3:
            $this->controller = $routes[0];
            $this->action     = $routes[1];
            $this->id         = $routes[2];
            break;
        }
        $controller = ucfirst($this->controller);
        $action = $this->action;
        $app = new $controller($this->controller,
                               $this->action,
                               $this->id);
        $app->$action();
    }

}
?>
