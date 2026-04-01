<x-filament-panels::page>

    <style>
        .slims-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            border-radius: 0.5rem;
            border: 1px solid rgba(128, 128, 128, 0.25);
            background-color: rgba(128, 128, 128, 0.08);
            padding: 14px 20px;
            margin-bottom: 20px;
        }

        .slims-toolbar h2 {
            font-size: 15px;
            font-weight: 700;
            margin: 0;
        }

        .slims-toolbar p {
            font-size: 12px;
            opacity: 0.6;
            margin: 3px 0 0;
        }

        .btn-cetak {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #2563eb;
            color: #fff;
            border: 2px solid #1d4ed8;
            border-radius: 7px;
            padding: 9px 18px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            white-space: nowrap;
            font-family: inherit;
        }

        .btn-cetak:hover {
            background: #1d4ed8;
            border-color: #1e40af;
        }


        .label-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        /* Satu pasang per item, dashed border sebagai panduan potong */
        .label-pair {
            display: flex;
            gap: 5px;
            border: 1px dashed rgb(var(--gray-300));
            border-radius: 4px;
            padding: 6px;
            page-break-inside: avoid;
        }

        .dark .label-pair {
            border-color: rgb(var(--gray-600));
        }

        /* ─── BARCODE LABEL ───
           Selalu putih (kertas label), paksa warna */
        .barcode-label {
            flex: 1;
            border: 1.5px solid #000 !important;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            padding: 4px 6px;
            min-height: 32mm;
            background: #fff !important;
            color: #000 !important;
            font-family: Arial, Helvetica, sans-serif;
        }

        .barcode-label .lib-name {
            font-size: 7pt;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #000;
            width: 100%;
            text-align: center;
            padding-bottom: 3px;
            color: #000 !important;
        }

        .barcode-label .barcode-wrap {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4px 0;
        }

        .barcode-label .barcode-wrap svg {
            max-width: 100%;
            height: auto;
        }

        .barcode-label .item-info {
            width: 100%;
            border-top: 1px solid #000;
            padding-top: 3px;
            text-align: center;
            color: #000 !important;
        }

        .barcode-label .item-code {
            font-size: 7.5pt;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .barcode-label .call-number {
            font-size: 6.5pt;
        }


        .spine-label {
            width: 22mm;
            min-height: 32mm;
            border: 2px solid #000 !important;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 5px 4px;
            background: #fff !important;
            color: #000 !important;
            font-family: Arial, Helvetica, sans-serif;
        }

        .spine-label .row-class {
            font-size: 16pt;
            font-weight: 900;
            text-align: center;
            line-height: 1;
            letter-spacing: -1px;
            color: #000 !important;
        }

        .spine-label .divider-line {
            border-top: 1.5px solid #000;
            width: 100%;
            margin: 4px 0;
        }

        .spine-label .row-cutter {
            font-size: 9.5pt;
            font-weight: 700;
            text-align: center;
            line-height: 1.3;
            color: #000 !important;
        }

        .spine-label .row-year {
            font-size: 7pt;
            text-align: center;
            margin-top: 3px;
            color: #333 !important;
        }


        @media print {

            body * {
                visibility: hidden !important;
            }


            .print-content,
            .print-content * {
                visibility: visible !important;
            }


            .print-content {
                position: absolute !important;
                top: 0 !important;
                left: 0 !important;
                width: 100% !important;
                padding: 8mm !important;
            }


            .barcode-label,
            .spine-label {
                background: #fff !important;
                color: #000 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }


            .label-pair {
                border: none !important;
                padding: 0 !important;
            }

            .label-grid {
                gap: 4mm;
            }
        }

        @page {
            size: A4 portrait;
            margin: 8mm;
        }
    </style>


    <div class="slims-toolbar">
        <div style="border-left: 3px solid #3b82f6; padding-left: 12px;">
            <h2>Cetak Label — {{ Str::limit($record->title, 55) }}</h2>
            <p>{{ $items->count() }} eksemplar siap cetak</p>
        </div>
        <button class="btn-cetak" onclick="window.print()">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6 9V4h12v5M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2M6 14h12v6H6v-6z" />
            </svg>
            Cetak (Ctrl+P)
        </button>
    </div>


    <div class="print-content">

        @if ($items->isEmpty())
            <p style="text-align:center;padding:40px;font-family:inherit;">
                Tidak ada eksemplar ditemukan.
            </p>
        @else
            <div class="label-grid">
                @foreach ($items as $item)
                    @php
                        $classification = $record->classification ?? '';

                        $firstAuthor = $record->authors->first()?->name ?? '';
                        $nameParts = preg_split('/[\s,]+/', trim($firstAuthor));
                        $cutterName = strtoupper(mb_substr($nameParts[count($nameParts) > 1 ? 1 : 0] ?? 'XXX', 0, 3));

                        $skipWords = ['the', 'a', 'an', 'al', 'el'];
                        $titleWords = preg_split('/\s+/', strtolower($record->title ?? ''));
                        $titleFirst = $titleWords[0] ?? '';
                        if (in_array($titleFirst, $skipWords) && count($titleWords) > 1) {
                            $titleFirst = $titleWords[1];
                        }
                        $titleCode = mb_substr($titleFirst, 0, 1);
                        $publishYear = $record->publish_year ?? date('Y');
                    @endphp

                    <div class="label-pair">

                        <div class="barcode-label">
                            <div class="lib-name">Perpustakaan</div>
                            <div class="barcode-wrap">
                                {!! generateBarcodeSVG($item->item_code, 1, 36) !!}
                            </div>
                            <div class="item-info">
                                <div class="item-code">{{ $item->item_code }}</div>
                                <div class="call-number">{{ $classification }} {{ $cutterName }} {{ $titleCode }}
                                </div>
                            </div>
                        </div>

                        <div class="spine-label">
                            <div class="row-class">{{ $classification }}</div>
                            <div class="divider-line"></div>
                            <div class="row-cutter">{{ $cutterName }}<br>{{ $titleCode }}</div>
                            <div class="row-year">{{ $publishYear }}</div>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif

    </div>

    <script>
        const p = new URLSearchParams(window.location.search);
        if (p.get('autoprint') === '1') {
            window.addEventListener('load', () => setTimeout(() => window.print(), 400));
        }
    </script>

</x-filament-panels::page>
