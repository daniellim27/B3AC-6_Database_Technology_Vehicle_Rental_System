<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Customers as CustomersModel;

class Customers extends BaseController
{
    public function index()
    {
        $customersModel = new CustomersModel();
        $data['customers'] = $customersModel->findAll();
        return view('pages/customers/index', $data);
    }

    public function create()
    {
        return view('pages/customers/create');
    }

    public function store()
    {
        $customersModel = new CustomersModel();
        $validation = \Config\Services::validation();
        $validation->setRules([
            'customer_id' => 'required|numeric|min_length[4]',
            'first_name' => 'required|max_length[35]',
            'last_name' => 'required|max_length[35]',
            'email' => 'required|valid_email|max_length[320]',
            'phone_number' => 'required|max_length[13]',
            'address' => 'required|max_length[35]',
            'driver_license_number' => 'max_length[14]',
            'date_of_birth' => 'required|valid_date[Y-m-d]',
        ]);

        if (!$validation->run($this->request->getPost())) {
            return redirect()->back()
                ->withInput()
                ->with('validation', $validation)
                ->with('errors', $validation->getErrors());
        }

        $data = [
            'customer_id' => $this->request->getPost('customer_id'),
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'email' => $this->request->getPost('email'),
            'phone_number' => $this->request->getPost('phone_number'),
            'address' => $this->request->getPost('address'),
            'driver_license_number' => $this->request->getPost('driver_license_number'),
            'date_of_birth' => $this->request->getPost('date_of_birth'),
        ];

        $customersModel->insert($data);

        return redirect()->to('/customers')->with('status', 'Customer successfully added!');
    }

    public function show($id = null)
    {
        $customersModel = new CustomersModel();
        $data['customer'] = $customersModel->find($id);
        if (!$data['customer']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Customer ' . $id . ' not found');
        }
        return view('pages/customers/show', $data);
    }

    public function edit($id = null)
    {
        $customersModel = new CustomersModel();
        $data['customer'] = $customersModel->find($id);
        if (!$data['customer']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Customer ' . $id . ' not found');
        }
        return view('pages/customers/edit', $data);
    }

    public function update($id = null)
    {
        $customersModel = new CustomersModel();
        $validation = \Config\Services::validation();
        $validation->setRules([
            'first_name' => 'required|max_length[35]',
            'last_name' => 'required|max_length[35]',
            'email' => 'required|valid_email|max_length[320]',
            'phone_number' => 'required|max_length[13]',
            'address' => 'required|max_length[35]',
            'driver_license_number' => 'max_length[14]',
            'date_of_birth' => 'required|valid_date[Y-m-d]',
        ]);

        if (!$validation->run($this->request->getPost())) {
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
            'address' => $this->request->getPost('address'),
            'driver_license_number' => $this->request->getPost('driver_license_number'),
            'date_of_birth' => $this->request->getPost('date_of_birth'),
        ];

        $customersModel->update($id, $data);

        return redirect()->to('/customers')->with('status', 'Customer successfully updated!');
    }

    public function delete($id = null)
    {
        $customersModel = new CustomersModel();
        $customersModel->delete($id);
        return redirect()->to('/customers')->with('status', 'Customer successfully deleted!');
    }
}
