<?php

    include_once("../includes/sessions/loggedSession.php");
    include_once("../includes/logs/log.php");
    $session = new mySession($_SESSION['email'], $_SESSION['password'], $_SESSION['role'], $_SESSION['department'], new Log);
    $session->loggedSessionDean();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/fontawesome-free-6.4.0-web/css/all.css">
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <title>Document</title>
</head>
<body>
  <section id="dean-dashboard" >
    <span class="top-color" ></span>
    <div id="sidebar" class="" >
      <span class="text-white" id="close-sidebar" > <i class="fa fa-close" ></i> </span>
      <div class="blue-side text-center">
          <img src="../../assets/images/user-big.png" class="rounded-circle shadow mt-4" " alt="">
          <h3 class="text-white mt-2" >Lorem Lorem</h3>
          <h6 class="text-white text-uppercase fw-light" >CICT DEPARTMENT</h6>
      </div>
      <div  class="container">
        <div class="row mt-4">
          <div class="col text-center">
            <a href="#home" class="text-decoration-none" > <div class="icon-holder icon-holder-active " > <i class="fa fa-home" ></i><h6>Home</h6></div>  </a>
          </div>
          <div class="col text-center">
            <a href="#" class="text-decoration-none" > <div class="icon-holder" > <i class="fa fa-tasks" ></i><h6>Set Up</h6></div>  </a>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col text-center">
            <a href="#" class="text-decoration-none" > <div class="icon-holder " > <i class="fa fa-home" ></i><h6>Classroom</h6></div>  </a>
          </div>
          <div class="col text-center">
            <a href="#" class="text-decoration-none" > <div class="icon-holder" > <i class="fa fa-book" ></i><h6>Subject</h6></div>  </a>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col text-center">
            <a href="#" class="text-decoration-none" > <div class="icon-holder " > <i class="fa fa-users" ></i><h6>Professors</h6></div>  </a>
          </div>
          <div class="col text-center">
            <a href="#setting" class="text-decoration-none" > <div class="icon-holder" > <i class="fa fa-cog" ></i><h6>setting</h6></div>  </a>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col text-center">
            <a href="#" class="text-decoration-none" > <div class="icon-holder " > <i class="fa fa-user-plus" ></i><h6>Add Account</h6></div>  </a>
          </div>
          <div class="col text-center">
            <a href="#setting" class="text-decoration-none" > <div class="icon-holder" > <i class="fa fa-cog" ></i><h6>setting</h6></div>  </a>
          </div>
        </div>
      </div>
    </div>
    <div id="content"> 
        <div id="home" class="p-3">
          <nav class="navbar text-white p-2 mb-5" >
              <span>
                <i class="fa fa-bars" id="bars" ></i>
              </span>
              <div class="btn-group">
                <button type="button" class=" btn text-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="../../assets/images/user.png" height="30px"  alt="">
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><button class="dropdown-item" type="button">Action</button></li>
                  <li><button class="dropdown-item" type="button">Another action</button></li>
                  <li><button class="dropdown-item" type="button">Something else here</button></li>
                </ul>
              </div>
          </nav>
          <div class="bg-white shadow  home-content">
            <h1>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus porro excepturi veniam iure quis! Saepe eligendi necessitatibus suscipit magni ipsum quod facilis impedit, alias accusantium sit? Corrupti facilis reiciendis deserunt.</h1>
          </div>
        </div>
        <div id="setting" class="p-3">
          <nav class="navbar text-white p-2" >
              <span>
                <i class="fa fa-bars" id="bars" ></i>
              </span>
              <div class="btn-group">
                <button type="button" class=" btn text-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="../../assets/images/user.png" height="30px"  alt="">
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><button class="dropdown-item" type="button">Action</button></li>
                  <li><button class="dropdown-item" type="button">Another action</button></li>
                  <li><button class="dropdown-item" type="button">Something else here</button></li>
                </ul>
              </div>
          </nav>
          <h4 class="text-white" >Setting</h4>
        </div>
    </div>
  </section>
<script src="../../assets/js/jquery-3.6.4.js"></script>
<script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../../assets/sweetalert2/dist/sweetalert2.all.js"></script>
<script src="../../assets/js/all.js"></script>
</body>
</html>