<?php

require_once("../models/user.model.php"); // Changed include_once to require_once
require_once("../includes/validations/validation.php");
require_once("../includes/logs/log.php");
require_once("../includes/hash/hash.php");
require_once("../Email/email.php");

$log = new Log;
$hash = new Hash;
$validation = new Validation;
$mailer = new Email;

class UserView extends UserModel {

    private $validation;

    public function __construct(Log $log , Hash $hash ,Validation $validation, Email $mailer  )
    {
        $this->log = $log;
        $this->hash = $hash;
        $this->validation = $validation;
        $this->mailer = $mailer;
    }

    public function logins(){
        
        if(!empty($this->getEmail())){
            if(!empty($this->getPassword())){
                if($this->validation->email($this->getEmail())){
                    $this->setEmail($this->validation->email($this->getEmail()));

                    if(strlen($this->getPassword()) >= 8  ){
                        return $this->login();
                    }
                    else{
                        $this->log->saveLog($this->logPath,"Password must be atleast 8 letter.");
                        return json_encode(array('status'=>false, 'error'=>"password" ,"message"=>"Password must be atleast 8 letter."));
                    }
                }
                else{
                    $this->log->saveLog($this->logPath, "input valid email address.");
                    return json_encode(array('status'=>false, 'error'=>"email" ,"message"=>"Please input valid email address."));
                }
            }
            else{
                $this->log->saveLog($this->logPath, "password field is required");
                return json_encode(array('status'=>false, 'error'=>"password" ,"message"=>"This field is required."));
            }
        }
        else{
            $this->log->saveLog($this->logPath,"email field is required");
            return json_encode(array('status'=>false, 'error'=>"email" ,"message"=>"This field is required."));
        }
    }

    public function verifyAccounts(){
        if($this->validation->numeric($this->getVerificationCode())){
            return $this->loginVerify();
        }
        else{
            $this->log->saveLog($this->logPath,"Verification code must be a number.");
            return json_encode(array('status'=>false, 'error'=>"verification" ,"message"=>"Verification code must be a number."));
        }
    }
}

$action = $_POST['action'];

if(!empty($action)){
    $user = new UserView($log,$hash,$validation,$mailer);

    switch($action){
        case 'logins':{
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            echo $user->logins();
            break;
        }
        case 'verifyAccounts':{

            $code1 = $_POST['code1'];
            $code2 = $_POST['code2'];
            $code3 = $_POST['code3'];
            $code4 = $_POST['code4'];
            $code5 = $_POST['code5'];
            $code6 = $_POST['code6'];
            $code = $code1.$code2.$code3.$code4.$code5.$code6;

            if(empty($code1) && empty($code2) && empty($code3) && empty($code4) && empty($code5) && empty($code6)){
                $log->saveLog("../../logs.log","Please input all verification input fields!");
                echo json_encode(array('status'=>false, 'error'=>"verification" ,"message"=>"Please input all input fields!"));
            }
            else{
                $user->setVerificationCode($code);
                echo $user->verifyAccounts();
            }

            break;
        }
        default:{
            $log->saveLog("../../logs.log", "action:{$action} is not existing!");
            die("action: {$action} is not existing!");
            break;
        }
    }
}
else{
    $log->saveLog("../../logs.log","action variable is empty!");
    die("action variable is empty!");
}




?>