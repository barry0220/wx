<?php
/**
 * Created by PhpStorm.
 * User: HANCY
 * Date: 2017/12/28
 * Time: 11:56
 */

function dd($info){
    echo "<pre>";
    print_r($info);
    die;
}

function ddd($info){
    echo "<pre>";
    print_r($info);
}

function consize($filename){
//    $filename = iconv("utf-8","gb2312",$filename);
//    dd($filename);
    $size = filesize($filename);
    if($size < 1024){
        return $size.'Bytes';
    }else if($size >= 1024 && $size < pow(1024,2)){
        return round($size/1024,2).'KB';
    }else if($size >= pow(1024,2) && $size < pow(1024,3)){
        return round($size/pow(1024,2),2).'MB';
    }else if($size >= pow(1024,3) && $size < pow(1024,4)){
        return round($size/pow(1024,3),2).'GB';
    }
}