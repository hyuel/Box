<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/21 0021
 * Time: 16:56
 */

namespace OSS;


require_once __DIR__."/aliyun-oss-php-sdk/autoload.php";

use OSS\OssClient;
use OSS\Core\OssException;

class AliyunOss
{
    /**
     * �ն˽ڵ�
     * @var string
     */
    private $endpoint = '';
    /**
     * �ʺ�ID
     * @var string
     */
    private $accessKeyId = '';
    /**
     * �ʺ���Կ
     * @var string
     */
    private $accessKeySecret = '';
    /**
     * Ͱ����
     * @var string
     */
    private $bucketName = '';
    /**
     * Ͱ����
     * @var string
     */
    private $bucketDomain = '';

    /**
     * @var \AliOss\ConfigOss
     */
    private $ossConfig = null;
    /**
     * @var \AliOss\OssClient
     */
    private $ossClient = null;

    public function __construct($config = array())
    {
        header("Content-Type:text/html;charset=utf-8");
        if (!empty($config)) {
            $this->setConfig($config);
        }
    }


    private function __clone(){
    }
    /**
     * @return string
     */
    public function getAccessKeyId() : string {
        return $this->accessKeyId;
    }

    /**
     * @param string $accessKeyId
     * @throws \Exception\AliOss\OssException
     */
    public function setAccessKeyId(string $accessKeyId){
        if(ctype_alnum($accessKeyId)){
            $this->accessKeyId = $accessKeyId;
        } else {
            throw new OssException('�ʺ�ID���Ϸ�', ErrorCode::ALIOSS_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getEndpoint() : string {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     * @throws \Exception\AliOss\OssException
     */
    public function setEndpoint(string $endpoint){
        if(preg_match('/^(http|https)\:\/\/\S+$/', $endpoint) > 0){
            $this->endpoint = $endpoint;
        } else {
            throw new OssException('�ն˽ڵ㲻�Ϸ�', ErrorCode::ALIOSS_PARAM_ERROR);
        }
    }

    public function setBucket($bucket){
        $this->bucket = $bucket;
    }

    /**
     * @return string
     */
    public function getAccessKeySecret() : string {
        return $this->accessKeySecret;
    }

    /**
     * @param string $accessKeySecret
     * @throws \Exception\AliOss\OssException
     */
    public function setAccessKeySecret(string $accessKeySecret){
        if(ctype_alnum($accessKeySecret)){
            $this->accessKeySecret = $accessKeySecret;
        } else {
            throw new OssException('�ʺ���Կ���Ϸ�', ErrorCode::ALIOSS_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getBucketName() : string {
        return $this->bucketName;
    }

    /**
     * @param string $bucketName
     * @throws \Exception\AliOss\OssException
     */
    public function setBucketName(string $bucketName){
        if (strlen($bucketName) > 0) {
            $this->bucketName = $bucketName;
        } else {
            throw new OssException('Ͱ���Ʋ��Ϸ�', ErrorCode::ALIOSS_PARAM_ERROR);
        }
    }

    public function setConfig($config){
        $this->accessKeyId = $config['accessKeyId'];
        $this->accessKeySecret = $config['accessKeySecret'];
        $this->endpoint = $config['endpoint'];
        $this->bucket = $config['bucket'];
    }
    /**
     * @return string
     */
    public function getBucketDomain() : string {
        return $this->bucketDomain;
    }

    /**
     * @param string $bucketDomain
     * @throws \Exception\AliOss\OssException
     */
    public function setBucketDomain(string $bucketDomain){
        if(preg_match('/^(http|https)\:\/\/\S+$/', $bucketDomain) > 0){
            $this->bucketDomain = $bucketDomain;
        } else {
            throw new OssException('Ͱ�������Ϸ�', ErrorCode::ALIOSS_PARAM_ERROR);
        }
    }



    /**
     * OSS�ϴ������ļ�����
     * @param string $savename �ϴ����ļ�����
     * @param string $filepath �����ļ�·��
     * @return null
     */
    function ossUpload($filepath, $savename)
    {
        echo __LINE__.'<br/>';
        if(empty($this->accessKeyId)){
            $details['code'] = '30001';
            $details['message'] = 'accessKeyIdΪ��';
            throw new OssException($details);
        }
        echo __LINE__.'<br/>';
        if(empty($this->accessKeySecret)){
            $details['code'] = '30001';
            $details['message'] = 'accessKeySecretΪ��';
            throw new OssException($details);
        }
        if(empty($this->endpoint)){
            $details['code'] = '30001';
            $details['message'] = 'endpointΪ��';
            throw new OssException($details);
        }
        if(empty($this->bucket)){
            $details['code'] = '30001';
            $details['message'] = 'bucketΪ��';
            throw new OssException($details);
        }

        $result = [];
        try {
            $ossClient = new OssClient($this->accessKeyId, $this->accessKeySecret, $this->endpoint);
            $upResult = $ossClient->uploadFile($this->bucket, $savename, $filePath);

            /*��Ϸ�������*/
            $arr = [
                'oss_url' => $upResult['info']['url'],  //�ϴ��ɹ��󷵻صĸ�ͼƬ��oss��ַ
                'relative_path' => $ossFileName     //���ݿⱣ������(���·��)
            ];
            $result['data'] = $arr;
            $result['code'] = 0;
        } catch (OssException $e) {
            $result['msg'] = $e->getMessage();
            $result['code'] = $e->getCode();

        } finally {
            unlink($filePath);
        }
        return $result;
    }
    /**
     * @return \AliOss\ConfigOss
     */
    public function getOssConfig() {
        return $this->ossConfig;
    }

    /**
     * @return \AliOss\OssClient
     */
    public function getOssClient() {
        return $this->ossClient;
    }

    public static function getInstance($data){
        $config[] ='';
        $config['accessKeyId'] = '';
        $config['accessKeySecret'] = '';
        $config['endpoint'] = '';
        $config['bucket']  = '';
        $config['bucketDomain']  = '';

        $ossConfig = new AliyunOss();
        $ossConfig->setAccessKeyId($config['accessKeyId']);
        $ossConfig->setAccessKeySecret($config['accessKeySecret']);
        $ossConfig->setEndpoint($config['endpoint']);
        $ossConfig->setBucketName($config['bucket']);
        $ossConfig->setBucketDomain($config['bucketDomain']);

        $initType = isset($data['type']) ? (int)$data['type'] : 1;
        $securityToken = isset($data['security']) ? (string)$data['security'] : '';
        $requestProxy = isset($data['proxy']) ? (string)$data['proxy'] : '';
        $networkTimeoutTransmission = isset($data['proxy']) ? (int)$data['proxy'] : 3600;
        $networkTimeoutConnect = isset($data['network']) ? (int)$data['network'] : 3;

        try {
            switch ($initType) {
                case 1:
                    $ossClient = new OssClient($ossConfig->getAccessKeyId(), $ossConfig->getAccessKeySecret(), $ossConfig->getEndpoint());
                    break;
                case 2:
                    $ossClient = new OssClient($ossConfig->getAccessKeyId(), $ossConfig->getAccessKeySecret(), $ossConfig->getEndpoint(), true);
                    break;
                case 3:
                    if(strlen($securityToken) == 0){
                        throw new OssException('�������Ʋ���Ϊ��', ErrorCode::ALIOSS_PARAM_ERROR);
                    }
                    $ossClient = new OssClient($ossConfig->getAccessKeyId(), $ossConfig->getAccessKeySecret(), $ossConfig->getEndpoint(), false, $securityToken);
                    break;
                case 4:
                    if(strlen($requestProxy) == 0){
                        throw new OssException('�����ַ����Ϊ��', ErrorCode::ALIOSS_PARAM_ERROR);
                    }
                    $ossClient = new OssClient($ossConfig->getAccessKeyId(), $ossConfig->getAccessKeySecret(), $ossConfig->getEndpoint(), false, null, $requestProxy);
                    break;
                default:
                    throw new OssException('��ʼ�����Ͳ�֧��', ErrorCode::ALIOSS_PARAM_ERROR);
            }

            $ossClient->setTimeout($networkTimeoutTransmission);
            $ossClient->setConnectTimeout($networkTimeoutConnect);
            $this->ossClient = $ossClient;
        } catch (\Exception $e) {
            $this->ossConfig = null;
            $this->ossClient = null;
            Log::error($e->getMessage(), $e->getCode(), $e->getTraceAsString());
            throw new OssException($e->getMessage(), ErrorCode::ALIOSS_CONNECT_ERROR);
        }
    }

    public function tset()
    {
        if (!empty($_FILES['oss_file']) && !empty($_POST['type'])) {
            $file_arr = getFiles();
            $AliyunOss = new AliyunOss();
            foreach($file_arr as $file) {
                $res = upload_File($file, $type_name . '/' . $user_info['contact'], $user_info);
                if (isset($res['fname']) && isset($res['dest']) && isset($res['file_name'])) {
                    $result = $AliyunOss->upload_file($res['dest'], $res['fname']);
                    if ($result) {
                        //1���������ݿ� �˴����ֱ����������벹ȫ ֪���߼�����
                        $insert_time = date('Y-m-d H:i:s', time());
                        $fileData = array(
                            'phone' => "'{$phone}'",
                            'company_name' => "'{$oss_db->escape($user_info['contact'])}'",
                            'insert_time' => "'{$insert_time}'",
                            'file_name' => "'{$res['file_name']}'",
                            'file_url' => "'{$result['oss_file']}'"
                        );
                        $sql = "insert into `oss_file` (" . implode(',', array_keys($fileData)) . ") values (" . implode(',', array_values($fileData)) . ")";
                        $oss_db->query($sql);
                        if ($oss_db->insert_id()) {
                            //2��ɾ����ʱ�ļ�
                            unlink($res['dest']);
                        }
                    }
                }
            }
            echo '�ϴ��ɹ�';
            header('Location:list.php');
            die;
        } else {
            echo '�ϴ�ʧ��';
        }
    }
}