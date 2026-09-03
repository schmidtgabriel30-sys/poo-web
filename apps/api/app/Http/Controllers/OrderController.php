<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;

class OrderController extends Controller
{
    public function index()
    {
        return Order::paginate();
    }

    public function store(OrderStoreRequest $request)
    {
        return Order::create($request->validated());
    }

    public function show(string $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Pedido não encontrado'], 404);
        }

        return $order;
    }

    public function update(OrderUpdateRequest $request, string $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->validated());
        return $order;
    }

    public function destroy(string $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Pedido não encontrado'], 404);
        }

        $order->delete();

        return response()->json(['message' => 'Pedido excluído'], 204);
    }
}