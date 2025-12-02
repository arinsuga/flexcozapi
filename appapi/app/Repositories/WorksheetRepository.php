<?php

namespace App\Repositories;

use App\Worksheet;
use App\Repositories\Contracts\WorksheetRepositoryInterface;
use App\Repositories\Data\EloquentRepository;

class WorksheetRepository extends EloquentRepository implements WorksheetRepositoryInterface
{
    protected $worksheet;


    public function getWorksheetsByProject($projectId)
    {
        return $this->data->where('project_id', $projectId)->get();
    }

    public function getWorksheetsBySheetGroup($sheetGroupId)
    {
        return $this->data->where('sheetgroup_id', $sheetGroupId)->get();
    }

    public function getWorksheetsByVendor($vendorId)
    {
        return $this->data->where('vendor_id', $vendorId)->get();
    }
}
