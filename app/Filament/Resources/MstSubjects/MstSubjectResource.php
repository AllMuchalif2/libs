<?php

namespace App\Filament\Resources\MstSubjects;

use App\Filament\Resources\MstSubjects\Pages\CreateMstSubject;
use App\Filament\Resources\MstSubjects\Pages\EditMstSubject;
use App\Filament\Resources\MstSubjects\Pages\ListMstSubjects;
use App\Filament\Resources\MstSubjects\Schemas\MstSubjectForm;
use App\Filament\Resources\MstSubjects\Tables\MstSubjectsTable;
use App\Models\MstSubject;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MstSubjectResource extends Resource
{
    protected static ?string $model = MstSubject::class;

    protected static ?string $modelLabel = 'Mata Kuliah';

    protected static ?string $pluralModelLabel = 'Mata Kuliah';

    protected static ?string $navigationLabel = 'Mata Kuliah';

    public static function getNavigationGroup(): ?string
    {
        return 'Master Data';
    }

    protected static ?int $navigationSort = 5;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return MstSubjectForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MstSubjectsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMstSubjects::route('/'),
            'create' => CreateMstSubject::route('/create'),
            'edit' => EditMstSubject::route('/{record}/edit'),
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
