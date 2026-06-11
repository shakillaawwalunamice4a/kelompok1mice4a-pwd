<?php $__env->startSection('title', 'My Tickets'); ?>

<?php $__env->startSection('content'); ?>
<section class="py-5">
    <div class="container">
        <h3 class="fw-bold mb-4"><i class="bi bi-ticket-perforated" style="color:var(--primary);"></i> My Tickets</h3>

        <?php if($tickets->count() > 0): ?>
        <div class="row g-4">
            <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4">
                <div class="card h-100" style="border-radius:12px;overflow:hidden;">
                    <div class="p-3 text-center" style="background:linear-gradient(135deg,var(--primary),var(--primary-dark));color:white;">
                        <i class="bi bi-qr-code fs-1 opacity-50"></i>
                        <h6 class="fw-bold mb-0 mt-2"><?php echo e($ticket->event->nama_event); ?></h6>
                    </div>
                    <div class="card-body text-center">
                        <span class="badge badge-<?php echo e($ticket->status); ?> mb-3"><?php echo e(ucfirst($ticket->status)); ?></span>
                        <p class="mb-1"><strong>Kode:</strong> <?php echo e($ticket->kode_tiket); ?></p>
                        <p class="text-muted small mb-1"><i class="bi bi-calendar3"></i> <?php echo e($ticket->event->tanggal->format('d M Y')); ?></p>
                        <p class="text-muted small mb-3"><i class="bi bi-geo-alt"></i> <?php echo e(Str::limit($ticket->event->lokasi, 30)); ?></p>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="<?php echo e(route('tickets.show', $ticket)); ?>" class="btn btn-sm btn-primary">
                                <i class="bi bi-eye"></i> Lihat
                            </a>
                            <?php if($ticket->isActive()): ?>
                            <a href="<?php echo e(route('tickets.download', $ticket)); ?>" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-download"></i> Download
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="mt-4"><?php echo e($tickets->links()); ?></div>
        <?php else: ?>
        <div class="text-center py-5">
            <i class="bi bi-ticket-perforated" style="font-size:4rem;color:var(--gray-300);"></i>
            <h5 class="mt-3 text-muted">Belum ada tiket</h5>
            <p class="text-muted">Booking event terlebih dahulu untuk mendapat e-ticket.</p>
            <a href="<?php echo e(route('events.index')); ?>" class="btn btn-primary mt-2">Cari Event</a>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MeeTopia\resources\views/tickets/index.blade.php ENDPATH**/ ?>