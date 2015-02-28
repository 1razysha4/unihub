<?php

function icon($icon_name, $alt='', $ext='png') {

	return '<img src="' . base_url() . 'assets/public/icons/' . $icon_name . '.' . $ext . '" alt="' . $alt . '" />';

}

?>
