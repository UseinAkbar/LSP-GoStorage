@extends('layout.app')

@section('navbar')
    @include('layout.navbar')
@endsection

@section('content')
    <div class="bg-primary-bg">
    @if ($errors->first('wrong'))
                <div id="error" class="w-full px-5 bg-red-500 text-white py-3 rounded items-center">
                    {{ $errors->first('wrong') }}
                    <div class="float-right" onclick="closePopupError()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor"
                            class="w-6 h-6  hover:rounded-full text-white hover:bg-red-800 hover:cursor-pointer">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>
        @endif
        <div class="">
            <div class="">
                <div class="grid grid-cols-2" style="height: 80vh;">
                    <div class="grid grid-cols-1 items-center px-10 py-20 bg-primary-green text-white">
                        <div class="grid grid-cols-1 gap-5 justify-items-start">
                            <div class="text-6xl font-bold font-raleway">
                                Jadikan penyimpanan logistikmu lebih mudah dengan GoStorage
                            </div>
                            <p class="text-nunito font-semibold text-xl" style="width: 70%;">Kami menyediakan berbagai jenis gudang untuk kebutuhan bisnis dan logistik Anda</p>
                            <a href="/list_gudang" class="px-8 py-2 bg-primary-pink text-lg font-bold text-nunito rounded" style="justify-self: start;">Sewa Sekarang!</a>
                        </div>
                    </div>
                    <div class="bg-red-200 bg-cover" style="background-image: url('/images/banner.jpeg');"></div>
                </div>
            </div>
        </div>
        <div class="mt-20 pb-20">
            <div class="text-center">
                <div class="font-raleway font-bold text-4xl">Pilih Storage</div>
                <div class="flex justify-center mt-5">
                    <div class="w-1/6 text-light">Pilih storage, ada berbagai gudang penyimpanan untuk Anda</div>
                </div>
            </div>
            <div class="mt-10">
                <div class="px-40 grid grid-cols-4 gap-10 text-white font-nunito">
                    @foreach ($data as $data)
                        <a href="{{ route('gudang.detail', ['id' => $data['id']]) }}"
                            style="background-image: url('/images/{{ $data['gambar'] }}')"
                            class="w-[18rem] h-[25rem] bg-gray-800 rounded-xl bg-center relative bg-cover">
                            <div class="flex flex-col gap-2 px-5 text-lg absolute bottom-0 w-full py-5 rounded-b-xl bg-black bg-opacity-50">
                                <div class="font-bold">{{ $data['nama_gudang'] }}</div>
                                <div>{{ $data['lokasi'] }}</div>
                                <div>{{ $data['luas'] }}</div>
                                @if($data['status'] == 'available')
                                <div class="mt-2 bg-green-500 font-semibold p-2 rounded">{{ $data['status'] }}</div>
                                @else
                                <div class="mt-2 bg-red-500 font-semibold p-2 rounded">{{ $data['status'] }}</div>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="">
            <div class="flex h-[33rem]">
                <div class="w-7/12 bg-cover" style="background-image: url('/images/about.jpg');"></div>
                <div class="w-5/12 bg-primary-green px-10 py-10 text-white space-y-3">
                    <div class="text-raleway font-bold text-3xl">
                        Tentang Kami
                    </div>
                    <div class="text-xl w-11/12 font-nunito">
                        Kami telah bekerja sama dengan beberapa perusahaan penyedia gudang untuk memberikan pelayanan yang terbaik.
                    </div>
                    <div class="flex justify-center pt-10">
                        <div class="grid grid-cols-2 gap-16 text-nunito text-lg text-center">
                            <div>
                                <div class="font-semibold text-3xl">170+</div>
                                <div>Gudang</div>
                            </div>
                            <div>
                                <div class="font-semibold text-3xl">17</div>
                                <div>Provinsi</div>
                            </div>
                            <div>
                                <div class="font-semibold text-3xl">52</div>
                                <div>Kota</div>
                            </div>
                            <div>
                                <div class="font-semibold text-3xl">1500+</div>
                                <div>Pelanggan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function closePopupError() {
            document.getElementById('error').classList.add('hidden');
        }
    </script>
@endsection

@section('footer')
    @include('layout.footer')
@endsection
