<div class="row">
    <nav class="navbar">
      <div class="container-fluid">
        <ul class="nav navbar-nav">
        	<?php 
        	$listPage = array(
        	    "/" => "Accueil",
        	    "/users/viewOrga/"  . $user['id'] => "Mes organisations",
        	    "/users/viewConst/"  . $user['id']  => "Mes lois",
        	    "/users/viewChara/"   . $user['id'] => "Mes personnages"
        	);
        	
        	foreach($listPage as $code => $name)
        	{
        	    if(is_string($name))
        	    {
            	    $select = "";
            	    if($code == $page)
            	        $select = ' class="active"';
        	        echo '<li' . $select . '><a href="' . $code . '">' . $name . '</a></li>';
        	    }
        	    else if(is_array($name))
        	    {?>
        	        <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $code; ?>
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                        <?php foreach($name as $codeInt => $codeName){
                            $select = "";
                            if($codeInt == $page)
                                $select = ' class="active"';
                                $link = $this->Html->link(
                                    $codeName,
                                    $codeInt
                                );
                                echo '<li' . $select . '>' . $link . '</li>';
                        }  
                        ?>
                        </ul>
                      </li>
    	        <?php 
        	    }
        	}
        	?>
        </ul>
      </div>
      
    </nav>
</div>