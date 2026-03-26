<?php

namespace App\Filament\Resources\MstGmds;

use App\Filament\Resources\MstGmds\Pages\CreateMstGmd;
use App\Filament\Resources\MstGmds\Pages\EditMstGmd;
use App\Filament\Resources\MstGmds\Pages\ListMstGmds;
use App\Filament\Resources\MstGmds\Schemas\MstGmdForm;
use App\Filament\Resources\MstGmds\Tables\MstGmdsTable;
use App\Models\MstGmd;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MstGmdResource extends Resource
{
    protected static ?string $model = MstGmd::class;

    protected static ?string $modelLabel = 'GMD';

    protected static ?string $pluralModelLabel = 'GMD';

    protected static ?string $navigationLabel = 'GMD';

    public static function getNavigationGroup(): ?string
    {
        return 'Master Data';
    }

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookmark;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return MstGmdForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MstGmdsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMstGmds::route('/'),
            'create' => CreateMstGmd::route('/create'),
            'edit' => EditMstGmd::route('/{record}/edit'),
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
