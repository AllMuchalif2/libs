<?php

namespace App\Filament\Resources\MstCollTypes;

use App\Filament\Resources\MstCollTypes\Pages\CreateMstCollType;
use App\Filament\Resources\MstCollTypes\Pages\EditMstCollType;
use App\Filament\Resources\MstCollTypes\Pages\ListMstCollTypes;
use App\Filament\Resources\MstCollTypes\Schemas\MstCollTypeForm;
use App\Filament\Resources\MstCollTypes\Tables\MstCollTypesTable;
use App\Models\MstCollType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MstCollTypeResource extends Resource
{
    protected static ?string $model = MstCollType::class;

    protected static ?string $modelLabel = 'Tipe Koleksi';

    protected static ?string $pluralModelLabel = 'Tipe Koleksi';

    protected static ?string $navigationLabel = 'Tipe Koleksi';

    public static function getNavigationGroup(): ?string
    {
        return 'Master Data';
    }

    protected static ?int $navigationSort = 2;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCircleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return MstCollTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MstCollTypesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMstCollTypes::route('/'),
            'create' => CreateMstCollType::route('/create'),
            'edit' => EditMstCollType::route('/{record}/edit'),
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
