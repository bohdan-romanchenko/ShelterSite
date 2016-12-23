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

    $servername = "localhost"
    $username = "vlad"
    $password = "qewret"
    $dbname = "db-7"

    function dbManipulations(&$start, &$step, &$end) {
      $conn = new mysqli($servername, $username, $password, $dbname);
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
      $selectLastLoop = "SELECT * FROM loop_history ORDER BY DESC LIMIT 1";
      if (!$start || !$step || !$end) {
        $result = $conn->query($selectLastLoop);
        if ($row = $result->fetch_assoc()) {
          if (!$start) $start = $row["start"];
          if (!$step) $step = $row["step"];
          if (!$end) $end = $row["end"];
        } else {
          echo "No data in DB to replace missing values.";
        }
      }
      $insertLoop = "INSERT INTO loop_history VALUES (CURRENT_TIMESTAMP, '$start', '$step', '$end')";
      $conn->query($insertLoop);
      $conn->close();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['submit'])) {
        $start = $_POST['start'];
        $step = $_POST['step'];
        $end = $_POST['end'];

        dbManipulations($start, $step, $end);

        printLoop($start, $step, $end);
      }
    }

    ?>
  </body>
</html>
