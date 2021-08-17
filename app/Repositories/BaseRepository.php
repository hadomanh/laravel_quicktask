<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    /**
     * Eloquent model
     */
    protected $model;

    /**
     * @param $model
     */
    function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Get all record
     */
    public function all($columns = array('*'))
    {
        return $this->model->all($columns);
    }

    /**
     * Get all record, return empty array if there's no record
     */
    public function allOrEmpty($columns = array('*'))
    {
        $data = $this->model->all($columns);
        $data = $data->isNotEmpty() ? $data->toArray() : [];

        return $data;
    }

    /**
     * Paginate
     */
    public function paginate($per = 10)
    {
        return $this->model->orderBy('created_at', 'desc')->paginate($per);
    }

    /**
     * Retrieves all of the values for a given key as key-value array
     */
    public function pluck($column, $key = null, $sortColumn = null, $direction = 'asc')
    {
        return $this->model->orderBy($sortColumn, $direction)->pluck($column, $key);
    }

    /**
     * Retrieve record by given ID
     */
    public function findById($id, $columns = array('*'))
    {
        return $this->model->find($id, $columns);
    }

    /**
     * Insert record to table
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * Update record by given ID
     */
    public function update($data, $id, $withTrashed = false)
    {
        $obj = $withTrashed ? $this->model->withTrashed()->findOrFail($id) : $this->model->findOrFail($id);
        return $obj->update($data);
    }

    /**
     * Update specify columns of record by given ID
     */
    public function updateColumn($id, $columns, $data)
    {
        return $this->model->where(['id' => $id])->update([$columns => $data]);
    }

    /**
     * Delete record by given ID
     */
    public function destroy($id)
    {
        $obj = $this->model->findOrFail($id);
        return $obj->delete();
    }

    /**
     * Find with condition and retrieve first result
     */
    public function findBy($key, $value, $withTrashed = false)
    {
        return !$withTrashed ? $this->model->where($key, $value)->first() : $this->model->where($key, $value)->withTrashed()->first();
    }

    /**
     * Find with condition
     */
    public function findAllBy($key, $value, $columns = '*', $isPaginate = false, $per = 10)
    {
        $query = $this->model->where($key, $value)->select($columns)->orderBy('id', 'desc');

        return !$isPaginate ? $query->get() : $query->paginate($per);
    }

    /**
     * Find with selected value
     */
    public function findAllWhereIn($key, $values, $columns = '*', $isPaginate = false, $per = 10)
    {
        $query = $this->model->whereIn($key, $values)->select($columns)->orderBy('id', 'desc');

        return !$isPaginate ? $query->get() : $query->paginate($per);
    }

    /**
     * Delete with condition
     */
    public function destroyByConditions($conditions)
    {
        $query = $this->model;

        foreach ($conditions as $key => $value) {
            $query = $query->where($key, $value);
        }

        $obj = $query->first();

        return $obj ? $obj->delete() : false;
    }

    public function restore($id)
    {
        $obj = $this->model->withTrashed()->findOrFail($id);
        return $obj->restore();
    }

    /**
     * Check if any record with given condition exists
     */
    public function exists($key, $value, $withTrashed = false)
    {
        return !$withTrashed ? $this->model->where($key, $value)->exists() : $this->model->where($key, $value)->withTrashed()->exists();
    }

    /**
     * Create new record or update if
     */
    public function store(array $data, $id = null)
    {
        if (!$id) {
            return $this->create($data)->id;
        }
        $this->update($data, $id);
        return $id;
    }

    /**
     * Update record with IN condition
     */
    public function updateWhereIn($key, array $values, $updateData)
    {
        return $this->model->whereIn($key, $values)->update($updateData);
    }

    /**
     * Insert and return record ID
     */
    public function insertGetId($data)
    {
        return $this->model->insertGetId($data);
    }

    /**
     * Insert record
     */
    public function insert($data)
    {
        return $this->model->insert($data);
    }

    /**
     * Find by condition
     */
    public function findByConditions($conditions = [])
    {
        $query = $this->model;

        foreach ($conditions as $key => $value) {
            $query = $query->where($key, $value);
        }

        $obj = $query->first();

        return $obj;
    }
}
