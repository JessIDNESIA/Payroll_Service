<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Halaman User') }}
        </h2>
    </x-slot>
    <h1 class="text-black">ini deskripsi</h1>


    @if (Auth()->user()->hasRole('admin'))
    <h1 class="text-black">ini edit</h1>
    <h1 class="text-black">ini hapus</h1>
    @endif
</x-app-layout>
