<?php
namespace Jan\Component\Database\ORM;



use Exception;
use Jan\Component\Database\Connection\PDO\PDOConnection;
use Jan\Component\Database\Connection\PDO\Statement;
use Jan\Component\Database\Database;
use ReflectionClass;

/**
 * Class Model
 * @package Jan\Component\Database\ORM
*/
class Model implements \ArrayAccess
{

    /**
     * @var array
     */
    protected $attributes = [];


    /**
     * @var array
    */
    protected $fillable = [];


    /**
     * @var string[]
     */
    protected $guarded = ['id'];


    /**
     * @var array
     */
    protected $hidden = ['password'];


    /**
     * @param $column
     * @return bool
     */
    public function hasAttribute($column)
    {
        return isset($this->attributes[$column]);
    }


    /**
     * @param $column
     * @param $value
     */
    public function setAttribute($column, $value)
    {
        $this->attributes[$column] = $value;
    }


    /**
     * @param $column
     * @return mixed|null
     */
    public function getAttribute($column)
    {
        return $this->attributes[$column] ?? null;
    }


    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes)
    {
        foreach ($attributes as $column => $value)
        {
            $this->setAttribute($column, $value);
        }
    }


    /**
     * @return mixed|null
     */
    public function getAttributes()
    {
        return $this->attributes;
    }



    /**
     * @param $column
     * @param $value
     */
    public function __set($column, $value)
    {
        $this->setAttribute($column, $value);
    }



    /**
     * @param $column
     * @return mixed|null
     */
    public function __get($column)
    {
        return $this->getAttribute($column);
    }


    /**
     * @return Statement
     * @throws Exception
     */
    public static function findAll()
    {
        return self::query(
            sprintf('SELECT * FROM %s', self::getTable())
        );
    }



    /**
     * @param array $criteria
     */
    public static function findBy(array $criteria = [])
    {
        //
    }


    /**
     * @param array $criteria
     */
    public static function findOne(array $criteria = [])
    {
        //
    }


    /**
     * @param $id
     * @return Statement
     * @throws Exception
     */
    public static function find($id)
    {
        return self::query(
            sprintf('SELECT * FROM %s WHERE id = :id', self::getTable()),
            compact('id')
        );
    }


    /**
     * @param $condition
     * @param $value
     * @return Statement
     * @throws Exception
     */
    public static function where($condition, $value)
    {
        return self::query(
            sprintf('SELECT * FROM %s WHERE %s', self::getTable(), $condition),
            [$value]
        );
    }



    /**
     * Save data to the database
     */
    public function save()
    {
        $columnMap = $this->getColumns();
    }


    /**
     * Get columns
     */
    protected function getColumns()
    {
        return [];
    }


    /**
     * @param $sql
     * @param array $params
     * @return Statement
     * @throws Exception
     */
    protected static function query($sql, $params = [])
    {
        $connection = Database::getConnection();

        if(! $connection instanceof PDOConnection)
        {
            throw new Exception('active records use pdo connection!');
        }

        return $connection->execute($sql, $params, static::class);
    }


    /**
     * @return string
    */
    protected static function getTable()
    {
        $reflectedClass = new ReflectionClass(static::class);
        $name = mb_strtolower($reflectedClass->getShortName()).'s';
        return Database::config('prefix') . $name;
    }



    /**
     * @param mixed $offset
     * @return bool
    */
    public function offsetExists($offset)
    {
        return $this->hasAttribute($offset);
    }



    /**
     * @param mixed $offset
     * @return mixed
    */
    public function offsetGet($offset)
    {
         return $this->getAttribute($offset);
    }



    /**
     * @param mixed $offset
     * @param mixed $value
    */
    public function offsetSet($offset, $value)
    {
         $this->setAttribute($offset, $value);
    }



    /**
     * @param mixed $offset
    */
    public function offsetUnset($offset)
    {
        unset($this->attributes[$offset]);
    }
}