<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Lab 3</title>
    <style>
      table {
          border-collapse: collapse;
          margin: auto;
          width: 80%;
          height: 250px;
          margin-bottom: 35px;
          margin-top: 35px;
      }

      table td {
          border: 1px solid black;
      }

      #first-table td:last-child {
        width: 30%;
      }

      #second-table {
        height: 320px;
      }

      #second-table tr:last-child {
        height: 28%;
      }

      #third-table tr:nth-child(2n + 1) td:last-child {
        width: calc(100% / 7);
      }

      #third-table tr:nth-child(2n) td:not(:first-child) {
        width: calc(100% / 7 * 2);
      }
    </style>
  </head>
  <body>
      <?php
        include './loop.php'; //there are function loop(start, end, step)

      echo '<h1>Task 1</h1>';
      echo '<h2>1.1</h2>';
      echo "Loop (200, 0, -3)<br />";
      echo loop(200, 0, -3);

      echo '<h2>1.2</h2>';
      echo "Loop (0, 99, 1)<br />";
      echo loop(0, 99, 1);

      echo '<h2>1.3</h2>';
      echo "Loop (1, -99, 1)<br />";
      echo loop(1, -99, 1);

      echo '<h2>1.4</h2>';
      echo "Loop (-100, -2, 2)<br />";
      echo loop(-100, -2, 2);

      //////////////////////////////////////////

      echo '<h1>Task 2</h1>';
      $n=9; $m=9; //arguments for tables

      echo '<h2>2.1</h2>';
      echo '<table border="1">';
      for ($i = $n; $i > 0; $i--) 
      {
        print "<tr>";
        if ($i != $n)
          print "<td rowspan='". ($i) ."'></td>";
    
        print "<td colspan='".($i)."'></td></tr>";
      }
      echo '</table>';  

      echo '<h2>2.2</h2>';
      echo '<table border="1">';
      for ($i = $n; $i >= 1; $i--)
      {
        print "<tr><td rowspan='".$i."'></td>";
        if($i != 1)
          print "<td colspan='".$i."'></td></tr>";
              
      }
      echo '</table>';
      
      echo '<h2>2.3</h2>';
      echo '<table border="1">';
      for($i=1; $i<=$n; $i++)
      {
        print "<tr>";
        if($i % 2 != 0)
          print "<td colspan='1' width='5%'></td>";
        for($j=1; $j<$m; $j++)
        {
          print "<td colspan='2' width='10%'></td>";
        }
        if($i % 2 == 0)
          print "<td colspan='1' width='5%'></td>";
        print "</tr>";
      }
      echo '</table>';  

      echo '<h2>2.4</h2>';
      $arr = array(array());
      for($i=0; $i<$m; $i++)
        $arr[i] = array_fill(0, m, 0);     
      print("<table border = '1px'>");
      for($i = 0; $i<$m; $i++){
        print("<tr>");
        $counter = 2;

        if($i == 0){
          for($j = 0; $j<$n; $j++){
            if($counter == 3)
              $counter = 0;
            
            for($k = 0; $k <= $counter; $k++)
              $arr[$i+$k][$j]=1;
          
            print("<td rowspan = ".($counter+1)."></td>");
            $counter++;
          }
        }
        else{
          for($j = 0; $j<$n; $j++){
            if($arr[$i][$j]==0){
              
              for($k = 0; $k <= $counter; $k++){
                if($i+$k < $m)
                  $arr[$i+$k][$j]=1;
              }
              
              if($m-$i+1>$counter+1)
                print("<td rowspan = ".($counter+1)."></td>");
              else
                print("<td rowspan = ".($m-$i)."></td>");
            }
          }
        }
        print("</tr>");
      }
      print("</table>");
    ?>
  </body>
</html>
