<template>
	<select style="width: 100%"></select>
</template>
<script>
	export default {
		name: 'Select2',
		props: {
			options : {
				default : function() {
					return [];
				}
			},
			value : null,
			labelProp : {
				type : String,
				default : 'text'
			},
			valueProp : {
				type: String,
				default : 'id'
			},
			feed : {
				default : function() {
					return {
						getUri : null,
						params : {
							limit: 10,
							order_by: '',
						},
						getSingleResourceUri : null,
					};
				}
			},
			multiple : {
				type : Boolean,
				default : false,
			},
			disabled : {
				type : Boolean,
				default : false,
			}
		},
		data() {
			return {
				currentOptions: [],
			}
		},
		watch: {
			value: function (value) {
				// Ignore if undefined value
				if (typeof value === 'undefined') {
					value = null;
				}
				
				if (this.labelProp == this.valueProp) {
					if (this.options.length == 0) {
						if (this.multiple) {
							_.forEach(value, (v) => {
								this.currentOptions = [{
									id: v,
									text: v,
								}];
							});
						} else {
							this.currentOptions = [{
								id: value,
								text: value,
							}];
						}
						
						if ($(this.$el).data('select2')) {
							$(this.$el).select2().empty();
							$(this.$el).select2('destroy');
						}
						$(this.$el).find('option').remove();
						
						this.init();
					}
				} else {
					if ((this.feed.getUri != null) || (('getSingleResourceUri' in this.feed) && (this.feed.getSingleResourceUri != null))) {
						if ($(this.$el).data('select2')) {
							$(this.$el).select2().empty();
							$(this.$el).select2('destroy');
						}
						$(this.$el).find('option').remove();
						
						var baseUri = this.feed.getUri;
						if (('getSingleResourceUri' in this.feed) && (this.feed.getSingleResourceUri != null)) {
							baseUri = this.feed.getSingleResourceUri;
						}
						
						if (this.multiple) {
							let callArray = this.value;
							
							let promiseArray = callArray.map((v) => apiAxios.get(baseUri + '/' + v));
							
							Promise.all(promiseArray)
								.then((results) => {
									this.currentOptions = []
									_.forEach(results, (response) => {
										this.currentOptions.push({
											id: response.data.data[this.valueProp],
											text: response.data.data[this.labelProp],
										});
									});
									this.initWithDefaultValueFromAjax();
								})
								.catch(error => {
									this.$root.axiosError(error);
								});
						} else if (value != null) {
							apiAxios
								.get(baseUri + '/' + this.value)
								.then(response => {
									this.currentOptions = [{
										id: this.value,
										text: response.data.data[this.labelProp],
									}];
									this.initWithDefaultValueFromAjax();
								})
								.catch(error => {
									this.$root.axiosError(error);
								});
						} else {
							this.currentOptions = [];
							this.initWithDefaultValueFromAjax();
						}
						return;
					}
				}
				
				$(this.$el).val(value).trigger('change');
			},
			
			options: function (options) {
				// Initial options
				var oldValue = this.value;
				var oldValueFound = false;
				this.currentOptions = [];
				if (this.options.length > 0) {
					this.options.forEach((option) => {
						if (option[this.valueProp] == oldValue) {
							oldValueFound = true;
						}
						this.currentOptions.push({
							id: option[this.valueProp],
							text: option[this.labelProp],
						})
					});
				}
				
				if ($(this.$el).data('select2')) {
					$(this.$el).select2().empty();
					$(this.$el).select2('destroy');
				}
				$(this.$el).find('option').remove();
				
				// Select first option in this case
				if (!oldValueFound && (this.currentOptions.length > 0)) {
					//this.value = this.currentOptions[0].id;
				}
				
				this.init();
			}
		},
		mounted() {
			// Initial options
			if (this.options.length > 0) {
				this.options.forEach((option) => {
					this.currentOptions.push({
						id: option[this.valueProp],
						text: option[this.labelProp],
					})
				});
			}
			
			this.init();
		},
		destroyed() {
			if ($(this.$el).data('select2')) {
				$(this.$el).off().select2('destroy');
			}
		},
		methods : {
			initWithDefaultValueFromAjax() {
				var config = {};
				
				config.data = this.currentOptions;
				
				config.multiple = this.multiple;
				
				config.disabled = this.disabled;
				
				// Ajax feed
				if (this.feed.getUri != null) {
					config.ajax = {
						url: this.feed.getUri,
						delay : 250,
						data: (params) => {
							var query = {
								page: 1,
								limit: this.feed.limit,
								order_by: this.feed.order_by
							};
							
							if (params.term) {
								query.search = params.term + '*';
							}
							
							if (params.page) {
								query.page = params.page;
							}
							
							return query;
						},
						transport: (params, success, failure) => {
							var config = {
								params: params.data
							};
							apiAxios
								.get(this.feed.getUri, config)
								.then(success)
								.catch(failure);
						},
						processResults: (data, params) => {
							var results = [];
							data.data.data.forEach((row) => {
								results.push({
									id : row[this.valueProp],
									text : row[this.labelProp],
								});
							});
							return {
								results : results,
								pagination: {
									more: (data.data.meta.pagination.current_page < data.data.meta.pagination.total_pages)
								},
								totals : data.data.meta.pagination.total
							};
						}
					}
				}
				
				$(this.$el).select2(config);
				
				// Default value
				if (this.value != null) {
					$(this.$el).val(this.value).trigger('change');
				}
				
				$(this.$el).unbind('select2:select').on('select2:select', (evt) => {
					this.$emit('input', $(this.$el).val());
				});
				
				$(this.$el).unbind('select2:unselect').on('select2:unselect', (evt) => {
					this.$emit('input', $(this.$el).val());
				});
			},
			
			init() {
				var config = {};
				
				// Default value
				if (this.value != null) {
					if (this.labelProp == this.valueProp) {
						if (this.options.length == 0) {
							if (this.multiple) {
								this.currentOptions = [];
								_.forEach(this.value, (v) => {
									this.currentOptions.push({
										id: v,
										text: v,
									});
								});
							} else {
								this.currentOptions = [{
									id: this.value,
									text: this.value,
								}];
							}
						}
					} else if ((this.feed.getUri != null) || (('getSingleResourceUri' in this.feed) && (this.feed.getSingleResourceUri != null))) {
						
						var baseUri = this.feed.getUri;
						if (('getSingleResourceUri' in this.feed) && (this.feed.getSingleResourceUri != null)) {
							baseUri = this.feed.getSingleResourceUri;
						}
						
						if (this.multiple) {
							let callArray = this.value;
							
							let promiseArray = callArray.map((v) => apiAxios.get(baseUri + '/' + v));
							
							Promise.all(promiseArray)
								.then((results) => {
									this.currentOptions = []
									_.forEach(results, (response) => {
										this.currentOptions.push({
											id: response.data.data[this.valueProp],
											text: response.data.data[this.labelProp],
										});
									});
									this.initWithDefaultValueFromAjax();
								})
								.catch(error => {
									this.$root.axiosError(error);
								});
						} else {
							apiAxios
								.get(baseUri + '/' + this.value)
								.then(response => {
									this.currentOptions = [{
										id: this.value,
										text: response.data.data[this.labelProp],
									}];
									this.initWithDefaultValueFromAjax();
								})
								.catch(error => {
									this.$root.axiosError(error);
								});
						}
						return;
					}
				}
				
				config.data = this.currentOptions;
				
				config.multiple = this.multiple;
				
				config.disabled = this.disabled;
				
				// Ajax feed
				if (this.feed.getUri != null) {
					config.ajax = {
						url: this.feed.getUri,
						delay : 250,
						data: (params) => {
							var query = {
								page: 1,
								limit: this.feed.limit,
								order_by: this.feed.order_by
							}
							
							if (params.term) {
								query.search = params.term + '*';
							}
							
							if (params.page) {
								query.page = params.page;
							}
							
							return query;
						},
						transport: (params, success, failure) => {
							var config = {
								params: params.data
							};
							apiAxios
								.get(this.feed.getUri, config)
								.then(success)
								.catch(failure);
						},
						processResults: (data, params) => {
							var results = [];
							data.data.data.forEach((row) => {
								results.push({
									id : row[this.valueProp],
									text : row[this.labelProp],
								});
							});
							return {
								results : results,
								pagination: {
									more: (data.data.meta.pagination.current_page < data.data.meta.pagination.total_pages)
								},
								totals : data.data.meta.pagination.total
							};
						}
					}
				}
				
				$(this.$el).select2(config);
				
				// Default value
				if (this.value != null) {
					$(this.$el).val(this.value).trigger('change');
				}
				
				$(this.$el).unbind('select2:select').on('select2:select', (evt) => {
					this.$emit('input', $(this.$el).val());
				});
				$(this.$el).unbind('select2:unselect').on('select2:unselect', (evt) => {
					this.$emit('input', $(this.$el).val());
				});
			}
		}
	}
</script>