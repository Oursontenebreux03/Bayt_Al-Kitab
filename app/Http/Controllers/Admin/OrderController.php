<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Accès réservé à l\'administration.');
        }
    }

    public function index()
    {
        $orders = Order::with(['user', 'items.book'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'items.book'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'status' => $request->status,
            'shipped_at' => $request->status === 'shipped' ? now() : null,
            'delivered_at' => $request->status === 'delivered' ? now() : null,
        ]);

        session()->flash('success', 'Statut de la commande mis à jour avec succès !');

        return redirect()->route('admin.orders.show', $id);
    }
} 