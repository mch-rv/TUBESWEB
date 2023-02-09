<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\KeluarModel;
use Config\Service;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;
use Dompdf\Dompdf;

class Keluar extends BaseController
{
    protected $keluar;

    function __construct()
    {
        $this->keluar = new KeluarModel();
    }
    public function index()
    {
        $keyword=$this->request->getVar('keyword');
        if($keyword){
            $Data = $this->keluar->search($keyword);
        }else{
            $Data = $this->keluar;
        }
        $currentPage = $this->request->getVar("page_Keluar") ? $this->request->getVar("page_Keluar") : 1;
        $data = [
            'keluar' => $Data->paginate(10,'Keluar'),
            'pager' => $this->keluar->pager,
            'currentPage' => $currentPage
        ];
        return view('Agenda_Keluar/index', $data);
    }
    function preview($id)
	{
		$dataKeluar = $this->keluar->find($id);
        if (empty($dataKeluar)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Tidak ditemukan !');
        }
        $data['keluar'] = $dataKeluar;
        return view('Agenda_Keluar/preview', $data);
    }
    public function create()
    {
        if(session()->get('Role')=='Admin'||session()->get('Role')=='Staff'){
            return view('Agenda_Keluar/create');
        }else{
            return redirect()->to(base_url('home'));
        }
    }
    public function store()
    {
        if (!$this->validate([
            'Instansi_Yang_Dituju' => [
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
            'Tanggal_Pengiriman' => [
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
		
        $this->keluar->insert([
            'id' => $this->request->getVar('id'),
            'Instansi_Yang_Dituju' => $this->request->getVar('Instansi_Yang_Dituju'),
            'Nomor' => $this->request->getVar('Nomor'),
            'Tanggal' => $this->request->getVar('Tanggal'),
            'Perihal' => $this->request->getVar('Perihal'),
            'Penanggung_Jawab' => $this->request->getVar('Penanggung_Jawab'),
            'Tanggal_Pengiriman' => $this->request->getVar('Tanggal_Pengiriman'),
            'Keterangan' => $this->request->getVar('Keterangan'),
        ]);
        session()->setFlashdata('message', 'Tambah Data Berhasil');
        return redirect()->to('/keluar');
    }
    function edit($id)
    {
        if(session()->get('Role')=='Admin'||session()->get('Role')=='Staff'){
            $dataKeluar = $this->keluar->find($id);
            if (empty($dataKeluar)) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Tidak ditemukan !');
            }
            $data['keluar'] = $dataKeluar;
            return view('Agenda_Keluar/edit', $data);
        }else{
            return redirect()->to(base_url('home'));
        }
    }
    public function update($id)
    {
        if (!$this->validate([
            'Instansi_Yang_Dituju' => [
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
            'Tanggal_Pengiriman' => [
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
        
        if($this->keluar->update($id, [
                'Instansi_Yang_Dituju' => $this->request->getVar('Instansi_Yang_Dituju'),
                'Nomor' => $this->request->getVar('Nomor'),
                'Tanggal' => $this->request->getVar('Tanggal'),
                'Perihal' => $this->request->getVar('Perihal'),
                'Penanggung_Jawab' => $this->request->getVar('Penanggung_Jawab'),
                'Tanggal_Pengiriman' => $this->request->getVar('Tanggal_Pengiriman'),
                'Keterangan' => $this->request->getVar('Keterangan'),
            ]));
            session()->setFlashdata('message', 'Update Data Berhasil');
            return redirect()->to('/keluar');
        }
    function delete($id)
    { 
        if(session()->get('Role')=='Admin'||session()->get('Role')=='Staff'){
            $dataKeluar = $this->keluar->find($id);
            $this->keluar->where('id', $id);
            $this->keluar->delete($id);
            session()->setFlashdata('message', 'Delete Data Berhasil');
            return redirect()->back();
        }else{
            return redirect()->to(base_url('home'));
        }
    }
    public function exportPDF(){
        $data  [
            'keluar'
        ]=$this->keluar->findAll();
        $view = view('Agenda_Keluar/export-pdf-keluar',$data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);

    // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
        $dompdf->render();

    // Output the generated PDF to Browser
        $dompdf->stream("Buku-Agenda-Keluar", array("attachment"=>false));
    }
    /*public function generate()
    {
        $phpword = new PhpWord;
        
        $phpword->addTitleStyle(1, ['name' => 'Times New Roman','size'=>18,'bold'=>true],['alignment'=>'center']);
        $sectionStyle = array(
            'orientation' => 'landscape',
        );
        $section = $phpword->addSection($sectionStyle);
        $section->addTitle("BUKU AGENDA SURAT KELUAR");
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
        $table->addCell(5000)->addText("Nama Instansi Yang Dituju",[
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
        $table->addCell(5000)->addText("Tanggal Pengiriman",[
            'name' => 'Times New Roman',
            'size' => '12',
            'color' => '000000',
            'bold' => true,],['align'=>'center',]);
        $table->addCell(5000)->addText("Keterangan",[
            'name' => 'Times New Roman',
             'size' => '12',
             'color' => '000000',
             'bold' => true,],['align'=>'center',]);

        $data['keluar'] = $this->keluar->findAll();
        $dataKeluar= $data['keluar'];
        $no=1;
        foreach($dataKeluar as $item){
            $table->addRow();
            $table->addCell()->addText($no++,[
                'align'=>'center',
                'name' => 'Times New Roman',
                'size' => '12',
                'color' => '000000',],['align'=>'center',]);
            $table->addCell()->addText($item->Instansi_Yang_Dituju,[
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
                $table->addCell()->addText($item->Tanggal_Pengiriman,[
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
        $fileName = date('y-m-d-H-i-s').'Buku-Agenda-Surat-Keluar.docx';
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
                $dataKeluar = $spreedsheet->getActiveSheet()->toArray();
                foreach($dataKeluar as $key => $value){
                    if($key == 0||$key == 1){
                        continue;
                    }
                    $data = [
                        'Instansi_Yang_Dituju' => $value[1],
                        'Nomor' => $value[2],
                        'Tanggal'   => $newDate = date("Y-m-d", strtotime($value[3])),
                        'Perihal'  => $value[4],
                        'Penanggung_Jawab'  => $value[5],
                        'Tanggal_Pengiriman'  => $newDate = date("Y-m-d", strtotime($value[6])),
                        'Keterangan' => $value[7],
                    ];
                    $this->keluar->insert($data);
                }
                session()->setFlashdata('message', 'Tambah Data Excel Berhasil');
                return redirect()->to('/keluar');
            }else{
                session()->setFlashdata('error', 'Format File Tidak Sesuai');
                return redirect()->to('/keluar');
            }
        }else{
            return redirect()->to(base_url('home'));
        }
    }
}   