({
    listeners: {
        afterrender: function() {
            var tipoSeguro = this.down('[name="tipoSeguro"]');
            tipoSeguro.on({'selectRow':{fn: this.onSelectRow, scope: this}});
            this.down('[name="tipoSeguro/id"]').on({'blur':{fn: this.onBlurTipoSeguro, scope: this}});
            this.onBlurTipoSeguro();
            
            this.down('[name="dataInicio"]').on({'blur':{fn: this.onBlurDataInicio, scope: this}});
            
        }
    },
    onBlurDataInicio:function(){
        if(this.down('[name="dataInicio"]').getValue()){
            var dataInicio = new Date(this.down('[name="dataInicio"]').getValue());                    
            var anoFim = dataInicio.getFullYear() + 1;
            var mes = dataInicio.getMonth() + 1;
            if(mes.length == 1){
                mes = '0' + mes;
            }            
            var dataFim = new Date(anoFim + '/' +  mes + '/' + dataInicio.getDate());            
            this.down('[name="dataFim"]').setValue(dataFim);
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