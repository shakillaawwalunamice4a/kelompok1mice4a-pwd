<?php $__env->startSection('title', 'My Bookings'); ?>

<?php $__env->startSection('content'); ?>
<section class="py-5">
    <div class="container">
        <h3 class="fw-bold mb-4"><i class="bi bi-bookmark" style="color:var(--primary);"></i> My Bookings</h3>

        <?php if($bookings->count() > 0): ?>
        <div class="row g-4">
            <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6">
                <div class="card h-100" style="border-radius:12px;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <span class="badge badge-<?php echo e($booking->status_booking); ?> mb-2"><?php echo e(ucfirst($booking->status_booking)); ?></span>
                                <h6 class="fw-bold mb-1"><?php echo e($booking->event->nama_event); ?></h6>
                                <small class="text-muted"><?php echo e($booking->kode_booking); ?></small>
                            </div>
                            <span class="fw-bold" style="color:var(--primary);">Rp <?php echo e(number_format($booking->total_harga, 0, ',', '.')); ?></span>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block"><i class="bi bi-calendar3"></i> <?php echo e($booking->event->tanggal->format('d M Y')); ?></small>
                            <small class="text-muted d-block"><i class="bi bi-people"></i> <?php echo e($booking->jumlah_tiket); ?> tiket</small>
                            <small class="text-muted d-block"><i class="bi bi-clock"></i> <?php echo e($booking->created_at->format('d M Y H:i')); ?></small>
                        </div>

                        <!-- Payment Status -->
                        <?php if($booking->payment): ?>
                        <div class="alert py-2 mb-3 alert-<?php echo e($booking->payment->status_payment === 'verified' ? 'success' : ($booking->payment->status_payment === 'rejected' ? 'danger' : 'warning')); ?>">
                            <small>
                                <i class="bi bi-<?php echo e($booking->payment->status_payment === 'verified' ? 'check-circle' : ($booking->payment->status_payment === 'rejected' ? 'x-circle' : 'clock')); ?>"></i>
                                Pembayaran: <?php echo e(ucfirst($booking->payment->status_payment)); ?>

                            </small>
                        </div>
                        <?php else: ?>
                        <?php if($booking->status_booking === 'pending'): ?>
                        <a href="<?php echo e(route('bookings.payment', $booking)); ?>" class="btn btn-warning btn-sm w-100 fw-bold text-dark mb-2">
                            <i class="bi bi-credit-card"></i> Upload Bukti Pembayaran
                        </a>
                        <?php endif; ?>
                        <?php endif; ?>

                        <div class="d-flex gap-2">
                            <a href="<?php echo e(route('bookings.show', $booking)); ?>" class="btn btn-sm btn-outline-primary">Detail</a>
                            <?php if($booking->status_booking === 'pending' && !$booking->payment): ?>
                            <form method="POST" action="<?php echo e(route('bookings.cancel', $booking)); ?>" onsubmit="return confirm('Yakin ingin membatalkan booking ini?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('POST'); ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger">Batalkan</button>
                            </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="mt-4"><?php echo e($bookings->links()); ?></div>
        <?php else: ?>
        <div class="text-center py-5">
            <i class="bi bi-bookmark-x" style="font-size:4rem;color:var(--gray-300);"></i>
            <h5 class="mt-3 text-muted">Belum ada booking</h5>
            <a href="<?php echo e(route('events.index')); ?>" class="btn btn-primary mt-3">Cari Event</a>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MeeTopia\resources\views/bookings/index.blade.php ENDPATH**/ ?>