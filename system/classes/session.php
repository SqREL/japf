<?php
class Session
{
    function __construct()
    {
        session_start();
    }

    function set($key, $value)
    {
        if ($_SESSION[$key] = $value)
            return true;
        else
            return false;
    }

    function get($key, $not_exists = false)
    {
        return !empty($_SESSION[$key]) ? $_SESSION[$key] : $not_exists;
    }

    function push($session, $value)
    {
        if (!$this->get($session))
            $this->set($session, array());
        array_push($_SESSION[$session], $value);
    }

    function remove($session, $value)
    {
        if (!$this->get($session))
            return true;
        $num = array_search($value, $_SESSION[$session]);
        unset($_SESSION[$session][$num]);
    }
}
?>
