<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../main.css" media="screen" title="no title" charset="utf-8">
    <title>Table</title>
  </head>
  <body>
    <?php
    include('../scripts/table.php');

    function inRange($val, $min, $max) {
      return ($val >= $min && $val <= $max);
    }

    function checkInput($rows, $cols, $tableID) {
      return (inRange($rows, 1, 50) &&
              inRange($cols, 1, 50) &&
              inRange($tableID, 0, 3));
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['submit'])) {
        $rows = $_POST['rows'];
        $cols = $_POST['cols'];
        $tableID = $_POST['tableID'];

        if (!checkInput($rows, $cols, $tableID)) {
          echo 'Wrong input values';
        } else {
          $functions = array('table_1', 'table_2', 'table_3', 'table_4');
          echo $functions[$tableID - 1]($rows, $cols);
        }
      }
    }
    ?>
  </body>
</html>
