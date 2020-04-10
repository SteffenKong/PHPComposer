<?php
//函数库

function show() {
    print('================================================' . PHP_EOL);
    print('|| 请输入操作' . PHP_EOL);
    print('|| 1 - 切换国内镜' . PHP_EOL);
    print('|| 2 - 切换国外镜像' . PHP_EOL);
    print('|| 3 - 查看国内镜像列表' . PHP_EOL);
    print('|| 4 - 切换国外镜像列表' . PHP_EOL);
    print('|| 5 - 查看当前镜像' . PHP_EOL);
    print('|| 6 - 还原镜像' . PHP_EOL);
    print('|| 7 - 查看提示' . PHP_EOL);
    print('|| 8 - 清屏' . PHP_EOL);
    print('|| 9 - 安装多线程采集器' . PHP_EOL);
    print('|| 10 - 退出' . PHP_EOL);
    print('================================================' . PHP_EOL);
}

/**
 * @param $message
 */
function printMsg($message) {
    print($message.PHP_EOL);
}


/**
 * @param array $data
 * 循环输出
 */
function printArray(array $data) {
    printMsg('================================================');
    foreach ($data ?? [] as $key => $image) {
        printMsg("|| (".($key+1).") ======> $image");
    }
    printMsg('================================================');
}


/**
 * @param string $title
 * @return string
 * 删除处理
 */
function input($title = '请输入: ') {
    fwrite(STDOUT, $title);
    return trim(fgets(STDIN));
}