<template>
	<div>
		<DataTable
			ref="datatable"
			:mainTitle="i18n('main_title')"
			:defaultOrderByColumn="defaultOrderBy.column"
			:defaultOrderByDirection="defaultOrderBy.direction"
			:paginationLimiting="pagination.limiting"
			:defaultPaginationLimit="pagination.defaultLimit"
			:paginationLimits="pagination.limits"
			:searching="searching"
			:dataStoreStateName="store.stateName"
			:dataLoadingStoreStateName="store.loadingStateName"
			:dataDispatchAction="store.dispatchAction"
			:requestInclude="request.include"
			:requestExtraParameters="request.extraParameters"
			:columns="dataTableColumns"
			:rowsButtons="dataTableRowsButtons"
			:buttonsColumnClass="buttonsColumnClass"
			:checkboxes="dataTableCheckboxes"
			:emptyMessage="i18n('empty_message')"
		>
			<span slot="top-actions">
				<a v-if="realRights.allowCreate" class="action-link pull-right" @click="showCreateModal" v-html="this.i18n('modals.create.show_modal_link')"></a>
			</span>
		</DataTable>
		<CreateModal
			v-if="realRights.allowCreate"
			:id="createModalId"
			:title="createModalTitle"
			:postUri="createModalPostUri"
			:fields="createModalFields"
			:onSuccess="createModalOnSuccess"
		></CreateModal>
		<EditModal
			v-if="realRights.allowEdit"
			:id="editModalId"
			:title="editModalTitle"
			:putUri="editModalPutUri"
			:fields="editModalFields"
			:onSuccess="editModalOnSuccess"
		></EditModal>
		<DeleteModal
			v-if="realRights.allowDelete"
			:id="deleteModalId"
			:title="deleteModalTitle"
			:deleteUri="deleteModalDeleteUri"
			:onSuccess="deleteModalOnSuccess"
			:message="deleteModalMessage"
		></DeleteModal>
		<MassDeleteModal
			v-if="realRights.allowMassDelete"
			:id="massDeleteModalId"
			:title="massDeleteModalTitle"
			:rows="massDeleteModalResourceRows"
			:deleteUriTemplate="deleteModalDeleteUri"
			:onSuccess="massDeleteModalOnSuccess"
			:messageTemplate="massDeleteModalMessage"
		></MassDeleteModal>
	</div>
</template>

<script>
	import DataTable from './datatable'
	import CreateModal from './create-modal'
	import EditModal from './edit-modal'
	import DeleteModal from './delete-modal'
	import MassDeleteModal from './mass-delete-modal'

	export default {

		name: 'DataManager',

		components: { DataTable, CreateModal, EditModal , DeleteModal, MassDeleteModal },

		data() {
			return {
				createModalPostUri: null,
				createModalResourceRow: null,
				editModalPutUri: null,
				editModalResourceRow: null,
				deleteModalDeleteUri: null,
				deleteModalResourceRow: null,
				massDeleteModalResourceRows: null,
			}
		},

		props: {
			rights : {
				type: Object,
				default: function() {
					return {
						allowSee : true,
						allowCreate : true,
						allowEdit : true,
						allowDelete : true,
						allowMassDelete : true,
					}
				}
			},
			i18nPath : {
				type: String,
				default: '',
			},
			resource: {
				type: Object,
				default: function() {
					return {
						name: 'resource.name',
						routePath: 'resource.routePath',
						routeParamsMap: {
							'id': 'id',
						},
						create: {
							postUri: 'resource.create.postUri',
						},
						edit: {
							/* lodash template (eg. "myresourcepath/<%- resourceRow.id %>") */
							putUriTemplate: 'resource.edit.putUriTemplate',
						},
						delete: {
							/* lodash template (eg. "myresourcepath/<%- resourceRow.id %>") */
							deleteUriTemplate: 'resource.delete.deleteUriTemplate'
						},
						/* Specify default new resource values with this object */
						createDefaultResourceRow: {}
					}
				}
			},
			defaultOrderBy: {
				type: Object,
				default: function() {
					return {
						column: 'defaultOrderBy.column',
						direction: 'defaultOrderBy.direction'
					}
				}
			},
			pagination: {
				type: Object,
				default: function() {
					return {
						limiting : false,
						defaultLimit : 20,
						limits : [10, 20, 30, 40, 50],
					}
				}
			},
			searching: {
				type: Boolean,
				default: false,
			},
			request : {
				type: Object,
				default: function() {
					return {
						include: '',
						extraParameters: {},
					}
				}
			},
			store: {
				type: Object,
				default: function() {
					return {
						stateName: 'store.stateName',
						loadingStateName: 'store.loadingStateName',
						dispatchAction: 'store.dispatchAction',
					}
				}
			},
			checkboxes: {
				type: Object,
				default: function() {
					return {
						enabled: true,
						massButtons: [],
					}
				}
			},
			columns: {
				type: Array,
				default: function() {
					return [];
				}
			},
			buttonsColumnClass: {
				type: String,
				default: '',
			},
			rowsButtons: {
				type: Array,
				default: function() {
					return [];
				}
			}
		},

		computed: {
			realRights() {
				var rights = this.rights;

				// Apply default rights

				if (!('allowSee' in rights)) {
					rights.allowSee = true;
				}

				if (!('allowCreate' in rights)) {
					rights.allowCreate = true;
				}

				if (!('allowEdit' in rights)) {
					rights.allowEdit = true;
				}

				if (!('allowDelete' in rights)) {
					rights.allowDelete = true;
				}

				if (!('allowMassDelete' in rights)) {
					rights.allowMassDelete = true;
				}

				return rights;
			},

			dataTableColumns() {
				var dataTableColumns = [];

				_.forEach(this.columns, (column) => {
					var visible = true;
					if (('list' in column) && ('visible' in column.list) && (column.list.visible == false)) {
						visible = false;
					}

					if (visible) {
						var dataTableColumn = {
							name: column.name,
						};

						if (this.i18nExist('columns.' + column.name + '.title')) {
							dataTableColumn.title = this.i18n('columns.' + column.name + '.title');
						} else if (this.i18nExist('columns.' + column.name + '.title')) {
							dataTableColumn.title = column.name;
						}

						if ('displayProp' in column) {
							dataTableColumn.name = column.displayProp;
						}

						if ('class' in column) {
							dataTableColumn.class = column.class;
						}

						if ('orderable' in column) {
							dataTableColumn.orderable = column.orderable;
						}

						if ('order_by_field' in column) {
							dataTableColumn.order_by_field = column.order_by_field;
						}

						if ('routerLink' in column) {
							dataTableColumn.routerLink = column.routerLink;
						}

						if ('transformValue' in column) {
							dataTableColumn.transformValue = column.transformValue;
						}

						dataTableColumns.push(dataTableColumn);
					}
				});

				return dataTableColumns;
			},

			createModalFields() {
				var modalColumns = [];

				this.columns.forEach((column) => {
					if ('create' in column) {
						if (column.create.fillable || column.type == 'hidden') {
							var modalColumn = {
								name: column.name,
								type: column.type,
							};

							if (this.i18nExist('modals.create.fields.' + column.name + '.title')) {
								modalColumn.title = this.i18n('modals.create.fields.' + column.name + '.title');
							} else if (this.i18nExist('columns.' + column.name + '.title'))  {
								modalColumn.title = this.i18n('columns.' + column.name + '.title');
							} else {
								modalColumn.title = modalColumn.name;
							}

							if (this.i18nExist('modals.create.fields.' + column.name + '.help')) {
								modalColumn.help = this.i18n('modals.create.fields.' + column.name + '.help');
							} else if (this.i18nExist('columns.' + column.name + '.help'))  {
								modalColumn.help = this.i18n('columns.' + column.name + '.help');
							} else {
								modalColumn.help = '';
							}

							if ('defaultValue' in column.create) {
								modalColumn.value = column.create.defaultValue;
							}

							if ('select2' in column) {
								modalColumn.select2 = column.select2;
							}

							modalColumns.push(modalColumn);
						}
					}
				});

				return modalColumns;
			},

			editModalFields() {
				var modalColumns = [];

				this.columns.forEach((column) => {
					if ('edit' in column) {
						if (column.edit.fillable || column.type == 'hidden') {
							var modalColumn = {
								name: column.name,
								type: column.type,
							};

							if (this.i18nExist('modals.edit.fields.' + column.name + '.title')) {
								modalColumn.title = this.i18n('modals.edit.fields.' + column.name + '.title');
							} else if (this.i18nExist('columns.' + column.name + '.title'))  {
								modalColumn.title = this.i18n('columns.' + column.name + '.title');
							} else {
								modalColumn.title = modalColumn.name;
							}

							if (this.i18nExist('modals.edit.fields.' + column.name + '.help')) {
								modalColumn.help = this.i18n('modals.edit.fields.' + column.name + '.help');
							} else if (this.i18nExist('columns.' + column.name + '.help'))  {
								modalColumn.help = this.i18n('columns.' + column.name + '.help');
							} else {
								modalColumn.help = '';
							}

							if (this.editModalResourceRow != null) {
								modalColumn.value = column.name.split('.').reduce((o,i)=>o[i], this.editModalResourceRow);
							}

							if ('select2' in column) {
								modalColumn.select2 = column.select2;
							}

							modalColumns.push(modalColumn);
						}
					}
				});

				return modalColumns;
			},

			createModalId() {
				return this.resource.name + '-create-modal';
			},
			editModalId() {
				return this.resource.name + '-edit-modal';
			},
			deleteModalId() {
				return this.resource.name + '-delete-modal';
			},
			massDeleteModalId() {
				return this.resource.name + '-mass-delete-modal';
			},

			createModalTitle() {
				if (this.createModalResourceRow === null) {
					return '';
				}

				var compiledTitleTemplate = _.template(this.i18n('modals.create.title_template'));
				return compiledTitleTemplate({'resourceRow' : this.createModalResourceRow});
			},
			editModalTitle() {
				if (this.editModalResourceRow === null) {
					return '';
				}
				var compiledTitleTemplate = _.template(this.i18n('modals.edit.title_template'));
				return compiledTitleTemplate({'resourceRow' : this.editModalResourceRow});
			},
			deleteModalTitle() {
				if (this.deleteModalResourceRow === null) {
					return '';
				}
				var compiledTitleTemplate = _.template(this.i18n('modals.delete.title_template'));
				return compiledTitleTemplate({'resourceRow' : this.deleteModalResourceRow});
			},
			deleteModalMessage() {
				if (this.deleteModalResourceRow === null) {
					return '';
				}
				var compiledTitleTemplate = _.template(this.i18n('modals.delete.message_template'));
				return compiledTitleTemplate({'resourceRow' : this.deleteModalResourceRow});
			},
			massDeleteModalTitle() {
				if (this.massDeleteModalResourceRows === null) {
					return '';
				}
				var compiledMessageTemplate = _.template(this.i18n('modals.mass_delete.title_template'));
				return compiledMessageTemplate({'resourceRows' : this.massDeleteModalResourceRows});
			},
			massDeleteModalMessage() {
				if (this.massDeleteModalResourceRows === null) {
					return '';
				}
				var compiledMessageTemplate = _.template(this.i18n('modals.mass_delete.message_template'));
				return compiledMessageTemplate({'resourceRows' : this.massDeleteModalResourceRows});
			},

			dataTableCheckboxes() {
				var result = {
					enabled: this.checkboxes.enabled,
				};

				if (('massButtons' in this.checkboxes) && (this.checkboxes.massButtons.length > 0)) {
					result.massButtons = this.checkboxes.massButtons;
				} else {
					result.massButtons = [
						{
							title : this.$i18n.t('common.unselect_all_btn'),
							class : 'btn btn-default',
							onClick : function(rows) {
								var l = rows.length;
								for (var i  = 0 ; i < l ; i++) {
									rows.shift();
								}
							}
						},
					];

					if (this.realRights.allowMassDelete) {
						result.massButtons.push(
							{
								title : this.$i18n.t('common.delete_btn'),
								class : 'btn btn-danger',
								onClick : (rows) => {
									this.massDeleteModalResourceRows = rows;
									$('#' + this.resource.name + '-mass-delete-modal').modal('show');
								}
							}
						);
					}
				}

				return result;
			},

			dataTableRowsButtons() {
				if (this.rowsButtons.length > 0) {
					return this.rowsButtons;
				} else {
					var buttons = [];
					var see_btn_title, edit_btn_title, delete_btn_title;

					if (this.realRights.allowSee) {
						if (this.i18nExist('buttons-column.see')) {
							see_btn_title = this.i18n('buttons-column.see');
						} else {
							see_btn_title = this.$t('common.see_btn');
						}

						buttons.push(
							{
								title : see_btn_title,
								class : 'btn btn-default',
								onClick : (rowResource) => {
									var params = {};

									for (var p in this.resource.routeParamsMap) {
										params[p] = this.resource.routeParamsMap[p].split('.').reduce((o,i)=>o[i], rowResource);
									}

									this.$router.push({
										name: this.resource.routePath,
										params: params
									});
								}
							}
						);
					}

					if (this.realRights.allowEdit) {
						if (this.i18nExist('buttons-column.edit')) {
							edit_btn_title = this.i18n('buttons-column.edit');
						} else {
							edit_btn_title = this.$t('common.edit_btn');
						}
						buttons.push(
							{
								title : edit_btn_title,
								class : 'btn btn-default',
								onClick : (resourceRow) => {
									this.editModalResourceRow = resourceRow;
									var compiledPutUriTemplate = _.template(this.resource.edit.putUriTemplate);
									this.editModalPutUri = compiledPutUriTemplate({'resourceRow' : resourceRow});
									$('#' + this.resource.name + '-edit-modal').modal('show');
								}
							}
						);
					}

					if (this.realRights.allowDelete) {
						if (this.i18nExist('buttons-column.delete')) {
							delete_btn_title = this.i18n('buttons-column.delete');
						} else {
							delete_btn_title = this.$t('common.delete_btn');
						}

						buttons.push(
							{
								title : delete_btn_title,
								class : 'btn btn-danger',
								onClick : (resourceRow) => {
									this.deleteModalResourceRow = resourceRow;
									var compiledDeleteUriTemplate = _.template(this.resource.delete.deleteUriTemplate);
									this.deleteModalDeleteUri = compiledDeleteUriTemplate({'resourceRow' : resourceRow});
									$('#' + this.resource.name + '-delete-modal').modal('show');
								}
							}
						);
					}

					return buttons;
				}
			},
		},

		methods: {

			showCreateModal() {
				this.createModalResourceRow = {};

				if (typeof this.resource.createDefaultResourceRow == 'object') {
					this.createModalResourceRow = this.resource.createDefaultResourceRow;
				}

				this.createModalPostUri = this.resource.create.postUri;

				$('#' + this.resource.name + '-create-modal').modal('show');
			},

			createModalOnSuccess() {
				// Refresh datatables
				this.$refs.datatable.fetchData();
			},

			editModalOnSuccess() {
				// Refresh datatables
				this.$refs.datatable.fetchData();
			},

			deleteModalOnSuccess() {
				// Refresh datatables
				this.$refs.datatable.fetchData();
			},

			massDeleteModalOnSuccess() {
				// Refresh datatables
				this.$refs.datatable.fetchData();
			},

			i18n(path) {
				return this.$i18n.t(this.i18nPath + '.' + path);
			},

			i18nExist(path) {
				return this.$i18n._exist(this.$i18n.messages[this.$i18n.locale], this.i18nPath + '.' + path)
			},
		}
	}
</script>