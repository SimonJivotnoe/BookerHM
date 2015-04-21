<?php


/**
 * Class SessionModel
 */
class SessionModel {
    /**
     *
     */
    public function __construct()
    {

    }

    /**
     * @param $key
     * @param $value
     * @return bool
     */
    public function add($key, $value)
    {
        if(session_start())
        {
            $_SESSION[$key] = $value;
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * @param $key
     * @return bool
     */
    public function read($key)
    {
        if(isset($_SESSION[$key]))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * @param $key
     * @return bool
     */
    public function remove($key)
    {
        if(isset($_SESSION[$key]))
        {
            session_unset();
            return true;
        }
        else
        {
            return false;
        }
    }
} 