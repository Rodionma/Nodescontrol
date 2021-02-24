<?php


interface BDContext
{
 public function GetAllData();
 public function SaveData(mysqli $mysqli);
 public function DeleteData(mysqli $mysqli);
}