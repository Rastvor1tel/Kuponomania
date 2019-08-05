Ext.namespace('msdo.combo');

msdo.combo.ProductKey = function(config) {
    config = config || {};

    Ext.applyIf(config, {
        name: 'property',
        id: 'msdo-combo-product-key',
        hiddenName: 'key',
        displayField: 'name',
        valueField: 'id',
        editable: true,
        fields: ['id', 'name'],
        pageSize: 10,
        emptyText: _('msdo_combo_select'),
        hideMode: 'offsets',
        url: msdo.config.connector_url,
        baseParams: {
            action: 'mgr/misc/product/key/getlist'
        }
    });
    msdo.combo.ProductKey.superclass.constructor.call(this, config);
};
Ext.extend(msdo.combo.ProductKey, MODx.combo.ComboBox);
Ext.reg('msdo-combo-product-key', msdo.combo.ProductKey);


