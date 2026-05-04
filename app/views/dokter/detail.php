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
        <div id="doctor-detail-view" class="flex flex-col lg:flex-row gap-8 animate-in fade-in slide-in-from-right duration-500 pb-10">

            <div class="flex-1 flex flex-col gap-6">
                <div class="flex items-center gap-6 p-6 bg-slate-100 rounded-[35px]">
                    <div class="w-24 h-24 rounded-2xl border-4 border-white shadow-sm overflow-hidden bg-slate-300 shrink-0">
                        <!-- Gunakan foto dari database jika ada, jika tidak pakai placeholder -->
                        <img id="det-img" src="<?= BASEURL ?>/public/img/<?= $dokter['foto'] ?? 'default.jpg' ?>" alt="Avatar">
                    </div>
                    <div>
                        <div class="flex items-center gap-3">
                            <h3 id="det-name" class="text-3xl font-black text-slate-800 tracking-tighter leading-none">
                                <?= $dokter['nama_dokter'] ?>
                            </h3>
                            <span id="det-status" class="px-3 py-1 bg-blue-900 text-white text-[10px] font-bold rounded-md uppercase">
                                <?= $dokter['spesialisasi'] ?>
                            </span>
                        </div>
                        <p id="det-nip" class="text-sm font-bold text-slate-500 mt-2">NIP: <?= $dokter['nip'] ?? '-' ?></p>
                        <p id="det-spec" class="text-xs font-black text-blue-600 uppercase mt-1 tracking-widest">
                            Spesialisasi: <?= $dokter['spesialisasi'] ?>
                        </p>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row gap-6">
                    <!-- Kontak -->
                    <div class="md:w-1/3 p-8 bg-slate-100 rounded-[35px] flex flex-col gap-6">
                        <h4 class="font-black text-lg text-slate-800">Informasi Kontak</h4>
                        <div class="space-y-4 text-sm font-bold text-slate-700">
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Email Resmi</p>
                                <p class="truncate text-blue-900" id="det-email"><?= $dokter['email_resmi'] ?? 'tidak ada email' ?></p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">No. STR</p>
                                <p><?= $dokter['no_str'] ?? 'STR-XXXX-XXXX' ?></p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Ruang Praktik</p>
                                <p><?= $dokter['ruangan_praktek'] ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Pendidikan & Pengalaman -->
                    <div class="flex-1 flex flex-col gap-6">
                        <div class="p-8 bg-slate-100 rounded-[35px]">
                            <h4 class="font-black text-lg text-slate-800 mb-4 uppercase tracking-tight">Kredensial Pendidikan</h4>
                            <div class="flex justify-between border-t border-slate-200 pt-4">
                                <div class="border-r border-slate-300 pr-8">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase">Almamater</p>
                                    <p class="text-xs font-bold text-slate-700"><?= $dokter['almamater'] ?? 'Univ. Indonesia' ?></p>
                                </div>
                                <div class="border-r border-slate-300 px-8">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase">Spesialisasi</p>
                                    <p class="text-xs font-bold text-slate-700"><?= $dokter['spesialisasi'] ?></p>
                                </div>
                                <div class="pl-8 text-right">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase">Tahun Lulus</p>
                                    <p class="text-xs font-bold text-slate-700"><?= $dokter['tahun_lulus'] ?? '2012' ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sisi Kanan: ID Card Staff -->
            <div class="w-full lg:w-80 flex flex-col gap-6 shrink-0">
                <div class="bg-gradient-to-br from-[#042454] to-[#125873] rounded-[30px] p-6 text-white h-52 relative overflow-hidden flex flex-col justify-between shadow-2xl">
                    <div class="absolute inset-0 flex items-center justify-start py-2 px-5 bg-white mt-4 w-fit h-fit pointer-events-none top-0 rounded-r-lg">
                        <h1 class="text-[10px] font-black text-[#0a2d4d] tracking-tighter uppercase">Staff ID - Medical</h1>
                    </div>
                    <div class="relative z-20 mt-8">
                        <p class="text-[9px] text-white/50 uppercase tracking-[0.2em]">Nama Pemegang</p>
                        <p id="card-name" class="font-black text-sm tracking-tight truncate uppercase"><?= $dokter['nama_dokter'] ?></p>
                        <p id="card-nip" class="text-[10px] font-bold text-cyan-400 mt-1"><?= $dokter['nip'] ?? 'NIP. XXXXX' ?></p>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

</html>