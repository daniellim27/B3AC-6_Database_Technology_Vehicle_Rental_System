<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Payments as PaymentsModel;

class Payments extends BaseController
{
    public function index()
    {
        $paymentsModel = new PaymentsModel();
        $data['payments'] = $paymentsModel->getPayment();
        return view('pages/payments/index', $data);
    }

    public function create()
    {
        $paymentsModel = new PaymentsModel();
        $data['rentals'] = $paymentsModel->getRentals();
        return view('pages/payments/create', $data);
    }

    public function store()
    {
        $paymentsModel = new PaymentsModel();
        $validation = \Config\Services::validation();
        $rules = $paymentsModel->getValidationRules();

        if (!$validation->setRules($rules)->run($this->request->getPost())) {
            return redirect()->back()
                ->withInput()
                ->with('validation', $validation)
                ->with('errors', $validation->getErrors());
        }

        $data = [
            'payment_id' => $this->request->getPost('payment_id'),
            'rental_id' => $this->request->getPost('rental_id'),
            'payment_date' => $this->request->getPost('payment_date'),
            'payment_amount' => $this->request->getPost('payment_amount'),
            'payment_method' => $this->request->getPost('payment_method')
        ];

        $paymentsModel->insert($data);

        return redirect()->to('/payments')->with('status', 'Payment record successfully added!');
    }

    public function show($id = null)
    {
        $paymentsModel = new PaymentsModel();
        $data['payment'] = $paymentsModel->getPayment($id);
        if (!$data['payment']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Payment record ' . $id . ' not found');
        }
        return view('pages/payments/show', $data);
    }

    public function edit($id = null)
    {
        $paymentsModel = new PaymentsModel();
        $data['payment'] = $paymentsModel->getPayment($id);
        $data['rentals'] = $paymentsModel->getRentals();
        
        if (!$data['payment']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Payment record ' . $id . ' not found');
        }
        return view('pages/payments/edit', $data);
    }

    public function update($id = null)
    {
        $paymentsModel = new PaymentsModel();
        $validation = \Config\Services::validation();
        $rules = $paymentsModel->getValidationRules();
        $rules['payment_id'] = 'required|numeric';

        if (!$validation->setRules($rules)->run($this->request->getPost())) {
            return redirect()->back()
                ->withInput()
                ->with('validation', $validation)
                ->with('errors', $validation->getErrors());
        }

        $data = [
            'rental_id' => $this->request->getPost('rental_id'),
            'payment_date' => $this->request->getPost('payment_date'),
            'payment_amount' => $this->request->getPost('payment_amount'),
            'payment_method' => $this->request->getPost('payment_method')
        ];

        $paymentsModel->update($id, $data);

        return redirect()->to('/payments')->with('status', 'Payment record successfully updated!');
    }

    public function delete($id = null)
    {
        $paymentsModel = new PaymentsModel();
        $paymentsModel->delete($id);
        return redirect()->to('/payments')->with('status', 'Payment record successfully deleted!');
    }
}
