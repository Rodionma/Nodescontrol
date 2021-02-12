<?php


class Node implements  BDContext
{
public $text;
public $id;
public $parent_id;

    function __construct($text){
        $this->text=$text;

    }
    public function getallData(){

    }
    public function saveData(){

    }
    public function DeleteData(){

    }
}