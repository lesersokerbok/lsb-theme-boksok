<?php 

$input_placeholder =  __('Søk etter forfatter, tittel, tema, isbn ...', 'lsb_boksok');
$input_value = get_search_query();

$lsb_cat_filter_term = get_lsb_cat_filter_term();

?>

<div class="block block-lsb-search">
  <div class="container">
      <div class="row app-align-center">
        <div class="col-sm-12 col-md-8 col-md-offset-2">
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
		<div class="row ais-wrapper">

				<div class="col-md-8">
					<div id="algolia-hits">
						<div class="row">
							<div class="col-md-7 col-md-offset-5">
								<div class="lsb-heading-medium"><?php _e('Søker ...', 'lsb-theme-boksok') ?></div>
							</div>
						</div>
					</div>
				</div>
				<aside class="col-md-3 col-md-offset-1">
					<section id="algolia-refined-values"></section>
					<?php if( !$lsb_cat_filter_term ) : ?>
					<section class="ais-facets" id="facet-category"></section>
					<?php endif; ?>
					<section class="ais-facets" id="facet-topic"></section>
					<section class="ais-facets" id="facet-age"></section>
					<section class="ais-facets" id="facet-language"></section>
					<section class="ais-facets" id="facet-authors"></section>
					<section class="ais-facets" id="facet-illustrators"></section>
				</aside>
			</div>

			<div class="row">
				<div class="col-12 text-align-center">
					<div id="algolia-pagination" class="text-xs-center"></div>
				</div>
			</div>

		</div>
	</div>
</div>

	<script type="text/html" id="tmpl-instantsearch-hit">
		<!-- Should not be used, but if it does it will not fail -->	
	</script>

	<script type="text/html" id="tmpl-instantsearch-lsb_book-hit">
		<article class="summary lsb_book">
			<div class="row lsb-xs-row-valign-center">
				<div class="col-xs-5">
						<a class="lsb-book-thumbail" href="{{ data.permalink }}" title="{{ data.post_title }}">
							<# if(data.images.medium) { #>
							<img src="{{ data.images.medium.url }}" alt="{{ data.post_title }}" title="{{ data.post_title }}" itemprop="image" />
							<# } #>
						</a>
				</div>
				<div class="col-xs-7">
					<div class="lsb-heading-medium"><a href="{{ data.permalink }}">{{ data.post_title }}</a></div>
					<div class="ais-hits--tags">

						<#
						
							var creators = [];
							var terms = [];

							for ( var tax_key in data._highlightResult.taxonomies ) {	
								var tax_terms = data._highlightResult.taxonomies[tax_key];
								for ( var term_index in tax_terms ) {
									var tax_term = tax_terms[term_index];					
									if( tax_key === 'lsb_tax_author' || tax_key === 'lsb_tax_illustrator' || tax_key === 'lsb_tax_translator') {
										creators.push(tax_term.value);
									} else {
										terms.push(tax_term.value);
									}
								}
							}

							creators = jQuery.unique(creators);
							terms = jQuery.unique(terms);

						#>
						

						<# for ( var creator_index in creators ) { #>
							<span class="ais-hits--tag">
								<span class="icon icon-user" aria-hidden="true" style="color: black; opacity: 0.3"></span>
								{{{ creators[creator_index] }}}
							</span>
						<# } #>
						<# if (  data._highlightResult.lsb_isbn && data._highlightResult.lsb_isbn.matchedWords.length > 0 ) { #>
							<span class="ais-hits--tag">
								<span style="color: black; opacity: 0.3; font-size: 90%">isbn</span>
								{{{ data._highlightResult.lsb_isbn.value }}}
							</span>
						<# } #>
						<# for ( var term_index in terms ) { #>
							<span class="ais-hits--tag">
								{{{ terms[term_index] }}}
							</span>
						<# } #>
					</div>
					<p class="block-lsb-description">
						<#

							var relevant_content = '';

							for ( var snippet_index in data._snippetResult ) {
								var snippet = data._snippetResult[snippet_index];
								if( snippet.matchLevel !== 'none') {
									relevant_content = snippet.value;
									break;
								}
							}

							if( relevant_content === '' && data._snippetResult.lsb_review ) {
								relevant_content = data._snippetResult.lsb_review.value;
							}

						#>

						{{{ relevant_content }}}
					</p>
				</div>
			</div>
		</article>
	</script>

	<script type="text/html" id="tmpl-instantsearch-empty">
			<div class="row lsb-xs-row-valign-center">
				<div class="col-sm-7 col-sm-offset-5">
					<h1 class="lsb-heading-medium"><?php _e('Ingen resultater for', 'lsb_theme_boksok') ?> <em>{{data.query}}</em></h1>
				</div>
			</div>
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
							'lsb_review:40',
							'lsb_quote:40'
						],
						<?php if($lsb_cat_filter_term) : ?>
						facetFilters: [
    					'taxonomies.lsb_tax_lsb_cat:<?= $lsb_cat_filter_term->name ?>'
  					],
						<?php endif; ?>
					},
					searchFunction: function(helper) {
						if (search.helper.state.query === '') {
							search.helper.setQueryParameter('distinct', false);
							search.helper.setQueryParameter('filters', 'record_index=0');
						} else {
							search.helper.setQueryParameter('distinct', true);
							search.helper.setQueryParameter('filters', '');
						}

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
						templates: {
							empty: wp.template("instantsearch-empty"),
							item: function(item) {
								var template = wp.template('instantsearch-hit');
								if(item.hasOwnProperty('post_type') && item['post_type'] === 'lsb_book') {
									template = wp.template("instantsearch-" + item['post_type'] + "-hit");
								} 
            		return template(item);
         			}
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

				// Currently refined

				search.addWidget(
					instantsearch.widgets.currentRefinedValues({
						container: '#algolia-refined-values',
						clearAll: 'after',
						templates: {
							header: '<h3 class="lsb-heading-small"><?php _e("Valgt", "lsb-theme-boksok") ?></h3>',
      				clearAll: '<?php _e("Nullstill", "lsb-theme-boksok") ?>'	
    				},
						cssClasses: {
							clearAll: 'btn btn-primary btn-sm' 
						}
					})
				);

				<?php if( !$lsb_cat_filter_term ) : ?>
				// Facet widget: lsb_tax_lsb_cat
				search.addWidget(
					instantsearch.widgets.hierarchicalMenu({
						container: '#facet-category',
						attributes: ['taxonomies_hierarchical.lsb_tax_lsb_cat.lvl0', 'taxonomies_hierarchical.lsb_tax_lsb_cat.lvl1'],
						sortBy: ['count:desc', 'name:asc'],
						limit: 10,
						templates: {
							header: '<h3 class="lsb-heading-small">Kategori</h3>'
						},
						cssClasses: {
							count: 'label label-default'
						} 
					})
				);
				<?php endif; ?>

				// Facet widget: lsb_tax_language
				search.addWidget(
					instantsearch.widgets.menu({
						container: '#facet-language',
						attributeName: 'taxonomies.lsb_tax_language',
						sortBy: ['count:desc', 'name:asc'],
						limit: 10,
						templates: {
							header: '<h3 class="lsb-heading-small">Språk</h3>'
						},
						cssClasses: {
							count: 'label label-default'
						} 
					})
				);

				// Facet widget: lsb_tax_author
				search.addWidget(
					instantsearch.widgets.menu({
						container: '#facet-authors',
						attributeName: 'taxonomies.lsb_tax_author',
						sortBy: ['count:desc', 'name:asc'],
						limit: 10,
						templates: {
							header: '<h3 class="lsb-heading-small">Forfatter</h3>'
						},
						cssClasses: {
							count: 'label label-default'
						} 
					})
				);

				// Facet widget: lsb_tax_illustrator
				search.addWidget(
					instantsearch.widgets.menu({
						container: '#facet-illustrators',
						attributeName: 'taxonomies.lsb_tax_illustrator',
						sortBy: ['count:desc', 'name:asc'],
						limit: 10,
						templates: {
							header: '<h3 class="lsb-heading-small">Illustratør</h3>'
						},
						cssClasses: {
							count: 'label label-default'
						} 
					})
				);

				// Facet widget: lsb_tax_age
				search.addWidget(
					instantsearch.widgets.hierarchicalMenu({
						container: '#facet-age',
						separator: ' > ',
						sortBy: ['count'],
						attributes: ['taxonomies_hierarchical.lsb_tax_age.lvl0', 'taxonomies_hierarchical.lsb_tax_age.lvl1', 'taxonomies_hierarchical.lsb_tax_age.lvl2'],
						templates: {
							header: '<h3 class="lsb-heading-small">Alder</h3>'
						},
						cssClasses: {
							count: 'label label-default'
						} 
					})
				);

				// Facet widget: lsb_tax_topic
				search.addWidget(
					instantsearch.widgets.refinementList({
						container: '#facet-topic',
						attributeName: 'taxonomies.lsb_tax_topic',
						operator: 'or',
						limit: 10,
						showMore: true,
						sortBy: ['count:desc', 'name:asc'],
						templates: {
							header: '<h3 class="lsb-heading-small">Emne</h3>'
						},
						cssClasses: {
							item: 'checkbox',
							count: 'label label-default'
						} 
					})
				);

				// Start
				search.start();

				jQuery('#algolia-search-box input').attr('type', 'search').select();
			}
		});
	</script>
