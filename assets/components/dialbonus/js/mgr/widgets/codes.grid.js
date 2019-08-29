DialBonus.grid.DialBonus = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        id: 'dialbonus-grid-codes',
        url: DialBonus.config.connectorUrl,
        baseParams: {action: 'mgr/codes/getList'},
        fields: ['id', 'name', 'value', 'multiple', 'active_to', 'active', 'menu'],
        paging: true,
        remoteSort: true,
        anchor: '97%',
        autoExpandColumn: 'name',
        columns: [{
            header: _('id'),
            dataIndex: 'id',
            sortable: true,
            width: 60
        }, {
            header: _('dialbonus.code_name'),
            dataIndex: 'name',
            sortable: true,
            width: 100
        }, {
            header: _('dialbonus.code_value'),
            dataIndex: 'value',
            sortable: true,
            width: 100
        }, {
            header: _('dialbonus.code_multiple'),
            dataIndex: 'multiple',
            sortable: true,
            width: 100
        }, {
            header: _('dialbonus.code_active_to'),
            dataIndex: 'active_to',
            sortable: true,
            width: 100
        }, {
            header: _('dialbonus.code_active'),
            dataIndex: 'active',
            sortable: true,
            width: 100
        }],
        tbar: [{
            xtype: 'textfield',
            id: 'dialbonus-codes-search-filter',
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
        }, '->', {
            xtype: 'button',
            cls: 'primary-button',
            id: 'dialbonus-code-button-add',
            text: _('dialbonus.code_add'),
            listeners: {
                'click': {
                    fn: this.addCode,
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
            handler: this.updateCode
        }, '-', {
            text: _('remove'),
            handler: this.removeCode
        }];
    },
    addCode: function (btn, e) {
        if (!this.updateBonusWindow) {
            this.updateBonusWindow = MODx.load({
                xtype: 'dialbonus-window-codes-add',
                record: this.menu.record,
                listeners: {
                    'success': {fn: this.refresh, scope: this}
                }
            });
        }
        this.updateBonusWindow.setValues(this.menu.record);
        this.updateBonusWindow.show(e.target);
    },
    updateCode: function (btn, e) {
        if (!this.updateBonusWindow) {
            this.updateBonusWindow = MODx.load({
                xtype: 'dialbonus-window-codes-update',
                record: this.menu.record,
                listeners: {
                    'success': {fn: this.refresh, scope: this}
                }
            });
        }
        this.updateBonusWindow.setValues(this.menu.record);
        this.updateBonusWindow.show(e.target);
    },
    removeCode: function () {
        MODx.msg.confirm({
            title: _('remove'),
            text: _('remove_confirm'),
            url: this.config.url,
            params: {
                action: 'mgr/codes/remove',
                id: this.menu.record.id
            },
            listeners: {
                'success': {fn: this.refresh, scope: this}
            }
        });
    }
});
Ext.reg('dialbonus-grid-codes', DialBonus.grid.DialBonus);

DialBonus.window.AddCode = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'dialbonus-window-codes-add';
    }
    Ext.applyIf(config, {
        id: 'dialbonus-window-codes-add',
        title: _('dialbonus.code_add'),
        url: DialBonus.config.connectorUrl,
        baseParams: {
            action: 'mgr/codes/create'
        },
        fields: [{
            xtype: 'hidden',
            name: 'id'
        }, {
            xtype: 'textfield',
            fieldLabel: _('dialbonus.code_name'),
            name: 'name',
            anchor: '100%'
        }, {
            xtype: 'textfield',
            fieldLabel: _('dialbonus.code_value'),
            name: 'value',
            anchor: '100%'
        }, {
            xtype: 'checkbox',
            fieldLabel: _('dialbonus.code_multiple'),
            name: 'multiple',
            anchor: '100%'
        }, {
            xtype: 'xdatetime',
            fieldLabel: _('dialbonus.code_active_to'),
            name: 'active_to',
            anchor: '100%'
        }, {
            xtype: 'checkbox',
            fieldLabel: _('dialbonus.code_active'),
            name: 'active',
            anchor: '100%'
        }]
    });
    DialBonus.window.AddCode.superclass.constructor.call(this, config);
};
Ext.extend(DialBonus.window.AddCode, MODx.Window, {
    getKeys: function () {
        return [{
            key: Ext.EventObject.ENTER,
            shift: true,
            fn: function () {
                this.submit()
            },
            scope: this
        }];
    }
});
Ext.reg('dialbonus-window-codes-add', DialBonus.window.AddCode);

DialBonus.window.UpdateCode = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'dialbonus-window-codes-update';
    }
    Ext.applyIf(config, {
        id: 'dialbonus-window-codes-update',
        title: _('dialbonus.code_update'),
        url: DialBonus.config.connectorUrl,
        baseParams: {
            action: 'mgr/codes/update'
        },
        fields: [{
            xtype: 'hidden',
            name: 'id'
        }, {
            xtype: 'textfield',
            fieldLabel: _('dialbonus.code_name'),
            name: 'name',
            anchor: '100%'
        }, {
            xtype: 'textfield',
            fieldLabel: _('dialbonus.code_value'),
            name: 'value',
            anchor: '100%'
        }, {
            xtype: 'checkbox',
            fieldLabel: _('dialbonus.code_multiple'),
            name: 'multiple',
            anchor: '100%'
        }, {
            xtype: 'xdatetime',
            fieldLabel: _('dialbonus.code_active_to'),
            name: 'active_to',
            anchor: '100%'
        }, {
            xtype: 'checkbox',
            fieldLabel: _('dialbonus.code_active'),
            name: 'active',
            anchor: '100%'
        }]
    });
    DialBonus.window.UpdateCode.superclass.constructor.call(this, config);
};
Ext.extend(DialBonus.window.UpdateCode, MODx.Window, {
    getKeys: function () {
        return [{
            key: Ext.EventObject.ENTER,
            shift: true,
            fn: function () {
                this.submit()
            },
            scope: this
        }];
    }
});
Ext.reg('dialbonus-window-codes-update', DialBonus.window.UpdateCode);