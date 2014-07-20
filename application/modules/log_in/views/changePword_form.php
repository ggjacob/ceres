<!DOCTYPE html>
<html lang="en">
	<head>
		<link href="<?php echo $this->config->item('bootstrap_css');?>" rel="stylesheet">
		<script src="<?php echo $this->config->item('jquery');?>"></script>
		<script src="<?php echo $this->config->item('bootstrap_js');?>"></script>		
		<script>
			function validateNewPwords(pw1, pw2){
				if(pw1 != pw2){
					$("#cp_alert").html("Error! Passwords do not match!").removeClass('hide');
					return false;
				}
				else if(pw1.length < 8 ){
					$("#cp_alert").html("Error! Password should be at least 8 characters!").removeClass('hide');					
					return false;
				}
				else{
					return true;
				}
			}
		</script>					
		<title>Change Password - <?php echo $this->config->item('app_name'); ?></title>		
	</head>
	<body>
		<div class="alert alert-info hide" role="alert" id="pwchanged_alert"></div>
	<?php
		$this->load->helper('url');
		$session_user = $this->session->userdata('session_user');
		$pw_changed = $this->session->userdata('pwchanged');
		if($pw_changed == 0){
			echo "<script>";
			echo "$('#pwchanged_alert').html('First time log-in. Need to change password.').removeClass('hide');";
			echo "</script>";
		}
		else{
			echo "<a href=\"".base_url()."\"><img src=\"".base_url()."/img/back.png"."\" width=\"50px\" height=\"50px\" />Return to Home Page</a>";
		}
	?>	
		
		<div class="container">
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<form role="form" action="<?php echo base_url()."index.php/log_in/newPword"; ?>" method="post">
						<h1 class="text-center">Change Password</h1>
						<div class="form-group" id="uname_form">
							<label class="control-label" for="uname">User name:</label>
							<input type="text" class="form-control" id="uname" name="uname" readonly="readonly" value="<?php echo $session_user; ?>" />
						</div>
						<div class="form-group" id="pword_form1">
							<label class="control-label" for="pword1">Password:</label>
							<input type="password" class="form-control" id="pword1" name="pword1" />
						</div>
						<div class="form-group" id="pword_form2">
							<label class="control-label" for="pword2">Retype password:</label>
							<input type="password" class="form-control" id="pword2" name="pword2" />
						</div>						
						<button class="btn btn-default" onclick = "return validateNewPwords(getElementById('pword1').value, getElementById('pword2').value);" >Change Password</button>

					</form>
					<br />
					<div class="alert alert-danger hide" id="cp_alert" role="alert"></div>

				</div>
				<div class="col-md-4"></div>
			</div>
		</div>

	</body>	
	
</html>