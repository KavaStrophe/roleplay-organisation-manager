<div class="characters form large-9 medium-8 columns content">
    <?= $this->Form->create($character, array('type' => 'file')) ?>
    <fieldset>
        <legend><?= __('Créer un nouveau personnage') ?></legend>
        <?php
            echo $this->Form->control('FirstName_Character', [
                'label' => 'Prénom',
                'required' => 'required'
            ]);
            echo $this->Form->control('LastName_Character', [
                'label' => 'Nom',
                'required' => 'required'
            ]);
            echo $this->Form->control('Old_Character', [
                'label' => 'Âge',
                'type' => 'Number',
                'required' => 'required'
            ]);
            echo $this->Form->label('gender-character', 'Sexe');
            ?>
            <br /><input id="gender_male" type="radio" value="Homme" name="Gender_Character" required="required" class="radio" /><label class="radioLabel" for="gender_male">Homme</label>
            <input id="gender_female" type="radio" value="Femme" name="Gender_Character" required="required" class="radio" /><label class="radioLabel" for="gender_female">Femme</label>
            <input id="gender_other" type="radio" value="other" name="Gender_Character" required="required" class="radio" /><label class="radioLabel" for="gender_other">Autre</label>
            <?php
            
            echo $this->Form->control('Gender_Other_Character', [
                'label' => 'Si "Autre"',
                'placeholder' => 'No more futa plz...'
            ]);
            ?>
            
            <script>
			$(document).ready(function(){
				$('#gender-other-character').hide();
				$('label[for="gender-other-character"]').hide();
				$('input[name="Gender_Character"]').on('click', function(){
					if($(this).attr('value') == 'other'){
						$('#gender-other-character').show(100);
						$('label[for="gender-other-character"]').show(100);
					}
					else{
						$('#gender-other-character').hide(100);
						$('label[for="gender-other-character"]').hide(100);
					}
				});
			});
            </script>
            
            <?php
            echo $this->Form->control('Origin_Character', [
                'label' => 'Origine',
                'required' => 'required'
            ]);
            echo $this->Form->control('Race_Character', [
                'label' => 'Race',
                'required' => 'required'
            ]);
            echo $this->Form->control('Address_Character', [
                'label' => 'Localisation',
                'required' => 'required'
            ]);
            echo $this->Form->control('Religion_Character', [
                'label' => 'Religion',
                'required' => 'required'
            ]);
            echo $this->Form->control('ColorHair_Character', [
                'label' => 'Couleur de cheveux',
                'required' => 'required'
            ]);
            echo $this->Form->control('ColorEyes_Character', [
                'label' => 'Couleur des yeux',
                'required' => 'required'
            ]);
            echo $this->Form->control('ColorSkin_Character', [
                'label' => 'Couleur de peau',
                'required' => 'required'
            ]);
            echo $this->Form->control('Job_Character', [
                'label' => 'Travail',
                'required' => 'required'
            ]);
            echo $this->Form->control('Class_Character', [
                'label' => 'Classe',
                'required' => 'required'
            ]);
            echo $this->Form->control('Height_Character', [
                'label' => 'Taille',
                'type' => 'Number',
                'required' => 'required',
                'placeholder' => 'En cm'
            ]);
            echo $this->Form->control('Weight_Character', [
                'label' => 'Poids',
                'type' => 'Number',
                'required' => 'required',
                'placeholder' => 'En kg'
            ]);
            
            echo $this->Form->label('Remember_User', 'PNJ ?'); 
            echo $this->Form->checkbox('PNJ_Character', [
                'id' => "remember-user",
                "required" => 'none'
            ]);
            
            echo $this->Form->input('Img_Character', [
                'type' => 'file', 
                'label' => 'Illustration (200 x 250px)', 
                'required' => 'none'
            ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Créer')) ?>
    <?= $this->Form->end() ?>
</div>
