<?php

namespace App\Filament\Resources\MstPublishers;

use App\Filament\Resources\MstPublishers\Pages\CreateMstPublisher;
use App\Filament\Resources\MstPublishers\Pages\EditMstPublisher;
use App\Filament\Resources\MstPublishers\Pages\ListMstPublishers;
use App\Filament\Resources\MstPublishers\Schemas\MstPublisherForm;
use App\Filament\Resources\MstPublishers\Tables\MstPublishersTable;
use App\Models\MstPublisher;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MstPublisherResource extends Resource
{
    protected static ?string $model = MstPublisher::class;

    protected static ?string $modelLabel = 'Penerbit';

    protected static ?string $pluralModelLabel = 'Penerbit';

    protected static ?string $navigationLabel = 'Penerbit';

    public static function getNavigationGroup(): ?string
    {
        return 'Master Data';
    }

    protected static ?int $navigationSort = 3;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return MstPublisherForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MstPublishersTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMstPublishers::route('/'),
            'create' => CreateMstPublisher::route('/create'),
            'edit' => EditMstPublisher::route('/{record}/edit'),
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
