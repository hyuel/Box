<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/1/30 0030
 * Time: 18:45
 */

namespace Wx\Cash;


/**
 * 微信支付
 * Class WxCash
 * @package Wx\Cash
 */
class WxCash
{
    public $wxconfig = [];
    private $url = 'https://api.mch.weixin.qq.com';
    public function setWxConfig($wxconfig){
        $this->wxconfig = $wxconfig;
    }

    private $openid = '';
    /**
     * @param string $openid
     * @throws \Exception\Wx\WxException
     */
    public function setOpenid(string $openid) {
        if (preg_match('/^[0-9a-zA-Z\-\_]{28}$/', $openid) > 0) {
            $this->openid = $openid;
        } else {
            throw new WxException('用户openid不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public $partner_trade_no = '';
    /**
     * @param string $outTradeNo
     * @throws \Exception\Wx\WxException
     */
    public function setOutTradeNo(string $outTradeNo) {
        if(ctype_digit($outTradeNo) && (strlen($outTradeNo) <= 32)){
            $this->partner_trade_no = $outTradeNo;
        } else {
            throw new WxException('商户单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }


    /**
     * [sendMoney 企业付款到零钱]
     * @param  [type] $amount     [发送的金额（分）目前发送金额不能少于1元]
     * @param  [type] $re_openid  [发送人的 openid]
     * @param  string $desc       [企业付款描述信息 (必填)]
     * @param  string $re_user_name [收款用户姓名 (选填)]
     * @param  string $partner_trade_no [商户订单号 (选填)]
     * @return [type]             [description]
     */
    public function sendMoney($amount,$re_openid,$desc='描述信息',$re_user_name='',$partner_trade_no){
        if(empty($re_openid)){
            $res['code'] = 10000;
            $res['msg'] = '提现没有openid';
            return $res;
        }

        if(empty($partner_trade_no)){
            $partner_trade_no = date('YmdHis').rand(1000, 9999);
        }
        $app_id = isset($this ->wxconfig['appid']) ? $this ->wxconfig['appid'] : '' ;
        $app_id = empty($app_id) ? $this ->wxconfig['app_id'] : $app_id ;
        if(empty($app_id)){
            throw new \Exception('app_id为空','20003');
        }

        $mch_id = isset($this ->wxconfig['mch_id']) ? $this ->wxconfig['mch_id'] : '' ;
        $mch_id = empty($mch_id) ? $this ->wxconfig['pay_mchid'] : $mch_id ;
        if(empty($mch_id)){
            throw new \Exception('mch_id为空','20003');
        }
        $service_ip = isset($this ->wxconfig['service_ip']) ? $this ->wxconfig['service_ip'] : '' ;
        if(empty($service_ip)){
            throw new \Exception('service_ip为空','20003');
        }


        ///这个就是个API密码。MD5 32位。
        $mch_key = isset($this ->wxconfig['mch_key']) ? $this ->wxconfig['mch_key'] : '' ;
        $mch_key = empty($mch_key) ? $this ->wxconfig['pay_key'] : $mch_key ;
        if(empty($mch_key)){
            throw new \Exception('pay_key为空','20003');
        }


        $data = array(
            'mch_appid'=> $app_id,//商户账号appid
            'mchid'=> $mch_id,//商户号
            'nonce_str' => $this->createNoncestr(),//随机字符串
            'partner_trade_no'=> $partner_trade_no,//商户订单号
            'openid'=> $re_openid,//用户openid
            'check_name'=>'NO_CHECK',//校验用户姓名选项,
            're_user_name'=> $re_user_name,//收款用户姓名
            'amount'=>$amount,//金额
            'desc'=> $desc,//企业付款描述信息
            'spbill_create_ip'=> $service_ip,//Ip地址
        );


        //生成签名算法
        $secrect_key = $mch_key;
        $data = array_filter($data);
        ksort($data);
        $str = '';
        foreach($data as $k=>$v) {
            $str .= $k.'='.$v.'&';
        }
        $str .= 'key='.$secrect_key;
        $data['sign'] = md5($str);
        //生成签名算法



        $xml = $this->arraytoxml($data);

        $url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers'; //调用接口
        $res = $this->curl_post_ssl($url,$xml);
        $return = $this->xmltoarray($res);


//        print_r($return);
        //返回来的结果是xml，最后转换成数组
        /*
        array(9) {
          ["return_code"]=>
          string(7) "SUCCESS"
          ["return_msg"]=>
          array(0) {
          }
          ["mch_appid"]=>
          string(18) "wx57676786465544b2a5"
          ["mchid"]=>
          string(10) "143345612"
          ["nonce_str"]=>
          string(32) "iw6TtHdOySMAfS81qcnqXojwUMn8l8mY"
          ["result_code"]=>
          string(7) "SUCCESS"
          ["partner_trade_no"]=>
          string(18) "201807011410504098"
          ["payment_no"]=>
          string(28) "1000018301201807019357038738"
          ["payment_time"]=>
          string(19) "2018-07-01 14:56:35"
        }
        */

//        echo 'ffffffffffffffffffffffffffff';
//        var_dump($res);
        $responseObj = simplexml_load_string($res, 'SimpleXMLElement', LIBXML_NOCDATA);
//        var_dump($responseObj);exit;
        $res = $responseObj->return_code;  //SUCCESS  如果返回来SUCCESS,则发生成功，处理自己的逻辑
        if($res == 'SUCCESS'){
            $return['code'] = '0';
        }else{
            $return['code'] = $responseObj->return_code;
            $return['msg'] = json_decode($res,true);
        }

        return $return;
    }

    /**
     * 商户转账到用户零钱
     */
    public function transferAccountsToUser($params) {

        $uri = '/v3/transfer/batches';
        $res = $this->curl_post_ssl_new($uri, $params,30,[],false,'POST');
        return json_decode($res, true);//json_decode($res, true);
    }


    /**
     * @param $out_detail_no 商家明细单号
     * @param $out_batch_no 商家批次单号
     * @return mixed
     */
    public function transferQueryByBatchIdAndDetailId( $out_batch_no, $out_detail_no) {
        //$uri = "/v3/transfer/batches/batch-id/{$batchId}/details/detail-id/{$detailId}";
        $uri = "/v3/transfer/batches/out-batch-no/{$out_batch_no}/details/out-detail-no/{$out_detail_no}";
        $res = $this->curl_post_ssl_new($uri,null);
        return json_decode($res, true);//json_decode($res, true);
    }



    /**
     * [xmltoarray xml格式转换为数组]
     * @param  [type] $xml [xml]
     * @return [type]      [xml 转化为array]
     */
    public function xmltoarray($xml) {
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $xmlstring = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        $val = json_decode(json_encode($xmlstring),true);
        return $val;
    }

    /**
     * [arraytoxml 将数组转换成xml格式（简单方法）:]
     * @param  [type] $data [数组]
     * @return [type]       [array 转 xml]
     */
    public function arraytoxml($data){
        $str='<xml>';
        foreach($data as $k=>$v) {
            $str.='<'.$k.'>'.$v.'</'.$k.'>';
        }
        $str.='</xml>';
        return $str;
    }

    /**
     * [createNoncestr 生成随机字符串]
     * @param  integer $length [长度]
     * @return [type]          [字母大小写加数字]
     */
    public function createNoncestr($length =32){

        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYabcdefghijklmnopqrstuvwxyz0123456789";
        $str ="";

        for($i=0;$i<$length;$i++){
            $str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);
        }
        return $str;
    }

    /**
     * [curl_post_ssl 发送curl_post数据]
     * @param  [type]  $url     [发送地址]
     * @param  [type]  $xmldata [发送文件格式]
     * @param  [type]  $second [设置执行最长秒数]
     * @param  [type]  $aHeader [设置头部]
     * @return [type]           [description]
     */
    public function curl_post_ssl($url, $xmldata, $second = 30, $aHeader = array(),$is_ssl=false){
        $isdir = EXTEND_PATH."/WeChat/WePay/Cert/";//证书位置;绝对路径
        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
//        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');

        curl_setopt($ch, CURLOPT_TIMEOUT, $second);//设置执行最长秒数
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_URL, $url);//抓取指定网页



        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmldata);//全部数据使用HTTP协议中的"POST"操作来发送

//        if (count($aHeader) >= 1) {
//            curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);//设置头部
//        }

        if($is_ssl){
            //规避SSL验证
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            //跳过HOST验证
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            $data = curl_exec($ch);//执行回话
            if ($data) {
                curl_close($ch);
                return $data;
            } else {
                $error = curl_errno($ch);
                echo __FILE__.__LINE__.'\r\nreturn ['.print_r($data).']'."\r\ncall faild, errorCode:$error\n",'20005';
//            throw new \Exception(__FILE__.__LINE__.'return ['.print_r($data).']'."call faild, errorCode:$error\n",'20005');
                curl_close($ch);
                return false;
            }
        }else{
            //规避SSL验证
//            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//            //跳过HOST验证
//            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
//            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);


//            $tmpFile = tmpfile();
//            fwrite($tmpFile, $this ->wxconfig['payssl_cert']);
//            $tempPemPath = stream_get_meta_data($tmpFile);
//            $tmpCertUri = $tempPemPath['uri'];
//
//            $key_text = fread(EXTEND_PATH . 'WeChat/WePay/Cert/apiclient_key.pem');
//            $tmpFile = tmpfile();
//            fwrite($tmpFile, $this ->wxconfig['payssl_key']);
//            $tempPemPath = stream_get_meta_data($tmpFile);
//            $tmpKeyUri = $tempPemPath['uri'];

            curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, "POST" );
            curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
            curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );

            //证书地址,微信支付下面
            curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
            curl_setopt($ch,CURLOPT_SSLCERT, $this ->wxconfig['ssl_cer']); //证书这块大家把文件放到哪都行、
            curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
            curl_setopt($ch,CURLOPT_SSLKEY, $this ->wxconfig['ssl_key']);//注意证书名字千万别写错、

            curl_setopt ( $ch, CURLOPT_AUTOREFERER, 1 );
            $info = curl_exec ( $ch );
            //返回结果
            if($info){
                curl_close($ch);
                return $info;
            } else {
                $error = curl_errno($ch);
                curl_close($ch);
                echo "curl出错，错误码:$error";
                return "curl出错，错误码:$error";
            }
        }
    }

    /**
     * [curl_post_ssl 发送curl_post数据]
     * @param  [type]  $url     [发送地址]
     * @param  [type]  $xmldata [发送文件格式]
     * @param  [type]  $second [设置执行最长秒数]
     * @param  [type]  $aHeader [设置头部]
     * @return [type]           [description]
     */
    public function curl_post_ssl_new($uri, $data, $second = 30, $aHeader = array(),$is_ssl=false,$method = 'GET'){
        $isdir = EXTEND_PATH."/WeChat/WePay/Cert/";//证书位置;绝对路径

        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');

        curl_setopt($ch, CURLOPT_TIMEOUT, $second);//设置执行最长秒数
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_URL, $this->url . $uri);//抓取指定网页
        $jData = !empty($data) ? json_encode($data) : '';
        $header = $this->getNeedHeaderInfo($jData, $uri, $method);
        if ('POST' == $method) {
            curl_setopt($ch, CURLOPT_POST, 1);//post提交方式4660D02E2371DE640ECD5C3249644414
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));//全部数据使用HTTP协议中的"POST"操作来发送
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);//设置头部

        if($is_ssl){
            //规避SSL验证
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            //跳过HOST验证
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            $data = curl_exec($ch);//执行回话

            if ($data) {
                curl_close($ch);
                return $data;
            } else {
                $error = curl_errno($ch);
                echo __FILE__.__LINE__.'\r\nreturn ['.print_r($data).']'."\r\ncall faild, errorCode:$error\n",'20005';
//            throw new \Exception(__FILE__.__LINE__.'return ['.print_r($data).']'."call faild, errorCode:$error\n",'20005');
                curl_close($ch);
                return false;
            }
        }else{
            //规避SSL验证
//            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//            //跳过HOST验证
//            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
//            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);


//            $tmpFile = tmpfile();
//            fwrite($tmpFile, $this ->wxconfig['payssl_cert']);
//            $tempPemPath = stream_get_meta_data($tmpFile);
//            $tmpCertUri = $tempPemPath['uri'];
//
//            $key_text = fread(EXTEND_PATH . 'WeChat/WePay/Cert/apiclient_key.pem');
//            $tmpFile = tmpfile();
//            fwrite($tmpFile, $this ->wxconfig['payssl_key']);
//            $tempPemPath = stream_get_meta_data($tmpFile);
//            $tmpKeyUri = $tempPemPath['uri'];

            curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
            curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );

            //证书地址,微信支付下面
            curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
            curl_setopt($ch,CURLOPT_SSLCERT, $this ->wxconfig['ssl_cer']); //证书这块大家把文件放到哪都行、
            curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
            curl_setopt($ch,CURLOPT_SSLKEY, $this ->wxconfig['ssl_key']);//注意证书名字千万别写错、

            curl_setopt ( $ch, CURLOPT_AUTOREFERER, 1 );
            $info = curl_exec ( $ch );

            //返回结果
            if($info){
                curl_close($ch);
                return $info;
            } else {
                $error = curl_errno($ch);
                curl_close($ch);
                echo "curl出错，错误码:$error";
                return "curl出错，错误码:$error";
            }
        }
    }

    public function getNeedHeaderInfo($body,$uri,$method = 'GET') {
        $tiemstamp = time();
        $random_str =$this->createNoncestr();
        $params = array(
            'mchid'=>$this->wxconfig['mch_id'],
            'nonce_str'=>$random_str,
            'timestamp'=>$tiemstamp,
            'serial_no'=>$this->wxconfig['serial_no'],
        );

        ksort($params);
        $str1 = "{$method}\n"."{$uri}\n"."{$tiemstamp}\n"."{$random_str}\n"."{$body}\n";

        openssl_sign($str1, $raw_sign, $this->fread($this->wxconfig['ssl_key']), 'sha256WithRSAEncryption');
        $sign = base64_encode($raw_sign);
        $token = sprintf('mchid="%s",nonce_str="%s",timestamp="%d",serial_no="%s",signature="%s"', $params['mchid'],  $params['nonce_str'],  $params['timestamp'],  $params['serial_no'], $sign);
        $header = array('Authorization:'.'WECHATPAY2-SHA256-RSA2048 '. $token,
            'Accept:'.'application/json',
            'Content-Type:'.'application/json',
            'User-Agent:'.'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36'
        );
        return $header;
    }

    public function fread($file){
        $myfile = fopen($file, "r") or die("Unable to open file!");
        // 输出单行直到 end-of-file
        $str = '';
        while(!feof($myfile)) {
//            echo fgets($myfile) . "<br>";
            $str .= fgets($myfile);
        }
        fclose($myfile);
        return $str;
    }

    public function getTmpPathByContent($content)
    {
        static $tmpFile = null;
        $tmpFile = tmpfile();
        fwrite($tmpFile, $content);
        $tempPemPath = stream_get_meta_data($tmpFile);
        if(!file_exists($tempPemPath['uri'])){
            throw new \Exception(__FILE__.__LINE__.'无法生产文件','20005');
        }
        return $tempPemPath['uri'];
    }


}