<?php
//1.  DB接続します
require_once('db_connect.php');
ini_set('display_errors', 1);

// フォームデータの受け取り
$id = $_POST['id']; 
$name = $_POST['name'];
$email = $_POST['email'];
$bookTitle = $_POST['bookTitle'];
$author = $_POST['author'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];

//コメントの長さを確認する(500文字以内)
if (strlen($comment)>500){
    echo 'コメントは500文字以下にしてください';
    exit();
}

// データの保存
$sql = "UPDATE gs_bm_table SET name=:name, email=:email, bookTitle=:bookTitle, author=:author, rating=:rating, comment=:comment, date=NOW() WHERE id=:id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->bindParam(':name', $name, PDO::PARAM_STR);
  $stmt->bindParam(':email', $email, PDO::PARAM_STR);
  $stmt->bindParam(':bookTitle', $bookTitle, PDO::PARAM_STR);
  $stmt->bindParam(':author', $author, PDO::PARAM_STR);
  $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
  $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
  $stmt->execute();

   // POST処理の最後にリダイレクト処理
  header('Location: thankyou.php');
exit();

?>