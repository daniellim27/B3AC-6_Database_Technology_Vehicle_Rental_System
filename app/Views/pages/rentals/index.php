<?php $this->extend('layouts/default') ?>

<?php $this->section('content') ?>
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Rentals</h5>
        <a href="<?= site_url('rentals/create') ?>" class="btn btn-primary">Add New Rental</a>
    </div>
    <div class="card-body">
        <?php if (session()->has('status')): ?>
            <div class="alert alert-success">
                <?= session('status') ?>
            </div>
        <?php endif ?>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Rental ID</th>
                        <th>Customer</th>
                        <th>Vehicle</th>
                        <th>Employee</th>
                        <th>Status</th>
                        <th>Rental Date</th>
                        <th>Return Date</th>
                        <th>Total Cost</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rentals as $rental): ?>
                        <tr>
                            <td><?= $rental->rental_id ?></td>
                            <td><?= esc($rental->customer_first_name) . ' ' . esc($rental->customer_last_name) ?></td>
                            <td><?= esc($rental->vehicle_brand) . ' ' . esc($rental->vehicle_model) ?></td>
                            <td><?= esc($rental->employee_first_name) . ' ' . esc($rental->employee_last_name) ?></td>
                            <td><?= esc($rental->rental_status_name) ?></td>
                            <td><?= $rental->rental_date ?></td>
                            <td><?= $rental->return_date ?? '-' ?></td>
                            <td>Rp <?= number_format($rental->total_rental_cost, 0, ',', '.') ?></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ri-more-2-line"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/rentals/<?= $rental->rental_id ?>/edit"><i class="ri-pencil-line me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="/rentals/<?= $rental->rental_id ?>/delete" onclick="return confirm('Are you sure you want to delete this customer?')"><i class="ri-delete-bin-6-line me-1"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->endSection() ?>