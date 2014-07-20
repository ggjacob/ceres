<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
			$this->load->helper('url');
		?>		
    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
	    <link href="<?php echo $this->config->item('bootstrap_css')?>" rel="stylesheet">    
	    <link href="<?php echo $this->config->item('datatables_css')?>" rel="stylesheet">		
		<link href="<?php echo $this->config->item('datepicker_css');?>" rel="stylesheet">				    	
		<script src="<?php echo $this->config->item('jquery');?>"></script>
		<script src="<?php echo $this->config->item('datatables_js');?>"></script>
		<script src="<?php echo $this->config->item('bootstrap_js');?>"></script>	
		<script src="<?php echo $this->config->item('datepicker_js');?>"></script>

		<script>
			function load_users(){
				$('#users').load('<?php echo base_url()."index.php/admin/users_list";?>', function(){
					$('#users_table').DataTable();
				});				
			}
			function load_logs(){
				$('#ulog').load('<?php echo base_url()."index.php/admin/recent_log";?>', function(){
					$('#logs_table').DataTable();
					$('.datepicker').datepicker({'format':"yyyy-mm-dd"});
				})
			}	
			$(document).ready(function(){
				load_users();
			});
			
			function periodLogs(sdate, edate){
				if(sdate==="" || edate===""){
					$('#admin_alert').removeClass('hide');
					$('#alert_body').html('Start and End dates should not be empty!');
					setInterval(function(){$('#admin_alert').addClass('hide');}, 5000)							
				}
				else{
					$('#ulog').load('<?php echo base_url()."index.php/admin/period_log";?>',
						{'sdate':sdate, 'edate':edate}, function(){
						$('#admin_alert').removeClass('hide');
						$('#alert_body').html('Showing user activity logs from '+sdate+' to '+edate);									
						$('#logs_table').DataTable();
						$('.datepicker').datepicker({'format':"yyyy-mm-dd"});	
					})					
				}

			}
			function validateNewUser(uname, pword1, pword2){
				if(uname.length<8 || pword1.length<8){
					$('#admin_alert').removeClass('hide');
					$('#alert_body').html('Username and Password should be at least 8 characters long!');
					setInterval(function(){$('#admin_alert').addClass('hide');}, 5000)
					return false;
				}
				else if(pword1!=pword2){
					$('#admin_alert').removeClass('hide');
					$('#alert_body').html('Passwords do not match!');
					setInterval(function(){$('#admin_alert').addClass('hide');}, 5000)					
					return false;
				}
				else{
					return true;
				}
			}
			
			function updateUser(uid, uname, access){
				$('#admin_modal .modal-title').html("Edit User");
				$('#admin_modal .modal-body').load('<?php echo base_url()."index.php/admin/editUser";?>', 
					{'uid':uid, 'uname':uname, 'access':access});
				$('#admin_modal').modal('show');	
				
			}
			function saveUserChanges(uid, uname, access){
				$('#admin_modal').modal('hide');
				$('#users').load('<?php echo base_url()."index.php/admin/changeUser";?>', {'uid':uid, 'uname':uname, 'access':access}, function(){
					$('#users_table').DataTable();
					$('#admin_alert').removeClass('hide');
					$('#alert_body').html('Successfully edited user access!');
					setInterval(function(){$('#admin_alert').addClass('hide');}, 5000)
				});
				
			}
			function deleteUser(uid, uname){
				if(confirm("Delete this user: " + uname + "?")==false){
					return false;
				}
				else{
					$('#users').load('<?php echo base_url()."index.php/admin/deleteUser"; ?>', {'uid':uid, 'uname':uname}, function(){
					$('#users_table').DataTable();
					$('#admin_alert').removeClass('hide');
					$('#alert_body').html('Successfully deleted user - '+uname+'!');				
					setInterval(function(){$('#admin_alert').addClass('hide');}, 5000)							
					});
				}
			}
			function addUser(uname, pword1, pword2, access){
				if (validateNewUser(uname, pword1, pword2)){
					$('#users').load('<?php echo base_url()."index.php/admin/addUser";?>', 
						{'uname':uname, 'pword':pword1, 'access':access}, function(){
							$('#users_table').DataTable();
							$('#admin_alert').removeClass('hide');
							$('#alert_body').html('Successfully added new user - '+uname+'!');				
							setInterval(function(){$('#admin_alert').addClass('hide');}, 5000)						
						})	
				}
			}
		</script>	
		<title>Admin Panel</title>
	</head>
	<body>
		<div class="alert alert-info hide" id="admin_alert" role="alert">
			<button type="button" class="close" onclick="$('#admin_alert').addClass('hide');" ><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<div id="alert_body"></div>
		</div>
		<div class="modal" id="admin_modal">
  			<div class="modal-dialog">
    			<div class="modal-content">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        				<h4 class="modal-title"></h4>
      				</div>
      				<div class="modal-body"></div>
    			</div><!-- /.modal-content -->
  			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-10">
				<ul class="nav nav-tabs" role="tablist">
  					<li class="active" ><a href="#users" data-toggle="tab" onclick="load_users();">Users</a></li>
  					<li><a href="#ulog" data-toggle="tab" onclick="load_logs();">User Log</a></li>
  					<li><a href="#bb" data-toggle="tab">Bulletin Board</a></li>
				</ul>					
				</div>
				<div class="col-md-1"><a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>/img/pricelist.png" width="50px" height="50px" title="Back to Pricelist Manager" /></a></div>
				<div class="col-md-1"><a href="<?php echo base_url()."index.php/log_in/log_out"; ?>"><img src="<?php echo base_url();?>/img/log_out.png" width="50px" height="50px" title="Log out" /></a></div>
				
			</div>
			<div class="row">
				<div class="tab-content">
				<div id="users" class="tab-pane active fade in"></div>
				<div id="ulog" class="tab-pane"></div>
				<div id="bb" class="tab-pane"></div>
				</div>
			</div>
		</div>

		
			
	</body>
</html>