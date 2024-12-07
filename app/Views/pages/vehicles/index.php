<?php $this->extend('layouts/default') ?>

<?php $this->section('content') ?>
<div class="card">
<div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Vehicles</h5>
        <a href="/vehicles/create" class="btn btn-primary">Add Vehicle</a>
    </div>
    <div class="card-body">
        <!-- show success -->
        <?php if (session()->has('status')): ?>
            <div class="alert alert-success">
                <?= session('status') ?>
            </div>
        <?php endif ?>
        <!-- show error -->
        <?php if (session()->has('errors')): ?>
            <div class="alert alert-danger">
                <?= session('errors') ?>
            </div>
        <?php endif ?>
                
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Vehicle ID</th>
                        <th>Status Code</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>License Plate Number</th>
                        <th>Rental Rate per Day</th>
                        <th>Vehicle Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php foreach ($vehicles as $vehicle) : ?>
                    <tr>
                        <td><?= $vehicle->vehicle_id ?></td>
                        <td><?= $vehicle->status_code ?></td>
                        <td><?= $vehicle->brand ?></td>
                        <td><?= $vehicle->model ?></td>
                        <td><?= $vehicle->year ?></td>
                        <td><?= $vehicle->license_plate_number ?></td>
                        <td><?= $vehicle->rental_rate_per_day ?></td>
                        <td><?= $vehicle->vehicle_type ?></td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="ri-more-2-line"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="/vehicles/<?= $vehicle->vehicle_id ?>/edit"><i class="ri-pencil-line me-1"></i> Edit</a>
                                    <a class="dropdown-item" href="/vehicles/<?= $vehicle->vehicle_id ?>/delete" onclick="return confirm('Are you sure you want to delete this vehicle?')"><i class="ri-delete-bin-6-line me-1"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->endSection() ?>