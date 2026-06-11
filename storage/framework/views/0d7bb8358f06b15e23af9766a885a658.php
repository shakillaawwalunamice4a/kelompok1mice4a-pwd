<?php $__env->startSection('page-title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<!-- Stat Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="stat-icon me-3" style="background:#EEF2FF;"><i class="bi bi-people" style="color:var(--primary);"></i></div>
                <div>
                    <div class="stat-label">Total Users</div>
                    <div class="stat-value"><?php echo e($totalUsers); ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="border-left-color:var(--success);">
            <div class="d-flex align-items-center">
                <div class="stat-icon me-3" style="background:#ECFDF5;"><i class="bi bi-calendar-event" style="color:var(--success);"></i></div>
                <div>
                    <div class="stat-label">Event Aktif</div>
                    <div class="stat-value"><?php echo e($activeEvents); ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="border-left-color:var(--accent);">
            <div class="d-flex align-items-center">
                <div class="stat-icon me-3" style="background:#FEF3C7;"><i class="bi bi-receipt" style="color:var(--accent);"></i></div>
                <div>
                    <div class="stat-label">Total Booking</div>
                    <div class="stat-value"><?php echo e($totalBookings); ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="border-left-color:var(--secondary);">
            <div class="d-flex align-items-center">
                <div class="stat-icon me-3" style="background:#ECFEFF;"><i class="bi bi-currency-exchange" style="color:var(--secondary);"></i></div>
                <div>
                    <div class="stat-label">Total Transaksi</div>
                    <div class="stat-value">Rp <?php echo e(number_format($totalTransactions, 0, ',', '.')); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="stat-card" style="border-left-color:var(--danger);">
            <div class="d-flex align-items-center">
                <div class="stat-icon me-3" style="background:#FEE2E2;"><i class="bi bi-clock-history" style="color:var(--danger);"></i></div>
                <div>
                    <div class="stat-label">Pembayaran Pending</div>
                    <div class="stat-value"><?php echo e($pendingPayments); ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="border-left-color:#8B5CF6;">
            <div class="d-flex align-items-center">
                <div class="stat-icon me-3" style="background:#EDE9FE;"><i class="bi bi-ticket-perforated" style="color:#8B5CF6;"></i></div>
                <div>
                    <div class="stat-label">Tiket Aktif</div>
                    <div class="stat-value"><?php echo e($totalTickets); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Top Events -->
    <div class="col-md-6">
        <div class="card p-4">
            <h6 class="fw-bold mb-3"><i class="bi bi-trophy" style="color:var(--accent);"></i> Top 5 Event</h6>
            <?php if($topEvents->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-sm mb-0">
                    <thead><tr><th>Event</th><th>Booking</th><th>Kuota</th></tr></thead>
                    <tbody>
                        <?php $__currentLoopData = $topEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="fw-medium"><?php echo e(Str::limit($event->nama_event, 30)); ?></td>
                            <td><span class="badge bg-primary"><?php echo e($event->bookings_count); ?></span></td>
                            <td><?php echo e($event->kuota); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <p class="text-muted small">Belum ada data event.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Recent Bookings -->
    <div class="col-md-6">
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-clock-history" style="color:var(--primary);"></i> Booking Terbaru</h6>
                <a href="<?php echo e(route('admin.transactions.index')); ?>" class="small text-decoration-none" style="color:var(--primary);">Lihat Semua</a>
            </div>
            <?php if($recentBookings->count() > 0): ?>
            <?php $__currentLoopData = $recentBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="d-flex justify-content-between align-items-center p-2 mb-2 rounded" style="background:var(--gray-50);">
                <div>
                    <span class="fw-medium small"><?php echo e($booking->user->name); ?></span>
                    <span class="text-muted d-block" style="font-size:0.75rem;"><?php echo e($booking->event->nama_event); ?></span>
                </div>
                <div class="text-end">
                    <span class="badge badge-<?php echo e($booking->status_booking); ?>"><?php echo e(ucfirst($booking->status_booking)); ?></span>
                    <span class="d-block small text-muted">Rp <?php echo e(number_format($booking->total_harga, 0, ',', '.')); ?></span>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <p class="text-muted small">Belum ada booking.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Booking Stats Chart -->
<div class="row g-4 mt-1">
    <div class="col-12">
        <div class="card p-4">
            <h6 class="fw-bold mb-3"><i class="bi bi-graph-up" style="color:var(--primary);"></i> Statistik Booking (6 Bulan Terakhir)</h6>
            <?php if($bookingStats->count() > 0): ?>
            <div class="d-flex align-items-end gap-2" style="height:200px;">
                <?php
                    $maxBooking = $bookingStats->max('total') ?: 1;
                ?>
                <?php $__currentLoopData = $bookingStats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex-fill text-center">
                    <div class="d-flex flex-column align-items-center justify-content-end" style="height:180px;">
                        <span class="small fw-bold mb-1"><?php echo e($stat->total); ?></span>
                        <div style="width:100%;max-width:60px;height:<?php echo e(($stat->total / $maxBooking) * 150); ?>px;background:linear-gradient(to top,var(--primary),var(--primary-light));border-radius:6px 6px 0 0;min-height:4px;"></div>
                    </div>
                    <small class="text-muted" style="font-size:0.7rem;"><?php echo e(\Carbon\Carbon::parse($stat->month . '-01')->format('M Y')); ?></small>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php else: ?>
            <p class="text-muted small">Belum ada data statistik.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MeeTopia\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>