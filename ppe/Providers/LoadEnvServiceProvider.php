<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/10/20
 * Time: 13:41
 */

namespace Framework\Providers;


use Dotenv\Dotenv;

class LoadEnvServiceProvider extends ServiceProvider
{

    /**
     * Register application service.
     *
     * @return mixed
     */
    public function register()
    {
        $applicationPath = $this->di->getShared('bootstrap')->applicationPath;

        if( file_exists($applicationPath.'/.env') ){
            $env = new Dotenv($applicationPath.'/');
            $env->load();
        }
    }
}