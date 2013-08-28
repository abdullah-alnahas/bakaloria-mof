<!DOCTYPE html>
<html lang="ar" dir="rtl">
	<head>
		<title>تنظيم دخول الطلاب إلى قاعات المفاضلة</title>
        
        <?= link_tag(base_url().'dist/css/bootstrap.css'); ?>
        
        
		<link href="dist/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        
        <script type="text/javascript" src="<?php echo base_url();?>jquery.js" ></script>
        <script type="text/javascript" src="<?php echo base_url();?>dist/js/bootstrap.js" ></script>
        <script type="text/javascript">
            function try(){
            $.post('<?echo base_url()?>'+'join/lab_name',function(data){alert(data);});
            }
        </script>
        </head>

<body>
                
    
      			<div class="row" id="add">
				<div class="col-lg-8 col-lg-offset-2">
					<div class="">
						<form class="form-horizontal" action="http://localhost/codeigniter/index.php/join_employee/save" method="post" accept-charset="utf-8" >
						
							<div class="form-group">
								<div class="col-lg-7"></div>
								<div class="col-lg-3">
									<input type="text" class="form-control" id="emp_fname" name="emp_fname" placeholder="اسم الطالب">
								</div>
								<label for="st_fname" class="col-lg-2 control-label">الاسم</label>
							</div>
						  
							<div class="form-group ">
								<div class="col-lg-7"></div>
								<div class="col-lg-3">
									<input type="text" class="form-control" id="emp_lname" name="emp_lname" placeholder="كنية الطالب">
								</div>
								<label for="st_lname" class="col-lg-2  control-label">الكنية</label>
							</div>
						  
							<div class="form-group">
								<div class="col-lg-4"></div>
								<div class="col-lg-8">
									<input  id="add" class="btn pull-left btn-primary btn-lg" value="إضافة" type="submit" onclick="true" />
								</div>
							</div>
						  <button onclick="try();return false;">Click</button>
						</form>
					</div>
				</div>
			</div>
    
</body>
</html>
