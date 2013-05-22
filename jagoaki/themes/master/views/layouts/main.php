<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>Admin Home Page</title>
	<?php
	  $baseUrl = Yii::app()->theme->baseUrl; 
	  //$cs = Yii::app()->getClientScript();
	  //Yii::app()->clientScript->registerCoreScript('jquery');
	?>
	
    <!-- the styles -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="<?php echo $baseUrl; ?>/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="<?php echo $baseUrl; ?>/assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
       
        <script src="<?php echo $baseUrl; ?>/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
       
       
    </head>
    
    <body>
        <div class="navbar navbar-fixed-top">
            <?php include 'tpl_navigation.php'; ?>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span3" id="sidebar">
                    <?php include 'right_side.php'; ?>
                </div>
                
                <!--/span-->
                <div class="span9" id="content">
                    <div class="row-fluid">
                        <?php echo $content; ?>
						
						<?php
							/*
							if(Yii::app()->controller->id!='site'){
							$this->widget('ext.timeout-dialog.ETimeoutDialog', array(
								// Get timeout settings from session settings.
								//'timeout' => Yii::app()->getSession()->getTimeout(),
								// Uncomment to test.
								// Dialog should appear 20 sec after page load.
								'timeout' => 300,
								'keep_alive_url' => $this->createUrl('site/keepalive'),
								'logout_redirect_url' => $this->createUrl('site/logout'),
							));
							}
							*/
						?>
                    </div>
                </div>
            </div>
            <hr>
            <footer>
                <p>&copy; Jago Aki 2013</p>
            </footer>
        </div>
        <!--/.fluid-container-->
        <script src="<?php echo $baseUrl; ?>/vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script src="<?php echo $baseUrl; ?>/assets/scripts.js"></script>
        <script>
        $(function() {
            // Easy pie charts
            $('.chart').easyPieChart({animate: 1000});
        });
        </script>
    </body>

</html>