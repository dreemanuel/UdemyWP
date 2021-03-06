<?php
    get_header();

    while(have_posts()) {
        the_post(); ?>
        
        <div class="page-banner">
            <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg'); ?>)">
            </div>
            <div class="page-banner__content container container--narrow">
                <h1 class="page-banner__title"><?php the_title(); ?></h1>
                <div class="page-banner__intro">
                    <p>DONT FORGET TO REPLACE ME LATER WITH A PHP CODE</p>
                </div>
            </div>
        </div>

    <div class="container container--narrow page-section">
        <?php
            $theParent = wp_get_post_parent_id(get_the_ID()); // if it is a parent page then          $theParent would return 0 (false).
            if ($theParent) {   // if $theParent is TRUE, breadcrumb is active                
        ?> 

                <!-- BREADCRUMB BAR -->    
                <div class="metabox metabox--position-up metabox--with-home-link">
                    <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent) ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent) ?></a> <span class="metabox__main"><?php the_title(); ?></span></p>
                </div> 
            <?php }
        ?>

        <!--    SIDEBAR TO CHILDREN PAGES
                Sidebar only active when on a PARENT or CHILD page -->
        <?php 
        // first, define $testArray as a way to return TRUE if page is a parent page
        // we already have $theParent as a way to return TRUE if page is a child page.
        $testArray = get_pages(array(
            'child_of' => get_the_ID()  
        ));
        // next, if current page is a PARENT or CHILD (TRUE), execute sidebar code.
        // else, if both conditions return false (0), don't execute sidebar code.
        if ($theParent or $testArray) { ?>   
        <div class="page-links">
            <h2 class="page-links__title"><a href="<?php echo get_permalink($theParent); ?>"><?php echo get_the_title($theParent); ?></a></h2>
            <ul class="min-list">
                <?php 
                    if ($theParent) {                       // if $theParent =  not 0 (is a child), 
                        $findChildrenOf = $theParent;       // $findChildrenOf = $theParent.
                    } else {                                // if $theParent = 0 (is a parent page),
                        $findChildrenOf = get_the_ID();     // get_the_ID() of the current page.
                    }
                    wp_list_pages( array(
                        'title_li' => NULL,
                        'child_of' => $findChildrenOf,
                        'sort_column' => 'menu_order'       // to control order of list/buttons
                    ));
                ?>
            </ul>
        </div>
        <?php }; ?>

        <div class="generic-content">
            <?php the_content(); ?>
        </div>
    </div>
    
    <?php };

    get_footer();

?>

