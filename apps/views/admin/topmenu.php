<?php 
    $sessionData = $this->session->userdata('adminSession') ;
    // print_r($this->session->userdata('adminSession'));die;
?>
<div class="app-header header py-1 d-flex">
    <div class="container-fluid">
        <div class="d-flex">
            <a class="header-brand" href="<?php echo site_url('/');?>">
                <img src="<?php echo base_url(); ?>/assets/images/<?php echo ADMIN_SITE_LOGO; ?>" class="header-brand-img" alt="<?php echo SITE_NAME; ?>">
               
            </a>
            <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a>
            
                <div class="text-uppercase font-weight-semibold text-navy-blue" style="padding-top:15px;"><?php echo SITE_NAME; ?></div>
            


            <div class="d-flex order-lg-2 ml-auto">
                <div class="mt-2">
                    <div class="searching mt-2 ml-2 mr-3">
                        <a href="javascript:void(0)" class="search-open mt-3">
                            <i class="fa fa-search text-dark"></i>
                        </a>
                        <div class="search-inline">
                            <form>
                                <input type="text" class="form-control" placeholder="Search here">
                                <button type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                                <a href="javascript:void(0)" class="search-close">
                                    <i class="fa fa-times"></i>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="dropdown d-none d-md-flex " >
                    <a  class="nav-link icon full-screen-link">
                        <i class="mdi mdi-arrow-expand-all"  id="fullscreen-button"></i>
                    </a>
                </div>


                <div class="dropdown">
                    <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                        <span class="avatar avatar-md brround">
                        
                        <?php 
                            if($sessionData['profile_picture'] != '')
                            {
                                $profile_img = $sessionData['profile_picture'];
                                $profile_pic_path = base_url()."assets/upload/users/".$profile_img;
                            } 
                            else
                            {
                                // $profile_img = 'default_profile.jpg';
                                $profile_img = 'admin_logo.png';
                                $profile_pic_path = base_url()."assets/images/".$profile_img;
                            }

                            
                        ?>
                        <img src="<?php echo $profile_pic_path ; ?>" alt="<?php echo $sessionData['fname'];?>" class="avatar avatar-md brround">
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow ">
                        <div class="text-center">
                            <a href="#" class="dropdown-item text-center font-weight-sembold user"><?php echo $sessionData['fname'].' '.$sessionData['lname'];?></a>

                            <div class="dropdown-divider"></div>
                        </div>
                        <a class="dropdown-item" href="<?php echo site_url('adminprofile/my_profile'); ?>">
                            <i class="dropdown-icon mdi mdi-account-outline "></i> Profile
                        </a>
                        <a class="dropdown-item" href="<?php echo site_url('adminprofile/change_password'); ?>">
                            <i class="dropdown-icon  mdi mdi-settings"></i> Change Password
                        </a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="<?php echo site_url('admin/logout'); ?>">
                            <i class="dropdown-icon mdi  mdi-logout-variant"></i> Sign out
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--

<?php $sessiondata = $this->session->userdata('adminSession'); ?>
<div class="headerClock">
  <p id="headerDate"></p>
  <h2 id="headerTime"></h2>
</div>

<ul class="nav navbar-nav navbar-right navbar-user">
<?php $txtCssActive = $this->router->fetch_class() == 'adminDashboard' ? 'active' : ''; ?>
<?php $txtCssActive = $this->router->fetch_class() == 'profile' ? 'active' : ''; ?>
  <li class="dropdown user-dropdown <?php echo $txtCssActive; ?>">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $sessiondata['fname'] . ' ' . $sessiondata['lname']; ?> <b class="caret"></b></a>
    <ul class="dropdown-menu">

      <li><a href="<?php echo site_url('adminprofile/my_profile'); ?>"><i class="fa fa-user"></i> Profile</a></li>
      <li class="divider"></li>
      <li><a href="<?php echo site_url('adminprofile/change_password'); ?>"><i class="fa fa-key"></i> Change Password</a></li>
      <li class="divider"></li>

      <li class="divider"></li>

      <li><a href="<?php echo site_url('admin/logout'); ?>"><i class="fa fa-power-off"></i> Log Out</a></li>
    </ul>
  </li>
</ul>-->

<!---======mobile section navgation=======---->




