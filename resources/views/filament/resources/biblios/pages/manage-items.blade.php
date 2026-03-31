<x-filament-panels::page>
    <style>
        .custom-biblio-wrapper {
            position: relative;
            background-color: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border: 1px solid rgba(0,0,0,0.05);
            margin-bottom: 24px;
            display: flex;
            align-items: flex-start;
            gap: 24px;
        }
        .custom-biblio-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: var(--primary-600, #2563eb);
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
            transition: opacity 0.2s;
        }
        .custom-biblio-btn:hover {
            opacity: 0.8;
            color: white;
        }
        .custom-biblio-img {
            width: 120px;
            height: 160px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.15);
            border: 1px solid #e5e7eb;
        }
        .custom-biblio-noImg {
            width: 120px;
            height: 160px;
            background-color: #f3f4f6;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: #9ca3af;
            text-align: center;
            padding: 10px;
        }
        .custom-biblio-title {
            font-size: 22px;
            font-weight: 700;
            color: #111827;
            margin: 0;
            line-height: 1.2;
        }
        .custom-biblio-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-top: 10px;
        }
        .custom-biblio-label {
            display: block;
            font-size: 12px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }
        .custom-biblio-value {
            color: #111827;
            font-size: 15px;
            font-weight: 600;
        }

        /* DARK MODE SUPPORT */
        .dark .custom-biblio-wrapper {
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .dark .custom-biblio-btn {
            background-color: var(--primary-500, #3b82f6);
        }
        .dark .custom-biblio-img {
            border-color: rgba(255,255,255,0.1);
        }
        .dark .custom-biblio-noImg {
            background-color: rgba(0,0,0,0.2);
            border-color: rgba(255,255,255,0.1);
        }
        .dark .custom-biblio-title {
            color: #f9fafb;
        }
        .dark .custom-biblio-label {
            color: #9ca3af;
        }
        .dark .custom-biblio-value {
            color: #f3f4f6;
        }
    </style>

    <div class="custom-biblio-wrapper">
        <a href="{{ App\Filament\Resources\Biblios\BiblioResource::getUrl('edit', ['record' => $this->getOwnerRecord()->biblio_id]) }}"
           class="custom-biblio-btn">
            Edit Biblio
        </a>

        @if ($this->getOwnerRecord()->cover_image)
            <img src="{{ asset('uploads/' . $this->getOwnerRecord()->cover_image) }}" alt="Sampul" class="custom-biblio-img" />
        @else
            <div class="custom-biblio-noImg">Tanpa Sampul</div>
        @endif

        <div style="flex: 1; display:flex; flex-direction: column; gap: 10px; padding-right: 120px;">
            <h2 class="custom-biblio-title">{{ $this->getOwnerRecord()->title }}</h2>

            <div class="custom-biblio-grid">
                <div>
                    <span class="custom-biblio-label">Penerbit</span>
                    <strong class="custom-biblio-value">{{ $this->getOwnerRecord()->publisher?->name ?? '-' }}</strong>
                </div>

                <div>
                    <span class="custom-biblio-label">GMD</span>
                    <strong class="custom-biblio-value">{{ $this->getOwnerRecord()->gmd?->name ?? '-' }}</strong>
                </div>

                <div>
                    <span class="custom-biblio-label">Tahun Terbit</span>
                    <strong class="custom-biblio-value">{{ $this->getOwnerRecord()->publish_year ?? '-' }}</strong>
                </div>

                <div>
                    <span class="custom-biblio-label">ISBN / ISSN</span>
                    <strong class="custom-biblio-value">{{ $this->getOwnerRecord()->isbn_issn ?? '-' }}</strong>
                </div>

                <div>
                    <span class="custom-biblio-label">Klasifikasi DDC</span>
                    <strong class="custom-biblio-value">{{ $this->getOwnerRecord()->classification ?? '-' }}</strong>
                </div>

                <div>
                    <span class="custom-biblio-label">Penulis</span>
                    <strong class="custom-biblio-value">{{ $this->getOwnerRecord()->authors->pluck('name')->join(', ') ?: '-' }}</strong>
                </div>

                <div>
                    <span class="custom-biblio-label">Mata Kuliah</span>
                    <strong class="custom-biblio-value">{{ $this->getOwnerRecord()->subjects->pluck('name')->join(', ') ?: '-' }}</strong>
                </div>

                <div>
                    <span class="custom-biblio-label">Topik</span>
                    <strong class="custom-biblio-value">{{ $this->getOwnerRecord()->topics->pluck('name')->join(', ') ?: '-' }}</strong>
                </div>
            </div>
        </div>
    </div>

    {{ $this->table }}
</x-filament-panels::page>
