var msdo = function(config) {
	config = config || {};
	msdo.superclass.constructor.call(this, config);
};
Ext.extend(msdo, Ext.Component, {
	page: {},
	window: {},
	grid: {},
	tree: {},
	panel: {},
	combo: {},
	config: {},
	view: {},
	utils: {},
	keymap: {},
	plugin: {}
});
Ext.reg('msdo', msdo);
msdo = new msdo();
