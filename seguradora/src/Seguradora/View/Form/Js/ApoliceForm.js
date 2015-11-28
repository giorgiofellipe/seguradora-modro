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
    },
    onSelectRow: function(linha) {                        
        var tipoSeguroRegiao = this.down('[name="tipoSeguroRegiao"]');
        if(linha){            
            Ext.create('Faderim.AjaxRouter', {
                method: 'POST',
                router: this.routerName,
                action: 'buscaTipoSeguroRegiao',
                maskTarget: this,            
                params: {tipoSeguro:linha.id},
                success:function(retorno){                    
                    if(retorno.regiao){                        
                        tipoSeguroRegiao.getStore().loadData(retorno.regiao);
                        tipoSeguroRegiao.show();
                        tipoSeguroRegiao.focus();
                    }
                }
            });
        } 
    }
})