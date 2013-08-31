<!DOCTYPE html>
<html lang="ar" dir="rtl">
	<head>
		<title>تنظيم دخول الطلاب إلى قاعات المفاضلة</title>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<link href="<?php echo base_url();?>dist/modifications.css" rel="stylesheet" media="screen">
		<link href="<?php echo base_url();?>dist/css/bootstrap.css" rel="stylesheet" media="screen">
        <script type="text/javascript" src="<?php echo base_url();?>dist/jquery.js" ></script>
        <script type="text/javascript" src="<?php echo base_url();?>dist/js/bootstrap.js" ></script>
		<script type="text/javascript">		
			function check(){
				fname = $('#fname').val();
				lname = $('#lname').val();
				phone = $('#phone').val();
				faname = $('#faname').val();
				mname = $('#mname').val();
				queue_num = $('#queue_num').val();
				if(fname!="" && lname!="" && phone!="" && faname!="" && mname!=""&&queue_num!=""){
					$("#st_fname").attr('value',fname);
					$("#st_lname").attr('value',lname);
					$("#st_phone").attr('value',phone);
					$("#st_faname").attr('value',faname);
					$("#st_mname").attr('value',mname);
					$("#st_queue_num").attr('value',queue_num);
					fname = null; lname = null;phone=null;faname=null;mname=null;queue_num=null;
						$('#confirm_info').modal('show');
						$('#fname').val("");
						$('#lname').val("");
						$('#phone').val("");
						$('#faname').val("");
						$('#mname').val("");
						$('#queue_num').val("");
				} else{
					alert("لم تقم بإدخال جميع البيانات المطلوبة");
				}
			}
		</script>
		<script>
			$(function() {
				$('form.form-horizontal').submit(function(event) {
					var form = $(this);
					$.ajax({
						type: form.attr('method'),
						url: form.attr('action'),
						data: form.serialize()
					}).done(function(data) {
						if(data.length==2){
							alert('تمّت إضافة البيانات بنجاح\n رجاء اذهب إلى القاعة: '+data);
							$('#confirm_info').modal('hide');							
						}else if(data==='false'){
							alert('عذراً.. \n جميع القاعات ممتلئة الآن، يرجى الانتظار ريثما يتاح المجال لدخولك.');
							$('#confirm_info').modal('hide');
						}else{
							alert('خطأ بالبيانات المدخلة.. يرجى التأكد من مطابقة الدخل مع الحقول');
							$('#confirm_info').modal('hide');
						}
					}).fail(function() {
						alert('تأكد من اتصالك بالخادم..');
						
						$('#confirm_info').modal('hide');
					});
					event.preventDefault();
				});
				//calculate rest places..
				function calculateRestPlaces(){
					
					$.get("<?php echo site_url('join/neededStudent');?>", { already_exist: st_id } )
					.done(function(data) {
						if(data=='Updated Successfully'){
							alert('تم تسجيل زمن الخروج بنجاح');
							$('#'+row_id).remove();													
						}else if(data=='no affected rows'){
							alert('تم تسجيل زمن خروج الطالب مٌسبقاً، يُرجى إعادة تحميل الصفحة');
							$('#'+row_id).remove();
						}
					}).fail(function() {
						alert('تأكد من اتصالك بالخادم..');
						$('#'+st_id).replaceWith('<button class="btn btn-default " id="'+st_id+'" onclick="loading_gif('+st_id+');return true;">انتهى</button>');
					});
				}
			});
		</script>
		<script>
			function loading_gif(id){
				$('#'+id).replaceWith('<center id="'+id+'"><img src="<?php echo base_url();?>assets/images/loading.gif" /></center>');
			}
		</script>
		<script type="text/javascript">
			function get_out(st_id){
				loading_gif(st_id)
				row_id = st_id +'a';
				//ajax get request
				$.get("<?php echo base_url();?>index.php/join/update", { id: st_id } )
				.done(function(data) {
					if(data=='Updated Successfully'){
						alert('تم تسجيل زمن الخروج بنجاح');
						$('#'+row_id).remove();													
					}else if(data=='no affected rows'){
						alert('تم تسجيل زمن خروج الطالب مٌسبقاً، يُرجى إعادة تحميل الصفحة');
						$('#'+row_id).remove();
					}
				}).fail(function() {
					alert('تأكد من اتصالك بالخادم..');
					$('#'+st_id).replaceWith('<button class="btn btn-default " id="'+st_id+'" onclick="loading_gif('+st_id+');return true;">انتهى</button>');
				});
				
				
			}
		</script>
		<!--<script type="text/javascript">
			$(fucntoin(){
				setTimeout
			});
		</script>-->
	</head>
	<body>
	
		<ul class="nav nav-pills nav-justified navbar-fixed-top transparent well" id="tabs" data-tabs="tabs">
			<li class="active " >
				<a data-toggle="tab" href="#add">إضافة طالب</a>
			</li>
			<li class="">
				<a data-toggle="tab" href="<?php echo base_url();?>join/view/#inside">عرض الطلاب الموجودين</a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="row tab-pane active fade in" id="add">
				<div class="panel panel-primary col-lg-8 col-lg-offset-2">
					<div class="panel-heading">
						<h3 class="panel-title text-center">إدخال بيانات طالب</h3>
					</div>
					<div class="form-horizontal">
						
							<div class="form-group">
								<div class="col-lg-7">
									<div class=""></div>
								</div>
								<div class="col-lg-3">
									<input type="text" class="form-control" id="fname" name="fname" placeholder="اسم الطالب">
								</div>
								<label for="fname" class="col-lg-2 control-label">الاسم</label>
							</div>
						  
							<div class="form-group ">
								<div class="col-lg-7"></div>
								<div class="col-lg-3">
									<input type="text" class="form-control" id="lname" name="lname" placeholder="كنية الطالب">
								</div>
								<label for="lname" class="col-lg-2  control-label">الكنية</label>
							</div>
							
							<div class="form-group ">
								<div class="col-lg-7"></div>
								<div class="col-lg-3">
									<input type="text" class="form-control" id="faname" name="faname" placeholder="اسم الأب">
								</div>
								<label for="faname" class="col-lg-2  control-label">اسم الأب</label>
							</div>
							
							<div class="form-group ">
								<div class="col-lg-7"></div>
								<div class="col-lg-3">
									<input type="text" class="form-control" id="mname" name="mname" placeholder="اسم الأم">
								</div>
								<label for="mname" class="col-lg-2  control-label">اسم الأم</label>
							</div>
							
							<div class="form-group ">
								<div class="col-lg-7"></div>
								<div class="col-lg-3">
									<input type="tel" class="form-control" id="phone" name="phone" placeholder="أدخل رقم جوّال الطالب">
								</div>
								<label for="phone" class="col-lg-2  control-label">رقم الجوّال</label>
							</div>
							
							<div class="form-group ">
								<div class="col-lg-7"></div>
								<div class="col-lg-3">
									<input type="tel" class="form-control" id="queue_num" name="queue_num" placeholder="رقم الطالب في الطابور">
								</div>
								<label for="queue_num" class="col-lg-2  control-label">رقم الدور</label>
							</div>
						  
							<div class="form-group">
								<div class="col-lg-4"></div>
								<div class="col-lg-8">
									<button data-toggle="modal" onclick="check();return false;" id="add" class="btn pull-left btn-primary btn-lg" >إضافة</button>
									<!-- Modal -->
									<div class="modal fade" id="confirm_info">
										<div class="modal-dialog">
											<div id="modal_content" class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h3 class="modal-title">البيانات المُدخلة</h3>
												</div>
												<div id="modal_body" class="modal-body">
													<!--<h4>لقد قُمت بإدخال البيانات التالية:</h4> -->
													<form class="form-horizontal" id="add-form" method="post" action="<?php echo base_url() ?>index.php/join/save" >
														<div class="form-group row">
															<div class="col-lg-5"></div>
															<input type="text" id="st_fname" name="st_fname" class="col-lg-5" readonly>
															<label for="st_fname" class="col-lg-2">الاسم:</label>
														</div>
														<div class="form-group row">
															<div class="col-lg-5"></div>
															<input type="text" id="st_lname" name="st_lname" class="col-lg-5" readonly>
															<label for="st_lname "class="col-lg-2">الكنية:</label>
														</div>
														<div class="form-group row">
															<div class="col-lg-5"></div>
															<input type="text" id="st_faname" name="st_faname" class="col-lg-5" readonly>
															<label for="st_faname "class="col-lg-2">اسم الأب:</label>
														</div>
														<div class="form-group row">
															<div class="col-lg-5"></div>
															<input type="text" id="st_mname" name="st_mname" class="col-lg-5" readonly>
															<label for="st_mname "class="col-lg-2">اسم الأم:</label>
														</div>
														<div class="form-group row">
															<div class="col-lg-5"></div>
															<input type="text" id="st_phone" name="st_phone" class="col-lg-5" readonly>
															<label for="st_phone" class="col-lg-2">رقم الجوّال:</label>
														</div>
														<div class="form-group row">
															<div class="col-lg-5"></div>
															<input type="text" id="st_queue_num" name="st_queue_num" class="col-lg-5" readonly>
															<label for="st_queue_num" class="col-lg-2">رقم الدور:</label>
														</div>
														<!--<hr/>
														<h3>القاعة المتوفرة:</h3>
														<div class="form-group row">
															<div class="col-lg-5"></div>
															<input type="text" name="" id="lab" class="col-lg-5" readonly>
															<label for="lab-confirm" class="col-lg-2">القاعة:</label>
														</div>-->
													
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default pull-left" data-dismiss="modal">إلغاء</button>
													<input class="btn btn-primary pull-left" type="submit" value="تأكيد" />
												</div>
												</form>
												
											</div><!-- /.modal-content -->
										</div><!-- /.modal-dialog -->
									  </div><!-- /.modal -->
								</div>
							</div>
						  
					</div>
				</div>
				<div class="panel panel-primary col-lg-8 col-lg-offset-2">
					<!--<div class="panel-heading">Panel heading without title</div>-->
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-4"></div>
							<div class="col-lg-4">
								<center>
									<span class="badge" style="background-color:#428bca; "><font face="" size="3" color="white">عدد الأماكن المتبقية</font></span>
									<span class="badge" id="blank">8</span>
									<span>من أصل</span>
									<span class="badge" id="total">14</span>
								</center>
							</div>
							<div class="col-lg-4"></div>
						</div><br />
						<div class="row">
							<div class="col-lg-3"></div>
							<div class="col-lg-6">
								<div class="progress">
									<div class="progress-bar" style="width: 80%" id="p-blank">
										<span class="sr-only">80%</span>
									</div>
									<div class="progress-bar progress-bar-warning" id="p-filled" style="width: 20%">
										<span class="sr-only">20%</span>
									</div>
								</div>
							</div>
							<div class="col-lg-3">
							
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane fade in" id="inside">
				<!-- jumbotron -->
				<div class="row">
					<div class="col-lg-offset-3 col-lg-6 "><!-- table container-->
						<table class="table table-bordered table-hover">
							<colgroup></colgroup>
							<colgroup></colgroup>
							<colgroup id="m-no-borders"></colgroup>
							<thead>
								<tr class="panel-heading">
									<th class="text-center">اسم الطالب</th>
									<th class="text-center">اسم الأب</th>
									<th class="text-center">اسم الأم</th>
									<th class="text-center">الرقم في الدور</th>
									<th class="text-center">المخبر</th>
									<th class="text-center">يريد الخروج؟</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach ($records as $row) { 
								?>
										<tr id="<?php echo $tr_id = $row->st_id.'a'?>">
											<td class="text-center" id="full-name"><?php echo $row->st_fname .' '. $row->st_lname ; ?></td>
											<td class="text-center" id="fa-name"><?php echo $row->st_faname; ?></td>
											<td class="text-center" id="m-name"><?php echo $row->st_mname; ?></td>
											<td class="text-center" id="queue-num"><?php echo $row->st_queue_num; ?></td>
											<td class="text-center" id="lab"><?php echo $row->lab_name ; ?></td>
											<td class="text-center"><button class="btn btn-default " id="<?php echo $row->st_id?>" onclick="get_out(<?php echo $row->st_id?>);return true;">انتهى</button></td>
										</tr>
									<?php } ?>
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		
	</body>
  
</html>