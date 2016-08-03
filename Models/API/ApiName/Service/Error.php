<?php

namespace Models\API\ApiName\Service;

/**
 * @author Bang
 */
class Error extends Base {

    function __construct() {
        parent::__construct('Error');
    }

    public function TestSuccess($email) {
        $bag = array(
            'email' => $email,
        );
        return $this->CallApi($bag, 'TestSuccess');
    }

}
