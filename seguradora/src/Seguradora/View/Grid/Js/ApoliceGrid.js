({
    listeners: {
        beforerender: function() {
           var acaoImpressao = this.down('[name="seg_apolice_printer"]');	
           console.log(acaoImpressao);
           if (acaoImpressao) {                	
               acaoImpressao.clearListeners();	
               acaoImpressao.setHandler(this.onClickImprimir,this);	
            }            
        }
    },    
    onClickImprimir:function(){        
        var registros = this.getSelectedRows();
        if(registros.length == 1){
            Faderim.Util.printReport('seg_apolice_printer',{rows:JSON.stringify(registros)});            
        }
    }
})