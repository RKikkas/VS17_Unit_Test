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
    public function testTotal(){
        // Loome uue Receipt objekti
        $Receipt = new Receipt();
        // PHPUniti testi meetod, mis kontrollib kas oodatav väärtus on sama mis reaalne. assertEquals on samaväärne
        // operaator == ja assertSame on ===
        // võtab parameetrid (expected, real value, message in case of error)
        $this->assertEquals(
            15,
            $Receipt->total([0,2,5,8]),
            'When running should equal 15');
    }
}