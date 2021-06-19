<?php 

namespace Laragrad\Support;

use Illuminate\Database\Schema\Blueprint;

class Userstamps
{

    /**
     * Return list of default userstamp column names
     * 
     * @param bool $softDeleting
     * @return string[]
     */
    protected static function defaultColumns(bool $softDeleting = false) {
        
        $columns = [
            'created_by',
            'updated_by',
        ];
        
        if ($softDeleting) {
            $columns[] = 'deleted_by';
        }
        
        return $columns;
    }
    
    /**
     * Adding userstamp columns
     * 
     * @param Blueprint $table
     * @param string $columnMethod
     * @param bool $softDeletes
     * @param array $columns
     * @throws \Exception
     */
    public static function addUserstampsColumns(Blueprint $table, bool $softDeletes = false, string $columnMethod = 'bigInteger', array $columns = [])
    {
        // Check column method
        if (! in_array($columnMethod, ['bigInteger','integer','uuid'])) {
            throw new \Exception("Error. Column method {$columnMethod} is incorrect!");
        }

        // Preparing column list
        if (empty($columns)) {
            $columns = self::defaultColumns($softDeletes);
        }
        
        // Creating columns
        foreach ($columns as $column) {
            $table->$columnMethod($column)->nullable();
        }
    }

    /**
     * Dropping userstamp columns
     * 
     * @param Blueprint $table
     * @param bool $softDeletes
     * @param array $columns
     */
    public static function dropUserstampsColumns(Blueprint $table, bool $softDeletes = false, array $columns = [])
    {
        // Preparing column list
        if (empty($columns)) {
            $columns = self::defaultColumns($softDeletes);
        }
        
        // Dropping columns
        foreach ($columns as $column) {
            $table->dropColumn($column)->nullable();
        }
    }
}