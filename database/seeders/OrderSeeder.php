<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Book;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'user')->take(3)->get();
        $books = Book::take(5)->get();

        if ($users->isEmpty() || $books->isEmpty()) {
            return;
        }

        // Créer quelques commandes d'exemple
        $orders = [
            [
                'user_id' => $users->first()->id,
                'status' => 'pending',
                'payment_status' => 'pending',
                'total_amount' => 45.90,
                'shipping_cost' => 5.90,
                'shipping_address' => '123 Rue de la Paix',
                'shipping_city' => 'Paris',
                'shipping_postal_code' => '75001',
                'shipping_country' => 'France',
                'shipping_phone' => '+33 6 12 34 56 78',
                'items' => [
                    ['book_id' => $books->first()->id, 'quantity' => 1, 'unit_price' => 25.00],
                    ['book_id' => $books->get(1)->id, 'quantity' => 2, 'unit_price' => 15.00],
                ]
            ],
            [
                'user_id' => $users->get(1)->id ?? $users->first()->id,
                'status' => 'shipped',
                'payment_status' => 'paid',
                'total_amount' => 32.50,
                'shipping_cost' => 5.90,
                'shipping_address' => '456 Avenue des Champs',
                'shipping_city' => 'Lyon',
                'shipping_postal_code' => '69001',
                'shipping_country' => 'France',
                'shipping_phone' => '+33 6 98 76 54 32',
                'shipped_at' => now()->subDays(2),
                'items' => [
                    ['book_id' => $books->get(2)->id, 'quantity' => 1, 'unit_price' => 32.50],
                ]
            ],
            [
                'user_id' => $users->get(2)->id ?? $users->first()->id,
                'status' => 'delivered',
                'payment_status' => 'paid',
                'total_amount' => 78.20,
                'shipping_cost' => 0.00,
                'shipping_address' => '789 Boulevard Central',
                'shipping_city' => 'Marseille',
                'shipping_postal_code' => '13001',
                'shipping_country' => 'France',
                'shipping_phone' => '+33 6 11 22 33 44',
                'shipped_at' => now()->subDays(5),
                'delivered_at' => now()->subDays(3),
                'items' => [
                    ['book_id' => $books->get(3)->id, 'quantity' => 2, 'unit_price' => 25.00],
                    ['book_id' => $books->get(4)->id, 'quantity' => 1, 'unit_price' => 28.20],
                ]
            ]
        ];

        foreach ($orders as $orderData) {
            $items = $orderData['items'];
            unset($orderData['items']);

            $order = Order::create($orderData);

            foreach ($items as $itemData) {
                $itemData['order_id'] = $order->id;
                $itemData['total_price'] = $itemData['quantity'] * $itemData['unit_price'];
                OrderItem::create($itemData);
            }
        }
    }
}
