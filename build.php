<?php
/**
 * build 打包php
 * 打包的过程就是将src下的项目源码 构建到 build目录下的
 */

$srcPath = __DIR__.'/src';
$buildPath = __DIR__.'/build';

//打包
$phar = new Phar($buildPath.'/PHPComposer.phar', FilesystemIterator::CURRENT_AS_FILEINFO,'PHPComposer.phar');
$phar['PHPComposer.php'] = file_get_contents($srcPath.'/PHPComposer.php');

//生成入口文件
$phar->setStub($phar->createDefaultStub("PHPComposer.php"));

if (!is_dir($buildPath.'/lib')) {
    mkdir($buildPath.'/lib');
}

//迁移代码文件到build目录下
copy($srcPath . "/lib/function.php", $buildPath . "/lib/function.php");
copy($srcPath . "/lib/PHPComposer.php", $buildPath . "/lib/PHPComposer.php");