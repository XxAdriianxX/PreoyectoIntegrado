<?php
class Event
{
    private $name;
    private $date;
    private $location;
    private $description;
    private $active;
    private $DNI;
    private $points;

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