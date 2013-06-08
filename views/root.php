<!DOCTYPE html>
<html>
  <head>
    <title>Agileit dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="/css/giggle.css" rel="stylesheet" media="screen">

    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/main.js"></script>
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <span class="brand">Current project:</span>
          <a href="/settings" class="pull-right">
            <img src="/img/settings_1.png" class="img-circle" style="height: 30pt; width: 30pt;">
          </a>
          <ul class="nav main-nav">
            <li><a href="/dashboard">Dashboard</a></li>
            <li><a href="/branches">Branches</a></li>
            <li><a href="/backlog">Backlog</a></li>
            <li><a href="/stream">Stream</a></li>
            <li><a href="/settings">Settings</a></li>
          </ul>

          <ul class="nav pull-right">
            <li class="navbar-text">Kirill Zorin</li>
            <li class="divider-vertical"></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Projects <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">35cm</a></li>
                <li><a href="#">Agileit</a></li>
                <li class="divider"></li>
                <li><a href="#">New project</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="alert-holder"></div>
    
    <?php echo $content; ?>

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