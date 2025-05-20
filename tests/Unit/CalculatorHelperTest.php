<?php

namespace Tests\Unit;

use App\Helpers\CalculatorHelper;
use PHPUnit\Framework\TestCase;

class CalculatorHelperTest extends TestCase
{
    public function testAddition()
    {
        $this->assertEquals(5, CalculatorHelper::add(2, 3));
    }

    public function testSubtraction()
    {
        $this->assertEquals(1, CalculatorHelper::subtract(4, 3));
    }
}
