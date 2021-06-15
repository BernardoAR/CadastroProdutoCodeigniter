<?php
/**
 * Modificado por Bernardo
 */
if(!function_exists('generatedBreadcrumb')){
function gerarBreadcrumb(){
    $ci=&get_instance();
    $i=1;
    $uri = $ci->uri->segment($i);
    //Começa com o home sempre
    $link='<ol class="breadcrumb">
           <li class="breadcrumb-item">
           <a href='.site_url('sistema').'>
           <i class="fas fa-home"></i></a></li>';

    while($uri != ''){
        $prep_link = '';
        for($j=1; $j<=$i; $j++){
            $prep_link.=$ci->uri->segment($j).'/';
        }
        // Verificar se é o sistema, se não é, faz o Breadcrumb normalmente, caso seja, faz o icone home
        if($ci->uri->segment($i+1)== ''){
            if(!($ci->uri->segment($i) == 'sistema')){
                $link.='<li class="breadcrumb-item active">';
                $link.=$ci->uri->segment($i).'</li>';
            } else {

            }

        } else {
            $link.='<li class="breadcrumb-item"><a href="'.site_url($prep_link).'">';
            $link.=$ci->uri->segment($i).'</a></li>';
        }
        $i++;
        $uri = $ci->uri->segment($i);
    }
    $link .='</ol>';
    return $link;
    }
}

