<?php

namespace App\Repositories;

use App\Vendor;
use App\Repositories\Contracts\VendorRepositoryInterface;
use App\Repositories\Data\EloquentRepository;

class VendorRepository extends EloquentRepository implements VendorRepositoryInterface
{
    public function __construct(Vendor $model)
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

    public function getVendorsByType($vendorTypeId)
    {
        return $this->data->where('vendortype_id', $vendorTypeId)->get();
    }

    public function getVendorsByActive()
    {
        return $this->data->where('is_active', 1)->get();
    }

    public function getVendorByCode($code)
    {
        return $this->data->where('vendor_code', $code)->first();
    }
}
