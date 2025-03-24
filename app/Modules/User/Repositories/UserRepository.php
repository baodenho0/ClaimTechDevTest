<?php

namespace App\Modules\User\Repositories;

use App\Modules\User\Models\User;
use App\Http\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

}
