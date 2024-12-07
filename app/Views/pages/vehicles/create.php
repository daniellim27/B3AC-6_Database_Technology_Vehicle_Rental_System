<?php $this->extend('layouts/default') ?>

<?php $this->section('content') ?>
<div class="card mb-6">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Add Vehicle</h5>
        <small class="text-muted float-end">Vehicle Addition Form</small>
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

        <form action="/vehicles/create" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <!-- Vehicle ID -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="vehicle-id">Vehicle ID</label>
                <div class="col-sm-10">
                    <input
                        type="number"
                        class="form-control <?= session('errors.vehicle_id') ? 'is-invalid' : '' ?>"
                        id="vehicle-id"
                        name="vehicle_id"
                        placeholder="1001"
                        value="<?= old('vehicle_id') ?>"
                        min="1001" />
                    <div class="invalid-feedback">
                        <?= session('errors.vehicle_id') ?>
                    </div>
                </div>
            </div>

            <!-- Status Code -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input
                            class="form-check-input <?= session('errors.status_code') ? 'is-invalid' : '' ?>"
                            type="radio"
                            name="status_code"
                            id="status-available"
                            value="1"
                            <?= old('status_code') == '1' ? 'checked' : '' ?> />
                        <label class="form-check-label" for="status-available">Available</label>
                    </div>
                    <div class="form-check">
                        <input
                            class="form-check-input <?= session('errors.status_code') ? 'is-invalid' : '' ?>"
                            type="radio"
                            name="status_code"
                            id="status-unavailable"
                            value="2"
                            <?= old('status_code') == '2' ? 'checked' : '' ?> />
                        <label class="form-check-label" for="status-unavailable">Unavailable</label>
                    </div>
                    <div class="form-check">
                        <input
                            class="form-check-input <?= session('errors.status_code') ? 'is-invalid' : '' ?>"
                            type="radio"
                            name="status_code"
                            id="status-maintenance"
                            value="3"
                            <?= old('status_code') == '3' ? 'checked' : '' ?> />
                        <label class="form-check-label" for="status-maintenance">Under Maintenance</label>
                    </div>
                    <?php if (session('errors.status_code')): ?>
                        <div class="text-danger"><?= session('errors.status_code') ?></div>
                    <?php endif ?>
                </div>
            </div>

            <!-- Brand -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="brand">Brand</label>
                <div class="col-sm-10">
                    <input
                        type="text"
                        class="form-control <?= session('errors.brand') ? 'is-invalid' : '' ?>"
                        id="brand"
                        name="brand"
                        placeholder="Toyota"
                        value="<?= old('brand') ?>" />
                    <div class="invalid-feedback">
                        <?= session('errors.brand') ?>
                    </div>
                </div>
            </div>

            <!-- Model -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="model">Model</label>
                <div class="col-sm-10">
                    <input
                        type="text"
                        class="form-control <?= session('errors.model') ? 'is-invalid' : '' ?>"
                        id="model"
                        name="model"
                        placeholder="Corolla"
                        value="<?= old('model') ?>" />
                    <div class="invalid-feedback">
                        <?= session('errors.model') ?>
                    </div>
                </div>
            </div>

            <!-- Year -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="year">Year</label>
                <div class="col-sm-10">
                    <input
                        type="number"
                        class="form-control <?= session('errors.year') ? 'is-invalid' : '' ?>"
                        id="year"
                        name="year"
                        placeholder="2022"
                        value="<?= old('year') ?>" />
                    <div class="invalid-feedback">
                        <?= session('errors.year') ?>
                    </div>
                </div>
            </div>

            <!-- License Plate Number -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="license-plate-number">License Plate Number</label>
                <div class="col-sm-10">
                    <input
                        type="text"
                        class="form-control <?= session('errors.license_plate_number') ? 'is-invalid' : '' ?>"
                        id="license-plate-number"
                        name="license_plate_number"
                        placeholder="B 1234 ABC"
                        value="<?= old('license_plate_number') ?>" />
                    <div class="invalid-feedback">
                        <?= session('errors.license_plate_number') ?>
                    </div>
                </div>
            </div>

            <!-- Rental Rate per Day -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="rental-rate-per-day">Rental Rate per Day</label>
                <div class="col-sm-10">
                    <input
                        type="number"
                        class="form-control <?= session('errors.rental_rate_per_day') ? 'is-invalid' : '' ?>"
                        id="rental-rate-per-day"
                        name="rental_rate_per_day"
                        placeholder="500000"
                        value="<?= old('rental_rate_per_day') ?>" />
                    <div class="invalid-feedback">
                        <?= session('errors.rental_rate_per_day') ?>
                    </div>
                </div>
            </div>

            <!-- Vehicle Type -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="vehicle-type">Vehicle Type</label>
                <div class="col-sm-10">
                    <input
                        type="text"
                        class="form-control <?= session('errors.vehicle_type') ? 'is-invalid' : '' ?>"
                        id="vehicle-type"
                        name="vehicle_type"
                        placeholder="Sedan"
                        value="<?= old('vehicle_type') ?>" />
                    <div class="invalid-feedback">
                        <?= session('errors.vehicle_type') ?>
                    </div>
                </div>
            </div>

            <!-- Vehicle Image -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="vehicle-image">Vehicle Image</label>
                <div class="col-sm-10">
                    <input
                        type="file"
                        class="form-control <?= session('errors.vehicle_image') ? 'is-invalid' : '' ?>"
                        id="vehicle-image"
                        name="vehicle_image" />
                    <div class="invalid-feedback">
                        <?= session('errors.vehicle_image') ?>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Add Vehicle</button>
                    <a href="<?= site_url('vehicles') ?>" class="btn btn-outline-secondary ms-2">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $this->endSection() ?>