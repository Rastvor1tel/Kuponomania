Ext.ComponentMgr.onAvailable('minishop2-product-tabs', function() {
    this.on('beforerender', function() {
		this.add({
            title: _('msdo_tab_title')
			,border: false
			,items: [{
					xtype: 'modx-tabs'
					,bodyStyle: 'padding: 10px'
		            ,defaults: { border: false ,autoHeight: true }
		            ,border: false
		            ,hideMode: 'offsets'
					,items: [{
							 title: _('msdo_tab_offers')
							,items: [{
								html: _('msdo_tab_offers_description')
								,bodyCssClass: 'panel-desc'
								,bodyStyle: 'margin-bottom: 10px'
								,border: false
							},{
								xtype: 'msdo-product-offers-grid'
								,preventRender: true
								,border: false
							}]
		                },{
							title: _('msdo_tab_bought')
							,items: [{
									html: _('msdo_tab_bought_description')
									,bodyCssClass: 'panel-desc'
									,bodyStyle: 'margin-bottom: 10px'
									,border: false
								},{
		                    			xtype: 'msdo-product-bought-grid'
									,preventRender: true
									,border: false
								}]
		                	}
					]
				}
            ]
        });
	});
});
