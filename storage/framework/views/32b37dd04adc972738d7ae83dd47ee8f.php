<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>E-Ticket - <?php echo e($ticket->kode_tiket); ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        .ticket { max-width: 600px; margin: 0 auto; border: 2px solid #4F46E5; border-radius: 12px; overflow: hidden; }
        .header { background: #4F46E5; color: white; padding: 20px; text-align: center; }
        .header h1 { margin: 0; font-size: 24px; }
        .qr-section { text-align: center; padding: 20px; background: white; }
        .details { padding: 20px; }
        .details table { width: 100%; }
        .details td { padding: 8px 0; }
        .details td:first-child { color: #64748B; }
        .details td:last-child { font-weight: bold; text-align: right; }
        .footer { background: #F1F5F9; padding: 15px; text-align: center; font-size: 12px; color: #64748B; }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="header">
            <h1>MeeTopia E-Ticket</h1>
            <p style="margin:5px 0 0;opacity:0.8;"><?php echo e($ticket->kode_tiket); ?></p>
        </div>
        <div class="qr-section">
            <?php echo $qrCode; ?>

        </div>
        <div class="details">
            <table>
                <tr><td>Event</td><td><?php echo e($ticket->event->nama_event); ?></td></tr>
                <tr><td>Tanggal</td><td><?php echo e($ticket->event->tanggal->format('d F Y')); ?></td></tr>
                <tr><td>Waktu</td><td><?php echo e($ticket->event->waktu ?? '-'); ?></td></tr>
                <tr><td>Lokasi</td><td><?php echo e($ticket->event->lokasi); ?></td></tr>
                <tr><td>Peserta</td><td><?php echo e($ticket->user->name); ?></td></tr>
                <tr><td>Email</td><td><?php echo e($ticket->user->email); ?></td></tr>
            </table>
        </div>
        <div class="footer">
            Ticket ini sah dan dapat digunakan untuk masuk event. Tunjukkan QR Code saat check-in.
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\MeeTopia\resources\views/tickets/pdf.blade.php ENDPATH**/ ?>