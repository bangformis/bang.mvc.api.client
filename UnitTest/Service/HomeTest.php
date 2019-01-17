<?php

require_once 'auto_load.php';

use Models\API\ApiName\Service;

/**
 * 字串功能測試
 */
class HomeTest extends PHPUnit_Framework_TestCase {

    public function testSuccess() {
        $service = new Service\Home();
        $email = 'test@com.tw';
        $result1 = $service->TestSuccess($email);
        $this->assertTrue($result1->IsSuccess);
    }

    public function testTestUnSuccess() {
        $service = new Service\Home();
        $email = 'test@com.tw';
        $result1 = $service->TestUnSuccess($email);
        $this->assertFalse($result1->IsSuccess);
    }

}
