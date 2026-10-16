@extends('layouts.admin')

@section('title', 'Pengaturan Situs')

@section('content')
    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data"
        class="max-w-3xl space-y-6">
        @csrf
        @method('PUT')

        @php
            $input = 'w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sage-400';
            $v = fn ($key) => old($key, $values[$key] ?? '');
        @endphp

        {{-- Identitas --}}
        <div class="rounded-2xl bg-white p-6 shadow">
            <h2 class="text-lg font-bold text-sage-800">Identitas Situs</h2>

            <div class="mt-4 space-y-4">
                <div>
                    <label class="mb-1 block text-sm font-medium">Nama situs</label>
                    <input type="text" name="site_name" value="{{ $v('site_name') }}" required class="{{ $input }}">
                    @error('site_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium">Subjudul</label>
                    <input type="text" name="site_tagline" value="{{ $v('site_tagline') }}" class="{{ $input }}">
                    @error('site_tagline') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium">Logo (maks. 2 MB)</label>
                    @if (!empty($values['logo']))
                        <div class="mb-2 flex items-center gap-4">
                            <img src="{{ asset('storage/' . $values['logo']) }}" alt="Logo saat ini"
                                class="h-16 w-16 rounded-lg border object-contain p-1">
                            <label class="flex items-center gap-2 text-sm">
                                <input type="checkbox" name="remove_logo" value="1"> Hapus logo
                            </label>
                        </div>
                    @endif
                    <input type="file" name="logo" accept="image/*"
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2">
                    @error('logo') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Beranda --}}
        <div class="rounded-2xl bg-white p-6 shadow">
            <h2 class="text-lg font-bold text-sage-800">Banner Beranda</h2>

            <div class="mt-4 space-y-4">
                <div>
                    <label class="mb-1 block text-sm font-medium">Judul besar</label>
                    <input type="text" name="hero_title" value="{{ $v('hero_title') }}" class="{{ $input }}">
                    @error('hero_title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium">Teks pengantar</label>
                    <textarea name="hero_subtitle" rows="3" class="{{ $input }}">{{ $v('hero_subtitle') }}</textarea>
                    @error('hero_subtitle') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium">Tautan Daftar PMB</label>
                    <input type="url" name="pmb_url" value="{{ $v('pmb_url') }}" placeholder="https://..." class="{{ $input }}">
                    @error('pmb_url') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Kontak --}}
        <div class="rounded-2xl bg-white p-6 shadow">
            <h2 class="text-lg font-bold text-sage-800">Kontak</h2>

            <div class="mt-4 grid gap-4 md:grid-cols-2">
                <div>
                    <label class="mb-1 block text-sm font-medium">Email</label>
                    <input type="email" name="contact_email" value="{{ $v('contact_email') }}" class="{{ $input }}">
                    @error('contact_email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium">Telepon</label>
                    <input type="text" name="contact_phone" value="{{ $v('contact_phone') }}" class="{{ $input }}">
                    @error('contact_phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div class="md:col-span-2">
                    <label class="mb-1 block text-sm font-medium">Alamat</label>
                    <textarea name="contact_address" rows="2" class="{{ $input }}">{{ $v('contact_address') }}</textarea>
                    @error('contact_address') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Sosial media --}}
        <div class="rounded-2xl bg-white p-6 shadow">
            <h2 class="text-lg font-bold text-sage-800">Media Sosial</h2>

            <div class="mt-4 space-y-4">
                <div>
                    <label class="mb-1 block text-sm font-medium">Instagram</label>
                    <input type="url" name="instagram_url" value="{{ $v('instagram_url') }}" placeholder="https://..." class="{{ $input }}">
                    @error('instagram_url') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium">Facebook</label>
                    <input type="url" name="facebook_url" value="{{ $v('facebook_url') }}" placeholder="https://..." class="{{ $input }}">
                    @error('facebook_url') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium">YouTube</label>
                    <input type="url" name="youtube_url" value="{{ $v('youtube_url') }}" placeholder="https://..." class="{{ $input }}">
                    @error('youtube_url') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <button type="submit"
            class="rounded-lg bg-sage-600 px-6 py-2 font-semibold text-white hover:bg-sage-700">Simpan Pengaturan</button>
    </form>
@endsection