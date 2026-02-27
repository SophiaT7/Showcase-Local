<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

use App\Filament\Admin\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions;


class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
