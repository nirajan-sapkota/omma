<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use UnitEnum;

class Test extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'hari om';

    protected static ?string $title = 'Page';

    protected static string|UnitEnum|null $navigationGroup = 'Testing';

    protected string $view = 'filament.pages.test';
}