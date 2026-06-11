<?php $__env->startSection('title', 'E-Ticket'); ?>

<?php $__env->startSection('content'); ?>
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card" style="border-radius:16px;overflow:hidden;">
                    <!-- Header -->
                    <div class="p-4 text-center text-white" style="background:linear-gradient(135deg,var(--primary),var(--secondary));">
                        <i class="bi bi-ticket-perforated-fill fs-1"></i>
                        <h4 class="fw-bold mt-2 mb-0">E-TICKET</h4>
                    </div>

                    <!-- QR Code -->
                    <div class="text-center p-4 bg-white">
                        <?php echo $qrCode; ?>

                        <p class="mt-2 mb-0 fw-bold" style="color:var(--primary);"><?php echo e($ticket->kode_tiket); ?></p>
                    </div>

                    <!-- Ticket Details -->
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <span class="badge badge-<?php echo e($ticket->status); ?> fs-6"><?php echo e(ucfirst($ticket->status)); ?></span>
                        </div>

                        <h5 class="fw-bold text-center mb-3"><?php echo e($ticket->event->nama_event); ?></h5>

                        <table class="table table-sm mb-0">
                            <tr>
                                <td class="text-muted"><i class="bi bi-calendar3"></i> Tanggal</td>
                                <td class="fw-bold text-end"><?php echo e($ticket->event->tanggal->format('d F Y')); ?></td>
                            </tr>
                            <?php if($ticket->event->waktu): ?>
                            <tr>
                                <td class="text-muted"><i class="bi bi-clock"></i> Waktu</td>
                                <td class="fw-bold text-end"><?php echo e($ticket->event->waktu); ?></td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <td class="text-muted"><i class="bi bi-geo-alt"></i> Lokasi</td>
                                <td class="fw-bold text-end"><?php echo e($ticket->event->lokasi); ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted"><i class="bi bi-person"></i> Peserta</td>
                                <td class="fw-bold text-end"><?php echo e($ticket->user->name); ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted"><i class="bi bi-envelope"></i> Email</td>
                                <td class="text-end small"><?php echo e($ticket->user->email); ?></td>
                            </tr>
                        </table>
                    </div>

                    <!-- Actions -->
                    <div class="p-4 pt-0 d-flex gap-2">
                        <?php if($ticket->isActive()): ?>
                        <a href="<?php echo e(route('tickets.download', $ticket)); ?>" class="btn btn-primary flex-fill fw-bold">
                            <i class="bi bi-download"></i> Download PDF
                        </a>
                        <?php endif; ?>
                        <a href="<?php echo e(route('tickets.index')); ?>" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MeeTopia\resources\views/tickets/show.blade.php ENDPATH**/ ?>