<template id="template__checkbox">
	<div class="form-group">
		<input
			type="checkbox"
			:name="name"
			:id="'checkbox_' + name + uuid"
			:disabled="disabled"
			:checked="checked"
			@input="handleInput"
			:value="value"
		>
		<label class="checkbox" :for="'checkbox_' + name + uuid">
			<div class="checkbox-body">@include('svg.tick')</div>
			<span><slot></slot></span>
		</label>
	</div>
</template>