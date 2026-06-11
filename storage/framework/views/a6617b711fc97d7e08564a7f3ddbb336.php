<?php $__env->startSection('title', 'Detail Booking'); ?>

<?php $__env->startSection('content'); ?>
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="border-radius:16px;">
                    <div class="card-body p-5">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <h4 class="fw-bold">Detail Booking</h4>
                                <span class="text-muted">Kode: <?php echo e($booking->kode_booking); ?></span>
                            </div>
                            <span class="badge badge-<?php echo e($booking->status_booking); ?> fs-6">
                                <?php echo e(ucfirst($booking->status_booking)); ?>

                            </span>
                        </div>

                        <!-- Event Info -->
                        <div class="card p-3 mb-4" style="border-radius:10px;background:var(--gray-50);">
                            <h6 class="fw-bold"><?php echo e($booking->event->nama_event); ?></h6>

                            <small class="text-muted">
                                <i class="bi bi-calendar3"></i>
                                <?php echo e(\Carbon\Carbon::parse($booking->event->tanggal)->format('d F Y')); ?>

                            </small>
                            <br>

                            <small class="text-muted">
                                <i class="bi bi-geo-alt"></i>
                                <?php echo e($booking->event->lokasi); ?>

                            </small>
                        </div>

                        <!-- Booking Details -->
                        <table class="table">
                            <tr>
                                <td class="text-muted">Jumlah Tiket</td>
                                <td class="fw-bold text-end"><?php echo e($booking->jumlah_tiket); ?></td>
                            </tr>

                            <tr>
                                <td class="text-muted">Harga per Tiket</td>
                                <td class="text-end">
                                    Rp <?php echo e(number_format($booking->event->harga, 0, ',', '.')); ?>

                                </td>
                            </tr>

                            <tr>
                                <td class="text-muted">Total Harga</td>
                                <td class="fw-bold text-end fs-5" style="color:var(--primary);">
                                    Rp <?php echo e(number_format($booking->total_harga, 0, ',', '.')); ?>

                                </td>
                            </tr>

                            <tr>
                                <td class="text-muted">Tanggal Booking</td>
                                <td class="text-end">
                                    <?php echo e(\Carbon\Carbon::parse($booking->created_at)->format('d M Y H:i')); ?>

                                </td>
                            </tr>
                        </table>

                        <!-- Payment Status -->
                        <?php if($booking->payment): ?>
                        <div class="card p-3 mb-3"
                             style="border-radius:10px;border-left:4px solid <?php echo e($booking->payment->status_payment === 'verified' ? 'var(--success)' : ($booking->payment->status_payment === 'rejected' ? 'var(--danger)' : 'var(--accent)')); ?>;">

                            <h6 class="fw-bold">
                                Status Pembayaran:
                                <?php echo e(ucfirst($booking->payment->status_payment)); ?>

                            </h6>

                            <small class="text-muted">
                                Metode:
                                <?php echo e(str_replace('_', ' ', ucfirst($booking->payment->metode_pembayaran))); ?>

                            </small>
                            <br>

                            <?php if($booking->payment->verified_at): ?>
                                <small class="text-muted">
                                    Diverifikasi:
                                    <?php echo e(\Carbon\Carbon::parse($booking->payment->verified_at)->format('d M Y H:i')); ?>

                                </small>
                                <br>
                            <?php endif; ?>

                            <?php if($booking->payment->catatan): ?>
                                <small class="text-muted">
                                    Catatan: <?php echo e($booking->payment->catatan); ?>

                                </small>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>

                        <!-- Tickets -->
                        <?php if($booking->tickets->count() > 0): ?>
                            <h6 class="fw-bold mt-4 mb-3">E-Tickets</h6>

                            <?php $__currentLoopData = $booking->tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="d-flex justify-content-between align-items-center p-2 mb-2 rounded"
                                     style="background:var(--gray-50);">

                                    <div>
                                        <span class="fw-medium">
                                            <?php echo e($ticket->kode_tiket); ?>

                                        </span>

                                        <span class="badge badge-<?php echo e($ticket->status); ?> ms-2">
                                            <?php echo e(ucfirst($ticket->status)); ?>

                                        </span>
                                    </div>

                                    <a href="<?php echo e(route('tickets.show', $ticket)); ?>"
                                       class="btn btn-sm btn-primary">
                                        <i class="bi bi-qr-code"></i> Lihat
                                    </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <div class="mt-4">
                            <a href="<?php echo e(route('bookings.index')); ?>"
                               class="btn btn-outline-primary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MeeTopia\resources\views/bookings/show.blade.php ENDPATH**/ ?>