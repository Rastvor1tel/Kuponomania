msdo.grid.Offers = function(config) {
	config = config || {};
	config.product_id = msdo.product_id;

	this.sm = new Ext.grid.CheckboxSelectionModel();


	// верхнее меню
	if (!config.menu) {
		config.menu = [];
	}
	config.menu.push({
		text: _('msdo_price_selected_set_active'),
		handler: this.activeSelected,
		scope: this
	}, {
		text: _('msdo_price_selected_set_inactive'),
		handler: this.inactiveSelected,
		scope: this
	});
	config.menu.push('-');
	config.menu.push({
		text: _('msdo_price_selected_delete'),
		handler: this.deleteSelected,
		scope: this
	});





	if (!config.tbar) {
		config.tbar = [];
	}
	config.tbar.push({
		text: '<i class="icon icon-list"></i> ' + _('msdo_bulk_actions'),
		menu: config.menu
	}, '-', {
		text: '<i class="icon icon-plus"></i> ' + _('msdo_menu_create_offer'),
		handler: this.createOffer,
		scope: this
	});


	//if(MODx.config.msdo_type == 1) {
		config.tbar.push({
			text: '<i class="icon icon-list-ul"></i> ' + _('msdo_menu_create_offers'),
			handler: this.createOffers,
			scope: this
		});
	//}



	//config.tbar.push('->', {});

	MODx.Ajax.request({
		url: msdo.config.connector_url,
		params: {
			action: 'mgr/offers/getlist',
			product_id: config.product_id
		},
		listeners: {
			success: { fn: function(r){
				//console.log(r)
			},
			scope: this }
		}
	});

	Ext.applyIf(config, {
		id: 'msdo-grid-product-price',
		url: msdo.config.connector_url,
		baseParams: {
			action: 'mgr/offers/getlist',
			product_id: config.product_id
		},
		fields: ['id', 'product_id', 'value', 'createdon', 'active'],
		columns: this.getColumns(),
		paging: true,
		autoHeight: true,
		remoteSort: true,
		sm: this.sm,
		save_action: 'mgr/offers/updatefromgrid',
		autosave: true,
		save_callback: this.updateRow

	});
	msdo.grid.Offers.superclass.constructor.call(this, config);
};
Ext.extend(msdo.grid.Offers, MODx.grid.Grid, {

	getMenu: function() {
		var m = [];
		m.push({
			text: _('msdo_menu_update'),
			handler: this.updatePrice
		});
		m.push({
			text: _('msdo_menu_remove'),
			handler: this.removePrice
		});
		this.addContextMenuItem(m);
	},

	getColumns: function() {
		var columns = [this.sm];

		columns.push({
			header: _('msdo_value'),
			dataIndex: 'value',
			width: 75,
			sortable: true
		},{
			header: _('msdo_createdon'),
			dataIndex: 'createdon',
			width: 75,
			sortable: true
		},{
			header: _('msdo_active'),
			dataIndex: 'active',
			sortable: true,
			width: 50,
			editor: {
				xtype: 'combo-boolean',
				renderer: 'boolean'
			}
		});

		return columns;
	},

	updateRow: function(response) {
		var row = response.object;
		var items = this.store.data.items;

		for (var i = 0; i < items.length; i++) {
			var item = items[i];
			if (item.id == row.id) {
				item.data = row;
			}
		}
	},

	createOffer: function(btn, e) {

		var product_id = btn.scope.config.product_id;

		if (this.windows.createOffer) {
			try {
				this.windows.createOffer.close();
				this.windows.createOffer.destroy();
				this.windows.createOffer = undefined;
			} catch (e) {}
		}

		if (!this.windows.createOffer) {
			this.windows.createOffer = MODx.load({
				xtype: 'msdo-window-price-create',
				title: _('msdo_title_create_offer'),
				fields: this.getPriceFields('create'),
				baseParams: {
					action: 'mgr/offers/create'
				},
				listeners: {
					success: {
						fn: function() {
							this.refresh();
						},
						scope: this
					}
				}
			});
		}
		this.windows.createOffer.fp.getForm().reset();
		this.windows.createOffer.fp.getForm().setValues({
			product_id: product_id,
			active: 1,
			count: 0
		});
		this.windows.createOffer.show(e.target);
	},

	updatePrice: function(btn, e, row) {
		if (typeof(row) != 'undefined') {
			this.menu.record = row.data;
		}
		var id = this.menu.record.id;
		var product_id = btn.scope.config.product_id;

		MODx.Ajax.request({
			url: msdo.config.connector_url,
			params: {
				action: 'mgr/offers/get',
				id: id
			},
			listeners: {
				success: {
					fn: function(r) {

						if (this.windows.updatePrice) {
							try {
								this.windows.updatePrice.close();
								this.windows.updatePrice.destroy();
							} catch (e) {}
						}
						this.windows.updatePrice = MODx.load({
							xtype: 'msdo-window-price-update',
							title: _('msdo_title_update_offer'),
							record: r.object,
							fields: this.getPriceFields('update'),
							listeners: {
								success: {
									fn: function() {
										this.refresh();
									},
									scope: this
								}
							}
						});
						this.windows.updatePrice.fp.getForm().reset();
						this.windows.updatePrice.fp.getForm().setValues(r.object);
						this.windows.updatePrice.show(e.target);
					},
					scope: this
				}
			}
		});
	},

	createOffers: function(btn, e) {

		var product_id = btn.scope.config.product_id;

		if (this.windows.createOffers) {
			try {
				this.windows.createOffers.close();
				this.windows.createOffers.destroy();
				this.windows.createOffers = undefined;
			} catch (e) {}
		}

		if (!this.windows.createOffers) {
			this.windows.createOffers = MODx.load({
				xtype: 'msdo-window-offers-create',
				title: _('msdo_title_create_offers'),
				fields: [{
						html: _('msdo_title_create_offers_desc')
						,baseCls: 'panel-desc'
						,bodyStyle: 'margin-bottom: 10px'
					},{
						xtype: 'hidden',
						name: 'product_id'
					}, {
						xtype: 'textarea',
						hideLabel: true,
						name: 'value',
						allowBlank:false,
						anchor: '99%'
				}],
				baseParams: {
					action: 'mgr/offers/create-list'
				},
				listeners: {
					success: {
						fn: function() {
							this.refresh();
						},
						scope: this
					}
				}
			});
		}
		this.windows.createOffers.fp.getForm().reset();
		this.windows.createOffers.fp.getForm().setValues({
			product_id: product_id
		});
		this.windows.createOffers.show(e.target);
	},


	getPriceFields: function(type) {

		var fields = [];
		var disabled = type == 'update' ? true : false;

		fields.push({
			xtype: 'hidden',
			name: 'id',
			id: 'msdo-product-price-id-' + type
		}, {
			xtype: 'hidden',
			name: 'product_id',
			id: 'msdo-product-product_id-' + type
		}, {
			html: _('msdo_title_create_offer_desc')
			,baseCls: 'panel-desc'
			,bodyStyle: 'margin-bottom: 10px'
		},{
			xtype: 'textfield',
			fieldLabel: _('msdo_value'),
			name: 'value',
			hideLabel: true,
			allowBlank:false,
			anchor: '99%'
		 });

		fields.push({
			xtype: 'xcheckbox',
			boxLabel: _('msdo_active'),
			name: 'active',
			id: 'msdo-product-option-active-' + type,
			hideLabel: true,
		});

		return fields;
	},

	removePrice: function(btn, e) {
		if (this.menu.record) {
			MODx.msg.confirm({
				title: _('msdo_menu_remove'),
				text: _('msdo_menu_remove_confirm'),
				url: msdo.config.connector_url,
				params: {
					action: 'mgr/offers/remove',
					id: this.menu.record.id
				},
				listeners: {
					success: {
						fn: function(r) {
							this.refresh();
						},
						scope: this
					}
				}
			});
		}
	},

	deleteSelected: function(btn, e) {
		var cs = this.getSelectedAsList();
		if (cs === false) return false;

		MODx.msg.confirm({
			title: _('msdo_menu_remove'),
			text: _('msdo_menu_remove_multiple_confirm'),
			url: msdo.config.connector_url,
			params: {
				action: 'mgr/offers/delete_multiple',
				ids: cs
			},
			listeners: {
				'success': {
					fn: function(r) {
						this.getSelectionModel().clearSelections(true);
						this.refresh();
					},
					scope: this
				}
			}
		});

		return true;
	},

	activeSelected: function(btn, e) {
		var cs = this.getSelectedAsList();
		if (cs === false) return false;

		MODx.msg.confirm({
			title: _('msdo_menu_active'),
			text: _('msdo_menu_active_multiple_confirm'),
			url: msdo.config.connector_url,
			params: {
				action: 'mgr/offers/active_multiple',
				ids: cs,
				value: 1
			},
			listeners: {
				'success': {
					fn: function(r) {
						this.getSelectionModel().clearSelections(true);
						this.refresh();
					},
					scope: this
				}
			}
		});

		return true;
	},

	inactiveSelected: function(btn, e) {
		var cs = this.getSelectedAsList();
		if (cs === false) return false;

		MODx.msg.confirm({
			title: _('msdo_menu_inactive'),
			text: _('msdo_menu_inactive_multiple_confirm'),
			url: msdo.config.connector_url,
			params: {
				action: 'mgr/offers/active_multiple',
				ids: cs,
				value: 0
			},
			listeners: {
				'success': {
					fn: function(r) {
						this.getSelectionModel().clearSelections(true);
						this.refresh();
					},
					scope: this
				}
			}
		});

		return true;
	}

});
Ext.reg('msdo-product-offers-grid', msdo.grid.Offers);


msdo.window.createOffer = function(config) {
	config = config || {};
	this.ident = config.ident || 'meuitem' + Ext.id();
	Ext.applyIf(config, {
		title: _('msdo_menu_create'),
		id: this.ident,
		width: 600,
		autoHeight: true,
		labelAlign: 'left',
		labelWidth: 180,
		url: msdo.config.connector_url,
		action: 'mgr/offers/create',
		fields: config.fields,
		keys: [{
			key: Ext.EventObject.ENTER,
			shift: true,
			fn: function() {
				this.submit()
			},
			scope: this
		}]
	});
	msdo.window.createOffer.superclass.constructor.call(this, config);
};
Ext.extend(msdo.window.createOffer, MODx.Window);
Ext.reg('msdo-window-price-create', msdo.window.createOffer);


msdo.window.UpdatePrice = function(config) {
	config = config || {};
	this.ident = config.ident || 'meuitem' + Ext.id();
	Ext.applyIf(config, {
		title: _('msdo_menu_update'),
		id: this.ident,
		width: 600,
		autoHeight: true,
		labelAlign: 'left',
		labelWidth: 180,
		url: msdo.config.connector_url,
		action: 'mgr/offers/update',
		fields: config.fields,
		keys: [{
			key: Ext.EventObject.ENTER,
			shift: true,
			fn: function() {
				this.submit()
			},
			scope: this
		}]
	});
	msdo.window.UpdatePrice.superclass.constructor.call(this, config);
};
Ext.extend(msdo.window.UpdatePrice, MODx.Window);
Ext.reg('msdo-window-price-update', msdo.window.UpdatePrice);


// окно создания списка кодов
msdo.window.CreateOffers = function(config) {
	config = config || {};
	this.ident = config.ident || 'meuitem' + Ext.id();
	Ext.applyIf(config, {
		title: _('msdo_title_create_offers'),
		id: this.ident,
		width: 600,
		autoHeight: true,
		labelAlign: 'left',
		labelWidth: 180,
		url: msdo.config.connector_url,
		action: 'mgr/offer/create-list',
		fields: config.fields,
		keys: [{
			key: Ext.EventObject.ENTER,
			shift: true,
			fn: function() {
				this.submit()
			},
			scope: this
		}]
	});
	msdo.window.CreateOffers.superclass.constructor.call(this, config);
};
Ext.extend(msdo.window.CreateOffers, MODx.Window);
Ext.reg('msdo-window-offers-create', msdo.window.CreateOffers);
