<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Mengambil Top 3 Sellers
        $topSellers = DB::table('sale_items')
            ->join('sales', 'sale_items.sale_id', '=', 'sales.id')
            ->join('menus', 'sale_items.menu_id', '=', 'menus.id')
            ->select(
                'menus.name as menu_name',
                'menus.price as menu_price',
                DB::raw('SUM(sale_items.quantity) as total_orders')
            )
            ->where('sales.sale_date', '>=', Carbon::now()->subDays(7))
            ->groupBy('menus.id', 'menus.name', 'menus.price')
            ->orderByDesc('total_orders')
            ->limit(3)
            ->get();

        // 2. Mengambil 3 Recent Orders terbaru
        $recentOrders = Sale::with('items.menu')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        // 3. Menghitung Data Hari Ini & Kemarin
        $todayRevenueRaw = Sale::whereDate('created_at', Carbon::today())->sum('total');
        $yesterdayRevenueRaw = Sale::whereDate('created_at', Carbon::yesterday())->sum('total');
        $ordersToday = Sale::whereDate('created_at', Carbon::today())->count(); 

        // 4. Menghitung Rata-rata Order 7 Hari Terakhir
        $avgOrderRaw = Sale::where('created_at', '>=', Carbon::now()->subDays(7))->avg('total') ?? 0;

        // 5. Fungsi Helper untuk format K (Ribuan) dan M (Jutaan)
        $formatNumber = function ($number) {
            if ($number >= 1000000) {
                return round($number / 1000000, 1) . 'M';
            } elseif ($number >= 1000) {
                return round($number / 1000, 1) . 'K';
            }
            return $number;
        };

        // Format datanya agar siap ditampilkan di view
        $todayRevenue = $formatNumber($todayRevenueRaw);
        $avgOrderWeek = $formatNumber($avgOrderRaw);

        return view('dashboard', compact(
            'topSellers', 
            'recentOrders', 
            'todayRevenue', 
            'todayRevenueRaw', 
            'yesterdayRevenueRaw',
            'ordersToday',
            'avgOrderWeek'
        ));
    }
}   