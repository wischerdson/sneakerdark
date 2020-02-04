export default {
	templates: [
		'Home',
		'Brands',
		'Search',
		'Wishlist',
		{
			'Catalog': [
				'&Product',
				'&ProductNotFound',
				'&Collection'
			],
			'Legal': [
				'&Refund'
			]
		},
		'Test'
	],
	sections: [
		'Header',
		'Cart',
		'Search',
		'Footer'
	],
	vendor: [
		'Breadcrumb',
		'BreadcrumbItem',
		'Checkbox',
		'Radio',
		'HasScroll',
		'Sticky',
		'Laradata',
		{
			'Tabs': [
				'TabsContent',
				'TabContent',
				'TabsItems',
				'TabItem'
			],
			'Accordion': [
				'Accordion',
				'AccordionItem',
				'AccordionItemHead',
				'AccordionItemContent',
			]
		}
	]
}