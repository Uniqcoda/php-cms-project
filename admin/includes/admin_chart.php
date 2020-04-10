<?php
$drafts_query = "SELECT * FROM posts WHERE post_status = 'draft'";
$drafts_result = mysqli_query($connection, $drafts_query);
confirmQuery($drafts_result);
$drafts_count = mysqli_num_rows($drafts_result);

$unapproved_comments_query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
$unapproved_comments_result = mysqli_query($connection, $unapproved_comments_query);
confirmQuery($unapproved_comments_result);
$unapproved_comments_count = mysqli_num_rows($unapproved_comments_result);

$subscribers_query = "SELECT * FROM users WHERE user_role = 'subscriber'";
$subscribers_result = mysqli_query($connection, $subscribers_query);
confirmQuery($subscribers_result);
$subscribers_count = mysqli_num_rows($subscribers_result);


?>
<div class="row">
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Data', 'Count'],
        <?php
        $element_text = ['Active Posts', 'Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Subscribers', 'Categories'];
        $element_count = [$posts_count, $drafts_count, $comments_count, $unapproved_comments_count, $users_count, $subscribers_count, $categories_count];
        for ($i = 0; $i < 7; $i++) {
          echo "['$element_text[$i]', $element_count[$i]],";
        }
        ?>
      ]);

      var options = {
        chart: {
          title: '',
          subtitle: '',
        }
      };

      var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

      chart.draw(data, google.charts.Bar.convertOptions(options));
    }
  </script>
  <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>

</div>