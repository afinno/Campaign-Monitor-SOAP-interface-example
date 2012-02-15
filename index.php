<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
	<title>Sample Application - afinno</title>
	<link rel="stylesheet" href="styles/global.css"> 
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="scripts/jquery.global.js"></script>
</head>

<body>

<div class="container_12">

	<form method="post" name="sample_form" id="sample_form">
		
		<h4>Please enter your details</h4>
		
		<fieldset>
		
			<label for="fullname">Name</label>
			<input type="text" name="full_name" id="full_name" value="">
			<br />
			<label for="email">Email Address</label>
			<input type="text" name="email" id="email" value="">
			<br />
			<label>Newsletter</label><br />
			<label><input type="radio" name="subscribe" id="subscribe" value="Y"> Subscribe</label>
			<label><input type="radio" name="subscribe" id="subscribe" value="N"> Unsubscribe</label>
			
		</fieldset>
		
		<input type="submit" class="sidebar_submit" value="SUBMIT">
		
	</form>
	
</div>

</body>
</html>