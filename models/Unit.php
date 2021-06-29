<?php 
    include_once('User.php');
    include_once('Auto.php');
    include_once('Route.php');
    class Unit {
        public function __construct($data) {
            $this->id = $data['id'];
            $this->date = date("d.m.y", strtotime($data['date']));
            $this->dateTime = $data['date'];
            $this->user = new User($data);
            $this->auto = new Auto($data);
            $this->route = new Route($data);
            $this->fail = $data['fail'];
            $this->trash = $data['trash'];
            $this->oil = $data['oil'];
            $this->km = $data['km'];
            $this->coor = $data['coor'];
            $this->speed = $data['speed'];
            $this->crush = $data['crush'];
            $this->btw = $data['btw'];
            $this->ltw = $data['ltw'];
            $this->time = $data['time'];
            $this->flight = json_decode($data['flight']);
            $this->begin = $data['begin'];
            $this->end = $data['end'];
            $this->trashType = $data['trashType'];
            $this->report = $data['report'];
        }
    }
?>