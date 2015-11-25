/*
 * @Copyright (c) 2011 AurÃ©lio Saraiva
 * @Page http://github.com/plentz/jquery-maskmoney, http://code.google.com/p/extjs-field-money/
 * try at http://exemplos.aureliosaraiva.com/fieldmoney/exemplo.html

 * Permission is hereby granted, free of charge, to any person
 * obtaining a copy of this software and associated documentation
 * files (the "Software"), to deal in the Software without
 * restriction, including without limitation the rights to use,
 * copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following
 * conditions:
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
 * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 */

/**
 * Aviso Magazord, os números inteiros do javascript são precisos até 15 digitos,
 * caso você esteja tendo problemas com valores com mais que esta quantidade de
 * de digitos provávelmente esta é a causa.
 */

/*
 * @Version: 0.2
 * @Release: 2012-01-20
 */
Ext.define('Faderim.form.field.FieldNumber', {
    extend: 'Ext.form.field.Text',
    alias: 'widget.field-money',
    symbol: 'R$ ',
    showSymbol: false,
    symbolStay: false,
    thousands: '',
    decimal: '',
    precision: 0,
    defaultZero: false,
    allowZero: true,
    allowNegative: false,
    editorConsulta: false,
    constructor: function(options) {
        options.maxLength = options.maxLength || 16;
        this.callParent(arguments);
    },
    onRender: function() {
        this.callParent(arguments);
        var name = this.name || this.inputEl.dom.name;
        this.hiddenField = this.inputEl.insertSibling({
            tag: 'input',
            type: 'hidden',
            name: name,
            value: this._parseValue(this.value)
        });
        this.hiddenName = name;

        this.inputEl.dom.removeAttribute('name');
        this.inputEl.on({
            keyup: {
                scope: this,
                fn: this._onUpdateHidden
            },
            blur: {
                scope: this,
                fn: this._onUpdateHidden
            }
        },
        Ext.isIE ? 'after' : 'before');
        this.value = this._maskValue(this.value);
        this.inputEl.dom.setAttribute('maxLength', this.maxLength);
        this.setValue = Ext.Function.createSequence(this.setValue, this._onUpdateHidden, this);
        this.setValue(this.value);
    },
    setValue:function(v){
        if(this.editorConsulta && v){
            //Quando o valor for numérico vamos forçar a ter as casas decimais
            if (typeof v == 'number'){
                v = v.toFixed(this.precision);
            }
            v = this._maskValue(v.toString());
        }
        this.callParent([v]);
    },
    getValue:function(){
        var v = this.callParent();
        if(this.editorConsulta && v){
            //Quando o valor for numérico vamos forçar a ter as casas decimais
            if (typeof v == 'number'){
                v = v.toFixed(this.precision);
            }
            v = this._parseValue(v);
        }
        return v;
    },
    getSubmitData: function() {
        var name = this.name;
        var o = {};

        o[name] = this._parseValue(this.getValue());

        return o;
    },
    _parseValue: function(v) {
        if(!v){
            return v;
        }
        v = v.toString();
        var isNegative = v.substr(0,1)=='-';
        v = v.replace(/\D/g, "");
        if(isNegative) {
            v = '-'+v;
        }
        if (v.length == 0 && this.defaultZero == false) {
            return '';
        } else if (v.length == 0) {
            return 0;
        }
        var aux = v;
        if (this.precision > 0) {
            aux = v.substr(0, (v.length - this.precision)) + '.' + v.substr((v.length - this.precision));
        }
        return (this.editorConsulta) ? aux : parseFloat(aux);
    },
    _onUpdateHidden: function() {
        this.hiddenField.dom.value = this._parseValue(this.getValue());
    },
    initEvents: function() {

        var input = this.inputEl;

        input.on('keypress', this._onKeypress, this);
        input.on('keydown', this._onKeydown, this);
        input.on('blur', this._onBlur, this);
        input.on('focus', this._onFocus, this);

        this.callParent();
    },
    _onFocus: function(e) {
        var input = this.inputEl;

        var mask = this._getDefaultMask();
        if (input.getValue() == mask) {
            input.getValue('');
        } else if (input.getValue() == '' && this.defaultZero) {
            input.dom.value = (this._setSymbol(mask));
        } else {
            input.dom.value = (this._setSymbol(input.getValue()));
        }
        if (this.createTextRange) {
            var textRange = this.createTextRange();
            textRange.collapse(false);
            // set the cursor at the end of the input
            textRange.select();
        }
    },
    _onBlur: function(e) {
        if (Ext.isIE) {
            this._onKeypress(e);
        }

        var input = this.inputEl;

        if (input.getValue() == '' && this.defaultZero == false) {
            input.dom.value = '';
            return;
        }

        if (input.getValue() == '' || input.getValue() == this._setSymbol(this._getDefaultMask()) || input.getValue() == this.symbol) {
            if (!this.allowZero)
                input.dom.value = '';
            else if (!this.symbolStay)
                input.dom.value = (this._getDefaultMask());
            else
                input.dom.value = (this._setSymbol(this._getDefaultMask()));
        } else {
            if (!this.symbolStay)
                input.dom.value = (input.getValue().replace(this.symbol, ''));
            else if (this.symbolStay && input.getValue() == this.symbol)
                input.dom.value = (this._setSymbol(this._getDefaultMask()));
        }
    },
    _onKeydown: function(e) {
        e = e || window.event;
        var k = e.getCharCode() || e.getKey() || e.which, input = this.inputEl;
        if (k == undefined)
            return false;
        //needed to handle an IE "special" event
        if (input.getAttribute('readonly') && (k != 13 && k != 9))
            return false;
        // don't allow editing of readonly fields but allow tab/enter

        var x = input.dom;
        var selection = this._getInputSelection(x);
        var startPos = selection.start;
        var endPos = selection.end;

        if (k == 8) {// backspace key
            e.preventDefault();

            if (startPos == endPos) {
                // Remove single character
                x.value = x.value.substring(0, startPos - 1) + x.value.substring(endPos, x.value.length);
                startPos = startPos - 1;
            } else {
                // Remove multiple characters
                x.value = x.value.substring(0, startPos) + x.value.substring(endPos, x.value.length);
            }
            this._maskAndPosition(x, startPos);
            return false;
        } else if (k == 9) {// tab key
            return true;
        } else if (k == 46 || k == 63272) {// delete key (with special case for safari)
            e.preventDefault();
            if (x.selectionStart == x.selectionEnd) {
                // Remove single character
                x.value = x.value.substring(0, startPos) + x.value.substring(endPos + 1, x.value.length);
            } else {
                //Remove multiple characters
                x.value = x.value.substring(0, startPos) + x.value.substring(endPos, x.value.length);
            }
            this._maskAndPosition(x, startPos);
            return false;
        } else {// any other key
            return true;
        }
    },
    _onKeypress: function(e) {
        e = e || window.event;        
        var k = e.getCharCode() || e.getKey() || e.which, input = this.inputEl;
        var keyCode = e.keyCode;
        if (k == undefined)
            return false;
        //needed to handle an IE "special" event
        if (input.getAttribute('readonly') && (k != 13 && k != 9))
            return false;
        // don't allow editing of readonly fields but allow tab/enter

        if (k < 48 || k > 57) {// any key except the numbers 0-9
            if (k == 45) {// -(minus) key
                this.setValue(this._changeSign(input, k));
                e.preventDefault();
                return false;
            }
            if (k == 43) {// +(plus) key
                e.preventDefault();
                this.setValue(this._changeSign(input, k));
                return false;
            } else if (k == 13 || k == 9) {// enter key or tab key
                return true;
            } else if (!Ext.isWebKit && !Ext.isIE && (keyCode == 37 || keyCode == 39 || keyCode == 36 || keyCode == 35)) {// left arrow key, right arrow key, or HOME or END
                return true;
            } else {// any other key with keycode less than 48 and greater than 57
                e.preventDefault();
                return true;
            }
        } else if (input.getValue().length == input.getAttribute('maxlength')) {
            return false;
        } else {
            e.preventDefault();

            var key = String.fromCharCode(k);
            var x = input.dom;

            var selection = this._getInputSelection(x);
            var startPos = selection.start;
            var endPos = selection.end;
            x.value = x.value.substring(0, startPos) + key + x.value.substring(endPos, x.value.length);
            this._maskAndPosition(x, startPos + 1);
            return false;
        }
    },
    _getDefaultMask: function() {
        var n = parseFloat('0') / Math.pow(10, this.precision);
        return (n.toFixed(this.precision)).replace(new RegExp('\\.', 'g'), this.decimal);
    },
    _maskValue: function(v) {
        if(!v){
            return v;
        }
        v = v.toString();
        v = v.replace(this.symbol, '');

        var strCheck = '0123456789';
        var len = v.length;
        var a = '', t = '', neg = '';

        if (len != 0 && v.charAt(0) == '-') {
            v = v.replace('-', '');
            if (this.allowNegative) {
                neg = '-';
            }
        }

        if (len == 0) {
            if (!this.defaultZero)
                return t;
            t = '0.00';
        }

        for (var i = 0; i < len; i++) {
            if ((v.charAt(i) != '0') && (v.charAt(i) != this.decimal))
                break;
        }

        for (; i < len; i++) {
            if (strCheck.indexOf(v.charAt(i)) != -1)
                a += v.charAt(i);
        }

        var n = parseFloat(a);
        n = isNaN(n) ? 0 : n / Math.pow(10, this.precision);
        t = n.toFixed(this.precision);
        i = this.precision == 0 ? 0 : 1;
        var p, d = (t = t.split('.'))[i].substr(0, this.precision);
        for (p = (t = t[0]).length; (p -= 3) >= 1; ) {
            t = t.substr(0, p) + this.thousands + t.substr(p);
        }

        return (this.precision > 0) ? this._setSymbol(neg + t + this.decimal + d + Array((this.precision + 1) - d.length).join(0)) : this._setSymbol(neg + t);
    },
    _setSymbol: function(v) {
        if (this.showSymbol) {
            if (v.substr(0, this.symbol.length) != this.symbol)
                return this.symbol + v;
        }
        return v;
    },
    _maskAndPosition: function(x, startPos) {
        var input = this.inputEl, originalLen = input.getValue().length;

        input.dom.value = this._maskValue(x.value);
        var newLen = input.getValue().length;
        startPos = startPos - (originalLen - newLen);
        this._setCursorPosition(startPos);
    },
    _changeSign: function(i, k) {

        var key = String.fromCharCode(k);
        var value = i.getValue();

        if (this.allowNegative) {
            if (key == '+') {
                value = i.getValue().replace('-', '');
            } else if (key == '-' && i.getValue().indexOf('-') == -1) {
                value = '-' + i.getValue();
            }
        }

        return value;

    },
    _getInputSelection: function(el) {
        var start = 0, end = 0, normalizedValue, range, textInputRange, len, endRange;

        if (typeof el.selectionStart == "number" && typeof el.selectionEnd == "number") {
            start = el.selectionStart;
            end = el.selectionEnd;
        } else {
            range = document.selection.createRange();

            if (range && range.parentElement() == el) {
                len = el.value.length;
                normalizedValue = el.value.replace(/\r\n/g, "\n");

                // Create a working TextRange that lives only in the input
                textInputRange = el.createTextRange();
                textInputRange.moveToBookmark(range.getBookmark());

                // Check if the start and end of the selection are at the very end
                // of the input, since moveStart/moveEnd doesn't return what we want
                // in those cases
                endRange = el.createTextRange();
                endRange.collapse(false);

                if (textInputRange.compareEndPoints("StartToEnd", endRange) > -1) {
                    start = end = len;
                } else {
                    start = -textInputRange.moveStart("character", -len);
                    start += normalizedValue.slice(0, start).split("\n").length - 1;

                    if (textInputRange.compareEndPoints("EndToEnd", endRange) > -1) {
                        end = len;
                    } else {
                        end = -textInputRange.moveEnd("character", -len);
                        end += normalizedValue.slice(0, end).split("\n").length - 1;
                    }
                }
            }
        }

        return {
            start: start,
            end: end
        };
    },
    _setCursorPosition: function(pos) {
        var elem = this.inputEl;
        if (elem.dom.setSelectionRange) {
            elem.focus();
            elem.dom.setSelectionRange(pos, pos);
        } else if (elem.createTextRange) {
            var range = elem.createTextRange();
            range.collapse(true);
            range.moveEnd('character', pos);
            range.moveStart('character', pos);
            range.select();
        }
    }
});