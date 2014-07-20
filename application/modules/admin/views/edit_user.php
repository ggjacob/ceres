<form role="form">
	<div class="form-group">
		<label for="uname">Username:</label>
		<input class="form-control" type="text" id="uname" readonly="readonly" value="<?php echo $uname;?>"/>
		<label for="access">Access:</label>
		<select class="form-control" id="access">
			<?php
				$y = 0;
				foreach($this->config->item('access_type') as $k){
					if(!strcmp($this->config->item($access, 'access_type'), $this->config->item($y, 'access_type'))){
						echo "<option value=\"".$y."\" selected=\"selected\">".$k."</option>";
					}
					else{
						echo "<option value=\"".$y."\">".$k."</option>";
					}
					$y++;
				}
			?>		
		</select>		
		<hr />
	</div>
</form>
       	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       	<button type="button" class="btn btn-primary" onclick="saveUserChanges('<?php echo $uid;?>', '<?php echo $uname;?>', document.getElementById('access').value)">Save changes</button>
      				
