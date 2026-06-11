<?php $__env->startSection('page-title', 'Tambah Event'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-4">
    <a href="<?php echo e(route('admin.events.index')); ?>" class="text-decoration-none" style="color:var(--primary);">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Event
    </a>
</div>

<div class="card p-4" style="border-radius:12px;">
    <h5 class="fw-bold mb-4"><i class="bi bi-plus-circle" style="color:var(--primary);"></i> Tambah Event Baru</h5>

    <form method="POST" action="<?php echo e(route('admin.events.store')); ?>" enctype="multipart/form-data">
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

        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label fw-medium">Nama Event *</label>
                <input type="text" name="nama_event" class="form-control" value="<?php echo e(old('nama_event')); ?>" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Kategori *</label>
                <select name="kategori" class="form-select" required>
                    <option value="">Pilih Kategori</option>
                    <option value="conference" <?php echo e(old('kategori') == 'conference' ? 'selected' : ''); ?>>Conference</option>
                    <option value="seminar" <?php echo e(old('kategori') == 'seminar' ? 'selected' : ''); ?>>Seminar</option>
                    <option value="workshop" <?php echo e(old('kategori') == 'workshop' ? 'selected' : ''); ?>>Workshop</option>
                    <option value="exhibition" <?php echo e(old('kategori') == 'exhibition' ? 'selected' : ''); ?>>Exhibition</option>
                    <option value="webinar" <?php echo e(old('kategori') == 'webinar' ? 'selected' : ''); ?>>Webinar</option>
                    <option value="other" <?php echo e(old('kategori') == 'other' ? 'selected' : ''); ?>>Other</option>
                </select>
            </div>
            <div class="col-12">
                <label class="form-label fw-medium">Deskripsi *</label>
                <textarea name="deskripsi" class="form-control" rows="4" required><?php echo e(old('deskripsi')); ?></textarea>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Tanggal Mulai *</label>
                <input type="date" name="tanggal" class="form-control" value="<?php echo e(old('tanggal')); ?>" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" class="form-control" value="<?php echo e(old('tanggal_selesai')); ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Waktu</label>
                <input type="time" name="waktu" class="form-control" value="<?php echo e(old('waktu')); ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Lokasi *</label>
                <input type="text" name="lokasi" class="form-control" value="<?php echo e(old('lokasi')); ?>" required>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-medium">Kuota *</label>
                <input type="number" name="kuota" class="form-control" min="1" value="<?php echo e(old('kuota')); ?>" required>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-medium">Harga (Rp) *</label>
                <input type="number" name="harga" class="form-control" min="0" step="0.01" value="<?php echo e(old('harga', 0)); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Poster Event</label>
                <input type="file" name="poster" class="form-control" accept="image/*">
                <small class="text-muted">Format: JPG, PNG (maks. 2MB)</small>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary fw-bold px-4">
                <i class="bi bi-check-circle"></i> Simpan Event
            </button>
            <a href="<?php echo e(route('admin.events.index')); ?>" class="btn btn-outline-secondary ms-2">Batal</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MeeTopia\resources\views/admin/events/create.blade.php ENDPATH**/ ?>