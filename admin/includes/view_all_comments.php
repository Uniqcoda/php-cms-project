<table class="table table-hover table-bordered">
  <thead>
    <tr>
      <th>ID</th>
      <th>Author</th>
      <th>Comment</th>
      <th>Email</th>
      <th>Status</th>
      <th>In Response To</th>
      <th>Date</th>
      <th>Approve</th>
      <th>Unapprove</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php
      global $connection;
      $query = "SELECT * FROM comments";
      $result = mysqli_query($connection, $query);
      while ($row = mysqli_fetch_assoc($result)) {
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_content = substr($row['comment_content'], 0, 100);
        $comment_email = $row['comment_email'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];

        echo "<tr>";
        echo "<td>$comment_id</td>";
        echo "<td>$comment_author</td>";
        echo "<td>$comment_content...</td>";
        echo "<td>$comment_email</td>";
        echo "<td>$comment_status</td>";

        // relationship between post and category 
        $post_query = "SELECT * FROM posts WHERE post_id = {$comment_post_id} ";
        $post_result = mysqli_query($connection, $post_query);
        confirmQuery($post_result);
        while ($row = mysqli_fetch_assoc($post_result)) {
          $post_id = $row['post_id'];
          $post_title = $row['post_title'];


          echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
        }

        echo "<td>$comment_date</td>";
        echo "<td><a href='posts.php?source=edit_post&p_id={$comment_id}'>Approve</a></td>";
        echo "<td><a href='posts.php?delete={$comment_id}'>Unapprove</a></td>";
        echo "<td><a href='posts.php?delete={$comment_id}'>Delete</a></td>";
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