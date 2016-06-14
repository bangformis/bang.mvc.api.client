<?php

require_once 'auto_load.php';

use Bang\Lib\String;

/**
 * 字串功能測試
 */
class StringTest extends PHPUnit_Framework_TestCase {

    public function testIsNullOrSpace() {
        //Arrange 
        $strTrue = '  ';
        $strFalse = " g";
        $strTrue2 = NULL;

        //Act
        $resultTrue1 = String::IsNullOrSpace($strTrue);
        $resultFalse1 = String::IsNullOrSpace($strFalse);
        $resultTrue2 = String::IsNullOrSpace($strTrue2);
        $resultTrue3 = String::IsNullOrSpace("");

        //Assert
        $this->assertEquals($resultTrue1, TRUE);
        $this->assertEquals($resultFalse1, FALSE);
        $this->assertEquals($resultTrue2, TRUE);
        $this->assertEquals($resultTrue3, TRUE);
    }

    public function testRemoveSuffix() {
        // Arrange
        $suffix = 'Controller';
        $str1 = 'HomeController';
        $str2 = 'Home2Controller';
        $str3 = 'SiteController';

        // Act
        $result1 = String::RemoveSuffix($str1, $suffix);
        $result2 = String::RemoveSuffix($str2, $suffix);
        $result3 = String::RemoveSuffix($str3, $suffix);

        // Assert
        $this->assertEquals($result1, "Home");
        $this->assertEquals($result2, "Home2");
        $this->assertEquals($result3, "Site");
    }

    public function testRemovePrefix() {
        // Arrange
        $prefix = 'bla_';
        $str = 'bla_string_bla_bla_bla';

        // Act
        $result = String::RemovePrefix($str, $prefix);

        // Assert
        $this->assertEquals($result, "string_bla_bla_bla");
    }

    public function testStartsWith() {
        // Arrange
        $test = "test1";
        $test2 = "";

        // Act
        $isTrue = String::StartsWith($test, "test");
        $isFlase = String::StartsWith($test, "1");
        $isFalse2 = String::StartsWith($test2, "1");

        // Assert
        $this->assertTrue($isTrue);
        $this->assertFalse($isFlase);
        $this->assertFalse($isFalse2);
    }

    public function testEndsWith() {
        // Arrange
        $test = "test1";
        $test2 = "";

        // Act
        $isFlase = String::EndsWith($test, "test");
        $isTrue = String::EndsWith($test, "1");
        $isFalse2 = String::EndsWith($test2, "1");

        // Assert
        $this->assertTrue($isTrue);
        $this->assertFalse($isFlase);
        $this->assertFalse($isFalse2);
    }

}
