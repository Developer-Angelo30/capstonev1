<?php
date_default_timezone_set('Asia/Manila');

class DB{

    private $DBserver = "localhost";
    private $DBusername = "root";
    private $DBpassword = "";
    private $DBname = "capstone";

    protected function DBconnection(){
        $con = mysqli_connect($this->DBserver, $this->DBusername, $this->DBpassword , $this->DBname);
        if(!$con){
            die("Connection failed".mysqli_connect_error($con));
        }
        else{
            return $con;
        }
    }

    protected function DBclose(){
        return mysqli_close($this->DBconnection());
    }

}

?>