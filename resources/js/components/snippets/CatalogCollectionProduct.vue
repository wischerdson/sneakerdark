<script type="text/javascript">
	
	export default {
		template: '#template__snippet_catalog_collection_product',
		props: {
			'title': String,
			'picture': String,
			'vendor': String,
			'url': String,
			'price': Number,
			'sizes': {
				type: Array,
				default () {
					return []
				}
			}
		}
	}

</script>