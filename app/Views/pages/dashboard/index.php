<?php $this->extend('layouts/default') ?>

<?php $this->section('content') ?>
<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Summary Cards -->
<div class="row mb-4">
    <!-- Available Vehicles Card -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span class="fw-medium d-block mb-1">Available Vehicles</span>
                        <div class="d-flex align-items-center">
                            <h3 class="mb-0 me-2"><?= count($availableVehicles) ?></h3>
                            <i class="ri-car-line text-primary" style="font-size: 24px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ongoing Rentals Card -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span class="fw-medium d-block mb-1">Ongoing Rentals</span>
                        <div class="d-flex align-items-center">
                            <h3 class="mb-0 me-2"><?= $ongoingRentalsCount ?></h3>
                            <i class="ri-calendar-check-line text-success" style="font-size: 24px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Revenue Card -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span class="fw-medium d-block mb-1">Total Revenue</span>
                        <div class="d-flex align-items-center">
                            <h3 class="mb-0 me-2">Rp <?= number_format($totalRevenue, 0, ',', '.') ?></h3>
                            <i class="ri-money-dollar-circle-line text-warning" style="font-size: 24px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row mb-4">
    <!-- Rental Status Distribution -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Rental Status Distribution</h5>
            </div>
            <div class="card-body">
                <canvas id="rentalStatusChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Popular Vehicles -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Popular Vehicles</h5>
            </div>
            <div class="card-body">
                <canvas id="popularVehiclesChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Top Customers Table -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Top Customers</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th class="text-end">Total Spent</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($topCustomers as $customer): ?>
                                <tr>
                                    <td><?= esc($customer->first_name) ?> <?= esc($customer->last_name) ?></td>
                                    <td class="text-end">Rp <?= number_format($customer->total_spent, 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <!-- Available Vehicles Table -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Available Vehicles</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php foreach ($availableVehicles as $vehicle) : ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100">
                                <img class="card-img-top" src="/uploads/<?= $vehicle->vehicle_image ?? '/assets/img/default-vehicle.jpg' ?>"
                                    alt="<?= $vehicle->brand ?> <?= $vehicle->model ?>" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $vehicle->brand ?> <?= $vehicle->model ?> (<?= $vehicle->year ?>)</h5>
                                    <div class="mb-3">
                                        <span class="badge bg-primary"><?= $vehicle->vehicle_type ?></span>
                                        <span class="badge <?= $vehicle->status_code === 'available' ? 'bg-success' : 'bg-warning' ?>">
                                            <?= ucfirst($vehicle->status_code) ?>
                                        </span>
                                    </div>
                                    <p class="card-text">
                                        <strong>License Plate:</strong> <?= $vehicle->license_plate_number ?><br>
                                        <strong>Rental Rate:</strong> Rp <?= number_format($vehicle->rental_rate_per_day, 2) ?>/day
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="/vehicles/<?= $vehicle->vehicle_id ?>" class="btn btn-outline-primary">View Details</a>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="ri-more-2-line"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="/vehicles/<?= $vehicle->vehicle_id ?>/edit">
                                                    <i class="ri-pencil-line me-1"></i> Edit
                                                </a>
                                                <a class="dropdown-item" href="/vehicles/<?= $vehicle->vehicle_id ?>/delete"
                                                    onclick="return confirm('Are you sure you want to delete this vehicle?')">
                                                    <i class="ri-delete-bin-6-line me-1"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Initialization -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Rental Status Distribution Chart
        const rentalStatusCtx = document.getElementById('rentalStatusChart').getContext('2d');
        new Chart(rentalStatusCtx, {
            type: 'pie',
            data: {
                labels: <?= json_encode(array_column($rentalStatusDistribution, 'status')) ?>,
                datasets: [{
                    data: <?= json_encode(array_column($rentalStatusDistribution, 'rental_count')) ?>,
                    backgroundColor: [
                        '#696cff',
                        '#71dd37',
                        '#03c3ec',
                        '#ffab00',
                        '#ff3e1d'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Popular Vehicles Chart
        const popularVehiclesCtx = document.getElementById('popularVehiclesChart').getContext('2d');
        new Chart(popularVehiclesCtx, {
            type: 'bar',
            data: {
                labels: <?= json_encode(array_map(function ($v) {
                            return $v->brand . ' ' . $v->model;
                        }, $popularVehicles)) ?>,
                datasets: [{
                    label: 'Total Rentals',
                    data: <?= json_encode(array_column($popularVehicles, 'total_rentals')) ?>,
                    backgroundColor: '#696cff'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
<?php $this->endSection() ?>