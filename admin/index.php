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
                </div>
                <h4>Please select an item from the menu on the left-hand side.</h4>
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