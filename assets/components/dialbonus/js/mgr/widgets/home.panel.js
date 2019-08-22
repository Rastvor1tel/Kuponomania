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
                title: _('dialbonus'),
                defaults: {autoHeight: true},
                items: [{
                    html: '<p>' + _('dialbonus.management_desc') + '</p>',
                    border: false,
                    bodyCssClass: 'panel-desc'
                }]
            }]
        }]
    });
    DialBonus.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(DialBonus.panel.Home, MODx.Panel);
Ext.reg('dialbonus-panel-home', DialBonus.panel.Home);