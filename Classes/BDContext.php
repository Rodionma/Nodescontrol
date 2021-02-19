<?php


interface BDContext
{
 public function getallData();
 public function saveData(mysqli $mysqli);
 public function DeleteData(mysqli $mysqli);
}