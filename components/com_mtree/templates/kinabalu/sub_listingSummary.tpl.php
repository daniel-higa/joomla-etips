<div class="app_description">
    <?php
        $link_name = $fields->getFieldById(1);

        $aux_link = loadLink($link->link_id, $savantConf, $temp_fields, $aux_params);
        
        $fields->resetPointer();
        $field_link = $fields->getFieldByCaption('applink');
        if (isset($field_link)) {
            $link = $field_link->getValue();
        }
        
        $app_link = '';
        if (isset($link) and !empty($link)) {
            $app_link = '<img src="images/appstore_btn_en.png" alt="' . $link_name->getOutput(2) . '">';
        }
        
        echo '<a href="' . $link . '" target="_blank" onclick="_gaq.push([\'_trackEvent\', \'Destinos-'. $lang->getTag() .'\', \''. htmlspecialchars($this->cat_name) .'\'])">';
        echo '<div class="app_head_container">';
        echo '<div class="title_container"><h2 class="app_title">' . $link_name->getOutput(2) . '</h2></div><div class="ico_container">' . $app_link  . '</div></div>';
        echo '<div class="clear"></div>';
        echo '</a>';
        echo '<div class="description_container" >';
        echo '<div class="description_text"><h3>' . $link_desc . '</h3></div>';

        echo '<div class="description_graph">';
        if (isset($aux_link->link_image) and !empty($aux_link->link_image)) {
				echo '<img src="' . $this->jconf['live_site'] . $this->mtconf['relative_path_to_listing_small_image'] . $aux_link->link_image .'" alt=""/>';
        }

        $column_description = $fields->getFieldByCaption('column_description');

        if (isset($column_description)) {
			$alt = listing_alt($this->cat_name, $link_name->getOutput(2), $categoria);
			if (!empty($alt)) {
				echo set_alt($column_description->getValue(), $alt);
			} else {
				echo $column_description->getValue();
			}
        }
        echo '</div>';

        echo '<div class="clear"></div>';
        echo '</div>';
    ?>
</div>
