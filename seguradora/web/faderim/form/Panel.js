Ext.define('Faderim.form.Panel', {
    extend: 'Ext.FormPanel',
    region: 'center',
    autoHeight: true,
    layout: 'form',
    createForm: function() {
        var form = this.callParent(arguments);
        var me = this;
        form.monitor = new Faderim.MonitorFormPanel({
            selector: '[isFormField]',
            scope: me,
            addHandler: me.onFieldAdd,
            removeHandler: me.onFieldRemove
        });
        form.monitor.bind(form.owner);
        return form;
    },
    constructor: function(options) {        
        this.callParent(arguments);
        if (options.values) {            
            this.getForm().setValues(options.values);
        }
    },
    buttons: [{
            text: 'Gravar',
            formBind: false,
            disabled: false,
            handler: function() {                
                var panel = this.up('form');
                var form = this.up('form').getForm();
                if (form.isValid()) {
                    form.submit({
                        waitMsg: 'Aguarde, enviando os dados',
                        success: function(form, action) {
                            Faderim.Action.parseResult(action.result, panel);
                        },
                        failure: function(form, action) {
                            Faderim.Action.parseResult(action.result, panel);
                        }
                    });
                }
            }
        }, {
            text: 'Limpar',
            handler: function() {
                this.up('form').getForm().reset();
            }
        }]
});