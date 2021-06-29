<?php 
require_once('default/functions.php');
function getEvents ($page) {
    $link = new mysqli("localhost", "root", "root", "analytics");
    if ($link->connect_errno){
        return sendError();
    }
    else {
        $link->set_charset("utf8");
        $sql = "SELECT * FROM `events` JOIN `users` ON users.user_id = events.user_id ORDER BY id DESC LIMIT 10 OFFSET $page";
        $result = $link->query($sql);
        $link->close();
        return $result;
    }
}


?>