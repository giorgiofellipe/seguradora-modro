Ext.define('Faderim.view.GridForm', {
    extend: 'Ext.form.Panel',
    rootForm: 'root',
    autoScroll: true,
    reserveScroolBar: true,    
    isFormField : true,            
    childsValidateDuplicate : null,            
    initRow: 2,
    camposLinha: null,
    data: null,
    constructor: function(options) {
        this.camposLinha = options.items;        
        if (options.items) {
            options.items = [this.getPanelInicial()];
        }        
        this.callParent(arguments);
        this.setAutoScroll(true);
    },
    isChildValidateDuplicate:function(name){
        var validates = JSON.parse(this.childsValidateDuplicate);
        for(var x = 0;x < validates.length;x++){
            if(name == validates[x] ) {
                return true;
            }
        }
        return false;
    },
    validate: function(){
        if(this.childsValidateDuplicate !== null){            
            var valores = this.getValoresForm();
            var duplicados = false;            
            var identificadores = [];               
            for(var x = 0; x < valores.length; x++){
                var linha = valores[x];                
                var identificador = [];
                for(var name in linha){
                    if(this.isChildValidateDuplicate(name)){
                        identificador.push(linha[name]);
                    }
                }
                identificador = identificador.join('_');
                for(var i = 0; i < identificadores.length; i++){
                    if(identificador == identificadores[i]){
                        duplicados = true;
                        break;
                    }
                }
                if(duplicados){
                    Faderim.Util.error('Erro', 'Existem valores duplicados nas informações de ' + this.title + '.');
                    return 0;
                } else {
                    identificadores.push(identificador);
                }                
            }            
        }
        return 1;
    },
    isFileUpload: function() {
        return 0;
    },
    reset: function() {
        this.getForm().reset();
    },
    getValoresForm: function() {
        var val = this.getForm().getValues();
        var valores = [];
        for (var nomePropriedade in val) {
            var valoresPropriedade = val[nomePropriedade];
            Ext.each(valoresPropriedade, function(value, index) {
                if (!valores[index]) {
                    valores[index] = {};
                }
                valores[index][nomePropriedade] = value;
            });
        }
        return valores;
    },
    getModelData: function() {
        var o = {};
        var name = this.name;
        o[name] = this.getValoresForm();
        return o;
    },
    getSubmitData: function() {
        var o = {};
        var name = this.name;
        o[name] = Ext.encode(this.getValoresForm());
        return o;
    },    
    beforeRender: function() {
        this.callParent();
        var form = this.child('[rowStandard="true"]');        
        if (this.data === null) {
            for (var x = 1; x < this.initRow; x++) {
                this.add(this.getPanelInicial());
            }
        } else if (this.data.length > 0) {
            var gridFaderim = this;            
            Ext.each(this.data, function(linha, x) {
                //utilizaremos a primeira linha para o primeiro valor
                if (x > 0) {
                    form = gridFaderim.add(gridFaderim.getPanelInicial());
                }
                for (var name in linha) {                                                            
                    var campo = form.child('[containerRow=true]').down('[name="' + name + '"]');
                    if (campo !== null) {                
                        campo.setValue(linha[name]);
                    }
                }
            });            
        }
        
    },    
    getPanelInicial: function() {        
        function enableChildFormFieldGrid(fields){
            if(Ext.isObject(fields)){                
                if(fields.items  && fields.items.length > 0) {
                    enableChildFormFieldGrid(fields.items);
                }
            }
            for(var x = 0; x < fields.length;x++){
                var field = fields[x];                                                                
                if(field && !field.isXType('field')){
                    if(field.items  && field.items.length > 0) {
                        enableChildFormFieldGrid(field.items);
                    }
                } else if(field && field.isFormField){
                    field.isFormFieldGrid = true;                    
                }
            }
        }
        var fields = this.camposLinha.call();
        enableChildFormFieldGrid(fields);
        return Ext.create("Ext.panel.Panel",
                {
                    rowStandard: true,                                        
                    border:0,
                    flex:1,
                    items: [Ext.create("Ext.container.Container",{layout:{type:"hbox",align:"stretch"},
                                                                   items:fields,
                                                                defaults:{flex:1},
                                                            containerRow:true,
                                                                  border:0,
                                                                   style:{paddingRight: '5px'}})],
                    style: {padding: 5, borderBottom: '1px solid #157fcc'},                    
                    dockedItems: [{
                            xtype: 'toolbar',
                            dock: 'right',
                            width: 60,                            
                            layout: {type:'hbox',pack: 'center'},                            
                            items: [{text: '-',
                                    xtype: 'button',
                                    handler: function() {
                                        var form = this.up('[rootForm="root"]');
                                        if (form.items.getCount() > 1) {
                                            form.remove(this.up('[rowStandard="true"]'));
                                        } else {
                                            form.reset();
                                        }
                                    }},
                                {text: '+',
                                    xtype: 'button',
                                    handler: function() {
                                        var form = this.up('[rootForm="root"]');
                                        form.add(form.getPanelInicial());                                                                                
                                    }                                    
                                }]
                        }]
                });
    }
});