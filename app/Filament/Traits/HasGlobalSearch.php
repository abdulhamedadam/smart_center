<?php

namespace App\Filament\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Filament\Resources\Resource;

trait HasGlobalSearch
{
    public static function getGlobalSearchResultTitle(Model $record): string
    {
        return $record->name ?? $record->title ?? $record->id;
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];
        
        // Add name/title if exists
        if (isset($record->name)) {
            $details['Name'] = $record->name;
        } elseif (isset($record->title)) {
            $details['Title'] = $record->title;
        }

        // Add description if exists
        if (isset($record->description)) {
            $details['Description'] = Str::limit(strip_tags($record->description), 100);
        }

        // Add slug if exists
        if (isset($record->slug)) {
            $details['Slug'] = $record->slug;
        }

        return $details;
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        $query = parent::getGlobalSearchEloquentQuery();
        $searchableColumns = ['name', 'title', 'description', 'slug'];
        $modelClass = static::getModel();
        
        foreach ($searchableColumns as $column) {
            if (in_array($column, (new $modelClass)->getFillable())) {
                $query->orWhere($column, 'like', '%{search}%');
            }
        }
        
        return $query;
    }

    public static function getGlobalSearchResultUrl(Model $record): string
    {
        return static::getUrl('edit', ['record' => $record]);
    }
} 