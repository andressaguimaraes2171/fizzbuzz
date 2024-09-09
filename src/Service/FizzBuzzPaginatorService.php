<?php

namespace App\Service;

class FizzBuzzPaginatorService
{
    private $fizzBuzzService;
    private $arrayPaginatorService;

    public function __construct(FizzBuzzService $fizzBuzzService, ArrayPaginatorService $arrayPaginatorService)
    {
        $this->fizzBuzzService = $fizzBuzzService;
        $this->arrayPaginatorService = $arrayPaginatorService;
    }

    public function getPaginatedFizzBuzz(int $from, int $to, int $fizzNumber, int $buzzNumber, int $page, int $limit): array
    {
        $totalItems = $to - $from + 1;
        $pageFrom = $from + (($page - 1) * $limit);
        $pageTo = min($pageFrom + $limit - 1, $to);

        $items = $this->fizzBuzzService->generateFizzBuzz($pageFrom, $pageTo, $fizzNumber, $buzzNumber);

        return $this->arrayPaginatorService->paginate($items, $page, $limit, $totalItems);
    }
}
