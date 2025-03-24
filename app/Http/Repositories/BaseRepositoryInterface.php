<?php

namespace App\Http\Repositories;

interface BaseRepositoryInterface
{
    public function create(array $data);
    public function find($id);
    public function update($id, array $data);
}
