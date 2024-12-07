<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Employees as EmployeesModel;

class Employees extends BaseController
{
    public function index()
    {
        $employeesModel = new EmployeesModel();
        $data['employees'] = $employeesModel->findAll();
        return view('pages/employees/index', $data);
    }

    public function create()
    {
        return view('pages/employees/create');
    }

    public function store()
    {
        $employeesModel = new EmployeesModel();
        $validation = \Config\Services::validation();
        $rules = $employeesModel->getValidationRules();

        if (!$validation->setRules($rules)->run($this->request->getPost())) {
            return redirect()->back()
                ->withInput()
                ->with('validation', $validation)
                ->with('errors', $validation->getErrors());
        }

        $data = [
            'employee_id' => $this->request->getPost('employee_id'),
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'email' => $this->request->getPost('email'),
            'phone_number' => $this->request->getPost('phone_number'),
            'role' => $this->request->getPost('role'),
            'salary' => $this->request->getPost('salary')
        ];

        $query = $employeesModel->insert($data);

        return redirect()->to('/employees')->with('status', 'Employee successfully added!');
    }

    public function show($id = null)
    {
        $employeesModel = new EmployeesModel();
        $data['employee'] = $employeesModel->find($id);
        if (!$data['employee']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Employee ' . $id . ' not found');
        }
        return view('pages/employees/show', $data);
    }

    public function edit($id = null)
    {
        $employeesModel = new EmployeesModel();
        $data['employee'] = $employeesModel->find($id);
        
        if (!$data['employee']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Employee ' . $id . ' not found');
        }
        return view('pages/employees/edit', $data);
    }

    public function update($id = null)
    {
        $employeesModel = new EmployeesModel();
        $validation = \Config\Services::validation();
        $rules = $employeesModel->getValidationRules();
        $rules['employee_id'] = 'required|numeric';

        if (!$validation->setRules($rules)->run($this->request->getPost())) {
            return redirect()->back()
                ->withInput()
                ->with('validation', $validation)
                ->with('errors', $validation->getErrors());
        }

        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'email' => $this->request->getPost('email'),
            'phone_number' => $this->request->getPost('phone_number'),
            'role' => $this->request->getPost('role'),
            'salary' => $this->request->getPost('salary')
        ];

        $employeesModel->update($id, $data);

        return redirect()->to('/employees')->with('status', 'Employee successfully updated!');
    }

    public function delete($id = null)
    {
        $employeesModel = new EmployeesModel();
        $employeesModel->delete($id);
        return redirect()->to('/employees')->with('status', 'Employee successfully deleted!');
    }
}
