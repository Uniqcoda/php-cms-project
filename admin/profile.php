<?php
include "includes/admin_header.php";
include "includes/db.php";
?>
<?php session_start() ?>


<?php
// get user's data
if (isset($_SESSION["username"])) {
  $username = $_SESSION["username"];

  $username = mysqli_real_escape_string($connection, $username);
  $query = "SELECT * FROM users WHERE username = '{$username}' ";
  $result = mysqli_query($connection, $query);
  if (!$result) {
    die("QUERY FAILED " . mysqli_error($connection));
  }
  while ($row = mysqli_fetch_assoc($result)) {
    $user_id = $row["user_id"];
    $username = $row["username"];
    $user_email = $row["user_email"];
    $user_password = $row["user_password"];
    $user_firstname = $row["user_firstname"];
    $user_lastname = $row["user_lastname"];
    $user_image = $row['user_image'];
    $user_role = $row["user_role"];
  }
}
?>

<?php
// update query
if (isset($_POST["edit_user"])) {

  $user_password = $_POST['user_password'];
  $user_firstname = $_POST['user_firstname'];
  $user_lastname = $_POST['user_lastname'];
  $user_email = $_POST['user_email'];
  $user_image = $_FILES['user_image']['name'];
  $user_image_temp = $_FILES['user_image']['tmp_name'];
  $user_role = $_POST['user_role'];

  move_uploaded_file($user_image_temp, "../images/$user_image");

  if (empty($user_image)) {
    $n_query = "SELECT * FROM users WHERE username = '{$username}' ";

    $n_result = mysqli_query($connection, $n_query);
    confirmQuery($n_result);
    while ($row = mysqli_fetch_assoc($n_result)) {
      $user_image = $row['user_image'];
    }
  }

  $update_query = "UPDATE users SET ";
  $update_query .= "user_password = '{$user_password}', ";
  $update_query .= "user_firstname = '{$user_firstname}', ";
  $update_query .= "user_lastname = '{$user_lastname}', ";
  $update_query .= "user_email = '{$user_email}', ";
  $update_query .= "user_image = '{$user_image}', ";
  $update_query .= "user_role = '{$user_role}' ";
  $update_query .= "WHERE username = '{$username}' ";

  $update_result = mysqli_query($connection, $update_query);
  confirmQuery($update_result);
}

?>


<div id="wrapper">
  <!-- Navigation -->
  <?php
  include "includes/admin_navbar.php";
  ?>
  <div id="page-wrapper">
    <div class="container-fluid">
      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">
            Welcome
            <small><?php echo ucfirst($_SESSION['firstname']) ?></small>
          </h1>
          <h3>Edit Profile</h3>
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
              <label for="user_password">Password</label>
              <input type="password" class="form-control" name="user_password" value="<?php echo $user_password ?>">
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
              <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile">
            </div>


          </form>
        </div>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php
include "includes/admin_footer.php";
?>