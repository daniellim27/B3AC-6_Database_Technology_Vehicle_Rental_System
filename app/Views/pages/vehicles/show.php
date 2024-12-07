<?php $this->extend('layouts/default') ?>

<?php $this->section('content') ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Vehicle Details</h5>
                    <div>
                        <a href="/vehicles" class="btn btn-secondary me-2">Back to List</a>
                        <a href="/vehicles/<?= $vehicle->vehicle_id ?>/edit" class="btn btn-primary me-2">
                            <i class="ri-pencil-line"></i> Edit Vehicle
                        </a>
                        <a href="/vehicles/<?= $vehicle->vehicle_id ?>/delete" 
                           class="btn btn-danger"
                           onclick="return confirm('Are you sure you want to delete this vehicle?')">
                            <i class="ri-delete-bin-6-line"></i> Delete Vehicle
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <!-- Vehicle Image -->
                        <div class="col-md-6 mb-4">
                            <img src="/uploads/<?= $vehicle->vehicle_image ?? 'assets/img/default-vehicle.jpg' ?>" 
                                 alt="<?= $vehicle->brand ?> <?= $vehicle->model ?>" 
                                 class="img-fluid rounded" 
                                 style="width: 100%; height: 400px; object-fit: cover;">
                        </div>

                        <!-- Vehicle Information -->
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h3 class="text-primary mb-2"><?= $vehicle->brand ?> <?= $vehicle->model ?></h3>
                                <div class="mb-3">
                                    <span class="badge bg-primary"><?= $vehicle->vehicle_type ?></span>
                                    <span class="badge <?= $vehicle->status_code === 'available' ? 'bg-success' : 'bg-warning' ?>">
                                        <?= ucfirst($vehicle->status_code) ?>
                                    </span>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th class="ps-0" style="width: 180px;">Vehicle ID</th>
                                            <td><?= $vehicle->vehicle_id ?></td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0">Year</th>
                                            <td><?= $vehicle->year ?></td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0">License Plate</th>
                                            <td><?= $vehicle->license_plate_number ?></td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0">Rental Rate</th>
                                            <td>Rp <?= number_format($vehicle->rental_rate_per_day, 2) ?>/day</td>
                                        </tr>
                                        <?php if (isset($vehicle->description)): ?>
                                        <tr>
                                            <th class="ps-0">Description</th>
                                            <td><?= $vehicle->description ?></td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                            <?php if ($vehicle->status_code === 'available'): ?>
                            <div class="mt-4">
                                <a href="/rentals/create?vehicle_id=<?= $vehicle->vehicle_id ?>" 
                                   class="btn btn-success btn-lg">
                                    <i class="ri-car-line me-2"></i> Rent This Vehicle
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if (isset($vehicle->features) && !empty($vehicle->features)): ?>
                    <!-- Vehicle Features -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Vehicle Features</h5>
                            <div class="row g-3">
                                <?php foreach ($vehicle->features as $feature): ?>
                                <div class="col-md-3">
                                    <div class="d-flex align-items-center">
                                        <i class="ri-check-line text-success me-2"></i>
                                        <span><?= $feature ?></span>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if (isset($vehicle->maintenance_history) && !empty($vehicle->maintenance_history)): ?>
                    <!-- Maintenance History -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Maintenance History</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>Description</th>
                                            <th>Cost</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($vehicle->maintenance_history as $maintenance): ?>
                                        <tr>
                                            <td><?= $maintenance->date ?></td>
                                            <td><?= $maintenance->type ?></td>
                                            <td><?= $maintenance->description ?></td>
                                            <td>Rp <?= number_format($maintenance->cost, 2) ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>
