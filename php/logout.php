<?php

    $host  = $_SERVER['HTTP_HOST'];

	$login_page = '../html/login.html';

    session_start();
    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

    header("Location: http://$host$uri/$login_page");

    session_destroy();
    exit;
?>