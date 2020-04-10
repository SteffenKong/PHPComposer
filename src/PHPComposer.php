#!/bin/php
<?php
require_once './lib/PHPComposer.php';
require_once './lib/function.php';

$beginFlag = true;
show();

while($beginFlag) {
    $input = input('请输入操作(查看提示按7): ');
    $composer = PHPComposer::getInstance();
    switch ($input) {
        case 1:
            printArray($composer->getListByInner());
            $imageId = input('请输入镜像id: ');
            try {
                if(!$composer->execComposerByInner($imageId - 1)) {
                    printMsg('切换失败!');
                    die();
                }
                printMsg('切换成功');
            }catch (Exception $exception) {
                printMsg('切换失败!');
                die();
            }
            break;
        case 2:
            printArray($composer->getListByOut());
            $imageId = input('请输入镜像id: ');
            try {
                if(!$composer->execComposerByOut($imageId - 1)) {
                    printMsg('切换失败!');
                    die();
                }
                printMsg('切换成功');
                break;
            }catch (Exception $exception) {
                printMsg('切换失败!');
                die();
            }
        case 3:
            printArray($composer->getListByInner());
            break;
        case 4:
            printArray($composer->getListByOut());
            break;
        case 5:
            $queryImage = $composer->queryImage();
            printMsg('当前镜像地址: ' . $queryImage);
            break;
        case 6:
            $composer->resetImage() ? printMsg('还原成功') : printMsg('还原失败!');
            break;
        case 7:
            show();
            break;
        case 8:
            system('clear');
            break;
        case 9:
            if(!$composer->installProcess()) {
                printMsg('安装失败');
                die();
            }
            printMsg('安装成功');
            break;
        case 10:
            printMsg('退出工具!');
            $beginFlag = false;
            break;
        default:
            printMsg('没有此选项!');
            break;
    }
}