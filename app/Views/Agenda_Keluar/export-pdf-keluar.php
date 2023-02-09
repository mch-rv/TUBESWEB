<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://getbootstrap.com/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
    <div class="table-responsive">
    <h3 align="center">BUKU AGENDA SURAT KELUAR</h3>
    <table style="margin-left: 150px;" class="my-3">

    <tbody>
        <tr>
            <td>Kecamatan</td>
            <td style="padding-left: 50px;">:</td>
        </tr>
         <tr>
            <td >Kelurahan</td>
            <td style="padding-left: 50px;">:</td>
        </tr>
        <tr>
            <td>Tahun</td>
            <td style="padding-left: 50px;">:</td>
        </tr>
    </tbody>

    </table>
    <table align="center" border=1 width=80% cellpadding=2 cellspacing=0 style="margin-top: 5px; text-align:center">  
    <thead>
                <tr class="text-center">
                    <th class="align-middle" rowspan="2">No</th>
                    <th class="align-middle" rowspan="2">Nama Instansi Yang Dituju</th>
                    <th class="align-middle" colspan="2">Nomor Surat dan Tanggal</th>
                    <th class="align-middle" rowspan="2">Perihal</th>
                    <th class="align-middle" rowspan="2">Penanggung jawab Pengelola</th>
                    <th class="align-middle" rowspan="2">Tanggal Pengiriman</th>
                    <th class="align-middle" rowspan="2">Keterangan</th>
                </tr>
                <tr>
                    <th class="align-middle">Nomor</th>
                    <th class="align-middle">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                        $no  = 1;
                        foreach ($keluar as $row) {
                        ?>
                            <tr class="text-center">
                            <td><?= $no++; ?></td>
                            <td><?= $row->Instansi_Yang_Dituju; ?></td>
                                <td><?= $row->Nomor; ?></td>
                                <td><?= $row->Tanggal; ?></td>
                                <td><?= $row->Perihal; ?></td>
                                <td><?= $row->Penanggung_Jawab; ?></td>
                                <td><?= $row->Tanggal_Pengiriman; ?></td>
                                <td><?= $row->Keterangan; ?></td>
                            </tr>
                <?php
                }
                ?>
            </tbody>
            </table>
            </div>
        </div>
    </body>
</html>
