<?php 
    require_once('default/functions.php');
    function getOneIndex ($interval, $typeCat, $id) {
        $link = new mysqli("localhost", "root", "root", "analytics");
        if ($link->connect_errno){
            return sendError();
        }
        else {
            $link->set_charset("utf8");
            $one = cutLastSymbol($typeCat);
            $str = 'JOIN routes ON stat.route_id = routes.route_id';
            $sql = "SELECT * FROM stat
            $str
            WHERE DATE(`date`) > ((SELECT MAX(`date`) from stat) - INTERVAL $interval DAY)
            AND stat.{$one}_id = $id
            ORDER BY `date`";
            $result = $link->query($sql);
            $link->close();
            return $result;
        }
    }


?>