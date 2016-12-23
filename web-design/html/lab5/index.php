<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Lab 5</title>
  </head>
  <body>
  <?php

  $arr = array();
    $elements = 10;
    for ($i=0; $i < $elements; $i++) {
      array_push($arr, $i);
    }
    shuffle($arr);

    // $arr = array(7, 3, 9, 6, 5, 1, 2, 0, 8, 4);

    echo '<h1>Task 1</h1>';
    $timeStart = microtime(true);
    selectionSort($arr);
    $timeFinish = microtime(true);
    echo "selection - ". ($timeFinish - $timeStart) / 60 ." seconds</br>";

    $timeStart = microtime(true);
    insertionSort($arr);
    $timeFinish = microtime(true);
    echo "insertionSort - ". ($timeFinish - $timeStart) / 60 ." seconds</br>";

    if ($elements <= 10) {
      $timeStart = microtime(true);
      randomSort($arr);
      $timeFinish = microtime(true);
      echo "randomSort - ". ($timeFinish - $timeStart) / 60 ." seconds</br>";
    }

    $timeStart = microtime(true);
    bubbleSort($arr);
    $timeFinish = microtime(true);
    echo "bubbleSort - ". ($timeFinish - $timeStart) / 60 ." seconds</br>";

    $timeStart = microtime(true);
    quickSort($arr);
    $timeFinish = microtime(true);
    echo "quickSort - ". ($timeFinish - $timeStart) / 60 ." seconds</br>";

    $timeStart = microtime(true);
    mergesort($arr);
    $timeFinish = microtime(true);
    echo "mergesort - ". ($timeFinish - $timeStart) / 60 ." seconds</br>";



    // $timeStart = microtime(true);
    // insertionSort($arr);
    // ti
    // if ($arr.len <= 10) {
    //   randomSort($arr);
    // }
    // echo "insertion - ".implode(insertionSort($arr), " "), "</br>";
    // $time3 = microtime(true);
    // echo "random sort - ".implode(randomSort($arr), " "), "</br>";
    // $time4 = microtime(true);
    // echo "bubble sort - ".implode(bubbleSort($arr), " "), "</br>";
    // $time5 = microtime(true);
    // echo "quick sort - ".implode(quickSort($arr), " "), "</br>";
    // $time6 = microtime(true);
    // echo "merge sort - ".implode(mergesort($arr), " "), "</br>";
    // $time7 = microtime(true);
  ?>
  </body>
</html>

<?php

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

function swap(&$x, &$y) {
    $tmp=$x; $x=$y; $y=$tmp;
}

function ordered($A) {
  for ($i = 0; $i < count($A) - 1; $i++) {
    if ($A[$i] > $A[$i + 1]) {
      return False;
    }
  }
  return True;
}

function selectionSort($A) {
  $len = count($A);
  for ($i = 0; $i < $len - 1; $i++) {
    $key = $i;
    for ($j = $i + 1; $j < $len; $j++) {
      if ($A[$j] < $A[$key]) {
        $key = $j;
      }
    }
    swap($A[$i], $A[$key]);
  }
  return $A;
}

function insertionSort($A) {
  $len = count($A);
  for ($i = 1; $i < $len; $i++) {
    $tmp = $A[$i];
    $j = $i;
    while ($j >= 1 && $A[$j - 1] > $tmp) {
      $A[$j] = $A[$j - 1];
      $j--;
    }
    $A[$j] = $tmp;
  }
  return $A;
}

function randomSort($A) {
    while (!ordered($A)) {
      shuffle($A);
    }
  return $A;
}

function bubbleSort($A) {
  $len = count($A);
  for ($i = 0; $i <$len ; $i++) {
    for ($j = 0; $j < $len - 1; $j++) {
      if ($A[$j + 1] < $A[$j]) {
        swap($A[$j + 1], $A[$j]);
      }
    }
  }
  return $A;
}

function quickSort($A) {
  $len = count($A);
  if ($len < 2) {
    return $A;
  }

  $left = $right = array();
  reset($A);
  $pivot_key = key($A);
  $pivot = array_shift($A);

  foreach($A as $k => $v) {
  	if($v < $pivot)
        $left[$k] = $v;
    else
        $right[$k] = $v;
  }

  return array_merge(quickSort($left),
                     array($pivot_key => $pivot),
                     quickSort($right));
}

function mergesort($A) {
    if(count($A)>1) {
        $A_middle = round(count($A)/2, 0, PHP_ROUND_HALF_DOWN);
        $A_part1 = mergesort(array_slice($A, 0, $A_middle));
        $A_part2 = mergesort(array_slice($A, $A_middle, count($A)));
        $counter1 = $counter2 = 0;
        for ($i=0; $i<count($A); $i++) {
            if($counter1 == count($A_part1)) {
                $A[$i] = $A_part2[$counter2];
                ++$counter2;
            } elseif (($counter2 == count($A_part2)) or ($A_part1[$counter1] < $A_part2[$counter2])) { 
                $A[$i] = $A_part1[$counter1];
                ++$counter1;
            } else {
                $A[$i] = $A_part2[$counter2];
                ++$counter2;
            }
        }
    }
    return $A;
}

?>
