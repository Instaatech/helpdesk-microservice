<?php

namespace App\Repositories;

use App\Contracts\BaseContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;
use Ramsey\Uuid\Uuid;

abstract class BaseRepository implements BaseContract
{
    protected Model $model;

    protected bool $withoutGlobalScopes = false;

    protected array $with = [];

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    //Get All Data
    public function findAll()
    {
        return $this->model->all();
    }



    /**
     * {@inheritdoc}
     */
    public function with(array $with = []): BaseRepository
    {
        $this->with = $with;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withoutGlobalScopes(): BaseRepository
    {
        $this->withoutGlobalScopes = true;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function store(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * {@inheritdoc}
     */
    public function trashed(Model $model, array $data)
    {
        return $model->where($data)->delete();
    }

    /**
     * {@inheritdoc}
     */
    public function firstOrCreate(array $data): Model
    {
        return $this->model->firstOrCreate($data);
    }

    /**
     * {@inheritdoc}
     */
    public function update(Model $model, int $id, array $data)
    {
        // return tap($model)->update($data);
        return $this->model->find($id)->update($data);
    }

    /**
     * {@inheritdoc}
     */
    public function findByFilters(): LengthAwarePaginator
    {
        return $this->model->with($this->with)->paginate();
    }

    /**
     * {@inheritdoc}
     */
    public function findOneById(int $id): Model
    {

        if (!empty($this->with) || auth()->check()) {
            return $this->findOneBy(['id' => $id]);
        }

        return $this->model->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function findOneBy(array $criteria): Model
    {
        if (!$this->withoutGlobalScopes) {
            return $this->model->with($this->with)
                ->where($criteria)
                ->orderByDesc('created_at')
                ->firstOrFail();
        }

        return $this->model->with($this->with)
            ->withoutGlobalScopes()
            ->where($criteria)
            ->orderByDesc('created_at')
            ->firstOrFail();
    }

    /**
     * {@inheritdoc}
     */
    public function findOneByAllData(array $criteria)
    {

        if (!$this->withoutGlobalScopes) {
            return $this->model->with($this->with)
                ->where($criteria)
                ->orderByDesc('created_at')
                ->paginate();
        }

        return $this->model->with($this->with)
            ->withoutGlobalScopes()
            ->where($criteria)
            ->orderByDesc('created_at')
            ->paginate();
    }

    public function findBySearch(array $criteria)
    {
        if (!$this->withoutGlobalScopes) {
            return $this->model->with($this->with)
                ->where($criteria['attr'], 'LIKE', '%' . $criteria['query'] . '%')
                ->orderByDesc('created_at')
                ->paginate()
                ->withQueryString();
        }

        return $this->model->with($this->with)
            ->withoutGlobalScopes()
            ->where($criteria)
            ->orderByDesc('created_at')
            ->paginate()
            ->withQueryString();
    }

    // public function findByOptionalFilter(array $criteria=[])
    // {

    // }
}
