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
    <link rel="stylesheet" href="../../assets/css/style-dashboard.css">
    <title>Document</title>
</head>
<body>
    <section class="container-fluid" id="dean-dashboard" ><br>
      <nav class="p-2 navbar  bg-white shadow rounded-3 ">
        <a class="btn" data-bs-toggle="offcanvas" href="#dean-sidebar" role="button" aria-controls="dean-sidebar"> <i class="fa fa-bars"></i> </a>
        <div class="btn-group">
          <a type="button" class="" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../../assets/images/user.png" height="30px" width="30px" alt="">
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><button class="dropdown-item text-muted" type="button"> <i class="fa fa-user" ></i> <span>Lorem Lorem</span> </button></li>
            <li><button class="dropdown-item text-muted" type="button"> <i class="fa fa-cog" ></i> <span>Setting</span> </button></li>
            <li><a class="dropdown-item text-muted" href="../logout.php" type="button"> <i class="fa fa-sign-out" ></i> <span>Logout</span> </a></li>
          </ul>
        </div>
      </nav>
      <div class="row mt-3">
        <div class="col-sm-4 mt-2 mb-2">
            <div class="p-2 shadow bg-light total">
              <h1 class="text-center">0</h1>
              <span class="fw-bold">Total</span>
            </div>
        </div>
        <div class="col-sm-4 mt-2 mb-2">
            <div class="p-2 shadow bg-light total">
              <h1 class="text-center">0</h1>
              <span class="fw-bold">Total</span>
            </div>
        </div>
        <div class="col-sm-4 mt-2 mb-2">
            <div class="p-2 shadow bg-light total">
              <h1 class="text-center">0</h1>
              <span class="fw-bold">Total</span>
            </div>
        </div>
      </div>
    </section>
    <!-- sidebar -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="dean-sidebar" aria-labelledby="dean-sidebarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="dean-sidebarLabel">Offcanvas</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <div>
          Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
        </div>
        <div class="dropdown mt-3">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
            Dropdown button
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </div>
      </div>
    </div>
<script src="../../assets/js/jquery-3.6.4.js"></script>
<script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../../assets/sweetalert2/dist/sweetalert2.all.js"></script>
<script src="../../assets/js/all.js"></script>
</body>
</html>