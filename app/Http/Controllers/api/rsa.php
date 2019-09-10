<?php
namespace App\Http\Controllers\api;

//phpinfo();die;
class Rsa{
    private static $_privkey = '';
    private static $_pubkey = '';
    private static $_isbase64 = false;
    /**
     * 初始化key值
     * @param  string  $privkey  私钥
     * @param  string  $pubkey   公钥
     * @param  boolean $isbase64 是否base64编码
     * @return null
     */
    public  function init($privkey="", $pubkey="", $isbase64=false){
        self::$_privkey = $privkey;
        self::$_pubkey = $pubkey;
        self::$_isbase64 = $isbase64;
    }
    /**
     * 私钥加密
     * @param  string $data 原文
     * @return string       密文
     */
    public  function priv_encode($data){
        $outval = '';

        $res = openssl_pkey_get_private(self::$_privkey);

        openssl_private_encrypt($data, $outval, $res);
        if(self::$_isbase64){
            $outval = base64_encode($outval);
        }
        return $outval;
    }
    /**
     * 公钥解密
     * @param  string $data 密文
     * @return string       原文
     */
    public  function pub_decode($data){
        $outval = '';
        if(self::$_isbase64){
            $data = base64_decode($data);
        }
        $res = openssl_pkey_get_public(self::$_pubkey);
        openssl_public_decrypt($data, $outval, $res);
        return $outval;
    }
    /**
     * 公钥加密
     * @param  string $data 原文
     * @return string       密文
     */
    public  function pub_encode($data){
        $outval = '';
        $res = openssl_pkey_get_public(self::$_pubkey);
        openssl_public_encrypt($data, $outval, $res);
        if(self::$_isbase64){
            $outval = base64_encode($outval);
        }
        return $outval;
    }
    /**
     * 私钥解密
     * @param  string $data 密文
     * @return string       原文
     */
    public  function priv_decode($data){
        $outval = '';
        if(self::$_isbase64){
            $data = base64_decode($data);
        }
        $res = openssl_pkey_get_private(self::$_privkey);
        openssl_private_decrypt($data, $outval, $res);
        return $outval;
    }
    /**
     * 创建一组公钥私钥
     * @return array 公钥私钥数组
     */
    public function new_rsa_key(){
        $res = openssl_pkey_new();
        openssl_pkey_export($res, $privkey);
        $d= openssl_pkey_get_details($res);
        $pubkey = $d['key'];
        return array(
            'privkey' => $privkey,
            'pubkey'  => $pubkey
        );
    }
}
 
 

 
// //举个例子
// $Rsa = new Rsa();
// // $keys = $Rsa->new_rsa_key(); //生成完key之后应该记录下key值，这里省略
// // p($keys);
// //私钥
// $privkey = "-----BEGIN RSA PRIVATE KEY-----
// MIICXAIBAAKBgQCxb1xeaxjto2a6MaHtkFM6G7vq7ARhw9G7cwSLpPeOVITqOq1h
// m3/exOeYKNjyZVaPuxUQoUD+H4P5bCCXcV7rSmNMXEA8+pbRiwmePXoGBvAYps8n
// WLuxNxMkDBaYkA7NCFZ66VTvD7qBXVa5ihJNOkNsSa6eOuRIz/h6LeqLiQIDAQAB
// AoGAOEi//z9vz+oWaxfVattuWy9zA8lMdoq8W/7XQUjaMm8DHp3wY9cEz/CcGntS
// nkmhFMTeoMDWMgZjQdqX2BJhbjCOd8p3OZH61lPZjeeEvfTjh/4BeShZ3ymvgmf6
// Byd5uoczCu17BqUBJCG0niVnrS1tPqGsUjN8mIlE+5/fuqUCQQDa33k3+LifQCGJ
// V84ny748ItY9FNthoGQ77hbEg0Ivfwe3WSdMkAFwanWWq4ZM32fitmZKbPOZb54l
// UHRbQzgPAkEAz4hzXNabjeIniDqNg2FMaiEYkzVjNE7RJ6PWebOJlfUatDXcDB1n
// e7ouMjY3j6HdQzosOK2gb9gj+btVLWeq5wJATj39E2kydptyYaql48wN4WmCtKs0
// EZ5ItrPSJ8XUby42D/Eq/0+rdAhaqNYAWJK0jHMv9gMkwgEIw8YTElzhOQJAQUY0
// qr2hXYYFUxa/jdQbmcHhHeQL2Nb1eBdTDSJIIw9dn9LU7EaPVt4fS5G79gQ+OLfi
// Us1hiewcnJ6sUsSpfwJBAJzEOS/QIfdVWTfO8I13cix1Etb3KDLQhdrZMsvK3DV2
// t9YPk4vPe1SOMBrPaqhIyLUh/XcCWQ8P5YAxTgiJn10=
// -----END RSA PRIVATE KEY-----";//$keys['privkey'];
// //公钥
// $pubkey  = "-----BEGIN PUBLIC KEY-----
// MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCxb1xeaxjto2a6MaHtkFM6G7vq
// 7ARhw9G7cwSLpPeOVITqOq1hm3/exOeYKNjyZVaPuxUQoUD+H4P5bCCXcV7rSmNM
// XEA8+pbRiwmePXoGBvAYps8nWLuxNxMkDBaYkA7NCFZ66VTvD7qBXVa5ihJNOkNs
// Sa6eOuRIz/h6LeqLiQIDAQAB
// -----END PUBLIC KEY-----";//$keys['pubkey'];
// //echo $privkey;die;
// //初始化rsaobject
// $Rsa->init($privkey, $pubkey,TRUE);
 
// //原文
// $data = '你妈妈让你回家吃饭了';
 
// //私钥加密示例
// $encode = $Rsa->priv_encode($data);
// p($encode);
// $ret = $Rsa->pub_decode($encode);
// p($ret);
 
// //公钥加密示例
// $encode = $Rsa->pub_encode($data);
 
// p($encode);
// $ret = $Rsa->priv_decode($encode);
// p($ret);
 
 
 
// function p($str){
//     echo '<pre>';
//     print_r($str);
//     echo '</pre>';
// }
