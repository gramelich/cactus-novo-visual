<?php

namespace App\Filament\Admin\Resources\RoundsFreeConfigResource\Pages;

use App\Filament\Admin\Resources\RoundsFreeConfigResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRoundsFreeConfig extends EditRecord
{
    protected static string $resource = RoundsFreeConfigResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
