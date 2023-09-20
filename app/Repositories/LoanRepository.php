<?php


namespace App\Repositories;


use App\Interfaces\LoanInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class LoanRepository extends BaseRepository implements LoanInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function searchLoanRequestsByPagination(array $filters, int $page, int $limit): LengthAwarePaginator
    {
        return $this->searchLoanRequestsQuery($filters)->paginate($limit);
    }

    public function searchLoanRequestsQuery(array $filters): Builder
    {
        $query = $this->model->query();
        if ($filters['user_id']) {
            $query = $query->where('user_id', $filters['user_id']);
        }
        return $query;
    }

    public function getStatistics()
    {
        $total = $this->model->newQuery()->where('status', 'accepted')->sum('amount');
        $rejected = $this->model->newQuery()->where('status', 'rejected')->count();
        $accepted = $this->model->newQuery()->where('status', 'accepted')->count();
        $created = $this->model->newQuery()->where('status', 'created')->count();
        return [
          'total' => $total,
          'rejected' => $rejected,
          'accepted' => $accepted,
          'created' => $created,
        ];
    }
}
