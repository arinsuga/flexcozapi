<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\ContractSheetRepositoryInterface;

class ContractSheetController extends Controller
{
    protected $repository;

    public function __construct(ContractSheetRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->middleware('authjwt');
    }

    public function index()
    {
        $contractsheets = $this->repository->all();
        return response()->json(['data' => $contractsheets], 200);
    }

    public function show($id)
    {
        $contractsheet = $this->repository->find($id);
        
        if (!$contractsheet) {
            return response()->json(['error' => 'Contract sheet not found'], 404);
        }

        return response()->json(['data' => $contractsheet], 200);
    }

    public function getByContract($contractId)
    {
        $contractsheets = $this->repository->getContractSheetsByContract($contractId);
        return response()->json(['data' => $contractsheets], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'contract_id' => 'required|exists:contracts,id',
        ]);

        $contractsheet = $this->repository->create($validated);
        return response()->json(['data' => $contractsheet], 201);
    }

    public function update(Request $request, $id)
    {
        $contractsheet = $this->repository->find($id);
        
        if (!$contractsheet) {
            return response()->json(['error' => 'Contract sheet not found'], 404);
        }

        $validated = $request->validate([
            'contract_id' => 'exists:contracts,id',
        ]);

        $updated = $this->repository->update($id, $validated);
        return response()->json(['data' => $updated], 200);
    }

    public function destroy($id)
    {
        $contractsheet = $this->repository->find($id);
        
        if (!$contractsheet) {
            return response()->json(['error' => 'Contract sheet not found'], 404);
        }

        $this->repository->delete($id);
        return response()->json(['message' => 'Contract sheet deleted successfully'], 200);
    }
}
