<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Rentals as RentalsModel;

class Rentals extends BaseController
{
    public function index()
    {
        $rentalsModel = new RentalsModel();
        $data['rentals'] = $rentalsModel->getRental();
        return view('pages/rentals/index', $data);
    }

    public function create()
    {
        $rentalsModel = new RentalsModel();
        $data = [
            'customers' => $rentalsModel->getCustomers(),
            'vehicles' => $rentalsModel->getVehicles(),
            'employees' => $rentalsModel->getEmployees(),
            'rental_statuses' => $rentalsModel->getRentalStatuses()
        ];
        return view('pages/rentals/create', $data);
    }

    public function store()
    {
        $rentalsModel = new RentalsModel();
        $validation = \Config\Services::validation();
        $rules = $rentalsModel->getValidationRules();

        if (!$validation->setRules($rules)->run($this->request->getPost())) {
            return redirect()->back()
                ->withInput()
                ->with('validation', $validation)
                ->with('errors', $validation->getErrors());
        }

        $data = [
            'rental_id' => $this->request->getPost('rental_id'),
            'customer_id' => $this->request->getPost('customer_id'),
            'vehicle_id' => $this->request->getPost('vehicle_id'),
            'employee_id' => $this->request->getPost('employee_id'),
            'rental_status_code' => $this->request->getPost('rental_status_code'),
            'rental_date' => $this->request->getPost('rental_date'),
            'return_date' => $this->request->getPost('return_date'),
            'total_rental_cost' => $this->request->getPost('total_rental_cost')
        ];

        $rentalsModel->insert($data);

        return redirect()->to('/rentals')->with('status', 'Rental successfully added!');
    }

    public function show($id = null)
    {
        $rentalsModel = new RentalsModel();
        $data['rental'] = $rentalsModel->getRental($id);
        if (!$data['rental']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Rental ' . $id . ' not found');
        }
        return view('pages/rentals/show', $data);
    }

    public function edit($id = null)
    {
        $rentalsModel = new RentalsModel();
        $data = [
            'rental' => $rentalsModel->getRental($id),
            'customers' => $rentalsModel->getCustomers(),
            'vehicles' => $rentalsModel->getVehicles(),
            'employees' => $rentalsModel->getEmployees(),
            'rental_statuses' => $rentalsModel->getRentalStatuses()
        ];
        
        if (!$data['rental']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Rental ' . $id . ' not found');
        }
        return view('pages/rentals/edit', $data);
    }

    public function update($id = null)
    {
        $rentalsModel = new RentalsModel();
        $validation = \Config\Services::validation();
        $rules = $rentalsModel->getValidationRules();
        $rules['rental_id'] = 'required|numeric';

        if (!$validation->setRules($rules)->run($this->request->getPost())) {
            return redirect()->back()
                ->withInput()
                ->with('validation', $validation)
                ->with('errors', $validation->getErrors());
        }

        $data = [
            'customer_id' => $this->request->getPost('customer_id'),
            'vehicle_id' => $this->request->getPost('vehicle_id'),
            'employee_id' => $this->request->getPost('employee_id'),
            'rental_status_code' => $this->request->getPost('rental_status_code'),
            'rental_date' => $this->request->getPost('rental_date'),
            'return_date' => $this->request->getPost('return_date'),
            'total_rental_cost' => $this->request->getPost('total_rental_cost')
        ];

        $rentalsModel->update($id, $data);

        return redirect()->to('/rentals')->with('status', 'Rental successfully updated!');
    }

    public function delete($id = null)
    {
        $rentalsModel = new RentalsModel();
        $rentalsModel->delete($id);
        return redirect()->to('/rentals')->with('status', 'Rental successfully deleted!');
    }
}
