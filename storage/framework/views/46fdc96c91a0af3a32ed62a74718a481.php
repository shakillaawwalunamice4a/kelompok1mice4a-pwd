<?php $__env->startSection('page-title', 'Detail Transaksi'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-4">
    <a href="<?php echo e(route('admin.transactions.index')); ?>" class="text-decoration-none" style="color:var(--primary);">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Transaksi
    </a>
</div>

<div class="row g-4">
    <!-- Booking Info -->
    <div class="col-md-8">
        <div class="card p-4" style="border-radius:12px;">
            <h5 class="fw-bold mb-3">Detail Booking</h5>
            <table class="table">
                <tr><td class="text-muted" style="width:35%;">Kode Booking</td><td class="fw-bold"><?php echo e($booking->kode_booking); ?></td></tr>
                <tr><td class="text-muted">Peserta</td><td><?php echo e($booking->user->name); ?> (<?php echo e($booking->user->email); ?>)</td></tr>
                <tr><td class="text-muted">Event</td><td><?php echo e($booking->event->nama_event); ?></td></tr>
                <tr><td class="text-muted">Jumlah Tiket</td><td><?php echo e($booking->jumlah_tiket); ?></td></tr>
                <tr><td class="text-muted">Total Harga</td><td class="fw-bold fs-5" style="color:var(--primary);">Rp <?php echo e(number_format($booking->total_harga, 0, ',', '.')); ?></td></tr>
                <tr><td class="text-muted">Status Booking</td><td><span class="badge badge-<?php echo e($booking->status_booking); ?>"><?php echo e(ucfirst($booking->status_booking)); ?></span></td></tr>
                <tr><td class="text-muted">Tanggal Booking</td><td><?php echo e($booking->created_at->format('d M Y H:i')); ?></td></tr>
            </table>
        </div>
    </div>

    <!-- Payment & Verify -->
    <div class="col-md-4">
        <?php if($booking->payment): ?>
        <div class="card p-4 mb-3" style="border-radius:12px;">
            <h6 class="fw-bold mb-3">Informasi Pembayaran</h6>
            <table class="table table-sm">
                <tr><td class="text-muted">Metode</td><td><?php echo e(ucfirst(str_replace('_', ' ', $booking->payment->metode_pembayaran))); ?></td></tr>
                <tr><td class="text-muted">Jumlah</td><td class="fw-bold">Rp <?php echo e(number_format($booking->payment->jumlah_bayar, 0, ',', '.')); ?></td></tr>
                <tr><td class="text-muted">Status</td><td><span class="badge badge-<?php echo e($booking->payment->status_payment); ?>"><?php echo e(ucfirst($booking->payment->status_payment)); ?></span></td></tr>
            </table>

            <?php if($booking->payment->bukti_transfer): ?>
            <div class="mb-3">
                <label class="form-label small fw-medium">Bukti Transfer:</label>
                <img src="<?php echo e(Storage::url($booking->payment->bukti_transfer)); ?>" class="img-fluid rounded" alt="Bukti Transfer">
            </div>
            <?php endif; ?>

            <?php if($booking->payment->status_payment === 'pending'): ?>
            <form method="POST" action="<?php echo e(route('admin.payments.verify', $booking->payment)); ?>">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label class="form-label small fw-medium">Catatan (opsional)</label>
                    <textarea name="catatan" class="form-control form-control-sm" rows="2"></textarea>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" name="status_payment" value="verified" class="btn btn-success btn-sm fw-bold flex-fill">
                        <i class="bi bi-check-circle"></i> Verifikasi
                    </button>
                    <button type="submit" name="status_payment" value="rejected" class="btn btn-danger btn-sm fw-bold flex-fill" onclick="return confirm('Tolak pembayaran ini?')">
                        <i class="bi bi-x-circle"></i> Tolak
                    </button>
                </div>
            </form>
            <?php endif; ?>

            <?php if($booking->payment->verified_at): ?>
            <div class="mt-3 p-2 rounded" style="background:var(--gray-50);">
                <small class="text-muted">Diverifikasi: <?php echo e($booking->payment->verified_at->format('d M Y H:i')); ?></small><br>
                <?php if($booking->payment->verifier): ?>
                <small class="text-muted">Oleh: <?php echo e($booking->payment->verifier->name); ?></small>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php else: ?>
        <div class="card p-4 text-center" style="border-radius:12px;">
            <i class="bi bi-credit-card-2-front" style="font-size:2rem;color:var(--gray-300);"></i>
            <p class="text-muted mt-2">Peserta belum mengupload bukti pembayaran</p>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MeeTopia\resources\views/admin/transactions/show.blade.php ENDPATH**/ ?>