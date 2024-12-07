<?php $this->extend('layouts/default') ?>

<?php $this->section('content') ?>
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Employees</h5>
        <a href="<?= site_url('employees/create') ?>" class="btn btn-primary">Add New Employee</a>
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
                        <th>ID</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Role</th>
                        <th>Salary</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employees as $employee): ?>
                        <tr>
                            <td><?= $employee->employee_id ?></td>
                            <td>
                                <?= esc($employee->first_name) ?> <?= esc($employee->last_name) ?>
                            </td>
                            <td>
                                <?= esc($employee->email) ?><br>
                                <small class="text-muted"><?= esc($employee->phone_number) ?></small>
                            </td>
                            <td><?= esc($employee->role) ?></td>
                            <td>Rp <?= number_format($employee->salary, 0, ',', '.') ?></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ri-more-2-line"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/employees/<?= $employee->employee_id ?>/edit">
                                            <i class="ri-pencil-line me-1"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="/employees/<?= $employee->employee_id ?>/delete" 
                                           onclick="return confirm('Are you sure you want to delete this employee?')">
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
