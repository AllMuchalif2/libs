<?php

namespace App\Filament\Resources\MstHolidays\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MstHolidayForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('holiday_date')
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('description')
                    ->required()
                    ->maxLength(255),
            ]);
    }
}
