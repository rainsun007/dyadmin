<?php

/**
 * 简易兼容输出(simple echo)
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

/**
 * 获取耗时
 * 
 * @param int 结束时间
 * @param int 开始时间
 * 
 * @param string 
 */
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