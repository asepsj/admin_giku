<?php

namespace App\Http\Controllers\Page\Antrian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kreait\Laravel\Firebase\Facades\Firebase;

class RiwayatController extends Controller
{
    public function __construct()
    {
        $this->database = Firebase::database();
        $this->antrianTable = 'antrians';
        $this->userTable = 'users';
        $this->pasienTable = 'pasiens';
    }

    public function index(Request $request)
    {
        $id = $request->session()->get('uid');
        $search = $request->input('table_search', '');
        $dateFilter = $request->input('date_filter', '');

        // Fetch antrians from Firebase
        $antrians = $this->database->getReference($this->antrianTable)
            ->orderByChild('doctor_id')->equalTo($id)
            ->getValue();

        // Fetch users and pasien data
        $users = $this->database->getReference($this->userTable)->getValue();
        $pasiens = $this->database->getReference($this->pasienTable)->getValue();
        // Attach names to antrians
        foreach ($antrians as &$antrian) {
            $antrian['doctor_name'] = $users[$antrian['doctor_id']]['displayName'] ?? 'Unknown';
            $antrian['pasien_name'] = $pasiens[$antrian['pasien_id']]['displayName'] ?? 'Unknown';
        }

        // Filter antrians by status and search term
        $filteredAntrians = array_filter($antrians, function ($antrian) use ($search, $dateFilter) {
            $searchTerm = strtolower($search);
            $dateMatch = $dateFilter ? \Carbon\Carbon::parse($antrian['date'])->format('Y-m-d') === $dateFilter : true;
            return (
                in_array($antrian['status'], ['batal', 'selesai']) &&
                $dateMatch &&
                (
                    strpos(strtolower($antrian['pasien_name'] ?? ''), $searchTerm) !== false
                )
            );
        });

        return view('pages.antrian.riwayat.index', [
            'antrians' => $filteredAntrians,
            'search' => $search,
            'dateFilter' => $dateFilter
        ]);
    }
}
