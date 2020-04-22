<?php
include "includes/admin_header.php";
include "includes/db.php";

?>
<div id="wrapper">

  <!-- Navigation -->
  <?php
  include "includes/admin_navbar.php";

  ?>

  <?php
  if (isset($_GET['source'])) {
    $source = $_GET['source'];
  } else {
    $source = '';
  }

  switch ($source) {
    case 'add_user':
      include "includes/add_user.php";
      break;
    case 'edit_user':
      include "includes/edit_user.php";
      break;

    default:
      include "includes/view_all_users.php";
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