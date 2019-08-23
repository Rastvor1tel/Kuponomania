var DialBonus = function (config) {
    config = config || {};

    DialBonus.superclass.constructor.call(this, config);
};

Ext.extend(DialBonus, Ext.Component, {
    page: {},
    window: {},
    grid: {},
    tree: {},
    panel: {},
    combo: {},
    config: {}
});

Ext.reg('dialbonus', DialBonus);

DialBonus = new DialBonus();