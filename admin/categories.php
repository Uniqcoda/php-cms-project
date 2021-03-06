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
            Welcome
            <small><?php echo ucfirst($_SESSION['firstname']) ?></small>
          </h1>
          <h3>Categories</h3>

          <div class="col-xs-6">
            <?php addCategory() ?>

            <form action="" method="post">
              <div class="form-group">
                <label for="cat_title"> Add Category</label>
                <input class="form-control" type="text" name="cat_title" placeholder="Category Name">
              </div>
              <div class="form-group">
                <input class="btn btn-primary" type="submit" name="submit" value="Add">
              </div>
            </form>

            <?php
            if (isset($_GET["edit"])) {
              $cat_id = $_GET["edit"];
              include "includes/update_categories.php";
            }
            ?>
          </div>

          <div class="col-xs-6">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Category Title</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php getAllCategories(); ?>
                <?php deleteCategory(); ?>
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