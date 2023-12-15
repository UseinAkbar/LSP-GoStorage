@extends('layout.app')

@section('content')
<div class="flex">
    @include('layout.sidebar')
    <div class="px-5 w-10/12">
        <div class="mt-7 font-bold text-3xl">Tambah Gudang</div>
        @if (count($errors) > 0)
        <div id="error" class="px-5 bg-red-500 text-white py-3 rounded items-center">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
      @endif
        @if ($errors->first('wrong'))
            <div id="error" class="w-full px-5 bg-red-500 text-white py-3 rounded items-center">
                {{ $errors->first('wrong') }}
                <div class="float-right" onclick="closePopup()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor"
                        class="w-6 h-6  hover:rounded-full text-white hover:bg-red-800 hover:cursor-pointer">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>
        @endif
        @if (Session::has('success'))
            <div id="success"
                class="w-full px-5 bg-green-500 text-white py-3 rounded -mt-16 items-center">
                {{ Session::get('success') }}
                <div class="float-right" onclick="closePopup()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor"
                        class="w-6 h-6  hover:rounded-full text-white hover:bg-green-800 hover:cursor-pointer">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>
        @endif
        <form action="{{route('dashboard.gudang_post')}}" method="post" class="mt-5" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <input type="hidden" name="id_admin" value="{{Auth::user()->id}}">
            <div class="flex flex-col w-1/2">
                <div class="mt-2 w-full space-y-2">
                    <div class="">Nama Gudang</div>
                    <input type="text" name="nama_gudang" value="{{old('nama_gudang')}}" class="border border-black px-3 py-2 w-full" placeholder="Nama Gudang">
                </div>
                <div class="mt-2 w-full space-y-2">
                    <div class="">Kode Gudang</div>
                    <input type="text" name="kode_gudang" value="{{old('kode_gudang')}}" class="border border-black px-3 py-2 w-full" placeholder="Kode Gudang">
                </div>
                <div class="mt-2 w-full space-y-2">
                    <div class="">Lokasi</div>
                    <input type="text" name="lokasi" value="{{old('lokasi')}}" class="border border-black px-3 py-2 w-full" placeholder="Lokasi Gudang">
                </div>
                <div class="mt-2 w-full space-y-2">
                    <div class="">Luas</div>
                    <input type="text" name="luas" value="{{old('luas')}}" class="border border-black px-3 py-2 w-full" placeholder="Luas Gudang (m2)">
                </div>
                <div class="mt-2 w-full space-y-2">
                    <div class="">Harga</div>
                    <input type="text" name="harga" value="{{old('harga')}}" class="border border-black px-3 py-2 w-full" placeholder="Harga Sewa Gudang">                    
                </div>
                <div class="mt-2 w-full space-y-2">
                    <div class="">Kategori</div>
                    @foreach ($kategori as $k)
                    <div class="flex items-center ps-3">
                        <input class="text-darks-600 h-4 w-4 rounded border-gray-300 bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:ring-offset-gray-700 dark:focus:ring-blue-600 dark:focus:ring-offset-gray-700" id="vue-checkbox" name="kategori[]" type="checkbox" value="{{ $k->id }}">
                        <label class="text-black-300 ms-2 w-full py-3 text-sm font-medium text-gray-900" for="vue-checkbox">{{ $k->nama }}</label>
                    </div>
                    @endforeach
                </div>
                <div class="mt-2 w-full space-y-2">
                    <div class="">Deskripsi</div>
                    <textarea name="deskripsi" class="border border-black px-3 py-2 w-full" placeholder="Deskripsi Gudang">{{old('deskripsi')}}</textarea>
                </div>
                <div class="mt-2 w-full space-y-2">
                    <div class="">Gambar</div>
                    <input name="gambar" type="file" class="border border-black px-3 py-2 w-full">
                </div>
                <button>
                    <div class="border border-black px-3 py-2 mt-5 w-full text-center bg-white hover:bg-slate-800 hover:text-white">Tambah</div>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
