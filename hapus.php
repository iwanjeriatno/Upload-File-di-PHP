<?php

    include_once 'ConnectDB.php';

    $id = $_GET['id'];

    $sql = "DELETE FROM files WHERE id='$id' ";

    if($connect->query($sql))
        header('Location: index.php');

 ?>
