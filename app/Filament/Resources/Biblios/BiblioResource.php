<?php

namespace App\Filament\Resources\Biblios;

use App\Filament\Resources\Biblios\Pages\CreateBiblio;
use App\Filament\Resources\Biblios\Pages\EditBiblio;
use App\Filament\Resources\Biblios\Pages\ListBiblios;
use App\Filament\Resources\Biblios\Pages\ManageBiblioItems;
use App\Filament\Resources\Biblios\Pages\PrintBarcode;
use App\Filament\Resources\Biblios\Schemas\BiblioForm;
use App\Filament\Resources\Biblios\Tables\BibliosTable;
use App\Models\Biblio;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BiblioResource extends Resource
{
    protected static ?string $model = Biblio::class;

    protected static ?string $modelLabel = 'Koleksi (Biblio)';

    protected static ?string $pluralModelLabel = 'Koleksi (Biblio)';

    protected static ?string $navigationLabel = 'Bibliografi';

    public static function getNavigationGroup(): ?string
    {
        return 'Sistem Kelola'; // Using 'Sistem Kelola' or just 'Bibliografi', user had their own structure. Let's make it null or 'Sistem'.
    }

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return BiblioForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BibliosTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBiblios::route('/'),
            'create' => CreateBiblio::route('/create'),
            'edit' => EditBiblio::route('/{record}/edit'),
            'barcode' => PrintBarcode::route('/{record}/barcode'),
            'items' => ManageBiblioItems::route('/{record}/items'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
