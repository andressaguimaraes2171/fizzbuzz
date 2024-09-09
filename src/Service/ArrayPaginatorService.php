<?php
namespace App\Service;

class ArrayPaginatorService
{
    public function paginate(array $items, int $page, int $limit): array
    {
        $totalItems = count($items);
        $totalPages = ceil($totalItems / $limit);
        $offset = ($page - 1) * $limit;

        return [
            'items' => array_slice($items, $offset, $limit),
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalItems' => $totalItems,
            'limit' => $limit
        ];
    }
}
