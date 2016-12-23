<html>
    <head>
        <title>PHP</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
echo 'Current PHP version: ' . phpversion();

$db = mysql_connect("localhost", "root", "root");
mysql_select_db('Lab7', $db);
echo '<h1>Завдання 1. Цикли.</h1>';

for ($i = 1; $i <= 4; $i++) {
    $start = $_POST[$i . "_start"];
    $step  = $_POST[$i . "_step"];
    $stop  = $_POST[$i . "_end"];
    if (empty($start) || empty($step) || empty($stop) || $step <= 0 || $stop <= 0) {
        $result = mysql_query("SELECT MAX(id) FROM lab7_loop", $db);
        $maxId  = rand(1, mysql_result($result, 0, 0));
        echo "<h3>не всі параметри " . $i . "-го циклу було заповнено, або деякі з них від’ємні. Кортеж до бд записаний не буде. Дані буде взято з БД</h3>";
        $result = mysql_query("SELECT start, step, end FROM  lab7_loop WHERE id = " . $maxId, $db);
        $start  = mysql_result($result, 0, 0);
        $step   = mysql_result($result, 0, 1);
        $stop   = mysql_result($result, 0, 2);
    } else {
        echo "<h3>всі параметри заповнено, кортеж (" . $start . ", " . $step . ", " . $stop . ") записаний<h3>";
        mysql_query("INSERT INTO lab7_loop(start, step, end) VALUES(" . $start . "," . $step . "," . $stop . ")", $db);
    }
    echo "<h4>початок : " . $start . ", крок : " . $step . ", кінцеве значення : " . $stop . "</h4>";
    for ($j = $start; $j < $stop; $j += $step)
        echo $j . " ";
    
    echo "<hr>";
}

echo '<h1>Завдання 2. таблиці.</h1>';

$table1_size    = $_POST['table1_size'];
$table2_size    = $_POST['table2_size'];
$table3_columns = $_POST['table3_columns'];
$table3_rows    = $_POST['table3_rows'];
$table4_columns = $_POST['table4_columns'];
$table4_rows    = $_POST['table4_rows'];

if (empty($table1_size) || empty($table2_size) || empty($table3_columns) || empty($table3_rows) || empty($table4_columns) || empty($table4_rows)) {
    echo "<h3>не всі дані таблиці було заповнено. Кортеж не буде записаний. Дані буде взято з БД</h3>";
    $result         = mysql_query("SELECT MAX(id) FROM lab7_tables", $db);
    $maxId          = rand(1, mysql_result($result, 0, 0));
    $result         = mysql_query("SELECT table1_size,table2_size, table3_columns, table3_rows, table4_columns, table4_rows 
                    FROM  lab7_tables WHERE id = " . $maxId, $db);
    $table1_size    = mysql_result($result, 0, 0);
    $table2_size    = mysql_result($result, 0, 1);
    $table3_columns = mysql_result($result, 0, 2);
    $table3_rows    = mysql_result($result, 0, 3);
    $table4_columns = mysql_result($result, 0, 4);
    $table4_rows    = mysql_result($result, 0, 5);
} else {
    echo "<h3>кортеж (" . $table1_size . ", " . $table2_size . ", " . $table3_columns . ", " . $table3_rows . ", " . $table4_columns . ", " . $table4_rows . ") було записано в БД</h3>";
    mysql_query("INSERT INTO lab7_tables(table1_size, table2_size, table3_columns, table3_rows, table4_columns, table4_rows) 
                                        VALUES (" . $table1_size . ", " . $table2_size . ", " . $table3_columns . ", " . $table3_rows . ", " . $table4_columns . ", " . $table4_rows . ")", $db);
}

echo "<h4>table1 size = " . $table1_size . ", table2 size = " . $table2_size . ", table3 columns = " . $table3_columns . ", table4 rows = " . $table3_rows . ", table4 columns = " . $table4_columns . ", table4 rows = " . $table4_rows . "</h4>";

echo '<h2>2.1</h2>';
echo '<table border="1">';
for ($i = $table1_size; $i > 0; $i--) {
    print "<tr>";
    if ($i != $table1_size)
        print "<td rowspan='" . ($i) . "'></td>";
    
    print "<td colspan='" . ($i) . "'></td></tr>";
}
echo '</table>';

echo '<h2>2.2</h2>';
echo '<table border="1">';
for ($i = $table2_size; $i >= 1; $i--) {
    print "<tr><td rowspan='" . $i . "'></td>";
    if ($i != 1)
        print "<td colspan='" . $i . "'></td></tr>";
    
}
echo '</table>';

echo '<h2>2.3</h2>';
echo '<table border="1">';
for ($i = 1; $i <= $table3_rows; $i++) {
    print "<tr>";
    if ($i % 2 != 0)
        print "<td colspan='1' width='5%'></td>";
    
    for ($j = 1; $j < $table3_columns / 2; $j++)
        print "<td colspan='2' width='10%'></td>";
    
    if ($i % 2 != 0 && $table3_columns % 2 == 0)
        print "<td colspan='1' width='5%'></td>";
    else if ($i % 2 == 0 && $table3_columns % 2 == 0)
        print "<td colspan='2' width='10%'></td>";
    
    if ($i % 2 == 0 && $table3_columns % 2 != 0)
        print "<td colspan='1' width='5%'></td>";
    print "</tr>";
}
echo '</table>';

$arr = array(
    array()
);
echo '<h2>2.4</h2>';
print("<table border = '1px'>");
for ($i = 0; $i < $table4_rows; $i++) {
    print("<tr>");
    $counter = 2;
    
    if ($i == 0) {
        for ($j = 0; $j < $table4_columns; $j++) {
            if ($counter == 3)
                $counter = 0;
            
            for ($k = 0; $k <= $counter; $k++)
                $arr[$i + $k][$j] = 1;
            
            print("<td rowspan = " . ($counter + 1) . "></td>");
            $counter++;
        }
    } else {
        for ($j = 0; $j < $table4_columns; $j++) {
            if ($arr[$i][$j] == 0) {
                
                for ($k = 0; $k <= $counter; $k++) {
                    if ($i + $k < $table4_rows)
                        $arr[$i + $k][$j] = 1;
                }
                
                if ($table4_rows - $i + 1 > $counter + 1)
                    print("<td rowspan = " . ($counter + 1) . "></td>");
                else
                    print("<td rowspan = " . ($table4_rows - $i) . "></td>");
            }
        }
    }
    print("</tr>");
}
print("</table>");

mysql_close($db);
?>


    </body>
</html>