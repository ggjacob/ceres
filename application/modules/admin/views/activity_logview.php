
<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-1"><h3>Period:</h3></div>
	<div class="col-md-3">
		<div class="input-append date" id="dp1" data-date-format="yyyy-mm-dd">		
			<label for="startdate">From: </label>
			<input class="datepicker" type="text" id="startdate" />
			<span class="add-on"><i class="icon-th"></i></span>			
		</div>
	</div>
	<div class="col-md-3">
		<div class="input-append date" id="dp2" data-date-format="yyyy-mm-dd">		
			<label for="enddate">To: </label>
			<input class="datepicker" type="text" id="enddate" />
			<span class="add-on"><i class="icon-th"></i></span>			
		</div>
	</div>	
	<div class="col-md-2">
		<button class="btn btn-default" onclick="periodLogs(startdate.value, enddate.value);">Submit</button>
	</div>		
</div>
<hr />
<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-10">
<table class="display" id="logs_table">
	<thead>
		<tr>
			<th>Date/Time</th>
			<th>User</th>
			<th>Activity</th>
		</tr>
	</thead>
	<tbody>
<?php
	foreach ($recent_logs as $row) {
		echo "<tr>";
		echo "<td>".$row->timestamp."</td>";
		echo "<td>".$row->user."</td>";
		echo "<td>".$row->activity."</td>";
	}
?>			
	</tbody>
</table>			
	</div>

</div>


