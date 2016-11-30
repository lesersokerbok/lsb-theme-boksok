<?php 

$input_placeholder =  __('Søk etter forfatter, tittel, tema, isbn ...', 'lsb_boksok');
$input_value = get_search_query();

$lsb_cat_filter_term = get_lsb_cat_filter_term();
$url_addon = "";
if($lsb_cat_filter_term) {
	$url_addon = '?filter=' . $lsb_cat_filter_term->slug;
}

?>

  <div class="block block-lsb-search">
    <div class="container">
      <div class="row app-align-center">
        <div class="col-sm-12 col-md-8 col-md-offset-2">
          <div class="search-form">
            <div class="input-group input-group-lg">
              <input id="algolia-insta-search" type="search" class="form-control" value="<?php echo $input_value ?>" placeholder="<?php echo $input_placeholder ?>">
              <span class="input-group-btn">
                <button class="btn btn-default" type="submit"><?php _e('Søk', 'lsb_boksok'); ?></button>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="block block-lsb-books">
    <div class="container">
      <div id="algolia-hits">
        <div class="ais-hits">
          <p class="lsb-heading-medium"><?php _e('Søker ...', 'lsb-theme-boksok') ?></p>
        </div>
      </div>

      <nav class="post-nav text-xs-center">
        <div id="algolia-pagination" class="text-xs-center"></div>
      </nav>
    </div>
  </div>

	<script type="text/html" id="tmpl-instantsearch-hit">
		<!-- Should not be used, but if it does it will not fail -->	
	</script>

  <script type="text/html" id="tmpl-instantsearch-hits">
    <#
		  for ( var book_index in data.hits ) {
        var book = data.hits[book_index];
        console.log(book);

        var relevant_content = null;
        var use_relevant_content = true;

        var relevant_meta = {};

        relevant_meta.creators = {
          terms: [],
          label: '<?= __('av', 'lsb-theme-books') ?>'
        };

        relevant_meta.topics = {
          terms: [],
          label: '<?= __('tema', 'lsb-theme-books') ?>'
        };

        relevant_meta.partof = {
          terms: [],
          label: '<?= __('del av', 'lsb-theme-books') ?>'
        };

        relevant_meta.audience = {
          terms: [],
          label: '<?= __('passer for', 'lsb-theme-books') ?>'
        };

        if(book._highlightResult.post_title.matchLevel === 'full') {
          use_relevant_content = false;
        }


        for ( var tax_key in book._highlightResult.taxonomies ) {
          var tax_terms = book._highlightResult.taxonomies[tax_key];
          for ( var term_index in tax_terms ) {
            var tax_term = tax_terms[term_index];
            if(tax_term.matchLevel !== 'none' || tax_key === 'lsb_tax_author') {
              if( tax_key === 'lsb_tax_author' || tax_key === 'lsb_tax_illustrator' || tax_key === 'lsb_tax_translator') {
                relevant_meta.creators.terms.push({value: tax_term.value, permalink: book.taxonomies_permalinks[tax_key][term_index]});
              } else if( tax_key === 'lsb_tax_topic') {
                relevant_meta.topics.terms.push({value: tax_term.value, permalink: book.taxonomies_permalinks[tax_key][term_index]});
              } else if( tax_key === 'lsb_tax_series' || tax_key === 'lsb_tax_list' ) {
                relevant_meta.partof.terms.push({value: tax_term.value, permalink: book.taxonomies_permalinks[tax_key][term_index]});
              } else if( tax_key === 'lsb_tax_age' || tax_key === 'lsb_tax_audience' ) {
                relevant_meta.audience.terms.push({value: tax_term.value, permalink: book.taxonomies_permalinks[tax_key][term_index]});
              }
            }

            if(tax_term.matchLevel === 'full') {
              use_relevant_content = false;
            }
          }
        }


        for ( var snippet_index in book._snippetResult ) {
          var snippet = book._snippetResult[snippet_index];
          if( snippet.matchLevel !== 'none') {
            relevant_content = snippet.value;
            break;
          }
        }

    #>

      <article class="lsb-book-collection-item">
        <a class="lsb-book-collection-item-cover"
          title="{{ book.post_title }}"
          alt="<?= __('Omslag - ', 'lsb-theme-books') ?>{{ book.post_title }}"
          href="{{ book.permalink }}">

          <# if(book.images.medium) { #>
            <img src="{{ book.images.medium.url }}" alt="{{ book.post_title }}" title="{{ book.post_title }}" itemprop="image" />
          <# } #>

        </a>
        <h1 class="lsb-book-collection-item-title">
          <a href="{{ book.permalink }}">{{{ book._highlightResult.post_title.value }}}</a>
        </h1>

        <# if(relevant_content && use_relevant_content) { #>
          <p class="lsb-book-collection-item-meta">
            {{{ relevant_content }}}
          </p>
        <# } #>

        <p class="lsb-book-collection-item-meta">
          <# for (var meta_index in relevant_meta) { #>
            <# if (relevant_meta[meta_index].terms.length > 0) { #>
            <span class="lsb-tags">
              <span class="lsb-tag lsb-tag-label">{{ relevant_meta[meta_index].label }}</span>
              <# for (var term_index in relevant_meta[meta_index].terms) { #>
                <span class="lsb-tag"><a href="{{{ relevant_meta[meta_index].terms[term_index].permalink }}}">
                  {{{ relevant_meta[meta_index].terms[term_index].value }}}
                </a></span>
              <# } #>
            </span>
            <# } #>
          <# } #>
        </p>
		  </article>

    <# } #>

	</script>

	<script type="text/html" id="tmpl-instantsearch-empty">
		<p class="lsb-heading-medium"><?php _e('Ingen resultater for', 'lsb_theme_boksok') ?> <em>{{data.query}}</em></p>
	</script>


	<script type="text/javascript">
		jQuery(function() {
			if(jQuery('#algolia-insta-search').length > 0) {
				// Instantiate instantsearch.js
				var search = instantsearch({
					appId: algolia.application_id,
					apiKey: algolia.search_api_key,
					indexName: algolia.indices.posts_lsb_book.name,
					urlSync: {
						mapping: {
							'q': 's'
						},
						trackedParameters: ['query']
					},
					searchParameters: {
						facetingAfterDistinct: true,
						attributesToSnippet: [
							'lsb_review:20',
							'lsb_quote:20'
						],
						<?php if($lsb_cat_filter_term) : ?>
            facets: ['taxonomies.lsb_tax_lsb_cat'],
						facetsRefinements: {
    					'taxonomies.lsb_tax_lsb_cat': ["<?= htmlspecialchars_decode($lsb_cat_filter_term->name) ?>"]
            },
						<?php endif; ?>
					},
					searchFunction: function(helper) {
            var savedPage = helper.state.page;
						if (search.helper.state.query === '') {
							search.helper.setQueryParameter('distinct', false);
							search.helper.setQueryParameter('filters', 'record_index=0');
						} else {
							search.helper.setQueryParameter('distinct', true);
							search.helper.setQueryParameter('filters', '');
						}
						search.helper.setPage(savedPage);
						helper.search();
					}
				});

				// Search box widget
				search.addWidget(
					instantsearch.widgets.searchBox({
						container: '#algolia-insta-search',
						placeholder: jQuery('#algolia-insta-search').attr('placeholder'),
						wrapInput: false,
					})
				);

				// Hits widget
				search.addWidget(
					instantsearch.widgets.hits({
						container: '#algolia-hits',
						hitsPerPage: 30,
						transformData: {
							item: function(data) {
								data.permalink = data.permalink + "<?= $url_addon ?>";
                for ( var tax_key in data.taxonomies_permalinks ) {
                  for ( var term_index in data.taxonomies_permalinks[tax_key] ) {
                    data.taxonomies_permalinks[tax_key][term_index] = data.taxonomies_permalinks[tax_key][term_index] + "<?= $url_addon ?>";
                  }
                }
								return data;
							},
						}, 
						templates: {
							empty: wp.template("instantsearch-empty"),
							allItems: wp.template('instantsearch-hits')
						}
					})
				);

				// Pagination widget
				search.addWidget(
					instantsearch.widgets.pagination({
						container: '#algolia-pagination',
						cssClasses: {
							root: 'pagination' 
						}
					})
				);

//				// Currently refined
//
//				search.addWidget(
//					instantsearch.widgets.currentRefinedValues({
//						container: '#algolia-refined-values',
//						clearAll: 'after',
//						templates: {
//							header: '<h3 class="lsb-heading-small"><?php _e("Filter", "lsb-theme-boksok") ?></h3>',
//      				clearAll: '<?php _e("Nullstill", "lsb-theme-boksok") ?>'
//    				},
//						cssClasses: {
//							clearAll: 'btn btn-default btn-sm'
//						}
//					})
//				);
//
//				// Facet widget: lsb_tax_lsb_cat
//				search.addWidget(
//					instantsearch.widgets.hierarchicalMenu({
//						container: '#facet-category',
//						attributes: ['taxonomies_hierarchical.lsb_tax_lsb_cat.lvl0', 'taxonomies_hierarchical.lsb_tax_lsb_cat.lvl1'],
//						sortBy: ['count:desc', 'name:asc'],
//						limit: 10,
//						templates: {
//							header: '<h3 class="lsb-heading-small">Kategori</h3>'
//						}
//					})
//				);

				// Start
				search.start();

				jQuery('#algolia-search-box input').attr('type', 'search').select();
			}
		});
	</script>
