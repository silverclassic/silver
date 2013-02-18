<?php

class Usermanage_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function insert($data) {
        return $this->db->insert('users', array(
                    'username' => $data['name'],
                    'password' => Hash::create('sha256', $_POST['password'], HASH_PASSWORD_KEY),
                    'role' => $data['role']
                ));
    }

    public function getUserList() {
        return $this->db->select('SELECT id, username, role FROM users');
    }

    public function userSingleList($id) {
        return $this->db->select('SELECT id, username, role FROM users WHERE id = :id', array(':id' => $id));
    }

    public function get_users() {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset = ($page - 1) * $rows;
        $result = array();

        $sth = $this->db->prepare("select count(id) from users");
        $sth->execute();
        $row = $sth->fetch();
        $result["total"] = $row[0];
        $sth = $this->db->prepare("select id, username, role from users limit $offset,$rows");
        $sth->execute();

        $items = array();
        while ($row = $sth->fetch(PDO::FETCH_OBJ)) {
            array_push($items, $row);
        }
        $result["rows"] = $items;

        echo json_encode($result);
    }

    public function delete($id) {
        $sth = $this->db->prepare('SELECT role FROM users WHERE id = "' . $id . '"');
        $sth->execute();
        $data = $sth->fetch();
        if ($data['role'] == 'owner') {
            return false;
        }
        $sth = $this->db->prepare('DELETE FROM users WHERE id = "' . $id . '"');
        $rs = $sth->execute();
    }

    public function edit($id) {
        require '';
    }

}