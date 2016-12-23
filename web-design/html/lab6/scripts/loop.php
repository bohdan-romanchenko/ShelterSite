<?php

function printLoop($start, $step, $end) {
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

  echo '<br /><br />';
}

?>
