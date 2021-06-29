<?php 

    function sendError() {
        $obj = new stdClass();
        $obj->error = true;
        return $obj;
    }
    function getSuccessPoints($arr) {
        $count = 0;
        foreach($arr as $arrItem) {
            if($arrItem->success == true) {
                $count++;
            }
        }
        return $count;
    }
    function cutLastSymbol($str) {
        $needStr;
        if ($str[strlen($str)-1] == 's') {
            return substr($str,0,-1);
        } else {
            return $str;
        }
    }
    function cutArrays($arr) {
        $need = new stdClass();
        foreach($arr as $key => $arrItem) {
            $need->$key->keys = array_keys($arrItem);
            $need->$key->values = array_values($arrItem);
        }
        return $need;
    }
    function addToArray($obj, $type, $name) {
        foreach($obj->items as $val) {
            $bool = isset($obj->result[$val->id]);
            if (!$bool) {
                if ($type == 2) {
                    $expArr = explode(',', $name);
                    if ($expArr[0] == 'completePoint') {
                        $obj->result[$val->id]['completePoint']['0000-00-00'] = 0;
                        $obj->result[$val->id]['point']['0000-00-00'] = 0;
                    } else {
                        $obj->result[$val->id][$expArr[0]]['0000-00-00'] = 0;
                        $obj->result[$val->id][$expArr[1]]['0000-00-00'] = 0;
                    }                 
                } else {
                    $obj->result[$val->id]['0000-00-00'] = 0;
                }
            }
        } 
    }
    function debug($obj) {
        echo '<pre>';
        print_r($obj);
        echo '</pre>';
    }
?>