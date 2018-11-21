<?php

require_once 'auto_load.php';

use Models\API\ApiName\Service;

/**
 * 字串功能測試
 */
class HomeTest extends PHPUnit_Framework_TestCase {

    public function testSuccess() {
        $service = new Service\Home();

        $result1 = $service->Success();
        $this->assertTrue($result1->IsSuccess);
    }

}
