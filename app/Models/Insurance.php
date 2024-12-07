<?php

namespace App\Models;

use CodeIgniter\Model;

class Insurance extends Model
{
    protected $table = 'insurance';
    protected $primaryKey = 'insurance_id';
    protected $useAutoIncrement = false;
    protected $allowedFields = ['insurance_id', 'vehicle_id', 'insurance_company', 'insurance_policy_number', 
                              'coverage_start_date', 'coverage_end_date', 'insurance_cost'];
    protected $returnType = 'object';

    protected $validationRules = [
        'insurance_id' => 'required|numeric|greater_than_equal_to[3001]|is_unique[insurance.insurance_id]',
        'vehicle_id' => 'required|numeric|is_not_unique[vehicles.vehicle_id]',
        'insurance_company' => 'required|string|max_length[35]',
        'insurance_policy_number' => 'required|numeric',
        'coverage_start_date' => 'required|valid_date',
        'coverage_end_date' => 'required|valid_date',
        'insurance_cost' => 'required|numeric|greater_than[0]'
    ];

    protected $validationMessages = [
        'insurance_id' => [
            'required' => 'Insurance ID is required',
            'numeric' => 'Insurance ID must be a number',
            'greater_than_equal_to' => 'Insurance ID must be greater than or equal to 3001',
            'is_unique' => 'Insurance ID must be unique'
        ],
        'vehicle_id' => [
            'required' => 'Vehicle is required',
            'numeric' => 'Vehicle ID must be a number',
            'is_not_unique' => 'Selected vehicle does not exist'
        ],
        'insurance_company' => [
            'required' => 'Insurance company is required',
            'string' => 'Insurance company must be text',
            'max_length' => 'Insurance company cannot exceed 35 characters'
        ],
        'insurance_policy_number' => [
            'required' => 'Policy number is required',
            'numeric' => 'Policy number must be a number'
        ],
        'coverage_start_date' => [
            'required' => 'Coverage start date is required',
            'valid_date' => 'Please enter a valid start date'
        ],
        'coverage_end_date' => [
            'required' => 'Coverage end date is required',
            'valid_date' => 'Please enter a valid end date'
        ],
        'insurance_cost' => [
            'required' => 'Insurance cost is required',
            'numeric' => 'Insurance cost must be a number',
            'greater_than' => 'Insurance cost must be greater than 0'
        ]
    ];

    public function getInsurance($id = null)
    {
        if ($id === null) {
            return $this->select('insurance.*, vehicles.brand as vehicle_brand, vehicles.model as vehicle_model, vehicles.license_plate_number as plate_number')
                       ->join('vehicles', 'vehicles.vehicle_id = insurance.vehicle_id')
                       ->findAll();
        }

        return $this->select('insurance.*, vehicles.brand as vehicle_brand, vehicles.model as vehicle_model, vehicles.license_plate_number as plate_number')
                   ->join('vehicles', 'vehicles.vehicle_id = insurance.vehicle_id')
                   ->where('insurance.insurance_id', $id)
                   ->first();
    }

    public function getVehicles()
    {
        $vehiclesModel = new \App\Models\Vehicles();
        $vehicles = $vehiclesModel->select('vehicle_id, brand, model, license_plate_number as plate_number')
                                ->findAll();

        $options = [];
        foreach ($vehicles as $vehicle) {
            $options[$vehicle->vehicle_id] = $vehicle->brand . " " . $vehicle->model . " (" . $vehicle->plate_number . ")";
        }

        return $options;
    }
}
