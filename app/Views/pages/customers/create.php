<!-- schema
CREATE TABLE `customers` (
	`customer_id` INT(4) NOT NULL,
	`first_name` VARCHAR(35) NOT NULL COLLATE 'utf8_general_ci',
	`last_name` VARCHAR(35) NOT NULL COLLATE 'utf8_general_ci',
	`email` VARCHAR(320) NOT NULL COLLATE 'utf8_general_ci',
	`phone_number` VARCHAR(13) NOT NULL COLLATE 'utf8_general_ci',
	`address` VARCHAR(35) NOT NULL COLLATE 'utf8_general_ci',
	`driver_license_number` VARCHAR(14) NOT NULL DEFAULT '' COLLATE 'utf8_general_ci',
	`date_of_birth` DATE NOT NULL,
	PRIMARY KEY (`customer_id`) USING BTREE,
	CONSTRAINT `customer_id` CHECK (`customer_id` >= 9001)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
; -->


<?php $this->extend('layouts/default') ?>
<?php $this->section('content') ?>
<div class="card mb-6">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Add Customer</h5>
        <small class="text-muted float-end">Customer Addition Form</small>
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
        <form action="/customers/create" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <!-- Customer ID -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="customer-id">Customer ID</label>
                <div class="col-sm-10">
                    <input
                        type="number"
                        class="form-control <?= session('errors.customer_id') ? 'is-invalid' : '' ?>"
                        id="customer-id"
                        name="customer_id"
                        placeholder="9001"
                        value="<?= old('customer_id') ?>"
                        min="9001" />
                    <div class="invalid-feedback">
                        <?= session('errors.customer_id') ?>
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
                        placeholder="john@example.com"
                        value="<?= old('email') ?>"
                        maxlength="320" />
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
                        placeholder="08123456789"
                        value="<?= old('phone_number') ?>"
                        maxlength="13" />
                    <div class="invalid-feedback">
                        <?= session('errors.phone_number') ?>
                    </div>
                </div>
            </div>

            <!-- Address -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="address">Address</label>
                <div class="col-sm-10">
                    <input
                        type="text"
                        class="form-control <?= session('errors.address') ? 'is-invalid' : '' ?>"
                        id="address"
                        name="address"
                        placeholder="Enter address"
                        value="<?= old('address') ?>"
                        maxlength="35" />
                    <div class="invalid-feedback">
                        <?= session('errors.address') ?>
                    </div>
                </div>
            </div>

            <!-- Driver License Number -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="driver-license-number">Driver License Number</label>
                <div class="col-sm-10">
                    <input
                        type="text"
                        class="form-control <?= session('errors.driver_license_number') ? 'is-invalid' : '' ?>"
                        id="driver-license-number"
                        name="driver_license_number"
                        placeholder="Enter SIM number"
                        value="<?= old('driver_license_number') ?>"
                        maxlength="14" />
                    <div class="invalid-feedback">
                        <?= session('errors.driver_license_number') ?>
                    </div>
                </div>
            </div>

            <!-- Date of Birth -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="date-of-birth">Date of Birth</label>
                <div class="col-sm-10">
                    <input
                        type="date"
                        class="form-control <?= session('errors.date_of_birth') ? 'is-invalid' : '' ?>"
                        id="date-of-birth"
                        name="date_of_birth"
                        value="<?= old('date_of_birth') ?>" />
                    <div class="invalid-feedback">
                        <?= session('errors.date_of_birth') ?>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Add Customer</button>
                    <a href="<?= site_url('customers') ?>" class="btn btn-outline-secondary ms-2">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $this->endSection() ?>