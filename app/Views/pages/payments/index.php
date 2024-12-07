<?php $this->extend('layouts/default') ?>

<?php $this->section('content') ?>
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Payment Records</h5>
        <a href="<?= site_url('payments/create') ?>" class="btn btn-primary">Add New Payment</a>
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
                        <th>Payment ID</th>
                        <th>Rental Details</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($payments as $payment): ?>
                        <tr>
                            <td><?= $payment->payment_id ?></td>
                            <td>
                                Rental #<?= $payment->rental_id ?><br>
                                <small class="text-muted">
                                    <?= esc($payment->customer_name) ?> - 
                                    <?= esc($payment->vehicle_brand) ?> <?= esc($payment->vehicle_model) ?>
                                </small>
                            </td>
                            <td><?= $payment->payment_date ?></td>
                            <td>Rp <?= number_format($payment->payment_amount, 0, ',', '.') ?></td>
                            <td><?= esc($payment->payment_method) ?></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ri-more-2-line"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/payments/<?= $payment->payment_id ?>/edit">
                                            <i class="ri-pencil-line me-1"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="/payments/<?= $payment->payment_id ?>/delete" 
                                           onclick="return confirm('Are you sure you want to delete this payment record?')">
                                            <i class="ri-delete-bin-6-line me-1"></i> Delete
                                        </a>
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
