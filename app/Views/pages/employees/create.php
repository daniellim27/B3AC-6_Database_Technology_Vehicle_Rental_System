<?php $this->extend('layouts/default') ?>

<?php $this->section('content') ?>
<div class="card mb-6">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Add Employee</h5>
        <small class="text-muted float-end">Employee Addition Form</small>
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

        <form action="/employees/create" method="post">
            <?= csrf_field() ?>

            <!-- Employee ID -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="employee-id">Employee ID</label>
                <div class="col-sm-10">
                    <input
                        type="number"
                        class="form-control <?= session('errors.employee_id') ? 'is-invalid' : '' ?>"
                        id="employee-id"
                        name="employee_id"
                        placeholder="8001"
                        value="<?= old('employee_id') ?>"
                        min="8001" />
                    <div class="invalid-feedback">
                        <?= session('errors.employee_id') ?>
                    </div>
                </div>
            </div>

            <!-- First Name -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="first-name">First Name</label>
                <div class="col-sm-10">
                    <input
                        type="text"
                        class="form-control <?= session('errors.first_name') ? 'is-invalid' : '' ?>"
                        id="first-name"
                        name="first_name"
                        placeholder="John"
                        value="<?= old('first_name') ?>"
                        maxlength="35" />
                    <div class="invalid-feedback">
                        <?= session('errors.first_name') ?>
                    </div>
                </div>
            </div>

            <!-- Last Name -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="last-name">Last Name</label>
                <div class="col-sm-10">
                    <input
                        type="text"
                        class="form-control <?= session('errors.last_name') ? 'is-invalid' : '' ?>"
                        id="last-name"
                        name="last_name"
                        placeholder="Doe"
                        value="<?= old('last_name') ?>"
                        maxlength="35" />
                    <div class="invalid-feedback">
                        <?= session('errors.last_name') ?>
                    </div>
                </div>
            </div>

            <!-- Email -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="email">Email</label>
                <div class="col-sm-10">
                    <input
                        type="email"
                        class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>"
                        id="email"
                        name="email"
                        placeholder="john.doe@example.com"
                        value="<?= old('email') ?>"
                        maxlength="220" />
                    <div class="invalid-feedback">
                        <?= session('errors.email') ?>
                    </div>
                </div>
            </div>

            <!-- Phone Number -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="phone-number">Phone Number</label>
                <div class="col-sm-10">
                    <input
                        type="tel"
                        class="form-control <?= session('errors.phone_number') ? 'is-invalid' : '' ?>"
                        id="phone-number"
                        name="phone_number"
                        placeholder="081234567890"
                        value="<?= old('phone_number') ?>"
                        maxlength="13" />
                    <div class="invalid-feedback">
                        <?= session('errors.phone_number') ?>
                    </div>
                </div>
            </div>

            <!-- Role -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="role">Role</label>
                <div class="col-sm-10">
                    <input
                        type="text"
                        class="form-control <?= session('errors.role') ? 'is-invalid' : '' ?>"
                        id="role"
                        name="role"
                        placeholder="Manager"
                        value="<?= old('role') ?>"
                        maxlength="35" />
                    <div class="invalid-feedback">
                        <?= session('errors.role') ?>
                    </div>
                </div>
            </div>

            <!-- Salary -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="salary">Salary</label>
                <div class="col-sm-10">
                    <input
                        type="number"
                        class="form-control <?= session('errors.salary') ? 'is-invalid' : '' ?>"
                        id="salary"
                        name="salary"
                        placeholder="5000000"
                        value="<?= old('salary') ?>"
                        min="1" />
                    <div class="invalid-feedback">
                        <?= session('errors.salary') ?>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Add Employee</button>
                    <a href="<?= site_url('employees') ?>" class="btn btn-outline-secondary ms-2">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $this->endSection() ?>
