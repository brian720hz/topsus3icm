<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<title>Home</title>

<link rel="icon" href="<?php echo base_url()?>assets/backend/images/favicon.ico" type="image/x-icon">
<link href="<?php echo base_url()?>assets/backend/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
<link href="<?php echo base_url()?>assets/backend/plugins/morrisjs/morris.css" rel="stylesheet" />
<!-- Custom Css -->
<link href="<?php echo base_url()?>assets/backend/css/main.css" rel="stylesheet">
<!-- Swift Themes. You can choose a theme from css/themes instead of get all themes -->
<link href="<?php echo base_url()?>assets/backend/css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-cyan">
<!-- page loader -->
    <?php $this->load->view('Pelengkap/V_page_loader') ?>
<!-- end page loader -->

<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->



<section class="content home">
    <div class="container-fluid">

         <!-- Isi Konten -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2> Daftar Block </h2><br>
                        <a href="<?php echo site_url('Home/Tambah_block');?>">
                            <button type="button" class="btn btn-raised btn-info waves-effect"> Tambah Block</button>
                        </a>
                        <a href="<?php echo site_url('Home/Check');?>">
                            <button type="button" class="btn btn-raised btn-info waves-effect"> Check</button>
                        </a>
                        <a href="<?php echo site_url('Home/Restore');?>">
                            <button type="button" class="btn btn-raised btn-info waves-effect"> Restore</button>
                        </a>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th style="text-align: center;">No</th>
                                <th style="text-align: center;">Timestamp</th>
                                <th style="text-align: center;">Data</th>
                                <th style="text-align: center;">Hash</th>
                                <th style="text-align: center;">Prevhash</th>
                                <th style="text-align: center;">Status</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 0;
                                    foreach($block as $p) :
                                        $timestamp_old = $p['timestamp_data'];
                                        $timestamp = date('d-m-Y h:i:s', strtotime($timestamp_old));
                                        $data = $p['data'];
                                        $hash = $p['hash'];
                                        $prevhash = $p['prevhash'];
                                        $status = $p['status'];

                                        if($no > 0){
                                ?>
                                <tr>
                                    <td style="text-align: center; padding-top: 2em;"><?php echo $no; ?></td>
                                    <td style="text-align: center; padding-top: 2em;"><?php echo $timestamp; ?></td>
                                    <td style="text-align: center; padding-top: 2em;"><?php echo $data; ?></td>
                                    <td style="text-align: center; padding-top: 2em;"><?php echo $hash; ?></td>
                                    <td style="text-align: center; padding-top: 2em;"><?php echo $prevhash; ?></td>
                                    <?php
                                        if($status == 'Valid')
                                        {  
                                    ?>
                                        <td style="text-align: center; padding-top: 2em; color: green;"><b><?php echo $status; ?></b></td>
                                    <?php } else { ?>
                                        <td style="text-align: center; padding-top: 2em; color: red;"><b><?php echo $status; ?></b></td>
                                    <?php } ?>
                                </tr>
                                <?php 
                                    }
                                    $no++;
                                    endforeach;  
                                ?>
                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Isi Konten -->
    </div>
</section>

<div class="color-bg"></div>
<!-- Jquery Core Js --> 
<script src="<?php echo base_url()?>assets/backend/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
<script src="<?php echo base_url()?>assets/backend/bundles/morphingsearchscripts.bundle.js"></script> <!-- morphing search Js --> 
<script src="<?php echo base_url()?>assets/backend/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="<?php echo base_url()?>assets/backend/plugins/jquery-sparkline/jquery.sparkline.min.js"></script> <!-- Sparkline Plugin Js -->
<script src="<?php echo base_url()?>assets/backend/plugins/chartjs/Chart.bundle.min.js"></script> <!-- Chart Plugins Js --> 

<script src="<?php echo base_url()?>assets/backend/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
<script src="<?php echo base_url()?>assets/backend/bundles/morphingscripts.bundle.js"></script><!-- morphing search page js --> 
<script src="<?php echo base_url()?>assets/backend/js/pages/index.js"></script>
<script src="<?php echo base_url()?>assets/backend/js/pages/charts/sparkline.min.js"></script>
</body>
</html>