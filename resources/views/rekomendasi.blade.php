@extends('layout.app')

@section('navbar')
    @include('layout.navbar')
@endsection

@section('content')
    <div class="bg-primary-bg pb-10">
        <div class="flex justify-center pt-32">
            <div class="text-center">
                <div class="font-bold font-raleway text-4xl">Rekomendasi Storage</div>
                <div class="font-nunito text-lg flex justify-center mt-5">
                    <div class="w-4/6">
                        Pilih gudang sesuai dengan kebutuhan Anda, kami menyediakan berbagai jenis gudang yang bisa menyesuaikan bisnis Anda
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-10">
            <div class="px-40 grid grid-cols-4 gap-10 text-white font-nunito">
                @foreach ($data as $data)
                    <a href="{{ route('gudang.detail', ['id' => $data['id']]) }}"
                        style="background-image: url('/images/{{ $data['gambar'] }}')"
                        class="w-[18rem] h-[25rem] bg-gray-800 bg-center rounded-xl relative bg-cover">
                        <div class="px-5 text-lg absolute bottom-0 w-full py-5 rounded-b-xl bg-black bg-opacity-50">
                            <div class="font-bold">{{ $data['nama_gudang'] }}</div>
                            <div>{{ $data['lokasi'] }}</div>
                            <div>{{ $data['luas'] }}</div>
                            <div>{{ $data['status'] }}</div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('layout.footer')
@endsection
