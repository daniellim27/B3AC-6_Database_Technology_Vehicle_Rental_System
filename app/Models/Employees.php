<?php

namespace App\Models;

use CodeIgniter\Model;

class Employees extends Model
{
    protected $table            = 'employees';
    protected $primaryKey       = 'employee_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'employee_id',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'role',
        'salary'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Validation rules
    protected $validationRules = [
        'employee_id' => [
            'rules' => 'required|numeric|greater_than_equal_to[8001]',
            'errors' => [
                'required' => 'Employee ID is required',
                'numeric' => 'Employee ID must be a number',
                'greater_than_equal_to' => 'Employee ID must be greater than or equal to 8001'
            ]
        ],
        'first_name' => [
            'rules' => 'required|max_length[35]',
            'errors' => [
                'required' => 'First name is required',
                'max_length' => 'First name cannot exceed 35 characters'
            ]
        ],
        'last_name' => [
            'rules' => 'required|max_length[35]',
            'errors' => [
                'required' => 'Last name is required',
                'max_length' => 'Last name cannot exceed 35 characters'
            ]
        ],
        'email' => [
            'rules' => 'required|valid_email|max_length[220]',
            'errors' => [
                'required' => 'Email is required',
                'valid_email' => 'Please enter a valid email address',
                'max_length' => 'Email cannot exceed 220 characters'
            ]
        ],
        'phone_number' => [
            'rules' => 'required|max_length[13]',
            'errors' => [
                'required' => 'Phone number is required',
                'max_length' => 'Phone number cannot exceed 13 characters'
            ]
        ],
        'role' => [
            'rules' => 'required|max_length[35]',
            'errors' => [
                'required' => 'Role is required',
                'max_length' => 'Role cannot exceed 35 characters'
            ]
        ],
        'salary' => [
            'rules' => 'required|numeric|greater_than[0]',
            'errors' => [
                'required' => 'Salary is required',
                'numeric' => 'Salary must be a number',
                'greater_than' => 'Salary must be greater than 0'
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
     * Get a list of employees formatted for dropdown selection
     */
    public function getDropdownList()
    {
        $employees = $this->findAll();
        $list = [];
        foreach ($employees as $employee) {
            $list[$employee->employee_id] = $employee->first_name . ' ' . $employee->last_name;
        }
        return $list;
    }
}
