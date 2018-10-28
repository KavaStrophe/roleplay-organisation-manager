<?php //debug($userCharac)?>
<h2>Liste des personnages</h2>
<p>Vous avez <?= count($userCharac['characters'])?> personnage<?php if(count($userCharac['characters']) != 1){echo 's';}?><button id="newCharac">Créer</button></p>

<?php 
if(count($userCharac['characters']) != 0):
    $characPNJ = array();
    $characPlay = array();
    foreach($userCharac['characters'] as $charac):
        if($charac['PNJ_Character'])
            array_push($characPNJ, $charac);
        else
            array_push($characPlay, $charac);
    endforeach;?>
    	 <h3>Mes personnages</h3>
    <?php
    if(count($characPlay) > 0):
        foreach($characPlay as $chara):
        ?>
        	<div class="charaBox" data-id="<?=  $chara['id'] ?>">
        		<div class="charaImg">
        		<?= $this->Html->image("characters/" . $chara['Img_Character'], [
                        "alt" => "Image du personage"
                    ]);
        		?>
        		</div>
        		<div class="charaContent">
        			<p class="charaData charaName">
        				<?= $chara['FirstName_Character']?> <?= $chara['LastName_Character']?>
        			</p>
        			<div class="charaInfos">
        				<div class="charaInfosLeft">
	        				<p class="charaData"><font class="charaLabel">Âge : </font><?= $chara['Old_Character'] ?> ans</p>
	        				<p class="charaData"><font class="charaLabel">Couleur de cheveux : </font><?= $chara['ColorHair_Character'] ?> </p>
	        				<p class="charaData"><font class="charaLabel">Couleur des yeux : </font><?= $chara['ColorEyes_Character'] ?> </p>
	        				<p class="charaData"><font class="charaLabel">Couleur de peau : </font><?= $chara['ColorSkin_Character'] ?> </p>
	        				<p class="charaData"><font class="charaLabel">Taille : </font><?= $chara['Height_Character'] ?> cm</p>
	        				<p class="charaData"><font class="charaLabel">Poids : </font><?= $chara['Height_Character'] ?> kg</p>
	        				<p class="charaData"><font class="charaLabel">Localisation : </font><?= $chara['Address_Character'] ?> </p>
        				</div>
        				<div class="charaInfosRight">
	        				<p class="charaData"><font class="charaLabel">Sexe : </font><?= $chara['Gender_Character'] ?> </p>
	        				<p class="charaData"><font class="charaLabel">Race : </font><?= $chara['Race_Character'] ?> </p>
	        				<p class="charaData"><font class="charaLabel">Travail : </font><?= $chara['Job_Character'] ?> </p>
	        				<p class="charaData"><font class="charaLabel">Classe : </font><?= $chara['Class_Character'] ?> </p>
	        				<p class="charaData"><font class="charaLabel">Religion : </font><?= $chara['Religion_Character'] ?> </p>
	        				<p class="charaData"><font class="charaLabel">Origine : </font><?= $chara['Origin_Character'] ?> </p>
        				
        				</div>
        			</div>
        		</div>
        	</div>
        <?php 
        endforeach;
    else:
    ?>
    	<p>Vous n'avez aucun personnage</p>
    <?php 
    endif;
    ?>
    	<h3>Mes PNJs</h3>
    <?php
    if(count($characPNJ) > 0):
        foreach($characPNJ as $chara):
        ?>
        
        <?php 
        endforeach;
    else:
    ?>
    	<p>Vous n'avez aucun PNJ</p>
    <?php 
    endif;
endif;
?>
<script>
$(document).ready(function(){
	$('.charaBox').on('click', function(){
		window.location = "/characters/view/" + $(this).attr('data-id');
	});
	redirectButton('#newCharac', '/characters/add/');
});
</script>
<?= $this->Html->css('charabox') ?>