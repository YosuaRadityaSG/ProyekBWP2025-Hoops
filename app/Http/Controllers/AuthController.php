<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Interest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginRegister()
    {
        // Ambil semua user untuk ditampilkan di halaman awal
        $all_users = DB::table('users')->get();
        
        $param['users'] = $all_users;
        return view('auth.login_register', $param);
    }

    public function handleLogin(Request $request)
    {
        $users = User::where('email', $request->email)->get();

        if (count($users) > 0) {
            $user = $users[0];
            
            // Simpan ID user di session untuk langkah selanjutnya
            Session::put('user_id_to_process', $user->id);

            // Cek apakah profilnya sudah lengkap (kita ambil contoh nickname)
            if ($user->birth_date == null) {
                // Jika profil belum lengkap, arahkan ke halaman registrasi profil
                return redirect()->route('register.profile');
            } else {
                // Jika profil sudah lengkap, "login"-kan user dan arahkan ke dashboard
                Session::put('user_id', $user->id);
                Session::forget('user_id_to_process'); // Hapus session sementara
                return redirect()->route('dashboard');
            }
        }
        return redirect()->route('loginRegister')->with('error', 'Akun tidak ditemukan.');
    }

    public function showEmailRegister()
    {
        return view('auth.register_email');
    }

    public function handleEmailRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|regex:/^(?=.*[A-Z])(?=.*\d).+$/'
        ]);

        if ($validator->fails()) {
            return redirect()->route('register.email')->withErrors($validator);
        }

        // Buat user baru di database dengan profil kosong
        // Kita gunakan username dari form sebagai nickname sementara
        $user = User::create([
            'email' => $request->email,
            'nickname' => $request->username, // Gunakan username sebagai nickname awal
            'role_id' => 2,
            // Kolom lain akan otomatis NULL sesuai struktur DB baru
        ]);

        if ($user) {
            // Jika berhasil, kembali ke halaman awal dengan pesan sukses
            return redirect()->route('loginRegister')->with('success', 'Akun ' . $request->email . ' berhasil dibuat! Silahkan pilih akun Anda untuk melanjutkan registrasi.');
        }

        return redirect()->route('register.email')->with('error', 'Terjadi kesalahan saat membuat akun.');
    }

    public function showProfileRegister()
    {
        // Pastikan ada user yang sedang dalam proses registrasi
        if (!Session::has('user_id_to_process')) {
            return redirect()->route('loginRegister')->with('error', 'Silahkan pilih akun terlebih dahulu!');
        }
        $interests = Interest::all();
        $param['interests'] = $interests;
        return view('auth.register_profile', $param);
    }

    public function handleProfileRegister(Request $request)
    {
        $userId = Session::get('user_id_to_process');
        if (!$userId) {
            return redirect()->route('loginRegister');
        }

        $request->validate([
            'nickname' => 'required',
            'birth_date' => 'required|date',
            'gender' => 'required',
            'country' => 'required',
            'friend_preference_gender' => 'required',
            'friend_preference_location' => 'required',
            'interests' => 'required|array|min:1'
        ]);

        // Cari user yang akan di-update
        $userToUpdate = User::where('id', $userId)->get();

        if (count($userToUpdate) > 0) {
            // Lakukan update data
            DB::table('users')->where('id', $userId)->update([
                'nickname' => $request->nickname,
                'birth_date' => $request->birth_date,
                'gender' => $request->gender,
                'country' => $request->country,
                'friend_preference_gender' => $request->friend_preference_gender,
                'friend_preference_location' => $request->friend_preference_location,
                'profile_picture_url' => $request->profile_picture_url,
            ]);

            // Hapus data interest lama (jika ada, untuk mencegah duplikat)
            DB::table('interest_user')->where('user_id', $userId)->delete();

            // Masukkan data interest yang baru
            foreach ($request->interests as $interest_id) {
                DB::table('interest_user')->insert([
                    'user_id' => $userId,
                    'interest_id' => $interest_id
                ]);
            }
            
            // Login-kan user
            Session::put('user_id', $userId);
            Session::forget('user_id_to_process'); // Hapus session sementara
            
            return redirect()->route('dashboard')->with('success', 'Registrasi berhasil! Selamat datang!');
        }
        
        return redirect()->route('register.profile')->with('error', 'Gagal menyimpan data. User tidak ditemukan.');
    }

    public function dashboard()
    {
        if (!Session::has('user_id')) {
            return redirect()->route('loginRegister');
        }
        $userId = Session::get('user_id');
        $users = User::with('interests')->where('id', $userId)->get();
        if (count($users) == 0) {
            return redirect()->route('logout');
        }
        $user = $users[0];
        $param['user'] = $user;
        return view('dashboard', $param);
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('loginRegister');
    }
    
    public function checkEmail(Request $request)
    {
        $users = User::where('email', $request->email)->get();
        if(count($users) > 0) {
            return response()->json(['exists' => true]);
        }
        return response()->json(['exists' => false]);
    }
}