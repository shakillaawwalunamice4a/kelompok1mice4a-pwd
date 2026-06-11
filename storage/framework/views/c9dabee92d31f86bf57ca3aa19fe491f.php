<?php $__env->startSection('title', 'Booking Tiket'); ?>

<?php $__env->startSection('content'); ?>
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="border-radius:16px;">
                    <div class="card-body p-5">
                        <h4 class="fw-bold mb-4">
                            <i class="bi bi-cart-plus" style="color:var(--primary);"></i> Booking Tiket
                        </h4>

                        <!-- Event Info -->
                        <div class="card mb-4 p-3" style="border-radius:10px;background:var(--gray-50);">
                            <div class="d-flex align-items-center">
                                <div class="rounded d-flex align-items-center justify-content-center me-3" style="width:50px;height:50px;background:var(--primary);color:white;">
                                    <i class="bi bi-calendar-event fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0"><?php echo e($event->nama_event); ?></h6>
                                    <small class="text-muted"><?php echo e($event->tanggal->format('d M Y')); ?> | <?php echo e($event->lokasi); ?></small>
                                </div>
                            </div>
                        </div>

                        <form method="POST" action="<?php echo e(route('bookings.store', $event)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0 small">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                            <?php endif; ?>

                            <div class="mb-3">
                                <label class="form-label fw-medium">Jumlah Tiket</label>
                                <input type="number" name="jumlah_tiket" class="form-control form-control-lg"
                                    min="1" max="<?php echo e($event->sisa_kuota); ?>" value="1" required
                                    id="jumlah_tiket">
                                <small class="text-muted">Maksimal <?php echo e($event->sisa_kuota); ?> tiket tersisa</small>
                            </div>

                            <!-- Price Summary -->
                            <div class="card p-3 mb-4" style="border-radius:10px;background:var(--gray-50);">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Harga per tiket</span>
                                    <span id="harga_satuan">
                                        <?php if($event->harga == 0): ?> GRATIS <?php else: ?> Rp <?php echo e(number_format($event->harga, 0, ',', '.')); ?> <?php endif; ?>
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Jumlah</span>
                                    <span id="jumlah_display">1</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between fw-bold fs-5">
                                    <span>Total</span>
                                    <span id="total_harga" style="color:var(--primary);">
                                        <?php if($event->harga == 0): ?> GRATIS <?php else: ?> Rp <?php echo e(number_format($event->harga, 0, ',', '.')); ?> <?php endif; ?>
                                    </span>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-3 fw-bold" style="border-radius:10px;font-size:1.1rem;">
                                <i class="bi bi-check-circle"></i> Konfirmasi Booking
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->startPush('scripts'); ?>
<script>
    const hargaSatuan = <?php echo e($event->harga); ?>;
    const jumlahInput = document.getElementById('jumlah_tiket');
    const jumlahDisplay = document.getElementById('jumlah_display');
    const totalDisplay = document.getElementById('total_harga');

    jumlahInput.addEventListener('input', function() {
        const jumlah = parseInt(this.value) || 1;
        jumlahDisplay.textContent = jumlah;
        const total = hargaSatuan * jumlah;
        totalDisplay.textContent = hargaSatuan === 0 ? 'GRATIS' : 'Rp ' + total.toLocaleString('id-ID');
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MeeTopia\resources\views/bookings/create.blade.php ENDPATH**/ ?>