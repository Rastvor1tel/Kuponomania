msdo.page.Settings = function(config) {
    config = config || {};
    Ext.applyIf(config, {
        components: [{
            xtype: 'msdo-panel-settings',
            renderTo: 'msdo-panel-settings-div'
        }]
    });
    msdo.page.Settings.superclass.constructor.call(this, config);
};
Ext.extend(msdo.page.Settings, MODx.Component);
Ext.reg('msdo-page-settings', msdo.page.Settings);

msdo.panel.Settings = function(config) {
    config = config || {};
    Ext.apply(config, {
        border: false,
        deferredRender: true,
        baseCls: 'modx-formpanel',
        items: [{
            html: '<h2>' + _('msdo') + ' :: ' + _('msdo_settings') + '</h2>',
            border: false,
            cls: 'modx-page-header container'
        }, {
            xtype: 'modx-tabs',
            id: 'msdo-settings-tabs',
            bodyStyle: 'padding: 10px',
            defaults: {
                border: false,
                autoHeight: true
            },
            border: true,
            hideMode: 'offsets'

            ,
            items: [{
                title: _('msdo_setting_option'),
                items: [{
                    html: '<p>' + _('msdo_setting_option_intro') + '</p>',
                    border: false,
                    bodyCssClass: 'panel-desc',
                    bodyStyle: 'margin-bottom: 10px'
                }, {
                    xtype: 'msdo-grid-setting-option'
                }]
            }, {
                title: _('msdo_setting_operation'),
                items: [{
                    html: '<p>' + _('msdo_setting_operation_intro') + '</p>',
                    border: false,
                    bodyCssClass: 'panel-desc',
                    bodyStyle: 'margin-bottom: 10px'
                }, {
                    xtype: 'msdo-grid-setting-operation'
                }]
            }, {
                title: _('msdo_lexicon_editor'),
                items: [{
                    html: '<p>' + _('msdo_lexicon_editor_intro') + '</p>',
                    border: false,
                    bodyCssClass: 'panel-desc',
                    bodyStyle: 'margin-bottom: 10px'
                }, {
                    // xtype: 'msdo-grid-lexicon'
                }]
            }]

        }]
    });
    msdo.panel.Settings.superclass.constructor.call(this, config);
};
Ext.extend(msdo.panel.Settings, MODx.Panel);
Ext.reg('msdo-panel-settings', msdo.panel.Settings);
