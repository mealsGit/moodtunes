<?php
$myDatabase = mysqli_connect("localhost","mylevtjd","4ZyiWXj7K3-?6","mylevtjd_mydatabase");
$stmt = mysqli_prepare($myDatabase
  , "SELECT title, link FROM tunes WHERE volumeOption = ? AND tempoOption = ? AND complexityOption = ? AND keySignatureOption = ?"
) or die(mysqli_error($myDatabase));
mysqli_stmt_bind_param($stmt, 'ssss', $_GET['volume'], $_GET['tempo'], $_GET['complexity'], $_GET['key']);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $title, $link);
mysqli_stmt_fetch($stmt);
echo '{"title": "' . $title . '", "link": "' . $link . '"}';
mysqli_close($myDatabase);
?>