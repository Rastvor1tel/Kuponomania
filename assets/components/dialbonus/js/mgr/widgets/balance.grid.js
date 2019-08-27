DialBonus.grid.DialBonus = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        id: 'dialbonus-grid-balance',
        url: DialBonus.config.connectorUrl,
        baseParams: {action: 'mgr/balance/getList'},
        fields: ['id', 'user_id', 'value', 'bonus_group', 'menu'],
        paging: true,
        remoteSort: true,
        anchor: '97%',
        autoExpandColumn: 'value',
        columns: [{
            header: _('id'),
            dataIndex: 'id',
            sortable: true,
            width: 60
        }, {
            header: _('user'),
            dataIndex: 'user_id',
            sortable: true,
            width: 100
        }, {
            header: _('balance'),
            dataIndex: 'value',
            sortable: true,
            width: 100
        }, {
            header: _('bonus_group'),
            dataIndex: 'bonus_group',
            sortable: true,
            width: 100
        }],
        tbar: [{
            xtype: 'textfield',
            id: 'dialbonus-balance-search-filter',
            emptyText: _('search'),
            listeners: {
                'change': {
                    fn: this.search,
                    scope: this
                },
                'render': {
                    fn: function (cmp) {
                        new Ext.KeyMap(cmp.getEl(), {
                            key: Ext.EventObject.ENTER,
                            fn: function () {
                                this.fireEvent('change', this);
                                this.blur();
                                return true;
                            },
                            scope: cmp
                        });
                    },
                    scope: this
                }
            }
        }]
    });
    DialBonus.grid.DialBonus.superclass.constructor.call(this, config)
};

Ext.extend(DialBonus.grid.DialBonus, MODx.grid.Grid, {
    search: function (tf, nv, ov) {
        var s = this.getStore();
        s.baseParams.query = tf.getValue();
        this.getBottomToolbar().changePage(1);
        this.refresh();
    },
    getMenu: function () {
        return [{
            text: _('edit'),
            handler: this.updateBalance
        }, '-', {
            text: _('remove'),
            handler: this.removeBalance
        }];
    },
    updateBalance: function (btn, e) {
        if (!this.updateBonusWindow) {
            this.updateBonusWindow = MODx.load({
                xtype: 'dialbonus-window-balance-update',
                record: this.menu.record,
                listeners: {
                    'success': {fn: this.refresh, scope: this}
                }
            });
        }
        this.updateBonusWindow.setValues(this.menu.record);
        this.updateBonusWindow.show(e.target);
    },
    removeBalance: function () {
        MODx.msg.confirm({
            title: _('remove'),
            text: _('remove_confirm'),
            url: this.config.url,
            params: {
                action: 'mgr/balance/remove',
                id: this.menu.record.id
            },
            listeners: {
                'success': {fn: this.refresh, scope: this}
            }
        });
    }
});
Ext.reg('dialbonus-grid-balance', DialBonus.grid.DialBonus);

DialBonus.window.UpdateBalance = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        title: _('dialbonus.balance_update'),
        url: DialBonus.config.connectorUrl,
        baseParams: {
            action: 'mgr/balance/update'
        },
        fields: [{
            xtype: 'hidden',
            name: 'id'
        }, {
            xtype: 'textfield',
            fieldLabel: _('balance'),
            name: 'value',
            anchor: '100%'
        }]
    });
    DialBonus.window.UpdateBalance.superclass.constructor.call(this, config);
};
Ext.extend(DialBonus.window.UpdateBalance, MODx.Window);
Ext.reg('dialbonus-window-balance-update', DialBonus.window.UpdateBalance);