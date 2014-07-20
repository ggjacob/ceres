<form role="form">
	<div class="form-group">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-4"><h3>Add New User</h3></div>
		</div>
		
		<div class="row">
			<div class="col-md-1"></div>
		<div class="col-md-4">
			<label for="uname">User name:</label>
			<input class="form-control" type="text" id="uname" placeholder="at least 8 characters"/>			
		</div>
		</div>
		<div class="row">
			<div class="col-md-1"></div>
		<div class="col-md-4">
			<label for="pword1" >Password:</label>
			<input class="form-control" type="password" id="pword1" placeholder="at least 8 characters"/> 	
		</div>
		</div>
		<div class="row">
			<div class="col-md-1"></div>
		<div class="col-md-4">
			<label for="pword2">Retype Password:</label>
			<input class="form-control" type="password" id="pword2" placeholder="retype password" />
		</div>
		</div>
		<div class="row">
			<div class="col-md-1"></div>
		<div class="col-md-4">
			<label for="pword2">Access:</label>
			<select class="form-control" id="access">
				<?php 
					$z = 0;
					foreach($this->config->item('access_type') as $k){
						echo "<option value=\"".$z."\">".$k."</option>";
						$z++;
					}
				?>
			</select>
		</div>
		</div>		
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-4">
				<span class="btn btn-default" onclick="addUser(document.getElementById('uname').value, document.getElementById('pword1').value, document.getElementById('pword2').value, document.getElementById('access').value )">Save</span>						
			</div>
		</div>		
	</div>
</form>

<hr />
<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-10">
<table id="users_table" class="display">
	<thead>
		<tr>
			<th>No.</th>
			<th>User Name</th>
			<th>Access</th>
			<th>Password Changed</th>
			<th>Edit</th>
		</tr>
	</thead>
	<tbody>	
		<?php
			$x = 1;
			if($all_users){
				foreach($all_users as $row){
					echo "<tr>";
					echo "<td>".$x."</td>";
					echo "<td>".$row->uname."</td>";
					echo "<td>".$this->config->item($row->access_type, 'access_type')."</td>";
					echo "<td>".$this->config->item($row->pw_changed, 'pw_changed')."</td>";
					echo "<td><button class=\"btn btn-default\" onclick = \"updateUser('".$row->u_id."','".$row->uname."',".$row->access_type.");\">Edit</button><button class=\"btn btn-default\" onclick=\"deleteUser('".$row->u_id."', '".$row->uname."')\">Delete</button></td>";
					echo "</tr>";
					$x++;
				}
			}
		
		?>
	</tbody>
</table>			
	</div>

	
</div>


