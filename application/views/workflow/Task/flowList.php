<?php $this->pageTitle = '工作流管理'?>
<?php VHelper::setBreadcrumb('发起新任务', '工作流模板选择', 'workflow/task/list'); ?>

<!-- Main content -->
<div class="row">
<section class="col-md-12">
    <div class="box box-success">
      <div class="box-header">
        <h3 class="box-title">工作流列表 - [在列表中选择要使用的工作流]</h3>
        <div class="box-tools pull-right">
          <a href="<?php echo DyRequest::createUrl('/workflow/task/list');?>">返回任务列表</a>
        </div>
      </div>

      <div class="box-body">
        <!-- form start -->
        <form role="form">
          <div class="form-group">
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th class="col-md-2">流程名称</th>
                            <th class="col-md-1">创建者</th>
                            <th class="col-md-6">说明</th>
                            <th class="col-md-2">创建时间</th>
                            <th class="col-md-1">操作</th>
                        </tr>
                        <?php foreach ($listData as $key => $val):?>
                        <tr>
                            <td><?php echo $val->name; ?></td>
                            <td><?php echo $val->username; ?></td>
                            <td><?php echo $val->explain; ?></td>
                            <td><?php echo $val->create_time; ?></td>
                            <td>
                              <a href="<?php echo DyRequest::createUrl('/workflow/task/add',array('id'=>$val->id));?>"><button type="button" class="btn btn-primary" style="width:55px;">使用</button></a>
                           </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
          </div>
        </form>
        <?php $this->widget('DyPagerWidget', $pageWidgetOptions); ?>
      </div>
      <!-- /.box-body -->

    </div>
    <!-- /.box -->
</section>

</div>
<!-- /.content -->
