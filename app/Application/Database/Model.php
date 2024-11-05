<?php

namespace App\Application\Database;

use App\Application\Router\Redirect;
use PDO;

class Model extends Connection implements ModelInterface
{

    protected int $id;
    protected ?string $created_at;
    protected ?string $updated_at;
    protected array $fields = [];
    protected string $password;
    protected string $table;
    //создали массив пустой, в который будем складывать $many при успешном поиске пользователя
    protected array $collection = [];

    public function id(): int
    {
        return $this->id;
    }

    public function createdAt(): string
    {
        return $this->created_at;

    }

// метод который будет искать потльзователя
    public function find(string $column, mixed $value, bool $many = false): array|bool|Model
    {
        $query = "SELECT * FROM" . " " . $this->table . " WHERE " . $column . "= :" . $column;
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$column => $value]);
        if ($many) {
            $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($items as $item) {
                foreach ($item as $key => $value) {
                    $this->$key = $value;
                }
                $this->collection[] = clone $this;
            }
            return $this->collection;
        } else {
            // перебирпаем массив пользователя, что бы получить ключ - значение
            $entity = $stmt->fetch(PDO::FETCH_ASSOC);
            // что бы при несуществующем пользователе он не выдовал ошибку по массиву
            if (!$entity) {
                return false;
            }
            foreach ($entity as $key => $value) {

                $this->$key = $value;
            }
            return $this;
        }
        return $many ? $stmt->fetchAll(PDO::FETCH_ASSOC) : $stmt->fetch(PDO::FETCH_ASSOC);
    }

//метод который будет записывать данные в массив
    public function store(): void
    { //заносим  универсальные в переменные
        $columns = implode(', ', array_map(function ($fields) {
            return "$fields";
        }, $this->fields));
        $binds = implode(', ', array_map(function ($fields) {
            return ":$fields";
        }, $this->fields));

//запрос на добавления данных
        $query = "INSERT INTO $this->table ($columns)
VALUES ($binds)";
        $stmt = $this->connect()->prepare($query);
//создаем пустой массив и перебираем его что бы ключ и данные соответствовали
        $params = [];
        foreach ($this->fields as $field) {
            $params[$field] = $this->$field ?? null;
        }
        $stmt->execute($params);
        Redirect::to('login');
    }

//создаем метод для обновления полей в частности поля токен
    public function update(array $data): void
    {
        $keys = array_keys($data);
        $fields = array_map(function ($item) {
            return "$item= :$item";
        }, $keys);
        $updatedFields = implode(', ', $fields);
        $query = "UPDATE  $this->table SET $updatedFields WHERE users.id = :id";
        $stmt = $this->connect()->prepare($query);
        $data['id'] = $this->id;
        $stmt->execute($data);
    }

    public function all(): array
    {
        $items = $this->connect()->query("SELECT * FROM $this->table ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($items as $item) {
            foreach ($item as $key => $value) {
                $this->$key = $value;
            }
            $this->collection[] = clone $this;
        }
        return $this->collection;
    }
}