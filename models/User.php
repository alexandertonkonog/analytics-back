<?php
    class User {
        public function __construct($data) {
            $this->id = $data['user_id'];
            $this->name = $data['user_name'];
            $this->number = $data['user_number'];
            $this->img = $data['user_img'];
        }
    } 
?>