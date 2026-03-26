<?php

namespace App\Filament\Resources\MstAuthors;

use App\Filament\Resources\MstAuthors\Pages\CreateMstAuthor;
use App\Filament\Resources\MstAuthors\Pages\EditMstAuthor;
use App\Filament\Resources\MstAuthors\Pages\ListMstAuthors;
use App\Filament\Resources\MstAuthors\Schemas\MstAuthorForm;
use App\Filament\Resources\MstAuthors\Tables\MstAuthorsTable;
use App\Models\MstAuthor;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MstAuthorResource extends Resource
{
    protected static ?string $model = MstAuthor::class;

    protected static ?string $modelLabel = 'Penulis';

    protected static ?string $pluralModelLabel = 'Penulis';

    protected static ?string $navigationLabel = 'Penulis';

    public static function getNavigationGroup(): ?string
    {
        return 'Master Data';
    }

    protected static ?int $navigationSort = 4;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUser;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return MstAuthorForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MstAuthorsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMstAuthors::route('/'),
            'create' => CreateMstAuthor::route('/create'),
            'edit' => EditMstAuthor::route('/{record}/edit'),
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
