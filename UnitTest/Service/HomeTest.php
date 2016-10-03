<?php

require_once 'auto_load.php';

use Models\API\ApiName\Service;

/**
 * 字串功能測試
 */
class HomeTest extends PHPUnit_Framework_TestCase {

    public function testTestSuccess() {
        $service = new Service\Home();
        $email = 'bang@bang.mvc';

        $result1 = $service->TestSuccess($email);
        $this->assertTrue($result1->IsSuccess);
        $this->assertEquals($result1->Message, 'test success!');

        $result2 = $service->TestUnSuccess($email);
        $this->assertFalse($result2->IsSuccess);
        $this->assertEquals($result2->Message, 'test unsuccess!');
    }

}
