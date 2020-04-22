<?php
include "includes/admin_header.php";
include "includes/db.php";

?>
<div id="wrapper">

  <!-- Navigation -->
  <?php
  include "includes/admin_navbar.php";

  ?>
  <h3>Comments</h3>

  <?php
  if (isset($_GET['source'])) {
    $source = $_GET['source'];
  } else {
    $source = '';
  }

  switch ($source) {
    case 'add_post':
      include "includes/add_post.php";
      break;
    case 'edit_post':
      include "includes/edit_post.php";
      break;

    default:
      include "includes/view_all_comments.php";
      break;
  }



  ?>
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