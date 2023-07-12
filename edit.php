<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id=$_GET['id'];

//funcs.phpを読み込む
require_once('funcs.php');
//1.  DB接続します
require_once('db_connect.php');

//2.データ表示
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //バインド変数をここでセット
$status = $stmt->execute();

if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
   $result = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>データ編集</title>
    <link
  href="https://unpkg.com/sanitize.css"
  rel="stylesheet"
/>
    <link rel="stylesheet" href="css/edit.css">
</head>
<body>
<form class="formWrapper" action="update.php" method="post">
        <label for="name">名前:<br><p><?=$result['name']?></p></label>
  
        <label for="bookTitle">おすすめの本のタイトル:<br><p><?=$result['bookTitle']?></p></label>

        <label for="author">本の著者:<br><p><?=$result['author']?></p></label>

        <label for="rating">オススメ度:</label>
            <div class="star-rating">
            <input type="radio" name="rating" id="rating5" value="5" <?= $result['rating'] == 5 ? 'checked' : '' ?> required><label for="rating5"></label>
            <input type="radio" name="rating" id="rating4" value="4" <?= $result['rating'] == 4 ? 'checked' : '' ?>><label for="rating4"></label>
            <input type="radio" name="rating" id="rating3" value="3" <?= $result['rating'] == 3 ? 'checked' : '' ?>><label for="rating3"></label>
            <input type="radio" name="rating" id="rating2" value="2" <?= $result['rating'] == 2 ? 'checked' : '' ?>><label for="rating2"></label>
            <input type="radio" name="rating" id="rating1" value="1" <?= $result['rating'] == 1 ? 'checked' : '' ?>><label for="rating1"></label>
            </div>
  
        <label for="comment">オススメコメント:</label>
            <textarea name="comment" id="comment"><?=$result['comment']?></textarea>
            <input type="hidden" name="id" value="<?= $result['id']?>">
            <input type="hidden" name="name" value="<?=$result['name']?>">
            <input type="hidden" name="bookTitle" value="<?=$result['bookTitle']?>">
            <input type="hidden" name="author" value="<?=$result['author']?>">
            <input type="hidden" name="email" value="<?=$result['email']?>">
  
        <input type="submit" value="更新">
        <input type="button" class="transparent-button" value="更新せずにオススメ一覧を見る" onclick="location.href='result.php'">
    </form>
</body>
</html>