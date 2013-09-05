<!DOCTYPE html>
<html lang="ar" dir="rtl">
	<head>
		<title>تنظيم دخول الطلاب إلى قاعات المفاضلة</title>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<link href="<?php echo base_url();?>dist/modifications.css" rel="stylesheet" media="screen">
		<link href="<?php echo base_url();?>dist/css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="<?php echo base_url();?>dist/css/bootstrap-glyphicons.css" rel="stylesheet" media="screen">
        <script type="text/javascript" src="<?php echo base_url();?>dist/jquery-1.10.2.js" ></script>
        <script type="text/javascript" src="<?php echo base_url();?>dist/js/bootstrap.js" ></script>
        <script type="text/javascript">
        	window.onload = function(){
        		getNumOfAvailPlaces();
        		submit_();
        		setInterval(comet, 1000);
        		setInterval(comet2, 1000);
        	}
        </script>
        <script type="text/javascript">
        function submit_() {
        	$('form.form-horizontal').submit(function(event) {
					var form = $(this);
					$.ajax({
						type: form.attr('method'),
						url: form.attr('action'),
						data: form.serialize()
					}).done(function(data) {
						if(data.length<=6){
							alert('تمّت إضافة البيانات بنجاح\n رجاء اذهب إلى القاعة: '+data);
							$('#confirm_info').modal('hide');							
						}else if(data=='false!!'){
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
			}
        </script>
        <script type="text/javascript">
        	function getNumOfAvailPlaces(){
				$.getJSON("<?php echo site_url('join/num_available_places');?>", function( json ) {
					$('#total').text(json.capacity);
					$('#blank').text(json.available);
					/*availPercentage = Number((json.available/json.capacity).toFixed(2)); // 6.7
					$('#p-filled').attr("style","");
					$('#p-filled').attr("sytle","width: "+1-availPercentage+";background-color: #999999");
					$('#avail-places').attr("style","width: "+availPercentage);*/
				 });
        	}
        </script>
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
						//.focus();
						$('#submit_').focus();
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
			function loading_gif(id){
				$('#'+id).replaceWith('<center id="'+id+'"><img src="<?php echo base_url();?>assets/images/loading.gif" /></center>');
			}
		</script>
		<script type="text/javascript">
			function get_out(st_id,pc_id){
				loading_gif(st_id)
				row_id = st_id +'a';
				$.get("<?php echo base_url();?>index.php/join/update", { id: st_id ,p_id: pc_id} )
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
		<script type="text/javascript">
			var _timestamp = null;
			function comet() {
				$.getJSON("<?php echo site_url('join/updateNumOfAvailPlaces');?>",{timestamp:_timestamp})
				.done( function(json) {
					$('#blank').text(json.available_places);
					_timestamp  = json.timestamp;
				})
				.fail(function( jqxhr, textStatus, error ) {
				  var err = textStatus + ', ' + error;
				  console.log( "Request Failed: " + err);
				});
			}
		</script>
		<script type="text/javascript">
			function inc_count(){
				$.get('<?php echo site_url('join/inc_Counter');?>');
			}
			function dec_count(){
				$.get('<?php echo site_url('join/dec_Counter');?>');
			}
		</script>
		<script type="text/javascript">
			var _timestamp2 = null;
			function comet2() {
				$.getJSON("<?php echo site_url('join/syncCounterValue');?>",{timestamp:_timestamp2})
				.done( function(json) {
					_timestamp2  = json.timestamp;
					$('#countr').text(json.counterVal);
				})
				.fail(function( jqxhr, textStatus, error ) {
				  var err = textStatus + ', ' + error;
				  console.log( "Request Failed: " + err);
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
				<a data-toggle="tab" href="<?php echo site_url();?>/join/index/#add">إضافة طالب</a>
			</li>
			<li class="">
				<a data-toggle="tab" href="<?php echo site_url();?>/join/index/#inside">عرض الطلاب الموجودين</a>
			</li>
			<li class="">
				<a data-toggle="tab" href="<?php echo site_url();?>/join/index/#pc">حالة الحواسب</a>
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
								<label for="phone" class="col-lg-2 control-label">رقم الجوّال</label>
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
															<div  class="col-lg-5">
																<input type="text" id="st_fname" name="st_fname" class="form-control" readonly>
															</div>
															<label for="st_fname" class="col-lg-2  control-label">الاسم:</label>
														</div>
														<div class="form-group row">
															<div class="col-lg-5"></div>
															<div  class="col-lg-5">
																<input type="text" id="st_lname" name="st_lname" class="form-control" readonly>
															</div>
															<label for="st_lname "class="col-lg-2 control-label">الكنية:</label>
														</div>
														<div class="form-group row">
															<div class="col-lg-5"></div>
															<div  class="col-lg-5">
																<input type="text" id="st_faname" name="st_faname" class="form-control" readonly>
															</div>
															<label for="st_faname "class="col-lg-2 control-label">اسم الأب:</label>
														</div>
														<div class="form-group row">
															<div class="col-lg-5"></div>
															<div  class="col-lg-5">
																<input type="text" id="st_mname" name="st_mname" class="form-control" readonly>
															</div>
															<label for="st_mname "class="col-lg-2 control-label">اسم الأم:</label>
														</div>
														<div class="form-group row">
															<div class="col-lg-5"></div>
															<div  class="col-lg-5">
																<input type="text" id="st_phone" name="st_phone" class="form-control" readonly>
															</div>
															<label for="st_phone" class="col-lg-2 control-label">رقم الجوّال:</label>
														</div>
														<div class="form-group row">
															<div class="col-lg-5"></div>
															<div class="col-lg-5">
																<input type="text" id="st_queue_num" name="st_queue_num" class="form-control" readonly>
															</div>
															<label for="st_queue_num" class="col-lg-2 control-label">رقم الدور:</label>
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
													<input class="btn btn-primary pull-left" id='submit_' type="submit" value="تأكيد" />
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
						<center>
							<span class="badge" style="background-color:#428bca; "><font face="" size="3" color="white">عدد الأماكن المتبقية</font></span>
						</center><br />
						<div class="row">
							<div class="col-lg-4"></div>
							<div class="col-lg-4">
								<center>
									<span class="badge" id="blank">0</span>
									<span>من أصل</span>
									<span class="badge" id="total">0</span>
								</center>
							</div>
							<div class="col-lg-4"></div>
						</div>
						
						<!--<div class="row">
							<div class="col-lg-3"></div>
							<div class="col-lg-6">
								<div class="progress">
									<div class="progress-bar " id="p-filled" style="width: 80%;background-color: #999999;">
										<span class="sr-only">80%</span>
									</div>
									<div class="progress-bar" style="width: 20%" id="avail-places">
										<span class="sr-only">20%</span>
									</div>
								</div>
							</div>
							<div class="col-lg-3">
							
							</div>
						</div>-->
					</div>
				</div>
				<div class="panel panel-primary col-lg-8 col-lg-offset-2">
					<!--<div class="panel-heading">Panel heading without title</div>-->
					<div class="panel-body">
					<center>
						<span class="badge" style="background-color:#428bca;vertical-align: middle; "><font face="" size="3" color="white">العداد</font></span>
					</center>
						<div class="row">
							<div class="col-lg-4"></div>
							<div class="col-lg-4">
								
							<center>
								<span title="-1" onclick="dec_count();" style="font-size: 25px;" class="btn glyphicon glyphicon-minus-sign"></span>
								<span class="badge" id="countr" style="border-radius: 11% 50%;vertical-align: middle;font-size: 18px">0</span>
								<span title="+1" onclick="inc_count();" style="font-size: 25px;" class="btn glyphicon glyphicon-plus-sign"></span>
								
							</center>
						
							</div>
							<div class="col-lg-4"></div>
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
									<th class="text-center">الحاسب</th>
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
											<td class="text-center" id="pc-name"><?php echo $row->pc_name; ?></td>
											<td class="text-center"><button class="btn btn-default " id="<?php echo $row->st_id?>" onclick="get_out(<?php echo $row->st_id?>,<?php echo $row->pc_id?>);return true;">انتهى</button></td>
										</tr>
									<?php } ?>
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="tab-pane fade in" id="pc">
				<div class="panel-group" id="accordion">
					<?php
						echo '<div class="panel panel-default">
							    <div class="panel-heading">
							      <h4 class="panel-title">
							        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
							          Collapsible Group Item #1
							        </a>
							      </h4>
							    </div>
							    <div id="collapseOne" class="panel-collapse collapse in">
							      <div class="panel-body">
							        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\'t heard of them accusamus labore sustainable VHS.
						      </div>
						    </div>
						  </div>';
					?>
				</div>
			</div>
		</div>
		
	</body>
  
</html>