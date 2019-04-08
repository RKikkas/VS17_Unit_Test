<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8.04.2019
 * Time: 9:44
 */

namespace TDD;

class Receipt {

    public function total($items = array()) {
        return array_sum($items);
    }

    public function tax($amount, $tax) {
        return($amount * $tax);
    }
}