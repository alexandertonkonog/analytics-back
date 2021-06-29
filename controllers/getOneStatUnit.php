<?php 
    require_once('default/functions.php');
    function getOneStatUnit ($name, $interval) {
        $link = new mysqli("localhost", "root", "root", "analytics");
        if ($link->connect_errno){
            return sendError();
        }
        else {
            $link->set_charset("utf8");
            $result;
            if ($name == 'completePoint,point') {
                $sql = "SELECT `date`, routes.route_id, routes.coors FROM stat
                JOIN routes ON stat.route_id = routes.route_id 
                WHERE DATE(`date`) > ((SELECT MAX(`date`) FROM stat) - INTERVAL $interval DAY)
                ORDER BY `date`";
                $result = $link->query($sql);                
            } else if ($name == 'activeAuto,auto') {
                $sql = "SELECT `date` FROM stat
                JOIN `auto` ON stat.auto_id = auto.auto_id
                WHERE DATE(`date`) > ((SELECT MAX(`date`) FROM stat) - INTERVAL $interval DAY)
                ORDER BY `date`";
                $result = $link->query($sql);
            } else { 
                $sql = "SELECT `date`, $name FROM stat
                WHERE DATE(`date`) > ((SELECT MAX(`date`) FROM stat) - INTERVAL $interval DAY)
                ORDER BY `date`";
                $result = $link->query($sql);
            }
            $link->close();
            return $result;
        }
    }


?>