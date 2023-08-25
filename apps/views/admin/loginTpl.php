<div class="page bg-img">
			<div class="page-single">
				<div class="container">
					<div class="row">
						<div class="col mx-auto">
							<div class="text-center mb-6">
								<img src="<?php echo base_url('assets/images/'.ADMIN_SITE_LOGO);?>" alt="<?php echo SITE_NAME; ?>" width="120px">
							</div>
							<div class="row justify-content-center">
								<div class="col-md-8">
									<div class="card-group mb-0">
                                                                            
										<div class="card p-4">
                                                                                    <form method="post" role="form" name="loginForm" id="loginForm" action="<?php echo site_url("admin/index");?>">
											<div class="card-body">
												<h1>Login</h1>
                                                                                                <?php $this->load->view('admin/_topmessage'); ?>
												<p class="text-muted">Sign In to your account</p>
												<div class="input-group mb-3">
													<span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                                                                        <input type="text" class="form-control" value="" id="username" name="username" placeholder="User name" required="">
													
												</div>
												<div class="input-group mb-4">
													<span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
                                                                                                        <input type="password" class="form-control" value="" id="password" name="password" placeholder="password" required="">
													
												</div>
												<div class="row">
													<div class="col-12">
														<button type="submit" class="btn btn-gradient-primary btn-block">Login</button>
													</div>
													
												</div>
											</div>
                                                                                        </form>
										</div>
                                                                             
										<div class="card text-white bg-primary py-5 d-md-down-none login-transparent">
											<div class="card-body text-center justify-content-center ">
												<h2>Welcome To <?php echo SITE_NAME; ?></h2>
												<p>To access panel detail. Please login with your credential. </p>
												
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

<!--
<div class="container">
 <div class="row">

    <div class=" col-sm-8 col-sm-offset-2 col-md-6 col-offset-2" >

          <div>
              <h2 style="text-align:center"><img src="<?php echo base_url('assets/images/'.SITE_LOGO);?>" alt="<?php echo SITE_NAME; ?>" title="<?php echo SITE_NAME; ?>"></h2>
          </div>

          <div class="col-lg-12">

               <?php if ($errorMsg) { ?>
                    <div class="alert alert-dismissable alert-danger">
                          <button type="button" class="close" data-dismiss="alert">×</button>
                          <strong>Oops!</strong> <?php echo $errorMsg; ?>
                        </div>
               <?php } ?>

            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">Login</h3>
              </div>
              <div class="panel-body">

                  <form method="post" role="form" name="loginForm" id="loginForm" action="<?php echo site_url("admin/index");?>">
                      <div class="form-group">
                        <label>Username :</label>
                        <input type="text" class="form-control" value="" id="username" name="username" required="">
                      </div>

                        <div class="form-group">
                        <label>Password:</label>
                        <input type="password" class="form-control" value="" id="password" name="password" required="">
                      </div>
                         <div class="checkbox">
                          <label>
                            <input name="remember" value="1" type="checkbox"> Remember Me.
                          </label>
                        </div>
                      <button type="submit" class="btn btn-primary">Login</button>

                    </form>

              </div>
            </div>



          </div>

        </div>

 </div>
 </div>
-->



