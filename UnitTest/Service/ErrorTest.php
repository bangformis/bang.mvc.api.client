<?php

require_once 'auto_load.php';

use Models\API\ApiName\Service;

/**
 * 字串功能測試
 */
class ErrorTest extends PHPUnit_Framework_TestCase {

    public function testTestSuccess() {
        $service = new Service\Error();
        $email = 'bang@bang.mvc';

        $result1 = $service->TestSuccess($email);
        $this->assertTrue(!$result1->IsSuccess);
        $this->assertEquals($result1->Value, 500);
    }

}
