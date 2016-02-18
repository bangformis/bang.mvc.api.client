<?php

namespace API\Service;

/**
 * @author Bang
 */
class Base {

    function __construct($controller, $url = null) {
        if ($url == null) {
            $url = \API\Config::ApiUrl;
        }
        $this->url = $url;
        $this->controller = $controller;
    }

    protected $url;
    public $controller;

    /**
     * 
     * @param type $bag
     * @param string $action
     * @return \TaskResult
     */
    public function CallApi($bag, $action) {
        if (!is_array($bag)) {
            $bag = \ORM::ObjectToArray($bag);
        }
        $this_array = \ORM::ObjectToArray($this);
        $params = array_merge($bag, $this_array);
        $params['action'] = $action;

        if (\API\Config::Checksum) {
            $params['Checksum'] = $this->GetChecksum($params);
        }

        $call_url = $this->url . '?' . http_build_query($params);
        $response_content = \Net::HttpGET($call_url);
        $result = json_decode($response_content);
        return $result;
    }

    private function GetChecksum($params) {
        $checksum_str = $this->GetChecksumString($params);
        $check_sum_from = md5($checksum_str . \API\Config::Key);
        return $check_sum_from;
    }

    public function GetChecksumString($params) {
        if (!is_array($params)) {
            $array = get_object_vars($params);
        } else {
            $array = $params;
        }

        ksort($array);
        $check_sum = '';
        foreach ($array as $key => $value) {
            if ($key == 'controller' || $key == 'action' || $key == 'Checksum' || \String::StartsWith($key, '_')) {
                continue;
            }
            $check_sum .= "{$key}:{$value},";
        }
        return $check_sum;
    }

}
