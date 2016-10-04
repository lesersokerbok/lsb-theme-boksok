<?php

$book = $lsb_partials_args['book'];
if(!$book) {
  $book = $post;
}

$counties = get_post_meta($book->ID, 'lsb_library_status', true);

?>

<?php if( $counties ) : ?>
<div class="content-part library-status">
  <table class="table">
    <thead>
      <tr>
        <th colspan="2" class="text-xs-center">
          <form class="form-inline">
           <label class="m-r" for="countySelect"><?php _e( 'Lån boka på ditt bibliotek:', 'lsb' ); ?></label>
            <select class="form-control" id="countySelect">
              <option><?php _e('Velg fylke', 'lsb') ?></option>
              <?php foreach( $counties as $key => $county_libraries ) : ?>
                <?php if( $key ) : ?>
                <option value="<?php echo sanitize_title($key) ?>"><?php echo esc_html( $key ); ?></option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
          </form>
        </th>
      </tr>
    </thead>

  <?php foreach( $counties as $key => $county_libraries ) : ?>
    <tbody class="hidden county <?php echo sanitize_title( $key ); ?>">
    <?php foreach( $county_libraries as $library ) : ?>
      <tr>
        <td>
          <?php echo esc_html( $library['name'] ) ?>
          <a class="small" href="<?php echo esc_url( $library['url'] ) ?>">
            (<?php _e('Hjemmeside', 'lsb-book') ?>)
          </a>
        </td>
        <td class="text-xs-right">
          <a target="_blank" href="<?php echo esc_url( $library['book_url'] ) ?>">
            <?php _e('Lån boka', 'lsb'); ?>
          </a>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  <?php endforeach; ?>
  </table>
</div>
<?php endif; ?>
