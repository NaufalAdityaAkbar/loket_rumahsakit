<div wire:poll.2s class="min-h-screen bg-slate-100 p-6">
    <div class="w-full">
        <!-- Top header bar -->
        <div class="bg-blue-600 text-white rounded-t-lg px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 6h18M3 12h18M3 18h18" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <div class="text-lg font-semibold">Rumah Sakit Selalu</div>
            </div>
            <div class="text-sm opacity-90">LAYAR PEMANGGILAN ANTRIAN</div>
        </div>

        <!-- Main content -->
        <div class="bg-white rounded-b-lg shadow-lg p-8">
            <!-- Loket Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($lokets as $loket)
                    <div class="bg-white rounded-lg border shadow-sm">
                        <!-- Loket Header -->
                        <div class="bg-blue-500 text-white px-4 py-3 rounded-t-lg">
                            <h3 class="font-semibold">{{ $loket->name }}</h3>
                            <p class="text-xs opacity-80">{{ $loket->description }}</p>
                        </div>

                        <!-- Current Number -->
                        @php
                            $current = $loket->antrians->where('status', App\Models\Antrian::STATUS_CALLED)->first();
                            $waiting = $loket->antrians->where('status', App\Models\Antrian::STATUS_WAITING)->take(3);
                        @endphp

                        <div class="p-4">
                            <div class="text-center mb-4">
                                <p class="text-sm text-gray-500 mb-1">SEDANG DILAYANI</p>
                                <div class="text-4xl font-bold text-blue-600">
                                    {{ $current ? $current->nomor : '-' }}
                                </div>
                            </div>

                            <!-- Next Numbers -->
                            <div class="border-t pt-3">
                                <p class="text-xs text-gray-500 mb-2">ANTRIAN BERIKUTNYA:</p>
                                <div class="space-y-2">
                                    @forelse($waiting as $antrian)
                                        <div class="bg-gray-50 rounded px-3 py-2 text-sm">
                                            <span class="font-semibold">{{ $antrian->nomor }}</span>
                                        </div>
                                    @empty
                                        <p class="text-center text-gray-400 text-sm">Tidak ada antrian</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
