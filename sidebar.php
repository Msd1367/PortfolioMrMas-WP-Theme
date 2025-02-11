<?php
if ( is_active_sidebar( 'sidebar-right' ) ) : ?>
    <aside id="secondary" class="widget-area">
        <?php dynamic_sidebar( 'sidebar-right' ); ?>
    </aside><!-- #secondary -->
<?php endif; ?>