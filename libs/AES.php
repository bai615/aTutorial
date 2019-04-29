<?php
/**
 * Created by PhpStorm.
 * User: baihua
 * Date: 2019/4/28
 * Time: 下午7:46
 */

class AES
{
    /**
     * 加密
     * @param $unencrypted
     * @param $key
     * @param $iv
     * @return string
     */
    public function encrypt($unencrypted, $key, $iv)
    {
        if (is_array($unencrypted)) {
            $str_padded = json_encode($unencrypted);
        } else {
            $str_padded = $unencrypted;
        }
        if (strlen($str_padded) % 16) {
            $str_padded = str_pad($str_padded, strlen($str_padded) + 16 - strlen($str_padded) % 16, "\0");
        }
        $encrypted = openssl_encrypt($str_padded, 'aes-128-cbc', $key, OPENSSL_NO_PADDING, $iv);
        return (base64_encode($encrypted));
    }

    /**
     * 解密
     * @param $encrypted
     * @param $key
     * @param $iv
     * @return string
     */
    public function decrypt($encrypted, $key, $iv)
    {
        $m = openssl_decrypt(base64_decode($encrypted), 'aes-128-cbc', $key, OPENSSL_NO_PADDING, $iv);
        return (rtrim(rtrim($m, chr(0)), chr(7)));
    }

    /**
     * 加密 (适用 PHP 5)
     * @param $unencrypted
     * @param $key
     * @param $iv
     * @return string
     */
    public function encrypt5($unencrypted, $key128, $iv)
    {
        $cipher = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
        
        if (mcrypt_generic_init($cipher, $key128, $iv) != -1) {
            
            if (is_array($unencrypted)) {
                $str_padded = json_encode($unencrypted);
            } else {
                $str_padded = $unencrypted;
            }
            $cipherText = mcrypt_generic($cipher, $str_padded);
            mcrypt_generic_deinit($cipher);

            return base64_encode($cipherText);
        }

        return '';
    }
}