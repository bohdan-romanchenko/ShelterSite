<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Lab 4</title>
  </head>
  <body>
    <?php
      // Start - Step - End
      $a = array(array(200, 150, 120), array(1, 2, 3), array(0, 1, -1));
      $b = array(array(0, 1, 2), array(1, 10, 100), array(99, 199, 999));
      $c = array(array(1, 0, -1), array(1, 2), array(-99, 0, 99));
      $d = array(array(-100, 0, 100), array(2, 3, 4), array(-2, 0, 2));

      echo '<h1>Task 1</h1>';
      echo "<h2>Loop 1</h2>";
      printRandomLoop($a);

      echo "<h2>Loop 2</h2>";
      printRandomLoop($b);

      echo "<h2>Loop 3</h2>";
      printRandomLoop($c);

      echo "<h2>Loop 4</h2>";
      printRandomLoop($d);
    ?>
  </body>
</html>

<?php

function printRandomLoop($initials) {
  $start = $initials[0][rand(0, count($initials[0]) - 1)];  //getting random between first array(e.g. between 200, 150 and 120).
                                                            //this will be our start
  $step = $initials[1][rand(0, count($initials[1]) - 1)];   //getting random between second array(e.g. between 1, 2 and 3).
                                                            //this will be our step
  $end = $initials[2][rand(0, count($initials[2]) - 1)];    //getting random between third array(e.g. between 0, 1 and -1).
                                                            //this will be our end
  loop($start, $step, $end);  //call function to print loop with our randomed arguments(func from previous lab)
}

function loop($start, $end, $step) {
  echo "Loop ({$start}, {$step}, {$end})<br />";

  if ($step === 0) {
    echo 'Step is 0, can not loop <br/><br/>';
    return;
  }

  if ($start === $end) {
    echo 'Start equals to end <br/><br/>';
    return;
  }

  if (($step > 0 && $start > $end) ||
      ($step < 0 && $start < $end)) {
    $step = -$step;
  }

  if ($start < $end) {
    for ($i = $start; $i <= $end; $i += $step) {
      echo "${i} ";
    }
  } else {
    for ($i = $start; $i >= $end; $i += $step) {
      echo "${i} ";
    }
  }

  echo '<br/><br/>';
}

?>
