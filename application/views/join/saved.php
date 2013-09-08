<!DOCTYPE html>
<html>
 <head>
   <title></title>
   <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<link href="<?php echo base_url();?>dist/modifications.css" rel="stylesheet" media="screen">
		<link href="<?php echo base_url();?>dist/css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="<?php echo base_url();?>dist/animate.css" rel="stylesheet" media="screen">
		<link href="<?php echo base_url();?>dist/css/bootstrap-glyphicons.css" rel="stylesheet" media="screen">
        <script type="text/javascript" src="<?php echo base_url();?>dist/jquery-1.10.2.js" ></script>
        <script type="text/javascript" src="<?php echo base_url();?>dist/js/bootstrap.js" ></script>
        <script type="text/javascript">
        	window.onload=function (){
        		$('.collapse').collapse('hide');
        	}
        </script>
 </head>
 
 <body>
    
    <?php
		$last=null;
		echo '<div class="panel-group" id="accordion">';
		for ($i=0; $i <sizeof($pcs) ; $i++) {
			if($pcs[$i]['lab_name']!=$last){
				//echo'<script type="text/javascript">alert("'.$pcs[$i]['lab_name'].'");</script>';
				if($i!==0){
            	echo '</tbody></table>';
				echo '</div></div></div>';
				}
				if($i!==sizeof($pcs)-1){
						echo 
						 '<div class="panel panel-default">
						    <div class="panel-heading">
						      <h4 class="panel-title">
						        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#'.$pcs[$i]['lab_name'].'">
						          '.$pcs[$i]['lab_name'].'
						        </a>
						      </h4>
						    </div>
						    <div id="'.$pcs[$i]['lab_name'].'" class="panel-collapse collapse in">
						      <div class="panel-body">';
				echo '<table class="table table-bordered table-hover text-center"><thead class="panel-heading"><tr><th class="text-center">Lab Name</th><th class="text-center">PC Number</th><th class="text-center">Status</th></tr><thead><tbody>';
				}
			
			}
			echo
				 '<tr>'
				. '<td>' . $pcs[$i]['lab_name'] . '</td>'
				. '<td>'. $pcs[$i]['pc_name'] . '</td>'
				. '<td>'. $pcs[$i]['pc_is_working']. '</td>'
				.'</tr>';
			$last = $pcs[$i]['lab_name'];
        }
		echo '</div>';
    ?>
    
    
 </body>
</html>
