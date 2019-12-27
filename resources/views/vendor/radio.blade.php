<template id="template__radio">
	<div class="form-check">
		<input
			type="radio"
			:name="name"
			:id="'radio_' + name + uuid"
			:disabled="disabled"
			:checked="checked"
			@change="handler"
			:value="value"
			class="form-check-input"
		>
		<label class="form-check-label" :for="'radio_' + name + uuid">
			<div class="form-check-body"></div>
			<span><slot></slot></span>
		</label>
	</div>
</template>