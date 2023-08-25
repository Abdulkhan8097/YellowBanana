<?php
$sessionData = $this->session->userdata('adminSession');
$userType =  $sessionData['usertype']; 
?>
<!-- Sidebar menu-->
<div class="app-sidebar__overlay " data-toggle="sidebar"></div>
<aside class="app-sidebar bg-img">
    <div class="app-sidebar__user">
        <div class="dropdown user-pro-body">
            <div>
                &nbsp;
            </div>
            <div class="user-info mb-2">
                &nbsp;

            </div>
            &nbsp;

        </div>
    </div>
    <ul class="side-menu ">
        <li>
            <a class="side-menu__item"  href="<?php echo site_url('adminDashboard'); ?>"><i class="side-menu__icon fa fa-dashboard"></i><span class="side-menu__label">Dashboard</span></a>
        </li>
        <?php if($userType=='admin')
        { 
            ?>

            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-file"></i><span class="side-menu__label">Manage PO</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    <li>
                        <a href="<?php echo site_url('porders'); ?>" class="slide-item">List PO</a>
                    </li>
                <!-- <li>
                    <a href="<?php //echo site_url('pordernew'); ?>" class="slide-item">Create New PO</a>
                </li> -->
                
            </ul>
        </li>

        <!-- <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-user"></i><span class="side-menu__label">General manager</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li>
                    <a href="<?php echo site_url('adminDashboard/list_generalManager') ?>" class="slide-item">List General Manager</a>
                </li>
                <li>
                    <a href="<?php echo site_url('adminDashboard/add_generalManager') ?>" class="slide-item">Add New General Manager</a>
                </li>
                
            </ul>
        </li> -->
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-user"></i><span class="side-menu__label">Operational GM</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li>
                    <a href="<?php echo site_url('adminDashboard/list_operationalgeneralManager') ?>" class="slide-item">List Operational GM</a>
                </li>
                <li>
                    <a href="<?php echo site_url('adminDashboard/add_operationalgeneralManager') ?>" class="slide-item">Add Operational GM</a>
                </li>
                
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-user"></i><span class="side-menu__label">Project GM</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li>
                    <a href="<?php echo site_url('adminDashboard/list_projectgeneralManager') ?>" class="slide-item">List Project GM</a>
                </li>
                <li>
                    <a href="<?php echo site_url('adminDashboard/add_projectgeneralManager') ?>" class="slide-item">Add Project GM</a>
                </li>
                
            </ul>
        </li>

        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-users"></i><span class="side-menu__label">Area Manager</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li>
                    <a href="<?php echo site_url('adminDashboard/list_areaManager') ?>" class="slide-item">List Area Manager</a>
                </li>
                <li>
                    <a href="<?php echo site_url('adminDashboard/add_areaManager') ?>" class="slide-item">Add New Area Manager</a>
                </li>

            </ul>
        </li>

        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-user"></i><span class="side-menu__label">Manage Accountant</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li>
                    <a href="<?php echo site_url('adminDashboard/list_Accountant') ?>" class="slide-item">List Accountant</a>
                </li>
                <li>
                    <a href="<?php echo site_url('adminDashboard/add_Accountant') ?>" class="slide-item">Add New Accountant</a>
                </li>

            </ul>
        </li>     

        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-institution"></i><span class="side-menu__label">Manage Outlets</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li>
                    <a href="<?php echo site_url('admin_outlets'); ?>" class="slide-item">List Outlets</a>
                </li>
                <li>
                    <a href="<?php echo site_url('admin_outlet_new'); ?>" class="slide-item">Add New Outlet</a>
                </li>
            </ul>
        </li> 

        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-truck"></i><span class="side-menu__label">Manage Vendors</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li>
                    <a href="<?php echo site_url('adminDashboard/list_vendor'); ?>" class="slide-item">List Vendors</a>
                </li>
                <li>
                    <a href="<?php echo site_url('adminDashboard/add_Vendor'); ?>" class="slide-item">Add New Vendor</a>
                </li>

            </ul>
        </li>

    <?php } ?>
    <?php if($userType=='area_manager')
    { 
        ?>
        
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-file"></i><span class="side-menu__label">Manage PO</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li>
                    <a href="<?php echo site_url('porders'); ?>" class="slide-item">List PO</a>
                </li>
                <!-- <li>
                    <a href="<?php //echo site_url('pordernew'); ?>" class="slide-item">Create New PO</a>
                </li> -->
                
            </ul>
        </li>

        <!-- <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-user"></i><span class="side-menu__label">General manager</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li>
                    <a href="<?php echo site_url('adminDashboard/list_generalManager') ?>" class="slide-item">List General Manager</a>
                </li>
                <li>
                    <a href="<?php echo site_url('adminDashboard/add_generalManager') ?>" class="slide-item">Add New General Manager</a>
                </li>
                
            </ul>
        </li> -->     

        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-institution"></i><span class="side-menu__label">Manage Outlets</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li>
                    <a href="<?php echo site_url('admin_outlets'); ?>" class="slide-item">List Outlets</a>
                </li>
            </ul>
        </li> 

        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-truck"></i><span class="side-menu__label">Manage Vendors</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li>
                    <a href="<?php echo site_url('adminDashboard/list_vendor'); ?>" class="slide-item">List Vendors</a>
                </li>
                <li>
                    <a href="<?php echo site_url('adminDashboard/add_Vendor'); ?>" class="slide-item">Add New Vendor</a>
                </li>

            </ul>
        </li>

    <?php } ?>        


        <?php //if( $userType=='area_manager' )
        if( $userType=='operational_general_manager' || $userType=='project_general_manager')
            { ?>

                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-file"></i><span class="side-menu__label">Manage PO</span><i class="angle fa fa-angle-right"></i></a>
                    <ul class="slide-menu">
                        <li>
                            <a href="<?php echo site_url('porders'); ?>" class="slide-item">List PO</a>
                        </li>                
                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-institution"></i><span class="side-menu__label">Manage Outlets</span><i class="angle fa fa-angle-right"></i></a>
                    <ul class="slide-menu">
                        <li>
                            <a href="<?php echo site_url('myoutlets'); ?>" class="slide-item">My Outlets</a>
                        </li>

                    </ul>
                </li>

        <!-- <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-truck"></i><span class="side-menu__label">Manage Vendors</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li>
                    <a href="<?php echo site_url('adminDashboard/list_vendor'); ?>" class="slide-item">List Vendors</a>
                </li>
                <li>
                    <a href="<?php echo site_url('adminDashboard/add_Vendor'); ?>" class="slide-item">Add New Vendor</a>
                </li>

            </ul>
        </li> -->
    <?php } ?>

    <?php if( $userType=='general_manager' )
    { ?>


        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-file"></i><span class="side-menu__label">Manage PO</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li>
                    <a href="<?php echo site_url('porders'); ?>" class="slide-item">List PO</a>
                </li>                
            </ul>
            
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-users"></i><span class="side-menu__label">Area Manager</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    <li>
                        <a href="<?php echo site_url('adminDashboard/list_areaManager') ?>" class="slide-item">List Area Manager</a>
                    </li>
                    <!-- <li>
                        <a href="<?php echo site_url('adminDashboard/add_areaManager') ?>" class="slide-item">Add New Area Manager</a>
                    </li> -->

                </ul>
            </li>
        </li>
        
    <?php } ?>

    <?php 
    if( $userType=='accountant' )
    { 
        ?>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-file"></i><span class="side-menu__label">Manage PO</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li>
                    <a href="<?php echo site_url('adminPorders/list_approved_po'); ?>" class="slide-item">List PO</a>
                </li>                      
            </ul>
        </li>    

        <?php
    }
    ?>    


</ul>
</aside>