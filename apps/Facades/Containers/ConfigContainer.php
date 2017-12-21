<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/15
 * Time: 17:02
 */

namespace Apps\Facades\Containers;


use Framework\App;
use Framework\Support\Containers\Container;
use Framework\Support\Containers\FacadeInterface;
use Phalcon\Config;
use Phalcon\Di;

class ConfigContainer implements FacadeInterface
{
    use Container;

    /**
     * @var \Phalcon\Config
     */
    private static $_instance;

    /**
     * 映射实体类
     *
     * @return string|object
     */
    public static function getFacadesAccessor()
    {
        return Di::getDefault()->getShared('config');
    }

    /**
     * 读取配置-自动加载配置文件
     *
     * @param string $key
     * @param string $default
     * @return mixed|null|Config
     */
    public static function get($key=null,$default=null)
    {
        if( $key===null ){
            return self::$_instance;
        }elseif ( !strpos($key,'.') ){
            $value = self::$_instance->get($key);
            if( $value===null ){
                $value = self::getFileConfig($key);
                if( $value===false ){
                    return $default;
                }
                return $value;
            }else{
                return $value;
            }
        }
        $arrConfigKey = explode('.',$key);
        $config       = self::$_instance;
        $value        = $config->get($arrConfigKey[0]);
        foreach ($arrConfigKey as $num=>$keyNext){
            if( $value===null ){
                if( $num==0 ){
                    $value = self::getFileConfig($keyNext);
                }else{
                    return $default;
                }
            }elseif( $value instanceof Config){
                $config = $value;
                $value = $config->get($keyNext);
            }elseif( $num==0 ){
                $value = self::getFileConfig($keyNext);
                if( $value===null ) {
                    return $default;
                }
            }
        }
        return $value;
    }

    private static function getFileConfig($fileName)
    {
        $value = false;
        $configFile = Di::getDefault()->getShared("module")->modulePath . "/Config/{$fileName}.php";
        if( file_exists($configFile) ){
            $addConfig = @include_once $configFile;
            if( is_array($addConfig) ){
                self::$_instance->merge(new Config([$fileName=>$addConfig]));
                $value = self::$_instance->get($fileName);
            }
        }else{
            $configFile = App::getRootPath() . "/config/{$fileName}.php";
            if( file_exists($configFile) ){
                $addConfig = @include_once $configFile;
                if( is_array($addConfig) ){
                    self::$_instance->merge(new Config([$fileName=>$addConfig]));
                    $value = self::$_instance->get($fileName);
                }
            }
        }
        return $value;
    }
}