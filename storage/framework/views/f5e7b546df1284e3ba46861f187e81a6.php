<?php $__env->startSection('title', $event->nama_event); ?>

<?php $__env->startSection('content'); ?>
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Event Image -->
            <div class="col-lg-5">
                <div class="card overflow-hidden" style="border-radius:16px;">
                    <?php if($event->poster): ?>
                    <img src="<?php echo e(Storage::url($event->poster)); ?>" class="w-100" alt="<?php echo e($event->nama_event); ?>" style="object-fit:cover;max-height:400px;">
                    <?php else: ?>
                    <div class="d-flex align-items-center justify-content-center bg-light" style="height:300px;">
                        <i class="bi bi-image" style="font-size:5rem;color:var(--gray-300);"></i>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Event Details -->
            <div class="col-lg-7">
                <div class="d-flex gap-2 mb-3">
                    <span class="badge badge-kategori"><?php echo e(ucfirst($event->kategori)); ?></span>
                    <span class="badge" style="background:#D1FAE5;color:#065F46;"><?php echo e(ucfirst($event->status)); ?></span>
                </div>
                <h2 class="fw-bold mb-3"><?php echo e($event->nama_event); ?></h2>

                <div class="row mb-4">
                    <div class="col-sm-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width:40px;height:40px;background:#EEF2FF;">
                                <i class="bi bi-calendar3" style="color:var(--primary);"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Tanggal</small>
                                <strong><?php echo e($event->tanggal->format('d F Y')); ?></strong>
                            </div>
                        </div>
                    </div>
                    <?php if($event->waktu): ?>
                    <div class="col-sm-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width:40px;height:40px;background:#ECFDF5;">
                                <i class="bi bi-clock" style="color:var(--success);"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Waktu</small>
                                <strong><?php echo e($event->waktu); ?></strong>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="col-sm-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width:40px;height:40px;background:#FEF3C7;">
                                <i class="bi bi-geo-alt" style="color:var(--accent);"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Lokasi</small>
                                <strong><?php echo e($event->lokasi); ?></strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width:40px;height:40px;background:#FCE7F3;">
                                <i class="bi bi-people" style="color:#EC4899;"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Kuota</small>
                                <strong><?php echo e($event->sisa_kuota); ?> / <?php echo e($event->kuota); ?> tersisa</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Price & Book -->
                <div class="card p-4 mb-4" style="border-radius:12px;border:2px solid var(--primary);">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">Harga Tiket</small>
                            <h3 class="fw-bold mb-0 price-tag" style="font-size:1.75rem;">
                                <?php if($event->harga == 0): ?> GRATIS <?php else: ?> Rp <?php echo e(number_format($event->harga, 0, ',', '.')); ?> <?php endif; ?>
                            </h3>
                        </div>
                        <?php if(auth()->guard()->check()): ?>
                        <?php if(!$event->isFull()): ?>
                        <a href="<?php echo e(route('bookings.create', $event)); ?>" class="btn btn-primary btn-lg fw-bold px-4">
                            <i class="bi bi-cart-plus"></i> Booking Sekarang
                        </a>
                        <?php else: ?>
                        <button class="btn btn-secondary btn-lg" disabled>Tiket Habis</button>
                        <?php endif; ?>
                        <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-primary btn-lg fw-bold px-4">
                            <i class="bi bi-box-arrow-in-right"></i> Login untuk Booking
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card p-4" style="border-radius:12px;">
                    <h5 class="fw-bold mb-3">Deskripsi Event</h5>
                    <p style="white-space:pre-line;line-height:1.8;"><?php echo e($event->deskripsi); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MeeTopia\resources\views/events/show.blade.php ENDPATH**/ ?>