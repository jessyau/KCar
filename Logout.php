<?php

session_start();
session_destroy();
$home_url = 'Login.html';
header('Location: ' . $home_url);

?>