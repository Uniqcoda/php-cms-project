<?php session_start() ?>
<?php
include "includes/header.php";
include "includes/db.php";

if (isset($_SESSION["username"]) && isset($_SESSION["user_role"])) {
  header("Location: index.php");
}
?>

<?php
if (isset($_POST["submit"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];
  if (empty($username) || empty($password)) {
    $error_message = "All fields are required";
  } else {

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $result = mysqli_query($connection, $query);
    if (!$result) {
      die("QUERY FAILED " . mysqli_error($connection));
    }
    while ($row = mysqli_fetch_assoc($result)) {
      $db_user_id = $row["user_id"];
      $db_username = $row["username"];
      $db_hashed_password = $row["user_password"];
      $db_user_firstname = $row["user_firstname"];
      $db_user_lastname = $row["user_lastname"];
      $db_user_email = $row["user_email"];
      $db_user_role = $row["user_role"];


      if (!password_verify($password, $db_hashed_password)) {
        $error_message = "User details do not match";
      } else {
        $_SESSION["username"] = $db_username;
        $_SESSION["firstname"] = $db_user_firstname;
        $_SESSION["lastname"] = $db_user_lastname;
        $_SESSION["email"] = $db_user_email;
        $_SESSION["user_role"] = $db_user_role;

        header("Location: index.php");
      }
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
            <h1>Login</h1>
            <!-- <small>All fields are required</small> -->
            <form role="form" action="login.php" method="post" id="login-form" autocomplete="off">
              <div class="form-group">
                <label for="username" class="sr-only">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username">
              </div>
              <div class="form-group">
                <label for="password" class="sr-only">Password</label>
                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
              </div>
              <small><?php echo $error_message ?></small>
              <input type="submit" name="submit" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Login">
            </form>

          </div>
        </div> <!-- /.col-xs-12 -->
      </div> <!-- /.row -->
    </div> <!-- /.container -->
  </section>


  <hr>



  <?php include "includes/footer.php"; ?>