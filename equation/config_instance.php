      <?php print_string('configcontent', 'block_simplehtml'); ?>:

	

      <?php print_textarea(true, 10, 50, 0, 0, 'text', $this->config->text); ?>

     <input type="submit" value="<?php print_string('savechanges') ?>" />

<?php use_html_editor(); ?> 