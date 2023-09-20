<?php


namespace App\Repositories;

use App\Interfaces\BaseInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseRepository
 *
 * @package \App\Repositories
 */
class BaseRepository implements BaseInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Create a model instance
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * Update a model instance
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        return $this->findOneOrFail($id)->update($attributes);
    }

    /**
     * Return all model rows
     * @param array $columns
     * @param string $orderBy
     * @param string $sortBy
     * @return mixed
     */
    public function all($columns = array('*'), $orderBy = 'id', $sortBy = 'DESC')
    {
        return $this->model->orderBy($orderBy, $sortBy)->get($columns);
    }

    public function allByPagination($columns = array('*'), $orderBy = 'id', $sortBy = 'DESC', $page = 1, $limit = 10)
    {
        return $this->model->orderBy($orderBy, $sortBy)->paginate($limit);
    }

    /**
     * Delete one by Id
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->findOneOrFail($id)->delete();
    }

    /**
     * Find one by ID
     * @param int $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Find one by ID or throw exception
     * @param int $id
     * @return mixed
     */
    public function findOneOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Find based on a different column
     * @param array $data
     * @return mixed
     */
    public function findBy(array $data)
    {
        return $this->model->where($data)->get();
    }

    /**
     * Find based on a different column
     * @param array $data
     * @param string $orderBy
     * @param string $sortBy
     * @return mixed
     */
    public function findByOrder(array $data, $orderBy = 'id', $sortBy = 'desc')
    {
        return $this->model->where($data)->orderBy($orderBy, $sortBy)->get();
    }

    /**
     * Find one based on a different column
     * @param array $data
     * @return mixed
     */
    public function findOneBy(array $data)
    {
        return $this->model->where($data)->orderBy('id', 'desc')->first();
    }

    /**
     * Find based on a different column
     * @param array $data
     * @param int $page
     * @param int $limit
     * @return mixed
     */
    public function findByPaginate(array $data, int $page = 1, int $limit = 10)
    {
        return $this->model->where($data)->orderBy('id', 'desc')->paginate($limit);
    }

    /**
     * Find based on a different column
     * @param array $data
     * @param string $orderBy
     * @param string $sortBy
     * @param int $page
     * @param int $limit
     * @return mixed
     */
    public function findByOrderPaginate(array $data, $orderBy = 'id', $sortBy = 'desc', int $page = 1, int $limit = 10)
    {
        return $this->model->where($data)->orderBy($orderBy, $sortBy)->paginate($limit);
    }

    /**
     * Find one based on a different column or through exception
     * @param array $data
     * @return mixed
     */
    public function findOneByOrFail(array $data)
    {
        return $this->model->where($data)->firstOrFail();
    }
}
