<div wire:poll.2s class="min-h-screen flex items-center justify-center bg-slate-100 p-6">
    <div class="w-full max-w-5xl">
        <!-- Top header bar -->
        <div class="bg-blue-600 text-white rounded-t-lg px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 6h18M3 12h18M3 18h18" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <div class="text-lg font-semibold">Rumah Sakit Selalu</div>
            </div>
            <div class="text-sm opacity-90">LAYAR PEMANGGILAN ANTRIAN</div>
        </div>

        <!-- Main cards -->
        <div class="bg-white rounded-b-lg shadow-lg p-8">
            <!-- Current call card -->
            <div class="bg-white rounded-lg border p-8 text-center">
                <div class="text-sm text-gray-500 mb-2 flex items-center justify-center gap-2">
                    <span class="inline-block">SEDANG DIPANGGIL</span>
                    <span class="text-xs text-blue-500">wire:poll</span>
                </div>

                @php
                    $current = (isset($called) && $called->count()) ? $called->first() : null;
                @endphp

                <div class="text-6xl font-extrabold text-slate-800">{{ $current ? $current->nomor : '-' }}</div>
                <div class="mt-3 text-sm text-blue-600 font-semibold">Loket: {{ $current ? optional($current->loket)->name : 'Pendaftaran Umum' }}</div>
            </div>

            <!-- Next queue card -->
            <div class="mt-8 bg-white rounded-lg border p-6">
                <div class="text-sm text-gray-400 uppercase tracking-wide mb-4">Antrian Berikutnya</div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @if(isset($next) && $next->count())
                        @foreach($next as $n)
                            <div class="p-4 bg-slate-50 rounded shadow-sm">
                                <div class="text-lg font-bold">{{ $n->nomor }}</div>
                                <div class="text-xs text-gray-500">- Loket {{ optional($n->loket)->name ?? 'Umum' }}</div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-span-3 text-center text-gray-400">Tidak ada antrian menunggu</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
