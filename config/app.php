<?php

/**
 * 基础配置
 */
return [
    /**
     * 项目名称
     */
    'app_name'=>env('APP_NAME','PPE'),
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
     * 默认模块
     */
    'default_module'=>'index',
    /**
     * 模块配置
     */
    'modules' => [
        "index" => [
            // 命名空间格式名称
            "nameSpace" => 'Index',
            // 绑定的域名
            "domain" => "www.ppe.app",
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