<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\KejadianModel;
use Config\Service;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;



class Kejadian extends BaseController
{
  protected $kejadian;

  function __construct()
  {
    $this->kejadian = new KejadianModel();
  }
  public function index()
  {
    $keyword = $this->request->getVar('keyword');
    if ($keyword) {
      $Data = $this->kejadian->search($keyword);
    } else {
      $Data = $this->kejadian;
    }
    $currentPage = $this->request->getVar("page_Kejadian") ? $this->request->getVar("page_Kejadian") : 1;
    $data = [
      'kejadian' => $Data->paginate(10, 'Kejadian'),
      'pager' => $this->kejadian->pager,
      'currentPage' => $currentPage
    ];
    return view('Kejadian/index', $data);
  }
  function preview($id)
  {
    $dataKejadian = $this->kejadian->find($id);
    if (empty($dataKejadian)) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Tidak ditemukan !');
    }
    $data['kejadian'] = $dataKejadian;
    return view('Kejadian/preview', $data);
  }
  public function create()
  {
    if (session()->get('Role') == 'Admin' || session()->get('Role') == 'Staff') {
      return view('Kejadian/create');
    } else {
      return redirect()->to(base_url('home'));
    }
  }
  public function store()
  {
    if (!$this->validate([
      'Tanggal' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Harus diisi'
        ]
      ],
      'Pelapor' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Harus diisi'
        ]
      ],
      'Tanggal_Kejadian' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Harus diisi'
        ]
      ],
      'Tempat_Kejadian' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Harus diisi',
        ]
      ],
      'Jenis_Kejadian' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Harus diisi',
        ]
      ],
      'Petugas' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Harus diisi',
        ]
      ],
      'Penyebab' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Harus diisi',
        ]
      ],
      'Akibat' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Harus diisi',
        ]
      ],
      'Kerugian' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Harus diisi',
        ]
      ],
      'Solusi' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Harus diisi',
        ]
      ],
      'Hasil' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Harus diisi',
        ]
      ],
      'Keterangan' => [],

    ])) {
      session()->setFlashdata('error', $this->validator->listErrors());
      return redirect()->back()->withInput();
    }
    $this->kejadian->insert([
      'id' => $this->request->getVar('id'),
      'Tanggal' => $this->request->getVar('Tanggal'),
      'Pelapor' => $this->request->getVar('Pelapor'),
      'Tanggal_Kejadian' => $this->request->getVar('Tanggal_Kejadian'),
      'Tempat_Kejadian' => $this->request->getVar('Tempat_Kejadian'),
      'Jenis_Kejadian' => $this->request->getVar('Jenis_Kejadian'),
      'Petugas' => $this->request->getVar('Petugas'),
      'Penyebab' => $this->request->getVar('Penyebab'),
      'Akibat' => $this->request->getVar('Akibat'),
      'Kerugian' => $this->request->getVar('Kerugian'),
      'Solusi' => $this->request->getVar('Solusi'),
      'Hasil' => $this->request->getVar('Hasil'),
      'Keterangan' => $this->request->getVar('Keterangan'),
    ]);
    session()->setFlashdata('message', 'Tambah Data Berhasil');
    return redirect()->to('/kejadian');
  }
  function edit($id)
  {
    if (session()->get('Role') == 'Admin' || session()->get('Role') == 'Staff') {
      $dataKejadian = $this->kejadian->find($id);
      if (empty($dataKejadian)) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Tidak ditemukan !');
      }
      $data['kejadian'] = $dataKejadian;
      return view('Kejadian/edit', $data);
    } else {
      return redirect()->to(base_url('home'));
    }
  }
  public function update($id)
  {
    if (!$this->validate([
      'Tanggal' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Harus diisi'
        ]
      ],
      'Pelapor' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Harus diisi'
        ]
      ],
      'Tanggal_Kejadian' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Harus diisi',
        ]
      ],
      'Tempat_Kejadian' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Harus diisi',
        ]
      ],
      'Jenis_Kejadian' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Harus diisi',
        ]
      ],
      'Petugas' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Harus diisi',
        ]
      ],
      'Penyebab' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Harus diisi',
        ]
      ],
      'Akibat' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Harus diisi',
        ]
      ],
      'Kerugian' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Harus diisi',
        ]
      ],
      'Solusi' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Harus diisi',
        ]
      ],
      'Hasil' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Harus diisi',
        ]
      ],
      'Keterangan' => [],

    ])) {
      session()->setFlashdata('error', $this->validator->listErrors());
      return redirect()->back();
    }
    $data = $this->kejadian->find($id);

    if ($this->kejadian->update($id, [
      'Tanggal' => $this->request->getVar('Tanggal'),
      'Pelapor' => $this->request->getVar('Pelapor'),
      'Tanggal_Kejadian' => $this->request->getVar('Tanggal_Kejadian'),
      'Tempat_Kejadian' => $this->request->getVar('Tempat_Kejadian'),
      'Jenis_Kejadian' => $this->request->getVar('Jenis_Kejadian'),
      'Petugas' => $this->request->getVar('Petugas'),
      'Penyebab' => $this->request->getVar('Penyebab'),
      'Akibat' => $this->request->getVar('Akibat'),
      'Kerugian' => $this->request->getVar('Kerugian'),
      'Solusi' => $this->request->getVar('Solusi'),
      'Hasil' => $this->request->getVar('Hasil'),
      'Keterangan' => $this->request->getVar('Keterangan'),
    ]));
    session()->setFlashdata('message', 'Update Data Berhasil');
    return redirect()->to('/kejadian');
  }
  function delete($id)
  {
    if (session()->get('Role') == 'Admin' || session()->get('Role') == 'Staff') {
      $dataKejadian = $this->kejadian->find($id);
      $this->kejadian->where('id', $id);
      $this->kejadian->delete($id);
      session()->setFlashdata('message', 'Delete Data Berhasil');
      return redirect()->back();
    } else {
      return redirect()->to(base_url('home'));
    }
  }
  public function generate()
  {
    $phpword = new PhpWord;

    $phpword->addTitleStyle(1, ['name' => 'Times New Roman', 'size' => 18, 'bold' => true], ['alignment' => 'center']);
    $sectionStyle = array(
      'orientation' => 'landscape',
    );
    $section = $phpword->addSection($sectionStyle);
    $section->addTitle("BUKU RUPA-RUPA KEJADIAN");
    $section->addText("Kecamatan\t:", [
      'name' => 'Times New Roman',
      'size' => '12',
      'color' => '000000',
      'bold' => true,
    ],);
    $section->addText("Kelurahan\t:", [
      'name' => 'Times New Roman',
      'size' => '12',
      'color' => '000000',
      'bold' => true,
    ],);
    $section->addText("Tahun\t\t:", [
      'name' => 'Times New Roman',
      'size' => '12',
      'color' => '000000',
      'bold' => true,
    ],);
    $table = $section->addTable(['borderSize' => 3, 'alignment' => 'center']);
    $table->addRow();
    $table->addCell(100)->addText("No", [
      'name' => 'Times New Roman',
      'size' => '12',
      'color' => '000000',
      'bold' => true,
    ], ['align' => 'center',]);
    $table->addCell(5000)->addText("Tanggal", [
      'name' => 'Times New Roman',
      'size' => '12',
      'color' => '000000',
      'bold' => true,
    ], ['align' => 'center',]);
    $table->addCell(10000)->addText("Pelapor", [
      'align' => 'center',
      'name' => 'Times New Roman',
      'size' => '12',
      'color' => '000000',
      'bold' => true,
    ], ['align' => 'center',]);
    $table->addCell(5000)->addText("Tanggal Kejadian", [
      'name' => 'Times New Roman',
      'size' => '12',
      'color' => '000000',
      'bold' => true,
    ], ['align' => 'center',]);
    $table->addCell(5000)->addText("Tempat Kejadian", [
      'name' => 'Times New Roman',
      'size' => '12',
      'color' => '000000',
      'bold' => true,
    ], ['align' => 'center',]);
    $table->addCell(5000)->addText("Jenis Kejadian", [
      'name' => 'Times New Roman',
      'size' => '12',
      'color' => '000000',
      'bold' => true,
    ], ['align' => 'center',]);
    $table->addCell(5000)->addText("Petugas", [
      'name' => 'Times New Roman',
      'size' => '12',
      'color' => '000000',
      'bold' => true,
    ], ['align' => 'center',]);
    $table->addCell(5000)->addText("Penyebab", [
      'name' => 'Times New Roman',
      'size' => '12',
      'color' => '000000',
      'bold' => true,
    ], ['align' => 'center',]);
    $table->addCell(5000)->addText("Akibat", [
      'name' => 'Times New Roman',
      'size' => '12',
      'color' => '000000',
      'bold' => true,
    ], ['align' => 'center',]);
    $table->addCell(5000)->addText("Kerugian", [
      'name' => 'Times New Roman',
      'size' => '12',
      'color' => '000000',
      'bold' => true,
    ], ['align' => 'center',]);
    $table->addCell(5000)->addText("Solusi", [
      'name' => 'Times New Roman',
      'size' => '12',
      'color' => '000000',
      'bold' => true,
    ], ['align' => 'center',]);
    $table->addCell(5000)->addText("Hasil", [
      'name' => 'Times New Roman',
      'size' => '12',
      'color' => '000000',
      'bold' => true,
    ], ['align' => 'center',]);
    $table->addCell(5000)->addText("Keterangan", [
      'name' => 'Times New Roman',
      'size' => '12',
      'color' => '000000',
      'bold' => true,
    ], ['align' => 'center',]);

    $data['kejadian'] = $this->kejadian->findAll();
    $dataKejadian = $data['kejadian'];
    $no = 1;
    foreach ($dataKejadian as $item) {
      $table->addRow();
      $table->addCell()->addText($no++, [
        'align' => 'center',
        'name' => 'Times New Roman',
        'size' => '12',
        'color' => '000000',
      ], ['align' => 'center',]);
      $table->addCell()->addText($item->Tanggal, [
        'align' => 'center',
        'name' => 'Times New Roman',
        'size' => '12',
        'color' => '000000',
      ], ['align' => 'center',]);
      $table->addCell()->addText($item->Pelapor, [
        'align' => 'center',
        'name' => 'Times New Roman',
        'size' => '12',
        'color' => '000000',
      ], ['align' => 'center',]);
      $table->addCell()->addText($item->Tanggal_Kejadian, [
        'align' => 'center',
        'name' => 'Times New Roman',
        'size' => '12',
        'color' => '000000',
      ], ['align' => 'center',]);
      $table->addCell()->addText($item->Tempat_Kejadian, [
        'align' => 'center',
        'name' => 'Times New Roman',
        'size' => '12',
        'color' => '000000',
      ], ['align' => 'center',]);
      $table->addCell()->addText($item->Jenis_Kejadian, [
        'align' => 'center',
        'name' => 'Times New Roman',
        'size' => '12',
        'color' => '000000',
      ], ['align' => 'center',]);
      $table->addCell()->addText($item->Petugas, [
        'align' => 'center',
        'name' => 'Times New Roman',
        'size' => '12',
        'color' => '000000',
      ], ['align' => 'center',]);
      $table->addCell()->addText($item->Penyebab, [
        'align' => 'center',
        'name' => 'Times New Roman',
        'size' => '12',
        'color' => '000000',
      ], ['align' => 'center',]);
      $table->addCell()->addText($item->Akibat, [
        'align' => 'center',
        'name' => 'Times New Roman',
        'size' => '12',
        'color' => '000000',
      ], ['align' => 'center',]);
      $table->addCell()->addText($item->Kerugian, [
        'align' => 'center',
        'name' => 'Times New Roman',
        'size' => '12',
        'color' => '000000',
      ], ['align' => 'center',]);
      $table->addCell()->addText($item->Solusi, [
        'align' => 'center',
        'name' => 'Times New Roman',
        'size' => '12',
        'color' => '000000',
      ], ['align' => 'center',]);
      $table->addCell()->addText($item->Hasil, [
        'align' => 'center',
        'name' => 'Times New Roman',
        'size' => '12',
        'color' => '000000',
      ], ['align' => 'center',]);

      $table->addCell()->addText($item->Keterangan, [
        'align' => 'center',
        'name' => 'Times New Roman',
        'size' => '12',
        'color' => '000000',
      ], ['align' => 'center',]);
    }
        $writter = new Word2007($phpword);
        $fileName = date('y-m-d-H-i-s') . 'Buku-Rupa-Rupa-Kejadian.docx';
        header("Contet-Type: application/msword");
        header("Content-Disposition: attachment; filename=" . $fileName);
        header("Cache-Control: max-age=0");
        $writter->save("php://output");
  }
  public function import()
  {
    if (session()->get('Role') == 'Admin' || session()->get('Role') == 'Staff') {
      $file = $this->request->getfile('file_excel');
      $extension = $file->getClientExtension();
      if ($extension == 'xlsx' || $extension == 'xls') {
        if ($extension == 'xls') {
          $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
          $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreedsheet = $reader->load($file);
        $dataKejadian = $spreedsheet->getActiveSheet()->toArray();
        foreach ($dataKejadian as $key => $value) {
          if ($key == 0) {
            continue;
          }
          $data = [
            'Tanggal' => $newDate = date("Y-m-d", strtotime($value[1])),
            'Pelapor' => $value[2],
            'Tanggal_Kejadian'   => $value[3],
            'Tempat_Kejadian'  => $value[4],
            'Jenis_Kejadian'  => $value[5],
            'Petugas'  => $value[6],
            'Penyebab'  => $value[7],
            'Akibat'  => $value[8],
            'Kerugian'  => $value[9],
            'Solusi'  => $value[10],
            'Hasil'  => $value[11],
            'Keterangan' => $value[12],
          ];
          $this->kejadian->insert($data);
        }
        session()->setFlashdata('message', 'Tambah Data Excel Berhasil');
        return redirect()->to('/kejadian');
      } else {
        session()->setFlashdata('error', 'Format File Tidak Sesuai');
        return redirect()->to('/kejadian');
      }
    } else {
      return redirect()->to(base_url('home'));
    }
  }
}
