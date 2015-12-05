Ext.Loader.setConfig({enabled: true});
Ext.Loader.setPath('Faderim', 'faderim');
Ext.require(['*']);
Ext.util.Observable.observe(Ext.data.Connection);
Ext.override(Ext.data.proxy.Ajax, {timeout: 18000000});

Ext.override(Ext.data.Connection, {
    timeout: 18000000
});

Ext.override(Ext.form.action.Submit, {
    submitEmptyText: false
});

Ext.override(Ext.grid.column.Number, {
    //align:'right'
    
});
//Ext.util.Format.thousandSeparator = ',';
//Ext.util.Format.decimalSeparator = ',';
Ext.Error.handle = function(err) {
    Faderim.Util.error('Erro', err.msg);
};

Ext.override(Ext.form.field.Base, {
    setRequired: function(required) {
        this.allowBlank = !(required);
    },
    setValidator: function(validator) {
        this.validator = validator;
    }
});
Ext.override(Ext.form.field.ComboBox, {
    getSubmitValue: function() {
        if(this.multiSelect == true) {                        
            var s = {};
            s[this.name] = JSON.stringify(this.getModelData()[this.name]);
            return s;
        } else {
            return this.callParent(arguments);
        }
    }
});

function avaliaResponseError(response) {
    if (response.responseText !== null) {
        if (!response.getResponseHeader) {
            sExcept = 'Erro não identificado';
        }
        else {
            var sExcept = response.getResponseHeader('Faderim-Exception');
            if (!sExcept) {
                sExcept = response.responseText;
            }
            else {
                sExcept = JSON.parse(sExcept);
            }
            var trace = JSON.parse(response.getResponseHeader('Faderim-Exception-Trace'));
        }
        Faderim.Util.error('Erro', sExcept);
    }
}



Ext.data.Connection.on('requestexception', function(dataconn, response, options) {
    avaliaResponseError(response);
});
Ext.Ajax.on('requestexception', function(conn, response, options) {
    avaliaResponseError(response);
});
Ext.Ajax.on('requestcomplete', function(conn, response, options) {
    //avaliaResponseError(response);    
});
Ext.state.Manager.setProvider(Ext.create('Ext.state.CookieProvider'));

Ext.override(Ext.form.field.File, {
    buttonText: 'Selecionar Arquivo'
});
Ext.onReady(function() {
});
var Faderim = {};
Faderim.Util = function() {
    var msgCt;
    return {
        baseUrl: 'http://127.0.0.1/tcc/web/',
        baseIconUrl: 'http://127.0.0.1/tcc/web/image/icons/',
        error: function(title, msg) {
            Ext.MessageBox.show({
                title: title,
                msg: msg,
                buttons: Ext.MessageBox.OK,
                icon: Ext.MessageBox.ERROR
            });
        },
        icon: function(image) {
            return this.baseIconUrl + '' + image + '.png';
        },
        msg: function(title, msg) {
            if (!msgCt) {
                msgCt = Ext.DomHelper.insertFirst(document.body, {id: 'msg-div'}, true);
            }
            var m = Ext.DomHelper.append(msgCt, '<div class="msg"><h3>' + title + '</h3><p>' + msg + '</p></div>', true);
            var c = Ext.DomHelper.append(m, '<span>X</span>', true);
            m.hide();
            var fnHide = function() {
                if (m) {
                    m.ghost('t', {delay: 100, remove: true});
                }
            };
            m.slideIn('t');
            var timer = setTimeout(fnHide, 5000);
            c.on('click', fnHide);
            m.on('mouseover', function() {
                clearTimeout(timer);
            });
        },
        storeClone: function(source) {
            var target = Ext.create('Ext.data.Store', {
                model: source.model
            });
            Ext.each(source.getRange(), function(record) {
                var newRecordData = Ext.clone(record.copy().data);
                var model = new source.model(newRecordData, newRecordData.id);
                target.add(model);
            });
            return target;
        },
        init: function() {
            if (!msgCt) {
                msgCt = Ext.DomHelper.insertFirst(document.body, {id: 'msg-div'}, true);
            }
        },
        printReport: function(routerReportName, parametros) {            
            var frm = document.createElement('form');
            frm.action = '?router=' + routerReportName;
            frm.target = '_blank';
            frm.method = 'POST';             
            frm.name = 'frm_tmp_report_' + new Date().getTime();
            for (var paramName in parametros) {
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = paramName;
                input.value = parametros[paramName];
                frm.appendChild(input);
            }
            document.body.appendChild(frm);
            frm.submit();
            document.body.removeChild(frm);            
        }
    };
}();

Ext.override(Ext.form.field.Base, {
    getExterno: function() {
        return this.up('[isExterno]');
    }
});

Ext.define('Ext.form.field.multiplefile', {
    extend: 'Ext.form.field.File',
    alias: 'widget.multifilefield',
    initMultiple: function() {
        var me = this;
        if (me.multiple) {
            me.fileInputEl.set({multiple: true});
        }
    },
    reset: function() {
        this.callParent(arguments);
        this.initMultiple();
    },
    onRender: function() {
        delete this.maxLength;
        this.callParent(arguments);
        this.initMultiple();
    },
    onFileChange: function(button, e, value) {
        this.duringFileSelect = true;
        var me = this,
                upload = me.fileInputEl.dom,
                files = upload.files,
                names = [];

        if (files) {
            for (var i = 0; i < files.length; i++)
                names.push(files[i].name);
            value = names.join(', ');
        }

        Ext.form.field.File.superclass.setValue.call(this, value);

        delete this.duringFileSelect;
    }
});

Faderim.GridRender = function() {
    return {
        MidiaRender: function(a, metadata) {
            if (a) {
                metadata.style = 'text-align:center;vertical-align:middle';
                return '<img src="' + a + '" />';
            }
        },
        CurrencyRender: function(a,metadata) {
            return Ext.util.Format.currency(parseFloat(a), 'R$ ',2);
            metadata.style = 'text-align:right';
            return 'R$ '+a;
        } 
    };
}();

Faderim.Action = function() {
    return {
        parseResult: function(result, object, caller) {
            caller = (object && object.caller) || caller;
            if (result.success) {
                Faderim.Util.msg('Sucesso', result.msg);
                if (result.resetCaller) {
                    caller.getStore().reload();
                }
                if (result.close) {
                    var up = object.up();
                    if (up && up.isXType('window')) {
                        up.close();
                    }
                    else {
                        object.close();
                    }
                }
                if (result.reset) {
                    object.getForm().reset();
                }
            }
            else {
                Faderim.Util.error('Erro', result.msg);
            }
        },
        parseResultString: function(result, object, caller) {
            return this.parseResult(Ext.decode(result), object, caller);
        }
    };
}();
Ext.onReady(Faderim.Util.init, Faderim.Util, Faderim.GridRender);

Ext.define('Faderim.AjaxRouter', {
    config: {
        method: "GET",
        maskTarget: Ext.getBody(),
        router: '',
        params: {},
        action: null,
        caller: null,
        success: function() {

        }
    },
    constructor: function(config) {        
        this.initConfig(config);        
        this.config.params['router'] = this.router;
        if (this.config.action) {
            this.config.params['action'] = this.config.action;
        }
        this.call();
    },
    call: function() {
        var self = this;
        var target = self.config.target;
        if (Faderim.AjaxRouter.beforeComponentCallback[target]) {
            var cont = Faderim.AjaxRouter.beforeComponentCallback[target](self.config);
            if (cont === false) {
                return;
            }
        }
        if (this.config.maskTarget) {
            this.config.maskTarget.mask('Aguarde enquanto a ação é realizada!');
        }

        Ext.Ajax.request({
            method: 'GET',
            params: this.config.params,
            url: '?',
            success: function(response) {
                if (self.config.maskTarget) {
                    self.config.maskTarget.unmask();
                }
                var loader = Ext.decode(response.responseText);

                loader.routerName = self.router;
                loader.caller = self.config.caller;
                if (self.config) {
                    self.config.success.call(null, loader);
                }
                if (Faderim.AjaxRouter.componentCallback[target]) {
                    Faderim.AjaxRouter.componentCallback[target](loader, self.config);
                }
                else if(target) {
                    target.add(loader);
                }
            },
            failure: function() {
                if (self.config.maskTarget) {
                    self.config.maskTarget.unmask();
                }
            }
        });
        return;
    },
    statics: {
        componentCallback: {},
        beforeComponentCallback: {},
        defineBeforeComponentCallback: function(name, callback) {
            this.beforeComponentCallback[name] = callback;
        },
        defineComponentCallback: function(name, callback) {
            this.componentCallback[name] = callback;
        }
    }
});

Ext.define('Faderim.MonitorFormPanel', {
    extend: 'Ext.container.Monitor',
    getItems: function() {
        var me = this;
        var items = me.items = new Ext.util.MixedCollection();
        var queryResult = me.target.query(me.selector);
        var fields = [];
        for (var x = 0; x < queryResult.length; x++) {
            if (queryResult[x].isFormFieldGrid) {
                continue;
            }
            fields.push(queryResult[x]);
        }
        items.addAll(fields);
        return items;
    }
});

Ext.define('Faderim.view.ColorColumn', {
    extend: 'Ext.grid.column.Column',
    alias: ['widget.colorcolumn'],
    constructor: function(options) {

        options.renderer = function(item, metadata) {
            return '<div style="display:inline-table;width:18px;height:18px;background-color:#' + item + ';border-color:gray"></div>';
        };
        this.callParent(arguments);
    }
});

Ext.define('Faderim.view.ListColumn', {
    extend: 'Ext.grid.column.Column',
    alias: ['widget.listcolumn'],
    constructor: function(options) {
        if (options.store) {
            options.renderer = function(item) {
                var record = options.store.findRecord('val', item, 0, false, true, true);
                if (record) {
                    return record.data.name;
                }
                else {
                    return item;
                }
            };
        }
        this.callParent(arguments);
    }
});

Ext.define('Faderim.Editor', {
    extend: 'Ext.form.field.TextArea',
    alias: 'widget.tinymce',        
    editorConfig: undefined,
    afterRender: function() {
        this.callParent(arguments);

        var me = this,
            id = this.inputEl.id;

        var editor = tinymce.createEditor(id, Ext.apply({
            selector: '#' + id,
            resize: true,
            language:'pt_BR',
            height: this.height,            
            width: this.width,
            document_base_url: "http://zord.magamobi.com.br/",
            plugins:"advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking save table contextmenu directionality emoticons template textcolor paste textcolor",
            //plugins:"advlist",
            menubar: true
        }, this.editorConfig));
        this.editor = editor;
        // set initial value when the editor has been rendered            
        editor.on('init', function() {
            editor.setContent(me.value || '');
        });
        // render
        editor.render();
        // --- Relay events to Ext
        editor.on('focus', function() {
            me.previousContent = editor.getContent();
            me.fireEvent('focus', me);
        });

        editor.on('blur', function() {
            me.fireEvent('blur', me);
        });

        editor.on('change', function(e) {
            var content = editor.getContent(),
                previousContent = me.previousContent;
            if (content !== previousContent) {
                me.previousContent = content;
                me.fireEvent('change', me, content, previousContent);
            }
        });
    }

    ,getRawValue: function() {
        var editor = this.editor,
            value = editor && editor.initialized ? editor.getContent() : Ext.value(this.rawValue, '');
        this.rawValue = value;
        return value;
    }

    ,setRawValue: function(value) {
        this.callParent(arguments);

        var editor = this.editor;
        if (editor && editor.initialized) {
            editor.setContent(value);
        }
        return this;
    }
});

Ext.define('Faderim.TreeFormPanel', {
    extend: 'Ext.form.Panel',
    isFormField: true,
    instanceTree:null,
    submitSelection:false,
    itensSelection:null,
    constructor: function(options) {
        var title = options.title;
        options.title = '';
        this.instanceTree = Ext.create('Ext.tree.Panel',options);        
        options.items = this.instanceTree;        
        options.title = title;
        this.callParent(arguments);
    },
    listeners:{
        afterrender: function() {            
            if(this.itensSelection !== null){
                var me = this ;
                var sm = this.getTree().getSelectionModel();                                
                Ext.each(this.itensSelection,function(name,x){                                        
                    var node = me.findByName(name);
                    sm.select(node);                                        
                    var parent = node.parentNode;
                    //vamos abrir nossos galhos
                    while(parent){
                        parent.expand();
                        parent = parent.parentNode;
                    };                    
                });
            }            
        }
    },
    findByName:function(name,father){
        var me = this;
        var childs = (father) ? father.childNodes : me.getTree().getRootNode().childNodes;
        var node = null;
        Ext.each(childs,function(currentNode,x){
            if(currentNode.raw.name == name){
                node = currentNode;
                return false;
            } else if(currentNode.childNodes.length > 0) {
                node = me.findByName(name,currentNode);
                if(node !== null){
                    return false;
                }
            }
        });
        return node;
    },
    getTree:function(){
        return this.instanceTree;
    },
    reset:function(){
        var selecionados = this.getTree().getView().getChecked();
        Ext.each(selecionados,function(node,index){            
            console.log(node);            
        });                     
    },
    validate: function(){
        return 1;
    },    
    isFileUpload: function() {
        return 0;        
    },
    getValues:function() {
        var data = [];
        var selecionados = [];
        if( this.submitSelection ) {
            var sm = this.getTree().getSelectionModel();
            if( sm.hasSelection() ) {
                selecionados = sm.getSelection();
            }
        } else {
            selecionados = this.getTree().getView().getChecked();
        }
        Ext.each(selecionados,function(node,index){            
            data.push(node.raw.value);            
        });     
        return data;        
    },
    getModelData: function() {        
        return {};
    },
    getSubmitData: function() {        
        var o = {};
        var name = this.name;
        o[name] = Ext.encode(this.getValues());
        return o;
    },
    unCheckAll: function(nodes) {        
        nodes = nodes || this.getTree().getRootNode();
        var checked = false;
        var me = this;
        Ext.each(nodes, function(node){
            // Vamos verificar se existe um check
            if (node.get('checked') !== null) {
                node.set('checked',(checked));
            }
            // Explora os filhos do Node - se tiver algum
            if (!node.leaf) {
                me.unCheckAll(node.childNodes, checked);
            }
        });
    },
    checkAllFromValues : function(values, nodes) {
        nodes = nodes || this.getTree().getRootNode();
        var checked = false;
        var me = this;
        Ext.each(nodes, function(node){
            // Vamos verificar se existe um check
            if (node.get('checked') !== null) {
                checked = false;
                for(var i=0; i<values.length; i++) {
                    if (values[i] == node.raw.value) {
                        checked = true;
                    }
                }
                node.set('checked',(checked));
            }
            // Explora os filhos do Node - se tiver algum
            if (!node.leaf) {
                me.checkAllFromValues(values, node.childNodes);
            }
        });        
    }
});