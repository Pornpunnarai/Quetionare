<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Use title if it's in the page YAML frontmatter -->
    <title>Sign In</title>

    <!-- Bootstrap core CSS -->
    <link href="/questionare/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
</head>

<body>
<div class="container">
    <form class="form-signin" method="post" action="check_login.php">
        <h2 class="form-signin-heading">Please Sign In</h2>

        <label for="txtEmail" class="sr-only">Email address</label>
        <input type="email" name="txtEmail" class="form-control" placeholder="Email address" required="required">

        <label for="txtPassword" class="sr-only">Password</label>
        <input type="password" name="txtPassword" class="form-control" placeholder="Password" required="required">


        <div class="input-group">
            <button type="submit" name="submit" class="btn btn-lg btn-primary btn-block"> LOGIN </button>
        </div>

    </form>
</div>
</body>
</html>