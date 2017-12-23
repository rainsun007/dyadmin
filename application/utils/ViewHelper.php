<?php
/**
 * 助手类.
 *
 * @author 大宇 Email:dyphp.com@gmail.com
 *
 * @link http://www.dyphp.com/
 *
 * @copyright Copyright 2011 dyphp.com
 **/
class ViewHelper
{
    //静态文件路径
    private static $staticServerPath = '';

    /**
     * 分类图片.
     **/
    public static function getCatePic()
    {
    }

    /**
     * 用户头像.
     **/
    public static function getface()
    {
    }

    /**
     * 获取静态文件地址
     *
     * @param string 静态文件
     *
     * @return string
     **/
    public static function getStaticPath($path = '')
    {
        $path = ltrim($path, '/');
        if (self::$staticServerPath) {
            return self::$staticServerPath.$path;
        }
        $appHttpPath = DyCfg::item('appHttpPath') != '' ? DyCfg::item('appHttpPath').'/' : '';
        self::$staticServerPath = rtrim(STATIC_SERVER, '/').'/'.$appHttpPath.'static/';

        return self::$staticServerPath.$path;
    }

    /**
     * @brief    加载css
     *
     * @param   $css
     *
     * @return
     **/
    public static function regCss($css)
    {
        //$mtime = mt_rand(10000, 99999);
        //$css = preg_replace('{\\.([^./]+)$}', "-$mtime.\$1", $css);
        DyStatic::regCss(self::getStaticPath($css));
    }

    /**
     * @brief   移除css
     *
     * @param   $css
     *
     * @return
     **/
    public static function unregCss($css)
    {
        //$mtime = mt_rand(10000, 99999);
        //$css = preg_replace('{\\.([^./]+)$}', "-$mtime.\$1", $css);
        DyStatic::unregCss(self::getStaticPath($css));
    }

    /**
     * @brief    加载js
     *
     * @param   $script
     * @param   $position
     *
     * @return
     **/
    public static function regJs($script, $position = 'head')
    {
        //$mtime = mt_rand(10000, 99999);
        //$script = preg_replace('{\\.([^./]+)$}', "-$mtime.\$1", $script);
        DyStatic::regScript(self::getStaticPath($script), $position);
    }

    /**
     * @brief    移除js
     *
     * @param   $script
     * @param   $position
     *
     * @return
     **/
    public static function unregJs($script, $position = 'head')
    {
        //$mtime = mt_rand(10000, 99999);
        //$script = preg_replace('{\\.([^./]+)$}', "-$mtime.\$1", $script);
        DyStatic::unregScript(self::getStaticPath($script), $position);
    }

    /**
     * @brief    获取平台类型
     *
     * @param   $type
     *
     * @return
     **/
    public static function getPfType($type, $key)
    {
        $pfTypeArr = array(
            '0' => array(
                'title' => '新浪微博',
                'url' => DyRequest::createUrl('/weibo/auth'),
            ),
        );

        return isset($pfTypeArr[$type][$key]) ? $pfTypeArr[$type][$key] : 'unknown';
    }

    /**
     * @brief   jstree html结构
     *
     * @param   $navTree           树型数组
     * @param   $permissions       用户或角色权限 用于处理checkbox的默认选中状态(用于权限角色编辑)
     * @param   $treeSortInputShow 排序input是否显示控制（用于导航列表）
     * @param   $navForbidClass    导航禁用样式（用于权限列表）
     * @param   $displayNavForbid  是否对已禁用导航加 $navForbidClass的样式（用于导航列表）
     *
     * @return
     **/
    public static function jsTree($navTree = array(), $permissions = array(), $treeSortInputShow = false, $navForbidClass = '', $displayNavForbid = false)
    {
        $jsTree = '<div id="roleTree">';
        $jsTree .= '<ul>';

        foreach ($navTree as $key => $val) {
            $selected = $permissions && in_array($val['id'], $permissions) ? '"selected" : true,' : '';
            $treeSortInput = $treeSortInputShow ? '<input class="treeSort" treeId="'.$val['id'].'" value="'.$val['sort'].'" osort="'.$val['sort'].'" type="text" style="width:25px;height:20px;margin-right:3px" />' : '';
            $forbidClass = ($displayNavForbid && $val['type'] == 0 && $val['display'] == 0) || (!$displayNavForbid && $val['type'] == 0) ? ' '.$navForbidClass : '';
            $valNoChild = $val;
            if (isset($valNoChild['child'])) {
                unset($valNoChild['child']);
            }
            $jsTree .= '<li data=\''.json_encode($valNoChild).'\' data-jstree=\'{'.$selected.'"opened":true}\'>'.$treeSortInput.'<span class="'.$val['icon'].$forbidClass.'"> '.$val['name'].'</span>';
            $jsTree .= self::jsTreeChild($val, $permissions, $treeSortInputShow, $navForbidClass, $displayNavForbid);
            $jsTree .= '</li>';
        }

        $jsTree .= '</ul>';
        $jsTree .= '</div>';

        return $jsTree;
    }

    /**
     * @brief   jsTree子方法
     */
    private static function jsTreeChild($child = '', $permissions = array(), $treeSortInputShow = false, $navForbidClass = '', $displayNavForbid = false)
    {
        $jsTree = '';
        if (isset($child['child'])) {
            $jsTree .= '<ul>';
            foreach ($child['child'] as $key => $val) {
                $selected = $permissions && in_array($val['id'], $permissions) ? '"selected" : true,' : '';
                $treeSortInput = $treeSortInputShow ? '<input class="treeSort" treeId="'.$val['id'].'" value="'.$val['sort'].'" osort="'.$val['sort'].'" type="text" style="width:25px;height:20px;margin-right:3px" />' : '';
                $forbidClass = ($displayNavForbid && $val['type'] == 0 && $val['display'] == 0) || (!$displayNavForbid && $val['type'] == 0) ? ' '.$navForbidClass : '';
                $valNoChild = $val;
                if (isset($valNoChild['child'])) {
                    unset($valNoChild['child']);
                }
                $jsTree .= '<li data=\''.json_encode($valNoChild).'\' data-jstree=\'{'.$selected.'"opened":true}\'>'.$treeSortInput.'<span class="'.$val['icon'].$forbidClass.'"> '.$val['name'].'</span>';
                if (isset($val['child'])) {
                    $jsTree .= self::jsTreeChild($val, $permissions, $treeSortInputShow, $navForbidClass, $displayNavForbid);
                }
                $jsTree .= '</li>';
            }
            $jsTree .= '</ul>';
        }
        return $jsTree;
    }

    /**
     * @brief    加载kindeditor
     *
     * @param   $container
     *
     * @return
     **/
    public static function loadKindEditor($textareaName = 'content', $themeType = 'default')
    {
        self::regJs('kindeditor/kindeditor-min.js');
        self::regJs('kindeditor/lang/zh_CN.js');
        if ($themeType == 'default' || $themeType == 'simple') {
            echo '<script type="text/javascript">
                var editor;
                KindEditor.ready(function(K) {
                        editor = K.create(\'textarea[name="'.$textareaName.'"]\', {
                        allowFileManager : false,
                        themeType : \''.$themeType.'\',
                        items:["source","|","undo","redo","|","preview","print","template","code","cut","copy","paste","plainpaste","wordpaste","|","justifyleft","justifycenter","justifyright","justifyfull","insertorderedlist","insertunorderedlist","indent","outdent","subscript","superscript","clearhtml","|","fullscreen","/","formatblock",
                                "fontname","fontsize","|","forecolor","hilitecolor","bold","italic","underline","strikethrough","lineheight","removeformat","|","image","multiimage","flash","media","insertfile","table","hr","emoticons","baidumap","pagebreak","anchor","link","unlink"]
                    });
                });
            </script>';
        } elseif ($themeType == 'qq') {
            echo '<script type="text/javascript">
            var editor;
            KindEditor.ready(function(K) {
                    K.each({
                        \'plug-align\' : {
                            name : \'对齐方式\',
                            method : {
                                \'justifyleft\' : \'左对齐\',
                                \'justifycenter\' : \'居中对齐\',
                                \'justifyright\' : \'右对齐\'
                            }
                        },
                        \'plug-order\' : {
                            name : \'编号\',
                            method : {
                                \'insertorderedlist\' : \'数字编号\',
                                \'insertunorderedlist\' : \'项目编号\'
                            }
                        },
                        \'plug-indent\' : {
                            name : \'缩进\',
                            method : {
                                \'indent\' : \'向右缩进\',
                                \'outdent\' : \'向左缩进\'
                            }
                        }
                    },function( pluginName, pluginData ){
                        var lang = {};
                        lang[pluginName] = pluginData.name;
                        KindEditor.lang( lang );
                        KindEditor.plugin( pluginName, function(K) {
                            var self = this;
                            self.clickToolbar( pluginName, function() {
                                var menu = self.createMenu({
                                        name : pluginName,
                                        width : pluginData.width || 100
                                    });
                                K.each( pluginData.method, function( i, v ){
                                    menu.addItem({
                                        title : v,
                                        checked : false,
                                        iconClass : pluginName+\'-\'+i,
                                        click : function() {
                                            self.exec(i).hideMenu();
                                        }
                                    });
                                })
                            });
                        });
                    });
                    editor = K.create(\'textarea[name="'.$textareaName.'"]\', {
                        themeType : \'qq\',
                        items : [
                            \'bold\',\'italic\',\'underline\',\'fontname\',\'fontsize\',\'forecolor\',\'hilitecolor\',\'plug-align\',\'plug-order\',\'plug-indent\',\'link\'
                        ]
                    });
                });
            </script>';
        }
    }

    /**
     * @brief    获取用户头像
     *
     * @param int      $userId 用户id
     * @param string   $avatar 用户头像
     *
     * @return  string 
     **/
    public static function getUserAvatar($userId = 0,$avatar = '')
    {
        if (!$avatar) {
            $ex = array('.jpg','.png');
            return '/static/AdminLTE/dist/img/avatar'.rand(1, 5).$ex[array_rand($ex)];
        }else{
            return $avatar;
        }
    }

    /**
     * 设置面包屑导航信息
     *
     * @param string $breadcrumbMain    面包屑主导航名
     * @param string $breadcrumbActive  面包屑当前活动导航名
     * @param string $navLinkActive     活动菜单导航
     * @return void
     */
    public static function setBreadcrumb($breadcrumbMain = '' , $breadcrumbActive = '', $navLinkActive = ''){
        Dy::app()->runingController->view->setData('breadcrumbMain', $breadcrumbMain);
        Dy::app()->runingController->view->setData('breadcrumbActive', $breadcrumbActive);
        Dy::app()->runingController->view->setData('navLinkActive', $navLinkActive);
    }
}
