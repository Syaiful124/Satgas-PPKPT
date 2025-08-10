@extends('layouts.public')
@section('title', 'Pusat Unduhan')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-lg max-w-4xl mx-auto">
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-gray-800">Pusat Unduhan</h1>
        <p class="text-gray-500">Dokumen dan panduan terkait PPKS.</p>
    </div>

    <div class="space-y-4" id="accordion-container">
        @forelse ($files as $file)
        <div class="border rounded-lg overflow-hidden">
            <button class="accordion-header w-full flex justify-between items-center p-4 text-left font-semibold text-gray-700 bg-gray-50 hover:bg-gray-100">
                <span>{{ $file->judul }}</span>
                <svg class="accordion-arrow w-6 h-6 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            <div class="accordion-content hidden p-4 border-t bg-white">
                <p class="text-gray-600 mb-4">Klik link di bawah untuk mengunduh file.</p>
                <a href="{{-- Storage::url($file->file_path) --}}" class="inline-flex items-center text-orange-600 font-bold hover:underline" download>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                    {{ $file->file_name }}
                </a>
            </div>
        </div>
        @empty
        <div class="text-center text-gray-500 p-8 border-2 border-dashed rounded-lg">
            <p>Tidak ada file yang tersedia untuk diunduh saat ini.</p>
        </div>
        @endforelse
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const accordionContainer = document.getElementById('accordion-container');
    accordionContainer.addEventListener('click', function(event) {
        const header = event.target.closest('.accordion-header');
        if (!header) return;

        const content = header.nextElementSibling;
        const arrow = header.querySelector('.accordion-arrow');

        content.classList.toggle('hidden');
        arrow.classList.toggle('rotate-180');
    });
});
</script>
@endpush
@endsection
