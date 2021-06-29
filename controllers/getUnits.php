<?php 
    require_once('default/functions.php');
    function getUnits ($interval = 7) {
        $link = new mysqli("localhost", "root", "root", "analytics");
        if ($link->connect_errno){
            return sendError();
        }
        else {
            $link->set_charset("utf8");
            $sql = "SELECT * FROM stat 
            JOIN auto ON stat.auto_id = auto.auto_id 
            JOIN users ON stat.user_id = users.user_id
            JOIN routes ON stat.route_id = routes.route_id
            WHERE DATE(`date`) > ((SELECT MAX(`date`) from stat) - INTERVAL $interval DAY)
            ORDER BY `date`";
            $result = $link->query($sql);
            $link->close();
            return $result;
        }
    }


?>