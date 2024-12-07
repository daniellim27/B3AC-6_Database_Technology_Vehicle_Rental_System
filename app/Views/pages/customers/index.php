<?php $this->extend('layouts/default') ?>

<?php $this->section('content') ?>
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Customers</h5>
        <a href="/customers/create" class="btn btn-primary">Add Customer</a>
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
                        <th>Customer ID</th>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>Driver License Number</th>
                        <th>Date of Birth</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php foreach ($customers as $customer) : ?>
                    <tr>
                        <td><?= $customer->customer_id ?></td>
                        <td><?= $customer->first_name . ' ' . $customer->last_name ?></td>
                        <td><?= $customer->email ?></td>
                        <td><?= $customer->phone_number ?></td>
                        <td><?= $customer->address ?></td>
                        <td><?= $customer->driver_license_number ?></td>
                        <td><?= $customer->date_of_birth ?></td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="ri-more-2-line"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="/customers/<?= $customer->customer_id ?>/edit"><i class="ri-pencil-line me-1"></i> Edit</a>
                                    <a class="dropdown-item" href="/customers/<?= $customer->customer_id ?>/delete" onclick="return confirm('Are you sure you want to delete this customer?')"><i class="ri-delete-bin-6-line me-1"></i> Delete</a>
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