<?php $this->extend('layouts/default') ?>

<?php $this->section('content') ?>
<div class="card mb-6">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Add Insurance Record</h5>
        <small class="text-muted float-end">Insurance Record Addition Form</small>
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

        <form action="/insurance/create" method="post">
            <?= csrf_field() ?>

            <!-- Insurance ID -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="insurance-id">Insurance ID</label>
                <div class="col-sm-10">
                    <input
                        type="number"
                        class="form-control <?= session('errors.insurance_id') ? 'is-invalid' : '' ?>"
                        id="insurance-id"
                        name="insurance_id"
                        placeholder="3001"
                        value="<?= old('insurance_id') ?>"
                        min="3001" />
                    <div class="invalid-feedback">
                        <?= session('errors.insurance_id') ?>
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

            <!-- Insurance Company -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="insurance-company">Insurance Company</label>
                <div class="col-sm-10">
                    <input
                        type="text"
                        class="form-control <?= session('errors.insurance_company') ? 'is-invalid' : '' ?>"
                        id="insurance-company"
                        name="insurance_company"
                        placeholder="Insurance Company Name"
                        value="<?= old('insurance_company') ?>"
                        maxlength="35" />
                    <div class="invalid-feedback">
                        <?= session('errors.insurance_company') ?>
                    </div>
                </div>
            </div>

            <!-- Policy Number -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="insurance-policy-number">Policy Number</label>
                <div class="col-sm-10">
                    <input
                        type="number"
                        class="form-control <?= session('errors.insurance_policy_number') ? 'is-invalid' : '' ?>"
                        id="insurance-policy-number"
                        name="insurance_policy_number"
                        placeholder="12345678"
                        value="<?= old('insurance_policy_number') ?>" />
                    <div class="invalid-feedback">
                        <?= session('errors.insurance_policy_number') ?>
                    </div>
                </div>
            </div>

            <!-- Coverage Start Date -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="coverage-start-date">Coverage Start Date</label>
                <div class="col-sm-10">
                    <input
                        type="date"
                        class="form-control <?= session('errors.coverage_start_date') ? 'is-invalid' : '' ?>"
                        id="coverage-start-date"
                        name="coverage_start_date"
                        value="<?= old('coverage_start_date') ?>" />
                    <div class="invalid-feedback">
                        <?= session('errors.coverage_start_date') ?>
                    </div>
                </div>
            </div>

            <!-- Coverage End Date -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="coverage-end-date">Coverage End Date</label>
                <div class="col-sm-10">
                    <input
                        type="date"
                        class="form-control <?= session('errors.coverage_end_date') ? 'is-invalid' : '' ?>"
                        id="coverage-end-date"
                        name="coverage_end_date"
                        value="<?= old('coverage_end_date') ?>" />
                    <div class="invalid-feedback">
                        <?= session('errors.coverage_end_date') ?>
                    </div>
                </div>
            </div>

            <!-- Insurance Cost -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="insurance-cost">Insurance Cost</label>
                <div class="col-sm-10">
                    <input
                        type="number"
                        class="form-control <?= session('errors.insurance_cost') ? 'is-invalid' : '' ?>"
                        id="insurance-cost"
                        name="insurance_cost"
                        placeholder="1000000"
                        value="<?= old('insurance_cost') ?>" />
                    <div class="invalid-feedback">
                        <?= session('errors.insurance_cost') ?>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Add Insurance Record</button>
                    <a href="<?= site_url('insurance') ?>" class="btn btn-outline-secondary ms-2">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $this->endSection() ?>
