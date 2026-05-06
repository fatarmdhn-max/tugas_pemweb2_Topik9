<?php
require_once __DIR__ . '/../koneksi.php';

class Studies
{
    public function index()
    {
        global $dbh;

        $sql = '
            SELECT
                s.id,
                s.nama,
                s.idlevel,
                s.keterangan,
                s.tahun_lulus,
                s.foto_sekolah,
                l.nama AS nama_level
            FROM studies s
            LEFT JOIN level l ON s.idlevel = l.id
            ORDER BY s.id DESC
        ';

        $stmt = $dbh->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStudies($id)
    {
        global $dbh;

        $sql = '
            SELECT
                s.id,
                s.nama,
                s.idlevel,
                s.keterangan,
                s.tahun_lulus,
                s.foto_sekolah,
                l.nama AS nama_level
            FROM studies s
            LEFT JOIN level l ON s.idlevel = l.id
            WHERE s.id = ?
        ';

        $stmt = $dbh->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
    }

    public function simpan($data)
    {
        global $dbh;

        $stmt = $dbh->prepare(
            'INSERT INTO studies (nama, idlevel, keterangan, tahun_lulus, foto_sekolah) VALUES (?, ?, ?, ?, ?)'
        );

        return $stmt->execute($data);
    }

    public function ubah($data)
    {
        global $dbh;

        $stmt = $dbh->prepare(
            'UPDATE studies SET nama = ?, idlevel = ?, keterangan = ?, tahun_lulus = ?, foto_sekolah = ? WHERE id = ?'
        );

        return $stmt->execute($data);
    }

    public function hapus($id)
    {
        global $dbh;

        $stmt = $dbh->prepare('DELETE FROM studies WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
