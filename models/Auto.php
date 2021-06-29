<?php
    class Auto {
        public function __construct($data) {
            $this->id = $data['auto_id'];
            $this->name = $data['auto_name'];
            $this->model = $data['auto_model'];
            $this->number = $data['auto_number'];
        }
    } 
?>