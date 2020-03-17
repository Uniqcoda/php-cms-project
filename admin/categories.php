<?php
include "includes/admin_header.php";
include "includes/db.php";

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
            Welcome to Admin
            <small>Author</small>
          </h1>
          <div class="col-xs-6">
            <?php
            if (isset($_POST["submit"])) {
              // echo "Hello";
              $cat_title = $_POST["cat_title"];
              if ($cat_title == "" || empty($cat_title)) {
                echo "<small>Please fill this field</small>";
              } else {
                $query = "INSERT INTO categories(cat_title) VALUE('{$cat_title}') ";
                $result = mysqli_query($connection, $query);
                if (!$result) {
                  die("QUERY FAILED" . mysqli_error($connection));
                }
              }
            }
            ?>
            <form action="" method="post">
              <div class="form-group">
                <label for="cat_title"> Add Category</label>
                <input class="form-control" type="text" name="cat_title">
              </div>
              <div class="form-group">
                <input class="btn btn-primary" type="submit" name="submit" value="Add">
              </div>
            </form>
          </div>



          <div class="col-xs-6">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Category Title</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                // get all categories
                $query = "SELECT * FROM categories";
                $result = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                  $cat_id = $row['cat_id'];
                  $cat_title = $row['cat_title'];
                  echo "<tr>
                <td>$cat_id</td>
                <td>$cat_title</td>
                <td><a href='categories.php?delete={$cat_id}'>Delete</a></td>
              </tr>";
                }
                ?>
                <?php 
                // delete categories
                if (isset($_GET["delete"])) {
                  $cat_id = $_GET["delete"];
                  $query = "DELETE FROM categories WHERE cat_id = {$cat_id} ";
                  $result = mysqli_query($connection, $query);
                  header("Location: categories.php");
                }
                ?>
              </tbody>
            </table>
          </div>
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