<?php $__env->startSection('page-title', 'Kelola Events'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Daftar Event</h4>
        <p class="text-muted small mb-0">Kelola semua event di platform</p>
    </div>
    <a href="<?php echo e(route('admin.events.create')); ?>" class="btn btn-primary fw-bold">
        <i class="bi bi-plus-circle"></i> Tambah Event
    </a>
</div>

<!-- Search & Filter -->
<div class="card p-3 mb-4" style="border-radius:10px;">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-5">
            <input type="text" name="search" class="form-control" placeholder="Cari event..." value="<?php echo e(request('search')); ?>">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Semua Status</option>
                <option value="upcoming" <?php echo e(request('status') == 'upcoming' ? 'selected' : ''); ?>>Upcoming</option>
                <option value="ongoing" <?php echo e(request('status') == 'ongoing' ? 'selected' : ''); ?>>Ongoing</option>
                <option value="completed" <?php echo e(request('status') == 'completed' ? 'selected' : ''); ?>>Completed</option>
                <option value="cancelled" <?php echo e(request('status') == 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-outline-primary w-100"><i class="bi bi-search"></i></button>
        </div>
    </form>
</div>

<!-- Events Table -->
<div class="card" style="border-radius:12px;">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Event</th>
                    <th>Tanggal</th>
                    <th>Lokasi</th>
                    <th>Harga</th>
                    <th>Kuota</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <?php if($event->poster): ?>
                            <img src="<?php echo e(Storage::url($event->poster)); ?>" class="rounded me-2" style="width:40px;height:40px;object-fit:cover;">
                            <?php else: ?>
                            <div class="rounded me-2 bg-light d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                                <i class="bi bi-image small text-muted"></i>
                            </div>
                            <?php endif; ?>
                            <div>
                                <span class="fw-medium"><?php echo e(Str::limit($event->nama_event, 25)); ?></span>
                                <span class="d-block small text-muted"><?php echo e(ucfirst($event->kategori)); ?></span>
                            </div>
                        </div>
                    </td>
                    <td><small><?php echo e($event->tanggal->format('d M Y')); ?></small></td>
                    <td><small><?php echo e(Str::limit($event->lokasi, 20)); ?></small></td>
                    <td><small class="fw-bold" style="color:var(--primary);"><?php if($event->harga==0): ?> GRATIS <?php else: ?> Rp <?php echo e(number_format($event->harga, 0, ',', '.')); ?> <?php endif; ?></small></td>
                    <td><small><?php echo e($event->sisa_kuota); ?>/<?php echo e($event->kuota); ?></small></td>
                    <td><span class="badge badge-<?php echo e($event->status); ?>"><?php echo e(ucfirst($event->status)); ?></span></td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="<?php echo e(route('admin.events.edit', $event)); ?>" class="btn btn-outline-primary" title="Edit"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="<?php echo e(route('admin.events.destroy', $event)); ?>" onsubmit="return confirm('Hapus event ini?')" class="d-inline">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-outline-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3"><?php echo e($events->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MeeTopia\resources\views/admin/events/index.blade.php ENDPATH**/ ?>