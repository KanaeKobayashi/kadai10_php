<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank you</title>
    <link rel="stylesheet" href="./css/write.css">
</head>
<body>
<div class="message">
    <p class="comment">登録が完了しました。<br> ありがとうございました！<br></p>
    <a href="index.php" class="back-button">Home<br></a>
    <?php
        // セッションを開始する
        session_start();

        // ユーザーがサインインしていれば、フォームへ戻るリンクとサインアウトボタンを表示する
        if (isset($_SESSION['user_id'])) {
            echo "<a href='form.php' class='back-button'>再度書く</a>";
            echo "<a href='signOut.php' class='back-button'>Sign Out</a>";
        } else {
            // ユーザーがサインインしていなければ、サインインボタンを表示する
            echo "<a href='sign-in.php' class='back-button'>Sign In へ</a>";
        }
    ?>
  </div>
</body>
</html>