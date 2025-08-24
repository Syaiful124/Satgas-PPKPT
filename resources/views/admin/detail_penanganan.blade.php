@extends('layouts.app')
@section('title', 'Form Penanganan')

@section('content')
<a href="{{ route('admin.laporan.masuk') }}" class="text-gray-600 hover:text-gray-900 mb-4 inline-block">&larr; BACK</a>

<div class="grid grid-cols-1 lg:grid-cols-5 gap-8 mb-4">
    <div class="lg:col-span-3 flex flex-col gap-8">
        <div class="bg-white p-6 rounded-lg shadow-md mb-5">
            <h2 class="text-2xl font-semibold mb-4 border-b pb-2">Laporan Pengaduan</h2>

            <div class="mb-4">
                <p class="text-sm text-gray-500">Judul Laporan</p>
                <p class="text-lg font-bold">{{ $pengaduan->judul }}</p>
            </div>

            <div class="grid grid-cols-2 grid-rows-3 gap-4 mb-4">
                <div>
                    <p class="text-sm text-gray-500">Kategori</p>
                    <p class="font-semibold">{{ $pengaduan->kategori->nama_kategori }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tanggal Dilaporkan</p>
                    <p class="font-semibold">{{ $pengaduan->created_at?->translatedFormat('d M Y, H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Pelapor</p>
                    <p class="font-semibold">{{ $pengaduan->nama_pelapor ?? 'Anonim' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Email Pelapor</p>
                    <p class="font-semibold">{{ $pengaduan->email_pelapor }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Telepon Pelapor</p>
                    <p class="font-semibold">{{ $pengaduan->telepon_pelapor }}</p>
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
                @if ($pengaduan->kategori->nama_kategori == 'Lainnya' && !empty($pengaduan->kategori_lainnya))
                <div class="col-span-2">
                    <p class="text-sm text-gray-500">Kategori Lainnya yang Disebutkan</p>
                    <p class="font-semibold text-orange-600">{{ $pengaduan->kategori_lainnya }}</p>
                </div>
                @endif
            </div>

            <div class="mb-4">
                <p class="text-sm text-gray-500">Kronologi Kejadian</p>
                <p class="text-gray-700 whitespace-pre-wrap mt-1">{{ $pengaduan->isi_laporan }}</p>
            </div>
        </div>
    </div>
    <div class="lg:col-span-2 flex flex-col gap-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="font-bold mb-2">Bukti Kejadian (dari Pelapor)</h3>
            @if($pengaduan->foto_kejadian)
                @if(Str::contains($pengaduan->foto_kejadian, ['.jpg', '.jpeg', '.png', '.gif']))
                <img src="{{ Storage::url($pengaduan->foto_kejadian) }}" alt="Bukti" class="w-full rounded-lg shadow">
                @else
                <video src="{{ Storage::url($pengaduan->foto_kejadian) }}" controls class="w-full rounded-lg shadow"></video>
                @endif
            @else
            <div class="border-2 border-dashed rounded-lg p-10 text-center text-gray-400">Tidak ada bukti gambar/video.</div>
            @endif
        </div>
    </div>
</div>

<form action="{{ route('admin.laporan.tangani', $pengaduan) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-bold mb-4">Form Penanganan Admin</h3>
        <div class="flex flex-row w-full gap-6">
            <div class="w-full">
                <div class="mb-4">
                    <label for="nama_admin" class="block text-gray-700 font-bold mb-2">Nama Admin*</label>
                    <input type="text" id="nama_admin" value="{{ auth()->user()->name }}" class="w-full px-3 py-2 border rounded-lg bg-gray-100" readonly>
                </div>
                <div class="mb-4">
                    <label for="isi_penanganan" class="block text-gray-700 font-bold mb-2">Penjelasan Penanganan*</label>
                    <textarea name="isi_penanganan" id="isi_penanganan" rows="5" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>{{ old('isi_penanganan') }}</textarea>
                </div>
            </div>
            <div class="mb-4 w-full">
                <label class="block text-gray-700 font-bold mb-2">Upload Bukti Penanganan</label>
                <div class="flex items-center space-x-4 flex-col gap-4">
                    <div id="preview-container-admin" class="w-auto h-auto flex-shrink-0 bg-gray-200 rounded-lg flex items-center justify-center">
                        <img id="image-preview-admin" class="hidden w-full h-full object-cover rounded-lg"/>
                        <video id="video-preview-admin" class="hidden w-full h-full object-cover rounded-lg"></video>
                        <svg id="preview-placeholder-admin" xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                    <div class="flex flex-row gap-4">
                        <label for="foto_penanganan" class="flex items-center cursor-pointer bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                            Upload Bukti
                        </label>
                        <input type="file" name="foto_penanganan" id="foto_penanganan" class="hidden w-full" accept="image/*,video/*">
                        <div id="file-info-admin" class="text-sm text-gray-500 mt-2">
                            <p id="file-name-admin">Tidak ada file dipilih.</p>
                            <p id="file-size-admin"></p>
                        </div>
                        <button type="button" id="remove-file-admin" class="hidden mt-2 text-red-500 text-sm hover:underline">Hapus File</button>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-2">Format: PNG, JPG, JPEG, MP4, AVI, MOV (maks 20MB)</p>
            </div>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600">Kirim</button>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('foto_penanganan');
    const imagePreview = document.getElementById('image-preview-admin');
    const videoPreview = document.getElementById('video-preview-admin');
    const previewPlaceholder = document.getElementById('preview-placeholder-admin');
    const fileNameDisplay = document.getElementById('file-name-admin');
    const fileSizeDisplay = document.getElementById('file-size-admin');
    const removeFileButton = document.getElementById('remove-file-admin');

    function formatBytes(bytes, decimals = 2) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const dm = decimals < 0 ? 0 : decimals;
        const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    }

    fileInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            fileNameDisplay.textContent = file.name;
            fileSizeDisplay.textContent = formatBytes(file.size);
            removeFileButton.classList.remove('hidden');
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

    removeFileButton.addEventListener('click', function() {
        fileInput.value = '';
        fileNameDisplay.textContent = 'Tidak ada file dipilih.';
        fileSizeDisplay.textContent = '';
        removeFileButton.classList.add('hidden');

        imagePreview.classList.add('hidden');
        imagePreview.src = '';
        videoPreview.classList.add('hidden');
        videoPreview.src = '';
        previewPlaceholder.classList.remove('hidden');
    });
});
</script>
@endpush
