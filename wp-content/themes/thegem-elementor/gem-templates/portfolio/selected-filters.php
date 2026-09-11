<div class="portfolio-filter-item portfolio-selected-filters <?php if (isset($settings['duplicate_selected_in_sidebar']) && $settings['duplicate_selected_in_sidebar'] != 'yes' && $settings['duplicate_selected_in_sidebar'] != '1') {
	echo 'hide-on-sidebar';
} ?> <?php echo esc_attr($settings['filter_buttons_standard_alignment']); ?>">
	<div class="portfolio-selected-filter-item clear-filters">
		<?php echo !empty($settings['filters_text_labels_clear_text']) ? esc_attr($settings['filters_text_labels_clear_text']) : __('Clear Filters', 'thegem'); ?>
	</div>
	<?php if (isset($_GET[$grid_uid_url . 'category'])) {
		$active_cat = $_GET[$grid_uid_url . 'category'];
		$category = get_term_by('slug', $active_cat, 'product_cat');
		if ($category) { ?>
			<div class="portfolio-selected-filter-item category"
				 data-filter="<?php echo esc_attr($active_cat); ?>"><?php
				echo esc_html($category->name); ?> <i class="delete-filter"></i></div>
		<?php } ?>
	<?php }
	if (!empty($attributes_filter)) {
		foreach ($attributes_filter as $key => $value) {
			if (strpos($key, "__range") > 0) {
				$key = str_replace("__range","", $key);
				$prefix = $suffix = '';
				if (isset($filter_attr_numeric) && $filter_attr_numeric[$key]) {
					$item = $filter_attr_numeric[$key];
					$prefix = $item['attribute_price_format_prefix'];
					$suffix = $item['attribute_price_format_suffix'];
				} ?>
				<div class="portfolio-selected-filter-item price" data-attr="<?php echo esc_attr($key); ?>">
					<?php echo('<div>' . $prefix . '<span>' . $value[0] . '</span>' . $suffix . ' - ' . $prefix . '<span>' . $value[1] . '</span>' . $suffix . '</div>'); ?>
					<i class="delete-filter"></i>
				</div>
			<?php } else {
				foreach ($value as $attr_value) { ?>
					<div class="portfolio-selected-filter-item attribute" data-attr="<?php echo esc_attr($key); ?>"
						 data-filter="<?php echo esc_attr($attr_value); ?>">
						<?php if (strpos($key, 'tax_') === 0) {
							$term = get_term_by('slug', $attr_value,  str_replace("tax_","", $key));
							echo esc_html($term->name);
						} else if (strpos($key, 'meta_') === 0) {
							echo esc_html($attr_value);
						} else {
							$term = get_term_by('slug', $attr_value, 'pa_' . $key);
							echo esc_html($term->name);
						} ?><i class="delete-filter"></i>
					</div>
				<?php }
			}
		}
	}
	if (!empty($status_current)) {
		if (in_array('sale', $status_current)) { ?>
			<div class="portfolio-selected-filter-item status"
				 data-filter="sale"><?php echo __('On Sale', 'thegem'); ?><i
						class="delete-filter"></i></div>
		<?php }
		if (in_array('stock', $status_current)) { ?>
			<div class="portfolio-selected-filter-item status"
				 data-filter="stock"><?php echo __('In Stock', 'thegem'); ?>
				<i class="delete-filter"></i></div>
			<?php
		}
	}
	if (!empty($price_current)) {
		$currency_pos = get_option('woocommerce_currency_pos');
		$space = '';
		$min_price = number_format($current_min_price, 0, get_option('woocommerce_price_decimal_sep'), get_option('woocommerce_price_thousand_sep'));
		$max_price = number_format($current_max_price, 0, get_option('woocommerce_price_decimal_sep'), get_option('woocommerce_price_thousand_sep'));
		if ($currency_pos == 'left' || $currency_pos == 'left_space') {
			if ($currency_pos == 'left_space') {
				$space = ' ';
			}
			$price = get_woocommerce_currency_symbol() . $space . $min_price . ' - ' . get_woocommerce_currency_symbol() . $space . $max_price;
		} else {
			if ($currency_pos == 'right_space') {
				$space = ' ';
			}
			$price = $min_price . $space . get_woocommerce_currency_symbol() . ' - ' . $max_price . $space . get_woocommerce_currency_symbol();
		} ?>
		<div class="portfolio-selected-filter-item price"><?php echo esc_html($price); ?>
			<i class="delete-filter"></i></div>
		<?php
	}
	if (!empty($search_current)) { ?>
		<div class="portfolio-selected-filter-item search"><?php echo esc_html($search_current); ?><i
					class="delete-filter"></i></div>
	<?php } ?>
</div>