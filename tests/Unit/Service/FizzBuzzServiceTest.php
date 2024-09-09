<?php

namespace App\Tests\Service;

use App\Service\FizzBuzzService;
use PHPUnit\Framework\TestCase;

class FizzBuzzServiceTest extends TestCase
{

    public function testGenerateFizzBuzz()
    {
        $service = new FizzBuzzService();

        $result = $service->generateFizzBuzz(1, 15, 3, 5);

        $expected = [
            '1', '2', 'Fizz', '4', 'Buzz', 'Fizz', '7', '8', 'Fizz', 'Buzz', '11', 'Fizz', '13', '14', 'FizzBuzz'
        ];

        $this->assertEquals($expected, $result);
    }

    public function testGenerateFizzBuzzWithCustomNumbers()
    {
        $service = new FizzBuzzService();

        $result = $service->generateFizzBuzz(1, 10, 2, 3);

        $expected = [
            '1', 'Fizz', 'Buzz', 'Fizz', '5', 'FizzBuzz', '7', 'Fizz', 'Buzz', 'Fizz'
        ];

        $this->assertEquals($expected, $result);
    }

    public function testGenerateFizzBuzzWithNegativeNumbers()
    {
        $service = new FizzBuzzService();

        $result = $service->generateFizzBuzz(-5, 5, 3, 5);

        $expected = [
            'Buzz', '-4', 'Fizz', '-2', '-1', 'FizzBuzz', '1', '2', 'Fizz', '4', 'Buzz'
        ];

        $this->assertEquals($expected, $result);
    }

    public function testGenerateFizzBuzzWithSameNumber()
    {
        $service = new FizzBuzzService();

        $result = $service->generateFizzBuzz(1, 15, 3, 3);

        $expected = [
            '1', '2', 'FizzBuzz', '4', '5', 'FizzBuzz', '7', '8', 'FizzBuzz', '10', '11', 'FizzBuzz', '13', '14', 'FizzBuzz'
        ];

        $this->assertEquals($expected, $result);
    }

    public function testGenerateFizzBuzzWithLargeRange()
    {
        $service = new FizzBuzzService();

        $result = $service->generateFizzBuzz(98, 102, 3, 5);

        $expected = [
            '98', 'Fizz', 'Buzz', '101', 'Fizz'
        ];

        $this->assertEquals($expected, $result);
    }

    public function testGenerateFizzBuzzWithReversedRange()
    {
        $service = new FizzBuzzService();

        $result = $service->generateFizzBuzz(5, 1, 3, 5);

        $this->assertEmpty($result);
    }
}
