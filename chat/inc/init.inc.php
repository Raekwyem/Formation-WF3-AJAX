<?php
$pdo = new PDO('mysql:host=localhost;dbname=chat', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// on lance une session
session_start();