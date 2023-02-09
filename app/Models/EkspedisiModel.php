<?php

namespace App\Models;

use CodeIgniter\Model;

class EkspedisiModel extends Model
{
    protected $table = "ekspedisi";
    protected $column_order = array(NULL,'Tanggal_Surat_Kirim','Nomor_Surat_Kirim',NULL,NULL,NULL,NULL,NULL);
    protected $column_search = array('Tanggal_Surat_Kirim','Nomor_Surat_Kirim','Perihal','Tujuan_Surat');
    protected $order = array('Tanggal_Surat_Kirim'=>'asc');
    protected $primaryKey = "id";
    protected $returnType = "object";
    protected $useTimestamps = true;
    protected $allowedFields = ['Tanggal_Surat_Kirim', 'Nomor_Surat_Kirim', 'Perihal', 'Tujuan_Surat', 'TTD','Keterangan'];

    public function search($keyword)
    {
        return $this->table('Ekspedisi')->like('Tanggal_Surat_Kirim',$keyword)
        ->orLike('Nomor_Surat_Kirim',$keyword)->orLike('Perihal',$keyword)->orLike('Tujuan_Surat',$keyword);
    }
}