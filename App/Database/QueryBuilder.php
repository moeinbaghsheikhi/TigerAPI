<?php

namespace App\Database;

class QueryBuilder {
    protected $table;
    protected $select = '*';
    protected $joins = [];
    protected $where = [];
    protected $orderBy;
    protected $limit;

    public function table($table) {
        $this->table = $table;
        return $this;
    }

    public function select($columns) {
        $this->select = is_array($columns) ? implode(', ', $columns) : $columns;
        return $this;
    }

    public function join($table, $first, $operator, $second, $type = 'INNER') {
        $this->joins[] = "$type JOIN $table ON $first $operator $second";
        return $this;
    }

    public function where($column, $operator, $value) {
        $this->where[] = "$column $operator '$value'";
        return $this;
    }

    public function orderBy($column, $direction = 'ASC') {
        $this->orderBy = "$column $direction";
        return $this;
    }

    public function limit($limit) {
        $this->limit = $limit;
        return $this;
    }

    public function get() {
        $sql = "SELECT $this->select FROM $this->table";

        foreach ($this->joins as $join) {
            $sql .= " $join";
        }

        if (!empty($this->where)) {
            $sql .= ' WHERE ' . implode(' AND ', $this->where);
        }

        if ($this->orderBy) {
            $sql .= " ORDER BY $this->orderBy";
        }

        if ($this->limit) {
            $sql .= " LIMIT $this->limit";
        }

        return $sql;
    }
}