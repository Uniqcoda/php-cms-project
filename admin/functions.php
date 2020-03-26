<?php

function confirmQuery($result)
{
  global $connection;
  if (!$result) {
    die("QUERY FAILED " . mysqli_error($connection));
  }
}

function addCategory()
{
  if (isset($_POST["submit"])) {
    global $connection;
    $cat_title = $_POST["cat_title"];
    if ($cat_title == "" || empty($cat_title)) {
      echo "<small>Please fill this field</small>";
    } else {
      $query = "INSERT INTO categories(cat_title) VALUE('{$cat_title}') ";
      $result = mysqli_query($connection, $query);
      if (!$result) {
        die("QUERY FAILED " . mysqli_error($connection));
      }
    }
  }
}

function getAllCategories()
{
  global $connection;
  $query = "SELECT * FROM categories";
  $result = mysqli_query($connection, $query);
  while ($row = mysqli_fetch_assoc($result)) {
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];
    echo "<tr>";
    echo "<td>$cat_id</td>";
    echo "<td>$cat_title</td>";
    echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
    echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
    "</tr>";
  }
}

function deleteCategory()
{
  if (isset($_GET["delete"])) {
    global $connection;
    $cat_id = $_GET["delete"];
    $query = "DELETE FROM categories WHERE cat_id = {$cat_id} ";
    $result = mysqli_query($connection, $query);
    header("Location: categories.php");
  }
}
