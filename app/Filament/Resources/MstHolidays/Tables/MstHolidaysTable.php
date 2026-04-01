<?php

namespace App\Filament\Resources\MstHolidays\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
// use Filament\Actions\ForceDeleteBulkAction;
// use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
// use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MstHolidaysTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')
                    ->label('#')
                    ->rowIndex(),
                TextColumn::make('holiday_date')
                    ->label('Tanggal Libur')
                    ->date('d F Y')
                    ->sortable()
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        $months = [
                            'januari' => '01', 'februari' => '02', 'maret' => '03', 'april' => '04',
                            'mei' => '05', 'juni' => '06', 'juli' => '07', 'agustus' => '08',
                            'september' => '09', 'oktober' => '10', 'november' => '11', 'desember' => '12',
                            'january' => '01', 'february' => '02', 'march' => '03', 'may' => '05', 
                            'june' => '06', 'july' => '07', 'august' => '08', 'october' => '10', 'december' => '12'
                        ];

                        $searchLower = strtolower($search);
                        
                        foreach ($months as $name => $number) {
                            if (strpos($name, $searchLower) !== false) {
                                return $query->orWhereMonth('holiday_date', $number);
                            }
                        }

                        return $query->orWhere('holiday_date', 'like', "%{$search}%");
                    }),
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->searchable(),
            ])
            ->filters([
                // TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make()->visible(fn () => auth()->user()->role === 'admin'),
                DeleteAction::make()->visible(fn () => auth()->user()->role === 'admin'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ])->visible(fn () => auth()->user()->role === 'admin'),
            ])
            ->defaultSort('holiday_date', 'asc');
    }
}
