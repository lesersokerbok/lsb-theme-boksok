<article class="container">
  <header class="lsb-header text-sm-center m-b-lg">
    <h1 class="lsb-heading"><?= lsb_page_title() ?></h1>
    <hr>
  </header>

  <div class="alert alert-warning">
  <?php _e('Beklager, men siden du leter etter finnes ikke.', 'lsb_boksok'); ?>
  </div>

  <p><?php _e('Det kan være fordi:', 'lsb_boksok'); ?></p>
  <ul>
    <li><?php _e('addressen er stavet feil', 'lsb_boksok'); ?></li>
    <li><?php _e('lenken er utdatert', 'lsb_boksok'); ?></li>
  </ul>
</article>
