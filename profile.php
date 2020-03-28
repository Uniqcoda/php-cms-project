<?php session_start() ?>
<?php
include "includes/header.php";
include "includes/db.php";
?>

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
if (isset($_POST["edit_profile"])) {
  $username = $_SESSION["username"];
  $user_firstname = $_POST['user_firstname'];
  $user_lastname = $_POST['user_lastname'];
  $user_email = $_POST['user_email'];
  $user_image = $_FILES['user_image']['name'];
  $user_image_temp = $_FILES['user_image']['tmp_name'];


  move_uploaded_file($user_image_temp, "images/$user_image");


  if (empty($user_image)) {
    $n_query = "SELECT * FROM users WHERE username = '{$username}' ";

    $n_result = mysqli_query($connection, $n_query);
    if (!$n_result) {
      die("QUERY FAILED " . mysqli_error($connection));
    }
    while ($row = mysqli_fetch_assoc($n_result)) {
      $user_image = $row['user_image'];
    }
  }

  $update_query = "UPDATE users SET ";
  $update_query .= "user_firstname = '{$user_firstname}', ";
  $update_query .= "user_lastname = '{$user_lastname}', ";
  $update_query .= "user_email = '{$user_email}', ";
  $update_query .= "user_image = '{$user_image}' ";
  $update_query .= "WHERE username = '{$username}' ";

  $update_result = mysqli_query($connection, $update_query);
  if (!$update_result) {
    die("QUERY FAILED " . mysqli_error($connection));
  } else {
    $_SESSION["firstname"] = $user_firstname;
    $_SESSION["lastname"] = $user_lastname;
  }
}

?>

<!-- Navigation -->
<?php
include "includes/navbar.php";
?>

<div class="container">

  <section>
    <div class="container">
      <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
          <div class="form-wrap">




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
                <label for="user_image">User Image</label><br>
                <img width="100" src="images/<?php echo $user_image ?>" alt="">
                <input type="file" name="user_image">
              </div>

              <div class="form-group">
                <input class="btn btn-primary" type="submit" name="edit_profile" value="Update">
              </div>


            </form>
















          </div>
        </div> <!-- /.col-xs-12 -->
      </div> <!-- /.row -->
    </div> <!-- /.container -->
  </section>

  <hr>



  <?php include "includes/footer.php"; ?>