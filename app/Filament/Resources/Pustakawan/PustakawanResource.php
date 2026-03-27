<?php

namespace App\Filament\Resources\Pustakawan;

use App\Filament\Resources\Pustakawan\Pages\CreatePustakawan;
use App\Filament\Resources\Pustakawan\Pages\EditPustakawan;
use App\Filament\Resources\Pustakawan\Pages\ListPustakawans;
use App\Filament\Resources\Pustakawan\Schemas\PustakawanForm;
use App\Filament\Resources\Pustakawan\Tables\PustakawanTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PustakawanResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $slug = 'pustakawans';

    protected static ?string $modelLabel = 'Pustakawan';

    protected static ?string $pluralModelLabel = 'Pustakawan';

    protected static ?string $navigationLabel = 'Pustakawan';

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return PustakawanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PustakawanTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPustakawans::route('/'),
            'create' => CreatePustakawan::route('/create'),
            'edit' => EditPustakawan::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('role', 'pustakawan');
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
