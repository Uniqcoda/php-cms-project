<?php
include "../functions.php";
?>


<?php
// get user's data
if (isset($_GET["user_id"])) {
  $user_id = $_GET["user_id"];

  $query = "SELECT * FROM users WHERE user_id = {$user_id} ";

  $result = mysqli_query($connection, $query);
  confirmQuery($result);
  while ($row = mysqli_fetch_assoc($result)) {
    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_password = $row['user_password'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];
  }
}
?>

<?php
// update query
if (isset($_POST["edit_user"])) {

  $user_id = $_GET["user_id"];
  $user_firstname = $_POST['user_firstname'];
  $user_lastname = $_POST['user_lastname'];
  $user_email = $_POST['user_email'];
  $user_image = $_FILES['user_image']['name'];
  $user_image_temp = $_FILES['user_image']['tmp_name'];
  $user_role = $_POST['user_role'];

  move_uploaded_file($user_image_temp, "../images/$user_image");

  if (empty($user_image)) {
    $query = "SELECT * FROM users WHERE user_id = {$user_id} ";

    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    while ($row = mysqli_fetch_assoc($result)) {
      $user_image = $row['user_image'];
    }
  }

  $update_query = "UPDATE users SET ";
  $update_query .= "user_firstname = '{$user_firstname}', ";
  $update_query .= "user_lastname = '{$user_lastname}', ";
  $update_query .= "user_email = '{$user_email}', ";
  $update_query .= "user_image = '{$user_image}', ";
  $update_query .= "user_role = '{$user_role}' ";
  $update_query .= "WHERE user_id = {$user_id} ";

  $update_result = mysqli_query($connection, $update_query);
  confirmQuery($update_result);
  header("Location: users.php");
}

?>

<h3>Edit User</h3>
<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="user_firstname">First Name</label>
    <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname ?>">
  </div>

  <div class="form-group">
    <label for="user_lastname">Last Name</label>
    <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname ?>">
  </div>

  <div class="form-group">
    <label for="user_email">Email</label>
    <input type="email" class="form-control" name="user_email" value="<?php echo $user_email ?>">
  </div>

  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username" value="<?php echo $username ?>">
  </div>

  <div class="form-group">
    <label for="user_image">User Image</label><br>
    <img width="100" src="../images/<?php echo $user_image ?>" alt="">
    <input type="file" name="user_image">
  </div>

  <div class="form-group">
    <label for="user_role">User Role</label>
    <select name="user_role" id="">
      <option value="<?php echo $user_role ?>"><?php echo ucfirst($user_role) ?></option>
      <?php
      if ($user_role == "admin") {
        echo "<option value='subscriber'>Subscriber</option>";
      } else {
        echo "<option value='admin'>Admin</option>";
      } ?>
    </select>
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
  </div>


</form>