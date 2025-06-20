<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // Get some users to associate with orders
        $users = User::take(5)->get();

        if ($users->isEmpty()) {
            $this->command->info('No users found. Please run UserSeeder first.');
            return;
        }

        $orders = [
            [
                'user_id' => $users->random()->id,
                'total_amount' => 299.99,
                'status' => Order::STATUS_COMPLETED,
                'payment_status' => Order::PAYMENT_STATUS_PAID,
                'payment_method' => 'Credit Card',
                'shipping_address' => '123 Main St, New York, NY 10001',
                'shipping_phone' => '+1 (555) 123-4567',
                'notes' => 'Please deliver in the morning',
                'order_details' => [
                    'Product A' => 2,
                    'Product B' => 1,
                ],
            ],
            [
                'user_id' => $users->random()->id,
                'total_amount' => 149.50,
                'status' => Order::STATUS_PROCESSING,
                'payment_status' => Order::PAYMENT_STATUS_PAID,
                'payment_method' => 'PayPal',
                'shipping_address' => '456 Oak Ave, Los Angeles, CA 90001',
                'shipping_phone' => '+1 (555) 987-6543',
                'notes' => 'Gift wrapping requested',
                'order_details' => [
                    'Product C' => 1,
                    'Product D' => 3,
                ],
            ],
            [
                'user_id' => $users->random()->id,
                'total_amount' => 499.99,
                'status' => Order::STATUS_PENDING,
                'payment_status' => Order::PAYMENT_STATUS_PENDING,
                'payment_method' => 'Bank Transfer',
                'shipping_address' => '789 Pine Rd, Chicago, IL 60601',
                'shipping_phone' => '+1 (555) 456-7890',
                'notes' => 'International shipping',
                'order_details' => [
                    'Product E' => 1,
                    'Product F' => 2,
                ],
            ],
            [
                'user_id' => $users->random()->id,
                'total_amount' => 199.99,
                'status' => Order::STATUS_CANCELLED,
                'payment_status' => Order::PAYMENT_STATUS_FAILED,
                'payment_method' => 'Credit Card',
                'shipping_address' => '321 Elm St, Miami, FL 33101',
                'shipping_phone' => '+1 (555) 234-5678',
                'notes' => 'Customer requested cancellation',
                'order_details' => [
                    'Product G' => 1,
                ],
            ],
            [
                'user_id' => $users->random()->id,
                'total_amount' => 399.99,
                'status' => Order::STATUS_COMPLETED,
                'payment_status' => Order::PAYMENT_STATUS_PAID,
                'payment_method' => 'PayPal',
                'shipping_address' => '654 Maple Dr, Seattle, WA 98101',
                'shipping_phone' => '+1 (555) 876-5432',
                'notes' => 'Express shipping requested',
                'order_details' => [
                    'Product H' => 2,
                    'Product I' => 1,
                ],
            ],
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }

        $this->command->info('Orders seeded successfully!');
    }
} 