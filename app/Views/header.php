
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title><?= SITETITLE ?></title>
    
    <link href="<?= DIR ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= DIR ?>/assets/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="<?= DIR ?>/assets/css/starter.css" rel="stylesheet">

  </head>
  
  <body>
  
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?= DIR ?>">Babita framework</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?= DIR ?>">Home</a></li>
            <li><a href="<?= DIR ?>/home/teste/param1/param2/param3">Url com parâmetros</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>