<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengaduan - SATGAS PPKPT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(20deg, #ffffff, #ff6900);
            height: max-content;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body class=" flex justify-center w-full">
    <a href="{{ route('account.pengaduan.show', $pengaduan) }}" class="absolute text-1xl top-4 left-4 text-black-500 hover:text-gray-800 ml-6 mt-4 flex items-center w-auto gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
        </svg>
        Batal
    </a>
    <div class="w-full ml-20 mr-20 mt-10 mb-10">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Edit Pengaduan</h1>
            <p class="text-gray-500">Perbarui formulir pengaduan Anda</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                <p class="font-bold">Terjadi Kesalahan</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM ACTION & METHOD DIUBAH --}}
        <form action="{{ route('account.pengaduan.update', $pengaduan) }}" method="POST" enctype="multipart/form-data" id="pengaduanForm">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 h-fit">
                <div class="flex flex-col">
                    <div class="bg-white p-6 rounded-lg shadow-lg mb-4">
                        <div class="mb-4">
                            <label class="flex items-center">
                                {{-- TAMBAHKAN KONDISI 'checked' UNTUK ANONIM --}}
                                <input type="checkbox" name="anonim" id="anonimCheckbox" value="1" class="form-checkbox h-5 w-5 text-orange-600"
                                    {{ old('anonim', ($pengaduan->nama_pelapor == 'Anonim')) ? 'checked' : '' }}>
                                <span class="ml-2 text-gray-700 ">Kirim sebagai Anonim</span>
                            </label>
                        </div>

                        <div id="identitasPelapor">
                            <div class="mb-3">
                                <label for="nama_pelapor" class="block text-gray-700 font-bold mb-1">Nama Pengadu</label>
                                {{-- SEMUA VALUE DIUBAH UNTUK MENGAMBIL DATA DARI $pengaduan --}}
                                <input placeholder="nama pelapor" type="text" name="nama_pelapor" id="namaPelapor" value="{{ old('nama_pelapor', $pengaduan->nama_pelapor) }}" class="bg-gray-100 w-full px-3 py-2 border rounded-lg">
                            </div>
                            <div class="mb-3">
                                <label for="email_pelapor" class="block text-gray-700 font-bold mb-1">Email</label>
                                <input placeholder="email@gmail.com" type="email" name="email_pelapor" id="emailPelapor" value="{{ old('email_pelapor', $pengaduan->email_pelapor) }}" class="bg-gray-100 w-full px-3 py-2 border rounded-lg">
                            </div>
                            <div>
                                <label for="telepon_pelapor" class="block text-gray-700 font-bold mb-1">No. Telepon/HP</label>
                                <input placeholder="no. telepon" type="text" name="telepon_pelapor" id="teleponPelapor" value="{{ old('telepon_pelapor', $pengaduan->telepon_pelapor) }}" class="bg-gray-100 w-full px-3 py-2 border rounded-lg">
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <div class="mb-4">
                            <label for="judul" class="block text-gray-700 font-bold mb-1">Judul Pengaduan*</label>
                            <input placeholder="judul" type="text" name="judul" value="{{ old('judul', $pengaduan->judul) }}" class="bg-gray-100 w-full px-3 py-2 border rounded-lg" required>
                        </div>
                        <div class="mb-4">
                            <label for="kategori_id" class="block text-gray-700 font-bold mb-2">Kategori Pengaduan*</label>
                            <select name="kategori_id" id="kategoriSelect" class="bg-gray-100 w-full px-3 py-2 border rounded-lg" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoris as $kategori)
                                {{-- TAMBAHKAN KONDISI 'selected' UNTUK KATEGORI --}}
                                <option value="{{ $kategori->id }}" data-nama="{{ $kategori->nama_kategori }}" {{ old('kategori_id', $pengaduan->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div id="kategoriLainnyaContainer" class="hidden mb-4">
                            <label for="kategori_lainnya" class="block text-gray-700 font-bold mb-2">Sebutkan Kategori Lainnya*</label>
                            <input type="text" name="kategori_lainnya" id="kategoriLainnyaInput" value="{{ old('kategori_lainnya', $pengaduan->kategori_lainnya) }}" class="bg-gray-100 w-full px-3 py-2 border rounded-lg">
                        </div>
                    </div>
                </div>

                <div class="flex flex-col items-center bg-white p-6 rounded-lg shadow-lg mb-4 w-full h-full">
                    <p class="block text-gray-700 font-bold mb-2 flex justify-center">Bukti Kejadian</p>
                    <div class="flex items-center justify-center space-x-4 flex-col w-full h-full">
                        <div id="preview-container" class="w-auto h-auto flex-shrink-0 bg-gray-200 rounded-lg flex items-center justify-center p-1">
                            <img id="image-preview" class="hidden w-full h-full object-cover rounded-lg"/>
                            <video id="video-preview" class="hidden w-full h-full object-cover rounded-lg" controls></video>
                            {{-- UBAH PREVIEW DEFAULT UNTUK MENAMPILKAN BUKTI LAMA --}}
                            <div id="preview-placeholder" class="text-center text-gray-400">
                                @if($pengaduan->foto_kejadian)
                                    @if(Str::contains($pengaduan->foto_kejadian, ['.jpg', '.jpeg', '.png', '.gif']))
                                        <img src="{{ Storage::url($pengaduan->foto_kejadian) }}" class="w-full h-full object-cover rounded-lg">
                                    @else
                                        <video src="{{ Storage::url($pengaduan->foto_kejadian) }}" controls class="w-full h-full object-cover rounded-lg"></video>
                                    @endif
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row mt-2 gap-1 items-center w-full h-auto">
                        <label for="foto_kejadian" class="w-max cursor-pointer bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors">
                            Ganti File
                        </label>
                        <input type="file" name="foto_kejadian" id="foto_kejadian" class="hidden" accept="image/*,video/*">
                        <div id="file-info" class="text-sm text-gray-500 items-center h-auto flex items-center flex-row bg-gray-100 w-full px-3 py-2 border rounded-lg">
                            <p id="file-name">{{ $pengaduan->foto_kejadian ? basename($pengaduan->foto_kejadian) : 'Tidak ada file dipilih.' }}</p>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2 w-full h-auto">Format: PNG, JPG, JPEG, MP4, AVI, MOV (maks 20MB)</p>
                </div>
            </div>

            <div class="mt-4 p-6 bg-white rounded-lg shadow-lg">
                <label for="isi_laporan" class="block text-gray-700 font-bold mb-2">Kronologi Kejadian*</label>
                <textarea name="isi_laporan" rows="5" class="bg-gray-100 w-full px-3 py-2 border rounded-lg" required>{{ old('isi_laporan', $pengaduan->isi_laporan) }}</textarea>
            </div>
            <div class="mt-6">
                <label class="flex items-start">
                    <input type="checkbox" name="persetujuan" id="persetujuanCheckbox" value="1" class="form-checkbox h-5 w-5 text-orange-600 mt-1" required>
                    <span class="ml-2 text-gray-700">Apakah anda yakin sudah mengisi dengan benar dan sejujurnya?<br><small>Pastikan semua data yang anda masukkan sudah benar sebelum mengirim untuk pertimbangan penanganan.</small></span>
                </label>
            </div>
            <div class="mt-8 text-center">
                <button type="submit" id="submitButton" class="w-full md:w-1/2 bg-gray-800 text-white py-3 rounded-lg hover:bg-gray-900 disabled:bg-gray-400 disabled:cursor-not-allowed" disabled>Simpan Perubahan</button>
            </div>
        </form>
    </div>

    {{-- SCRIPT TETAP SAMA KARENA SUDAH DIDESAIN UNTUK ADAPTIF --}}
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const anonimCheckbox = document.getElementById('anonimCheckbox');
        const identitasPelapor = document.getElementById('identitasPelapor');
        const namaPelaporInput = document.getElementById('namaPelapor');
        const emailPelaporInput = document.getElementById('emailPelapor');
        const teleponPelaporInput = document.getElementById('teleponPelapor');
        const submitButton = document.getElementById('submitButton');
        const persetujuanCheckbox = document.getElementById('persetujuanCheckbox');
        const fileInput = document.getElementById('foto_kejadian');
        const imagePreview = document.getElementById('image-preview');
        const videoPreview = document.getElementById('video-preview');
        const previewPlaceholder = document.getElementById('preview-placeholder');
        const fileNameDisplay = document.getElementById('file-name');
        const kategoriSelect = document.getElementById('kategoriSelect');
        const kategoriLainnyaContainer = document.getElementById('kategoriLainnyaContainer');
        const kategoriLainnyaInput = document.getElementById('kategoriLainnyaInput');

        // === Logika untuk Anonim ===
        function toggleIdentitas() {
            const isAnonim = anonimCheckbox.checked;
            identitasPelapor.style.display = isAnonim ? 'none' : 'block';
            if ({{ auth()->check() ? 'false' : 'true' }}) { // Hanya set required untuk tamu
                namaPelaporInput.required = !isAnonim;
                emailPelaporInput.required = !isAnonim;
                teleponPelaporInput.required = !isAnonim;
            }
        }

        // === Logika untuk Kategori Lainnya ===
        function toggleKategoriLainnya() {
            const selectedOption = kategoriSelect.options[kategoriSelect.selectedIndex];
            const isLainnya = selectedOption.dataset.nama?.toLowerCase() === 'lainnya';
            kategoriLainnyaContainer.classList.toggle('hidden', !isLainnya);
            kategoriLainnyaInput.required = isLainnya;
            if (!isLainnya) {
                kategoriLainnyaInput.value = '';
            }
        }

        // === Logika untuk Tombol Kirim ===
        function toggleSubmitButton() {
            submitButton.disabled = !persetujuanCheckbox.checked;
        }

        // === Logika untuk Preview File ===
        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                fileNameDisplay.textContent = file.name;
                previewPlaceholder.classList.add('hidden');
                const fileType = file.type;
                imagePreview.classList.add('hidden');
                videoPreview.classList.add('hidden');

                if (fileType.startsWith('image/')) {
                    imagePreview.src = URL.createObjectURL(file);
                    imagePreview.classList.remove('hidden');
                } else if (fileType.startsWith('video/')) {
                    videoPreview.src = URL.createObjectURL(file);
                    videoPreview.classList.remove('hidden');
                } else {
                    previewPlaceholder.classList.remove('hidden');
                }
            }
        });

        // === Event Listeners ===
        anonimCheckbox.addEventListener('change', toggleIdentitas);
        kategoriSelect.addEventListener('change', toggleKategoriLainnya);
        persetujuanCheckbox.addEventListener('change', toggleSubmitButton);

        // === Panggil fungsi saat halaman pertama kali dimuat untuk menyesuaikan dengan data yang ada ===
        toggleIdentitas();
        toggleKategoriLainnya();
        toggleSubmitButton();
    });
    </script>
</body>
</html>
