<?php

namespace App\Filament\Resources\InstructorResource\Pages;

use App\Filament\Resources\InstructorResource;
use Filament\Resources\Pages\Page;

class InstructorDetails extends Page
{
    protected static string $resource = InstructorResource::class;

    protected static string $view = 'filament.resources.instructor-resource.pages.instructor-details';
}
