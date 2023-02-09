<?php

namespace App\Models;

use CodeIgniter\Model;

class KeluarModel extends Model
{
    protected $table = "keluar";
    protected $column_order = array(NULL,'Nomor','Tanggal',NULL,NULL,NULL,NULL,NULL);
    protected $column_search = array('Instansi_Yang_Dituju','Nomor','Tanggal','Perihal');
    protected $order = array('Tanggal'=>'asc');
    protected $primaryKey = "id";
    protected $returnType = "object";
    protected $useTimestamps = true;
    protected $allowedFields = ['Instansi_Yang_Dituju','Nomor','Tanggal','Perihal','Penanggung_Jawab','Tanggal_Pengiriman','Keterangan'];

    public function search($keyword)
    {
        return $this->table('Keluar')->like('Nomor',$keyword)
        ->orLike('Tanggal',$keyword)->orLike('Perihal',$keyword)->orLike('Instansi_Yang_Dituju',$keyword);
    }
}