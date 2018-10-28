<div id="contentBox">
    <h2>Mes organisations</h2>
    <?php 
    if(count($myOrga) > 0):
        foreach($myOrga as $orga):
        ?>
        <div class="orgaBox" data-id="<?= $orga['id'] ?>">
        	<h3 class="orgaTitle"><?= $orga['Name_Organization']?></h3>
        	<h4 class="orgaNick"><font class="orgaLabel orgaAlias">Alias </font>" <?= $orga['Nickname_Organization']?> "</h4>
        	<p class="orgaResume"><font class="orgaLabel">Résumé : </font><?= $orga['Resume_Organization']?></p>
        </div>
        <?php 
        endforeach;
    else:
        echo "<p>Vous ne possèdez aucune organisation pour l'instant</p>";
    endif;
    ?>
    
    <h2>Organisations liées à mes personnages</h2>
    <?php 
    if(count($otherOrga) > 0):
        foreach($otherOrga as $charac):
        ?>
        <h3><?= $charac['FirstName_Character']?> <?= ['LastName_Character']?> : </h3>
        	<?php foreach($charac as $orga):?>
            <div class="orgaBox" data-id="<?= $orga['id'] ?>">
            	<h3 class="orgaTitle"><?= $orga['Name_Organization']?></h3>
            	<h4 class="orgaNick"><font class="orgaLabel orgaAlias">Alias </font>" <?= $orga['Nickname_Organization']?> "</h4>
            	<p class="orgaResume"><font class="orgaLabel">Résumé : </font><?= $orga['Resume_Organization']?></p>
            </div>
        	<?php 
            endforeach;
        endforeach;
    else:
        echo "<p>Vous ne faîtes partie d'aucune organisation pour l'instant</p>";
    endif;
    ?>
</div>
<?= $this->Html->css('orgabox') ?>
<script>
$(document).ready(function(){
	$('.orgaBox').on('click', function(){
		window.location = "/organizations/view/" + $(this).attr('data-id');
	});
});
</script>