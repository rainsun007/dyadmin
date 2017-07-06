<?php
/**
 * @brief    首字母小写
 *
 * @param   $string
 *
 * @return
 **/
if (false === function_exists('lcfirst')) {
    function lcfirst($string)
    {
        $string = (string) $string;
        if (empty($string)) {
            return '';
        }
        $string{0} = strtolower($string{0});

        return $string;
    }
}

/**
 * @brief    简易过滤输出
 *
 * @param   $arg
 * @param   $key
 * @param   $isReturn
 *
 * @return
 **/
function se($arg, $key, $isReturn = false)
{
    $value = '';
    if (is_array($arg)) {
        $value = isset($arg[$key]) ? $arg[$key] : '';
    } elseif (is_object($arg)) {
        $value = isset($arg->$key) ? $arg->$key : '';
    }
    if ($isReturn) {
        return $value;
    } else {
        echo $value;
    }
}

/**
 * 获取工作流的当前节点
 * 写成函数为了方便全局使用
 *
 * @param array $flowArr 工作流信息
 * @return array
 */
function getNodeCurrent($flowArr){
    if(!isset($flowArr['nodes'])){
        return array();
    }
    $nodes = $flowArr['nodes'];
    foreach ($nodes as $key => $value) {
        if (isset($value['current']) && $value['current']) {
            if($key == 'end_node' || $key == 'start_node'){
                $value['userIds'] = array();
            }
            $value['id'] = $key;
            return $value;
        }
    }
    return array();
}
