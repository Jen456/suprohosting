<?php
if ( $item['qf_item_link']['url'] ) :
	$link_key = 'main_link_' . $index;
	$this->add_link_attributes( $link_key, $item['qf_item_link'] );
	$this->add_render_attribute( $link_key, 'class', 'quickfinder-item-link' );
	$this->add_render_attribute( $link_key, 'aria-label', esc_attr__('Read more', 'thegem') ); ?>
	<a <?php echo $this->get_render_attribute_string( $link_key ); ?>></a>
<?php endif; ?>