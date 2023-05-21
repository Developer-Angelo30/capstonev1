<?php
session_start();
require_once("../database/database.php");
class UserModel extends DB {
    
    protected $log;
    protected $hash;
    protected $mailer;

    protected $email;
    protected $firstname;
    protected $lastname;
    protected $password;
    protected $role;
    protected $department;
    protected $logPath = "../../logs.log";

    protected $verificationCode;

    public function __construct(Log $log , Hash $hash , Email $mailer)
    {
        $this->log = $log;
        $this->hash = $hash;
        $this->mailer = $mailer;
    }

    protected function login(){
        $email = mysqli_real_escape_string($this->DBconnection(), $this->getEmail());
        $password = mysqli_real_escape_string($this->DBconnection(), $this->getPassword());

        $now = date("Y-m-d H:i");
        
        $add = strtotime($now) + (3 * 60);
        $punish = date("Y-m-d H:i" , $add );

        $sql_check_account = "SELECT users.* , attempts.* FROM users INNER JOIN attempts ON attempts.userID = users.userID WHERE users.userEmail = '$email'";
        $result_check_account = mysqli_query($this->DBconnection(), $sql_check_account);
        if(mysqli_num_rows($result_check_account)){

            $row = mysqli_fetch_assoc($result_check_account);
            $id = $row['userID'];
            $attempt = $row['attempt'] - 1;

            if($this->hash->decrypt($password, $row['userPassword'])){

                $reset = "UPDATE `attempts` SET `attempt`= 3 ,`attempt_date`='$punish' WHERE `userID`= '$id' ";
               
                if($row['attempt'] != 0 ){
                    
                        $result = mysqli_query($this->DBconnection(), $reset);
                        if($result){

                            $code = mt_rand(111111,999999);

                            $_SESSION['email'] = $row['userEmail'];
                            $_SESSION['password'] = $row['userPassword'];
                            // $_SESSION['role'] = $row['userRole'];
                            // $_SESSION['department'] = $row['userDepartment'];

                            switch($row['userRole']){
                                case 1:{
                                    if($this->mailer->sendVerification($row['userEmail'], $code)){
                                        $_SESSION['code'] = $this->hash->encrypt($code);
                                        $_SESSION['code_time'] = strtotime($punish);
                                        $output = json_encode(array("status"=>true , "verify"=> true ));
                                        $this->log->saveLog($this->logPath ,"login as dean.", $this->logPath );
                                    }
                                    break;
                                }
                                case 2:{
                                    if($this->mailer->sendVerification($row['userEmail'], $code)){
                                        $_SESSION['code'] = $this->hash->encrypt($code);
                                        $_SESSION['code_time'] = strtotime($punish);
                                        $output = json_encode(array("status"=>true , "verify"=> true ));
                                        $this->log->saveLog($this->logPath ,"login as super admin.");
                                    }
                                    break;
                                }
                                case 3:{
                                    $_SESSION['role'] = $row['userRole'];
                                    $_SESSION['department'] = $row['userDepartment'];
                                    $output = json_encode(array("status"=>true , "verify"=>false , "message"=>"../admin/dashboard.php" ));
                                    $this->log->saveLog($this->logPath ,"login as admin.", $this->logPath );
                                    break;
                                }
                                default :{
                                    $this->log->saveLog($this->logPath ,"something wrong in role in case statement. role not found!");
                                    break;
                                }
                            }

                        }
                }
                else{
                    if(strtotime($now) >= strtotime($row['attempt_date'])){

                        $result = mysqli_query($this->DBconnection(), $reset);
                        if($result){

                            $code = mt_rand(111111,999999);

                            $_SESSION['email'] = $row['userEmail'];
                            $_SESSION['password'] = $row['userPassword'];
                            // $_SESSION['role'] = $row['userRole'];
                            // $_SESSION['department'] = $row['userDepartment'];

                            switch($row['userRole']){
                                case 1:{
                                    if($this->mailer->sendVerification($row['userEmail'], $code)){
                                        $_SESSION['code'] = $this->hash->encrypt($code);
                                        $_SESSION['code_time'] = strtotime($punish);
                                        $output = json_encode(array("status"=>true , "verify"=> true ));
                                        $this->log->saveLog($this->logPath ,"login as dean.");
                                    }
                                    break;
                                }
                                case 2:{
                                    if($this->mailer->sendVerification($row['userEmail'], $code)){
                                        $_SESSION['code'] =  $this->hash->encrypt($code);
                                        $_SESSION['code_time'] = strtotime($punish);
                                        $output = json_encode(array("status"=>true , "verify"=>true ));
                                        $this->log->saveLog($this->logPath ,"login as super admin.");
                                    }
                                    break;
                                }
                                case 3:{
                                    $_SESSION['role'] = $row['userRole'];
                                    $_SESSION['department'] = $row['userDepartment'];
                                    $output = json_encode(array("status"=>true , "verify"=>false , "message"=>"../admin/dashboard.php" ));
                                    $this->log->saveLog($this->logPath ,"login as admin.");
                                    break;
                                }
                                default :{
                                    $this->log->saveLog($this->logPath ,"something wrong in role in case statement. role not found!");
                                    break;
                                }
                            }
                        }
                    }
                    else{
                        $this->log->saveLog($this->logPath ,"reach maximun attempt");
                        $output = json_encode(array("status"=>false , "error"=>"attempt" , "message"=>"Please try again in ".date('h:i A', strtotime($row['attempt_date']) ) ));
                    }
                }
            }
            else{

                if($row['attempt'] == 0 ){
                    if(strtotime($now) >= strtotime($row['attempt_date'])){
                        $update = "UPDATE `attempts` SET `attempt`= 2 ,`attempt_date`='$punish' WHERE `userID`= '$id' ";
                        $result = mysqli_query($this->DBconnection(), $update);
                        if($result){
                            $this->log->saveLog($this->logPath ,"login attempt");
                            $output = json_encode(array("status"=>false , "error"=>"password" , "message"=>"Password not matched, 2 more attempts." ));
                        }
                    }
                    else{
                        $this->log->saveLog($this->logPath ,"reach maximun attempt.");
                        $output = json_encode(array("status"=>false , "error"=>"attempt" , "message"=>"Please try again in ".date('h:i A', strtotime($row['attempt_date']) ) ));
                    }
                }
                else{
                    $update = "UPDATE `attempts` SET `attempt`= '$attempt' ,`attempt_date`='$punish' WHERE `userID`= '$id' ";
                    $result = mysqli_query($this->DBconnection(), $update);
                    if($result){
                        $this->log->saveLog($this->logPath ,"login attempt.");
                        $output = json_encode(array("status"=>false , "error"=>"password" , "message"=>"Password not matched, {$attempt} more attempts." ));
                    }
                }
            }
        }
        else{
            $output = json_encode(array("status"=>false , "error"=>"email" , "Please double check your email." ));
        }

        $this->DBclose();
        return $output;
    } 

    protected function loginVerify(){

        $email = mysqli_real_escape_string($this->DBconnection(),$_SESSION['email']);
        $password = mysqli_real_escape_string($this->DBconnection(),$_SESSION['password']);
        $code = $this->getVerificationCode();

        if($this->hash->decrypt($code, $_SESSION['code'])){

            $sql = "SELECT userRole , userDepartment FROM users WHERE userEmail = '$email' AND userPassword = '$password' ";
            $result = mysqli_query($this->DBconnection() , $sql);
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                $_SESSION['role'] = $row['userRole'];
                $_SESSION['department'] = $row['userDepartment'];
                return json_encode(array("status"=>true));
            }
            else{
                $this->log->saveLog($this->logPath ,"Credentials errors");
                die("Credentials errors");
            }
        }
        else{
            return json_encode(array("status"=>false , "error"=>"verification" , "message"=>"verification code is not matched!" ));
        }
    }

    public function setEmail($email){
        $this->email = $email;
    }

    protected function getEmail(){
        return $this->email;
    }

    public function setFirstname($firstname){
        $this->firstname = $firstname;
    }

    protected function getFirstname(){
        return $this->firstname;
    }

    public function setLastname($lastname){
        $this->lastname = $lastname;
    }

    protected function getLastname(){
        return $this->lastname;
    }

    public function setPassword(string $password){
        $this->password = $password;
    }

    protected function getPassword(){
        return $this->password;
    }

    public function setRole(int $role){
        $this->role = $role;
    }

    protected function getRole(){
        return $this->role;
    }

    public function setDepartment(string $department){
        $this->department = $department;
    }

    protected function getDepartment(){
        return $this->department;
    }

    public function setVerificationCode($verificationCode){
        $this->verificationCode = $verificationCode;
    }

    protected function getVerificationCode(){
        return $this->verificationCode;
    }

}


?>