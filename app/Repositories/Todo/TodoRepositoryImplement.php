<?php
namespace App\Repositories\Todo;

use App\Repositories\BaseRepository;
use App\Models\Todo;

class TodoRepositoryImplement extends BaseRepository implements TodoRepository
{
    public function __construct(Todo $model)
    {
        parent::__construct($model);
    }
}
