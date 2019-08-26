DialBonus.grid.DialBonus = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'dialbonus-grid-operations',
        url: DialBonus.config.connectorUrl,
        baseParams: { action: 'mgr/operations/getList' },
        fields: ['id', 'user_id', 'date', 'value', 'type', 'menu'],
        paging: true,
        remoteSort: true,
        anchor: '97%',
        autoExpandColumn: 'value',
        columns: [{
            header: _('id'),
            dataIndex: 'id',
            sortable: true,
            width: 60
        },{
            header: _('user'),
            dataIndex: 'user_id',
            sortable: true,
            width: 100
        },{
            header: _('dialbonus.operation_date'),
            dataIndex: 'date',
            sortable: true,
            width: 100
        },{
            header: _('dialbonus.operation'),
            dataIndex: 'value',
            sortable: true,
            width: 100,
            editor: { xtype: 'textfield' }
        },{
            header: _('dialbonus.operation_type'),
            dataIndex: 'type',
            sortable: true,
            width: 100,
            editor: { xtype: 'textfield' }
        }],
        tbar:[{
            xtype: 'textfield',
            id: 'dialbonus-operation-search-filter',
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
            text: _('remove'),
            handler: this.removeOperation
        }];
    },
    removeOperation: function() {
        MODx.msg.confirm({
            title: _('remove'),
            text: _('remove_confirm'),
            url: this.config.url,
            params: {
                action: 'mgr/operations/remove',
                id: this.menu.record.id
            },
            listeners: {
                'success': {fn:this.refresh,scope:this}
            }
        });
    }
});
Ext.reg('dialbonus-grid-operations',DialBonus.grid.DialBonus);