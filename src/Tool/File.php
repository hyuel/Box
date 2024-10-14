<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/21 0021
 * Time: 22:50
 */

namespace Tool;


class File
{
    private $name = '';//文件名
    private $type = '';//文件类型
    private $size = '';//文件大小 kB
    private $filePath = '';//文件临时存储的位置
    private $file = null;

    protected $maxSize = 204800;

    // 允许上传的图片后缀
    private $allowedExts = array("gif", "jpeg", "jpg", "png");

    public function __construct($file){
        $temp = explode(".", $this->name);
        $extension = end($temp);
        if ((($file["type"] == "image/gif")
                || ($file["type"] == "image/jpeg")
                || ($file["type"] == "image/jpg")
                || ($file["type"] == "image/pjpeg")
                || ($file["type"] == "image/x-png")
                || ($file["type"] == "image/png"))
            && ($_FILES["file"]["size"] < $this->maxSize)    // 小于 200 kb
            && in_array($extension, $this->allowedExts))
        {
            if ($_FILES["file"]["error"] > 0)
            {
                echo "错误：: " . $_FILES["file"]["error"] . "<br>";
            }
            else
            {
                $this->name = $file["name"];
                $this->type = $file["type"];
                $this->size = $file["size"] / 1024;
                $this->filePath = $file["tmp_name"];
            }
            $this->file = $file;
        }
        else
        {
            return ['msg'=> "非法的文件格式"];
        }
    }
    public function getFileInfo(){
        $file["name"] = $this->name;
        $file["type"] = $this->type;
        $file["size"] = $this->size;
        $file["tmp_name"] = $this->filePath;
    }
    public function getFile(){
        return $this->file;
    }

}