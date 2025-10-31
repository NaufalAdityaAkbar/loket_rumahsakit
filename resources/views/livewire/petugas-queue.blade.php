<div class="p-4 bg-white rounded shadow">
    <div class="mb-3">
        <label class="block text-sm font-medium">Loket Aktif</label>
        <select wire:model="loketId" class="border p-2 w-full">
            <option value="">-- Pilih Loket --</option>
            {{-- Developer: populate loket list via API --}}
        </select>
    </div>

    <div class="flex gap-2">
        <button wire:click.prevent="callNext" class="bg-green-600 text-white px-4 py-2 rounded">Panggil Next</button>
    </div>

    <div class="mt-4">
        {{-- Tempat daftar antrian untuk loket dengan tombol Finish --}}
    </div>
</div>
