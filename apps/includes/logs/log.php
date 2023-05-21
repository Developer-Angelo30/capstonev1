<?php
date_default_timezone_set('Asia/Manila');
    class Log{

        public function saveLog($path , string $action){

            $os = $_SERVER['HTTP_SEC_CH_UA_PLATFORM'];
            $ip = $_SERVER['REMOTE_ADDR'];
            $date = date("Y-m-d h:i:s A");
            $msg = "[{$date}] - IP:{$ip}, OS:{$os}, MESSAGE:{$action}\n";
            file_put_contents( $path , $msg , FILE_APPEND );

        }

    }
?>