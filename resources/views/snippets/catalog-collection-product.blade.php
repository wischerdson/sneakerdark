<template id="template__snippet_catalog_collection_product">
	<li class="product-item">
		<a :href="url">
			<div class="picture-wrapper">
				<ul class="sizes-panel" @click.prevent="">
					<div class="size-item"><button class="size btn">38</button></div>
					<div class="size-item"><button class="size btn">39</button></div>
					<div class="size-item"><button class="size btn">40</button></div>
					<div class="size-item"><button class="size btn">41</button></div>
					<div class="size-item"><button class="size btn">42</button></div>
					<div class="size-item"><button class="size btn">43</button></div>
					<div class="size-item"><button class="size btn">44</button></div>
				</ul>
				<div class="square">
					<div class="picture" :style="`background-image: url(${picture})`"></div>
				</div>
			</div>
			
			<div class="text">
				<div class="vendor">@{{ vendor }}</div>
				<div class="title">@{{ title }}</div>
				<div class="price-wrapper">
					<div class="compare-at-price">@{{ price*1.2 }}</div>
					<div class="price">@{{ price }}</div>
				</div>
			</div>
		</a>
	</li>
</template>