<?php $__env->startSection('page-title', 'Transaksi'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Daftar Transaksi</h4>
        <p class="text-muted small mb-0">Verifikasi pembayaran dan kelola booking</p>
    </div>
</div>

<!-- Filter -->
<div class="card p-3 mb-4" style="border-radius:10px;">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Cari kode booking atau nama..." value="<?php echo e(request('search')); ?>">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Semua Status</option>
                <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Pending</option>
                <option value="confirmed" <?php echo e(request('status') == 'confirmed' ? 'selected' : ''); ?>>Confirmed</option>
                <option value="cancelled" <?php echo e(request('status') == 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-outline-primary w-100"><i class="bi bi-search"></i></button>
        </div>
    </form>
</div>

<!-- Transactions Table -->
<div class="card" style="border-radius:12px;">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Kode Booking</th>
                    <th>Peserta</th>
                    <th>Event</th>
                    <th>Tiket</th>
                    <th>Total</th>
                    <th>Status Booking</th>
                    <th>Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><span class="fw-medium"><?php echo e($booking->kode_booking); ?></span></td>
                    <td><small><?php echo e($booking->user->name); ?></small></td>
                    <td><small><?php echo e(Str::limit($booking->event->nama_event, 20)); ?></small></td>
                    <td><small><?php echo e($booking->jumlah_tiket); ?></small></td>
                    <td><small class="fw-bold" style="color:var(--primary);">Rp <?php echo e(number_format($booking->total_harga, 0, ',', '.')); ?></small></td>
                    <td><span class="badge badge-<?php echo e($booking->status_booking); ?>"><?php echo e(ucfirst($booking->status_booking)); ?></span></td>
                    <td>
                        <?php if($booking->payment): ?>
                        <span class="badge badge-<?php echo e($booking->payment->status_payment); ?>"><?php echo e(ucfirst($booking->payment->status_payment)); ?></span>
                        <?php else: ?>
                        <span class="text-muted small">Belum bayar</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo e(route('admin.transactions.show', $booking)); ?>" class="btn btn-sm btn-outline-primary" title="Detail">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3"><?php echo e($bookings->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MeeTopia\resources\views/admin/transactions/index.blade.php ENDPATH**/ ?>