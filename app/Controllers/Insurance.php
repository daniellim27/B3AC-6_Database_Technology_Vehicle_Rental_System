<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Insurance as InsuranceModel;

class Insurance extends BaseController
{
    public function index()
    {
        $insuranceModel = new InsuranceModel();
        $data['insurances'] = $insuranceModel->getInsurance();
        return view('pages/insurance/index', $data);
    }

    public function create()
    {
        $insuranceModel = new InsuranceModel();
        $data['vehicles'] = $insuranceModel->getVehicles();
        return view('pages/insurance/create', $data);
    }

    public function store()
    {
        $insuranceModel = new InsuranceModel();
        $validation = \Config\Services::validation();
        $rules = $insuranceModel->getValidationRules();

        if (!$validation->setRules($rules)->run($this->request->getPost())) {
            return redirect()->back()
                ->withInput()
                ->with('validation', $validation)
                ->with('errors', $validation->getErrors());
        }

        $data = [
            'insurance_id' => $this->request->getPost('insurance_id'),
            'vehicle_id' => $this->request->getPost('vehicle_id'),
            'insurance_company' => $this->request->getPost('insurance_company'),
            'insurance_policy_number' => $this->request->getPost('insurance_policy_number'),
            'coverage_start_date' => $this->request->getPost('coverage_start_date'),
            'coverage_end_date' => $this->request->getPost('coverage_end_date'),
            'insurance_cost' => $this->request->getPost('insurance_cost')
        ];

        $insuranceModel->insert($data);

        return redirect()->to('/insurance')->with('status', 'Insurance record successfully added!');
    }

    public function show($id = null)
    {
        $insuranceModel = new InsuranceModel();
        $data['insurance'] = $insuranceModel->getInsurance($id);
        if (!$data['insurance']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Insurance record ' . $id . ' not found');
        }
        return view('pages/insurance/show', $data);
    }

    public function edit($id = null)
    {
        $insuranceModel = new InsuranceModel();
        $data['insurance'] = $insuranceModel->getInsurance($id);
        $data['vehicles'] = $insuranceModel->getVehicles();
        
        if (!$data['insurance']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Insurance record ' . $id . ' not found');
        }
        return view('pages/insurance/edit', $data);
    }

    public function update($id = null)
    {
        $insuranceModel = new InsuranceModel();
        $validation = \Config\Services::validation();
        $rules = $insuranceModel->getValidationRules();
        $rules['insurance_id'] = 'required|numeric';

        if (!$validation->setRules($rules)->run($this->request->getPost())) {
            return redirect()->back()
                ->withInput()
                ->with('validation', $validation)
                ->with('errors', $validation->getErrors());
        }

        $data = [
            'vehicle_id' => $this->request->getPost('vehicle_id'),
            'insurance_company' => $this->request->getPost('insurance_company'),
            'insurance_policy_number' => $this->request->getPost('insurance_policy_number'),
            'coverage_start_date' => $this->request->getPost('coverage_start_date'),
            'coverage_end_date' => $this->request->getPost('coverage_end_date'),
            'insurance_cost' => $this->request->getPost('insurance_cost')
        ];

        $insuranceModel->update($id, $data);

        return redirect()->to('/insurance')->with('status', 'Insurance record successfully updated!');
    }

    public function delete($id = null)
    {
        $insuranceModel = new InsuranceModel();
        $insuranceModel->delete($id);
        return redirect()->to('/insurance')->with('status', 'Insurance record successfully deleted!');
    }
}
