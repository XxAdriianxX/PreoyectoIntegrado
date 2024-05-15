<?php
class Event
{
    public $name;
    public $date;
    public $location;
    public $description;
    public $active;
    public $DNI;
    public $points;

    public function __construct($name, $date, $location, $description, $active, $DNI, $points)
    {
        $this->name = $name;
        $this->date = $date;
        $this->location = $location;
        $this->description = $description;
        $this->active = $active;
        $this->DNI = $DNI;
        $this->points = $points;
    }
}