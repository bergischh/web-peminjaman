<?php
class BarangModel {
    private $table = 'mvc_kasus';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllBuku()
    {
        $this->db->query("SELECT * FROM " . $this->table);
        return $this->db->resultSet();
    }

    public function getBukuById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahBarang($data) {
        $query = "INSERT INTO mvc_kasus (nama_peminjaman, jenis_barang, no_barang, tgl_pinjam) VALUES(:nama_peminjaman, :jenis_barang, :no_barang, :tgl_pinjam)";
        $this->db->query($query);
        $this->db->bind('nama_peminjaman' , $data['nama_peminjaman']);
        $this->db->bind('jenis_barang' , $data['jenis_barang']);
        $this->db->bind('no_barang' , $data['no_barang']);
        $this->db->bind('tgl_pinjam' , $data['tgl_pinjam']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateDataBarang($data) {
        $query = "UPDATE mvc_kasus SET nama_peminjaman=:nama_peminjaman, jenis_barang=:jenis_barang, no_barang=:no_barang, tgl_pinjam=:tgl_pinjam, tgl_kembali=:tgl_kembali WHERE id=:id";
        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('nama_peminjaman', $data['nama_peminjaman']);
        $this->db->bind('jenis_barang', $data['jenis_barang']);
        $this->db->bind('no_barang', $data['no_barang']);
        $this->db->bind('tgl_pinjam', $data['tgl_pinjam']);
        $this->db->bind('tgl_kembali', $data['tgl_kembali']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteBarang($id) {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function cariData() {
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM mvc_kasus WHERE nama_peminjaman LIKE :keyword OR jenis_barang LIKE :keyword";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");
        return $this->db->resultSet();
    }

    public function reset()
    {
        $this->db->query("SELECT * FROM " . $this->table);
        return $this->db->resultSet();
    }

}

?>