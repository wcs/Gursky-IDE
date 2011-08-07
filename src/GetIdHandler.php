<?php
    $id = uniqid('id');
    session_name($id);
    session_start();
    $_SESSION['value'] = 0;
    echo $id;

?>
