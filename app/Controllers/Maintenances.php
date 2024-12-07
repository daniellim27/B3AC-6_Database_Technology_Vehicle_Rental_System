<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Maintenances as MaintenancesModel;

class Maintenances extends BaseController
{
    public function index()
    {
        $maintenancesModel = new MaintenancesModel();
        $data['maintenances'] = $maintenancesModel->getMaintenance();
        return view('pages/maintenances/index', $data);
    }

    public function create()
    {
        $maintenancesModel = new MaintenancesModel();
        $data['vehicles'] = $maintenancesModel->getVehicles();
        return view('pages/maintenances/create', $data);
    }

    public function store()
    {
        $maintenancesModel = new MaintenancesModel();
        $validation = \Config\Services::validation();
        $rules = $maintenancesModel->getValidationRules();

        if (!$validation->setRules($rules)->run($this->request->getPost())) {
            return redirect()->back()
                ->withInput()
                ->with('validation', $validation)
                ->with('errors', $validation->getErrors());
        }

        $data = [
            'maintenance_id' => $this->request->getPost('maintenance_id'),
            'vehicle_id' => $this->request->getPost('vehicle_id'),
            'maintenance_date' => $this->request->getPost('maintenance_date'),
            'maintenance_description' => $this->request->getPost('maintenance_description'),
            'maintenance_cost' => $this->request->getPost('maintenance_cost')
        ];

        $maintenancesModel->insert($data);

        return redirect()->to('/maintenances')->with('status', 'Maintenance record successfully added!');
    }

    public function show($id = null)
    {
        $maintenancesModel = new MaintenancesModel();
        $data['maintenance'] = $maintenancesModel->getMaintenance($id);
        if (!$data['maintenance']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Maintenance record ' . $id . ' not found');
        }
        return view('pages/maintenances/show', $data);
    }

    public function edit($id = null)
    {
        $maintenancesModel = new MaintenancesModel();
        $data['maintenance'] = $maintenancesModel->getMaintenance($id);
        $data['vehicles'] = $maintenancesModel->getVehicles();
        
        if (!$data['maintenance']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Maintenance record ' . $id . ' not found');
        }
        return view('pages/maintenances/edit', $data);
    }

    public function update($id = null)
    {
        $maintenancesModel = new MaintenancesModel();
        $validation = \Config\Services::validation();
        $rules = $maintenancesModel->getValidationRules();
        $rules['maintenance_id'] = 'required|numeric';

        if (!$validation->setRules($rules)->run($this->request->getPost())) {
            return redirect()->back()
                ->withInput()
                ->with('validation', $validation)
                ->with('errors', $validation->getErrors());
        }

        $data = [
            'vehicle_id' => $this->request->getPost('vehicle_id'),
            'maintenance_date' => $this->request->getPost('maintenance_date'),
            'maintenance_description' => $this->request->getPost('maintenance_description'),
            'maintenance_cost' => $this->request->getPost('maintenance_cost')
        ];

        $maintenancesModel->update($id, $data);

        return redirect()->to('/maintenances')->with('status', 'Maintenance record successfully updated!');
    }

    public function delete($id = null)
    {
        $maintenancesModel = new MaintenancesModel();
        $maintenancesModel->delete($id);
        return redirect()->to('/maintenances')->with('status', 'Maintenance record successfully deleted!');
    }
}
