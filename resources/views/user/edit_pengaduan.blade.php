<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengaduan - SATGAS PPKPT</title>
    <link rel="icon" type="image/png" href="https://stimata.ac.id/media/2023/01/ICON-STIMATA-1536x1536.png">
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
                                <input type="checkbox" name="anonim" id="anonimCheckbox" value="1" class="form-checkbox h-5 w-5 text-orange-600"
                                    {{ old('anonim', ($pengaduan->nama_pelapor == 'Anonim')) ? 'checked' : '' }}>
                                <span class="ml-2 text-gray-700 ">Kirim sebagai Anonim</span>
                            </label>
                        </div>

                        <div id="identitasPelapor">
                            <div class="mb-3">
                                <label for="nama_pelapor" class="block text-gray-700 font-bold mb-1">Nama Pengadu</label>
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

                <div class="flex flex-col bg-white p-6 rounded-lg shadow-lg mb-4 w-full h-full">
                    <p class="block text-gray-700 font-bold mb-2 flex items-center justify-center h-auto w-full">Bukti Kejadian</p>
                    <div class="flex items-center justify-center space-x-4 flex-col w-full h-full">
                        <div id="preview-container" class="w-full bg-gray-200 rounded-lg grid grid-cols-3 gap-2 mb-4 min-h-[100px] max-h-[300px] p-2">
                            @foreach($pengaduan->bukti as $bukti)
                            <div class="w-full h-auto bg-gray-100 rounded-lg shadow-sm flex flex-col">
                                <div class="relative w-full h-24 bg-gray-200 rounded-t-lg">
                                    @if($bukti->file_type == 'image')
                                    <img src="{{ Storage::url($bukti->file_path) }}" class="w-full h-full object-cover rounded-t-lg">
                                    @else
                                    <video src="{{ Storage::url($bukti->file_path) }}" class="w-full h-full object-cover rounded-t-lg"></video>
                                    @endif
                                </div>
                                <div class="text-xs p-2 text-center w-full">
                                    <span class="block truncate font-semibold text-gray-700" title="{{ $bukti->file_name }}">{{ $bukti->file_name }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex flex-row gap-1 items-center justify-between w-full h-max">
                        <label for="bukti-input" class="text-center w-full h-max cursor-pointer bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors">
                            Ganti/Tambah File...
                        </label>
                        <input type="file" name="bukti[]" id="bukti-input" class="hidden" accept="image/*,video/*" multiple>
                    </div>
                    <p class="text-xs text-gray-400 mt-2 w-full h-auto">
                        *Format Foto: .jpg, .jpeg, .png, .gif, .webp, .heic (maks 20MB)
                        <br>*Format Video: .mp4, .mov, .avi, .mkv, .webm, .flv (maks 300MB)
                        <br>*Maksimal 6 file bukti.
                    </p>
                </div>
            </div>

            <div class="mt-4 p-6 bg-white rounded-lg shadow-lg">
                <label for="isi_laporan" class="block text-gray-700 font-bold mb-2">Kronologi Kejadian*</label>
                <textarea name="isi_laporan" rows="8" class="w-full px-3 py-2 border rounded-lg" required placeholder="Tuliskan :
Nama Korban :
Lokasi Kejadian :
Tanggal/Waktu Kejadian :
Kondisi Korban saat ini :
Deskripsikan lebih lanjut..."
                >{{ old('isi_laporan', $pengaduan->isi_laporan) }}</textarea>            </div>
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

        // === FUNGSI BANTUAN UNTUK FORMAT UKURAN FILE ===
        function formatBytes(bytes, decimals = 2) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const dm = decimals < 0 ? 0 : decimals;
            const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
        }

        // === LOGIKA BARU UNTUK MULTIPLE FILE UPLOAD ===
        const fileInput = document.getElementById('bukti-input');
        const previewContainer = document.getElementById('preview-container');
        let selectedFiles = []; // Array untuk menampung file yang valid

        fileInput.addEventListener('change', function(event) {
            const newFiles = Array.from(event.target.files);

            let combinedFiles = [...selectedFiles, ...newFiles];
            if (combinedFiles.length > 6) {
                alert('Anda hanya dapat mengupload maksimal 6 file.');
                combinedFiles = combinedFiles.slice(0, 6);
            }
            selectedFiles = combinedFiles;

            updatePreview();
            updateFileInput();
        });

        function updatePreview() {
            previewContainer.innerHTML = ''; // Kosongkan preview lama

            if (selectedFiles.length === 0) {
                previewContainer.classList.remove('grid');
                previewContainer.classList.add('flex'); // Kembalikan ke flex jika kosong
            } else {
                previewContainer.classList.remove('flex');
                previewContainer.classList.add('grid'); // Gunakan grid jika ada file
            }

            selectedFiles.forEach((file, index) => {
                const reader = new FileReader();

                // Wrapper untuk satu item file (preview + info)
                const fileItemWrapper = document.createElement('div');
                fileItemWrapper.className = 'w-full h-auto bg-gray-100 rounded-lg shadow-sm flex flex-col';

                // Wrapper untuk preview media
                const previewWrapper = document.createElement('div');
                previewWrapper.className = 'relative w-full h-24 bg-gray-200 rounded-t-lg';

                let mediaElement;
                if (file.type.startsWith('image/')) {
                    mediaElement = document.createElement('img');
                } else {
                    mediaElement = document.createElement('video');
                }
                mediaElement.src = URL.createObjectURL(file); // Gunakan URL.createObjectURL untuk preview cepat
                mediaElement.className = 'w-full h-full object-cover rounded-t-lg';
                previewWrapper.appendChild(mediaElement);

                // Tombol Hapus
                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'absolute top-1 right-1 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs opacity-75 hover:opacity-100';
                removeBtn.innerHTML = '&times;';
                removeBtn.onclick = function() {
                    selectedFiles.splice(index, 1);
                    updatePreview();
                    updateFileInput();
                };

                previewWrapper.appendChild(removeBtn);
                fileItemWrapper.appendChild(previewWrapper);

                // ================== BAGIAN BARU: INFO NAMA & UKURAN FILE ==================
                const infoDiv = document.createElement('div');
                infoDiv.className = 'text-xs p-2 text-center w-full';

                const nameSpan = document.createElement('span');
                nameSpan.className = 'block truncate font-semibold text-gray-700';
                nameSpan.textContent = file.name;
                nameSpan.title = file.name; // Tooltip jika nama terlalu panjang

                const sizeSpan = document.createElement('span');
                sizeSpan.className = 'block text-gray-500';
                sizeSpan.textContent = formatBytes(file.size);

                infoDiv.appendChild(nameSpan);
                infoDiv.appendChild(sizeSpan);
                fileItemWrapper.appendChild(infoDiv);
                // =======================================================================

                previewContainer.appendChild(fileItemWrapper);
            });
        }

        function updateFileInput() {
            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(file => {
                dataTransfer.items.add(file);
            });
            fileInput.files = dataTransfer.files;
        }

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
