<?php 
    require_once('default/functions.php');
    function getCountAuto () {
        $link = new mysqli("localhost", "root", "root", "analytics");
        if ($link->connect_errno){
            return sendError();
        }
        else {
            $link->set_charset("utf8");
            $sql = "SELECT COUNT(*) FROM auto";
            $result = $link->query($sql);
            $link->close();
            print_r($result);
            return $result;
        }
    }


?>