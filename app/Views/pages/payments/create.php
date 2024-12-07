<?php $this->extend('layouts/default') ?>

<?php $this->section('content') ?>
<div class="card mb-6">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Add Payment Record</h5>
        <small class="text-muted float-end">Payment Record Addition Form</small>
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

        <form action="/payments/create" method="post">
            <?= csrf_field() ?>

            <!-- Payment ID -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="payment-id">Payment ID</label>
                <div class="col-sm-10">
                    <input
                        type="number"
                        class="form-control <?= session('errors.payment_id') ? 'is-invalid' : '' ?>"
                        id="payment-id"
                        name="payment_id"
                        placeholder="5001"
                        value="<?= old('payment_id') ?>"
                        min="5001" />
                    <div class="invalid-feedback">
                        <?= session('errors.payment_id') ?>
                    </div>
                </div>
            </div>

            <!-- Rental -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="rental-id">Rental</label>
                <div class="col-sm-10">
                    <select
                        class="form-select <?= session('errors.rental_id') ? 'is-invalid' : '' ?>"
                        id="rental-id"
                        name="rental_id">
                        <option value="">Select Rental</option>
                        <?php foreach ($rentals as $id => $name): ?>
                            <option value="<?= $id ?>" <?= old('rental_id') == $id ? 'selected' : '' ?>>
                                <?= esc($name) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= session('errors.rental_id') ?>
                    </div>
                </div>
            </div>

            <!-- Payment Date -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="payment-date">Payment Date</label>
                <div class="col-sm-10">
                    <input
                        type="date"
                        class="form-control <?= session('errors.payment_date') ? 'is-invalid' : '' ?>"
                        id="payment-date"
                        name="payment_date"
                        value="<?= old('payment_date') ?>" />
                    <div class="invalid-feedback">
                        <?= session('errors.payment_date') ?>
                    </div>
                </div>
            </div>

            <!-- Amount -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="payment-amount">Amount</label>
                <div class="col-sm-10">
                    <input
                        type="number"
                        class="form-control <?= session('errors.payment_amount') ? 'is-invalid' : '' ?>"
                        id="payment-amount"
                        name="payment_amount"
                        placeholder="500000"
                        value="<?= old('payment_amount') ?>" />
                    <div class="invalid-feedback">
                        <?= session('errors.payment_amount') ?>
                    </div>
                </div>
            </div>

            <!-- Payment Method -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="payment-method">Payment Method</label>
                <div class="col-sm-10">
                    <select
                        class="form-select <?= session('errors.payment_method') ? 'is-invalid' : '' ?>"
                        id="payment-method"
                        name="payment_method">
                        <option value="">Select Payment Method</option>
                        <option value="Cash" <?= old('payment_method') == 'Cash' ? 'selected' : '' ?>>Cash</option>
                        <option value="Credit Card" <?= old('payment_method') == 'Credit Card' ? 'selected' : '' ?>>Credit Card</option>
                        <option value="Debit Card" <?= old('payment_method') == 'Debit Card' ? 'selected' : '' ?>>Debit Card</option>
                        <option value="Bank Transfer" <?= old('payment_method') == 'Bank Transfer' ? 'selected' : '' ?>>Bank Transfer</option>
                        <option value="E-Wallet" <?= old('payment_method') == 'E-Wallet' ? 'selected' : '' ?>>E-Wallet</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= session('errors.payment_method') ?>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Add Payment Record</button>
                    <a href="<?= site_url('payments') ?>" class="btn btn-outline-secondary ms-2">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $this->endSection() ?>
