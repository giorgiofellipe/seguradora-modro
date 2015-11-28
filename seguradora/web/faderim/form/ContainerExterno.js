Ext.define('Faderim.form.ContainerExterno', {
    extend: 'Ext.form.FieldContainer',
    layout: 'hbox',
    isExterno:true,
    pageSize: 20,
    parametros: null,
    fields: [],
    defaults: {
        hideLabel: true
    },
    constructor: function() {
        this.addEvents('selectRow');
        this.callParent(arguments);

    },
    listeners: {
        beforeadd: function(self, comp) {
            comp.hideLabel = true;
        }
    },
    createBindField: function() {
        this.bindField = Ext.create('Ext.form.field.Hidden', {
            name: this.name
        });
    },
    beforeRender: function() {
        this.callParent(arguments);
        this.createBindField();
        this.createButtonFind();
        this.createSuggest();
        this.createBind();
        this.createFind();
        this.add(this.bindField);
        this.add(this.suggest);
        this.add(this.buttonFind);
        if (this.value) {
            this.selectRow(this.value);
        }
    },
    setValue: function(value) {
        this.value = value;
    },
    doBlurField: function() {
        this.bindField.setValue('');
        this.suggest.setValue('');
        var filters = [];
        var required = true;
        for (var i = 0; i < this.fields.length; i++) {
            var obj = this.fields[i];
            if (obj.find) {
                var el = obj.getBind();
                var value = el.getValue();
                //somente adiciona filtros que estao preenchidos
                if (value != '' && value != null) {
                    filters.push({id: obj.name, property: '=', value: value});
                }
                //se algum não estiver preenchido aborta
                else {
                    required = false;
                }
            }
        }
        var fixeds = this.getFiltersParams();
        if (fixeds.length > 0) {
            Ext.each(fixeds, function(fixed) {
                filters.push(fixed);
            });
        }
        if (required && filters.length > 0) {
            var self = this;
            self.store.clearFilter(true);
            //console.log(self.suggest.inputEl);
            self.suggest.inputEl.dom.setAttribute('placeholder', 'Carregando...');
            self.suggest.setDisabled(true);
            this.store.load({
                params: this.getGridParam(filters),
                callback: function(records, operation, sucess) {
                    self.suggest.inputEl.dom.setAttribute('placeholder', '');
                    self.suggest.setDisabled(false);
                    if (sucess) {
                        if (records && records[0]) {
                            self.selectRow(records[0]['data']);
                        }
                        else {
                            self.selectRow(null);
                            alert('Registro não encontrado');
                        }
                    }
                }
            });
        }
        else {
            //   alert('lipando os campos');
        }
    },
    selectRow: function(row) {
        if (row !== null) {
            for (var i = 0; i < this.fields.length; i++) {
                var obj = this.fields[i];
                var name = obj.name;
                var el = obj.getBind();
                if (el) {
                    var value = row[name];
                    el.setValue(value);
                }
            }
            this.bindField.setValue(JSON.stringify(row));
        }
        this.fireEvent('selectRow', row);
        //setamos o focus para o próximo
        if (row !== null) {
            var next = this.next();
            while (next && next.isVisible() == false) {
                next = next.next();
                if (!next) {
                    break;
                }
            }
            if (next) {
                if (next.isXType('containerExterno')) {
                    next.objFocus.focus();
                } else {
                    next.focus();
                }
                //forçamos no suggest
            } else if (this.suggest) {
                this.suggest.focus();
                //forçamos no botão de busca
            } else if (this.buttonFind) {
                this.buttonFind.focus();
            }
        }
    },
    createFind: function() {
        for (var i = 0; i < this.fields.length; i++) {
            var obj = this.fields[i];
            if (obj.find) {
                var el = obj.getBind();
                el.on({blur: {fn: this.doBlurField, scope: this}});
            }
        }
    },
    createBind: function() {
        var form = this.up('form');
        var me = this;
        Ext.each(this.fields, function() {
            this.getBind = function() {
                var name = this.bind;
                if (name) {
                    var current = me.query('[name=' + name + ']');
                    if (current.length > 0) {
                        return current[0];
                    }
                }
                return null;
            };
        });
    },
    getTemplate: function() {
        var tpl = '<tpl for="."><div class="x-boundlist-item">';

        var fields = [];
        for (var i = 0; i < this.fields.length; i++) {
            var obj = this.fields[i];
            if (obj.display) {
                fields.push('{' + obj.name + '}');
            }
        }
        tpl += fields.join(' - ');
        tpl += '</div></tpl>';
        return tpl;
        return '<tpl for="."><div class="x-boundlist-item">{nome} - {codigo}</div></tpl>';
    },
    createSuggest: function() {
        if (this.store && this.pageSize) {
            this.store.pageSize = this.pageSize;
        }

        var self = this;

        this.suggest = Ext.create('Ext.form.ComboBox', {
            store: this.store,
            //typeAhead: false,
            hideTrigger: true,
            name: this.suggestFieldName,
            triggerAction: 'query',
            anchor: '100%',
            flex: 1,
            emptyText: 'Digite para pesquisar...',
            queryField: this.queryField,
            listeners: {
                scope: self,
                select: function(a, b, c) {
                    if (b && b.length > 0 && b[0].data) {
                        this.selectRow(b[0].data);
                    }
                }
            },
            getParams: function(s) {
                var filters = [];
                this.store.clearFilter(true);
                for (var i = 0; i < self.fields.length; i++) {
                    var obj = self.fields[i];
                    if (obj.suggest) {
                        var el = obj.getBind();
                        var value = el.getValue();
                        filters.push({id: obj.name, property: 'LIKE', value: value});
                    }
                }
                var fixeds = self.getFiltersParams();
                if (fixeds.length > 0) {
                    Ext.each(fixeds, function(fixed) {
                        filters.push(fixed);
                    });
                }
                this.store.filter(filters);
                return self.getGridParam(filters);
            },
            listConfig: {
                minWidth: 600,
                loadingText: 'Realizando busca...',
                emptyText: 'Nenhum registro encontrado',
                tpl: self.getTemplate()
            },
            pageSize: this.pageSize
        });
    },
    createButtonFind: function() {
        var self = this;
        this.buttonFind = Ext.create('Ext.button.Button', {
            margin: '1 3 0 3',
            icon: Faderim.Util.icon('magnifier'),
            listeners: {
                scope: self,
                click: self.openGrid
            }
        });
    },
    openGrid: function() {
        var render = this.up('[windowContainer]');
        var self = this;
        var routerName = this.router;
        Ext.create('Faderim.AjaxRouter', {
            method: 'POST',
            router: routerName,
            renderTo: render,
            success: function(grid) {
                var btnSel = Ext.create('Faderim.view.ActionGrid', {
                    text: 'Selecionar',
                    listeners: {
                        click: function() {
                            var rows = grid.getSelectedRows();
                            grid.up().close();
                            if (rows[0]) {
                                self.selectRow(rows[0]);
                            }
                        }
                    }
                });
                var view = render.getSize();
                grid.width = view.width * 0.9;
                grid.height = view.height * 0.9;
                var filters = self.getFiltersParams();
                //adicionamos o filtro inicial
                grid.store.filter(filters);
                //adicionamos o filtros para as outras requisições da consulta
                grid.setFiltersFixed(filters);
                grid.addActionRow(btnSel, 0);
            },
            caller: this,
            maskTarget: Ext.getBody(),
            target: 'window'
        });
    },
    getFiltersParams: function() {
        var filters = [];
        if (this.parametros !== null) {
            var parametros = JSON.parse(this.parametros);
            for (var name in parametros) {
                filters.push({id: name, property: '=', value: parametros[name]});
            }
        }
        return filters;
    },
    getGridParam: function(objects) {
        var params = {};
        params['q'] = this.store.proxy.encodeFilters(objects);
        return params;
    }
});
