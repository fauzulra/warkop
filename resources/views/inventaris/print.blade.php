<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Stok Barang - {{ $startDate->format('d/m/Y') }} sd {{ $endDate->format('d/m/Y') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print {
                display: none;
            }

            body {
                padding: 20px;
            }
        }
    </style>
</head>

<body class="bg-white p-8">

    <!-- Tombol Cetak (Tidak ikut tercetak) -->
    <div class="no-print mb-8 flex justify-end">
        <button onclick="window.print()" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
            Print Laporan
        </button>
    </div>

    <!-- Header Laporan -->
    <div class="text-center mb-8 border-b-2 border-gray-800 pb-4">
        <h1 class="text-2xl font-bold uppercase">Laporan Stok Barang</h1>
        <p class="text-gray-600">Periode: {{ $startDate->format('d F Y') }} - {{ $endDate->format('d F Y') }}</p>
    </div>

    <!-- Tabel Data -->
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2 text-left">Kode</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Nama Item</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Kategori</th>
                <th class="border border-gray-300 px-4 py-2 text-right">Stok</th>
                <th class="border border-gray-300 px-4 py-2 text-right">Harga Satuan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td class="border border-gray-300 px-4 py-2 font-mono">{{ $product->sku_code }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $product->name }}</td>
                    <td class="border border-gray-300 px-4 py-2 capitalize">{{ $product->category }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-right font-bold">{{ $product->stock }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-right">Rp
                        {{ number_format($product->unit_price, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="border border-gray-300 px-4 py-4 text-center text-gray-500">
                        Tidak ada data pada periode ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Tanda Tangan -->
    <div class="mt-12 flex justify-end">
        <div class="text-center w-48">
            <p>Batam, {{ date('d F Y') }}</p>
            <p class="mb-16">Penanggung Jawab,</p>
            <p class="font-bold underline">(...............................)</p>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>
