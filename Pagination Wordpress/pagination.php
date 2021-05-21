<?php
if(!function_exists('teenskey_custom_pagination')){
    function teenskey_custom_pagination( $type = null, $echo = true ) {
        if($type){
            $number = get_query_var( 'paged' );
            $paged = $number ? $number  : 1;
            $args = array(
                'post_type' => $type,
                'post_status' => 'publish',
                'order' => 'ASC',
                'orderby' => 'menu_order', //order by...
                'posts_per_page' => get_option("posts_per_page"),
                'paged' =>  $paged
            );
            $wp_query = new WP_query($args);
        }
        $pages = paginate_links(array(
        'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
        'format'       => '?paged=%#%',
        'current'      => max( 1, get_query_var( 'paged' ) ),
        'total'        => $wp_query->max_num_pages,
        'type'         => 'array',
        'show_all'     => true,
        'end_size'     => 0,
        'mid_size'     => 2,
        'prev_next'    => true,
        'prev_text'    => __('<span class="icon">|< </span>Prev'),
        'next_text'    => __('Next<span class="icon"> >|</span>'),
        'add_args'     => false,
        'add_fragment' => ''
        )
            );
            
            if ( is_array( $pages ) ) {
            $pagination = '<div class="pagination-pager"><ul class="pagination-list">';
            foreach ($pages as $page) {
                $pagination .= '<li'.(strpos($page,'current')!== false ? ' class="active" ':'').'>';
                if(strpos($page,'current')!== false){
                    if(get_query_var('paged') > 1){
                        $pagination .= '<a>'. get_query_var('paged') .'</a>';
                    }else{
                    $pagination .= '<a>'. 1 .'</a>';
                    }
                }else{
                    $pagination .= str_replace('class="page-numbers"', '', $page);
                }
                    $pagination .= '</li>';
        }
        $pagination .= '</ul></div>';
            if($echo === true){
                echo $pagination;
            }else{
                return $pagination;
            }
        }
        return null;
    }
}
 


?>