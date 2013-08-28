<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<?php echo validation_errors(); ?> 

<?php echo form_open('join_employee/save'); ?>

<?php


//form building

?>
<p>&nbsp;</p>
  <table width="349" border="0" align="center" dir="rtl">
    <tbody>
    <tr>
    <td>
<?php    
    $emp_fname = array(
      'name' => 'emp_fname',
      'id' => 'emp_fname',

    );
    
    echo form_input($emp_fname);
    echo form_label('First Name','emp_fname');
    echo '<br />';
    ?>
    </td>
    </tr>
    <tr>
      <td>
    <?php
    $emp_lname = array(
      'name' => 'emp_lname',
      'id' => 'emp_lname',

    );
    
    echo form_input($emp_lname);
    echo form_label('Last Name','emp_lname');
    echo '<br />';
    
    ?>
    </td>
     </tr>
    <tr>
    <td>
    
    <?php
    echo form_submit('submit','Register');
    ?>
    </td>
    </tr>
    </tbody></table>
    <p>&nbsp;</p>
    
    <?php
    echo form_close();

?>
	<div id="footer">
		<div class="clearfix">
			<div id="connect">
				<a href="http://freewebsitetemplates.com/go/facebook/" target="_blank" class="facebook"></a><a href="http://freewebsitetemplates.com/go/googleplus/" target="_blank" class="googleplus"></a><a href="http://freewebsitetemplates.com/go/twitter/" target="_blank" class="twitter"></a><a href="http://www.freewebsitetemplates.com/misc/contact/" target="_blank" class="tumbler"></a>
			</div>
			<p>
				© 2013 FITE. All Rights Reserved.
			</p>
		</div>
	</div>