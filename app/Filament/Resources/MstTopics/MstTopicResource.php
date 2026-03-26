<?php

namespace App\Filament\Resources\MstTopics;

use App\Filament\Resources\MstTopics\Pages\CreateMstTopic;
use App\Filament\Resources\MstTopics\Pages\EditMstTopic;
use App\Filament\Resources\MstTopics\Pages\ListMstTopics;
use App\Filament\Resources\MstTopics\Schemas\MstTopicForm;
use App\Filament\Resources\MstTopics\Tables\MstTopicsTable;
use App\Models\MstTopic;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MstTopicResource extends Resource
{
    protected static ?string $model = MstTopic::class;

    protected static ?string $modelLabel = 'Topik';

    protected static ?string $pluralModelLabel = 'Topik';

    protected static ?string $navigationLabel = 'Topik';

    public static function getNavigationGroup(): ?string
    {
        return 'Master Data';
    }

    protected static ?int $navigationSort = 6;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return MstTopicForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MstTopicsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMstTopics::route('/'),
            'create' => CreateMstTopic::route('/create'),
            'edit' => EditMstTopic::route('/{record}/edit'),
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
