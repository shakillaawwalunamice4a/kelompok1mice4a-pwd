<?php $__env->startSection('title', 'Daftar Event'); ?>

<?php $__env->startSection('content'); ?>
<section class="py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h3 class="fw-bold">Daftar Event</h3>
                <p class="text-muted">Temukan event yang sesuai dengan minat Anda</p>
            </div>
        </div>

        <!-- Search & Filter -->
        <div class="card mb-4" style="border-radius:12px;">
            <div class="card-body">
                <form method="GET" action="<?php echo e(route('events.index')); ?>">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label small fw-medium">Cari Event</label>
                            <input type="text" name="search" class="form-control" placeholder="Nama event..." value="<?php echo e(request('search')); ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-medium">Kategori</label>
                            <select name="kategori" class="form-select">
                                <option value="">Semua Kategori</option>
                                <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($k); ?>" <?php echo e(request('kategori') == $k ? 'selected' : ''); ?>><?php echo e(ucfirst($k)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-medium">Urutkan</label>
                            <select name="sort" class="form-select">
                                <option value="terlama" <?php echo e(request('sort') == 'terlama' ? 'selected' : ''); ?>>Terdekat</option>
                                <option value="terbaru" <?php echo e(request('sort') == 'terbaru' ? 'selected' : ''); ?>>Terbaru</option>
                                <option value="termurah" <?php echo e(request('sort') == 'termurah' ? 'selected' : ''); ?>>Termurah</option>
                                <option value="termahal" <?php echo e(request('sort') == 'termahal' ? 'selected' : ''); ?>>Termahal</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i> Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Events Grid -->
        <?php if($events->count() > 0): ?>
        <div class="row g-4">
            <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4">
                <div class="card event-card h-100">
                    <?php if($event->poster): ?>
                    <img src="<?php echo e(Storage::url($event->poster)); ?>" class="card-img-top" alt="<?php echo e($event->nama_event); ?>">
                    <?php else: ?>
                    <div class="card-img-top d-flex align-items-center justify-content-center bg-light" style="height:200px;">
                        <i class="bi bi-image" style="font-size:3rem;color:var(--gray-300);"></i>
                    </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <div class="d-flex gap-2 mb-2">
                            <span class="badge badge-kategori"><?php echo e(ucfirst($event->kategori)); ?></span>
                            <?php if($event->isFull()): ?>
                            <span class="badge bg-danger">Full</span>
                            <?php endif; ?>
                        </div>
                        <h6 class="fw-bold"><?php echo e($event->nama_event); ?></h6>
                        <p class="text-muted small mb-1">
                            <i class="bi bi-calendar3"></i> <?php echo e($event->tanggal->format('d M Y')); ?>

                            <?php if($event->waktu): ?> <?php echo e($event->waktu); ?> <?php endif; ?>
                        </p>
                        <p class="text-muted small mb-1">
                            <i class="bi bi-geo-alt"></i> <?php echo e(Str::limit($event->lokasi, 40)); ?>

                        </p>
                        <p class="text-muted small mb-2">
                            <i class="bi bi-people"></i> Sisa <?php echo e($event->sisa_kuota); ?> dari <?php echo e($event->kuota); ?> tiket
                        </p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="price-tag">
                                <?php if($event->harga == 0): ?> GRATIS <?php else: ?> Rp <?php echo e(number_format($event->harga, 0, ',', '.')); ?> <?php endif; ?>
                            </span>
                            <a href="<?php echo e(route('events.show', $event)); ?>" class="btn btn-sm btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="mt-4">
            <?php echo e($events->withQueryString()->links()); ?>

        </div>
        <?php else: ?>
        <div class="text-center py-5">
            <i class="bi bi-calendar-x" style="font-size:4rem;color:var(--gray-300);"></i>
            <h5 class="mt-3 text-muted">Tidak ada event ditemukan</h5>
            <p class="text-muted">Coba ubah filter pencarian Anda.</p>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MeeTopia\resources\views/events/index.blade.php ENDPATH**/ ?>