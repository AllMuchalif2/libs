<?php

namespace App\Filament\Resources\MstHolidays;

use App\Filament\Resources\MstHolidays\Pages\CreateMstHoliday;
use App\Filament\Resources\MstHolidays\Pages\EditMstHoliday;
use App\Filament\Resources\MstHolidays\Pages\ListMstHolidays;
use App\Filament\Resources\MstHolidays\Schemas\MstHolidayForm;
use App\Filament\Resources\MstHolidays\Tables\MstHolidaysTable;
use App\Models\MstHoliday;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MstHolidayResource extends Resource
{
    protected static ?string $model = MstHoliday::class;

    protected static ?string $modelLabel = 'Hari Libur';

    protected static ?string $pluralModelLabel = 'Hari Libur';

    protected static ?string $navigationLabel = 'Hari Libur';

    public static function getNavigationGroup(): ?string
    {
        return 'Data Master';
    }

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDateRange;

    protected static ?string $recordTitleAttribute = 'description';

    public static function form(Schema $schema): Schema
    {
        return MstHolidayForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MstHolidaysTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMstHolidays::route('/'),
            'create' => CreateMstHoliday::route('/create'),
            'edit' => EditMstHoliday::route('/{record}/edit'),
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
