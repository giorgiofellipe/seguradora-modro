({
    listeners: {
        afterrender: function() {            
            var gravar = this.down('[text="Gravar"]');
            gravar.setText('Imprimir');
            gravar.removeListener();
            gravar.setHandler(this.onClickImprimir,this);            
        }
    },    
    onClickImprimir:function(){        
        if(this.getForm().isValid()){            
            Faderim.Util.printReport(this.routerName,this.getForm().getValues());            
        }
    }
})