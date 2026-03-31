<?php

namespace App\Filament\Resources\Biblios\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BiblioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('Judul Koleksi')
                    ->columnSpanFull(),
                Select::make('publisher_id')
                    ->relationship('publisher', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->label('Penerbit'),
                Select::make('gmd_id')
                    ->relationship('gmd', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->label('GMD'),
                Select::make('authors')
                    ->relationship('authors', 'name')
                    ->multiple()
                    ->searchable()
                    ->preload()
                    ->label('Penulis'),
                Select::make('subjects')
                    ->relationship('subjects', 'name')
                    ->multiple()
                    ->searchable()
                    ->preload()
                    ->label('Mata Kuliah'),
                Select::make('topics')
                    ->relationship('topics', 'name')
                    ->multiple()
                    ->searchable()
                    ->preload()
                    ->label('Topik'),
                TextInput::make('isbn_issn')
                    ->maxLength(50)
                    ->label('ISBN / ISSN'),
                TextInput::make('publish_year')
                    ->required()
                    ->maxLength(10)
                    ->numeric()
                    ->label('Tahun Terbit'),
                TextInput::make('classification')
                    ->required()
                    ->maxLength(10)
                    ->label('Klasifikasi DDC'),
                FileUpload::make('cover_image')
                    ->image()
                    ->disk('public_uploads')
                    ->directory('covers')
                    ->visibility('public')
                    ->maxSize(2048)
                    ->label('Gambar Sampul')
                    ->columnSpanFull(),
            ]);
    }
}
