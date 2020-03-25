<table class="table table-hover table-bordered">
  <thead>
    <tr>
      <th>ID</th>
      <th>Username</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Role</th>
      <!-- <th>Image</th> -->
      <th>Make Admin</th>
      <th>Make Subscriber</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php
      global $connection;
      $query = "SELECT * FROM users ";
      // $query .= "ORDER BY user_id DESC ";
      $result = mysqli_query($connection, $query);
      while ($row = mysqli_fetch_assoc($result)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];

        echo "<tr>";
        echo "<td>$user_id</td>";
        echo "<td>$username</td>";
        echo "<td>$user_firstname</td>";
        echo "<td>$user_lastname</td>";
        echo "<td>$user_email</td>";

        echo "<td>$user_role</td>";
        // echo "<td>$user_image</td>";
        echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
        echo "<td><a href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";
        echo "<td><a href='users.php?source=edit_user&user_id={$user_id}'>Edit</a></td>";
        echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
        echo "</tr>";
      } ?>
    </tr>
  </tbody>
</table>

<?php
if (isset($_GET["change_to_admin"])) {
  $user_id = $_GET["change_to_admin"];
  $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$user_id} ";
  $result = mysqli_query($connection, $query);
  confirmQuery($result);
  header("Location: users.php");
}

if (isset($_GET["change_to_sub"])) {
  $user_id = $_GET["change_to_sub"];
  $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$user_id} ";
  $result = mysqli_query($connection, $query);
  confirmQuery($result);
  header("Location: users.php");
}

if (isset($_GET["delete"])) {
  $user_id = $_GET["delete"];
  $query = "DELETE FROM users WHERE user_id = {$user_id} ";
  $result = mysqli_query($connection, $query);
  confirmQuery($result);
  header("Location: users.php");
}
?>