<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 6/26/17
 * Time: 12:06 AM
 */

namespace App\Services;

class PhoneNumber {

    private $phoneNumber;

    public function __construct($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function addPrefix() {
        $phone = str_split($this->phoneNumber);
        $prefix = $phone[0];
        if (sizeof($phone) == 10 and $prefix=='0'){
            $phone[0] = '+254';
            return implode('', $phone);

        }
        elseif (sizeof($phone) == 13  and $prefix == '+' ) {
            return $this->phoneNumber;
        }
        elseif (sizeof($phone) < 10) {
            print_r(json_encode(array(
                "Error" => "Phone number too short"
            )));
            return null;
        }
        elseif (sizeof($phone) > 13 ){
            print_r(json_encode(array(
                "Error" => "Phone number length exceed the required length of 13"
            )));
            return null;
        }
        else{
            print_r(json_encode(array(
                "Error" => "invalid phone number"
            )));
            return null;
        }
    }
}