@extends('layout.app')

@section('navbar')
    @include('layout.navbar')
@endsection

@section('content')
    <div class="bg-primary-bg pb-10">
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
        <div class="flex justify-center pt-32">
            <div class="text-center w-full">
                <div class="font-bold font-raleway text-4xl w-full">List Gudang</div>
                <div class="font-nunito text-lg flex justify-center mt-6 space-x-4">
                    <input id="searchInput2" onkeyup="searchList()" type="text"
                        class="flex py-1 px-10 w-5/12 rounded-lg border border-black font-nunito"
                        placeholder="Cari gudang sesuai kebutuhanmu" value="{{ $gudang }}">
                    <button onclick="searchButtonGoList()" class="py-1 px-6 bg-primary-pink text-white rounded-lg"><i
                            class="fas fa-search text-white"></i>
                        Search</button>
                </div>
            </div>
        </div>

        <div class="mt-10">
            @if(count($data) == 0)
                <div class="flex justify-center text-white">
                    <div class="text-center w-1/2 bg-red-500 rounded">
                        <div class="font-medium py-2 font-raleway text-2xl w-full">Data Tidak Ditemukan</div>
                    </div>
                </div>
            @endif
            <div class="px-40 grid grid-cols-4 gap-10 text-white font-nunito">
                @foreach ($data as $data)
                    <a href="{{ route('gudang.detail', ['id' => $data->id]) }}"
                        style='background-image: url("/images/{{ $data->gambar }}")'
                        class="w-[18rem] h-[25rem] bg-gray-800 bg-center rounded-xl relative bg-cover">
                        <div class="flex flex-col gap-2 px-5 text-lg absolute bottom-0 w-full py-5 rounded-b-xl bg-black bg-opacity-50">
                            <div class="font-bold">{{ $data->nama_gudang }}</div>
                            <div>{{ $data->lokasi }}</div>
                            <div>{{ $data->luas }}</div>
                            @if($data->status == 'available')
                            <div class="mt-2 bg-green-500 font-semibold p-2 rounded">{{ $data->status }}</div>
                            @else
                            <div class="mt-2 bg-red-500 font-semibold p-2 rounded">{{ $data->status }}</div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        function searchList() {
            let search = document.getElementById('searchInput2');
            console.log(search.value);
            search.addEventListener("keyup", function(event) {
                if (event.keyCode === 13) {
                    searchButtonGoList()
                }
            });
        }

        function searchButtonGoList() {
            let search = document.getElementById('searchInput2').value;
            if (search.length > 0) {
                window.location.href = '/list_gudang/' + search;
            } else {
                window.location.href = '/list_gudang';
            }
        }

        function closePopupError() {
            document.getElementById('error').classList.add('hidden');
        }
    </script>
@endsection

@section('footer')
    @include('layout.footer')
@endsection
