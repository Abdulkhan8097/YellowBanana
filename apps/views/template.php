<?php $sessionData = $this->session->userdata('sessionData');
$controllerName = $this->uri->segment(1); ?>
<?php $Aurl = array_reverse(explode("/", $_SERVER['REQUEST_URI']));
$page = $Aurl[0]; ?>
<?php /*if (isset($this->session->userdata['sessionMenuData'])) {
    $menuData = $this->session->userdata['sessionMenuData'];
} else { */
    $Object = &get_instance();
    $Object->load->model("menulist_model", "menu");
    $Object->menu->getMenuData();
    $menuData = $this->session->userdata['sessionMenuData'];
//}
?>


<!DOCTYPE HTML>
<html>
    <head>
<?php include_title(); ?>
        <?php include_metas(); ?>

<?php echo link_tag('assets/css/style.css'); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>

        <!--slider-->
        <?php echo link_tag('assets/css/bootstrap.css'); ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery-2.0.3.js"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script><script>var newj = jQuery.noConflict();</script>
        <script>var newj = jQuery.noConflict();</script>
        <script src="<?php echo base_url() ?>assets/js/jquery.fancybox.js?v=2.1.5"></script><script src="<?php echo base_url(); ?>assets/js/clock24.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/js/clock24.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/js/ebook-scripts.js" type="text/javascript"></script>
<?php echo link_tag('assets/css/jquery.fancybox.css?v=2.1.5'); ?>
        <script type="text/javascript">           
            $(document).ready(function()
            {
                var refreshId = setInterval( function()
                {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('connections/getNotificationData'); ?>",
                        success: function (data){
                            var obj = $.parseJSON(data);
		
                            //alert(obj['requestedNotifications']);
                            //alert(obj['requestedFriends']);
                            if(parseInt(obj['requestedNotifications']) > 0) {
                                $("#notification_count").fadeIn(300);
                                $("#notification_count").html(obj['requestedNotifications']);
                            }
                            if(parseInt(obj['requestedFriends']) > 0) {
                                $("#notification_count1").fadeIn(300);
                                $("#notification_count1").html(obj['requestedFriends']);
                            }
                        }
                    });
                }, 5500);
            });
            jQuery(document).ready(function($) {
                $('.fancybox').fancybox({
                    'height'        : '400px',
                    'width'			: '490px',
                    'scrolling'		: 'no',
                    'titleShow'		: false,
                    'closeClick'    : false, // prevents closing when clicking INSIDE fancybox
                    'helpers'       : {
                        overlay : {closeClick: false} // prevents closing when clicking OUTSIDE fancybox
                    }
                });
                $('.fancybox_update').fancybox({
			
                    maxWidth	: 530,
                    maxHeight	: 420,
                    width		: '70%',
                    height		: '70%',
			
                    helpers       : {
                        overlay : {closeClick: false} // prevents closing when clicking OUTSIDE fancybox
                    }
                });
            });
        </script>
        <script type="text/javascript" >
            $(document).ready(function()
            {
                $("#notificationLink").click(function()
                {
                    //alert("here is the code for notification display");

                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('connections/ajaxGetNotifications'); ?>",
                        success: function (data){
                            $("#notificationContainer").html(data);
                        }
                    });
                    $("#notificationContainer1").fadeOut("slow");
                    $("#notificationContainer2").fadeOut("slow");

                    // here we have to write function for seen unseen
                    $("#notificationContainer").fadeToggle(300);
                    $("#notification_count").fadeOut("slow");
                    return false;
                });

                //Document Click
                $(document).click(function()
                {
                    $("#notificationContainer").hide();
                });
                //Popup Click
                $("#notificationContainer").click(function()
                {
                    //return false
                });

            });
        </script>
        <script type="text/javascript" >
            $(document).ready(function()
            {
                $("#notificationLink1").click(function()
                {
                    //alert("here is the code for the friends requests");
                    // to display data

                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('connections/ajaxGetFriendsRequest'); ?>",
                        success: function (data){
                            $("#notificationContainer1").html(data);
                        }
                    });
                    $("#notificationContainer").fadeOut("slow");
                    $("#notificationContainer2").fadeOut("slow");
                    // to display data over
                    $("#notificationContainer1").fadeToggle(300);
                    $("#notification_count1").fadeOut("slow");
                    return false;
                });

                //Document Click
                $(document).click(function()
                {
                    $("#notificationContainer1").hide();
                });
                //Popup Click
                $("#notificationContainer1").click(function()
                {
                    //return false
                });

            });
        </script>
        <script type="text/javascript" >
            $(document).ready(function()
            {
                $("#notificationLink2").click(function()
                {
                    $("#notificationContainer1").fadeOut("slow");
                    $("#notificationContainer").fadeOut("slow");

                    $("#notificationContainer2").fadeToggle(300);
                    $("#notification_count2").fadeOut("slow");
                    return false;
                });

                //Document Click
                $(document).click(function()
                {
                    $("#notificationContainer2").hide();
                });
                //Popup Click
                $("#notificationContainer2").click(function()
                {
                    //return false
                });

            });
        </script>
<?php echo link_tag('assets/css/bootstrap.css'); ?>
    <?php echo link_tag('assets/css/prettyPhoto.css'); ?>
<?php echo link_tag('assets/css/social-icons.css'); ?>
        <?php echo link_tag('assets/css/ebook-style.css'); ?>
<?php echo link_tag('assets/font-awesome/css/font-awesome.min.css'); ?>

    </head>


<?php if (frontendLoginCheck(1)) { ?>
        <body class="UserDashboard">
<?php } else { ?>
        <body>
<?php } ?>

        <!-- Search Tab -->


        <div class="header">
            <div id="top_header">

                <div class="container">
<?php if (frontendLoginCheck(1)) {
            if ($controllerName != "") {
 ?>
                    <div class="user_section_left" style="margin-top:2px;">
                        <form name="searchform" id="searchform" method="post" onsubmit="return checkSearchValue();" action="<?php echo site_url("dashboard/searchSite"); ?>">
                        <?php $searchCri = $this->input->get("search"); ?>
                            <input type="text" name="search" id="search" value="<?php if ($searchCri != "") {
                        echo $searchCri;
                    } ?>" class="searchtext" placeholder=" People, Groups, Events , Knowledgebase and more... "><button type="submit" class="search-button"><i class="fa fa-search"></i></button>
                        </form>
                        <!-- Search Tab Over -->
                    </div>

                <?php }
            } ?>
                    <div class="user_section_right">

                            <?php if (frontendLoginCheck(1)) { ?>

                            <ul class="list-inline">
                                <li><a href="#" class="text-uppercase">
                                <?php if ($sessionData["userPicture"] != "") {
                                    echo img('assets/upload/users/' . $sessionData['userId'] . '/thumb120_' . $sessionData["userPicture"]);
                                } ?>
                            <?php echo ucwords($sessionData["userName"]); ?> </a></li>                               

                                <li id="notification_li2">
                                <!--<span id="notification_count2">2</span>-->
                                    <a href="#" id="notificationLink2" class="text-uppercase"><i class="fa fa-cog"></i> Settings</a>
                                    <div id="notificationContainer2">
<!--                                        <div id="notificationTitle2">Settings <a href="#" class="pull-right" style="color:#72ae20;">Help</a></div>-->
                                        <div id="notificationsBody2" class="notifications">
                                            <ul>
                                                <li>
                                                    <a href="<?php echo site_url('logout'); ?>">Logout ?</a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                    </li>

                                </ul>
                        <?php } else {
 ?>
                                <a href="<?php echo site_url('dashboard/register'); ?>"> &nbsp;Connect Now ! </a>
                                <a href="#">Welcome Guest ! </a>
<?php } ?>

                            <!--<?php //	if(frontendLoginCheck(1)){		 ?>
    		<a href="<?php //echo site_url('logout'); ?>"> &nbsp;Logout </a>
    		<a href="#">Welcome <?php //echo ucwords($sessionData["userName"]);  ?> ! </a>

<?php //if($friendRequests > 0){  ?>
    		<a style="margin-right:10px;" href="<?php //echo site_url("connections/viewInvitation");  ?>">
                            <span class="notification" id="totalNotification"><?php //echo $friendRequests;  ?></span> Notifications&nbsp;&nbsp;|</a>
<?php //}  ?>
<?php //	}else{		 ?>
    		<a href="<?php //echo site_url('dashboard/register');?>"> &nbsp;Connect Now ! </a>
		<a href="#">Welcome Guest ! </a> 		
<?php //	}		 ?>
		-->
                    </div>
                </div>
            </div>

            <div class="header-bottom">
                <div class="container">
                    <div class="logo">
                        <a href="<?php echo site_url(); ?>"><?php echo img('assets/images/' . SITE_LOGO); ?></a>
                    </div>

                    <div class="col_1_of_3 pull-right">
                        <p class="whether">
                    <?php //echo img('assets/images/weather.png');  ?> <!--Current Weather | --><?php //if(frontendLoginCheck(1)){ echo $sessionData["weatherMsg"];}else{ echo "Not Available";} ?><!--<br>-->
                    <?php echo img('assets/images/time.png'); ?> <span class="clock24s" id="clock24_14150" ></span>
                        </p>
                    </div>
                </div>
                <script type="text/javascript">
                    var clock24_14150 = new clock24('14150',-240,'%W, %M %dd, %yyyy &nbsp;%HH:%nn:%ss&nbsp; EDT');
                    //Wednesday, October 16, 2013 11:51:38clock24_14150.daylight('US'); clock24_14150.refresh();</script>
                <div style="clear: both; height: 0px;">&nbsp;</div>


            </div>
            <nav class="navbar navbar-inverse" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                        <ul class="nav navbar-nav navbar-right">

                            <?php if (frontendLoginCheck(1)) { ?>
                                <li id="notification_li1">
                                    <div id="notification_count1"></div>
                                    <a href="#" id="notificationLink1"><i class="fa fa-user"></i> Friend Request</a>
                                    <div id="notificationContainer1"></div>
                                </li>

                                <li id="notification_li">
                                    <div id="notification_count"></div>
                                    <a href="#" id="notificationLink"><i class="fa fa-globe"></i> Notification</a>
                                    <div id="notificationContainer"></div>
                                </li>
                            <?php } ?>


<?php if ($menuData['home']['status'] == 1) { ?>
                                <li <?php if ($controllerName == "" || $controllerName == "index.php") {
                                    echo 'class="active"';
                                } ?>><a href="<?php echo site_url(); ?>"><?php echo $menuData['home']['display_menu_name'] ?></a></li>
<?php } ?>

<?php if (frontendLoginCheck(1)) { ?>

<?php if ($menuData['profile']['status'] == 1) { ?>
                                    <li class="dropdown <?php if (($controllerName == "profile" || $page == "basic" || $page == "professional") && $page != "myaccount") {
                                        echo ' active';
                                    } ?>">
                                        <a href="<?php echo site_url('profile'); ?>"><?php echo $menuData['profile']['display_menu_name'] ?> </a>
                                    </li>
<?php } ?>

                                    <?php if ($menuData['storyclip']['status'] == 1) { ?>
                                    <li <?php if ($controllerName == "storyclip") { echo 'class="active"';} ?>>
                                        <a href="<?php echo site_url('storyclip'); ?>"><?php echo $menuData['storyclip']['display_menu_name'] ?></a>
                                    </li>
                                        <?php } ?>

                                    <?php if ($menuData['knowledgebase']['status'] == 1) { ?>
                                    <li <?php if ($controllerName == "knowledgebase") { echo 'class="active"'; } ?>>
                                        <a href="<?php echo site_url('knowledgebase'); ?>"><?php echo $menuData['knowledgebase']['display_menu_name'] ?></a>
                                    </li>
                                    <?php } ?>

                                    <?php if ($menuData['groups']['status'] == 1) { ?>
                                    <li <?php if ($controllerName == "groups") { echo 'class="active"'; } ?>>
                                        <a href="<?php echo site_url('groups'); ?>"><?php echo $menuData['groups']['display_menu_name'] ?></a>
                                    </li>
                                        <?php } ?>

                                    <?php if ($menuData['events']['status'] == 1) { ?>
                                    <li <?php if ($controllerName == "events") { echo 'class="active"';} ?>>
                                        <a href="<?php echo site_url('events'); ?>"><?php echo $menuData['events']['display_menu_name'] ?></a>
                                    </li>
                                    <?php } ?>

                                        <?php if ($menuData['settings']['status'] == 1) { ?>
                                                  <li <?php if ($page == "myaccount") { echo 'class="active"';} ?>>
                                                      <a href="<?php echo site_url('profile/myaccount'); ?>"><?php echo $menuData['settings']['display_menu_name'] ?></a></li>
                                            <?php }
                                                } ?>

                                                     <?php if ($menuData['business']['status'] == 1) { ?>
                                                    <li <?php if ($page == "businessservice") { ?> class="active" <?php } ?>><a href="<?php echo site_url("market/businessservice") ?>"><?php echo $menuData['business']['display_menu_name'] ?></a></li>
                                                    <?php } ?>

                                                    <?php if ($menuData['aboutus']['status'] == 1) { ?>
                                                    <li <?php if ($page == "aboutus") { ?> class="active" <?php } ?>><a href="<?php echo site_url("dashboard/aboutus") ?>"><?php echo $menuData['aboutus']['display_menu_name'] ?></a></li>
                                                    <?php } ?>
                                                    <?php if ($menuData['contactus']['status'] == 1) { ?>
                                                    <li <?php if ($page == "contactus") { ?> class="active" <?php } ?>><a href="<?php echo site_url("dashboard/contactus") ?>"><?php echo $menuData['contactus']['display_menu_name'] ?></a></li>
                                                    <?php } ?>
                                            </ul>
                                        </div>
                                        <!-- /.navbar-collapse -->
                                    </div>
                                    <!-- /.container -->
                                </nav>
                            </div>
                            <!------ Static Image ------------>
<?php
                            if ($controllerName == "") {
                               $this->load->view("searchTpl");
                            }
?>
                            <!------End Static Image ------------>
                                <?php echo $contents ?>
                                <?php echo $this->load->view('footerTpl'); ?>
                            <div style="display:none"><img src="<?php echo base_url("assets/images/default11.jpg"); ?>"></div>
                            <script>
                                function acceptInvitation(id,senderId){
                                    if(confirm("Are you sure?")){
                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo site_url('connections/ajaxAcceptInvitation'); ?>",
                                            data: {id: id,senderId:senderId},
                                            success: function (data){
                                                $("#showDiv_"+id).remove();
                                            }
                                        });
                                    }
                                }

                                function rejectInvitation(id,senderId){
                                    if(confirm("Are you sure?")){
                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo site_url('connections/ajaxRejectInvitation'); ?>",
                        data: {id: id,senderId:senderId},
                        success: function (data){
                            $("#showDiv_"+id).remove();
                        }
                    });
                }
            }
	
            function checkSearchValue(){
                searchVal = $("#search").val();
                if(searchVal == ""){
                    alert("Please enter search criteria");
                    return false;
                }
            }
        </script>

