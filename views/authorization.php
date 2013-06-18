<!DOCTYPE html>
<html>
  <head>
    <title>Agileit authorization</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="/css/giggle.css" rel="stylesheet" media="screen">
    <link href="/css/signin.css" rel="stylesheet" media="screen">

    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/main.js"></script>
  </head>
  <body>
  <div class="alert-holder"></div>

  <div class="container">
    <h1>Agile IT!</h1>

    <form class="form-signin" action="/authorization" method="POST" id="authForm">
      <h2 class="form-signin-heading">Please sign in</h2>
      <input type="text" class="input-block-level" placeholder="Email address" name="email">
      <input type="password" class="input-block-level" placeholder="Password" name="password">
      <label class="checkbox">
        <input type="checkbox" value="remember-me"> Remember me
      </label>
      <button class="btn btn-large btn-inverse" type="submit">Sign in</button>
    </form>

  </div>
  <script src="/js/authorization.js"></script>

  <script type="text/template" id="alert-error">
    <div class="alert alert-error fade">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <span></span>
    </div>
  </script>
  
  <script type="text/template" id="alert-success">
    <div class="alert alert-success fade">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <span></span>
    </div>
  </script>
  </body>
</html>