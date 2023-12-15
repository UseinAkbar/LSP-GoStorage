@extends('layout.app')

@section('content')
<div class="flex">
    @include('layout.sidebar')
    <div class="grid grid-cols-1 gap-2 px-5 pb-20 w-10/12">
        <div class="my-5">
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
                </div>
            @endif
            @if (Session::has('success'))
                <div id="success"
                    class="w-full px-5 bg-green-500 text-white py-3 rounded items-center">
                    {{ Session::get('success') }}
                </div>
            @endif
        </div>
        <div class="mt-7 font-bold text-3xl">Gudang GoStorage</div>
        <div class="mt-5">
            <a href="{{Route('dashboard.gudang_add')}}" class="border border-black px-10 py-3">+ Add Gudang</a>
        </div>
     
        <div class="mt-5 relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-black dark:text-black">
                <thead class="text-xs text-white uppercase bg-slate-800 dark:bg-grey-300 dark:text-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Gudang
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Kode Gudang
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Lokasi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Kategori
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Deskripsi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Harga
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Luas
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($gudang as $g)
                    <tr class="bg-white border-b dark:bg-white dark:border-gray-500 hover:bg-gray-50 dark:hover:bg-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap dark:text-black">
                            {{ $loop->iteration }}
                        </th>
                        <td class="px-6 py-4">
                            {{$g['nama_gudang']}}
                        </td>
                        <td class="px-6 py-4">
                            {{$g['kode_gudang']}}
                        </td>
                        <td class="px-6 py-4">
                            {{$g['lokasi']}}
                        </td>
                        <td>
                            <ul class="">
                                @foreach ($g->kategori as $item)
                                    <li class="px-6 py-4">• {{ $item->nama }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="px-6 py-4">
                            {{$g['deskripsi']}}
                        </td>
                        <td class="px-6 py-4 font-semibold">
                            {{$g['status']}}
                        </td>
                        <td class="px-6 py-4">
                            Rp{{number_format($g['harga'], 0)}}
                        </td>
                        <td class="px-6 py-4">
                            {{$g['luas']}}
                        </td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <div class="flex space-x-4">
                                <a href="{{route('dashboard.gudang_update', ['id' => $g['id']])}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                <form action="{{route('dashboard.gudang_delete', ['id' => $g['id']])}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>  
    </div>
</div>
@endsection
