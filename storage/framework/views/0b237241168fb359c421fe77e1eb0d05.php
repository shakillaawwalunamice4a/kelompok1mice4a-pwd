<?php $__env->startSection('title', 'Register'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0" style="border-radius:16px;">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold" style="color:var(--primary);">Mee<span style="color:var(--accent);">Topia</span></h2>
                        <p class="text-muted">Buat akun baru</p>
                    </div>

                    <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0 small">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('register')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label class="form-label fw-medium">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>"
                                value="<?php echo e(old('name')); ?>" placeholder="Masukkan nama lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-medium">Email</label>
                            <input type="email" name="email" class="form-control <?php echo e($errors->has('email') ? 'is-invalid' : ''); ?>"
                                value="<?php echo e(old('email')); ?>" placeholder="email@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-medium">Nomor Telepon</label>
                            <input type="text" name="phone" class="form-control" value="<?php echo e(old('phone')); ?>" placeholder="+62 812 xxx">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-medium">Password</label>
                            <input type="password" name="password" class="form-control <?php echo e($errors->has('password') ? 'is-invalid' : ''); ?>"
                                placeholder="Minimal 8 karakter" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-medium">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Ulangi password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold" style="border-radius:10px;">
                            <i class="bi bi-person-plus"></i> Daftar
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-muted small mb-0">Sudah punya akun?
                            <a href="<?php echo e(route('login')); ?>" class="fw-bold text-decoration-none" style="color:var(--primary);">Login</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MeeTopia\resources\views/auth/register.blade.php ENDPATH**/ ?>