msdo.grid.Bought = function(config) {
	config = config || {};
	config.product_id = msdo.product_id;

	this.sm = new Ext.grid.CheckboxSelectionModel();

	// верхнее меню
	if (!config.menu) {
		config.menu = [];
	}


	if (!config.tbar) {
		config.tbar = [];
	}


	MODx.Ajax.request({
		url: msdo.config.connector_url,
		params: {
			action: 'mgr/bought/getlist',
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
		id: 'msdo-grid-product-bought',
		url: msdo.config.connector_url,
		baseParams: {
			action: 'mgr/bought/getlist',
			product_id: config.product_id
		},
		fields: ['id', 'product_id', 'order_id', 'num',  'user_id', 'email', 'value', 'boughtdon'],
		columns: this.getColumns(),
		paging: true,
		autoHeight: true,
		remoteSort: true,
		sm: this.sm,
		rowOverCls:' test'
		//save_action: 'mgr/bought/updatefromgrid',
		//autosave: true,
		//save_callback: this.updateRow

	});
	msdo.grid.Bought.superclass.constructor.call(this, config);
};
Ext.extend(msdo.grid.Bought, MODx.grid.Grid, {


	getColumns: function() {
		var columns = [this.sm];

		columns.push({
			header: _('msdo_order_id'),
			dataIndex: 'num',
			width: 75,
			sortable: true
		},{
			header: _('msdo_value'),
			dataIndex: 'value',
			width: 75,
			sortable: true
		},{
			header: _('msdo_email'),
			dataIndex: 'email',
			width: 75,
			sortable: true
		},{
			header: _('msdo_boughtdon'),
			dataIndex: 'boughtdon',
			width: 75,
			sortable: true
		});

		return columns;
	}
});
Ext.reg('msdo-product-bought-grid', msdo.grid.Bought);
