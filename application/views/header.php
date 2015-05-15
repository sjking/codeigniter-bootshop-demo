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

    <!-- JQuery -->
    <script src="<?php echo base_url('assets/js/jquery-1.11.3.js') ?>"></script>

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