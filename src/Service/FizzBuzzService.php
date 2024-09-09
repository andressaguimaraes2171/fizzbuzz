<?php

namespace App\Service;

class FizzBuzzService
{
    private const FIZZ = 'Fizz';
    private const BUZZ = 'Buzz';
    private const FIZZ_BUZZ = 'FizzBuzz';

    public function generateFizzBuzz(int $from, int $to, int $fizzNumber, int $buzzNumber): array
    {
        $result = [];

        for ($i = $from; $i <= $to; $i++) {
            $result[] = $this->getFizzBuzzOutput($i, $fizzNumber, $buzzNumber);
        }

        return $result;
    }

    private function isItMultipleDivisibleBy(int $number, int $fizzNumber, int $buzzNumber): bool
    {
        return $number % $fizzNumber === 0 && $number % $buzzNumber === 0;
    }

    private function isItDivisibleBy(int $number, int $divisor): bool
    {
        return $number % $divisor === 0;
    }

    private function getFizzBuzzOutput(int $number, int $fizzNumber, int $buzzNumber): string
    {
        if ($this->isItMultipleDivisibleBy($number, $fizzNumber, $buzzNumber)) {
            return self::FIZZ_BUZZ;
        }

        if ($this->isItDivisibleBy($number, $fizzNumber)) {
            return self::FIZZ;
        }

        if ($this->isItDivisibleBy($number, $buzzNumber)) {
            return self::BUZZ;
        }

        return (string) $number;
    }

}
