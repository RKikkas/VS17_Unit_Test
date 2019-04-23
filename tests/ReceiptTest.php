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
    // dot block, mis määrab, et antud test kasutab provideTotal Data Providerit
    /**
     * @dataProvider provideTotal
     */
    public function testTotal($items, $expected){
        // array väärtustega
        $coupon = null;
        // kutsume Receipt meetodi total koos eelnevalt defineeritud väärtustega
        $output = $this->Receipt->total($items, $coupon);
        // PHPUniti testi meetod, mis kontrollib kas oodatav väärtus on sama mis reaalne. assertEquals on samaväärne
        // operaator == ja assertSame on ===
        // võtab parameetrid (expected, real value, message in case of error)
        $this->assertEquals(
            $expected,
            $output,
            "When running should equal {$expected}"
        );
    }

    // Data provider, mis annab väärtused Total meetodi testimiseks
    public function provideTotal() {
        // Array esimene element läheb testTotal $items parameetriks ja teine element on $expected
        return [
            // Episood 9 lisatud arrayle key, mille järgi saab testi filtreerida ja pärast kontrollida, milliste
            // väärtustega test failis
            'ints total 16' => [[1, 2, 5, 8], 16],
            [[-1, 2, 5, 8], 14],
            [[1, 2, 8], 11],
        ];
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

    // Testib Receipt postTaxTotal meetodi
    public function testPostTaxTotal() {
        $items = [1, 2, 5, 8];
        $tax = 0.2;
        $coupon = null;
        // Loome uue Mock Receipt objekti
        $Receipt = $this->getMockBuilder('TDD\Receipt')
            ->setMethods(['total', 'tax'])
            ->getMock();
        // Episood 7 tehtud stubist mock, millel on ootused (expectation), et meetodit kutsutakse välja üks kord
        // samuti lisatud oodatud argumendid
        $Receipt->expects($this->once())
            ->method('total')
            ->with($items, $coupon)
            ->will($this->returnValue(10.00));
        // Episood 7 tehtud stubist mock, millel on ootused (expectation), et meetodit kutsutakse välja üks kord
        // samuti lisatud oodatud argumendid
        $Receipt->expects($this->once())
            ->method('tax')
            ->with(10.00, $tax)
            ->will($this->returnValue(1));
        // Kutsub Receipt objektist postTaxTotal meetodi oma muutujatega, kuid $result erineb
        // kuna varasemalt on stubid määranud, et total ja tax returnivad kindlad valued
        // ja neid meetodeid kasutatakse postTaxTotalis.
        // Ehk me anname muutujatena summa 16 ja tax 0.2 mis peaks returnima 19.2, aga
        // me kontrollime, et väärtus oleks 11 ja test on successful, sest varasemalt on määratud
        // stubid, kus summa on 10 ja tax 0.1
        $result = $Receipt->postTaxTotal([1, 2, 5, 8], 0.2, null);
        $this->assertEquals(
            11.00,
            $result
        );
    }
}