<?php
namespace App\Core\Database;

use \Exception;
use PDO;
use App\Core\Database\connection;
use App\Controllers\taskControllers;
use App\Core\App;
class queryBuilder
{
    protected $pdo;
    public function __construct(\PDO $pdo){
        $this->pdo=$pdo;
    }

    public function insert($table, $parameters)
    {
        $query = sprintf(
            "Insert into %s (%s) values (%s)",
            $table,
            implode(',', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
            );
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($parameters);
        } catch (\Exception $e) {
            //
        }
    }

    public function selectData($query, $parameters){
        try {
            $stmt=$this->pdo->prepare($query);
            if(!empty($parameters)){
                foreach ($parameters as $key => $val) {
                    if (is_int($val)) {
                        $type = PDO::PARAM_INT;
                    } else {
                        $type = PDO::PARAM_STR;
                    }
                    $stmt->bindValue(':'.$key, $val, $type);
                }
            }
            $stmt->execute();
            return $stmt->fetch();
        } catch (\Exception $e){
            //
        }
    }

    public function update($table, $parameter){
        $query=sprintf("Update %s set %s=%s",
        $table,
        implode(',', array_keys($parameter)),
        ':'.implode(',:', array_keys($parameter))
        );
        try {
            $stmt=$this->pdo->prepare($query);
            $stmt->execute($parameter);
        } catch (\Exception $e){
            //
        }
    }
}