<?php
	include "config.php";
	require_once "monitor.php";

	$monitor = new Monitor($db);

	try {
		$monitor_data = $monitor->getAll('monitor');

?>

<div class="monitors">

<h3>All Monitors:</h3>

<table style="width:100%">
<tr><th>monitor</th><th>type</th></tr>
	
<?php

		foreach($monitor_data as $row) {
			$name = $row['name'];
			$type = $row['monitor_type'];
			$monitor_id = $row['id'];
			$action = $row['action'];
?> 

<tr>
	<td style="width:50%"><?php echo $name; ?></td>
	<td style="width:20%"><?php echo $type; ?></td>
	<td style="width:30%">
		<form style="border:none;margin:0px;padding:0px;display:inline" action="monitorForm.php" method="post">
			<button type="submit" name="id" value="<?php echo $monitor_id; ?>">Edit</button>
		</form>
		<form style="border:none;margin:0px;padding:0px;display:inline" action="processMonitor.php" method="post">
			<button type="submit" name="action" value="<?php echo $monitor_id; ?>">
				<?php if ($action == "Paused") {
					echo "Start";
				} else {
					echo "Pause";
				}?>
			</button>
		</form>
	</td>
</tr>

<?php
		}
	} catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
		
	$db = null;
	
?> 

</table>

</div>


