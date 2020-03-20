<table class="table table-hover table-bordered">
  <thead>
    <tr>
      <th>ID</th>
      <th>Author</th>
      <th>Title</th>
      <th>Category</th>
      <th>Status</th>
      <th>Image</th>
      <th>Tags</th>
      <th>Comments</th>
      <th>Date</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php
      global $connection;
      $query = "SELECT * FROM posts ORDER BY post_date DESC ";
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
        echo "<tr>";
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
        echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
        echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
        echo "</tr>";
      } ?>
    </tr>
  </tbody>
</table>

<?php
if (isset($_GET["delete"])) {
  $post_id = $_GET["delete"];
  $query = "DELETE FROM posts WHERE post_id = {$post_id} ";
  $result = mysqli_query($connection, $query);
  confirmQuery($result);
  header("Location: posts.php");
}
?>