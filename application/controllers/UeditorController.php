<?php

/**
 * home controller
 * 框架规则-默认错误 信息 登陆处理对应此controller 如不使用默认需要在配制中定义.
 *
 * @author 大宇 Email:dyphp.com@gmail.com
 *
 * @link http://www.dyphp.com/
 *
 * @copyright Copyright 2011 dyphp.com
 */
class UeditorController extends BaseController
{
    protected $allNeedLogin = true;

    public function actionIndex()
    {
        $action = DyRequest::getStr('action');
        switch ($action) {
            /* 获取上传配制 */
            case 'config':
                $result =  json_encode($this->getConfig());
                break;
            /* 上传图片 */
            case 'uploadimage':
                $result = json_encode($this->uploadImage());
                break;
            /* 上传视频 */
            //case 'uploadvideo':
            //$result = json_encode($this->uploadVideo());
            //break;
            /* 上传文件 */
            //case 'uploadfile':
            //$result = json_encode($this->uploadFile());
            //break;
            default:
                $result = json_encode(array('state'=> '请求地址出错'));
                break;
        }
        
        /* 输出结果 */
        if (DyRequest::getStr('callback')) {
            echo preg_match("/^[\w_]+$/", DyRequest::getStr('callback')) ? htmlspecialchars(DyRequest::getStr('callback')).'('.$result.')' : json_encode(array('state'=>'callback参数不合法'));
        } else {
            echo $result;
        }
    }

    /**
     * 获取上传配制
     *
     * @return array
     */
    private function getConfig()
    {
        return json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents(APP_PATH."/config/Ueditor_config.json")), true);
    }

    /**
     * 图片上传
     *
     * @return array
     */
    private function uploadImage()
    {
        $config = $this->getConfig();
        $path = $config['imagePathFormat'].'/'.join('/', explode('-', date("Y-m-d")));
        $savePath = APP_PARENT_PATH.$path;
        $fileName = date("YmdHis").mt_rand(1000, 9999);
        $maxSize = $config['imageMaxSize'] / 1024 / 1024;
        $imageAllowFiles = trim(str_replace('.', '|', join('', $config['imageAllowFiles'])), '|');

        $upPic = DyGDImg::upload($config['imageFieldName'], $savePath, $fileName, $maxSize, $imageAllowFiles);
        if ($upPic == 0) {
            $info = DyGDImg::resize($savePath.'/'.DyGDImg::getFileSaveName(), '', '', 640, 1000);

            return array(
                "title"=>'pic',
                "original"=>$fileName,
                "state"=>"SUCCESS",
                'url'=>$path.'/'.$info['name'],
            );
        } else {
            return array("state"=>'error code:'.$upPic,);
        }
    }

    /**
     * 附件上传
     *
     * @return array
     */
    private function uploadFile()
    {
        $dyUpload = new DyUpload;
        //$smallPicUp = $dyUpload->setAllowExt(array('rar','zip','tar','gz'))->up(PIC_DIR_QUALITY,$this->createUpFileName('small_'.$uid),'upfile');
        //$smallPic = $dyUpload->getFileSaveName();
    }

    /**
     * 视频上传
     *
     * @return array
     */
    private function uploadVideo()
    {
        $dyUpload = new DyUpload;
        //$smallPicUp = $dyUpload->setAllowExt(array('rar','zip','tar','gz'))->up(PIC_DIR_QUALITY,$this->createUpFileName('small_'.$uid),'upfile');
        //$smallPic = $dyUpload->getFileSaveName();
    }
}
