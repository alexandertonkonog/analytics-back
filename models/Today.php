<?php
    require_once('default/functions.php');
    class Today {
        public function __construct($data) {
            $maxDate = $this->selectMaxDate($data);
            $this->auto = 3; ///////////////////////////////////////////
            foreach($data as $value) {
                if($maxDate == $value->dateTime) {
                    $this->fail += $value->fail;
                    $this->trash += $value->trash;
                    $this->oil += $value->oil;
                    $this->km += $value->km;
                    $this->point += count($value->route->points);
                    $this->completePoint += getSuccessPoints($value->route->points);
                    $this->speed += $value->speed;
                    $this->crush += $value->crush;
                    $this->btw += $value->btw;
                    $this->ltw += $value->ltw;
                    $this->time += $value->time;
                    $this->activeAuto++;
                    $this->report += $value->report;
                }
            }
            $this->selectMaxDate($data);
        }
        protected function selectMaxDate($data) {
            $date;
            foreach($data as $value) {
                if (empty($date)) {
                    $date = strtotime($value->dateTime);
                } else {
                    if (strtotime($value->dateTime) > $date) {
                        $date = strtotime($value->dateTime);
                    }
                }
            }
            return date("Y-m-d", $date);
        }
    } 
?>