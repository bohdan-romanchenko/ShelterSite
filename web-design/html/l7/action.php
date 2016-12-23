<html>
	<head>
		<title>PHP</title>
		<meta charset="utf-8">
	</head>
	<body>
		<p>

		<?php 
		echo '<strong>Task1 </strong>';

		$tab1 = $_POST['tab1'];
		$tab2 = $_POST['tab2'];
		$tab3 = $_POST['tab3'];
		$tab4 = $_POST['tab4'];

		echo "<br><br> Input number for table 1 = ".$tab1;
		echo "<br> Input number for table 2 = ".$tab2;
		echo "<br> Input number for table 3 = ".$tab3;
		echo "<br> Input number for table 4 = ".$tab4;

		$db = mysql_connect("localhost", "root", "root");
		mysql_select_db('Lab7', $db);

		if (((strlen ($tab1)) < 1) or ($tab1 < 1) or is_int($tab1)==TRUE){
			// $db = mysql_connect("localhost", "root", "root");
			// mysql_select_db('Lab7', $db);
				$result = mysql_query("SELECT table1 FROM Lab WHERE ID=1", $db);
				$tab1= mysql_result($result, 0);
			// mysql_close($db);
		}

		if (((strlen ($tab2)) < 1) or ($tab2 < 1) or is_int($tab2)==TRUE){
			// $db = mysql_connect("localhost", "root", "root");
			// mysql_select_db('Lab7', $db);
				$result = mysql_query("SELECT table2 FROM  Lab WHERE ID=1", $db);
				$tab2= mysql_result($result, 0);
			// mysql_close($db);
		}

		if (((strlen ($tab3)) < 1) or ($tab3 < 1) or is_int($tab3)==TRUE){
				// $db = mysql_connect("localhost", "root", "root");
			// mysql_select_db('Lab7', $db);
				$result = mysql_query("SELECT table3 FROM  Lab WHERE ID=1", $db);
				$tab3= mysql_result($result, 0);
			// mysql_close($db);
		}

		if (((strlen ($tab4)) < 1) or ($tab4 < 1) or is_int($tab4)==TRUE){
			// $db = mysql_connect("localhost", "root", "root");
			// mysql_select_db('Lab7', $db);
				$result = mysql_query("SELECT table4 FROM  Lab WHERE ID=1", $db);
				$tab4= mysql_result($result, 0);
			// mysql_close($db);
		}

		mysql_close($db);

		$conn = new mysqli("localhost", "root", "root", Lab7);

		if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
		} 

		$sql = ("INSERT INTO Lab (table1, table2, table3, table4)
		VALUES ($tab1, $tab2, $tab3, $tab4)");

		if ($conn->query($sql) === TRUE) {
   			echo "<br>New record created successfully";
		}
		else {
    		echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();


		?>
		</p>
		
		
<p>
			<table border="1" width="90%">
				<?php
				if ($tab1 < 0){
					echo "Некоректне число рядків";
					$tab1=12;
					echo "<br>Кількість рядків за замовчанням 12";
				}
					echo"<td colspan=\"$tab1\">&nbsp;</td>";
					for($n = $tab1-1; $n >= 1; $n=$n-1){
						echo "<tr>";
							echo"<td rowspan=\"".($n)."\">&nbsp;</td>";
							echo"<td colspan=\"".($n)."\">&nbsp;</td>";	
						echo"</tr>";
					}
				?>
			</table>
		</p>

		<p>
			<table border="1" width="90%">
				<?php
				if ($tab2 < 0){
					echo "Некоректне число рядків";
					$tab2 = 14;
					echo "<br>Кількість рядків за замовчанням 14";
				}
					for($n =$tab2; $n >= 1; $n=$n-1){
						echo "<tr>";
						if($n>=3){
							echo"<td rowspan=\"".($n)."\">&nbsp;</td>";
							echo"<td colspan=\"".($n)."\">&nbsp;</td>";	
						}
						elseif($n==2){
							echo"<td rowspan=\"".($n)."\">&nbsp;</td>";
							echo"<td colspan=\"".($n-1)."\">&nbsp;</td>";	
						}
						else{
							echo"<td colspan=\"".($n)."\">&nbsp;</td>";
						}
						echo"</tr>";
					}
				?>
			</table>
		</p>

		<p>
			<table border="1" width="90%">
				<?php
				if ($tab3 < 0){
					echo "Некоректне число рядків";
					$tab3 = 10;
					echo "<br>Кількість рядків за замовчанням 10";
				}
					for($y = $tab3; $y >= 1; $y=$y-1){
						echo "<tr>";
						if ($y%2==0){
							for($x = 3; $x >= 1; $x=$x-1){
								echo"<td colspan=\"2\" width=\"10%\" >&nbsp;</td>";
							}
							echo"<td width=\"5%\">&nbsp;</td>";
						}
						else{
							echo"<td width=\"5%\">&nbsp;</td>";
							for($x = 3; $x >= 1; $x=$x-1){
								echo"<td colspan=\"2\" width=\"10%\" >&nbsp;</td>";
							}
						}
						echo"</tr>";
					}
				?>
			</table>
		</p>

<p>
<?php
			echo '<table border="1" width="90%" height="40%">';
			if ($tab4 < 0){
					echo "Некоректна кількість блоків";
					$tab4 = 4;
					echo "<br>Кількість блоків за замовчанням 4";
				}				
					for ($n = 8; $n >=1; $n=$n-1) { 
						echo "<tr>";
						if ($n == 8) {

							for ($m = $tab4; $m >=1 ; $m=$m-1) { 
								echo "<td rowspan=\"3\"  >&nbsp;</td>";
								echo "<td rowspan=\"1\"  >&nbsp;</td>";
								echo "<td rowspan=\"2\"  >&nbsp;</td>";
							}
						}
						else {
							if ($n == 1) {
								for ($m = $tab4; $m >=1 ; $m=$m-1) { 
									echo "<td rowspan=\"1\" >&nbsp;</td>";
								}
							}

							else if ($n == 2){
								for ($m = $tab4; $m >=1 ; $m=$m-1) { 
									echo "<td rowspan=\"2\" >&nbsp;</td>";
								}
							}

							else{
								if ($n % 3 == 0) {
									for ($m = $tab4; $m >=1 ; $m=$m-1) { 
										echo "<td rowspan=\"3\" >&nbsp;</td>";
									}
								}
								else {
									for ($m = $tab4; $m >=1 ; $m=$m-1) { 
										echo "<td rowspan=\"3\" >&nbsp;</td>";	
										}								
								}
							}
						}
						echo "</tr>";
					}
					echo '</table>';
				?>
		</p>
	</body>
</html>