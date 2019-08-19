Ext.onReady(function () {
    MODx.load({xtype: 'dialbonus-page-home'});
});

DialBonus.page.Home = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        components: [{
            xtype: 'dialbonus-panel-home',
            renderTo: 'dialbonus-panel-home-div'
        }]
    });
    DialBonus.page.Home.superclass.constructor.call(this, config);
};
Ext.extend(DialBonus.page.Home, MODx.Component);
Ext.reg('dialbonus-page-home', DialBonus.page.Home);