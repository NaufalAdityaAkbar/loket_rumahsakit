<div class="p-4 bg-white rounded shadow">
    <div class="mb-3">
        <label class="block text-sm font-medium">Nama Pasien (opsional)</label>
        <input wire:model.defer="patientName" type="text" class="border p-2 w-full" placeholder="Nama Anda">
    </div>

    <div class="mb-3">
        <label class="block text-sm font-medium">Pilih Loket (opsional)</label>
        <select wire:model="loketId" class="border p-2 w-full">
            <option value="">-- Pilih --</option>
            {{-- Developer: populate loket list via controller / API and emit to Livewire --}}
        </select>
    </div>

    <div>
        <button wire:click.prevent="generate" class="bg-blue-600 text-white px-4 py-2 rounded">Ambil Nomor</button>
    </div>

    <div class="mt-4">
        {{-- Tempat menampilkan nomor yang sudah diambil --}}
    </div>
</div>
