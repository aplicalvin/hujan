<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Keranjang Belanja</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
</head>

<body class="bg-zinc-800 text-white flex flex-col min-h-screen justify-between">
    <!-- INI UNTUK HEADING -->
    <nav class="bg-slate-100 px-24 py-6">
        @include('components.nav-bar')
    </nav>
    <!-- INI UNTUK HEADING -->
    <div class="max-w-[960px] mt-12 py-8 mx-auto w-full">
        @php
            $invoice_number = request('invoice_number');
            $transaction = App\Models\Transaction::where('invoice_number', $invoice_number)->first();
        @endphp
        <h1 class="text-3xl font-bold mb-6 text-center">Checkout</h1>

        <!-- Invoice dan No Meja -->
        <div class="bg-zinc-700 p-6 rounded-lg shadow-lg mb-6">
            <h2 class="text-xl font-semibold mb-4">Detail Pesanan</h2>
            <p class="mb-2">
                No. Invoice: <span class="font-bold"># {{ $transaction->invoice_number }}</span>
            </p>
            <p>No. Meja: <span class="font-bold">{{ $transaction->table_number }}</span></p>
        </div>

        <!-- Status Pesanan -->
        <div
            id="status-container"
            class="bg-zinc-700 p-6 rounded-lg shadow-lg md:mx-auto flex flex-col md:flex-row w-full justify-between items-center">
            <h2 class="text-xl font-semibold mb-4">Status Pesanan</h2>
            <div class="flex items-center gap-4">
                <!-- Status Text -->
                <div>
                    <h3
                        class="text-lg text-center font-semibold {{ $transaction->status == 'pending' ? 'text-yellow-500' : ($transaction->status == 'cooking' ? 'text-orange-500' : ($transaction->status == 'completed' ? 'text-green-500' : 'text-red-500')) }}">
                        @if ($transaction->status == 'pending')
                            Menunggu Pembayaran
                        @elseif ($transaction->status == 'cooking')
                            Sedang Dimasak
                        @elseif ($transaction->status == 'completed')
                            Pesanan Selesai
                        @elseif ($transaction->status == 'cancelled')
                            Pesanan Dibatalkan
                        @endif
                    </h3>
                    <p class="text-sm text-gray-400">
                        @if ($transaction->status == 'pending')
                            Silakan lakukan pembayaran untuk melanjutkan proses.
                        @elseif ($transaction->status == 'cooking')
                            Pesanan Anda Sedang Dimasak
                        @elseif ($transaction->status == 'completed')
                            Pesanan Anda Selesai
                        @elseif ($transaction->status == 'canceled')
                            Pesanan Anda Dibatalkan
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- FOOTER / MEDIA SOCIAL -->
    @include('components.footer2')
    <!-- FOOTER / MEDIA SOCIAL -->

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script>
        function updateStatus() {
            const invoiceNumber = '{{ $invoice_number }}';
            fetch(`{{ route('transaction.status', ['invoice_number' => $invoice_number]) }}`)
                .then(response => response.json())
                .then(data => {
                    const statusContainer = document.getElementById('status-container');
                    let statusText = '';
                    let statusDescription = '';
                    let statusColor = '';

                    switch (data.status) {
                        case 'pending':
                            statusText = 'Menunggu Pembayaran';
                            statusDescription = 'Silakan lakukan pembayaran untuk melanjutkan proses.';
                            statusColor = 'text-yellow-500';
                            break;
                        case 'cooking':
                            statusText = 'Sedang Dimasak';
                            statusDescription = 'Pesanan Anda Sedang Dimasak';
                            statusColor = 'text-orange-500';
                            break;
                        case 'completed':
                            statusText = 'Pesanan Selesai';
                            statusDescription = 'Pesanan Anda Selesai';
                            statusColor = 'text-green-500';
                            break;
                        case 'canceled':
                            statusText = 'Pesanan Dibatalkan';
                            statusDescription = 'Pesanan Anda Dibatalkan';
                            statusColor = 'text-red-500';
                            break;
                    }

                    statusContainer.innerHTML = `
                        <h2 class="text-xl font-semibold mb-4">Status Pesanan</h2>
                        <div class="flex items-center gap-4">
                            <div>
                                <h3 class="text-lg text-center font-semibold ${statusColor}">
                                    ${statusText}
                                </h3>
                                <p class="text-sm text-gray-400">
                                    ${statusDescription}
                                </p>
                            </div>
                        </div>
                    `;
                });
        }

        // Update status setiap 5 detik
        updateStatus();
        setInterval(updateStatus, 5000);
    </script>
</body>

</html>
