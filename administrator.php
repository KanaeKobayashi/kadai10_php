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
    header("Location: index.php"); // または適切な非管理者ユーザー向けのページにリダイレクトしてください。
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
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="./css/admin.css">

</head>
<body>
<div class="admin-menu">
    <h1>管理者画面</h1>
    <li><a href="signOut.php" class="back-button">ログアウトしてホームに戻る<br></a></li>
    <li><a href="totalling.php" class="back-button">集計結果を表示する<br></a></li>
    <li><a href="resultAdmin.php" class="back-button">データリスト</a></li>
    <li> <a href="export_csv.php" class="back-button">CSVをダウンロードする</a></li>
    <li> <a href="import_csv.php" class="back-button">CSVをインポートする</a></li>
    </div>
</body>
</html>