<?php
$link=mysqli_connect("localhost", "root", "root", "to_do");
$id = $_GET['id'];
$user_id = $_GET['user_id'];
mysqli_query($link, " DELETE FROM tasks WHERE id='".$id."'");
header("Location: add_ads.php?id=$user_id"); exit();
?>
