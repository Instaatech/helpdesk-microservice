<?php 
namespace App\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface BaseContract
{
    /**
     * Set the relationships of the query.
     *
     * @param array $with
     * @return BaseContract
     */
    public function with(array $with = []): BaseContract;

    /**
     * Set withoutGlobalScopes attribute to true and apply it to the query.
     *
     * @return BaseContract
     */
    public function withoutGlobalScopes(): BaseContract;

    /**
     * Find a resource by id.
     *
     * @param string $id
     * @return Model
     * @throws ModelNotFoundException
     */
    public function findOneById(int $id): Model;

    /**
     * Find a resource by key value criteria.
     *
     * @param array $criteria
     * @return Model
     * @throws ModelNotFoundException
     */
    public function findOneBy(array $criteria): Model;

    /**
     * Find a resource by key value criteria.
     *
     * @param array $criteria
     * @throws ModelNotFoundException
     */
    public function findOneByAllData(array $criteria);


    /**
     * Search All resources by spatie query builder.
     *
     * @return LengthAwarePaginator
     */
    public function findByFilters(): LengthAwarePaginator;

    /**
     * Save a resource.
     *
     * @param array $data
     * @return Model
     */
    public function store(array $data): Model;

    /**
     * Update a resource.
     *
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function update(Model $model,int $id, array $data);

    /**
     * create if not exist a resource.
     *
     * @param array $data
     * @return Model
     */
    public function firstOrCreate(array $data): Model;

    /**
     * Update a resource.
     *
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function trashed(Model $model, array $data);

    public function findAll();




}