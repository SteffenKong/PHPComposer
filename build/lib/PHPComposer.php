<?php

/**
 *  composer 镜像源管理工具
 *
 *  composer config -gl  查看全局配置
 * composer global require hirak/prestissimo    多线程安装
 */

/**
 * Class PHPComposer
 */
class PHPComposer {

    private function __clone() {}

    protected static $instance = null;

    protected $baseCommand;

    //国内
    protected $imageList = [
        'https://packagist.phpcomposer.com/',
        'https://mirrors.huaweicloud.com/repository/php/',
        'https://mirrors.cloud.tencent.com/composer/',
        'https://mirrors.aliyun.com/composer/',
        'https://packagist.phpcomposer.com/',
        'https://packagist.laravel-china.org/',
        'https://packagist.mirrors.sjtug.sjtu.edu.cn/'  //上海交通大学
    ];

    //国外
    protected $imageListOut = [
        'https://packagist.jp/',      //日本
        'https://packagist.org/'   //国外
    ];


    private function __construct() {
        $this->baseCommand = 'composer config -g repo.packagist composer ';
    }


    /**
     * @return PHPComposer|null
     * 单例
     */
    public static function getInstance() {
        return self::$instance ?? new self();
    }


    /**
     * @return array
     */
    public function getListByOut() {
        return $this->imageListOut;
    }


    /**
     * @return array
     */
    public function getListByInner() {
        return $this->imageList;
    }


    /**
     * @param $imageIndex
     * @return bool
     * @throws Exception
     * 切换国外镜像
     */
    public function execComposerByOut($imageIndex) {
        if (!isset($this->imageListOut[$imageIndex])) {
            throw new Exception('镜像不存在!');
        }
        $return = $this->execCommand($this->baseCommand.$this->imageListOut[$imageIndex]);
        if ($return[1] != 0) {
            return false;
        }
        return true;
    }


    /**
     * @param $imageIndex
     * @return bool
     * @throws Exception
     * 切换国内镜像
     */
    public function execComposerByInner($imageIndex) {
        if (!isset($this->imageList[$imageIndex])) {
            throw new Exception('镜像不存在!');
        }
        $return = $this->execCommand($this->baseCommand.$this->imageList[$imageIndex]);
        if ($return[1] != 0) {
            return false;
        }
        return true;
    }


    /**
     * @return bool
     * 还原到国外原始镜像
     */
    public function resetImage() {
        $return = $this->execCommand($this->baseCommand.$this->imageListOut[1]);
        if ($return[1] != 0) {
            return false;
        }
        return true;
    }


    /**
     * @param $command
     * @return array
     * 执行命令
     */
    public function execCommand($command) {
        exec($command,$output,$return);
        return [$output,$return];
    }


    public function queryImage() {
        $command = 'composer config -gl | grep repositories.packagist.org.url';
        $return = $this->execCommand($command);
        return substr($return[0][0],strlen('[repositories.packagist.org.url]'));
    }


    /**
     * @return bool
     */
    public function installProcess() {
        $command = 'composer global require hirak/prestissimo';
        list($output,$return) = $this->execCommand($command);
        if($return[1] != 0) {
            return false;
        }
        return true;
    }
}
