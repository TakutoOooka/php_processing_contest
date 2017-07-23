<?php

require_once(dirname(__FILE__) . '/../helpers/JsonFormatter.php');

class JsonFileIO
{
    private $json_url;
    private $db_array;
    private $json_name;

    function __construct($json_name)
    {
        $this->json_name = $json_name;
        $this->json_url = dirname(__FILE__) . '/../db/' . $this->json_name . '.json';
        $this->read_json_file();
    }

    public function read_json_file()
    {
        $this->check_file();
        $json = file_get_contents($this->json_url);
        $json = mb_convert_encoding($json,
            'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        $this->db_array = json_decode($json, true);
    }

    public function write_json_file()
    {
        $this->check_file();
        // ファイル入出力操作
        $fp = fopen($this->json_url, 'w');
        if (flock($fp, LOCK_EX)) {
            $this->json = JsonFormatter::format( json_encode($this->db_array) );
            // ftruncate($fp, 0);
            fwrite($fp, $this->json );
            fflush($fp);
            flock($fp, LOCK_UN);
            fclose($fp);
        } else {
            fclose($fp);
            throw new \RuntimeException("writing file error!!");
        }
    }

    private function check_file()
    {
        // jsonファイルが存在しない場合の対処
        if (!file_exists($this->json_url)) {
            if (!copy('', $this->json_url)) {
                echo "failed to copy $this->json_url ...\n";
            }
        }
    }

    public function get_db_array()
    {
        return $this->db_array;
    }

    public function new_record_array()
    {
        $new_arr = $this->db_array['schema'];
        // auto_incrementの一括処理
        foreach ($this->db_array['auto_increment'] as $key => $val) {
            $new_arr[$key] = $val;
        }
        return $new_arr;
    }

    public function save_record($record)
    {
        if (($index = $this->get_index_by_id($record['id'])) >= 0 && isset($index)) { // update record
            $this->db_array['records'][intval($index)] = $record;
            $this->set_time_stamp($record['id'], 'updated_at');
            $this->write_json_file();
        } else { // insert new record
            // auto_incrementの一括処理
            foreach ($this->db_array['auto_increment'] as $key => $val) {
                $record[$key] = $val;
                $this->db_array['auto_increment'][$key] += 1;
            }
            array_push($this->db_array['records'], $record); // 新しいレコードの挿入

            $this->set_time_stamp($record['id'], 'created_at');
            $this->set_time_stamp($record['id'], 'updated_at');

            $this->write_json_file();
        }
    }

    public function delete_record($record)
    {
        if ($del_index = $this->get_index_by_id($record['id'])) {
            if (array_splice($this->db_array['records'], $del_index, 1)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function get_index_by_id($id)
    {
        foreach ($this->db_array['records'] as $index => $record) {
            if ($record['id'] == $id) {
                return $index;
            }
        }
        return null;
    }

    private function set_time_stamp($id, $time_key)
    {
        if (($index = $this->get_index_by_id($id)) >= 0) {
            date_default_timezone_set('Asia/Tokyo');
            $this->db_array['records'][$index][$time_key] = date('Y-m-d H:i:s');
            return true;
        } else {
            return false;
        }
    }
}
