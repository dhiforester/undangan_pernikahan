<?php
    $password = "dhiforester";
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    echo $hashedPassword;
?>