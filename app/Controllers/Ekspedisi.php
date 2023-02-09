<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\EkspedisiModel;
use Config\Service;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;


class Ekspedisi extends BaseController
{
    protected $ekspedisi;

    function __construct()
    {
        $this->ekspedisi = new EkspedisiModel();
    }
    public function index()
    {
        $keyword=$this->request->getVar('keyword');
        if($keyword){
            $Data = $this->ekspedisi->search($keyword);
        }else{
            $Data = $this->ekspedisi;
        }
        $currentPage = $this->request->getVar("page_Ekspedisi") ? $this->request->getVar("page_Ekspedisi") : 1;
        $data = [
            'ekspedisi' => $Data->paginate(10,'Ekspedisi'),
            'pager' => $this->ekspedisi->pager,
            'currentPage' => $currentPage
        ];
        return view('Ekspedisi/index', $data);
    }
    function preview($id)
	{
		$dataEkspedisi = $this->ekspedisi->find($id);
        if (empty($dataEkspedisi)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Tidak ditemukan !');
        }
        $data['ekspedisi'] = $dataEkspedisi;
        return view('Ekspedisi/preview', $data);
    }
    public function create()
    {
        if(session()->get('Role')=='Admin'||session()->get('Role')=='Staff'){
            return view('Ekspedisi/create');
        }else{
            return redirect()->to(base_url('home'));
        }
    }
    public function store()
    {
        if (!$this->validate([
            'Tanggal_Surat_Kirim' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'Nomor_Surat_Kirim' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'Perihal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'Tujuan_Surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi',
                ]
            ],
            'TTD' => [
				'rules' => 'uploaded[TTD]|mime_in[TTD,image/jpg,image/jpeg,image/gif,image/png]|max_size[TTD,2048]',
				'errors' => [
					'uploaded' => 'Harus Ada File yang diupload',
					'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
					'max_size' => 'Ukuran File Maksimal 2 MB'
				]
            ],
            'Keterangan' => [
            ],
 
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
		$dataEkspedisi = $this->request->getFile('TTD');
		$fileName = $dataEkspedisi->getRandomName();
        $this->ekspedisi->insert([
            'id' => $this->request->getVar('id'),
            'Tanggal_Surat_Kirim' => $this->request->getVar('Tanggal_Surat_Kirim'),
            'Nomor_Surat_Kirim' => $this->request->getVar('Nomor_Surat_Kirim'),
            'Perihal' => $this->request->getVar('Perihal'),
            'Tujuan_Surat' => $this->request->getVar('Tujuan_Surat'),
            'TTD' => $fileName,
            'Keterangan' => $this->request->getVar('Keterangan'),
        ]);
        $dataEkspedisi->move('uploads/berkas/', $fileName);
        session()->setFlashdata('message', 'Tambah Data Berhasil');
        return redirect()->to('/ekspedisi');
    }
    function edit($id)
    {
        if(session()->get('Role')=='Admin'||session()->get('Role')=='Staff'){
            $dataEkspedisi = $this->ekspedisi->find($id);
            if (empty($dataEkspedisi)) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Tidak ditemukan !');
            }
            $data['ekspedisi'] = $dataEkspedisi;
            return view('Ekspedisi/edit', $data);
        }else{
            return redirect()->to(base_url('home'));
        }
    }
    public function update($id)
    {
        if (!$this->validate([
            'Tanggal_Surat_Kirim' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'Nomor_Surat_Kirim' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'Perihal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'Tujuan_Surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi',
                ]
            ],
            'TTD' => [
				'rules' => 'mime_in[TTD,image/jpg,image/jpeg,image/gif,image/png]|max_size[TTD,2048]',
				'errors' => [
					'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
					'max_size' => 'Ukuran File Maksimal 2 MB'
				]
            ],
            'Keterangan' => [
            ],
            
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back();
        }
        $data = $this->ekspedisi->find($id);
        $old_img_name = $data->TTD;

		$dataEkspedisi = $this->request->getFile('TTD');
        if($dataEkspedisi->isValid() && !$dataEkspedisi->hasMoved())
        {
            if(file_exists("uploads/berkas/".$old_img_name)){
                unlink("uploads/berkas/".$old_img_name);
            }
            $fileName = $dataEkspedisi->getRandomName();
            $dataEkspedisi->move('uploads/berkas/', $fileName);
        }
            else
            {
                $fileName = $old_img_name;
            }
            if($this->ekspedisi->update($id, [
                'Tanggal_Surat_Kirim' => $this->request->getVar('Tanggal_Surat_Kirim'),
                'Nomor_Surat_Kirim' => $this->request->getVar('Nomor_Surat_Kirim'),
                'Perihal' => $this->request->getVar('Perihal'),
                'Tujuan_Surat' => $this->request->getVar('Tujuan_Surat'),
                'TTD' => $fileName,
                'Keterangan' => $this->request->getVar('Keterangan'),
            ]));
            session()->setFlashdata('message', 'Update Data Berhasil');
            return redirect()->to('/ekspedisi');
        }
    function delete($id)
    { 
        if(session()->get('Role')=='Admin'||session()->get('Role')=='Staff'){
            $dataEkspedisi = $this->ekspedisi->find($id);
            $imagefile = $dataEkspedisi->TTD;
            if(file_exists("uploads/berkas/".$imagefile)){
                unlink("uploads/berkas/".$imagefile);
            }
            $this->ekspedisi->where('id', $id);
            $this->ekspedisi->delete($id);
            session()->setFlashdata('message', 'Delete Data Berhasil');
            return redirect()->back();
        }else{
            return redirect()->to(base_url('home'));
        }
    }
    public function generate()
    {
        $phpword = new PhpWord;
        
        $phpword->addTitleStyle(1, ['name' => 'Times New Roman','size'=>18,'bold'=>true],['alignment'=>'center']);
        $sectionStyle = array(
            'orientation' => 'landscape',
        );
        $section = $phpword->addSection($sectionStyle);
        $section->addTitle("BUKU EKSPEDISI");
        $section->addText("Kecamatan\t:",[
            'name' => 'Times New Roman',
            'size' => '12',
            'color' => '000000',
            'bold' => true,],);
        $section->addText("Kelurahan\t:",[
            'name' => 'Times New Roman',
            'size' => '12',
            'color' => '000000',
            'bold' => true,],);
        $section->addText("Tahun\t\t:",[
            'name' => 'Times New Roman',
            'size' => '12',
            'color' => '000000',
            'bold' => true,],);
        $table = $section->addTable(['borderSize' => 3,'alignment'=>'center']);
        $table->addRow();
        $table->addCell(100)->addText("No",[
            'name' => 'Times New Roman',
            'size' => '12',
            'color' => '000000',
            'bold' => true,],['align'=>'center',]);
        $table->addCell(5000)->addText("Tanggal Surat Kirim",[
            'name' => 'Times New Roman',
            'size' => '12',
            'color' => '000000',
            'bold' => true,],['align'=>'center',]);
        $table->addCell(10000)->addText("Nomor Surat Kirim",[
            'align'=>'center',
            'name' => 'Times New Roman',
            'size' => '12',
            'color' => '000000',
            'bold' => true,],['align'=>'center',]);
        $table->addCell(5000)->addText("Perihal",[
            'name' => 'Times New Roman',
            'size' => '12',
            'color' => '000000',
            'bold' => true,],['align'=>'center',]);
        $table->addCell(5000)->addText("Tujuan Surat",[
            'name' => 'Times New Roman',
            'size' => '12',
            'color' => '000000',
            'bold' => true,],['align'=>'center',]);
        $table->addCell(5000)->addText("Tanda Tangan Penerima",[
            'name' => 'Times New Roman',
            'size' => '12',
            'color' => '000000',
            'bold' => true,],['align'=>'center',]);
        $table->addCell(5000)->addText("Keterangan",[
            'name' => 'Times New Roman',
            'size' => '12',
            'color' => '000000',
            'bold' => true,],['align'=>'center',]);

        $data['ekspedisi'] = $this->ekspedisi->findAll();
        $dataEkspedisi= $data['ekspedisi'];
        $no=1;
        foreach($dataEkspedisi as $item){
            $table->addRow();
            $table->addCell()->addText($no,[
                'align'=>'center',
                'name' => 'Times New Roman',
                'size' => '12',
                'color' => '000000',],['align'=>'center',]);
            $table->addCell()->addText($item->Tanggal_Surat_Kirim,[
                'align'=>'center',
                'name' => 'Times New Roman',
                'size' => '12',
                'color' => '000000',],['align'=>'center',]);
            $table->addCell()->addText($item->Nomor_Surat_Kirim,[
                'align'=>'center',
                'name' => 'Times New Roman',
                'size' => '12',
                'color' => '000000',],['align'=>'center',]);
            $table->addCell()->addText($item->Perihal,[
                'align'=>'center',
                'name' => 'Times New Roman',
                'size' => '12',
                'color' => '000000',],['align'=>'center',]);
            $table->addCell()->addText($item->Tujuan_Surat,[
                'align'=>'center',
                'name' => 'Times New Roman',
                'size' => '12',
                'color' => '000000',],['align'=>'center',]);
                if($item->TTD=="no_image.png"){
                    $table->addCell()->addimage('images/'.$item->TTD,['alignment'=>'center','width'=>75,'height'=>60,]);                    
                }else{
                    $table->addCell()->addimage('uploads/berkas/'.$item->TTD,['alignment'=>'center','width'=>75,'height'=>60,]);                    
                }
                if($item->Keterangan==''){
                    $table->addCell()->addText('',[
                        'align'=>'center',
                        'name' => 'Times New Roman',
                        'size' => '12',
                        'color' => '000000',],['align'=>'center',]); 
                }else{
                    $table->addCell()->addText($item->Keterangan,[
                        'align'=>'center',
                        'name' => 'Times New Roman',
                        'size' => '12',
                        'color' => '000000',],['align'=>'center',]); 
                }
                $no++;                  
        }
        
        $writter = new Word2007($phpword);
        $fileName = date('y-m-d-H-i-s').'Buku-Ekspedisi.docx';
        header("Contet-Type: application/msword");
        header("Content-Disposition: attachment; filename=".$fileName);
        header("Cache-Control: max-age=0");
        $writter->save("php://output");
        
        
            
    }
    public function import()
    {
        if(session()->get('Role')=='Admin'||session()->get('Role')=='Staff'){
            $file = $this->request->getfile('file_excel');
            $extension = $file->getClientExtension();
            if($extension == 'xlsx' || $extension == 'xls'){
                if($extension == 'xls'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlx();
                }else{
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                }
                $spreedsheet = $reader->load($file);
                $dataEkspedisi = $spreedsheet->getActiveSheet()->toArray();
                foreach($dataEkspedisi as $key => $value){
                    if($key == 0){
                        continue;
                    }
                    $data = [
                        'Tanggal_Surat_Kirim' => $newDate = date("Y-m-d", strtotime($value[1])),
                        'Nomor_Surat_Kirim' => $value[2],
                        'Perihal'   => $value[3],
                        'Tujuan_Surat'  => $value[4],
                        'TTD'  => 'no_image.png',
                        'Keterangan' => $value[6],
                    ];
                    $this->ekspedisi->insert($data);
                }
                session()->setFlashdata('message', 'Tambah Data Excel Berhasil');
                return redirect()->to('/ekspedisi');
            }else{
                session()->setFlashdata('error', 'Format File Tidak Sesuai');
                return redirect()->to('/ekspedisi');
            }
        }else{
            return redirect()->to(base_url('home'));
        }
    }
}   