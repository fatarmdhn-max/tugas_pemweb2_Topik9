<?php
require_once __DIR__ . '/../koneksi.php';

class Level
{
    public function index()
    {
        global $dbh;

        $stmt = $dbh->query('SELECT id, nama FROM level ORDER BY id DESC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLevel($id)
    {
        global $dbh;

        $stmt = $dbh->prepare('SELECT id, nama FROM level WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
    }

    public function simpan($data)
    {
        global $dbh;

        $stmt = $dbh->prepare('INSERT INTO level (nama) VALUES (?)');
        return $stmt->execute($data);
    }

    public function ubah($data)
    {
        global $dbh;

        $stmt = $dbh->prepare('UPDATE level SET nama = ? WHERE id = ?');
        return $stmt->execute($data);
    }

    public function hapus($id)
    {
        global $dbh;

        $stmt = $dbh->prepare('DELETE FROM level WHERE id = ?');
        return $stmt->execute([$id]);
    }

    public function cekDipakai($id)
    {
        global $dbh;

        $stmt = $dbh->prepare('SELECT COUNT(*) FROM studies WHERE idlevel = ?');
        $stmt->execute([$id]);
        return (int) $stmt->fetchColumn();
    }
}
