<?php
$test=array(0=>array("url"=>"test1",
			"symbol"=>"testSymbol1",
			"name"=>"testName1",
			"subCatergory"=>array(0=>array("url"=>"test2",
									"symbol"=>"testSymbol2",
									"name"=>"testName2",
									"subCatergory"=>array(0=>array("url"=>"test4",
																	"symbol"=>"testSymbol4",
																	"name"=>"testName4",))
																	)
								)
					),
			1=>array("url"=>"test3",
			"symbol"=>"testSymbol3",
			"name"=>"testName3",
				)
			);
function writeCategory($categories){ 
	foreach($categories as $key => $category){

	?>
		<li style="background-color:#ffffff;" class="treeview rootcat categoriesNavItem" >
			<a href="<?php echo base_url($category["url"]) ?>" style="color:#348ED8" class="linky">
				<i style="color:;" class="fa <?php echo $category["symbol"] ?>"></i>
				<span style="color:#3c8dbc;"><?php echo $category["name"] ?></span>
			</a>
	<?php 
		if(isset($category["subCatergory"])){
			?>
			<ul class="treeview-menu" style="background-color:#ffffff;" hidden>
			<?php writeCategory($category["subCatergory"],"hidden"); ?>
			</ul>
		</li>
		<?php
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url("application/third_party/bootstrap-3.3.5-dist/css/bootstrap.min.css")?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url("application/third_party/startbootsrtap/css/heroic-features.css")?>" rel="stylesheet">
    <!-- Font Awesome because Awesome> !-->
    <link rel="stylesheet" href="<?php echo base_url("application/third_party/font-awesome-4.4.0/css/font-awesome.min.css")?>">
	<script src="<?php echo base_url("application/third_party/jquery-1.11.3.min.js")?>" type="text/javascript"></script>
	<script src="<?php echo base_url("application/third_party/jquery-ui-1.11.4/jquery-ui.js")?>" type="text/javascript"></script>
	<script src="<?php echo base_url("application/third_party/bootstrap-3.3.5-dist/js/bootstrap.min.js")?>" type="text/javascript"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Geen Idee</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav pull-right">
                    <li>
                        <a href="#">Winkelmandje</a>
                    </li>
                    <li>
                        <a href="#"><?php echo $accountText ?></a>
                    </li>
                    <li>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    
    
    
    <div class="container">
		<div class="row">
			<div class="box">
				<div class="box-body">
					<div class="image col-md-8">
						<p>some image here</p>
					</div>
					<div class="searchbar pull-right col-md-4">
						<form action="<?php echo base_url('index.php/products/search')?>" method="post">
							<div class="input-group">
								<input type="text" name="search" class="form-control" placeholder="Search">
								<span class="input-group-addon"><button><i class="fa fa-search"></i> </button></span>

							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- Second Navbar> !-->
		<div class="row" style="margin-top:10px">
			<nav class="navbar navbar-inverse" role="navigation">
				<div class="container">
				    <!-- Collect the nav links, forms, and other content for toggling -->
				    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				        <ul class="nav navbar-nav">
				            <li>
				                <a href="#">Some</a>
				            </li>
				            <li>
				                <a href="#">links</a>
				            </li>
				            <li>
				            	  <a href="#">here</a>
				            </li>
				        </ul>
				    </div>
				    <!-- /.navbar-collapse -->
				</div>
				<!-- /.container -->
			</nav>
		</div>
        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer" style="margin-top:10px">
            <h1>A Warm Welcome!</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
            </p>
        </header>
        
        <div class="alert <?php echo $warningClass ?>" <?php echo  ($warningVisible == true ? "" : "hidden");?>>
        	<p><?php echo $warningMessage ?></p>
        </div>
        <div class="col-md-3 categoriesNav" id="changeAble">
    		<div class="list-group" style="background-color:#ffffff;">
        		<section class="sidebar">
            		<ul class="sidebar-menu">
            			<li style="background-color: #3D6E6F" class="categoriesNavHeader">
                			<i class="fa fa-list" style="margin-left: 15px; color: white"></i> <span style="color: white;"> Categorieën</span>
                		</li>
                		<li class="categoriesNavItem">
                    		<a href="./DGMoutlet Webwinkel_files/DGMoutlet Webwinkel.html">
                        		<i class="fa fa-home" style="color:#348ED8;"></i> <span style="color:#348ED8;">Home pagina</span>
                    		</a>
                		</li>
						<?php writeCategory($test); ?>
					</ul>
        		</section>
        	</div>
        </div>


