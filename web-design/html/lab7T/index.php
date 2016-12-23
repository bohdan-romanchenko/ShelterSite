<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PHP</title>
	<style>
		h1 {
			text-align: center;
		}
		table {
			width: 100%;
			border-collapse: collapse;
			border: 1px solid #000;
			height: 300px;
		}
		h3 {
			padding-left: 20px;
		}
		form{
			margin-left: 30px;
			margin-bottom: 20px;
		}
		form input 
		{
			margin: 10px;
		}
		h4,.arr{
			padding-left: 40px;
		}
	</style>
</head>
<body>
	<h1>Лабораторна робота №7</h1>
	<h2>1.	Написати програми виведення на екран повідомлень в циклі із заданими користувачем параметрами початку циклу, кроку циклу, і закінчення циклу.</h2>
	<h3>Цикл 1.1</h3>
	<form method="post" action="index.php">
		Початок: <input type="text" name="start">
		Закінчення: <input type="text" name="end">
		Крок: <input type="text" name="step">
		<input type="submit" name="form1">
	</form>
		
	<?php 
		
		if (isset($_REQUEST['form1'])) {
		
			$start = $_POST["start"];
			$end = $_POST["end"];
			$step = $_POST["step"];

			if (isset($start) && isset($end) && isset($step) && $step!=0 &&(($start < $end && $step>0) || ($start > $end && $step<0))) {
				$db = mysql_connect("localhost", "root", "root");
				mysql_select_db('Lab7', $db);
				print("<h4>Початок: ".$start.", крок: ".$step.", закінчення: ".$end."</h4><div class='arr'>");
				if ($start>$end) {
					for ($i = $start; $i >= $end; $i -= $step) 
						print $i.' ';
				}
				else
				{
					for ($i = $start; $i <= $end; $i += $step) 
						print $i.' ';
				}
				print("</div>");
				$id = 1;
				try
				{
					$sql = 'UPDATE `loop` SET `start`=:start, `end`=:ends, `step`=:step WHERE id=:id'; 
					
					$s = $pdo->prepare($sql);
					$s->bindValue(':start', $start);
					$s->bindValue(':ends', $end);
					$s->bindValue(':step', $step);
					$s->bindValue(':id', $id);
					$s->execute();
				}
				catch (PDOException $e)
				{
					exit('Error fetching data from db!'.$e);
				}
			}
			else
			{
				print("<div class='arr'>Введено не всі параметри або вони є не правильними!</div>");
			}
		}
		else 
		{
			$id = 1;
			try
			{
				$sql = 'SELECT * FROM  `loop` WHERE id=:id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':id', $id);
				$s->execute();
			}
			catch (PDOException $e)
			{
				exit('Error fetching data from db!'.$e);
			}
			$data = $s->fetch();
			$start = $data['start'];
			$end = $data['end'];
			$step = $data['step'];
			print("<h4>Початок: ".$start.", крок: ".$step.", закінчення: ".$end."</h4><div class='arr'>");
			if ($start>$end) {
				for ($i = $start; $i >= $end; $i -= $step) 
					print $i.' ';
			}
			else
			{
				for ($i = $start; $i <= $end; $i += $step) 
					print $i.' ';
			}
			print("</div>");
		}
	?>
	<h3>Цикл 1.2</h3>
	<form method="post" action="index.php">
		Початок: <input type="text" name="start_1">
		Закінчення: <input type="text" name="end_1">
		Крок: <input type="text" name="step_1">
		<input type="submit" name="form2">
	</form>
	<?php 
		if (isset($_REQUEST['form2'])) {
		
			$start = $_POST["start_1"];
			$end = $_POST["end_1"];
			$step = $_POST["step_1"];

			if (isset($start) && isset($end) && isset($step) && $step!=0 && (($start < $end && $step>0) || ($start > $end && $step<0))) {
				print("<h4>Початок: ".$start.", крок: ".$step.", закінчення: ".$end."</h4><div class='arr'>");
				if ($start>$end) {
					for ($i = $start; $i >= $end; $i -= $step) 
						print $i.' ';
				}
				else
				{
					for ($i = $start; $i <= $end; $i += $step) 
						print $i.' ';
				}
				print("</div>");
				$id = 2;
				try
				{
					$sql = 'UPDATE `loop` SET `start`=:start, `end`=:ends, `step`=:step WHERE id=:id'; 
					
					$s = $pdo->prepare($sql);
					$s->bindValue(':start', $start);
					$s->bindValue(':ends', $end);
					$s->bindValue(':step', $step);
					$s->bindValue(':id', $id);
					$s->execute();
				}
				catch (PDOException $e)
				{
					exit('Error fetching data from db!'.$e);
				}
			}
			else
			{
				print("<div class='arr'>Введено не всі параметри або вони є не правильними!</div>");
			}
		}
		else 
		{
			$id = 2;
			try
			{
				$sql = 'SELECT * FROM  `loop` WHERE id=:id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':id', $id);
				$s->execute();
			}
			catch (PDOException $e)
			{
				exit('Error fetching data from db!'.$e);
			}
			$data = $s->fetch();
			$start = $data['start'];
			$end = $data['end'];
			$step = $data['step'];
			print("<h4>Початок: ".$start.", крок: ".$step.", закінчення: ".$end."</h4><div class='arr'>");
			if ($start>$end) {
				for ($i = $start; $i >= $end; $i -= $step) 
					print $i.' ';
			}
			else
			{
				for ($i = $start; $i <= $end; $i += $step) 
					print $i.' ';
			}
			print("</div>");
		}
	?>
	<h2>2.	Написати програми автоматичного формування таблиць з 2 лабораторної</h2>
	<h3>Таблиця 2.1</h3>
	<form method="post" action="index.php">
		Кількість рядків: <input type="text" name="number_rows">
		<input type="submit" name="form3">
	</form>
	<table border="1">
	<?php
		$number_rows;
		if (isset($_REQUEST['form3'])) {
		
			$number_rows = $_POST["number_rows"];

			if (isset($number_rows) && $number_rows>0) {
				$id = 1;
				try
				{
					$sql = 'UPDATE `table` SET `number_row`=:number_row WHERE id=:id'; 
					
					$s = $pdo->prepare($sql);
					$s->bindValue(':number_row', $number_rows);
					$s->bindValue(':id', $id);
					$s->execute();
				}
				catch (PDOException $e)
				{
					exit('Error fetching data from db!'.$e);
				}
			}
			else
			{
				print("<div class='arr'>Введено не всі параметри або вони є не правильними!</div>");
			}
		}
		else 
		{
			$id = 1;
			try
			{
				$sql = 'SELECT * FROM  `table` WHERE id=:id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':id', $id);
				$s->execute();
			}
			catch (PDOException $e)
			{
				exit('Error fetching data from db!'.$e);
			}
			$data = $s->fetch();
			$number_rows = $data['number_row'];
		}
		print("<h4>Кількість рядків: ".$number_rows."</h4>");
		for ($i = 0; $i < $number_rows; $i++) 
		{
			print "<tr>";
			if ($i != 0)
				print "<td rowspan='". ($number_rows - $i) ."'></td>";
			if ($i == $number_rows-1)
				$width = "width='28.6%'";
			print "<td colspan='". ($number_rows - $i) ."' ". $width ."></td></tr>";
		}
	?>
	</table>
	<h3>Таблица 2.2</h3>
	<form method="post" action="index.php">
		Кількість рядків: <input type="text" name="number_rows_1">
		<input type="submit" name="form4">
	</form>
	<table border="1">
	<?php 
		if (isset($_REQUEST['form4'])) {
		
			$number_rows = $_POST["number_rows_1"];

			if (isset($number_rows) && $number_rows>0) {
				$id = 2;
				try
				{
					$sql = 'UPDATE `table` SET `number_row`=:number_row WHERE id=:id'; 
					
					$s = $pdo->prepare($sql);
					$s->bindValue(':number_row', $number_rows);
					$s->bindValue(':id', $id);
					$s->execute();
				}
				catch (PDOException $e)
				{
					exit('Error fetching data from db!'.$e);
				}
			}
			else
			{
				print("<div class='arr'>Введено не всі параметри або вони є не правильними!</div>");
			}
		}
		else 
		{
			$id = 2;
			try
			{
				$sql = 'SELECT * FROM  `table` WHERE id=:id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':id', $id);
				$s->execute();
			}
			catch (PDOException $e)
			{
				exit('Error fetching data from db!'.$e);
			}
			$data = $s->fetch();
			$number_rows = $data['number_row'];
		}
		print("<h4>Кількість рядків: ".$number_rows."</h4>");
		for ($i = 0; $i < $number_rows; $i++) 
		{
			print "<tr><td rowspan='". ($number_rows+1 - $i) ."'></td>";
			if ($i != $number_rows-1)
				print "<td colspan='". ($number_rows-1 - $i) ."'></td>";
			print "</tr>";
		}
	?>
	</table>
	<h3>Таблица 2.3</h3>
	<form method="post" action="index.php">
		Кількість рядків: <input type="text" name="number_rows_2">
		
		<input type="submit" name="form5">
	</form>
	<table border="1">
	<?php 
		if (isset($_REQUEST['form5'])) {
		
			$number_rows = $_POST["number_rows_2"];

			if (isset($number_rows) && $number_rows>0) {
				$id = 3;
				try
				{
					$sql = 'UPDATE `table` SET `number_row`=:number_row WHERE id=:id'; 
					
					$s = $pdo->prepare($sql);
					$s->bindValue(':number_row', $number_rows);
					$s->bindValue(':id', $id);
					$s->execute();
				}
				catch (PDOException $e)
				{
					exit('Error fetching data from db!'.$e);
				}
			}
			else
			{
				print("<div class='arr'>Введено не всі параметри або вони є не правильними!</div>");
			}
		}
		else 
		{
			$id = 3;
			try
			{
				$sql = 'SELECT * FROM  `table` WHERE id=:id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':id', $id);
				$s->execute();
			}
			catch (PDOException $e)
			{
				exit('Error fetching data from db!'.$e);
			}
			$data = $s->fetch();
			$number_rows = $data['number_row'];
		}
		print("<h4>Кількість рядків: ".$number_rows."</h4>");
		for ($i = 0; $i < $number_rows; $i++) 
		{
			print "<tr>";
			if ($i % 2 == 1)
				print "<td></td>";
			for ($j = 0; $j < 3; $j++) 
				print "<td colspan='2' width='10%'></td>";
			if ($i % 2 == 0)
				print "<td></td>";
			print "</tr>";
		}
	?>
	</table>
	<h3>Таблица 2.4</h3>
	<form method="post" action="index.php">
		Кількість рядків: <input type="text" name="number_rows_3">
		<input type="submit" name="form6">
	</form>
	<table border="1">
	<?php 
		if (isset($_REQUEST['form6'])) {
		
			$number_rows = $_POST["number_rows_3"];

			if (isset($number_rows) && $number_rows>0) {
				$id = 4;
				try
				{
					$sql = 'UPDATE `table` SET `number_row`=:number_row WHERE id=:id'; 
					
					$s = $pdo->prepare($sql);
					$s->bindValue(':number_row', $number_rows);
					$s->bindValue(':id', $id);
					$s->execute();
				}
				catch (PDOException $e)
				{
					exit('Error fetching data from db!'.$e);
				}
			}
			else
			{
				print("<div class='arr'>Введено не всі параметри або вони є не правильними!</div>");
			}
		}
		else 
		{
			$id = 4;
			try
			{
				$sql = 'SELECT * FROM  `table` WHERE id=:id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':id', $id);
				$s->execute();
			}
			catch (PDOException $e)
			{
				exit('Error fetching data from db!'.$e);
			}
			$data = $s->fetch();
			$number_rows = $data['number_row'];
		}
		print("<h4>Кількість рядків: ".$number_rows."</h4>");
		for ($i = 0; $i < $number_rows; $i++) 
		{
			print "<tr>";
			if ($i == 0)
			{
				for($j = 5; $j<12;$j++) 
				{
					$height = ((($j%3)+1)*12.5);
					print '<td rowspan="'.(($j%3)+1).'"height="'.$height.'%"></td>';
				}
			}
			else 
			{
				if ($i < $number_rows-2)
				{
					if ($i % 3 != 0)
						print '<td rowspan="3"></td><td rowspan="3"></td>';
					else
						print '<td rowspan="3"></td><td rowspan="3"></td><td rowspan="3"></td>';
				}
				else
				{
					if ($i % 3 != 0)
						print '<td rowspan="'. ($number_rows - $i) .'"></td><td rowspan="'. ($number_rows - $i) .'"></td>';
					else
						print '<td rowspan="'. ($number_rows - $i) .'"></td><td rowspan="'. ($number_rows - $i) .'"></td><td rowspan="'. ($number_rows - $i) .'"></td>';
				}
			}
			print "</tr>";
		}
		
	?>
	</table>
</body>
</html>