<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Voucher Anda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                                        Nama Voucher
                                    </th>
                                    <th class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                                        Deskripsi
                                    </th>
                                    <th class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                                        Poin yang Dibutuhkan
                                    </th>
                                    <th class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                                        Diskon
                                    </th>
                                    <th class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                                        Tanggal Kedaluarsa
                                    </th>
                                    <th class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                                        Kode Voucher
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @if ($vouchers->isEmpty())
                                    <tr>
                                        <td colspan="6" class="p-4 text-center">Tidak ada voucher yang tersedia</td>
                                    </tr>
                                @else
                                    @foreach ($vouchers as $voucher)
                                        <tr>
                                            <td class="p-4">{{ $voucher->name }}</td>
                                            <td class="p-4">{{ $voucher->description }}</td>
                                            <td class="p-4">{{ $voucher->point_required }}</td>
                                            <td class="p-4">{{ $voucher->discount }}</td>
                                            <td class="p-4">{{ $voucher->expired_date }}</td>
                                            <td class="p-4">{{ $voucher->voucher_code }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
