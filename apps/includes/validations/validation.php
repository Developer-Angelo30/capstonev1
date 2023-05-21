<?php
class Validation{

    public function email($email){
        if(filter_var($email , FILTER_VALIDATE_EMAIL)){
            return filter_var($email , FILTER_SANITIZE_EMAIL);
        }
    }

    public function alpha($input){
        $pattern = "/^[A-Za-z]+$/";
        return preg_match($pattern, $input);
    }

    public function numeric($input){
        $pattern = "/^[0-9]+$/";
        return preg_match($pattern, $input);
    }
}
?>