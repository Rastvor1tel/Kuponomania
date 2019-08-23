DialBonus.grid.DialBonus = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'dialbonus-grid-groups',
        url: DialBonus.config.connectorUrl,
        baseParams: { action: 'mgr/groups/getList' },
        fields: ['id', 'order_sum', 'discount_value', 'menu'],
        paging: true,
        remoteSort: true,
        anchor: '97%',
        autoExpandColumn: 'value',
        save_action: 'mgr/groups/updateFromGrid',
        autosave: true,
        columns: [{
            header: _('id'),
            dataIndex: 'id',
            sortable: true,
            width: 60
        },{
            header: _('order_sum'),
            dataIndex: 'order_sum',
            sortable: true,
            width: 100,
            editor: { xtype: 'textfield' }
        },{
            header: _('discount_value'),
            dataIndex: 'discount_value',
            sortable: true,
            width: 100,
            editor: { xtype: 'textfield' }
        }],
        tbar:[{
            xtype: 'textfield',
            id: 'dialbonus-groups-search-filter',
            emptyText: _('search'),
            listeners: {
                'change': {
                    fn:this.search,
                    scope:this
                },
                'render': {
                    fn: function(cmp) {
                        new Ext.KeyMap(cmp.getEl(), {
                            key: Ext.EventObject.ENTER,
                            fn: function() {
                                this.fireEvent('change',this);
                                this.blur();
                                return true;
                            },
                            scope: cmp
                        });
                    },
                    scope:this
                }
            }
        }]
    });
    DialBonus.grid.DialBonus.superclass.constructor.call(this,config)
};

Ext.extend(DialBonus.grid.DialBonus,MODx.grid.Grid,{
    search: function(tf,nv,ov) {
        var s = this.getStore();
        s.baseParams.query = tf.getValue();
        this.getBottomToolbar().changePage(1);
        this.refresh();
    },
    getMenu: function() {
        return [{
            text: _('edit'),
            handler: this.updateGroup
        },'-',{
            text: _('remove'),
            handler: this.removeGroup
        }];
    },
    updateGroup: function(btn,e) {
        if (!this.updateBonusWindow) {
            this.updateBonusWindow = MODx.load({
                xtype: 'dialbonus-window-groups-update',
                record: this.menu.record,
                listeners: {
                    'success': {fn:this.refresh,scope:this}
                }
            });
        }
        this.updateBonusWindow.setValues(this.menu.record);
        this.updateBonusWindow.show(e.target);
    },
    removeGroup: function() {
        MODx.msg.confirm({
            title: _('remove'),
            text: _('remove_confirm'),
            url: this.config.url,
            params: {
                action: 'mgr/groups/remove',
                id: this.menu.record.id
            },
            listeners: {
                'success': {fn:this.refresh,scope:this}
            }
        });
    }
});
Ext.reg('dialbonus-grid-groups',DialBonus.grid.DialBonus);

DialBonus.window.UpdateGroup = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        title: _('dialbonus.group_update'),
        url: DialBonus.config.connectorUrl,
        baseParams: {
            action: 'mgr/groups/update'
        },
        fields: [{
            xtype: 'hidden',
            name: 'id'
        },{
            xtype: 'textfield',
            fieldLabel: _('order_sum'),
            name: 'order_sum',
            anchor: '100%'
        },{
            xtype: 'textfield',
            fieldLabel: _('discount_value'),
            name: 'discount_value',
            anchor: '100%'
        }]
    });
    DialBonus.window.UpdateGroup.superclass.constructor.call(this,config);
};
Ext.extend(DialBonus.window.UpdateGroup,MODx.Window);
Ext.reg('dialbonus-window-groups-update',DialBonus.window.UpdateGroup);