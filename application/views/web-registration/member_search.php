<!DOCTYPE html>
<html class="no-js" lang="zxx">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="description" content="krisbid">
		<meta name="keywords" content="kib,krisibid,id card id">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    
        <title>KIB</title>

        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/style-3.css" rel="stylesheet">
    </head>
    <body class="bgimg">
		<nav class="navbar affix-top" role="navigation" id="BB-nav">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="text-center">
					<div class="logo">
						<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/logo.png"><span>Kirishibid<span class="cus_or1"> I</span>nstitution Bangladesh</span></a>
					</div>
				</div>
			</div>
		</nav>
		
		<div class="section_bkash">
			<div class="container">
				<div class="row">
					
					<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
						<div class="bkash_infos text-center">
							<h3>Member ID Search</h3>
							
			                <p class="text-success" style="font-size: 16px;">মোবাইল নাম্বার, নাম ও পিতার নাম- এর যে কোন একটি তথ্য দিয়ে অনুসন্ধান করুন।</p>
							<form action="<?php echo base_url();?>home/member_search_submit" method='post'>
								<div class="form-group">
									<input type="text" class="form-control" id="number" name='number' placeholder="Mobile Number/Member's Name/Father's Name" value='<?php if(isset($number)){echo $number; }?>' required>
								</div>
								<button type="submit" class="btn btn-primary">Submit</button>
							</form>
							<br />
							
							<table class="table id_search_table" border='1' <?php if(!isset($msg) || (isset($msg) && $msg!='')){echo "style='display:none;'";} ?> >
							    <p class="text-danger" style="font-size: 16px;">অনুসন্ধানকৃত তথ্যটি সঠিকভাবে মিলিয়ে নিন।</p>
								<thead>
									  <tr class="odd">
										  <th style='text-align:center;border-bottom:1px solid black;'>Member ID</th>
										  <th style='text-align:center;border-bottom:1px solid black;'>Member Type</th>
										  <th style='text-align:center;border-bottom:1px solid black;'>Member Name</th>
										  <th style='text-align:center;border-bottom:1px solid black;'>Father's Name</th>
									  </tr>
								</thead>   
								<tbody>
								    <?php 
								        if(isset($data)){
								        foreach ($data as $member)
										{ 
                                            //print_r($member);
									?>
    									<tr class= "even">
    										<td> <?php echo $member->mem_no; ?></td>
    										<td>
        										<?php 
        										        if($member->memtype_id=='2')
        										        {
        										            echo "Life";
        										        }
        										        else
        										        {
        										          echo "General";   
        										        }
        										 ?>
    										 </td>
    										<td><?php echo $member->mem_name; ?></td>
    										<td><?php echo $member->father_name; ?></td>
    									</tr>   
									<?php
										}}
								    ?>
								</tbody>
							</table>
							<?php
    							if(isset($msg))
    							{
    							    echo $msg;
    							}
							?>
							<a href='<?php echo base_url(); ?>' class="btn btn-primary">Go to Home</a>
						</div>
					</div>
			
				</div>
			</div>
		</div>
		
		<footer class="container-fluid">
			<div class="row">
				<div class="col-md-12 footer">
					<p style='font-size:16px;'>Powered by: <a href="https://rezanreza.com/" target='blank' style='text-color:#25527B;text-decoration:underline;'>Reza &amp; Reza Solutions</a></p>
				</div>
			</div>
		</footer>
		<!-- script js -->
		<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.4.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    </body>
</html>