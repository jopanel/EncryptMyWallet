<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('navBarHelper'))
{
    function navBarHelper($controller_name, $page){
        if ($page == $controller_name) { return "active"; } 
    }
   
}

?>