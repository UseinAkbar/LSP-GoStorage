<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
    }

    public function dashboard_user()
    {
        return view('dashboard.user.user_read');
    }

    public function listPelanggan()
    {
        $data = User::all()->where('isAdmin','0');   
        return view('dashboard.user.user_list', ['data' => $data]);
    }

    public function registerAccount(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            'noTelp' => 'required',
            'instansi' => 'required',
            'password' => 'required|min:8',
        ];

        $customMessages = [
            'required' => ':attribute tidak boleh kosong.',
            'unique' => ':attribute sudah terdaftar.',
            'email' => ':attribute harus berupa email.',
            'min' => ':attribute minimal :min karakter.',
            'same' => ':attribute tidak sama dengan password.',
        ];

        $this->validate($request, $rules, $customMessages);
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'noTelp' => $request->noTelp,
            'instansi' => $request->instansi,
            'password' => bcrypt($request->password)
        ]);

        $user->save();
        return redirect()->route('user.login')->with('success', 'Registrasi Berhasil');
    }

    public function daftar()
    {
        return view('register');
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        $customMessages = [
            'required' => ':attribute tidak boleh kosong.'
        ];

        $this->validate($request, $rules, $customMessages);


        if (Auth::attempt($request->only('email', 'password'))) {
            return back()->with('success', 'Login Berhasil');
        }

        return back()->withErrors([
            'wrong' => 'Email atau password anda salah',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.user.user_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            'noTelp' => 'required',
            'instansi' => 'required',
            'password' => 'required|min:8',
        ];

        $customMessages = [
            'required' => ':attribute tidak boleh kosong.',
            'unique' => ':attribute sudah terdaftar.',
            'email' => ':attribute harus berupa email.',
            'min' => ':attribute minimal :min karakter.',
            'same' => ':attribute tidak sama dengan password.',
        ];

        $this->validate($request, $rules, $customMessages);
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'noTelp' => $request->noTelp,
            'instansi' => $request->instansi,
            'password' => bcrypt($request->password)
        ]);

        $user->save();
        return redirect()->route('dashboard.pelanggan')->with('success', 'Data Pelanggan Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::find($id);
        return view('dashboard.user.user_edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if($request->has('photoProfile')) {
            // $file = $request->file('gambar');
            // $filename = uniqid() . "_" . $file->getClientOriginalName();
            // $file->storeAs('public/', $filename);
            $path = 'images/';
            File::delete($path . $user->photoProfile);

            $filename = time() . '.' . $request->photoProfile->extension();

            $request->photoProfile->move(public_path('images'), $filename);

            $user->photoProfile = $filename;
        }

        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->noTelp = $request->noTelp;
        $user->instansi = $request->instansi;
        $user->save();

        if (Auth::user()->isAdmin == 1) {
            if (str_contains($request->path(), 'admin')) {
                return redirect()->route('dashboard.pelanggan')->with('success', 'Berhasil Mengubah Data');
            } else {
                return redirect()->back()->with('success', 'Berhasil Mengubah Data');
            }
        }

        return redirect()->back()->with('success', 'Berhasil Mengubah Data');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('dashboard.pelanggan')->with('success', 'Data Berhasil Dihapus');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('user.login')->with('success', 'Berhasil Logout');
    }
}
