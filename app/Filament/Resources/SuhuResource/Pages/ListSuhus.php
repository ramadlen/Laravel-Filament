<?php

namespace App\Filament\Resources\SuhuResource\Pages;

use App\Filament\Resources\SuhuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSuhus extends ListRecords
{
    protected static string $resource = SuhuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
