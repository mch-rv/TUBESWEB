<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MasukModel;
use Config\Service;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;
use Dompdf\Dompdf;


class Masuk extends BaseController
{
    protected $masuk;

    function __construct()
    {
        $this->masuk = new MasukModel();
    }
    public function index()
    {
        $keyword=$this->request->getVar('keyword');
        if($keyword){
            $Data = $this->masuk->search($keyword);
        }else{
            $Data = $this->masuk;
        }
        $currentPage = $this->request->getVar("page_Masuk") ? $this->request->getVar("page_Masuk") : 1;
        $data = [
            'masuk' => $Data->paginate(10,'Masuk'),
            'pager' => $this->masuk->pager,
            'currentPage' => $currentPage
        ];
        return view('Agenda_Masuk/index', $data);
    }
    function preview($id)
	{
		$dataMasuk = $this->masuk->find($id);
        if (empty($dataMasuk)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Tidak ditemukan !');
        }
        $data['masuk'] = $dataMasuk;
        return view('Agenda_Masuk/preview', $data);
    }
    public function create()
    {
        if(session()->get('Role')=='Admin'||session()->get('Role')=='Staff'){
            return view('Agenda_Masuk/create');
        }else{
            return redirect()->to(base_url('home'));
        }
    }
    public function store()
    {
        if (!$this->validate([
            'Asal_Surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi',
                ]
            ],
            'Nomor' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'Tanggal' => [
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
            'Penanggung_Jawab' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi',
                ]
            ],
            'Tanggal_Penerimaan' => [
				'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi',
                ]
            ],
            'Keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi',
                ]
            ],
 
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
		
        $this->masuk->insert([
            'id' => $this->request->getVar('id'),
            'Asal_Surat' => $this->request->getVar('Asal_Surat'),
            'Nomor' => $this->request->getVar('Nomor'),
            'Tanggal' => $this->request->getVar('Tanggal'),
            'Perihal' => $this->request->getVar('Perihal'),
            'Penanggung_Jawab' => $this->request->getVar('Penanggung_Jawab'),
            'Tanggal_Penerimaan' => $this->request->getVar('Tanggal_Penerimaan'),
            'Keterangan' => $this->request->getVar('Keterangan'),
        ]);
        session()->setFlashdata('message', 'Tambah Data Berhasil');
        return redirect()->to('/masuk');
    }
    function edit($id)
    {
        if(session()->get('Role')=='Admin'||session()->get('Role')=='Staff'){
            $dataMasuk = $this->masuk->find($id);
            if (empty($dataMasuk)) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Tidak ditemukan !');
            }
            $data['masuk'] = $dataMasuk;
            return view('Agenda_Masuk/edit', $data);
        }else{
            return redirect()->to(base_url('home'));
        }
    }
    public function update($id)
    {
        if (!$this->validate([
            'Asal_Surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi',
                ]
            ],
            'Nomor' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'Tanggal' => [
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
            'Penanggung_Jawab' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi',
                ]
            ],
            'Tanggal_Penerimaan' => [
				'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi',
                ]
            ],
            'Keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi',
                ]
            ],
            
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back();
        }
        
        if($this->masuk->update($id, [
                'Asal_Surat' => $this->request->getVar('Asal_Surat'),
                'Nomor' => $this->request->getVar('Nomor'),
                'Tanggal' => $this->request->getVar('Tanggal'),
                'Perihal' => $this->request->getVar('Perihal'),
                'Penanggung_Jawab' => $this->request->getVar('Penanggung_Jawab'),
                'Tanggal_Penerimaan' => $this->request->getVar('Tanggal_Penerimaan'),
                'Keterangan' => $this->request->getVar('Keterangan'),
            ]));
            session()->setFlashdata('message', 'Update Data Berhasil');
            return redirect()->to('/masuk');
        }
    function delete($id)
    { 
        if(session()->get('Role')=='Admin'||session()->get('Role')=='Staff'){
            $dataMasuk = $this->masuk->find($id);
            $this->masuk->where('id', $id);
            $this->masuk->delete($id);
            session()->setFlashdata('message', 'Delete Data Berhasil');
            return redirect()->back();
        }else{
            return redirect()->to(base_url('home'));
        }
    }
    public function exportPDF(){
        $data  [
            'masuk'
        ]=$this->masuk->findAll();
        $view = view('Agenda_Masuk/export-pdf-masuk',$data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);

    // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
        $dompdf->render();

    // Output the generated PDF to Browser
        $dompdf->stream("Buku-Agenda-Masuk", array("attachment"=>false));
    }
    /*public function generate()
    {
        $phpword = new PhpWord;
        
        $phpword->addTitleStyle(1, ['name' => 'Times New Roman','size'=>18,'bold'=>true],['alignment'=>'center']);
        $sectionStyle = array(
            'orientation' => 'landscape',
        );
        $section = $phpword->addSection($sectionStyle);
        $section->addTitle("BUKU AGENDA SURAT MASUK");
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
        $table->addCell(5000)->addText("Nama Instansi Yang Mengirim/Asal Surat",[
            'name' => 'Times New Roman',
            'size' => '12',
            'color' => '000000',
            'bold' => true,],['align'=>'center',]);
        $table->addCell(10000)->addText("Nomor",[
            'align'=>'center',
            'name' => 'Times New Roman',
            'size' => '12',
            'color' => '000000',
            'bold' => true,],['align'=>'center',]);
        $table->addCell(5000)->addText("Tanggal",[
            'name' => 'Times New Roman',
            'size' => '12',
            'color' => '000000',
            'bold' => true,],['align'=>'center',]);
        $table->addCell(5000)->addText("Perihal",[
            'name' => 'Times New Roman',
            'size' => '12',
            'color' => '000000',
            'bold' => true,],['align'=>'center',]);
        $table->addCell(5000)->addText("Penanggung Jawab Pengelola",[
            'name' => 'Times New Roman',
            'size' => '12',
            'color' => '000000',
            'bold' => true,],['align'=>'center',]);
        $table->addCell(5000)->addText("Tanggal Penerimaan",[
            'name' => 'Times New Roman',
            'size' => '12',
            'color' => '000000',
            'bold' => true,],['align'=>'center',]);
        $table->addCell(5000)->addText("Keterangan",[
            'name' => 'Times New Roman',
             'size' => '12',
             'color' => '000000',
             'bold' => true,],['align'=>'center',]);

        $data['masuk'] = $this->masuk->findAll();
        $dataMasuk= $data['masuk'];
        $no=1;
        foreach($dataMasuk as $item){
            $table->addRow();
            $table->addCell()->addText($no++,[
                'align'=>'center',
                'name' => 'Times New Roman',
                'size' => '12',
                'color' => '000000',],['align'=>'center',]);
            $table->addCell()->addText($item->Asal_Surat,[
                'align'=>'center',
                'name' => 'Times New Roman',
                'size' => '12',
                'color' => '000000',],['align'=>'center',]);
            $table->addCell()->addText($item->Nomor,[
                'align'=>'center',
                'name' => 'Times New Roman',
                'size' => '12',
                'color' => '000000',],['align'=>'center',]);
            $table->addCell()->addText($item->Tanggal,[
                'align'=>'center',
                'name' => 'Times New Roman',
                'size' => '12',
                'color' => '000000',],['align'=>'center',]);
            $table->addCell()->addText($item->Perihal,[
                'align'=>'center',
                'name' => 'Times New Roman',
                'size' => '12',
                'color' => '000000',],['align'=>'center',]);
            $table->addCell()->addText($item->Penanggung_Jawab,[
                'align'=>'center',
                'name' => 'Times New Roman',
                'size' => '12',
                'color' => '000000',],['align'=>'center',]);
                $table->addCell()->addText($item->Tanggal_Penerimaan,[
                    'align'=>'center',
                    'name' => 'Times New Roman',
                    'size' => '12',
                    'color' => '000000',],['align'=>'center',]);    
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
        }
        
        $writter = new Word2007($phpword);
        $fileName = date('y-m-d-H-i-s').'Buku-Agenda-Surat-Masuk.docx';
        header("Contet-Type: application/msword");
        header("Content-Disposition: attachment; filename=".$fileName);
        header("Cache-Control: max-age=0");
        $writter->save("php://output");
        
        
            
    }*/
    public function import()
    {
        if(session()->get('Role')=='Admin'||session()->get('Role')=='Staff'){
            $file = $this->request->getfile('file_excel');
            $extension = $file->getClientExtension();
            if($extension == 'xlsx' || $extension == 'xls'){
                if($extension == 'xls'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }else{
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                }
                $spreedsheet = $reader->load($file);
                $dataMasuk = $spreedsheet->getActiveSheet()->toArray();
                foreach($dataMasuk as $key => $value){
                    if($key == 0||$key == 1){
                        continue;
                    }
                    $data = [
                        'Asal_Surat' => $value[1],
                        'Nomor' => $value[2],
                        'Tanggal'   => $newDate = date("Y-m-d", strtotime($value[3])),
                        'Perihal'  => $value[4],
                        'Penanggung_Jawab'  => $value[5],
                        'Tanggal_Penerimaan'  => $newDate = date("Y-m-d", strtotime($value[6])),
                        'Keterangan' => $value[7],
                    ];
                    $this->masuk->insert($data);
                }
                session()->setFlashdata('message', 'Tambah Data Excel Berhasil');
                return redirect()->to('/masuk');
            }else{
                session()->setFlashdata('error', 'Format File Tidak Sesuai');
                return redirect()->to('/masuk');
            }
        }else{
            return redirect()->to(base_url('home'));
        }
    }
}   