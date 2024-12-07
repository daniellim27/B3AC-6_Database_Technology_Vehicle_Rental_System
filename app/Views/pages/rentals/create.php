<?php $this->extend('layouts/default') ?>

<?php $this->section('content') ?>
<div class="card mb-6">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Add Rental</h5>
        <small class="text-muted float-end">Rental Addition Form</small>
    </div>
    <div class="card-body">
        <!-- show success -->
        <?php if (session()->has('status')): ?>
            <div class="alert alert-success">
                <?= session('status') ?>
            </div>
        <?php endif ?>

        <!-- show errors -->
        <?php if (session()->has('errors')): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach (session('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>

        <form action="/rentals/create" method="post">
            <?= csrf_field() ?>

            <!-- Rental ID -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="rental-id">Rental ID</label>
                <div class="col-sm-10">
                    <input
                        type="number"
                        class="form-control <?= session('errors.rental_id') ? 'is-invalid' : '' ?>"
                        id="rental-id"
                        name="rental_id"
                        placeholder="4001"
                        value="<?= old('rental_id') ?>"
                        min="4001" />
                    <div class="invalid-feedback">
                        <?= session('errors.rental_id') ?>
                    </div>
                </div>
            </div>

            <!-- Customer -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="customer-id">Customer</label>
                <div class="col-sm-10">
                    <select
                        class="form-select <?= session('errors.customer_id') ? 'is-invalid' : '' ?>"
                        id="customer-id"
                        name="customer_id">
                        <option value="">Select Customer</option>
                        <?php foreach ($customers as $id => $name): ?>
                            <option value="<?= $id ?>" <?= old('customer_id') == $id ? 'selected' : '' ?>>
                                <?= esc($name) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= session('errors.customer_id') ?>
                    </div>
                </div>
            </div>

            <!-- Vehicle -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="vehicle-id">Vehicle</label>
                <div class="col-sm-10">
                    <select
                        class="form-select <?= session('errors.vehicle_id') ? 'is-invalid' : '' ?>"
                        id="vehicle-id"
                        name="vehicle_id">
                        <option value="">Select Vehicle</option>
                        <?php foreach ($vehicles as $id => $name): ?>
                            <option value="<?= $id ?>" <?= old('vehicle_id') == $id ? 'selected' : '' ?>>
                                <?= esc($name) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= session('errors.vehicle_id') ?>
                    </div>
                </div>
            </div>

            <!-- Employee -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="employee-id">Employee</label>
                <div class="col-sm-10">
                    <select
                        class="form-select <?= session('errors.employee_id') ? 'is-invalid' : '' ?>"
                        id="employee-id"
                        name="employee_id">
                        <option value="">Select Employee</option>
                        <?php foreach ($employees as $id => $name): ?>
                            <option value="<?= $id ?>" <?= old('employee_id') == $id ? 'selected' : '' ?>>
                                <?= esc($name) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= session('errors.employee_id') ?>
                    </div>
                </div>
            </div>

            <!-- Rental Status -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="rental-status-code">Rental Status</label>
                <div class="col-sm-10">
                    <select
                        class="form-select <?= session('errors.rental_status_code') ? 'is-invalid' : '' ?>"
                        id="rental-status-code"
                        name="rental_status_code">
                        <option value="">Select Status</option>
                        <?php foreach ($rental_statuses as $code => $name): ?>
                            <option value="<?= $code ?>" <?= old('rental_status_code') == $code ? 'selected' : '' ?>>
                                <?= esc($name) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= session('errors.rental_status_code') ?>
                    </div>
                </div>
            </div>

            <!-- Rental Date -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="rental-date">Rental Date</label>
                <div class="col-sm-10">
                    <input
                        type="date"
                        class="form-control <?= session('errors.rental_date') ? 'is-invalid' : '' ?>"
                        id="rental-date"
                        name="rental_date"
                        value="<?= old('rental_date') ?>" />
                    <div class="invalid-feedback">
                        <?= session('errors.rental_date') ?>
                    </div>
                </div>
            </div>

            <!-- Return Date -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="return-date">Return Date</label>
                <div class="col-sm-10">
                    <input
                        type="date"
                        class="form-control <?= session('errors.return_date') ? 'is-invalid' : '' ?>"
                        id="return-date"
                        name="return_date"
                        value="<?= old('return_date') ?>" />
                    <div class="invalid-feedback">
                        <?= session('errors.return_date') ?>
                    </div>
                </div>
            </div>

            <!-- Total Rental Cost -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="total-rental-cost">Total Rental Cost</label>
                <div class="col-sm-10">
                    <input
                        type="number"
                        class="form-control <?= session('errors.total_rental_cost') ? 'is-invalid' : '' ?>"
                        id="total-rental-cost"
                        name="total_rental_cost"
                        placeholder="500000"
                        value="<?= old('total_rental_cost') ?>" />
                    <div class="invalid-feedback">
                        <?= session('errors.total_rental_cost') ?>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Add Rental</button>
                    <a href="<?= site_url('rentals') ?>" class="btn btn-outline-secondary ms-2">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $this->endSection() ?>