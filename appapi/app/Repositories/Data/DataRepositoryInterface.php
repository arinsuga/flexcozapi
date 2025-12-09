<?php

namespace App\Repositories\Data;

interface DataRepositoryInterface
{
    function all();
    function first();
    function find($parId);
    function create($parData);
    function update($id, $data);
    function delete($parId);

}