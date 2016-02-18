<?php

/**
 * 字串(String)擴增功能
 */
class String {

    /**
     * 将阵列字串结合成单一字串
     * @param array $strs 字串阵列
     * @param string $separated 分隔字串
     * @param string $symbol 字串符号
     * @return string 结果字串
     */
    public static function ToSingleString($strs, $separated = ",", $symbol = "'") {
        $result = "";
        $count = 0;
        foreach ($strs as $str) {
            if ($count > 0) {
                $result .= $separated;
            }
            $result .= $symbol . $str . $symbol;
            $count++;
        }
        return $result;
    }

    /**
     * 判斷字串不是空值或是空白
     * @param string $str 判斷字串
     * @return bool 判斷結果
     */
    public static function IsNotNullOrSpace($str) {
        return !String::IsNullOrSpace($str);
    }

    /**
     * 判斷字串是空值或是空白
     * @param string $str 判斷字串
     * @return bool 判斷結果
     */
    public static function IsNullOrSpace($str) {
        return (!isset($str) || trim($str) === '');
    }

    /**
     * 刪除字串開頭文字
     * @param string $input 輸入值
     * @param string $prefix 開頭文字
     * @return string 刪除後字串
     */
    public static function RemovePrefix($input, $prefix) {
        $str = $input;
        if (self::StartsWith($input, $prefix)) {
            $str = substr($input, strlen($prefix));
        }
        return $str;
    }

    /**
     * 刪除字串結尾文字
     * @param string $input 輸入值
     * @param string $suffix 結尾文字
     * @return string 刪除後字串
     */
    public static function RemoveSuffix($input, $suffix) {
        $str = $input;
        if (self::EndsWith($input, $suffix)) {
            $str = substr($input, 0, strlen($input) - strlen($suffix));
        }
        return $str;
    }

    /**
     * 判斷字串是否為$test開頭
     * @param string $input 輸入值
     * @param string $test 比對值
     * @return bool 判斷結果
     */
    public static function StartsWith($input, $test) {
        return strpos($input, $test) === 0;
    }

    /**
     * 判斷字串是否為$test結尾
     * @param string $input 輸入值
     * @param string $test 比對值
     * @return bool 判斷結果
     */
    public static function EndsWith($input, $test) {
        return $test === "" || substr($input, -strlen($test)) === $test;
    }

    /**
     * 字串取代
     * @param string $input 輸入完整字串
     * @param string $target_str 尋找目標？
     * @param string $replace_to 取代為？
     * @return string 結果字串
     */
    public static function Replace($input, $target_str, $replace_to) {
        return str_replace($target_str, $replace_to, $input);
    }
    
    /**
     * 將QueryString轉為陣列
     * @param string $input QueryString
     * @return array 陣列結果
     */
    public static function ParseQueryStringToArray($input){
        $resultArray = array();
        parse_str($input , $resultArray);
        return $resultArray;
    }

}
