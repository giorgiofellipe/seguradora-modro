({
    listeners: {
        afterrender: function() {
            var tipoSeguro = this.down('[name="tipoSeguro"]');
            tipoSeguro.on({'selectRow':{fn: this.onSelectRow, scope: this}});
            this.down('[name="tipoSeguro/id"]').on({'blur':{fn: this.onBlurTipoSeguro, scope: this}});
            this.onBlurTipoSeguro();
            
        }
    },    
    onBlurTipoSeguro:function(){
        if(!this.down('[name="tipoSeguro/id"]').getValue()){
            this.down('[name="tipoSeguroRegiao"]').reset();
            this.down('[name="tipoSeguroRegiao"]').hide();
        }
    }
})