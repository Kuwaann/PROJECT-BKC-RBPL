<?php
namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NasabahController extends Controller{
    public function showLandingPage()
    {
        $user = Auth::guard('nasabah')->user();
        if($user) {
            // Redirect to homepage if user is already logged in
            return redirect()->route('nasabah.homepage');
        }
        return view('auth.landing');
    }
    public function showHomePage()
    {
        $user = Auth::guard('nasabah')->user();
        if (!$user) {
            // Redirect ke login atau tampilkan pesan error
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
        $nasabah = Nasabah::where('id_akun', $user->id_akun)->first();
        $notifications = Notifications::where('id_akun', $user->id_akun)->get();
        return view('menu.homepage', compact('nasabah','notifications'));
    }
    public function showAccountPage()
    {
        $user = Auth::guard('nasabah')->user();
        $nasabah = Nasabah::where('id_akun', $user->id_akun)->first();
        return view('menu.account', compact('nasabah','user'));
    }
    public function showAccountSettingsPage()
    {
        $user = Auth::guard('nasabah')->user();
        $nasabah = Nasabah::where('id_akun', $user->id_akun)->first();
        return view('menu.account-settings', compact('nasabah'));
    }
    public function showNotificationsPage()
    {
        $user = Auth::guard('nasabah')->user();
        $nasabah = Nasabah::where('id_akun', $user->id_akun)->first();
        $notifications = Notifications::where('id_akun', $user->id_akun)->get();
        return view('menu.notification', compact('nasabah','notifications'));
    }
    public function showBalancePage()
    {
        $akun = Auth::guard('nasabah')->user();
        $nasabah = Nasabah::where('id_akun', $akun->id_akun)->first();
        return view('perbankan.loan_site.balance', compact('nasabah'));
    }
    public function markSeen(Request $request)
    {
        $notification =  Notifications::findOrFail($request->id_notifikasi);
        $notification->update([
            'status_notifikasi' => true,
        ]);
        return redirect($notification->link_notifikasi);
    }

    public function update(Request $request, $id): RedirectResponse
{
    $nasabah = Nasabah::findOrFail($id);

    $nasabah->update([
        'alamat_nasabah' => $request->alamat_nasabah,
        'gender_nasabah' => $request->gender_nasabah,
        'statuskawin_nasabah' => $request->statuskawin_nasabah,
        'nohp_nasabah' => $request->nohp_nasabah,
        'pekerjaan_nasabah' => $request->pekerjaan_nasabah,
        'penghasilan_nasabah' => $request->penghasilan_nasabah,
        'tanggungan_nasabah' => $request->tanggungan_nasabah,
        'nama_nasabah' => $request->nama_nasabah,



    ]);

    return redirect()->back()->with('success', 'Data berhasil diperbarui!');

}

    public function showIntroductionPage()
    {
        $user = Auth::guard('nasabah')->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
        $nasabah = Nasabah::where('id_akun', $user->id_akun)->first();
        return view('menu.introduction', compact('nasabah'));
    }

    public function selectCard(Request $request)
    {
        $validated = $request->validate([
            'card_type' => 'required|in:classic,gold,red'
        ]);

        $user = Auth::guard('nasabah')->user();
        \Log::info('User: ' . ($user ? $user->id_akun : 'null') . ', Card: ' . $request->card_type);
        $nasabah = Nasabah::where('id_akun', $user->id_akun)->first();
        \Log::info('Nasabah: ' . ($nasabah ? $nasabah->id_akun : 'not found'));
        if (!$nasabah) {
            return redirect()->back()->with('error', 'Nasabah not found');
        }

        $nasabah->update(['card_type' => $request->card_type]);

        return redirect()->route('nasabah.homepage')->with('success', 'Card selected successfully');
    }

}
?>
