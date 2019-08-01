<?php
/**
 * Created by PhpStorm.
 * User: liwei
 * Date: 2017/5/6
 * Time: 上午12:02
 */


if (!function_exists('fileLog')) {
    /**
     * 日志记录
     * @param $logDir
     * @param $text
     */
    function fileLog($logDir, $text)
    {
        if ( ! is_dir($logDir))
            mkdir($logDir, 0777, true);

        $logFile = $logDir.'/'.date('Y-m-d').'.log';

        $text = sprintf(
            '%s %s %s',
            date('Y-m-d H:i:s'),
            PHP_EOL,
            $text
        );

        $fp = fopen($logFile, "a+");
        flock($fp, LOCK_EX) ;
        fwrite($fp, $text);
        flock($fp, LOCK_UN);
        fclose($fp);
    }
}

if (!function_exists('output')) {
    /**
     * 统一返回
     * @param $content
     * @param int $code
     * @param string $message
     * @param string $error
     * @return \Illuminate\Http\JsonResponse
     */
    function output($content, $code=0, $message='请求成功', $error='')
    {
        $result = [
            'code'              => $code,
            'message'           => (0 == $code) ? $message : '['.$code.']'.$message,
            'content'           => $content,
            'contentEncrypt'    => $error
        ];

        return response()->json($result);
    }
}

if (!function_exists('postCurl')) {
    /**
     * 发起http 请求
     * @param        $url
     * @param array $body
     * @param array $header
     * @param string $method
     * @return bool|mixed
     */
    function postCurl($url, $body = array(), $header = array(), $method = 'POST')
    {
//        array_push($header, 'Accept: application/json');
//        array_push($header, 'Content-Length: '.strlen(http_build_query($body)));
        //$header['Accept'] = 'application/json';
        //$header['Content-Length'] = strlen(http_build_query($body));

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        switch ($method) {
            case 'GET':
                curl_setopt($ch, CURLOPT_HTTPGET, true);
                break;
            case 'POST':
                curl_setopt($ch, CURLOPT_POST, true);
                break;
            case 'PUT':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                break;
            case 'DELETE':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
        }

        curl_setopt($ch, CURLOPT_USERAGENT, 'SSTS Browser/1.0');
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);  //原先是FALSE，可改为2

        if ($body) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($body));
        }
        if ($header) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }

        $ret = curl_exec($ch);
        $err = curl_error($ch);
        $errno = curl_errno($ch);

        curl_close($ch);

        if ($errno) {
            fileLog(
                storage_path('logs/curl'),
                sprintf(
                    'postCurl %s %s error: %s[%s]%s header: %s%s body: %s%s',
                    strtoupper($method),
                    $url,
                    $err,
                    $errno,
                    PHP_EOL,
                    json_encode($header),
                    PHP_EOL,
                    json_encode($body),
                    PHP_EOL
                )
            );
            return false;
        } else {
            fileLog(
                storage_path('logs/curl'),
                sprintf(
                    'postCurl %s %s%s header: %s%s body %s%s response: %s%s',
                    strtoupper($method),
                    $url,
                    PHP_EOL,
                    json_encode($header),
                    PHP_EOL,
                    json_encode(
                        $body,
                        JSON_UNESCAPED_SLASHES
                        | JSON_UNESCAPED_UNICODE
                        | JSON_PRETTY_PRINT
                        | JSON_FORCE_OBJECT
                    ),
                    PHP_EOL,
                    $ret,
                    PHP_EOL
                )
            );
        }

        return $ret;
    }
}

if (!function_exists('postCurlJson')) {
    /**
     * 发起http 请求
     * @param        $url
     * @param array $body
     * @param array $header
     * @param string $method
     * @return bool|mixed
     */
    function postCurlJson($url, $body = array(), $header = array(), $method = 'POST')
    {
        array_push($header, 'Content-Type: application/json');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        switch ($method) {
            case 'GET':
                curl_setopt($ch, CURLOPT_HTTPGET, true);
                break;
            case 'POST':
                curl_setopt($ch, CURLOPT_POST, true);
                break;
            case 'PUT':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                break;
            case 'DELETE':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
        }

        curl_setopt($ch, CURLOPT_USERAGENT, 'SSTS Browser/1.0');
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);  //原先是FALSE，可改为2

        if ($body) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        }
        if ($header) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }

        $ret = curl_exec($ch);
        $err = curl_error($ch);
        $errno = curl_errno($ch);

        curl_close($ch);

        if ($errno) {
            fileLog(
                storage_path('logs/curl'),
                sprintf(
                    'postCurl %s %s error: %s[%s]%s header: %s%s body: %s%s',
                    strtoupper($method),
                    $url,
                    $err,
                    $errno,
                    PHP_EOL,
                    json_encode($header),
                    PHP_EOL,
                    json_encode($body),
                    PHP_EOL
                )
            );
            return false;
        } else {
            fileLog(
                storage_path('logs/curl'),
                sprintf(
                    'postCurl %s %s%s header: %s%s body %s%s response: %s%s',
                    strtoupper($method),
                    $url,
                    PHP_EOL,
                    json_encode($header),
                    PHP_EOL,
                    json_encode(
                        $body,
                        JSON_UNESCAPED_SLASHES
                        | JSON_UNESCAPED_UNICODE
                        | JSON_PRETTY_PRINT
                        | JSON_FORCE_OBJECT
                    ),
                    PHP_EOL,
                    $ret,
                    PHP_EOL
                )
            );
        }
        return $ret;
        // 数据库存日志
        // if ($errno) {
        //     $saveData = [
        //         'method' => strtoupper($method),
        //         'url' => $url,
        //         'header' => json_encode($header),
        //         'body' => json_encode($body),
        //         'error_str' => $err,
        //         'error_no' => $errno,
        //         'created_at' => date('Y-m-d H:i:s')
        //     ];
        //     dblog($saveData);
        //     return false;
        // }

        // $saveData = [
        //     'method' => strtoupper($method),
        //     'url' => $url,
        //     'header' => json_encode($header),
        //     'body' => json_encode($body, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_FORCE_OBJECT),
        //     'response' => $ret,
        //     'created_at' => date('Y-m-d H:i:s')
        // ];
        // dblog($saveData);
        // return $ret;

    }
}

if (!function_exists('check_mobile')) {
    function check_mobile($mobile)
    {

        if (!$mobile) {
            return false;
        }
        if (preg_match("/^\d{11}$/", $mobile)) {
            return true;
        } else {
            return false;

        }
    }
}

if (!function_exists('check_idcard')) {
    /**
     * 身份证校验
     * @param $vStr
     * @return bool
     */
    function check_idcard($vStr)
    {

        if ( !$vStr ) {
            return false;
        }

        $vCity = array(
            '11','12','13','14','15','21','22',
            '23','31','32','33','34','35','36',
            '37','41','42','43','44','45','46',
            '50','51','52','53','54','61','62',
            '63','64','65','71','81','82','91'
        );

        if (!preg_match('/^([\d]{17}[xX\d]|[\d]{15})$/', $vStr)) return false;

        if (!in_array(substr($vStr, 0, 2), $vCity)) return false;

        $vStr = preg_replace('/[xX]$/i', 'a', $vStr);
        $vLength = strlen($vStr);

        if ($vLength == 18)
        {
            $vBirthday = substr($vStr, 6, 4) . '-' . substr($vStr, 10, 2) . '-' . substr($vStr, 12, 2);
        } else {
            $vBirthday = '19' . substr($vStr, 6, 2) . '-' . substr($vStr, 8, 2) . '-' . substr($vStr, 10, 2);
        }

        if (date('Y-m-d', strtotime($vBirthday)) != $vBirthday) return false;
        if ($vLength == 18)
        {
            $vSum = 0;

            for ($i = 17 ; $i >= 0 ; $i--)
            {
                $vSubStr = substr($vStr, 17 - $i, 1);
                $vSum += (pow(2, $i) % 11) * (($vSubStr == 'a') ? 10 : intval($vSubStr , 11));
            }

            if($vSum % 11 != 1) return false;
        }

        return true;
    }
}

if (!function_exists('getAgeByID')) {
    /**
     * 根据身份证获取年龄
     * @param $cid
     * @return float|string
     */
    function getAgeByID($cid)
    {
        //过了这年的生日才算多了1周岁
        if(empty($cid)) return '';
        $date = strtotime(substr($cid, 6, 8));
        //获得出生年月日的时间戳
        $today = strtotime('today');
        //获得今日的时间戳
        $diff = floor(($today-$date)/86400/365);
        //得到两个日期相差的大体年数

        //strtotime加上这个年数后得到那日的时间戳后与今日的时间戳相比
        $age = strtotime(substr($cid, 6, 8).' +'.$diff.'years')>$today ? ($diff+1) : $diff;

        return $age;
    }
}

if (!function_exists('getSexByID')) {
    /**
     * 根据身份证号，自动返回性别
     * @param $cid
     * @return string
     */
    function getSexByID($cid)
    {
        $sexInt = (int)substr($cid,16,1);
        return $sexInt % 2 === 0 ? '女' : '男';
    }
}

if (! function_exists('secToTime')) {
    /**
     * 秒转换小时分钟
     * @param $sec
     * @return string
     */
    function secToTime($sec)
    {
        $sec = round($sec/60);
        if ($sec >= 60){
            $hour = floor($sec/60);
            $min = $sec % 60;
            $res = $hour.' 小时 ';
            $min != 0  &&  $res .= $min.' 分钟';
        }
        else{
            $res = $sec.' 分钟';
        }
        return $res;
    }
}

if (! function_exists('timeDiffDay')) {
    /**
     * 计算两个时间的相差天数
     * @param $beginTime
     * @param $endTime
     * @return float
     */
    function timeDiffDay($beginTime, $endTime)
    {
        if ( $beginTime > $endTime ) {
            $temp = $beginTime;
            $beginTime = $endTime;
            $endTime = $temp;
        }

        $timeDiff = $endTime - $beginTime;

        return ceil($timeDiff/3600/24);
    }
}

if (! function_exists('isVehicleNumber')) {
    /**
     * 车牌号校验
     * @param $vehicleNumber
     * @return bool
     */
    function isVehicleNumber($vehicleNumber)
    {
        //dd($vehicleNumber);
        $express = '/^[\x{4e00}-\x{9fa5}a-zA-Z]{1}[a-zA-Z]{1}[a-zA-Z0-9]{4,6}[a-zA-Z0-9挂学警港澳]{1}$/u';
        if ( preg_match($express, $vehicleNumber) )
            return true;

        return false;
    }
}

if (! function_exists('format_money')) {
    /**
     * 格式化金额
     * @param $money
     * @return bool
     */
    function format_money($money)
    {
        //$money = floor($money * 100) / 100;
        return number_format($money, 2, '.', '');
    }
}

if (! function_exists('argSort')) {
    /**
     * 对数组排序
     * @param $para 排序前的数组
     * @return 排序后的数组
     */
    function argSort($para) {
        ksort($para);
        reset($para);
        return $para;
    }
}

if (! function_exists('createLinkString')) {
    /**
     * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
     * @param $para 需要拼接的数组
     * @return 拼接完成以后的字符串
     */
    function createLinkString($para) {
        $arg  = "";
        while (list ($key, $val) = each ($para)) {
            if (is_array($val)) {
                $sortVal = argSort($val);
                foreach($sortVal as $k => $v) {
                    $arg .= $key."[".$k."]=".$v."&";
                }
            }
            else {
                $arg.=$key."=".$val."&";
            }
        }
        //去掉最后一个&字符
        $arg = substr($arg,0,count($arg)-2);

        //如果存在转义字符，那么去掉转义
        if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}

        return $arg;
    }
}

if (! function_exists('paraFilter')) {
    /**
     * 除去数组中的空值和签名参数
     * @param array $para 签名参数组
     * @return 去掉空值与签名参数后的新签名参数组
     */
    function paraFilter(array $para) {
        $para_filter = array();
        while (list ($key, $val) = each ($para)) {
            if ( is_array($val) ) {
                foreach ($val as $k => $v) {
                    if (
                        $v === ""
                        || is_null($v) // 空值不参与签名
                    )
                        unset($val[$k]);
                }
            }

            if (
                $key == "color_sign"
                || $key == "signature"
                || $val === ""
                || is_null($val) // 空值不参与签名
                || $val === []
                || ( is_string($val) && strtoupper($val) === 'NULL') // android 空值传为字符串 null
                //|| 'password' == $key // 解决 RSA 加密后 IOS base64 "+"加号变空格问题
            )
                continue;
            else
                $para_filter[$key] = $para[$key];
        }
        return $para_filter;
    }
}

if (! function_exists('paraFilterUrlEncode')) {
    /**
     * 除去数组中的空值和签名参数
     * @param array $para 签名参数组
     * @return 去掉空值与签名参数后的新签名参数组
     */
    function paraFilterUrlEncode(array $para) {
        $para_filter = array();
        while (list ($key, $val) = each ($para)) {

            if (
                $key == "sign"
                || $key == "sign_type"
                || $key == "signature"
                || $key == "ts"
                || $key == "access_token"
                || $val === ""
                || is_null($val) // 空值不参与签名
                || ( is_string($val) && strtoupper($val) === 'NULL') // android 空值传为字符串 null
            )
                continue;
            else
                $para_filter[$key] = urlencode($para[$key]);
        }
        return $para_filter;
    }
}

if (! function_exists('arrayToStr')) {
    /**
     * 拼接参数
     * @param null $array
     * @return string
     */
    function arrayToStr($array = null)
    {
        $str = '';
        if ($array) {
            foreach ($array as $k => $v) {
                if (empty($v))
                    continue;
                $str .= "&{$k}={$v}";
            }
            $str = trim($str, '&');
        }
        return $str;
    }
}

if (! function_exists('rsa_encode')) {
    /**
     * rsa 加密
     * @param $pwd
     * @return string
     */
    function rsa_encode($pwd)
    {
        // TODO 待测试环境解决 rsa 问题后开启
        return $pwd;

        $public_key = <<<EOF
-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAgkD7ASE+jfTg3oBZwl0zn3GbBXuvrR9G5ArmjbsT0OLh1rGcivizYHaoTqcc8eytHxCuL16uA2CcE7MLfnK8ZgLUMjvNNz3zJhuq9v0muOCJGwqqyUEVZ7yAbFPA9r+jzcdpLOkoIeCZUa+/OMfGOAyCS/PdJKJhsFhcWv8NfbCSvn+eAKOCWlmSbkuWG3qwZoIoZAAGOMXHwLa6XgHV6QSKuIFrw2ELX/fCwZ8QiDgdeGXIQjvWlY4YzP8k+PvvRg2CURVAkOdVeZdYPWax8j0FVWfM0IL40hrlyzQC7ITShVSxMdg2nTLTlsFRspNckzqN5hBZ+0tlO5spbiTaDwIDAQAB
-----END PUBLIC KEY-----
EOF;
        openssl_public_encrypt($pwd, $encrypted, $public_key, OPENSSL_PKCS1_PADDING);
        $password = base64_encode($encrypted);

        return $password;
    }

}

if (! function_exists('str_rand')) {
    /*
     * 生成随机字符串
     * @param int $length 生成随机字符串的长度
     * @param string $char 组成随机字符串的字符串
     * @return string $string 生成的随机字符串
     */
    function str_rand(
        $length = 32,
        $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ) {
        if(!is_int($length) || $length < 0) {
            return false;
        }

        $string = '';
        for($i = $length; $i > 0; $i--) {
            $string .= $char[mt_rand(0, strlen($char) - 1)];
        }

        return $string;
    }
}

if (! function_exists('des_encrypt')) {
    /**
     * PHP des-ecb加密
     * @param $data
     * @param $key
     * @return string
     */
    function des_encrypt($data, $key){
        return openssl_encrypt ($data, 'des-ecb', $key);
    }
}

if (! function_exists('des_decrypt')) {
    /**
     * PHP des-ecb解密
     * @param $data
     * @param $key
     * @return string
     */
    function des_decrypt($data, $key) {
        return openssl_decrypt ($data, 'des-ecb', $key);
    }
}

if (! function_exists('static_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool    $secure
     * @return string
     */
    function static_asset($path, $secure = null)
    {
        return trim(env('APP_URL'), '/').'/'.trim($path, '/');
    }
}

if (!function_exists('make_sign')) {
    /**
     * 生成签名
     * @param array $params
     * @return boolean
     */
    function make_sign($params) {
        $secret = env('ICE_CLIENT_SECRET');
        $params['appID'] = isset($params['appID']) ? $params['appID'] : env('ICE_APPID');

        $params = paraFilter($params);
        $params = argSort($params);

        $signStr = createLinkStringUrlEncode($params).'&secret='.$secret;
        //dd($signStr, strtoupper(md5($signStr)));
        return strtoupper(md5($signStr));
    }

    /*
     * 除去数组中的空值和签名参数
     */
    function createLinkStringUrlEncode($para) {
        $arg  = "";
        while (list ($key, $val) = each ($para)) {
            $arg.=$key."=".urlencode($val)."&";
        }
        //去掉最后一个&字符
        $arg = substr($arg,0,count($arg)-2);

        //如果存在转义字符，那么去掉转义
        if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}

        return $arg;
    }
}

if (!function_exists('genOrderNumber')) {
    function genOrderNumber($prefix='O')
    {
        // 编年
        $yCode = array(
            'A', 'B', 'C', 'D', 'E', 'F', 'G',
            'H', 'I', 'J', 'K', 'L', 'M', 'N',
            'O', 'P', 'Q', 'R', 'S', 'T',
            'U', 'V', 'W', 'X', 'Y', 'Z');
        $orderSn = $yCode[intval(date('Y')) - 2015]
            . strtoupper(dechex(date('m')))
            . date('d') . substr(time(), -5)
            . substr(microtime(), 2, 5)
            . sprintf('%02d', rand(0, 99));

        return $prefix.$orderSn;
    }
}


if (!function_exists('getPlatform')) {
    function getPlatform()
    {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        if (str_contains($userAgent, 'colourlifeApp')) {
            return 'czy';
        } elseif(str_contains($userAgent, 'MicroMessenger')) {
            return 'wechat';
        } else {
            return 'czy';
        }
    }
}

/**
 *数字转大写人民币
 * @param [type] $num [description]
 * @return [type]  [description]
 */
if (!function_exists('num2rmb')) {
    function num2rmb($num)
    {
        $c1 = "零壹贰叁肆伍陆柒捌玖";
        $c2 = "分角元拾佰仟万拾佰仟亿";
        $num = round($num, 2);
        $num = $num * 100;
        if (strlen($num) > 10) {
            return "oh,sorry,the number is too long!";
        }
        $i = 0;
        $c = "";
        while (1) {
            if ($i == 0) {
                $n = substr($num, strlen($num) - 1, 1);
            } else {
                $n = $num % 10;
            }
            $p1 = substr($c1, 3 * $n, 3);
            $p2 = substr($c2, 3 * $i, 3);
            if ($n != '0' || ($n == '0' && ($p2 == '亿' || $p2 == '万' || $p2 == '元'))) {
                $c = $p1 . $p2 . $c;
            } else {
                $c = $p1 . $c;
            }
            $i = $i + 1;
            $num = $num / 10;
            $num = (int)$num;
            if ($num == 0) {
                break;
            }
        }
        $j = 0;
        $slen = strlen($c);
        while ($j < $slen) {
            $m = substr($c, $j, 6);
            if ($m == '零元' || $m == '零万' || $m == '零亿' || $m == '零零') {
                $left = substr($c, 0, $j);
                $right = substr($c, $j + 3);
                $c = $left . $right;
                $j = $j - 3;
                $slen = $slen - 3;
            }
            $j = $j + 3;
        }
        if (substr($c, strlen($c) - 3, 3) == '零') {
            $c = substr($c, 0, strlen($c) - 3);
        } // if there is a '0' on the end , chop it out
        return $c . "整";
    }
}

if (!function_exists('oss_get')) {
    /**
     * OSS 获取 文件url
     * @param $ossKey
     * @param string $method
     * @return string
     */
    function oss_get($ossKey, $method = '')
    {
        if ($ossKey == '')
            return '';
        
        $ossKey = ltrim($ossKey, "/");

        $bucketName = App\Services\OSS::$bucketName;
        if ($method === 'public') {
            return App\Services\OSS::getPublicObjectURL($bucketName, $ossKey);
        } else {
            return App\Services\OSS::getPrivateObjectURLWithExpireTime($bucketName, $ossKey, new DateTime('+1 day'));
        }
    }
}


if (!function_exists('makeImageUrl')) {

    function makeImageUrl($path)
    {
        if ($path == '') {
            return '';
        }
        $pathArr = explode(',', $path);
        $newPathArr = [];
        foreach($pathArr as $row) {
            $newPathArr[] = oss_get($row);
        }
        return implode(',', $newPathArr);
    }
}

if (!function_exists('makeImageUrlArr')) {

    function makeImageUrlArr($path)
    {
        if ($path == '' || $path == '[]') {
            return [];
        }
        $pathArr = json_decode($path, true);
        $newPathArr = [];
        foreach($pathArr as $row) {
            $newPathArr[] = oss_get($row);
        }
        return $newPathArr;
    }
}

/**
 * 错误日志记录表
 */
if (!function_exists('curl_log')) {

    /**
     * @param string $des 简短描述
     * @param string $content 错误内容
     */
    function curl_log($des, $content)
    {
        try {
            app('db')->table('curl_log')
                        ->insert([
                            'des' => $des,
                            'content' => $content,
                            'created_at' => date('Y-m-d H:i:s')                 
                            ]);
        } catch (\Exception $e) {
            info($e->getMessage());
        }
    }
}

/**
 * 日期带中文
 */
if (!function_exists('format_date')) {

    /**
     * @param string $des 简短描述
     * @param string $content 错误内容
     */
    function format_date($date)
    {
        $date = explode('-', $date);
        $date = $date[0].'年'.$date[1].'月'.$date[2].'日';
        return $date;
    }
}

//格式化时间带点分
if (!function_exists('format_time')) {

    /**
     * @param string $date 11:20
     */
    function format_time($date)
    {
        $date = explode(':', $date);
        $date = $date[0].'点'.$date[1].'分';
        return $date;
    }
}

//时间戳计算小时差
if (!function_exists('diff_hour')) {

    /**
     * @param string $start 100
     * @param string $end 110
     */
    function diff_hour($start, $end)
    {
        $second = abs($end - $start);
        $hour = ceil($second/3600);
        return $hour;
    }
}

//获取经纬度
if (!function_exists('get_address')) {

    /**
     * @param string $start 100
     * @param string $end 110
     */
    function get_address($address)
    {
        try {
            $key = 'EXABZ-VJ3KQ-RHJ5X-GEC65-ES25F-6CBTM';
            $url = 'https://apis.map.qq.com/ws/geocoder/v1/?address='.$address.'&key=EXABZ-VJ3KQ-RHJ5X-GEC65-ES25F-6CBTM';
            $data = file_get_contents($url);
            $data = json_decode($data, true);
            if ($data['status'] == 0)
                return $data['result']['location'];
        } catch (\Exception $e) {
            return false;
        }
        return false;
    }
}