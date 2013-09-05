<!DOCTYPE hHTML>
<html>
	<head>
		<title>رقم الدور</title>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<link href="<?php echo base_url();?>dist/css/bootstrap.css" rel="stylesheet" media="screen">
        <script type="text/javascript" src="<?php echo base_url();?>dist/jquery-1.10.2.js" ></script>
        <script type="text/javascript" src="<?php echo base_url();?>dist/js/bootstrap.js" ></script>
		<script type="text/javascript">
        	window.onload = function(){
        		setInterval(comet, 1000);
        		comet();
        	}
        </script>
		<script type="text/javascript">
			var _timestamp = null;
			function comet() {
				$.getJSON("<?php echo site_url('join/syncCounterValue');?>",{timestamp:_timestamp})
				.done( function(json) {
					counter = json.counterVal;
					_timestamp  = json.timestamp;
					digitsOfCounter = new Array(); 
					i = 0;
					       
					do{
						temp = counter % 10;
						counter = Math.floor(counter/10);
						digitsOfCounter[i] = temp;
						i++;
					}
					while (counter !==0);
					$('#count').html('');
					for(j= i-1;j>=0;j--){
						$('#count').append('<img src="<?php echo base_url('assets/images/blue');?>/' +digitsOfCounter[j]+'.jpg" style="width: 400px;height: 100%" />');
					}
				})
				.fail(function( jqxhr, textStatus, error ) {
				  var err = textStatus + ', ' + error;
				  console.log( "Request Failed: " + err);
				});
			}
		</script>
	</head>
	<body>
		<div >
			<center id="count">
				<!-- image tags should be added here -->
			</center>
		</div>
	</body>
</html>