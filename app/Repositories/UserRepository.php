<?php


namespace App\Repositories;


use App\Interfaces\UserInterface;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository implements UserInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
