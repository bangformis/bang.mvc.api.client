<?php

/**
 * 網路相關功能
 */
class Net {
    
    /**
     * 將IP轉算為數字
     * @param string $ip IP位置
     * @return int 數字結果
     */
    public static function INET_ATON($ip) {
        $ip = trim($ip);
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6))
            return 0;
        return sprintf("%u", ip2long($ip));
    }

    /**
     * 將數字轉算為IP
     * @param int $num 數字
     * @return string IP位置
     */
    public static function INET_NTOA($num) {
        $num = trim($num);
        if ($num == "0")
            return "0.0.0.0";
        return long2ip(-(4294967295 - ($num - 1)));
    }

    /**
     * 連結取得HTTP結果內容(POST)
     * @param string $url
     */
    public static function HttpPOST($url, $param, $timeout = 40, $https_keyname = "") {
        $curl = Net::PrepareCurl($url, $https_keyname, $timeout);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $param);

        $recall = curl_exec($curl);
        if (!$recall) {
            /* echo curl_error($curl); */
            return false;
        }
        curl_close($curl);
        return $recall;
    }

    /**
     * 連結取得HTTP結果內容(GET)
     * @param string $url
     */
    public static function HttpGET($url, $https_keyname = "") {
        $curl = Net::PrepareCurl($url, $https_keyname, 25);
        $recall = curl_exec($curl);
        if (!$recall) {
            /* echo curl_error($curl); */
            return false;
        }
        curl_close($curl);
        return $recall;
    }

    /**
     * 準備cURL請求
     * @param string $url 請求網址
     * @param type $https_keyname 是否需要SSL KEY
     * @param type $timeout 請求Timeout秒數
     * @return cURL
     */
    private static function PrepareCurl($url, $https_keyname, $timeout = 40) {
        if (substr($url, 0, 4) != "http") {
            $url = "http://" . $url;
        }
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_ENCODING, "UTF-8");
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        if (substr($url, 0, 5) == "https") {
            curl_setopt($curl, CURLOPT_PORT, 443);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            if ($https_keyname != "") {
                curl_setopt($curl, CURLOPT_SSLCERT, dirname(__FILE__) . "/{$https_keyname}.pem");
                curl_setopt($curl, CURLOPT_SSLKEY, dirname(__FILE__) . "/{$https_keyname}.key");
            }
        }
        return $curl;
    }

}
