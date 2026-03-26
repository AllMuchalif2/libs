<?php

namespace App\Filament\Resources\MstLocations;

use App\Filament\Resources\MstLocations\Pages\CreateMstLocation;
use App\Filament\Resources\MstLocations\Pages\EditMstLocation;
use App\Filament\Resources\MstLocations\Pages\ListMstLocations;
use App\Filament\Resources\MstLocations\Schemas\MstLocationForm;
use App\Filament\Resources\MstLocations\Tables\MstLocationsTable;
use App\Models\MstLocation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MstLocationResource extends Resource
{
    protected static ?string $model = MstLocation::class;

    protected static ?string $modelLabel = 'Lokasi';

    protected static ?string $pluralModelLabel = 'Lokasi';

    protected static ?string $navigationLabel = 'Lokasi';

    public static function getNavigationGroup(): ?string
    {
        return 'Master Data';
    }

    protected static ?int $navigationSort = 7;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMapPin;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return MstLocationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MstLocationsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMstLocations::route('/'),
            'create' => CreateMstLocation::route('/create'),
            'edit' => EditMstLocation::route('/{record}/edit'),
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
