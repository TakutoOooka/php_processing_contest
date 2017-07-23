<?php
define("ASSET_ROOT", PROJECT_ROOT . '/assets');
define("VIEW_ROOT", PROJECT_ROOT . '/views');
?>

<html>
<head>
  <meta charset='utf-8'>
  <title>Processing Contest!</title>
  <script src='assets/js/jquery-3.2.1.min.js'></script>
  <link href='assets/css/reset.css' rel='stylesheet' type='text/css'>
  <link href="assets/css/application.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php include(VIEW_ROOT . '/header.php') ?>
  <div id='content-area'>

    <?php include(VIEW_ROOT . '/' . $controller . '/' . $action . '.php') ?>
  </div>
    <?php include(VIEW_ROOT . '/footer.php'); ?>
</body>

<script src='assets/js/application.js' type='text/javascript'></script>

</html>
