<!DOCTYPE html>
<html class="full" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="krisibid">
    <meta name="keywords" content="kib,krisibid,id card id">

    <title><?php echo $title; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
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

<body class="bgimg">

	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="text-center">
				<div class="list-inline">
					<a class="logo-padding" href="<?php  echo base_url(); ?>index"><img src="<?php echo base_url(); ?>assets/images/logo.png"><span>Kirishibid<span class="cus_or1"> I</span>nstitution Bangladesh</span></a>
					
				</div>
				
			</div>

			
		</div><!-- /.container-fluid -->
	</nav>

	<div class="patern">
	<!-- login form -->
		<div class="container">
			<div class="row mainpart">
				<div class="col-md-8 welcome">
					<h3>Welcome <p style="color:red;"> To <p/> MEMBER ID CARD PORTAL</h3>
					<p class="text1">কৃষিবিদ ইনস্টিটিউশন বাংলাদেশ – এর জীবন ও সাধারণ সদস্যগণ মেম্বার আইডি কার্ড প্রাপ্তির জন্য এই পোর্টালে আবেদন করতে হবে।</p>
					<p class="text2">Please read the following guides in using this Member ID Card Portal</p>
					<p>১। পোর্টালে আবেদন করতে হলে আপনাকে প্রথমে লগইন করতে হবে। </p>
					<p>২। মেম্বার রেজিস্ট্রেশান নাম্বার ও মেম্বার টাইপ উল্লেখ্য করে লগইন করুন। </p>
					<p>৩। তারকা চিহ্নিত (*) ক্রমিক নং গুলো অবশ্য পূরণীয়।</p>
					<p>৪। আবেদন করার সময় আপনাকে একটি ছবি সংযোজন করতে হবে। ছবির মান নিন্মুক্ত নিয়ম অনুযায়ী হতে হবে।</p>
					<p>✔ সাদা ব্যাকগ্রাউণ্ডের পাসপোর্ট সাইজের রঙ্গিন ছবি হতে হবে।</p>
					<p>✔ সরাসরি ডিজিটাল ছবি দিতে হবে।ছবি থেকে ছবি বা স্ক্যানকৃত ছবি গ্রহণযোগ্য নয়।</p>
					<p> ✔ সাদা পোশাকের ছবি গ্রহণ যোগ্য নয়।</p>
					<p>✔ ছবিতে মুখমন্ডলের অবস্থান অত্যন্ত গুরুত্বপূর্ণ । এমন ভাবে ছবি তুলুন যাতে সম্পুর্নমুখ মন্ডল ভাল ভাবে দেখা যায় এবং তা ছবির মাঝ বরাবর থাকে।</p>
					<p>✔ চশমা পরিহিত বা চোখ বন্ধ অবস্থায় তোলা ছবি গ্রহণযোগ্য নয়।</p>
					<p> ✔ ছবিতে মুখের অভিব্যক্তি স্বাভাবিক থাকতে হবে।</p>
					<p>৫। জীবন ও সাধারণ সদস্যগণ ১৫০/- (একশতপঞ্চাশ) টাকা কৃষিবিদ ইনস্টিটিউশন বাংলাদেশ এর বিকাশ অ্যাকাউন্ট নাম্বার এ অনলাইন পোর্টাল এর মাধ্যমে জমা দিতে হবে। ফিরতি এস এম এস এর মাধ্যমে আপনি নিশ্চিত হতে পারবেন । </p>
				
				</div>
				<div class="col-md-4">

					<div class="panel panel-default formbody">
						<div class="panel-heading">Search</div>
						<div class="panel-body">
							<form id="reg_form" class="form-horizontal" role="form" method="post" action="<?php  echo base_url(); ?>search-view">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" id="member_id" name="member_id" class="form-control" placeholder="Member ID" value="<?php if(isset($member_id)){echo $member_id; } ?>" required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
                                        <select class="form-control" id="member_type" name="member_type"  required>
                                            <option value="">Select</option>
                                            <option value="general" <?php if(isset($member_type) && $member_type=='general'){echo 'selected';} ?>>General</option>
                                            <option value="life" <?php if(isset($member_type) && $member_type=='life'){echo 'selected';} ?>>Life</option>
                                        </select>
									</div>
								</div>
								<div class="form-group last">
									<div class="col-sm-12">
                                        <span style="color:red"><?php if(isset($msg)){echo $msg; } ?></span>
										<center>
                                            <input type="submit" class="cus_btn btn btn-success btn-sm" value="Search" onclick="submitVerifation()">
                                        </center>
									</div>
								</div>
							</form>
						</div>

					</div>
					<p class="text3">
					প্রাসঙ্গিক যে কোন প্রয়োজনে অফিস চলাকালীন সময়ে হেল্পলাইনের সহায়তা নিন।
					</p>
					<p class="text3">
					হেল্পলাইনঃ <img class="tel" src="<?php echo base_url(); ?>assets/images/tel.gif"> ০১৭১২৪১৬১৫১
					</p>
					<a href="<?php  echo base_url(); ?>index" style='color:white;'>Search</a>
				</div>
			</div>
		</div>
	</div>
	<!-- login form -->
	
	
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
</body>

</html>
