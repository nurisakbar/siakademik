<?php
if($this->session->userdata('id_users')=='')
{
    redirect('auth/login');
}
?>
<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title>SI SEKOLAH</title>

        <meta name="description" content="uAdmin is a Professional, Responsive and Flat Admin Template created by pixelcave and published on Themeforest">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <meta name="viewport" content="width=device-width,initial-scale=1">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="img/favicon.ico">
        <link rel="apple-touch-icon" href="img/icon57.png" sizes="57x57">
        <link rel="apple-touch-icon" href="img/icon72.png" sizes="72x72">
        <link rel="apple-touch-icon" href="img/icon76.png" sizes="76x76">
        <link rel="apple-touch-icon" href="img/icon114.png" sizes="114x114">
        <link rel="apple-touch-icon" href="img/icon120.png" sizes="120x120">
        <link rel="apple-touch-icon" href="img/icon144.png" sizes="144x144">
        <link rel="apple-touch-icon" href="img/icon152.png" sizes="152x152">
        <!-- END Icons -->

        <style>
		.btn-file {
		    position: relative;
		    overflow: hidden;
		}
		.btn-file input[type=file] {
		    position: absolute;
		    top: 0;
		    right: 0;
		    min-width: 100%;
		    min-height: 100%;
		    font-size: 999px;
		    text-align: right;
		    filter: alpha(opacity=0);
		    opacity: 0;
		    background: red;
		    cursor: inherit;
		    display: block;
		}
		input[readonly] {
			background-color: white !important;
			cursor: text !important;
		}
	</style>
        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="<?php echo base_url()?>uadmin/css/bootstrap.css">

        <!-- Related styles of various javascript plugins -->
        <link rel="stylesheet" href="<?php echo base_url()?>uadmin/css/plugins.css">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="<?php echo base_url()?>uadmin/css/main.css">

        <!-- Load a specific file here from css/themes/ folder to alter the default theme of the template -->

        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <link rel="stylesheet" href="<?php echo base_url()?>uadmin/css/themes.css">
        <!-- END Stylesheets -->

        <!-- Modernizr (browser feature detection library) & Respond.js (Enable responsive CSS code on browsers that don't support it, eg IE8) -->
        <script src="<?php echo base_url()?>uadmin/js/vendor/modernizr-2.7.1-respond-1.4.2.min.js"></script>
    </head>

    <!-- Add the class .fixed to <body> for a fixed layout on large resolutions (min: 1200px) -->
    <!-- <body class="fixed"> -->
    <body>
        <!-- Page Container -->
        <div id="page-container">
            <!-- Header -->
            <!-- Add the class .navbar-fixed-top or .navbar-fixed-bottom for a fixed header on top or bottom respectively -->
            <!-- <header class="navbar navbar-inverse navbar-fixed-top"> -->
            <!-- <header class="navbar navbar-inverse navbar-fixed-bottom"> -->
            <header class="navbar navbar-inverse">
                <!-- Mobile Navigation, Shows up  on smaller screens -->
                <ul class="navbar-nav-custom pull-right hidden-md hidden-lg">
                    <li class="divider-vertical"></li>
                    <li>
                        <!-- It is set to open and close the main navigation on smaller screens. The class .navbar-main-collapse was added to aside#page-sidebar -->
                        <a href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-main-collapse">
                            <i class="fa fa-bars"></i>
                        </a>
                    </li>
                </ul>
                <!-- END Mobile Navigation -->

                <!-- Logo -->
                <a href="index.html" class="navbar-brand"><img src="<?php echo base_url()?>uadmin/img/template/logo.png" alt="logo"></a>

                <!-- Loading Indicator, Used for demostrating how loading of widgets could happen, check main.js - uiDemo() -->
                <div id="loading" class="pull-left"><i class="fa fa-certificate fa-spin"></i></div>

                <!-- Header Widgets -->
                <!-- You can create the widgets you want by replicating the following. Each one exists in a <li> element -->
                <ul id="widgets" class="navbar-nav-custom pull-right">
                    <!-- Just a divider -->
                    <li class="divider-vertical"></li>

                    <!-- RSS Widget -->
                    <!-- Add .dropdown-left-responsive class to align the dropdown menu left (so its visible on mobile) -->
                    <li id="rss-widget" class="dropdown dropdown-left-responsive">
                        
                        <!-- By adding the class .widget-fluid, dropdown width will be set to auto with min value 180px and max value 250px -->
                        
                    </li>
                    <!-- END RSS Widget -->

                    <li class="divider-vertical"></li>

                    

                    <li class="divider-vertical"></li>

                   
                    <!-- END Notifications Widget -->

                    <li class="divider-vertical"></li>

                    <!-- User Menu -->
                    <li class="dropdown pull-right dropdown-user">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo base_url()?>uadmin/img/template/avatar.png" alt="avatar"> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <!-- Just a button demostrating how loading of widgets could happen, check main.js- - uiDemo() -->
                            <li>
                                
                                <?php echo anchor('users/profile',"<i class='fa fa-user'></i>Profile ")?>
                            </li>
   
                            <li class="divider"></li>

                            <li><?php echo anchor('auth/logout',"<i class='fa fa-lock'></i>".' Logout');?></li>
                        </ul>
                    </li>
                    <!-- END User Menu -->
                </ul>
                <!-- END Header Widgets -->
            </header>
            <!-- END Header -->

            <!-- Inner Container -->
            <div id="inner-container">
                <!-- Sidebar -->
                <aside id="page-sidebar" class="collapse navbar-collapse navbar-main-collapse">
                    <!-- Sidebar search -->
                    <form id="sidebar-search" action="page_search_results.html" method="post">
                        
                    </form>
                    <!-- END Sidebar search -->

                    <!-- Primary Navigation -->
                    <nav id="primary-nav">
                        <ul>
                            <!-- END Sidebar search
                            <li>
                                <a href="<?php echo base_url();?>dashboard"><i class="fa fa-fire"></i>DASHBOARD</a>
                            </li>
                             -->
                            <?php
                            $mainmenu=$this->db->get_where('mainmenu',array('aktif'=>'y'))->result();
                            foreach ($mainmenu as $m)
                            {
                                // chek ada submenu atau tidak
                                $submenu=$this->db->get_where('submenu',array('id_mainmenu'=>$m->id_mainmenu,'aktif'=>'y'));
                                if($submenu->num_rows()>0)
                                {
                                    echo "<li>".  anchor($m->link,  '<i class="'.$m->icon.'"></i>'.strtoupper($m->nama_mainmenu))."";
                                    echo"<ul>";
                                    // tampilkan submenu
                                    foreach ($submenu->result() as $s)
                                    {
                                         echo "<li>".  anchor($s->link,  '<i class="'.$s->icon.'"></i>'.strtoupper($s->nama_submenu))."</li>";
                                    }
                                    echo"</ul></li>";
                                    
                                }
                                else
                                {
                                    // tampilkan main menu
                                    echo "<li>".  anchor($m->link,  '<i class="'.$m->icon.'"></i>'.strtoupper($m->nama_mainmenu))."</li>";
                                }   
                            }
                            ?>

                            
                            
                    </nav>
                    <!-- END Primary Navigation -->

                    <!-- Demo Theme Options -->
                    <div id="theme-options" class="text-left visible-md visible-lg">
                        <a href="<?php echo base_url()?>auth/logout" class="btn btn-theme-options"><i class="fa fa-lock"></i> Logout</a>
                       
                    </div>
                    <!-- END Demo Theme Options -->
                </aside>
                <!-- END Sidebar -->

                <!-- Page Content -->
                <div id="page-content">
                    <!-- Navigation info -->
                    <ul id="nav-info" class="clearfix">
                        <li><a href="index.html"><i class="fa fa-home"></i></a></li>
                        <li><a href="javascript:void(0)">Tables</a></li>
                        <li class="active"><a href="">DataTables</a></li>
                    </ul>
                    <!-- END Navigation info -->
                    
                   
                    
                    
                    
                    
                     <?php echo $contents; ?>       
    

                   
                </div>
                <!-- END Page Content -->
<div style="clear: both"></div>
                <!-- Footer -->
                <footer>
                    2014 &copy; <strong><a href="http://goo.gl/9QhXQ">Sistem Informasi Sekolah Ver 0.1 Beta</a></strong>  -  SMPIT BINA INSAN UNGGUL
                </footer>
                <!-- END Footer -->
            </div>
            <!-- END Inner Container -->
        </div>
        <!-- END Page Container -->

        <!-- Scroll to top link, check main.js - scrollToTop() -->
        <a href="javascript:void(0)" id="to-top"><i class="fa fa-chevron-up"></i></a>

        <!-- User Modal Settings, appears when clicking on 'User Settings' link found on user dropdown menu (header, top right) -->
        <div id="modal-user-settings" class="modal">
            <!-- Modal Dialog -->
            <div class="modal-dialog">
                <!-- Modal Content -->
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4>Profile Settings</h4>
                    </div>
                    <!-- END Modal Header -->

                    <!-- Modal Content -->
                    <div class="modal-body">
                        <!-- Tab links -->
                        <ul id="example-user-tabs" class="nav nav-tabs" data-toggle="tabs">
                            <li class="active"><a href="#example-user-tabs-account"><i class="fa fa-cogs"></i> Account</a></li>
                            <li><a href="#example-user-tabs-profile"><i class="fa fa-user"></i> Profile</a></li>
                        </ul>
                        <!-- END Tab links -->

                        <!-- END Tab Content -->
                        <div class="tab-content">
                            <!-- First Tab -->
                            <div class="tab-pane active" id="example-user-tabs-account">
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Success!</strong> Password changed!
                                </div>
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Username</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">administrator</p>
                                            <span class="help-block">You can't change your username!</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="example-user-pass">Password</label>
                                        <div class="col-md-9">
                                            <input type="password" id="example-user-pass" name="example-user-pass" class="form-control">
                                            <span class="help-block">if you want to change your password enter your current for confirmation!</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="example-user-newpass">New Password</label>
                                        <div class="col-md-9">
                                            <input type="password" id="example-user-newpass" name="example-user-newpass" class="form-control">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- END First Tab -->

                            <!-- Second Tab -->
                            <div class="tab-pane" id="example-user-tabs-profile">
                                <h4 class="page-header-sub">Image</h4>
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <div class="col-md-3">
                                            <img src="img/placeholders/image_dark_120x120.png" alt="image" class="img-responsive push">
                                        </div>
                                        <div class="col-md-9">
                                            <form action="index.html" class="dropzone">
                                                <div class="fallback">
                                                    <input name="file" type="file">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <form class="form-horizontal">
                                    <h4 class="page-header-sub">Details</h4>
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="example-user-firstname">Firstname</label>
                                        <div class="col-md-9">
                                            <input type="text" id="example-user-firstname" name="example-user-firstname" class="form-control" value="John">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="example-user-lastname">Lastname</label>
                                        <div class="col-md-9">
                                            <input type="text" id="example-user-lastname" name="example-user-lastname" class="form-control" value="Doe">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="example-user-gender">Gender</label>
                                        <div class="col-md-9">
                                            <select id="example-user-gender" name="example-user-gender" class="form-control">
                                                <option>Male</option>
                                                <option>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="example-user-bio">Bio</label>
                                        <div class="col-md-9">
                                            <textarea id="example-user-bio" name="example-user-bio" class="form-control textarea-elastic" rows="3">Bio Information..</textarea>
                                        </div>
                                    </div>
                                    <h5 class="page-header-sub">Social</h5>
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="example-user-fb">Facebook</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <input type="text" id="example-user-fb" name="example-user-fb" class="form-control">
                                                <span class="input-group-addon"><i class="fa fa-facebook fa-fw"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="example-user-twitter">Twitter</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <input type="text" id="example-user-twitter" name="example-user-twitter" class="form-control">
                                                <span class="input-group-addon"><i class="fa fa-twitter fa-fw"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="example-user-pinterest">Pinterest</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <input type="text" id="example-user-pinterest" name="example-user-pinterest" class="form-control">
                                                <span class="input-group-addon"><i class="fa fa-pinterest fa-fw"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="example-user-github">Github</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <input type="text" id="example-user-github" name="example-user-github" class="form-control">
                                                <span class="input-group-addon"><i class="fa fa-github fa-fw"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- END Second Tab -->
                        </div>
                        <!-- END Tab Content -->
                    </div>
                    <!-- END Modal Content -->

                    <!-- Modal footer -->
                    <div class="modal-footer remove-margin">
                        <button class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button class="btn btn-success"><i class="fa fa-spinner fa-spin"></i> Save changes</button>
                    </div>
                    <!-- END Modal footer -->
                </div>
                <!-- END Modal Content -->
            </div>
            <!-- END Modal Dialog -->
        </div>
        <!-- END User Modal Settings -->

        <!-- Excanvas for canvas support on IE8 -->
        <!--[if lte IE 8]><script src="js/helpers/excanvas.min.js"></script><![endif]-->

        <!-- Include Jquery library from Google's CDN but if something goes wrong get Jquery from local file (Remove 'http:' if you have SSL) -->
        <script src="<?php echo base_url()?>uadmin/js/jquery.min.js"></script>
        <script>!window.jQuery && document.write(unescape('%3Cscript src="js/vendor/jquery-1.11.0.min.js"%3E%3C/script%3E'));</script>

        <!-- Bootstrap.js -->
        <script src="<?php echo base_url()?>uadmin/js/vendor/bootstrap.min.js"></script>

        <!-- Jquery plugins and custom javascript code -->
        <script src="<?php echo base_url()?>uadmin/js/plugins.js"></script>
        <script src="<?php echo base_url()?>uadmin/js/main.js"></script>
                <script src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js"></script>
	<script src="<?php echo base_url();?>assets/ui/jquery.ui.core.js"></script>
	<script src="<?php echo base_url();?>assets/ui/jquery.ui.widget.js"></script>
	<script src="<?php echo base_url();?>assets/ui/jquery.ui.datepicker.js"></script>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/themes/base/jquery.ui.all.css">
        
        	<script>
	$(function() {
		$( "#datepicker" ).datepicker({
                changeMonth: true,
                dateFormat: 'yy-mm-dd',
                changeYear: true
                });

                $( "#datepicker1" ).datepicker({
                changeMonth: true,
                dateFormat: 'yy-mm-dd',
                changeYear: true
                });

                $( "#datepicker2" ).datepicker({
                changeMonth: true,
                dateFormat: 'yy-mm-dd',
                changeYear: true
                });
                $( "#datepicker3" ).datepicker({
                changeMonth: true,
                dateFormat: 'yy-mm-dd',
                changeYear: true
                });

                $( "#datepicker4" ).datepicker({
                changeMonth: true,
                dateFormat: 'yy-mm-dd',
                changeYear: true
                });
                
                $( "#datepicker5" ).datepicker({
                changeMonth: true,
                dateFormat: 'yy-mm-dd',
                changeYear: true
                });
                
                $( "#datepicker6" ).datepicker({
                changeMonth: true,
                dateFormat: 'yy-mm-dd',
                changeYear: true
                });
                
                $( "#datepicker7" ).datepicker({
                changeMonth: true,
                dateFormat: 'yy-mm-dd',
                changeYear: true
                });
	});
	</script>
        

        <!-- Javascript code only for this page -->
        <script>
            $(function() {
                /* Initialize Datatables */
                $('#example-datatables').dataTable({"aoColumnDefs": [{"bSortable": false, "aTargets": [0]}]});
                $('.dataTables_filter input').addClass('form-control').attr('placeholder', 'Search');
                 
            });
            
            
 
        </script>
    </body>
</html>