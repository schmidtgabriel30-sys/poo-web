<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;

class CustomerController extends Controller
{
    public function index()
    {
        return Customer::paginate();
    }

    public function store(CustomerStoreRequest $request)
    {
        return Customer::create($request->validated());
    }

    public function show(string $id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        return $customer;
    }

    public function update(CustomerUpdateRequest $request, string $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update($request->validated());
        return $customer;
    }

    public function destroy(string $id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        $customer->delete();

        return response()->json(['message' => 'Cliente excluído'], 204);
    }
}