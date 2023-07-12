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
    <title>CSV Import</title>
    <link rel="stylesheet" href="./css/admin.css">
    <style>
        input[type="file"]{
            width: 285px;
            padding: 10px 20px;
            background-color: #0056b3; 
            border: none;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
            border-radius: 5px;
        }
        input[type="submit"] {
            width: 320px;
            padding: 10px 20px;
            background-color: #0056b3; 
            border: none;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
            border-radius: 5px;
        }
        input[type="file"]:hover,
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        
    </style>
</head>
<body>
<div class="admin-menu">
    <h1>CSV Import</h1>
    <form action="process_import.php" method="post" enctype="multipart/form-data">
        <!-- <label id="custom-file-upload" for="file" class="custom-file-upload">CSVファイルを選択:</label> -->
        <input type="file" id="file" name="file" accept=".csv" ><br><br>
        <input type="submit" value="Upload CSV">
    </form>
    <a href="administrator.php" class="back-button">戻る</a>
</div>
<script>
  
  actualBtn.addEventListener('change', function(){
    fileChosen.textContent = this.files[0].name
  })
</script>
</body>
</html>