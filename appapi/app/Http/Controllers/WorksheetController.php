<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\WorksheetRepositoryInterface;

class WorksheetController extends Controller
{
    protected $repository;

    public function __construct(WorksheetRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->middleware('authjwt');
    }

    public function index()
    {
        $worksheets = $this->repository->all();
        return response()->json(['data' => $worksheets], 200);
    }

    public function show($id)
    {
        $worksheet = $this->repository->find($id);
        
        if (!$worksheet) {
            return response()->json(['error' => 'Worksheet not found'], 404);
        }

        return response()->json(['data' => $worksheet], 200);
    }

    public function getByProject($projectId)
    {
        $worksheets = $this->repository->getWorksheetsByProject($projectId);
        return response()->json(['data' => $worksheets], 200);
    }

    public function getBySheetGroup($sheetGroupId)
    {
        $worksheets = $this->repository->getWorksheetsBySheetGroup($sheetGroupId);
        return response()->json(['data' => $worksheets], 200);
    }

    public function getByVendor($vendorId)
    {
        $worksheets = $this->repository->getWorksheetsByVendor($vendorId);
        return response()->json(['data' => $worksheets], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sheet_code' => 'required|unique:worksheets,sheet_code',
            'sheet_type' => 'integer|in:0,1',
            'project_id' => 'required|exists:projects,id',
            'sheetgroup_id' => 'required|exists:sheetgroups,id',
        ]);

        $worksheet = $this->repository->create($validated);
        return response()->json(['data' => $worksheet], 201);
    }

    public function update(Request $request, $id)
    {
        $worksheet = $this->repository->find($id);
        
        if (!$worksheet) {
            return response()->json(['error' => 'Worksheet not found'], 404);
        }

        $validated = $request->validate([
            'sheet_code' => 'unique:worksheets,sheet_code,' . $id,
            'sheet_type' => 'integer|in:0,1',
        ]);

        $updated = $this->repository->update($id, $validated);
        return response()->json(['data' => $updated], 200);
    }

    public function destroy($id)
    {
        $worksheet = $this->repository->find($id);
        
        if (!$worksheet) {
            return response()->json(['error' => 'Worksheet not found'], 404);
        }

        $this->repository->delete($id);
        return response()->json(['message' => 'Worksheet deleted successfully'], 200);
    }
}
