<?php 
    require_once('default/functions.php');
    class OneStatUnit {
        public function __construct($data, $name, $type) {
            if($type == '2') {
                $arr = explode(',', $name);
                if($arr[0] == 'completePoint') {
                    while($value = $data->fetch_array()) {
                        $this->completePoint[$value["date"]] += getSuccessPoints(json_decode($value["coors"]));
                        $this->point[$value["date"]] += count(json_decode($value["coors"]));
                    }
                } else if ($arr[0] == 'activeAuto') {
                    while($value = $data->fetch_array()) {
                        $this->activeAuto[$value["date"]]++;
                        $this->auto[$value["date"]] = 3;
                    }
                } else {
                    while($value = $data->fetch_array()) {
                        foreach($arr as $arrItem) {
                            $this->$arrItem[$value["date"]] += $value[$arrItem];
                            $this->$arrItem[$value["date"]] += $value[$arrItem];
                        }
                    }
                }    
            } else {    
                while($value = $data->fetch_array()) {
                    $this->$name[$value["date"]] += $value[$name];
                }
            }      
        }
    }
?>