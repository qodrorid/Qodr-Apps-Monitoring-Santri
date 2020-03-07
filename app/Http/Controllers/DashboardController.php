<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Auth;
use DB;

class DashboardController extends Controller
{
    
    public function index()
    {
        $role = Auth::user()->role_id;

        switch ($role) {
            case 1:
                # Super User
                return $this->superUser();
            case 2:
                # Admin
                return $this->admin();
            case 3:
                # Ketua
                return $this->ketua();
            case 4:
                # Sekretaris
                return $this->sekretaris();
            case 5:
                # Bendahara
                return $this->bendahara();
            case 6:
                # Divisi IT
                return $this->divisiIT();
            case 7:
                # Divisi Agama
                return $this->divisiAgama();
            case 8:
                # Mitra
                return $this->mitra();
            case 9:
                # Santri
                return $this->santri();
        }
    }

    private function superUser()
    {
        $logs   = Storage::disk('logs')->files();
        $roles  = DB::table('roles')->whereNull('deleted_at')->count();
        $users  = DB::table('users')->whereNull('deleted_at')->count();
        $branch = DB::table('branches')->whereNull('deleted_at')->count();
        
        unset($logs[0]);
        
        $widget = (object) [
            'logs'   => count($logs),
            'role'   => $roles,
            'user'   => $users,
            'branch' => $branch
        ];

        return view('pages.dashboard.1', compact('widget'));
    }

    private function admin()
    {
        return view('pages.dashboard.example');
    }

    private function ketua()
    {
        return view('pages.dashboard.example');
    }

    private function sekretaris()
    {
        return view('pages.dashboard.example');
    }

    private function bendahara()
    {
        return view('pages.dashboard.example');
    }

    private function divisiIT()
    {
        return view('pages.dashboard.example');
    }

    private function divisiAgama()
    {
        return view('pages.dashboard.example');
    }

    private function mitra()
    {
        return view('pages.dashboard.example');
    }

    private function santri()
    {
        return view('pages.dashboard.example');
    }


}
