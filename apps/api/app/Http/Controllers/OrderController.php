<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use ResourceBundle;

class OrderController extends Controller
{
    public function index()
    {
        return Order::paginate();
    }

    public function store(OrderRequest $request)
    {

        $data = $request->validated();

        $order = Order::create($data);

        return $order;
    }

    public function show(Order $order)
    {
        return $order;
    }

    public function update(OrderRequest $request, Order $order)
    {
        if (!$order) {
            return response()->json(['message' => 'Pedido não encontrado'], 404);
        }
        $order->customer_id = $request->customer_id ?? $order->customer_id;
        $order->total = $request->total ?? $order->total;
        $order->status = $request->status ?? $order->status;
        $order->paid_at = $request->paid_at ?? $order->paid_at;

        $order->save();

        return $order;
    }

    public function destroy(Order $order)
    {
        if (!$order) {
            return response()->json(['message' => 'Pedido não encontrado'], 404);
        }

        $order->delete();

        return response()->json(['message' => 'Pedido excluído'], 200);
    }
}
