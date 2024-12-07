<?php $this->extend('layouts/default') ?>

<?php $this->section('content') ?>
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Vehicle Maintenance Records</h5>
        <a href="<?= site_url('maintenances/create') ?>" class="btn btn-primary">Add New Maintenance Record</a>
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
                        <th>Maintenance ID</th>
                        <th>Vehicle</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Cost</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($maintenances as $maintenance): ?>
                        <tr>
                            <td><?= $maintenance->maintenance_id ?></td>
                            <td><?= esc($maintenance->vehicle_brand) . ' ' . esc($maintenance->vehicle_model) ?></td>
                            <td><?= $maintenance->maintenance_date ?></td>
                            <td><?= esc($maintenance->maintenance_description) ?></td>
                            <td>Rp <?= number_format($maintenance->maintenance_cost, 0, ',', '.') ?></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ri-more-2-line"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/maintenances/<?= $maintenance->maintenance_id ?>/edit">
                                            <i class="ri-pencil-line me-1"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="/maintenances/<?= $maintenance->maintenance_id ?>/delete" 
                                           onclick="return confirm('Are you sure you want to delete this maintenance record?')">
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
