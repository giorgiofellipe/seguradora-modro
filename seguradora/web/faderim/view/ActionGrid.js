Ext.define('Faderim.view.ActionGrid', {
    extend: 'Ext.Button',
    faderim_params_defaults:null,
    constructor: function(options) {
        var router = options.faderim_router;
        var icon = router ? router.split('_').pop() : null;
        if (icon) {
            options.icon = Faderim.Util.icon(icon);
        }
        this.callParent(arguments);
    }
});