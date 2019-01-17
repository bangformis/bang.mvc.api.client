<?php

namespace Models\API\ApiName\Service;

use Bang\Abstracts\IApiLogger;
use Bang\Lib\eString;
use Bang\Lib\Net;
use Bang\Lib\ORM;
use Bang\Lib\TaskResult;
use ConfigApiName;

/**
 * @author Bang
 */
class Base {

    function __construct($controller, IApiLogger $logger = null, $url = null) {
        if ($url == null) {
            $url = ConfigApiName::ApiUrl;
        }
        $this->url = $url;
        $this->controller = $controller;
        $this->logger = $logger;
    }

    private function IsShouldLog() {
        $result = (null != $this->logger) && ConfigApiName::EnableLog;
        return $result;
    }

    /**
     * @var IApiLogger 
     */
    protected $logger;
    protected $url;
    public $controller;

    /**
     * @param type $bag
     * @param string $action
     * @return TaskResult
     */
    public function CallApi($bag, $action) {
        if (!is_array($bag)) {
            $bag = ORM::ObjectToArray($bag);
        }
        $this_array = ORM::ObjectToArray($this);
        $params = array_merge($bag, $this_array);
        $params['action'] = $action;

        if (ConfigApiName::EnableChecksum) {
            $params['Checksum'] = $this->GetChecksum($params);
        }

        $call_url = $this->url . '?' . http_build_query($params);
        if ($this->IsShouldLog()) {
            $this->logger->InitRequest("{$this->controller}/{$action}", $call_url);
        }
        $response_content = Net::HttpGET($call_url);
        $result = json_decode($response_content);
        if ($this->IsShouldLog()) {
            $this->logger->EndWithResponse($result->IsSuccess, $response_content);
        }
        return $result;
    }

    private function GetChecksum($params) {
        $checksum_str = $this->GetChecksumString($params);
        $check_sum_from = md5($checksum_str . ConfigApiName::ChecksumKey);
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
            if ($key == 'controller' || $key == 'action' || $key == 'Checksum' || eString::StartsWith($key, '_')) {
                continue;
            }
            $check_sum .= "{$key}:{$value},";
        }
        return $check_sum;
    }

}
