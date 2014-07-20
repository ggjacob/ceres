<!DOCTYPE html>
<html lang="en">
	<head>
		<link href="<?php echo $this->config->item('bootstrap_css');?>" rel="stylesheet">
		<script src="<?php echo $this->config->item('jquery');?>"></script>
		<script src="<?php echo $this->config->item('bootstrap_js');?>"></script>		
		<title>Log-IN to <?php echo $this->config->item('app_name'); ?></title>		
	</head>
	<body>
	<?php
		$this->load->helper('url');
		if($valid_user){
			foreach($valid_user as $row){
				$this->session->set_userdata('session_user', $row->uname);
				$this->session->set_userdata('session_access', $row->access_type);
				$this->session->set_userdata('pwchanged', $row->pw_changed);
			}
			if($this->session->userdata('pwchanged') == 0){
				header('Location:'.base_url().'index.php/log_in/changePword');
			}
			else{
				header('Location:'.base_url());
			}
			
		}
	
	?>	
		
		<div class="container">
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<form role="form" action="<?php echo base_url()."index.php/log_in/checkUserPword"; ?>" method="post">
						<h1 class="text-center">Log IN</h1>
						<div class="form-group" id="uname_form">
							<label class="control-label" for="uname">User name:</label>
							<input type="text" class="form-control" id="uname" name="uname" />
						</div>
						<div class="form-group" id="pword_form">
							<label class="control-label" for="pword">Password:</label>
							<input type="password" class="form-control" id="pword" name="pword" />
						</div>
					<button class="btn btn-default" >Log IN</button>
					</form>
					
					<br />
					<div class="alert alert-warning hide" role="alert" id="logfail_alert">Log-in failed. Please try again.</div>
					<?php
						//if page loaded from a post-method, and username and password did not match database entry
						if($_SERVER["REQUEST_METHOD"] == "POST"){
						echo "<script>";
						echo "$('#logfail_alert').removeClass('hide')";
						echo "</script>";
						}
					
					?>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>


	</body>	
	
</html>