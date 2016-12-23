<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="main.css" media="screen" title="no title" charset="utf-8">
  <title>Lab 6</title>
</head>
<body>
  <h2>Запустить цикл:</h2>
  <form action="./controllers/loop.php" method="post">
    Начальное значение
    <input type="text" name="start"><br/>

    Конечное значение
    <input type="text" name="end"><br/>

    Шаг цикла
    <input type="text" name="step"><br/>
    <input type="submit" name="submit" value="Запустить">
  </form>

  <h2>Построить таблицу:</h2>
  <form action="./controllers/table.php" method="post">
    Количество строк
    <input type="text" name="rows"><br/>

    Количество столбцов
    <input type="text" name="cols"><br/>

    Номер таблицы
    <select name="tableID">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select><br/>
    <input type="submit" name="submit" value="Построить">
  </form>
</body>
</html>
