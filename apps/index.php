<?php

    date_default_timezone_set('Asia/Manila');
    include_once("../apps/includes/sessions/checkSession.php");
    include_once("../apps/includes/logs/log.php");
    $log = new log;
    if(isset($_SESSION['email']) && isset($_SESSION['password']) && isset($_SESSION['role']) && isset($_SESSION['department'])) {
        $session = new mySession($_SESSION['email'], $_SESSION['password'], $_SESSION['role'], $_SESSION['department'], new Log);
        $session->checkSession();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.4.0-web/css/all.css">
    <link rel="stylesheet" href="../assets/css/style-login.css">
    <title>Document</title>
</head>
<body>
    <section class="login-section d-flex justify-content-center align-items-center " >
        <div class="login-box-center bg-white">
        <div class="left">
                <span class="yellow" ></span>
                <span class="orange p-2" >
                    <img src="../assets/images/schedule-icon.JPG" width="100%" alt="">
                    </span>
                <span class="blue" ></span>
            </div>
            <div class="right">
                <span class="yellow" ></span>
                <span class="orange" ></span>
                <span class="white d-flex justify-content-center align-items-center" >
                    <form id="loginForm" class="w-100 p-3" >
                        <div class="text-center neust-logo-center">
                            <img class="neust-logo" src="../assets/images/icon.gif" alt="">
                            <h6 class="mt-1" >ADMINISTRATOR</h6><hr>
                            <div class="alert alert-danger error-global-login global d-none " style="font-size: 14px;" ></div>
                        </div>
                        <div class="input-group mt-3">
                            <input type="text" name="email" class="form-control input" placeholder="Email Address">
                            <span class="input-group-text" ><i class="fa fa-envelope"></i></span>
                        </div>
                        <small class="error error-email-login text-danger" ></small>
                        <div class="input-group mt-3">
                            <input type="password" name="password" class="form-control input" placeholder="Password">
                            <span class="input-group-text" ><i class="fa fa-eye"></i></span>
                        </div>
                        <small class="error error-password-login text-danger" ></small>
                        <div class="text-center mt-3">
                            <button type="submit" id="loginForm-submit" class="btn btn-primary w-75" ><span>Login <i class="fa fa-arrow-right" ></i></span></button>
                        </div>
                    </form>
                </span>
            </div>
        </div>
    </section>
<?php
    
    if((isset($_SESSION['code']) && isset($_SESSION['code_time']))){

        $currentDateTime = date("Y-m-d H:i");
        $codeTime = $_SESSION['code_time'];

        if (strtotime($currentDateTime) >= $codeTime) {
            header("location: logout.php");
        } else {  
?>
            <section class="verification-section d-flex justify-content-center align-items-center" >
                <div class="verification-center bg-white rounded p-3">
                    <form id="verificationForm" action="./views/user.view.php" >
                        
                        <h6 class="" >Please verify your account.</h6><hr>
                        <div class="alert alert-danger error-global-verification-login global d-none text-center " style="font-size: 14px;" ></div>
                        <span class="group-input">
                            <input type="text" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="code1" class="form-control input w-100" >
                            <input type="text" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="code2" class="form-control input w-100" >
                            <input type="text" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="code3" class="form-control input w-100" >
                            <input type="text" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="code4" class="form-control input w-100" >
                            <input type="text" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="code5" class="form-control input w-100" >
                            <input type="text" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="code6" class="form-control input w-100" >
                        </span>
                        <div class="text-center mt-3">
                            <a href="./logout.php" class="btn btn-danger" ><i class="fa fa-close" ></i> Cancel</a>
                            <button class="btn btn-primary" ><i class="fa fa-check" ></i> Verify</button>
                        </div>
                    </form>
                </div>
            </section>
<?php
        }
    }
    
?>
</body>
<script src="../assets/js/jquery-3.6.4.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/sweetalert2/dist/sweetalert2.all.js"></script>
<script src="../assets/js/all.js"></script>
</html>