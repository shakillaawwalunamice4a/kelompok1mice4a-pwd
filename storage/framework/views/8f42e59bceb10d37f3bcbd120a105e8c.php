<?php $__env->startSection('title', 'Upload Pembayaran'); ?>

<?php $__env->startSection('content'); ?>
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card" style="border-radius:16px;">
                    <div class="card-body p-5">
                        <h4 class="fw-bold mb-4">
                            <i class="bi bi-credit-card" style="color:var(--primary);"></i> Upload Bukti Pembayaran
                        </h4>

                        <!-- Booking Summary -->
                        <div class="card p-3 mb-4" style="border-radius:10px;background:var(--gray-50);">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="fw-bold mb-1"><?php echo e($booking->event->nama_event); ?></h6>
                                    <small class="text-muted"><?php echo e($booking->kode_booking); ?></small>
                                </div>
                                <div class="text-end">
                                    <span class="fw-bold fs-5" style="color:var(--primary);">Rp <?php echo e(number_format($booking->total_harga, 0, ',', '.')); ?></span>
                                    <br><small class="text-muted"><?php echo e($booking->jumlah_tiket); ?> tiket</small>
                                </div>
                            </div>
                        </div>

                        <!-- Bank Info -->
                        <div class="card p-3 mb-4" style="border-radius:10px;border:2px dashed var(--primary);">
                            <h6 class="fw-bold mb-2">Informasi Transfer</h6>
                            <p class="mb-1"><strong>Bank:</strong> BCA</p>
                            <p class="mb-1"><strong>No. Rekening:</strong> 1234567890</p>
                            <p class="mb-1"><strong>Atas Nama:</strong> PT MeeTopia Indonesia</p>
                            <p class="mb-0"><strong>Total Transfer:</strong> Rp <?php echo e(number_format($booking->total_harga, 0, ',', '.')); ?></p>
                        </div>

                        <form method="POST" action="<?php echo e(route('bookings.payment.store', $booking)); ?>" enctype="multipart/form-data">
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
                                <label class="form-label fw-medium">Metode Pembayaran</label>
                                <select name="metode_pembayaran" class="form-select" required>
                                    <option value="bank_transfer">Transfer Bank</option>
                                    <option value="e_wallet">E-Wallet</option>
                                    <option value="cash">Cash</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-medium">Bukti Transfer / Pembayaran</label>
                                <input type="file" name="bukti_transfer" class="form-control" accept="image/*" required>
                                <small class="text-muted">Format: JPG, PNG (maks. 2MB)</small>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-3 fw-bold" style="border-radius:10px;">
                                <i class="bi bi-upload"></i> Upload Bukti Pembayaran
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MeeTopia\resources\views/payments/upload.blade.php ENDPATH**/ ?>