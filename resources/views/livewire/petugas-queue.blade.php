<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Left: profile / loket selector -->
    <div class="bg-white rounded shadow p-6">
        <div class="mb-4">
            <label class="block text-sm font-medium">Loket Aktif</label>
                    <select wire:model.live="loketId" class="border p-2 w-full">
            <option value="">-- Pilih Loket --</option>
            @foreach($lokets as $l)
                <option value="{{ $l->id }}">{{ $l->name }}</option>
            @endforeach
        </select>
        @if($loketId)
        @endif
        </div>

        <div class="flex items-center gap-4">
            <img src="https://ui-avatars.com/api/?name=Petugas" alt="avatar" class="w-20 h-20 rounded-full" />
            <div>
                <div class="font-semibold">Petugas Loket</div>
                <div class="text-sm text-gray-500">{{ optional($lokets->where('id', $loketId)->first())->name ?? 'Pilih loket' }}</div>
            </div>
        </div>
    </div>

    <!-- Middle: waiting list -->
    <div class="md:col-span-1 bg-white rounded shadow p-6">
        <div class="font-semibold mb-3">Daftar Antrian Menunggu</div>
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
                            <button wire:click="callSpecific({{ $w->id }})" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                                Panggil
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-sm text-gray-400">Tidak ada antrian menunggu</div>
        @endif
    </div>

    <!-- Right: current called -->
    <div class="bg-white rounded shadow p-6">
        <div class="font-semibold mb-3">Sedang Dipanggil</div>
        @if($currentCalled)
            <div class="text-center">
                <div class="text-4xl font-extrabold mb-2">{{ $currentCalled->nomor }}</div>
                <div class="text-sm text-gray-600 mb-4">Loket: {{ optional($currentCalled->loket)->name ?? '-' }}</div>
                <button wire:click.prevent="finish({{ $currentCalled->id }})" class="bg-green-600 text-white w-full py-2 rounded">Selesai</button>
            </div>
        @else
            <div class="text-center text-gray-400">Belum ada panggilan</div>
        @endif
        <div class="mt-4">
            <button wire:click.prevent="callNext" class="bg-indigo-500 text-white w-full py-2 rounded">Panggil Next</button>
        </div>
    </div>
</div>
