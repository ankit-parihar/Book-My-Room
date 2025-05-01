<?php
session_start();
unset($_POST['number']);
unset($_POST['password']);
header("location:login.html");
?>