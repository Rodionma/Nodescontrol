<?php

require_once "template.php";

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
        case 'addform':
            Context::addcommit($_GET['parent_id']);
            break;
        case 'deleteform':
            Context::deletecommit($_GET['parent_id']);
            break;
        case 'delete':
            $id=$_GET['id'];
            delete($id);
            break;
    }
}


function getdata(){//getting data from DB
    $nodes=array();
    global $mysqli;
    $result=$mysqli->query("SELECT * FROM nodes ORDER BY parent_id ASC");//query

    while ($new=$result->fetch_assoc()) {
        $current_node = new Node();
        $current_node->setwithid($new['text'], $new['parent_id'], $new['id']);
        $nodes[] = $current_node;
    }
    if (!empty($nodes)) {

        return $nodes;//returning array of all values
    }
    else
    {
        echo "<button id='root' class='root btn btn-success'>Create root</button>";
    }
}

function getall(){
    $nodes=getdata();
    if(isset($nodes)){
        foreach ($nodes as $el){
            if($el->getParentId()==0){
                $el->getallData();

                allchildren($el->getId(),$nodes);
            }
        }}

}

function allchildren($parrentid,$nodes){

    foreach ($nodes as $res){

        if($parrentid==$res->getParentId()) {
            echo '<div style="margin-left: 50px; position:relative" >';
            $res->getallData();

            allchildren($res->getID(),$nodes);
            echo '</div>';
            unset($res);
        }
    }

}




function createroot(){

    global $mysqli;
    $node=new Node();
    $node->set('Root',0);

    $node->saveData($mysqli);
    getall();
}


function add(){//adding new node

    $text=$_GET['text'];

    $parrent=$_GET['parent_id'];//getting data
    global $mysqli;
    $node=new Node();
    $node->set($text,$parrent);

    $node->saveData($mysqli);//saving data in db
    getall();
}

function delete($id){
    $nodes=getdata();
    global $mysqli;
    if(isset($nodes)){
        foreach ($nodes as $res){


            if($id==$res->getId()) {

                foreach ($nodes as $resc){
                    if($resc->getParentId()==$id){

                        deletechildren($nodes,$res->getId());
                    }//searching for all children

                }
                $res->DeleteData($mysqli);//deleting

            }
        }
        unset($nodes);}
    getall();
}

function deletechildren($nodes,$id){//deleting all children
    global $mysqli;
    foreach ($nodes as $resc){
        if($resc->getParentId()==$id){

            deletechildren($nodes,$resc->getId());//recursive call
            $resc->DeleteData($mysqli);
        }
    }
}