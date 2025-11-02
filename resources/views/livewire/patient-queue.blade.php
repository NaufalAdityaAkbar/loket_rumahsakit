<div style="background:#f3f4f6; padding:40px 0; display:flex; justify-content:center;">
    <div style="width:920px; max-width:95%; display:flex; gap:28px; align-items:flex-start;">
        <!-- Left card: choose loket -->
        <div style="flex:1; background:#ffffff; border-radius:10px; padding:22px; box-shadow:0 6px 20px rgba(2,6,23,0.08);">
            <div style="font-weight:700; margin-bottom:6px;">Pilih Loket Antrian</div>
            <div style="color:#6b7280; font-size:13px; margin-bottom:14px;">Silakan pilih layanan antrian.</div>

            <!-- loket list (type shown on buttons) -->

            <div style="display:flex; flex-direction:column; gap:12px;">
                @foreach(($lokets ?? []) as $loket)
                    @php
                        // support both Collection of models and plain arrays
                        $id = is_object($loket) ? $loket->id : ($loket['id'] ?? null);
                        // show the 'type' column as the label; fallback to name if type missing
                        $label = is_object($loket) ? ($loket->type ?? $loket->name ?? '') : ($loket['type'] ?? ($loket['name'] ?? ''));
                    @endphp
                    @if($id)
                        <button wire:click="generateWithLoket({{ $id }})" style="display:flex; align-items:center; gap:10px; padding:12px 14px; border-radius:8px; border:none; background:linear-gradient(180deg,#1e3ea8,#2563eb); color:#fff; font-weight:700; cursor:pointer;">
                            <span style="background:rgba(255,255,255,0.12); width:36px; height:36px; display:inline-flex; align-items:center; justify-content:center; border-radius:6px;">📋</span>
                            <span style="flex:1; text-align:left;">{{ $label }}</span>
                        </button>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Right card: show generated number -->
        <div style="width:420px; background:#ffffff; border-radius:10px; padding:22px; box-shadow:0 6px 20px rgba(2,6,23,0.08);">
            <div style="font-weight:700; margin-bottom:6px;">Nomor Antrian Anda</div>
            <div style="color:#6b7280; font-size:13px; margin-bottom:18px;">Pilih loket di kiri untuk menampilkan nomor antrian Anda.</div>

            <div style="background:#f8fafc; border-radius:8px; padding:20px; text-align:center;">
                @if(!empty($success) && !empty($nomor))
                    <div style="font-size:40px; font-weight:800; color:#0f172a;">{{ $nomor }}</div>
                    @php
                        $sel = collect($lokets)->firstWhere('id', $loketId);
                        $selLabel = is_object($sel) ? ($sel->type ?? $sel->name ?? '') : ($sel['type'] ?? ($sel['name'] ?? ''));
                    @endphp
                    <div style="margin-top:8px; color:#6b7280;">Loket: <strong>{{ $selLabel }}</strong></div>
                    <div style="margin-top:14px; display:flex; gap:8px; justify-content:center;">
                        <button onclick="window.print()" style="background:#2563eb; color:#fff; padding:10px 14px; border-radius:8px; border:none; font-weight:700; cursor:pointer;">Cetak Nomor Antrian</button>
                    </div>
                @else
                    <div style="font-size:28px; font-weight:700; color:#9ca3af;">- - -</div>
                    <div style="margin-top:10px; color:#9ca3af;">Belum ada nomor</div>
                @endif
            </div>
        </div>
    </div>
</div>
