<?php $this->extend('layouts/default') ?>

<?php $this->section('content') ?>
<div class="card mb-6">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Edit Payment Record</h5>
        <small class="text-muted float-end">Payment Record Edit Form</small>
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

        <form action="/payments/<?= $payment->payment_id ?>/edit" method="post">
            <?= csrf_field() ?>

            <!-- Payment ID (readonly) -->
            <div class="row mb-4">
                <label class="col-sm-2 col-form-label" for="payment-id">Payment ID</label>
                <div class="col-sm-10">
                    <input
                        type="number"
                        class="form-control"
                        id="payment-id"
                        name="payment_id"
                        value="<?= $payment->payment_id ?>"
                        readonly />
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
                            <option value="<?= $id ?>" <?= $payment->rental_id == $id ? 'selected' : '' ?>>
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
                        value="<?= $payment->payment_date ?>" />
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
                        value="<?= $payment->payment_amount ?>" />
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
                        <option value="Cash" <?= $payment->payment_method == 'Cash' ? 'selected' : '' ?>>Cash</option>
                        <option value="Credit Card" <?= $payment->payment_method == 'Credit Card' ? 'selected' : '' ?>>Credit Card</option>
                        <option value="Debit Card" <?= $payment->payment_method == 'Debit Card' ? 'selected' : '' ?>>Debit Card</option>
                        <option value="Bank Transfer" <?= $payment->payment_method == 'Bank Transfer' ? 'selected' : '' ?>>Bank Transfer</option>
                        <option value="E-Wallet" <?= $payment->payment_method == 'E-Wallet' ? 'selected' : '' ?>>E-Wallet</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= session('errors.payment_method') ?>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Update Payment Record</button>
                    <a href="<?= site_url('payments') ?>" class="btn btn-outline-secondary ms-2">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $this->endSection() ?>
