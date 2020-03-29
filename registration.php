<?php session_start() ?>
<?php
include "includes/header.php";
include "includes/db.php";
include "admin/functions.php";


if (isset($_SESSION["username"]) && isset($_SESSION["user_role"])) {
  header("Location: index.php");
}
?>


<?php
if (isset($_POST["submit"])) {
  $user_firstname = $_POST['firstname'];
  $user_lastname = $_POST['lastname'];
  $username = $_POST['username'];
  // TODO add image upload to form
  $user_image = "profile.png";
  $email = $_POST['email'];
  $password = $_POST['password'];

  if (empty($user_firstname) || empty($user_lastname) || empty($username) || empty($password) || empty($email)) {
    $error_message = "All fields are required";
  } else if ($password !== $_POST["password2"]) {
    $error_message =  "Passwords do not match";
  } else {
    $user_firstname = mysqli_real_escape_string($connection, $user_firstname);
    $user_lastname = mysqli_real_escape_string($connection, $user_lastname);
    $user_image = mysqli_real_escape_string($connection, $user_image);
    $username = mysqli_real_escape_string($connection, $username);
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $user_role = 'subscriber';

    $query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_image, user_role) ";
    $query .= "VALUES('{$username}','{$hashed_password}','{$user_firstname}','{$user_lastname}','{$email}','{$user_image}','{$user_role}') ";

    $result = mysqli_query($connection, $query);
    if (!$result) {
      die("QUERY FAILED " . mysqli_error($connection));
    } else {
      $_SESSION["username"] = $username;
      $_SESSION["firstname"] = $user_firstname;
      $_SESSION["lastname"] = $user_lastname;
      $_SESSION["user_role"] = $user_role;

      header("Location: ./index.php");
    }
  }
} else {
  $error_message = "";
}

?>

<!-- Navigation -->
<?php
include "includes/navbar.php";
?>


<!-- Page Content -->
<div class="container">

  <section>
    <div class="container">
      <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
          <div class="form-wrap">
            <h1>Register</h1>
            <small>All fields are required</small>
            <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
              <div class="form-group">
                <label for="firstname" class="sr-only">Firstname</label>
                <input type="text" name="firstname" class="form-control" placeholder="Enter Firstname">
              </div>
              <div class="form-group">
                <label for="lastname" class="sr-only">Lastname</label>
                <input type="text" name="lastname" class="form-control" placeholder="Enter Lastname">
              </div>
              <div class="form-group">
                <label for="username" class="sr-only">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username">
              </div>
              <div class="form-group">
                <label for="email" class="sr-only">Email</label>
                <input type="email" name="email" class="form-control" placeholder="somebody@example.com">
              </div>
              <div class="form-group">
                <label for="password" class="sr-only">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
              </div>
              <div class="form-group">
                <label for="password2" class="sr-only">Retype Password</label>
                <input type="password" name="password2" class="form-control" placeholder="Password">
              </div>

              <small><?php echo $error_message ?></small>

              <input type="submit" name="submit" class="btn btn-primary btn-lg btn-block" value="Register">
            </form>

          </div>
        </div> <!-- /.col-xs-12 -->
      </div> <!-- /.row -->
    </div> <!-- /.container -->
  </section>


  <hr>



  <?php include "includes/footer.php"; ?>