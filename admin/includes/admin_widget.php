<!-- /.row -->
<div class="row">
  <div class="col-lg-3 col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">
            <i class="fa fa-file-text fa-5x"></i>
          </div>
          <div class="col-xs-9 text-right">
            <?php
            $posts_query = "SELECT * FROM posts";
            $posts_result = mysqli_query($connection, $posts_query);
            confirmQuery($posts_result);
            $posts_count = mysqli_num_rows($posts_result);
            echo "<div class='huge'>$posts_count</div>";
            ?>

            <div>Posts</div>
          </div>
        </div>
      </div>
      <a href="posts.php">
        <div class="panel-footer">
          <span class="pull-left">View Details</span>
          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
          <div class="clearfix"></div>
        </div>
      </a>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="panel panel-green">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">
            <i class="fa fa-comments fa-5x"></i>
          </div>
          <div class="col-xs-9 text-right">
            <?php
            $comments_query = "SELECT * FROM comments";
            $comments_result = mysqli_query($connection, $comments_query);
            confirmQuery($comments_result);
            $comments_count = mysqli_num_rows($comments_result);
            echo "<div class='huge'>$comments_count</div>";
            ?>
            <div>Comments</div>
          </div>
        </div>
      </div>
      <a href="comments.php">
        <div class="panel-footer">
          <span class="pull-left">View Details</span>
          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
          <div class="clearfix"></div>
        </div>
      </a>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="panel panel-yellow">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">
            <i class="fa fa-user fa-5x"></i>
          </div>
          <div class="col-xs-9 text-right">
            <?php
            $users_query = "SELECT * FROM users";
            $users_result = mysqli_query($connection, $users_query);
            confirmQuery($users_result);
            $users_count = mysqli_num_rows($users_result);
            echo "<div class='huge'>$users_count</div>";
            ?>
            <div> Users</div>
          </div>
        </div>
      </div>
      <a href="users.php">
        <div class="panel-footer">
          <span class="pull-left">View Details</span>
          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
          <div class="clearfix"></div>
        </div>
      </a>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="panel panel-red">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">
            <i class="fa fa-list fa-5x"></i>
          </div>
          <div class="col-xs-9 text-right">
            <?php
            $categories_query = "SELECT * FROM categories";
            $categories_result = mysqli_query($connection, $categories_query);
            confirmQuery($categories_result);
            $categories_count = mysqli_num_rows($categories_result);
            echo "<div class='huge'>$categories_count</div>";
            ?>
            <div>Categories</div>
          </div>
        </div>
      </div>
      <a href="categories.php">
        <div class="panel-footer">
          <span class="pull-left">View Details</span>
          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
          <div class="clearfix"></div>
        </div>
      </a>
    </div>
  </div>
</div>
<!-- /.row -->