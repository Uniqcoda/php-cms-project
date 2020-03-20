<?php
include "includes/header.php";
include "includes/db.php";
include "admin/functions.php";

?>

<!-- Navigation -->
<?php
include "includes/navbar.php";
?>


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php
            if (isset($_GET["p_id"])) {
                $post_id = $_GET["p_id"];
            }

            $query = "SELECT * FROM posts WHERE post_id = $post_id ";
            $all_posts = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($all_posts)) {
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
            ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
            <?php
            }
            ?>

            <!-- Blog Comments -->
            <?php
            if (isset($_POST["create_comment"])) {
                $comment_post_id = $_GET["p_id"];
                $comment_author = $_POST["comment_author"];
                $comment_email = $_POST["comment_email"];
                $comment_content = $_POST["comment_content"];


                $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date ) ";
                $query .= "VALUE ($comment_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now()) ";

                $result = mysqli_query($connection, $query);
                confirmQuery($result);
            }
            ?>

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" method="post" role="form">
                    <div class="form-group">
                        <input type="text" class="form-control" name="comment_author" placeholder="Enter Full Name">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="comment_email" placeholder="Enter Email Address">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="comment_content" placeholder="Enter Comment"></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <!--Display Comments -->
            <?php
            if (isset($_GET['p_id'])) {
                $post_id = $_GET['p_id'];

                $comment_query = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
                $comment_query .= "AND comment_status = 'approved' ";
                // newer comments first
                $comment_query .= "ORDER BY comment_date DESC";
                $comment_result = mysqli_query($connection, $comment_query);
                confirmQuery($comment_result);

                while ($row = mysqli_fetch_assoc($comment_result)) {
                    $comment_id = $row['comment_id'];
                    $comment_post_id = $row['comment_post_id'];
                    $comment_author = $row['comment_author'];
                    $comment_content = substr($row['comment_content'], 0, 100);
                    $comment_email = $row['comment_email'];
                    $comment_status = $row['comment_status'];
                    $comment_date = $row['comment_date'];
            ?>

                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $comment_author ?> <small> <?php echo $comment_date ?></small>
                            </h4>
                            <p><?php echo $comment_content ?></p>
                        </div>
                    </div>

            <?php
                }
            }
            ?>
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php
        include "includes/sidebar.php";
        ?>

    </div>
    <!-- /.row -->

    <hr>
</div>
<?php
include "includes/footer.php";
?>