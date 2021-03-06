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

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>&nbsp;</h2>
        <ol class="breadcrumb">
            <li class="active">
                <a href="#">Selamat Datang, di Aplikasi KLIK MPAY <?php echo $nama_lembaga; ?></a>
            </li>
        </ol>
    </div>
</div>

<!-- Content -->

<div class="wrapper wrapper-content  animated fadeInRight article" style="margin-top: 10px;">

    <div class="row">

        <div class="col-lg-1"></div>
        <div class="col-lg-10">

            <div class="carousel slide" id="carousel2">
                <ol class="carousel-indicators">
                    <li data-slide-to="0" data-target="#carousel2" class="active"></li>
                    <li data-slide-to="1" data-target="#carousel2"></li>
                    <li data-slide-to="2" data-target="#carousel2" class=""></li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active">
                        <img alt="image" class="img-responsive" style="width: 100%; height: 50%;" src="<?php echo base_url();?>assets/img/p_big1.jpg">
                        <div class="carousel-caption">
                            <p>Caption 1</p>
                        </div>
                    </div>
                    <div class="item ">
                        <img alt="image" class="img-responsive" style="width: 100%; height: 50%;" src="<?php echo base_url();?>assets/img/p_big3.jpg">
                        <div class="carousel-caption">
                            <p>Caption 2</p>
                        </div>
                    </div>
                    <div class="item">
                        <img alt="image" class="img-responsive" style="width: 100%; height: 50%;" src="<?php echo base_url();?>assets/img/p_big2.jpg">
                        <div class="carousel-caption">
                            <p>Caption 3</p>
                        </div>
                    </div>
                </div>
                <a data-slide="prev" href="#carousel2" class="left carousel-control">
                    <span class="icon-prev"></span>
                </a>
                <a data-slide="next" href="#carousel2" class="right carousel-control">
                    <span class="icon-next"></span>
                </a>
            </div>

        </div>
        <div class="col-lg-1"></div>

    </div>

    <div class="row" style="margin-top: 20px;">

        <div class="col-lg-1"></div>

        <?php
        if($this->session->userdata('user_level')==0) {
            ?>

                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-info pull-right">Total</span>
                            <h5>Transaksi Deposit Saldo</h5>
                        </div>
                        <div class="ibox-content" style="padding-top: 20px;">
                            <h1 class="no-margins"><?php echo $jumlah_transaksi_deposit?></h1>
                            <div class="stat-percent font-bold text-info">
                                <a href="<?php echo base_url('Deposit/deposit') ?>">
                                <button class="btn btn-info">Click Here</button>
                                </a>
                            </div>
                            <small style="color: #ed5565;"><?php echo $jumlah_konfirmasi_topupsaldo?> Perlu Dikonfirmasi</small>
                        </div>
                    </div>
                </div>

            <?php
        }
        ?>

        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right">Today</span>
                    <h5>Jumlah Transaksi</h5>
                </div>
                <div class="ibox-content" style="padding-top: 20px;">
                    <h1 class="no-margins"><?php echo $transaction_today?></h1>
                    <small>New Orders</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right">Monthly</span>
                    <h5>Jumlah Transaksi</h5>
                </div>
                <div class="ibox-content" style="padding-top: 20px;">
                    <h1 class="no-margins"><?php echo $transaction_month?></h1>
                    <small>New Orders</small>
                </div>
            </div>
        </div>

    </div>

    <div class="row" style="margin-top: 20px;">

        <div class="col-lg-1"></div>

        <div class="col-lg-2">

            <h2>Produk Digital</h2>
            <div class="tooltip-demo">
                <a href="<?php echo base_url('pesawat')?>">
                    <button class="btn btn-danger btn-circle btn-lg btn-outline" type="button" data-toggle="tooltip" data-placement="top" title="Pesan Tiket Pesawat"><i class="fa fa-plane"></i></button>
                </a>
                <a href="<?php echo base_url('kereta')?>">
                    <button class="btn btn-danger btn-circle btn-lg btn-outline" type="button" data-toggle="tooltip" data-placement="top" title="Pesan Tiket Kereta"><i class="fa fa-train"></i></button>
                </a>
                <a href="<?php echo base_url('hotel')?>">
                    <button class="btn btn-danger btn-circle btn-lg btn-outline" type="button" data-toggle="tooltip" data-placement="top" title="Booking Hotel"><i class="fa fa-hotel"></i></button>
                </a>
                <a href="<?php echo base_url('pelni')?>">
                    <button class="btn btn-danger btn-circle btn-lg btn-outline" type="button" data-toggle="tooltip" data-placement="top" title="Pesan Tiket PELNI"><i class="fa fa-ship"></i></button>
                </a>
                <a href="<?php echo base_url('bus')?>">
                    <button class="btn btn-danger btn-circle btn-lg btn-outline" type="button" data-toggle="tooltip" data-placement="top" title="Pesan Tiket Bus"><i class="fa fa-bus"></i></button>
                </a>
                <a href="<?php echo base_url('wisata')?>">
                    <button class="btn btn-danger btn-circle btn-lg btn-outline" type="button" data-toggle="tooltip" data-placement="bottom" title="Cari Tempat Wisata"><i class="fa fa-snowflake-o"></i></button>
                </a>
            </div>
        </div>

        <div class="col-lg-8">

            <h2>Produk PPOB</h2>

            <div class="table-responsive">

                <table class="table no-borders table-menu-ppob">

                    <tr class="no-borders">
                        <td class="no-borders no-padding no-margins">

                            <a href="<?php echo base_url('pulsa') ?>">
                                <button type="button" class="btn btn-outline btn-danger" style="width: 100%; text-align: left;">
                                    <i class="fa fa-signal fa-2x col-lg-1 col-xs-1" style="padding-left: 0px;"> </i>
                                    <text class="col-lg-10 col-xs-10" style="margin-top: 3px; padding-left: 20px;">Pulsa & Data</text>
                                </button>
                            </a>

                        </td>
                        <td class="no-borders no-padding no-margins">

                            <a href="<?php echo base_url('ppob?tab=1') ?>">
                                <button type="button" class="btn btn-outline btn-danger" style="width: 100%; text-align: left;">
                                    <i class="fa fa-mobile-phone fa-2x col-lg-1 col-xs-1" style="padding-left: 0px;"> </i>
                                    <text class="col-lg-10 col-xs-10" style="margin-top: 3px; padding-left: 20px;">Pasca Bayar</text>
                                </button>
                            </a>

                        </td>
                        <td class="no-borders no-padding no-margins">

                            <a href="<?php echo base_url('ppob?tab=1') ?>">
                                <button type="button" class="btn btn-outline btn-danger" style="width: 100%; text-align: left;">
                                    <i class="fa fa-lightbulb-o fa-2x col-lg-1 col-xs-1" style="padding-left: 0px;"></i>
                                    <text class="col-lg-10 col-xs-10" style="margin-top: 3px; padding-left: 20px;">Listrik PLN</text>
                                </button>
                            </a>

                        </td>
                        <td class="no-borders no-padding no-margins">

                            <a href="<?php echo base_url('ppob?tab=3') ?>">
                                <button type="button" class="btn btn-outline btn-danger" style="width: 100%; text-align: left;">
                                    <i class="fa fa-tint fa-2x col-lg-1 col-xs-1" style="padding-left: 0px;"></i>
                                    <text class="col-lg-10 col-xs-10" style="margin-top: 3px; padding-left: 20px;">Air PDAM</text>
                                </button>
                            </a>

                        </td>
                    </tr>
                    <tr class="no-borders">
                        <td class="no-borders no-padding no-margins">

                            <a href="<?php echo base_url('ppob?tab=5') ?>">
                                <button type="button" class="btn btn-outline btn-danger" style="width: 100%; text-align: left;">
                                    <i class="fa fa-phone fa-2x col-lg-1 col-xs-1" style="padding-left: 0px;"> </i>
                                    <text class="col-lg-10 col-xs-10" style="margin-top: 3px; padding-left: 20px;">TELKOM</text>
                                </button>
                            </a>

                        </td>
                        <td class="no-borders no-padding no-margins">

                            <a href="<?php echo base_url('ppob?tab=6') ?>">
                                <button type="button" class="btn btn-outline btn-danger" style="width: 100%; text-align: left;">
                                    <i class="fa fa-fire fa-2x col-lg-1 col-xs-1" style="padding-left: 0px;"> </i>
                                    <text class="col-lg-10 col-xs-10" style="margin-top: 3px; padding-left: 20px;">Gas PGN</text>
                                </button>
                            </a>

                        </td>
                        <td class="no-borders no-padding no-margins">

                            <a href="<?php echo base_url('ppob?tab=7') ?>">
                                <button type="button" class="btn btn-outline btn-danger" style="width: 100%; text-align: left;">
                                    <i class="fa fa-video-camera fa-2x col-lg-1 col-xs-1" style="padding-left: 0px;"> </i>
                                    <text class="col-lg-10 col-xs-10" style="margin-top: 3px; padding-left: 20px;">TV Kabel</text>
                                </button>
                            </a>

                        </td>
                        <td class="no-borders no-padding no-margins">

                            <a href="<?php echo base_url('ppob?tab=4') ?>">
                                <button type="button" class="btn btn-outline btn-danger" style="width: 100%; text-align: left;">
                                    <i class="fa fa-gamepad fa-2x col-lg-1 col-xs-1" style="padding-left: 0px;"></i>
                                    <text class="col-lg-10 col-xs-10" style="margin-top: 3px; padding-left: 20px;">Voucher Game</text>
                                </button>
                            </a>

                        </td>
                    </tr>
                    <tr class="no-borders">
                        <td class="no-borders no-padding no-margins">

                            <a href="<?php echo base_url('ppob?tab=12') ?>">
                                <button type="button" class="btn btn-outline btn-danger" style="width: 100%; text-align: left;">
                                    <i class="fa fa-road fa-2x col-lg-1 col-xs-1" style="padding-left: 0px;"> </i>
                                    <text class="col-lg-10 col-xs-10" style="margin-top: 3px; padding-left: 20px;">E-Money</text>
                                </button>
                            </a>

                        </td>
                        <td class="no-borders no-padding no-margins">

                            <a href="<?php echo base_url('ppob?tab=8') ?>">
                                <button type="button" class="btn btn-outline btn-danger" style="width: 100%; text-align: left;">
                                    <i class="fa fa-money fa-2x col-lg-1 col-xs-1" style="padding-left: 0px;"> </i>
                                    <text class="col-lg-10 col-xs-10" style="margin-top: 3px; padding-left: 20px;">Asuransi & Finance</text>
                                </button>
                            </a>

                        </td>
                        <td class="no-borders no-padding no-margins">

                            <a href="<?php echo base_url('ppob?tab=9') ?>">
                                <button type="button" class="btn btn-outline btn-danger" style="width: 100%; text-align: left;">
                                    <i class="fa fa-cc fa-2x col-lg-1 col-xs-1" style="padding-left: 0px;"> </i>
                                    <text class="col-lg-10 col-xs-10" style="margin-top: 3px; padding-left: 20px;">Kartu Kredit</text>
                                </button>
                            </a>

                        </td>
                        <td class="no-borders no-padding no-margins">

                            <a href="<?php echo base_url('ppob?tab=10') ?>">
                                <button type="button" class="btn btn-outline btn-danger" style="width: 100%; text-align: left;">
                                    <i class="fa fa-handshake-o fa-2x col-lg-1 col-xs-1" style="padding-left: 0px;"> </i>
                                    <text class="col-lg-10 col-xs-10" style="margin-top: 3px; padding-left: 20px;">Zakat</text>
                                </button>
                            </a>

                        </td>
                    </tr>

                </table>

            </div>

        </div>

        <div class="col-lg-1"></div>

    </div>


</div>

<!-- /content -->

</div>
