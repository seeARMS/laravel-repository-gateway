<?php namespace src\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

abstract class AbstractBaseModel extends Model {

    public function getTableColumns() {
        $column_names = [];

        $columns = DB::connection()
            ->getDoctrineSchemaManager()
            ->listTableColumns($this->getTable());

        foreach ($columns as $col) {
            $column_names[] = $col->getName();
        }

        return $column_names;
    }


    /**
     * Retrieves the fillable attributes for the model
     *
     * Fillables are anything not in the $guarded array
     *
     * This won't return the $fillable attribute. If you want that then
     * use getFillable(). This method is more convenient. It gives you every
     * table column for the model that is not in the $guarded array.
     *
     * @return array
     */
    public function getFillables() {
        $attrs = $this->getTableColumns();

        if (empty($this->guarded)) {
            return $attrs;
        }

        foreach ($this->guarded as $attr) {
            unset($attrs[array_search($attr, $attrs)]);
        }

        return $attrs;
    }


    /**
     * Returns the class name without the namespace
     *
     * @return string
     */
    public function getShortName() {
        $class = get_class($this);

        if (false === strpos($class, '\\')) {
            return $class;
        }

        $name_parts = explode('\\', $class);

        return $name_parts[1];
    }


    public function getSafeAttributes() {
        return $this->getArrayableAttributes();
    }


    abstract function getUpdateRules();


    abstract function getRules();
}