<?php
$connection =  mysqli_connect('localhost', 'root', 'root', 'cms');

if (!$connection) {
  echo "Database connection error";
}
