<?php

use Illuminate\Support\Collection;

if (! \function_exists('collect')) {
    /**
     * Create a collection from the given value.
     */
    function collect(array $value = []): Collection
    {
        return new Collection($value);
    }
}
