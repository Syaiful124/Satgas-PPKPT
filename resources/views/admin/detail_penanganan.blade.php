@extends('layouts.app')
@section('title', 'Form Penanganan')

@section('content')
<a href="{{ route('admin.laporan.masuk') }}" class="text-gray-600 hover:text-gray-900 mb-4 inline-block">&larr; KEMBALI</a>

<div class="grid grid-cols-1 lg:grid-cols-5 gap-4 mb-2">
    <div class="lg:col-span-3 flex flex-col gap-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4 border-b pb-2">Laporan Pengaduan</h2>
            <div class="mb-4">
                <p class="text-sm text-gray-500">Judul Laporan</p>
                <p class="text-lg font-bold">{{ $pengaduan->judul }}</p>
            </div>
            <div class="mb-4">
                <p class="text-sm text-gray-500">Kategori</p>
                <p class="font-semibold">{{ $pengaduan->kategori->nama_kategori }}</p>
            </div>
            @if ($pengaduan->kategori->nama_kategori == 'Lainnya' && !empty($pengaduan->kategori_lainnya))
            <div class="mb-4">
                <p class="text-sm text-gray-500">Kategori Lainnya yang Disebutkan</p>
                <p class="font-semibold text-orange-600">{{ $pengaduan->kategori_lainnya }}</p>
            </div>
            @endif
            <div class="grid grid-cols-2 grid-rows-3 gap-4 mb-4">
                <div>
                    <p class="text-sm text-gray-500">Pelapor</p>
                    <p class="font-semibold">{{ $pengaduan->nama_pelapor ?? 'Anonim' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tanggal Dilaporkan</p>
                    <p class="font-semibold">{{ $pengaduan->created_at?->translatedFormat('d M Y, H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Email Pelapor</p>
                    <p class="font-semibold">{{ $pengaduan->email_pelapor ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status Saat Ini</p>
                    <p class="font-bold
                        @if($pengaduan->status == 'menunggu') text-orange-500 @endif
                        @if($pengaduan->status == 'penanganan') text-blue-500 @endif
                        @if($pengaduan->status == 'selesai') text-green-500 @endif
                        @if($pengaduan->status == 'ditolak') text-red-500 @endif
                    ">{{ ucfirst($pengaduan->status) }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Telepon Pelapor</p>
                    <p class="font-semibold">{{ $pengaduan->telepon_pelapor ?? '-' }}</p>
                </div>
            </div>

            <div class="mb-4">
                <p class="text-sm text-gray-500">Kronologi Kejadian</p>
                <p class="text-gray-700 whitespace-pre-wrap mt-1">{{ $pengaduan->isi_laporan }}</p>
            </div>
        </div>
    </div>
    <div class="lg:col-span-2 flex flex-col gap-8 mb-4">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="font-bold mb-2">Bukti Kejadian (dari Pelapor)</h3>
            @if ($pengaduan->bukti->isNotEmpty())
                <div class="w-full bg-gray-200 rounded-lg grid grid-cols-3 gap-2 mb-4 p-1">
                    @foreach($pengaduan->bukti as $bukti)
                        <div>
                            @if($bukti->file_type == 'image')
                                <img src="{{ Storage::url($bukti->file_path) }}" alt="{{ $bukti->file_name }}" class="w-full min-h-[100px] max-h-[200px] rounded-lg shadow">
                            @else
                                <video src="{{ Storage::url($bukti->file_path) }}" controls class="w-full min-h-[100px] max-h-[200px] rounded-lg shadow"></video>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="border-2 border-dashed rounded-lg p-10 text-center text-gray-400">
                    Tidak ada bukti dari pelapor.
                </div>
            @endif
        </div>
    </div>
</div>

<form action="{{ route('admin.laporan.tangani', $pengaduan) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class=" w-full bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-bold mb-4">Form Penanganan Admin</h3>
            <div class="flex flex-col w-full gap-6">
                <div class="mb-4">
                    <label for="nama_admin" class="block text-gray-700 font-bold mb-2">Nama Admin*</label>
                    <input type="text" id="nama_admin" value="{{ auth()->user()->name }}" class="w-full px-3 py-2 border rounded-lg bg-gray-100" readonly>
                </div>
                <div class="mb-4">
                    <label for="isi_penanganan" class="block text-gray-700 font-bold mb-2">Penjelasan Penanganan*</label>
                    <textarea name="isi_penanganan" id="isi_penanganan" rows="5" class="w-full bg-gray-200 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>{{ old('isi_penanganan') }}</textarea>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4 w-full">
                <label class="block text-gray-700 font-bold mb-2">Upload Bukti Penanganan</label>
                <div class="flex items-center space-x-4 flex-col gap-4">
                    <div id="preview-container" class="w-full bg-gray-200 rounded-lg grid grid-cols-3 gap-2 min-h-[100px] max-h-[300px] p-1">
                        @if($pengaduan->penanganan)
                            @foreach($pengaduan->penanganan->bukti as $bukti)
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
                        @endif
                    </div>
                    <div class="flex flex-row gap-4">
                        <label for="bukti-input" class="flex items-center cursor-pointer bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                            Upload Bukti
                        </label>
                        <input type="file" name="bukti[]" id="bukti-input" class="hidden w-full" accept="image/*,video/*" multiple>
                    </div>
                </div>
                    <p class="text-xs text-gray-500 mt-2 w-full h-auto">
                    *Format Foto: .jpg, .jpeg, .png, .gif, .webp, .heic (maks 20MB)
                    <br>*Format Video: .mp4, .mov, .avi, .mkv, .webm, .flv (maks 300MB)
                    <br>*Maksimal 6 file bukti.
                </p>
            </div>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="w-full bg-orange-500 bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600">
                {{ $pengaduan->penanganan ? 'Update Laporan Penanganan' : 'Kirim Laporan Penanganan' }}
            </button>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

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
});
</script>
@endpush
