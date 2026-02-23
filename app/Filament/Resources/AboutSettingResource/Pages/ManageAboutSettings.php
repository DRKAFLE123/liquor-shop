<?php

namespace App\Filament\Resources\AboutSettingResource\Pages;

use App\Filament\Resources\AboutSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAboutSettings extends ManageRecords
{
    protected static string $resource = AboutSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
