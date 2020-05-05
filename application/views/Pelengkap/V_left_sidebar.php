<!-- Left Sidebar -->
<?php
    $account = $this->session->userdata("account");
?>
<section> 
    <aside id="leftsidebar" class="sidebar"> 
        <!-- User Info -->
        <div class="user-info">
            <center>
                <div class="admin-image"> <img src="<?php echo base_url()?>assets/backend/images/random-avatar7.jpg" alt=""> </div>
            </center>
            <div class="quick-stats">
                <h5><center>Welcome!</center></h5>
                <h5 style="font-size: 16px"><center><?php echo $account['nama_pasien']; ?></center></h5>
                
            </div>
        </div>
        <!-- #User Info --> 
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                <li class="open"><a href="<?php echo site_url('Home');?>"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>
                <li><a href="<?php echo site_url('Booking');?>"><i class="zmdi zmdi-file-text"></i><span>Booking</span></a></li>
                <li><a href="<?php echo site_url('List_booking');?>"><i class="zmdi zmdi-calendar-check"></i><span>List Booking</span></a></li>                
                <li><a href="<?php echo site_url('Setting');?>"><i class="zmdi zmdi-settings"></i><span>Setting</span></a></li>
                <li><a href="<?php echo site_url('Login/logout');?>"><i class="zmdi zmdi-sign-in"></i><span>Logout</span></a></li>   
            </ul>
        </div>
        <!-- #Menu -->
    </aside>
</section>
<!-- End Left Sidebar --> 