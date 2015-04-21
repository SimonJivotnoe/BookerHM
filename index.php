<?php
include 'config.php'; //connect config file
include 'Router.php'; //connect Router

function __autoload($class)
{
   $directories = array( //include all directories in Array
            '/controllers/',
            '/models/',
            '/view/'
        );
		//foreach directory
        foreach($directories as $directory)
        {
            //see if the file exsists
            if(file_exists(dirname(__FILE__).$directory.$class.'.php'))
            {
                require_once(dirname(__FILE__).$directory.$class.'.php');
                //only require the class once, so quit after to save effort (if you got more, then name them something else 
                return;
            }            
        }
}
$router = new Router();