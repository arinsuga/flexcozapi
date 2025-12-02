<?php

namespace App\Repositories;

use App\SheetGroup;
use App\Repositories\Contracts\SheetGroupRepositoryInterface;
use App\Repositories\Data\EloquentRepository;

class SheetGroupRepository extends EloquentRepository implements SheetGroupRepositoryInterface
{
    public function __construct(SheetGroup $model)
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

    public function getSheetGroupsByType($type)
    {
        return $this->data->where('sheetgroup_type', $type)->get();
    }

    public function getSheetGroupsByActive()
    {
        return $this->data->where('is_active', 1)->orderBy('display_order')->get();
    }

    public function getSheetGroupByCode($code)
    {
        return $this->data->where('sheetgroup_code', $code)->first();
    }
}
