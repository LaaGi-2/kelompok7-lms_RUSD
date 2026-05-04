<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSUD Bakti Permana - Manajemen Dokter</title>
    <link rel="stylesheet" href="/kelompok7-lms_RUSD/public/assets/css/main.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: #e2e8f0;
        border-radius: 10px;
    }

    .sidebar-item-active {
        background-color: #f8fafc;
        border-radius: 16px;
        color: #1e3a8a !important;
    }
</style>

<body class="flex min-h-screen overflow-hidden p-10 bg-slate-50">

    <aside class="w-72 pt-16 pl-2 pr-16 pb-16 flex flex-col gap-8">
        <div class="flex items-center gap-3 px-4 mb-4">
            <img src="/kelompok7-lms_RUSD/public/assets/images/logo.png" alt="Logo">
        </div>

        <nav class="flex flex-col gap-1">
            <a href="dashboard" class="p-4 flex items-center gap-4 text-slate-400 hover:text-blue-900 transition font-medium">
                <i data-lucide="layout-dashboard"></i> Dashboard
            </a>
            <a href="janji-temu.html" class="p-4 flex items-center gap-4 text-slate-400 hover:text-blue-900 transition font-medium">
                <i data-lucide="calendar-check"></i> Janji Temu
            </a>
            <a href="pasien.html" class="p-4 flex items-center gap-4 text-slate-400 hover:text-blue-900 transition font-medium">
                <i data-lucide="users"></i> Pasien
            </a>
            <a href="dokter" class="sidebar-item-active p-4 flex items-center gap-4 font-semibold">
                <i data-lucide="stethoscope" class="text-blue-900"></i> Dokter
            </a>
            <a href="jadwal-dokter.html" class="p-4 flex items-center gap-4 text-slate-400 hover:text-blue-900 transition font-medium">
                <i data-lucide="clipboard-list"></i> Jadwal Dokter
            </a>
            <a href="departemen.html" class="p-4 flex items-center gap-4 text-slate-400 hover:text-blue-900 transition font-medium">
                <i data-lucide="network"></i> Departemen
            </a>
            <a href="pembayaran.html" class="p-4 flex items-center gap-4 text-slate-400 hover:text-blue-900 transition font-medium">
                <i data-lucide="credit-card"></i> Pembayaran
            </a>
        </nav>
    </aside>

    <main class="flex-1 bg-white my-4 mr-4 rounded-[45px] shadow-sm p-10 flex flex-col relative overflow-hidden border border-slate-100">
        <header class="flex justify-between items-center mb-10 shrink-0">
            <div class="flex items-center gap-0" id="header-left-section">
                <button id="back-button" onclick="backToList()"
                    class="overflow-hidden transition-all duration-500 ease-in-out opacity-0 w-0 h-12 bg-slate-100 rounded-2xl hover:bg-slate-200 flex items-center justify-center mr-0 pointer-events-none">
                    <i data-lucide="arrow-left" class="w-5 h-5 text-slate-700 min-w-[20px]"></i>
                </button>

                <div class="relative w-[400px] transition-all duration-500" id="search-container">
                    <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 w-4 h-4"></i>
                    <input type="text" class="w-full pl-12 pr-4 py-3 bg-slate-100 rounded-2xl border-none focus:ring-2 focus:ring-blue-100 outline-none text-sm" placeholder="Cari Dokter (Nama/Spesialisasi)">
                </div>
            </div>

            <div class="flex items-center gap-3 bg-slate-100 pl-2 pr-5 py-2 rounded-full cursor-pointer hover:bg-slate-200 transition">
                <div class="w-8 h-8 bg-slate-800 rounded-full flex items-center justify-center text-white text-xs font-bold">A</div>
                <span class="font-bold text-slate-700 text-sm">Admin</span>
                <i data-lucide="chevron-down" class="w-3 h-3 text-slate-500"></i>
            </div>
        </header>
        <div class="flex-1 p-10 bg-white rounded-[45px] shadow-sm">
    <h2 class="text-2xl font-black text-slate-800 mb-6">Edit Data Dokter</h2>
    <form action="<?= BASEURL ?>/admin/dokter/update" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <!-- ID Tersembunyi -->
    <input type="hidden" name="id_dokter" value="<?= $dokter['id_dokter'] ?>">

    <div class="md:col-span-2">
        <label class="text-[10px] font-black text-slate-400 uppercase">Nama Dokter</label>
        <input type="text" name="nama_dokter" value="<?= $dokter['nama_dokter'] ?>" required class="w-full px-6 py-4 bg-slate-50 rounded-[20px] outline-none">
    </div>
    <div>
        <label class="text-[10px] font-black text-slate-400 uppercase">Nomor STR</label>
        <input type="text" name="no_str" value="<?= $dokter['no_str'] ?>" class="w-full px-6 py-4 bg-slate-50 rounded-[20px] outline-none">
    </div>
    <div>
        <label class="text-[10px] font-black text-slate-400 uppercase">Spesialisasi</label>
        <input type="text" name="spesialisasi" value="<?= $dokter['spesialisasi'] ?>" class="w-full px-6 py-4 bg-slate-50 rounded-[20px] outline-none">
    </div>
    <div>
        <label class="text-[10px] font-black text-slate-400 uppercase">Email Resmi</label>
        <input type="email" name="email_resmi" value="<?= $dokter['email_resmi'] ?>" class="w-full px-6 py-4 bg-slate-50 rounded-[20px] outline-none">
    </div>
    <div>
        <label class="text-[10px] font-black text-slate-400 uppercase">Ruangan Praktek</label>
        <input type="text" name="ruangan_praktek" value="<?= $dokter['ruangan_praktek'] ?>" class="w-full px-6 py-4 bg-slate-50 rounded-[20px] outline-none">
    </div>
    <button type="submit" class="md:col-span-2 py-4 bg-amber-500 text-white rounded-[20px] font-bold">PERBARUI DATA</button>
</form>
</div>
    </main>

</body>

</html>