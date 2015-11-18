
Ext.define('Faderim.data.GridJsonStore', {
    extend: 'Ext.data.JsonStore',
    remoteFilter: true,
    remoteSort: true,
    filterFixed: null,
    constructor: function(options) {       
        options.proxy.filterParam = 'q';
        options.proxy.encodeFilters = function(filters) {                        
            var a = [];
            Ext.each(filters, function() {                
                a.push({id: this.id, p: this.property, v: this.value});
            });            
            return JSON.stringify(a);
        };
        this.callParent(arguments);
        
    },    
    filterOne: function(campo, operador, value) {
        this.store.filter({id: campo, property: operador, value: value});
    },    
    listeners:{
        beforeload:function(store, operation, eOpts){
            Ext.each(this.getFiltersFixed(),function(fixed){
                 operation.filters.push(fixed);
            });            
            var param = store.proxy.getParams(operation);            
            store.proxy.buildRequest(param);
        }
    },
    setFiltersFixed:function(filtersFixed){
        this.filterFixed = filtersFixed;
    },
    getFiltersFixed:function(){
        return this.filterFixed;
    }
});