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
 * @brief    简易输出(simple echo)
 *
 * @param   object|array  $arg
 * @param   string        $key
 * @param   bool          $isReturn
 *
 * @return  mixed
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
function getNodeCurrent($flowArr)
{
    if (!isset($flowArr['nodes'])) {
        return array();
    }
    $nodes = $flowArr['nodes'];
    foreach ($nodes as $key => $value) {
        if (isset($value['current']) && $value['current']) {
            if ($key == 'end_node' || $key == 'start_node') {
                $value['userIds'] = array();
            }
            $value['id'] = $key;
            return $value;
        }
    }
    return array();
}

function getConsume($end,$start){
    $diff = $end - $start;
    if($diff < 60){
        return $diff.'秒';
    }elseif($diff < 3600){
        return ceil($diff/60).'分';
    }elseif($diff < 86400){
        return ceil($diff/3600).'小时';
    }else{
        return ceil($diff/86400).'天';
    }
}