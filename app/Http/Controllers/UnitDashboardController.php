<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnitDashboardController extends Controller
{
    public function index()
    {
        $wasteData = DB::table('waste_collections')
            ->join('waste_types', 'waste_collections.waste_type_id', '=', 'waste_types.id')
            ->select('waste_types.name as waste_type', DB::raw('MONTH(collected_at) as month'), DB::raw('SUM(amount) as total'))
            ->whereYear('collected_at', 2024)
            ->groupBy('waste_type', 'month')
            ->orderBy('month', 'asc')
            ->get();

        return view('unit.dashboard', compact('wasteData'));
    }
}
