<?php $__env->startSection('page-title', 'Laporan Transaksi'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="<?php echo e(route('admin.reports.index')); ?>" class="text-decoration-none" style="color:var(--primary);"><i class="bi bi-arrow-left"></i> Kembali</a>
        <h4 class="fw-bold mt-2 mb-0">Laporan Transaksi</h4>
        <p class="text-muted small mb-0"><?php echo e($payments->count()); ?> transaksi terverifikasi</p>
    </div>
    <a href="<?php echo e(route('admin.reports.transactions', array_merge(request()->all(), ['export' => 'pdf']))); ?>" class="btn btn-danger btn-sm fw-bold">
        <i class="bi bi-file-earmark-pdf"></i> Export PDF
    </a>
</div>

<!-- Total Revenue Card -->
<div class="card p-4 mb-4" style="border-radius:12px;border-left:4px solid var(--success);">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <span class="text-muted">Total Pendapatan</span>
            <h3 class="fw-bold mb-0" style="color:var(--success);">Rp <?php echo e(number_format($totalPendapatan, 0, ',', '.')); ?></h3>
        </div>
        <i class="bi bi-currency-exchange" style="font-size:2rem;color:var(--success);opacity:0.3;"></i>
    </div>
</div>

<!-- Filter -->
<div class="card p-3 mb-4" style="border-radius:10px;">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-3">
            <label class="form-label small">Dari Tanggal</label>
            <input type="date" name="from_date" class="form-control form-control-sm" value="<?php echo e(request('from_date')); ?>">
        </div>
        <div class="col-md-3">
            <label class="form-label small">Sampai Tanggal</label>
            <input type="date" name="to_date" class="form-control form-control-sm" value="<?php echo e(request('to_date')); ?>">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-outline-primary btn-sm w-100"><i class="bi bi-funnel"></i> Filter</button>
        </div>
    </form>
</div>

<!-- Table -->
<div class="card" style="border-radius:12px;">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Booking</th>
                    <th>Peserta</th>
                    <th>Event</th>
                    <th>Metode</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><small><?php echo e($payment->booking->kode_booking); ?></small></td>
                    <td><small><?php echo e($payment->booking->user->name); ?></small></td>
                    <td><small><?php echo e(Str::limit($payment->booking->event->nama_event, 20)); ?></small></td>
                    <td><small><?php echo e(ucfirst(str_replace('_', ' ', $payment->metode_pembayaran))); ?></small></td>
                    <td><small class="fw-bold">Rp <?php echo e(number_format($payment->jumlah_bayar, 0, ',', '.')); ?></small></td>
                    <td><small><?php echo e($payment->created_at->format('d M Y')); ?></small></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MeeTopia\resources\views/admin/reports/transactions.blade.php ENDPATH**/ ?>