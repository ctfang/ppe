一个基于phalcon的laravel框架，php7.0以上版本，composer安装

<p align="center">
<a href="https://packagist.org/packages/selden1992/ppe"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/selden1992/ppe"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About ppe

> **Note:** ,phalcon框架本身提供一系列的功能，但是需要整合在一起才能完成一个完整的项目目录，本项目的目的是把phalcon可以有laravel的舒适度、友好、简单、完备的各种好处，但又不失性能。

已经集成的功能

- [env](https://packagist.org/packages/selden1992/ppe) 使用不同环境启用对应的env配置
- [多模块](https://packagist.org/packages/selden1992/ppe) 根据域名或端口自动启动不同模块
- [命令行模块](https://laravel.com/docs/container) 定时任务下，使用phalcon的cli应用，普通命令基于symfony的console
- [异常](https://packagist.org/packages/selden1992/ppe) 使用whoops调试神器，代码调试非常方便，自带的异常发送邮件提示功能
- [Facades门脸](https://packagist.org/packages/selden1992/ppe) Db、Log等常用类都提供根命名的门脸,也允许业务自己注册自己的容器门脸
- [日志](https://packagist.org/packages/selden1992/ppe) 默认使用monolog，因为phalcon自带的log不好扩展，当然，也允许使用phalcon的log类，只要Di注入即可
- [事件](https://packagist.org/packages/selden1992/ppe) 事件和监听器配置，可以满足大多数需求变更

## 安装

如果安装不上，记得切换国内composer镜像
~~~~
composer create-project selden1992/ppe
~~~~

## 多模块

[config/app.php](CODE_OF_CONDUCT.md)配置多模块
~~~~
    'default_module'=>'index',
    'modules' => [
        "index" => [
            // 命名空间格式名称
            "nameSpace" => 'Index',
            "domain" => env('index_domain',"www.ppe.app"),
            'core' => 'full',
        ],
    ],
~~~~
可以配合.env配置，区分不同环境的模块配置


## Facades门脸

Facades的使用对开发非常有帮助，例如发送短信功能，本地调试使用写日志方式调试，正式环境就真实发送，只要业务层统一使用门脸调用，就可以无缝地切换

[apps/Facades/Kernel.php](CODE_OF_CONDUCT.md)注册业务门脸

所有门脸都是惰性加载


## Exceptions异常

处理框架自带的异常处理handler外，可以在[apps/Exceptions/Kernel.php](CODE_OF_CONDUCT.md)注册业务异常处理，例如错误发生邮件、发生日记管理系统

已有handler（错误日志记录，404页面处理,500页面处理）

## 如何对框架进行修改

本框架完全使用DI贯穿整个项目，为了就是可像usb那样，快速切换或者添加功能

修改[boostsrap/app.php](CODE_OF_CONDUCT.md)文件的initializeServices内容，就可以替换框架任意功能


## License

The ppe framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
