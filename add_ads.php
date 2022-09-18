
<?
$user_id=$_GET['id'];
echo '<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Список дел</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h1>Список дел</h1>
    <form action="add.php?id='.$user_id.'" method="post">
      <input type="text" name="task" id="task" placeholder="Нужно сделать.." class="form-control">
      <button type="submit" name="sendTask" class="btn btn-success">Отправить</button>';
   echo '</form>
  </div>
</body>
</html>';
 require 'configDB.php';

      echo '<ul>';
      $sql = 'SELECT * FROM `tasks` WHERE `user_id`=? ORDER BY `id` DESC';
      $query = $pdo->prepare($sql);
      $query->execute([$user_id]);
      while($row = $query->fetch(PDO::FETCH_OBJ)) {
          echo '<li><b>'.$row->task.'</b><a href="delete.php?id='.$row->id.'&user_id='.$user_id.'"><button>Удалить</button></a></li>';
      }
      echo '</ul>';

?>
