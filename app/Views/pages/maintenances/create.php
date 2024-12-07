<?php $this->extend('layouts/default') ?>

<?php $this->section('content') ?>
<div class="card mb-6">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Add Maintenance Record</h5>
        <small class="text-muted float-end">Maintenance Record Addition Form</small>
    </div>
    <div class="card-body">
        <?php if (session()->has('status')): ?>
            <div class="alert alert-success">
                <?= session('status') ?>
            </div>
        <?php endif ?>

        <?php if (session()->has('errors')): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach (session('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>

        <form action="/maintenances/create" method="post">
            <?= csrf_field() ?>

            <!-- Maintenance ID -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="maintenance-id">Maintenance ID</label>
                <div class="col-sm-10">
                    <input
                        type="number"
                        class="form-control <?= session('errors.maintenance_id') ? 'is-invalid' : '' ?>"
                        id="maintenance-id"
                        name="maintenance_id"
                        placeholder="2001"
                        value="<?= old('maintenance_id') ?>"
                        min="2001" />
                    <div class="invalid-feedback">
                        <?= session('errors.maintenance_id') ?>
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

            <!-- Maintenance Date -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="maintenance-date">Maintenance Date</label>
                <div class="col-sm-10">
                    <input
                        type="date"
                        class="form-control <?= session('errors.maintenance_date') ? 'is-invalid' : '' ?>"
                        id="maintenance-date"
                        name="maintenance_date"
                        value="<?= old('maintenance_date') ?>" />
                    <div class="invalid-feedback">
                        <?= session('errors.maintenance_date') ?>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="maintenance-description">Description</label>
                <div class="col-sm-10">
                    <textarea
                        class="form-control <?= session('errors.maintenance_description') ? 'is-invalid' : '' ?>"
                        id="maintenance-description"
                        name="maintenance_description"
                        rows="3"
                        maxlength="100"><?= old('maintenance_description') ?></textarea>
                    <div class="invalid-feedback">
                        <?= session('errors.maintenance_description') ?>
                    </div>
                </div>
            </div>

            <!-- Cost -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="maintenance-cost">Cost</label>
                <div class="col-sm-10">
                    <input
                        type="number"
                        class="form-control <?= session('errors.maintenance_cost') ? 'is-invalid' : '' ?>"
                        id="maintenance-cost"
                        name="maintenance_cost"
                        placeholder="500000"
                        value="<?= old('maintenance_cost') ?>" />
                    <div class="invalid-feedback">
                        <?= session('errors.maintenance_cost') ?>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Add Maintenance Record</button>
                    <a href="<?= site_url('maintenances') ?>" class="btn btn-outline-secondary ms-2">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $this->endSection() ?>
