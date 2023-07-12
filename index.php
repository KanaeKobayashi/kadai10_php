<?php
include 'db_connect.php';
include 'funcs.php';

// データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table ORDER BY id DESC LIMIT 15");
$status = $stmt->execute();

if ($status == false) {
  // execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}

// データ取得
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="js/bootstrap.js"></script>
    <style>
        .hero{
            background-image: url("img/cat2.png");
            width: 100%;
            background-size: cover;
            background-attachment: fixed;
            position: relative;
            z-index: 2;
        }
        .hero::after{
            content:"";
            position: absolute;
            width: 100%;
            height: 100%;
            top:0;
            left: 0;
            background-color: rgba(37,39,71,0.5);
            z-index: -1;
        }
        .card-img-top {
        height: 50%;   
        object-fit: contain;  
    }
        
   
  .form-container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 2rem;
  }
  
  .form-container .form-outline {
    margin-bottom: 1.5rem;
  }
  
  .card-img-top-custom {
    height: 40%;
    object-fit: contain;  
  }
        
    </style>
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
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#services">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="signUp.php">Join US</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
</header>
<!-- hero -->
<div class='hero vh-100 d-flex align-items-center' id="home" 
style="
background-position:center; 
background-size:cover;
background-attachment:fixed">
<div class="container">
    <div class="row">
        <div class= "col-lg-7 mx-auto ">
            <h1 class="display-4"  style="color:wheat;">Recommend Books</h1>
            <p style="color: wheat;">
            Books are mirrors. <br>You only see in them what you already have inside you.
            </p>
            <a href="sign-in.php" class="btn btn-primary">Sign In</a>
            <a href="#contact" class="btn btn-secondary">Contact us</a>
        </div>
        </div>
        </div>

    </div>
        <section id="services" style="padding-top:80px">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto text-center">
                    <h6>SERVICES</h6>
                    <h1>services</h1>
                    <p>自分のお気に入りの本を勧めましょう。
                    </p>
                </div>
            </div>
                <div class="row row-cols-1 row-cols-md-5 g-4">
                <?php foreach($books as $book): ?>
                <div class="col">
                <div class="card h-100">
                <img src="<?= htmlspecialchars($book['thumbnail'], ENT_QUOTES, 'UTF-8'); ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <div class="card-header"><?= $book['bookTitle']; ?></div>
                    <div class="card-body text-secondary">
                    <p class="card-text"><?= $book['comment']; ?></p>
                    </div>
                    </div>
                </div>
                </div>
            <?php endforeach; ?>
            </div>
            </div>
 
  <div class="form-container">
  <div id="contact" class="col-md-8 mx-auto text-center">
    <h6 >Contact</h6>
    <h1 >Contact us</h1>
    <p>お問い合わせはこちらから</p>
  </div>
  <form style="width: 50%;">
  <!-- Name input -->
  <div class="form-outline">
      <input type="text" id="form5Example1" class="form-control" placeholder="関東花子"/>
      <label class="form-label" for="form5Example1">Name</label>
    </div>

  <!-- Email input -->
  <div class="form-outline">
      <input type="email" id="form5Example2" class="form-control"placeholder="abc@example.com" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required />
      <label class="form-label" for="form5Example2">Email address</label>
    </div>

  <!-- Checkbox -->
    <div class="form-check d-flex justify-content-center">
      <input class="form-check-input me-2" type="checkbox" value="" id="form5Example3" checked />
      <label class="form-check-label" for="form5Example3">I have read and agree to the terms</label>
    </div>

  <!-- Submit button -->
    <div class="d-flex justify-content-center" style="padding-top:20px">
      <button type="submit" class="btn btn-primary">Subscribe</button>
    </div>
  </form>
  </div>     
  <footer class="" style="padding-top:20px;">
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2023 Copyright:
      <a class="text-dark" href="">Kanae</a>
    </div>
  </footer>


</body>
</html>
