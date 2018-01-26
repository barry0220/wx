<?php
return array(
    //'配置项'=>'配置值'
    'URL_MODEL' =>  2, // URL访问模式,可选参数0、1、2、3,代表以下四种模式;
    'URL_HTML_SUFFIX'       => 'html',  // URL伪静态后缀设置
    'MODULE_ALLOW_LIST' => array('Home','Admin'),
    'TMPL_EXCEPTION_FILE' => './Application/Home/View/Common/err.html',
    'DB_TYPE'   =>  'mysql',            // 数据库类型
    'DB_HOST'   =>  '127.0.0.1',        // 服务器地址
    'DB_NAME'   =>  'db_gym_database',             // 数据库名
    'DB_USER'   =>  'root',             // 用户名
    'DB_PWD'    =>  '',   // 密码
    'DB_PORT'   =>  '3306',             // 端口
    'SESSION_AUTO_START' =>  true,// 是否自动开启Session
    'TMPL_ACTION_ERROR'     =>  MODULE_PATH.'View/Public/error.html', // 默认错误跳转对应的模板文件
);