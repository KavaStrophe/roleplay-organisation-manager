<script>	
		$(document).ready(function(){
			<?php if (isset($hide) && $hide===true) { ?>
				$("#<?= 'h' . $tableid ?>").hide();
			<?php } ?>
	    	$("#<?= 'b'. $tableid ?>").click(function(){
				$("#<?= 'h' . $tableid ?>").slideToggle();
    		});
   
		});
	
</script>
<?php 
	if(!isset($showNumber))
		$showNumber = true;
	if(!isset($showOption))
		$showOption = true;
	if(!isset($showFilter))
		$showFilter = true;
	if(!isset($showConvert))
		$showConvert = true;
	if(!isset($showSelect))
		$showSelect = true;
?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 containerTable" style="overflow-x:auto;" id="<?= $tableid ?>">
<h3 id="<?= 'b' . $tableid ?>"><?= __($tabletitle) ?></h3>
	<div id="<?= 'h' . $tableid ?>">
    <div class= "buttonActionTop" >
    
    	<div class="<?php if(!$showNumber){echo 'invisible';} ?>">    
    		<div>Afficher</div>    
    		<div>
    		<select class="pageSizeSelected" id="<?= $tableid ?>PageSizeSelected">
    			<option value=10>10</option>
    			<option value=25>25</option>
    			<option value=50>50</option>
    			<option value=100>100</option>
    		</select>
    		</div> 
    	</div>  
    	
    	<div class="buttonTopRight <?php if(!$showOption){echo 'invisible';} ?> ">
    		<div class="dropdown  <?php if(!$showSelect){echo 'invisible';} ?>">
	  			<button class="buttonAction" type="button" data-toggle="dropdown">Select
	  				<span class="caret"></span>
	  			</button>
	  				<ul class="dropdown-menu">
	  					<li class="helpTrigger" id="<?= $tableid ?>SelectVisible" >Select Visible
	  					<span class='helpBox'>Sélectionne toutes les lignes visibles sur cette page du tableau.</span></li>
	  					<li class="helpTrigger" id="<?= $tableid ?>SelectInvertVisible" >Invert Select Visible
	  					<span class='helpBox'>Inverse la sélection sur toutes les lignes visibles sur cette page du tableau.</span></li>
	    				<li class="helpTrigger" id="<?= $tableid ?>SelectAll" >Select All
	    				<span class='helpBox'>Sélectionne toutes les lignes de toutes les pages du tableau.</span></li>    				    				
						<li class="helpTrigger" id="<?= $tableid ?>SelectNone">Deselect All
						<span class='helpBox'>Désélectionne toutes les lignes de toutes les pages du tableau.</span></li>
						<li class="helpTrigger" id="<?= $tableid ?>SelectInv" >Invert Select
						<span class='helpBox'>Inverse la sélection sur toutes les lignes de toutes les pages du tableau.</span></li>		
	  				</ul>
			</div>
			<div class="convertToCsv <?php if(!$showConvert){echo 'invisible';} ?>">
				<div class="dropdown">
  					<button class="buttonAction" type="button" data-toggle="dropdown">CSV
  						<span class="caret"></span>
  					</button>
  					<ul class="dropdown-menu">
    					<li  class="helpTrigger" id="<?= $tableid ?>CsvOnePage" >Csv
    					<span class='helpBox'>Exporte toute la page actuelle du tableau sous format CSV</span></li>
    					<li  class="helpTrigger" id="<?= $tableid ?>CsvSelected" >CsvSelected
    					<span class='helpBox'>Exporte toutes les lignes sélectionnées de toutes les pages du tableau sous format CSV.</span></li>
    					<li  class="helpTrigger" id="<?= $tableid ?>CsvAll" >CsvAll
    					<span class='helpBox'>Exporte toutes les lignes de toutes les pages du tableau sous format CSV.</span></li>	
  					</ul>
				</div> 				
			</div>
			<?php 
			/*if(isset($isDelete)){
				if($isDelete == true){
					echo '<div class="dropdown">';
					echo '<button class="buttonAction" type="button" id="'. $tableid .'delete" data-toggle="dropdown">DoSomething';
					echo '<span class="caret"></span>';
					echo '</button>';
					echo '</div>';
				}
			}	*/
			?>	
			<div class="columnFilter <?php if(!$showFilter){echo 'invisible';} ?>" id = "<?= $tableid ?>ColumnFilter">
				<div class="dropdown">
					<button class="buttonAction" type="button" data-toggle="dropdown">columnFilter<span class="caret"></span></button>
					<ul class="dropdown-menu dropdownMenuWithScroll">
						
					</ul>
				</div>
			</div>							
		</div>
	</div>
