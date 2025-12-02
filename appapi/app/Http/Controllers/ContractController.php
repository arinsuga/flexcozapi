<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\ContractRepositoryInterface;

class ContractController extends Controller
{
    protected $repository;

    public function __construct(ContractRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->middleware('authjwt');
    }

    public function index()
    {
        $contracts = $this->repository->getContractsByActive();
        return response()->json(['data' => $contracts], 200);
    }

    public function show($id)
    {
        $contract = $this->repository->find($id);
        
        if (!$contract) {
            return response()->json(['error' => 'Contract not found'], 404);
        }

        return response()->json(['data' => $contract], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'contract_code' => 'required|unique:contracts,contract_code',
            'contract_name' => 'required|string',
            'is_active' => 'boolean',
        ]);

        $contract = $this->repository->create($validated);
        return response()->json(['data' => $contract], 201);
    }

    public function update(Request $request, $id)
    {
        $contract = $this->repository->find($id);
        
        if (!$contract) {
            return response()->json(['error' => 'Contract not found'], 404);
        }

        $validated = $request->validate([
            'contract_code' => 'unique:contracts,contract_code,' . $id,
            'contract_name' => 'string',
            'is_active' => 'boolean',
        ]);

        $updated = $this->repository->update($id, $validated);
        return response()->json(['data' => $updated], 200);
    }

    public function destroy($id)
    {
        $contract = $this->repository->find($id);
        
        if (!$contract) {
            return response()->json(['error' => 'Contract not found'], 404);
        }

        $this->repository->delete($id);
        return response()->json(['message' => 'Contract deleted successfully'], 200);
    }
}
