<?php $this->pageTitle = '导航管理'?>
<?php ViewHelper::regCss('jstree/themes/default/style.css'); ?>
<?php ViewHelper::regJs('jstree/jstree.js', 'head'); ?>

<style>
      .bs-glyphicons {
        padding-left: 0;
        padding-bottom: 1px;
        margin-bottom: 20px;
        list-style: none;
        overflow: hidden;
      }

      .bs-glyphicons li {
        float: left;
        width: 25%;
        height: 115px;
        padding: 10px;
        margin: 0 -1px -1px 0;
        font-size: 12px;
        line-height: 1.4;
        text-align: center;
        border: 1px solid #ddd;
      }

      .bs-glyphicons .glyphicon {
        margin-top: 5px;
        margin-bottom: 10px;
        font-size: 24px;
      }

      .bs-glyphicons .glyphicon-class {
        display: block;
        text-align: center;
        word-wrap: break-word; /* Help out IE10+ with class names */
      }

      .bs-glyphicons li:hover {
        background-color: rgba(86, 61, 124, .1);
      }

      @media (min-width: 768px) {
        .bs-glyphicons li {
          width: 12.5%;
        }
      }
</style>

<!-- Main content -->
<div class="row">

  <section class="col-md-6">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">导航列表</h3>
        </div>

        <div class="box-body">
          <!-- form start -->
          <form role="form">
            <div class="callout callout-info">
              <h4>功能说明</h4>
              <p><span class="text-muted" style="background:#fff;padding:3px;">灰色</span> 项为禁用的导航，在列表中各节点上右键进行相关操作</p>
              <p>添加主导航请在右侧的表单操作；各节点中的输入框为导航排序（正整数），修改后输入框失去焦点将自动保存</p>
              <p class="text-red">注意：只支持二级导航，相关内部操作（权限）在<a href="<?php echo DyRequest::createUrl('/admin/permit/list');?>">权限管理</a>中设置</p>
            </div>
            <div class="form-group">
            <label>选择角色权限</label>
            <div id="roleTree">
              <?php echo ViewHelper::jsTree($permissionTree, array(), true, 'text-muted', true); ?>
            </div>
            </div>
          </form>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
  </section>

  <section class="col-md-6">
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title">创建主导航</h3>
      </div>

      <div class="box-body">
        <!-- form start -->
        <form id="mainNavAdd" role="form">
          <div class="form-group">
            <label>导航名<span class="text-red">*</span></label>
            <input type="text" class="form-control" name="name" placeholder="导航显示名">
          </div>

          <div class="form-group">
            <label>连接地址</label>
            <input type="text" class="form-control" name="link" placeholder="访问连接">
          </div>

          <div class="form-group">
            <label>ICON样式</label>
            <input type="text" class="form-control" name="icon" placeholder="icon class">
          </div>

          <div class="form-group">
            <label>排序</label>
            <input type="text" class="form-control" name="sort" placeholder="请输入正整数">
          </div>

          <!-- checkbox -->
          <div class="form-group">
            <label>
              <input type="checkbox" name="display" class="flat-red" checked>
            </label>
            <label>
              导航是否可用（不勾选为禁用）
            </label>
          </div>
        </form>
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="button" id="mainNavAddSubmit" class="btn btn-primary">Submit</button>
      </div>
    </div>
    <!-- /.box -->
  </section>

  <div class="col-xs-12">
    <div class="layui-elem-quote layui-quote-nm" style="background-color:#FFF;">以下为可选用的ICON样式，将要使用的样式名填入到ICON样式输入框内即可，默认主导航图标:<i class="fa fa-folder"></i> fa fa-folder &nbsp; 默认子导航图标:<i class="fa fa-circle-o"></i> fa fa-circle-o</div>
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#fa-icons" data-toggle="tab" aria-expanded="false">Font Awesome</a></li>
        <li class=""><a href="#glyphicons" data-toggle="tab" aria-expanded="true">Glyphicons</a></li>
      </ul>
      <div class="tab-content">
        <!-- Font Awesome Icons -->
        <div class="tab-pane active" id="fa-icons">
          <section id="new">
            <h4 class="page-header">66 New Icons in 4.4</h4>

            <div class="row fontawesome-icon-list">
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-500px"></i> fa fa-500px</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-amazon"></i> fa fa-amazon</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-balance-scale"></i> fa fa-balance-scale</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-battery-0"></i> fa fa-battery-0
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-battery-1"></i> fa fa-battery-1
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-battery-2"></i> fa fa-battery-2
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-battery-3"></i> fa fa-battery-3
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-battery-4"></i> fa fa-battery-4
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-battery-empty"></i> fa fa-battery-empty</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-battery-full"></i> fa fa-battery-full</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-battery-half"></i> fa fa-battery-half</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-battery-quarter"></i> fa fa-battery-quarter</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-battery-three-quarters"></i> fa fa-battery-three-quarters
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-black-tie"></i> fa fa-black-tie</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-calendar-check-o"></i> fa fa-calendar-check-o
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-calendar-minus-o"></i> fa fa-calendar-minus-o
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-calendar-plus-o"></i> fa fa-calendar-plus-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-calendar-times-o"></i> fa fa-calendar-times-o
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cc-diners-club"></i> fa fa-cc-diners-club</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cc-jcb"></i> fa fa-cc-jcb</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-chrome"></i> fa fa-chrome</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-clone"></i> fa fa-clone</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-commenting"></i> fa fa-commenting</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-commenting-o"></i> fa fa-commenting-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-contao"></i> fa fa-contao</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-creative-commons"></i> fa fa-creative-commons
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-expeditedssl"></i> fa fa-expeditedssl</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-firefox"></i> fa fa-firefox</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-fonticons"></i> fa fa-fonticons</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-genderless"></i> fa fa-genderless</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-get-pocket"></i> fa fa-get-pocket</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-gg"></i> fa fa-gg</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-gg-circle"></i> fa fa-gg-circle</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-grab-o"></i> fa fa-hand-grab-o
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-lizard-o"></i> fa fa-hand-lizard-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-paper-o"></i> fa fa-hand-paper-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-peace-o"></i> fa fa-hand-peace-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-pointer-o"></i> fa fa-hand-pointer-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-rock-o"></i> fa fa-hand-rock-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-scissors-o"></i> fa fa-hand-scissors-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-spock-o"></i> fa fa-hand-spock-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-stop-o"></i> fa fa-hand-stop-o
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hourglass"></i> fa fa-hourglass</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hourglass-1"></i> fa fa-hourglass-1
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hourglass-2"></i> fa fa-hourglass-2
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hourglass-3"></i> fa fa-hourglass-3
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hourglass-end"></i> fa fa-hourglass-end</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hourglass-half"></i> fa fa-hourglass-half</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hourglass-o"></i> fa fa-hourglass-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hourglass-start"></i> fa fa-hourglass-start</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-houzz"></i> fa fa-houzz</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-i-cursor"></i> fa fa-i-cursor</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-industry"></i> fa fa-industry</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-internet-explorer"></i> fa fa-internet-explorer
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-map"></i> fa fa-map</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-map-o"></i> fa fa-map-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-map-pin"></i> fa fa-map-pin</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-map-signs"></i> fa fa-map-signs</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-mouse-pointer"></i> fa fa-mouse-pointer</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-object-group"></i> fa fa-object-group</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-object-ungroup"></i> fa fa-object-ungroup</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-odnoklassniki"></i> fa fa-odnoklassniki</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-odnoklassniki-square"></i> fa fa-odnoklassniki-square
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-opencart"></i> fa fa-opencart</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-opera"></i> fa fa-opera</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-optin-monster"></i> fa fa-optin-monster</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-registered"></i> fa fa-registered</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-safari"></i> fa fa-safari</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sticky-note"></i> fa fa-sticky-note</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sticky-note-o"></i> fa fa-sticky-note-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-television"></i> fa fa-television</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-trademark"></i> fa fa-trademark</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-tripadvisor"></i> fa fa-tripadvisor</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-tv"></i> fa fa-tv
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-vimeo"></i> fa fa-vimeo</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-wikipedia-w"></i> fa fa-wikipedia-w</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-y-combinator"></i> fa fa-y-combinator</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-yc"></i> fa fa-yc
                <span class="text-muted">(alias)</span></div>
            </div>
          </section>

          <section id="web-application">
            <h4 class="page-header">Web Application Icons</h4>

            <div class="row fontawesome-icon-list">
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-adjust"></i> fa fa-adjust</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-anchor"></i> fa fa-anchor</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-archive"></i> fa fa-archive</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-area-chart"></i> fa fa-area-chart</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-arrows"></i> fa fa-arrows</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-arrows-h"></i> fa fa-arrows-h</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-arrows-v"></i> fa fa-arrows-v</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-asterisk"></i> fa fa-asterisk</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-at"></i> fa fa-at</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-automobile"></i> fa fa-automobile
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-balance-scale"></i> fa fa-balance-scale</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-ban"></i> fa fa-ban</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bank"></i> fa fa-bank <span class="text-muted">(alias)</span>
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bar-chart"></i> fa fa-bar-chart</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bar-chart-o"></i> fa fa-bar-chart-o
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-barcode"></i> fa fa-barcode</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bars"></i> fa fa-bars</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-battery-0"></i> fa fa-battery-0
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-battery-1"></i> fa fa-battery-1
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-battery-2"></i> fa fa-battery-2
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-battery-3"></i> fa fa-battery-3
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-battery-4"></i> fa fa-battery-4
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-battery-empty"></i> fa fa-battery-empty</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-battery-full"></i> fa fa-battery-full</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-battery-half"></i> fa fa-battery-half</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-battery-quarter"></i> fa fa-battery-quarter</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-battery-three-quarters"></i> fa fa-battery-three-quarters
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bed"></i> fa fa-bed</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-beer"></i> fa fa-beer</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bell"></i> fa fa-bell</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bell-o"></i> fa fa-bell-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bell-slash"></i> fa fa-bell-slash</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bell-slash-o"></i> fa fa-bell-slash-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bicycle"></i> fa fa-bicycle</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-binoculars"></i> fa fa-binoculars</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-birthday-cake"></i> fa fa-birthday-cake</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bolt"></i> fa fa-bolt</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bomb"></i> fa fa-bomb</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-book"></i> fa fa-book</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bookmark"></i> fa fa-bookmark</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bookmark-o"></i> fa fa-bookmark-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-briefcase"></i> fa fa-briefcase</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bug"></i> fa fa-bug</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-building"></i> fa fa-building</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-building-o"></i> fa fa-building-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bullhorn"></i> fa fa-bullhorn</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bullseye"></i> fa fa-bullseye</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bus"></i> fa fa-bus</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cab"></i> fa fa-cab <span class="text-muted">(alias)</span>
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-calculator"></i> fa fa-calculator</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-calendar"></i> fa fa-calendar</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-calendar-check-o"></i> fa fa-calendar-check-o
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-calendar-minus-o"></i> fa fa-calendar-minus-o
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-calendar-o"></i> fa fa-calendar-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-calendar-plus-o"></i> fa fa-calendar-plus-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-calendar-times-o"></i> fa fa-calendar-times-o
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-camera"></i> fa fa-camera</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-camera-retro"></i> fa fa-camera-retro</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-car"></i> fa fa-car</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-caret-square-o-down"></i> fa fa-caret-square-o-down
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-caret-square-o-left"></i> fa fa-caret-square-o-left
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-caret-square-o-right"></i> fa fa-caret-square-o-right
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-caret-square-o-up"></i> fa fa-caret-square-o-up
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cart-arrow-down"></i> fa fa-cart-arrow-down</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cart-plus"></i> fa fa-cart-plus</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cc"></i> fa fa-cc</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-certificate"></i> fa fa-certificate</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-check"></i> fa fa-check</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-check-circle"></i> fa fa-check-circle</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-check-circle-o"></i> fa fa-check-circle-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-check-square"></i> fa fa-check-square</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-check-square-o"></i> fa fa-check-square-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-child"></i> fa fa-child</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-circle"></i> fa fa-circle</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-circle-o"></i> fa fa-circle-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-circle-o-notch"></i> fa fa-circle-o-notch</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-circle-thin"></i> fa fa-circle-thin</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-clock-o"></i> fa fa-clock-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-clone"></i> fa fa-clone</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-close"></i> fa fa-close <span class="text-muted">(alias)</span>
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cloud"></i> fa fa-cloud</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cloud-download"></i> fa fa-cloud-download</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cloud-upload"></i> fa fa-cloud-upload</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-code"></i> fa fa-code</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-code-fork"></i> fa fa-code-fork</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-coffee"></i> fa fa-coffee</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cog"></i> fa fa-cog</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cogs"></i> fa fa-cogs</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-comment"></i> fa fa-comment</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-comment-o"></i> fa fa-comment-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-commenting"></i> fa fa-commenting</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-commenting-o"></i> fa fa-commenting-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-comments"></i> fa fa-comments</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-comments-o"></i> fa fa-comments-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-compass"></i> fa fa-compass</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-copyright"></i> fa fa-copyright</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-creative-commons"></i> fa fa-creative-commons
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-credit-card"></i> fa fa-credit-card</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-crop"></i> fa fa-crop</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-crosshairs"></i> fa fa-crosshairs</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cube"></i> fa fa-cube</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cubes"></i> fa fa-cubes</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cutlery"></i> fa fa-cutlery</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-dashboard"></i> fa fa-dashboard
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-database"></i> fa fa-database</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-desktop"></i> fa fa-desktop</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-diamond"></i> fa fa-diamond</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-dot-circle-o"></i> fa fa-dot-circle-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-download"></i> fa fa-download</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-edit"></i> fa fa-edit <span class="text-muted">(alias)</span>
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-ellipsis-h"></i> fa fa-ellipsis-h</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-ellipsis-v"></i> fa fa-ellipsis-v</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-envelope"></i> fa fa-envelope</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-envelope-o"></i> fa fa-envelope-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-envelope-square"></i> fa fa-envelope-square</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-eraser"></i> fa fa-eraser</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-exchange"></i> fa fa-exchange</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-exclamation"></i> fa fa-exclamation</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-exclamation-circle"></i> fa fa-exclamation-circle
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-exclamation-triangle"></i> fa fa-exclamation-triangle
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-external-link"></i> fa fa-external-link</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-external-link-square"></i> fa fa-external-link-square
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-eye"></i> fa fa-eye</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-eye-slash"></i> fa fa-eye-slash</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-eyedropper"></i> fa fa-eyedropper</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-fax"></i> fa fa-fax</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-feed"></i> fa fa-feed <span class="text-muted">(alias)</span>
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-female"></i> fa fa-female</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-fighter-jet"></i> fa fa-fighter-jet</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-archive-o"></i> fa fa-file-archive-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-audio-o"></i> fa fa-file-audio-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-code-o"></i> fa fa-file-code-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-excel-o"></i> fa fa-file-excel-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-image-o"></i> fa fa-file-image-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-movie-o"></i> fa fa-file-movie-o
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-pdf-o"></i> fa fa-file-pdf-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-photo-o"></i> fa fa-file-photo-o
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-picture-o"></i> fa fa-file-picture-o
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-powerpoint-o"></i> fa fa-file-powerpoint-o
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-sound-o"></i> fa fa-file-sound-o
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-video-o"></i> fa fa-file-video-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-word-o"></i> fa fa-file-word-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-zip-o"></i> fa fa-file-zip-o
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-film"></i> fa fa-film</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-filter"></i> fa fa-filter</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-fire"></i> fa fa-fire</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-fire-extinguisher"></i> fa fa-fire-extinguisher
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-flag"></i> fa fa-flag</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-flag-checkered"></i> fa fa-flag-checkered</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-flag-o"></i> fa fa-flag-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-flash"></i> fa fa-flash <span class="text-muted">(alias)</span>
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-flask"></i> fa fa-flask</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-folder"></i> fa fa-folder</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-folder-o"></i> fa fa-folder-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-folder-open"></i> fa fa-folder-open</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-folder-open-o"></i> fa fa-folder-open-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-frown-o"></i> fa fa-frown-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-futbol-o"></i> fa fa-futbol-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-gamepad"></i> fa fa-gamepad</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-gavel"></i> fa fa-gavel</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-gear"></i> fa fa-gear <span class="text-muted">(alias)</span>
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-gears"></i> fa fa-gears <span class="text-muted">(alias)</span>
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-gift"></i> fa fa-gift</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-glass"></i> fa fa-glass</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-globe"></i> fa fa-globe</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-graduation-cap"></i> fa fa-graduation-cap</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-group"></i> fa fa-group <span class="text-muted">(alias)</span>
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-grab-o"></i> fa fa-hand-grab-o
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-lizard-o"></i> fa fa-hand-lizard-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-paper-o"></i> fa fa-hand-paper-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-peace-o"></i> fa fa-hand-peace-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-pointer-o"></i> fa fa-hand-pointer-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-rock-o"></i> fa fa-hand-rock-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-scissors-o"></i> fa fa-hand-scissors-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-spock-o"></i> fa fa-hand-spock-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-stop-o"></i> fa fa-hand-stop-o
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hdd-o"></i> fa fa-hdd-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-headphones"></i> fa fa-headphones</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-heart"></i> fa fa-heart</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-heart-o"></i> fa fa-heart-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-heartbeat"></i> fa fa-heartbeat</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-history"></i> fa fa-history</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-home"></i> fa fa-home</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hotel"></i> fa fa-hotel <span class="text-muted">(alias)</span>
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hourglass"></i> fa fa-hourglass</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hourglass-1"></i> fa fa-hourglass-1
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hourglass-2"></i> fa fa-hourglass-2
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hourglass-3"></i> fa fa-hourglass-3
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hourglass-end"></i> fa fa-hourglass-end</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hourglass-half"></i> fa fa-hourglass-half</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hourglass-o"></i> fa fa-hourglass-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hourglass-start"></i> fa fa-hourglass-start</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-i-cursor"></i> fa fa-i-cursor</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-image"></i> fa fa-image <span class="text-muted">(alias)</span>
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-inbox"></i> fa fa-inbox</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-industry"></i> fa fa-industry</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-info"></i> fa fa-info</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-info-circle"></i> fa fa-info-circle</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-institution"></i> fa fa-institution
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-key"></i> fa fa-key</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-keyboard-o"></i> fa fa-keyboard-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-language"></i> fa fa-language</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-laptop"></i> fa fa-laptop</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-leaf"></i> fa fa-leaf</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-legal"></i> fa fa-legal <span class="text-muted">(alias)</span>
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-lemon-o"></i> fa fa-lemon-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-level-down"></i> fa fa-level-down</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-level-up"></i> fa fa-level-up</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-life-bouy"></i> fa fa-life-bouy
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-life-buoy"></i> fa fa-life-buoy
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-life-ring"></i> fa fa-life-ring</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-life-saver"></i> fa fa-life-saver
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-lightbulb-o"></i> fa fa-lightbulb-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-line-chart"></i> fa fa-line-chart</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-location-arrow"></i> fa fa-location-arrow</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-lock"></i> fa fa-lock</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-magic"></i> fa fa-magic</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-magnet"></i> fa fa-magnet</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-mail-forward"></i> fa fa-mail-forward
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-mail-reply"></i> fa fa-mail-reply
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-mail-reply-all"></i> fa fa-mail-reply-all
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-male"></i> fa fa-male</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-map"></i> fa fa-map</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-map-marker"></i> fa fa-map-marker</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-map-o"></i> fa fa-map-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-map-pin"></i> fa fa-map-pin</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-map-signs"></i> fa fa-map-signs</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-meh-o"></i> fa fa-meh-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-microphone"></i> fa fa-microphone</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-microphone-slash"></i> fa fa-microphone-slash
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-minus"></i> fa fa-minus</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-minus-circle"></i> fa fa-minus-circle</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-minus-square"></i> fa fa-minus-square</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-minus-square-o"></i> fa fa-minus-square-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-mobile"></i> fa fa-mobile</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-mobile-phone"></i> fa fa-mobile-phone
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-money"></i> fa fa-money</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-moon-o"></i> fa fa-moon-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-mortar-board"></i> fa fa-mortar-board
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-motorcycle"></i> fa fa-motorcycle</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-mouse-pointer"></i> fa fa-mouse-pointer</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-music"></i> fa fa-music</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-navicon"></i> fa fa-navicon
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-newspaper-o"></i> fa fa-newspaper-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-object-group"></i> fa fa-object-group</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-object-ungroup"></i> fa fa-object-ungroup</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-paint-brush"></i> fa fa-paint-brush</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-paper-plane"></i> fa fa-paper-plane</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-paper-plane-o"></i> fa fa-paper-plane-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-paw"></i> fa fa-paw</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-pencil"></i> fa fa-pencil</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-pencil-square"></i> fa fa-pencil-square</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-pencil-square-o"></i> fa fa-pencil-square-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-phone"></i> fa fa-phone</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-phone-square"></i> fa fa-phone-square</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-photo"></i> fa fa-photo <span class="text-muted">(alias)</span>
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-picture-o"></i> fa fa-picture-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-pie-chart"></i> fa fa-pie-chart</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-plane"></i> fa fa-plane</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-plug"></i> fa fa-plug</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-plus"></i> fa fa-plus</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-plus-circle"></i> fa fa-plus-circle</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-plus-square"></i> fa fa-plus-square</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-plus-square-o"></i> fa fa-plus-square-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-power-off"></i> fa fa-power-off</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-print"></i> fa fa-print</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-puzzle-piece"></i> fa fa-puzzle-piece</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-qrcode"></i> fa fa-qrcode</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-question"></i> fa fa-question</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-question-circle"></i> fa fa-question-circle</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-quote-left"></i> fa fa-quote-left</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-quote-right"></i> fa fa-quote-right</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-random"></i> fa fa-random</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-recycle"></i> fa fa-recycle</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-refresh"></i> fa fa-refresh</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-registered"></i> fa fa-registered</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-remove"></i> fa fa-remove
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-reorder"></i> fa fa-reorder
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-reply"></i> fa fa-reply</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-reply-all"></i> fa fa-reply-all</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-retweet"></i> fa fa-retweet</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-road"></i> fa fa-road</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-rocket"></i> fa fa-rocket</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-rss"></i> fa fa-rss</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-rss-square"></i> fa fa-rss-square</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-search"></i> fa fa-search</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-search-minus"></i> fa fa-search-minus</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-search-plus"></i> fa fa-search-plus</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-send"></i> fa fa-send <span class="text-muted">(alias)</span>
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-send-o"></i> fa fa-send-o
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-server"></i> fa fa-server</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-share"></i> fa fa-share</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-share-alt"></i> fa fa-share-alt</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-share-alt-square"></i> fa fa-share-alt-square
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-share-square"></i> fa fa-share-square</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-share-square-o"></i> fa fa-share-square-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-shield"></i> fa fa-shield</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-ship"></i> fa fa-ship</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-shopping-cart"></i> fa fa-shopping-cart</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sign-in"></i> fa fa-sign-in</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sign-out"></i> fa fa-sign-out</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-signal"></i> fa fa-signal</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sitemap"></i> fa fa-sitemap</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sliders"></i> fa fa-sliders</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-smile-o"></i> fa fa-smile-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-soccer-ball-o"></i> fa fa-soccer-ball-o
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sort"></i> fa fa-sort</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sort-alpha-asc"></i> fa fa-sort-alpha-asc</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sort-alpha-desc"></i> fa fa-sort-alpha-desc</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sort-amount-asc"></i> fa fa-sort-amount-asc</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sort-amount-desc"></i> fa fa-sort-amount-desc
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sort-asc"></i> fa fa-sort-asc</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sort-desc"></i> fa fa-sort-desc</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sort-down"></i> fa fa-sort-down
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sort-numeric-asc"></i> fa fa-sort-numeric-asc
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sort-numeric-desc"></i> fa fa-sort-numeric-desc
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sort-up"></i> fa fa-sort-up
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-space-shuttle"></i> fa fa-space-shuttle</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-spinner"></i> fa fa-spinner</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-spoon"></i> fa fa-spoon</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-square"></i> fa fa-square</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-square-o"></i> fa fa-square-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-star"></i> fa fa-star</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-star-half"></i> fa fa-star-half</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-star-half-empty"></i> fa fa-star-half-empty
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-star-half-full"></i> fa fa-star-half-full
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-star-half-o"></i> fa fa-star-half-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-star-o"></i> fa fa-star-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sticky-note"></i> fa fa-sticky-note</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sticky-note-o"></i> fa fa-sticky-note-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-street-view"></i> fa fa-street-view</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-suitcase"></i> fa fa-suitcase</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sun-o"></i> fa fa-sun-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-support"></i> fa fa-support
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-tablet"></i> fa fa-tablet</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-tachometer"></i> fa fa-tachometer</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-tag"></i> fa fa-tag</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-tags"></i> fa fa-tags</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-tasks"></i> fa fa-tasks</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-taxi"></i> fa fa-taxi</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-television"></i> fa fa-television</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-terminal"></i> fa fa-terminal</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-thumb-tack"></i> fa fa-thumb-tack</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-thumbs-down"></i> fa fa-thumbs-down</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-thumbs-o-down"></i> fa fa-thumbs-o-down</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-thumbs-o-up"></i> fa fa-thumbs-o-up</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-thumbs-up"></i> fa fa-thumbs-up</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-ticket"></i> fa fa-ticket</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-times"></i> fa fa-times</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-times-circle"></i> fa fa-times-circle</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-times-circle-o"></i> fa fa-times-circle-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-tint"></i> fa fa-tint</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-toggle-down"></i> fa fa-toggle-down
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-toggle-left"></i> fa fa-toggle-left
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-toggle-off"></i> fa fa-toggle-off</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-toggle-on"></i> fa fa-toggle-on</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-toggle-right"></i> fa fa-toggle-right
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-toggle-up"></i> fa fa-toggle-up
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-trademark"></i> fa fa-trademark</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-trash"></i> fa fa-trash</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-trash-o"></i> fa fa-trash-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-tree"></i> fa fa-tree</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-trophy"></i> fa fa-trophy</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-truck"></i> fa fa-truck</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-tty"></i> fa fa-tty</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-tv"></i> fa fa-tv
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-umbrella"></i> fa fa-umbrella</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-university"></i> fa fa-university</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-unlock"></i> fa fa-unlock</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-unlock-alt"></i> fa fa-unlock-alt</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-unsorted"></i> fa fa-unsorted
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-upload"></i> fa fa-upload</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-user"></i> fa fa-user</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-user-plus"></i> fa fa-user-plus</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-user-secret"></i> fa fa-user-secret</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-user-times"></i> fa fa-user-times</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-users"></i> fa fa-users</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-video-camera"></i> fa fa-video-camera</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-volume-down"></i> fa fa-volume-down</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-volume-off"></i> fa fa-volume-off</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-volume-up"></i> fa fa-volume-up</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-warning"></i> fa fa-warning
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-wheelchair"></i> fa fa-wheelchair</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-wifi"></i> fa fa-wifi</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-wrench"></i> fa fa-wrench</div>
            </div>
          </section>

          <section id="hand">
            <h4 class="page-header">Hand Icons</h4>

            <div class="row fontawesome-icon-list">
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-grab-o"></i> fa fa-hand-grab-o
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-lizard-o"></i> fa fa-hand-lizard-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-o-down"></i> fa fa-hand-o-down</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-o-left"></i> fa fa-hand-o-left</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-o-right"></i> fa fa-hand-o-right</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-o-up"></i> fa fa-hand-o-up</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-paper-o"></i> fa fa-hand-paper-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-peace-o"></i> fa fa-hand-peace-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-pointer-o"></i> fa fa-hand-pointer-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-rock-o"></i> fa fa-hand-rock-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-scissors-o"></i> fa fa-hand-scissors-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-spock-o"></i> fa fa-hand-spock-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-stop-o"></i> fa fa-hand-stop-o
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-thumbs-down"></i> fa fa-thumbs-down</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-thumbs-o-down"></i> fa fa-thumbs-o-down</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-thumbs-o-up"></i> fa fa-thumbs-o-up</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-thumbs-up"></i> fa fa-thumbs-up</div>
            </div>
          </section>

          <section id="transportation">
            <h4 class="page-header">Transportation Icons</h4>

            <div class="row fontawesome-icon-list">
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-ambulance"></i> fa fa-ambulance</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-automobile"></i> fa fa-automobile
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bicycle"></i> fa fa-bicycle</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bus"></i> fa fa-bus</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cab"></i> fa fa-cab <span class="text-muted">(alias)</span>
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-car"></i> fa fa-car</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-fighter-jet"></i> fa fa-fighter-jet</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-motorcycle"></i> fa fa-motorcycle</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-plane"></i> fa fa-plane</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-rocket"></i> fa fa-rocket</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-ship"></i> fa fa-ship</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-space-shuttle"></i> fa fa-space-shuttle</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-subway"></i> fa fa-subway</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-taxi"></i> fa fa-taxi</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-train"></i> fa fa-train</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-truck"></i> fa fa-truck</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-wheelchair"></i> fa fa-wheelchair</div>
            </div>
          </section>

          <section id="gender">
            <h4 class="page-header">Gender Icons</h4>

            <div class="row fontawesome-icon-list">
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-genderless"></i> fa fa-genderless</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-intersex"></i> fa fa-intersex
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-mars"></i> fa fa-mars</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-mars-double"></i> fa fa-mars-double</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-mars-stroke"></i> fa fa-mars-stroke</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-mars-stroke-h"></i> fa fa-mars-stroke-h</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-mars-stroke-v"></i> fa fa-mars-stroke-v</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-mercury"></i> fa fa-mercury</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-neuter"></i> fa fa-neuter</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-transgender"></i> fa fa-transgender</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-transgender-alt"></i> fa fa-transgender-alt</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-venus"></i> fa fa-venus</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-venus-double"></i> fa fa-venus-double</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-venus-mars"></i> fa fa-venus-mars</div>
            </div>
          </section>

          <section id="file-type">
            <h2 class="page-header">File Type Icons</h2>

            <div class="row fontawesome-icon-list">
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file"></i> fa fa-file</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-archive-o"></i> fa fa-file-archive-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-audio-o"></i> fa fa-file-audio-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-code-o"></i> fa fa-file-code-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-excel-o"></i> fa fa-file-excel-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-image-o"></i> fa fa-file-image-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-movie-o"></i> fa fa-file-movie-o
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-o"></i> fa fa-file-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-pdf-o"></i> fa fa-file-pdf-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-photo-o"></i> fa fa-file-photo-o
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-picture-o"></i> fa fa-file-picture-o
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-powerpoint-o"></i> fa fa-file-powerpoint-o
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-sound-o"></i> fa fa-file-sound-o
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-text"></i> fa fa-file-text</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-text-o"></i> fa fa-file-text-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-video-o"></i> fa fa-file-video-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-word-o"></i> fa fa-file-word-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-zip-o"></i> fa fa-file-zip-o
                <span class="text-muted">(alias)</span></div>
            </div>
          </section>

          <section id="spinner">
            <h2 class="page-header">Spinner Icons</h2>

            <div class="row fontawesome-icon-list">
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-circle-o-notch"></i> fa fa-circle-o-notch</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cog"></i> fa fa-cog</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-gear"></i> fa fa-gear <span class="text-muted">(alias)</span>
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-refresh"></i> fa fa-refresh</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-spinner"></i> fa fa-spinner</div>
            </div>
          </section>

          <section id="form-control">
            <h4 class="page-header">Form Control Icons</h4>

            <div class="row fontawesome-icon-list">
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-check-square"></i> fa fa-check-square</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-check-square-o"></i> fa fa-check-square-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-circle"></i> fa fa-circle</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-circle-o"></i> fa fa-circle-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-dot-circle-o"></i> fa fa-dot-circle-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-minus-square"></i> fa fa-minus-square</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-minus-square-o"></i> fa fa-minus-square-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-plus-square"></i> fa fa-plus-square</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-plus-square-o"></i> fa fa-plus-square-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-square"></i> fa fa-square</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-square-o"></i> fa fa-square-o</div>
            </div>
          </section>

          <section id="payment">
            <h4 class="page-header">Payment Icons</h4>

            <div class="row fontawesome-icon-list">
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cc-amex"></i> fa fa-cc-amex</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cc-diners-club"></i> fa fa-cc-diners-club</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cc-discover"></i> fa fa-cc-discover</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cc-jcb"></i> fa fa-cc-jcb</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cc-mastercard"></i> fa fa-cc-mastercard</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cc-paypal"></i> fa fa-cc-paypal</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cc-stripe"></i> fa fa-cc-stripe</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cc-visa"></i> fa fa-cc-visa</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-credit-card"></i> fa fa-credit-card</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-google-wallet"></i> fa fa-google-wallet</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-paypal"></i> fa fa-paypal</div>
            </div>
          </section>

          <section id="chart">
            <h4 class="page-header">Chart Icons</h4>

            <div class="row fontawesome-icon-list">
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-area-chart"></i> fa fa-area-chart</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bar-chart"></i> fa fa-bar-chart</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bar-chart-o"></i> fa fa-bar-chart-o
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-line-chart"></i> fa fa-line-chart</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-pie-chart"></i> fa fa-pie-chart</div>
            </div>
          </section>

          <section id="currency">
            <h4 class="page-header">Currency Icons</h4>

            <div class="row fontawesome-icon-list">
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bitcoin"></i> fa fa-bitcoin
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-btc"></i> fa fa-btc</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cny"></i> fa fa-cny <span class="text-muted">(alias)</span>
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-dollar"></i> fa fa-dollar
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-eur"></i> fa fa-eur</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-euro"></i> fa fa-euro <span class="text-muted">(alias)</span>
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-gbp"></i> fa fa-gbp</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-gg"></i> fa fa-gg</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-gg-circle"></i> fa fa-gg-circle</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-ils"></i> fa fa-ils</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-inr"></i> fa fa-inr</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-jpy"></i> fa fa-jpy</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-krw"></i> fa fa-krw</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-money"></i> fa fa-money</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-rmb"></i> fa fa-rmb <span class="text-muted">(alias)</span>
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-rouble"></i> fa fa-rouble
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-rub"></i> fa fa-rub</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-ruble"></i> fa fa-ruble <span class="text-muted">(alias)</span>
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-rupee"></i> fa fa-rupee <span class="text-muted">(alias)</span>
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-shekel"></i> fa fa-shekel
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sheqel"></i> fa fa-sheqel
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-try"></i> fa fa-try</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-turkish-lira"></i> fa fa-turkish-lira
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-usd"></i> fa fa-usd</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-won"></i> fa fa-won <span class="text-muted">(alias)</span>
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-yen"></i> fa fa-yen <span class="text-muted">(alias)</span>
              </div>
            </div>
          </section>

          <section id="text-editor">
            <h4 class="page-header">Text Editor Icons</h4>

            <div class="row fontawesome-icon-list">
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-align-center"></i> fa fa-align-center</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-align-justify"></i> fa fa-align-justify</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-align-left"></i> fa fa-align-left</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-align-right"></i> fa fa-align-right</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bold"></i> fa fa-bold</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-chain"></i> fa fa-chain <span class="text-muted">(alias)</span>
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-chain-broken"></i> fa fa-chain-broken</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-clipboard"></i> fa fa-clipboard</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-columns"></i> fa fa-columns</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-copy"></i> fa fa-copy <span class="text-muted">(alias)</span>
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cut"></i> fa fa-cut <span class="text-muted">(alias)</span>
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-dedent"></i> fa fa-dedent
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-eraser"></i> fa fa-eraser</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file"></i> fa fa-file</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-o"></i> fa fa-file-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-text"></i> fa fa-file-text</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-file-text-o"></i> fa fa-file-text-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-files-o"></i> fa fa-files-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-floppy-o"></i> fa fa-floppy-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-font"></i> fa fa-font</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-header"></i> fa fa-header</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-indent"></i> fa fa-indent</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-italic"></i> fa fa-italic</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-link"></i> fa fa-link</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-list"></i> fa fa-list</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-list-alt"></i> fa fa-list-alt</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-list-ol"></i> fa fa-list-ol</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-list-ul"></i> fa fa-list-ul</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-outdent"></i> fa fa-outdent</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-paperclip"></i> fa fa-paperclip</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-paragraph"></i> fa fa-paragraph</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-paste"></i> fa fa-paste <span class="text-muted">(alias)</span>
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-repeat"></i> fa fa-repeat</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-rotate-left"></i> fa fa-rotate-left
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-rotate-right"></i> fa fa-rotate-right
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-save"></i> fa fa-save <span class="text-muted">(alias)</span>
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-scissors"></i> fa fa-scissors</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-strikethrough"></i> fa fa-strikethrough</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-subscript"></i> fa fa-subscript</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-superscript"></i> fa fa-superscript</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-table"></i> fa fa-table</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-text-height"></i> fa fa-text-height</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-text-width"></i> fa fa-text-width</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-th"></i> fa fa-th</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-th-large"></i> fa fa-th-large</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-th-list"></i> fa fa-th-list</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-underline"></i> fa fa-underline</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-undo"></i> fa fa-undo</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-unlink"></i> fa fa-unlink
                <span class="text-muted">(alias)</span></div>
            </div>
          </section>

          <section id="directional">
            <h4 class="page-header">Directional Icons</h4>

            <div class="row fontawesome-icon-list">
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-angle-double-down"></i> fa fa-angle-double-down
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-angle-double-left"></i> fa fa-angle-double-left
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-angle-double-right"></i> fa fa-angle-double-right
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-angle-double-up"></i> fa fa-angle-double-up</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-angle-down"></i> fa fa-angle-down</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-angle-left"></i> fa fa-angle-left</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-angle-right"></i> fa fa-angle-right</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-angle-up"></i> fa fa-angle-up</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-arrow-circle-down"></i> fa fa-arrow-circle-down
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-arrow-circle-left"></i> fa fa-arrow-circle-left
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-arrow-circle-o-down"></i> fa fa-arrow-circle-o-down
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-arrow-circle-o-left"></i> fa fa-arrow-circle-o-left
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-arrow-circle-o-right"></i> fa fa-arrow-circle-o-right
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-arrow-circle-o-up"></i> fa fa-arrow-circle-o-up
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-arrow-circle-right"></i> fa fa-arrow-circle-right
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-arrow-circle-up"></i> fa fa-arrow-circle-up</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-arrow-down"></i> fa fa-arrow-down</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-arrow-left"></i> fa fa-arrow-left</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-arrow-right"></i> fa fa-arrow-right</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-arrow-up"></i> fa fa-arrow-up</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-arrows"></i> fa fa-arrows</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-arrows-alt"></i> fa fa-arrows-alt</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-arrows-h"></i> fa fa-arrows-h</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-arrows-v"></i> fa fa-arrows-v</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-caret-down"></i> fa fa-caret-down</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-caret-left"></i> fa fa-caret-left</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-caret-right"></i> fa fa-caret-right</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-caret-square-o-down"></i> fa fa-caret-square-o-down
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-caret-square-o-left"></i> fa fa-caret-square-o-left
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-caret-square-o-right"></i> fa fa-caret-square-o-right
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-caret-square-o-up"></i> fa fa-caret-square-o-up
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-caret-up"></i> fa fa-caret-up</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-chevron-circle-down"></i> fa fa-chevron-circle-down
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-chevron-circle-left"></i> fa fa-chevron-circle-left
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-chevron-circle-right"></i> fa fa-chevron-circle-right
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-chevron-circle-up"></i> fa fa-chevron-circle-up
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-chevron-down"></i> fa fa-chevron-down</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-chevron-left"></i> fa fa-chevron-left</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-chevron-right"></i> fa fa-chevron-right</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-chevron-up"></i> fa fa-chevron-up</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-exchange"></i> fa fa-exchange</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-o-down"></i> fa fa-hand-o-down</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-o-left"></i> fa fa-hand-o-left</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-o-right"></i> fa fa-hand-o-right</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hand-o-up"></i> fa fa-hand-o-up</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-long-arrow-down"></i> fa fa-long-arrow-down</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-long-arrow-left"></i> fa fa-long-arrow-left</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-long-arrow-right"></i> fa fa-long-arrow-right
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-long-arrow-up"></i> fa fa-long-arrow-up</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-toggle-down"></i> fa fa-toggle-down
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-toggle-left"></i> fa fa-toggle-left
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-toggle-right"></i> fa fa-toggle-right
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-toggle-up"></i> fa fa-toggle-up
                <span class="text-muted">(alias)</span></div>
            </div>
          </section>

          <section id="video-player">
            <h4 class="page-header">Video Player Icons</h4>

            <div class="row fontawesome-icon-list">
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-arrows-alt"></i> fa fa-arrows-alt</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-backward"></i> fa fa-backward</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-compress"></i> fa fa-compress</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-eject"></i> fa fa-eject</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-expand"></i> fa fa-expand</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-fast-backward"></i> fa fa-fast-backward</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-fast-forward"></i> fa fa-fast-forward</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-forward"></i> fa fa-forward</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-pause"></i> fa fa-pause</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-play"></i> fa fa-play</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-play-circle"></i> fa fa-play-circle</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-play-circle-o"></i> fa fa-play-circle-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-random"></i> fa fa-random</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-step-backward"></i> fa fa-step-backward</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-step-forward"></i> fa fa-step-forward</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-stop"></i> fa fa-stop</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-youtube-play"></i> fa fa-youtube-play</div>
            </div>
          </section>

          <section id="brand">
            <h4 class="page-header">Brand Icons</h4>

            <div class="row fontawesome-icon-list">
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-500px"></i> fa fa-500px</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-adn"></i> fa fa-adn</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-amazon"></i> fa fa-amazon</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-android"></i> fa fa-android</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-angellist"></i> fa fa-angellist</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-apple"></i> fa fa-apple</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-behance"></i> fa fa-behance</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-behance-square"></i> fa fa-behance-square</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bitbucket"></i> fa fa-bitbucket</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bitbucket-square"></i> fa fa-bitbucket-square
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bitcoin"></i> fa fa-bitcoin
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-black-tie"></i> fa fa-black-tie</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-btc"></i> fa fa-btc</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-buysellads"></i> fa fa-buysellads</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cc-amex"></i> fa fa-cc-amex</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cc-diners-club"></i> fa fa-cc-diners-club</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cc-discover"></i> fa fa-cc-discover</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cc-jcb"></i> fa fa-cc-jcb</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cc-mastercard"></i> fa fa-cc-mastercard</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cc-paypal"></i> fa fa-cc-paypal</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cc-stripe"></i> fa fa-cc-stripe</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cc-visa"></i> fa fa-cc-visa</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-chrome"></i> fa fa-chrome</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-codepen"></i> fa fa-codepen</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-connectdevelop"></i> fa fa-connectdevelop</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-contao"></i> fa fa-contao</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-css3"></i> fa fa-css3</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-dashcube"></i> fa fa-dashcube</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-delicious"></i> fa fa-delicious</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-deviantart"></i> fa fa-deviantart</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-digg"></i> fa fa-digg</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-dribbble"></i> fa fa-dribbble</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-dropbox"></i> fa fa-dropbox</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-drupal"></i> fa fa-drupal</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-empire"></i> fa fa-empire</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-expeditedssl"></i> fa fa-expeditedssl</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-facebook"></i> fa fa-facebook</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-facebook-f"></i> fa fa-facebook-f
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-facebook-official"></i> fa fa-facebook-official
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-facebook-square"></i> fa fa-facebook-square</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-firefox"></i> fa fa-firefox</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-flickr"></i> fa fa-flickr</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-fonticons"></i> fa fa-fonticons</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-forumbee"></i> fa fa-forumbee</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-foursquare"></i> fa fa-foursquare</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-ge"></i> fa fa-ge
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-get-pocket"></i> fa fa-get-pocket</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-gg"></i> fa fa-gg</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-gg-circle"></i> fa fa-gg-circle</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-git"></i> fa fa-git</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-git-square"></i> fa fa-git-square</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-github"></i> fa fa-github</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-github-alt"></i> fa fa-github-alt</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-github-square"></i> fa fa-github-square</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-gittip"></i> fa fa-gittip
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-google"></i> fa fa-google</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-google-plus"></i> fa fa-google-plus</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-google-plus-square"></i> fa fa-google-plus-square
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-google-wallet"></i> fa fa-google-wallet</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-gratipay"></i> fa fa-gratipay</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hacker-news"></i> fa fa-hacker-news</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-houzz"></i> fa fa-houzz</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-html5"></i> fa fa-html5</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-instagram"></i> fa fa-instagram</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-internet-explorer"></i> fa fa-internet-explorer
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-ioxhost"></i> fa fa-ioxhost</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-joomla"></i> fa fa-joomla</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-jsfiddle"></i> fa fa-jsfiddle</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-lastfm"></i> fa fa-lastfm</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-lastfm-square"></i> fa fa-lastfm-square</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-leanpub"></i> fa fa-leanpub</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-linkedin"></i> fa fa-linkedin</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-linkedin-square"></i> fa fa-linkedin-square</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-linux"></i> fa fa-linux</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-maxcdn"></i> fa fa-maxcdn</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-meanpath"></i> fa fa-meanpath</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-medium"></i> fa fa-medium</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-odnoklassniki"></i> fa fa-odnoklassniki</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-odnoklassniki-square"></i> fa fa-odnoklassniki-square
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-opencart"></i> fa fa-opencart</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-openid"></i> fa fa-openid</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-opera"></i> fa fa-opera</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-optin-monster"></i> fa fa-optin-monster</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-pagelines"></i> fa fa-pagelines</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-paypal"></i> fa fa-paypal</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-pied-piper"></i> fa fa-pied-piper</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-pied-piper-alt"></i> fa fa-pied-piper-alt</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-pinterest"></i> fa fa-pinterest</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-pinterest-p"></i> fa fa-pinterest-p</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-pinterest-square"></i> fa fa-pinterest-square
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-qq"></i> fa fa-qq</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-ra"></i> fa fa-ra
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-rebel"></i> fa fa-rebel</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-reddit"></i> fa fa-reddit</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-reddit-square"></i> fa fa-reddit-square</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-renren"></i> fa fa-renren</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-safari"></i> fa fa-safari</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sellsy"></i> fa fa-sellsy</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-share-alt"></i> fa fa-share-alt</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-share-alt-square"></i> fa fa-share-alt-square
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-shirtsinbulk"></i> fa fa-shirtsinbulk</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-simplybuilt"></i> fa fa-simplybuilt</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-skyatlas"></i> fa fa-skyatlas</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-skype"></i> fa fa-skype</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-slack"></i> fa fa-slack</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-slideshare"></i> fa fa-slideshare</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-soundcloud"></i> fa fa-soundcloud</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-spotify"></i> fa fa-spotify</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-stack-exchange"></i> fa fa-stack-exchange</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-stack-overflow"></i> fa fa-stack-overflow</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-steam"></i> fa fa-steam</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-steam-square"></i> fa fa-steam-square</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-stumbleupon"></i> fa fa-stumbleupon</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-stumbleupon-circle"></i> fa fa-stumbleupon-circle
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-tencent-weibo"></i> fa fa-tencent-weibo</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-trello"></i> fa fa-trello</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-tripadvisor"></i> fa fa-tripadvisor</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-tumblr"></i> fa fa-tumblr</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-tumblr-square"></i> fa fa-tumblr-square</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-twitch"></i> fa fa-twitch</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-twitter"></i> fa fa-twitter</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-twitter-square"></i> fa fa-twitter-square</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-viacoin"></i> fa fa-viacoin</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-vimeo"></i> fa fa-vimeo</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-vimeo-square"></i> fa fa-vimeo-square</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-vine"></i> fa fa-vine</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-vk"></i> fa fa-vk</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-wechat"></i> fa fa-wechat
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-weibo"></i> fa fa-weibo</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-weixin"></i> fa fa-weixin</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-whatsapp"></i> fa fa-whatsapp</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-wikipedia-w"></i> fa fa-wikipedia-w</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-windows"></i> fa fa-windows</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-wordpress"></i> fa fa-wordpress</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-xing"></i> fa fa-xing</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-xing-square"></i> fa fa-xing-square</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-y-combinator"></i> fa fa-y-combinator</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-y-combinator-square"></i> fa fa-y-combinator-square 
                <span class="text-muted">(alias)</span>
              </div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-yahoo"></i> fa fa-yahoo</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-yc"></i> fa fa-yc
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-yc-square"></i> fa fa-yc-square
                <span class="text-muted">(alias)</span></div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-yelp"></i> fa fa-yelp</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-youtube"></i> fa fa-youtube</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-youtube-play"></i> fa fa-youtube-play</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-youtube-square"></i> fa fa-youtube-square</div>
            </div>
          </section>

          <section id="medical">
            <h4 class="page-header">Medical Icons</h4>

            <div class="row">
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-ambulance"></i> fa fa-ambulance</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-h-square"></i> fa fa-h-square</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-heart"></i> fa fa-heart</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-heart-o"></i> fa fa-heart-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-heartbeat"></i> fa fa-heartbeat</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hospital-o"></i> fa fa-hospital-o</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-medkit"></i> fa fa-medkit</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-plus-square"></i> fa fa-plus-square</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-stethoscope"></i> fa fa-stethoscope</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-user-md"></i> fa fa-user-md</div>
              <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-wheelchair"></i> fa fa-wheelchair</div>
            </div>
          </section>
        </div>
        <!-- /#fa-icons -->

        <!-- glyphicons-->
        <div class="tab-pane" id="glyphicons">

          <ul class="bs-glyphicons">
            <li>
              <span class="glyphicon glyphicon-asterisk"></span>
              <span class="glyphicon-class">glyphicon glyphicon-asterisk</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-plus"></span>
              <span class="glyphicon-class">glyphicon glyphicon-plus</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-euro"></span>
              <span class="glyphicon-class">glyphicon glyphicon-euro</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-eur"></span>
              <span class="glyphicon-class">glyphicon glyphicon-eur</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-minus"></span>
              <span class="glyphicon-class">glyphicon glyphicon-minus</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-cloud"></span>
              <span class="glyphicon-class">glyphicon glyphicon-cloud</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-envelope"></span>
              <span class="glyphicon-class">glyphicon glyphicon-envelope</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-pencil"></span>
              <span class="glyphicon-class">glyphicon glyphicon-pencil</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-glass"></span>
              <span class="glyphicon-class">glyphicon glyphicon-glass</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-music"></span>
              <span class="glyphicon-class">glyphicon glyphicon-music</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-search"></span>
              <span class="glyphicon-class">glyphicon glyphicon-search</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-heart"></span>
              <span class="glyphicon-class">glyphicon glyphicon-heart</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-star"></span>
              <span class="glyphicon-class">glyphicon glyphicon-star</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-star-empty"></span>
              <span class="glyphicon-class">glyphicon glyphicon-star-empty</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-user"></span>
              <span class="glyphicon-class">glyphicon glyphicon-user</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-film"></span>
              <span class="glyphicon-class">glyphicon glyphicon-film</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-th-large"></span>
              <span class="glyphicon-class">glyphicon glyphicon-th-large</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-th"></span>
              <span class="glyphicon-class">glyphicon glyphicon-th</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-th-list"></span>
              <span class="glyphicon-class">glyphicon glyphicon-th-list</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-ok"></span>
              <span class="glyphicon-class">glyphicon glyphicon-ok</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-remove"></span>
              <span class="glyphicon-class">glyphicon glyphicon-remove</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-zoom-in"></span>
              <span class="glyphicon-class">glyphicon glyphicon-zoom-in</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-zoom-out"></span>
              <span class="glyphicon-class">glyphicon glyphicon-zoom-out</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-off"></span>
              <span class="glyphicon-class">glyphicon glyphicon-off</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-signal"></span>
              <span class="glyphicon-class">glyphicon glyphicon-signal</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-cog"></span>
              <span class="glyphicon-class">glyphicon glyphicon-cog</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-trash"></span>
              <span class="glyphicon-class">glyphicon glyphicon-trash</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-home"></span>
              <span class="glyphicon-class">glyphicon glyphicon-home</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-file"></span>
              <span class="glyphicon-class">glyphicon glyphicon-file</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-time"></span>
              <span class="glyphicon-class">glyphicon glyphicon-time</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-road"></span>
              <span class="glyphicon-class">glyphicon glyphicon-road</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-download-alt"></span>
              <span class="glyphicon-class">glyphicon glyphicon-download-alt</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-download"></span>
              <span class="glyphicon-class">glyphicon glyphicon-download</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-upload"></span>
              <span class="glyphicon-class">glyphicon glyphicon-upload</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-inbox"></span>
              <span class="glyphicon-class">glyphicon glyphicon-inbox</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-play-circle"></span>
              <span class="glyphicon-class">glyphicon glyphicon-play-circle</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-repeat"></span>
              <span class="glyphicon-class">glyphicon glyphicon-repeat</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-refresh"></span>
              <span class="glyphicon-class">glyphicon glyphicon-refresh</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-list-alt"></span>
              <span class="glyphicon-class">glyphicon glyphicon-list-alt</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-lock"></span>
              <span class="glyphicon-class">glyphicon glyphicon-lock</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-flag"></span>
              <span class="glyphicon-class">glyphicon glyphicon-flag</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-headphones"></span>
              <span class="glyphicon-class">glyphicon glyphicon-headphones</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-volume-off"></span>
              <span class="glyphicon-class">glyphicon glyphicon-volume-off</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-volume-down"></span>
              <span class="glyphicon-class">glyphicon glyphicon-volume-down</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-volume-up"></span>
              <span class="glyphicon-class">glyphicon glyphicon-volume-up</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-qrcode"></span>
              <span class="glyphicon-class">glyphicon glyphicon-qrcode</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-barcode"></span>
              <span class="glyphicon-class">glyphicon glyphicon-barcode</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-tag"></span>
              <span class="glyphicon-class">glyphicon glyphicon-tag</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-tags"></span>
              <span class="glyphicon-class">glyphicon glyphicon-tags</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-book"></span>
              <span class="glyphicon-class">glyphicon glyphicon-book</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-bookmark"></span>
              <span class="glyphicon-class">glyphicon glyphicon-bookmark</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-print"></span>
              <span class="glyphicon-class">glyphicon glyphicon-print</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-camera"></span>
              <span class="glyphicon-class">glyphicon glyphicon-camera</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-font"></span>
              <span class="glyphicon-class">glyphicon glyphicon-font</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-bold"></span>
              <span class="glyphicon-class">glyphicon glyphicon-bold</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-italic"></span>
              <span class="glyphicon-class">glyphicon glyphicon-italic</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-text-height"></span>
              <span class="glyphicon-class">glyphicon glyphicon-text-height</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-text-width"></span>
              <span class="glyphicon-class">glyphicon glyphicon-text-width</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-align-left"></span>
              <span class="glyphicon-class">glyphicon glyphicon-align-left</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-align-center"></span>
              <span class="glyphicon-class">glyphicon glyphicon-align-center</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-align-right"></span>
              <span class="glyphicon-class">glyphicon glyphicon-align-right</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-align-justify"></span>
              <span class="glyphicon-class">glyphicon glyphicon-align-justify</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-list"></span>
              <span class="glyphicon-class">glyphicon glyphicon-list</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-indent-left"></span>
              <span class="glyphicon-class">glyphicon glyphicon-indent-left</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-indent-right"></span>
              <span class="glyphicon-class">glyphicon glyphicon-indent-right</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-facetime-video"></span>
              <span class="glyphicon-class">glyphicon glyphicon-facetime-video</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-picture"></span>
              <span class="glyphicon-class">glyphicon glyphicon-picture</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-map-marker"></span>
              <span class="glyphicon-class">glyphicon glyphicon-map-marker</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-adjust"></span>
              <span class="glyphicon-class">glyphicon glyphicon-adjust</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-tint"></span>
              <span class="glyphicon-class">glyphicon glyphicon-tint</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-edit"></span>
              <span class="glyphicon-class">glyphicon glyphicon-edit</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-share"></span>
              <span class="glyphicon-class">glyphicon glyphicon-share</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-check"></span>
              <span class="glyphicon-class">glyphicon glyphicon-check</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-move"></span>
              <span class="glyphicon-class">glyphicon glyphicon-move</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-step-backward"></span>
              <span class="glyphicon-class">glyphicon glyphicon-step-backward</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-fast-backward"></span>
              <span class="glyphicon-class">glyphicon glyphicon-fast-backward</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-backward"></span>
              <span class="glyphicon-class">glyphicon glyphicon-backward</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-play"></span>
              <span class="glyphicon-class">glyphicon glyphicon-play</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-pause"></span>
              <span class="glyphicon-class">glyphicon glyphicon-pause</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-stop"></span>
              <span class="glyphicon-class">glyphicon glyphicon-stop</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-forward"></span>
              <span class="glyphicon-class">glyphicon glyphicon-forward</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-fast-forward"></span>
              <span class="glyphicon-class">glyphicon glyphicon-fast-forward</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-step-forward"></span>
              <span class="glyphicon-class">glyphicon glyphicon-step-forward</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-eject"></span>
              <span class="glyphicon-class">glyphicon glyphicon-eject</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-chevron-left"></span>
              <span class="glyphicon-class">glyphicon glyphicon-chevron-left</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-chevron-right"></span>
              <span class="glyphicon-class">glyphicon glyphicon-chevron-right</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-plus-sign"></span>
              <span class="glyphicon-class">glyphicon glyphicon-plus-sign</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-minus-sign"></span>
              <span class="glyphicon-class">glyphicon glyphicon-minus-sign</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-remove-sign"></span>
              <span class="glyphicon-class">glyphicon glyphicon-remove-sign</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-ok-sign"></span>
              <span class="glyphicon-class">glyphicon glyphicon-ok-sign</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-question-sign"></span>
              <span class="glyphicon-class">glyphicon glyphicon-question-sign</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-info-sign"></span>
              <span class="glyphicon-class">glyphicon glyphicon-info-sign</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-screenshot"></span>
              <span class="glyphicon-class">glyphicon glyphicon-screenshot</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-remove-circle"></span>
              <span class="glyphicon-class">glyphicon glyphicon-remove-circle</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-ok-circle"></span>
              <span class="glyphicon-class">glyphicon glyphicon-ok-circle</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-ban-circle"></span>
              <span class="glyphicon-class">glyphicon glyphicon-ban-circle</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-arrow-left"></span>
              <span class="glyphicon-class">glyphicon glyphicon-arrow-left</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-arrow-right"></span>
              <span class="glyphicon-class">glyphicon glyphicon-arrow-right</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-arrow-up"></span>
              <span class="glyphicon-class">glyphicon glyphicon-arrow-up</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-arrow-down"></span>
              <span class="glyphicon-class">glyphicon glyphicon-arrow-down</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-share-alt"></span>
              <span class="glyphicon-class">glyphicon glyphicon-share-alt</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-resize-full"></span>
              <span class="glyphicon-class">glyphicon glyphicon-resize-full</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-resize-small"></span>
              <span class="glyphicon-class">glyphicon glyphicon-resize-small</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-exclamation-sign"></span>
              <span class="glyphicon-class">glyphicon glyphicon-exclamation-sign</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-gift"></span>
              <span class="glyphicon-class">glyphicon glyphicon-gift</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-leaf"></span>
              <span class="glyphicon-class">glyphicon glyphicon-leaf</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-fire"></span>
              <span class="glyphicon-class">glyphicon glyphicon-fire</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-eye-open"></span>
              <span class="glyphicon-class">glyphicon glyphicon-eye-open</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-eye-close"></span>
              <span class="glyphicon-class">glyphicon glyphicon-eye-close</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-warning-sign"></span>
              <span class="glyphicon-class">glyphicon glyphicon-warning-sign</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-plane"></span>
              <span class="glyphicon-class">glyphicon glyphicon-plane</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-calendar"></span>
              <span class="glyphicon-class">glyphicon glyphicon-calendar</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-random"></span>
              <span class="glyphicon-class">glyphicon glyphicon-random</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-comment"></span>
              <span class="glyphicon-class">glyphicon glyphicon-comment</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-magnet"></span>
              <span class="glyphicon-class">glyphicon glyphicon-magnet</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-chevron-up"></span>
              <span class="glyphicon-class">glyphicon glyphicon-chevron-up</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-chevron-down"></span>
              <span class="glyphicon-class">glyphicon glyphicon-chevron-down</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-retweet"></span>
              <span class="glyphicon-class">glyphicon glyphicon-retweet</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-shopping-cart"></span>
              <span class="glyphicon-class">glyphicon glyphicon-shopping-cart</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-folder-close"></span>
              <span class="glyphicon-class">glyphicon glyphicon-folder-close</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-folder-open"></span>
              <span class="glyphicon-class">glyphicon glyphicon-folder-open</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-resize-vertical"></span>
              <span class="glyphicon-class">glyphicon glyphicon-resize-vertical</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-resize-horizontal"></span>
              <span class="glyphicon-class">glyphicon glyphicon-resize-horizontal</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-hdd"></span>
              <span class="glyphicon-class">glyphicon glyphicon-hdd</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-bullhorn"></span>
              <span class="glyphicon-class">glyphicon glyphicon-bullhorn</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-bell"></span>
              <span class="glyphicon-class">glyphicon glyphicon-bell</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-certificate"></span>
              <span class="glyphicon-class">glyphicon glyphicon-certificate</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-thumbs-up"></span>
              <span class="glyphicon-class">glyphicon glyphicon-thumbs-up</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-thumbs-down"></span>
              <span class="glyphicon-class">glyphicon glyphicon-thumbs-down</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-hand-right"></span>
              <span class="glyphicon-class">glyphicon glyphicon-hand-right</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-hand-left"></span>
              <span class="glyphicon-class">glyphicon glyphicon-hand-left</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-hand-up"></span>
              <span class="glyphicon-class">glyphicon glyphicon-hand-up</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-hand-down"></span>
              <span class="glyphicon-class">glyphicon glyphicon-hand-down</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-circle-arrow-right"></span>
              <span class="glyphicon-class">glyphicon glyphicon-circle-arrow-right</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-circle-arrow-left"></span>
              <span class="glyphicon-class">glyphicon glyphicon-circle-arrow-left</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-circle-arrow-up"></span>
              <span class="glyphicon-class">glyphicon glyphicon-circle-arrow-up</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-circle-arrow-down"></span>
              <span class="glyphicon-class">glyphicon glyphicon-circle-arrow-down</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-globe"></span>
              <span class="glyphicon-class">glyphicon glyphicon-globe</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-wrench"></span>
              <span class="glyphicon-class">glyphicon glyphicon-wrench</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-tasks"></span>
              <span class="glyphicon-class">glyphicon glyphicon-tasks</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-filter"></span>
              <span class="glyphicon-class">glyphicon glyphicon-filter</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-briefcase"></span>
              <span class="glyphicon-class">glyphicon glyphicon-briefcase</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-fullscreen"></span>
              <span class="glyphicon-class">glyphicon glyphicon-fullscreen</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-dashboard"></span>
              <span class="glyphicon-class">glyphicon glyphicon-dashboard</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-paperclip"></span>
              <span class="glyphicon-class">glyphicon glyphicon-paperclip</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-heart-empty"></span>
              <span class="glyphicon-class">glyphicon glyphicon-heart-empty</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-link"></span>
              <span class="glyphicon-class">glyphicon glyphicon-link</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-phone"></span>
              <span class="glyphicon-class">glyphicon glyphicon-phone</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-pushpin"></span>
              <span class="glyphicon-class">glyphicon glyphicon-pushpin</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-usd"></span>
              <span class="glyphicon-class">glyphicon glyphicon-usd</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-gbp"></span>
              <span class="glyphicon-class">glyphicon glyphicon-gbp</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-sort"></span>
              <span class="glyphicon-class">glyphicon glyphicon-sort</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-sort-by-alphabet"></span>
              <span class="glyphicon-class">glyphicon glyphicon-sort-by-alphabet</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-sort-by-alphabet-alt"></span>
              <span class="glyphicon-class">glyphicon glyphicon-sort-by-alphabet-alt</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-sort-by-order"></span>
              <span class="glyphicon-class">glyphicon glyphicon-sort-by-order</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-sort-by-order-alt"></span>
              <span class="glyphicon-class">glyphicon glyphicon-sort-by-order-alt</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-sort-by-attributes"></span>
              <span class="glyphicon-class">glyphicon glyphicon-sort-by-attributes</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-sort-by-attributes-alt"></span>
              <span class="glyphicon-class">glyphicon glyphicon-sort-by-attributes-alt</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-unchecked"></span>
              <span class="glyphicon-class">glyphicon glyphicon-unchecked</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-expand"></span>
              <span class="glyphicon-class">glyphicon glyphicon-expand</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-collapse-down"></span>
              <span class="glyphicon-class">glyphicon glyphicon-collapse-down</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-collapse-up"></span>
              <span class="glyphicon-class">glyphicon glyphicon-collapse-up</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-log-in"></span>
              <span class="glyphicon-class">glyphicon glyphicon-log-in</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-flash"></span>
              <span class="glyphicon-class">glyphicon glyphicon-flash</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-log-out"></span>
              <span class="glyphicon-class">glyphicon glyphicon-log-out</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-new-window"></span>
              <span class="glyphicon-class">glyphicon glyphicon-new-window</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-record"></span>
              <span class="glyphicon-class">glyphicon glyphicon-record</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-save"></span>
              <span class="glyphicon-class">glyphicon glyphicon-save</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-open"></span>
              <span class="glyphicon-class">glyphicon glyphicon-open</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-saved"></span>
              <span class="glyphicon-class">glyphicon glyphicon-saved</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-import"></span>
              <span class="glyphicon-class">glyphicon glyphicon-import</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-export"></span>
              <span class="glyphicon-class">glyphicon glyphicon-export</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-send"></span>
              <span class="glyphicon-class">glyphicon glyphicon-send</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-floppy-disk"></span>
              <span class="glyphicon-class">glyphicon glyphicon-floppy-disk</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-floppy-saved"></span>
              <span class="glyphicon-class">glyphicon glyphicon-floppy-saved</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-floppy-remove"></span>
              <span class="glyphicon-class">glyphicon glyphicon-floppy-remove</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-floppy-save"></span>
              <span class="glyphicon-class">glyphicon glyphicon-floppy-save</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-floppy-open"></span>
              <span class="glyphicon-class">glyphicon glyphicon-floppy-open</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-credit-card"></span>
              <span class="glyphicon-class">glyphicon glyphicon-credit-card</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-transfer"></span>
              <span class="glyphicon-class">glyphicon glyphicon-transfer</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-cutlery"></span>
              <span class="glyphicon-class">glyphicon glyphicon-cutlery</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-header"></span>
              <span class="glyphicon-class">glyphicon glyphicon-header</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-compressed"></span>
              <span class="glyphicon-class">glyphicon glyphicon-compressed</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-earphone"></span>
              <span class="glyphicon-class">glyphicon glyphicon-earphone</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-phone-alt"></span>
              <span class="glyphicon-class">glyphicon glyphicon-phone-alt</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-tower"></span>
              <span class="glyphicon-class">glyphicon glyphicon-tower</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-stats"></span>
              <span class="glyphicon-class">glyphicon glyphicon-stats</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-sd-video"></span>
              <span class="glyphicon-class">glyphicon glyphicon-sd-video</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-hd-video"></span>
              <span class="glyphicon-class">glyphicon glyphicon-hd-video</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-subtitles"></span>
              <span class="glyphicon-class">glyphicon glyphicon-subtitles</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-sound-stereo"></span>
              <span class="glyphicon-class">glyphicon glyphicon-sound-stereo</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-sound-dolby"></span>
              <span class="glyphicon-class">glyphicon glyphicon-sound-dolby</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-sound-5-1"></span>
              <span class="glyphicon-class">glyphicon glyphicon-sound-5-1</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-sound-6-1"></span>
              <span class="glyphicon-class">glyphicon glyphicon-sound-6-1</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-sound-7-1"></span>
              <span class="glyphicon-class">glyphicon glyphicon-sound-7-1</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-copyright-mark"></span>
              <span class="glyphicon-class">glyphicon glyphicon-copyright-mark</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-registration-mark"></span>
              <span class="glyphicon-class">glyphicon glyphicon-registration-mark</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-cloud-download"></span>
              <span class="glyphicon-class">glyphicon glyphicon-cloud-download</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-cloud-upload"></span>
              <span class="glyphicon-class">glyphicon glyphicon-cloud-upload</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-tree-conifer"></span>
              <span class="glyphicon-class">glyphicon glyphicon-tree-conifer</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-tree-deciduous"></span>
              <span class="glyphicon-class">glyphicon glyphicon-tree-deciduous</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-cd"></span>
              <span class="glyphicon-class">glyphicon glyphicon-cd</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-save-file"></span>
              <span class="glyphicon-class">glyphicon glyphicon-save-file</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-open-file"></span>
              <span class="glyphicon-class">glyphicon glyphicon-open-file</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-level-up"></span>
              <span class="glyphicon-class">glyphicon glyphicon-level-up</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-copy"></span>
              <span class="glyphicon-class">glyphicon glyphicon-copy</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-paste"></span>
              <span class="glyphicon-class">glyphicon glyphicon-paste</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-alert"></span>
              <span class="glyphicon-class">glyphicon glyphicon-alert</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-equalizer"></span>
              <span class="glyphicon-class">glyphicon glyphicon-equalizer</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-king"></span>
              <span class="glyphicon-class">glyphicon glyphicon-king</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-queen"></span>
              <span class="glyphicon-class">glyphicon glyphicon-queen</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-pawn"></span>
              <span class="glyphicon-class">glyphicon glyphicon-pawn</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-bishop"></span>
              <span class="glyphicon-class">glyphicon glyphicon-bishop</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-knight"></span>
              <span class="glyphicon-class">glyphicon glyphicon-knight</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-baby-formula"></span>
              <span class="glyphicon-class">glyphicon glyphicon-baby-formula</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-tent"></span>
              <span class="glyphicon-class">glyphicon glyphicon-tent</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-blackboard"></span>
              <span class="glyphicon-class">glyphicon glyphicon-blackboard</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-bed"></span>
              <span class="glyphicon-class">glyphicon glyphicon-bed</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-apple"></span>
              <span class="glyphicon-class">glyphicon glyphicon-apple</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-erase"></span>
              <span class="glyphicon-class">glyphicon glyphicon-erase</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-hourglass"></span>
              <span class="glyphicon-class">glyphicon glyphicon-hourglass</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-lamp"></span>
              <span class="glyphicon-class">glyphicon glyphicon-lamp</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-duplicate"></span>
              <span class="glyphicon-class">glyphicon glyphicon-duplicate</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-piggy-bank"></span>
              <span class="glyphicon-class">glyphicon glyphicon-piggy-bank</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-scissors"></span>
              <span class="glyphicon-class">glyphicon glyphicon-scissors</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-bitcoin"></span>
              <span class="glyphicon-class">glyphicon glyphicon-bitcoin</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-btc"></span>
              <span class="glyphicon-class">glyphicon glyphicon-btc</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-xbt"></span>
              <span class="glyphicon-class">glyphicon glyphicon-xbt</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-yen"></span>
              <span class="glyphicon-class">glyphicon glyphicon-yen</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-jpy"></span>
              <span class="glyphicon-class">glyphicon glyphicon-jpy</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-ruble"></span>
              <span class="glyphicon-class">glyphicon glyphicon-ruble</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-rub"></span>
              <span class="glyphicon-class">glyphicon glyphicon-rub</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-scale"></span>
              <span class="glyphicon-class">glyphicon glyphicon-scale</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-ice-lolly"></span>
              <span class="glyphicon-class">glyphicon glyphicon-ice-lolly</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-ice-lolly-tasted"></span>
              <span class="glyphicon-class">glyphicon glyphicon-ice-lolly-tasted</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-education"></span>
              <span class="glyphicon-class">glyphicon glyphicon-education</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-option-horizontal"></span>
              <span class="glyphicon-class">glyphicon glyphicon-option-horizontal</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-option-vertical"></span>
              <span class="glyphicon-class">glyphicon glyphicon-option-vertical</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-menu-hamburger"></span>
              <span class="glyphicon-class">glyphicon glyphicon-menu-hamburger</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-modal-window"></span>
              <span class="glyphicon-class">glyphicon glyphicon-modal-window</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-oil"></span>
              <span class="glyphicon-class">glyphicon glyphicon-oil</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-grain"></span>
              <span class="glyphicon-class">glyphicon glyphicon-grain</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-sunglasses"></span>
              <span class="glyphicon-class">glyphicon glyphicon-sunglasses</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-text-size"></span>
              <span class="glyphicon-class">glyphicon glyphicon-text-size</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-text-color"></span>
              <span class="glyphicon-class">glyphicon glyphicon-text-color</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-text-background"></span>
              <span class="glyphicon-class">glyphicon glyphicon-text-background</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-object-align-top"></span>
              <span class="glyphicon-class">glyphicon glyphicon-object-align-top</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-object-align-bottom"></span>
              <span class="glyphicon-class">glyphicon glyphicon-object-align-bottom</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-object-align-horizontal"></span>
              <span class="glyphicon-class">glyphicon glyphicon-object-align-horizontal</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-object-align-left"></span>
              <span class="glyphicon-class">glyphicon glyphicon-object-align-left</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-object-align-vertical"></span>
              <span class="glyphicon-class">glyphicon glyphicon-object-align-vertical</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-object-align-right"></span>
              <span class="glyphicon-class">glyphicon glyphicon-object-align-right</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-triangle-right"></span>
              <span class="glyphicon-class">glyphicon glyphicon-triangle-right</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-triangle-left"></span>
              <span class="glyphicon-class">glyphicon glyphicon-triangle-left</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-triangle-bottom"></span>
              <span class="glyphicon-class">glyphicon glyphicon-triangle-bottom</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-triangle-top"></span>
              <span class="glyphicon-class">glyphicon glyphicon-triangle-top</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-console"></span>
              <span class="glyphicon-class">glyphicon glyphicon-console</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-superscript"></span>
              <span class="glyphicon-class">glyphicon glyphicon-superscript</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-subscript"></span>
              <span class="glyphicon-class">glyphicon glyphicon-subscript</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-menu-left"></span>
              <span class="glyphicon-class">glyphicon glyphicon-menu-left</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-menu-right"></span>
              <span class="glyphicon-class">glyphicon glyphicon-menu-right</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-menu-down"></span>
              <span class="glyphicon-class">glyphicon glyphicon-menu-down</span>
            </li>
            <li>
              <span class="glyphicon glyphicon-menu-up"></span>
              <span class="glyphicon-class">glyphicon glyphicon-menu-up</span>
            </li>
          </ul>
        </div>
        <!-- /#ion-icons -->

      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>

</div>
<!-- /.content -->

<div class="modal fade" id="permitOpModal" treeData='' tabindex="-1" role="dialog" aria-labelledby="permitOpModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="permitOpModal">创建子导航</h4>
      </div>
      <div class="modal-body">
        <form id="navOp">
          <input type="hidden" class="form-control" name="treeId" id="treeId" >
          <div class="form-group">
            <label>导航名<span class="text-red">*</span></label>
            <input type="text" class="form-control" name="name" id="name" placeholder="导航显示名">
          </div>

          <div class="form-group">
            <label>连接地址</label>
            <input type="text" class="form-control" name="link" id="link" placeholder="访问连接">
          </div>

          <div class="form-group">
            <label>ICON样式</label>
            <input type="text" class="form-control" name="icon" id="icon" placeholder="icon class">
          </div>

          <div class="form-group">
            <label>排序</label>
            <input type="text" class="form-control" name="sort" id="sort" placeholder="请输入整数">
          </div>

          <!-- checkbox -->
          <div class="form-group">
            <label>
              <input type="checkbox" name="display" id="display" class="flat-red" checked>
            </label>
            <label>
              导航是否可用（不勾选为禁用）
            </label>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="navOpSubmit" type="button" class="btn btn-primary">submit</button>
      </div>
    </div>
  </div>
</div>

<!-- Page script -->
<script>
 $(function () {
     //Flat red color scheme for iCheck
     $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
       checkboxClass: 'icheckbox_flat-green',
     });
     $("#mainNavAdd input[name='display']").on('ifChecked ifUnchecked', function(event) {
       event.type == 'ifChecked' ? $(this).attr('checked',true) : $(this).attr('checked',false);
     });
     $("#permitOpModal input[name='display']").on('ifChecked ifUnchecked', function(event) {
       event.type == 'ifChecked' ? $(this).attr('checked',true) : $(this).attr('checked',false);
     });

		$("#roleTree").jstree({
      "core" : {
         "check_callback" : true,
         "multiple" : true,
      },

      "types" : {
         "default" : {
           "icon" : false
         },
       },

      "contextmenu":{
         "select_node":false,
         "items":customMenu,
       },

			"plugins" : [ "types","contextmenu"]
		});

    function customMenu(node) {
       var items = {
         "create":null,
         "rename":null,
         "remove":null,
         "ccp":null,
         "addMenu":{
             "separator_before": false,
             "separator_after": false,
             "icon":"glyphicon glyphicon-leaf text-aqua",
             "label":"<span data-toggle=\"modal\" data-target=\"#permitOpModal\" data-op=\"add\">添加导航</span>",
             "action":function(data){
                 var inst = jQuery.jstree.reference(data.reference),
                 obj = inst.get_node(data.reference);
                 $('#permitOpModal').attr('treeData',$('#'+obj.id).attr("data"))
             }
         },
         "delMenu":{
             "separator_before": false,
             "separator_after": false,
             "icon":"glyphicon glyphicon-trash  text-red",
             "label":"<span data-toggle=\"modal\" data-target=\"#permitOpModal\" data-op=\"del\">删除导航</span>",
             "action":function(data){
                 var inst = jQuery.jstree.reference(data.reference),
                 obj = inst.get_node(data.reference);
                 $('#permitOpModal').attr('treeData',$('#'+obj.id).attr("data"))
             }
         },
         "editMenu":{
             "separator_before": false,
             "separator_after": false,
             "icon":"glyphicon glyphicon-edit text-yellow",
             "label":"<span data-toggle=\"modal\" data-target=\"#permitOpModal\" data-op=\"edit\">编辑导航</span>",
             "action":function(data){
                 var inst = jQuery.jstree.reference(data.reference),
                 obj = inst.get_node(data.reference);
                 $('#permitOpModal').attr('treeData',$('#'+obj.id).attr("data"))
             }
         }
       };

       var nodeData = jQuery.parseJSON($('#'+node.id).attr('data'));
       console.log(nodeData);
       //二级导航不可创建子导航
       if (nodeData.pid > 0) {
          delete items.addMenu;
       }
       //系统导航不可删除
       if (nodeData.sys == 1) {
          delete items.delMenu;
       }

       return items;
    }

    //右键菜单操作弹窗
    $('#permitOpModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var op = button.data('op')
        var modal = $(this)
        var treeData = jQuery.parseJSON($(modal[0]).attr('treeData'));

        modal.removeClass('modal-warning').addClass('fade');
        modal.find('.modal-body form').show();
        modal.find('.modal-body p').remove();

        if(op == 'add'){
          modal.find('.modal-body input').val('');
          modal.find('.modal-title').html('<i class="'+treeData.icon+'"></i>'+treeData.name+' [添加子导航]');
          //console.log(modal.find('.modal-body #name')[0]);
        }else if(op == 'edit'){
          modal.find('.modal-title').html('<i class="'+treeData.icon+'"></i>'+treeData.name+' [编辑导航]');
          modal.find('.modal-body #name').val(treeData.name);
          modal.find('.modal-body #link').val(treeData.link);
          modal.find('.modal-body #icon').val(treeData.icon);
          modal.find('.modal-body #sort').val(treeData.sort);
          treeData.display == 1 ? modal.find('.modal-body #display').iCheck('check') : modal.find('.modal-body #display').iCheck('uncheck');;
        }else if(op == 'del'){
          modal.removeClass('fade').addClass('modal-warning');
          modal.find('.modal-title').html('<i class="'+treeData.icon+'"></i>'+treeData.name+' [删除导航]');
          modal.find('.modal-body form').hide();
          modal.find('.modal-body').append("<p>你确定要删除 ["+treeData.name+"] 项吗? 请注意此操作会删除本导航及其子导航</p>")
        }
        modal.find('.modal-body #treeId').val(treeData.id);
        modal.find('.modal-body form').attr('op',op);
    });

    //右键弹窗提交
    $("#navOpSubmit").on("click",function(evt){
      var op = $("#navOp").attr('op');
      var treeId = $("#navOp input[name='treeId']").val();
      if(op == 'edit'){
        var url = '<?php echo DyRequest::createUrl("/admin/nav/edit");?>';
        var postData = {id:treeId, name:$("#navOp input[name='name']").val(), link:$("#navOp input[name='link']").val(),sort:$("#navOp input[name='sort']").val(),icon:$("#navOp input[name='icon']").val(),display:$("#navOp input[name='display']").is(':checked') };
      }else if(op == 'add'){
        var url = '<?php echo DyRequest::createUrl("/admin/nav/add");?>';
        var postData = {pid:treeId, name:$("#navOp input[name='name']").val(), link:$("#navOp input[name='link']").val(),sort:$("#navOp input[name='sort']").val(),icon:$("#navOp input[name='icon']").val(),display:$("#navOp input[name='display']").is(':checked') };
      }else if(op == 'del'){
        var url = '<?php echo DyRequest::createUrl("/admin/nav/del");?>';
        var postData = {id:treeId};
      }
      $.post(url, postData,
         function(data){
             var mtype = data.status == 0 ? 'success' : 'warning';
             $.bootstrapGrowl(data.message,{ele:'body',type:mtype,offset: {from:'top',amount:100},align:'center',width:350,delay:4000,allow_dismiss:true,stackup_spacing:10});
             if(data.status == 0){
                setTimeout("window.location.reload();",1000);
             }
         },
         'json'
      );
    });

    //排序编辑
    $("input[class='treeSort']").on("click",function(evt){
        evt.stopPropagation();
        evt.preventDefault();
        $(evt.target).focus().one('blur',function(){
             if($(evt.target).attr('osort') != $(evt.target).val()){
               $.post("<?php echo DyRequest::createUrl('/admin/nav/upsort');?>", { id: $(evt.target).attr('treeid'), sort: $(evt.target).val() },
                   function(data){
                       var mtype = data.status == 0 ? 'success' : 'warning';
                       var msg = data.status == 0 ? '已修改成功' : '修改失败！';
                       msg = data.code == 403 ? data.message : msg;
                       $.bootstrapGrowl(msg,{ele:'body',type:mtype,offset: {from:'top',amount:100},align:'center',width:350,delay:4000,allow_dismiss:true,stackup_spacing:10});
                   },
                   'json'
               );
           }
        });
    });

    //创建主导航提交
    $("#mainNavAddSubmit").on("click",function(evt){
      $.post("<?php echo DyRequest::createUrl('/admin/nav/add');?>", {name:$("#mainNavAdd input[name='name']").val(), link:$("#mainNavAdd input[name='link']").val(),sort:$("#mainNavAdd input[name='sort']").val(),icon:$("#mainNavAdd input[name='icon']").val(),display:$("#mainNavAdd input[name='display']").is(':checked') },
         function(data){
             var mtype = data.status == 0 ? 'success' : 'warning';
             var msg = data.status == 0 ? '创建成功' : '创建失败！';
             msg = data.code == 403 ? data.message : msg;
             $.bootstrapGrowl(msg,{ele:'body',type:mtype,offset: {from:'top',amount:100},align:'center',width:350,delay:4000,allow_dismiss:true,stackup_spacing:10});
             if(data.status == 0){
                setTimeout("window.location.reload();",1000);
             }
         },
         'json'
      );
    });
 });
</script>
