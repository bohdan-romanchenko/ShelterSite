<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../main.css" media="screen" title="no title" charset="utf-8">
    <title>Loop</title>
  </head>
  <body>
    <?php
    include('../scripts/loop.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['submit'])) {
        $start = $_POST['start'];
        $step = $_POST['step'];
        $end = $_POST['end'];

        printLoop($start, $step, $end);
      }
    }

    ?>
  </body>
</html>
