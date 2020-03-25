<?php
include "../functions.php";
?>


<h3>Edit Post</h3>
<form action="" method="post" enctype="multipart/form-data">
  <?php
  // fetch post data from the database
  if (isset($_GET["p_id"])) {

    $post_id = $_GET["p_id"];

    $query = "SELECT * FROM posts WHERE post_id = {$post_id} ";

    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    while ($row = mysqli_fetch_assoc($result)) {
      $post_id = $row['post_id'];

      $post_title = $row['post_title'];
      $post_author = $row['post_author'];
      $post_category_id  = $row['post_category_id'];
      $post_status = $row['post_status'];
      $post_image = $row['post_image'];
      $post_tags = $row['post_tags'];
      $post_content = $row['post_content'];
      $post_date = $row['post_date'];
      $post_comment_count = $row['post_comment_count'];
  ?>


      <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" value="<?php if (isset($post_title)) echo $post_title ?>">
      </div>

      <div class="form-group">
        <label for="post_category_id">Post Category</label><br>
        <select name="post_category_id" id="post_category">
          <?php
          $query = "SELECT * FROM categories ";

          $result = mysqli_query($connection, $query);
          confirmQuery($result);

          while ($row = mysqli_fetch_assoc($result)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            echo "<option value='{$cat_id}'>$cat_title</option>";
          }
          ?>
        </select>

      </div>

      <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="author" value="<?php if (isset($post_author)) echo $post_author ?>">
      </div>


      <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status" value="<?php if (isset($post_status)) echo $post_status ?>">
      </div>

      <div class="form-group">
        <label for="image">Post Image</label><br>
        <img width="100" src="../images/<?php echo $post_image ?>" alt="">
        <input type="file" name="image">
      </div>

      <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php if (isset($post_tags)) echo $post_tags ?>">
      </div>

      <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control " name="post_content" id="body" cols="30" rows="10"><?php if (isset($post_content)) echo $post_content ?></textarea>
      </div>


  <?php }
  } ?>

  <?php
  // update query
  if (isset($_POST["update_post"])) {

    $post_id = $_GET["p_id"];
    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    $post_category_id  = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];

    move_uploaded_file($post_image_temp, "../images/$post_image");

    // fix bug: submitting empty image value
    if (empty($post_image)) {
      $query = "SELECT * FROM posts WHERE post_id = {$post_id} ";

      $result = mysqli_query($connection, $query);
      confirmQuery($result);
      while ($row = mysqli_fetch_assoc($result)) {
        $post_image = $row['post_image'];
      }
    }

    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_date = now(), ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_image = '{$post_image}' ";
    $query .= "WHERE post_id = {$post_id} ";

    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    header("Location: posts.php");
  }
  ?>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
  </div>


</form>