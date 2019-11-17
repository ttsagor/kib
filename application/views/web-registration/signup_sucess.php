<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="krisibid">
        <meta name="keywords" content="kib,krisibid,id card id">
		<title>KIB Registration</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<style>
			html,body 
			{
				height:100%;
			}
			td
			{
				padding-bottom:5px;
				width:50%;
			}
			.left-td
			{
				text-align:left;
			}
			.right-td
			{
				text-align:left;
			}
			h4
			{
				color:#3E6360;
			}
			tr.border_bottom_right{
			  border-bottom:1px dotted #3E6360;			  
			}
			tr.border_bottom{
			  border-bottom:1px dotted #3E6360;
			  border-left:1px dotted #3E6360;
			}
			input
			{
				width:100%;
			}
			select
			{
				width:100%;
			}
			.heading-txt
			{
				font-weight:bold;
			}
		</style>		
	</head>
	<body>
		<table cellpadding='0' cellspacing='0' border='0' style='width:80%;margin:auto;text-align:center;background-color:#e8ffec;'>
			<tr>
				<td>
					<img src='<?php echo base_url(); ?>assets/images/logo.png' onclick='window.location.href = "<?php echo base_url().'kib'; ?>";'/>
				</td>
			</tr>
			<tr>
				<td>
					<div class="alert alert-success">
					  <strong>Success!</strong> Member ID Card Registration Successful.
					</div>
				</td>						
			</tr>
		</table>
    </body>
</html>  