<?php
//1.  DB接続します
require_once('db_connect.php');
ini_set('display_errors', 1);

// フォームデータの受け取り
$name = $_POST['name'];
$email = $_POST['email'];
$nickName = $_POST['nickName'];
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];

// データの保存
$sql = "INSERT INTO gs_user_table (name, email, nickName, lid, lpw, date) VALUES (:name, :email, :nickName, :lid, :lpw, NOW())";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':name', $name, PDO::PARAM_STR);
  $stmt->bindParam(':email', $email, PDO::PARAM_STR);
  $stmt->bindParam(':nickName', $nickName, PDO::PARAM_STR);
  $stmt->bindParam(':lid', $lid, PDO::PARAM_STR);
  $stmt->bindParam(':lpw', $lpw, PDO::PARAM_STR);
  $stmt->execute();

// サインアップが成功したら、セッション変数 'just_signed_up' を true に設定
  $_SESSION['just_signed_up'] = true;

// POST処理の最後にリダイレクト処理
   header('Location: thankyou.php');
   exit();

