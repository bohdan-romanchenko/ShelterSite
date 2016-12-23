<?php

function wrap($content, $tag, $attr = "") {
  return "<$tag $attr>\n" . $content . "\n</$tag>";
}

function cell($rowspan = 1, $colspan = 1, $content = "") {
  $attr = "";
  if ($rowspan > 1) {
    $attr .= "rowspan=\"$rowspan\" ";
  }
  if ($colspan > 1) {
    $attr .= "colspan=\"$colspan\" ";
  }
  return wrap($content, "td", $attr);
}

function row() {
  $cells = func_get_args();
  $flatCells = implode("\n", $cells);
  return wrap($flatCells, "tr");
}

function table($content, $id) {
  return wrap($content, "table", "id=\"$id\"");
}

function table_1($rows, $cols) {
  $dim = max($rows, $cols);
  $content = "";
  $content .= row(cell(1, $dim));
  for ($i = $dim - 1; $i != 0; $i--) {
    $content .= row(cell($i, 1),
                    cell(1, $i));
  }
  return table($content, "first-table");
}

function table_2($rows, $cols) {
  $dim = max($rows, $cols);
  $content = "";
  for ($i = $dim; $i != 1; $i--) {
    $content .= row(cell($i, 1),
                    cell(1, $i));
  }
  $content .= row(cell(1, 1));
  return table($content, "second-table");
}

function table_3($rows, $cols) {
  $content = "";
  for ($i = 0; $i != $rows; $i++) {
    if ($i % 2 == 0) {
      $content .= row(cell(1, 2),
                      cell(1, 2),
                      cell(1, 2),
                      cell(1, 1));
    } else {
      $content .= row(cell(1, 1),
                      cell(1, 2),
                      cell(1, 2),
                      cell(1, 2));
    }
  }
  return table($content, "third-table");
}

function howMuchCellsInRow($cols) {
    $a = round($cols / 3);
    $b = round(($cols + 1) / 3);
    $c = round(($cols - 1) / 3);
    $nums = array();

    if ($a == $b && $a == $c) {
      // Центр тройки
      $nums[0] = $nums[1] = $nums[2] = round($cols / 3);
    } else if ($a == $b) {
      // Нижний элемент
      $nums[0] = $nums[2] = round($cols / 3);
      $nums[1] = $nums[0] - 1;
    } else {
      // Верхний элемент
      $nums[0] = $nums[1] = round($cols / 3);
      $nums[2] = $nums[0] + 1;
    }
    // echo $nums[0], $nums[1], $nums[2], "<br/>";
    return array($nums[0], $nums[1], $nums[2]);
}

function canFill($rest, $max) {
  for ($i = 0; $i != count($rest); $i++) {
    $el = $rest[$i];
    if ($el >= 3) {
      return True;
    }
  }
  return False;
}

function finalRest($rest) {
  // echo implode($rest, " ");
  $ones = 0;
  $twos = 0;
  for ($i = 0; $i != count($rest); $i++) {
    $el = $rest[$i];
    if ($el == 1) {
      $ones++;
    } else if ($el == 2) {
      $twos++;
    }
  }
  return array($ones, $twos);
}

function table_4($rows, $cols) {
  $content = "";
  $cells = array(cell(1, 1), cell(2, 1), cell(3, 1));
  $orderedCells = array(cell(3, 1), cell(1, 1), cell(2, 1));
  $orderedSize = array(3, 1, 2);
  $rest = array();
  for ($i = 0; $i != $cols; $i++) {
    $rest[$i] = $rows;
  }
  $canFill = True;

  $fillIndex = array(1, 2, 0);
  $shift = 3;
  $start = 0;

  // [0] - количество единиц
  // [1] - количество двоек
  // [2] - количество троек
  $numCellsInRow = howMuchCellsInRow($cols);
  $currentCellSize = 0;

  // Заполняется первая строка
  $flatCells = array();
  for ($i = 0; $i != $cols; $i++) {
    $idx = $i % count($orderedCells);
    array_push($flatCells, $orderedCells[$idx]);
    $rest[$i] -= $orderedSize[$idx];
  }
  $content .= row(implode($flatCells));

  // Заполняются строки со 2 и почти до последней
  $j = 0;
  while (canFill($rest, $rows)) {
    // echo "<br/>", implode($rest, " "), "<br/>";

    $flatCells = array();

    $num = $numCellsInRow[$currentCellSize % count($numCellsInRow)];
    $fill = $fillIndex[$j % count($fillIndex)];

    for ($i = 0; $i != $num; $i++) {
      array_push($flatCells, $cells[2]);
      $rest[$fill] -= 3;
      // echo "Fill: ", $j, " ", $num, "<br/>";
      $fill += $shift;
    }

    $startIndex += 1;
    $pendingIndex = $startIndex;
    $content .= row(implode($flatCells));
    $canFill = false;
    $currentCellSize++;
    $j++;
  }

  // Заполняются последние строки
  $flatCells = array();
  $finalRest = finalRest($rest);
  for ($i = 0; $i != $finalRest[1]; $i++) {
    array_push($flatCells, cell(2, 1));
  }
  $content .= row(implode($flatCells));

  $flatCells = array();
  for ($i = 0; $i != $finalRest[0]; $i++) {
    array_push($flatCells, cell(1, 1));
  }
  $content .= row(implode($flatCells));

  return table($content, "fourth-table");
}

?>
