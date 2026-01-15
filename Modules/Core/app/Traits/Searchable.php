<?php

namespace Modules\Core\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    /**
     * Search scope
     */
    public function scopeSearch(Builder $query, string $searchTerm): Builder
    {
        if (empty($searchTerm)) {
            return $query;
        }

        $columns = $this->getSearchableColumns();

        return $query->where(function ($q) use ($searchTerm, $columns) {
            foreach ($columns as $column) {
                if (str_contains($column, '.')) {
                    // Handle relation searches
                    [$relation, $field] = explode('.', $column);
                    $q->orWhereHas($relation, function ($query) use ($field, $searchTerm) {
                        $query->where($field, 'LIKE', "%{$searchTerm}%");
                    });
                } elseif (str_contains($column, '->')) {
                    // Handle JSON columns
                    $q->orWhereRaw("LOWER({$column}) LIKE ?", ["%" . strtolower($searchTerm) . "%"]);
                } else {
                    // Regular columns
                    $q->orWhere($column, 'LIKE', "%{$searchTerm}%");
                }
            }
        });
    }

    /**
     * Get searchable columns
     */
    public function getSearchableColumns(): array
    {
        return property_exists($this, 'searchable')
            ? $this->searchable
            : ['title', 'name', 'description'];
    }

    /**
     * Apply search filters
     */
    public function scopeApplyFilters(Builder $query, array $filters): Builder
    {
        foreach ($filters as $field => $value) {
            if (empty($value)) {
                continue;
            }

            if (method_exists($this, 'filter' . ucfirst($field))) {
                $this->{'filter' . ucfirst($field)}($query, $value);
            } else {
                $query->where($field, $value);
            }
        }

        return $query;
    }
}
