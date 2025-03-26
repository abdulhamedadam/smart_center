<?php

namespace App\Filament\Resources\StudentsResource\Pages;

use App\Filament\Resources\StudentsResource;
use Filament\Resources\Pages\Page;

class StudentDetails extends Page
{
    protected static string $resource = StudentsResource::class;

    protected static string $view = 'filament.resources.students-resource.pages.student-details';
}
