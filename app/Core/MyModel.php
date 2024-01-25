<?php

namespace App\Core;

use CodeIgniter\Model;

class MyModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function escape_data($data)
    {
        return $this->escape_str($data);
    }

    function insert_data($table_name, $data)
    {
        $this->table = $table_name;
        $this->insert($data, true);
        return $this->getInsertID();
    }

    function get_all_rows($table_name, $fields, $where = array(), $join = array(), $order_by = array(), $limit = '', $join_type = '', $like_array = array(), $group_by = '', $or_where = array(), $or_like_array = array())
    {
        $this->table = $table_name;
        $this->from($table_name, true);
        $this->select($fields);
        if (is_array($join) && count($join) > 0) {
            foreach ($join as $key => $value) {
                if (!empty($join_type) && $join_type) {
                    $this->join($key, $value, $join_type);
                } else {
                    $this->join($key, $value);
                }
            }
        }
        if (is_array($where) && count($where) > 0) {
            $this->where($where);
        }
        if (count($or_where) > 0) {
            $this->orWhere($or_where);
        }
        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $key => $value) {
                $this->orderBy($key, $value);
            }
        }
        if (is_array($like_array) && count($like_array) > 0) {
            $this->like($like_array);
        }
        //or like
        if (is_array($or_like_array) && count($or_like_array) > 0) {
            //or_like
            foreach ($or_like_array as $key => $value) {
                $like_statements[] = " " . $key . " LIKE '%" . $value . "%'";
            }
            $like_string = "(" . implode(' OR ', $like_statements) . ")";
            $this->where($like_string);
        }
        if ($group_by != '') {
            $this->groupBy($group_by);
        }

        if ($limit != '') {
            $limit = explode(',', $limit);
            $database_object = $this->findAll($limit[1], $limit[0]);
        } else {
            $database_object = $this->findAll();
        }
        /*$database_object = $this->get($table_name);
        $table_data = array();
        foreach ($database_object->result_array() as $row) {
            $table_data[] = $row;
        }*/
        return $database_object;
    }

    function update_data($table_name, $data = array(), $where = array())
    {
        $this->table = $table_name;
        foreach ($data as $key => $value) {
            $this->set($key, $value);
        }
        $this->where($where);
        $this->update();
        return true;
    }

    function get_single_row($table_name, $column, $where = array())
    {
        $this->table = $table_name;
        $this->select($column);
        $this->where($where);
        $query = $this->findAll();
        if (!empty($query)) {
            $row = $query[0];
            return $row;
        } else {
            return array();
        }
    }

    public function delete_data($table_name, $where = array())
    {
        $this->table = $table_name;
        $this->where($where);
        $this->delete();
    }

    function get_rows($table_name, $column, $where = array())
    {
        $this->table = $table_name;
        $this->select($column);
        $this->where($where);
        $query = $this->get($table_name);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_single_column($table_name, $column, $where = array())
    {
        $this->table = $table_name;
        $this->select($column);
        $this->where($where);
        $query = $this->get($table_name);
        if ($query->num_rows() > 0) {
            return $query->row()->$column;
        } else {
            return '';
        }
    }
    function get_all_rows_by_query($query)
    {
        $database_object = $this->query($query);
        $table_data = array();
        foreach ($database_object->getResult() as $row) {
            $table_data[] = $row;
        }
        return $table_data;
    }

    function get_single_by_query($query)
    {
        $database_object = $this->query($query);
        $table_data = array();
        return $database_object->row();
    }

    function get_rows_orderby($table_name, $column, $where = array(), $order_field, $order_by)
    {
        $this->select($column);
        $this->where($where);
        $this->order_by($order_field, $order_by);
        $query = $this->get($table_name);
        return $query->result_array();
    }

    function get_rows_joins($table_name, $fields, $where = array(), $join = array(), $order_by = array(), $limit = '', $join_type = '', $like_array = array(), $group_by = '', $or_where = array(), $or_like_array = array())
    {
        $this->select($fields);
        if (is_array($join) && count($join) > 0) {
            foreach ($join as $key => $value) {
                if (!empty($join_type) && $join_type) {
                    $this->join($key, $value, $join_type);
                } else {
                    $this->join($key, $value);
                }
            }
        }
        if (is_array($where) && count($where) > 0) {
            $this->where($where);
        }
        if (count($or_where) > 0) {
            $this->orWhere($or_where);
        }


        if (is_array($like_array) && count($like_array) > 0) {
            $this->like($like_array);
        }
        //or like
        if (is_array($or_like_array) && count($or_like_array) > 0) {
            //or_like
            foreach ($or_like_array as $key => $value) {
                $like_statements[] = " " . $key . " LIKE '%" . $value . "%'";
            }
            $like_string = "(" . implode(' OR ', $like_statements) . ")";
            $this->where($like_string);
        }
        if ($group_by != '') {
            $this->group_by($group_by);
        }
        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $key => $value) {
                $this->order_by($key, $value);
            }
        }

        if ($limit != '') {
            $limit = explode(',', $limit);
            $this->limit($limit[0], $limit[1]);
        }
        $database_object = $this->get($table_name);
        $table_data = array();
        return $database_object->result_array();
    }
}