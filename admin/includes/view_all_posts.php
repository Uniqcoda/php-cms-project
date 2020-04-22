<h3>Posts</h3>
<?php
if (isset($_POST['checkBoxArray'])) {
  foreach ($_POST['checkBoxArray'] as $postId) {
    $bulk_options = $_POST['bulk_options'];

    if ($bulk_options == 'published' || 'draft') {
      $bulk_query = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = $postId ";
      $bulk_query_result = mysqli_query($connection, $bulk_query);
      confirmQuery($bulk_query_result);
    }
    if ($bulk_options == 'delete') {
      $bulk_query = "DELETE FROM posts WHERE post_id = '$postId' ";
      $bulk_query_result = mysqli_query($connection, $bulk_query);
      confirmQuery($bulk_query_result);
    }
  }
}
?>

<form action="" method="post">
  <div id="bulkOptionContainer" class="col-xs-4">
    <select name="bulk_options" id="" class="form-control">
      <option value="">Select Options</option>
      <option value="published">Publish</option>
      <option value="draft">Draft</option>
      <option value="delete">Delete</option>
    </select>
  </div>
  <div class="col-xs-4">
    <input type="submit" name="submit" class="btn btn-success" value="Apply">
    <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
  </div>
  <table class="table table-hover table-bordered">
    <thead>
      <tr>
        <th><input id="selectAllBoxes" type="checkbox"></th>
        <th>ID</th>
        <th>Author</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>
        <th>View</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php
      global $connection;
      $query = "SELECT * FROM posts ";
      // $query .= "ORDER BY post_date DESC ";
      $result = mysqli_query($connection, $query);
      while ($row = mysqli_fetch_assoc($result)) {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
      ?>
        <tr>
          <td><input class='checkBoxes' type='checkbox' name="checkBoxArray[]" value=<?php echo $post_id; ?>></td>

        <?php
        echo "<td>$post_id</td>";
        echo "<td>$post_author</td>";
        echo "<td>$post_title</td>";

        // relationship between post and category 
        $cat_query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
        $cat_result = mysqli_query($connection, $cat_query);
        confirmQuery($cat_result);
        while ($row = mysqli_fetch_assoc($cat_result)) {
          $cat_id = $row['cat_id'];
          $cat_title = $row['cat_title'];
        }

        echo "<td>$cat_title</td>";
        echo "<td>$post_status</td>";
        echo "<td><img width='100' src='../images/$post_image'></td>";
        echo "<td>$post_tags</td>";
        echo "<td>$post_comment_count</td>";
        echo "<td>$post_date</td>";
        echo "<td><a href='../post.php?p_id={$post_id}'>View</a></td>";
        echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
        echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?');\" href='posts.php?delete={$post_id}'>Delete</a></td>";
        echo "</tr>";
      } ?>
    </tbody>
  </table>
</form>

<?php
if (isset($_GET["delete"])) {
  $post_id = $_GET["delete"];
  $query = "DELETE FROM posts WHERE post_id = {$post_id} ";
  $result = mysqli_query($connection, $query);
  confirmQuery($result);
  header("Location: posts.php");
}
?>