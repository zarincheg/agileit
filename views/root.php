<!DOCTYPE html>
<html>
  <head>
    <title>Giggle dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="/css/giggle.css" rel="stylesheet" media="screen">

    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/main.js"></script>
    <script src="/dashboard.js"></script>
    <script src="/backlog.js"></script>
    <script src="/stream.js"></script>
    <script src="/settings.js"></script>
    <script src="/task.js"></script>
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a href="/settings" class="pull-right">
            <img src="/img/settings_1.png" class="img-circle" style="height: 30pt; width: 30pt;">
          </a>
        <ul class="nav main-nav">
          <li><a href="/dashboard">Dashboard</a></li>
          <li><a href="/branches">Branches</a></li>
          <li><a href="/backlog">Backlog</a></li>
          <li><a href="/stream">Stream</a></li>
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