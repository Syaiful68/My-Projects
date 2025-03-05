<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Armada;
use App\Models\Record;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userRole = Auth::user()->rules;
        if ($userRole !== 'admin') {
            return redirect('/fuel');
        }
        $armada = Armada::query()->where('is_status', '0')->count();
        $transaction = Record::query()->where('is_status', 'paid')->count();
        $cash = Record::query()->where('is_status', 'paid')->sum('cost');
        $year = Carbon::now()->format('Y');
        $sumTransaction = DB::table('tb_record')->select('is_status', DB::raw('SUM(cost) as total_cost'))->groupBy('is_status')->get();
        $sumBarTransaction = DB::table('tb_record')->where('is_status', 'Paid')->where(DB::raw('YEAR(created_at)'), $year)->select(DB::raw('SUM(cost) as data'), DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'))->groupBy('Month', 'year')->get();
        return Inertia::render('home', [
            'armada' => $armada,
            'transaction' => $transaction,
            'cash' => $cash,
            'total_cost' => $sumTransaction,
            'summary' => $sumBarTransaction,
            'year' => $year
        ]);
    }
}
