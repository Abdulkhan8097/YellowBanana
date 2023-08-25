<html lang="en" dir="ltr"><head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="msapplication-TileColor" content="#ff685c">
	<meta name="theme-color" content="#32cafe">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" type="image/x-icon" href="http://139.59.15.90/yellowbananafood/assets/admin/images/favicon.ico">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<!-- Title -->
	<title>PO Order | Yellow Banana Food Pvt Ltd</title>
	<meta name="content" content="">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<style>
		<style type="text/css">
		.tg  {border-collapse:collapse;border-spacing:0;}
		.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
		.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
		.tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
		th{
			background-color: #ddd;
			font-weight: bold !important;
		}
	</style>

</style>
</head>
<body class="app sidebar-mini rtl">

	<div class='container'>
		<br/>
		<div id="global-loader" style="display: none;"></div>
		<div class="page">
			<div class="page-main">
				<div class="bg-img my-3 my-md-5"> 
					<div class="side-app"> 
						<?php 
						//ksort($result[0]);echo "<pre>";print_r($result);echo "</pre>";
						$po_date          = $result[0]['created_date'];
						$po_number        = $result[0]['order_id'];
						$vendor_name      = $result[0]['vendor_name'];
						$vendor_company   = $result[0]['company'];
						$vendor_address   = $result[0]['address'];
						$vendor_city      = $result[0]['city'];
						$pincode          = $result[0]['pincode'];
						$state            = $result[0]['state_name'];
						$country_name     = $result[0]['country_name'];
						$vendor_contact_no= $result[0]['mobile_no'];
						$vendor_email     = $result[0]['email'];
						$vendor_gst_no    = $result[0]['gst_no'];
						$gross_total      = $result[0]['gross_total'];
						$grand_total      = $result[0]['amount'];
						$taxname          = $result[0]['taxname'];
						$tax_amount       = $grand_total - $gross_total;

						?>
						<div class="row">
							<div class="col-md-12 col-lg-12">
								<div class="card">                     
									<div class="card-body">    
										<div>
											<table class="tg table table-responsive table-bordered">
												<tr>
													<th class="text-center" class="tg-c3ow" colspan="8"><?php echo SITE_NAME ?></th>
												</tr>
												<tr class="text-center">
													<td class="tg-c3ow" colspan="8"><?php echo SITE_ADDRESS ?></td>
												</tr>
												<tr>
													<td class="text-center text-uppercase" class="tg-c3ow" colspan="8">purchase order</td>
												</tr>
												<tr>
													<td class="tg-c3ow text-capitalize" colspan="3">date : <?php echo $po_date; ?></td>
													<td class="tg-c3ow text-capitalize" colspan="5">po no: <?php echo $po_number; ?></td>
												</tr>
												<tr>
													<td class="tg-c3ow" colspan="3"></td>
													<td class="tg-c3ow" colspan="5">Ref. Quotation No:</td>
												</tr>
												<tr>
													<td class="tg-c3ow" colspan="3"></td>
													<td class="tg-c3ow" colspan="5">Ref Invoice No:</td>
												</tr>
												<tr>
													<th class="tg-c3ow text-uppercase" colspan="3">Name of vendor conpany and address</th>
													<th class="tg-c3ow text-uppercase" colspan="2">department</th>
													<th class="tg-c3ow text-uppercase" colspan="3">vendor details</th>
												</tr>
												<tr>
													<td class="tg-c3ow" colspan="3">Name: <?php echo $vendor_company; ?></td>
													<td class="tg-c3ow" colspan="2" rowspan="3">PROJECTS</td>
													<td class="tg-c3ow" colspan="3"><?php echo $vendor_company; ?></td>
												</tr>
												<tr>
													<td class="tg-c3ow" colspan="3"><?php echo $vendor_address; ?></td>
													<td class="tg-c3ow" colspan="3">Contact No.: <?php echo $vendor_contact_no; ?></td>
												</tr>
												<tr>
													<td class="tg-c3ow" colspan="3">Vendor GST: <?php echo $vendor_gst_no; ?></td>
													<td class="tg-c3ow" colspan="3">Email: <?php echo $vendor_email; ?></td>
												</tr>
											<!-- <tr>
												<td class="tg-c3ow" colspan="3"></td>
												<td class="tg-c3ow" colspan="3"></td>
											</tr> -->
											<tr>
												<th class="tg-c3ow text-uppercase">sr no.</th>
												<th class="tg-c3ow text-uppercase" colspan="3">discription</th>
												<th class="tg-c3ow text-uppercase">hsn</th>
												<th class="tg-c3ow text-uppercase">qty</th>
												<th class="tg-c3ow ext-uppercase">unit price</th>
												<th class="tg-c3ow text-uppercase">price</th>
											</tr>

											<?php 	
											$exp_discri    = explode(',',$result[0]['description']);
											$exp_hsn       = explode(',',$result[0]['hsn']);
											$exp_quantity  = explode(',',$result[0]['quantity']);
											$exp_total     = explode(',',$result[0]['total']);
											$exp_unit_price= explode(',',$result[0]['unit_price']);
											$exp_mo_id= explode(',',$result[0]['mo_id']);

											$count = count($exp_discri);
											$j=1;
											for ($i=0; $i < $count; $i++)
												{?>
													<tr>
														<td class="tg-c3ow"><?php echo $j; ?></td>
														<td class="tg-c3ow" colspan="3"><?php echo $exp_discri[$i]; ?></td>
														<td class="tg-c3ow"><?php echo $exp_hsn[$i]; ?></td>
														<td class="tg-c3ow"><?php echo $exp_quantity[$i]; ?></td>
														<td class="tg-c3ow"><?php echo $exp_unit_price[$i]; ?></td>
														<td class="tg-c3ow"><?php echo $exp_total[$i]; ?></td>
													</tr>
													<?php
													$j++;
												}													
											?>

											<tr>
												<td class="tg-0pky" colspan="5">Amount In Words</td>
												<td class="tg-0pky">Gross Total: </td>
												<td class="tg-0pky" colspan="2"><?php echo $gross_total; ?></td>
											</tr>
											<tr>
												<td class="tg-0pky" colspan="5">Remark</td>
												<td class="tg-0pky">GST @ <?php echo $taxname; ?></td>
												<td class="tg-0pky" colspan="2"><?php echo $tax_amount; ?></td>
											</tr>
											<tr>
												<td class="tg-0pky" colspan="5"></td>
												<td class="tg-0pky"><b>Grand Total:</b></td>
												<td class="tg-0pky" colspan="2"><?php echo $grand_total; ?></td>
											</tr>

											<tr>
												<td class="tg-0pky" colspan="4">Company GST No:</td>
												<td class="tg-0pky" colspan="4"><?php echo SITE_NAME ?></td>
											</tr>
											<!-- <tr>
												<td class="tg-0pky" colspan="4">Prepared By :</td>
												<td class="tg-0pky" colspan="4"></td>
											</tr> -->
											<!-- <tr>
												<td class="tg-0pky" colspan="4">prod garenty</td>
												<td class="tg-0pky" colspan="4"></td>
											</tr> -->
											<tr>
												<td class="tg-0pky" colspan="4">Completion Date</td>
												<td class="tg-0pky" colspan="4"></td>
											</tr>
											<tr>
												<td class="tg-0pky" colspan="4">Payment Terms</td>
												<td class="tg-0pky" colspan="4"></td>
											</tr>
											<tr>
												<td class="tg-0pky" colspan="4" rowspan="3"></td>
												<td class="tg-0pky" colspan="4">Authorised Signature</td>
											</tr>
											
										</table>
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
</body>
</html>