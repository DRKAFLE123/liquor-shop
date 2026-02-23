<?php

namespace App\Filament\Resources\HeritageResource\Pages;

use App\Filament\Resources\HeritageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHeritages extends ListRecords
{
    protected static string $resource = HeritageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
