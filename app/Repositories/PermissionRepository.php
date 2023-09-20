<?php


namespace App\Repositories;


use App\Interfaces\PermissionInterface;
use Illuminate\Database\Eloquent\Model;

class PermissionRepository extends BaseRepository implements PermissionInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
