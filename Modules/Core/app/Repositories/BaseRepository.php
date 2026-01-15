<?php

namespace Modules\Core\Repositories;

use Modules\Core\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

abstract class BaseRepository implements RepositoryInterface
{
    protected Model $model;
    protected Builder $query;

    public function __construct()
    {
        $this->model = $this->makeModel();
        $this->query = $this->model->newQuery();
    }

    /**
     * Make model instance
     */
    abstract protected function makeModel(): Model;

    public function all(array $columns = ['*']): Collection
    {
        return $this->query->get($columns);
    }

    public function find(int $id): ?Model
    {
        return $this->query->find($id);
    }

    public function findBy(string $column, mixed $value): ?Model
    {
        return $this->query->where($column, $value)->first();
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $model = $this->find($id);
        if (!$model) {
            return false;
        }
        return $model->update($data);
    }

    public function delete(int $id): bool
    {
        $model = $this->find($id);
        if (!$model) {
            return false;
        }
        return $model->delete();
    }

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->query->paginate($perPage);
    }

    public function where(array $conditions): Collection
    {
        return $this->query->where($conditions)->get();
    }

    public function with(array $relations): self
    {
        $this->query = $this->query->with($relations);
        return $this;
    }

    public function orderBy(string $column, string $direction = 'asc'): self
    {
        $this->query = $this->query->orderBy($column, $direction);
        return $this;
    }

    /**
     * Reset query builder
     */
    protected function resetQuery(): void
    {
        $this->query = $this->model->newQuery();
    }
}
