<?php

namespace App\Repositories;

interface RepositoryInterface
{
    
    /**
     * Get all record
     */
    public function all($columns = array('*'));

    /**
     * Get all record, return empty array if there's no record
     */
    public function allOrEmpty($columns = array('*'));

    /**
     * Paginate
     */
    public function paginate($per = 10);

    /**
     * Retrieves all of the values for a given key as key-value array
     */
    public function pluck($column, $key = null, $sortColumn = null, $direction = 'asc');
    
    /**
     * Retrieve record by given ID
     */
    public function findById($id, $columns = array('*'));

    /**
     * Insert record to table
     */
    public function create($data);

    /**
     * Update record by given ID
     */
    public function update($data, $id, $withTrashed = false);

    /**
     * Update specify columns of record by given ID
     */
    public function updateColumn($id, $columns, $data);

    /**
     * Delete record by given ID
     */
    public function destroy($id);

    /**
     * Find with condition and retrieve first result
     */
    public function findBy($key, $value, $withTrashed = false);

    /**
     * Find with condition
     */
    public function findAllBy($key, $value, $columns = '*', $isPaginate = false, $per = 10);

    /**
     * Find with selected value
     */
    public function findAllWhereIn($key, $values, $columns = '*', $isPaginate = false, $per = 10);

    /**
     * Delete with condition
     */
    public function destroyByConditions($conditions);

    public function restore($id);

    /**
     * Check if any record with given condition exists
     */
    public function exists($key, $value, $withTrashed = false);

    /**
     * Create new record or update if
     */
    public function store(array $data, $id = null);

    /**
     * Update record with IN condition
     */
    public function updateWhereIn($key, array $values, $updateData);

    /**
     * Insert and return record ID
     */
    public function insertGetId($data);
    /**
     * Insert record
     */
    public function insert($data);

    /**
     * Find by condition
     */
    public function findByConditions($conditions = []);
}
