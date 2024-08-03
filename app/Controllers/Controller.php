<?php

namespace App\Controllers;

class Controller{
    public function view($route, $data = []){

        extract($data);

        $route = str_replace('.', '/', $route);

        if(file_exists("../resources/views/$route.php")){
            ob_start();
            include "../resources/views/$route.php";
            $content = ob_get_clean();
            return $content;
        }else{
            return "404 - Not Found";
        }
    }

    public function redirect($route){
        header("Location: $route");
    }   
}