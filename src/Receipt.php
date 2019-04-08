<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8.04.2019
 * Time: 9:44
 */

namespace TDD;

class Receipt {

    public function total($items = array(), $coupon = null) {
        $sum = array_sum($items);
        if (!is_null($coupon)) {
            return $sum - ($sum * $coupon);
        }
        return $sum;
    }

    public function tax($amount, $tax) {
        return($amount * $tax);
    }

    public function postTaxTotal($items, $tax, $coupon) {
        // Arvutab kogusumma
        $subtotal = $this->total($items, $coupon);
        // Returnib lõppsumma = kogusumma - tax
        return $subtotal + $this->tax($subtotal, $tax);
    }
}