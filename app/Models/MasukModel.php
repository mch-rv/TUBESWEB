<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class MasukModel extends Model
{
    protected $table = "masuk";
    protected $primaryKey = "id";
    protected $returnType = "object";
    protected $useTimestamps = true;
    protected $allowedFields = ['Asal_Surat', 'Nomor', 'Tanggal', 'Perihal', 'Penanggung_Jawab','Tanggal_Penerimaan','Keterangan',];
}
