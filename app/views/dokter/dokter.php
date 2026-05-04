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

        <div id="main-content-area" class="flex-1 overflow-y-auto pr-2 custom-scrollbar">

            <div id="doctor-list-view" class="flex flex-col gap-4 animate-in fade-in duration-500">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-black text-slate-800">Manajemen Dokter</h2>
                    <button onclick="location.href='<?= BASEURL ?>/admin/dokter/create'" class="bg-blue-900 text-white px-6 py-2.5 rounded-xl text-xs font-bold hover:bg-blue-950 transition flex items-center gap-2 shadow-lg shadow-blue-900/10">
                        <i data-lucide="plus" class="w-4 h-4"></i> Tambah Dokter
                    </button>
                </div>

                <div class="overflow-hidden rounded-lg shadow-sm">
                    <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                        <thead class="bg-slate-100">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-medium text-gray-900">ID</th>
                                <th scope="col" class="px-6 py-4 font-medium text-gray-900">No. STR</th>
                                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Nama Dokter</th>
                                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Spesialis</th>
                                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Email Resmi</th>
                                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Ruang Praktek</th>
                                <th scope="col" class="px-6 py-4 font-medium text-gray-900 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php foreach ($dataDokter as $row) : ?>
                                <tr class="hover:bg-slate-100 transition-colors">
                                    <td class="px-6 py-4 font-semibold text-gray-700">#<?= $row['id_dokter']; ?></td>
                                    <td class="px-6 py-4"><?= $row['no_str']; ?></td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900"><?= $row['nama_dokter']; ?></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2 py-1 text-xs font-medium text-blue-600">
                                            <?= $row['spesialisasi']; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4"><?= $row['email_resmi']; ?></td>
                                    <td class="px-6 py-4"><?= $row['ruangan_praktek']; ?></td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="<?= BASEURL ?>/admin/dokter/profil/<?= $row['id_dokter']; ?>"
                                            class="inline-block rounded-md bg-indigo-600 px-4 py-2 text-xs font-semibold text-white shadow-sm hover:bg-indigo-700 transition-all">
                                            Detail
                                        </a>
                                        <a href="<?= BASEURL ?>/admin/dokter/edit/<?= $row['id_dokter']; ?>"
                                            class="inline-block rounded-md bg-yellow-600 px-4 py-2 text-xs font-semibold text-white shadow-sm hover:bg-yellow-700 transition-all">
                                            <i data-lucide="edit-3" class="inline-block w-4 h-4"></i>

                                        </a>
                                        <a href="<?= BASEURL ?>/admin/dokter/delete/<?= $row['id_dokter']; ?>"
                                            class="inline-block rounded-md bg-red-600 px-4 py-2 text-xs font-semibold text-white shadow-sm hover:bg-red-700 transition-all">
                                            <i data-lucide="trash-2" class="inline-block w-4 h-4"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="doctor-detail-view" class="hidden flex flex-col lg:flex-row gap-8 animate-in fade-in slide-in-from-right duration-500 pb-10">

                <div class="flex-1 flex flex-col gap-6">
                    <div class="flex items-center gap-6 p-6 bg-slate-100 rounded-[35px]">
                        <div class="w-24 h-24 rounded-2xl border-4 border-white shadow-sm overflow-hidden bg-slate-300 shrink-0">
                            <img id="det-img" src="" alt="Avatar">
                        </div>
                        <div>
                            <div class="flex items-center gap-3">
                                <h3 id="det-name" class="text-3xl font-black text-slate-800 tracking-tighter leading-none"></h3>
                                <span id="det-status" class="px-3 py-1 bg-blue-900 text-white text-[10px] font-bold rounded-md uppercase">Spesialis</span>
                            </div>
                            <p id="det-nip" class="text-sm font-bold text-slate-500 mt-2"></p>
                            <p id="det-spec" class="text-xs font-black text-blue-600 uppercase mt-1 tracking-widest"></p>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="md:w-1/3 p-8 bg-slate-100 rounded-[35px] flex flex-col gap-6">
                            <h4 class="font-black text-lg text-slate-800">Informasi Kontak</h4>
                            <div class="space-y-4 text-sm font-bold text-slate-700">
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Email Resmi</p>
                                    <p class="truncate text-blue-900" id="det-email">petra.w@rsud-bp.com</p>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">No. STR</p>
                                    <p>STR-2299-100-2938</p>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Ruang Praktik</p>
                                    <p>Gedung B, Lantai 2, Ruang 204</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex-1 flex flex-col gap-6">
                            <div class="p-8 bg-slate-100 rounded-[35px]">
                                <h4 class="font-black text-lg text-slate-800 mb-4 uppercase tracking-tight">Kredensial Pendidikan</h4>
                                <div class="flex justify-between border-t border-slate-200 pt-4">
                                    <div class="border-r border-slate-300 pr-8">
                                        <p class="text-[10px] font-bold text-slate-400 uppercase">Almamater S1</p>
                                        <p class="text-xs font-bold text-slate-700">Univ. Indonesia</p>
                                    </div>
                                    <div class="border-r border-slate-300 px-8">
                                        <p class="text-[10px] font-bold text-slate-400 uppercase">Spesialisasi</p>
                                        <p class="text-xs font-bold text-slate-700">Saraf</p>
                                    </div>
                                    <div class="pl-8 text-right">
                                        <p class="text-[10px] font-bold text-slate-400 uppercase">Tahun Lulus</p>
                                        <p class="text-xs font-bold text-slate-700">2012</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col gap-4">
                                <h4 class="font-black text-lg text-slate-800 px-2 uppercase tracking-tight">Pengalaman Kerja</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="p-6 bg-slate-100 rounded-[30px]">
                                        <p class="text-[10px] font-bold text-blue-600">2018 - Sekarang</p>
                                        <h5 class="text-sm font-black text-slate-800 mt-1 uppercase">Kepala Tim Bedah Saraf</h5>
                                        <p class="text-[10px] text-slate-500 mt-2 leading-relaxed ">Memimpin lebih dari 200 prosedur bedah saraf kompleks di RSUD Bakti Permana.</p>
                                    </div>
                                    <div class="p-6 bg-slate-100 rounded-[30px]">
                                        <p class="text-[10px] font-bold text-slate-400">2015 - 2018</p>
                                        <h5 class="text-sm font-black text-slate-800 mt-1 uppercase">Junior Resident</h5>
                                        <p class="text-[10px] text-slate-500 mt-2 leading-relaxed">Bertugas di unit gawat darurat bedah trauma pusat.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-4">
                        <h4 class="font-black text-lg text-slate-800 px-2 uppercase">Indikator Kinerja (KPI)</h4>
                        <div class="p-8 bg-slate-100 rounded-[35px] flex justify-around items-center">
                            <div class="flex items-center gap-6">
                                <div class="w-12 h-12 bg-blue-900 rounded-xl flex items-center justify-center text-white shadow-lg">
                                    <i data-lucide="users" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400">Total Pasien</p>
                                    <p class="text-xl font-black text-slate-800">1.240</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-6">
                                <div class="w-12 h-12 bg-blue-900 rounded-xl flex items-center justify-center text-white shadow-lg">
                                    <i data-lucide="award" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400">Rating Kepuasan</p>
                                    <p class="text-xl font-black text-slate-800">4.9/5.0</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-6">
                                <div class="w-12 h-12 bg-blue-900 rounded-xl flex items-center justify-center text-white shadow-lg">
                                    <i data-lucide="clock" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400">Jam Praktik</p>
                                    <p class="text-xl font-black text-slate-800">32h/mgg</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-80 flex flex-col gap-6 shrink-0">
                    <div class="bg-gradient-to-br from-[#042454] to-[#125873] rounded-[30px] p-6 text-white h-52 relative overflow-hidden flex flex-col justify-between shadow-2xl">
                        <div class="absolute inset-0 flex items-center justify-start py-2 px-5 bg-white mt-4 w-fit h-fit pointer-events-none top-0 rounded-r-lg">
                            <h1 class="text-[10px] font-black text-[#0a2d4d] tracking-tighter uppercase">Staff ID - Medical</h1>
                        </div>

                        <div class="flex justify-end items-start relative z-20 mt-2">
                            <i data-lucide="activity" class="text-white/30 w-8 h-8"></i>
                        </div>

                        <div class="relative z-20">
                            <p class="text-[9px] text-white/50 uppercase tracking-[0.2em]">Nama Pemegang</p>
                            <p id="card-name" class="font-black text-sm tracking-tight truncate uppercase"></p>
                            <p id="card-nip" class="text-[10px] font-bold text-cyan-400 mt-1"></p>
                        </div>

                        <div class="absolute right-0 bottom-0 opacity-10 pointer-events-none">
                            <i data-lucide="stethoscope" class="w-32 h-32 -mb-8 -mr-8"></i>
                        </div>
                    </div>

                    <div class="p-8 bg-slate-100 rounded-[35px] flex-1 flex flex-col gap-6 border border-slate-200/50">
                        <h4 class="font-black text-sm text-slate-800 uppercase tracking-widest">Dokumen Sertifikasi</h4>
                        <div class="flex flex-col gap-4">
                            <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-3 hover:scale-[1.02] transition-transform cursor-pointer">
                                <div class="w-10 h-10 bg-blue-900 rounded-lg flex items-center justify-center text-white">
                                    <i data-lucide="file-check" class="w-5 h-5"></i>
                                </div>
                                <div class="overflow-hidden">
                                    <p class="text-[10px] font-black text-slate-800 truncate uppercase">Sertifikat_Spesialis.pdf</p>
                                    <p class="text-[9px] font-bold text-slate-400  tracking-tighter">Verified • Oct 2025</p>
                                </div>
                            </div>
                            <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-3 hover:scale-[1.02] transition-transform cursor-pointer">
                                <div class="w-10 h-10 bg-blue-900 rounded-lg flex items-center justify-center text-white">
                                    <i data-lucide="award" class="w-5 h-5"></i>
                                </div>
                                <div class="overflow-hidden">
                                    <p class="text-[10px] font-black text-slate-800 truncate uppercase">STR_TERKINI_2026.pdf</p>
                                    <p class="text-[9px] font-bold text-slate-400  tracking-tighter">Active • Jun 2030</p>
                                </div>
                            </div>
                        </div>
                        <button class="w-full py-4 border-2 border-dashed border-slate-300 rounded-2xl text-[10px] font-bold text-slate-400 hover:bg-white hover:text-blue-900 hover:border-blue-900 transition mt-auto">
                            + UNGGAH DOKUMEN BARU
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        lucide.createIcons();

        function showDoctorDetail(name, nip, spec) {
            const listView = document.getElementById('doctor-list-view');
            const detailView = document.getElementById('doctor-detail-view');
            const backBtn = document.getElementById('back-button');
            const searchContainer = document.getElementById('search-container');

            backBtn.classList.remove('w-0', 'opacity-0', 'mr-0', 'pointer-events-none');
            backBtn.classList.add('w-12', 'opacity-100', 'mr-4', 'p-3');
            searchContainer.classList.replace('w-[400px]', 'w-[340px]');

            document.getElementById('det-name').innerText = name;
            document.getElementById('card-name').innerText = name;
            document.getElementById('det-nip').innerText = "NIP: " + nip;
            document.getElementById('card-nip').innerText = nip;
            document.getElementById('det-spec').innerText = spec;
            document.getElementById('det-img').src = `https://ui-avatars.com/api/?name=${name.replace(' ', '+')}&background=0f172a&color=fff&bold=true`;

            document.getElementById('det-email').innerText = name.toLowerCase().split(' ')[1] + "@rsud-bp.com";

            listView.classList.add('hidden');
            detailView.classList.remove('hidden');

            document.getElementById('main-content-area').scrollTop = 0;
        }

        function backToList() {
            const listView = document.getElementById('doctor-list-view');
            const detailView = document.getElementById('doctor-detail-view');
            const backBtn = document.getElementById('back-button');
            const searchContainer = document.getElementById('search-container');

            detailView.classList.add('hidden');
            listView.classList.remove('hidden');

            backBtn.classList.add('w-0', 'opacity-0', 'mr-0', 'pointer-events-none');
            backBtn.classList.remove('w-12', 'opacity-100', 'mr-4', 'p-3');
            searchContainer.classList.replace('w-[340px]', 'w-[400px]');
        }


        window.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeAddDoctorModal();
        });
    </script>


</body>

</html>