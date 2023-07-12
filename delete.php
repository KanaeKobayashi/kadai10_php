<?php
// DB接続します
require_once('db_connect.php');

// パラメータから削除対象のIDを取得
$id = $_GET['id'];

// 指定されたIDのデータを取得
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();

// データが存在する場合は削除の確認画面を表示
if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $name = $row['name'];
    $email = $row['email'];
    $bookTitle = $row['bookTitle'];
    $author = $row['author'];
    $rating = $row['rating'];
    $comment = $row['comment'];
} else {
    echo '該当するデータが見つかりません。';
    exit;
}

// 削除の確認が得られた場合はデータベースから該当する行を削除
if (isset($_POST['confirm'])) {
    $stmt = $pdo->prepare("DELETE FROM gs_bm_table WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    echo '<script>
    alert("データを削除しました。");
    window.location.href = "index.php";
    </script>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>削除</title>

    <link rel="stylesheet" href="/css/delete.css">
</head>
<body>
    <div class="container" style="padding-left:20px">
        <h1>削除の確認</h1>
        <p style="color:#ff0000">以下のデータを削除します。よろしいですか？</p>
        <div style="padding-left: 20px;">
            <p>名前: <?php echo $name; ?></p>
            <p>Eメール: <?php echo $email; ?></p>
            <p>本のタイトル: <?php echo $bookTitle; ?></p>
            <p>著者: <?php echo $author; ?></p>
            <p>評価: <?php echo $rating; ?></p>
            <p>コメント: <?php echo $comment; ?></p>
        </div>
    
        <form action="" method="POST" id="delete-form">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="confirm" value="削除する">
        </form>
        <a href="index.php" class="back-button">戻る</a>
    </div>
    
</body>
</html>
