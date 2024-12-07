<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Vehicles as VehiclesModel;

class Vehicles extends BaseController
{
    public function index()
    {
        $vehiclesModel = new VehiclesModel();
        $data['vehicles'] = $vehiclesModel->findAll();
        return view('pages/vehicles/index', $data);
    }

    public function create()
    {
        return view('pages/vehicles/create');
    }

    public function store()
    {
        $vehiclesModel = new VehiclesModel();
        $validation = \Config\Services::validation();
        $validation->setRules([
            'vehicle_id' => 'required|numeric',
            'status_code' => 'required|numeric',
            'brand' => 'required|max_length[35]',
            'model' => 'required|max_length[35]',
            'year' => 'required|numeric',
            'license_plate_number' => 'required|max_length[10]',
            'rental_rate_per_day' => 'required|numeric',
            'vehicle_type' => 'required|max_length[35]',
            // 'vehicle_image' => 'uploaded[vehicle_image]|mime_in[vehicle_image,image/jpg,image/jpeg,image/png]',
        ]);

        if (!$validation->run($this->request->getPost())) {
            return redirect()->back()
                ->withInput()
                ->with('validation', $validation)
                ->with('errors', $validation->getErrors());
        }

        $vehicleImage = $this->request->getFile('vehicle_image');
        if($vehicleImage && $vehicleImage->getError() != 4) {
            $vehicleImage->move(ROOTPATH . 'public/uploads', $vehicleImage->getName());
        }

        $data = [
            'vehicle_id' => $this->request->getPost('vehicle_id'),
            'status_code' => $this->request->getPost('status_code'),
            'brand' => $this->request->getPost('brand'),
            'model' => $this->request->getPost('model'),
            'year' => $this->request->getPost('year'),
            'license_plate_number' => $this->request->getPost('license_plate_number'),
            'rental_rate_per_day' => $this->request->getPost('rental_rate_per_day'),
            'vehicle_type' => $this->request->getPost('vehicle_type'),
            'vehicle_image' => ($vehicleImage && $vehicleImage->getError() != 4) ? $vehicleImage->getName() : null,
        ];
        $vehiclesModel->insert($data);

        return redirect()->to('/vehicles')->with('status', 'Vehicle successfully added!');
    }

    public function show($id = null)
    {
        $vehiclesModel = new VehiclesModel();
        $data['vehicle'] = $vehiclesModel->find($id);
        if (!$data['vehicle']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Vehicle ' . $id . ' not found');
        }
        return view('pages/vehicles/show', $data);
    }

    public function edit($id = null)
    {
        $vehiclesModel = new VehiclesModel();
        $data['vehicle'] = $vehiclesModel->find($id);
        if (!$data['vehicle']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Vehicle ' . $id . ' not found');
        }
        return view('pages/vehicles/edit', $data);
    }

    public function update($id = null)
    {
        $vehiclesModel = new VehiclesModel();
        $validation = \Config\Services::validation();
        $validation->setRules([
            'vehicle_id' => 'required|numeric',
            'status_code' => 'required|numeric',
            'brand' => 'required|max_length[35]',
            'model' => 'required|max_length[35]',
            'year' => 'required|numeric',
            'license_plate_number' => 'required|max_length[10]',
            'rental_rate_per_day' => 'required|numeric',
            'vehicle_type' => 'required|max_length[35]',
            // 'vehicle_image' => 'uploaded[vehicle_image]|mime_in[vehicle_image,image/jpg,image/jpeg,image/png]',
        ]);

        if (!$validation->run($this->request->getPost())) {
            return redirect()->back()
                ->withInput()
                ->with('validation', $validation)
                ->with('errors', $validation->getErrors());
        }

        $vehicleImage = $this->request->getFile('vehicle_image');
        if($vehicleImage && $vehicleImage->getError() != 4) {
            $vehicleImage->move(ROOTPATH . 'public/uploads', $vehicleImage->getName());
        }

        $data = [
            'status_code' => $this->request->getPost('status_code'),
            'brand' => $this->request->getPost('brand'),
            'model' => $this->request->getPost('model'),
            'year' => $this->request->getPost('year'),
            'license_plate_number' => $this->request->getPost('license_plate_number'),
            'rental_rate_per_day' => $this->request->getPost('rental_rate_per_day'),
            'vehicle_type' => $this->request->getPost('vehicle_type'),
            'vehicle_image' => ($vehicleImage && $vehicleImage->getError() != 4) ? $vehicleImage->getName() : null,
        ];
        if($vehicleImage && $vehicleImage->getError() == 4){
            unset($data['vehicle_image']);
        }
        $vehiclesModel->update($id, $data);
        return redirect()->to('/vehicles')->with('status', 'Vehicle successfully updated!');
    }

    public function delete($id = null)
    {
        $vehiclesModel = new VehiclesModel();
        $vehiclesModel->delete($id);
        return redirect()->to('/vehicles')->with('status', 'Vehicle successfully deleted!');
    }
}
