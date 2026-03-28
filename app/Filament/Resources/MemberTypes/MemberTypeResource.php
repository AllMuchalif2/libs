<?php

namespace App\Filament\Resources\MemberTypes;

use App\Filament\Resources\MemberTypes\Pages\CreateMemberType;
use App\Filament\Resources\MemberTypes\Pages\EditMemberType;
use App\Filament\Resources\MemberTypes\Pages\ListMemberTypes;
use App\Filament\Resources\MemberTypes\Schemas\MemberTypeForm;
use App\Filament\Resources\MemberTypes\Tables\MemberTypesTable;
use App\Models\MemberType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MemberTypeResource extends Resource
{
    protected static ?string $model = MemberType::class;

    protected static ?string $modelLabel = 'Tipe Anggota';

    protected static ?string $pluralModelLabel = 'Tipe Anggota';

    protected static ?string $navigationLabel = 'Tipe Anggota';

    public static function getNavigationGroup(): ?string
    {
        return 'Keanggotaan';
    }

    protected static ?int $navigationSort = 2;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedIdentification;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return MemberTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MemberTypesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMemberTypes::route('/'),
            'create' => CreateMemberType::route('/create'),
            'edit' => EditMemberType::route('/{record}/edit'),
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
