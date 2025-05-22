<?php

namespace Panlatent\Filament\ActionConfirmation\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Panlatent\Filament\ActionConfirmation\FilamentActionConfirmation
 */
class FilamentActionConfirmation extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Panlatent\Filament\ActionConfirmation\FilamentActionConfirmation::class;
    }
}
