<script type="text/html" id="tmpl-autocomplete-empty">
	<div class="autocomplete-header">
		<div class="autocomplete-header-title">Ingen treff</div>
		<div class="clear"></div>
		<span class="suggestion-post-title">Ingen treff for {{{ data.query }}}</span>
	</div>
</script>


<script type="text/html" id="tmpl-autocomplete-header">
	<div class="autocomplete-header">
		<div class="autocomplete-header-title">{{ data.label }}</div>
		<div class="clear"></div>
	</div>
</script>

<script type="text/html" id="tmpl-autocomplete-lsb_book-suggestion">
	<a class="suggestion-link" href="{{ data.permalink }}" title="{{ data.post_title }}">
		<# if ( data.images.thumbnail ) { #>
		<img class="suggestion-post-thumbnail" src="{{ data.images.thumbnail.url }}" alt="{{ data.post_title }}">
		<# } #>
		<div class="suggestion-post-attributes">
			<span class="suggestion-post-title">{{{ data._highlightResult.post_title.value }}}</span>

			<#

			var relevant_content = '';
			
			var creators = [];
			var relevant_creators = [];
			var relevant_taxonomies = [];

			for ( var tax_key in data._highlightResult.taxonomies ) {	
				var terms = data._highlightResult.taxonomies[tax_key];
				for ( var term_index in terms ) {
					var term = terms[term_index];					
					if( tax_key === 'lsb_tax_author' || tax_key === 'lsb_tax_illustrator' || tax_key === 'lsb_tax_translator') {
						creators.push(term.value);
						if ( term.matchedWords.length > 0 ) {
							relevant_creators.push(term.value);
						} 
					} else if ( term.matchedWords.length > 0 ) {
						relevant_taxonomies.push(term.value);
					}
				}
			}

			if ( data._highlightResult.post_title.matchedWords.length > 0 || relevant_creators.length > 0 ) {
				creators = jQuery.unique(creators);
				relevant_content = '<span class="glyphicon glyphicon-user" aria-hidden="true" style="color: black; opacity: 0.3"></span> ' + creators.join(", ");
			} else if ( relevant_taxonomies.length > 0 ) {
				relevant_taxonomies = jQuery.unique(relevant_taxonomies);
				relevant_content = '<span class="glyphicon glyphicon-tag" aria-hidden="true" style="color: black; opacity: 0.3"></span> ' + relevant_taxonomies.join(", ");
			} else if ( data._highlightResult.lsb_isbn && data._highlightResult.lsb_isbn.matchedWords.length > 0 ) {
				relevant_content = '<span class="glyphicon glyphicon-barcode" aria-hidden="true" style="color: black; opacity: 0.3"></span> ' + data._highlightResult.lsb_isbn.value;
			} else {
				for ( var snippet_index in data._snippetResult ) {
					var snippet = data._snippetResult[snippet_index];
					if( snippet.matchLevel !== 'none') {
						relevant_content = snippet.value;
						break;
					}
				}
			}

			if (relevant_content === '') {
				relevant_content = '<span class="glyphicon glyphicon-user" aria-hidden="true" style="color: black; opacity: 0.3"></span> ' + creators.join(", ");
			}

			#>
			<span class="suggestion-post-content">{{{ relevant_content }}}</span>
		</div>
	</a>
</script>

<script type="text/html" id="tmpl-autocomplete-post-suggestion">
	<a class="suggestion-link" href="{{ data.permalink }}" title="{{ data.post_title }}">
		<# if ( data.images.thumbnail ) { #>
		<img class="suggestion-post-thumbnail" src="{{ data.images.thumbnail.url }}" alt="{{ data.post_title }}">
		<# } #>
		<div class="suggestion-post-attributes">
			<span class="suggestion-post-title">{{{ data._highlightResult.post_title.value }}}</span>

			<#
			var attributes = ['content', 'title6', 'title5', 'title4', 'title3', 'title2', 'title1'];
			var attribute_name;
			var relevant_content = '';
			for ( var index in attributes ) {
				attribute_name = attributes[ index ];
				if ( data._highlightResult[ attribute_name ].matchedWords.length > 0 ) {
					relevant_content = data._snippetResult[ attribute_name ].value;
					break;
				} else if( data._snippetResult[ attribute_name ].value !== '' ) {
					relevant_content = data._snippetResult[ attribute_name ].value;
				}
			}
			#>
			<span class="suggestion-post-content">{{{ relevant_content }}}</span>
		</div>
	</a>
</script>

<script type="text/html" id="tmpl-autocomplete-term-suggestion">
	<a class="suggestion-link" href="{{ data.permalink }}"  title="{{ data.name }}">
		<span class="suggestion-post-title">
			<# if ( data.hasOwnProperty('taxonomy') &&  ( data.taxonomy === 'lsb_tax_author' || data.taxonomy === 'lsb_tax_illustrator') ) { #>
    		<span class="glyphicon glyphicon-user" aria-hidden="true" style="color: black; opacity: 0.3"></span>
  		<# } else { #>
			<span class="glyphicon glyphicon-tag" aria-hidden="true" style="color: black; opacity: 0.3"></span>
			<# } #>
			{{{ data._highlightResult.name.value }}}
		</span>
		<#
		var relevant_content = '';
		for ( var snippet_index in data._snippetResult ) {
			var snippet = data._snippetResult[snippet_index];
			if( snippet.matchLevel !== 'none') {
				relevant_content = snippet.value;
				break;
			}
		}
		#>
		<span class="suggestion-post-content">{{{ relevant_content }}}</span>

	</a>
</script>

<script type="text/html" id="tmpl-autocomplete-user-suggestion">
	<a class="suggestion-link user-suggestion-link" href="{{ data.posts_url }}"  title="{{ data.display_name }}">
		<# if ( data.avatar_url ) { #>
		<img class="suggestion-user-thumbnail" src="{{ data.avatar_url }}" alt="{{ data.display_name }}">
		<# } #>

		<span class="suggestion-post-title">{{{ data._highlightResult.display_name.value }}}</span>
	</a>
</script>

<script type="text/html" id="tmpl-autocomplete-footer">
	<div class="autocomplete-footer">
		<div class="autocomplete-footer-branding">
			<?php esc_html_e( 'Powered by', 'algolia' ); ?>
			<a href="#" class="algolia-powered-by-link" title="Algolia">
				<img class="algolia-logo" src="https://www.algolia.com/assets/algolia128x40.png" alt="Algolia" />
			</a>
		</div>
	</div>
</script>

<script type="text/html" id="tmpl-autocomplete-empty">
	<div class="autocomplete-empty">
		<?php esc_html_e( 'No results matched your query ', 'algolia' ); ?>
		<span class="empty-query">{{ data.query }}"</span>
	</div>
</script>

<script type="text/javascript">
	jQuery(function () {
		// init Algolia client
		var client = algoliasearch(algolia.application_id, algolia.search_api_key);

		// setup default sources
		var sources = [];
		jQuery.each(algolia.autocomplete.sources, function(i, config) {
			var filters = '';
			var label_extra = '';
			if(config['index_name'].indexOf('lsb_book') > -1) {
				var tax_filter = jQuery("#algolia-filter").data('tax-term');
				if( tax_filter.hasOwnProperty('taxonomy')) {
					console.log(tax_filter);
					filters = "taxonomies." + tax_filter.taxonomy + ":'" + tax_filter.term_name + "'";
					label_extra = " i " + tax_filter.term_label;
				}
			}
			sources.push({
				source: autocomplete.sources.hits(client.initIndex(config['index_name']), {
					hitsPerPage: config['max_suggestions'],
					filters: filters,
					attributesToSnippet: [
						'lsb_review:10',
						'lsb_quote:10',
						'description: 10'
					]
				}),
				templates: {
					header: function() {
						return wp.template('autocomplete-header')({
							label: config['label'] + label_extra
						});
					},
					suggestion: function(suggestion) {
						var template = wp.template(config['tmpl_suggestion']);
						if(suggestion.hasOwnProperty('post_type') && suggestion['post_type'] === 'lsb_book') {
							template = wp.template("autocomplete-" + suggestion['post_type'] + "-suggestion");
						} 
            return template(suggestion);
          }
				}
			});

		});

		// Setup dropdown menus
		jQuery("input[name='s']").each(function(i) {
			var $searchInput = jQuery(this);

			var config = {
				debug: algolia.debug,
				hint: false,
				openOnFocus: true,
				templates: {
					empty: wp.template('autocomplete-empty')
				},
				keyboardShortcuts: ['s']
			};
			//Todo: Add empty template when we fixed https://github.com/algolia/autocomplete.js/issues/109

			// Instantiate autocomplete.js
			autocomplete($searchInput[0], config, sources)
			.on('autocomplete:selected', function(e, suggestion, datasetName) {
				// Redirect the user when we detect a suggestion selection.
				window.location.href = suggestion.permalink;
			});

			var $autocomplete = $searchInput.parent();

			// Remove autocomplete.js default inline input search styles.
			$autocomplete.removeAttr('style');

			// Configure tether
			var $menu = $autocomplete.find('.aa-dropdown-menu');
			var config = {
				element: $menu,
				target: this,
				attachment: 'top left',
				targetAttachment: 'bottom left',
				constraints: [
					{
						to: 'window',
						attachment: 'none element'
					}
				]
			};

			// This will make sure the dropdown is no longer part of the same container as
			// the search input container.
			// It ensures styles are not overridden and limits theme breaking.
			var tether = new Tether(config);
			tether.on('update', function(item) {
				// todo: fix the inverse of this: https://github.com/HubSpot/tether/issues/182
				if (item.attachment.left == 'right' && item.attachment.top == 'top' && item.targetAttachment.left == 'left' && item.targetAttachment.top == 'bottom') {
					config.attachment = 'top right';
					config.targetAttachment = 'bottom right';

					tether.setOptions(config, false);
				}
			});
			$searchInput.on('autocomplete:updated', function() {
				tether.position();
			});
			$searchInput.on('autocomplete:opened', function() {
				updateDropdownWidth();
			});


			// Trick to ensure the autocomplete is always above all.
			$menu.css('z-index', '99999');

			// Makes dropdown match the input size.
			var dropdownMinWidth = 200;
			function updateDropdownWidth() {
				var inputWidth = $searchInput.outerWidth();
				if (inputWidth >= dropdownMinWidth) {
					$menu.css('width', $searchInput.outerWidth());
				} else {
					$menu.css('width', dropdownMinWidth);
				}
				tether.position();
			}
			jQuery(window).on('resize', updateDropdownWidth);
		});

		// This ensures that when the dropdown overflows the window, Thether can reposition it.
		jQuery('body').css('overflow-x', 'hidden');

		jQuery(document).on("click", ".algolia-powered-by-link", function(e) {
			e.preventDefault();
			window.location = "https://www.algolia.com/?utm_source=WordPress&utm_medium=extension&utm_content=" + window.location.hostname + "&utm_campaign=poweredby";
		});
	});
</script>
