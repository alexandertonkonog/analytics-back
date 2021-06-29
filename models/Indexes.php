<?php 
    require_once('default/functions.php');
    class Indexes {
        private $name;
        private $type;
        private $typeCat;
        private $one;
        private $expArr;
        public $items = [];
        public function __construct($data, $name, $type, $typeCat) {
            $this->name = $name;
            $this->type = $type;
            $this->typeCat = $typeCat;
            $this->one = cutLastSymbol($typeCat);
            if ($type == 2) {
                $this->expArr = explode(',', $name);
            }
            while($unit = $data->result->fetch_array(MYSQLI_ASSOC)) {
                $this->checkType($unit);
            }
            while($unit = $data->items->fetch_array(MYSQLI_ASSOC)) {
                $this->pushInItems($unit);
            }
            $bool = count($this->items) > count($this->result);
            if ($bool) {
                addToArray($this, $type, $name);
            }
        }
        private function checkType($unit) {
            if ($this->type == 2) {
                if ($this->expArr[0] == 'completePoint') {
                    $this->result[$unit["{$this->one}_id"]]['completePoint'][$unit['date']] 
                        += getSuccessPoints(json_decode($unit["coors"]));
                    $this->result[$unit["{$this->one}_id"]]['point'][$unit['date']] 
                        += count(json_decode($unit["coors"]));
                } else {
                    $this->result[$unit["{$this->one}_id"]][$this->expArr[0]][$unit['date']] 
                        += $unit[$this->expArr[0]];
                    $this->result[$unit["{$this->one}_id"]][$this->expArr[1]][$unit['date']] 
                        += $unit[$this->expArr[1]];
                }
            } else {
                $this->result[$unit["{$this->one}_id"]][$unit['date']] += $unit[$this->name];
            }
        }
        private function pushInItems($unit) {
            $obj = new stdClass();
            $obj->id = $unit["{$this->one}_id"];
            $obj->interval = 7;
            if ($this->typeCat == 'users') {
                $obj->name = $unit['user_name'];
                $obj->number = $unit['user_number'];
            } else if ($this->typeCat == 'auto') {
                $obj->name = $unit['auto_name'];
                $obj->number = $unit['auto_number'];
            } else {
                $obj->name = $unit['route_name'];
            }
            array_push($this->items, $obj);
        }
    }
?>