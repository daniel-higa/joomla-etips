<div class="app_description">
    <?php
        $link_name = $fields->getFieldById(1);
        $fields->resetPointer();
        $field_link = $fields->getFieldByCaption('applink');
        if (isset($field_link)) {
            $link = $field_link->getValue();
        }
        $app_link = '<a href="'. $link .'"><img src="images/appstore_btn_en.png" alt="' . $link_name->getOutput(2) . '"></a>';
        
        echo '<a href="' . $link . '" >';
        echo '<div class="app_head_container">';
        echo '<div class="title_container"><h2 class="app_title">' . $link_name->getOutput(2) . '</h2></div><div class="ico_container">' . $app_link  . '</div></div>';
        echo '<div class="clear"></div>';
        echo '</a>';
        echo '<div class="description_container"  onclick="document.location = \'' . $link . '\';"><h3>' . $link_desc . '</h3>';
        echo '</div>';
    ?>
</div>
