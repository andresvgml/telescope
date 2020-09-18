<?php

namespace Laravel\Telescope\Storage;

use Illuminate\Database\Eloquent\Model;

class EntryTagModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'telescope_entries_tags';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = null;

    /**
     * Scope the query for the given type.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $type
     * @return $this
     */
    public static function getTags()
    {
        $name = "application:";
        return self::selectRaw("DISTINCT(
                CONCAT(UCASE(LEFT(
                    REPLACE(tag, '$name', '')
                , 1)), 
                SUBSTRING(
                    REPLACE(tag, '$name', '')
                , 2))
            ) AS label, tag AS value")
            ->where("tag", "LIKE", "$name%")
            ->get()
            ->toArray();
    }

    /**
     * Get the current connection name for the model.
     *
     * @return string
     */
    public function getConnectionName()
    {
        return config('telescope.storage.database.connection');
    }
}
