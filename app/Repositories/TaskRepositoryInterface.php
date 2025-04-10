<?php

namespace App\Repositories;

interface TaskRepositoryInterface
{
    public function all($userId);
    public function store(array $data);
    public function update($task, array $data);
    public function delete($task);
}
