@extends('layouts.public')
@section('title', 'Kirim Pengaduan')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-lg max-w-4xl mx-auto">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Pengaduan</h1>
        <p class="text-gray-500">Lengkapi formulir untuk pengaduan Anda</p>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data" id="pengaduanForm">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <div class="mb-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="anonim" id="anonimCheckbox" value="1" class="form-checkbox h-5 w-5 text-orange-600">
                        <span class="ml-2 text-gray-700">Kirim sebagai Anonim</span>
                    </label>
                </div>

                <div id="identitasPelapor">
                    <div class="mb-4">
                        <label for="nama_pelapor" class="block text-gray-700 font-bold mb-2">Nama Pengadu*</label>
                        <input type="text" name="nama_pelapor" id="nama_pelapor" value="{{ auth()->user()->name ?? old('nama_pelapor') }}" class="w-full px-3 py-2 border rounded-lg" {{ auth()->check() ? 'readonly' : '' }}>
                    </div>
                    <div class="mb-4">
                        <label for="email_pelapor" class="block text-gray-700 font-bold mb-2">Email (Optional)</label>
                        <input type="email" name="email_pelapor" id="email_pelapor" value="{{ auth()->user()->email ?? old('email_pelapor') }}" class="w-full px-3 py-2 border rounded-lg" {{ auth()->check() ? 'readonly' : '' }}>
                    </div>
                    <div class="mb-4">
                        <label for="telepon_pelapor" class="block text-gray-700 font-bold mb-2">No. Telepon/HP*</label>
                        <input type="text" name="telepon_pelapor" value="{{ old('telepon_pelapor') }}" class="w-full px-3 py-2 border rounded-lg">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="judul" class="block text-gray-700 font-bold mb-2">Judul Pengaduan*</label>
                    <input type="text" name="judul" value="{{ old('judul') }}" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="kategori_id" class="block text-gray-700 font-bold mb-2">Kategori Pengaduan*</label>
                    <select name="kategori_id" class="w-full px-3 py-2 border rounded-lg" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex flex-col">
                <div class="border-2 border-dashed rounded-lg p-4 h-full flex flex-col items-center justify-center bg-gray-50">
                    <div id="preview-container" class="hidden mb-4">
                         <img id="image-preview" class="max-h-40 rounded"/>
                         <video id="video-preview" class="max-h-40 rounded" controls></video>
                    </div>
                    <label for="foto_kejadian" class="cursor-pointer">
                        <div id="upload-placeholder">
                             <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
                             <p class="text-sm text-center text-gray-600">Upload Bukti Kejadian</p>
                        </div>
                        <input type="file" name="foto_kejadian" id="foto_kejadian" class="hidden" accept="image/*,video/*">
                    </label>
                    <p id="file-name" class="text-sm text-gray-500 mt-2"></p>
                    <button type="button" id="remove-file" class="hidden mt-2 text-red-500 text-sm">Hapus File</button>
                    <p class="text-xs text-gray-500 mt-2">Format: PNG, JPG, JPEG, MP4, AVI, MOV (maks 20MB)</p>
                </div>
            </div>
        </div>

        <div class="mt-8">
             <label for="isi_laporan" class="block text-gray-700 font-bold mb-2">Kronologi Kejadian*</label>
             <textarea name="isi_laporan" rows="5" class="w-full px-3 py-2 border rounded-lg" required>{{ old('isi_laporan') }}</textarea>
        </div>
        <div class="mt-6">
            <label class="flex items-start">
                <input type="checkbox" name="persetujuan" id="persetujuanCheckbox" value="1" class="form-checkbox h-5 w-5 text-orange-600 mt-1" required>
                <span class="ml-2 text-gray-700">Apakah anda yakin sudah mengisi dengan benar dan sejujurnya?<br><small>Pastikan semua data yang anda masukkan sudah benar sebelum mengirim untuk pertimbangan penanganan.</small></span>
            </label>
        </div>
        <div class="mt-8 text-center">
            <button type="submit" id="submitButton" class="w-full md:w-1/2 bg-gray-800 text-white py-3 rounded-lg hover:bg-gray-900 disabled:bg-gray-400 disabled:cursor-not-allowed" disabled>Kirim Pengaduan</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const anonimCheckbox = document.getElementById('anonimCheckbox');
    const identitasPelapor = document.getElementById('identitasPelapor');
    const namaPelaporInput = document.getElementById('nama_pelapor');

    function toggleIdentitas() {
        if (anonimCheckbox.checked) {
            identitasPelapor.style.display = 'none';
            namaPelaporInput.required = false;
        } else {
            identitasPelapor.style.display = 'block';
            namaPelaporInput.required = true;
        }
    }
    anonimCheckbox.addEventListener('change', toggleIdentitas);
    toggleIdentitas(); // initial check

    const submitButton = document.getElementById('submitButton');
    const persetujuanCheckbox = document.getElementById('persetujuanCheckbox');

    persetujuanCheckbox.addEventListener('change', function() {
        submitButton.disabled = !this.checked;
    });

    const fileInput = document.getElementById('foto_kejadian');
    const previewContainer = document.getElementById('preview-container');
    const imagePreview = document.getElementById('image-preview');
    const videoPreview = document.getElementById('video-preview');
    const uploadPlaceholder = document.getElementById('upload-placeholder');
    const fileNameDisplay = document.getElementById('file-name');
    const removeFileButton = document.getElementById('remove-file');

    fileInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const fileType = file.type;
            const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
            const validVideoTypes = ['video/mp4', 'video/avi', 'video/mov'];

            imagePreview.style.display = 'none';
            videoPreview.style.display = 'none';

            if (validImageTypes.includes(fileType)) {
                imagePreview.src = URL.createObjectURL(file);
                imagePreview.style.display = 'block';
            } else if (validVideoTypes.includes(fileType)) {
                 videoPreview.src = URL.createObjectURL(file);
                 videoPreview.style.display = 'block';
            }

            previewContainer.classList.remove('hidden');
            uploadPlaceholder.classList.add('hidden');
            fileNameDisplay.textContent = file.name;
            removeFileButton.classList.remove('hidden');
        }
    });

    removeFileButton.addEventListener('click', function() {
        fileInput.value = ''; // Reset the file input
        previewContainer.classList.add('hidden');
        uploadPlaceholder.classList.remove('hidden');
        fileNameDisplay.textContent = '';
        removeFileButton.classList.add('hidden');
    });
});
</script>
@endpush
