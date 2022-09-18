<?php
  $task = $_POST['task'];
  $user_id=$_GET['id'];
  if($task == '') {
    echo 'Введите само задание';
    exit();
  }
$link=mysqli_connect("localhost", "root", "root", "to_do");
mysqli_query($link,"INSERT INTO tasks SET user_id='".$user_id."',task='".$task."'");
header("Location: add_ads.php?id=$user_id"); exit();

?>
