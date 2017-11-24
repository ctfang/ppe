<?php
/**
 * Created by PhpStorm.
 * User: baichou
 * Date: 2017/10/23
 * Time: 17:52
 */

namespace Framework\Support\Cli;

/**
 * Class Input
 * @package Framework\Support\Cli
 */
class Input
{
    private static $param;
    private static $noKeyParam;

    /**
     * 获取参数
     *
     * @param $key
     * @param null $default
     * @return null
     */
    public static function get($key,$default=null)
    {
        if( isset(self::$param[$key]) ){
            return self::$param[$key];
        }
        return $default;
    }

    /**
     * 判断命令行是否输入某个值
     *
     * @param $key
     * @return bool
     */
    public static function has($key)
    {
        return in_array($key,self::$noKeyParam);
    }

    public function init(array $arr)
    {
        foreach ($arr as $strData){
            if( strpos($strData,'=') ){
                $arrTem = explode('=',$strData);
                self::$param[$arrTem[0]] = $arrTem[1];
            }else{
                self::$noKeyParam[] = $strData;
            }
        }
    }
}