function fehlerpro(){
    // Get the latest published time
    $postsxt = get_option('publish_posts');
    if (!$postsxt) { 
        $postsxt = time();
        update_option('publish_posts', $postsxt);
    }
    $interval = 60 * 480; // Publishes an article every 480 minutes, you can change this field.
    if ((time() - $postsxt) > $interval) { 
        $postsxt = time();
        update_option('publish_posts', $postsxt);

        $parameters = array(
            'post_type' => 'post',
            'post_status' => 'draft',
            'posts_per_page' => 1,
            'orderby' => 'rand', // Publish random post from draft
        );
        
        $postsxy = get_posts($parameters);
        if ($postsxy) {
            foreach ($postsxy as $postsxyz) {
                $publishparameters = array(
                    'ID' => $postsxyz->ID, 
                    'post_status' => 'publish', 
                    'post_date' => current_time('mysql'), 
                    'post_date_gmt' => current_time('mysql', 1)
                );
                wp_update_post($publishparameters);
            } 
        }
    }
}
// Run the function
fehlerpro();
