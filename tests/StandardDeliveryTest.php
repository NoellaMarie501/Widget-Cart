<?php
use PHPUnit\Framework\TestCase;
use App\Delivery\StandardDelivery;


class StandardDeliveryTest extends TestCase
{
    public function testCalculateReturns495ForSubtotalLessThan50()
    {
        $delivery = new StandardDelivery();
        $this->assertEquals(4.95, $delivery->calculate(30.00));
    }

    public function testCalculateReturns295ForSubtotalBetween50And90()
    {
        $delivery = new StandardDelivery();
        $this->assertEquals(2.95, $delivery->calculate(70.00));
    }

    public function testCalculateReturns0ForSubtotal90OrMore()
    {
        $delivery = new StandardDelivery();
        $this->assertEquals(0.00, $delivery->calculate(100.00));
    }

    public function testCalculateReturns495ForEdgeCaseJustBelow50()
    {
        $delivery = new StandardDelivery();
        $this->assertEquals(4.95, $delivery->calculate(49.99));
    }

    public function testCalculateReturns295ForEdgeCaseJustBelow90()
    {
        $delivery = new StandardDelivery();
        $this->assertEquals(2.95, $delivery->calculate(89.99));
    }

    public function testCalculateReturns0ForEdgeCaseExactly90()
    {
        $delivery = new StandardDelivery();
        $this->assertEquals(0.00, $delivery->calculate(90.00));
    }
}