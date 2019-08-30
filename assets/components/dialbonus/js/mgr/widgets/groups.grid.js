DialBonus.grid.DialBonus = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        id: 'dialbonus-grid-groups',
        url: DialBonus.config.connectorUrl,
        baseParams: {action: 'mgr/groups/getList'},
        fields: ['id', 'name', 'order_sum', 'bonus_from_order', 'bonus_on_order', 'menu'],
        paging: true,
        remoteSort: true,
        anchor: '97%',
        autoExpandColumn: 'order_sum',
        columns: [{
            header: _('id'),
            dataIndex: 'id',
            sortable: true,
            width: 60
        }, {
            header: _('dialbonus.group_name'),
            dataIndex: 'name',
            sortable: true,
            width: 100
        }, {
            header: _('order_sum'),
            dataIndex: 'order_sum',
            sortable: true,
            width: 100
        }, {
            header: _('dialbonus.group_bonus_from_order'),
            dataIndex: 'bonus_from_order',
            sortable: true,
            width: 100
        }, {
            header: _('dialbonus.group_bonus_on_order'),
            dataIndex: 'bonus_on_order',
            sortable: true,
            width: 100
        }],
        tbar: [{
            xtype: 'textfield',
            id: 'dialbonus-groups-search-filter',
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
            id: 'dialbonus-group-button-add',
            text: _('dialbonus.group_add'),
            listeners: {
                'click': {
                    fn: this.addGroup,
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
            handler: this.updateGroup
        }, '-', {
            text: _('remove'),
            handler: this.removeGroup
        }];
    },
    addGroup: function() {
        var win = MODx.load({
            xtype: 'dialbonus-window-groups',
            listeners: {
                success: {fn: function(r) {
                        this.refresh();
                    },scope: this},
                scope: this
            }
        });
        win.show();
    },
    updateGroup: function() {
        var record = this.menu.record;
        var win = MODx.load({
            xtype: 'dialbonus-window-groups',
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
    removeGroup: function () {
        MODx.msg.confirm({
            title: _('remove'),
            text: _('remove_confirm'),
            url: this.config.url,
            params: {
                action: 'mgr/groups/remove',
                id: this.menu.record.id
            },
            listeners: {
                'success': {fn: this.refresh, scope: this}
            }
        });
    }
});
Ext.reg('dialbonus-grid-groups', DialBonus.grid.DialBonus);

DialBonus.window.Group = function (config) {
    config = config || {};
    config.id = config.id || Ext.id();
    Ext.applyIf(config, {
        title: (config.isUpdate) ?
            _('dialbonus.group_update') :
            _('dialbonus.group_add'),
        url: DialBonus.config.connectorUrl,
        baseParams: {
            action: (config.isUpdate) ?
                'mgr/groups/update' :
                'mgr/groups/create'
        },
        fields: this.getFields(config),
        keys: [{
            key: Ext.EventObject.ENTER, shift: true, fn: function () {
                this.submit()
            }, scope: this
        }]
    });
    DialBonus.window.Group.superclass.constructor.call(this, config);
};
Ext.extend(DialBonus.window.Group, MODx.Window, {
    getFields: function (config) {
        return [
            {
                xtype: 'hidden',
                name: 'id'
            }, {
                xtype: 'textfield',
                fieldLabel: _('dialbonus.group_name'),
                name: 'name',
                anchor: '100%'
            }, {
                xtype: 'textfield',
                fieldLabel: _('order_sum'),
                name: 'order_sum',
                anchor: '100%'
            }, {
                xtype: 'textfield',
                fieldLabel: _('dialbonus.group_bonus_from_order'),
                name: 'bonus_from_order',
                anchor: '100%'
            }, {
                xtype: 'textfield',
                fieldLabel: _('dialbonus.group_bonus_on_order'),
                name: 'bonus_on_order',
                anchor: '100%'
            }
        ];
    }
});
Ext.reg('dialbonus-window-groups', DialBonus.window.Group);