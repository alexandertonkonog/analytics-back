<?php 
    require_once('default/functions.php');
    function getIndexes ($typeCat, $interval = 7) {
        $link = new mysqli("localhost", "root", "root", "analytics");
        if ($link->connect_errno){
            return sendError();
        }
        else {
            $one = cutLastSymbol($typeCat);
            $link->set_charset("utf8");
            $result = new stdClass();
            $str = 'JOIN routes ON stat.route_id = routes.route_id';
            $sql = "SELECT * FROM $typeCat";
            $sql2 = "SELECT * FROM stat
            $str
            WHERE DATE(`date`) > ((SELECT MAX(`date`) from stat) - INTERVAL $interval DAY)
            ORDER BY `date`";
            $result->items = $link->query($sql);
            $result->result = $link->query($sql2);
            $link->close();
            return $result;
        }
    }


?>