<?php
    class Sesion_Usuario_Controller{
        function __construct(){
            session_start();
        }

        function set_current_user($id){
            $_SESSION['rygo_session'] = $id;
        }

        function get_current_user(){
            return $_SESSION['rygo_session'];
        }

        function close_session(){
            session_unset();
            session_destroy();
        }
    }
?>