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
