<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <h1 class="entry-title"><?php the_title(); ?> <small>(доповнюється)</small></h1>
    </header>
    <div class="entry-content">

<?php
    $args = array (
        'post_type' => 'bio',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC'
    );
            
    query_posts($args);
    
    $candidates = array ();
    
    while ( have_posts() ) : the_post();
        if (!$candidates):
            $adv_fields = get_field_objects();
            foreach ($adv_fields as $key => $adv_field):
                $candidates[$key]['label'] = $adv_field['label'];
                $candidates[$key]['order_no'] = $adv_field['order_no'];
            endforeach;
        endif;
        
        //print_r ( $candidates );
        uasort($candidates, "cmp");
        //print_r ( $candidates );

        $candidates_post[get_the_ID()] = array (
                'title' => get_the_title(),
                //'thumb' => (has_post_thumbnail()) ? wp_get_attachment_image_src(get_post_thumbnail_id(),'thumb') : ''
                'thumb' => get_avatar( get_the_author_meta( 'ID' ),100 )
        );

        $meta = get_fields();
        foreach ($meta as $key => $field):
            $candidates[$key][get_the_ID()] = $field;
        endforeach;
        
    endwhile;
    
    wp_reset_query();

    function cmp($a, $b)
    {
        if ($a['order_no'] == $b['order_no']) {
            return 0;
        }
        return ($a['order_no'] < $b['order_no']) ? -1 : 1;
    }
?>
        
        <table class="candidates-compare" style="width:100%;table-layout:fixed;max-width: 10000px;">
            <colgroup>
                <col width="220">
                <?php foreach ($candidates_post as $candidate_post): ?>    
                    <col width="480">
                <?php endforeach; ?>              
            </colgroup>
            <thead>
                <th>&nbsp;</th>
<?php foreach ($candidates_post as $candidate_id => $candidate_post): ?>                
                <th>
                    <div class="candidate-thumb"><?php echo $candidate_post['thumb'] ?></div>
                    <h4 class="candidate-title"><?php echo $candidate_post['title'] ?></h4>
                    <?php if ($candidates['disqualified'][$candidate_id]): ?><div class="disqualified">вибув</div><?php endif; ?>
                </th>
<?php endforeach; ?>                
            </thead>
            <tbody>
<?php foreach ($candidates as $key => $value): if ($key&&$key!='disqualified'): ?>                
            <tr>
                <th><?php echo $value['label'] ?></th>
                <?php foreach ($candidates_post as $candidate_id => $candidate_post): ?>    
                <td><?php echo $value[$candidate_id] ?></td>
                <?php endforeach; ?>
            </tr>
<?php endif; endforeach; ?>                
            </tbody>
            <tfoot>
            </tfoot>
        </table>
        
    </div>
</article>

<div class="row bigrow">
  <div class="col-sm-12 news-preview">
    <h2>Новини</h2>
    <?php 
      $args = array(
        'post__not_in' => $do_not_duplicate,
        'posts_per_page' =>4, 
        'category_name' => 'novini',
      );
      query_posts( $args );
      while ( have_posts() ) : the_post();?>
      
        <div class="col-sm-3 news-item"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br><span class="el-icon-calendar icon date"><?php the_time('d.m.Y'); ?></span></div>
      
        
      <?php endwhile;

        wp_reset_query();
    ?>
    <a href="<?php echo home_url('/news/') ?>" class="all-news">Всі матеріали</a>
    
  </div>

</div> 