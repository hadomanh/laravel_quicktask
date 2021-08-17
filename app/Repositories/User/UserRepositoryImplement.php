<?php
namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use App\Models\User;

class UserRepositoryImplement extends BaseRepository implements UserRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
