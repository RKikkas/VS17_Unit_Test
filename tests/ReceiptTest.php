<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8.04.2019
 * Time: 9:44
 */
namespace TDD\Test;
#require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
require('vendor\autoload.php');

use PHPUnit\Framework\TestCase;
use TDD\Receipt;

class ReceiptTest extends TestCase {

    // setUp loob uue Receipt objekti
    public function setUp() {
        $this->Receipt = new Receipt();
    }

    // tearDown eemaldab pärast teste Receipt objekti
    public function tearDown() {
        unset($this->Receipt);
    }

    // Testib Receipt Total meetodit ilma couponita
    public function testTotal(){
        // array väärtustega
        $input = [0, 2, 5, 8];
        $coupon = null;
        // kutsume Receipt meetodi total koos eelnevalt defineeritud väärtustega
        $output = $this->Receipt->total($input, $coupon);
        // PHPUniti testi meetod, mis kontrollib kas oodatav väärtus on sama mis reaalne. assertEquals on samaväärne
        // operaator == ja assertSame on ===
        // võtab parameetrid (expected, real value, message in case of error)
        $this->assertEquals(
            15,
            $output,
            'When running should equal 15'
        );
    }

    // Testib Receipt Total meetodit koos couponiga
    public function testTotalAndCoupon(){
        // array väärtustega
        $input = [0, 2, 5, 8];
        $coupon = 0.2;
        // kutsume Receipt meetodi total koos eelnevalt defineeritud väärtustega
        $output = $this->Receipt->total($input, $coupon);
        // PHPUniti testi meetod, mis kontrollib kas oodatav väärtus on sama mis reaalne. assertEquals on samaväärne
        // operaator == ja assertSame on ===
        // võtab parameetrid (expected, real value, message in case of error)
        $this->assertEquals(
            12,
            $output,
            'When running should equal 12'
        );
    }

    // Testib Receipt tax meetodit
    public function testTax() {
        // Algsed muutujad
        $inputAmount = 10;
        $taxInput = 0.1;
        $output = $this->Receipt->tax($inputAmount, $taxInput);

        $this->assertEquals(
            1,
            $output,
            'Tax calculation should be equal to 1'
        );
    }

}