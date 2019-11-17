<?php 
    error_reporting(0);
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="description" content="krisibid">
		<meta name="keywords" content="kib,krisibid,id card id">
		<meta name="viewport" content="width=device-width, initial-scale=1">    
        <title><?php echo $title; ?></title>
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/style-2.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/font.css" rel="stylesheet">
        <!-- <link href="css/ihover.css" rel="stylesheet"> -->
        <link href="<?php echo base_url(); ?>assets/css/responsive.css" rel="stylesheet">
		<!--======= Responsive Bootstrap Carousel StyleSheet =========-->
		<style type="text/css">
			.form-control {
				display: block;
				border-bottom:2px solid #25527B !important;
				width: 100%;
				height: 34px;
				padding: 6px 0px;
				font-size: 14px;
				line-height: 1.42857143;
				color: #25527B;
				background-color: rgba(255,0,0,0) !important;
				background-image: none;
				border: 1px solid rgba(204, 204, 204, 0);
				border-radius: 0px;
				-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
				box-shadow: inset 0px 0px 0px rgba(0,0,0,.075) !important;
				-webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
				-o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
				transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
			}
		</style>
		<script>
            function submitVerifation()
            {
                if(document.getElementById('member_type').value!='' && document.getElementById('member_id').value!='')
                {
                    document.getElementById('reg_form').submit();
                }
            }
        </script>
    </head>
    <body class="bgimg" style='font-family:kalpurushregular !important;'>
		<nav class="navbar affix-top" role="navigation" id="BB-nav">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="text-center">
					<div class="logo">
						<a href="<?php echo base_url();?>"><img src="<?php echo base_url(); ?>assets/images/logo.png"><span>Kirishibid<span class="cus_or1"> I</span>nstitution Bangladesh</span></a>
					</div>
				</div>
			</div>
		</nav>	
		
		<div class="container">
			<div class="row">
				<div class="patern">
					<!-- login form -->
					<div class="container">
						<div class="row mainpart">
							<div class="col-md-7 col-md-offset-1 welcome">
								<h4>Welcome To Member ID Card Resigtration Portal</h4>
								<p class="text1">কৃষিবিদ ইনস্টিটিউশন বাংলাদেশ – এর জীবন ও সাধারণ সদস্যগণ মেম্বার আইডি কার্ড প্রাপ্তির জন্য এই পোর্টালে আবেদন করতে হবে।</p>
								<p class="text2">মেম্বার আইডি কার্ড আবেদনের প্রয়োজনীয়  তথ্যাবলী  নিন্মরূপঃ </p>
								<p>১। পোর্টালে আবেদন করতে হলে আপনাকে প্রথমে লগইন করতে হবে। </p>
								<p>২।  মেম্বার রেজিস্ট্রেশন নাম্বার (Member ID) ও মেম্বার টাইপ উল্লেখ্য করে লগইন করুন।</p>
								
								<p>৩। আবেদন করার সময় আপনাকে একটি ছবি সংযোজন করতে হবে। ছবির মান নিন্মুক্ত নিয়ম অনুযায়ী হতে হবে।</p>
								<div class="image_requirment">
									<div class="pad"><i class="glyphicon glyphicon-check"></i><p> সাদা ব্যাকগ্রাউণ্ডের পাসপোর্ট সাইজের রঙ্গিন ছবি হতে হবে।</p></div>
									<div class="pad"><i class="glyphicon glyphicon-check"></i><p> সরাসরি ডিজিটাল ছবি দিতে হবে। ছবি থেকে ছবি বা স্ক্যানকৃত ছবি গ্রহণযোগ্য নয়।</p></div>
									<div class="pad"><i class="glyphicon glyphicon-check"></i><p> সাদা পোশাকের ছবি গ্রহণযোগ্য নয়।</p></div>
									<div class="pad"><i class="glyphicon glyphicon-check"></i><p> ছবিতে মুখমন্ডলের অবস্থান অত্যন্ত গুরুত্বপূর্ণ। এমনভাবে ছবি তুলুন যাতে  সম্পুর্ন মুখমন্ডল ভালভাবে দেখা যায় এবং তা ছবির মাঝ বরাবর থাকে।</p></div>
									<div class="pad"><i class="glyphicon glyphicon-check"></i><p> চশমা পরিহিত বা চোখ বন্ধ অবস্থায় তোলা ছবি গ্রহণযোগ্য নয়।</p></div>
									<div class="pad"><i class="glyphicon glyphicon-check"></i><p> ছবিতে মুখের অভিব্যক্তি স্বাভাবিক থাকতে হবে।</p></div>		
								</div>
								<p>৪।  জীবন ও সাধারণ সদস্যগণ ১০০/- টাকা কৃষিবিদ ইন্সটিটিউশন বাংলাদেশ এর বিকাশ অ্যাকাউন্ট নাম্বার এ জমা দিতে হবে। 
								<a href='<?php  echo base_url(); ?>home/payment_instruction' class="text3" style='color:#c94444;text-decoration:underline;'> <i>টাকা জমা দেওয়ার নিয়মাবলী।</i></a></p></div>
							
							<div class="col-md-3">
								<form method="post" action="<?php  echo base_url(); ?>web-member-information">
									<fieldset>
										<div class='kickass_field'>
										  <input maxlength='30' required='required' placeholder="Member ID" id="member_id" name="member_id" value="<?php if(isset($member_id)){echo $member_id; } ?>" required>
										</div>
										<div class='kickass_field'>
											<select id="member_type" name="member_type"  class="form-control" style='font-family: "Helvetica Neue",Roboto,Arial,"Droid Sans",sans-serif;' required>
											  <option value="">Select Member Type</option>
                                                <option value="general" <?php if(isset($member_type) && $member_type=='general'){echo 'selected';} ?>>General</option>
                                                <option value="life" <?php if(isset($member_type) && $member_type=='life'){echo 'selected';} ?>>Life</option>
											  <!-- <option value="4">Almacenero</option>
											  <option value="5">Ayudante</option> -->
											</select>
										</div>
										<div class='kickass_field'>
										   <span style="color:red"><?php if(isset($msg)){echo $msg; } ?></span> 
										  <button type="submit" class="cus_btn btn-primary" onclick="submitVerifation()">Sign In</button>
										</div>
										<br />
										<div class='kickass_field'>
											<p class="text4">
											মেম্বার আইডি কার্ড আবেদন সংক্রান্ত যে কোন প্রয়োজনে অফিস চলাকালীন সময় হেল্পলাইনের সহায়তা নিন ।
											</p>
											<p><a href='<?php  echo base_url(); ?>home/member_search' class="text3" style='color:#c94444;text-decoration:underline;font-size:15px'> <i>মেম্বার আইডি খুজে পেতে এই লিংকে ক্লিক করুন </i></a></p>
											<div class="direc_line">
												<div class="text6">
												<img class="tel" src="<?php echo base_url(); ?>assets/images/tel.gif">  হেল্পলাইনঃ        </div>
												<br />
												
												<p class="p_right"><span class="text5">  তথ্যের জন্যঃ</span>
													<b>০২৯১২৬৮০৯ ,</b>
													<b>০১৭১১৪০২৮৯৫, </b>
													<b>০১৭১২৪১৬১৫১ </b>
												</p>
												
												<p class="p_right"><span class="text5"> টেকনিক্যাল সাপোর্টঃ </span><b>০১৯১৪৮১১১১৮</b></p>
												
											</div>
											<div class="direc_line1">
												<div class="text5">সহযোগিতা / পরামর্শঃ </div>
												<p>মোঃ আরিফুর রহমান তরফদার</p>
												<p>সাংগঠনিক সম্পাদক</p>
												<p>কৃষিবিদ ইনস্টিটিউশন বাংলাদেশ</p>
												<p>মোবাইলঃ ০১৭১১১৯২৬০৮</p>
											</div>
										
											<!--p><a href='<?php  echo base_url(); ?>home/member_search' class="text3" style='color:#c94444;text-decoration:underline;'> <i>মেম্বার আইডি খুজে পেতে এই লিংকে ক্লিক করুন </i></a></p>
											<p class="text5">
											<img class="tel" src="<?php echo base_url(); ?>assets/images/tel.gif"> হেল্পলাইনঃ ০১৯১৪৮১১১১৮,  ০২৯১২৬৮০৯, ০১৭১১৪০২৮৯৫, ০১৭১২৪১৬১৫১
											</p-->
										</div>
										
									</fieldset>
								</form>
							</div>
						</div>
					</div>
				</div>	
			</div>
		</div>
		<footer class="container-fluid">
			<div class="row">
				<div class="footer">
					<p style='font-size:16px;'>Powered by: <a href="https://rezanreza.com/" target='blank' style='text-color:#25527B;text-decoration:underline;'>Reza &amp; Reza Solutions</a></p>					
				</div>
			</div>
		</footer>
		<!-- script js -->
		<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.4.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    </body>
</html>