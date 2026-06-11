<?php $__env->startSection('page-title', 'Laporan Peserta'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="<?php echo e(route('admin.reports.index')); ?>" class="text-decoration-none" style="color:var(--primary);"><i class="bi bi-arrow-left"></i> Kembali</a>
        <h4 class="fw-bold mt-2 mb-0">Laporan Peserta</h4>
        <p class="text-muted small mb-0"><?php echo e($bookings->count()); ?> data peserta</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?php echo e(route('admin.reports.participants', array_merge(request()->all(), ['export' => 'pdf']))); ?>" class="btn btn-danger btn-sm fw-bold">
            <i class="bi bi-file-earmark-pdf"></i> Export PDF
        </a>
        <a href="<?php echo e(route('admin.reports.participants', array_merge(request()->all(), ['export' => 'excel']))); ?>" class="btn btn-success btn-sm fw-bold">
            <i class="bi bi-file-earmark-excel"></i> Export Excel
        </a>
    </div>
</div>

<!-- Filter -->
<div class="card p-3 mb-4" style="border-radius:10px;">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-3">
            <label class="form-label small">Event</label>
            <select name="event_id" class="form-select form-select-sm">
                <option value="">Semua Event</option>
                <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($event->id); ?>" <?php echo e(request('event_id') == $event->id ? 'selected' : ''); ?>><?php echo e($event->nama_event); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label small">Dari Tanggal</label>
            <input type="date" name="from_date" class="form-control form-control-sm" value="<?php echo e(request('from_date')); ?>">
        </div>
        <div class="col-md-3">
            <label class="form-label small">Sampai Tanggal</label>
            <input type="date" name="to_date" class="form-control form-control-sm" value="<?php echo e(request('to_date')); ?>">
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
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Event</th>
                    <th>Tiket</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><small><?php echo e($booking->kode_booking); ?></small></td>
                    <td><small class="fw-medium"><?php echo e($booking->user->name); ?></small></td>
                    <td><small><?php echo e($booking->user->email); ?></small></td>
                    <td><small><?php echo e(Str::limit($booking->event->nama_event, 20)); ?></small></td>
                    <td><small><?php echo e($booking->jumlah_tiket); ?></small></td>
                    <td><small>Rp <?php echo e(number_format($booking->total_harga, 0, ',', '.')); ?></small></td>
                    <td><span class="badge badge-<?php echo e($booking->status_booking); ?>"><?php echo e(ucfirst($booking->status_booking)); ?></span></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MeeTopia\resources\views/admin/reports/participants.blade.php ENDPATH**/ ?>