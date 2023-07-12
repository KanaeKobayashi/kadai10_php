<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign in</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body, html {
            height: 100%;
            margin: 0 auto;
            padding: 0;
        }
        .form-wrapper {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    
</style>
</head>
<body>
    <header>
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
          <a class="nav-link" href="sign-in.php">Sign In</a>
        </li>


      </ul>
    </div>
  </div>
</nav>
    </header>
    <div class="form-wrapper">
    <form class="text-center card" name="form2" action="user_registration_act.php" method="post">
    <div class="card-body">
    <h1 class="card-title"><img src="img/user.png" width="100px" alt="Sign up"/></h1>
    <p class="card-text"><input  class="form-control" type="text" name="name" required="required" placeholder="Your name" required autofocus></p>
    <p class="card-text"><input  class="form-control" type="email" name="email" required="required" placeholder="Your email" required autofocus></p>
    <p class="card-text"><input  class="form-control" type="text" name="nickName" required="required" placeholder="Your nick name" required autofocus></p>
    <p class="card-text"><input  class="form-control" type="text" name="lid" required="required" placeholder="Sign in ID" required></p>
    <p class="card-text"><input  class="form-control" type="password" name="lpw" required="required" placeholder="Password" required></p>
    <p class="card-text"><button type="submit" class="btn btn-primary" value="Registration" >Sign Up</button></p>
    </div>
</form>
</div>
</body>
</html>