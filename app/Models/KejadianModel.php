<?php

namespace App\Models;

use CodeIgniter\Model;

class KejadianModel extends Model
{
  protected $table = "kejadian";
  protected $column_order = array(NULL, 'Tanggal', 'Pelapor', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL,  NULL);
  protected $column_search = array('Tanggal', 'Pelapor', 'Tanggal_Kejadian', 'Tempat_Kejadian', 'Jenis_Kejadian', 'Petugas', 'Penyebab', 'Akibat', 'Kerugian', 'Solusi', 'Hasil');
  protected $order = array('Tanggal_Surat_Kirim' => 'asc');
  protected $primaryKey = "id";
  protected $returnType = "object";
  protected $useTimestamps = true;
  protected $allowedFields = ['Tanggal', 'Pelapor', 'Tanggal_Kejadian', 'Tempat_Kejadian', 'Jenis_Kejadian', 'Petugas', 'Penyebab', 'Akibat', 'Kerugian', 'Solusi', 'Hasil', 'Keterangan'];

  public function search($keyword)
  {
    return $this->table('Kejadian')->like('Tanggal', $keyword)
      ->orLike('Pelapor', $keyword)->orLike('Tanggal_Kejadian', $keyword)->orLike('Tempat_Kejadian', $keyword)->orLike('Jenis_Kejadian', $keyword)->orLike('Petugas', $keyword)->orLike('Penyebab', $keyword)->orLike('Akibat', $keyword)->orLike('Kerugian', $keyword)->orLike('Solusi', $keyword)->orLike('Hasil', $keyword);
  }
}
