<div class="bg-white">
    <div class=" px-10 font-nunito">
        <div class=" flex items-center justify-between py-5">
            <a href='/' class="text-2xl font-bold font-raleway hover:underline">GoStorage</a>
            <div class="space-x-5">
                <a class="hover:underline {{ Route::is('gudang.home') ? 'underline  font-semibold' : '' }}"
                    href="/">Home</a>
                <!-- <a class="hover:underline {{ Route::is('gudang.rekomendasi') ? 'underline  font-semibold' : '' }}"
                    href="/rekomendasi">Rekomendasi</a> -->
                <a class="hover:underline {{ Route::is('gudang.list') ? 'underline  font-semibold' : '' }}"
                    href="/list_gudang">List Gudang</a>
            </div>
            <div class="flex space-x-5 items-center">
                <!-- <div id="search" class="hidden">
                    <input type="text" id="searchInput" onkeyup="search()"
                        class="py-0.5 px-10 rounded-full border border-primary-pink">
                </div>
                <div class="bg-primary-pink hover:bg-slate-300 hover:cursor-pointer px-2 py-1 rounded-full hidden"
                    id='searchButton2' onclick="searchButtonGo()">
                    <i class="fas fa-search text-white"></i>
                </div>
                <div class="bg-primary-pink hover:bg-slate-300 hover:cursor-pointer px-2 py-1 rounded-full"
                    id='searchButton' onclick="searchButton()">
                    <i class="fas fa-search text-white"></i>
                </div>
                <div class="bg-primary-pink rounded-full p-1 hover:bg-red-500 hidden" id='close'
                    onclick="closeButton()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 text-white hover:cursor-pointer">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div> -->
                <div>
                    @if (Auth::user() != null)
                        <div class="flex space-x-3">
                            @if(Auth::user()->isAdmin == 1)
                            <a href="{{ route('dashboard.transaksi') }}" class=" font-semibold  text-black py-2 px-4 rounded-lg hover:underline">Halo, {{ Auth::user()->nama }}</a>
                            @else
                            <a href="{{ route('dashboard.index') }}" class=" font-semibold  text-black py-2 px-4 rounded-lg hover:underline">Halo, {{ Auth::user()->nama }}</a>
                            @endif
                            <form method="POST" action="{{ route('user.logout') }}">
                                @csrf
                                <button type="submit"
                                    class="font-semibold bg-orange-500 hover:bg-orange-800 text-white py-2 px-4 rounded-lg">Logout</button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('user.login') }}"
                            class=" font-semibold bg-primary-pink hover:bg-slate-300 text-white py-2 px-4 rounded-lg">Masuk
                            /
                            Daftar</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
