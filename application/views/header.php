<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="shortcut icon" href="../../assets/ico/favicon.ico">-->

    <title><?php echo $title ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/bootstrap-theme.min.css') ?>" rel="stylesheet">

    <?php if(isset($styleSheets)){ ?>
      <?foreach ($styleSheets as $css):?>
        <link href="<?php echo base_url("assets/css/{$css}") ?>" rel="stylesheet">
      <?endforeach?>
    <?php } ?>

    <link href="<?php echo base_url('assets/css/sticky-footer.css') ?>" rel="stylesheet">

    <!-- JQuery -->
    <script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js') ?>"></script>

    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
    
    <?php if(isset($javaScript)){ ?>
      <?foreach ($javaScript as $js):?>
        <script src="<?php echo base_url("assets/js/{$js}") ?>"></script>
      <?endforeach?>
    <?php } ?>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div id="wrap">
      <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            <a class="navbar-brand" href="<?= base_url() ?>">CodeIgniter Bootshop</a>
          </div>
          <div class="navbar-collapse collapse" id="navbar">
         
            <ul class="nav navbar-nav navbar-right">
              <li><a href="<?= base_url('contents') ?>">Contents</a></li>
              <li><a href="#">About</a></li>

            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </nav>

      <div class="container">
    