<?php

require_once(dirname(__FILE__) . '/JsonFileIO.php');

abstract class BaseModel
{
    protected $records = array();
    protected $json_instance;

    public function __construct($model_name)
    {
        $this->json_instance = new JsonFileIO($model_name);
        $this->all();
    }

    public function get_records()
    {
        return $this->records;
    }

    // 条件式のrecordを取り出すメソッド .select('id < 5');
    public function select($condition)
    {
        $select_records = array();

        list($key, $operator, $value) = explode(' ', $condition);

        foreach ($this->records as $record) {
            switch ($operator) {
                case '==':
                    if ($record[$key] ==  $value) {
                        array_push($select_records, $record);
                    }
                    break;
                case '===':
                    if ($record[$key] === $value) {
                        array_push($select_records, $record);
                    }
                    break;
                case '!=':
                    if ($record[$key] !=  $value) {
                        array_push($select_records, $record);
                        break;
                    }
                    break;
                case '!==':
                    if ($record[$key] !== $value) {
                        array_push($select_records, $record);
                    }
                    break;
                case '<':
                    if ($record[$key] <   $value) {
                        array_push($select_records, $record);
                    }
                    break;
                case '>':
                    if ($record[$key] >   $value) {
                        array_push($select_records, $record);
                    }
                    break;
                case '<=':
                    if ($record[$key] <=  $value) {
                        array_push($select_records, $record);
                        break;
                    }
                    break;
                case '>=':
                    if ($record[$key] >=  $value) {
                        array_push($select_records, $record);
                    }
                    break;
                default:
                    return false;
            }
        }
        $this->records = $select_records;
        return $select_records;
    }

    public function all()
    {
        $this->records = $this->json_instance->get_db_array();
        $this->records = $this->records['records'];
        return $this->records;
    }

    public function order_asc($order_key)
    {
        foreach ((array) $this->records as $key => $value) {
            $sort[$key] = $value[$order_key];
        }

        array_multisort($sort, SORT_ASC, $this->records);
        return $this->records;
    }

    public function order_desc($order_key)
    {
        foreach ((array) $this->records as $key => $value) {
            $sort[$key] = $value[$order_key];
        }

        array_multisort($sort, SORT_DESC, $this->records);
        return $this->records;
    }

    public function limit($limit_n)
    {
        if (count($this->records) > $limit_n) {
            return array_splice($this->records, 0, $limit_n-1);
        } else {
            return $this->records;
        }
    }

    public function new_record()
    {
        return $this->json_instance->new_record_array();
    }

    public function save($record)
    {
        $this->json_instance->save_record($record);
    }

    public function find_by($key, $value)
    {
        $arr = $this->select($key . ' == ' . $value);
        return $arr[0];
    }

    public function delete($record)
    {
        $this->json_instance->delte_record($record);
    }

    public function remove_duplicated_value()
    {
        $ids = array();
        foreach ($this->records as $record) {
            if (in_array($record['id'], $ids)) {
                continue;
            }
            array_push($ids, $record['id']);
        }
    }
}
