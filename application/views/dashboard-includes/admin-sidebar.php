<?php $session = $this->session->userdata($data); ?>
<script type="text/javascript">
    uri_Segment = '<?php echo $this->uri->segment(1); ?>';
</script>
<div id="main" class="layout-row flex">
   <!-- ############ LAYOUT START-->
   <!-- ############ Aside START-->
   <div id="aside" class="page-sidenav no-shrink  nav-expand  animate fadeInLeft fade folded" aria-hidden="true">
      <div class="sidenav h-100 modal-dialog bg-white box-shadow">
         <!-- sidenav top -->
         <!-- Flex nav content -->
         <div class="flex scrollable hover">
            <div class="nav-border b-primary" data-nav="">
               <ul class="nav bg" id="accordion">
                  <li class="nav-header hidden-folded">
                     <span class="_fwg500_ _fs12_">Menu</span>
                  </li>
                  <li>
                     <a href="<?php echo base_url(); ?>admin/admin_dashboard" class="i-con-h-a _cmmnsdHvr_ instituteActive">
                     <span class="nav-icon">
                       <i class="i-con i-con-users _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i>
                     </span>
                     <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Dashboard</span>
                     </a>
                  </li>
                  
                  <!-- <li>
                     <a href="<?php echo base_url(); ?>admin/institute_list" class="i-con-h-a _cmmnsdHvr_ instituteActive">
                     <span class="nav-icon">
                       <i class="i-con i-con-users _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i>
                     </span>
                     <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Institute List</span>
                     </a>
                  </li> -->
                  <!-- <li>
                     <a href="#" class="i-con-h-a _cmmnsdHvr_ viewActive">
                     <span class="nav-icon">
                       <i class="i-con i-con-users _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i>
                     </span>
                     <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">View Institute</span>
                     </a>
                  </li> -->
                  <!-- <li>
                     <a href="<?php echo base_url(); ?>admin/add_institute_new" class="i-con-h-a _cmmnsdHvr_ addinstituteActive">
                     <span class="nav-icon">
                       <i class="i-con i-con-users _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i>
                     </span>
                     <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Add New Institute</span>
                     </a>
                  </li> -->
                  <!-- <li>
                     <a href="<?php echo base_url(); ?>admin/announcement" class="i-con-h-a _cmmnsdHvr_ addinstituteActive">
                     <span class="nav-icon">
                       <i class="i-con i-con-users _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i>
                     </span>
                     <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Announcement</span>
                     </a>
                  </li> -->
                  <!-- <li>
                     <a href="<?php echo base_url(); ?>admin/all_old_institute" class="i-con-h-a _cmmnsdHvr_ oldinstituteActive">
                     <span class="nav-icon">
                       <i class="i-con i-con-users _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i>
                     </span>
                     <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">All old Institute</span>
                     </a>
                  </li> -->
               </ul>
            </div>
         </div>
      </div>
   </div>
   <!-- ############ Aside END-->