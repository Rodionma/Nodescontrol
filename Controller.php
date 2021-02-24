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
            createRoot();
            break;
        case 'add':
            add();
            break;
        case 'addform':
            Context::AddCommit($_GET['parent_id']);
            break;
        case 'deleteform':
            Context::DeleteCommit($_GET['parent_id']);
            break;
        case 'delete':
            $id=$_GET['id'];
            delete($id);
            break;
    }
}


function GetData(){//getting data from DB
    $nodes=array();
    global $mysqli;
    $result=$mysqli->query("SELECT * FROM nodes ORDER BY parent_id ASC");//query

    while ($new=$result->fetch_assoc()) {
        $current_node = new Node();
        $current_node->SetWithId($new['text'], $new['parent_id'], $new['id']);
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

function GetAll(){
    $nodes=GetData();
    if(isset($nodes)){//Output all data
        foreach ($nodes as $el){
            if($el->getParentId()==0){
                $el->getallData();

                allchildren($el->getId(),$nodes);
            }
        }}

}

function allchildren($parrentid,$nodes){//outputting data about all children

    foreach ($nodes as $res){

        if($parrentid==$res->getParentId()) {
            echo '<div style="margin-left: 50px; position:relative" >';
            $res->getallData();

            allchildren($res->getID(),$nodes);//recursive calling
            echo '</div>';
            unset($res);
        }
    }

}




function createRoot(){//creating node with name "Root"

    global $mysqli;
    $node=new Node();
    $node->Set('Root',0);

    $node->SaveData($mysqli);
    GetAll();
}


function add(){//adding new node

    $text=$_GET['text'];

    $parrent=$_GET['parent_id'];//getting data
    global $mysqli;
    $node=new Node();
    $node->Set($text,$parrent);

    $node->SaveData($mysqli);//saving data in db
    GetAll();
}

function delete($id){
    $nodes=GetData();//Getting all nodes
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
    GetAll();
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