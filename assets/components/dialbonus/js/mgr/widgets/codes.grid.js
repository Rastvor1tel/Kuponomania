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
    addCode: function() {
        var win = MODx.load({
            xtype: 'dialbonus-window-codes',
            listeners: {
                success: {fn: function(r) {
                        this.refresh();
                    },scope: this},
                scope: this
            }
        });
        win.show();
    },
    updateCode: function() {
        var record = this.menu.record;
        var win = MODx.load({
            xtype: 'dialbonus-window-codes',
            listeners: {
                success: {fn: function(r) {
                        this.refresh();
                    },scope: this},
                scope: this
            },
            isUpdate: true
        });
        win.setValues(record);
        win.show();
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

DialBonus.window.Code = function (config) {
    config = config || {};
    config.id = config.id || Ext.id();
    Ext.applyIf(config, {
        title: (config.isUpdate) ?
            _('dialbonus.code_update') :
            _('dialbonus.code_add'),
        url: DialBonus.config.connectorUrl,
        baseParams: {
            action: (config.isUpdate) ?
                'mgr/codes/update' :
                'mgr/codes/create'
        },
        fields: this.getFields(config),
        keys: [{
            key: Ext.EventObject.ENTER, shift: true, fn: function () {
                this.submit()
            }, scope: this
        }]
    });
    DialBonus.window.Code.superclass.constructor.call(this, config);
};
Ext.extend(DialBonus.window.Code, MODx.Window, {
    getFields: function (config) {
        return [
            {
                xtype: 'hidden',
                name: 'id',
                id: config.id + '-id'
            }, {
                xtype: 'textfield',
                fieldLabel: _('dialbonus.code_name'),
                name: 'name',
                id: config.id + '-name',
                anchor: '100%'
            }, {
                xtype: 'textfield',
                fieldLabel: _('dialbonus.code_value'),
                name: 'value',
                id: config.id + '-value',
                anchor: '100%'
            }, {
                xtype: 'checkbox',
                fieldLabel: _('dialbonus.code_multiple'),
                name: 'multiple',
                id: config.id + '-multiple',
                anchor: '100%'
            }, {
                xtype: 'checkbox',
                fieldLabel: _('dialbonus.code_active'),
                name: 'active',
                id: config.id + '-active',
                anchor: '100%'
            }
        ];
    }
});
Ext.reg('dialbonus-window-codes', DialBonus.window.Code);
