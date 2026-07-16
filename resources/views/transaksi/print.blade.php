<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi - Print</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
        }

        .header p {
            margin: 5px 0 0;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }

        th {
            background-color: #f4f4f4;
            text-transform: uppercase;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .summary {
            margin-top: 30px;
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        .summary-box {
            border: 1px solid #333;
            padding: 15px;
            width: 300px;
        }

        /* Auto-Print Logic saat halaman terbuka */
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="header">
        <h2>Laporan Transaksi</h2>
        <p>Periode: {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} s/d
            {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tgl Transaksi</th>
                <th>Invoice</th>
                <th>Item Dibeli</th>
                <th>Status</th>
                <th class="text-right">Total (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sales as $index => $sale)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($sale->created_at)->format('d-m-Y H:i') }}</td>
                    <td>{{ $sale->invoice_number }}</td>
                    <td>
                        <ul style="margin: 0; padding-left: 15px;">
                            @foreach ($sale->items as $item)
                                <li>{{ $item->menu->name ?? 'Item Tidak Ditemukan' }} (x{{ $item->quantity }})</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ ucfirst($sale->status) }}</td>
                    <td class="text-right">{{ number_format($sale->total, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada transaksi pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" class="text-right">Total Pendapatan (Status Selesai):</th>
                <th class="text-right">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="summary no-print" style="margin-top: 20px;">
        <button onclick="window.print()"
            style="padding: 10px 20px; background: #333; color: white; border: none; cursor: pointer;">Print
            Ulang</button>
    </div>

</body>

</html>
