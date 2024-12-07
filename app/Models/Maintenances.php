<?php

namespace App\Models;

use CodeIgniter\Model;

class Maintenances extends Model
{
    protected $table            = 'vehiclemaintenance';
    protected $primaryKey       = 'maintenance_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'maintenance_id',
        'vehicle_id',
        'maintenance_date',
        'maintenance_description',
        'maintenance_cost'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Validation rules
    protected $validationRules = [
        'maintenance_id' => [
            'rules' => 'required|numeric|greater_than_equal_to[2001]',
            'errors' => [
                'required' => 'Maintenance ID is required',
                'numeric' => 'Maintenance ID must be a number',
                'greater_than_equal_to' => 'Maintenance ID must be greater than or equal to 2001'
            ]
        ],
        'vehicle_id' => [
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Vehicle is required',
                'numeric' => 'Vehicle ID must be a number'
            ]
        ],
        'maintenance_date' => [
            'rules' => 'required|valid_date',
            'errors' => [
                'required' => 'Maintenance date is required',
                'valid_date' => 'Please enter a valid date'
            ]
        ],
        'maintenance_description' => [
            'rules' => 'required|max_length[100]',
            'errors' => [
                'required' => 'Maintenance description is required',
                'max_length' => 'Description cannot exceed 100 characters'
            ]
        ],
        'maintenance_cost' => [
            'rules' => 'required|numeric|greater_than[0]',
            'errors' => [
                'required' => 'Maintenance cost is required',
                'numeric' => 'Cost must be a number',
                'greater_than' => 'Cost must be greater than 0'
            ]
        ]
    ];

    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Get maintenance records with vehicle details
     */
    public function getMaintenance($id = null)
    {
        $this->select('vehiclemaintenance.*, vehicles.brand as vehicle_brand, vehicles.model as vehicle_model');
        $this->join('vehicles', 'vehicles.vehicle_id = vehiclemaintenance.vehicle_id', 'left');
        
        if ($id !== null) {
            return $this->find($id);
        }
        
        return $this->findAll();
    }

    /**
     * Get vehicles for dropdown
     */
    public function getVehicles()
    {
        $db = \Config\Database::connect();
        $vehicles = $db->table('vehicles')->get()->getResult();
        $vehicleArray = [];
        foreach ($vehicles as $vehicle) {
            $vehicleArray[$vehicle->vehicle_id] = $vehicle->brand . ' ' . $vehicle->model;
        }
        return $vehicleArray;
    }
}
