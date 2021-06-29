<?php
    class Route {
        public function __construct($data) {
            $this->id = $data['route_id'];
            $this->points = json_decode($data['coors']);
        }
    } 
?>