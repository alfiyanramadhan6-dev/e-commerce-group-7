<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Store;
use Illuminate\Http\Request;

class AdminSellerApprovalController extends Controller
{
    /**
     * Show list of users requesting seller approval
     */
    public function index()
    {
        $pending = User::where('store_request_status', 'pending')->get();

        return view('admin.seller-requests.index', [
            'requests' => $pending
        ]);
    }

    /**
     * Approve seller request
     */
    public function approve($userId)
    {
        $user = User::findOrFail($userId);

        // Ubah status pengajuan
        $user->update([
            'store_request_status' => 'approved'
        ]);

        // Verifikasi store EXISTING (jangan buat baru)
        if ($user->store) {
            $user->store->update([
                'is_verified' => true
            ]);
        }

        return redirect()->back()->with('success', 'Seller berhasil disetujui.');
    }

    /**
     * Reject seller request
     */
    public function reject($userId)
    {
        $user = User::findOrFail($userId);

        // Update status pengajuan
        $user->update([
            'store_request_status' => 'rejected'
        ]);

        // Jika mau, hapus store yang belum diverifikasi
        if ($user->store && $user->store->is_verified === false) {
            $user->store->delete();
        }

        return redirect()->back()->with('error', 'Seller ditolak.');
    }
}
