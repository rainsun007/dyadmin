<!-- 公用操作确认弹窗模板 -->
<div class="modal fade" id="alertModalInfo" tabindex="-1" role="dialog" aria-labelledby="alertModalInfo">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="alertModalInfoTitle">确认提示</h4>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button id="alertModalSubmit" type="button" class="btn btn-primary">Submit</button>
			</div>
		</div>
	</div>
</div>

<!-- 退出系统操作确认弹窗模板 -->
<div class="modal fade" id="logoutAlertModalInfo" tabindex="-1" role="dialog" aria-labelledby="logoutAlertModalInfo">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="logoutAlertModalInfoTitle">确认提示</h4>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button id="logoutAlertModalSubmit" type="button" class="btn btn-primary">Submit</button>
			</div>
		</div>
	</div>
</div>

<!-- ajax请求全局loading提示 -->
<style>
	.loading_message {
		display: none;
		background: #000;
		width: 220px;
		height: 56px;
		position: fixed;
		top: 20%;
		left: 50%;
		line-height: 50px;
		color: #fff;
		padding: 3px 60px 5px 60px;
		font-size: 16px;
		z-index: 9999;
		-moz-border-radius: 20px;
		-webkit-border-radius: 20px;
		border-radius: 20px;
		opacity: 0.7;
		filter: progid:DXImageTransform.Microsoft.Alpha(opacity=70);
	}
</style>
<div id="loading_message" class="loading_message">
	<i class="fa fa-refresh fa-spin"></i> 请稍候......
</div>
<script>
	$(document).bind("ajaxSend", function() {
		$("#loading_message").show();
	}).bind("ajaxComplete", function() {
		$("#loading_message").hide();
	})
</script>

<!-- bootstrapGrowl提示 -->
<script>
	function growlInfo(message, mtype,align='center',amount=100) {
		var bootstrapGrowlConfig = {
			ele: 'body',
			type: mtype,
			offset: {
				from: 'top',
				amount: amount
			},
			align: align,
			width: 350,
			delay: 3000,
			allow_dismiss: true,
			stackup_spacing: 10
		}
		$.bootstrapGrowl(message, bootstrapGrowlConfig);
	}
</script>