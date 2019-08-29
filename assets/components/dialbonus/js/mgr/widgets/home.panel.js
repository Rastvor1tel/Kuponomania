DialBonus.panel.Home = function (config) {
    config = config || {};
    Ext.apply(config, {
        border: false,
        baseCls: 'modx-formpanel',
        cls: 'container',
        items: [{
            html: '<h2>' + _('dialbonus.management') + '</h2>',
            border: false,
            cls: 'modx-page-header'
        }, {
            xtype: 'modx-tabs',
            defaults: {border: false, autoHeight: true},
            border: true,
            items: [{
                title: _('dialbonus.balance'),
                defaults: {autoHeight: true},
                items: [{
                    html: '<p>' + _('dialbonus.balance_desc') + '</p>',
                    border: false,
                    bodyCssClass: 'panel-desc'
                }, {
                    xtype: 'dialbonus-grid-balance',
                    cls: 'main-wrapper',
                    preventRender: true
                }]
            }, {
                title: _('dialbonus.groups'),
                defaults: {autoHeight: true},
                items: [{
                    html: '<p>' + _('dialbonus.groups_desc') + '</p>',
                    border: false,
                    bodyCssClass: 'panel-desc'
                }, {
                    xtype: 'dialbonus-grid-groups',
                    cls: 'main-wrapper',
                    preventRender: true
                }]
            }, {
                title: _('dialbonus.codes'),
                defaults: {autoHeight: true},
                items: [{
                    html: '<p>' + _('dialbonus.codes_desc') + '</p>',
                    border: false,
                    bodyCssClass: 'panel-desc'
                }, {
                    xtype: 'dialbonus-grid-codes',
                    cls: 'main-wrapper',
                    preventRender: true
                }]
            }, {
                title: _('dialbonus.operations'),
                defaults: {autoHeight: true},
                items: [{
                    html: '<p>' + _('dialbonus.operations_desc') + '</p>',
                    border: false,
                    bodyCssClass: 'panel-desc'
                }, {
                    xtype: 'dialbonus-grid-operations',
                    cls: 'main-wrapper',
                    preventRender: true
                }]
            }]
        }]
    });
    DialBonus.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(DialBonus.panel.Home, MODx.Panel);
Ext.reg('dialbonus-panel-home', DialBonus.panel.Home);