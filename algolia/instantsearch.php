

	<div id="ais-wrapper">
		<main id="ais-main">
			<div id="algolia-search-box">
				<div id="algolia-stats"></div>
				<svg class="search-icon" width="25" height="25" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"><path d="M24.828 31.657a16.76 16.76 0 0 1-7.992 2.015C7.538 33.672 0 26.134 0 16.836 0 7.538 7.538 0 16.836 0c9.298 0 16.836 7.538 16.836 16.836 0 3.22-.905 6.23-2.475 8.79.288.18.56.395.81.645l5.985 5.986A4.54 4.54 0 0 1 38 38.673a4.535 4.535 0 0 1-6.417-.007l-5.986-5.986a4.545 4.545 0 0 1-.77-1.023zm-7.992-4.046c5.95 0 10.775-4.823 10.775-10.774 0-5.95-4.823-10.775-10.774-10.775-5.95 0-10.775 4.825-10.775 10.776 0 5.95 4.825 10.775 10.776 10.775z" fill-rule="evenodd"></path></svg>
			</div>
			<div id="algolia-hits"></div>
			<div id="algolia-pagination"></div>
		</main>
		<aside id="ais-facets">
			<section class="ais-facets" id="facet-post-types"></section>
			<section class="ais-facets" id="facet-categories"></section>
			<section class="ais-facets" id="facet-tags"></section>
			<section class="ais-facets" id="facet-users"></section>
		</aside>
	</div>

<script type="text/html" id="tmpl-instantsearch-hit">
		<article itemtype="http://schema.org/Article">
			<# if ( data.images.thumbnail ) { #>
			<div class="ais-hits--thumbnail">
				<a href="{{ data.permalink }}" title="{{ data.post_title }}">
					<img src="{{ data.images.thumbnail.url }}" alt="{{ data.post_title }}" title="{{ data.post_title }}" itemprop="image" />
				</a>
			</div>
			<# } #>

			<div class="ais-hits--content">
				<h2 itemprop="name headline"><a href="{{ data.permalink }}" title="{{ data.post_title }}" itemprop="url">{{{ data._highlightResult.post_title.value }}}</a></h2>
				<div class="ais-hits--tags">
					<# for (var index in data.taxonomies.post_tag) { #>
					<span class="ais-hits--tag">{{{ data._highlightResult.taxonomies.post_tag[index].value }}}</span>
					<# } #>
				</div>
				<div class="excerpt">
					<p>
						
					</p>
				</div>
			</div>
			<div class="ais-clearfix"></div>
		</article>
	</script>

	<script type="text/html" id="tmpl-instantsearch-lsb_book-hit">
		<article itemtype="http://schema.org/Article">
			<# if ( data.images.thumbnail ) { #>
			<div class="ais-hits--thumbnail">
				<a href="{{ data.permalink }}" title="{{ data.post_title }}">
					<img src="{{ data.images.thumbnail.url }}" alt="{{ data.post_title }}" title="{{ data.post_title }}" itemprop="image" />
				</a>
			</div>
			<# } #>

			<div class="ais-hits--content">
				<h2 itemprop="name headline" style="margin-bottom: 0.3em"><a href="{{ data.permalink }}" title="{{ data.post_title }}" itemprop="url">{{{ data._highlightResult.post_title.value }}}</a></h2>
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
							<span class="glyphicon glyphicon-user" aria-hidden="true" style="color: black; opacity: 0.3; font-size: 90%"></span>
							{{{ creators[creator_index] }}}
						</span>
					<# } #>
					<# for ( var term_index in terms ) { #>
						<span class="ais-hits--tag">
							<span class="glyphicon glyphicon-user" aria-hidden="true" style="color: black; opacity: 0.3; font-size: 90%"></span>
							{{{ terms[term_index] }}}
						</span>
					<# } #>
				</div>
				<div class="excerpt">
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
					<p>{{{ relevant_content }}}</p>
				</div>
			</div>
			<div class="ais-clearfix"></div>
		</article>
	</script>


	<script type="text/javascript">
		jQuery(function() {
			if(jQuery('#algolia-search-box').length > 0) {
				console.log(algolia.indices);
				// Instantiate instantsearch.js
				var search = instantsearch({
					appId: algolia.application_id,
					apiKey: algolia.search_api_key,
					indexName: algolia.indices.searchable_posts.name,
					urlSync: {
						mapping: {'q': 's'},
						trackedParameters: ['query']
					},
					searchParameters: {
						facetingAfterDistinct: true,
						attributesToSnippet: [
							'lsb_review:40',
							'lsb_quote:40'
						]
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
						container: '#algolia-search-box',
						placeholder: 'Search for...',
						wrapInput: false,
						poweredBy: algolia.powered_by_enabled
					})
				);

				// Stats widget
				search.addWidget(
					instantsearch.widgets.stats({
						container: '#algolia-stats'
					})
				);

				// Hits widget
				search.addWidget(
					instantsearch.widgets.hits({
						container: '#algolia-hits',
						hitsPerPage: 10,
						templates: {
							empty: 'No results were found for "<strong>{{query}}</strong>".',
							item: function(item) {
								console.log(item);
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
						container: '#algolia-pagination'
					})
				);

				// Post types refinement widget
				search.addWidget(
					instantsearch.widgets.menu({
						container: '#facet-post-types',
						attributeName: 'post_type_label',
						sortBy: ['isRefined:desc', 'count:desc', 'name:asc'],
						limit: 10,
						templates: {
							header: '<h3 class="widgettitle">Post Type</h3>'
						},
					})
				);

				// Categories refinement widget
				search.addWidget(
					instantsearch.widgets.hierarchicalMenu({
						container: '#facet-categories',
						separator: ' > ',
						sortBy: ['count'],
						attributes: ['taxonomies_hierarchical.category.lvl0', 'taxonomies_hierarchical.category.lvl1', 'taxonomies_hierarchical.category.lvl2'],
						templates: {
							header: '<h3 class="widgettitle">Categories</h3>'
						}
					})
				);

				// Tags refinement widget
				search.addWidget(
					instantsearch.widgets.refinementList({
						container: '#facet-tags',
						attributeName: 'taxonomies.post_tag',
						operator: 'and',
						limit: 15,
						sortBy: ['isRefined:desc', 'count:desc', 'name:asc'],
						templates: {
							header: '<h3 class="widgettitle">Tags</h3>'
						}
					})
				);

				// Users refinement widget
				search.addWidget(
					instantsearch.widgets.menu({
						container: '#facet-users',
						attributeName: 'post_author.display_name',
						sortBy: ['isRefined:desc', 'count:desc', 'name:asc'],
						limit: 10,
						templates: {
							header: '<h3 class="widgettitle">Auteurs</h3>'
						}
					})
				);

				// Start
				search.start();

				jQuery('#algolia-search-box input').attr('type', 'search').select();
			}
		});
	</script>
