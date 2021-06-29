<?php 
    require_once('default/functions.php');
    class OneIndex {
        //можно рефакторить с классом Indexes
        public $result = [];
        public function __construct($data, $name, $type, $typeCat) {
            $arr = $data->fetch_all(MYSQLI_ASSOC);
            if (!empty($arr)) {
                if ($type == 2) {
                    $expArr = explode(',', $name);
                    if ($expArr[0] == 'completePoint') {
                        foreach($arr as $unit) {
                            //debug($unit);
                            $this->result['completePoint'][$unit['date']] 
                                += getSuccessPoints(json_decode($unit["coors"]));
                            $this->result['point'][$unit['date']] 
                                += count(json_decode($unit["coors"]));
                        }                        
                    } else {
                        foreach($arr as $unit) {
                            $this->result[$expArr[0]][$unit['date']] += $unit[$expArr[0]];
                            $this->result[$expArr[1]][$unit['date']] += $unit[$expArr[1]];
                        }
                    }
                } else {
                    foreach($arr as $unit) {
                        $this->result[$unit['date']] += $unit[$name];
                    }
                } 
            } else {
                if($type == 2) {
                    $expArr = explode(',', $name);
                    $this->result[$expArr[0]]['0000-00-00'] = 0;
                    $this->result[$expArr[1]]['0000-00-00'] = 0;
                } else {
                    $this->result['0000-00-00'] = 0;
                }
            }
            
        }
    }

?>