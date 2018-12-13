<?php
$nama_lembaga = $this->config->item("nama_lembaga"); $logo_lembaga = $this->config->item("logo_lembaga");
$css_lembaga = $this->config->item("css_lembaga"); $warna_lembaga = $this->config->item("warna_lembaga");
if (sizeof($data_lembaga)>0) {
    $nama_lembaga = $data_lembaga[0]["nama"];
    $logo_lembaga = $data_lembaga[0]["logo"];
    $css_lembaga = $data_lembaga[0]["css"];
    $warna_lembaga = $data_lembaga[0]["warna"];
}
?>

<div class="row wrapper border-bottom white-bg page-heading"
     style="position: fixed; z-index: 1; width: 100%">
    <div class="col-lg-10">
        <ol class="breadcrumb" style="padding-top: 60px;">
            <li>
                <a href="<?php echo base_url('dashboard')?>">Home</a>
            </li>
            <li>
                <a href="<?php echo base_url('pelni')?>">Pesan Tiket PELNI</a>
            </li>
            <li class="active">
                <strong>Info Jadwal</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<?php
$this->load->view('func_custom');

$cekpp = $this->input->post('cekpp');
$tglpergi = $this->input->post('tglpergi',true);
$tglpulang = $this->input->post('tglpulang',true);
$pria = $this->input->post('jmlpria',true);
$wanita = $this->input->post('jmlwanita',true);
$bayi = $this->input->post('jmlbayi',true);

$origin = $this->input->post('origin',true);
$exporigin = explode('-', $origin);
$origincode = str_replace(' ', '', $exporigin[0]);
$originname = $exporigin[1];

$destination = $this->input->post('destination',true);
$expdest = explode('-', $destination);
$destcode = str_replace(' ', '', $expdest[0]);
$destname = $expdest[1];

$exptglpergi = explode('/', $tglpergi);
$bulantglpergi = bulan($exptglpergi[1]);
$tglpergiindo = $exptglpergi[0] . ' ' . $bulantglpergi . ' ' .$exptglpergi[2];
$tglpergidb = $exptglpergi[2] . '-' . $exptglpergi[1] . '-' .$exptglpergi[0];

$exptglpulang = explode('/', $tglpulang);
$bulantglpulang = bulan($exptglpulang[1]);
$tglpulangindo = $exptglpulang[0].' '.$bulantglpulang.' '.$exptglpulang[2];
$tglpulangdb = $exptglpulang[2].'-'.$exptglpulang[1].'-'.$exptglpulang[0];

if($cekpp == 'on'){
    $tanggalpulang = hari($tglpulangdb).', '.$tglpulangindo;
    $pp = '(PP)';
    $margintop = '450px';
    $display = 'block';
}else{
    $tanggalpulang = '';
    $pp = '';
    $margintop = '220px';
    $display = 'none';
}
?>

<!-- Judul Pergi dan Tujuan -->

<div class="row" style="position: fixed; z-index: 1;margin-top: 99px; width: 100%">

    <div class="ibox-content red-bg">

        <input type="hidden" value="<?php echo $warna_lembaga ?>" name="txbwarnalembaga" id="txbwarnalembaga">

        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="col-xs-10">
                    <h2><?php echo $originname;?> ke <?php echo $destname; ?> <?php echo $pp; ?></h2>
                    <h3>
                        <i class="fa fa-calendar"></i>
                        <?php echo hari($tglpergidb).', '.$tglpergiindo; ?> - <?php echo $tanggalpulang; ?>
                        | <i class="fa fa-user"></i>
                        <?php if($pria>0) echo $pria.' Pria'; ?>
                        <?php if($wanita>0) echo $wanita.' Wanita'; ?>
                        <?php if($bayi>0){ echo ' | '.$bayi.' Bayi';} ?>
                    </h3>
                </div>
                <div class="col-xs-2">
                    <a href="#" onclick="showubahcari()" style="color: white" id="btnubahcari"><h3>Ubah Pencarian</h3></a>
                </div>
            </div>
            <div class="col-lg-2"></div>
        </div>

    </div>

</div>

<?php
if($cekpp == 'on') {
    if($jadwal['pergi'] != null || $jadwal['pulang'] != null) {
        ?>

        <!-- Form Hasil Pilihan-->

        <div class="row" style="position: fixed; z-index: 1;margin-top: 205px; width: 100%">

            <div class="col-lg-8 col-lg-offset-2">

                <div class="ibox float-e-margins" style="outline: none; border-color: #d3d3d3;box-shadow: 0 0 10px #d3d3d3;">

                    <div class="ibox-content">

                        <div class="row">

                            <div class="col-xs-8">

                                <div id="formsebelumpilihpergi" style="display: block;">
                                    <h3>Jadwal Kapal Pergi belum dipilih</h3>
                                </div>

                                <hr/>

                                <div id="formsebelumpilihpulang" style="display: block;">
                                    <h3>Jadwal Kapal Pulang belum dipilih</h3>
                                </div>

                            </div>
                            <div class="col-xs-4" id="forminputpilihpergi">

                                <form method="post" id="formpilihpulangpergi" target="_blank">

                                    <div class="text-center"
                                         style="border-left: solid 1px #eeeeee;">
                                        <h2 id="flighttotalhargapp" style="color: <?php echo $warna_lembaga?>">Rp 0</h2>
                                        <button type="button" class="btn btn-danger" id="btnsubmitpulangpergi" onclick="submitpulangpergi()"> PESAN SEKARANG
                                        </button>
                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                    <div class="ibox-content">

                        <div class="row">

                            <ul class="nav nav-tabs text-center" style="border: none;">
                                <li class="active col-xs-6">
                                    <a data-toggle="tab" href="#tab-1" style="border: none;">
                                        <i class="fa fa-ship" style="color: <?php echo $warna_lembaga; ?>;font-size:3em;"></i>
                                        <br/> <span style="color: #ed5565">Perjalanan Pergi</span>
                                    </a>
                                </li>
                                <li class="col-xs-6">
                                    <a data-toggle="tab" href="#tab-2" style="border: none;">
                                        <i class="fa fa-ship" style="color: <?php echo $warna_lembaga; ?>;font-size:3em;"></i>
                                        <br/> <span style="color: #ed5565">Perjalanan Pulang</span>
                                    </a>
                                </li>
                            </ul>

                        </div>

                    </div>

                </div>

            </div>
            <div class="col-lg-2"></div>

        </div>

        <?php
    }
}
?>

<!-- Content -->

<div class="wrapper wrapper-content  animated fadeInRight article" style="margin-top: <?php echo $margintop;?>;">

    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">

                <!--form pencarian-->
                <div class="ibox-content formubahcari m-b-lg" id="formubahcari" style="display: none;">

                    <form id="formpesantiket" method="post" autocomplete="off">

                        <div class="form-group">
                            <div class="i-checks">
                                <label>
                                    <input type="checkbox" class="cekpp" id="cekpp" name="cekpp" <?php if($cekpp=='on'){echo 'checked';}?>>
                                    <i></i> Pulang Pergi
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label><i class="fa fa-map-marker"
                                      style="font-size: 1.2em;color:<?php echo $warna_lembaga ?>;padding-right:5px;"></i>Tempat
                                Asal</label>
                            <input id="origin" name="origin" type="text" class="origin form-control"
                                   value="<?= $origin; ?>" onclick="clearori()" required>
                        </div>

                        <div class="row">
                            <div class="tukar" style="position: relative; cursor:pointer; margin-top: 7px;"
                                 onclick="tukar()">
                                <span class="fa-stack fa-lg"
                                      style="position:absolute;bottom:-20px;right:16px;width:55px;">
                                <i class="fa fa-circle fa-stack-2x" style="color:<?php echo $warna_lembaga; ?>"></i>
                                <i class="fa fa-exchange fa-stack-1x fa-inverse fa-rotate-90"></i>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label><i class="fa fa-map-marker"
                                      style="font-size: 1.2em;color:<?php echo $warna_lembaga ?>;padding-right:5px;"></i>
                                Tempat Tujuan</label>
                            <input id="destination" name="destination" type="text" class="destination form-control"
                                   value="<?= $destination; ?>" onclick="cleardest()" required>
                        </div>

                        <div class="form-group" id="tanggalpergi">
                            <label> Tanggal Pergi</label>
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input id="dppergi" type="text" name="tglpergi" class="form-control"
                                       value="<?= $tglpergi; ?>" onchange="ubahtglpergi()" required>
                            </div>
                        </div>

                        <div class="form-group" id="tanggalpulang" style="margin-top: 28px; display: <?php echo $display; ?>;">
                            <label> Tanggal Pulang</label>
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input id="dppulang" type="text" name="tglpulang" class="form-control"
                                       value="<?= $tglpulang; ?>" required>
                            </div>
                        </div>

                        <div class="form-group" style="margin-top: 30px;">
                            <div class="col-sm-8" style="border-right: solid 1px;">
                                <label> Dewasa (>= 3 thn) :  </label><br/>
                                <div class="col-sm-6">
                                    <label> Pria </label><br/>
                                    <select class="form-control" name="jmlpria" id="jmlpria" required>
                                        <?php
                                        for($i=0; $i<=10; $i++){
                                            ?>
                                            <option <?php if($pria == $i){echo 'selected';} ?>><?= $i;?></option>
                                            <?php
                                        }
                                        ?>
                                    </select><br/>
                                </div>
                                <div class="col-sm-6">
                                    <label> Wanita </label><br/>
                                    <select class="form-control" name="jmlwanita" id="jmlwanita" required>
                                        <?php
                                        for($i=0; $i<=10; $i++){
                                            ?>
                                            <option <?php if($wanita == $i){echo 'selected';} ?>><?= $i;?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label> Bayi (< 3 thn) : </label>
                                <select class="form-control" name="jmlbayi" id="jmlbayi" style="margin-top: 20px;" required>
                                    <?php
                                    for($i=0; $i<=10; $i++){
                                        ?>
                                        <option <?php if($bayi == $i){echo 'selected';} ?>><?= $i;?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" style="padding-top: 150px;">
                            <button id="btnsubmit" class="btn btn-danger" onclick="submittiket()"
                                    style="display: block; width: 100%;">Cari Jadwal
                            </button>
                        </div>

                    </form>

                </div>

                <?php

                if($cekpp == 'on'){

                    if($jadwal['pergi'] == null && $jadwal['pulang'] == null){

                        ?>

                        <div class="ibox-content">

                            <div class="row text-center">

                                <h1>
                                    API Tidak Terkoneksi
                                </h1><br/>
                                <h2>Lakukan Pencarian Jadwal Keberangkatan Kembali</h2><br/>
                                <a href="<?php echo base_url('pelni')?>"><button class="btn btn-danger">Kembali ke form pencarian</button></a>

                            </div>

                        </div>

                        <?php

                    }
                    else{
                        ?>

                        <div class="tab-content" style="padding-top: 20px;">

                            <!-- Jadwal Pergi-->
                            <div id="tab-1" class="tab-pane active">

                                <?php
                                if($jadwal['pergi'] == null){

                                    ?>

                                    <div class="ibox-content">

                                        <div class="row text-center">

                                            <h1>
                                                API Pergi Tidak Terkoneksi
                                            </h1><br/>
                                            <h2>Lakukan Pencarian Jadwal Keberangkatan Kembali</h2><br/>
                                            <a href="<?php echo base_url('pelni')?>"><button class="btn btn-danger">Kembali ke form pencarian</button></a>

                                        </div>

                                    </div>

                                    <?php

                                }else{

                                    $rcpergi = $jadwal['pergi']->rc;
                                    $rdpergi = $jadwal['pergi']->rd;

                                    if($rcpergi != '00'){

                                        ?>

                                        <div class="ibox-content">

                                            <div class="row text-center">

                                                <h1>
                                                    Terjadi error pada API Pergi
                                                </h1><br/>
                                                <h2>Error API : <?php echo $rdpergi;?></h2><br/>
                                                <h2>Lakukan Pencarian Jadwal Keberangkatan Kembali</h2><br/>
                                                <a href="<?php echo base_url('pelni')?>"><button class="btn btn-danger">Kembali ke form pencarian</button></a>

                                            </div>

                                        </div>

                                        <?php

                                    }else{

                                        $jumlahjadwalpergi = count($jadwal['pergi']->data);

                                        if($jumlahjadwalpergi == 0){

                                            ?>

                                            <div class="ibox-content">

                                                <div class="row text-center">

                                                    <h1>
                                                        JADWAL KEBERANGKATAN PERGI TIDAK DITEMUKAN
                                                    </h1><br/>
                                                    <h2>Lakukan Pencarian Jadwal Keberangkatan Kembali</h2><br/>
                                                    <a href="<?php echo base_url('pelni')?>"><button class="btn btn-danger">Kembali ke form pencarian</button></a>

                                                </div>

                                            </div>

                                            <?php

                                        }else{

                                            ?>

                                            <!--form jadwal kapal-->
                                            <input type="hidden" id="jumlahjadwalpergi" value="<?= $jumlahjadwalpergi;?>">

                                            <?php
                                            $depdatekurangpergi = 0;
                                            for ($x = 0; $x < $jumlahjadwalpergi; $x++) {
                                                $depdatepergi = $jadwal['pergi']->data[$x]->DEP_DATE;
                                                $newdepdatepergi = date('Y-m-d',strtotime($depdatepergi));
                                                $expnewdepdatepergi = explode('-', $newdepdatepergi);
                                                $newdepdatepergiindo = hari($newdepdatepergi).', '.$expnewdepdatepergi[2] . ' ' . bulan($expnewdepdatepergi[1]) . ' ' .$expnewdepdatepergi[0];
                                                $deptimepergi = $jadwal['pergi']->data[$x]->DEP_TIME;
                                                $chunkspergi = str_split($deptimepergi, 2);
                                                $deptimepergi = implode(':', $chunkspergi);

                                                $arvdatepergi = $jadwal['pergi']->data[$x]->ARV_DATE;
                                                $newarvdatepergi = date('Y-m-d',strtotime($arvdatepergi));
                                                $expnewarvdatepergi = explode('-', $newarvdatepergi);
                                                $newarvdatepergiindo = hari($newarvdatepergi).', '.$expnewarvdatepergi[2] . ' ' . bulan($expnewarvdatepergi[1]) . ' ' .$expnewarvdatepergi[0];
                                                $arvtimepergi = $jadwal['pergi']->data[$x]->ARV_TIME;
                                                $chunkspergi = str_split($arvtimepergi, 2);
                                                $arvtimepergi = implode(':', $chunkspergi);

                                                $shipnopergi = $jadwal['pergi']->data[$x]->SHIP_NO;
                                                $shipnamepergi = $jadwal['pergi']->data[$x]->SHIP_NAME;

                                                $routepergi = $jadwal['pergi']->data[$x]->ROUTE;
                                                $exproutepergi = explode('-',$routepergi);
                                                $jmlroutepergi = count($exproutepergi);

                                                if($newdepdatepergi >= $tglpergidb) {

                                                    $depdatekurangpergi = $depdatekurangpergi + 1;

                                                    $labelrutepergi = array();

                                                    for($y = 0; $y < $jmlroutepergi; $y++){
                                                        $rutepergi = $exproutepergi[$y];
                                                        $exprutepergi = explode('/',$rutepergi);
                                                        $coderutepergi = $exprutepergi[0];
                                                        $tiperutepergi = $exprutepergi[1];

                                                        for($z = 0; $z<count($kode->data); $z++){
                                                            $namarutepergi = $kode->data[$z]->NAME;
                                                            $koderutepergi = $kode->data[$z]->CODE;
                                                            if($y==0){
                                                                $namarute = '<b>'.$namarutepergi.'</b>';
                                                            }
                                                            if($y==($jmlroutepergi-1)){
                                                                $namarute = '<b>'.$namarutepergi.'</b>';
                                                            }
                                                            if($coderutepergi == $koderutepergi){
                                                                array_push($labelrutepergi,$namarutepergi);
                                                            }
                                                        }
                                                    }

                                                    $labelpergi = implode(" <i class='fa fa-arrow-right'></i> ",$labelrutepergi);

                                                    ?>
                                                    <div class="ibox float-e-margins">
                                                        <div class="ibox-title red-bg">
                                                            <?php echo 'Berangkat : '.$newdepdatepergiindo.' ('.$deptimepergi.') - Tiba : '.$newarvdatepergiindo.' ('.$arvtimepergi.')';?>
                                                        </div>
                                                        <div class="ibox-content" style="margin-bottom: 10px; padding-top: 10px;">
                                                            <h2><?= $shipnopergi.' - '.$shipnamepergi;?></h2>
                                                            <hr/>
                                                            <div style="text-align: justify">
                                                                <Text style="font-size: 14px;"><?= 'Rute : '.$labelpergi;?></Text>
                                                            </div>
                                                            <hr/>
                                                            <form class="form-horizontal">
                                                                <div class="form-group">
                                                                    <label class="control-label col-sm-2"> Pilih Kelas </label>
                                                                    <div class="col-sm-5">
                                                                        <?php
                                                                        $farespergi= $jadwal['pergi']->data[$x]->fares;
                                                                        $idselectpergi = 'kelas'.$x;
                                                                        $jmlfarespergi = count($farespergi);
                                                                        ?>
                                                                        <select class="form-control" name="kelas" id="<?= $idselectpergi;?>" onchange="showhargakelaspergi(this)">
                                                                            <?php
                                                                            for($i=0; $i<$jmlfarespergi; $i++){
                                                                                $subclasspergi = $farespergi[$i]->SUBCLASS;
                                                                                $classpergi = $farespergi[$i]->CLASS;
                                                                                $availabilityfpergi = $farespergi[$i]->AVAILABILITY->F;
                                                                                $availabilitympergi = $farespergi[$i]->AVAILABILITY->M;
                                                                                $valuepergi = $x.'/'.$farespergi[$i]->CLASS.' - '.$farespergi[$i]->SUBCLASS.'/'.$jmlfarespergi.'/'.$i;
                                                                                $labelclasspergi = 'KELAS '.$classpergi.' - '.$subclasspergi.', Sisa Kursi (W = '. $availabilityfpergi .', P = '.$availabilitympergi.')';
                                                                                ?>
                                                                                <option value="<?= $valuepergi;?>"><?= $labelclasspergi;?></option>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-5"></div>
                                                                </div>
                                                                <hr>
                                                                <?php
                                                                $namakelaspergi = $farespergi[0]->CLASS.' - '.$farespergi[0]->SUBCLASS;
                                                                $namaspanpergi = 'spanpergi'.$x;
                                                                ?>
                                                                <h3>Harga sesuai kelas : KELAS <span id="<?=$namaspanpergi;?>"><?= $namakelaspergi;?></span></h3>
                                                                <?php
                                                                for($i=0; $i<$jmlfarespergi; $i++) {
                                                                    $portpasspergi = $farespergi[$i]->FARE_DETAIL->A->PORT_PASS;
                                                                    $arvporttransportfeeepergi = $farespergi[$i]->FARE_DETAIL->A->ARV_PORT_TRANSPORT_FEE;
                                                                    $depporttransportfeeepergi = $farespergi[$i]->FARE_DETAIL->A->DEP_PORT_TRANSPORT_FEE;
                                                                    $insurancepergi = $farespergi[$i]->FARE_DETAIL->A->INSURANCE;
                                                                    $farepergi = $farespergi[$i]->FARE_DETAIL->A->FARE;
                                                                    $totalpergi = $farespergi[$i]->FARE_DETAIL->A->TOTAL;

                                                                    $portpassbayipergi = $farespergi[$i]->FARE_DETAIL->I->PORT_PASS;
                                                                    $arvporttransportfeeebayipergi = $farespergi[$i]->FARE_DETAIL->I->ARV_PORT_TRANSPORT_FEE;
                                                                    $depporttransportfeeebayipergi = $farespergi[$i]->FARE_DETAIL->I->DEP_PORT_TRANSPORT_FEE;
                                                                    $insurancebayipergi = $farespergi[$i]->FARE_DETAIL->I->INSURANCE;
                                                                    $farebayipergi = $farespergi[$i]->FARE_DETAIL->I->FARE;
                                                                    $totalbayipergi = $farespergi[$i]->FARE_DETAIL->I->TOTAL;

                                                                    $idtablepergi = 'tablepergi'.$x.''.$i;

                                                                    if ($i == 0) {
                                                                        $display = 'block';
                                                                    } else {
                                                                        $display = 'none';
                                                                    }
                                                                    ?>

                                                                    <div id="<?= $idtablepergi;?>" class="<?= $idtablepergi;?> form-group" style="display: <?= $display;?>">
                                                                        <div class="col-sm-6 text-center">
                                                                            <text class="text-center" style="font-weight: bold;"> Tarif Tiket Dewasa </text>
                                                                            <div class="table-responsive">
                                                                                <table class="table table-bordered table-hover" style="font-size: 12px;">
                                                                                    <tr class="text-right">
                                                                                        <th class="text-right">PORT PASS</th>
                                                                                        <td><?= nominalcomma($portpasspergi);?></td>
                                                                                    </tr>
                                                                                    <tr class="text-right">
                                                                                        <th class="text-right">DEPARTURE PORT TRANSPORT FEE</th>
                                                                                        <td><?= nominalcomma($depporttransportfeeepergi);?></td>
                                                                                    </tr>
                                                                                    <tr class="text-right">
                                                                                        <th class="text-right">ARRRIVAL PORT TRANSPORT FEE</th>
                                                                                        <td><?= nominalcomma($arvporttransportfeeepergi);?></td>
                                                                                    </tr>
                                                                                    <tr class="text-right">
                                                                                        <th class="text-right">ASURANSI</th>
                                                                                        <td><?= nominalcomma($insurancepergi);?></td>
                                                                                    </tr>
                                                                                    <tr class="text-right">
                                                                                        <th class="text-right">HARGA</th>
                                                                                        <td><?= nominalcomma($farepergi);?></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th class="text-right">TOTAL HARGA</th>
                                                                                        <th class="text-right"><?= rupiah($totalpergi);?></th>
                                                                                    </tr>
                                                                                </table>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6 text-center">
                                                                            <text class="text-center" style="font-weight: bold;"> Tarif Tiket Bayi </text>
                                                                            <div class="table-responsive">
                                                                                <table class="table table-bordered table-hover" style="font-size: 12px;">
                                                                                    <tr class="text-right">
                                                                                        <th class="text-right">PORT PASS</th>
                                                                                        <td><?= nominalcomma($portpassbayipergi);?></td>
                                                                                    </tr>
                                                                                    <tr class="text-right">
                                                                                        <th class="text-right">DEPARTURE PORT TRANSPORT FEE</th>
                                                                                        <td><?= nominalcomma($depporttransportfeeebayipergi);?></td>
                                                                                    </tr>
                                                                                    <tr class="text-right">
                                                                                        <th class="text-right">ARRRIVAL PORT TRANSPORT FEE</th>
                                                                                        <td><?= nominalcomma($arvporttransportfeeebayipergi);?></td>
                                                                                    </tr>
                                                                                    <tr class="text-right">
                                                                                        <th class="text-right">ASURANSI</th>
                                                                                        <td><?= nominalcomma($insurancebayipergi);?></td>
                                                                                    </tr>
                                                                                    <tr class="text-right">
                                                                                        <th class="text-right">HARGA</th>
                                                                                        <td><?= nominalcomma($farebayipergi);?></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th class="text-right">TOTAL HARGA</th>
                                                                                        <th class="text-right"><?= rupiah($totalbayipergi);?></th>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <?php
                                                                }
                                                                ?>
                                                            </form>

                                                        </div>

                                                    </div>
                                                    <?php
                                                }
                                            }

                                            if($depdatekurangpergi == 0){
                                                ?>

                                                <div class="ibox-content">

                                                    <div class="row text-center">

                                                        <h1>
                                                            JADWAL KEBERANGKATAN PERGI TIDAK DITEMUKAN SETELAH TANGGAL INI
                                                        </h1><br/>
                                                        <h2>Lakukan Pencarian Jadwal Keberangkatan Pergi Kembali sebelum tanggal ini</h2><br/>
                                                        <a href="<?php echo base_url('pelni')?>"><button class="btn btn-danger">Kembali ke form pencarian</button></a>

                                                    </div>

                                                </div>

                                                <?php
                                            }

                                        }


                                    }

                                }
                                ?>


                            </div>

                            <!-- Jadwal Pulang-->
                            <div id="tab-2" class="tab-pane">


                            </div>

                        </div>

                        <?php
                    }

                }
                else{

                    if($jadwal['pergi'] == null){

                        ?>

                        <div class="ibox-content">

                            <div class="row text-center">

                                <h1>
                                    API Tidak Terkoneksi
                                </h1><br/>
                                <h2>Lakukan Pencarian Jadwal Keberangkatan Kembali</h2><br/>
                                <a href="<?php echo base_url('pelni')?>"><button class="btn btn-danger">Kembali ke form pencarian</button></a>

                            </div>

                        </div>

                        <?php

                    }
                    else{

                        $rc = $jadwal['pergi']->rc;
                        $rd = $jadwal['pergi']->rd;

                        if($rc != '00'){

                            ?>

                            <div class="ibox-content">

                                <div class="row text-center">

                                    <h1>
                                        Terjadi error pada API
                                    </h1><br/>
                                    <h2>Error API : <?php echo $rd;?></h2><br/>
                                    <h2>Lakukan Pencarian Jadwal Keberangkatan Kembali</h2><br/>
                                    <a href="<?php echo base_url('pelni')?>"><button class="btn btn-danger">Kembali ke form pencarian</button></a>

                                </div>

                            </div>

                            <?php

                        }else{

                            $jumlahjadwal = count($jadwal['pergi']->data);

                            if($jumlahjadwal == 0){

                                ?>

                                <div class="ibox-content">

                                    <div class="row text-center">

                                        <h1>
                                            JADWAL KEBERANGKATAN TIDAK DITEMUKAN
                                        </h1><br/>
                                        <h2>Lakukan Pencarian Jadwal Keberangkatan Kembali</h2><br/>
                                        <a href="<?php echo base_url('pelni')?>"><button class="btn btn-danger">Kembali ke form pencarian</button></a>

                                    </div>

                                </div>

                                <?php

                            }
                            else {

                                ?>

                                <!--form jadwal kapal-->
                                <input type="hidden" id="jumlahjadwal" value="<?= $jumlahjadwal;?>">
                                <?php
                                $depdatekurang = 0;
                                for ($x = 0; $x < $jumlahjadwal; $x++) {
                                    $depdate = $jadwal['pergi']->data[$x]->DEP_DATE;
                                    $newdepdate = date('Y-m-d',strtotime($depdate));
                                    $expnewdepdate = explode('-', $newdepdate);
                                    $newdepdateindo = hari($newdepdate).', '.$expnewdepdate[2] . ' ' . bulan($expnewdepdate[1]) . ' ' .$expnewdepdate[0];
                                    $deptime = $jadwal['pergi']->data[$x]->DEP_TIME;
                                    $chunks = str_split($deptime, 2);
                                    $deptime = implode(':', $chunks);

                                    $arvdate = $jadwal['pergi']->data[$x]->ARV_DATE;
                                    $newarvdate = date('Y-m-d',strtotime($arvdate));
                                    $expnewarvdate = explode('-', $newarvdate);
                                    $newarvdateindo = hari($newarvdate).', '.$expnewarvdate[2] . ' ' . bulan($expnewarvdate[1]) . ' ' .$expnewarvdate[0];
                                    $arvtime = $jadwal['pergi']->data[$x]->ARV_TIME;
                                    $chunks = str_split($arvtime, 2);
                                    $arvtime = implode(':', $chunks);

                                    $shipno = $jadwal['pergi']->data[$x]->SHIP_NO;
                                    $shipname = $jadwal['pergi']->data[$x]->SHIP_NAME;

                                    $route = $jadwal['pergi']->data[$x]->ROUTE;
                                    $exproute = explode('-',$route);
                                    $jmlroute = count($exproute);

                                    if($newdepdate >= $tglpergidb) {

                                        $depdatekurang = $depdatekurang + 1;

                                        $labelrute = array();

                                        for($y = 0; $y < $jmlroute; $y++){
                                            $rute = $exproute[$y];
                                            $exprute = explode('/',$rute);
                                            $coderute = $exprute[0];
                                            $tiperute = $exprute[1];

                                            for($z = 0; $z<count($kode->data); $z++){
                                                $namarute = $kode->data[$z]->NAME;
                                                $koderute = $kode->data[$z]->CODE;
                                                if($y==0){
                                                    $namarute = '<b>'.$namarute.'</b>';
                                                }
                                                if($y==($jmlroute-1)){
                                                    $namarute = '<b>'.$namarute.'</b>';
                                                }
                                                if($coderute == $koderute){
                                                    array_push($labelrute,$namarute);
                                                }
                                            }
                                        }

                                        $label = implode(" <i class='fa fa-arrow-right'></i> ",$labelrute);

                                        ?>
                                        <div class="ibox float-e-margins">

                                            <div class="ibox-title red-bg">
                                            <?php echo 'Berangkat : '.$newdepdateindo.' ('.$deptime.') - Tiba : '.$newarvdateindo.' ('.$arvtime.')';?>
                                        </div>
                                            <div class="ibox-content" style="margin-bottom: 10px; padding-top: 10px;">
                                            <h2><?= $shipno.' - '.$shipname;?></h2>
                                            <hr/>
                                            <div style="text-align: justify">
                                                <Text style="font-size: 14px;"><?= 'Rute : '.$label;?></Text>
                                            </div>
                                            <hr/>
                                            <form class="form-horizontal">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2"> Pilih Kelas </label>
                                                    <div class="col-sm-5">
                                                        <?php
                                                        $fares= $jadwal['pergi']->data[$x]->fares;
                                                        $idselect = 'kelas'.$x;
                                                        $jmlfares = count($fares);
                                                        ?>
                                                        <select class="form-control" name="kelas" id="<?= $idselect;?>" onchange="showhargakelas(this)">
                                                            <?php
                                                            for($i=0; $i<$jmlfares; $i++){
                                                                $subclass = $fares[$i]->SUBCLASS;
                                                                $class = $fares[$i]->CLASS;
                                                                $availabilityf = $fares[$i]->AVAILABILITY->F;
                                                                $availabilitym = $fares[$i]->AVAILABILITY->M;
                                                                $value = $x.'/'.$fares[$i]->CLASS.' - '.$fares[$i]->SUBCLASS.'/'.$jmlfares.'/'.$i;
                                                                $labelclass = 'KELAS '.$class.' - '.$subclass.', Sisa Kursi (W = '. $availabilityf .', P = '.$availabilitym.')';
                                                                ?>
                                                                <option value="<?= $value;?>"><?= $labelclass;?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-5"></div>
                                                </div>
                                                <hr>
                                                <?php
                                                $namakelas = $fares[0]->CLASS.' - '.$fares[0]->SUBCLASS;
                                                $namaspan = 'span'.$x;
                                                ?>
                                                <h3>Harga sesuai kelas : KELAS <span id="<?=$namaspan;?>"><?= $namakelas;?></span></h3>
                                                <?php
                                                for($i=0; $i<$jmlfares; $i++) {
                                                    $portpass = $fares[$i]->FARE_DETAIL->A->PORT_PASS;
                                                    $arvporttransportfeee = $fares[$i]->FARE_DETAIL->A->ARV_PORT_TRANSPORT_FEE;
                                                    $depporttransportfeee = $fares[$i]->FARE_DETAIL->A->DEP_PORT_TRANSPORT_FEE;
                                                    $insurance = $fares[$i]->FARE_DETAIL->A->INSURANCE;
                                                    $fare = $fares[$i]->FARE_DETAIL->A->FARE;
                                                    $total = $fares[$i]->FARE_DETAIL->A->TOTAL;

                                                    $portpassbayi = $fares[$i]->FARE_DETAIL->I->PORT_PASS;
                                                    $arvporttransportfeeebayi = $fares[$i]->FARE_DETAIL->I->ARV_PORT_TRANSPORT_FEE;
                                                    $depporttransportfeeebayi = $fares[$i]->FARE_DETAIL->I->DEP_PORT_TRANSPORT_FEE;
                                                    $insurancebayi = $fares[$i]->FARE_DETAIL->I->INSURANCE;
                                                    $farebayi = $fares[$i]->FARE_DETAIL->I->FARE;
                                                    $totalbayi = $fares[$i]->FARE_DETAIL->I->TOTAL;

                                                    $idtable = 'table'.$x.''.$i;

                                                    if ($i == 0) {
                                                        $display = 'block';
                                                    } else {
                                                        $display = 'none';
                                                    }
                                                    ?>

                                                    <div id="<?= $idtable;?>" class="<?= $idtable;?> form-group" style="display: <?= $display;?>">
                                                        <div class="col-sm-6 text-center">
                                                            <text class="text-center" style="font-weight: bold;"> Tarif Tiket Dewasa </text>
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-hover" style="font-size: 12px;">
                                                                    <tr class="text-right">
                                                                        <th class="text-right">PORT PASS</th>
                                                                        <td><?= nominalcomma($portpass);?></td>
                                                                    </tr>
                                                                    <tr class="text-right">
                                                                        <th class="text-right">DEPARTURE PORT TRANSPORT FEE</th>
                                                                        <td><?= nominalcomma($depporttransportfeee);?></td>
                                                                    </tr>
                                                                    <tr class="text-right">
                                                                        <th class="text-right">ARRRIVAL PORT TRANSPORT FEE</th>
                                                                        <td><?= nominalcomma($arvporttransportfeee);?></td>
                                                                    </tr>
                                                                    <tr class="text-right">
                                                                        <th class="text-right">ASURANSI</th>
                                                                        <td><?= nominalcomma($insurance);?></td>
                                                                    </tr>
                                                                    <tr class="text-right">
                                                                        <th class="text-right">HARGA</th>
                                                                        <td><?= nominalcomma($fare);?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="text-right">TOTAL HARGA</th>
                                                                        <th class="text-right"><?= rupiah($total);?></th>
                                                                    </tr>
                                                                </table>

                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 text-center">
                                                            <text class="text-center" style="font-weight: bold;"> Tarif Tiket Bayi </text>
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-hover" style="font-size: 12px;">
                                                                    <tr class="text-right">
                                                                        <th class="text-right">PORT PASS</th>
                                                                        <td><?= nominalcomma($portpassbayi);?></td>
                                                                    </tr>
                                                                    <tr class="text-right">
                                                                        <th class="text-right">DEPARTURE PORT TRANSPORT FEE</th>
                                                                        <td><?= nominalcomma($depporttransportfeeebayi);?></td>
                                                                    </tr>
                                                                    <tr class="text-right">
                                                                        <th class="text-right">ARRRIVAL PORT TRANSPORT FEE</th>
                                                                        <td><?= nominalcomma($arvporttransportfeeebayi);?></td>
                                                                    </tr>
                                                                    <tr class="text-right">
                                                                        <th class="text-right">ASURANSI</th>
                                                                        <td><?= nominalcomma($insurancebayi);?></td>
                                                                    </tr>
                                                                    <tr class="text-right">
                                                                        <th class="text-right">HARGA</th>
                                                                        <td><?= nominalcomma($farebayi);?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="text-right">TOTAL HARGA</th>
                                                                        <th class="text-right"><?= rupiah($totalbayi);?></th>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <?php
                                                }
                                                ?>
                                            </form>

                                        </div>

                                        </div>
                                        <?php
                                    }
                                }

                                if($depdatekurang == 0){
                                    ?>

                                    <div class="ibox-content">

                                        <div class="row text-center">

                                            <h1>
                                                JADWAL KEBERANGKATAN TIDAK DITEMUKAN SETELAH TANGGAL INI
                                            </h1><br/>
                                            <h2>Lakukan Pencarian Jadwal Keberangkatan Kembali sebelum tanggal ini</h2><br/>
                                            <a href="<?php echo base_url('pelni')?>"><button class="btn btn-danger">Kembali ke form pencarian</button></a>

                                        </div>

                                    </div>

                                    <?php
                                }
                            }

                        }

                    }

                }

                ?>

        </div>
        <div class="col-lg-2"></div>
    </div>

</div>

<!-- /content -->


</div>
