<?php

namespace Models\API\ApiName\Service;

/**
 * @author Bang
 */
class Home extends Base {

    function __construct() {
        parent::__construct('Home');
    }

    public function Success() {
        $bag = array(
            
        );
        return $this->CallApi($bag, __FUNCTION__);
    }

    public function TestUnSuccess($email) {
        $bag = array(
            'email' => $email,
        );
        return $this->CallApi($bag, 'TestUnSuccess');
    }

}
