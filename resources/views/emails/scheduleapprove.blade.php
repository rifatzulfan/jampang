<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Jadwal baru telah dibuat</title>
</head>
<body>
    <h2>Jadwal Baru telah Dibuat</h2>
    
    <p>Halo {{ $user->name }},</p>

    @if ($role === 'admin')
        <p>This email is to notify you that a new schedule has been created by {{ $user->name }}.</p>
    @elseif ($role === 'superadmin')
        <p>This email is to notify you that a new schedule has been created by {{ $user->name }}.</p>
    @else
        <p>Terimakasih telah membuat pengajuan peminjaman baru. berikut detail:</p>
    @endif

    <!-- Display schedule details here -->
    <!-- You can access the user's schedule information using $user, for example: -->
    <p>Atas Name: {{ $peminjaman->name }}</p>
    <p>Schedule Name: {{ $user->name }}</p>
    <p>Phone: {{ $user->phone }}</p>
    <p>Instansi: {{ $peminjaman->instansi->name }}</p>
    <p>Kegunaan: {{ $peminjaman->kegunaan->name }}</p>
    <p>Tanggal: {{ $jadwal->tanggal }}</p>
    <p>Jam Mulai: {{ $jadwal->jammulai }}</p>
    <p>Jam Selesai: {{ $jadwal->jamselesai }}</p>
   
    <p>Status saat ini <span style="font-weight: bold;">Diproses</span> Admin akan mengecek pengajuan. Mohon ditunggu ya!!</p>

    <!-- Additional schedule details can be added as needed -->

    <p>Thank you.</p>
</body>
</html>
