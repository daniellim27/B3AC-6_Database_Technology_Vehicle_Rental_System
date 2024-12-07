<?php

namespace App\Controllers;

use App\Models\Vehicles;
use App\Models\Rentals;
use App\Models\Customers;

class Dashboard extends BaseController
{
    public function index()
    {
        $vehiclesModel = new Vehicles();
        $rentalsModel = new Rentals();
        $customersModel = new Customers();

        // 1. Available Vehicles
        $availableVehicles = $vehiclesModel->where('status_code', 1)->findAll();

        // 2. Ongoing Rentals Count
        $ongoingRentalsCount = $rentalsModel->where('rental_status_code', 3)->countAllResults();

        // 3. Total Revenue
        $totalRevenue = $rentalsModel->where('rental_status_code', 3)
            ->selectSum('total_rental_cost', 'total_revenue')
            ->first();

        // 4. Top Customers
        $topCustomers = $rentalsModel->select('customers.customer_id, customers.first_name, customers.last_name, SUM(rentals.total_rental_cost) as total_spent')
            ->join('customers', 'rentals.customer_id = customers.customer_id')
            ->where('rentals.rental_status_code', 3)
            ->groupBy('customers.customer_id')
            ->orderBy('total_spent', 'DESC')
            ->limit(5)
            ->find();

        // 5. Popular Vehicles
        $popularVehicles = $rentalsModel->select('vehicles.vehicle_id, vehicles.brand, vehicles.model, COUNT(rentals.rental_id) as total_rentals')
            ->join('vehicles', 'rentals.vehicle_id = vehicles.vehicle_id')
            ->groupBy('vehicles.vehicle_id, vehicles.brand, vehicles.model')
            ->orderBy('total_rentals', 'DESC')
            ->limit(5)
            ->find();

        // 6. Rental Status Distribution
        $rentalStatusDistribution = $rentalsModel->select('rentalstatus.status, COUNT(*) as rental_count')
            ->join('rentalstatus', 'rentals.rental_status_code = rentalstatus.status_code')
            ->groupBy('rentalstatus.status')
            ->find();

        $data = [
            'availableVehicles' => $availableVehicles,
            'ongoingRentalsCount' => $ongoingRentalsCount,
            'totalRevenue' => $totalRevenue->total_revenue ?? 0,
            'topCustomers' => $topCustomers,
            'popularVehicles' => $popularVehicles,
            'rentalStatusDistribution' => $rentalStatusDistribution
        ];

        return view('pages/dashboard/index', $data);
    }
}
