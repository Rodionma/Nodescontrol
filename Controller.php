<?php

require "template.php";

spl_autoload_register(function ($class_name) {
    include 'Classes/'.$class_name . '.php';
});
/*
 *
 * database
 *
 *
 */
$mysqli = new mysqli('localhost', 'root', 'root','nodes');
if (!$mysqli) {
    die('Connection error: ' . mysqli_error());
}
$nodes=array();

/*
 *
 * routing
 *
 *
 */
if(isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'create':
            createroot();
            break;
        case 'add':
            add();
            break;
        case 'delete':
            delete();
            break;
    }
}




function getall(){
    global $nodes;
    global $mysqli;
    $result=$mysqli->query("SELECT * FROM nodes ORDER BY parent_id ASC");
    if ($result->rowCount()===0){
        echo '<button id="root" class="btn btn-primary">Create Root</button>';
    }
    else{
 while ($new=$result->fetch_assoc()) {
     $current_node = new Node();
     $current_node->setwithid($new['text'], $new['parent_id'], $new['id']);
     $nodes[] = $current_node;
 }
 }

foreach ($nodes as $el){
    if($el->getParentId()==0){
    $el->getallData();


    allchildren($el->getId());
    unset($el);
    }
}

 }

function allchildren($parrentid){
    global $nodes;
   foreach ($nodes as $res)

   if($parrentid==$res->getParentId()) {
       echo '<div style="margin-left: 40px; position:relative" >';
       $res->getallData();

       allchildren($res->getID());
       echo '</div>';
       unset($res);
   }

}

function createroot(){
    global $mysqli;
    $node=new Node();
    $node->set('root',0);

    $node->saveData($mysqli);
    getall();
}




function add(){

    $text='sample';

    $parrent=$_GET['parent_id'];
    global $mysqli;
$node=new Node();
$node->set($text,$parrent);
$node->saveData($mysqli);
getall();
}

function delete(){
    global $nodes;
    $id=$_GET['id'];


}