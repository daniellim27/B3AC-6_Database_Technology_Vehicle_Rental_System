<?php

namespace App\Models;

use CodeIgniter\Model;

class Payments extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'payment_id';
    protected $useAutoIncrement = false;
    protected $allowedFields = ['payment_id', 'rental_id', 'payment_date', 'payment_amount', 'payment_method'];
    protected $returnType = 'object';

    protected $validationRules = [
        'payment_id' => 'required|numeric|greater_than_equal_to[5001]|is_unique[payments.payment_id]',
        'rental_id' => 'required|numeric|is_not_unique[rentals.rental_id]',
        'payment_date' => 'required|valid_date',
        'payment_amount' => 'required|numeric|greater_than[0]',
        'payment_method' => 'required|string|max_length[35]'
    ];

    protected $validationMessages = [
        'payment_id' => [
            'required' => 'Payment ID is required',
            'numeric' => 'Payment ID must be a number',
            'greater_than_equal_to' => 'Payment ID must be greater than or equal to 5001',
            'is_unique' => 'Payment ID must be unique'
        ],
        'rental_id' => [
            'required' => 'Rental ID is required',
            'numeric' => 'Rental ID must be a number',
            'is_not_unique' => 'Selected rental does not exist'
        ],
        'payment_date' => [
            'required' => 'Payment date is required',
            'valid_date' => 'Please enter a valid date'
        ],
        'payment_amount' => [
            'required' => 'Payment amount is required',
            'numeric' => 'Payment amount must be a number',
            'greater_than' => 'Payment amount must be greater than 0'
        ],
        'payment_method' => [
            'required' => 'Payment method is required',
            'string' => 'Payment method must be text',
            'max_length' => 'Payment method cannot exceed 35 characters'
        ]
    ];

    public function getPayment($id = null)
    {
        if ($id === null) {
            return $this->select('payments.*, rentals.rental_id, concat(customers.first_name, customers.last_name) as customer_name, vehicles.brand as vehicle_brand, vehicles.model as vehicle_model')
                       ->join('rentals', 'rentals.rental_id = payments.rental_id')
                       ->join('customers', 'customers.customer_id = rentals.customer_id')
                       ->join('vehicles', 'vehicles.vehicle_id = rentals.vehicle_id')
                       ->findAll();
        }

        return $this->select('payments.*, rentals.rental_id, concat(customers.first_name, customers.last_name) as customer_name, vehicles.brand as vehicle_brand, vehicles.model as vehicle_model')
                   ->join('rentals', 'rentals.rental_id = payments.rental_id')
                   ->join('customers', 'customers.customer_id = rentals.customer_id')
                   ->join('vehicles', 'vehicles.vehicle_id = rentals.vehicle_id')
                   ->where('payments.payment_id', $id)
                   ->first();
    }

    public function getRentals()
    {
        $rentalsModel = new \App\Models\Rentals();
        $rentals = $rentalsModel->select('rentals.rental_id, concat(customers.first_name, customers.last_name) as customer_name, vehicles.brand as vehicle_brand, vehicles.model as vehicle_model')
                               ->join('customers', 'customers.customer_id = rentals.customer_id')
                               ->join('vehicles', 'vehicles.vehicle_id = rentals.vehicle_id')
                               ->findAll();

        $options = [];
        foreach ($rentals as $rental) {
            $options[$rental->rental_id] = "Rental #" . $rental->rental_id . " - " . 
                                         $rental->customer_name . " (" . 
                                         $rental->vehicle_brand . " " . 
                                         $rental->vehicle_model . ")";
        }

        return $options;
    }
}
