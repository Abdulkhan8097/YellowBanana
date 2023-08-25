<?php $sessionData = $this->session->userdata('adminSession');  //print_r($sessionData);die; ?>
<!doctype html>
<html lang="en" dir="ltr">
  <head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<meta name="msapplication-TileColor" content="#ff685c">
		<meta name="theme-color" content="#32cafe">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<link rel="icon" href="favicon.ico" type="image/x-icon"/>
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/admin/images/favicon.ico');?>" />

		<!-- Title -->
		<?php include_title(); ?>
                <?php include_metas(); ?>
		<link rel="stylesheet" href="<?php echo base_url('assets/admin/fonts/fonts/font-awesome.min.css');?>">

		<!-- Font Family -->
		<link href="https://fonts.googleapis.com/css?family=Comfortaa:300,400,700" rel="stylesheet">

		<!-- Dashboard Css -->
		<link href="<?php echo base_url('assets/admin/css/dashboard.css');?>" rel="stylesheet" />

		<!-- c3.js Charts Plugin -->
		<link href="<?php echo base_url('assets/admin/plugins/charts-c3/c3-chart.css');?>" rel="stylesheet" />

		<!-- Custom scroll bar css-->
		<link href="<?php echo base_url('assets/admin/plugins/scroll-bar/jquery.mCustomScrollbar.css');?>" rel="stylesheet" />
                <!-- Morris.js Charts Plugin -->
		<link href="<?php echo base_url('assets/admin/plugins/morris/morris.css" rel="stylesheet');?>" />
                <!-- Sidemenu Css -->
		<link href="<?php echo base_url('assets/admin/plugins/toggle-sidebar/sidemenu.css');?>" rel="stylesheet" />


		<link href="<?php echo base_url('assets/admin/plugins/select2/select2.min.css');?>" rel="stylesheet" />

		<!---Font icons-->
		<link href="<?php echo base_url('assets/admin/plugins/iconfonts/plugin.css');?>" rel="stylesheet" />

  </head>
<?php //echo $sessionData['isAdminLoggedIn']; die; ?>
      <?php if(isset($sessionData['isAdminLoggedIn']) && $sessionData['isAdminLoggedIn']){ ?>
          <body class="app sidebar-mini rtl">
              <div id="global-loader" ></div>
              <div class="page">
                <div class="page-main">
           
        <?php $this->load->view('admin/topmenu'); ?>
        <?php if(LEFTPANEL){ ?>
        <?php $this->load->view('admin/leftpanel'); ?>
        <?php } ?>
        <?php }else{ ?>
            <body class="login-img">
        <?php } ?>