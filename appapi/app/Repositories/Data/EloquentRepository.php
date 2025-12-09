<?php

namespace App\Repositories\Data;

//use App\User;

abstract class EloquentRepository implements DataRepositoryInterface
{
    protected $data, $data1;

    public function __construct($parData, $parData1 = null)
    {
        $this->data = $parData;
        $this->data1 = $parData1;
    }

    public function all()
    {
        return $this->data->all();
    }

    public function first()
    {
        //TODO: Need to be tested
        return $this->data->all()->first();
    }

    public function find($parId)
    {
        //TODO: Need to be tested
        return $this->data->find($parId);
    }

    public function create($parData)
    {
        //TODO Code create data here
        return ["TODO" => "Customize create data in current repository"];
    }

    function update($id, $data)
    {
        //TODO Code update data here
        return ["TODO" => "Customize update data in current repository"];

    }

    function delete($parId)
    {
        //TODO Code delete data here
        return ["TODO" => "Customize delete data in current repository"];
    }

}