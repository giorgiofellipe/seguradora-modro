({
    listeners: {
        afterrender: function() {            
            var gravar = this.down('[text="Gravar"]');
            gravar.setText('Imprimir');
            gravar.removeListener();
            gravar.setHandler(this.onClickImprimir,this);                        
            this.down('[name="report"]').on({'blur':{fn:this.onBlurReport,scope:this}});
        }
    },    
    onBlurReport:function(){
        if(this.down('[name="report"]').getValue() == 2){
            this.down('[name="situacao"]').setValue(2);
            this.down('[name="situacao"]').setReadOnly(true);            
        } else {
            this.down('[name="situacao"]').reset();
            this.down('[name="situacao"]').setReadOnly(false);
        }
    },
    onClickImprimir:function(){        
        if(this.getForm().isValid()){            
            Faderim.Util.printReport(this.routerName,this.getForm().getValues());            
        }
    }
})