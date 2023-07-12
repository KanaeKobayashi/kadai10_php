<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//1.  DB接続します
require_once('db_connect.php');

  // ２．データ取得SQL作成
  $stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
  $status = $stmt->execute();
  
  if ($status == false) {
    // execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
  }

// ファイルがアップロードされていることを確認
if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
    // 独自のエラーチェックを追加
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    // if (finfo_file($finfo, $_FILES['file']['tmp_name']) !== "text/csv") {
    //     die('Invalid file format uploaded. Please upload a CSV file.');
    // }
    finfo_close($finfo);

    // ファイルを一時的な場所からサーバーのターゲットディレクトリに移動
    $uploadedFile = $_FILES['file']['tmp_name'];
    $destination = 'uploads/' . $_FILES['file']['name'];
    move_uploaded_file($uploadedFile, $destination);


    // CSVファイルを開く
    $handle = fopen($destination, 'r');

    // CSVの各行を処理
    while (($data = fgetcsv($handle)) !== false) {
        $id = $data[0];
        $name = $data[1];
        $email = $data[2];
        $bookTitle = $data[3];
        $author = $data[4];
        $rating = $data[5];
        $comment = $data[6];
        $thumbnail = $data[7];
    
        // レコードが存在するかチェック
        $stmt = $pdo->prepare('SELECT * FROM gs_bm_table WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // レコードが存在すれば更新
            $sql = 'UPDATE gs_bm_table SET name = :name, email = :email, bookTitle = :bookTitle, author = :author, rating = :rating, comment = :comment,thumbnail = :thumbnail WHERE id = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':bookTitle', $bookTitle, PDO::PARAM_STR);
            $stmt->bindParam(':author', $author, PDO::PARAM_STR);
            $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
            $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
            $stmt->bindParam(':thumbnail', $thumbnail, PDO::PARAM_STR);
            $stmt->execute();
        } else {
            // レコードが存在しなければ追加
            $sql = 'INSERT INTO gs_bm_table (name, email, bookTitle, author, rating, comment,thumbnail, date) VALUES (:name, :email, :bookTitle, :author, :rating, :comment, :thumbnail, NOW())';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':bookTitle', $bookTitle, PDO::PARAM_STR);
            $stmt->bindParam(':author', $author, PDO::PARAM_STR);
            $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
            $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
            $stmt->bindParam(':thumbnail', $thumbnail, PDO::PARAM_STR);
            $stmt->execute();
        }
    }
    
    fclose($handle);
    echo 'CSVデータのインポートが完了しました。<br><a href="administrator.php">戻る</a>';
} else {
    echo 'CSVファイルのアップロードに問題が発生しました。<br><a href="administrator.php">戻る</a>';
}
?>