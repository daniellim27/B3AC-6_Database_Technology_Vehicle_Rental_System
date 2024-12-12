<?php

namespace App\Models;

use CodeIgniter\Model;

class Rentals extends Model
{
    protected $table = 'rentals';
    protected $primaryKey = 'rental_id';
    protected $useAutoIncrement = false;
    protected $returnType = 'object';
    protected $allowedFields = [
        'rental_id',
        'customer_id',
        'vehicle_id',
        'employee_id',
        'rental_status_code',
        'rental_date',
        'return_date',
        'total_rental_cost'
    ];

    // Validation rules
    protected $validationRules = [
        'rental_id' => 'required|numeric|min_length[4]|is_unique[rentals.rental_id]|greater_than_equal_to[4001]',
        'customer_id' => 'required|numeric',
        'vehicle_id' => 'required|numeric',
        'employee_id' => 'required|numeric',
        'rental_status_code' => 'required|numeric',
        'rental_date' => 'required|valid_date',
        'return_date' => 'permit_empty|valid_date|callback_validateReturnDate[rental_date]',
        'total_rental_cost' => 'permit_empty|numeric'
    ];

    protected $validationMessages = [
        'rental_id' => [
            'required' => 'Rental ID is required',
            'numeric' => 'Rental ID must be numeric',
            'min_length' => 'Rental ID must be at least 4 digits',
            'is_unique' => 'Rental ID must be unique',
            'greater_than_equal_to' => 'Rental ID must be greater than or equal to 4001'
        ],
        'customer_id' => [
            'required' => 'Customer is required',
            'numeric' => 'Invalid customer selected',
            'exists' => 'Selected customer does not exist'
        ],
        'vehicle_id' => [
            'required' => 'Vehicle is required',
            'numeric' => 'Invalid vehicle selected',
            'exists' => 'Selected vehicle does not exist'
        ],
        'employee_id' => [
            'required' => 'Employee is required',
            'numeric' => 'Invalid employee selected',
            'exists' => 'Selected employee does not exist'
        ],
        'rental_status_code' => [
            'required' => 'Rental status is required',
            'numeric' => 'Invalid rental status selected',
            'exists' => 'Selected rental status does not exist'
        ],
        'rental_date' => [
            'required' => 'Rental date is required',
            'valid_date' => 'Invalid rental date'
        ],
        'return_date' => [
            'valid_date' => 'Invalid return date',
            'validateReturnDate' => 'The return date must be greater than the rental date.'
        ],
        'total_rental_cost' => [
            'numeric' => 'Total rental cost must be numeric'
        ]
    ];

    // Custom validation method to check return date
    public function validateReturnDate(string $returnDate, string $rentalDateField, array $data): bool
    {
        if (empty($returnDate)) {
            return true; // Return date is not mandatory, so skip validation if empty
        }

        $rentalDate = $data[$rentalDateField] ?? null;

        if (!$rentalDate || strtotime($returnDate) > strtotime($rentalDate)) {
            return true;
        }

        return false;
    }

    // Get rental with related data
    public function getRental($id = null)
    {
        $this->select('rentals.*, 
            customers.first_name as customer_first_name, 
            customers.last_name as customer_last_name,
            vehicles.brand as vehicle_brand,
            vehicles.model as vehicle_model,
            employees.first_name as employee_first_name,
            employees.last_name as employee_last_name,
            rentalstatus.status as rental_status_name');
        $this->join('customers', 'customers.customer_id = rentals.customer_id', 'left');
        $this->join('vehicles', 'vehicles.vehicle_id = rentals.vehicle_id', 'left');
        $this->join('employees', 'employees.employee_id = rentals.employee_id', 'left');
        $this->join('rentalstatus', 'rentalstatus.status_code = rentals.rental_status_code', 'left');
        
        if ($id !== null) {
            return $this->find($id);
        }
        
        return $this->findAll();
    }

    // Get customers for dropdown
    public function getCustomers()
    {
        $customerModel = new \App\Models\Customers();
        $customers = $customerModel->findAll();
        $customerArray = [];
        foreach ($customers as $customer) {
            $customerArray[$customer->customer_id] = $customer->first_name . ' ' . $customer->last_name;
        }
        return $customerArray;
    }

    // Get vehicles for dropdown
    public function getVehicles()
    {
        $vehicleModel = new \App\Models\Vehicles();
        $vehicles = $vehicleModel->findAll();
        $vehicleArray = [];
        foreach ($vehicles as $vehicle) {
            $vehicleArray[$vehicle->vehicle_id] = $vehicle->brand . ' ' . $vehicle->model . ' (' . $vehicle->license_plate_number . ')';
        }
        return $vehicleArray;
    }

    // Get employees for dropdown
    public function getEmployees()
    {
        $employeeModel = new \App\Models\Employees();
        $employees = $employeeModel->findAll();
        $employeeArray = [];
        foreach ($employees as $employee) {
            $employeeArray[$employee->employee_id] = $employee->first_name . ' ' . $employee->last_name;
        }
        return $employeeArray;
    }

    // Get rental statuses for dropdown
    public function getRentalStatuses()
    {
        $db = \Config\Database::connect();
        $statuses = $db->table('rentalstatus')->get()->getResult();
        $statusArray = [];
        foreach ($statuses as $status) {
            $statusArray[$status->status_code] = $status->status;
        }
        return $statusArray;
    }
}
