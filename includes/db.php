<?php
$connection =  mysqli_connect('localhost', 'root', 'root', 'cms');

if ($connection) {
  // echo "We are connected";
} else {
  echo "Database connection error";
}
