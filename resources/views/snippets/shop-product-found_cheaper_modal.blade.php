<div class="found-cheaper-modal" v-show="foundCheaperModalIsOpen">
	<div class="overlay" @click="foundCheaperModalIsOpen = false"></div>
	<div class="box">
		<div class="close" @click="foundCheaperModalIsOpen = false">@include('svg.cross')</div>
		<div class="content">
			<div class="top">
				<div class="title">Нашли этот товар дешевле?</div>
				<p class="text">Пришлите нам ссылку на этот товар в другом магазине,<br>и в течение суток Вы получите SMS с уникальным промокодом.<br>В случае отказа, информация поступит на указанный Вами e-mail.</p>
			</div>
			<div class="bottom">
				<form>
					<div class="form-group">
						<label for="foundCheaperForm_name" required>Имя</label>
						<input type="text" class="form-control" name="name" id="foundCheaperForm_name" placeholder="Даниил">
					</div>
					<div class="form-group">
						<label for="foundCheaperForm_email" required>E-mail</label>
						<input class="form-control" id="foundCheaperForm_email" type="text" name="email" placeholder="example@example.com">
					</div>
					<div class="form-group">
						<label for="foundCheaperForm_phone" required>Телефон</label>
						<div class="field phone-field">
							<div class="prefix">+</div>
							<input class="form-control" id="foundCheaperForm_phone" value="7" type="text" name="phone">
						</div>
					</div>
					<div class="form-group">
						<label for="foundCheaperForm_shopLink" required>Ссылка на товар в другом магазине</label>
						<input class="form-control" id="foundCheaperForm_shopLink" type="text" name="shop_link" placeholder="https://example.com/...">
					</div>
					<button class="btn primary" type="submit">Отправить заявку</button>
				</form>
				<div class="ps">
					<a href="#">Правила и условия акции</a>
				</div>
			</div>
		</div>
	</div>
</div>