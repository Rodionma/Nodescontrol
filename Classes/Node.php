<?php


class Node implements  BDContext
{
public $text;
public $id;
public $parent_id;




    public function set($text,$parent_id){
        $this->parent_id=$parent_id;
        $this->text=$text;
    }

    public function getallData(mysqli $mysqli){
       $result= $mysqli->fetch_assoc();
        $this->parent_id=$result('parent_id');
        $this->text=$result('text');
        $this->id=$result('id');
    }
    public function saveData(mysqli $mysqli){

    $query="INSERT INTO nodes (text,parent_id) VALUES ('$this->text','$this->parent_id')";
     if($mysqli->query($query)===true){
         echo "success";

     }
     else
     {
         echo "Error".$mysqli->error;
     }
    }
    public function DeleteData(mysqli $mysqli){

    }
    public function getText()
    {
        return $this->text;
    }
    public function getParentId()
    {
        return $this->parent_id;
    }
}