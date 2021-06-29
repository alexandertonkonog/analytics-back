<?php 
    require_once('default/functions.php');
    class Stat {
        public function __construct() {
            $this->arr = [
                'fail' => [],
                'trash' => [],
                'oil' => [],
                'km' => [],
                'point' => [],
                'completePoint' => [],
                'speed' => [],
                'crush' => [],
                'btw' => [],
                'ltw' => [],
                'time' => [],
                'activeAuto' => [],
                'auto' => [],
                'report' => []
            ];   
        }
        public function incrementObj($data) {
            $date = date("d.m.y", strtotime($data['date']));
            foreach($this->arr as $key => $value) {
                if ($key == 'activeAuto') {
                    $this->arr[$key][$date]++;
                } else if ($key == 'point') {
                    $this->arr[$key][$date] += count(json_decode($data["coors"]));
                } else if ($key == 'auto') {
                    $this->arr[$key][$date] = 3; 
                    //придумать функцию, считающую все автомобили
                } else if ($key == 'completePoint') {
                    $this->arr[$key][$date] 
                        += getSuccessPoints(json_decode($data["coors"]));
                } else {
                    $this->arr[$key][$date] += $data[$key];
                }
            } 
        }
    }
 
?>