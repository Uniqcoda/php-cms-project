<?php session_start() ?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"> Blissful CMS </a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <?php
        $query = "SELECT * FROM categories
        ";
        // to limit the number of values returned
        $query .= "LIMIT 3 ";
        $all_categories = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($all_categories)) {
          $cat_title = $row['cat_title'];
          echo "<li><a href='#'>$cat_title</a></li>";
        }
        ?>
        <?php

        if (isset($_SESSION["user_role"])) {
          if ($_SESSION["user_role"] == 'admin') {
            echo "<li><a href='admin'>Admin</a></li>";
          }
        } else {
          echo "<li><a href='registration.php'>Register</a></li>";
        }
        ?>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container -->
</nav>