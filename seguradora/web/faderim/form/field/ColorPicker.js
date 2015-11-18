Ext.define('Faderim.form.field.ColorPicker', {
    extend: 'Ext.form.field.Trigger',
    alias: 'widget.colorcbo',
    triggerTip: 'Selecione uma cor',
    picker: null,
    afterRender: function() {
        this.callParent(arguments);
        this.updateBGColor();
    },
    setValue: function() {
        this.callParent(arguments);
        this.updateBGColor();
    },
    updateBGColor: function() {
        if (this.value && this.inputEl) {
            this.inputEl.setStyle({backgroundColor: '#' + this.value});
        }
    },
    listeners: {
        change: function() {
            this.updateBGColor();
        }
    },
    onTriggerClick: function() {
        var me = this;
        if (!me.picker) {
            me.picker = Ext.create('Ext.picker.Color', {
                pickerField: this,
                ownerCt: this,
                renderTo: document.body,
                floating: true,
                hidden: false,
                focusOnShow: true,
                style: {
                    backgroundColor: "#fff"
                },
                listeners: {
                    scope: this,
                    select: function(field, value, opts) {
                        me.setValue(value);
                        me.picker.hide();
                    },
                    show: function(field, opts) {
                        field.getEl().monitorMouseLeave(500, field.hide, field);
                    }
                }
            });
            me.picker.alignTo(me.inputEl, 'tl-bl?');
            me.picker.show(me.inputEl);
        }
        else {
            if (me.picker.hidden) {
                me.picker.show();
            }
            else {
                me.picker.hide();
            }
        }
    }
});