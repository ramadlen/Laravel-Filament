<?php

namespace App\Filament\Resources\SuhuResource\Pages;

use App\Filament\Resources\SuhuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSuhu extends EditRecord
{
    protected static string $resource = SuhuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
