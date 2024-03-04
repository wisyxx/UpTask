<?php
namespace Model;
class ActiveRecord {

    // DB
    protected static $db;
    protected static $table = '';
    protected static $DBColumns = [];

    // Alerts & messages
    protected static $alerts = [];
    
    // DB conection
    public static function setDB($database) {
        self::$db = $database;
    }

    public static function setAlerts($type, $message) {
        static::$alerts[$type][] = $message;
    }
    // Validación
    public static function getAlerts() {
        return static::$alerts;
    }

    public function validate() {
        static::$alerts = [];
        return static::$alerts;
    }

    // CRUD
    public function save() {
        $result = '';
        if(!is_null($this->id)) {
            $result = $this->update();
        } else {
            $result = $this->create();
        }
        return $result;
    }

    public static function all() {
        $query = "SELECT * FROM " . static::$table;
        $result = self::queryDB($query);
        return $result;
    }

    // Search record by id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$table  ." WHERE id = $id";
        $result = self::queryDB($query);
        return array_shift( $result ) ;
    }

    // Get record
    public static function get($limit) {
        $query = "SELECT * FROM " . static::$table . " LIMIT $limit";
        $result = self::queryDB($query);
        return array_shift( $result ) ;
    }

    public static function where($column, $value) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE $column = '$value'";
        $result = self::queryDB($query);
        return array_shift( $result ) ;
    }

    // SQL for advanced queries
    public static function SQL($DBquery) {
        $query = $DBquery;
        $result = self::queryDB($query);
        return $result;
    }

    // crea un nuevo registro
    public function create() {
        // Sanitizar los datos
        $atributes = $this->sanitizeAtributes();
        
        // Insert in db
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributes));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributes));
        $query .= " ') ";

        $result = self::$db->query($query);

        return [
           'result' =>  $result,
           'id' => self::$db->insert_id
        ];
    }

    public function update() {
        $atributes = $this->sanitizeAtributes();

        $values = [];
        foreach($atributes as $key => $value) {
            $values[] = "$key='$value'";
        }

        $query = "UPDATE " . static::$table ." SET ";
        $query .=  join(', ', $values );
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 "; 

        $result = self::$db->query($query);
        return $result;
    }

    // Eliminar un delete record
    public function eliminar() {
        $query = "DELETE FROM "  . static::$table . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $result = self::$db->query($query);
        return $result;
    }

    public static function queryDB($query) {
        $resultado = self::$db->query($query);

        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::createObject($registro);
        }

        // free the memory
        $resultado->free();

        return $array;
    }

    protected static function createObject($registro) {
        $obj = new static;

        foreach($registro as $key => $value ) {
            if(property_exists($obj, $key  )) {
                $obj->$key = $value;
            }
        }

        return $obj;
    }

    public function atributes() {
        $atributes = [];
        foreach(static::$DBColumns as $column) {
            if($column === 'id') continue;
            $atributes[$column] = $this->$column;
        }
        return $atributes;
    }

    public function sanitizeAtributes() {
        $atributes = $this->atributes();
        $sanitized = [];
        foreach($atributes as $key => $value ) {
            $sanitized[$key] = self::$db->escape_string($value);
        }
        return $sanitized;
    }

    public function sync($args=[]) { 
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }
    }
}