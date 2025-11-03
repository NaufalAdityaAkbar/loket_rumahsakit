<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left column: selector + waiting list -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded shadow p-6 mb-6">
            <label class="block text-sm font-medium mb-2">Loket Aktif</label>
            <select wire:model.live="loketId" class="border p-2 w-full rounded">
                <option value="">-- Pilih Loket --</option>
                @foreach($lokets as $l)
                    <option value="{{ $l->id }}">{{ $l->name }}</option>
                @endforeach
            </select>

            @if($loketId)
                <div class="mt-4 flex items-center gap-4">
                    <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center text-lg font-bold">PE</div>
                    <div>
                        <div class="font-semibold">Petugas Loket</div>
                        <div class="text-sm text-gray-500">{{ optional($lokets->where('id', $loketId)->first())->name ?? 'Pilih loket' }}</div>
                    </div>
                </div>
            @else
                <div class="mt-4 text-sm text-gray-400">Pilih loket terlebih dahulu</div>
            @endif
        </div>

        <div class="bg-white rounded shadow p-6">
            <h4 class="font-semibold mb-3">Daftar Antrian Menunggu</h4>
            @if(!$loketId)
                <div class="text-sm text-gray-400">Pilih loket terlebih dahulu</div>
            @elseif(isset($waitingList) && $waitingList->count() > 0)
                <div class="space-y-3">
                    @foreach($waitingList as $w)
                        <div class="flex items-center justify-between border rounded p-3">
                            <div>
                                <div class="font-medium">{{ $w->nomor }}</div>
                                <div class="text-xs text-gray-500">{{ $w->patient_name ?? '-' }}</div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button wire:click="callSpecific({{ $w->id }})" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">Panggil</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-sm text-gray-400">Tidak ada antrian menunggu</div>
            @endif
        </div>
    </div>

    <!-- Center spacer for balanced layout on large screens -->
    <div class="lg:col-span-1"></div>

    <!-- Right column: current called -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded shadow p-6 text-center">
            <h4 class="font-semibold mb-3">Sedang Dipanggil</h4>
            @if($currentCalled)
                <div class="text-5xl font-extrabold mb-2">{{ $currentCalled->nomor }}</div>
                <div class="text-sm text-gray-600 mb-5">Loket: {{ optional($currentCalled->loket)->name ?? '-' }}</div>
                <button wire:click="finish({{ $currentCalled->id }})" class="bg-green-600 hover:bg-green-700 text-white w-full py-2 rounded">Selesai</button>
            @else
                <div class="text-center text-gray-400 py-10">Belum ada panggilan</div>
            @endif

            <div class="mt-4">
                <button wire:click="callNext" class="bg-indigo-600 hover:bg-indigo-700 text-white w-full py-2 rounded">Panggil Next</button>
            </div>
        </div>
    </div>
</div>
