<?php
// 0. SESSION開始！！
session_start();

//１．関数群の読み込み
require_once('funcs.php');
// funcs.phpで入れた関数を呼び出す
loginCheck();

// 管理者フラグの確認
if($_SESSION['kanri_flg']!=1){
    // リダイレクト処理
    header("Location: form.php"); // または適切な非管理者ユーザー向けのページにリダイレクトしてください。
    exit(); // 必ずリダイレクト後はexit()を入れる
} else {
    //２．データ登録SQL作成
    $pdo = db_conn();
    $stmt = $pdo->prepare('SELECT * FROM gs_bm_table');
    $status = $stmt->execute();

    //３．データ表示
    $view = '';
    if ($status == false) {
        sql_error($stmt);
    } else {
        while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $view .= '<p>';
            $view .= '<a href="detail.php?id=' . $r["id"] . '">';
            $view .= h($r['id']) . " " . h($r['name']) . " " . h($r['email']);
            $view .= '</a>';
            $view .= "　";
            $view .= '</p>';
        }
    }
}
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>List for Administrator</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./css/result.css">
  <style>
    .center-table {
        width: 100%;
        margin-top: 50px;
    }
    .name{
    width: 120px;
}
  </style>
</head>
<body>
<?php
if ($stmt->rowCount() > 0) {
  // 表の開始を表示
  echo '<table border="1" class="center-table">';
  echo '<tr><th>id</th><th>名前</th><th>email</th><th>本のタイトル</th><th>著者</th><th>評価</th><th>コメント</th><th>編集</th><th>削除</th></tr>';

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $id = $row['id'];
    $email = $row['email'];
    $name = $row['name'];
    $bookTitle = $row['bookTitle'];
    $author = $row['author'];
    $rating = $row['rating'];
    $comment = $row['comment'];
    $id = $row['id'];


    // データの表示
    echo '<tr>';
    echo '<td>' . $id . '</td>';
    echo '<td class="name">' . $name . '</td>';
    echo '<td>' . $email . '</td>';
    echo '<td>' . $bookTitle . '</td>';
    echo '<td>' . $author . '</td>';
    echo '<td>' . $rating . '</td>';
    echo '<td>' . $comment . '</td>';
    echo '<td><a href="edit.php?id=' . $id . '"><span class="material-symbols-outlined">
    edit
    </span></a></td>';
    echo '<td><a href="delete.php?id=' . $id . '"><span class="material-symbols-outlined">
    delete
    </span></a></td>';
    echo '</tr>';
  }
  // 表の終了を表示
  echo '</table>';
} else {
  echo 'まだアンケートがありません。';
}
?>


<a href="index.php" class="back-button">戻る</a>
<a href="totalling.php" class="back-button">集計結果を表示する</a>
</body>
</html>



