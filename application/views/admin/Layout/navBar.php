<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<?php if (!Dy::app()->auth->isGuest()):?>
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="<?php echo ViewHelper::getUserAvatar(Dy::app()->auth->id,$userInfo->avatar); ?>" class="img-circle" style="width:45px;height:45px;" >
			</div>
			<div class="pull-left info" style="padding-top: 0px;">
				<p>
					<?php echo Dy::app()->auth->username; ?>
				</p>
				<a href="javascript:void(0);" style="padding-right: 3px;">
					<span id="user_edit" class="label label-info" style="cursor:pointer">编辑</span>
				</a>
				<a href="#" data-toggle="modal" data-target="#logoutAlertModalInfo" style="padding-right: 1px;">
					<span class="label label-danger">退出</span>
				</a>
				<a href="<?php echo DyRequest::getSiteRootUrl();?>" target="_blank">
					<span class="label label-default">站点首页</span>
				</a>
			</div>
		</div>

		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li class="header" style="white-space:normal;width:100%">
				<div style="width:100%;color:#FFF;word-wrap:break-word;word-break:break-all;border-bottom:solid 1px #333;">
					<?php echo isset($userRolesName) ? '角色(组)：'.implode(',', $userRolesName) : ''; ?>
				</div>
			</li>
			<?php if (isset($navTree)): foreach ($navTree as $key => $val):?>
			<?php 
		            if (!Common::checkPermit($val['id'])) {
		                continue;
		            } 
			?>
			<li treeId="<?php echo $val['id']; ?>" class="treeview">
				<a href="#">
					<i class="<?php echo $val['icon']; ?>"></i>
					<span>
						<?php echo $val['name']; ?>
					</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<?php if (isset($val['child']) && is_array($val['child'])): ?>
				<ul class="treeview-menu">
					<?php foreach ($val['child'] as $k => $v):?>
					<?php
						if (!Common::checkPermit($v['id'])) {
							continue;
						}

						$itemActive = '';
						$link = trim($v['link'], '/');
			
						if (!empty($link) && strtolower(Dy::app()->module.'/'.Dy::app()->cid.'/'.Dy::app()->aid) == strtolower($link)) {
							$itemActive = 'active';
							$this->setData('breadcrumbMain', $val['name']);
							$this->setData('breadcrumbActive', $v['name']);
						}else if (isset($navLinkActive) && !empty($navLinkActive) && strtolower($link) == strtolower($navLinkActive)) {
							$itemActive = 'active';
						}
					?>
					<li <?php echo $itemActive ? 'class="active"' : ''; ?> pid="<?php echo $v['pid']; ?>">
						<a href="<?php echo $v['link']; ?>">
							<i class="<?php echo $v['icon']; ?>"></i>
							<?php echo $v['name']; ?>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>
			</li>
			<?php endforeach; endif; ?>
		</ul>
		<?php endif;?>
	</section>
	<!-- /.sidebar -->
</aside>


<!-- 编辑用户信息弹窗 -->
<div class="modal fade" id="userEditOpModal" treeData='' tabindex="-1" role="dialog" aria-labelledby="userEditOpModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">个人信息编辑</h4>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label>头像</label>
						<div class="layui-upload">
							<button type="button" class="layui-btn" id="facefile">
								<i class="layui-icon">&#xe67c;</i>上传图片</button>
							<div id="layuiFaceUploadShow" class="layui-upload-list" style="display:none;">
								<img style="width:100px;height:100px;border-radius:50%;" id="picShow">
								<p id="picUpErrorInfo"></p>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label>真实姓名
							<span class="text-red">*</span>
						</label>
						<input type="text" class="form-control" name="user_realname" id="user_realname" value="<?php se($userInfo, 'realname');?>"
						 placeholder="个人的真实姓名">
					</div>

					<div class="form-group">
						<label>Email
							<span class="text-red">*</span>
						</label>
						<input type="text" class="form-control" name="user_email" id="user_email" value="<?php se($userInfo, 'email');?>" placeholder="邮箱地址">
					</div>

					<div class="form-group">
						<label>密码</label>
						<input type="text" class="form-control" name="user_password" id="user_password" placeholder="password">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button id="userEditOpModalSubmit" type="button" class="btn btn-primary">submit</button>
			</div>
		</div>
	</div>
</div>


<script>
	$(document).ready(function() {
		//nav bar active menu
		$(".sidebar-menu > li > ul.treeview-menu").each(function(index, domEle) {
			var activePid = 0;
			$('li').each(function(i, e) {
				if ($(e).attr("class") == "active") {
					activePid = $(e).attr("pid");
					return false;
				}
			});

			if (activePid > 0 && $(domEle).parent().attr("treeId") == activePid) {
				$(domEle).parent().attr("class", "active treeview");
				return false;
			}
		});

		//用户信息编辑
		$('#user_edit').on("click", function() {
			$('#userEditOpModal').modal({
				keyboard: true
			});
		});
		$('#userEditOpModalSubmit').on("click", function() {
			var url = '/admin/user/userEdit';
			var postData = {
				realname: $('#user_realname').val(),
				password: $("#user_password").val(),
				email: $("#user_email").val()
			};
			$.post(url, postData,
				function(data) {
					var mtype = data.status == 0 ? 'success' : 'warning';
					if (data.status == 0) {
						$('#userEditOpModal').modal('hide');
					}
					growlInfo(data.message, mtype);
				},
				'json'
			);
		});

		//注销确认
		$('#logoutAlertModalInfo').on('show.bs.modal', function(event) {
			var title = '退出系统';
			var modal = $(this);

			modal.removeClass('fade');
			modal.addClass('modal-danger');
			modal.find('.modal-title').html(title);
			modal.find('.modal-body').html("<p>你确定要" + title + "吗? </p>");
		});
		$("#logoutAlertModalSubmit").on("click", function(evt) {
			window.location.href = "/app/logout?m=admin";
		});

		/**
		 * 上传图片简单预览
		 */
		$("#facefile").change(function() {
			var file = this.files[0];

			var objUrl = null;
			if (window.createObjectURL != undefined) { // basic  
				objUrl = window.createObjectURL(file);
			} else if (window.URL != undefined) { // mozilla(firefox)  
				objUrl = window.URL.createObjectURL(file);
			} else if (window.webkitURL != undefined) { // webkit or chrome  
				objUrl = window.webkitURL.createObjectURL(file);
			}

			if (objUrl) {
				$("#faceimg").attr("src", objUrl).attr("style",
					"width:50px;height:50px;border-radius:50% ;margin:0px auto;cursor: pointer;");
				$("#imginfo").show();
			}
		});
		$("#faceimg").on("click", function() {
			$("#facefile").val('');
			$(this).attr("src", "");
			$("#imginfo").hide();
		});

	});

	//异步上传图片
	layui.use('upload', function() {
		var upload = layui.upload;

		var uploadInst = upload.render({
			elem: '#facefile',
			exts: 'jpg|png|gif|bmp|jpeg',
			url: '/admin/user/faceUp',
			before: function(obj) {
				//预读本地文件示例，不支持ie8
				obj.preview(function(index, file, result) {
					$("#layuiFaceUploadShow").show();
					$('#picShow').attr('src', result); //图片链接（base64）
				});
			},
			done: function(res) {
				return layer.msg(res.message);
			},
			error: function() {
				//失败状态，并实现重传
				var retry = $('#picUpErrorInfo');
				retry.html('<span style="color: #FF5722;">上传失败</span> <a id="picUpErrorReload" style="color:#00c0ef">重试</a>');
				retry.find('#picUpErrorReload').on('click', function() {
					uploadInst.upload();
				});
			}
		});
	});
</script>
