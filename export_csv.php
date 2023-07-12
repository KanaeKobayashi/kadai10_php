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

require_once('db_connect.php');

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="export.csv"');

//2. データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
} else {
    $file = fopen('php://output', 'w');
    // ヘッダー行を追加
    fputcsv($file, array('id','名前', 'Eメール', '本のタイトル', '著者', '評価', 'コメント'));

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // データをCSVファイルに書き込む
        fputcsv($file, $row);
    }
    fclose($file);
}
}
?>



