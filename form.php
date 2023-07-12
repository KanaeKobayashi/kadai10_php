<?php

// スクリプトの開始時にセッションを開始
session_start();

require_once('funcs.php');
$pdo = db_conn();

// セッション変数 'just_signed_up' が設定されていれば、サインインページにリダイレクト
if (isset($_SESSION['just_signed_up'])) {
    header('Location: sign-in.php');
    exit;
}
// まずはセッションからユーザーIDを取得
$user_id = $_SESSION['user_id'];

// そのユーザーIDを用いて、データベースからユーザー情報を取得
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id = :user_id");
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$user_info = $stmt->fetch(PDO::FETCH_ASSOC);

// ユーザー情報が取得できなければ、ログインページにリダイレクト
if (!$user_info) {
  header('Location: sign-in.php');
  exit;
}

// 名前とメールアドレスをセッションに保存
$_SESSION['name'] = $user_info['name'];
$_SESSION['email'] = $user_info['email'];

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

if ($status == false) {
  // execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
} else {
  while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // フォームデータの受け取り、特殊文字をHTMLエンティティに変換
    $name = isset($_POST['name']) ? h($_POST['name']) : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    if (preg_match('/[^\\x01-\\x7E]/', $email)) {
        echo 'メールアドレスには全角文字を使用できません。';
        exit;
    }
    $bookTitle = isset($_POST['bookTitle'])? h($_POST['bookTitle']) : '';
    $author = isset($_POST['author'])? h($_POST['author']) : '';
    $rating = isset($_POST['rating']) ? h($_POST['rating']) : '';
    $comment = isset($_POST['comment']) ? h($_POST['comment']) : '';
    $thumbnail = isset($_POST['thumbnail'])? h($_POST['thumbnail']) : '';

    // 評価を整数に変換
    $rating = intval($rating);

    // データの保存
    $sql = "INSERT INTO gs_bm_table (name, email, bookTitle, author, rating, comment, thumbnail,date) VALUES (:name, :email, :bookTitle, :author, :rating, :thumbnail ,:comment, NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':bookTitle', $bookTitle, PDO::PARAM_STR);
    $stmt->bindParam(':author', $author, PDO::PARAM_STR);
    $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindParam(':thumbnail', $thumbnail, PDO::PARAM_STR);
    $stmt->execute();

    echo 'オススメの本が送信されました。ありがとうございました！';
}
?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recommended Book</title>
    <link
  href="https://unpkg.com/sanitize.css"
  rel="stylesheet"
/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

<link rel="stylesheet" href="./css/style.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    
    <header>
         <!-- nav bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#">Recommend Books</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">

        <li class="nav-item">
          <a class="nav-link active" href="signOut.php">Sign Out</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <h1 class="title">あなたのオススメの本を教えてください
    <button id="searchButton" onclick="window.location.href = 'search.php' "style="border-radius: 50%; border: none; padding:2px;background-color:white;"><span class="material-symbols-outlined">
search
</span></button>
    </h1>
    </header>
    <form class="formWrapper" action="write.php" method="post">

        <label for="bookTitle">おすすめの本のタイトル:</label>
            <input type="text" name="bookTitle" id="bookTitle" placeholder="本のタイトル" required><br>

            <label for="author">本の著者:</label>
            <input type="text" name="author" id="author" placeholder="著者" required><br>
        </div>
        <label for="thumbnail">Thumbnail URL:</label>
        <input type="text" id="thumbnail" name="thumbnail">
        <label for="rating">オススメ度:</label>
            <div class="star-rating">
                <input type="radio" name="rating" id="rating5" value="5" required><label for="rating5"></label>
                <input type="radio" name="rating" id="rating4" value="4"><label for="rating4"></label>
                <input type="radio" name="rating" id="rating3" value="3"><label for="rating3"></label>
                <input type="radio" name="rating" id="rating2" value="2"><label for="rating2"></label>
                <input type="radio" name="rating" id="rating1" value="1"><label for="rating1"></label>
            </div>
  
        <label for="comment">オススメコメント:</label>
            <textarea name="comment" id="comment" placeholder="こんなところがオススメというところを紹介してね" required></textarea><br>
  
            <label for="name">名前:</label>
            <input type="text" name="name" id="name" placeholder="関東太郎" value="<?php echo $_SESSION['name']; ?>"required><br>
  
            <label for="email">Eメール:</label>
            <input type="email" name="email" id="email" placeholder="abc@example.com" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" value="<?php echo $_SESSION['email']; ?>"required><br>
        <div id="selectionResult">

        <input type="submit" value="送信">
        <input type="button" class="transparent-button" value="オススメ一覧を見る" onclick="location.href='result.php'">
    </form>


    <script>

    // ページ読み込み時にローカルストレージから選択した本の情報を読み込む
    const selectedTitle = localStorage.getItem('selectedTitle');
        const selectedAuthor = localStorage.getItem('selectedAuthor');
        const selectedThumbnail = localStorage.getItem('selectedThumbnail');
        if (selectedTitle && selectedAuthor && selectedThumbnail) {
            const selectedTitleElement = document.getElementById('bookTitle');
            const selectedAuthorElement = document.getElementById('author');
            const selectedThumbnailElement = document.getElementById('thumbnail');
            selectedTitleElement.value = selectedTitle;
            selectedAuthorElement.value = selectedAuthor;
            selectedThumbnailElement.value = selectedThumbnail; 
            // ローカルストレージの情報を削除
            localStorage.removeItem('selectedTitle');
            localStorage.removeItem('selectedAuthor');
            localStorage.removeItem('selectedThumbnail'); 
        }

        // 選択された本の情報をローカルストレージに保存
        function selectBook(title, authors ,thumbnail) {
            localStorage.setItem('selectedTitle', title);
            localStorage.setItem('selectedAuthor', authors);
            localStorage.setItem('selectedThumbnail', thumbnail); 
            // 元のページに戻る
            window.location.href = 'write.php';
        }

        // サーチページから選択された本の情報を取得
        const searchParams = new URLSearchParams(window.location.search);
        const selectedTitleParam = searchParams.get('title');
        const selectedAuthorParam = searchParams.get('author');
        const selectedThumbnailParam = searchParams.get('thumbnail');
        if (selectedTitleParam && selectedAuthorParam) {
            // 選択された本の情報をフォームに表示
            const selectedTitleElement = document.getElementById('bookTitle');
            const selectedAuthorElement = document.getElementById('author');
            const selectedThumbnailElement = document.getElementById('thumbnail');
            selectedTitleElement.value = selectedTitleParam;
            selectedAuthorElement.value = selectedAuthorParam;
        }

   
</script>

</body>
</html>
