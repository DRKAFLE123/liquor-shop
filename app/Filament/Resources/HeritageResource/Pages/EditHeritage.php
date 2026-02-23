<?php

namespace App\Filament\Resources\HeritageResource\Pages;

use App\Filament\Resources\HeritageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHeritage extends EditRecord
{
    protected static string $resource = HeritageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
