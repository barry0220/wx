<?php
return array(
    //'配置项'=>'配置值'
    'URL_MODEL' =>  2, // URL访问模式,可选参数0、1、2、3,代表以下四种模式;
    'URL_HTML_SUFFIX'       => 'html',  // URL伪静态后缀设置
    'MODULE_ALLOW_LIST' => array('Home','Admin'),
    'TMPL_EXCEPTION_FILE' => './Application/Home/View/Common/err.html',
);