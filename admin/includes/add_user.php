<?php
include "../functions.php";

if (isset($_POST["add_user"])) {
  $username = $_POST['username'];
  $user_password = $_POST['user_password'];
  $user_firstname = $_POST['user_firstname'];
  $user_lastname = $_POST['user_lastname'];
  $user_email = $_POST['user_email'];
  $user_image = $_FILES['image']['name'];
  $user_image_temp = $_FILES['image']['tmp_name'];
  $user_role = $_POST['user_role'];

  move_uploaded_file($user_image_temp, "../images/$user_image");
  $query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_image, user_role) ";
  $query .= "VALUES('{$username}','{$user_password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_image}', '{$user_role}') ";

  $result = mysqli_query($connection, $query);
  confirmQuery($result);
}

?>
<h3>Add User</h3>
<form action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="user_firstname">First Name</label>
    <input type="text" class="form-control" name="user_firstname">
  </div>

  <div class="form-group">
    <label for="user_lastname">Last Name</label>
    <input type="text" class="form-control" name="user_lastname">
  </div>

  <div class="form-group">
    <label for="user_email">Email</label>
    <input type="text" class="form-control" name="user_email">
  </div>

  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username">
  </div>

  <div class="form-group">
    <label for="user_password">Password</label>
    <input type="password" class="form-control" name="user_password">
  </div>

  <div class="form-group">
    <label for="user_image">User Image</label>
    <input type="file" name="user_image">
  </div>

  <div class="form-group">
    <label for="user_role">User Role</label>
    <select name="user_role" id="">
      <option value='subscriber'>Select Option</option>
      <option value='admin'>Admin</option>
      <option value='subscriber'>Subscriber</option>
    </select>
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="add_user" value="Add User">
  </div>


</form>