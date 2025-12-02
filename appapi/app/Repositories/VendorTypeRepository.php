<?php

namespace App\Repositories;

use App\VendorType;
use App\Repositories\Contracts\VendorTypeRepositoryInterface;
use App\Repositories\Data\EloquentRepository;

class VendorTypeRepository extends EloquentRepository implements VendorTypeRepositoryInterface
{
    public function __construct(VendorType $model)
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

    public function getVendorTypesByActive()
    {
        return $this->data->where('is_active', 1)->orderBy('display_order')->get();
    }

    public function getVendorTypeByCode($code)
    {
        return $this->data->where('vendortype_code', $code)->first();
    }
}
