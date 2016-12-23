<?php

function loop($start, $end, $step) {
  
  if ($step === 0) {
    echo 'Step is 0, can not loop <br/><br/>';
    return;
  }

  if ($start === $end) {
    echo 'Start equals to end <br/><br/>';
    return;
  }

  if (($step > 0 && $start > $end) || ($step < 0 && $start < $end)) {
    $step = -$step; //from start to end. Can't go to infinity
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
