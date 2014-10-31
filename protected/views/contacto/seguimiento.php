<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of seguimiento
 *
 * @author Renato Hormazabal <nato.ehv@gmail.com>
 */
echo TbHtml::buttonDropdown('Tus amigos en peligro', array(
    array('label' => 'Action', 'url' => '#'),
    array('label' => 'Another action', 'url' => '#'),
    array('label' => 'Something else here', 'url' => '#'),
    ),
    array('color'=>TbHtml::BUTTON_COLOR_WARNING)  
);
?>
