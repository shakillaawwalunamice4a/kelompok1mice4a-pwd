<?php $__env->startSection('page-title', 'Reports'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-4">
    <h4 class="fw-bold">Laporan</h4>
    <p class="text-muted small mb-0">Export dan lihat laporan sistem</p>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card p-4 text-center h-100" style="border-radius:12px;">
            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:64px;height:64px;background:#EEF2FF;">
                <i class="bi bi-people" style="font-size:1.5rem;color:var(--primary);"></i>
            </div>
            <h5 class="fw-bold">Laporan Peserta</h5>
            <p class="text-muted small">Data peserta yang sudah terdaftar dan confirmed di event</p>
            <a href="<?php echo e(route('admin.reports.participants')); ?>" class="btn btn-primary btn-sm fw-bold mt-auto">
                <i class="bi bi-eye"></i> Lihat Laporan
            </a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-4 text-center h-100" style="border-radius:12px;">
            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:64px;height:64px;background:#ECFDF5;">
                <i class="bi bi-currency-exchange" style="font-size:1.5rem;color:var(--success);"></i>
            </div>
            <h5 class="fw-bold">Laporan Transaksi</h5>
            <p class="text-muted small">Data pembayaran yang sudah terverifikasi</p>
            <a href="<?php echo e(route('admin.reports.transactions')); ?>" class="btn btn-success btn-sm fw-bold mt-auto">
                <i class="bi bi-eye"></i> Lihat Laporan
            </a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-4 text-center h-100" style="border-radius:12px;">
            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:64px;height:64px;background:#FEF3C7;">
                <i class="bi bi-clipboard-check" style="font-size:1.5rem;color:var(--accent);"></i>
            </div>
            <h5 class="fw-bold">Laporan Kehadiran</h5>
            <p class="text-muted small">Data check-in dan kehadiran peserta event</p>
            <a href="<?php echo e(route('admin.reports.attendance')); ?>" class="btn btn-warning btn-sm text-dark fw-bold mt-auto">
                <i class="bi bi-eye"></i> Lihat Laporan
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MeeTopia\resources\views/admin/reports/index.blade.php ENDPATH**/ ?>