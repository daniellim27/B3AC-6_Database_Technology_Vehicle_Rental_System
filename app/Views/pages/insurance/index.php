<?php $this->extend('layouts/default') ?>

<?php $this->section('content') ?>
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Vehicle Insurance Records</h5>
        <a href="<?= site_url('insurance/create') ?>" class="btn btn-primary">Add New Insurance</a>
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
                        <th>Insurance ID</th>
                        <th>Vehicle</th>
                        <th>Company</th>
                        <th>Policy Number</th>
                        <th>Coverage Period</th>
                        <th>Cost</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($insurances as $insurance): ?>
                        <tr>
                            <td><?= $insurance->insurance_id ?></td>
                            <td>
                                <?= esc($insurance->vehicle_brand) ?> <?= esc($insurance->vehicle_model) ?><br>
                                <small class="text-muted"><?= esc($insurance->plate_number) ?></small>
                            </td>
                            <td><?= esc($insurance->insurance_company) ?></td>
                            <td><?= $insurance->insurance_policy_number ?></td>
                            <td>
                                <?= $insurance->coverage_start_date ?> to<br>
                                <?= $insurance->coverage_end_date ?>
                            </td>
                            <td>Rp <?= number_format($insurance->insurance_cost, 0, ',', '.') ?></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ri-more-2-line"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/insurance/<?= $insurance->insurance_id ?>/edit">
                                            <i class="ri-pencil-line me-1"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="/insurance/<?= $insurance->insurance_id ?>/delete" 
                                           onclick="return confirm('Are you sure you want to delete this insurance record?')">
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
