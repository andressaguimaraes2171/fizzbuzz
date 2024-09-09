<?php

namespace App\Tests\Unit\Service;

use App\Service\ArrayPaginatorService;
use PHPUnit\Framework\TestCase;

class ArrayPaginatorServiceTest extends TestCase
{

    public function testPaginateWithEmptyArray()
    {
        $paginatorService = new ArrayPaginatorService();
        $result = $paginatorService->paginate([], 1, 10);

        $this->assertEmpty($result['items']);
        $this->assertEquals(1, $result['currentPage']);
        $this->assertEquals(0, $result['totalPages']);
        $this->assertEquals(0, $result['totalItems']);
        $this->assertEquals(10, $result['limit']);
    }

    public function testPaginateWithSinglePage()
    {
        $paginatorService = new ArrayPaginatorService();
        $items = range(1, 5);
        $result = $paginatorService->paginate($items, 1, 10);

        $this->assertEquals($items, $result['items']);
        $this->assertEquals(1, $result['currentPage']);
        $this->assertEquals(1, $result['totalPages']);
        $this->assertEquals(5, $result['totalItems']);
        $this->assertEquals(10, $result['limit']);
    }

    public function testPaginateWithMultiplePages()
    {
        $paginatorService = new ArrayPaginatorService();
        $items = range(1, 25);
        $result = $paginatorService->paginate($items, 2, 10);

        $this->assertEquals(array_slice($items, 10, 10), $result['items']);
        $this->assertEquals(2, $result['currentPage']);
        $this->assertEquals(3, $result['totalPages']);
        $this->assertEquals(25, $result['totalItems']);
        $this->assertEquals(10, $result['limit']);
    }

    public function testPaginateWithLastPage()
    {
        $paginatorService = new ArrayPaginatorService();
        $items = range(1, 22);
        $result = $paginatorService->paginate($items, 3, 10);

        $this->assertEquals(array_slice($items, 20), $result['items']);
        $this->assertEquals(3, $result['currentPage']);
        $this->assertEquals(3, $result['totalPages']);
        $this->assertEquals(22, $result['totalItems']);
        $this->assertEquals(10, $result['limit']);
    }

    public function testPaginateWithInvalidPage()
    {
        $paginatorService = new ArrayPaginatorService();
        $items = range(1, 20);
        $result = $paginatorService->paginate($items, 5, 10);

        $this->assertEmpty($result['items']);
        $this->assertEquals(5, $result['currentPage']);
        $this->assertEquals(2, $result['totalPages']);
        $this->assertEquals(20, $result['totalItems']);
        $this->assertEquals(10, $result['limit']);
    }

    public function testPaginateWithCustomLimit()
    {
        $paginatorService = new ArrayPaginatorService();
        $items = range(1, 15);
        $result = $paginatorService->paginate($items, 2, 7);

        $this->assertEquals(array_slice($items, 7, 7), $result['items']);
        $this->assertEquals(2, $result['currentPage']);
        $this->assertEquals(3, $result['totalPages']);
        $this->assertEquals(15, $result['totalItems']);
        $this->assertEquals(7, $result['limit']);
    }
}
