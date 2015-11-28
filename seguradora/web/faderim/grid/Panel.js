Ext.define('Faderim.grid.Panel', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.faderim-grid',
    autoHeight: true,        
    constructor: function(options) {        
        var combo = new Ext.form.ComboBox({
            name: 'perpage',
            width: 60,
            store: new Ext.data.ArrayStore({
                fields: ['id'],
                data: [
                    ['15'],
                    ['20'],
                    ['25'],
                    ['50'],
                    ['100'],
                    ['500']
                ]
            }),
            mode: 'local',
            value: options.store.pageSize + '',
            listWidth: 50,
            triggerAction: 'all',
            displayField: 'id',
            valueField: 'id',
            editable: false,
            forceSelection: true
        });
        if (options.store.pageSize > 0) {
            options.bbar = Ext.create('Ext.PagingToolbar', {
                store: options.store,
                pageSize: 15,
                displayInfo: true,
                items: [
                    '-',
                    'Registros: ',
                    combo
                ]
            });
        }
        else {
            options.store.remoteSort = false;
        }
        combo.on('select', function(combo, record) {
            var pageSize = parseInt(record[0].get('id'), 10);
            options.store.pageSize = pageSize;
            options.bbar.pageSize = pageSize;
            options.bbar.doRefresh();
            //options.bbar.doLoad(options.bbar.cursor);
        }, this);
        options.features = [];
        var bUseSumary = false;
        Ext.each(options.columns, function(column, i) {
            if (column.summaryType) {
                bUseSumary = true;
                column.summaryName = column.summaryType;
                if (!column.summaryRenderer) {
                    column.summaryRenderer = function(a) {
                        var desc = {'count': 'Total:', 'sum': 'Soma:'}
                        return '<span style="font-weight:bold">' + desc[column.summaryName] + ' ' + a + '</span>';
                    };
                }
                column.summaryType = function(rows, col) {
                    var len = rows.length;
                    var val = 0;
                    for (var j = 0; j < len; j++) {
                        var row = rows[j];
                        var value = row['data'][col];
                        switch (options.columns[i].summaryName.toLowerCase()) {
                            case 'sum':
                                val += parseFloat(value);
                                break;
                            case 'count':
                                val++;
                                break;

                        }
                    }
                    return val;
                };
            }

        });
        if (bUseSumary) {
            options.features.push({
                ftype: 'summary'
            });
        }
        var self = this;
        options.selModel = Ext.create('Ext.selection.CheckboxModel', {
            listeners: {
                selectionchange: function(sm, selections) {                    
                    Ext.each(self.toolRowAction.items.items, function() {
                        if (this.faderim_multiple) {
                            this.setDisabled(selections.length === 0);
                        }
                        else {
                            this.setDisabled(selections.length !== 1);
                        }

                    });
                }
            }
        });
        this.createActions(options);
        options.dockedItems = [this.createFilters(options), /*,this.createActions(options)*/
            , new Ext.Panel({
                layout: 'hbox',
                items: [
                    this.toolAction,
                    this.toolRowAction
                            /*
                             {xtype: 'toolbar',border:0, items: [{text: 'one text'}]},
                             {xtype: 'toolbar',border:0, items: [{text: 'one two'}]}*/
                ]
            })
        ];
        this.callParent(arguments);
    },    
    filterFn: function(field, e) {        
        var me = this, value = field.getValue();
        if (e.getKey() === e.ENTER) {
            var store = field.up('grid').getStore();
            store.filter(me.fieldName, value);
        }
    },
    createFilters: function(options) {
        //options.store.remoteFilter = true;
        var me = this;
        var itens = [];
        Ext.each(options.columns, function() {
            if (this.filter) {
                var it = {};
                for (var key in this) {
                    it[key] = this[key];
                }
                if (it['store']) {
                    it['store'] = Faderim.Util.storeClone(it['store']);
                }
                it['width'] = 110;
                it['hidden'] = false;
                it['emptyText'] = this.text;
                it['xtype'] = this.xtype === 'listcolumn' ? 'combobox' : 'textfield';
                itens.push(it);
            }
        });
        var find = {
            text: 'Atualizar',
            icon: Faderim.Util.baseIconUrl + 'magnifier.png',
            xtype: 'button',
            handler: function() {                
                options.store.clearFilter(true);
                var toolIt = this.up('toolbar').items;
                var filters = [];
                Ext.each(itens, function() {
                    var field = this;
                    Ext.each(toolIt.items, function() {
                        if (this.name && this.name === field.name) {
                            var val = this.getValue();
                            if (val !== null && val != "") {
                                filters.push({
                                    id: field.name,
                                    property: '=',
                                    value: val
                                });
                            }
                        }
                    });
                });                
                if (filters.length > 0) {
                    options.store.filter(filters);
                } else {
                    options.store.clearFilter(false);
                }
            }
        };
        if (itens.length > 0) {
            itens.unshift({
                xtype: 'tbfill'
            });
            itens.push(find);            
            var tool = {
                xtype: 'toolbar',
                cls: 'grid-header-filter',
                dock: 'top',
                items: itens
            };
            return tool;
        }
        else {
            return null;
        }
    },
    executeAction: function(action) {
        var me = this;
        var fnExecute = function() {
            if (action.faderim_type === 1) {
                me.executeActionHide(action);
            }
            else if (action.faderim_type === 2) {
                me.executeActionComponent(action);
            }
            else if (action.faderim_type === 3) {
                me.executeActionWindow(action);
            }
        };
        if (action.faderim_confirm) {
            Ext.Msg.confirm('Confirmação', 'Você deseja realmente executar a ação de ' + action.text + ' para os itens selecionados?', function(e) {
                if ('yes' === e) {
                    fnExecute();
                }
            });
        }
        else {
            fnExecute();
        }
    },
    getSelectedRows: function() {
        var selection = this.getSelectionModel().getSelection();
        var row = [];
        Ext.each(selection, function() {
            row.push(this.data);
        });
        return row;
    },
    getActionParameters: function(paramsDefaults) {        
        var selectedRows = {rows: JSON.stringify(this.getSelectedRows())};        
        paramsDefaults = (paramsDefaults ==  null) ? {} : paramsDefaults;        
        var param = Ext.apply(paramsDefaults, selectedRows);        
        return param;
    },
    executeActionHide: function(action) {
        Ext.create('Faderim.AjaxRouter', {
            method: 'POST',
            router: action.faderim_router,
            maskTarget: this,
            caller: this,
            target: 'hide',
            params: this.getActionParameters(action.faderim_params_defaults)
        });
    },
    createComponentFromAction: function(action, fnAction) {
        Ext.create('Faderim.AjaxRouter', {
            method: 'POST',
            router: action.faderim_router,
            maskTarget: this,
            caller: this,
            target: 'window',
            params: this.getActionParameters(action.faderim_params_defaults)
        });
    },
    executeActionWindow: function(action) {
        Ext.create('Faderim.AjaxRouter', {
            method: 'POST',
            router: action.faderim_router,
            maskTarget: this,
            caller: this,
            target: 'window',
            params: this.getActionParameters(action.faderim_params_defaults)
        });
    },
    executeActionComponent: function(action) {
        Ext.create('Faderim.AjaxRouter', {
            method: 'POST',
            router: action.faderim_router,
            maskTarget: this,
            target: 'tabs',
            params: this.getActionParameters(action.faderim_params_defaults)
        });
    },
    addAction: function(btn,pos) {
        var me = this;
        btn.addListener('click', function() {
            me.executeAction(this);
        });
        this.toolAction.add(btn,pos);
    },
    addActionRow: function(btn,pos) {
        var me = this;
        btn.setDisabled(true);
        btn.addListener('click', function() {
            me.executeAction(this);
        });
        if(pos!==undefined) {
            this.toolRowAction.insert(pos,btn);    
        }
        else {
            this.toolRowAction.add(btn);    
        }
        
    },
    createActions: function(options) {
        var me = this;
        this.toolAction = new Ext.create('Ext.toolbar.Toolbar',{border:0});
        this.toolRowAction = new Ext.create('Ext.toolbar.Toolbar',{border:0,margin:'0 0 0 10'});
        Ext.each(options.action, function(cmp, i) {
            me.addAction(this);
        });
        Ext.each(options.rowAction, function() {
            me.addActionRow(this);
        });
    },
    findColumnByName: function(name) {
        var len = this.columns.length;
        for (var i = 0; i < len; i++) {
            var col = this.columns[i];
            if (col.name === name) {
                return col;
            }
        }
        return null;
    },
    setFiltersFixed:function(filtersFixed){
        this.store.setFiltersFixed(filtersFixed);
    },
    getFiltersFixed:function(){
        this.store.getFiltersFixed();;
    }
});
