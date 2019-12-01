<template id="template__snippet_catalog_collection_filters" >
	<sticky :margin-top="20 + 50">
		<div class="filters" ref="filters">
			<div class="filters-section">
				<div class="section-title">Категория</div>
				<div class="section-body">
					<has-scroll color="rgba(255,255,255,.75)">
						<checkbox name="category">Баскетбол</checkbox>
						<checkbox name="category">Бег</checkbox>
						<checkbox name="category">Ботинки</checkbox>
						<checkbox name="category">Кроссовки с мехом</checkbox>
						<checkbox name="category">Сандалии и сланцы</checkbox>
						<checkbox name="category">Сапоги</checkbox>
						<checkbox name="category">Скейтборд</checkbox>
						<checkbox name="category">Спортивный стиль</checkbox>
						<checkbox name="category">Футбол</checkbox>
						<checkbox name="category">Сандалии и сланцы</checkbox>
						<checkbox name="category">Сапоги</checkbox>
						<checkbox name="category">Скейтборд</checkbox>
						<checkbox name="category">Спортивный стиль</checkbox>
						<checkbox name="category">Футбол</checkbox>
					</has-scroll>
				</div>
			</div>
			<div class="filters-section">
				<div class="section-title">Пол</div>
				<div class="section-body">
					<checkbox name="gender">Мужский</checkbox>
					<checkbox name="gender">Женский</checkbox>
				</div>
			</div>
			<div class="filters-section">
				<div class="section-title">Размер</div>
				<div class="section-body">
					<has-scroll color="rgba(255,255,255,.75)" class_="sizes">
						<checkbox name="size">35</checkbox>
						<checkbox name="size">36</checkbox>
						<checkbox name="size">36.5</checkbox>
						<checkbox name="size">37</checkbox>
						<checkbox name="size">38</checkbox>
						<checkbox name="size">39</checkbox>
					</has-scroll>
				</div>
			</div>
			<div class="filters-section">
				<div class="section-title">Модель</div>
				<div class="section-body">
					<has-scroll color="white">
						<checkbox name="model">бежевый</checkbox>
						<checkbox name="model">коричневый</checkbox>
						<checkbox name="model">песочный</checkbox>
						<checkbox name="model">серый</checkbox>
						<checkbox name="model">синий</checkbox>
						<checkbox name="model">чёрный</checkbox>
					</has-scroll>
				</div>
			</div>
			<div class="filters-section">
				<div class="section-title">Цвет</div>
				<div class="section-body">
					<checkbox name="gender">бежевый</checkbox>
					<checkbox name="gender">коричневый</checkbox>
					<checkbox name="gender">песочный</checkbox>
					<checkbox name="gender">серый</checkbox>
					<checkbox name="gender">синий</checkbox>
					<checkbox name="gender">чёрный</checkbox>
				</div>
			</div>
			<div class="filters-section">
				<div class="section-title">Цена</div>
				<div class="section-body price">
					<div ref="range"></div>
					<div class="row">
						<input type="number" name="price_min" class="form-control" v-model.lazy="price.min">
						<div class="separator"></div>
						<input type="number" name="price_max" class="form-control" v-model.lazy="price.max">
					</div>
				</div>
			</div>
		</div>
	</sticky>
</template>