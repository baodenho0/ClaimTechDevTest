<?php

namespace App\Modules\Claim\Repositories;

use App\Modules\Claim\Models\Claim;
use App\Http\Repositories\BaseRepository;

class ClaimRepository extends BaseRepository implements ClaimRepositoryInterface
{
    public function __construct(Claim $model)
    {
        parent::__construct($model);
    }

    public function getByUserId($userId)
    {
        return $this->model->where('user_id', $userId)->get();
    }
}
