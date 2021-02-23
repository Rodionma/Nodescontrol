<?php


class Node implements  BDContext//Main class for working with every node
{
public $text;
public $id;
public $parent_id;




    public function set($text,$parent_id){
        $this->parent_id=$parent_id;
        $this->text=$text;
    }//setting data without id
    public function setwithid($text,$parent_id,$id){
        $this->parent_id=$parent_id;
        $this->text=$text;
        $this->id=$id;
    }//setting data with id

    public function getallData(){ ?>
<div class="node">
       <h2><?echo $this->text;?></h2>
<button id="add" value="<?echo $this->getId()?>" class="btn btn-success add">+</button>
<button id="remove" value="<?echo $this->getId()?>" class="btn btn-danger remove">-</button>

</div>
        <?php
    }//output all data about one node

    public function saveData(mysqli $mysqli){

    $query="INSERT INTO nodes (text,parent_id) VALUES ('$this->text','$this->parent_id')";
     if($mysqli->query($query)!=true){

         echo "Error".$mysqli->error;
     }//adding node to db



    }
    public function DeleteData(mysqli $mysqli){
        $query="DELETE FROM nodes WHERE id='$this->id'";
        if($mysqli->query($query)!=true){
            echo "Error".$mysqli->error;
    }

    }
    public function getText()
    {
        return $this->text;
    }
    public function getParentId()
    {
        return $this->parent_id;
    }


    public function getId()
    {
        return $this->id;
    }
}