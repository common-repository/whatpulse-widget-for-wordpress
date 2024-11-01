<?php

/*

Plugin Name: 	Whatpulse Plugin
Plugin URI: 	http://www.mycardboardbox.co.uk
Description: 	Show all of your Whatpulse statistics in a widget on your Wordpress website
Version: 		1.0
Author: 		Christopher Smith
Author URI: 	http://www.mycardboardbox.co.uk

*/

function widget_whatpulse($args) 
{

	extract($args);
	
	$options = get_option("widget_whatpulse");
			
	// Get JSON 
	$link = file_get_contents('http://api.whatpulse.org/user.php?UserID='.$options['UserID'].'&format=json');
	
	$data = json_decode($link, TRUE);
	
	// Display the widget
	echo $before_widget;
	echo $before_title;
	echo $options['WidgetTitle'];
	echo $after_title;
	
	echo "<div style=\"line-height: 16px;\">";
	
	if(!is_array($data))
	{
		echo "<b>Error:</b><br/>Something has gone wrong.<br/>Click <a href=\"http://api.whatpulse.org/user.php?UserID=".$options['UserID']."\">here</a> to find out what!";
	}
	else
	{
	
		echo "<b>User Details:</b><br/>".$data['AccountName']."<br/>";
		echo ($options['Country'] == 'checked') ? $data['Country'] . " <img src=\"http://amcdn.whatpulse.org/images/countries/".strtolower($data['tld']).".png\"><br />": "";
		echo ($options['DateJoined'] == 'checked') ? "User Since ". $data['DateJoined'] ."<br />" : "";
		echo ($options['Homepage'] == 'checked') ? " <a href=\"".$data['Homepage']."\">Visit Homepage</a>" ."<br />" : "";
		echo "<br/>";
	
		if($options['LastPulse'] == 'checked' || $options['Pulses'] == 'checked' || $options['Keys'] == 'checked' || $options['Clicks'] == 'checked' || $options['Download'] == 'checked'
		   || $options['Upload'] == 'checked' || $options['DownloadMB'] == 'checked' || $options['UploadMB'] == 'checked' || $options['UptimeSeconds'] == 'checked' || $options['UptimeShort'] == 'checked'
		   || $options['UptimeLong'] == 'checked' || $options['AvKeysPerPulse'] == 'checked' || $options['AvClicksPerPulse'] == 'checked' || $options['AvKPS'] == 'checked' || $options['AvCPS'] == 'checked')
		{
			echo "<b>User Statistics:</b><br/>";
		}
	
		echo ($options['LastPulse'] == 'checked') ? "<i>Last Pulse:</i> ". $data['LastPulse'] ."<br />" : "";
		echo ($options['Pulses'] == 'checked') ? "<i>Total Pulses:</i> ". $data['Pulses'] ."<br />" : "";
		echo ($options['Keys'] == 'checked') ? "<i>Total Keys:</i> ". $data['Keys'] ."<br />" : "";
		echo ($options['Clicks'] == 'checked') ? "<i>Total Clicks:</i> ". $data['Clicks'] ."<br />" : "";
		echo ($options['Download'] == 'checked') ? "<i>Total Downloaded:</i> ". $data['Download'] ."<br />" : "";
		echo ($options['Upload'] == 'checked') ? "<i>Total Uploaded:</i> ". $data['Upload'] ."<br />" : "";
		echo ($options['UptimeShort'] == 'checked') ? "<i>Uptime (Short):</i> ". $data['UptimeShort'] ."<br />" : "";
		echo ($options['AvKeysPerPulse'] == 'checked') ? "<i>Average KPP:</i> ". $data['AvKeysPerPulse'] ."<br />" : "";
		echo ($options['AvClicksPerPulse'] == 'checked') ? "<i>Average CPP:</i> ". $data['AvClicksPerPulse'] ."<br />" : "";
		echo ($options['AvKPS'] == 'checked') ? "<i>Average KPS:</i> ". $data['AvKPS'] ."<br />" : "";
		echo ($options['AvCPS'] == 'checked') ? "<i>Average CPS:</i> ". $data['AvCPS'] ."<br />" : "";
		
		echo ($options['Ranks']['Keys'] == 'checked' || $options['Ranks']['Clicks'] == 'checked' || $options['Ranks']['Download'] == 'checked' || $options['Ranks']['Upload'] == 'checked' || $options['Ranks']['Uptime'] == 'checked') ? "<br /><b>Personal Ranks:</b><br />" : "";
		
		echo ($options['Ranks']['Keys'] == 'checked') ? "<i>Keys:</i> ". $data['Ranks']['Keys'] ."<br />" : "";
		echo ($options['Ranks']['Clicks'] == 'checked') ? "<i>Clicks:</i> ". $data['Ranks']['Clicks'] ."<br />" : "";
		echo ($options['Ranks']['Download'] == 'checked') ? "<i>Download:</i> ". $data['Ranks']['Download'] ."<br />" : "";
		echo ($options['Ranks']['Upload'] == 'checked') ? "<i>Upload:</i> ". $data['Ranks']['Upload'] ."<br />" : "";
		echo ($options['Ranks']['Uptime'] == 'checked') ? "<i>Uptime:</i> ". $data['Ranks']['Uptime'] ."<br />" : "";
		
		if($options['computer']['Display'] == 'checked')
		{
			if( count($data['Computers']) != 0)
			{
				echo "<br/><b>Computers:</b><br/>";
				foreach (explode(',',$options['computer']['IDS']) as $ID)
				{
					if(isset($data['Computers']['computer-'.$ID]))
					{
						echo "<br /><u>".$data['Computers']['computer-'.$ID]['Name']."</u><br/><br/>";
						echo ($options['computer']['Keys'] == 'checked') ? "<i>Total Keys:</i> ". $data['Computers']['computer-'.$ID]['Keys'] ."<br />" : "";
						echo ($options['computer']['Clicks'] == 'checked') ? "<i>Total Clicks:</i> ". $data['Computers']['computer-'.$ID]['Clicks'] ."<br />" : "";
						echo ($options['computer']['Download'] == 'checked') ? "<i>Total Downloaded:</i> ". $data['Computers']['computer-'.$ID]['Download'] ."<br />" : "";
						echo ($options['computer']['Upload'] == 'checked') ? "<i>Total Uploaded:</i> ". $data['Computers']['computer-'.$ID]['Upload'] ."<br />" : "";
						echo ($options['computer']['UptimeShort'] == 'checked') ? "<i>Uptime (Short):</i> ". $data['Computers']['computer-'.$ID]['UptimeShort'] ."<br />" : "";
						echo ($options['computer']['Pulses'] == 'checked') ? "<i>Total Pulses:</i> ". $data['Computers']['computer-'.$ID]['Pulses'] ."<br />" : "";
						echo ($options['computer']['LastPulse'] == 'checked') ? "<i>Last Pulse:</i> ". $data['Computers']['computer-'.$ID]['LastPulse'] ."<br />" : "";
					}
				}
			}
		}
		
		if($options['Team']['Display'] == 'checked')
		{
			if (is_array($data['Team']) != 0)
			{
				echo "<br/><b>Team Statistics</b><br/>";
				echo ($options['Team']['Name'] == 'checked') ? $data['Team']['Name']."<br />" : "";
				echo ($options['Team']['Members'] == 'checked') ? $data['Team']['Members']." Members<br />" : ""; 
				echo ($options['Team']['Keys'] == 'checked') ? "<i>Total Keys:</i> ".$data['Team']['Keys']."<br />" : ""; 
				echo ($options['Team']['Clicks'] == 'checked') ? "<i>Total Clicks:</i> ".$data['Team']['Clicks']."<br />" : "";
				echo ($options['Team']['Download'] == 'checked') ? "<i>Total Download:</i> ".$data['Team']['Upload']."<br />" : "";
				echo ($options['Team']['Upload'] == 'checked') ? "<i>Total Upload:</i> ".$data['Team']['Download']."<br />" : ""; 
				if ($options['Team']['Ranks']['Keys'] == 'checked' || $options['Team']['Ranks']['Clicks'] || $options['Team']['Ranks']['Download'] || $options['Team']['Ranks']['Upload'] || $options['Team']['Ranks']['Uptime'])
				{
					echo "<br /><b>Team Ranks:</b><br/>";
				}
				echo ($options['Team']['Ranks']['Keys'] == 'checked') ? "<i>Keys:</i> ".$data['Team']['Ranks']['Keys']."<br />" : "";
				echo ($options['Team']['Ranks']['Clicks'] == 'checked') ? "<i>Clicks:</i> ".$data['Team']['Ranks']['Clicks']."<br />" : "";
				echo ($options['Team']['Ranks']['Download'] == 'checked') ? "<i>Download:</i> ".$data['Team']['Ranks']['Download']."<br />" : "";
				echo ($options['Team']['Ranks']['Upload'] == 'checked') ? "<i>Upload:</i> ".$data['Team']['Ranks']['Upload']."<br />" : "";
				echo ($options['Team']['Ranks']['Uptime'] == 'checked') ? "<i>Uptime:</i> ".$data['Team']['Ranks']['Uptime']."<br />" : "";
			}
		}
	}
	
	echo "</div>";
	
}

function whatpulsewidget_control()
{

	// Grab preset options
	$options = get_option("widget_whatpulse");
	
	// If no options are set, set them
	if (!is_array( $options )) 
	{ 
		$options = array();
		$options['WidgetTitle'] 		= 'Widget Title';
		$options['UserID'] 			= '1';
		$options['AccountName']			= 'checked';
		$options['Country'] 			= 'checked';
		$options['DateJoined'] 			= 'checked';
		$options['Homepage'] 			= 'checked';
		$options['LastPulse'] 			= 'checked';
		$options['Pulses'] 			= 'checked';
		$options['Keys'] 			= 'checked';
		$options['Clicks'] 			= 'checked';
		$options['Download'] 			= 'checked';
		$options['Upload'] 			= 'checked';
		$options['UptimeShort']	 		= 'checked';
		$options['AvKeysPerPulse'] 		= 'checked';
		$options['AvClicksPerPulse'] 		= 'checked';
		$options['AvKPS'] 			= 'checked';
		$options['AvCPS'] 			= 'checked';
		$options['Ranks']['Keys'] 		= 'checked';
		$options['Ranks']['Clicks'] 		= 'checked';
		$options['Ranks']['Download'] 		= 'checked';
		$options['Ranks']['Upload'] 		= 'checked';
		$options['Ranks']['Uptime'] 		= 'checked';
		$options['computer']['Display']		= 'checked';
		$options['computer']['IDS']		= '0,1,3,4,5,6,7,8,9';
		$options['computer']['Name'] 		= 'checked';
		$options['computer']['Keys'] 		= 'checked';
		$options['computer']['Clicks'] 		= 'checked';
		$options['computer']['Download'] 	= 'checked';
		$options['computer']['Upload'] 		= 'checked';
		$options['computer']['UptimeShort'] 	= 'checked';
		$options['computer']['Pulses'] 		= 'checked';
		$options['computer']['LastPulse'] 	= 'checked';
		$options['Team']['Display']		= 'checked';
		$options['Team']['Name']		= 'checked';
		$options['Team']['Members']		= 'checked';
		$options['Team']['Keys']		= 'checked';
		$options['Team']['Clicks']		= 'checked';
		$options['Team']['Download']		= 'checked';
		$options['Team']['Upload']		= 'checked';
		$options['Team']['UptimeShort']		= 'checked';
		$options['Team']['Description']		= 'checked';
		$options['Team']['DateFormed']		= 'checked';
		$options['Team']['Ranks']['Keys']	= 'checked';
		$options['Team']['Ranks']['Clicks']	= 'checked';
		$options['Team']['Ranks']['Download']	= 'checked';
		$options['Team']['Ranks']['Upload']	= 'checked';
		$options['Team']['Ranks']['Uptime']	= 'checked';	
	}
	
	// Check to see if user has submitted form, if they have - grab them
	if($_POST['whatpulseSubmit'])
	{
		$options['WidgetTitle'] 		= (!empty($_POST['WidgetTitle'])) ? htmlspecialchars($_POST['WidgetTitle']) : "Whatpulse Statistcs";
		$options['UserID'] 			= (!empty($_POST['UserID'])) ? htmlspecialchars($_POST['UserID']) : "1";
		$options['AccountName']			= "checked";
		$options['Country'] 			= ($_POST['Country'] == "checked") ? "checked" : "";
		$options['DateJoined'] 			= ($_POST['DateJoined'] == "checked") ? "checked" : "";
		$options['Homepage'] 			= ($_POST['Homepage'] == "checked") ? "checked" : "";
		$options['LastPulse'] 			= ($_POST['LastPulse'] == "checked") ? "checked" : "";
		$options['Pulses'] 			= ($_POST['Pulses'] == "checked") ? "checked" : "";
		$options['Keys'] 			= ($_POST['Keys'] == "checked") ? "checked" : "";
		$options['Clicks'] 			= ($_POST['Clicks'] == "checked") ? "checked" : "";
		$options['Download'] 			= ($_POST['Download'] == "checked") ? "checked" : "";
		$options['Upload'] 			= ($_POST['Upload'] == "checked") ? "checked" : "";
		$options['UptimeShort']	 		= ($_POST['UptimeShort'] == "checked") ? "checked" : "";
		$options['AvKeysPerPulse'] 		= ($_POST['AvKeysPerPulse'] == "checked") ? "checked" : "";
		$options['AvClicksPerPulse'] 		= ($_POST['AvClicksPerPulse'] == "checked") ? "checked" : "";
		$options['AvKPS'] 			= ($_POST['AvKPS'] == "checked") ? "checked" : "";
		$options['AvCPS'] 			= ($_POST['AvCPS'] == "checked") ? "checked" : "";
		$options['Ranks']['Keys'] 		= ($_POST['RanksKeys'] == "checked") ? "checked" : "";
		$options['Ranks']['Clicks'] 		= ($_POST['RanksClicks'] == "checked") ? "checked" : "";
		$options['Ranks']['Download'] 		= ($_POST['RanksDownload'] == "checked") ? "checked" : "";
		$options['Ranks']['Upload'] 		= ($_POST['RanksUpload'] == "checked") ? "checked" : "";
		$options['Ranks']['Uptime'] 		= ($_POST['RanksUptime'] == "checked") ? "checked" : "";
		$options['computer']['Display']		= ($_POST['ComputerDisplay'] == "checked") ? "checked" : "";
		$options['computer']['IDS']		= (!empty($_POST['ComputerIDS'])) ? htmlspecialchars($_POST['ComputerIDS']) : "0";
		$options['computer']['Name'] 		= ($_POST['ComputerName'] == "checked") ? "checked" : "";
		$options['computer']['Keys'] 		= ($_POST['ComputerKeys'] == "checked") ? "checked" : "";
		$options['computer']['Clicks'] 		= ($_POST['ComputerClicks'] == "checked") ? "checked" : "";
		$options['computer']['Download'] 	= ($_POST['ComputerDownload'] == "checked") ? "checked" : "";
		$options['computer']['Upload'] 		= ($_POST['ComputerUpload'] == "checked") ? "checked" : "";
		$options['computer']['UptimeShort'] 	= ($_POST['ComputerUptimeShort'] == "checked") ? "checked" : "";
		$options['computer']['Pulses'] 		= ($_POST['ComputerPulses'] == "checked") ? "checked" : "";
		$options['computer']['LastPulse'] 	= ($_POST['ComputerLastPulse'] == "checked") ? "checked" : "";
		$options['Team']['Display']		= ($_POST['TeamDisplay'] == "checked") ? "checked" : "";
		$options['Team']['Name']		= ($_POST['TeamName'] == "checked") ? "checked" : "";
		$options['Team']['Members']		= ($_POST['TeamMembers'] == "checked") ? "checked" : "";
		$options['Team']['Keys']		= ($_POST['TeamKeys'] == "checked") ? "checked" : "";
		$options['Team']['Clicks']		= ($_POST['TeamClicks'] == "checked") ? "checked" : "";
		$options['Team']['Download']		= ($_POST['TeamDownload'] == "checked") ? "checked" : "";
		$options['Team']['Upload']		= ($_POST['TeamUpload'] == "checked") ? "checked" : "";
		$options['Team']['UptimeShort']		= ($_POST['TeamUptimeShort'] == "checked") ? "checked" : "";
		$options['Team']['Description']		= ($_POST['TeamDescription'] == "checked") ? "checked" : "";
		$options['Team']['DateFormed']		= ($_POST['TeamDateFormed'] == "checked") ? "checked" : "";
		$options['Team']['Ranks']['Keys']	= ($_POST['TeamRanksKeys'] == "checked") ? "checked" : "";
		$options['Team']['Ranks']['Clicks']	= ($_POST['TeamRanksClicks'] == "checked") ? "checked" : "";
		$options['Team']['Ranks']['Download']	= ($_POST['TeamRanksDownload'] == "checked") ? "checked" : "";
		$options['Team']['Ranks']['Upload']	= ($_POST['TeamRanksUpload'] == "checked") ? "checked" : "";
		$options['Team']['Ranks']['Uptime']	= ($_POST['TeamRanksUptime'] == "checked") ? "checked" : "";
		update_option("widget_whatpulse", $options);
	}
	
	?>
	<p>
	
	<label for="WidgetTitle">Widget Title:</label><br /><input type="text" class="widefat" id="WidgetTitle" name="WidgetTitle" value="<?php echo $options["WidgetTitle"]; ?>" /><br /><br />
	<label for="UserID">User ID:</label><br /><input type="text" class="widefat" id="UserID" name="UserID" value="<?php echo $options["UserID"]; ?>" /><br /><br />
	
	<label for="GeneratedTime"><b>User Options:</b></label><br />
	<input type="checkbox" name="AccountName" value="checked" disabled="disabled" checked="checked" <?php echo $options['AccountName']; ?> /> Show Account Name <br />
	<input type="checkbox" name="Country" value="checked" <?php echo $options['Country']; ?> /> Show Country <br />
	<input type="checkbox" name="DateJoined" value="checked" <?php echo $options['DateJoined']; ?> /> Show Date Joined <br />
	<input type="checkbox" name="Homepage" value="checked" <?php echo $options['Homepage']; ?> /> Show Homepage <br />
	<br /><label><b>User Statistics:</b></label><br />
	<input type="checkbox" name="LastPulse" value="checked" <?php echo $options['LastPulse']; ?> /> Show Last Pulse <br />
	<input type="checkbox" name="Pulses" value="checked" <?php echo $options['Pulses']; ?> /> Show Total Pulses <br />
	<input type="checkbox" name="Keys" value="checked" <?php echo $options['Keys']; ?> /> Show Total Keys <br />
	<input type="checkbox" name="Clicks" value="checked" <?php echo $options['Clicks']; ?> /> Show Total Clicks <br />
	<input type="checkbox" name="Download" value="checked" <?php echo $options['Download']; ?> /> Show Total Downloaded <br />
	<input type="checkbox" name="Upload" value="checked" <?php echo $options['Upload']; ?> /> Show Total Uploaded <br />
	<input type="checkbox" name="UptimeShort" value="checked" <?php echo $options['UptimeShort']; ?> /> Show Uptime (Short) <br />
	<input type="checkbox" name="AvKeysPerPulse" value="checked" <?php echo $options['AvKeysPerPulse']; ?> /> Show Averags KPP <br />
	<input type="checkbox" name="AvClicksPerPulse" value="checked" <?php echo $options['AvClicksPerPulse']; ?> /> Show Average CPP <br />
	<input type="checkbox" name="AvKPS" value="checked" <?php echo $options['AvKPS']; ?> /> Show Averags KPS <br />
	<input type="checkbox" name="AvCPS" value="checked" <?php echo $options['AvCPS']; ?> /> Show Averags CPS <br />
	<input type="checkbox" name="RanksKeys" value="checked" <?php echo $options['Ranks']['Keys']; ?> /> Show Rank (Keys) <br />
	<input type="checkbox" name="RanksClicks" value="checked" <?php echo $options['Ranks']['Clicks']; ?> /> Show Rank (Clicks) <br />
	<input type="checkbox" name="RanksDownload" value="checked" <?php echo $options['Ranks']['Download']; ?> /> Show Rank (Download) <br />
	<input type="checkbox" name="RanksUpload" value="checked" <?php echo $options['Ranks']['Upload']; ?> /> Show Rank (Upload) <br />
	<input type="checkbox" name="RanksUptime" value="checked" <?php echo $options['Ranks']['Uptime']; ?> /> Show Rank (Uptime) <br />
	<br /><label><b>Computer Statistics:</b></label><br />
	<input type="checkbox" id="ComputerDisplay" name="ComputerDisplay" value="checked" <?php  echo $options['computer']['Display']; ?> /> Display Computer Statistcs<br /><br />
	<label for="ComputerIDS">Computer IDS</label><br/><input type="text" class="widefat" name="ComputerIDS" id="ComputerIDS" value="<?php echo $options['computer']['IDS']; ?>" /><br /><br />
	<input type="checkbox" disabled name="ComputerName" value="checked" <?php  echo $options['computer']['Name']; ?> /> Show Computer Name<br />
	<input <?php echo ($options['computer']['Display'] != 'checked') ? "disabled" : "" ?> type="checkbox" class="computerCheckbox" name="ComputerClicks" value="checked" <?php  echo $options['computer']['Clicks']; ?> /> Show Total Clicks<br />
	<input <?php echo ($options['computer']['Display'] != 'checked') ? "disabled" : "" ?> type="checkbox" class="computerCheckbox" name="ComputerKeys" value="checked" <?php  echo $options['computer']['Keys']; ?> /> Show Total Keys<br />
	<input <?php echo ($options['computer']['Display'] != 'checked') ? "disabled" : "" ?> type="checkbox" class="computerCheckbox" name="ComputerDownload" value="checked" <?php  echo $options['computer']['Download']; ?> /> Show Total Downloaded<br />
	<input <?php echo ($options['computer']['Display'] != 'checked') ? "disabled" : "" ?> type="checkbox" class="computerCheckbox" name="ComputerUpload" value="checked" <?php  echo $options['computer']['Upload']; ?> /> Show Total Uploaded<br />
	<input <?php echo ($options['computer']['Display'] != 'checked') ? "disabled" : "" ?> type="checkbox" class="computerCheckbox" name="ComputerUptimeShort" value="checked" <?php  echo $options['computer']['UptimeShort']; ?> /> Show Computer Uptime<br />
	<input <?php echo ($options['computer']['Display'] != 'checked') ? "disabled" : "" ?> type="checkbox" class="computerCheckbox" name="ComputerPulses" value="checked" <?php  echo $options['computer']['Pulses']; ?> /> Show Total Pulses<br />
	<input <?php echo ($options['computer']['Display'] != 'checked') ? "disabled" : "" ?> type="checkbox" class="computerCheckbox" name="ComputerLastPulse" value="checked" <?php  echo $options['computer']['LastPulse']; ?> /> Show Last Pulse<br />
	<br /><label><b>Team Statistics:</b></label><br />
	<input id="TeamDisplay" type="checkbox" name="TeamDisplay" value="checked" <?php  echo $options['Team']['Display']; ?> /> Display Team Statistcs<br />
	<input <?php echo ($options['Team']['Display'] != 'checked') ? "disabled" : "" ?> type="checkbox" class="teamCheckbox" name="TeamName" value="checked" <?php  echo $options['Team']['Name']; ?> /> Show Team Name<br />
	<input <?php echo ($options['Team']['Display'] != 'checked') ? "disabled" : "" ?> type="checkbox" class="teamCheckbox" name="TeamMembers" value="checked" <?php  echo $options['Team']['Members']; ?> /> Show Member Count<br />
	<input <?php echo ($options['Team']['Display'] != 'checked') ? "disabled" : "" ?> type="checkbox" class="teamCheckbox" name="TeamKeys" value="checked" <?php  echo $options['Team']['Keys']; ?> /> Show Total Keys<br />
	<input <?php echo ($options['Team']['Display'] != 'checked') ? "disabled" : "" ?> type="checkbox" class="teamCheckbox" name="TeamClicks" value="checked" <?php  echo $options['Team']['Clicks']; ?> /> Show Total Clicks<br />
	<input <?php echo ($options['Team']['Display'] != 'checked') ? "disabled" : "" ?> type="checkbox" class="teamCheckbox" name="TeamDownload" value="checked" <?php  echo $options['Team']['Download']; ?> /> Show Total Downloaded<br />
	<input <?php echo ($options['Team']['Display'] != 'checked') ? "disabled" : "" ?> type="checkbox" class="teamCheckbox" name="TeamUpload" value="checked" <?php  echo $options['Team']['Upload']; ?> /> Show Total Uploaded<br />
	<input <?php echo ($options['Team']['Display'] != 'checked') ? "disabled" : "" ?> type="checkbox" class="teamCheckbox" name="TeamUptimeShort" value="checked" <?php  echo $options['Team']['UptimeShort']; ?> /> Show Total Uptime<br />
	<input <?php echo ($options['Team']['Display'] != 'checked') ? "disabled" : "" ?> type="checkbox" class="teamCheckbox" name="TeamDescription" value="checked" <?php  echo $options['Team']['Description']; ?> /> Show Team Description<br />
	<input <?php echo ($options['Team']['Display'] != 'checked') ? "disabled" : "" ?> type="checkbox" class="teamCheckbox" name="TeamDateFormed" value="checked" <?php  echo $options['Team']['DateFormed']; ?> /> Show Date Formed<br />
	<input <?php echo ($options['Team']['Display'] != 'checked') ? "disabled" : "" ?> type="checkbox" class="teamCheckbox" name="TeamRanksKeys" value="checked" <?php  echo $options['Team']['Ranks']['Keys']; ?> /> Show Rank (Keys)<br />
	<input <?php echo ($options['Team']['Display'] != 'checked') ? "disabled" : "" ?> type="checkbox" class="teamCheckbox" name="TeamRanksClicks" value="checked" <?php  echo $options['Team']['Ranks']['Clicks']; ?> /> Show Rank (Clicks)<br />
	<input <?php echo ($options['Team']['Display'] != 'checked') ? "disabled" : "" ?> type="checkbox" class="teamCheckbox" name="TeamRanksDownload" value="checked" <?php  echo $options['Team']['Ranks']['Download']; ?> /> Show Rank (Download)<br />
	<input <?php echo ($options['Team']['Display'] != 'checked') ? "disabled" : "" ?> type="checkbox" class="teamCheckbox" name="TeamRanksUpload" value="checked" <?php  echo $options['Team']['Ranks']['Upload']; ?> /> Show Rank (Upload)<br />
	<input <?php echo ($options['Team']['Display'] != 'checked') ? "disabled" : "" ?> type="checkbox" class="teamCheckbox" name="TeamRanksUptime" value="checked" <?php  echo $options['Team']['Ranks']['Uptime']; ?> /> Show Rank (Uptime)<br />
	
	<input type="hidden" id="whatpulseSubmit" name="whatpulseSubmit" value="1" />
	
	</p>
	<?php
	
}

function whatpulseWidget_init()
{
	register_sidebar_widget('Whatpulse Widget', 'widget_whatpulse');
	register_widget_control('Whatpulse Widget', 'whatpulseWidget_control');
}

function whatpulseScript()
{
	?>
	<script>
		jQuery(document).ready(function($) {
			
			$('input#ComputerDisplay').change(function(){
				if(this.checked)
					$('input.computerCheckbox').removeAttr('disabled');
				else
					$('input.computerCheckbox').attr('disabled', 'disabled');
			});
			
			$('input#TeamDisplay').change(function(){
				if(this.checked)
					$('input.teamCheckbox').removeAttr('disabled');
				else
					$('input.teamCheckbox').attr('disabled', 'disabled');
			});
		
		});
	</script>
	<?php
}
add_action("plugins_loaded", "whatpulseWidget_init");
add_action("admin_head", "whatpulseScript");
?>
