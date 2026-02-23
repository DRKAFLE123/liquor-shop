<?php

namespace App\Filament\Resources\HeritageResource\Pages;

use App\Filament\Resources\HeritageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHeritage extends CreateRecord
{
    protected static string $resource = HeritageResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
