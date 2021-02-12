<?php
spl_autoload_register(function ($class_name) {
    include 'Classes/'.$class_name . '.php';
});
/*
 *
 * database
 *
 *
 */
$link = mysqli_connect('Nodes', 'root', 'root');
if (!$link) {
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
        case 'delete':
            break;
    }
}

function createroot(){
    $node=new Node("root");
    $node->saveData();?>
    <h2><?echo $node->text;?></h2>
    <button id="add">+</button>
    <button id="remove">-</button>
 <?
}

function add(){
    $node=new Node("root");
    $node->saveData();?>

    <?
}