<span style="font-family: verdana, geneva, sans-serif;">
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <title>Login form</title>

    <link rel="stylesheet" href="../css/signin.css">
  </head>

  <body>

    <nav>

      <a href="galler-E.html">Galler-E</a>

    </nav>

    <div class="wrapper">
      <h1>Sign In</h1>
      <p>Welcome back you've <br> been missed!</p>

      <form action="2loginLogic.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">

        <button type="submit" name="submit">Sign in</button>

      </form>

      <div class="not-member">
        Not a member? <a href="1sign_up.php">Register Now</a>
      </div>
    </div>
  </body>

  </html>
</span>