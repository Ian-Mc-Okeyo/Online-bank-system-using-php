<?php
    session_start();
    session_destroy();
    session_unset();
    unset($_SESSION['logged_in']);
    $logged_in=FALSE;
    
?>
<DOCTYPE html>
<html>
    <?php include "header.php"?>
    <br>
    <br>
    <br>
    <br>
    <div class='home-page-container' >
        <div style="order: 1;"><h1>THE G7 BANK</h1></div>
        <div style="order: 2;"><img src="static/g7.png" class='logo'></div>
        <div style="order: 3;"><h3 style="color:rgb(9, 91, 199);">Be Your Own Financial $ Star $ </h3></div>
    </div>
</body>
</html>