<?php

    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

    error_reporting(0);

    require_once('default/functions.php');
    require_once('models/Unit.php');
    require_once('models/Stat.php');
    require_once('models/Today.php');
    require_once('models/OneStatUnit.php');
    require_once('models/Indexes.php');
    require_once('models/OneIndex.php');
    require_once('controllers/getUnits.php');
    require_once('controllers/getOneStatUnit.php');
    require_once('controllers/getOneIndex.php');
    require_once('controllers/getIndexes.php');
    require_once('controllers/getCountAuto.php');
    require_once('controllers/getEvents.php');
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['method'] == 'getUnits') {
        $result = getUnits();
        if ($result->error) {
            echo json_encode($result);
        } else {
            $object = new stdClass();
            $object->data = [];
            
            $object->stat = new Stat();
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $obj = new Unit($row);
                $object->stat->incrementObj($row);
                array_push($object->data, $obj);
            }
            $object->stat = cutArrays($object->stat->arr);
            $object->today = new Today($object->data);
            echo json_encode($object);
        }
        
    } else if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['method'] == 'getUnit') {
        $result = getOneStatUnit($_GET['name'], $_GET['interval']);
        $obj = new OneStatUnit($result, $_GET['name'], $_GET['type']);
        echo json_encode(cutArrays($obj));
    } else if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['method'] == 'getIndexes') {
        $result = getIndexes($_GET['typeCat'], 7);
        $obj = new Indexes($result, $_GET['name'], $_GET['type'], $_GET['typeCat']);
        
        if($_GET['type'] == 2) {
            foreach($obj->result as $key => $value) {
                $obj->result[$key] = cutArrays($value);
            }
        } else {
            $obj->result = cutArrays($obj->result);
        }
        echo json_encode($obj);
    } else if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['method'] == 'getIndex') {
        $result = getOneIndex($_GET['interval'], $_GET['typeCat'], $_GET['id']);
        $obj = new OneIndex($result, $_GET['name'], $_GET['type'], $_GET['typeCat']);
        
        if($_GET['type'] == 2) {
            $obj->result = cutArrays($obj->result);
        } else {
            $obj = cutArrays($obj);
        }
        
        echo json_encode($obj);
    } else if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['method'] == 'getEvents') {
        $result = getEvents($_GET['page']);
        $arr = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($arr);
    }

?>