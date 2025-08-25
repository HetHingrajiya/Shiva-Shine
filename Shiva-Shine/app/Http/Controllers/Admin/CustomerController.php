<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CustomerController extends Controller
{
    public function index()
    {
        // 🔹 Fake Static Data (30 customers)
        $customers = collect([
            ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com', 'phone' => '+1 555 123 456', 'joined_on' => '2025-01-01'],
            ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com', 'phone' => '+1 555 987 654', 'joined_on' => '2025-01-05'],
            ['id' => 3, 'name' => 'Alice Brown', 'email' => 'alice@example.com', 'phone' => '+1 555 555 555', 'joined_on' => '2025-01-10'],
            ['id' => 4, 'name' => 'Michael Johnson', 'email' => 'michael@example.com', 'phone' => '+1 555 111 222', 'joined_on' => '2025-01-12'],
            ['id' => 5, 'name' => 'Emily Davis', 'email' => 'emily@example.com', 'phone' => '+1 555 333 444', 'joined_on' => '2025-01-13'],
            ['id' => 6, 'name' => 'Daniel Wilson', 'email' => 'daniel@example.com', 'phone' => '+1 555 666 777', 'joined_on' => '2025-01-14'],
            ['id' => 7, 'name' => 'Sophia Taylor', 'email' => 'sophia@example.com', 'phone' => '+1 555 888 999', 'joined_on' => '2025-01-15'],
            ['id' => 8, 'name' => 'James Anderson', 'email' => 'james@example.com', 'phone' => '+1 555 222 333', 'joined_on' => '2025-01-16'],
            ['id' => 9, 'name' => 'Olivia Martinez', 'email' => 'olivia@example.com', 'phone' => '+1 555 444 555', 'joined_on' => '2025-01-17'],
            ['id' => 10, 'name' => 'William Thomas', 'email' => 'william@example.com', 'phone' => '+1 555 777 888', 'joined_on' => '2025-01-18'],
            ['id' => 11, 'name' => 'Ava Garcia', 'email' => 'ava@example.com', 'phone' => '+1 555 999 000', 'joined_on' => '2025-01-19'],
            ['id' => 12, 'name' => 'Ethan Martinez', 'email' => 'ethan@example.com', 'phone' => '+1 555 121 212', 'joined_on' => '2025-01-20'],
            ['id' => 13, 'name' => 'Isabella Lee', 'email' => 'isabella@example.com', 'phone' => '+1 555 343 434', 'joined_on' => '2025-01-21'],
            ['id' => 14, 'name' => 'Mason Harris', 'email' => 'mason@example.com', 'phone' => '+1 555 565 656', 'joined_on' => '2025-01-22'],
            ['id' => 15, 'name' => 'Mia Clark', 'email' => 'mia@example.com', 'phone' => '+1 555 787 878', 'joined_on' => '2025-01-23'],
            ['id' => 16, 'name' => 'Benjamin Lewis', 'email' => 'benjamin@example.com', 'phone' => '+1 555 909 090', 'joined_on' => '2025-01-24'],
            ['id' => 17, 'name' => 'Charlotte Young', 'email' => 'charlotte@example.com', 'phone' => '+1 555 323 232', 'joined_on' => '2025-01-25'],
            ['id' => 18, 'name' => 'Henry Walker', 'email' => 'henry@example.com', 'phone' => '+1 555 454 545', 'joined_on' => '2025-01-26'],
            ['id' => 19, 'name' => 'Amelia King', 'email' => 'amelia@example.com', 'phone' => '+1 555 676 767', 'joined_on' => '2025-01-27'],
            ['id' => 20, 'name' => 'Lucas Scott', 'email' => 'lucas@example.com', 'phone' => '+1 555 898 989', 'joined_on' => '2025-01-28'],
            ['id' => 21, 'name' => 'Harper Green', 'email' => 'harper@example.com', 'phone' => '+1 555 101 202', 'joined_on' => '2025-01-29'],
            ['id' => 22, 'name' => 'Alexander Adams', 'email' => 'alexander@example.com', 'phone' => '+1 555 303 404', 'joined_on' => '2025-01-30'],
            ['id' => 23, 'name' => 'Evelyn Baker', 'email' => 'evelyn@example.com', 'phone' => '+1 555 505 606', 'joined_on' => '2025-01-31'],
            ['id' => 24, 'name' => 'Jack Gonzalez', 'email' => 'jack@example.com', 'phone' => '+1 555 707 808', 'joined_on' => '2025-02-01'],
            ['id' => 25, 'name' => 'Scarlett Perez', 'email' => 'scarlett@example.com', 'phone' => '+1 555 909 111', 'joined_on' => '2025-02-02'],
            ['id' => 26, 'name' => 'Owen Roberts', 'email' => 'owen@example.com', 'phone' => '+1 555 212 313', 'joined_on' => '2025-02-03'],
            ['id' => 27, 'name' => 'Ella Turner', 'email' => 'ella@example.com', 'phone' => '+1 555 414 515', 'joined_on' => '2025-02-04'],
            ['id' => 28, 'name' => 'Sebastian Phillips', 'email' => 'sebastian@example.com', 'phone' => '+1 555 616 717', 'joined_on' => '2025-02-05'],
            ['id' => 29, 'name' => 'Grace Campbell', 'email' => 'grace@example.com', 'phone' => '+1 555 818 919', 'joined_on' => '2025-02-06'],
            ['id' => 30, 'name' => 'Matthew Parker', 'email' => 'matthew@example.com', 'phone' => '+1 555 222 444', 'joined_on' => '2025-02-07'],
        ]);
        // 🔎 Apply search filter
        if ($search = request('search')) {
            $customers = $customers->filter(function ($customer) use ($search) {
                return stripos($customer['name'], $search) !== false
                    || stripos($customer['email'], $search) !== false
                    || stripos($customer['phone'], $search) !== false;
            });
        }

        // 🔹 Manual pagination (12 per page)
        $perPage = 12;
        $currentPage = request()->get('page', 1);
        $pagedData = new LengthAwarePaginator(
            $customers->forPage($currentPage, $perPage),
            $customers->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url()]
        );

        return view('admin.customer', ['customers' => $pagedData]);
    }
}
