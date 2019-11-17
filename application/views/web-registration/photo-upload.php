<!DOCTYPE html>
<html class="full" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="krisibid">
    <meta name="keywords" content="kib,krisibid,id card id">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <title>Krishibid</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
	
	<script>
			function readURL(input,id) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						$('#'+id)
							.attr('src', e.target.result)
							.width(150)
							.height(150);
					};

					reader.readAsDataURL(input.files[0]);
				}
			}
			function submitForm()
			{
				var fileName = document.getElementById('file').value;
				var allowed_extensions = new Array("jpg","png");
				var file_extension = fileName.split('.').pop().toLowerCase(); // split function will split the filename by dot(.), and pop function will pop the last element from the array which will give you the extension as well. If there will be no extension then it will return the filename.
				var flag = false;
				for(var i = 0; i <= allowed_extensions.length; i++)
				{
					if(allowed_extensions[i]==file_extension)
					{
						flag = true; // valid file extension
					}
				}			
				if(flag)
				{
					document.getElementById('upload_image_form').submit();
				}
				else
				{
					alert('Please Select Image with jpeg/png format');
				}
			}
		</script>
</head>

<body>
<div class="bgimg">
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

	<!-- upload form -->
	
	<div class="container">
		<div class="row">
			<div class="col-md-12 membership">
				<div class="heading">
					<h2>MEMBER ID CARD PORTAL</h2>
				</div>
	
				
				<div class="col-md-6 uploadcss">
					<div class="pad"><i class="cr-icon glyphicon glyphicon-ok"></i><p> সাদা ব্যাকগ্রাউণ্ডের পাসপোর্ট সাইজের রঙ্গিন ছবি হতে হবে।</p></div>
					<div class="pad"><i class="cr-icon glyphicon glyphicon-ok"></i><p> সরাসরি ডিজিটাল ছবি দিতে হবে। ছবি থেকে ছবি বা স্ক্যানকৃত ছবি গ্রহণযোগ্য নয়।</p></div>
					<div class="pad"><i class="cr-icon glyphicon glyphicon-ok"></i><p> সাদা পোশাকের ছবি গ্রহণযোগ্য নয়।</p></div>
					<div class="pad"><i class="cr-icon glyphicon glyphicon-ok"></i><p> ছবিতে মুখমন্ডলের অবস্থান অত্যন্ত গুরুত্বপূর্ণ। এমনভাবে ছবি তুলুন যাতে  সম্পুর্ন মুখমন্ডল ভালভাবে দেখা যায় এবং তা ছবির মাঝ বরাবর থাকা।</p></div>
					<div class="pad"><i class="cr-icon glyphicon glyphicon-ok"></i><p> চশমা পরিহিত বা চোখ বন্ধ অবস্থায় তোলা ছবি গ্রহণযোগ্য নয়।</p></div>
					<div class="pad"><i class="cr-icon glyphicon glyphicon-ok"></i><p> ছবিতে মুখের অভিব্যক্তি স্বাভাবিক থাকতে হবে।</p></div>		
				</div>
				<div class="col-md-6 uploadcss text-center">
				<p>Select a PNG or JPEG image, having maximum size <span id="max-size"></span> KB.</p>
					<center>
						<form id="upload_image_form" action="<?php echo $target; ?>" method="post" enctype="multipart/form-data">
							<div id="image_preview_div">
								<label for="exampleInputFile">Selected image:</label>
								<br>
								<?php 
								$img = 'assets/images/profile.jpg';
								if($applicant_photo_path!='')
								{
									$img = $applicant_photo_path;
								}
								?>
								<img src='<?php echo base_url().$img."?".time(); ?>' id='preview_img' width='150' height='150' >
							</div>
							
							<div class="form-group">
							
								
								<input type="file" name="member_pic" id="file" style="display:none;" onchange="readURL(this,'preview_img');" required>
							<i class="glyphicon glyphicon-camera" id="file1" style="cursor:pointer;border:1px solid #8f9398; padding:5px 10px;" onclick='document.getElementById("file").click()'> Photo Upload</i>
							</div>
						<a class="cus_btn btn btn-info" href='<?php echo 
						base_url(); ?>web-member-information-preview-data'>Back</a>
					<input class="cus_btn btn btn-primary" id="upload_button" name='upload_button' type="submit" value='Submit' onclick='submitForm();'> 
							<?php 
								if($applicant_photo_path!='')
								{
							?>
					<a class="cus_btn btn btn-info" href='<?php echo base_url(); ?>preview-info'>Skip</a>
				
							<?php
								}
							?>
						</form>
					</center>
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
	
	
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
	<!-- search -->
		
	</script>

</body>

</html>
