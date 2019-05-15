<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='../fullcalendar.css' rel='stylesheet' />
<link href='../fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='../lib/moment.min.js'></script>
<script src='../lib/jquery.min.js'></script>
<script src='../fullcalendar.min.js'></script>

<script type="text/javascript">

	$(document).ready(function() {

		//var arr = [];
		//var i=0;
		//for (var j = 0; j < 10; j++)
		//{
//			arr[j] = ["<?php echo "{title: 'eat me'"; ?>", "<?php echo "url: './gcal.html'"; ?>", "<?php echo "start: '2015-02-01'}"; ?>"];
		//}
		
		//alert (arr);
		
		
		
		$('#calendar').fullCalendar({
		    editable: true,
			eventSources:
			[
				{   // Render the events in the calendar
					url: './CalendarData.php', // Get the URL of the json feed
					error: function() 
					{
						alert('There Was An Error While Fetching Events Or The Events Are Not Found!');
					}
				}
			]
		});
		
	});
	
	
	
</script>
<style>

	body {
		margin: 40px 10px;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		max-width: 800px;
		margin: 0 auto;
	}

</style>
</head>
<body>

	<div id='calendar'></div>
	
		<?php $htmlString= 'testing'; ?>

			<script type="text/javascript">  // notice the quotes around the ?php tag         
  				var htmlString="<?php echo $htmlString; ?>";
			</script>

	</body>
</html>
