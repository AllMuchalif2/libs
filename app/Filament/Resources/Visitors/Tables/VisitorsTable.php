<?php

namespace App\Filament\Resources\Visitors\Tables;

use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Filament\Support\Icons\Heroicon;

class VisitorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')
                    ->label('No')
                    ->rowIndex(),
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('member.member_code')
                    ->label('Kode Anggota')
                    ->searchable()
                    ->placeholder('-'),
                TextColumn::make('visit_date')
                    ->label('Waktu Kunjungan')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('visit_date', 'desc')
            ->filters([
                Filter::make('visit_date')
                    ->label('Hari Ini')
                    ->query(fn (Builder $query): Builder => $query->whereDate('visit_date', Carbon::today()))
                    ->default(),
                SelectFilter::make('month')
                    ->label('Bulan')
                    ->options([
                        '1' => 'Januari',
                        '2' => 'Februari',
                        '3' => 'Maret',
                        '4' => 'April',
                        '5' => 'Mei',
                        '6' => 'Juni',
                        '7' => 'Juli',
                        '8' => 'Agustus',
                        '9' => 'September',
                        '10' => 'Oktober',
                        '11' => 'November',
                        '12' => 'Desember',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['value'],
                            fn (Builder $query, $value): Builder => $query->whereMonth('visit_date', $value)
                                ->whereYear('visit_date', Carbon::now()->year)
                        );
                    }),
            ])
            ->headerActions([
                
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([]);
    }
}
