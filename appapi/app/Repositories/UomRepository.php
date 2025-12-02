<?php

namespace App\Repositories;

use App\Uom;
use App\Repositories\Contracts\UomRepositoryInterface;
use App\Repositories\Data\EloquentRepository;

class UomRepository extends EloquentRepository implements UomRepositoryInterface
{
    public function __construct(Uom $model)
    {
        $this->data = $model;
    }

    public function all()
    {
        return $this->data->all();
    }

    public function find($id)
    {
        return $this->data->find($id);
    }

    public function create(array $data)
    {
        return $this->data->create($data);
    }

    public function update($id, array $data)
    {
        $model = $this->data->find($id);
        if ($model) {
            $model->update($data);
            return $model;
        }
        return null;
    }

    public function delete($id)
    {
        return $this->data->destroy($id);
    }

    public function getUomsByActive()
    {
        return $this->data->where('is_active', 1)->orderBy('display_order')->get();
    }

    public function getUomByCode($code)
    {
        return $this->data->where('uom_code', $code)->first();
    }
}
