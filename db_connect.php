<?php
// 1. DB接続します
try {
    $pdo = new PDO('mysql:dbname=kadai_PHP10;charset=utf8;host=localhost', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    exit('DBConnectError'.$e->getMessage());
  }


