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

    $servername = "localhost"
    $username = "root"
    $password = "root"
    $dbname = "JW"

    function dbManipulations(&$rows, &$cols, &$type) {
      $conn = new mysqli($servername, $username, $password, $dbname);
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
      $selectLastTable = "SELECT * FROM table_history ORDER BY DESC LIMIT 1";
      if (!$rows || !$cols || !$type) {
        $result = $conn->query($selectLastLoop);
        if ($row = $result->fetch_assoc()) {
          if (!$rows) $rows = $row["rows"];
          if (!$cols) $cols = $row["cols"];
          if (!$type) $type = $row["type"];
        } else {
          echo "No data in DB to replace missing values.";
        }
      }
      $insertTable = "INSERT INTO table_history VALUES (CURRENT_TIMESTAMP, '$type', '$rows', '$cols')";
      $conn->query($insertLoop);
      $conn->close();
    }

    function inRange($val, $min, $max) {
      return ($val >= $min && $val <= $max);
    }

    function checkInput($rows, $cols, $tableID) {
      return (inRange($rows, 1, 50) &&
              inRange($cols, 1, 50) &&
              inRange($tableID, 1, 4));
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['submit'])) {
        $rows = $_POST['rows'];
        $cols = $_POST['cols'];
        $tableID = $_POST['tableID'];

        if (!checkInput($rows, $cols, $tableID)) {
          echo 'Wrong input values';
        } else {
          dbManipulations($rows, $cols, $tableID);

          $functions = array('table_1', 'table_2', 'table_3', 'table_4');
          echo $functions[$tableID - 1]($rows, $cols);
        }
      }
    }
    ?>
  </body>
</html>
