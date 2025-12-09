<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuhuResource\Pages;
use App\Filament\Resources\SuhuResource\RelationManagers;
use App\Models\Suhu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SuhuResource extends Resource
{
    protected static ?string $model = Suhu::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kelembapan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('suhu')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('tanggal_dan_waktu_pencatatan')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kelembapan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('suhu')
                ->label('Suhu')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_dan_waktu_pencatatan')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSuhus::route('/'),
            'create' => Pages\CreateSuhu::route('/create'),
            'edit' => Pages\EditSuhu::route('/{record}/edit'),
        ];
    }
}
