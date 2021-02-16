<?php


interface BDContext
{
 public function getallData(mysqli $mysqli);
 public function saveData(mysqli $mysqli);
 public function DeleteData(mysqli $mysqli);
}