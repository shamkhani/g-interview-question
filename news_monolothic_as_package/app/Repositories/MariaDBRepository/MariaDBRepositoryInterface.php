<?php

namespace App\Repositories;

use App\Models\MariaDBModel as Model;

/**
 * Interface MariaDBRepositoryInterface. All the repositories should implement this interface.
 *
 * @author  Mostafa Shamkhani
 */
interface MariaDBRepositoryInterface
{
    /**
     * Returns the model which fetched by id.
     *
     * @param $id
     * @return Model
     */
    public function getModelById($id);

    /**
     * Insert new row to database, create its model object and return the inserted model.
     *
     * @param   array $data The data array holds the attributes and their values.
     * @return Model
     */
    public function create($data) : Model;

    /**
     * @param \Illuminate\Database\Eloquent\Model
     * @return Model
     */
    public function update($model) : bool;
    /**
     * @param $data
     * @param $id
     * @return Model
     */
    public function updateById($data, $id) : Model ;

    /**
     * Removes entity from database by passing model.
     *
     * @param   Model $model The model that should remove.
     * @return bool|null
     */
    public function removeByModel(Model $model);

    /**
     * Removes entity from database by passing id.
     *
     * @param   int $id The unique model ID.
     * @return bool
     */
    public function removeById($id);

    /**
     * Removes entity from database by passing constraint array.
     *
     * @param   array $constraints Constraints array should be something like: [ ['column1_name', '=', 'value'] ]
     * @return int
     */
    public function remove($constraints);


    /**
     * Removes all entity from database.
     * @param
     * @return int
     */
    public function removeAll();


    /**
     * @param $constraints
     * @param bool $findOne
     * @param array $relations
     * @param array $columns
     * @param int $limit
     * @return bool|null
     */
    public function find($constraints, $findOne = true, $relations = [], $limit = 10, $columns = []);
    /**
     * Get all rows using pagination.
     * Note: Currently we use Eloquent ORM which gets the page number directly from the request.
     *
     * @param   null|int $items The numbers of item that needs to be fetched.
     * @param array $columns
     * @return mixed
     */
    public function getAll($items = 0, $columns = []);

    /**
     * Return the count of all records in this model.
     *
     * @return int
     */
    public function countAll();

    /**
     * @param $model
     * @return mixed
     */
    public function putModelInCache($model);

    /**
     * @param $modelId
     * @return mixed
     */
    public function removeModelFromCache($modelId);


    /**
     * Insert new rows to database.
     *
     * @param $data
     */
    public function bulkCreate($data);


    /**
     * @param array $data
     * @return mixed
     */
    public function firstOrCreate(array $data);
}
