<?php

namespace App\Repositories\Contracts;

use App\Repositories\Data\DataRepositoryInterface;

interface WorksheetRepositoryInterface extends DataRepositoryInterface
{
    function getWorksheetsByProject($projectId);
    function getWorksheetsBySheetGroup($sheetGroupId);
    function getWorksheetsByVendor($vendorId);
}
