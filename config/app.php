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
     * 环境名称
     */
    'env' => env('APP_ENV', 'production'),

    /**
     * 根目录
     */
    'base_path'=>dirname(__DIR__),

    /**
     * 日记配置
     * 记录最小log级别
     */
    'log_level' => env('APP_LOG_LEVEL', 'debug'),
    /**
     * 历史log存储日期
     */
    'log_max_files' => 30,

    /**
     * 时区设置
     */
    'timezone' => env('TIMEZONE','Asia/Shanghai'),

    /**
     * 默认模块
     */
    'default_module'=>'wechat',
    /**
     * 模块配置
     */
    'modules' => [
        "wechat" => [
            // 命名空间格式名称
            "nameSpace" => 'Index',
            // 绑定的域名
            "domain" => "www.ppe.app",
            // 核心类型
            'core' => 'full',
        ],
    ],
];