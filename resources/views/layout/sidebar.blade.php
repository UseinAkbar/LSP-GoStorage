<div class="w-2/12 text-white bg-slate-800 min-h-screen" id="sidebar">
    <div class="px-5">
        <div class="font-bold text-md mt-4 pb-6 uppercase text-center">
            <div class="">Dashboard</div>
            <div class="">GoStorage</div>
        </div>
        <hr>
        <div class="mt-6">
        </div>
        @auth
        @if(Auth::user()->isAdmin == 1)
            <div class="mt-6">
                <div class="text-sm uppercase font-semibold text-slate-500">Admin</div>
                <div class="space-y-3 mt-5">
                    <a href="{{route('dashboard.gudang')}}"
                        class="flex space-x-3 {{ Route::is('dashboard.gudang') ? 'bg-slate-500 text-white' : '' }} items-center hover:bg-slate-500 hover:text-white rounded p-2">
                        <div class="w-5 text-center">
                            <i class="fas fa-people-carry hover:text-white text-slate-400"></i>
                        </div>
                        <div class="text-sm font-semibold uppercase">Data Gudang</div>
                    </a>
                    <a href="{{route('dashboard.transaksi')}}"
                        class="flex space-x-3 {{ Route::is('dashboard.transaksi') ? 'bg-slate-500 text-white' : '' }} items-center hover:bg-slate-500 hover:text-white rounded p-2">
                        <div class="w-5 text-center">
                            <i class="fas fa-dollar-sign hover:text-white text-slate-400"></i>
                        </div>
                        <div class="text-sm font-semibold uppercase">Data Transaksi</div>
                    </a>
                    <a href="{{route('dashboard.kategori')}}"
                        class="flex space-x-3 {{ Route::is('dashboard.kategori') ? 'bg-slate-500 text-white' : '' }} items-center hover:bg-slate-500 hover:text-white rounded p-2">
                        <div class="w-5 text-center">
                            <i class="fas fa-layer-group hover:text-white text-slate-400"></i>
                        </div>
                        <div class="text-sm font-semibold uppercase">List Kategori</div>
                    </a>
                    <a href="{{route('dashboard.user')}}"
                        class="flex space-x-3 items-center {{ Route::is('dashboard.user') ? 'bg-slate-500 text-white' : '' }} hover:bg-slate-500 hover:text-white rounded p-2">
                        <div class="w-5 text-center">
                            <i class="fas fa-user hover:text-white text-slate-400"></i>
                        </div>
                        <div class="text-sm font-semibold uppercase">Profile</div>
                    </a>
                </div>
            </div>
            @endif
            <div class="mt-6">
                <div class="text-sm uppercase font-semibold text-slate-500">Area User</div>
                <div class="space-y-3 mt-5">
                    <a href="{{route('gudang.home')}}"
                        class="flex space-x-3 {{ Route::is('gudang.home') ? 'bg-slate-500 text-white' : '' }} items-center hover:bg-slate-500 hover:text-white rounded p-2">
                        <div class="w-5 text-center">
                            <i class="fas fa-home hover:text-white text-slate-400"></i>
                        </div>
                        <div class="text-sm font-semibold uppercase">Home</div>
                    </a>
                    @if(Auth::user()->isAdmin != 1)
                    <a href="{{route('dashboard.history')}}"
                        class="flex space-x-3 {{ Route::is('dashboard.history') ? 'bg-slate-500 text-white' : '' }} items-center hover:bg-slate-500 hover:text-white rounded p-2">
                        <div class="w-5 text-center">
                            <i class="fas fa-people-carry hover:text-white text-slate-400"></i>
                        </div>
                        <div class="text-sm font-semibold uppercase">history peminjaman</div>
                    </a>
                    @endif
                    @if(Auth::user()->isAdmin == 1)
                    <a href="{{route('dashboard.pelanggan')}}"
                        class="flex space-x-3 items-center {{ Route::is('dashboard.pelanggan') ? 'bg-slate-500 text-white' : '' }} hover:bg-slate-500 hover:text-white rounded p-2">
                        <div class="w-5 text-center">
                            <i class="fas fa-list-ul hover:text-white text-slate-400"></i>
                        </div>
                        <div class="text-sm font-semibold uppercase">List Pelanggan</div>
                    </a>
                    @endif
                    @if(Auth::user()->isAdmin == 0)
                    <a href="{{route('dashboard.user')}}"
                        class="flex space-x-3 items-center {{ Route::is('dashboard.user') ? 'bg-slate-500 text-white' : '' }} hover:bg-slate-500 hover:text-white rounded p-2">
                        <div class="w-5 text-center">
                            <i class="fas fa-user hover:text-white text-slate-400"></i>
                        </div>
                        <div class="text-sm font-semibold uppercase">Profile</div>
                    </a>
                    @endif
                    <form action="{{route('user.logout')}}" method="post">
                    @csrf
                    @method('POST')
                    <button type="submit"
                        class="flex w-full space-x-3 items-center {{ Route::is('user.logout') ? 'bg-slate-500 text-white' : '' }} hover:bg-slate-500 hover:text-white rounded p-2">
                        <div class="w-5 text-center">
                            <i class="fas fa-user hover:text-white text-slate-400"></i>
                        </div>
                        <div type="submit" class="text-sm font-semibold uppercase">Logout</div>
                    </button>
                    </form>
                </div>
            </div>
            
        @endauth
    </div>
</div>
