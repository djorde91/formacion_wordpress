<?php
/**
 * @var $taxonomy
 * @var $current_screen
 * @var $page
 */

$name = get_admin_page_title();
$post_type = $current_screen->post_type;
$add_new_url = '';
$item = '';
$list_name_block = '';

    if($page === 'gd_events_page_gd_events_themes'){
        $item = 'Add New Theme';
	    $new_theme_link = admin_url('edit.php?post_type=gd_events&page=gd_events_themes&task=create_new_theme');
	    $add_new_url = wp_nonce_url($new_theme_link, 'gd_events_themes_create_new_theme');

	    if(isset($_GET['id'])):
		    $id = absint($_GET['id']);
            if($id === 1){
	            throw new \Exception('Cannot edit Default Theme');
            }
		    $themes = \GDCalendar\Models\Settings\Theme::get();

		    $list_name_block = "<ul class='gd_calendar_section_switch'>";
            foreach ($themes as $val):
	            $theme_id = $val->get_id();
                $theme_name = stripslashes($val->get_name());
	            $edit_theme = admin_url('edit.php?post_type=gd_events&page=gd_events_themes&task=edit_theme&id=' . $theme_id);
	            $edit_theme = wp_nonce_url($edit_theme, 'gd_events_themes_edit_theme_' . $theme_id);

	            if($theme_id === 1){continue;}

                if ($theme_id == $id):
	                $list_name_block .= "<li class='gd_calendar_active_section'>
                                            <a href='#' class='gd_calendar_section_edit_name'><i class='fa fa-pencil' aria-hidden='true'></i></a>
                                            <a href='#' class='gd_calendar_section_active_name'>". $theme_name ."</a>
                                            <input type='text' name='edit_name' value='". $theme_name ."' class='gd_calendar_edit_section_name_input gd_calendar_hidden'>
                                          </li>";
                else:
	                $list_name_block .= "<li><a href='". $edit_theme."'>". $theme_name ."</a></li>";
                endif;
            endforeach;
		    $list_name_block.="</ul>";
        endif;
    }
    elseif(!$taxonomy){
	    $add_new_url = admin_url('post-new.php?post_type=' . $post_type );
	    $post_obj = get_post_type_object($post_type);
	    $item = $post_obj->labels->add_new;

	    if(isset($_GET['post'])){
	        $id = absint($_GET['post']);
		    $posts = get_posts(array('post_type' => $post_type, 'posts_per_page' => -1));

		    $list_name_block = "<ul class='gd_calendar_section_switch'>";
		    foreach ($posts as $post):
			    $post_id = $post->ID;
			    $post_name = stripslashes($post->post_title);
			    $edit_post = admin_url('post.php?post=' . $post_id .'&action=edit');

			    if ($post_id == $id):
				    $list_name_block .= "<li class='gd_calendar_active_section'>
                                            <a href='#' class='gd_calendar_section_edit_name'><i class='fa fa-pencil' aria-hidden='true'></i></a>
                                            <a href='#' class='gd_calendar_section_active_name'>". $post_name ."</a>
                                            <input type='text' name='edit_name' value='". $post_name ."' class='gd_calendar_hidden gd_calendar_edit_section_name_input'>
                                          </li>";
			    else:
				    $list_name_block .= "<li><a href='". $edit_post."'>". $post_name ."</a></li>";
			    endif;
		    endforeach;
		    $list_name_block.="</ul>";
        }
    }

?>
    <div class="gd_calendar_top_banner">
        <i class="gd_calendar_banner_logo"></i>
        <span>GrandWP Event Calendar</span>
        <ul>
            <li>
                <a href="//grandwp.com/support" target="_blank"><?php _e('Support','gd-calendar');?></a>
            </li>
            <li>
                <a href="//grandwp.com/wordpress-event-calendar-user-manual" target="_blank"><?php _e('Help','gd-calendar');?></a>
            </li>
        </ul>
    </div>
    <?php if($taxonomy === '' && !($current_screen->base === 'post' && $current_screen->action === 'add' ) && $page !== 'gd_events_page_gd_events_featured_plugins' || $page === 'gd_events_page_gd_events_themes' ): ?>
        <div class="gd_calendar_new_list_header">
            <div>
                <?php
                    if($page == 'gd_events_themes'){
                        echo 'brrr';
                    } else {
                ?>

                    <h1><?php _e($name,'gd-calendar');?></h1>
                    <a href="<?php echo $add_new_url; ?>" id="gd_calendar_new"><?php _e($item,'gd-calendar');?></a>
                <?php } ?>
            </div>
        </div>
    <?php endif; ?>
