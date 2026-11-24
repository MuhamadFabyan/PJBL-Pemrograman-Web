@extends('layouts.app')

@section('title', 'Catatan - UMKM Manager')
@section('page-heading', 'Catatan')

@section('content')

<div class="container-fluid p-0">

    {{-- HEADER --}}
    <div class="mb-4">
        <h4>Catatan Operasional</h4>
        <p class="text-muted">
            Kelola catatan dan informasi penting usaha Anda.
        </p>
    </div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    {{-- FORM CATATAN --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">

            <h5 class="mb-3">Tambah Catatan</h5>

            <form action="{{ route('notes.store') }}" method="POST">
                @csrf

                {{-- JUDUL --}}
                <div class="mb-3">
                    <label for="title" class="form-label">
                        Judul Catatan
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="form-control"
                        placeholder="Contoh: Evaluasi stok mingguan"
                        value="{{ old('title') }}"
                        required
                    >
                </div>

                {{-- EDITOR --}}
                <div class="mb-3">
                    <label for="editor" class="form-label">
                        Isi Catatan
                    </label>

                    <textarea
                        id="editor"
                        name="content"
                    >{{ old('content') }}</textarea>
                </div>

                {{-- BUTTON --}}
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        Simpan Catatan
                    </button>
                </div>

            </form>

        </div>
    </div>

    {{-- DAFTAR CATATAN --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <h5 class="mb-4">Catatan Tersimpan</h5>

            @forelse($notes as $note)

                <div class="note-card border rounded-3 p-3 mb-3">

                    {{-- JUDUL DAN TANGGAL --}}
                    <div class="d-flex justify-content-between
                                align-items-start gap-3">

                        <div>
                            <h6 class="fw-bold mb-1">
                                {{ $note->title }}
                            </h6>

                            <small class="text-muted">
                                {{ $note->created_at->format('d M Y, H:i') }}
                            </small>
                        </div>

                        {{-- HAPUS --}}
                        <form
                            action="{{ route('notes.destroy', $note->id) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus catatan ini?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-outline-danger btn-sm"
                            >
                                Hapus
                            </button>
                        </form>

                    </div>

                    {{-- ISI CATATAN --}}
                    <div class="note-content mt-3">
                        {!! $note->content !!}
                    </div>

                </div>

            @empty

                <div class="text-center text-muted py-4">
                    <p>Belum ada catatan.</p>
                </div>

            @endforelse

        </div>
    </div>

</div>

@endsection

{{-- TINYMCE --}}
@section('scripts')

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js"
    referrerpolicy="origin"></script>

<script>
    tinymce.init({
        selector: '#editor',
        height: 350,

        plugins: 'lists link table code wordcount',

        toolbar:
            'undo redo | blocks | bold italic underline | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist | link table | code',

        menubar: false,
        branding: false,

        content_style: `
            body {
                font-family: Arial, sans-serif;
                font-size: 14px;
            }
        `
    });
</script>

@endsection