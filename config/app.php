<?php

/**
 * 基础配置
 */
return [
    /**
     * 调试模块
     */
    'debug' => env('APP_DEBUG', true),
    /**
     * 根目录
     */
    'basePath'=>dirname(__DIR__),
    /**
     * 时间戳
     */
    'timezone' => env('TIMEZONE','Asia/Shanghai'),
    /**
     * 模块配置
     */
    'modules' => [
        "frontend" => [
            // 命名空间格式
            "nameSpace" => 'Frontend',
            // 绑定的域名
            "domain" => "../apps/modules/frontend/Module.php",
            // 核心类型
            'core' => 'full',
        ],
    ],
    /**
     * 门脸
     */
    'aliases' => [

    ],
];