<div>
    @if(!empty($name) || !empty($type) || !empty($description) || !$showList)
        <form wire:submit.prevent="addLoket" class="space-y-3">
            <div>
                <label class="block text-sm font-medium">Nama Loket</label>
                <input wire:model.defer="name" class="border p-2 w-full" />
                @error('name') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium">Tipe</label>
                <input wire:model.defer="type" class="border p-2 w-full" />
            </div>

            <div>
                <label class="block text-sm font-medium">Deskripsi</label>
                <textarea wire:model.defer="description" class="border p-2 w-full"></textarea>
            </div>

            <div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Loket</button>
            </div>
        </form>
    @endif

    <div class="mt-4">
        <table class="w-full text-sm">
            <thead class="text-left text-gray-600">
                <tr>
                    <th class="pb-2">ID</th>
                    <th class="pb-2">Nama</th>
                    <th class="pb-2">Tipe</th>
                    <th class="pb-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lokets as $l)
                    <tr class="border-t">
                        <td class="py-2">{{ $l->id }}</td>
                        <td class="py-2">{{ $l->name }}</td>
                        <td class="py-2">{{ $l->type }}</td>
                        <td class="py-2">
                            <button wire:click.prevent="deleteLoket({{ $l->id }})" class="text-red-600">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
