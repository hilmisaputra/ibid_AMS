<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive admin dashboard and web application ui kit. ">
    <meta name="keywords" content="blank, starter">

    <title><?php echo $title; ?> &mdash; IBID AMS</title>

    <!-- Fonts -->
    <link href="//fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i" rel="stylesheet">

    <!-- Styles -->
    <link href="<?php echo base_url('assets/css/core.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/app.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/style.min.css') ?>" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="<?php echo base_url('assets/img/apple-touch-icon.png'); ?>">
    <link rel="icon" href="<?php echo base_url('assets/img/favicon.png'); ?>">
    <style type="text/css">
        .dtp-time{
            background: #926dde !important;
        }
        .dtp-header{
            background: #694ea3 !important;
        }
        .btn-add{
            margin-bottom: 1%;
        }
    </style>
  </head>

  <body>

    <!-- Preloader -->
    <div class="preloader">
      <div class="spinner-dots">
        <span class="dot1"></span>
        <span class="dot2"></span>
        <span class="dot3"></span>
      </div>
    </div>

    <?php isset($content_sidebar) ? $this->load->view($content_sidebar) : ''; ?>
    <?php isset($content_topbar) ? $this->load->view($content_topbar) : ''; ?>
	
	<!-- Main container -->
		<main>
			<div class="main-content">
				<?php $this->load->view($content); ?>
			</div>

    <?php isset($content_footer) ? $this->load->view($content_footer) : ''; ?>

		</main>
	<!-- END Main container -->

    <!-- Scripts -->
    <script src="<?php echo base_url('assets/js/core.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/app.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/script.min.js')?>"></script>
    <?php isset($content_script) ? $this->load->view($content_script) : ''; ?>
    <?php isset($content_modal) ? $this->load->view($content_modal) : ''; ?>
