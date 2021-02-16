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
    $result=$mysqli->query("SELECT * FROM nodes");
 foreach ($result->fetch_assoc() as $res){

 }


 }

function allchildren($id){

}

function createroot(){
    global $mysqli;
    $node=new Node();
    $node->set('root',0);
    $node->saveData($mysqli);?>
    <h2><?echo $node->text;?></h2>
    <button id="add" value="<?$node->getParentId()?>" class="add">+</button>
    <button id="remove" class="btn btn-danger">-</button>
 <?
}

function addform(){
   ?>


<?php
}

function add(){

    $text='sample';

    $parrent=$_GET['parent_id'];
$node=new Node();
$node->set($text,$parrent);
global $mysqli;
$node->saveData($mysqli);
?>

<?php
}