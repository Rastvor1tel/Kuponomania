msdo.grid.Option = function(config) {
    config = config || {};

    this.exp = new Ext.grid.RowExpander({
        expandOnDblClick: false,
        tpl: new Ext.Template('<p class="desc">{description}</p>'),
        renderer: function(v, p, record) {
            return record.data.description != '' && record.data.description != null ? '<div class="x-grid3-row-expander">&#160;</div>' : '&#160;';
        }
    });
    this.dd = function(grid) {
        this.dropTarget = new Ext.dd.DropTarget(grid.container, {
            ddGroup: 'dd',
            copy: false,
            notifyDrop: function(dd, e, data) {
                var store = grid.store.data.items;
                var target = store[dd.getDragData(e).rowIndex].id;
                var source = store[data.rowIndex].id;
                if (target != source) {
                    dd.el.mask(_('loading'), 'x-mask-loading');
                    MODx.Ajax.request({
                        url: msdo.config.connector_url,
                        params: {
                            action: config.action || 'mgr/settings/option/sort',
                            source: source,
                            target: target
                        },
                        listeners: {
                            success: {
                                fn: function(r) {
                                    dd.el.unmask();
                                    grid.refresh();
                                },
                                scope: grid
                            },
                            failure: {
                                fn: function(r) {
                                    dd.el.unmask();
                                },
                                scope: grid
                            }
                        }
                    });
                }
            }
        });
    };
    Ext.applyIf(config, {
        id: 'msdo-grid-product-option',
        url: msdo.config.connector_url,
        baseParams: {
            action: 'mgr/settings/option/getlist'
        },
        fields: ['id', 'name', 'key', 'description', 'active', 'editable', 'remains', 'weight', 'article'],
        autoHeight: true,
        paging: true,
        remoteSort: true,
        save_action: 'mgr/settings/option/updatefromgrid',
        autosave: true,
        plugins: this.exp,
        columns: [this.exp, {
            header: _('msdo_id'),
            dataIndex: 'id',
            width: 50,
            sortable: true
        }, {
            header: _('msdo_name'),
            dataIndex: 'name',
            width: 100,
            sortable: true,
            editor: {
                xtype: 'textfield'
            }
        }, {
            header: _('msdo_key'),
            dataIndex: 'key',
            width: 100,
            sortable: true
        }, {
            header: _('msdo_remains'),
            dataIndex: 'remains',
            sortable: true,
            width: 50,
            editor: {
                xtype: 'combo-boolean',
                renderer: 'boolean'
            }
        }, {
            header: _('msdo_weight'),
            dataIndex: 'weight',
            sortable: true,
            width: 50,
            editor: {
                xtype: 'combo-boolean',
                renderer: 'boolean'
            }
        }, {
            header: _('msdo_article'),
            dataIndex: 'article',
            sortable: true,
            width: 50,
            editor: {
                xtype: 'combo-boolean',
                renderer: 'boolean'
            }
        }, {
            header: _('msdo_active'),
            dataIndex: 'active',
            sortable: true,
            width: 50,
            editor: {
                xtype: 'combo-boolean',
                renderer: 'boolean'
            }
        }

        ],
        tbar: [{
            text: '<i class="icon icon-plus"></i> ' + _('msdo_btn_create'),
            handler: this.createOption,
            scope: this
        }],
        ddGroup: 'dd',
        enableDragDrop: true,
        listeners: {
            render: {
                fn: this.dd,
                scope: this
            }
        }
    });
    msdo.grid.Option.superclass.constructor.call(this, config);
};
Ext.extend(msdo.grid.Option, MODx.grid.Grid, {
    windows: {}

    ,
    getMenu: function() {
        var m = [];
        m.push({
            text: _('msdo_menu_update'),
            handler: this.updateOption
        });
        if (this.menu.record.editable) {
            m.push('-');
            m.push({
                text: _('msdo_menu_remove'),
                handler: this.removeOption
            });
        }
        this.addContextMenuItem(m);
    }

    ,
    createOption: function(btn, e) {
        if (this.windows.createOption) {
            this.windows.createOption.close();
            this.windows.createOption.destroy();
            this.windows.createOption = undefined;
        }
        if (!this.windows.createOption) {
            this.windows.createOption = MODx.load({
                xtype: 'msdo-window-option-create',
                id: 'msdo-window-option-create',
                fields: this.getOptionFields('create'),
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
        this.windows.createOption.fp.getForm().reset();
        this.windows.createOption.fp.getForm().setValues({
            active: 1
        });
        this.windows.createOption.show(e.target);
    }


    ,
    updateOption: function(btn, e, row) {
        if (typeof(row) != 'undefined') {
            this.menu.record = row.data;
        }
        var id = this.menu.record.id;

        MODx.Ajax.request({
            url: msdo.config.connector_url,
            params: {
                action: 'mgr/settings/option/get',
                id: id
            },
            listeners: {
                success: {
                    fn: function(r) {

                        if (this.windows.updateOption) {
                            try {
                                this.windows.updateOption.close();
                                this.windows.updateOption.destroy();
                            } catch (e) {}
                        }
                        this.windows.updateOption = MODx.load({
                            xtype: 'msdo-window-option-update',
                            record: r.object,
                            fields: this.getOptionFields('update'),
                            listeners: {
                                success: {
                                    fn: function() {
                                        this.refresh();
                                    },
                                    scope: this
                                }
                            }
                        });
                        this.windows.updateOption.fp.getForm().reset();
                        this.windows.updateOption.show(e.target);
                        this.windows.updateOption.fp.getForm().setValues(r.object);
                    },
                    scope: this
                }
            }
        });
    }

    ,
    removeOption: function(btn, e) {
        if (!this.menu.record) return false;

        MODx.msg.confirm({
            title: _('msdo_menu_remove') + '"' + this.menu.record.name + '"',
            text: _('msdo_menu_remove_confirm'),
            url: this.config.url,
            params: {
                action: 'mgr/settings/option/remove',
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

    ,
    getOptionFields: function(type) {

        var fields = [];
        var disabled = type == 'update' ? true : false;
        fields.push({
                xtype: 'hidden',
                name: 'id',
                id: 'msdo-product-option-id-' + type
            }, {
                xtype: 'textfield',
                fieldLabel: _('msdo_name'),
                name: 'name',
                hiddenName: 'name',
                allowBlank: false,
                anchor: '99%',
                id: 'msdo-product-option-name-name-' + type
            }, {
                xtype: 'msdo-combo-product-key',
                disabled: disabled,
                fieldLabel: _('msdo_key'),
                name: 'key',
                hiddenName: 'key',
                allowBlank: false,
                anchor: '99%',
                id: 'msdo-product-option-key-' + type
            }, {
                xtype: 'textarea',
                fieldLabel: _('msdo_description'),
                name: 'description',
                anchor: '99%',
                id: 'msdo-product-option-description-' + type
            }

            , {
                xtype: 'checkboxgroup',
                columns: 2,
                items: [{
                    xtype: 'xcheckbox',
                    boxLabel: _('msdo_remains'),
                    name: 'remains',
                    id: 'msdo-product-option-remains-' + type
                }, {
                    xtype: 'xcheckbox',
                    boxLabel: _('msdo_weight'),
                    name: 'weight',
                    id: 'msdo-product-option-weight-' + type
                }, {
                    xtype: 'xcheckbox',
                    boxLabel: _('msdo_active'),
                    name: 'active',
                    id: 'msdo-product-option-active-' + type
                }],
                id: 'msdo-product-option-group-' + type
            }

        );

        return fields;
    }

});
Ext.reg('msdo-grid-setting-option', msdo.grid.Option);


msdo.window.CreateOption = function(config) {
    config = config || {};
    this.ident = config.ident || 'mecitem' + Ext.id();
    Ext.applyIf(config, {
        title: _('msdo_menu_create'),
        id: this.ident,
        width: 600,
        autoHeight: true,
        labelAlign: 'left',
        labelWidth: 180,
        url: msdo.config.connector_url,
        action: 'mgr/settings/option/create',
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
    msdo.window.CreateOption.superclass.constructor.call(this, config);
};
Ext.extend(msdo.window.CreateOption, MODx.Window);
Ext.reg('msdo-window-option-create', msdo.window.CreateOption);


msdo.window.UpdateOption = function(config) {
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
        action: 'mgr/settings/option/update',
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
    msdo.window.UpdateOption.superclass.constructor.call(this, config);
};
Ext.extend(msdo.window.UpdateOption, MODx.Window);
Ext.reg('msdo-window-option-update', msdo.window.UpdateOption);
