<?php $__env->startSection('page-title', 'Laporan Kehadiran'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="<?php echo e(route('admin.reports.index')); ?>" class="text-decoration-none" style="color:var(--primary);"><i class="bi bi-arrow-left"></i> Kembali</a>
        <h4 class="fw-bold mt-2 mb-0">Laporan Kehadiran</h4>
        <p class="text-muted small mb-0"><?php echo e($attendance->count()); ?> data kehadiran</p>
    </div>
    <a href="<?php echo e(route('admin.reports.attendance', array_merge(request()->all(), ['export' => 'excel']))); ?>" class="btn btn-success btn-sm fw-bold">
        <i class="bi bi-file-earmark-excel"></i> Export Excel
    </a>
</div>

<!-- Filter -->
<div class="card p-3 mb-4" style="border-radius:10px;">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-4">
            <label class="form-label small">Event</label>
            <select name="event_id" class="form-select form-select-sm">
                <option value="">Semua Event</option>
                <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($event->id); ?>" <?php echo e(request('event_id') == $event->id ? 'selected' : ''); ?>><?php echo e($event->nama_event); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-outline-primary btn-sm w-100"><i class="bi bi-funnel"></i> Filter</button>
        </div>
    </form>
</div>

<!-- Table -->
<div class="card" style="border-radius:12px;">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Peserta</th>
                    <th>Email</th>
                    <th>Event</th>
                    <th>Kode Tiket</th>
                    <th>Status</th>
                    <th>Check-in</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $attendance; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><small class="fw-medium"><?php echo e($item->user->name); ?></small></td>
                    <td><small><?php echo e($item->user->email); ?></small></td>
                    <td><small><?php echo e(Str::limit($item->event->nama_event, 20)); ?></small></td>
                    <td><small><?php echo e($item->ticket->kode_tiket); ?></small></td>
                    <td>
                        <?php if($item->status === 'checked_in'): ?>
                        <span class="badge badge-verified">Checked In</span>
                        <?php elseif($item->status === 'absent'): ?>
                        <span class="badge badge-cancelled">Absent</span>
                        <?php else: ?>
                        <span class="badge badge-pending">Registered</span>
                        <?php endif; ?>
                    </td>
                    <td><small><?php echo e($item->check_in_time ? $item->check_in_time->format('d M Y H:i') : '-'); ?></small></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MeeTopia\resources\views/admin/reports/attendance.blade.php ENDPATH**/ ?>