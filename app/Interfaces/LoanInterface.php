<?php


namespace App\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface LoanInterface
 * @package App\Interfaces
 */
interface LoanInterface extends BaseInterface
{
    public function searchLoanRequestsByPagination(array $filters, int $page, int $limit): LengthAwarePaginator;
}
