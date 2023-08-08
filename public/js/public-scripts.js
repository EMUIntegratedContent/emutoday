/*! jQuery v3.1.1 | (c) jQuery Foundation | jquery.org/license */
!function(a,b){"use strict";"object"==typeof module&&"object"==typeof module.exports?module.exports=a.document?b(a,!0):function(a){if(!a.document)throw new Error("jQuery requires a window with a document");return b(a)}:b(a)}("undefined"!=typeof window?window:this,function(a,b){"use strict";var c=[],d=a.document,e=Object.getPrototypeOf,f=c.slice,g=c.concat,h=c.push,i=c.indexOf,j={},k=j.toString,l=j.hasOwnProperty,m=l.toString,n=m.call(Object),o={};function p(a,b){b=b||d;var c=b.createElement("script");c.text=a,b.head.appendChild(c).parentNode.removeChild(c)}var q="3.1.1",r=function(a,b){return new r.fn.init(a,b)},s=/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,t=/^-ms-/,u=/-([a-z])/g,v=function(a,b){return b.toUpperCase()};r.fn=r.prototype={jquery:q,constructor:r,length:0,toArray:function(){return f.call(this)},get:function(a){return null==a?f.call(this):a<0?this[a+this.length]:this[a]},pushStack:function(a){var b=r.merge(this.constructor(),a);return b.prevObject=this,b},each:function(a){return r.each(this,a)},map:function(a){return this.pushStack(r.map(this,function(b,c){return a.call(b,c,b)}))},slice:function(){return this.pushStack(f.apply(this,arguments))},first:function(){return this.eq(0)},last:function(){return this.eq(-1)},eq:function(a){var b=this.length,c=+a+(a<0?b:0);return this.pushStack(c>=0&&c<b?[this[c]]:[])},end:function(){return this.prevObject||this.constructor()},push:h,sort:c.sort,splice:c.splice},r.extend=r.fn.extend=function(){var a,b,c,d,e,f,g=arguments[0]||{},h=1,i=arguments.length,j=!1;for("boolean"==typeof g&&(j=g,g=arguments[h]||{},h++),"object"==typeof g||r.isFunction(g)||(g={}),h===i&&(g=this,h--);h<i;h++)if(null!=(a=arguments[h]))for(b in a)c=g[b],d=a[b],g!==d&&(j&&d&&(r.isPlainObject(d)||(e=r.isArray(d)))?(e?(e=!1,f=c&&r.isArray(c)?c:[]):f=c&&r.isPlainObject(c)?c:{},g[b]=r.extend(j,f,d)):void 0!==d&&(g[b]=d));return g},r.extend({expando:"jQuery"+(q+Math.random()).replace(/\D/g,""),isReady:!0,error:function(a){throw new Error(a)},noop:function(){},isFunction:function(a){return"function"===r.type(a)},isArray:Array.isArray,isWindow:function(a){return null!=a&&a===a.window},isNumeric:function(a){var b=r.type(a);return("number"===b||"string"===b)&&!isNaN(a-parseFloat(a))},isPlainObject:function(a){var b,c;return!(!a||"[object Object]"!==k.call(a))&&(!(b=e(a))||(c=l.call(b,"constructor")&&b.constructor,"function"==typeof c&&m.call(c)===n))},isEmptyObject:function(a){var b;for(b in a)return!1;return!0},type:function(a){return null==a?a+"":"object"==typeof a||"function"==typeof a?j[k.call(a)]||"object":typeof a},globalEval:function(a){p(a)},camelCase:function(a){return a.replace(t,"ms-").replace(u,v)},nodeName:function(a,b){return a.nodeName&&a.nodeName.toLowerCase()===b.toLowerCase()},each:function(a,b){var c,d=0;if(w(a)){for(c=a.length;d<c;d++)if(b.call(a[d],d,a[d])===!1)break}else for(d in a)if(b.call(a[d],d,a[d])===!1)break;return a},trim:function(a){return null==a?"":(a+"").replace(s,"")},makeArray:function(a,b){var c=b||[];return null!=a&&(w(Object(a))?r.merge(c,"string"==typeof a?[a]:a):h.call(c,a)),c},inArray:function(a,b,c){return null==b?-1:i.call(b,a,c)},merge:function(a,b){for(var c=+b.length,d=0,e=a.length;d<c;d++)a[e++]=b[d];return a.length=e,a},grep:function(a,b,c){for(var d,e=[],f=0,g=a.length,h=!c;f<g;f++)d=!b(a[f],f),d!==h&&e.push(a[f]);return e},map:function(a,b,c){var d,e,f=0,h=[];if(w(a))for(d=a.length;f<d;f++)e=b(a[f],f,c),null!=e&&h.push(e);else for(f in a)e=b(a[f],f,c),null!=e&&h.push(e);return g.apply([],h)},guid:1,proxy:function(a,b){var c,d,e;if("string"==typeof b&&(c=a[b],b=a,a=c),r.isFunction(a))return d=f.call(arguments,2),e=function(){return a.apply(b||this,d.concat(f.call(arguments)))},e.guid=a.guid=a.guid||r.guid++,e},now:Date.now,support:o}),"function"==typeof Symbol&&(r.fn[Symbol.iterator]=c[Symbol.iterator]),r.each("Boolean Number String Function Array Date RegExp Object Error Symbol".split(" "),function(a,b){j["[object "+b+"]"]=b.toLowerCase()});function w(a){var b=!!a&&"length"in a&&a.length,c=r.type(a);return"function"!==c&&!r.isWindow(a)&&("array"===c||0===b||"number"==typeof b&&b>0&&b-1 in a)}var x=function(a){var b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u="sizzle"+1*new Date,v=a.document,w=0,x=0,y=ha(),z=ha(),A=ha(),B=function(a,b){return a===b&&(l=!0),0},C={}.hasOwnProperty,D=[],E=D.pop,F=D.push,G=D.push,H=D.slice,I=function(a,b){for(var c=0,d=a.length;c<d;c++)if(a[c]===b)return c;return-1},J="checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",K="[\\x20\\t\\r\\n\\f]",L="(?:\\\\.|[\\w-]|[^\0-\\xa0])+",M="\\["+K+"*("+L+")(?:"+K+"*([*^$|!~]?=)"+K+"*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|("+L+"))|)"+K+"*\\]",N=":("+L+")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|"+M+")*)|.*)\\)|)",O=new RegExp(K+"+","g"),P=new RegExp("^"+K+"+|((?:^|[^\\\\])(?:\\\\.)*)"+K+"+$","g"),Q=new RegExp("^"+K+"*,"+K+"*"),R=new RegExp("^"+K+"*([>+~]|"+K+")"+K+"*"),S=new RegExp("="+K+"*([^\\]'\"]*?)"+K+"*\\]","g"),T=new RegExp(N),U=new RegExp("^"+L+"$"),V={ID:new RegExp("^#("+L+")"),CLASS:new RegExp("^\\.("+L+")"),TAG:new RegExp("^("+L+"|[*])"),ATTR:new RegExp("^"+M),PSEUDO:new RegExp("^"+N),CHILD:new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\("+K+"*(even|odd|(([+-]|)(\\d*)n|)"+K+"*(?:([+-]|)"+K+"*(\\d+)|))"+K+"*\\)|)","i"),bool:new RegExp("^(?:"+J+")$","i"),needsContext:new RegExp("^"+K+"*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\("+K+"*((?:-\\d)?\\d*)"+K+"*\\)|)(?=[^-]|$)","i")},W=/^(?:input|select|textarea|button)$/i,X=/^h\d$/i,Y=/^[^{]+\{\s*\[native \w/,Z=/^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,$=/[+~]/,_=new RegExp("\\\\([\\da-f]{1,6}"+K+"?|("+K+")|.)","ig"),aa=function(a,b,c){var d="0x"+b-65536;return d!==d||c?b:d<0?String.fromCharCode(d+65536):String.fromCharCode(d>>10|55296,1023&d|56320)},ba=/([\0-\x1f\x7f]|^-?\d)|^-$|[^\0-\x1f\x7f-\uFFFF\w-]/g,ca=function(a,b){return b?"\0"===a?"\ufffd":a.slice(0,-1)+"\\"+a.charCodeAt(a.length-1).toString(16)+" ":"\\"+a},da=function(){m()},ea=ta(function(a){return a.disabled===!0&&("form"in a||"label"in a)},{dir:"parentNode",next:"legend"});try{G.apply(D=H.call(v.childNodes),v.childNodes),D[v.childNodes.length].nodeType}catch(fa){G={apply:D.length?function(a,b){F.apply(a,H.call(b))}:function(a,b){var c=a.length,d=0;while(a[c++]=b[d++]);a.length=c-1}}}function ga(a,b,d,e){var f,h,j,k,l,o,r,s=b&&b.ownerDocument,w=b?b.nodeType:9;if(d=d||[],"string"!=typeof a||!a||1!==w&&9!==w&&11!==w)return d;if(!e&&((b?b.ownerDocument||b:v)!==n&&m(b),b=b||n,p)){if(11!==w&&(l=Z.exec(a)))if(f=l[1]){if(9===w){if(!(j=b.getElementById(f)))return d;if(j.id===f)return d.push(j),d}else if(s&&(j=s.getElementById(f))&&t(b,j)&&j.id===f)return d.push(j),d}else{if(l[2])return G.apply(d,b.getElementsByTagName(a)),d;if((f=l[3])&&c.getElementsByClassName&&b.getElementsByClassName)return G.apply(d,b.getElementsByClassName(f)),d}if(c.qsa&&!A[a+" "]&&(!q||!q.test(a))){if(1!==w)s=b,r=a;else if("object"!==b.nodeName.toLowerCase()){(k=b.getAttribute("id"))?k=k.replace(ba,ca):b.setAttribute("id",k=u),o=g(a),h=o.length;while(h--)o[h]="#"+k+" "+sa(o[h]);r=o.join(","),s=$.test(a)&&qa(b.parentNode)||b}if(r)try{return G.apply(d,s.querySelectorAll(r)),d}catch(x){}finally{k===u&&b.removeAttribute("id")}}}return i(a.replace(P,"$1"),b,d,e)}function ha(){var a=[];function b(c,e){return a.push(c+" ")>d.cacheLength&&delete b[a.shift()],b[c+" "]=e}return b}function ia(a){return a[u]=!0,a}function ja(a){var b=n.createElement("fieldset");try{return!!a(b)}catch(c){return!1}finally{b.parentNode&&b.parentNode.removeChild(b),b=null}}function ka(a,b){var c=a.split("|"),e=c.length;while(e--)d.attrHandle[c[e]]=b}function la(a,b){var c=b&&a,d=c&&1===a.nodeType&&1===b.nodeType&&a.sourceIndex-b.sourceIndex;if(d)return d;if(c)while(c=c.nextSibling)if(c===b)return-1;return a?1:-1}function ma(a){return function(b){var c=b.nodeName.toLowerCase();return"input"===c&&b.type===a}}function na(a){return function(b){var c=b.nodeName.toLowerCase();return("input"===c||"button"===c)&&b.type===a}}function oa(a){return function(b){return"form"in b?b.parentNode&&b.disabled===!1?"label"in b?"label"in b.parentNode?b.parentNode.disabled===a:b.disabled===a:b.isDisabled===a||b.isDisabled!==!a&&ea(b)===a:b.disabled===a:"label"in b&&b.disabled===a}}function pa(a){return ia(function(b){return b=+b,ia(function(c,d){var e,f=a([],c.length,b),g=f.length;while(g--)c[e=f[g]]&&(c[e]=!(d[e]=c[e]))})})}function qa(a){return a&&"undefined"!=typeof a.getElementsByTagName&&a}c=ga.support={},f=ga.isXML=function(a){var b=a&&(a.ownerDocument||a).documentElement;return!!b&&"HTML"!==b.nodeName},m=ga.setDocument=function(a){var b,e,g=a?a.ownerDocument||a:v;return g!==n&&9===g.nodeType&&g.documentElement?(n=g,o=n.documentElement,p=!f(n),v!==n&&(e=n.defaultView)&&e.top!==e&&(e.addEventListener?e.addEventListener("unload",da,!1):e.attachEvent&&e.attachEvent("onunload",da)),c.attributes=ja(function(a){return a.className="i",!a.getAttribute("className")}),c.getElementsByTagName=ja(function(a){return a.appendChild(n.createComment("")),!a.getElementsByTagName("*").length}),c.getElementsByClassName=Y.test(n.getElementsByClassName),c.getById=ja(function(a){return o.appendChild(a).id=u,!n.getElementsByName||!n.getElementsByName(u).length}),c.getById?(d.filter.ID=function(a){var b=a.replace(_,aa);return function(a){return a.getAttribute("id")===b}},d.find.ID=function(a,b){if("undefined"!=typeof b.getElementById&&p){var c=b.getElementById(a);return c?[c]:[]}}):(d.filter.ID=function(a){var b=a.replace(_,aa);return function(a){var c="undefined"!=typeof a.getAttributeNode&&a.getAttributeNode("id");return c&&c.value===b}},d.find.ID=function(a,b){if("undefined"!=typeof b.getElementById&&p){var c,d,e,f=b.getElementById(a);if(f){if(c=f.getAttributeNode("id"),c&&c.value===a)return[f];e=b.getElementsByName(a),d=0;while(f=e[d++])if(c=f.getAttributeNode("id"),c&&c.value===a)return[f]}return[]}}),d.find.TAG=c.getElementsByTagName?function(a,b){return"undefined"!=typeof b.getElementsByTagName?b.getElementsByTagName(a):c.qsa?b.querySelectorAll(a):void 0}:function(a,b){var c,d=[],e=0,f=b.getElementsByTagName(a);if("*"===a){while(c=f[e++])1===c.nodeType&&d.push(c);return d}return f},d.find.CLASS=c.getElementsByClassName&&function(a,b){if("undefined"!=typeof b.getElementsByClassName&&p)return b.getElementsByClassName(a)},r=[],q=[],(c.qsa=Y.test(n.querySelectorAll))&&(ja(function(a){o.appendChild(a).innerHTML="<a id='"+u+"'></a><select id='"+u+"-\r\\' msallowcapture=''><option selected=''></option></select>",a.querySelectorAll("[msallowcapture^='']").length&&q.push("[*^$]="+K+"*(?:''|\"\")"),a.querySelectorAll("[selected]").length||q.push("\\["+K+"*(?:value|"+J+")"),a.querySelectorAll("[id~="+u+"-]").length||q.push("~="),a.querySelectorAll(":checked").length||q.push(":checked"),a.querySelectorAll("a#"+u+"+*").length||q.push(".#.+[+~]")}),ja(function(a){a.innerHTML="<a href='' disabled='disabled'></a><select disabled='disabled'><option/></select>";var b=n.createElement("input");b.setAttribute("type","hidden"),a.appendChild(b).setAttribute("name","D"),a.querySelectorAll("[name=d]").length&&q.push("name"+K+"*[*^$|!~]?="),2!==a.querySelectorAll(":enabled").length&&q.push(":enabled",":disabled"),o.appendChild(a).disabled=!0,2!==a.querySelectorAll(":disabled").length&&q.push(":enabled",":disabled"),a.querySelectorAll("*,:x"),q.push(",.*:")})),(c.matchesSelector=Y.test(s=o.matches||o.webkitMatchesSelector||o.mozMatchesSelector||o.oMatchesSelector||o.msMatchesSelector))&&ja(function(a){c.disconnectedMatch=s.call(a,"*"),s.call(a,"[s!='']:x"),r.push("!=",N)}),q=q.length&&new RegExp(q.join("|")),r=r.length&&new RegExp(r.join("|")),b=Y.test(o.compareDocumentPosition),t=b||Y.test(o.contains)?function(a,b){var c=9===a.nodeType?a.documentElement:a,d=b&&b.parentNode;return a===d||!(!d||1!==d.nodeType||!(c.contains?c.contains(d):a.compareDocumentPosition&&16&a.compareDocumentPosition(d)))}:function(a,b){if(b)while(b=b.parentNode)if(b===a)return!0;return!1},B=b?function(a,b){if(a===b)return l=!0,0;var d=!a.compareDocumentPosition-!b.compareDocumentPosition;return d?d:(d=(a.ownerDocument||a)===(b.ownerDocument||b)?a.compareDocumentPosition(b):1,1&d||!c.sortDetached&&b.compareDocumentPosition(a)===d?a===n||a.ownerDocument===v&&t(v,a)?-1:b===n||b.ownerDocument===v&&t(v,b)?1:k?I(k,a)-I(k,b):0:4&d?-1:1)}:function(a,b){if(a===b)return l=!0,0;var c,d=0,e=a.parentNode,f=b.parentNode,g=[a],h=[b];if(!e||!f)return a===n?-1:b===n?1:e?-1:f?1:k?I(k,a)-I(k,b):0;if(e===f)return la(a,b);c=a;while(c=c.parentNode)g.unshift(c);c=b;while(c=c.parentNode)h.unshift(c);while(g[d]===h[d])d++;return d?la(g[d],h[d]):g[d]===v?-1:h[d]===v?1:0},n):n},ga.matches=function(a,b){return ga(a,null,null,b)},ga.matchesSelector=function(a,b){if((a.ownerDocument||a)!==n&&m(a),b=b.replace(S,"='$1']"),c.matchesSelector&&p&&!A[b+" "]&&(!r||!r.test(b))&&(!q||!q.test(b)))try{var d=s.call(a,b);if(d||c.disconnectedMatch||a.document&&11!==a.document.nodeType)return d}catch(e){}return ga(b,n,null,[a]).length>0},ga.contains=function(a,b){return(a.ownerDocument||a)!==n&&m(a),t(a,b)},ga.attr=function(a,b){(a.ownerDocument||a)!==n&&m(a);var e=d.attrHandle[b.toLowerCase()],f=e&&C.call(d.attrHandle,b.toLowerCase())?e(a,b,!p):void 0;return void 0!==f?f:c.attributes||!p?a.getAttribute(b):(f=a.getAttributeNode(b))&&f.specified?f.value:null},ga.escape=function(a){return(a+"").replace(ba,ca)},ga.error=function(a){throw new Error("Syntax error, unrecognized expression: "+a)},ga.uniqueSort=function(a){var b,d=[],e=0,f=0;if(l=!c.detectDuplicates,k=!c.sortStable&&a.slice(0),a.sort(B),l){while(b=a[f++])b===a[f]&&(e=d.push(f));while(e--)a.splice(d[e],1)}return k=null,a},e=ga.getText=function(a){var b,c="",d=0,f=a.nodeType;if(f){if(1===f||9===f||11===f){if("string"==typeof a.textContent)return a.textContent;for(a=a.firstChild;a;a=a.nextSibling)c+=e(a)}else if(3===f||4===f)return a.nodeValue}else while(b=a[d++])c+=e(b);return c},d=ga.selectors={cacheLength:50,createPseudo:ia,match:V,attrHandle:{},find:{},relative:{">":{dir:"parentNode",first:!0}," ":{dir:"parentNode"},"+":{dir:"previousSibling",first:!0},"~":{dir:"previousSibling"}},preFilter:{ATTR:function(a){return a[1]=a[1].replace(_,aa),a[3]=(a[3]||a[4]||a[5]||"").replace(_,aa),"~="===a[2]&&(a[3]=" "+a[3]+" "),a.slice(0,4)},CHILD:function(a){return a[1]=a[1].toLowerCase(),"nth"===a[1].slice(0,3)?(a[3]||ga.error(a[0]),a[4]=+(a[4]?a[5]+(a[6]||1):2*("even"===a[3]||"odd"===a[3])),a[5]=+(a[7]+a[8]||"odd"===a[3])):a[3]&&ga.error(a[0]),a},PSEUDO:function(a){var b,c=!a[6]&&a[2];return V.CHILD.test(a[0])?null:(a[3]?a[2]=a[4]||a[5]||"":c&&T.test(c)&&(b=g(c,!0))&&(b=c.indexOf(")",c.length-b)-c.length)&&(a[0]=a[0].slice(0,b),a[2]=c.slice(0,b)),a.slice(0,3))}},filter:{TAG:function(a){var b=a.replace(_,aa).toLowerCase();return"*"===a?function(){return!0}:function(a){return a.nodeName&&a.nodeName.toLowerCase()===b}},CLASS:function(a){var b=y[a+" "];return b||(b=new RegExp("(^|"+K+")"+a+"("+K+"|$)"))&&y(a,function(a){return b.test("string"==typeof a.className&&a.className||"undefined"!=typeof a.getAttribute&&a.getAttribute("class")||"")})},ATTR:function(a,b,c){return function(d){var e=ga.attr(d,a);return null==e?"!="===b:!b||(e+="","="===b?e===c:"!="===b?e!==c:"^="===b?c&&0===e.indexOf(c):"*="===b?c&&e.indexOf(c)>-1:"$="===b?c&&e.slice(-c.length)===c:"~="===b?(" "+e.replace(O," ")+" ").indexOf(c)>-1:"|="===b&&(e===c||e.slice(0,c.length+1)===c+"-"))}},CHILD:function(a,b,c,d,e){var f="nth"!==a.slice(0,3),g="last"!==a.slice(-4),h="of-type"===b;return 1===d&&0===e?function(a){return!!a.parentNode}:function(b,c,i){var j,k,l,m,n,o,p=f!==g?"nextSibling":"previousSibling",q=b.parentNode,r=h&&b.nodeName.toLowerCase(),s=!i&&!h,t=!1;if(q){if(f){while(p){m=b;while(m=m[p])if(h?m.nodeName.toLowerCase()===r:1===m.nodeType)return!1;o=p="only"===a&&!o&&"nextSibling"}return!0}if(o=[g?q.firstChild:q.lastChild],g&&s){m=q,l=m[u]||(m[u]={}),k=l[m.uniqueID]||(l[m.uniqueID]={}),j=k[a]||[],n=j[0]===w&&j[1],t=n&&j[2],m=n&&q.childNodes[n];while(m=++n&&m&&m[p]||(t=n=0)||o.pop())if(1===m.nodeType&&++t&&m===b){k[a]=[w,n,t];break}}else if(s&&(m=b,l=m[u]||(m[u]={}),k=l[m.uniqueID]||(l[m.uniqueID]={}),j=k[a]||[],n=j[0]===w&&j[1],t=n),t===!1)while(m=++n&&m&&m[p]||(t=n=0)||o.pop())if((h?m.nodeName.toLowerCase()===r:1===m.nodeType)&&++t&&(s&&(l=m[u]||(m[u]={}),k=l[m.uniqueID]||(l[m.uniqueID]={}),k[a]=[w,t]),m===b))break;return t-=e,t===d||t%d===0&&t/d>=0}}},PSEUDO:function(a,b){var c,e=d.pseudos[a]||d.setFilters[a.toLowerCase()]||ga.error("unsupported pseudo: "+a);return e[u]?e(b):e.length>1?(c=[a,a,"",b],d.setFilters.hasOwnProperty(a.toLowerCase())?ia(function(a,c){var d,f=e(a,b),g=f.length;while(g--)d=I(a,f[g]),a[d]=!(c[d]=f[g])}):function(a){return e(a,0,c)}):e}},pseudos:{not:ia(function(a){var b=[],c=[],d=h(a.replace(P,"$1"));return d[u]?ia(function(a,b,c,e){var f,g=d(a,null,e,[]),h=a.length;while(h--)(f=g[h])&&(a[h]=!(b[h]=f))}):function(a,e,f){return b[0]=a,d(b,null,f,c),b[0]=null,!c.pop()}}),has:ia(function(a){return function(b){return ga(a,b).length>0}}),contains:ia(function(a){return a=a.replace(_,aa),function(b){return(b.textContent||b.innerText||e(b)).indexOf(a)>-1}}),lang:ia(function(a){return U.test(a||"")||ga.error("unsupported lang: "+a),a=a.replace(_,aa).toLowerCase(),function(b){var c;do if(c=p?b.lang:b.getAttribute("xml:lang")||b.getAttribute("lang"))return c=c.toLowerCase(),c===a||0===c.indexOf(a+"-");while((b=b.parentNode)&&1===b.nodeType);return!1}}),target:function(b){var c=a.location&&a.location.hash;return c&&c.slice(1)===b.id},root:function(a){return a===o},focus:function(a){return a===n.activeElement&&(!n.hasFocus||n.hasFocus())&&!!(a.type||a.href||~a.tabIndex)},enabled:oa(!1),disabled:oa(!0),checked:function(a){var b=a.nodeName.toLowerCase();return"input"===b&&!!a.checked||"option"===b&&!!a.selected},selected:function(a){return a.parentNode&&a.parentNode.selectedIndex,a.selected===!0},empty:function(a){for(a=a.firstChild;a;a=a.nextSibling)if(a.nodeType<6)return!1;return!0},parent:function(a){return!d.pseudos.empty(a)},header:function(a){return X.test(a.nodeName)},input:function(a){return W.test(a.nodeName)},button:function(a){var b=a.nodeName.toLowerCase();return"input"===b&&"button"===a.type||"button"===b},text:function(a){var b;return"input"===a.nodeName.toLowerCase()&&"text"===a.type&&(null==(b=a.getAttribute("type"))||"text"===b.toLowerCase())},first:pa(function(){return[0]}),last:pa(function(a,b){return[b-1]}),eq:pa(function(a,b,c){return[c<0?c+b:c]}),even:pa(function(a,b){for(var c=0;c<b;c+=2)a.push(c);return a}),odd:pa(function(a,b){for(var c=1;c<b;c+=2)a.push(c);return a}),lt:pa(function(a,b,c){for(var d=c<0?c+b:c;--d>=0;)a.push(d);return a}),gt:pa(function(a,b,c){for(var d=c<0?c+b:c;++d<b;)a.push(d);return a})}},d.pseudos.nth=d.pseudos.eq;for(b in{radio:!0,checkbox:!0,file:!0,password:!0,image:!0})d.pseudos[b]=ma(b);for(b in{submit:!0,reset:!0})d.pseudos[b]=na(b);function ra(){}ra.prototype=d.filters=d.pseudos,d.setFilters=new ra,g=ga.tokenize=function(a,b){var c,e,f,g,h,i,j,k=z[a+" "];if(k)return b?0:k.slice(0);h=a,i=[],j=d.preFilter;while(h){c&&!(e=Q.exec(h))||(e&&(h=h.slice(e[0].length)||h),i.push(f=[])),c=!1,(e=R.exec(h))&&(c=e.shift(),f.push({value:c,type:e[0].replace(P," ")}),h=h.slice(c.length));for(g in d.filter)!(e=V[g].exec(h))||j[g]&&!(e=j[g](e))||(c=e.shift(),f.push({value:c,type:g,matches:e}),h=h.slice(c.length));if(!c)break}return b?h.length:h?ga.error(a):z(a,i).slice(0)};function sa(a){for(var b=0,c=a.length,d="";b<c;b++)d+=a[b].value;return d}function ta(a,b,c){var d=b.dir,e=b.next,f=e||d,g=c&&"parentNode"===f,h=x++;return b.first?function(b,c,e){while(b=b[d])if(1===b.nodeType||g)return a(b,c,e);return!1}:function(b,c,i){var j,k,l,m=[w,h];if(i){while(b=b[d])if((1===b.nodeType||g)&&a(b,c,i))return!0}else while(b=b[d])if(1===b.nodeType||g)if(l=b[u]||(b[u]={}),k=l[b.uniqueID]||(l[b.uniqueID]={}),e&&e===b.nodeName.toLowerCase())b=b[d]||b;else{if((j=k[f])&&j[0]===w&&j[1]===h)return m[2]=j[2];if(k[f]=m,m[2]=a(b,c,i))return!0}return!1}}function ua(a){return a.length>1?function(b,c,d){var e=a.length;while(e--)if(!a[e](b,c,d))return!1;return!0}:a[0]}function va(a,b,c){for(var d=0,e=b.length;d<e;d++)ga(a,b[d],c);return c}function wa(a,b,c,d,e){for(var f,g=[],h=0,i=a.length,j=null!=b;h<i;h++)(f=a[h])&&(c&&!c(f,d,e)||(g.push(f),j&&b.push(h)));return g}function xa(a,b,c,d,e,f){return d&&!d[u]&&(d=xa(d)),e&&!e[u]&&(e=xa(e,f)),ia(function(f,g,h,i){var j,k,l,m=[],n=[],o=g.length,p=f||va(b||"*",h.nodeType?[h]:h,[]),q=!a||!f&&b?p:wa(p,m,a,h,i),r=c?e||(f?a:o||d)?[]:g:q;if(c&&c(q,r,h,i),d){j=wa(r,n),d(j,[],h,i),k=j.length;while(k--)(l=j[k])&&(r[n[k]]=!(q[n[k]]=l))}if(f){if(e||a){if(e){j=[],k=r.length;while(k--)(l=r[k])&&j.push(q[k]=l);e(null,r=[],j,i)}k=r.length;while(k--)(l=r[k])&&(j=e?I(f,l):m[k])>-1&&(f[j]=!(g[j]=l))}}else r=wa(r===g?r.splice(o,r.length):r),e?e(null,g,r,i):G.apply(g,r)})}function ya(a){for(var b,c,e,f=a.length,g=d.relative[a[0].type],h=g||d.relative[" "],i=g?1:0,k=ta(function(a){return a===b},h,!0),l=ta(function(a){return I(b,a)>-1},h,!0),m=[function(a,c,d){var e=!g&&(d||c!==j)||((b=c).nodeType?k(a,c,d):l(a,c,d));return b=null,e}];i<f;i++)if(c=d.relative[a[i].type])m=[ta(ua(m),c)];else{if(c=d.filter[a[i].type].apply(null,a[i].matches),c[u]){for(e=++i;e<f;e++)if(d.relative[a[e].type])break;return xa(i>1&&ua(m),i>1&&sa(a.slice(0,i-1).concat({value:" "===a[i-2].type?"*":""})).replace(P,"$1"),c,i<e&&ya(a.slice(i,e)),e<f&&ya(a=a.slice(e)),e<f&&sa(a))}m.push(c)}return ua(m)}function za(a,b){var c=b.length>0,e=a.length>0,f=function(f,g,h,i,k){var l,o,q,r=0,s="0",t=f&&[],u=[],v=j,x=f||e&&d.find.TAG("*",k),y=w+=null==v?1:Math.random()||.1,z=x.length;for(k&&(j=g===n||g||k);s!==z&&null!=(l=x[s]);s++){if(e&&l){o=0,g||l.ownerDocument===n||(m(l),h=!p);while(q=a[o++])if(q(l,g||n,h)){i.push(l);break}k&&(w=y)}c&&((l=!q&&l)&&r--,f&&t.push(l))}if(r+=s,c&&s!==r){o=0;while(q=b[o++])q(t,u,g,h);if(f){if(r>0)while(s--)t[s]||u[s]||(u[s]=E.call(i));u=wa(u)}G.apply(i,u),k&&!f&&u.length>0&&r+b.length>1&&ga.uniqueSort(i)}return k&&(w=y,j=v),t};return c?ia(f):f}return h=ga.compile=function(a,b){var c,d=[],e=[],f=A[a+" "];if(!f){b||(b=g(a)),c=b.length;while(c--)f=ya(b[c]),f[u]?d.push(f):e.push(f);f=A(a,za(e,d)),f.selector=a}return f},i=ga.select=function(a,b,c,e){var f,i,j,k,l,m="function"==typeof a&&a,n=!e&&g(a=m.selector||a);if(c=c||[],1===n.length){if(i=n[0]=n[0].slice(0),i.length>2&&"ID"===(j=i[0]).type&&9===b.nodeType&&p&&d.relative[i[1].type]){if(b=(d.find.ID(j.matches[0].replace(_,aa),b)||[])[0],!b)return c;m&&(b=b.parentNode),a=a.slice(i.shift().value.length)}f=V.needsContext.test(a)?0:i.length;while(f--){if(j=i[f],d.relative[k=j.type])break;if((l=d.find[k])&&(e=l(j.matches[0].replace(_,aa),$.test(i[0].type)&&qa(b.parentNode)||b))){if(i.splice(f,1),a=e.length&&sa(i),!a)return G.apply(c,e),c;break}}}return(m||h(a,n))(e,b,!p,c,!b||$.test(a)&&qa(b.parentNode)||b),c},c.sortStable=u.split("").sort(B).join("")===u,c.detectDuplicates=!!l,m(),c.sortDetached=ja(function(a){return 1&a.compareDocumentPosition(n.createElement("fieldset"))}),ja(function(a){return a.innerHTML="<a href='#'></a>","#"===a.firstChild.getAttribute("href")})||ka("type|href|height|width",function(a,b,c){if(!c)return a.getAttribute(b,"type"===b.toLowerCase()?1:2)}),c.attributes&&ja(function(a){return a.innerHTML="<input/>",a.firstChild.setAttribute("value",""),""===a.firstChild.getAttribute("value")})||ka("value",function(a,b,c){if(!c&&"input"===a.nodeName.toLowerCase())return a.defaultValue}),ja(function(a){return null==a.getAttribute("disabled")})||ka(J,function(a,b,c){var d;if(!c)return a[b]===!0?b.toLowerCase():(d=a.getAttributeNode(b))&&d.specified?d.value:null}),ga}(a);r.find=x,r.expr=x.selectors,r.expr[":"]=r.expr.pseudos,r.uniqueSort=r.unique=x.uniqueSort,r.text=x.getText,r.isXMLDoc=x.isXML,r.contains=x.contains,r.escapeSelector=x.escape;var y=function(a,b,c){var d=[],e=void 0!==c;while((a=a[b])&&9!==a.nodeType)if(1===a.nodeType){if(e&&r(a).is(c))break;d.push(a)}return d},z=function(a,b){for(var c=[];a;a=a.nextSibling)1===a.nodeType&&a!==b&&c.push(a);return c},A=r.expr.match.needsContext,B=/^<([a-z][^\/\0>:\x20\t\r\n\f]*)[\x20\t\r\n\f]*\/?>(?:<\/\1>|)$/i,C=/^.[^:#\[\.,]*$/;function D(a,b,c){return r.isFunction(b)?r.grep(a,function(a,d){return!!b.call(a,d,a)!==c}):b.nodeType?r.grep(a,function(a){return a===b!==c}):"string"!=typeof b?r.grep(a,function(a){return i.call(b,a)>-1!==c}):C.test(b)?r.filter(b,a,c):(b=r.filter(b,a),r.grep(a,function(a){return i.call(b,a)>-1!==c&&1===a.nodeType}))}r.filter=function(a,b,c){var d=b[0];return c&&(a=":not("+a+")"),1===b.length&&1===d.nodeType?r.find.matchesSelector(d,a)?[d]:[]:r.find.matches(a,r.grep(b,function(a){return 1===a.nodeType}))},r.fn.extend({find:function(a){var b,c,d=this.length,e=this;if("string"!=typeof a)return this.pushStack(r(a).filter(function(){for(b=0;b<d;b++)if(r.contains(e[b],this))return!0}));for(c=this.pushStack([]),b=0;b<d;b++)r.find(a,e[b],c);return d>1?r.uniqueSort(c):c},filter:function(a){return this.pushStack(D(this,a||[],!1))},not:function(a){return this.pushStack(D(this,a||[],!0))},is:function(a){return!!D(this,"string"==typeof a&&A.test(a)?r(a):a||[],!1).length}});var E,F=/^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]+))$/,G=r.fn.init=function(a,b,c){var e,f;if(!a)return this;if(c=c||E,"string"==typeof a){if(e="<"===a[0]&&">"===a[a.length-1]&&a.length>=3?[null,a,null]:F.exec(a),!e||!e[1]&&b)return!b||b.jquery?(b||c).find(a):this.constructor(b).find(a);if(e[1]){if(b=b instanceof r?b[0]:b,r.merge(this,r.parseHTML(e[1],b&&b.nodeType?b.ownerDocument||b:d,!0)),B.test(e[1])&&r.isPlainObject(b))for(e in b)r.isFunction(this[e])?this[e](b[e]):this.attr(e,b[e]);return this}return f=d.getElementById(e[2]),f&&(this[0]=f,this.length=1),this}return a.nodeType?(this[0]=a,this.length=1,this):r.isFunction(a)?void 0!==c.ready?c.ready(a):a(r):r.makeArray(a,this)};G.prototype=r.fn,E=r(d);var H=/^(?:parents|prev(?:Until|All))/,I={children:!0,contents:!0,next:!0,prev:!0};r.fn.extend({has:function(a){var b=r(a,this),c=b.length;return this.filter(function(){for(var a=0;a<c;a++)if(r.contains(this,b[a]))return!0})},closest:function(a,b){var c,d=0,e=this.length,f=[],g="string"!=typeof a&&r(a);if(!A.test(a))for(;d<e;d++)for(c=this[d];c&&c!==b;c=c.parentNode)if(c.nodeType<11&&(g?g.index(c)>-1:1===c.nodeType&&r.find.matchesSelector(c,a))){f.push(c);break}return this.pushStack(f.length>1?r.uniqueSort(f):f)},index:function(a){return a?"string"==typeof a?i.call(r(a),this[0]):i.call(this,a.jquery?a[0]:a):this[0]&&this[0].parentNode?this.first().prevAll().length:-1},add:function(a,b){return this.pushStack(r.uniqueSort(r.merge(this.get(),r(a,b))))},addBack:function(a){return this.add(null==a?this.prevObject:this.prevObject.filter(a))}});function J(a,b){while((a=a[b])&&1!==a.nodeType);return a}r.each({parent:function(a){var b=a.parentNode;return b&&11!==b.nodeType?b:null},parents:function(a){return y(a,"parentNode")},parentsUntil:function(a,b,c){return y(a,"parentNode",c)},next:function(a){return J(a,"nextSibling")},prev:function(a){return J(a,"previousSibling")},nextAll:function(a){return y(a,"nextSibling")},prevAll:function(a){return y(a,"previousSibling")},nextUntil:function(a,b,c){return y(a,"nextSibling",c)},prevUntil:function(a,b,c){return y(a,"previousSibling",c)},siblings:function(a){return z((a.parentNode||{}).firstChild,a)},children:function(a){return z(a.firstChild)},contents:function(a){return a.contentDocument||r.merge([],a.childNodes)}},function(a,b){r.fn[a]=function(c,d){var e=r.map(this,b,c);return"Until"!==a.slice(-5)&&(d=c),d&&"string"==typeof d&&(e=r.filter(d,e)),this.length>1&&(I[a]||r.uniqueSort(e),H.test(a)&&e.reverse()),this.pushStack(e)}});var K=/[^\x20\t\r\n\f]+/g;function L(a){var b={};return r.each(a.match(K)||[],function(a,c){b[c]=!0}),b}r.Callbacks=function(a){a="string"==typeof a?L(a):r.extend({},a);var b,c,d,e,f=[],g=[],h=-1,i=function(){for(e=a.once,d=b=!0;g.length;h=-1){c=g.shift();while(++h<f.length)f[h].apply(c[0],c[1])===!1&&a.stopOnFalse&&(h=f.length,c=!1)}a.memory||(c=!1),b=!1,e&&(f=c?[]:"")},j={add:function(){return f&&(c&&!b&&(h=f.length-1,g.push(c)),function d(b){r.each(b,function(b,c){r.isFunction(c)?a.unique&&j.has(c)||f.push(c):c&&c.length&&"string"!==r.type(c)&&d(c)})}(arguments),c&&!b&&i()),this},remove:function(){return r.each(arguments,function(a,b){var c;while((c=r.inArray(b,f,c))>-1)f.splice(c,1),c<=h&&h--}),this},has:function(a){return a?r.inArray(a,f)>-1:f.length>0},empty:function(){return f&&(f=[]),this},disable:function(){return e=g=[],f=c="",this},disabled:function(){return!f},lock:function(){return e=g=[],c||b||(f=c=""),this},locked:function(){return!!e},fireWith:function(a,c){return e||(c=c||[],c=[a,c.slice?c.slice():c],g.push(c),b||i()),this},fire:function(){return j.fireWith(this,arguments),this},fired:function(){return!!d}};return j};function M(a){return a}function N(a){throw a}function O(a,b,c){var d;try{a&&r.isFunction(d=a.promise)?d.call(a).done(b).fail(c):a&&r.isFunction(d=a.then)?d.call(a,b,c):b.call(void 0,a)}catch(a){c.call(void 0,a)}}r.extend({Deferred:function(b){var c=[["notify","progress",r.Callbacks("memory"),r.Callbacks("memory"),2],["resolve","done",r.Callbacks("once memory"),r.Callbacks("once memory"),0,"resolved"],["reject","fail",r.Callbacks("once memory"),r.Callbacks("once memory"),1,"rejected"]],d="pending",e={state:function(){return d},always:function(){return f.done(arguments).fail(arguments),this},"catch":function(a){return e.then(null,a)},pipe:function(){var a=arguments;return r.Deferred(function(b){r.each(c,function(c,d){var e=r.isFunction(a[d[4]])&&a[d[4]];f[d[1]](function(){var a=e&&e.apply(this,arguments);a&&r.isFunction(a.promise)?a.promise().progress(b.notify).done(b.resolve).fail(b.reject):b[d[0]+"With"](this,e?[a]:arguments)})}),a=null}).promise()},then:function(b,d,e){var f=0;function g(b,c,d,e){return function(){var h=this,i=arguments,j=function(){var a,j;if(!(b<f)){if(a=d.apply(h,i),a===c.promise())throw new TypeError("Thenable self-resolution");j=a&&("object"==typeof a||"function"==typeof a)&&a.then,r.isFunction(j)?e?j.call(a,g(f,c,M,e),g(f,c,N,e)):(f++,j.call(a,g(f,c,M,e),g(f,c,N,e),g(f,c,M,c.notifyWith))):(d!==M&&(h=void 0,i=[a]),(e||c.resolveWith)(h,i))}},k=e?j:function(){try{j()}catch(a){r.Deferred.exceptionHook&&r.Deferred.exceptionHook(a,k.stackTrace),b+1>=f&&(d!==N&&(h=void 0,i=[a]),c.rejectWith(h,i))}};b?k():(r.Deferred.getStackHook&&(k.stackTrace=r.Deferred.getStackHook()),a.setTimeout(k))}}return r.Deferred(function(a){c[0][3].add(g(0,a,r.isFunction(e)?e:M,a.notifyWith)),c[1][3].add(g(0,a,r.isFunction(b)?b:M)),c[2][3].add(g(0,a,r.isFunction(d)?d:N))}).promise()},promise:function(a){return null!=a?r.extend(a,e):e}},f={};return r.each(c,function(a,b){var g=b[2],h=b[5];e[b[1]]=g.add,h&&g.add(function(){d=h},c[3-a][2].disable,c[0][2].lock),g.add(b[3].fire),f[b[0]]=function(){return f[b[0]+"With"](this===f?void 0:this,arguments),this},f[b[0]+"With"]=g.fireWith}),e.promise(f),b&&b.call(f,f),f},when:function(a){var b=arguments.length,c=b,d=Array(c),e=f.call(arguments),g=r.Deferred(),h=function(a){return function(c){d[a]=this,e[a]=arguments.length>1?f.call(arguments):c,--b||g.resolveWith(d,e)}};if(b<=1&&(O(a,g.done(h(c)).resolve,g.reject),"pending"===g.state()||r.isFunction(e[c]&&e[c].then)))return g.then();while(c--)O(e[c],h(c),g.reject);return g.promise()}});var P=/^(Eval|Internal|Range|Reference|Syntax|Type|URI)Error$/;r.Deferred.exceptionHook=function(b,c){a.console&&a.console.warn&&b&&P.test(b.name)&&a.console.warn("jQuery.Deferred exception: "+b.message,b.stack,c)},r.readyException=function(b){a.setTimeout(function(){throw b})};var Q=r.Deferred();r.fn.ready=function(a){return Q.then(a)["catch"](function(a){r.readyException(a)}),this},r.extend({isReady:!1,readyWait:1,holdReady:function(a){a?r.readyWait++:r.ready(!0)},ready:function(a){(a===!0?--r.readyWait:r.isReady)||(r.isReady=!0,a!==!0&&--r.readyWait>0||Q.resolveWith(d,[r]))}}),r.ready.then=Q.then;function R(){d.removeEventListener("DOMContentLoaded",R),
a.removeEventListener("load",R),r.ready()}"complete"===d.readyState||"loading"!==d.readyState&&!d.documentElement.doScroll?a.setTimeout(r.ready):(d.addEventListener("DOMContentLoaded",R),a.addEventListener("load",R));var S=function(a,b,c,d,e,f,g){var h=0,i=a.length,j=null==c;if("object"===r.type(c)){e=!0;for(h in c)S(a,b,h,c[h],!0,f,g)}else if(void 0!==d&&(e=!0,r.isFunction(d)||(g=!0),j&&(g?(b.call(a,d),b=null):(j=b,b=function(a,b,c){return j.call(r(a),c)})),b))for(;h<i;h++)b(a[h],c,g?d:d.call(a[h],h,b(a[h],c)));return e?a:j?b.call(a):i?b(a[0],c):f},T=function(a){return 1===a.nodeType||9===a.nodeType||!+a.nodeType};function U(){this.expando=r.expando+U.uid++}U.uid=1,U.prototype={cache:function(a){var b=a[this.expando];return b||(b={},T(a)&&(a.nodeType?a[this.expando]=b:Object.defineProperty(a,this.expando,{value:b,configurable:!0}))),b},set:function(a,b,c){var d,e=this.cache(a);if("string"==typeof b)e[r.camelCase(b)]=c;else for(d in b)e[r.camelCase(d)]=b[d];return e},get:function(a,b){return void 0===b?this.cache(a):a[this.expando]&&a[this.expando][r.camelCase(b)]},access:function(a,b,c){return void 0===b||b&&"string"==typeof b&&void 0===c?this.get(a,b):(this.set(a,b,c),void 0!==c?c:b)},remove:function(a,b){var c,d=a[this.expando];if(void 0!==d){if(void 0!==b){r.isArray(b)?b=b.map(r.camelCase):(b=r.camelCase(b),b=b in d?[b]:b.match(K)||[]),c=b.length;while(c--)delete d[b[c]]}(void 0===b||r.isEmptyObject(d))&&(a.nodeType?a[this.expando]=void 0:delete a[this.expando])}},hasData:function(a){var b=a[this.expando];return void 0!==b&&!r.isEmptyObject(b)}};var V=new U,W=new U,X=/^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,Y=/[A-Z]/g;function Z(a){return"true"===a||"false"!==a&&("null"===a?null:a===+a+""?+a:X.test(a)?JSON.parse(a):a)}function $(a,b,c){var d;if(void 0===c&&1===a.nodeType)if(d="data-"+b.replace(Y,"-$&").toLowerCase(),c=a.getAttribute(d),"string"==typeof c){try{c=Z(c)}catch(e){}W.set(a,b,c)}else c=void 0;return c}r.extend({hasData:function(a){return W.hasData(a)||V.hasData(a)},data:function(a,b,c){return W.access(a,b,c)},removeData:function(a,b){W.remove(a,b)},_data:function(a,b,c){return V.access(a,b,c)},_removeData:function(a,b){V.remove(a,b)}}),r.fn.extend({data:function(a,b){var c,d,e,f=this[0],g=f&&f.attributes;if(void 0===a){if(this.length&&(e=W.get(f),1===f.nodeType&&!V.get(f,"hasDataAttrs"))){c=g.length;while(c--)g[c]&&(d=g[c].name,0===d.indexOf("data-")&&(d=r.camelCase(d.slice(5)),$(f,d,e[d])));V.set(f,"hasDataAttrs",!0)}return e}return"object"==typeof a?this.each(function(){W.set(this,a)}):S(this,function(b){var c;if(f&&void 0===b){if(c=W.get(f,a),void 0!==c)return c;if(c=$(f,a),void 0!==c)return c}else this.each(function(){W.set(this,a,b)})},null,b,arguments.length>1,null,!0)},removeData:function(a){return this.each(function(){W.remove(this,a)})}}),r.extend({queue:function(a,b,c){var d;if(a)return b=(b||"fx")+"queue",d=V.get(a,b),c&&(!d||r.isArray(c)?d=V.access(a,b,r.makeArray(c)):d.push(c)),d||[]},dequeue:function(a,b){b=b||"fx";var c=r.queue(a,b),d=c.length,e=c.shift(),f=r._queueHooks(a,b),g=function(){r.dequeue(a,b)};"inprogress"===e&&(e=c.shift(),d--),e&&("fx"===b&&c.unshift("inprogress"),delete f.stop,e.call(a,g,f)),!d&&f&&f.empty.fire()},_queueHooks:function(a,b){var c=b+"queueHooks";return V.get(a,c)||V.access(a,c,{empty:r.Callbacks("once memory").add(function(){V.remove(a,[b+"queue",c])})})}}),r.fn.extend({queue:function(a,b){var c=2;return"string"!=typeof a&&(b=a,a="fx",c--),arguments.length<c?r.queue(this[0],a):void 0===b?this:this.each(function(){var c=r.queue(this,a,b);r._queueHooks(this,a),"fx"===a&&"inprogress"!==c[0]&&r.dequeue(this,a)})},dequeue:function(a){return this.each(function(){r.dequeue(this,a)})},clearQueue:function(a){return this.queue(a||"fx",[])},promise:function(a,b){var c,d=1,e=r.Deferred(),f=this,g=this.length,h=function(){--d||e.resolveWith(f,[f])};"string"!=typeof a&&(b=a,a=void 0),a=a||"fx";while(g--)c=V.get(f[g],a+"queueHooks"),c&&c.empty&&(d++,c.empty.add(h));return h(),e.promise(b)}});var _=/[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,aa=new RegExp("^(?:([+-])=|)("+_+")([a-z%]*)$","i"),ba=["Top","Right","Bottom","Left"],ca=function(a,b){return a=b||a,"none"===a.style.display||""===a.style.display&&r.contains(a.ownerDocument,a)&&"none"===r.css(a,"display")},da=function(a,b,c,d){var e,f,g={};for(f in b)g[f]=a.style[f],a.style[f]=b[f];e=c.apply(a,d||[]);for(f in b)a.style[f]=g[f];return e};function ea(a,b,c,d){var e,f=1,g=20,h=d?function(){return d.cur()}:function(){return r.css(a,b,"")},i=h(),j=c&&c[3]||(r.cssNumber[b]?"":"px"),k=(r.cssNumber[b]||"px"!==j&&+i)&&aa.exec(r.css(a,b));if(k&&k[3]!==j){j=j||k[3],c=c||[],k=+i||1;do f=f||".5",k/=f,r.style(a,b,k+j);while(f!==(f=h()/i)&&1!==f&&--g)}return c&&(k=+k||+i||0,e=c[1]?k+(c[1]+1)*c[2]:+c[2],d&&(d.unit=j,d.start=k,d.end=e)),e}var fa={};function ga(a){var b,c=a.ownerDocument,d=a.nodeName,e=fa[d];return e?e:(b=c.body.appendChild(c.createElement(d)),e=r.css(b,"display"),b.parentNode.removeChild(b),"none"===e&&(e="block"),fa[d]=e,e)}function ha(a,b){for(var c,d,e=[],f=0,g=a.length;f<g;f++)d=a[f],d.style&&(c=d.style.display,b?("none"===c&&(e[f]=V.get(d,"display")||null,e[f]||(d.style.display="")),""===d.style.display&&ca(d)&&(e[f]=ga(d))):"none"!==c&&(e[f]="none",V.set(d,"display",c)));for(f=0;f<g;f++)null!=e[f]&&(a[f].style.display=e[f]);return a}r.fn.extend({show:function(){return ha(this,!0)},hide:function(){return ha(this)},toggle:function(a){return"boolean"==typeof a?a?this.show():this.hide():this.each(function(){ca(this)?r(this).show():r(this).hide()})}});var ia=/^(?:checkbox|radio)$/i,ja=/<([a-z][^\/\0>\x20\t\r\n\f]+)/i,ka=/^$|\/(?:java|ecma)script/i,la={option:[1,"<select multiple='multiple'>","</select>"],thead:[1,"<table>","</table>"],col:[2,"<table><colgroup>","</colgroup></table>"],tr:[2,"<table><tbody>","</tbody></table>"],td:[3,"<table><tbody><tr>","</tr></tbody></table>"],_default:[0,"",""]};la.optgroup=la.option,la.tbody=la.tfoot=la.colgroup=la.caption=la.thead,la.th=la.td;function ma(a,b){var c;return c="undefined"!=typeof a.getElementsByTagName?a.getElementsByTagName(b||"*"):"undefined"!=typeof a.querySelectorAll?a.querySelectorAll(b||"*"):[],void 0===b||b&&r.nodeName(a,b)?r.merge([a],c):c}function na(a,b){for(var c=0,d=a.length;c<d;c++)V.set(a[c],"globalEval",!b||V.get(b[c],"globalEval"))}var oa=/<|&#?\w+;/;function pa(a,b,c,d,e){for(var f,g,h,i,j,k,l=b.createDocumentFragment(),m=[],n=0,o=a.length;n<o;n++)if(f=a[n],f||0===f)if("object"===r.type(f))r.merge(m,f.nodeType?[f]:f);else if(oa.test(f)){g=g||l.appendChild(b.createElement("div")),h=(ja.exec(f)||["",""])[1].toLowerCase(),i=la[h]||la._default,g.innerHTML=i[1]+r.htmlPrefilter(f)+i[2],k=i[0];while(k--)g=g.lastChild;r.merge(m,g.childNodes),g=l.firstChild,g.textContent=""}else m.push(b.createTextNode(f));l.textContent="",n=0;while(f=m[n++])if(d&&r.inArray(f,d)>-1)e&&e.push(f);else if(j=r.contains(f.ownerDocument,f),g=ma(l.appendChild(f),"script"),j&&na(g),c){k=0;while(f=g[k++])ka.test(f.type||"")&&c.push(f)}return l}!function(){var a=d.createDocumentFragment(),b=a.appendChild(d.createElement("div")),c=d.createElement("input");c.setAttribute("type","radio"),c.setAttribute("checked","checked"),c.setAttribute("name","t"),b.appendChild(c),o.checkClone=b.cloneNode(!0).cloneNode(!0).lastChild.checked,b.innerHTML="<textarea>x</textarea>",o.noCloneChecked=!!b.cloneNode(!0).lastChild.defaultValue}();var qa=d.documentElement,ra=/^key/,sa=/^(?:mouse|pointer|contextmenu|drag|drop)|click/,ta=/^([^.]*)(?:\.(.+)|)/;function ua(){return!0}function va(){return!1}function wa(){try{return d.activeElement}catch(a){}}function xa(a,b,c,d,e,f){var g,h;if("object"==typeof b){"string"!=typeof c&&(d=d||c,c=void 0);for(h in b)xa(a,h,c,d,b[h],f);return a}if(null==d&&null==e?(e=c,d=c=void 0):null==e&&("string"==typeof c?(e=d,d=void 0):(e=d,d=c,c=void 0)),e===!1)e=va;else if(!e)return a;return 1===f&&(g=e,e=function(a){return r().off(a),g.apply(this,arguments)},e.guid=g.guid||(g.guid=r.guid++)),a.each(function(){r.event.add(this,b,e,d,c)})}r.event={global:{},add:function(a,b,c,d,e){var f,g,h,i,j,k,l,m,n,o,p,q=V.get(a);if(q){c.handler&&(f=c,c=f.handler,e=f.selector),e&&r.find.matchesSelector(qa,e),c.guid||(c.guid=r.guid++),(i=q.events)||(i=q.events={}),(g=q.handle)||(g=q.handle=function(b){return"undefined"!=typeof r&&r.event.triggered!==b.type?r.event.dispatch.apply(a,arguments):void 0}),b=(b||"").match(K)||[""],j=b.length;while(j--)h=ta.exec(b[j])||[],n=p=h[1],o=(h[2]||"").split(".").sort(),n&&(l=r.event.special[n]||{},n=(e?l.delegateType:l.bindType)||n,l=r.event.special[n]||{},k=r.extend({type:n,origType:p,data:d,handler:c,guid:c.guid,selector:e,needsContext:e&&r.expr.match.needsContext.test(e),namespace:o.join(".")},f),(m=i[n])||(m=i[n]=[],m.delegateCount=0,l.setup&&l.setup.call(a,d,o,g)!==!1||a.addEventListener&&a.addEventListener(n,g)),l.add&&(l.add.call(a,k),k.handler.guid||(k.handler.guid=c.guid)),e?m.splice(m.delegateCount++,0,k):m.push(k),r.event.global[n]=!0)}},remove:function(a,b,c,d,e){var f,g,h,i,j,k,l,m,n,o,p,q=V.hasData(a)&&V.get(a);if(q&&(i=q.events)){b=(b||"").match(K)||[""],j=b.length;while(j--)if(h=ta.exec(b[j])||[],n=p=h[1],o=(h[2]||"").split(".").sort(),n){l=r.event.special[n]||{},n=(d?l.delegateType:l.bindType)||n,m=i[n]||[],h=h[2]&&new RegExp("(^|\\.)"+o.join("\\.(?:.*\\.|)")+"(\\.|$)"),g=f=m.length;while(f--)k=m[f],!e&&p!==k.origType||c&&c.guid!==k.guid||h&&!h.test(k.namespace)||d&&d!==k.selector&&("**"!==d||!k.selector)||(m.splice(f,1),k.selector&&m.delegateCount--,l.remove&&l.remove.call(a,k));g&&!m.length&&(l.teardown&&l.teardown.call(a,o,q.handle)!==!1||r.removeEvent(a,n,q.handle),delete i[n])}else for(n in i)r.event.remove(a,n+b[j],c,d,!0);r.isEmptyObject(i)&&V.remove(a,"handle events")}},dispatch:function(a){var b=r.event.fix(a),c,d,e,f,g,h,i=new Array(arguments.length),j=(V.get(this,"events")||{})[b.type]||[],k=r.event.special[b.type]||{};for(i[0]=b,c=1;c<arguments.length;c++)i[c]=arguments[c];if(b.delegateTarget=this,!k.preDispatch||k.preDispatch.call(this,b)!==!1){h=r.event.handlers.call(this,b,j),c=0;while((f=h[c++])&&!b.isPropagationStopped()){b.currentTarget=f.elem,d=0;while((g=f.handlers[d++])&&!b.isImmediatePropagationStopped())b.rnamespace&&!b.rnamespace.test(g.namespace)||(b.handleObj=g,b.data=g.data,e=((r.event.special[g.origType]||{}).handle||g.handler).apply(f.elem,i),void 0!==e&&(b.result=e)===!1&&(b.preventDefault(),b.stopPropagation()))}return k.postDispatch&&k.postDispatch.call(this,b),b.result}},handlers:function(a,b){var c,d,e,f,g,h=[],i=b.delegateCount,j=a.target;if(i&&j.nodeType&&!("click"===a.type&&a.button>=1))for(;j!==this;j=j.parentNode||this)if(1===j.nodeType&&("click"!==a.type||j.disabled!==!0)){for(f=[],g={},c=0;c<i;c++)d=b[c],e=d.selector+" ",void 0===g[e]&&(g[e]=d.needsContext?r(e,this).index(j)>-1:r.find(e,this,null,[j]).length),g[e]&&f.push(d);f.length&&h.push({elem:j,handlers:f})}return j=this,i<b.length&&h.push({elem:j,handlers:b.slice(i)}),h},addProp:function(a,b){Object.defineProperty(r.Event.prototype,a,{enumerable:!0,configurable:!0,get:r.isFunction(b)?function(){if(this.originalEvent)return b(this.originalEvent)}:function(){if(this.originalEvent)return this.originalEvent[a]},set:function(b){Object.defineProperty(this,a,{enumerable:!0,configurable:!0,writable:!0,value:b})}})},fix:function(a){return a[r.expando]?a:new r.Event(a)},special:{load:{noBubble:!0},focus:{trigger:function(){if(this!==wa()&&this.focus)return this.focus(),!1},delegateType:"focusin"},blur:{trigger:function(){if(this===wa()&&this.blur)return this.blur(),!1},delegateType:"focusout"},click:{trigger:function(){if("checkbox"===this.type&&this.click&&r.nodeName(this,"input"))return this.click(),!1},_default:function(a){return r.nodeName(a.target,"a")}},beforeunload:{postDispatch:function(a){void 0!==a.result&&a.originalEvent&&(a.originalEvent.returnValue=a.result)}}}},r.removeEvent=function(a,b,c){a.removeEventListener&&a.removeEventListener(b,c)},r.Event=function(a,b){return this instanceof r.Event?(a&&a.type?(this.originalEvent=a,this.type=a.type,this.isDefaultPrevented=a.defaultPrevented||void 0===a.defaultPrevented&&a.returnValue===!1?ua:va,this.target=a.target&&3===a.target.nodeType?a.target.parentNode:a.target,this.currentTarget=a.currentTarget,this.relatedTarget=a.relatedTarget):this.type=a,b&&r.extend(this,b),this.timeStamp=a&&a.timeStamp||r.now(),void(this[r.expando]=!0)):new r.Event(a,b)},r.Event.prototype={constructor:r.Event,isDefaultPrevented:va,isPropagationStopped:va,isImmediatePropagationStopped:va,isSimulated:!1,preventDefault:function(){var a=this.originalEvent;this.isDefaultPrevented=ua,a&&!this.isSimulated&&a.preventDefault()},stopPropagation:function(){var a=this.originalEvent;this.isPropagationStopped=ua,a&&!this.isSimulated&&a.stopPropagation()},stopImmediatePropagation:function(){var a=this.originalEvent;this.isImmediatePropagationStopped=ua,a&&!this.isSimulated&&a.stopImmediatePropagation(),this.stopPropagation()}},r.each({altKey:!0,bubbles:!0,cancelable:!0,changedTouches:!0,ctrlKey:!0,detail:!0,eventPhase:!0,metaKey:!0,pageX:!0,pageY:!0,shiftKey:!0,view:!0,"char":!0,charCode:!0,key:!0,keyCode:!0,button:!0,buttons:!0,clientX:!0,clientY:!0,offsetX:!0,offsetY:!0,pointerId:!0,pointerType:!0,screenX:!0,screenY:!0,targetTouches:!0,toElement:!0,touches:!0,which:function(a){var b=a.button;return null==a.which&&ra.test(a.type)?null!=a.charCode?a.charCode:a.keyCode:!a.which&&void 0!==b&&sa.test(a.type)?1&b?1:2&b?3:4&b?2:0:a.which}},r.event.addProp),r.each({mouseenter:"mouseover",mouseleave:"mouseout",pointerenter:"pointerover",pointerleave:"pointerout"},function(a,b){r.event.special[a]={delegateType:b,bindType:b,handle:function(a){var c,d=this,e=a.relatedTarget,f=a.handleObj;return e&&(e===d||r.contains(d,e))||(a.type=f.origType,c=f.handler.apply(this,arguments),a.type=b),c}}}),r.fn.extend({on:function(a,b,c,d){return xa(this,a,b,c,d)},one:function(a,b,c,d){return xa(this,a,b,c,d,1)},off:function(a,b,c){var d,e;if(a&&a.preventDefault&&a.handleObj)return d=a.handleObj,r(a.delegateTarget).off(d.namespace?d.origType+"."+d.namespace:d.origType,d.selector,d.handler),this;if("object"==typeof a){for(e in a)this.off(e,b,a[e]);return this}return b!==!1&&"function"!=typeof b||(c=b,b=void 0),c===!1&&(c=va),this.each(function(){r.event.remove(this,a,c,b)})}});var ya=/<(?!area|br|col|embed|hr|img|input|link|meta|param)(([a-z][^\/\0>\x20\t\r\n\f]*)[^>]*)\/>/gi,za=/<script|<style|<link/i,Aa=/checked\s*(?:[^=]|=\s*.checked.)/i,Ba=/^true\/(.*)/,Ca=/^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;function Da(a,b){return r.nodeName(a,"table")&&r.nodeName(11!==b.nodeType?b:b.firstChild,"tr")?a.getElementsByTagName("tbody")[0]||a:a}function Ea(a){return a.type=(null!==a.getAttribute("type"))+"/"+a.type,a}function Fa(a){var b=Ba.exec(a.type);return b?a.type=b[1]:a.removeAttribute("type"),a}function Ga(a,b){var c,d,e,f,g,h,i,j;if(1===b.nodeType){if(V.hasData(a)&&(f=V.access(a),g=V.set(b,f),j=f.events)){delete g.handle,g.events={};for(e in j)for(c=0,d=j[e].length;c<d;c++)r.event.add(b,e,j[e][c])}W.hasData(a)&&(h=W.access(a),i=r.extend({},h),W.set(b,i))}}function Ha(a,b){var c=b.nodeName.toLowerCase();"input"===c&&ia.test(a.type)?b.checked=a.checked:"input"!==c&&"textarea"!==c||(b.defaultValue=a.defaultValue)}function Ia(a,b,c,d){b=g.apply([],b);var e,f,h,i,j,k,l=0,m=a.length,n=m-1,q=b[0],s=r.isFunction(q);if(s||m>1&&"string"==typeof q&&!o.checkClone&&Aa.test(q))return a.each(function(e){var f=a.eq(e);s&&(b[0]=q.call(this,e,f.html())),Ia(f,b,c,d)});if(m&&(e=pa(b,a[0].ownerDocument,!1,a,d),f=e.firstChild,1===e.childNodes.length&&(e=f),f||d)){for(h=r.map(ma(e,"script"),Ea),i=h.length;l<m;l++)j=e,l!==n&&(j=r.clone(j,!0,!0),i&&r.merge(h,ma(j,"script"))),c.call(a[l],j,l);if(i)for(k=h[h.length-1].ownerDocument,r.map(h,Fa),l=0;l<i;l++)j=h[l],ka.test(j.type||"")&&!V.access(j,"globalEval")&&r.contains(k,j)&&(j.src?r._evalUrl&&r._evalUrl(j.src):p(j.textContent.replace(Ca,""),k))}return a}function Ja(a,b,c){for(var d,e=b?r.filter(b,a):a,f=0;null!=(d=e[f]);f++)c||1!==d.nodeType||r.cleanData(ma(d)),d.parentNode&&(c&&r.contains(d.ownerDocument,d)&&na(ma(d,"script")),d.parentNode.removeChild(d));return a}r.extend({htmlPrefilter:function(a){return a.replace(ya,"<$1></$2>")},clone:function(a,b,c){var d,e,f,g,h=a.cloneNode(!0),i=r.contains(a.ownerDocument,a);if(!(o.noCloneChecked||1!==a.nodeType&&11!==a.nodeType||r.isXMLDoc(a)))for(g=ma(h),f=ma(a),d=0,e=f.length;d<e;d++)Ha(f[d],g[d]);if(b)if(c)for(f=f||ma(a),g=g||ma(h),d=0,e=f.length;d<e;d++)Ga(f[d],g[d]);else Ga(a,h);return g=ma(h,"script"),g.length>0&&na(g,!i&&ma(a,"script")),h},cleanData:function(a){for(var b,c,d,e=r.event.special,f=0;void 0!==(c=a[f]);f++)if(T(c)){if(b=c[V.expando]){if(b.events)for(d in b.events)e[d]?r.event.remove(c,d):r.removeEvent(c,d,b.handle);c[V.expando]=void 0}c[W.expando]&&(c[W.expando]=void 0)}}}),r.fn.extend({detach:function(a){return Ja(this,a,!0)},remove:function(a){return Ja(this,a)},text:function(a){return S(this,function(a){return void 0===a?r.text(this):this.empty().each(function(){1!==this.nodeType&&11!==this.nodeType&&9!==this.nodeType||(this.textContent=a)})},null,a,arguments.length)},append:function(){return Ia(this,arguments,function(a){if(1===this.nodeType||11===this.nodeType||9===this.nodeType){var b=Da(this,a);b.appendChild(a)}})},prepend:function(){return Ia(this,arguments,function(a){if(1===this.nodeType||11===this.nodeType||9===this.nodeType){var b=Da(this,a);b.insertBefore(a,b.firstChild)}})},before:function(){return Ia(this,arguments,function(a){this.parentNode&&this.parentNode.insertBefore(a,this)})},after:function(){return Ia(this,arguments,function(a){this.parentNode&&this.parentNode.insertBefore(a,this.nextSibling)})},empty:function(){for(var a,b=0;null!=(a=this[b]);b++)1===a.nodeType&&(r.cleanData(ma(a,!1)),a.textContent="");return this},clone:function(a,b){return a=null!=a&&a,b=null==b?a:b,this.map(function(){return r.clone(this,a,b)})},html:function(a){return S(this,function(a){var b=this[0]||{},c=0,d=this.length;if(void 0===a&&1===b.nodeType)return b.innerHTML;if("string"==typeof a&&!za.test(a)&&!la[(ja.exec(a)||["",""])[1].toLowerCase()]){a=r.htmlPrefilter(a);try{for(;c<d;c++)b=this[c]||{},1===b.nodeType&&(r.cleanData(ma(b,!1)),b.innerHTML=a);b=0}catch(e){}}b&&this.empty().append(a)},null,a,arguments.length)},replaceWith:function(){var a=[];return Ia(this,arguments,function(b){var c=this.parentNode;r.inArray(this,a)<0&&(r.cleanData(ma(this)),c&&c.replaceChild(b,this))},a)}}),r.each({appendTo:"append",prependTo:"prepend",insertBefore:"before",insertAfter:"after",replaceAll:"replaceWith"},function(a,b){r.fn[a]=function(a){for(var c,d=[],e=r(a),f=e.length-1,g=0;g<=f;g++)c=g===f?this:this.clone(!0),r(e[g])[b](c),h.apply(d,c.get());return this.pushStack(d)}});var Ka=/^margin/,La=new RegExp("^("+_+")(?!px)[a-z%]+$","i"),Ma=function(b){var c=b.ownerDocument.defaultView;return c&&c.opener||(c=a),c.getComputedStyle(b)};!function(){function b(){if(i){i.style.cssText="box-sizing:border-box;position:relative;display:block;margin:auto;border:1px;padding:1px;top:1%;width:50%",i.innerHTML="",qa.appendChild(h);var b=a.getComputedStyle(i);c="1%"!==b.top,g="2px"===b.marginLeft,e="4px"===b.width,i.style.marginRight="50%",f="4px"===b.marginRight,qa.removeChild(h),i=null}}var c,e,f,g,h=d.createElement("div"),i=d.createElement("div");i.style&&(i.style.backgroundClip="content-box",i.cloneNode(!0).style.backgroundClip="",o.clearCloneStyle="content-box"===i.style.backgroundClip,h.style.cssText="border:0;width:8px;height:0;top:0;left:-9999px;padding:0;margin-top:1px;position:absolute",h.appendChild(i),r.extend(o,{pixelPosition:function(){return b(),c},boxSizingReliable:function(){return b(),e},pixelMarginRight:function(){return b(),f},reliableMarginLeft:function(){return b(),g}}))}();function Na(a,b,c){var d,e,f,g,h=a.style;return c=c||Ma(a),c&&(g=c.getPropertyValue(b)||c[b],""!==g||r.contains(a.ownerDocument,a)||(g=r.style(a,b)),!o.pixelMarginRight()&&La.test(g)&&Ka.test(b)&&(d=h.width,e=h.minWidth,f=h.maxWidth,h.minWidth=h.maxWidth=h.width=g,g=c.width,h.width=d,h.minWidth=e,h.maxWidth=f)),void 0!==g?g+"":g}function Oa(a,b){return{get:function(){return a()?void delete this.get:(this.get=b).apply(this,arguments)}}}var Pa=/^(none|table(?!-c[ea]).+)/,Qa={position:"absolute",visibility:"hidden",display:"block"},Ra={letterSpacing:"0",fontWeight:"400"},Sa=["Webkit","Moz","ms"],Ta=d.createElement("div").style;function Ua(a){if(a in Ta)return a;var b=a[0].toUpperCase()+a.slice(1),c=Sa.length;while(c--)if(a=Sa[c]+b,a in Ta)return a}function Va(a,b,c){var d=aa.exec(b);return d?Math.max(0,d[2]-(c||0))+(d[3]||"px"):b}function Wa(a,b,c,d,e){var f,g=0;for(f=c===(d?"border":"content")?4:"width"===b?1:0;f<4;f+=2)"margin"===c&&(g+=r.css(a,c+ba[f],!0,e)),d?("content"===c&&(g-=r.css(a,"padding"+ba[f],!0,e)),"margin"!==c&&(g-=r.css(a,"border"+ba[f]+"Width",!0,e))):(g+=r.css(a,"padding"+ba[f],!0,e),"padding"!==c&&(g+=r.css(a,"border"+ba[f]+"Width",!0,e)));return g}function Xa(a,b,c){var d,e=!0,f=Ma(a),g="border-box"===r.css(a,"boxSizing",!1,f);if(a.getClientRects().length&&(d=a.getBoundingClientRect()[b]),d<=0||null==d){if(d=Na(a,b,f),(d<0||null==d)&&(d=a.style[b]),La.test(d))return d;e=g&&(o.boxSizingReliable()||d===a.style[b]),d=parseFloat(d)||0}return d+Wa(a,b,c||(g?"border":"content"),e,f)+"px"}r.extend({cssHooks:{opacity:{get:function(a,b){if(b){var c=Na(a,"opacity");return""===c?"1":c}}}},cssNumber:{animationIterationCount:!0,columnCount:!0,fillOpacity:!0,flexGrow:!0,flexShrink:!0,fontWeight:!0,lineHeight:!0,opacity:!0,order:!0,orphans:!0,widows:!0,zIndex:!0,zoom:!0},cssProps:{"float":"cssFloat"},style:function(a,b,c,d){if(a&&3!==a.nodeType&&8!==a.nodeType&&a.style){var e,f,g,h=r.camelCase(b),i=a.style;return b=r.cssProps[h]||(r.cssProps[h]=Ua(h)||h),g=r.cssHooks[b]||r.cssHooks[h],void 0===c?g&&"get"in g&&void 0!==(e=g.get(a,!1,d))?e:i[b]:(f=typeof c,"string"===f&&(e=aa.exec(c))&&e[1]&&(c=ea(a,b,e),f="number"),null!=c&&c===c&&("number"===f&&(c+=e&&e[3]||(r.cssNumber[h]?"":"px")),o.clearCloneStyle||""!==c||0!==b.indexOf("background")||(i[b]="inherit"),g&&"set"in g&&void 0===(c=g.set(a,c,d))||(i[b]=c)),void 0)}},css:function(a,b,c,d){var e,f,g,h=r.camelCase(b);return b=r.cssProps[h]||(r.cssProps[h]=Ua(h)||h),g=r.cssHooks[b]||r.cssHooks[h],g&&"get"in g&&(e=g.get(a,!0,c)),void 0===e&&(e=Na(a,b,d)),"normal"===e&&b in Ra&&(e=Ra[b]),""===c||c?(f=parseFloat(e),c===!0||isFinite(f)?f||0:e):e}}),r.each(["height","width"],function(a,b){r.cssHooks[b]={get:function(a,c,d){if(c)return!Pa.test(r.css(a,"display"))||a.getClientRects().length&&a.getBoundingClientRect().width?Xa(a,b,d):da(a,Qa,function(){return Xa(a,b,d)})},set:function(a,c,d){var e,f=d&&Ma(a),g=d&&Wa(a,b,d,"border-box"===r.css(a,"boxSizing",!1,f),f);return g&&(e=aa.exec(c))&&"px"!==(e[3]||"px")&&(a.style[b]=c,c=r.css(a,b)),Va(a,c,g)}}}),r.cssHooks.marginLeft=Oa(o.reliableMarginLeft,function(a,b){if(b)return(parseFloat(Na(a,"marginLeft"))||a.getBoundingClientRect().left-da(a,{marginLeft:0},function(){return a.getBoundingClientRect().left}))+"px"}),r.each({margin:"",padding:"",border:"Width"},function(a,b){r.cssHooks[a+b]={expand:function(c){for(var d=0,e={},f="string"==typeof c?c.split(" "):[c];d<4;d++)e[a+ba[d]+b]=f[d]||f[d-2]||f[0];return e}},Ka.test(a)||(r.cssHooks[a+b].set=Va)}),r.fn.extend({css:function(a,b){return S(this,function(a,b,c){var d,e,f={},g=0;if(r.isArray(b)){for(d=Ma(a),e=b.length;g<e;g++)f[b[g]]=r.css(a,b[g],!1,d);return f}return void 0!==c?r.style(a,b,c):r.css(a,b)},a,b,arguments.length>1)}});function Ya(a,b,c,d,e){return new Ya.prototype.init(a,b,c,d,e)}r.Tween=Ya,Ya.prototype={constructor:Ya,init:function(a,b,c,d,e,f){this.elem=a,this.prop=c,this.easing=e||r.easing._default,this.options=b,this.start=this.now=this.cur(),this.end=d,this.unit=f||(r.cssNumber[c]?"":"px")},cur:function(){var a=Ya.propHooks[this.prop];return a&&a.get?a.get(this):Ya.propHooks._default.get(this)},run:function(a){var b,c=Ya.propHooks[this.prop];return this.options.duration?this.pos=b=r.easing[this.easing](a,this.options.duration*a,0,1,this.options.duration):this.pos=b=a,this.now=(this.end-this.start)*b+this.start,this.options.step&&this.options.step.call(this.elem,this.now,this),c&&c.set?c.set(this):Ya.propHooks._default.set(this),this}},Ya.prototype.init.prototype=Ya.prototype,Ya.propHooks={_default:{get:function(a){var b;return 1!==a.elem.nodeType||null!=a.elem[a.prop]&&null==a.elem.style[a.prop]?a.elem[a.prop]:(b=r.css(a.elem,a.prop,""),b&&"auto"!==b?b:0)},set:function(a){r.fx.step[a.prop]?r.fx.step[a.prop](a):1!==a.elem.nodeType||null==a.elem.style[r.cssProps[a.prop]]&&!r.cssHooks[a.prop]?a.elem[a.prop]=a.now:r.style(a.elem,a.prop,a.now+a.unit)}}},Ya.propHooks.scrollTop=Ya.propHooks.scrollLeft={set:function(a){a.elem.nodeType&&a.elem.parentNode&&(a.elem[a.prop]=a.now)}},r.easing={linear:function(a){return a},swing:function(a){return.5-Math.cos(a*Math.PI)/2},_default:"swing"},r.fx=Ya.prototype.init,r.fx.step={};var Za,$a,_a=/^(?:toggle|show|hide)$/,ab=/queueHooks$/;function bb(){$a&&(a.requestAnimationFrame(bb),r.fx.tick())}function cb(){return a.setTimeout(function(){Za=void 0}),Za=r.now()}function db(a,b){var c,d=0,e={height:a};for(b=b?1:0;d<4;d+=2-b)c=ba[d],e["margin"+c]=e["padding"+c]=a;return b&&(e.opacity=e.width=a),e}function eb(a,b,c){for(var d,e=(hb.tweeners[b]||[]).concat(hb.tweeners["*"]),f=0,g=e.length;f<g;f++)if(d=e[f].call(c,b,a))return d}function fb(a,b,c){var d,e,f,g,h,i,j,k,l="width"in b||"height"in b,m=this,n={},o=a.style,p=a.nodeType&&ca(a),q=V.get(a,"fxshow");c.queue||(g=r._queueHooks(a,"fx"),null==g.unqueued&&(g.unqueued=0,h=g.empty.fire,g.empty.fire=function(){g.unqueued||h()}),g.unqueued++,m.always(function(){m.always(function(){g.unqueued--,r.queue(a,"fx").length||g.empty.fire()})}));for(d in b)if(e=b[d],_a.test(e)){if(delete b[d],f=f||"toggle"===e,e===(p?"hide":"show")){if("show"!==e||!q||void 0===q[d])continue;p=!0}n[d]=q&&q[d]||r.style(a,d)}if(i=!r.isEmptyObject(b),i||!r.isEmptyObject(n)){l&&1===a.nodeType&&(c.overflow=[o.overflow,o.overflowX,o.overflowY],j=q&&q.display,null==j&&(j=V.get(a,"display")),k=r.css(a,"display"),"none"===k&&(j?k=j:(ha([a],!0),j=a.style.display||j,k=r.css(a,"display"),ha([a]))),("inline"===k||"inline-block"===k&&null!=j)&&"none"===r.css(a,"float")&&(i||(m.done(function(){o.display=j}),null==j&&(k=o.display,j="none"===k?"":k)),o.display="inline-block")),c.overflow&&(o.overflow="hidden",m.always(function(){o.overflow=c.overflow[0],o.overflowX=c.overflow[1],o.overflowY=c.overflow[2]})),i=!1;for(d in n)i||(q?"hidden"in q&&(p=q.hidden):q=V.access(a,"fxshow",{display:j}),f&&(q.hidden=!p),p&&ha([a],!0),m.done(function(){p||ha([a]),V.remove(a,"fxshow");for(d in n)r.style(a,d,n[d])})),i=eb(p?q[d]:0,d,m),d in q||(q[d]=i.start,p&&(i.end=i.start,i.start=0))}}function gb(a,b){var c,d,e,f,g;for(c in a)if(d=r.camelCase(c),e=b[d],f=a[c],r.isArray(f)&&(e=f[1],f=a[c]=f[0]),c!==d&&(a[d]=f,delete a[c]),g=r.cssHooks[d],g&&"expand"in g){f=g.expand(f),delete a[d];for(c in f)c in a||(a[c]=f[c],b[c]=e)}else b[d]=e}function hb(a,b,c){var d,e,f=0,g=hb.prefilters.length,h=r.Deferred().always(function(){delete i.elem}),i=function(){if(e)return!1;for(var b=Za||cb(),c=Math.max(0,j.startTime+j.duration-b),d=c/j.duration||0,f=1-d,g=0,i=j.tweens.length;g<i;g++)j.tweens[g].run(f);return h.notifyWith(a,[j,f,c]),f<1&&i?c:(h.resolveWith(a,[j]),!1)},j=h.promise({elem:a,props:r.extend({},b),opts:r.extend(!0,{specialEasing:{},easing:r.easing._default},c),originalProperties:b,originalOptions:c,startTime:Za||cb(),duration:c.duration,tweens:[],createTween:function(b,c){var d=r.Tween(a,j.opts,b,c,j.opts.specialEasing[b]||j.opts.easing);return j.tweens.push(d),d},stop:function(b){var c=0,d=b?j.tweens.length:0;if(e)return this;for(e=!0;c<d;c++)j.tweens[c].run(1);return b?(h.notifyWith(a,[j,1,0]),h.resolveWith(a,[j,b])):h.rejectWith(a,[j,b]),this}}),k=j.props;for(gb(k,j.opts.specialEasing);f<g;f++)if(d=hb.prefilters[f].call(j,a,k,j.opts))return r.isFunction(d.stop)&&(r._queueHooks(j.elem,j.opts.queue).stop=r.proxy(d.stop,d)),d;return r.map(k,eb,j),r.isFunction(j.opts.start)&&j.opts.start.call(a,j),r.fx.timer(r.extend(i,{elem:a,anim:j,queue:j.opts.queue})),j.progress(j.opts.progress).done(j.opts.done,j.opts.complete).fail(j.opts.fail).always(j.opts.always)}r.Animation=r.extend(hb,{tweeners:{"*":[function(a,b){var c=this.createTween(a,b);return ea(c.elem,a,aa.exec(b),c),c}]},tweener:function(a,b){r.isFunction(a)?(b=a,a=["*"]):a=a.match(K);for(var c,d=0,e=a.length;d<e;d++)c=a[d],hb.tweeners[c]=hb.tweeners[c]||[],hb.tweeners[c].unshift(b)},prefilters:[fb],prefilter:function(a,b){b?hb.prefilters.unshift(a):hb.prefilters.push(a)}}),r.speed=function(a,b,c){var e=a&&"object"==typeof a?r.extend({},a):{complete:c||!c&&b||r.isFunction(a)&&a,duration:a,easing:c&&b||b&&!r.isFunction(b)&&b};return r.fx.off||d.hidden?e.duration=0:"number"!=typeof e.duration&&(e.duration in r.fx.speeds?e.duration=r.fx.speeds[e.duration]:e.duration=r.fx.speeds._default),null!=e.queue&&e.queue!==!0||(e.queue="fx"),e.old=e.complete,e.complete=function(){r.isFunction(e.old)&&e.old.call(this),e.queue&&r.dequeue(this,e.queue)},e},r.fn.extend({fadeTo:function(a,b,c,d){return this.filter(ca).css("opacity",0).show().end().animate({opacity:b},a,c,d)},animate:function(a,b,c,d){var e=r.isEmptyObject(a),f=r.speed(b,c,d),g=function(){var b=hb(this,r.extend({},a),f);(e||V.get(this,"finish"))&&b.stop(!0)};return g.finish=g,e||f.queue===!1?this.each(g):this.queue(f.queue,g)},stop:function(a,b,c){var d=function(a){var b=a.stop;delete a.stop,b(c)};return"string"!=typeof a&&(c=b,b=a,a=void 0),b&&a!==!1&&this.queue(a||"fx",[]),this.each(function(){var b=!0,e=null!=a&&a+"queueHooks",f=r.timers,g=V.get(this);if(e)g[e]&&g[e].stop&&d(g[e]);else for(e in g)g[e]&&g[e].stop&&ab.test(e)&&d(g[e]);for(e=f.length;e--;)f[e].elem!==this||null!=a&&f[e].queue!==a||(f[e].anim.stop(c),b=!1,f.splice(e,1));!b&&c||r.dequeue(this,a)})},finish:function(a){return a!==!1&&(a=a||"fx"),this.each(function(){var b,c=V.get(this),d=c[a+"queue"],e=c[a+"queueHooks"],f=r.timers,g=d?d.length:0;for(c.finish=!0,r.queue(this,a,[]),e&&e.stop&&e.stop.call(this,!0),b=f.length;b--;)f[b].elem===this&&f[b].queue===a&&(f[b].anim.stop(!0),f.splice(b,1));for(b=0;b<g;b++)d[b]&&d[b].finish&&d[b].finish.call(this);delete c.finish})}}),r.each(["toggle","show","hide"],function(a,b){var c=r.fn[b];r.fn[b]=function(a,d,e){return null==a||"boolean"==typeof a?c.apply(this,arguments):this.animate(db(b,!0),a,d,e)}}),r.each({slideDown:db("show"),slideUp:db("hide"),slideToggle:db("toggle"),fadeIn:{opacity:"show"},fadeOut:{opacity:"hide"},fadeToggle:{opacity:"toggle"}},function(a,b){r.fn[a]=function(a,c,d){return this.animate(b,a,c,d)}}),r.timers=[],r.fx.tick=function(){var a,b=0,c=r.timers;for(Za=r.now();b<c.length;b++)a=c[b],a()||c[b]!==a||c.splice(b--,1);c.length||r.fx.stop(),Za=void 0},r.fx.timer=function(a){r.timers.push(a),a()?r.fx.start():r.timers.pop()},r.fx.interval=13,r.fx.start=function(){$a||($a=a.requestAnimationFrame?a.requestAnimationFrame(bb):a.setInterval(r.fx.tick,r.fx.interval))},r.fx.stop=function(){a.cancelAnimationFrame?a.cancelAnimationFrame($a):a.clearInterval($a),$a=null},r.fx.speeds={slow:600,fast:200,_default:400},r.fn.delay=function(b,c){return b=r.fx?r.fx.speeds[b]||b:b,c=c||"fx",this.queue(c,function(c,d){var e=a.setTimeout(c,b);d.stop=function(){a.clearTimeout(e)}})},function(){var a=d.createElement("input"),b=d.createElement("select"),c=b.appendChild(d.createElement("option"));a.type="checkbox",o.checkOn=""!==a.value,o.optSelected=c.selected,a=d.createElement("input"),a.value="t",a.type="radio",o.radioValue="t"===a.value}();var ib,jb=r.expr.attrHandle;r.fn.extend({attr:function(a,b){return S(this,r.attr,a,b,arguments.length>1)},removeAttr:function(a){return this.each(function(){r.removeAttr(this,a)})}}),r.extend({attr:function(a,b,c){var d,e,f=a.nodeType;if(3!==f&&8!==f&&2!==f)return"undefined"==typeof a.getAttribute?r.prop(a,b,c):(1===f&&r.isXMLDoc(a)||(e=r.attrHooks[b.toLowerCase()]||(r.expr.match.bool.test(b)?ib:void 0)),
void 0!==c?null===c?void r.removeAttr(a,b):e&&"set"in e&&void 0!==(d=e.set(a,c,b))?d:(a.setAttribute(b,c+""),c):e&&"get"in e&&null!==(d=e.get(a,b))?d:(d=r.find.attr(a,b),null==d?void 0:d))},attrHooks:{type:{set:function(a,b){if(!o.radioValue&&"radio"===b&&r.nodeName(a,"input")){var c=a.value;return a.setAttribute("type",b),c&&(a.value=c),b}}}},removeAttr:function(a,b){var c,d=0,e=b&&b.match(K);if(e&&1===a.nodeType)while(c=e[d++])a.removeAttribute(c)}}),ib={set:function(a,b,c){return b===!1?r.removeAttr(a,c):a.setAttribute(c,c),c}},r.each(r.expr.match.bool.source.match(/\w+/g),function(a,b){var c=jb[b]||r.find.attr;jb[b]=function(a,b,d){var e,f,g=b.toLowerCase();return d||(f=jb[g],jb[g]=e,e=null!=c(a,b,d)?g:null,jb[g]=f),e}});var kb=/^(?:input|select|textarea|button)$/i,lb=/^(?:a|area)$/i;r.fn.extend({prop:function(a,b){return S(this,r.prop,a,b,arguments.length>1)},removeProp:function(a){return this.each(function(){delete this[r.propFix[a]||a]})}}),r.extend({prop:function(a,b,c){var d,e,f=a.nodeType;if(3!==f&&8!==f&&2!==f)return 1===f&&r.isXMLDoc(a)||(b=r.propFix[b]||b,e=r.propHooks[b]),void 0!==c?e&&"set"in e&&void 0!==(d=e.set(a,c,b))?d:a[b]=c:e&&"get"in e&&null!==(d=e.get(a,b))?d:a[b]},propHooks:{tabIndex:{get:function(a){var b=r.find.attr(a,"tabindex");return b?parseInt(b,10):kb.test(a.nodeName)||lb.test(a.nodeName)&&a.href?0:-1}}},propFix:{"for":"htmlFor","class":"className"}}),o.optSelected||(r.propHooks.selected={get:function(a){var b=a.parentNode;return b&&b.parentNode&&b.parentNode.selectedIndex,null},set:function(a){var b=a.parentNode;b&&(b.selectedIndex,b.parentNode&&b.parentNode.selectedIndex)}}),r.each(["tabIndex","readOnly","maxLength","cellSpacing","cellPadding","rowSpan","colSpan","useMap","frameBorder","contentEditable"],function(){r.propFix[this.toLowerCase()]=this});function mb(a){var b=a.match(K)||[];return b.join(" ")}function nb(a){return a.getAttribute&&a.getAttribute("class")||""}r.fn.extend({addClass:function(a){var b,c,d,e,f,g,h,i=0;if(r.isFunction(a))return this.each(function(b){r(this).addClass(a.call(this,b,nb(this)))});if("string"==typeof a&&a){b=a.match(K)||[];while(c=this[i++])if(e=nb(c),d=1===c.nodeType&&" "+mb(e)+" "){g=0;while(f=b[g++])d.indexOf(" "+f+" ")<0&&(d+=f+" ");h=mb(d),e!==h&&c.setAttribute("class",h)}}return this},removeClass:function(a){var b,c,d,e,f,g,h,i=0;if(r.isFunction(a))return this.each(function(b){r(this).removeClass(a.call(this,b,nb(this)))});if(!arguments.length)return this.attr("class","");if("string"==typeof a&&a){b=a.match(K)||[];while(c=this[i++])if(e=nb(c),d=1===c.nodeType&&" "+mb(e)+" "){g=0;while(f=b[g++])while(d.indexOf(" "+f+" ")>-1)d=d.replace(" "+f+" "," ");h=mb(d),e!==h&&c.setAttribute("class",h)}}return this},toggleClass:function(a,b){var c=typeof a;return"boolean"==typeof b&&"string"===c?b?this.addClass(a):this.removeClass(a):r.isFunction(a)?this.each(function(c){r(this).toggleClass(a.call(this,c,nb(this),b),b)}):this.each(function(){var b,d,e,f;if("string"===c){d=0,e=r(this),f=a.match(K)||[];while(b=f[d++])e.hasClass(b)?e.removeClass(b):e.addClass(b)}else void 0!==a&&"boolean"!==c||(b=nb(this),b&&V.set(this,"__className__",b),this.setAttribute&&this.setAttribute("class",b||a===!1?"":V.get(this,"__className__")||""))})},hasClass:function(a){var b,c,d=0;b=" "+a+" ";while(c=this[d++])if(1===c.nodeType&&(" "+mb(nb(c))+" ").indexOf(b)>-1)return!0;return!1}});var ob=/\r/g;r.fn.extend({val:function(a){var b,c,d,e=this[0];{if(arguments.length)return d=r.isFunction(a),this.each(function(c){var e;1===this.nodeType&&(e=d?a.call(this,c,r(this).val()):a,null==e?e="":"number"==typeof e?e+="":r.isArray(e)&&(e=r.map(e,function(a){return null==a?"":a+""})),b=r.valHooks[this.type]||r.valHooks[this.nodeName.toLowerCase()],b&&"set"in b&&void 0!==b.set(this,e,"value")||(this.value=e))});if(e)return b=r.valHooks[e.type]||r.valHooks[e.nodeName.toLowerCase()],b&&"get"in b&&void 0!==(c=b.get(e,"value"))?c:(c=e.value,"string"==typeof c?c.replace(ob,""):null==c?"":c)}}}),r.extend({valHooks:{option:{get:function(a){var b=r.find.attr(a,"value");return null!=b?b:mb(r.text(a))}},select:{get:function(a){var b,c,d,e=a.options,f=a.selectedIndex,g="select-one"===a.type,h=g?null:[],i=g?f+1:e.length;for(d=f<0?i:g?f:0;d<i;d++)if(c=e[d],(c.selected||d===f)&&!c.disabled&&(!c.parentNode.disabled||!r.nodeName(c.parentNode,"optgroup"))){if(b=r(c).val(),g)return b;h.push(b)}return h},set:function(a,b){var c,d,e=a.options,f=r.makeArray(b),g=e.length;while(g--)d=e[g],(d.selected=r.inArray(r.valHooks.option.get(d),f)>-1)&&(c=!0);return c||(a.selectedIndex=-1),f}}}}),r.each(["radio","checkbox"],function(){r.valHooks[this]={set:function(a,b){if(r.isArray(b))return a.checked=r.inArray(r(a).val(),b)>-1}},o.checkOn||(r.valHooks[this].get=function(a){return null===a.getAttribute("value")?"on":a.value})});var pb=/^(?:focusinfocus|focusoutblur)$/;r.extend(r.event,{trigger:function(b,c,e,f){var g,h,i,j,k,m,n,o=[e||d],p=l.call(b,"type")?b.type:b,q=l.call(b,"namespace")?b.namespace.split("."):[];if(h=i=e=e||d,3!==e.nodeType&&8!==e.nodeType&&!pb.test(p+r.event.triggered)&&(p.indexOf(".")>-1&&(q=p.split("."),p=q.shift(),q.sort()),k=p.indexOf(":")<0&&"on"+p,b=b[r.expando]?b:new r.Event(p,"object"==typeof b&&b),b.isTrigger=f?2:3,b.namespace=q.join("."),b.rnamespace=b.namespace?new RegExp("(^|\\.)"+q.join("\\.(?:.*\\.|)")+"(\\.|$)"):null,b.result=void 0,b.target||(b.target=e),c=null==c?[b]:r.makeArray(c,[b]),n=r.event.special[p]||{},f||!n.trigger||n.trigger.apply(e,c)!==!1)){if(!f&&!n.noBubble&&!r.isWindow(e)){for(j=n.delegateType||p,pb.test(j+p)||(h=h.parentNode);h;h=h.parentNode)o.push(h),i=h;i===(e.ownerDocument||d)&&o.push(i.defaultView||i.parentWindow||a)}g=0;while((h=o[g++])&&!b.isPropagationStopped())b.type=g>1?j:n.bindType||p,m=(V.get(h,"events")||{})[b.type]&&V.get(h,"handle"),m&&m.apply(h,c),m=k&&h[k],m&&m.apply&&T(h)&&(b.result=m.apply(h,c),b.result===!1&&b.preventDefault());return b.type=p,f||b.isDefaultPrevented()||n._default&&n._default.apply(o.pop(),c)!==!1||!T(e)||k&&r.isFunction(e[p])&&!r.isWindow(e)&&(i=e[k],i&&(e[k]=null),r.event.triggered=p,e[p](),r.event.triggered=void 0,i&&(e[k]=i)),b.result}},simulate:function(a,b,c){var d=r.extend(new r.Event,c,{type:a,isSimulated:!0});r.event.trigger(d,null,b)}}),r.fn.extend({trigger:function(a,b){return this.each(function(){r.event.trigger(a,b,this)})},triggerHandler:function(a,b){var c=this[0];if(c)return r.event.trigger(a,b,c,!0)}}),r.each("blur focus focusin focusout resize scroll click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup contextmenu".split(" "),function(a,b){r.fn[b]=function(a,c){return arguments.length>0?this.on(b,null,a,c):this.trigger(b)}}),r.fn.extend({hover:function(a,b){return this.mouseenter(a).mouseleave(b||a)}}),o.focusin="onfocusin"in a,o.focusin||r.each({focus:"focusin",blur:"focusout"},function(a,b){var c=function(a){r.event.simulate(b,a.target,r.event.fix(a))};r.event.special[b]={setup:function(){var d=this.ownerDocument||this,e=V.access(d,b);e||d.addEventListener(a,c,!0),V.access(d,b,(e||0)+1)},teardown:function(){var d=this.ownerDocument||this,e=V.access(d,b)-1;e?V.access(d,b,e):(d.removeEventListener(a,c,!0),V.remove(d,b))}}});var qb=a.location,rb=r.now(),sb=/\?/;r.parseXML=function(b){var c;if(!b||"string"!=typeof b)return null;try{c=(new a.DOMParser).parseFromString(b,"text/xml")}catch(d){c=void 0}return c&&!c.getElementsByTagName("parsererror").length||r.error("Invalid XML: "+b),c};var tb=/\[\]$/,ub=/\r?\n/g,vb=/^(?:submit|button|image|reset|file)$/i,wb=/^(?:input|select|textarea|keygen)/i;function xb(a,b,c,d){var e;if(r.isArray(b))r.each(b,function(b,e){c||tb.test(a)?d(a,e):xb(a+"["+("object"==typeof e&&null!=e?b:"")+"]",e,c,d)});else if(c||"object"!==r.type(b))d(a,b);else for(e in b)xb(a+"["+e+"]",b[e],c,d)}r.param=function(a,b){var c,d=[],e=function(a,b){var c=r.isFunction(b)?b():b;d[d.length]=encodeURIComponent(a)+"="+encodeURIComponent(null==c?"":c)};if(r.isArray(a)||a.jquery&&!r.isPlainObject(a))r.each(a,function(){e(this.name,this.value)});else for(c in a)xb(c,a[c],b,e);return d.join("&")},r.fn.extend({serialize:function(){return r.param(this.serializeArray())},serializeArray:function(){return this.map(function(){var a=r.prop(this,"elements");return a?r.makeArray(a):this}).filter(function(){var a=this.type;return this.name&&!r(this).is(":disabled")&&wb.test(this.nodeName)&&!vb.test(a)&&(this.checked||!ia.test(a))}).map(function(a,b){var c=r(this).val();return null==c?null:r.isArray(c)?r.map(c,function(a){return{name:b.name,value:a.replace(ub,"\r\n")}}):{name:b.name,value:c.replace(ub,"\r\n")}}).get()}});var yb=/%20/g,zb=/#.*$/,Ab=/([?&])_=[^&]*/,Bb=/^(.*?):[ \t]*([^\r\n]*)$/gm,Cb=/^(?:about|app|app-storage|.+-extension|file|res|widget):$/,Db=/^(?:GET|HEAD)$/,Eb=/^\/\//,Fb={},Gb={},Hb="*/".concat("*"),Ib=d.createElement("a");Ib.href=qb.href;function Jb(a){return function(b,c){"string"!=typeof b&&(c=b,b="*");var d,e=0,f=b.toLowerCase().match(K)||[];if(r.isFunction(c))while(d=f[e++])"+"===d[0]?(d=d.slice(1)||"*",(a[d]=a[d]||[]).unshift(c)):(a[d]=a[d]||[]).push(c)}}function Kb(a,b,c,d){var e={},f=a===Gb;function g(h){var i;return e[h]=!0,r.each(a[h]||[],function(a,h){var j=h(b,c,d);return"string"!=typeof j||f||e[j]?f?!(i=j):void 0:(b.dataTypes.unshift(j),g(j),!1)}),i}return g(b.dataTypes[0])||!e["*"]&&g("*")}function Lb(a,b){var c,d,e=r.ajaxSettings.flatOptions||{};for(c in b)void 0!==b[c]&&((e[c]?a:d||(d={}))[c]=b[c]);return d&&r.extend(!0,a,d),a}function Mb(a,b,c){var d,e,f,g,h=a.contents,i=a.dataTypes;while("*"===i[0])i.shift(),void 0===d&&(d=a.mimeType||b.getResponseHeader("Content-Type"));if(d)for(e in h)if(h[e]&&h[e].test(d)){i.unshift(e);break}if(i[0]in c)f=i[0];else{for(e in c){if(!i[0]||a.converters[e+" "+i[0]]){f=e;break}g||(g=e)}f=f||g}if(f)return f!==i[0]&&i.unshift(f),c[f]}function Nb(a,b,c,d){var e,f,g,h,i,j={},k=a.dataTypes.slice();if(k[1])for(g in a.converters)j[g.toLowerCase()]=a.converters[g];f=k.shift();while(f)if(a.responseFields[f]&&(c[a.responseFields[f]]=b),!i&&d&&a.dataFilter&&(b=a.dataFilter(b,a.dataType)),i=f,f=k.shift())if("*"===f)f=i;else if("*"!==i&&i!==f){if(g=j[i+" "+f]||j["* "+f],!g)for(e in j)if(h=e.split(" "),h[1]===f&&(g=j[i+" "+h[0]]||j["* "+h[0]])){g===!0?g=j[e]:j[e]!==!0&&(f=h[0],k.unshift(h[1]));break}if(g!==!0)if(g&&a["throws"])b=g(b);else try{b=g(b)}catch(l){return{state:"parsererror",error:g?l:"No conversion from "+i+" to "+f}}}return{state:"success",data:b}}r.extend({active:0,lastModified:{},etag:{},ajaxSettings:{url:qb.href,type:"GET",isLocal:Cb.test(qb.protocol),global:!0,processData:!0,async:!0,contentType:"application/x-www-form-urlencoded; charset=UTF-8",accepts:{"*":Hb,text:"text/plain",html:"text/html",xml:"application/xml, text/xml",json:"application/json, text/javascript"},contents:{xml:/\bxml\b/,html:/\bhtml/,json:/\bjson\b/},responseFields:{xml:"responseXML",text:"responseText",json:"responseJSON"},converters:{"* text":String,"text html":!0,"text json":JSON.parse,"text xml":r.parseXML},flatOptions:{url:!0,context:!0}},ajaxSetup:function(a,b){return b?Lb(Lb(a,r.ajaxSettings),b):Lb(r.ajaxSettings,a)},ajaxPrefilter:Jb(Fb),ajaxTransport:Jb(Gb),ajax:function(b,c){"object"==typeof b&&(c=b,b=void 0),c=c||{};var e,f,g,h,i,j,k,l,m,n,o=r.ajaxSetup({},c),p=o.context||o,q=o.context&&(p.nodeType||p.jquery)?r(p):r.event,s=r.Deferred(),t=r.Callbacks("once memory"),u=o.statusCode||{},v={},w={},x="canceled",y={readyState:0,getResponseHeader:function(a){var b;if(k){if(!h){h={};while(b=Bb.exec(g))h[b[1].toLowerCase()]=b[2]}b=h[a.toLowerCase()]}return null==b?null:b},getAllResponseHeaders:function(){return k?g:null},setRequestHeader:function(a,b){return null==k&&(a=w[a.toLowerCase()]=w[a.toLowerCase()]||a,v[a]=b),this},overrideMimeType:function(a){return null==k&&(o.mimeType=a),this},statusCode:function(a){var b;if(a)if(k)y.always(a[y.status]);else for(b in a)u[b]=[u[b],a[b]];return this},abort:function(a){var b=a||x;return e&&e.abort(b),A(0,b),this}};if(s.promise(y),o.url=((b||o.url||qb.href)+"").replace(Eb,qb.protocol+"//"),o.type=c.method||c.type||o.method||o.type,o.dataTypes=(o.dataType||"*").toLowerCase().match(K)||[""],null==o.crossDomain){j=d.createElement("a");try{j.href=o.url,j.href=j.href,o.crossDomain=Ib.protocol+"//"+Ib.host!=j.protocol+"//"+j.host}catch(z){o.crossDomain=!0}}if(o.data&&o.processData&&"string"!=typeof o.data&&(o.data=r.param(o.data,o.traditional)),Kb(Fb,o,c,y),k)return y;l=r.event&&o.global,l&&0===r.active++&&r.event.trigger("ajaxStart"),o.type=o.type.toUpperCase(),o.hasContent=!Db.test(o.type),f=o.url.replace(zb,""),o.hasContent?o.data&&o.processData&&0===(o.contentType||"").indexOf("application/x-www-form-urlencoded")&&(o.data=o.data.replace(yb,"+")):(n=o.url.slice(f.length),o.data&&(f+=(sb.test(f)?"&":"?")+o.data,delete o.data),o.cache===!1&&(f=f.replace(Ab,"$1"),n=(sb.test(f)?"&":"?")+"_="+rb++ +n),o.url=f+n),o.ifModified&&(r.lastModified[f]&&y.setRequestHeader("If-Modified-Since",r.lastModified[f]),r.etag[f]&&y.setRequestHeader("If-None-Match",r.etag[f])),(o.data&&o.hasContent&&o.contentType!==!1||c.contentType)&&y.setRequestHeader("Content-Type",o.contentType),y.setRequestHeader("Accept",o.dataTypes[0]&&o.accepts[o.dataTypes[0]]?o.accepts[o.dataTypes[0]]+("*"!==o.dataTypes[0]?", "+Hb+"; q=0.01":""):o.accepts["*"]);for(m in o.headers)y.setRequestHeader(m,o.headers[m]);if(o.beforeSend&&(o.beforeSend.call(p,y,o)===!1||k))return y.abort();if(x="abort",t.add(o.complete),y.done(o.success),y.fail(o.error),e=Kb(Gb,o,c,y)){if(y.readyState=1,l&&q.trigger("ajaxSend",[y,o]),k)return y;o.async&&o.timeout>0&&(i=a.setTimeout(function(){y.abort("timeout")},o.timeout));try{k=!1,e.send(v,A)}catch(z){if(k)throw z;A(-1,z)}}else A(-1,"No Transport");function A(b,c,d,h){var j,m,n,v,w,x=c;k||(k=!0,i&&a.clearTimeout(i),e=void 0,g=h||"",y.readyState=b>0?4:0,j=b>=200&&b<300||304===b,d&&(v=Mb(o,y,d)),v=Nb(o,v,y,j),j?(o.ifModified&&(w=y.getResponseHeader("Last-Modified"),w&&(r.lastModified[f]=w),w=y.getResponseHeader("etag"),w&&(r.etag[f]=w)),204===b||"HEAD"===o.type?x="nocontent":304===b?x="notmodified":(x=v.state,m=v.data,n=v.error,j=!n)):(n=x,!b&&x||(x="error",b<0&&(b=0))),y.status=b,y.statusText=(c||x)+"",j?s.resolveWith(p,[m,x,y]):s.rejectWith(p,[y,x,n]),y.statusCode(u),u=void 0,l&&q.trigger(j?"ajaxSuccess":"ajaxError",[y,o,j?m:n]),t.fireWith(p,[y,x]),l&&(q.trigger("ajaxComplete",[y,o]),--r.active||r.event.trigger("ajaxStop")))}return y},getJSON:function(a,b,c){return r.get(a,b,c,"json")},getScript:function(a,b){return r.get(a,void 0,b,"script")}}),r.each(["get","post"],function(a,b){r[b]=function(a,c,d,e){return r.isFunction(c)&&(e=e||d,d=c,c=void 0),r.ajax(r.extend({url:a,type:b,dataType:e,data:c,success:d},r.isPlainObject(a)&&a))}}),r._evalUrl=function(a){return r.ajax({url:a,type:"GET",dataType:"script",cache:!0,async:!1,global:!1,"throws":!0})},r.fn.extend({wrapAll:function(a){var b;return this[0]&&(r.isFunction(a)&&(a=a.call(this[0])),b=r(a,this[0].ownerDocument).eq(0).clone(!0),this[0].parentNode&&b.insertBefore(this[0]),b.map(function(){var a=this;while(a.firstElementChild)a=a.firstElementChild;return a}).append(this)),this},wrapInner:function(a){return r.isFunction(a)?this.each(function(b){r(this).wrapInner(a.call(this,b))}):this.each(function(){var b=r(this),c=b.contents();c.length?c.wrapAll(a):b.append(a)})},wrap:function(a){var b=r.isFunction(a);return this.each(function(c){r(this).wrapAll(b?a.call(this,c):a)})},unwrap:function(a){return this.parent(a).not("body").each(function(){r(this).replaceWith(this.childNodes)}),this}}),r.expr.pseudos.hidden=function(a){return!r.expr.pseudos.visible(a)},r.expr.pseudos.visible=function(a){return!!(a.offsetWidth||a.offsetHeight||a.getClientRects().length)},r.ajaxSettings.xhr=function(){try{return new a.XMLHttpRequest}catch(b){}};var Ob={0:200,1223:204},Pb=r.ajaxSettings.xhr();o.cors=!!Pb&&"withCredentials"in Pb,o.ajax=Pb=!!Pb,r.ajaxTransport(function(b){var c,d;if(o.cors||Pb&&!b.crossDomain)return{send:function(e,f){var g,h=b.xhr();if(h.open(b.type,b.url,b.async,b.username,b.password),b.xhrFields)for(g in b.xhrFields)h[g]=b.xhrFields[g];b.mimeType&&h.overrideMimeType&&h.overrideMimeType(b.mimeType),b.crossDomain||e["X-Requested-With"]||(e["X-Requested-With"]="XMLHttpRequest");for(g in e)h.setRequestHeader(g,e[g]);c=function(a){return function(){c&&(c=d=h.onload=h.onerror=h.onabort=h.onreadystatechange=null,"abort"===a?h.abort():"error"===a?"number"!=typeof h.status?f(0,"error"):f(h.status,h.statusText):f(Ob[h.status]||h.status,h.statusText,"text"!==(h.responseType||"text")||"string"!=typeof h.responseText?{binary:h.response}:{text:h.responseText},h.getAllResponseHeaders()))}},h.onload=c(),d=h.onerror=c("error"),void 0!==h.onabort?h.onabort=d:h.onreadystatechange=function(){4===h.readyState&&a.setTimeout(function(){c&&d()})},c=c("abort");try{h.send(b.hasContent&&b.data||null)}catch(i){if(c)throw i}},abort:function(){c&&c()}}}),r.ajaxPrefilter(function(a){a.crossDomain&&(a.contents.script=!1)}),r.ajaxSetup({accepts:{script:"text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"},contents:{script:/\b(?:java|ecma)script\b/},converters:{"text script":function(a){return r.globalEval(a),a}}}),r.ajaxPrefilter("script",function(a){void 0===a.cache&&(a.cache=!1),a.crossDomain&&(a.type="GET")}),r.ajaxTransport("script",function(a){if(a.crossDomain){var b,c;return{send:function(e,f){b=r("<script>").prop({charset:a.scriptCharset,src:a.url}).on("load error",c=function(a){b.remove(),c=null,a&&f("error"===a.type?404:200,a.type)}),d.head.appendChild(b[0])},abort:function(){c&&c()}}}});var Qb=[],Rb=/(=)\?(?=&|$)|\?\?/;r.ajaxSetup({jsonp:"callback",jsonpCallback:function(){var a=Qb.pop()||r.expando+"_"+rb++;return this[a]=!0,a}}),r.ajaxPrefilter("json jsonp",function(b,c,d){var e,f,g,h=b.jsonp!==!1&&(Rb.test(b.url)?"url":"string"==typeof b.data&&0===(b.contentType||"").indexOf("application/x-www-form-urlencoded")&&Rb.test(b.data)&&"data");if(h||"jsonp"===b.dataTypes[0])return e=b.jsonpCallback=r.isFunction(b.jsonpCallback)?b.jsonpCallback():b.jsonpCallback,h?b[h]=b[h].replace(Rb,"$1"+e):b.jsonp!==!1&&(b.url+=(sb.test(b.url)?"&":"?")+b.jsonp+"="+e),b.converters["script json"]=function(){return g||r.error(e+" was not called"),g[0]},b.dataTypes[0]="json",f=a[e],a[e]=function(){g=arguments},d.always(function(){void 0===f?r(a).removeProp(e):a[e]=f,b[e]&&(b.jsonpCallback=c.jsonpCallback,Qb.push(e)),g&&r.isFunction(f)&&f(g[0]),g=f=void 0}),"script"}),o.createHTMLDocument=function(){var a=d.implementation.createHTMLDocument("").body;return a.innerHTML="<form></form><form></form>",2===a.childNodes.length}(),r.parseHTML=function(a,b,c){if("string"!=typeof a)return[];"boolean"==typeof b&&(c=b,b=!1);var e,f,g;return b||(o.createHTMLDocument?(b=d.implementation.createHTMLDocument(""),e=b.createElement("base"),e.href=d.location.href,b.head.appendChild(e)):b=d),f=B.exec(a),g=!c&&[],f?[b.createElement(f[1])]:(f=pa([a],b,g),g&&g.length&&r(g).remove(),r.merge([],f.childNodes))},r.fn.load=function(a,b,c){var d,e,f,g=this,h=a.indexOf(" ");return h>-1&&(d=mb(a.slice(h)),a=a.slice(0,h)),r.isFunction(b)?(c=b,b=void 0):b&&"object"==typeof b&&(e="POST"),g.length>0&&r.ajax({url:a,type:e||"GET",dataType:"html",data:b}).done(function(a){f=arguments,g.html(d?r("<div>").append(r.parseHTML(a)).find(d):a)}).always(c&&function(a,b){g.each(function(){c.apply(this,f||[a.responseText,b,a])})}),this},r.each(["ajaxStart","ajaxStop","ajaxComplete","ajaxError","ajaxSuccess","ajaxSend"],function(a,b){r.fn[b]=function(a){return this.on(b,a)}}),r.expr.pseudos.animated=function(a){return r.grep(r.timers,function(b){return a===b.elem}).length};function Sb(a){return r.isWindow(a)?a:9===a.nodeType&&a.defaultView}r.offset={setOffset:function(a,b,c){var d,e,f,g,h,i,j,k=r.css(a,"position"),l=r(a),m={};"static"===k&&(a.style.position="relative"),h=l.offset(),f=r.css(a,"top"),i=r.css(a,"left"),j=("absolute"===k||"fixed"===k)&&(f+i).indexOf("auto")>-1,j?(d=l.position(),g=d.top,e=d.left):(g=parseFloat(f)||0,e=parseFloat(i)||0),r.isFunction(b)&&(b=b.call(a,c,r.extend({},h))),null!=b.top&&(m.top=b.top-h.top+g),null!=b.left&&(m.left=b.left-h.left+e),"using"in b?b.using.call(a,m):l.css(m)}},r.fn.extend({offset:function(a){if(arguments.length)return void 0===a?this:this.each(function(b){r.offset.setOffset(this,a,b)});var b,c,d,e,f=this[0];if(f)return f.getClientRects().length?(d=f.getBoundingClientRect(),d.width||d.height?(e=f.ownerDocument,c=Sb(e),b=e.documentElement,{top:d.top+c.pageYOffset-b.clientTop,left:d.left+c.pageXOffset-b.clientLeft}):d):{top:0,left:0}},position:function(){if(this[0]){var a,b,c=this[0],d={top:0,left:0};return"fixed"===r.css(c,"position")?b=c.getBoundingClientRect():(a=this.offsetParent(),b=this.offset(),r.nodeName(a[0],"html")||(d=a.offset()),d={top:d.top+r.css(a[0],"borderTopWidth",!0),left:d.left+r.css(a[0],"borderLeftWidth",!0)}),{top:b.top-d.top-r.css(c,"marginTop",!0),left:b.left-d.left-r.css(c,"marginLeft",!0)}}},offsetParent:function(){return this.map(function(){var a=this.offsetParent;while(a&&"static"===r.css(a,"position"))a=a.offsetParent;return a||qa})}}),r.each({scrollLeft:"pageXOffset",scrollTop:"pageYOffset"},function(a,b){var c="pageYOffset"===b;r.fn[a]=function(d){return S(this,function(a,d,e){var f=Sb(a);return void 0===e?f?f[b]:a[d]:void(f?f.scrollTo(c?f.pageXOffset:e,c?e:f.pageYOffset):a[d]=e)},a,d,arguments.length)}}),r.each(["top","left"],function(a,b){r.cssHooks[b]=Oa(o.pixelPosition,function(a,c){if(c)return c=Na(a,b),La.test(c)?r(a).position()[b]+"px":c})}),r.each({Height:"height",Width:"width"},function(a,b){r.each({padding:"inner"+a,content:b,"":"outer"+a},function(c,d){r.fn[d]=function(e,f){var g=arguments.length&&(c||"boolean"!=typeof e),h=c||(e===!0||f===!0?"margin":"border");return S(this,function(b,c,e){var f;return r.isWindow(b)?0===d.indexOf("outer")?b["inner"+a]:b.document.documentElement["client"+a]:9===b.nodeType?(f=b.documentElement,Math.max(b.body["scroll"+a],f["scroll"+a],b.body["offset"+a],f["offset"+a],f["client"+a])):void 0===e?r.css(b,c,h):r.style(b,c,e,h)},b,g?e:void 0,g)}})}),r.fn.extend({bind:function(a,b,c){return this.on(a,null,b,c)},unbind:function(a,b){return this.off(a,null,b)},delegate:function(a,b,c,d){return this.on(b,a,c,d)},undelegate:function(a,b,c){return 1===arguments.length?this.off(a,"**"):this.off(b,a||"**",c)}}),r.parseJSON=JSON.parse,"function"==typeof define&&define.amd&&define("jquery",[],function(){return r});var Tb=a.jQuery,Ub=a.$;return r.noConflict=function(b){return a.$===r&&(a.$=Ub),b&&a.jQuery===r&&(a.jQuery=Tb),r},b||(a.jQuery=a.$=r),r});

!function(t,e){if("object"==typeof exports&&"object"==typeof module)module.exports=e(require("jquery"));else if("function"==typeof define&&define.amd)define(["jquery"],e);else{var n,i="object"==typeof exports?e(require("jquery")):e(t.jQuery);for(n in i)("object"==typeof exports?exports:t)[n]=i[n]}}(window,function(n){return i={"./js/entries/foundation.js":function(t,e,n){"use strict";n.r(e);var i=n("jquery"),i=n.n(i),o=n("./js/foundation.core.js");n.d(e,"Foundation",function(){return o.Foundation});var s=n("./js/foundation.core.utils.js");n.d(e,"CoreUtils",function(){return s});var r=n("./js/foundation.util.box.js");n.d(e,"Box",function(){return r.Box});var a=n("./js/foundation.util.imageLoader.js");n.d(e,"onImagesLoaded",function(){return a.onImagesLoaded});var l=n("./js/foundation.util.keyboard.js");n.d(e,"Keyboard",function(){return l.Keyboard});var u=n("./js/foundation.util.mediaQuery.js");n.d(e,"MediaQuery",function(){return u.MediaQuery});var c=n("./js/foundation.util.motion.js");n.d(e,"Motion",function(){return c.Motion});var f=n("./js/foundation.util.nest.js");n.d(e,"Nest",function(){return f.Nest});var d=n("./js/foundation.util.timer.js");n.d(e,"Timer",function(){return d.Timer});var h=n("./js/foundation.util.touch.js");n.d(e,"Touch",function(){return h.Touch});var p=n("./js/foundation.util.triggers.js");n.d(e,"Triggers",function(){return p.Triggers});var m=n("./js/foundation.abide.js");n.d(e,"Abide",function(){return m.Abide});var v=n("./js/foundation.accordion.js");n.d(e,"Accordion",function(){return v.Accordion});var g=n("./js/foundation.accordionMenu.js");n.d(e,"AccordionMenu",function(){return g.AccordionMenu});var y=n("./js/foundation.drilldown.js");n.d(e,"Drilldown",function(){return y.Drilldown});var b=n("./js/foundation.dropdown.js");n.d(e,"Dropdown",function(){return b.Dropdown});var w=n("./js/foundation.dropdownMenu.js");n.d(e,"DropdownMenu",function(){return w.DropdownMenu});var _=n("./js/foundation.equalizer.js");n.d(e,"Equalizer",function(){return _.Equalizer});var $=n("./js/foundation.interchange.js");n.d(e,"Interchange",function(){return $.Interchange});var k=n("./js/foundation.magellan.js");n.d(e,"Magellan",function(){return k.Magellan});var j=n("./js/foundation.offcanvas.js");n.d(e,"OffCanvas",function(){return j.OffCanvas});var O=n("./js/foundation.orbit.js");n.d(e,"Orbit",function(){return O.Orbit});var C=n("./js/foundation.responsiveMenu.js");n.d(e,"ResponsiveMenu",function(){return C.ResponsiveMenu});var z=n("./js/foundation.responsiveToggle.js");n.d(e,"ResponsiveToggle",function(){return z.ResponsiveToggle});var T=n("./js/foundation.reveal.js");n.d(e,"Reveal",function(){return T.Reveal});var S=n("./js/foundation.slider.js");n.d(e,"Slider",function(){return S.Slider});var R=n("./js/foundation.smoothScroll.js");n.d(e,"SmoothScroll",function(){return R.SmoothScroll});var E=n("./js/foundation.sticky.js");n.d(e,"Sticky",function(){return E.Sticky});var x=n("./js/foundation.tabs.js");n.d(e,"Tabs",function(){return x.Tabs});var P=n("./js/foundation.toggler.js");n.d(e,"Toggler",function(){return P.Toggler});var A=n("./js/foundation.tooltip.js");n.d(e,"Tooltip",function(){return A.Tooltip});var L=n("./js/foundation.responsiveAccordionTabs.js");n.d(e,"ResponsiveAccordionTabs",function(){return L.ResponsiveAccordionTabs}),o.Foundation.addToJquery(i.a),o.Foundation.rtl=s.rtl,o.Foundation.GetYoDigits=s.GetYoDigits,o.Foundation.transitionend=s.transitionend,o.Foundation.RegExpEscape=s.RegExpEscape,o.Foundation.onLoad=s.onLoad,o.Foundation.Box=r.Box,o.Foundation.onImagesLoaded=a.onImagesLoaded,o.Foundation.Keyboard=l.Keyboard,o.Foundation.MediaQuery=u.MediaQuery,o.Foundation.Motion=c.Motion,o.Foundation.Move=c.Move,o.Foundation.Nest=f.Nest,o.Foundation.Timer=d.Timer,h.Touch.init(i.a),p.Triggers.init(i.a,o.Foundation),u.MediaQuery._init(),o.Foundation.plugin(m.Abide,"Abide"),o.Foundation.plugin(v.Accordion,"Accordion"),o.Foundation.plugin(g.AccordionMenu,"AccordionMenu"),o.Foundation.plugin(y.Drilldown,"Drilldown"),o.Foundation.plugin(b.Dropdown,"Dropdown"),o.Foundation.plugin(w.DropdownMenu,"DropdownMenu"),o.Foundation.plugin(_.Equalizer,"Equalizer"),o.Foundation.plugin($.Interchange,"Interchange"),o.Foundation.plugin(k.Magellan,"Magellan"),o.Foundation.plugin(j.OffCanvas,"OffCanvas"),o.Foundation.plugin(O.Orbit,"Orbit"),o.Foundation.plugin(C.ResponsiveMenu,"ResponsiveMenu"),o.Foundation.plugin(z.ResponsiveToggle,"ResponsiveToggle"),o.Foundation.plugin(T.Reveal,"Reveal"),o.Foundation.plugin(S.Slider,"Slider"),o.Foundation.plugin(R.SmoothScroll,"SmoothScroll"),o.Foundation.plugin(E.Sticky,"Sticky"),o.Foundation.plugin(x.Tabs,"Tabs"),o.Foundation.plugin(P.Toggler,"Toggler"),o.Foundation.plugin(A.Tooltip,"Tooltip"),o.Foundation.plugin(L.ResponsiveAccordionTabs,"ResponsiveAccordionTabs"),e.default=o.Foundation},"./js/foundation.abide.js":function(t,e,n){"use strict";n.r(e),n.d(e,"Abide",function(){return i});var e=n("jquery"),c=n.n(e),s=n("./js/foundation.core.plugin.js"),r=n("./js/foundation.core.utils.js");function o(t){return(o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function a(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}function l(t,e){return(l=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function u(n){var i=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],function(){})),!0}catch(t){return!1}}();return function(){var t,e=f(n);return function(t,e){{if(e&&("object"===o(e)||"function"==typeof e))return e;if(void 0!==e)throw new TypeError("Derived constructors may only return object or undefined")}return function(t){if(void 0!==t)return t;throw new ReferenceError("this hasn't been initialised - super() hasn't been called")}(t)}(this,i?(t=f(this).constructor,Reflect.construct(e,arguments,t)):e.apply(this,arguments))}}function f(t){return(f=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}var i=function(){!function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&l(t,e)}(o,s["Plugin"]);var t,e,n,i=u(o);function o(){return function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,o),i.apply(this,arguments)}return t=o,(e=[{key:"_setup",value:function(t){var e=1<arguments.length&&void 0!==arguments[1]?arguments[1]:{};this.$element=t,this.options=c.a.extend(!0,{},o.defaults,this.$element.data(),e),this.isEnabled=!0,this.formnovalidate=null,this.className="Abide",this._init()}},{key:"_init",value:function(){var n=this;this.$inputs=c.a.merge(this.$element.find("input").not('[type="submit"]'),this.$element.find("textarea, select")),this.$submits=this.$element.find('[type="submit"]');var t=this.$element.find("[data-abide-error]");this.options.a11yAttributes&&(this.$inputs.each(function(t,e){return n.addA11yAttributes(c()(e))}),t.each(function(t,e){return n.addGlobalErrorA11yAttributes(c()(e))})),this._events()}},{key:"_events",value:function(){var e=this;this.$element.off(".abide").on("reset.zf.abide",function(){e.resetForm()}).on("submit.zf.abide",function(){return e.validateForm()}),this.$submits.off("click.zf.abide keydown.zf.abide").on("click.zf.abide keydown.zf.abide",function(t){t.key&&" "!==t.key&&"Enter"!==t.key||(t.preventDefault(),e.formnovalidate=null!==t.target.getAttribute("formnovalidate"),e.$element.submit())}),"fieldChange"===this.options.validateOn&&this.$inputs.off("change.zf.abide").on("change.zf.abide",function(t){e.validateInput(c()(t.target))}),this.options.liveValidate&&this.$inputs.off("input.zf.abide").on("input.zf.abide",function(t){e.validateInput(c()(t.target))}),this.options.validateOnBlur&&this.$inputs.off("blur.zf.abide").on("blur.zf.abide",function(t){e.validateInput(c()(t.target))})}},{key:"_reflow",value:function(){this._init()}},{key:"_validationIsDisabled",value:function(){return!1===this.isEnabled||("boolean"==typeof this.formnovalidate?this.formnovalidate:!!this.$submits.length&&null!==this.$submits[0].getAttribute("formnovalidate"))}},{key:"enableValidation",value:function(){this.isEnabled=!0}},{key:"disableValidation",value:function(){this.isEnabled=!1}},{key:"requiredCheck",value:function(t){if(!t.attr("required"))return!0;var e=!0;switch(t[0].type){case"checkbox":e=t[0].checked;break;case"select":case"select-one":case"select-multiple":var n=t.find("option:selected");n.length&&n.val()||(e=!1);break;default:t.val()&&t.val().length||(e=!1)}return e}},{key:"findFormError",value:function(e,t){var n=this,i=e.length?e[0].id:"",o=e.siblings(this.options.formErrorSelector);return o.length||(o=e.parent().find(this.options.formErrorSelector)),i&&(o=o.add(this.$element.find('[data-form-error-for="'.concat(i,'"]')))),t&&(o=o.not("[data-form-error-on]"),t.forEach(function(t){o=(o=o.add(e.siblings('[data-form-error-on="'.concat(t,'"]')))).add(n.$element.find('[data-form-error-for="'.concat(i,'"][data-form-error-on="').concat(t,'"]')))})),o}},{key:"findLabel",value:function(t){var e=t[0].id,e=this.$element.find('label[for="'.concat(e,'"]'));return e.length?e:t.closest("label")}},{key:"findRadioLabels",value:function(t){var i=this,t=t.map(function(t,e){var n=e.id,n=i.$element.find('label[for="'.concat(n,'"]'));return(n=!n.length?c()(e).closest("label"):n)[0]});return c()(t)}},{key:"findCheckboxLabels",value:function(t){var i=this,t=t.map(function(t,e){var n=e.id,n=i.$element.find('label[for="'.concat(n,'"]'));return(n=!n.length?c()(e).closest("label"):n)[0]});return c()(t)}},{key:"addErrorClasses",value:function(t,e){var n=this.findLabel(t),e=this.findFormError(t,e);n.length&&n.addClass(this.options.labelErrorClass),e.length&&e.addClass(this.options.formErrorClass),t.addClass(this.options.inputErrorClass).attr({"data-invalid":"","aria-invalid":!0}),e.filter(":visible").length&&this.addA11yErrorDescribe(t,e)}},{key:"addA11yAttributes",value:function(t){var e,n,i=this.findFormError(t),o=i.filter("label");i.length&&((e=i.filter(":visible").first()).length&&this.addA11yErrorDescribe(t,e),o.filter("[for]").length<o.length&&(void 0===(n=t.attr("id"))&&(n=Object(r.GetYoDigits)(6,"abide-input"),t.attr("id",n)),o.each(function(t,e){e=c()(e);void 0===e.attr("for")&&e.attr("for",n)})),i.each(function(t,e){e=c()(e);void 0===e.attr("role")&&e.attr("role","alert")}).end())}},{key:"addA11yErrorDescribe",value:function(t,e){var n;void 0===t.attr("aria-describedby")&&(void 0===(n=e.attr("id"))&&(n=Object(r.GetYoDigits)(6,"abide-error"),e.attr("id",n)),t.attr("aria-describedby",n).data("abide-describedby",!0))}},{key:"addGlobalErrorA11yAttributes",value:function(t){void 0===t.attr("aria-live")&&t.attr("aria-live",this.options.a11yErrorLevel)}},{key:"removeRadioErrorClasses",value:function(t){var e=this.$element.find(':radio[name="'.concat(t,'"]')),n=this.findRadioLabels(e),t=this.findFormError(e);n.length&&n.removeClass(this.options.labelErrorClass),t.length&&t.removeClass(this.options.formErrorClass),e.removeClass(this.options.inputErrorClass).attr({"data-invalid":null,"aria-invalid":null})}},{key:"removeCheckboxErrorClasses",value:function(t){var e=this.$element.find(':checkbox[name="'.concat(t,'"]')),n=this.findCheckboxLabels(e),t=this.findFormError(e);n.length&&n.removeClass(this.options.labelErrorClass),t.length&&t.removeClass(this.options.formErrorClass),e.removeClass(this.options.inputErrorClass).attr({"data-invalid":null,"aria-invalid":null})}},{key:"removeErrorClasses",value:function(t){if("radio"===t[0].type)return this.removeRadioErrorClasses(t.attr("name"));if("checkbox"===t[0].type)return this.removeCheckboxErrorClasses(t.attr("name"));var e=this.findLabel(t),n=this.findFormError(t);e.length&&e.removeClass(this.options.labelErrorClass),n.length&&n.removeClass(this.options.formErrorClass),t.removeClass(this.options.inputErrorClass).attr({"data-invalid":null,"aria-invalid":null}),t.data("abide-describedby")&&t.removeAttr("aria-describedby").removeData("abide-describedby")}},{key:"validateInput",value:function(e){var n,i=this,t=this.requiredCheck(e),o=e.attr("data-validator"),s=[],r=!0;if(this._validationIsDisabled())return!0;if(e.is("[data-abide-ignore]")||e.is('[type="hidden"]')||e.is("[disabled]"))return!0;switch(e[0].type){case"radio":this.validateRadio(e.attr("name"))||s.push("required");break;case"checkbox":this.validateCheckbox(e.attr("name"))||s.push("required"),r=!1;break;case"select":case"select-one":case"select-multiple":t||s.push("required");break;default:t||s.push("required"),this.validateText(e)||s.push("pattern")}o&&(n=!!e.attr("required"),o.split(" ").forEach(function(t){i.options.validators[t](e,n,e.parent())||s.push(t)})),e.attr("data-equalto")&&(this.options.validators.equalTo(e)||s.push("equalTo"));var a,l=0===s.length,u=(l?"valid":"invalid")+".zf.abide";return!l||(o=this.$element.find('[data-equalto="'.concat(e.attr("id"),'"]'))).length&&(a=this,o.each(function(){c()(this).val()&&a.validateInput(c()(this))})),r&&(l?this.removeErrorClasses(e):this.addErrorClasses(e,s)),e.trigger(u,[e]),l}},{key:"validateForm",value:function(){var t,n=this,e=[],i=this;if(this.initialized||(this.initialized=!0),this._validationIsDisabled())return!(this.formnovalidate=null);this.$inputs.each(function(){if("checkbox"===c()(this)[0].type){if(c()(this).attr("name")===t)return!0;t=c()(this).attr("name")}e.push(i.validateInput(c()(this)))});var o=-1===e.indexOf(!1);return this.$element.find("[data-abide-error]").each(function(t,e){e=c()(e);n.options.a11yAttributes&&n.addGlobalErrorA11yAttributes(e),e.css("display",o?"none":"block")}),this.$element.trigger((o?"formvalid":"forminvalid")+".zf.abide",[this.$element]),o}},{key:"validateText",value:function(t,e){e=e||t.attr("data-pattern")||t.attr("pattern")||t.attr("type");var n=t.val(),i=!0;return n.length&&(this.options.patterns.hasOwnProperty(e)?i=this.options.patterns[e].test(n):e!==t.attr("type")&&(i=new RegExp(e).test(n))),i}},{key:"validateRadio",value:function(t){var t=this.$element.find(':radio[name="'.concat(t,'"]')),n=!1,i=!1;return t.each(function(t,e){c()(e).attr("required")&&(i=!0)}),(n=!i?!0:n)||t.each(function(t,e){c()(e).prop("checked")&&(n=!0)}),n}},{key:"validateCheckbox",value:function(t){var n=this,t=this.$element.find(':checkbox[name="'.concat(t,'"]')),i=!1,o=!1,s=1,r=0;return t.each(function(t,e){c()(e).attr("required")&&(o=!0)}),(i=!o?!0:i)||(t.each(function(t,e){c()(e).prop("checked")&&r++,void 0!==c()(e).attr("data-min-required")&&(s=parseInt(c()(e).attr("data-min-required"),10))}),s<=r&&(i=!0)),!0!==this.initialized&&1<s||(t.each(function(t,e){i?n.removeErrorClasses(c()(e)):n.addErrorClasses(c()(e),["required"])}),i)}},{key:"matchValidation",value:function(e,t,n){var i=this;return n=!!n,-1===t.split(" ").map(function(t){return i.options.validators[t](e,n,e.parent())}).indexOf(!1)}},{key:"resetForm",value:function(){var t=this.$element,e=this.options;c()(".".concat(e.labelErrorClass),t).not("small").removeClass(e.labelErrorClass),c()(".".concat(e.inputErrorClass),t).not("small").removeClass(e.inputErrorClass),c()("".concat(e.formErrorSelector,".").concat(e.formErrorClass)).removeClass(e.formErrorClass),t.find("[data-abide-error]").css("display","none"),c()(":input",t).not(":button, :submit, :reset, :hidden, :radio, :checkbox, [data-abide-ignore]").val("").attr({"data-invalid":null,"aria-invalid":null}),c()(":input:radio",t).not("[data-abide-ignore]").prop("checked",!1).attr({"data-invalid":null,"aria-invalid":null}),c()(":input:checkbox",t).not("[data-abide-ignore]").prop("checked",!1).attr({"data-invalid":null,"aria-invalid":null}),t.trigger("formreset.zf.abide",[t])}},{key:"_destroy",value:function(){var t=this;this.$element.off(".abide").find("[data-abide-error]").css("display","none"),this.$inputs.off(".abide").each(function(){t.removeErrorClasses(c()(this))}),this.$submits.off(".abide")}}])&&a(t.prototype,e),n&&a(t,n),o}();i.defaults={validateOn:"fieldChange",labelErrorClass:"is-invalid-label",inputErrorClass:"is-invalid-input",formErrorSelector:".form-error",formErrorClass:"is-visible",a11yAttributes:!0,a11yErrorLevel:"assertive",liveValidate:!1,validateOnBlur:!1,patterns:{alpha:/^[a-zA-Z]+$/,alpha_numeric:/^[a-zA-Z0-9]+$/,integer:/^[-+]?\d+$/,number:/^[-+]?\d*(?:[\.\,]\d+)?$/,card:/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|(?:222[1-9]|2[3-6][0-9]{2}|27[0-1][0-9]|2720)[0-9]{12}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$/,cvv:/^([0-9]){3,4}$/,email:/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)+$/,url:/^((?:(https?|ftps?|file|ssh|sftp):\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\((?:[^\s()<>]+|(?:\([^\s()<>]+\)))*\))+(?:\((?:[^\s()<>]+|(?:\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:\'".,<>?\xab\xbb\u201c\u201d\u2018\u2019]))$/,domain:/^([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,8}$/,datetime:/^([0-2][0-9]{3})\-([0-1][0-9])\-([0-3][0-9])T([0-5][0-9])\:([0-5][0-9])\:([0-5][0-9])(Z|([\-\+]([0-1][0-9])\:00))$/,date:/(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))$/,time:/^(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9]){2}$/,dateISO:/^\d{4}[\/\-]\d{1,2}[\/\-]\d{1,2}$/,month_day_year:/^(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.]\d{4}$/,day_month_year:/^(0[1-9]|[12][0-9]|3[01])[- \/.](0[1-9]|1[012])[- \/.]\d{4}$/,color:/^#?([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$/,website:{test:function(t){return i.defaults.patterns.domain.test(t)||i.defaults.patterns.url.test(t)}}},validators:{equalTo:function(t){return c()("#".concat(t.attr("data-equalto"))).val()===t.val()}}}},"./js/foundation.accordion.js":function(t,e,n){"use strict";n.r(e),n.d(e,"Accordion",function(){return i});var e=n("jquery"),s=n.n(e),r=n("./js/foundation.core.plugin.js"),a=n("./js/foundation.core.utils.js"),l=n("./js/foundation.util.keyboard.js");function o(t){return(o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function u(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}function c(t,e){return(c=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function f(n){var i=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],function(){})),!0}catch(t){return!1}}();return function(){var t,e=d(n);return function(t,e){{if(e&&("object"===o(e)||"function"==typeof e))return e;if(void 0!==e)throw new TypeError("Derived constructors may only return object or undefined")}return function(t){if(void 0!==t)return t;throw new ReferenceError("this hasn't been initialised - super() hasn't been called")}(t)}(this,i?(t=d(this).constructor,Reflect.construct(e,arguments,t)):e.apply(this,arguments))}}function d(t){return(d=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}var i=function(){!function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&c(t,e)}(o,r["Plugin"]);var t,e,n,i=f(o);function o(){return function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,o),i.apply(this,arguments)}return t=o,(e=[{key:"_setup",value:function(t,e){this.$element=t,this.options=s.a.extend({},o.defaults,this.$element.data(),e),this.className="Accordion",this._init(),l.Keyboard.register("Accordion",{ENTER:"toggle",SPACE:"toggle",ARROW_DOWN:"next",ARROW_UP:"previous",HOME:"first",END:"last"})}},{key:"_init",value:function(){var n=this;this._isInitializing=!0,this.$tabs=this.$element.children("[data-accordion-item]"),this.$tabs.each(function(t,e){var n=s()(e),i=n.children("[data-tab-content]"),o=i[0].id||Object(a.GetYoDigits)(6,"accordion"),e=e.id?"".concat(e.id,"-label"):"".concat(o,"-label");n.find("a:first").attr({"aria-controls":o,id:e,"aria-expanded":!1}),i.attr({role:"region","aria-labelledby":e,"aria-hidden":!0,id:o})});var t=this.$element.find(".is-active").children("[data-tab-content]");t.length&&(this._initialAnchor=t.prev("a").attr("href"),this._openSingleTab(t)),this._checkDeepLink=function(){var t=window.location.hash;if(!t.length){if(n._isInitializing)return;n._initialAnchor&&(t=n._initialAnchor)}var e=t&&s()(t),t=t&&n.$element.find('[href$="'.concat(t,'"]'));!e.length||!t.length||(e&&t&&t.length?t.parent("[data-accordion-item]").hasClass("is-active")||n._openSingleTab(e):n._closeAllTabs(),n.options.deepLinkSmudge&&Object(a.onLoad)(s()(window),function(){var t=n.$element.offset();s()("html, body").animate({scrollTop:t.top-n.options.deepLinkSmudgeOffset},n.options.deepLinkSmudgeDelay)}),n.$element.trigger("deeplink.zf.accordion",[t,e]))},this.options.deepLink&&this._checkDeepLink(),this._events(),this._isInitializing=!1}},{key:"_events",value:function(){var i=this;this.$tabs.each(function(){var e=s()(this),n=e.children("[data-tab-content]");n.length&&e.children("a").off("click.zf.accordion keydown.zf.accordion").on("click.zf.accordion",function(t){t.preventDefault(),i.toggle(n)}).on("keydown.zf.accordion",function(t){l.Keyboard.handleKey(t,"Accordion",{toggle:function(){i.toggle(n)},next:function(){var t=e.next().find("a").focus();i.options.multiExpand||t.trigger("click.zf.accordion")},previous:function(){var t=e.prev().find("a").focus();i.options.multiExpand||t.trigger("click.zf.accordion")},first:function(){var t=i.$tabs.first().find(".accordion-title").focus();i.options.multiExpand||t.trigger("click.zf.accordion")},last:function(){var t=i.$tabs.last().find(".accordion-title").focus();i.options.multiExpand||t.trigger("click.zf.accordion")},handled:function(){t.preventDefault()}})})}),this.options.deepLink&&s()(window).on("hashchange",this._checkDeepLink)}},{key:"toggle",value:function(t){t.closest("[data-accordion]").is("[disabled]")?console.info("Cannot toggle an accordion that is disabled."):(t.parent().hasClass("is-active")?this.up(t):this.down(t),this.options.deepLink&&(t=t.prev("a").attr("href"),this.options.updateHistory?history.pushState({},"",t):history.replaceState({},"",t)))}},{key:"down",value:function(t){t.closest("[data-accordion]").is("[disabled]")?console.info("Cannot call down on an accordion that is disabled."):this.options.multiExpand?this._openTab(t):this._openSingleTab(t)}},{key:"up",value:function(t){var e;this.$element.is("[disabled]")?console.info("Cannot call up on an accordion that is disabled."):(e=t.parent()).hasClass("is-active")&&(e=e.siblings(),(this.options.allowAllClosed||e.hasClass("is-active"))&&this._closeTab(t))}},{key:"_openSingleTab",value:function(t){var e=this.$element.children(".is-active").children("[data-tab-content]");e.length&&this._closeTab(e.not(t)),this._openTab(t)}},{key:"_openTab",value:function(t){var e=this,n=t.parent(),i=t.attr("aria-labelledby");t.attr("aria-hidden",!1),n.addClass("is-active"),s()("#".concat(i)).attr({"aria-expanded":!0}),t.finish().slideDown(this.options.slideSpeed,function(){e.$element.trigger("down.zf.accordion",[t])})}},{key:"_closeTab",value:function(t){var e=this,n=t.parent(),i=t.attr("aria-labelledby");t.attr("aria-hidden",!0),n.removeClass("is-active"),s()("#".concat(i)).attr({"aria-expanded":!1}),t.finish().slideUp(this.options.slideSpeed,function(){e.$element.trigger("up.zf.accordion",[t])})}},{key:"_closeAllTabs",value:function(){var t=this.$element.children(".is-active").children("[data-tab-content]");t.length&&this._closeTab(t)}},{key:"_destroy",value:function(){this.$element.find("[data-tab-content]").stop(!0).slideUp(0).css("display",""),this.$element.find("a").off(".zf.accordion"),this.options.deepLink&&s()(window).off("hashchange",this._checkDeepLink)}}])&&u(t.prototype,e),n&&u(t,n),o}();i.defaults={slideSpeed:250,multiExpand:!1,allowAllClosed:!1,deepLink:!1,deepLinkSmudge:!1,deepLinkSmudgeDelay:300,deepLinkSmudgeOffset:0,updateHistory:!1}},"./js/foundation.accordionMenu.js":function(t,e,n){"use strict";n.r(e),n.d(e,"AccordionMenu",function(){return i});var e=n("jquery"),a=n.n(e),l=n("./js/foundation.util.keyboard.js"),r=n("./js/foundation.util.nest.js"),u=n("./js/foundation.core.utils.js"),s=n("./js/foundation.core.plugin.js");function o(t){return(o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function c(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}function f(t,e){return(f=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function d(n){var i=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],function(){})),!0}catch(t){return!1}}();return function(){var t,e=h(n);return function(t,e){{if(e&&("object"===o(e)||"function"==typeof e))return e;if(void 0!==e)throw new TypeError("Derived constructors may only return object or undefined")}return function(t){if(void 0!==t)return t;throw new ReferenceError("this hasn't been initialised - super() hasn't been called")}(t)}(this,i?(t=h(this).constructor,Reflect.construct(e,arguments,t)):e.apply(this,arguments))}}function h(t){return(h=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}var i=function(){!function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&f(t,e)}(o,s["Plugin"]);var t,e,n,i=d(o);function o(){return function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,o),i.apply(this,arguments)}return t=o,(e=[{key:"_setup",value:function(t,e){this.$element=t,this.options=a.a.extend({},o.defaults,this.$element.data(),e),this.className="AccordionMenu",this._init(),l.Keyboard.register("AccordionMenu",{ENTER:"toggle",SPACE:"toggle",ARROW_RIGHT:"open",ARROW_UP:"up",ARROW_DOWN:"down",ARROW_LEFT:"close",ESCAPE:"closeAll"})}},{key:"_init",value:function(){r.Nest.Feather(this.$element,"accordion");var s=this;this.$element.find("[data-submenu]").not(".is-active").slideUp(0),this.$element.attr({"aria-multiselectable":this.options.multiOpen}),this.$menuLinks=this.$element.find(".is-accordion-submenu-parent"),this.$menuLinks.each(function(){var t=this.id||Object(u.GetYoDigits)(6,"acc-menu-link"),e=a()(this),n=e.children("[data-submenu]"),i=n[0].id||Object(u.GetYoDigits)(6,"acc-menu"),o=n.hasClass("is-active");s.options.parentLink&&e.children("a").clone().prependTo(n).wrap('<li data-is-parent-link class="is-submenu-parent-item is-submenu-item is-accordion-submenu-item"></li>'),s.options.submenuToggle?(e.addClass("has-submenu-toggle"),e.children("a").after('<button id="'+t+'" class="submenu-toggle" aria-controls="'+i+'" aria-expanded="'+o+'" title="'+s.options.submenuToggleText+'"><span class="submenu-toggle-text">'+s.options.submenuToggleText+"</span></button>")):e.attr({"aria-controls":i,"aria-expanded":o,id:t}),n.attr({"aria-labelledby":t,"aria-hidden":!o,role:"group",id:i})});var t=this.$element.find(".is-active");t.length&&t.each(function(){s.down(a()(this))}),this._events()}},{key:"_events",value:function(){var r=this;this.$element.find("li").each(function(){var e=a()(this).children("[data-submenu]");e.length&&(r.options.submenuToggle?a()(this).children(".submenu-toggle").off("click.zf.accordionMenu").on("click.zf.accordionMenu",function(){r.toggle(e)}):a()(this).children("a").off("click.zf.accordionMenu").on("click.zf.accordionMenu",function(t){t.preventDefault(),r.toggle(e)}))}).on("keydown.zf.accordionMenu",function(e){var n,i,o=a()(this),s=o.parent("ul").children("li"),t=o.children("[data-submenu]");s.each(function(t){a()(this).is(o)&&(n=s.eq(Math.max(0,t-1)).find("a").first(),i=s.eq(Math.min(t+1,s.length-1)).find("a").first(),a()(this).children("[data-submenu]:visible").length&&(i=o.find("li:first-child").find("a").first()),a()(this).is(":first-child")?n=o.parents("li").first().find("a").first():n.parents("li").first().children("[data-submenu]:visible").length&&(n=n.parents("li").find("li:last-child").find("a").first()),a()(this).is(":last-child")&&(i=o.parents("li").first().next("li").find("a").first()))}),l.Keyboard.handleKey(e,"AccordionMenu",{open:function(){t.is(":hidden")&&(r.down(t),t.find("li").first().find("a").first().focus())},close:function(){t.length&&!t.is(":hidden")?r.up(t):o.parent("[data-submenu]").length&&(r.up(o.parent("[data-submenu]")),o.parents("li").first().find("a").first().focus())},up:function(){return n.focus(),!0},down:function(){return i.focus(),!0},toggle:function(){return!r.options.submenuToggle&&(o.children("[data-submenu]").length?(r.toggle(o.children("[data-submenu]")),!0):void 0)},closeAll:function(){r.hideAll()},handled:function(t){t&&e.preventDefault()}})})}},{key:"hideAll",value:function(){this.up(this.$element.find("[data-submenu]"))}},{key:"showAll",value:function(){this.down(this.$element.find("[data-submenu]"))}},{key:"toggle",value:function(t){t.is(":animated")||(t.is(":hidden")?this.down(t):this.up(t))}},{key:"down",value:function(t){var e,n=this;this.options.multiOpen||(e=t.parentsUntil(this.$element).add(t).add(t.find(".is-active")),e=this.$element.find(".is-active").not(e),this.up(e)),t.addClass("is-active").attr({"aria-hidden":!1}),(this.options.submenuToggle?t.prev(".submenu-toggle"):t.parent(".is-accordion-submenu-parent")).attr({"aria-expanded":!0}),t.slideDown(this.options.slideSpeed,function(){n.$element.trigger("down.zf.accordionMenu",[t])})}},{key:"up",value:function(t){var e=this,n=t.find("[data-submenu]"),i=t.add(n);n.slideUp(0),i.removeClass("is-active").attr("aria-hidden",!0),(this.options.submenuToggle?i.prev(".submenu-toggle"):i.parent(".is-accordion-submenu-parent")).attr("aria-expanded",!1),t.slideUp(this.options.slideSpeed,function(){e.$element.trigger("up.zf.accordionMenu",[t])})}},{key:"_destroy",value:function(){this.$element.find("[data-submenu]").slideDown(0).css("display",""),this.$element.find("a").off("click.zf.accordionMenu"),this.$element.find("[data-is-parent-link]").detach(),this.options.submenuToggle&&(this.$element.find(".has-submenu-toggle").removeClass("has-submenu-toggle"),this.$element.find(".submenu-toggle").remove()),r.Nest.Burn(this.$element,"accordion")}}])&&c(t.prototype,e),n&&c(t,n),o}();i.defaults={parentLink:!1,slideSpeed:250,submenuToggle:!1,submenuToggleText:"Toggle menu",multiOpen:!0}},"./js/foundation.core.js":function(t,e,n){"use strict";n.r(e),n.d(e,"Foundation",function(){return l});var e=n("jquery"),s=n.n(e),i=n("./js/foundation.core.utils.js"),r=n("./js/foundation.util.mediaQuery.js");function a(t){return(a="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}var l={version:"6.7.5",_plugins:{},_uuids:[],plugin:function(t,e){var n=e||u(t),e=o(n);this._plugins[e]=this[n]=t},registerPlugin:function(t,e){e=e?o(e):u(t.constructor).toLowerCase();t.uuid=Object(i.GetYoDigits)(6,e),t.$element.attr("data-".concat(e))||t.$element.attr("data-".concat(e),t.uuid),t.$element.data("zfPlugin")||t.$element.data("zfPlugin",t),t.$element.trigger("init.zf.".concat(e)),this._uuids.push(t.uuid)},unregisterPlugin:function(t){var e,n=o(u(t.$element.data("zfPlugin").constructor));for(e in this._uuids.splice(this._uuids.indexOf(t.uuid),1),t.$element.removeAttr("data-".concat(n)).removeData("zfPlugin").trigger("destroyed.zf.".concat(n)),t)"function"==typeof t[e]&&(t[e]=null)},reInit:function(t){var e,n,i=t instanceof s.a;try{i?t.each(function(){s()(this).data("zfPlugin")._init()}):(e=a(t),n=this,{object:function(t){t.forEach(function(t){t=o(t),s()("[data-"+t+"]").foundation("_init")})},string:function(){t=o(t),s()("[data-"+t+"]").foundation("_init")},undefined:function(){this.object(Object.keys(n._plugins))}}[e](t))}catch(t){console.error(t)}finally{return t}},reflow:function(i,t){void 0===t?t=Object.keys(this._plugins):"string"==typeof t&&(t=[t]);var o=this;s.a.each(t,function(t,e){var n=o._plugins[e];s()(i).find("[data-"+e+"]").addBack("[data-"+e+"]").filter(function(){return void 0===s()(this).data("zfPlugin")}).each(function(){var t=s()(this),e={reflow:!0};t.attr("data-options")&&t.attr("data-options").split(";").forEach(function(t){t=t.split(":").map(function(t){return t.trim()});t[0]&&(e[t[0]]=function(t){{if("true"===t)return!0;if("false"===t)return!1;if(!isNaN(+t))return parseFloat(t)}return t}(t[1]))});try{t.data("zfPlugin",new n(s()(this),e))}catch(t){console.error(t)}finally{return}})})},getFnName:u,addToJquery:function(){return s.a.fn.foundation=function(n){var t=a(n),e=s()(".no-js");if(e.length&&e.removeClass("no-js"),"undefined"===t)r.MediaQuery._init(),l.reflow(this);else{if("string"!==t)throw new TypeError("We're sorry, ".concat(t," is not a valid parameter. You must use a string representing the method you wish to invoke."));var i=Array.prototype.slice.call(arguments,1),o=this.data("zfPlugin");if(void 0===o||void 0===o[n])throw new ReferenceError("We're sorry, '"+n+"' is not an available method for "+(o?u(o):"this element")+".");1===this.length?o[n].apply(o,i):this.each(function(t,e){o[n].apply(s()(e).data("zfPlugin"),i)})}return this},s.a}};function u(t){if(void 0!==Function.prototype.name)return(void 0===t.prototype?t:t.prototype).constructor.name;t=/function\s([^(]{1,})\(/.exec(t.toString());return t&&1<t.length?t[1].trim():""}function o(t){return t.replace(/([a-z])([A-Z])/g,"$1-$2").toLowerCase()}l.util={throttle:function(n,i){var o=null;return function(){var t=this,e=arguments;null===o&&(o=setTimeout(function(){n.apply(t,e),o=null},i))}}},window.Foundation=l,function(){Date.now&&window.Date.now||(window.Date.now=Date.now=function(){return(new Date).getTime()});for(var i,t=["webkit","moz"],e=0;e<t.length&&!window.requestAnimationFrame;++e){var n=t[e];window.requestAnimationFrame=window[n+"RequestAnimationFrame"],window.cancelAnimationFrame=window[n+"CancelAnimationFrame"]||window[n+"CancelRequestAnimationFrame"]}!/iP(ad|hone|od).*OS 6/.test(window.navigator.userAgent)&&window.requestAnimationFrame&&window.cancelAnimationFrame||(i=0,window.requestAnimationFrame=function(t){var e=Date.now(),n=Math.max(i+16,e);return setTimeout(function(){t(i=n)},n-e)},window.cancelAnimationFrame=clearTimeout),window.performance&&window.performance.now||(window.performance={start:Date.now(),now:function(){return Date.now()-this.start}})}(),Function.prototype.bind||(Function.prototype.bind=function(t){if("function"!=typeof this)throw new TypeError("Function.prototype.bind - what is trying to be bound is not callable");function e(){return i.apply(this instanceof o?this:t,n.concat(Array.prototype.slice.call(arguments)))}var n=Array.prototype.slice.call(arguments,1),i=this,o=function(){};return this.prototype&&(o.prototype=this.prototype),e.prototype=new o,e})},"./js/foundation.core.plugin.js":function(t,e,n){"use strict";n.r(e),n.d(e,"Plugin",function(){return i});var o=n("./js/foundation.core.utils.js");function s(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}var i=function(){function n(t,e){!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,n),this._setup(t,e);e=r(this);this.uuid=Object(o.GetYoDigits)(6,e),this.$element.attr("data-".concat(e))||this.$element.attr("data-".concat(e),this.uuid),this.$element.data("zfPlugin")||this.$element.data("zfPlugin",this),this.$element.trigger("init.zf.".concat(e))}var t,e,i;return t=n,(e=[{key:"destroy",value:function(){this._destroy();var t,e=r(this);for(t in this.$element.removeAttr("data-".concat(e)).removeData("zfPlugin").trigger("destroyed.zf.".concat(e)),this)this.hasOwnProperty(t)&&(this[t]=null)}}])&&s(t.prototype,e),i&&s(t,i),n}();function r(t){return t.className.replace(/([a-z])([A-Z])/g,"$1-$2").toLowerCase()}},"./js/foundation.core.utils.js":function(t,e,n){"use strict";n.r(e),n.d(e,"rtl",function(){return i}),n.d(e,"GetYoDigits",function(){return o}),n.d(e,"RegExpEscape",function(){return s}),n.d(e,"transitionend",function(){return r}),n.d(e,"onLoad",function(){return a}),n.d(e,"ignoreMousedisappear",function(){return u});var e=n("jquery"),l=n.n(e);function i(){return"rtl"===l()("html").attr("dir")}function o(){for(var t=0<arguments.length&&void 0!==arguments[0]?arguments[0]:6,e=1<arguments.length?arguments[1]:void 0,n="",i="0123456789abcdefghijklmnopqrstuvwxyz",o=i.length,s=0;s<t;s++)n+=i[Math.floor(Math.random()*o)];return e?"".concat(n,"-").concat(e):n}function s(t){return t.replace(/[-[\]{}()*+?.,\\^$|#\s]/g,"\\$&")}function r(t){var e,n,i={transition:"transitionend",WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"otransitionend"},o=document.createElement("div");for(n in i)void 0!==o.style[n]&&(e=i[n]);return e||(setTimeout(function(){t.triggerHandler("transitionend",[t])},1),"transitionend")}function a(t,e){function n(){return t.triggerHandler(o)}var i="complete"===document.readyState,o=(i?"_didLoad":"load")+".zf.util.onLoad";return t&&(e&&t.one(o,e),i?setTimeout(n):l()(window).one("load",n)),o}function u(s){var t=1<arguments.length&&void 0!==arguments[1]?arguments[1]:{},e=t.ignoreLeaveWindow,r=void 0!==e&&e,t=t.ignoreReappear,a=void 0!==t&&t;return function(e){for(var t=arguments.length,n=new Array(1<t?t-1:0),i=1;i<t;i++)n[i-1]=arguments[i];var o=s.bind.apply(s,[this,e].concat(n));if(null!==e.relatedTarget)return o();setTimeout(function(){return r||!document.hasFocus||document.hasFocus()?void(a||l()(document).one("mouseenter",function(t){l()(e.currentTarget).has(t.target).length||(e.relatedTarget=t.target,o())})):o()},0)}}},"./js/foundation.drilldown.js":function(t,e,n){"use strict";n.r(e),n.d(e,"Drilldown",function(){return i});var e=n("jquery"),r=n.n(e),a=n("./js/foundation.util.keyboard.js"),s=n("./js/foundation.util.nest.js"),l=n("./js/foundation.core.utils.js"),u=n("./js/foundation.util.box.js"),c=n("./js/foundation.core.plugin.js");function o(t){return(o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function f(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}function d(t,e){return(d=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function h(n){var i=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],function(){})),!0}catch(t){return!1}}();return function(){var t,e=p(n);return function(t,e){{if(e&&("object"===o(e)||"function"==typeof e))return e;if(void 0!==e)throw new TypeError("Derived constructors may only return object or undefined")}return function(t){if(void 0!==t)return t;throw new ReferenceError("this hasn't been initialised - super() hasn't been called")}(t)}(this,i?(t=p(this).constructor,Reflect.construct(e,arguments,t)):e.apply(this,arguments))}}function p(t){return(p=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}var i=function(){!function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&d(t,e)}(o,c["Plugin"]);var t,e,n,i=h(o);function o(){return function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,o),i.apply(this,arguments)}return t=o,(e=[{key:"_setup",value:function(t,e){this.$element=t,this.options=r.a.extend({},o.defaults,this.$element.data(),e),this.className="Drilldown",this._init(),a.Keyboard.register("Drilldown",{ENTER:"open",SPACE:"open",ARROW_RIGHT:"next",ARROW_UP:"up",ARROW_DOWN:"down",ARROW_LEFT:"previous",ESCAPE:"close"})}},{key:"_init",value:function(){s.Nest.Feather(this.$element,"drilldown"),this.options.autoApplyClass&&this.$element.addClass("drilldown"),this.$element.attr({"aria-multiselectable":!1}),this.$submenuAnchors=this.$element.find("li.is-drilldown-submenu-parent").children("a"),this.$submenus=this.$submenuAnchors.parent("li").children("[data-submenu]").attr("role","group"),this.$menuItems=this.$element.find("li").not(".js-drilldown-back").find("a"),this.$currentMenu=this.$element,this.$element.attr("data-mutate",this.$element.attr("data-drilldown")||Object(l.GetYoDigits)(6,"drilldown")),this._prepareMenu(),this._registerEvents(),this._keyboardEvents()}},{key:"_prepareMenu",value:function(){var n=this;this.$submenuAnchors.each(function(){var t=r()(this),e=t.parent();n.options.parentLink&&t.clone().prependTo(e.children("[data-submenu]")).wrap('<li data-is-parent-link class="is-submenu-parent-item is-submenu-item is-drilldown-submenu-item" role="none"></li>'),t.data("savedHref",t.attr("href")).removeAttr("href").attr("tabindex",0),t.children("[data-submenu]").attr({"aria-hidden":!0,tabindex:0,role:"group"}),n._events(t)}),this.$submenus.each(function(){var t=r()(this);if(!t.find(".js-drilldown-back").length)switch(n.options.backButtonPosition){case"bottom":t.append(n.options.backButton);break;case"top":t.prepend(n.options.backButton);break;default:console.error("Unsupported backButtonPosition value '"+n.options.backButtonPosition+"'")}n._back(t)}),this.$submenus.addClass("invisible"),this.options.autoHeight||this.$submenus.addClass("drilldown-submenu-cover-previous"),this.$element.parent().hasClass("is-drilldown")||(this.$wrapper=r()(this.options.wrapper).addClass("is-drilldown"),this.options.animateHeight&&this.$wrapper.addClass("animate-height"),this.$element.wrap(this.$wrapper)),this.$wrapper=this.$element.parent(),this.$wrapper.css(this._getMaxDims())}},{key:"_resize",value:function(){this.$wrapper.css({"max-width":"none","min-height":"none"}),this.$wrapper.css(this._getMaxDims())}},{key:"_events",value:function(n){var i=this;n.off("click.zf.drilldown").on("click.zf.drilldown",function(t){var e;r()(t.target).parentsUntil("ul","li").hasClass("is-drilldown-submenu-parent")&&t.preventDefault(),i._show(n.parent("li")),i.options.closeOnClick&&(e=r()("body")).off(".zf.drilldown").on("click.zf.drilldown",function(t){t.target===i.$element[0]||r.a.contains(i.$element[0],t.target)||(t.preventDefault(),i._hideAll(),e.off(".zf.drilldown"))})})}},{key:"_registerEvents",value:function(){this.options.scrollTop&&(this._bindHandler=this._scrollTop.bind(this),this.$element.on("open.zf.drilldown hide.zf.drilldown close.zf.drilldown closed.zf.drilldown",this._bindHandler)),this.$element.on("mutateme.zf.trigger",this._resize.bind(this))}},{key:"_scrollTop",value:function(){var t=this,e=""!==t.options.scrollTopElement?r()(t.options.scrollTopElement):t.$element,e=parseInt(e.offset().top+t.options.scrollTopOffset,10);r()("html, body").stop(!0).animate({scrollTop:e},t.options.animationDuration,t.options.animationEasing,function(){this===r()("html")[0]&&t.$element.trigger("scrollme.zf.drilldown")})}},{key:"_keyboardEvents",value:function(){var t=this;this.$menuItems.add(this.$element.find(".js-drilldown-back > a, .is-submenu-parent-item > a")).on("keydown.zf.drilldown",function(e){var n,i,o=r()(this),s=o.parent("li").parent("ul").children("li").children("a");s.each(function(t){r()(this).is(o)&&(n=s.eq(Math.max(0,t-1)),i=s.eq(Math.min(t+1,s.length-1)))}),a.Keyboard.handleKey(e,"Drilldown",{next:function(){if(o.is(t.$submenuAnchors))return t._show(o.parent("li")),o.parent("li").one(Object(l.transitionend)(o),function(){o.parent("li").find("ul li a").not(".js-drilldown-back a").first().focus()}),!0},previous:function(){return t._hide(o.parent("li").parent("ul")),o.parent("li").parent("ul").one(Object(l.transitionend)(o),function(){setTimeout(function(){o.parent("li").parent("ul").parent("li").children("a").first().focus()},1)}),!0},up:function(){return n.focus(),!o.is(t.$element.find("> li:first-child > a"))},down:function(){return i.focus(),!o.is(t.$element.find("> li:last-child > a"))},close:function(){o.is(t.$element.find("> li > a"))||(t._hide(o.parent().parent()),o.parent().parent().siblings("a").focus())},open:function(){return(!t.options.parentLink||!o.attr("href"))&&(o.is(t.$menuItems)?o.is(t.$submenuAnchors)?(t._show(o.parent("li")),o.parent("li").one(Object(l.transitionend)(o),function(){o.parent("li").find("ul li a").not(".js-drilldown-back a").first().focus()}),!0):void 0:(t._hide(o.parent("li").parent("ul")),o.parent("li").parent("ul").one(Object(l.transitionend)(o),function(){setTimeout(function(){o.parent("li").parent("ul").parent("li").children("a").first().focus()},1)}),!0))},handled:function(t){t&&e.preventDefault()}})})}},{key:"_hideAll",value:function(){var t,e=this,n=this.$element.find(".is-drilldown-submenu.is-active");n.addClass("is-closing"),n.parent().closest("ul").removeClass("invisible"),this.options.autoHeight&&(t=n.parent().closest("ul").data("calcHeight"),this.$wrapper.css({height:t})),this.$element.trigger("close.zf.drilldown"),n.one(Object(l.transitionend)(n),function(){n.removeClass("is-active is-closing"),e.$element.trigger("closed.zf.drilldown")})}},{key:"_back",value:function(e){var n=this;e.off("click.zf.drilldown"),e.children(".js-drilldown-back").on("click.zf.drilldown",function(){n._hide(e);var t=e.parent("li").parent("ul").parent("li");t.length?n._show(t):n.$currentMenu=n.$element})}},{key:"_menuLinkEvents",value:function(){var t=this;this.$menuItems.not(".is-drilldown-submenu-parent").off("click.zf.drilldown").on("click.zf.drilldown",function(){setTimeout(function(){t._hideAll()},0)})}},{key:"_setShowSubMenuClasses",value:function(t,e){t.addClass("is-active").removeClass("invisible").attr("aria-hidden",!1),t.parent("li").attr("aria-expanded",!0),!0===e&&this.$element.trigger("open.zf.drilldown",[t])}},{key:"_setHideSubMenuClasses",value:function(t,e){t.removeClass("is-active").addClass("invisible").attr("aria-hidden",!0),t.parent("li").attr("aria-expanded",!1),!0===e&&t.trigger("hide.zf.drilldown",[t])}},{key:"_showMenu",value:function(e,n){var i=this;if(this.$element.find('li[aria-expanded="true"] > ul[data-submenu]').each(function(){i._setHideSubMenuClasses(r()(this))}),(this.$currentMenu=e).is("[data-drilldown]"))return!0===n&&e.find("li > a").first().focus(),void(this.options.autoHeight&&this.$wrapper.css("height",e.data("calcHeight")));var o=e.children().first().parentsUntil("[data-drilldown]","[data-submenu]");o.each(function(t){0===t&&i.options.autoHeight&&i.$wrapper.css("height",r()(this).data("calcHeight"));t=t===o.length-1;!0==t&&r()(this).one(Object(l.transitionend)(r()(this)),function(){!0===n&&e.find("li > a").first().focus()}),i._setShowSubMenuClasses(r()(this),t)})}},{key:"_show",value:function(t){var e=t.children("[data-submenu]");t.attr("aria-expanded",!0),this.$currentMenu=e,t.parent().closest("ul").addClass("invisible"),e.addClass("is-active visible").removeClass("invisible").attr("aria-hidden",!1),this.options.autoHeight&&this.$wrapper.css({height:e.data("calcHeight")}),this.$element.trigger("open.zf.drilldown",[t])}},{key:"_hide",value:function(t){this.options.autoHeight&&this.$wrapper.css({height:t.parent().closest("ul").data("calcHeight")}),t.parent().closest("ul").removeClass("invisible"),t.parent("li").attr("aria-expanded",!1),t.attr("aria-hidden",!0),t.addClass("is-closing").one(Object(l.transitionend)(t),function(){t.removeClass("is-active is-closing visible"),t.blur().addClass("invisible")}),t.trigger("hide.zf.drilldown",[t])}},{key:"_getMaxDims",value:function(){var e=0,t={},n=this;return this.$submenus.add(this.$element).each(function(){var t=u.Box.GetDimensions(this).height;e=e<t?t:e,n.options.autoHeight&&r()(this).data("calcHeight",t)}),this.options.autoHeight?t.height=this.$currentMenu.data("calcHeight"):t["min-height"]="".concat(e,"px"),t["max-width"]="".concat(this.$element[0].getBoundingClientRect().width,"px"),t}},{key:"_destroy",value:function(){r()("body").off(".zf.drilldown"),this.options.scrollTop&&this.$element.off(".zf.drilldown",this._bindHandler),this._hideAll(),this.$element.off("mutateme.zf.trigger"),s.Nest.Burn(this.$element,"drilldown"),this.$element.unwrap().find(".js-drilldown-back, .is-submenu-parent-item").remove().end().find(".is-active, .is-closing, .is-drilldown-submenu").removeClass("is-active is-closing is-drilldown-submenu").off("transitionend otransitionend webkitTransitionEnd").end().find("[data-submenu]").removeAttr("aria-hidden tabindex role"),this.$submenuAnchors.each(function(){r()(this).off(".zf.drilldown")}),this.$element.find("[data-is-parent-link]").detach(),this.$submenus.removeClass("drilldown-submenu-cover-previous invisible"),this.$element.find("a").each(function(){var t=r()(this);t.removeAttr("tabindex"),t.data("savedHref")&&t.attr("href",t.data("savedHref")).removeData("savedHref")})}}])&&f(t.prototype,e),n&&f(t,n),o}();i.defaults={autoApplyClass:!0,backButton:'<li class="js-drilldown-back"><a tabindex="0">Back</a></li>',backButtonPosition:"top",wrapper:"<div></div>",parentLink:!1,closeOnClick:!1,autoHeight:!1,animateHeight:!1,scrollTop:!1,scrollTopElement:"",scrollTopOffset:0,animationDuration:500,animationEasing:"swing"}},"./js/foundation.dropdown.js":function(t,e,n){"use strict";n.r(e),n.d(e,"Dropdown",function(){return i});var e=n("jquery"),s=n.n(e),r=n("./js/foundation.util.keyboard.js"),a=n("./js/foundation.core.utils.js"),l=n("./js/foundation.positionable.js"),u=n("./js/foundation.util.triggers.js"),c=n("./js/foundation.util.touch.js");function o(t){return(o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function f(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}function d(t,e,n){return(d="undefined"!=typeof Reflect&&Reflect.get?Reflect.get:function(t,e,n){t=function(t,e){for(;!Object.prototype.hasOwnProperty.call(t,e)&&null!==(t=m(t)););return t}(t,e);if(t){e=Object.getOwnPropertyDescriptor(t,e);return e.get?e.get.call(n):e.value}})(t,e,n||t)}function h(t,e){return(h=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function p(n){var i=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],function(){})),!0}catch(t){return!1}}();return function(){var t,e=m(n);return function(t,e){{if(e&&("object"===o(e)||"function"==typeof e))return e;if(void 0!==e)throw new TypeError("Derived constructors may only return object or undefined")}return function(t){if(void 0!==t)return t;throw new ReferenceError("this hasn't been initialised - super() hasn't been called")}(t)}(this,i?(t=m(this).constructor,Reflect.construct(e,arguments,t)):e.apply(this,arguments))}}function m(t){return(m=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}var i=function(){!function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&h(t,e)}(o,l["Positionable"]);var t,e,n,i=p(o);function o(){return function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,o),i.apply(this,arguments)}return t=o,(e=[{key:"_setup",value:function(t,e){this.$element=t,this.options=s.a.extend({},o.defaults,this.$element.data(),e),this.className="Dropdown",c.Touch.init(s.a),u.Triggers.init(s.a),this._init(),r.Keyboard.register("Dropdown",{ENTER:"toggle",SPACE:"toggle",ESCAPE:"close"})}},{key:"_init",value:function(){var t=this.$element.attr("id");this.$anchors=s()('[data-toggle="'.concat(t,'"]')).length?s()('[data-toggle="'.concat(t,'"]')):s()('[data-open="'.concat(t,'"]')),this.$anchors.attr({"aria-controls":t,"data-is-focus":!1,"data-yeti-box":t,"aria-haspopup":!0,"aria-expanded":!1}),this._setCurrentAnchor(this.$anchors.first()),this.options.parentClass?this.$parent=this.$element.parents("."+this.options.parentClass):this.$parent=null,void 0===this.$element.attr("aria-labelledby")&&(void 0===this.$currentAnchor.attr("id")&&this.$currentAnchor.attr("id",Object(a.GetYoDigits)(6,"dd-anchor")),this.$element.attr("aria-labelledby",this.$currentAnchor.attr("id"))),this.$element.attr({"aria-hidden":"true","data-yeti-box":t,"data-resize":t}),d(m(o.prototype),"_init",this).call(this),this._events()}},{key:"_getDefaultPosition",value:function(){var t=this.$element[0].className.match(/(top|left|right|bottom)/g);return t?t[0]:"bottom"}},{key:"_getDefaultAlignment",value:function(){var t=/float-(\S+)/.exec(this.$currentAnchor.attr("class"));return t?t[1]:d(m(o.prototype),"_getDefaultAlignment",this).call(this)}},{key:"_setPosition",value:function(){this.$element.removeClass("has-position-".concat(this.position," has-alignment-").concat(this.alignment)),d(m(o.prototype),"_setPosition",this).call(this,this.$currentAnchor,this.$element,this.$parent),this.$element.addClass("has-position-".concat(this.position," has-alignment-").concat(this.alignment))}},{key:"_setCurrentAnchor",value:function(t){this.$currentAnchor=s()(t)}},{key:"_events",value:function(){var n=this,e="ontouchstart"in window||void 0!==window.ontouchstart;this.$element.on({"open.zf.trigger":this.open.bind(this),"close.zf.trigger":this.close.bind(this),"toggle.zf.trigger":this.toggle.bind(this),"resizeme.zf.trigger":this._setPosition.bind(this)}),this.$anchors.off("click.zf.trigger").on("click.zf.trigger",function(t){n._setCurrentAnchor(this),(!1===n.options.forceFollow||e&&n.options.hover&&!1===n.$element.hasClass("is-open"))&&t.preventDefault()}),this.options.hover&&(this.$anchors.off("mouseenter.zf.dropdown mouseleave.zf.dropdown").on("mouseenter.zf.dropdown",function(){n._setCurrentAnchor(this);var t=s()("body").data();void 0!==t.whatinput&&"mouse"!==t.whatinput||(clearTimeout(n.timeout),n.timeout=setTimeout(function(){n.open(),n.$anchors.data("hover",!0)},n.options.hoverDelay))}).on("mouseleave.zf.dropdown",Object(a.ignoreMousedisappear)(function(){clearTimeout(n.timeout),n.timeout=setTimeout(function(){n.close(),n.$anchors.data("hover",!1)},n.options.hoverDelay)})),this.options.hoverPane&&this.$element.off("mouseenter.zf.dropdown mouseleave.zf.dropdown").on("mouseenter.zf.dropdown",function(){clearTimeout(n.timeout)}).on("mouseleave.zf.dropdown",Object(a.ignoreMousedisappear)(function(){clearTimeout(n.timeout),n.timeout=setTimeout(function(){n.close(),n.$anchors.data("hover",!1)},n.options.hoverDelay)}))),this.$anchors.add(this.$element).on("keydown.zf.dropdown",function(t){var e=s()(this);r.Keyboard.handleKey(t,"Dropdown",{open:function(){e.is(n.$anchors)&&!e.is("input, textarea")&&(n.open(),n.$element.attr("tabindex",-1).focus(),t.preventDefault())},close:function(){n.close(),n.$anchors.focus()}})})}},{key:"_addBodyHandler",value:function(){var e=s()(document.body).not(this.$element),n=this;e.off("click.zf.dropdown tap.zf.dropdown").on("click.zf.dropdown tap.zf.dropdown",function(t){n.$anchors.is(t.target)||n.$anchors.find(t.target).length||n.$element.is(t.target)||n.$element.find(t.target).length||(n.close(),e.off("click.zf.dropdown tap.zf.dropdown"))})}},{key:"open",value:function(){var t;this.$element.trigger("closeme.zf.dropdown",this.$element.attr("id")),this.$anchors.addClass("hover").attr({"aria-expanded":!0}),this.$element.addClass("is-opening"),this._setPosition(),this.$element.removeClass("is-opening").addClass("is-open").attr({"aria-hidden":!1}),!this.options.autoFocus||(t=r.Keyboard.findFocusable(this.$element)).length&&t.eq(0).focus(),this.options.closeOnClick&&this._addBodyHandler(),this.options.trapFocus&&r.Keyboard.trapFocus(this.$element),this.$element.trigger("show.zf.dropdown",[this.$element])}},{key:"close",value:function(){if(!this.$element.hasClass("is-open"))return!1;this.$element.removeClass("is-open").attr({"aria-hidden":!0}),this.$anchors.removeClass("hover").attr("aria-expanded",!1),this.$element.trigger("hide.zf.dropdown",[this.$element]),this.options.trapFocus&&r.Keyboard.releaseFocus(this.$element)}},{key:"toggle",value:function(){this.$element.hasClass("is-open")?this.$anchors.data("hover")||this.close():this.open()}},{key:"_destroy",value:function(){this.$element.off(".zf.trigger").hide(),this.$anchors.off(".zf.dropdown"),s()(document.body).off("click.zf.dropdown tap.zf.dropdown")}}])&&f(t.prototype,e),n&&f(t,n),o}();i.defaults={parentClass:null,hoverDelay:250,hover:!1,hoverPane:!1,vOffset:0,hOffset:0,position:"auto",alignment:"auto",allowOverlap:!1,allowBottomOverlap:!0,trapFocus:!1,autoFocus:!1,closeOnClick:!1,forceFollow:!0}},"./js/foundation.dropdownMenu.js":function(t,e,n){"use strict";n.r(e),n.d(e,"DropdownMenu",function(){return i});var e=n("jquery"),d=n.n(e),s=n("./js/foundation.core.plugin.js"),a=n("./js/foundation.core.utils.js"),h=n("./js/foundation.util.keyboard.js"),r=n("./js/foundation.util.nest.js"),l=n("./js/foundation.util.box.js"),u=n("./js/foundation.util.touch.js");function o(t){return(o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function c(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}function f(t,e){return(f=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function p(n){var i=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],function(){})),!0}catch(t){return!1}}();return function(){var t,e=m(n);return function(t,e){{if(e&&("object"===o(e)||"function"==typeof e))return e;if(void 0!==e)throw new TypeError("Derived constructors may only return object or undefined")}return function(t){if(void 0!==t)return t;throw new ReferenceError("this hasn't been initialised - super() hasn't been called")}(t)}(this,i?(t=m(this).constructor,Reflect.construct(e,arguments,t)):e.apply(this,arguments))}}function m(t){return(m=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}var i=function(){!function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&f(t,e)}(o,s["Plugin"]);var t,e,n,i=p(o);function o(){return function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,o),i.apply(this,arguments)}return t=o,(e=[{key:"_setup",value:function(t,e){this.$element=t,this.options=d.a.extend({},o.defaults,this.$element.data(),e),this.className="DropdownMenu",u.Touch.init(d.a),this._init(),h.Keyboard.register("DropdownMenu",{ENTER:"open",SPACE:"open",ARROW_RIGHT:"next",ARROW_UP:"up",ARROW_DOWN:"down",ARROW_LEFT:"previous",ESCAPE:"close"})}},{key:"_init",value:function(){r.Nest.Feather(this.$element,"dropdown");var t=this.$element.find("li.is-dropdown-submenu-parent");this.$element.children(".is-dropdown-submenu-parent").children(".is-dropdown-submenu").addClass("first-sub"),this.$menuItems=this.$element.find('li[role="none"]'),this.$tabs=this.$element.children('li[role="none"]'),this.$tabs.find("ul.is-dropdown-submenu").addClass(this.options.verticalClass),"auto"===this.options.alignment?this.$element.hasClass(this.options.rightClass)||Object(a.rtl)()||this.$element.parents(".top-bar-right").is("*")?(this.options.alignment="right",t.addClass("opens-left")):(this.options.alignment="left",t.addClass("opens-right")):"right"===this.options.alignment?t.addClass("opens-left"):t.addClass("opens-right"),this.changed=!1,this._events()}},{key:"_isVertical",value:function(){return"block"===this.$tabs.css("display")||"column"===this.$element.css("flex-direction")}},{key:"_isRtl",value:function(){return this.$element.hasClass("align-right")||Object(a.rtl)()&&!this.$element.hasClass("align-left")}},{key:"_events",value:function(){var f=this,s="ontouchstart"in window||void 0!==window.ontouchstart,r="is-dropdown-submenu-parent";(this.options.clickOpen||s)&&this.$menuItems.on("click.zf.dropdownMenu touchstart.zf.dropdownMenu",function(t){var e=d()(t.target).parentsUntil("ul",".".concat(r)),n=e.hasClass(r),i="true"===e.attr("data-is-click"),o=e.children(".is-dropdown-submenu");n&&(i?!f.options.closeOnClick||!f.options.clickOpen&&!s||f.options.forceFollow&&s||(t.stopImmediatePropagation(),t.preventDefault(),f._hide(e)):(t.stopImmediatePropagation(),t.preventDefault(),f._show(o),e.add(e.parentsUntil(f.$element,".".concat(r))).attr("data-is-click",!0)))}),f.options.closeOnClickInside&&this.$menuItems.on("click.zf.dropdownMenu",function(){d()(this).hasClass(r)||f._hide()}),s&&this.options.disableHoverOnTouch&&(this.options.disableHover=!0),this.options.disableHover||this.$menuItems.on("mouseenter.zf.dropdownMenu",function(){var t=d()(this);t.hasClass(r)&&(clearTimeout(t.data("_delay")),t.data("_delay",setTimeout(function(){f._show(t.children(".is-dropdown-submenu"))},f.options.hoverDelay)))}).on("mouseleave.zf.dropdownMenu",Object(a.ignoreMousedisappear)(function(){var t=d()(this);if(t.hasClass(r)&&f.options.autoclose){if("true"===t.attr("data-is-click")&&f.options.clickOpen)return!1;clearTimeout(t.data("_delay")),t.data("_delay",setTimeout(function(){f._hide(t)},f.options.closingTime))}})),this.$menuItems.on("keydown.zf.dropdownMenu",function(e){var n,i,o=d()(e.target).parentsUntil("ul",'[role="none"]'),t=-1<f.$tabs.index(o),s=t?f.$tabs:o.siblings("li").add(o);s.each(function(t){d()(this).is(o)&&(n=s.eq(t-1),i=s.eq(t+1))});function r(){i.children("a:first").focus(),e.preventDefault()}function a(){n.children("a:first").focus(),e.preventDefault()}function l(){var t=o.children("ul.is-dropdown-submenu");t.length&&(f._show(t),o.find("li > a:first").focus(),e.preventDefault())}function u(){var t=o.parent("ul").parent("li");t.children("a:first").focus(),f._hide(t),e.preventDefault()}var c={open:l,close:function(){f._hide(f.$element),f.$menuItems.eq(0).children("a").focus(),e.preventDefault()}};t?f._isVertical()?f._isRtl()?d.a.extend(c,{down:r,up:a,next:u,previous:l}):d.a.extend(c,{down:r,up:a,next:l,previous:u}):f._isRtl()?d.a.extend(c,{next:a,previous:r,down:l,up:u}):d.a.extend(c,{next:r,previous:a,down:l,up:u}):f._isRtl()?d.a.extend(c,{next:u,previous:l,down:r,up:a}):d.a.extend(c,{next:l,previous:u,down:r,up:a}),h.Keyboard.handleKey(e,"DropdownMenu",c)})}},{key:"_addBodyHandler",value:function(){var e=this,t=d()(document.body);this._removeBodyHandler(),t.on("click.zf.dropdownMenu tap.zf.dropdownMenu",function(t){!d()(t.target).closest(e.$element).length&&(e._hide(),e._removeBodyHandler())})}},{key:"_removeBodyHandler",value:function(){d()(document.body).off("click.zf.dropdownMenu tap.zf.dropdownMenu")}},{key:"_show",value:function(n){var t=this.$tabs.index(this.$tabs.filter(function(t,e){return 0<d()(e).find(n).length})),e=n.parent("li.is-dropdown-submenu-parent").siblings("li.is-dropdown-submenu-parent");this._hide(e,t),n.css("visibility","hidden").addClass("js-dropdown-active").parent("li.is-dropdown-submenu-parent").addClass("is-active"),l.Box.ImNotTouchingYou(n,null,!0)||(e="left"===this.options.alignment?"-right":"-left",(t=n.parent(".is-dropdown-submenu-parent")).removeClass("opens".concat(e)).addClass("opens-".concat(this.options.alignment)),l.Box.ImNotTouchingYou(n,null,!0)||t.removeClass("opens-".concat(this.options.alignment)).addClass("opens-inner"),this.changed=!0),n.css("visibility",""),this.options.closeOnClick&&this._addBodyHandler(),this.$element.trigger("show.zf.dropdownMenu",[n])}},{key:"_hide",value:function(t,e){var n,i=t&&t.length?t:void 0!==e?this.$tabs.not(function(t){return t===e}):this.$element;(i.hasClass("is-active")||0<i.find(".is-active").length)&&((n=i.find("li.is-active")).add(i).attr({"data-is-click":!1}).removeClass("is-active"),i.find("ul.js-dropdown-active").removeClass("js-dropdown-active"),(this.changed||i.find("opens-inner").length)&&(t="left"===this.options.alignment?"right":"left",i.find("li.is-dropdown-submenu-parent").add(i).removeClass("opens-inner opens-".concat(this.options.alignment)).addClass("opens-".concat(t)),this.changed=!1),clearTimeout(n.data("_delay")),this._removeBodyHandler(),this.$element.trigger("hide.zf.dropdownMenu",[i]))}},{key:"_destroy",value:function(){this.$menuItems.off(".zf.dropdownMenu").removeAttr("data-is-click").removeClass("is-right-arrow is-left-arrow is-down-arrow opens-right opens-left opens-inner"),d()(document.body).off(".zf.dropdownMenu"),r.Nest.Burn(this.$element,"dropdown")}}])&&c(t.prototype,e),n&&c(t,n),o}();i.defaults={disableHover:!1,disableHoverOnTouch:!0,autoclose:!0,hoverDelay:50,clickOpen:!1,closingTime:500,alignment:"auto",closeOnClick:!0,closeOnClickInside:!0,verticalClass:"vertical",rightClass:"align-right",forceFollow:!0}},"./js/foundation.equalizer.js":function(t,e,n){"use strict";n.r(e),n.d(e,"Equalizer",function(){return i});var e=n("jquery"),c=n.n(e),s=n("./js/foundation.util.mediaQuery.js"),r=n("./js/foundation.util.imageLoader.js"),a=n("./js/foundation.core.utils.js"),l=n("./js/foundation.core.plugin.js");function o(t){return(o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function u(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}function f(t,e){return(f=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function d(n){var i=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],function(){})),!0}catch(t){return!1}}();return function(){var t,e=h(n);return function(t,e){{if(e&&("object"===o(e)||"function"==typeof e))return e;if(void 0!==e)throw new TypeError("Derived constructors may only return object or undefined")}return function(t){if(void 0!==t)return t;throw new ReferenceError("this hasn't been initialised - super() hasn't been called")}(t)}(this,i?(t=h(this).constructor,Reflect.construct(e,arguments,t)):e.apply(this,arguments))}}function h(t){return(h=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}var i=function(){!function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&f(t,e)}(o,l["Plugin"]);var t,e,n,i=d(o);function o(){return function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,o),i.apply(this,arguments)}return t=o,(e=[{key:"_setup",value:function(t,e){this.$element=t,this.options=c.a.extend({},o.defaults,this.$element.data(),e),this.className="Equalizer",this._init()}},{key:"_init",value:function(){var t=this.$element.attr("data-equalizer")||"",e=this.$element.find('[data-equalizer-watch="'.concat(t,'"]'));s.MediaQuery._init(),this.$watched=e.length?e:this.$element.find("[data-equalizer-watch]"),this.$element.attr("data-resize",t||Object(a.GetYoDigits)(6,"eq")),this.$element.attr("data-mutate",t||Object(a.GetYoDigits)(6,"eq")),this.hasNested=0<this.$element.find("[data-equalizer]").length,this.isNested=0<this.$element.parentsUntil(document.body,"[data-equalizer]").length,this.isOn=!1,this._bindHandler={onResizeMeBound:this._onResizeMe.bind(this),onPostEqualizedBound:this._onPostEqualized.bind(this)};var n,t=this.$element.find("img");this.options.equalizeOn?(n=this._checkMQ(),c()(window).on("changed.zf.mediaquery",this._checkMQ.bind(this))):this._events(),(void 0!==n&&!1===n||void 0===n)&&(t.length?Object(r.onImagesLoaded)(t,this._reflow.bind(this)):this._reflow())}},{key:"_pauseEvents",value:function(){this.isOn=!1,this.$element.off({".zf.equalizer":this._bindHandler.onPostEqualizedBound,"resizeme.zf.trigger":this._bindHandler.onResizeMeBound,"mutateme.zf.trigger":this._bindHandler.onResizeMeBound})}},{key:"_onResizeMe",value:function(){this._reflow()}},{key:"_onPostEqualized",value:function(t){t.target!==this.$element[0]&&this._reflow()}},{key:"_events",value:function(){this._pauseEvents(),this.hasNested?this.$element.on("postequalized.zf.equalizer",this._bindHandler.onPostEqualizedBound):(this.$element.on("resizeme.zf.trigger",this._bindHandler.onResizeMeBound),this.$element.on("mutateme.zf.trigger",this._bindHandler.onResizeMeBound)),this.isOn=!0}},{key:"_checkMQ",value:function(){var t=!s.MediaQuery.is(this.options.equalizeOn);return t?this.isOn&&(this._pauseEvents(),this.$watched.css("height","auto")):this.isOn||this._events(),t}},{key:"_killswitch",value:function(){}},{key:"_reflow",value:function(){if(!this.options.equalizeOnStack&&this._isStacked())return this.$watched.css("height","auto"),!1;this.options.equalizeByRow?this.getHeightsByRow(this.applyHeightByRow.bind(this)):this.getHeights(this.applyHeight.bind(this))}},{key:"_isStacked",value:function(){return!this.$watched[0]||!this.$watched[1]||this.$watched[0].getBoundingClientRect().top!==this.$watched[1].getBoundingClientRect().top}},{key:"getHeights",value:function(t){for(var e=[],n=0,i=this.$watched.length;n<i;n++)this.$watched[n].style.height="auto",e.push(this.$watched[n].offsetHeight);t(e)}},{key:"getHeightsByRow",value:function(t){var e=this.$watched.length?this.$watched.first().offset().top:0,n=[],i=0;n[i]=[];for(var o=0,s=this.$watched.length;o<s;o++){this.$watched[o].style.height="auto";var r=c()(this.$watched[o]).offset().top;r!==e&&(n[++i]=[],e=r),n[i].push([this.$watched[o],this.$watched[o].offsetHeight])}for(var a=0,l=n.length;a<l;a++){var u=c()(n[a]).map(function(){return this[1]}).get(),u=Math.max.apply(null,u);n[a].push(u)}t(n)}},{key:"applyHeight",value:function(t){t=Math.max.apply(null,t);this.$element.trigger("preequalized.zf.equalizer"),this.$watched.css("height",t),this.$element.trigger("postequalized.zf.equalizer")}},{key:"applyHeightByRow",value:function(t){this.$element.trigger("preequalized.zf.equalizer");for(var e=0,n=t.length;e<n;e++){var i=t[e].length,o=t[e][i-1];if(i<=2)c()(t[e][0][0]).css({height:"auto"});else{this.$element.trigger("preequalizedrow.zf.equalizer");for(var s=0,r=i-1;s<r;s++)c()(t[e][s][0]).css({height:o});this.$element.trigger("postequalizedrow.zf.equalizer")}}this.$element.trigger("postequalized.zf.equalizer")}},{key:"_destroy",value:function(){this._pauseEvents(),this.$watched.css("height","auto")}}])&&u(t.prototype,e),n&&u(t,n),o}();i.defaults={equalizeOnStack:!1,equalizeByRow:!1,equalizeOn:""}},"./js/foundation.interchange.js":function(t,e,n){"use strict";n.r(e),n.d(e,"Interchange",function(){return i});var e=n("jquery"),o=n.n(e),r=n("./js/foundation.util.mediaQuery.js"),a=n("./js/foundation.core.plugin.js"),l=n("./js/foundation.core.utils.js"),u=n("./js/foundation.util.triggers.js");function s(t){return(s="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function c(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}function f(t,e){return(f=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function d(n){var i=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],function(){})),!0}catch(t){return!1}}();return function(){var t,e=h(n);return function(t,e){{if(e&&("object"===s(e)||"function"==typeof e))return e;if(void 0!==e)throw new TypeError("Derived constructors may only return object or undefined")}return function(t){if(void 0!==t)return t;throw new ReferenceError("this hasn't been initialised - super() hasn't been called")}(t)}(this,i?(t=h(this).constructor,Reflect.construct(e,arguments,t)):e.apply(this,arguments))}}function h(t){return(h=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}var i=function(){!function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&f(t,e)}(s,a["Plugin"]);var t,e,n,i=d(s);function s(){return function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,s),i.apply(this,arguments)}return t=s,(e=[{key:"_setup",value:function(t,e){this.$element=t,this.options=o.a.extend({},s.defaults,this.$element.data(),e),this.rules=[],this.currentPath="",this.className="Interchange",u.Triggers.init(o.a),this._init(),this._events()}},{key:"_init",value:function(){r.MediaQuery._init();var t=this.$element[0].id||Object(l.GetYoDigits)(6,"interchange");this.$element.attr({"data-resize":t,id:t}),this._parseOptions(),this._addBreakpoints(),this._generateRules(),this._reflow()}},{key:"_events",value:function(){var t=this;this.$element.off("resizeme.zf.trigger").on("resizeme.zf.trigger",function(){return t._reflow()})}},{key:"_reflow",value:function(){var t,e,n;for(e in this.rules)this.rules.hasOwnProperty(e)&&(n=this.rules[e],window.matchMedia(n.query).matches&&(t=n));t&&this.replace(t.path)}},{key:"_parseOptions",value:function(){void 0===this.options.type?this.options.type="auto":-1===["auto","src","background","html"].indexOf(this.options.type)&&(console.warn('Warning: invalid value "'.concat(this.options.type,'" for Interchange option "type"')),this.options.type="auto")}},{key:"_addBreakpoints",value:function(){for(var t in r.MediaQuery.queries)r.MediaQuery.queries.hasOwnProperty(t)&&(t=r.MediaQuery.queries[t],s.SPECIAL_QUERIES[t.name]=t.value)}},{key:"_generateRules",value:function(){var t,e,n,i=[],o=this.options.rules||this.$element.data("interchange");for(t in o="string"==typeof o?o.match(/\[.*?, .*?\]/g):o)o.hasOwnProperty(t)&&(e=(n=o[t].slice(1,-1).split(", ")).slice(0,-1).join(""),n=n[n.length-1],s.SPECIAL_QUERIES[n]&&(n=s.SPECIAL_QUERIES[n]),i.push({path:e,query:n}));this.rules=i}},{key:"replace",value:function(e){var n,t,i=this;this.currentPath!==e&&(n="replaced.zf.interchange","src"===(t="auto"===(t=this.options.type)?"IMG"===this.$element[0].nodeName?"src":e.match(/\.(gif|jpe?g|png|svg|tiff)([?#].*)?/i)?"background":"html":t)?this.$element.attr("src",e).on("load",function(){i.currentPath=e}).trigger(n):"background"===t?(e=e.replace(/\(/g,"%28").replace(/\)/g,"%29"),this.$element.css({"background-image":"url("+e+")"}).trigger(n)):"html"===t&&o.a.get(e,function(t){i.$element.html(t).trigger(n),o()(t).foundation(),i.currentPath=e}))}},{key:"_destroy",value:function(){this.$element.off("resizeme.zf.trigger")}}])&&c(t.prototype,e),n&&c(t,n),s}();i.defaults={rules:null,type:"auto"},i.SPECIAL_QUERIES={landscape:"screen and (orientation: landscape)",portrait:"screen and (orientation: portrait)",retina:"only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min--moz-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 2/1), only screen and (min-device-pixel-ratio: 2), only screen and (min-resolution: 192dpi), only screen and (min-resolution: 2dppx)"}},"./js/foundation.magellan.js":function(t,e,n){"use strict";n.r(e),n.d(e,"Magellan",function(){return i});var e=n("jquery"),a=n.n(e),s=n("./js/foundation.core.plugin.js"),r=n("./js/foundation.core.utils.js"),l=n("./js/foundation.smoothScroll.js"),u=n("./js/foundation.util.triggers.js");function o(t){return(o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function c(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}function f(t,e){return(f=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function d(n){var i=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],function(){})),!0}catch(t){return!1}}();return function(){var t,e=h(n);return function(t,e){{if(e&&("object"===o(e)||"function"==typeof e))return e;if(void 0!==e)throw new TypeError("Derived constructors may only return object or undefined")}return function(t){if(void 0!==t)return t;throw new ReferenceError("this hasn't been initialised - super() hasn't been called")}(t)}(this,i?(t=h(this).constructor,Reflect.construct(e,arguments,t)):e.apply(this,arguments))}}function h(t){return(h=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}var i=function(){!function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&f(t,e)}(o,s["Plugin"]);var t,e,n,i=d(o);function o(){return function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,o),i.apply(this,arguments)}return t=o,(e=[{key:"_setup",value:function(t,e){this.$element=t,this.options=a.a.extend({},o.defaults,this.$element.data(),e),this.className="Magellan",u.Triggers.init(a.a),this._init(),this.calcPoints()}},{key:"_init",value:function(){var t=this.$element[0].id||Object(r.GetYoDigits)(6,"magellan");this.$targets=a()("[data-magellan-target]"),this.$links=this.$element.find("a"),this.$element.attr({"data-resize":t,"data-scroll":t,id:t}),this.$active=a()(),this.scrollPos=parseInt(window.pageYOffset,10),this._events()}},{key:"calcPoints",value:function(){var n=this,t=document.body,e=document.documentElement;this.points=[],this.winHeight=Math.round(Math.max(window.innerHeight,e.clientHeight)),this.docHeight=Math.round(Math.max(t.scrollHeight,t.offsetHeight,e.clientHeight,e.scrollHeight,e.offsetHeight)),this.$targets.each(function(){var t=a()(this),e=Math.round(t.offset().top-n.options.threshold);t.targetPoint=e,n.points.push(e)})}},{key:"_events",value:function(){var e=this;a()(window).one("load",function(){e.options.deepLinking&&location.hash&&e.scrollToLoc(location.hash),e.calcPoints(),e._updateActive()}),e.onLoadListener=Object(r.onLoad)(a()(window),function(){e.$element.on({"resizeme.zf.trigger":e.reflow.bind(e),"scrollme.zf.trigger":e._updateActive.bind(e)}).on("click.zf.magellan",'a[href^="#"]',function(t){t.preventDefault();t=this.getAttribute("href");e.scrollToLoc(t)})}),this._deepLinkScroll=function(){e.options.deepLinking&&e.scrollToLoc(window.location.hash)},a()(window).on("hashchange",this._deepLinkScroll)}},{key:"scrollToLoc",value:function(t){this._inTransition=!0;var e=this,n={animationEasing:this.options.animationEasing,animationDuration:this.options.animationDuration,threshold:this.options.threshold,offset:this.options.offset};l.SmoothScroll.scrollToLoc(t,n,function(){e._inTransition=!1})}},{key:"reflow",value:function(){this.calcPoints(),this._updateActive()}},{key:"_updateActive",value:function(){var e,n,t,i,o,s,r=this;this._inTransition||(e=parseInt(window.pageYOffset,10),n=this.scrollPos>e,(this.scrollPos=e)<this.points[0]-this.options.offset-(n?this.options.threshold:0)||(s=e+this.winHeight===this.docHeight?this.points.length-1:(o=this.points.filter(function(t){return t-r.options.offset-(n?r.options.threshold:0)<=e})).length?o.length-1:0),t=this.$active,i="",void 0!==s?(this.$active=this.$links.filter('[href="#'+this.$targets.eq(s).data("magellan-target")+'"]'),this.$active.length&&(i=this.$active[0].getAttribute("href"))):this.$active=a()(),o=!(!this.$active.length&&!t.length||this.$active.is(t)),s=i!==window.location.hash,o&&(t.removeClass(this.options.activeClass),this.$active.addClass(this.options.activeClass)),this.options.deepLinking&&s&&(window.history.pushState?(s=i||window.location.pathname+window.location.search,this.options.updateHistory?window.history.pushState({},"",s):window.history.replaceState({},"",s)):window.location.hash=i),o&&this.$element.trigger("update.zf.magellan",[this.$active]))}},{key:"_destroy",value:function(){var t;this.$element.off(".zf.trigger .zf.magellan").find(".".concat(this.options.activeClass)).removeClass(this.options.activeClass),this.options.deepLinking&&(t=this.$active[0].getAttribute("href"),window.location.hash.replace(t,"")),a()(window).off("hashchange",this._deepLinkScroll),this.onLoadListener&&a()(window).off(this.onLoadListener)}}])&&c(t.prototype,e),n&&c(t,n),o}();i.defaults={animationDuration:500,animationEasing:"linear",threshold:50,activeClass:"is-active",deepLinking:!1,updateHistory:!1,offset:0}},"./js/foundation.offcanvas.js":function(t,e,n){"use strict";n.r(e),n.d(e,"OffCanvas",function(){return i});var e=n("jquery"),s=n.n(e),r=n("./js/foundation.core.plugin.js"),a=n("./js/foundation.core.utils.js"),l=n("./js/foundation.util.keyboard.js"),u=n("./js/foundation.util.mediaQuery.js"),c=n("./js/foundation.util.triggers.js");function f(t){return(f="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function d(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}function h(t,e){return(h=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function p(n){var i=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],function(){})),!0}catch(t){return!1}}();return function(){var t,e=o(n);return function(t,e){{if(e&&("object"===f(e)||"function"==typeof e))return e;if(void 0!==e)throw new TypeError("Derived constructors may only return object or undefined")}return function(t){if(void 0!==t)return t;throw new ReferenceError("this hasn't been initialised - super() hasn't been called")}(t)}(this,i?(t=o(this).constructor,Reflect.construct(e,arguments,t)):e.apply(this,arguments))}}function o(t){return(o=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}var i=function(){!function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&h(t,e)}(o,r["Plugin"]);var t,e,n,i=p(o);function o(){return function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,o),i.apply(this,arguments)}return t=o,(e=[{key:"_setup",value:function(t,e){var n=this;this.className="OffCanvas",this.$element=t,this.options=s.a.extend({},o.defaults,this.$element.data(),e),this.contentClasses={base:[],reveal:[]},this.$lastTrigger=s()(),this.$triggers=s()(),this.position="left",this.$content=s()(),this.nested=!!this.options.nested,this.$sticky=s()(),this.isInCanvas=!1,s()(["push","overlap"]).each(function(t,e){n.contentClasses.base.push("has-transition-"+e)}),s()(["left","right","top","bottom"]).each(function(t,e){n.contentClasses.base.push("has-position-"+e),n.contentClasses.reveal.push("has-reveal-"+e)}),c.Triggers.init(s.a),u.MediaQuery._init(),this._init(),this._events(),l.Keyboard.register("OffCanvas",{ESCAPE:"close"})}},{key:"_init",value:function(){var t=this.$element.attr("id");this.$element.attr("aria-hidden","true"),this.options.contentId?this.$content=s()("#"+this.options.contentId):this.$element.siblings("[data-off-canvas-content]").length?this.$content=this.$element.siblings("[data-off-canvas-content]").first():this.$content=this.$element.closest("[data-off-canvas-content]").first(),this.options.contentId?this.options.contentId&&null===this.options.nested&&console.warn("Remember to use the nested option if using the content ID option!"):this.nested=0===this.$element.siblings("[data-off-canvas-content]").length,!0===this.nested&&(this.options.transition="overlap",this.$element.removeClass("is-transition-push")),this.$element.addClass("is-transition-".concat(this.options.transition," is-closed")),this.$triggers=s()(document).find('[data-open="'+t+'"], [data-close="'+t+'"], [data-toggle="'+t+'"]').attr("aria-expanded","false").attr("aria-controls",t),this.position=this.$element.is(".position-left, .position-top, .position-right, .position-bottom")?this.$element.attr("class").match(/position\-(left|top|right|bottom)/)[1]:this.position,!0===this.options.contentOverlay&&(t=document.createElement("div"),e="fixed"===s()(this.$element).css("position")?"is-overlay-fixed":"is-overlay-absolute",t.setAttribute("class","js-off-canvas-overlay "+e),this.$overlay=s()(t),"is-overlay-fixed"==e?s()(this.$overlay).insertAfter(this.$element):this.$content.append(this.$overlay));var e=new RegExp(Object(a.RegExpEscape)(this.options.revealClass)+"([^\\s]+)","g").exec(this.$element[0].className);e&&(this.options.isRevealed=!0,this.options.revealOn=this.options.revealOn||e[1]),!0===this.options.isRevealed&&this.options.revealOn&&(this.$element.first().addClass("".concat(this.options.revealClass).concat(this.options.revealOn)),this._setMQChecker()),this.options.transitionTime&&this.$element.css("transition-duration",this.options.transitionTime),this.$sticky=this.$content.find("[data-off-canvas-sticky]"),0<this.$sticky.length&&"push"===this.options.transition&&(this.options.contentScroll=!1);e=this.$element.attr("class").match(/\bin-canvas-for-(\w+)/);e&&2===e.length?this.options.inCanvasOn=e[1]:this.options.inCanvasOn&&this.$element.addClass("in-canvas-for-".concat(this.options.inCanvasOn)),this.options.inCanvasOn&&this._checkInCanvas(),this._removeContentClasses()}},{key:"_events",value:function(){var t=this;this.$element.off(".zf.trigger .zf.offCanvas").on({"open.zf.trigger":this.open.bind(this),"close.zf.trigger":this.close.bind(this),"toggle.zf.trigger":this.toggle.bind(this),"keydown.zf.offCanvas":this._handleKeyboard.bind(this)}),!0===this.options.closeOnClick&&(this.options.contentOverlay?this.$overlay:this.$content).on({"click.zf.offCanvas":this.close.bind(this)}),this.options.inCanvasOn&&s()(window).on("changed.zf.mediaquery",function(){t._checkInCanvas()})}},{key:"_setMQChecker",value:function(){var t=this;this.onLoadListener=Object(a.onLoad)(s()(window),function(){u.MediaQuery.atLeast(t.options.revealOn)&&t.reveal(!0)}),s()(window).on("changed.zf.mediaquery",function(){u.MediaQuery.atLeast(t.options.revealOn)?t.reveal(!0):t.reveal(!1)})}},{key:"_checkInCanvas",value:function(){this.isInCanvas=u.MediaQuery.atLeast(this.options.inCanvasOn),!0===this.isInCanvas&&this.close()}},{key:"_removeContentClasses",value:function(t){"boolean"!=typeof t?this.$content.removeClass(this.contentClasses.base.join(" ")):!1===t&&this.$content.removeClass("has-reveal-".concat(this.position))}},{key:"_addContentClasses",value:function(t){this._removeContentClasses(t),"boolean"!=typeof t?this.$content.addClass("has-transition-".concat(this.options.transition," has-position-").concat(this.position)):!0===t&&this.$content.addClass("has-reveal-".concat(this.position))}},{key:"_fixStickyElements",value:function(){this.$sticky.each(function(t,e){var n=s()(e);"fixed"===n.css("position")&&(e=parseInt(n.css("top"),10),n.data("offCanvasSticky",{top:e}),e=s()(document).scrollTop()+e,n.css({top:"".concat(e,"px"),width:"100%",transition:"none"}))})}},{key:"_unfixStickyElements",value:function(){this.$sticky.each(function(t,e){var n=s()(e),e=n.data("offCanvasSticky");"object"===f(e)&&(n.css({top:"".concat(e.top,"px"),width:"",transition:""}),n.data("offCanvasSticky",""))})}},{key:"reveal",value:function(t){t?(this.close(),this.isRevealed=!0,this.$element.attr("aria-hidden","false"),this.$element.off("open.zf.trigger toggle.zf.trigger"),this.$element.removeClass("is-closed")):(this.isRevealed=!1,this.$element.attr("aria-hidden","true"),this.$element.off("open.zf.trigger toggle.zf.trigger").on({"open.zf.trigger":this.open.bind(this),"toggle.zf.trigger":this.toggle.bind(this)}),this.$element.addClass("is-closed")),this._addContentClasses(t)}},{key:"_stopScrolling",value:function(){return!1}},{key:"_recordScrollable",value:function(t){this.lastY=t.touches[0].pageY}},{key:"_preventDefaultAtEdges",value:function(t){var e=t.data,n=this.lastY-t.touches[0].pageY;this.lastY=t.touches[0].pageY,e._canScroll(n,this)||t.preventDefault()}},{key:"_scrollboxTouchMoved",value:function(t){var e=t.data,n=this.closest("[data-off-canvas], [data-off-canvas-scrollbox-outer]"),i=this.lastY-t.touches[0].pageY;n.lastY=this.lastY=t.touches[0].pageY,t.stopPropagation(),e._canScroll(i,this)||(e._canScroll(i,n)?n.scrollTop+=i:t.preventDefault())}},{key:"_canScroll",value:function(t,e){var n=0<e.scrollTop,e=e.scrollTop<e.scrollHeight-e.clientHeight;return t<0&&n||0<t&&e}},{key:"open",value:function(t,e){var n,i=this;this.$element.hasClass("is-open")||this.isRevealed||this.isInCanvas||(n=this,e&&(this.$lastTrigger=e),"top"===this.options.forceTo?window.scrollTo(0,0):"bottom"===this.options.forceTo&&window.scrollTo(0,document.body.scrollHeight),this.options.transitionTime&&"overlap"!==this.options.transition?this.$element.siblings("[data-off-canvas-content]").css("transition-duration",this.options.transitionTime):this.$element.siblings("[data-off-canvas-content]").css("transition-duration",""),this.$element.addClass("is-open").removeClass("is-closed"),this.$triggers.attr("aria-expanded","true"),this.$element.attr("aria-hidden","false"),this.$content.addClass("is-open-"+this.position),!1===this.options.contentScroll&&(s()("body").addClass("is-off-canvas-open").on("touchmove",this._stopScrolling),this.$element.on("touchstart",this._recordScrollable),this.$element.on("touchmove",this,this._preventDefaultAtEdges),this.$element.on("touchstart","[data-off-canvas-scrollbox]",this._recordScrollable),this.$element.on("touchmove","[data-off-canvas-scrollbox]",this,this._scrollboxTouchMoved)),!0===this.options.contentOverlay&&this.$overlay.addClass("is-visible"),!0===this.options.closeOnClick&&!0===this.options.contentOverlay&&this.$overlay.addClass("is-closable"),!0===this.options.autoFocus&&this.$element.one(Object(a.transitionend)(this.$element),function(){var t;n.$element.hasClass("is-open")&&((t=n.$element.find("[data-autofocus]")).length?t:n.$element.find("a, button")).eq(0).focus()}),!0===this.options.trapFocus&&(this.$content.attr("tabindex","-1"),l.Keyboard.trapFocus(this.$element)),"push"===this.options.transition&&this._fixStickyElements(),this._addContentClasses(),this.$element.trigger("opened.zf.offCanvas"),this.$element.one(Object(a.transitionend)(this.$element),function(){i.$element.trigger("openedEnd.zf.offCanvas")}))}},{key:"close",value:function(){var t=this;this.$element.hasClass("is-open")&&!this.isRevealed&&(this.$element.trigger("close.zf.offCanvas"),this.$element.removeClass("is-open"),this.$element.attr("aria-hidden","true"),this.$content.removeClass("is-open-left is-open-top is-open-right is-open-bottom"),!0===this.options.contentOverlay&&this.$overlay.removeClass("is-visible"),!0===this.options.closeOnClick&&!0===this.options.contentOverlay&&this.$overlay.removeClass("is-closable"),this.$triggers.attr("aria-expanded","false"),this.$element.one(Object(a.transitionend)(this.$element),function(){t.$element.addClass("is-closed"),t._removeContentClasses(),"push"===t.options.transition&&t._unfixStickyElements(),!1===t.options.contentScroll&&(s()("body").removeClass("is-off-canvas-open").off("touchmove",t._stopScrolling),t.$element.off("touchstart",t._recordScrollable),t.$element.off("touchmove",t._preventDefaultAtEdges),t.$element.off("touchstart","[data-off-canvas-scrollbox]",t._recordScrollable),t.$element.off("touchmove","[data-off-canvas-scrollbox]",t._scrollboxTouchMoved)),!0===t.options.trapFocus&&(t.$content.removeAttr("tabindex"),l.Keyboard.releaseFocus(t.$element)),t.$element.trigger("closed.zf.offCanvas")}))}},{key:"toggle",value:function(t,e){this.$element.hasClass("is-open")?this.close(t,e):this.open(t,e)}},{key:"_handleKeyboard",value:function(t){var e=this;l.Keyboard.handleKey(t,"OffCanvas",{close:function(){return e.close(),e.$lastTrigger.focus(),!0},handled:function(){t.preventDefault()}})}},{key:"_destroy",value:function(){this.close(),this.$element.off(".zf.trigger .zf.offCanvas"),this.$overlay.off(".zf.offCanvas"),this.onLoadListener&&s()(window).off(this.onLoadListener)}}])&&d(t.prototype,e),n&&d(t,n),o}();i.defaults={closeOnClick:!0,contentOverlay:!0,contentId:null,nested:null,contentScroll:!0,transitionTime:null,transition:"push",forceTo:null,isRevealed:!1,revealOn:null,inCanvasOn:null,autoFocus:!0,revealClass:"reveal-for-",trapFocus:!1}},"./js/foundation.orbit.js":function(t,e,n){"use strict";n.r(e),n.d(e,"Orbit",function(){return i});var e=n("jquery"),s=n.n(e),r=n("./js/foundation.util.keyboard.js"),c=n("./js/foundation.util.motion.js"),a=n("./js/foundation.util.timer.js"),l=n("./js/foundation.util.imageLoader.js"),u=n("./js/foundation.core.utils.js"),f=n("./js/foundation.core.plugin.js"),d=n("./js/foundation.util.touch.js");function o(t){return(o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function h(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}function p(t,e){return(p=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function m(n){var i=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],function(){})),!0}catch(t){return!1}}();return function(){var t,e=v(n);return function(t,e){{if(e&&("object"===o(e)||"function"==typeof e))return e;if(void 0!==e)throw new TypeError("Derived constructors may only return object or undefined")}return function(t){if(void 0!==t)return t;throw new ReferenceError("this hasn't been initialised - super() hasn't been called")}(t)}(this,i?(t=v(this).constructor,Reflect.construct(e,arguments,t)):e.apply(this,arguments))}}function v(t){return(v=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}var i=function(){!function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&p(t,e)}(o,f["Plugin"]);var t,e,n,i=m(o);function o(){return function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,o),i.apply(this,arguments)}return t=o,(e=[{key:"_setup",value:function(t,e){this.$element=t,this.options=s.a.extend({},o.defaults,this.$element.data(),e),this.className="Orbit",d.Touch.init(s.a),this._init(),r.Keyboard.register("Orbit",{ltr:{ARROW_RIGHT:"next",ARROW_LEFT:"previous"},rtl:{ARROW_LEFT:"next",ARROW_RIGHT:"previous"}})}},{key:"_init",value:function(){this._reset(),this.$wrapper=this.$element.find(".".concat(this.options.containerClass)),this.$slides=this.$element.find(".".concat(this.options.slideClass));var t=this.$element.find("img"),e=this.$slides.filter(".is-active"),n=this.$element[0].id||Object(u.GetYoDigits)(6,"orbit");this.$element.attr({"data-resize":n,id:n}),e.length||this.$slides.eq(0).addClass("is-active"),this.options.useMUI||this.$slides.addClass("no-motionui"),t.length?Object(l.onImagesLoaded)(t,this._prepareForOrbit.bind(this)):this._prepareForOrbit(),this.options.bullets&&this._loadBullets(),this._events(),this.options.autoPlay&&1<this.$slides.length&&this.geoSync(),this.options.accessible&&this.$wrapper.attr("tabindex",0)}},{key:"_loadBullets",value:function(){this.$bullets=this.$element.find(".".concat(this.options.boxOfBullets)).find("button")}},{key:"geoSync",value:function(){var t=this;this.timer=new a.Timer(this.$element,{duration:this.options.timerDelay,infinite:!1},function(){t.changeSlide(!0)}),this.timer.start()}},{key:"_prepareForOrbit",value:function(){this._setWrapperHeight()}},{key:"_setWrapperHeight",value:function(t){var e,n=0,i=0,o=this;this.$slides.each(function(){e=this.getBoundingClientRect().height,s()(this).attr("data-slide",i),/mui/g.test(s()(this)[0].className)||o.$slides.filter(".is-active")[0]===o.$slides.eq(i)[0]||s()(this).css({display:"none"}),n=n<e?e:n,i++}),i===this.$slides.length&&(this.$wrapper.css({height:n}),t&&t(n))}},{key:"_setSlideHeight",value:function(t){this.$slides.each(function(){s()(this).css("max-height",t)})}},{key:"_events",value:function(){var i=this;this.$element.off(".resizeme.zf.trigger").on({"resizeme.zf.trigger":this._prepareForOrbit.bind(this)}),1<this.$slides.length&&(this.options.swipe&&this.$slides.off("swipeleft.zf.orbit swiperight.zf.orbit").on("swipeleft.zf.orbit",function(t){t.preventDefault(),i.changeSlide(!0)}).on("swiperight.zf.orbit",function(t){t.preventDefault(),i.changeSlide(!1)}),this.options.autoPlay&&(this.$slides.on("click.zf.orbit",function(){i.$element.data("clickedOn",!i.$element.data("clickedOn")),i.timer[i.$element.data("clickedOn")?"pause":"start"]()}),this.options.pauseOnHover&&this.$element.on("mouseenter.zf.orbit",function(){i.timer.pause()}).on("mouseleave.zf.orbit",function(){i.$element.data("clickedOn")||i.timer.start()})),this.options.navButtons&&this.$element.find(".".concat(this.options.nextClass,", .").concat(this.options.prevClass)).attr("tabindex",0).on("click.zf.orbit touchend.zf.orbit",function(t){t.preventDefault(),i.changeSlide(s()(this).hasClass(i.options.nextClass))}),this.options.bullets&&this.$bullets.on("click.zf.orbit touchend.zf.orbit",function(){if(/is-active/g.test(this.className))return!1;var t=s()(this).data("slide"),e=t>i.$slides.filter(".is-active").data("slide"),n=i.$slides.eq(t);i.changeSlide(e,n,t)}),this.options.accessible&&this.$wrapper.add(this.$bullets).on("keydown.zf.orbit",function(t){r.Keyboard.handleKey(t,"Orbit",{next:function(){i.changeSlide(!0)},previous:function(){i.changeSlide(!1)},handled:function(){s()(t.target).is(i.$bullets)&&i.$bullets.filter(".is-active").focus()}})}))}},{key:"_reset",value:function(){void 0!==this.$slides&&1<this.$slides.length&&(this.$element.off(".zf.orbit").find("*").off(".zf.orbit"),this.options.autoPlay&&this.timer.restart(),this.$slides.each(function(t){s()(t).removeClass("is-active is-active is-in").removeAttr("aria-live").hide()}),this.$slides.first().addClass("is-active").show(),this.$element.trigger("slidechange.zf.orbit",[this.$slides.first()]),this.options.bullets&&this._updateBullets(0))}},{key:"changeSlide",value:function(t,e,n){if(this.$slides){var i=this.$slides.filter(".is-active").eq(0);if(/mui/g.test(i[0].className))return!1;var o=this.$slides.first(),s=this.$slides.last(),r=t?"Right":"Left",a=t?"Left":"Right",l=this,u=e||(t?!this.options.infiniteWrap||i.next(".".concat(this.options.slideClass)).length?i.next(".".concat(this.options.slideClass)):o:!this.options.infiniteWrap||i.prev(".".concat(this.options.slideClass)).length?i.prev(".".concat(this.options.slideClass)):s);u.length&&(this.$element.trigger("beforeslidechange.zf.orbit",[i,u]),this.options.bullets&&(n=n||this.$slides.index(u),this._updateBullets(n)),this.options.useMUI&&!this.$element.is(":hidden")?(c.Motion.animateIn(u.addClass("is-active"),this.options["animInFrom".concat(r)],function(){u.css({display:"block"}).attr("aria-live","polite")}),c.Motion.animateOut(i.removeClass("is-active"),this.options["animOutTo".concat(a)],function(){i.removeAttr("aria-live"),l.options.autoPlay&&!l.timer.isPaused&&l.timer.restart()})):(i.removeClass("is-active is-in").removeAttr("aria-live").hide(),u.addClass("is-active is-in").attr("aria-live","polite").show(),this.options.autoPlay&&!this.timer.isPaused&&this.timer.restart()),this.$element.trigger("slidechange.zf.orbit",[u]))}}},{key:"_updateBullets",value:function(t){var e=this.$bullets.filter(".is-active"),n=this.$bullets.not(".is-active"),i=this.$bullets.eq(t);e.removeClass("is-active").blur(),i.addClass("is-active");var o,t=e.children("[data-slide-active-label]").last();t.length||(o=e.children("span"),n.toArray().map(function(t){return s()(t).children("span").length}).every(function(t){return t<o.length})&&(t=o.last()).attr("data-slide-active-label","")),t.length&&(t.detach(),i.append(t))}},{key:"_destroy",value:function(){this.$element.off(".zf.orbit").find("*").off(".zf.orbit").end().hide()}}])&&h(t.prototype,e),n&&h(t,n),o}();i.defaults={bullets:!0,navButtons:!0,animInFromRight:"slide-in-right",animOutToRight:"slide-out-right",animInFromLeft:"slide-in-left",animOutToLeft:"slide-out-left",autoPlay:!0,timerDelay:5e3,infiniteWrap:!0,swipe:!0,pauseOnHover:!0,accessible:!0,containerClass:"orbit-container",slideClass:"orbit-slide",boxOfBullets:"orbit-bullets",nextClass:"orbit-next",prevClass:"orbit-previous",useMUI:!0}},"./js/foundation.positionable.js":function(t,e,n){"use strict";n.r(e),n.d(e,"Positionable",function(){return i});var r=n("./js/foundation.util.box.js"),s=n("./js/foundation.core.plugin.js"),a=n("./js/foundation.core.utils.js");function o(t){return(o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function l(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}function u(t,e){return(u=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function c(n){var i=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],function(){})),!0}catch(t){return!1}}();return function(){var t,e=f(n);return function(t,e){{if(e&&("object"===o(e)||"function"==typeof e))return e;if(void 0!==e)throw new TypeError("Derived constructors may only return object or undefined")}return function(t){if(void 0!==t)return t;throw new ReferenceError("this hasn't been initialised - super() hasn't been called")}(t)}(this,i?(t=f(this).constructor,Reflect.construct(e,arguments,t)):e.apply(this,arguments))}}function f(t){return(f=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}var d=["left","right","top","bottom"],e=["top","bottom","center"],n=["left","right","center"],h={left:e,right:e,top:n,bottom:n};function p(t,e){t=e.indexOf(t);return t===e.length-1?e[0]:e[t+1]}var i=function(){!function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&u(t,e)}(o,s["Plugin"]);var t,e,n,i=c(o);function o(){return function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,o),i.apply(this,arguments)}return t=o,(e=[{key:"_init",value:function(){this.triedPositions={},this.position="auto"===this.options.position?this._getDefaultPosition():this.options.position,this.alignment="auto"===this.options.alignment?this._getDefaultAlignment():this.options.alignment,this.originalPosition=this.position,this.originalAlignment=this.alignment}},{key:"_getDefaultPosition",value:function(){return"bottom"}},{key:"_getDefaultAlignment",value:function(){switch(this.position){case"bottom":case"top":return Object(a.rtl)()?"right":"left";case"left":case"right":return"bottom"}}},{key:"_reposition",value:function(){this._alignmentsExhausted(this.position)?(this.position=p(this.position,d),this.alignment=h[this.position][0]):this._realign()}},{key:"_realign",value:function(){this._addTriedPosition(this.position,this.alignment),this.alignment=p(this.alignment,h[this.position])}},{key:"_addTriedPosition",value:function(t,e){this.triedPositions[t]=this.triedPositions[t]||[],this.triedPositions[t].push(e)}},{key:"_positionsExhausted",value:function(){for(var t=!0,e=0;e<d.length;e++)t=t&&this._alignmentsExhausted(d[e]);return t}},{key:"_alignmentsExhausted",value:function(t){return this.triedPositions[t]&&this.triedPositions[t].length===h[t].length}},{key:"_getVOffset",value:function(){return this.options.vOffset}},{key:"_getHOffset",value:function(){return this.options.hOffset}},{key:"_setPosition",value:function(t,e,n){if("false"===t.attr("aria-expanded"))return!1;if(this.options.allowOverlap||(this.position=this.originalPosition,this.alignment=this.originalAlignment),e.offset(r.Box.GetExplicitOffsets(e,t,this.position,this.alignment,this._getVOffset(),this._getHOffset())),!this.options.allowOverlap){for(var i=1e8,o={position:this.position,alignment:this.alignment};!this._positionsExhausted();){var s=r.Box.OverlapArea(e,n,!1,!1,this.options.allowBottomOverlap);if(0===s)return;s<i&&(i=s,o={position:this.position,alignment:this.alignment}),this._reposition(),e.offset(r.Box.GetExplicitOffsets(e,t,this.position,this.alignment,this._getVOffset(),this._getHOffset()))}this.position=o.position,this.alignment=o.alignment,e.offset(r.Box.GetExplicitOffsets(e,t,this.position,this.alignment,this._getVOffset(),this._getHOffset()))}}}])&&l(t.prototype,e),n&&l(t,n),o}();i.defaults={position:"auto",alignment:"auto",allowOverlap:!1,allowBottomOverlap:!0,vOffset:0,hOffset:0}},"./js/foundation.responsiveAccordionTabs.js":function(t,e,n){"use strict";n.r(e),n.d(e,"ResponsiveAccordionTabs",function(){return m});var e=n("jquery"),u=n.n(e),s=n("./js/foundation.util.mediaQuery.js"),c=n("./js/foundation.core.utils.js"),r=n("./js/foundation.core.plugin.js"),e=n("./js/foundation.accordion.js");function i(t){return(i="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function a(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}function l(t,e){return(l=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function f(n){var i=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],function(){})),!0}catch(t){return!1}}();return function(){var t,e=o(n);return d(this,i?(t=o(this).constructor,Reflect.construct(e,arguments,t)):e.apply(this,arguments))}}function d(t,e){if(e&&("object"===i(e)||"function"==typeof e))return e;if(void 0!==e)throw new TypeError("Derived constructors may only return object or undefined");return h(t)}function h(t){if(void 0===t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return t}function o(t){return(o=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}var p={tabs:{cssClass:"tabs",plugin:n("./js/foundation.tabs.js").Tabs,open:function(t,e){return t.selectTab(e)},close:null,toggle:null},accordion:{cssClass:"accordion",plugin:e.Accordion,open:function(t,e){return t.down(u()(e))},close:function(t,e){return t.up(u()(e))},toggle:function(t,e){return t.toggle(u()(e))}}},m=function(){!function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&l(t,e)}(o,r["Plugin"]);var t,e,n,i=f(o);function o(t,e){return function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,o),d(e=i.call(this,t,e),e.options.reflow&&e.storezfData||h(e))}return t=o,(e=[{key:"_setup",value:function(t,e){this.$element=u()(t),this.$element.data("zfPluginBase",this),this.options=u.a.extend({},o.defaults,this.$element.data(),e),this.rules=this.$element.data("responsive-accordion-tabs"),this.currentMq=null,this.currentRule=null,this.currentPlugin=null,this.className="ResponsiveAccordionTabs",this.$element.attr("id")||this.$element.attr("id",Object(c.GetYoDigits)(6,"responsiveaccordiontabs")),this._init(),this._events()}},{key:"_init",value:function(){if(s.MediaQuery._init(),"string"==typeof this.rules){for(var t={},e=this.rules.split(" "),n=0;n<e.length;n++){var i=e[n].split("-"),o=1<i.length?i[0]:"small",i=1<i.length?i[1]:i[0];null!==p[i]&&(t[o]=p[i])}this.rules=t}this._getAllOptions(),u.a.isEmptyObject(this.rules)||this._checkMediaQueries()}},{key:"_getAllOptions",value:function(){for(var t in this.allOptions={},p)if(p.hasOwnProperty(t)){var e=p[t];try{var n,i,o=u()("<ul></ul>"),s=new e.plugin(o,this.options);for(n in s.options)s.options.hasOwnProperty(n)&&"zfPlugin"!==n&&(i=s.options[n],this.allOptions[n]=i);s.destroy()}catch(t){console.warn("Warning: Problems getting Accordion/Tab options: ".concat(t))}}}},{key:"_events",value:function(){this._changedZfMediaQueryHandler=this._checkMediaQueries.bind(this),u()(window).on("changed.zf.mediaquery",this._changedZfMediaQueryHandler)}},{key:"_checkMediaQueries",value:function(){var e,n=this;u.a.each(this.rules,function(t){s.MediaQuery.atLeast(t)&&(e=t)}),e&&(this.currentPlugin instanceof this.rules[e].plugin||(u.a.each(p,function(t,e){n.$element.removeClass(e.cssClass)}),this.$element.addClass(this.rules[e].cssClass),this.currentPlugin&&(!this.currentPlugin.$element.data("zfPlugin")&&this.storezfData&&this.currentPlugin.$element.data("zfPlugin",this.storezfData),this.currentPlugin.destroy()),this._handleMarkup(this.rules[e].cssClass),this.currentRule=this.rules[e],this.currentPlugin=new this.currentRule.plugin(this.$element,this.options),this.storezfData=this.currentPlugin.$element.data("zfPlugin")))}},{key:"_handleMarkup",value:function(t){var e,s,r,a,l,n=this,i="accordion",o=u()("[data-tabs-content="+this.$element.attr("id")+"]");(i=o.length?"tabs":i)!==t&&(e=n.allOptions.linkClass||"tabs-title",s=n.allOptions.panelClass||"tabs-panel",this.$element.removeAttr("role"),r=this.$element.children("."+e+",[data-accordion-item]").removeClass(e).removeClass("accordion-item").removeAttr("data-accordion-item"),a=r.children("a").removeClass("accordion-title"),"tabs"===i?(o=o.children("."+s).removeClass(s).removeAttr("role").removeAttr("aria-hidden").removeAttr("aria-labelledby")).children("a").removeAttr("role").removeAttr("aria-controls").removeAttr("aria-selected"):o=r.children("[data-tab-content]").removeClass("accordion-content"),o.css({display:"",visibility:""}),r.css({display:"",visibility:""}),"accordion"===t?o.each(function(t,e){u()(e).appendTo(r.get(t)).addClass("accordion-content").attr("data-tab-content","").removeClass("is-active").css({height:""}),u()("[data-tabs-content="+n.$element.attr("id")+"]").after('<div id="tabs-placeholder-'+n.$element.attr("id")+'"></div>').detach(),r.addClass("accordion-item").attr("data-accordion-item",""),a.addClass("accordion-title")}):"tabs"===t&&(l=u()("[data-tabs-content="+n.$element.attr("id")+"]"),(t=u()("#tabs-placeholder-"+n.$element.attr("id"))).length?(l=u()('<div class="tabs-content"></div>').insertAfter(t).attr("data-tabs-content",n.$element.attr("id")),t.remove()):l=u()('<div class="tabs-content"></div>').insertAfter(n.$element).attr("data-tabs-content",n.$element.attr("id")),o.each(function(t,e){var n=u()(e).appendTo(l).addClass(s),i=a.get(t).hash.slice(1),o=u()(e).attr("id")||Object(c.GetYoDigits)(6,"accordion");i!==o&&(""!==i?u()(e).attr("id",i):(i=o,u()(e).attr("id",i),u()(a.get(t)).attr("href",u()(a.get(t)).attr("href").replace("#","")+"#"+i))),u()(r.get(t)).hasClass("is-active")&&n.addClass("is-active")}),r.addClass(e)))}},{key:"open",value:function(){var t;if(this.currentRule&&"function"==typeof this.currentRule.open)return(t=this.currentRule).open.apply(t,[this.currentPlugin].concat(Array.prototype.slice.call(arguments)))}},{key:"close",value:function(){var t;if(this.currentRule&&"function"==typeof this.currentRule.close)return(t=this.currentRule).close.apply(t,[this.currentPlugin].concat(Array.prototype.slice.call(arguments)))}},{key:"toggle",value:function(){var t;if(this.currentRule&&"function"==typeof this.currentRule.toggle)return(t=this.currentRule).toggle.apply(t,[this.currentPlugin].concat(Array.prototype.slice.call(arguments)))}},{key:"_destroy",value:function(){this.currentPlugin&&this.currentPlugin.destroy(),u()(window).off("changed.zf.mediaquery",this._changedZfMediaQueryHandler)}}])&&a(t.prototype,e),n&&a(t,n),o}();m.defaults={}},"./js/foundation.responsiveMenu.js":function(t,e,n){"use strict";n.r(e),n.d(e,"ResponsiveMenu",function(){return p});var i=n("jquery"),s=n.n(i),r=n("./js/foundation.util.mediaQuery.js"),a=n("./js/foundation.core.utils.js"),l=n("./js/foundation.core.plugin.js"),e=n("./js/foundation.dropdownMenu.js"),i=n("./js/foundation.drilldown.js"),n=n("./js/foundation.accordionMenu.js");function o(t){return(o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function u(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}function c(t,e){return(c=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function f(n){var i=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],function(){})),!0}catch(t){return!1}}();return function(){var t,e=d(n);return function(t,e){{if(e&&("object"===o(e)||"function"==typeof e))return e;if(void 0!==e)throw new TypeError("Derived constructors may only return object or undefined")}return function(t){if(void 0!==t)return t;throw new ReferenceError("this hasn't been initialised - super() hasn't been called")}(t)}(this,i?(t=d(this).constructor,Reflect.construct(e,arguments,t)):e.apply(this,arguments))}}function d(t){return(d=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}var h={dropdown:{cssClass:"dropdown",plugin:e.DropdownMenu},drilldown:{cssClass:"drilldown",plugin:i.Drilldown},accordion:{cssClass:"accordion-menu",plugin:n.AccordionMenu}},p=function(){!function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&c(t,e)}(o,l["Plugin"]);var t,e,n,i=f(o);function o(){return function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,o),i.apply(this,arguments)}return t=o,(e=[{key:"_setup",value:function(t){this.$element=s()(t),this.rules=this.$element.data("responsive-menu"),this.currentMq=null,this.currentPlugin=null,this.className="ResponsiveMenu",this._init(),this._events()}},{key:"_init",value:function(){if(r.MediaQuery._init(),"string"==typeof this.rules){for(var t={},e=this.rules.split(" "),n=0;n<e.length;n++){var i=e[n].split("-"),o=1<i.length?i[0]:"small",i=1<i.length?i[1]:i[0];null!==h[i]&&(t[o]=h[i])}this.rules=t}s.a.isEmptyObject(this.rules)||this._checkMediaQueries(),this.$element.attr("data-mutate",this.$element.attr("data-mutate")||Object(a.GetYoDigits)(6,"responsive-menu"))}},{key:"_events",value:function(){var t=this;s()(window).on("changed.zf.mediaquery",function(){t._checkMediaQueries()})}},{key:"_checkMediaQueries",value:function(){var e,n=this;s.a.each(this.rules,function(t){r.MediaQuery.atLeast(t)&&(e=t)}),e&&(this.currentPlugin instanceof this.rules[e].plugin||(s.a.each(h,function(t,e){n.$element.removeClass(e.cssClass)}),this.$element.addClass(this.rules[e].cssClass),this.currentPlugin&&this.currentPlugin.destroy(),this.currentPlugin=new this.rules[e].plugin(this.$element,{})))}},{key:"_destroy",value:function(){this.currentPlugin.destroy(),s()(window).off(".zf.ResponsiveMenu")}}])&&u(t.prototype,e),n&&u(t,n),o}();p.defaults={}},"./js/foundation.responsiveToggle.js":function(t,e,n){"use strict";n.r(e),n.d(e,"ResponsiveToggle",function(){return i});var e=n("jquery"),s=n.n(e),r=n("./js/foundation.util.mediaQuery.js"),a=n("./js/foundation.util.motion.js"),l=n("./js/foundation.core.plugin.js");function o(t){return(o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function u(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}function c(t,e){return(c=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function f(n){var i=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],function(){})),!0}catch(t){return!1}}();return function(){var t,e=d(n);return function(t,e){{if(e&&("object"===o(e)||"function"==typeof e))return e;if(void 0!==e)throw new TypeError("Derived constructors may only return object or undefined")}return function(t){if(void 0!==t)return t;throw new ReferenceError("this hasn't been initialised - super() hasn't been called")}(t)}(this,i?(t=d(this).constructor,Reflect.construct(e,arguments,t)):e.apply(this,arguments))}}function d(t){return(d=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}var i=function(){!function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&c(t,e)}(o,l["Plugin"]);var t,e,n,i=f(o);function o(){return function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,o),i.apply(this,arguments)}return t=o,(e=[{key:"_setup",value:function(t,e){this.$element=s()(t),this.options=s.a.extend({},o.defaults,this.$element.data(),e),this.className="ResponsiveToggle",this._init(),this._events()}},{key:"_init",value:function(){r.MediaQuery._init();var t,e=this.$element.data("responsive-toggle");e||console.error("Your tab bar needs an ID of a Menu as the value of data-tab-bar."),this.$targetMenu=s()("#".concat(e)),this.$toggler=this.$element.find("[data-toggle]").filter(function(){var t=s()(this).data("toggle");return t===e||""===t}),this.options=s.a.extend({},this.options,this.$targetMenu.data()),this.options.animate&&(t=this.options.animate.split(" "),this.animationIn=t[0],this.animationOut=t[1]||null),this._update()}},{key:"_events",value:function(){this._updateMqHandler=this._update.bind(this),s()(window).on("changed.zf.mediaquery",this._updateMqHandler),this.$toggler.on("click.zf.responsiveToggle",this.toggleMenu.bind(this))}},{key:"_update",value:function(){r.MediaQuery.atLeast(this.options.hideFor)?(this.$element.hide(),this.$targetMenu.show()):(this.$element.show(),this.$targetMenu.hide())}},{key:"toggleMenu",value:function(){var t=this;r.MediaQuery.atLeast(this.options.hideFor)||(this.options.animate?this.$targetMenu.is(":hidden")?a.Motion.animateIn(this.$targetMenu,this.animationIn,function(){t.$element.trigger("toggled.zf.responsiveToggle"),t.$targetMenu.find("[data-mutate]").triggerHandler("mutateme.zf.trigger")}):a.Motion.animateOut(this.$targetMenu,this.animationOut,function(){t.$element.trigger("toggled.zf.responsiveToggle")}):(this.$targetMenu.toggle(0),this.$targetMenu.find("[data-mutate]").trigger("mutateme.zf.trigger"),this.$element.trigger("toggled.zf.responsiveToggle")))}},{key:"_destroy",value:function(){this.$element.off(".zf.responsiveToggle"),this.$toggler.off(".zf.responsiveToggle"),s()(window).off("changed.zf.mediaquery",this._updateMqHandler)}}])&&u(t.prototype,e),n&&u(t,n),o}();i.defaults={hideFor:"medium",animate:!1}},"./js/foundation.reveal.js":function(t,e,n){"use strict";n.r(e),n.d(e,"Reveal",function(){return i});var e=n("jquery"),s=n.n(e),r=n("./js/foundation.core.plugin.js"),a=n("./js/foundation.core.utils.js"),l=n("./js/foundation.util.keyboard.js"),u=n("./js/foundation.util.mediaQuery.js"),c=n("./js/foundation.util.motion.js"),f=n("./js/foundation.util.triggers.js"),d=n("./js/foundation.util.touch.js");function o(t){return(o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function h(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}function p(t,e){return(p=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function m(n){var i=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],function(){})),!0}catch(t){return!1}}();return function(){var t,e=v(n);return function(t,e){{if(e&&("object"===o(e)||"function"==typeof e))return e;if(void 0!==e)throw new TypeError("Derived constructors may only return object or undefined")}return function(t){if(void 0!==t)return t;throw new ReferenceError("this hasn't been initialised - super() hasn't been called")}(t)}(this,i?(t=v(this).constructor,Reflect.construct(e,arguments,t)):e.apply(this,arguments))}}function v(t){return(v=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}var i=function(){!function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&p(t,e)}(o,r["Plugin"]);var t,e,n,i=m(o);function o(){return function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,o),i.apply(this,arguments)}return t=o,(e=[{key:"_setup",value:function(t,e){this.$element=t,this.options=s.a.extend({},o.defaults,this.$element.data(),e),this.className="Reveal",this._init(),d.Touch.init(s.a),f.Triggers.init(s.a),l.Keyboard.register("Reveal",{ESCAPE:"close"})}},{key:"_init",value:function(){var t=this;u.MediaQuery._init(),this.id=this.$element.attr("id"),this.isActive=!1,this.cached={mq:u.MediaQuery.current},this.$anchor=s()('[data-open="'.concat(this.id,'"]')).length?s()('[data-open="'.concat(this.id,'"]')):s()('[data-toggle="'.concat(this.id,'"]')),this.$anchor.attr({"aria-controls":this.id,"aria-haspopup":"dialog",tabindex:0}),(this.options.fullScreen||this.$element.hasClass("full"))&&(this.options.fullScreen=!0,this.options.overlay=!1),this.options.overlay&&!this.$overlay&&(this.$overlay=this._makeOverlay(this.id)),this.$element.attr({role:"dialog","aria-hidden":!0,"data-yeti-box":this.id,"data-resize":this.id}),this.$overlay?this.$element.detach().appendTo(this.$overlay):(this.$element.detach().appendTo(s()(this.options.appendTo)),this.$element.addClass("without-overlay")),this._events(),this.options.deepLink&&window.location.hash==="#".concat(this.id)&&(this.onLoadListener=Object(a.onLoad)(s()(window),function(){return t.open()}))}},{key:"_makeOverlay",value:function(){var t="";return this.options.additionalOverlayClasses&&(t=" "+this.options.additionalOverlayClasses),s()("<div></div>").addClass("reveal-overlay"+t).appendTo(this.options.appendTo)}},{key:"_updatePosition",value:function(){var t=this.$element.outerWidth(),e=s()(window).width(),n=this.$element.outerHeight(),i=s()(window).height(),o=null,t="auto"===this.options.hOffset?parseInt((e-t)/2,10):parseInt(this.options.hOffset,10);"auto"===this.options.vOffset?o=i<n?parseInt(Math.min(100,i/10),10):parseInt((i-n)/4,10):null!==this.options.vOffset&&(o=parseInt(this.options.vOffset,10)),null!==o&&this.$element.css({top:o+"px"}),this.$overlay&&"auto"===this.options.hOffset||(this.$element.css({left:t+"px"}),this.$element.css({margin:"0px"}))}},{key:"_events",value:function(){var n=this,i=this;this.$element.on({"open.zf.trigger":this.open.bind(this),"close.zf.trigger":function(t,e){if(t.target===i.$element[0]||s()(t.target).parents("[data-closable]")[0]===e)return n.close.apply(n)},"toggle.zf.trigger":this.toggle.bind(this),"resizeme.zf.trigger":function(){i._updatePosition()}}),this.options.closeOnClick&&this.options.overlay&&this.$overlay.off(".zf.reveal").on("click.zf.dropdown tap.zf.dropdown",function(t){t.target!==i.$element[0]&&!s.a.contains(i.$element[0],t.target)&&s.a.contains(document,t.target)&&i.close()}),this.options.deepLink&&s()(window).on("hashchange.zf.reveal:".concat(this.id),this._handleState.bind(this))}},{key:"_handleState",value:function(){window.location.hash!=="#"+this.id||this.isActive?this.close():this.open()}},{key:"_disableScroll",value:function(t){t=t||s()(window).scrollTop(),s()(document).height()>s()(window).height()&&s()("html").css("top",-t)}},{key:"_enableScroll",value:function(t){t=t||parseInt(s()("html").css("top"),10),s()(document).height()>s()(window).height()&&(s()("html").css("top",""),s()(window).scrollTop(-t))}},{key:"open",value:function(){var t=this,e="#".concat(this.id);this.options.deepLink&&window.location.hash!==e&&(window.history.pushState?this.options.updateHistory?window.history.pushState({},"",e):window.history.replaceState({},"",e):window.location.hash=e),this.$activeAnchor=s()(document.activeElement).is(this.$anchor)?s()(document.activeElement):this.$anchor,this.isActive=!0,this.$element.css({visibility:"hidden"}).show().scrollTop(0),this.options.overlay&&this.$overlay.css({visibility:"hidden"}).show(),this._updatePosition(),this.$element.hide().css({visibility:""}),this.$overlay&&(this.$overlay.css({visibility:""}).hide(),this.$element.hasClass("fast")?this.$overlay.addClass("fast"):this.$element.hasClass("slow")&&this.$overlay.addClass("slow")),this.options.multipleOpened||this.$element.trigger("closeme.zf.reveal",this.id),0===s()(".reveal:visible").length&&this._disableScroll();var n=this;this.options.animationIn?(this.options.overlay&&c.Motion.animateIn(this.$overlay,"fade-in"),c.Motion.animateIn(this.$element,this.options.animationIn,function(){t.$element&&(t.focusableElements=l.Keyboard.findFocusable(t.$element),n.$element.attr({"aria-hidden":!1,tabindex:-1}).focus(),n._addGlobalClasses(),l.Keyboard.trapFocus(n.$element))})):(this.options.overlay&&this.$overlay.show(0),this.$element.show(this.options.showDelay)),this.$element.attr({"aria-hidden":!1,tabindex:-1}).focus(),l.Keyboard.trapFocus(this.$element),this._addGlobalClasses(),this._addGlobalListeners(),this.$element.trigger("open.zf.reveal")}},{key:"_addGlobalClasses",value:function(){function t(){s()("html").toggleClass("zf-has-scroll",!!(s()(document).height()>s()(window).height()))}this.$element.on("resizeme.zf.trigger.revealScrollbarListener",t),t(),s()("html").addClass("is-reveal-open")}},{key:"_removeGlobalClasses",value:function(){this.$element.off("resizeme.zf.trigger.revealScrollbarListener"),s()("html").removeClass("is-reveal-open"),s()("html").removeClass("zf-has-scroll")}},{key:"_addGlobalListeners",value:function(){var e=this;this.$element&&(this.focusableElements=l.Keyboard.findFocusable(this.$element),this.options.overlay||!this.options.closeOnClick||this.options.fullScreen||s()("body").on("click.zf.dropdown tap.zf.dropdown",function(t){t.target!==e.$element[0]&&!s.a.contains(e.$element[0],t.target)&&s.a.contains(document,t.target)&&e.close()}),this.options.closeOnEsc&&s()(window).on("keydown.zf.reveal",function(t){l.Keyboard.handleKey(t,"Reveal",{close:function(){e.options.closeOnEsc&&e.close()}})}))}},{key:"close",value:function(){if(!this.isActive||!this.$element.is(":visible"))return!1;var t,e=this;function n(){var t=parseInt(s()("html").css("top"),10);0===s()(".reveal:visible").length&&e._removeGlobalClasses(),l.Keyboard.releaseFocus(e.$element),e.$element.attr("aria-hidden",!0),0===s()(".reveal:visible").length&&e._enableScroll(t),e.$element.trigger("closed.zf.reveal")}this.options.animationOut?(this.options.overlay&&c.Motion.animateOut(this.$overlay,"fade-out"),c.Motion.animateOut(this.$element,this.options.animationOut,n)):(this.$element.hide(this.options.hideDelay),this.options.overlay?this.$overlay.hide(0,n):n()),this.options.closeOnEsc&&s()(window).off("keydown.zf.reveal"),!this.options.overlay&&this.options.closeOnClick&&s()("body").off("click.zf.dropdown tap.zf.dropdown"),this.$element.off("keydown.zf.reveal"),this.options.resetOnClose&&this.$element.html(this.$element.html()),this.isActive=!1,e.options.deepLink&&window.location.hash==="#".concat(this.id)&&(window.history.replaceState?(t=window.location.pathname+window.location.search,this.options.updateHistory?window.history.pushState({},"",t):window.history.replaceState("",document.title,t)):window.location.hash=""),this.$activeAnchor.focus()}},{key:"toggle",value:function(){this.isActive?this.close():this.open()}},{key:"_destroy",value:function(){this.options.overlay&&(this.$element.appendTo(s()(this.options.appendTo)),this.$overlay.hide().off().remove()),this.$element.hide().off(),this.$anchor.off(".zf"),s()(window).off(".zf.reveal:".concat(this.id)),this.onLoadListener&&s()(window).off(this.onLoadListener),0===s()(".reveal:visible").length&&this._removeGlobalClasses()}}])&&h(t.prototype,e),n&&h(t,n),o}();i.defaults={animationIn:"",animationOut:"",showDelay:0,hideDelay:0,closeOnClick:!0,closeOnEsc:!0,multipleOpened:!1,vOffset:"auto",hOffset:"auto",fullScreen:!1,overlay:!0,resetOnClose:!1,deepLink:!1,updateHistory:!1,appendTo:"body",additionalOverlayClasses:""}},"./js/foundation.slider.js":function(t,e,n){"use strict";n.r(e),n.d(e,"Slider",function(){return i});var e=n("jquery"),u=n.n(e),r=n("./js/foundation.util.keyboard.js"),h=n("./js/foundation.util.motion.js"),c=n("./js/foundation.core.utils.js"),s=n("./js/foundation.core.plugin.js"),a=n("./js/foundation.util.touch.js"),l=n("./js/foundation.util.triggers.js");function o(t){return(o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function f(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}function d(t,e){return(d=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function p(n){var i=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],function(){})),!0}catch(t){return!1}}();return function(){var t,e=m(n);return function(t,e){{if(e&&("object"===o(e)||"function"==typeof e))return e;if(void 0!==e)throw new TypeError("Derived constructors may only return object or undefined")}return function(t){if(void 0!==t)return t;throw new ReferenceError("this hasn't been initialised - super() hasn't been called")}(t)}(this,i?(t=m(this).constructor,Reflect.construct(e,arguments,t)):e.apply(this,arguments))}}function m(t){return(m=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}var i=function(){!function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&d(t,e)}(o,s["Plugin"]);var t,e,n,i=p(o);function o(){return function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,o),i.apply(this,arguments)}return t=o,(e=[{key:"_setup",value:function(t,e){this.$element=t,this.options=u.a.extend({},o.defaults,this.$element.data(),e),this.className="Slider",this.initialized=!1,a.Touch.init(u.a),l.Triggers.init(u.a),this._init(),r.Keyboard.register("Slider",{ltr:{ARROW_RIGHT:"increase",ARROW_UP:"increase",ARROW_DOWN:"decrease",ARROW_LEFT:"decrease",SHIFT_ARROW_RIGHT:"increaseFast",SHIFT_ARROW_UP:"increaseFast",SHIFT_ARROW_DOWN:"decreaseFast",SHIFT_ARROW_LEFT:"decreaseFast",HOME:"min",END:"max"},rtl:{ARROW_LEFT:"increase",ARROW_RIGHT:"decrease",SHIFT_ARROW_LEFT:"increaseFast",SHIFT_ARROW_RIGHT:"decreaseFast"}})}},{key:"_init",value:function(){this.inputs=this.$element.find("input"),this.handles=this.$element.find("[data-slider-handle]"),this.$handle=this.handles.eq(0),this.$input=this.inputs.length?this.inputs.eq(0):u()("#".concat(this.$handle.attr("aria-controls"))),this.$fill=this.$element.find("[data-slider-fill]").css(this.options.vertical?"height":"width",0),(this.options.disabled||this.$element.hasClass(this.options.disabledClass))&&(this.options.disabled=!0,this.$element.addClass(this.options.disabledClass)),this.inputs.length||(this.inputs=u()().add(this.$input),this.options.binding=!0),this._setInitAttr(0),this.handles[1]&&(this.options.doubleSided=!0,this.$handle2=this.handles.eq(1),this.$input2=1<this.inputs.length?this.inputs.eq(1):u()("#".concat(this.$handle2.attr("aria-controls"))),this.inputs[1]||(this.inputs=this.inputs.add(this.$input2)),this._setInitAttr(1)),this.setHandles(),this._events(),this.initialized=!0}},{key:"setHandles",value:function(){var t=this;this.handles[1]?this._setHandlePos(this.$handle,this.inputs.eq(0).val(),function(){t._setHandlePos(t.$handle2,t.inputs.eq(1).val())}):this._setHandlePos(this.$handle,this.inputs.eq(0).val())}},{key:"_reflow",value:function(){this.setHandles()}},{key:"_pctOfBar",value:function(t){var e=(t-this.options.start)/(this.options.end-this.options.start);switch(this.options.positionValueFunction){case"pow":e=this._logTransform(e);break;case"log":e=this._powTransform(e)}return e.toFixed(2)}},{key:"_value",value:function(t){switch(this.options.positionValueFunction){case"pow":t=this._powTransform(t);break;case"log":t=this._logTransform(t)}var e=this.options.vertical?parseFloat(this.options.end)+t*(this.options.start-this.options.end):(this.options.end-this.options.start)*t+parseFloat(this.options.start);return e}},{key:"_logTransform",value:function(t){return e=this.options.nonLinearBase,t=t*(this.options.nonLinearBase-1)+1,Math.log(t)/Math.log(e);var e}},{key:"_powTransform",value:function(t){return(Math.pow(this.options.nonLinearBase,t)-1)/(this.options.nonLinearBase-1)}},{key:"_setHandlePos",value:function(t,e,n){var i,o,s,r,a,l,u,c,f,d;this.$element.hasClass(this.options.disabledClass)||((e=parseFloat(e))<this.options.start?e=this.options.start:e>this.options.end&&(e=this.options.end),(c=this.options.doubleSided)&&(e=0===this.handles.index(t)?(f=parseFloat(this.$handle2.attr("aria-valuenow")))<=e?f-this.options.step:e:e<=(r=parseFloat(this.$handle.attr("aria-valuenow")))?r+this.options.step:e),f=(i=this).options.vertical,o=f?"height":"width",s=f?"top":"left",r=t[0].getBoundingClientRect()[o],f=this.$element[0].getBoundingClientRect()[o],a=this._pctOfBar(e),l=((f-r)*a/f*100).toFixed(this.options.decimal),e=parseFloat(e.toFixed(this.options.decimal)),u={},this._setValues(t,e),c&&(c=0===this.handles.index(t),f=Math.floor(r/f*100),c?(u[s]="".concat(l,"%"),d=parseFloat(this.$handle2[0].style[s])-l+f,n&&"function"==typeof n&&n()):(n=parseFloat(this.$handle[0].style[s]),d=l-(isNaN(n)?(this.options.initialStart-this.options.start)/((this.options.end-this.options.start)/100):n)+f),u["min-".concat(o)]="".concat(d,"%")),d=this.$element.data("dragging")?1e3/60:this.options.moveTime,Object(h.Move)(d,t,function(){isNaN(l)?t.css(s,"".concat(100*a,"%")):t.css(s,"".concat(l,"%")),i.options.doubleSided?i.$fill.css(u):i.$fill.css(o,"".concat(100*a,"%"))}),this.initialized&&(this.$element.one("finished.zf.animate",function(){i.$element.trigger("moved.zf.slider",[t])}),clearTimeout(i.timeout),i.timeout=setTimeout(function(){i.$element.trigger("changed.zf.slider",[t])},i.options.changedDelay)))}},{key:"_setInitAttr",value:function(t){var e=0===t?this.options.initialStart:this.options.initialEnd,n=this.inputs.eq(t).attr("id")||Object(c.GetYoDigits)(6,"slider");this.inputs.eq(t).attr({id:n,max:this.options.end,min:this.options.start,step:this.options.step}),this.inputs.eq(t).val(e),this.handles.eq(t).attr({role:"slider","aria-controls":n,"aria-valuemax":this.options.end,"aria-valuemin":this.options.start,"aria-valuenow":e,"aria-orientation":this.options.vertical?"vertical":"horizontal",tabindex:0})}},{key:"_setValues",value:function(t,e){var n=this.options.doubleSided?this.handles.index(t):0;this.inputs.eq(n).val(e),t.attr("aria-valuenow",e)}},{key:"_handleEvent",value:function(t,e,n){var i,o,s,r,a,l;n?l=this._adjustValue(null,n):(t.preventDefault(),i=(a=this.options.vertical)?"height":"width",o=a?"top":"left",s=a?t.pageY:t.pageX,r=this.$element[0].getBoundingClientRect()[i],n=a?u()(window).scrollTop():u()(window).scrollLeft(),a=this.$element.offset()[o],t.clientY===t.pageY&&(s+=n),l=this._value((a=(a=s-a)<0?0:r<a?r:a)/r),Object(c.rtl)()&&!this.options.vertical&&(l=this.options.end-l),l=this._adjustValue(null,l),e=e||(v(this.$handle,o,a,i)<=v(this.$handle2,o,a,i)?this.$handle:this.$handle2)),this._setHandlePos(e,l)}},{key:"_adjustValue",value:function(t,e){var n=this.options.step,i=parseFloat(n/2),o=t?parseFloat(t.attr("aria-valuenow")):e,t=0<=o?o%n:n+o%n,e=o-t;return 0===t?o:o=e+i<=o?e+n:e}},{key:"_events",value:function(){this._eventsForHandle(this.$handle),this.handles[1]&&this._eventsForHandle(this.$handle2)}},{key:"_eventsForHandle",value:function(o){function e(t){var e=s.inputs.index(u()(this));s._handleEvent(t,s.handles.eq(e),u()(this).val())}var n,i,s=this;this.inputs.off("keyup.zf.slider").on("keyup.zf.slider",function(t){13===t.keyCode&&e.call(this,t)}),this.inputs.off("change.zf.slider").on("change.zf.slider",e),this.options.clickSelect&&this.$element.off("click.zf.slider").on("click.zf.slider",function(t){return!s.$element.data("dragging")&&void(u()(t.target).is("[data-slider-handle]")||(s.options.doubleSided?s._handleEvent(t):s._handleEvent(t,s.$handle)))}),this.options.draggable&&(this.handles.addTouch(),i=u()("body"),o.off("mousedown.zf.slider").on("mousedown.zf.slider",function(t){o.addClass("is-dragging"),s.$fill.addClass("is-dragging"),s.$element.data("dragging",!0),n=u()(t.currentTarget),i.on("mousemove.zf.slider",function(t){t.preventDefault(),s._handleEvent(t,n)}).on("mouseup.zf.slider",function(t){s._handleEvent(t,n),o.removeClass("is-dragging"),s.$fill.removeClass("is-dragging"),s.$element.data("dragging",!1),i.off("mousemove.zf.slider mouseup.zf.slider")})}).on("selectstart.zf.slider touchmove.zf.slider",function(t){t.preventDefault()})),o.off("keydown.zf.slider").on("keydown.zf.slider",function(t){var e,n=u()(this),i=(s.options.doubleSided&&s.handles.index(n),parseFloat(o.attr("aria-valuenow")));r.Keyboard.handleKey(t,"Slider",{decrease:function(){e=i-s.options.step},increase:function(){e=i+s.options.step},decreaseFast:function(){e=i-10*s.options.step},increaseFast:function(){e=i+10*s.options.step},min:function(){e=s.options.start},max:function(){e=s.options.end},handled:function(){t.preventDefault(),s._setHandlePos(n,e)}})})}},{key:"_destroy",value:function(){this.handles.off(".zf.slider"),this.inputs.off(".zf.slider"),this.$element.off(".zf.slider"),clearTimeout(this.timeout)}}])&&f(t.prototype,e),n&&f(t,n),o}();function v(t,e,n,i){return Math.abs(t.position()[e]+t[i]()/2-n)}i.defaults={start:0,end:100,step:1,initialStart:0,initialEnd:100,binding:!1,clickSelect:!0,vertical:!1,draggable:!0,disabled:!1,doubleSided:!1,decimal:2,moveTime:200,disabledClass:"disabled",invertVertical:!1,changedDelay:500,nonLinearBase:5,positionValueFunction:"linear"}},"./js/foundation.smoothScroll.js":function(t,e,n){"use strict";n.r(e),n.d(e,"SmoothScroll",function(){return i});var e=n("jquery"),s=n.n(e),r=n("./js/foundation.core.utils.js"),a=n("./js/foundation.core.plugin.js");function o(t){return(o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function l(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}function u(t,e){return(u=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function c(n){var i=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],function(){})),!0}catch(t){return!1}}();return function(){var t,e=f(n);return function(t,e){{if(e&&("object"===o(e)||"function"==typeof e))return e;if(void 0!==e)throw new TypeError("Derived constructors may only return object or undefined")}return function(t){if(void 0!==t)return t;throw new ReferenceError("this hasn't been initialised - super() hasn't been called")}(t)}(this,i?(t=f(this).constructor,Reflect.construct(e,arguments,t)):e.apply(this,arguments))}}function f(t){return(f=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}var i=function(){!function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&u(t,e)}(o,a["Plugin"]);var t,e,n,i=c(o);function o(){return function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,o),i.apply(this,arguments)}return t=o,n=[{key:"scrollToLoc",value:function(t){var e=1<arguments.length&&void 0!==arguments[1]?arguments[1]:o.defaults,n=2<arguments.length?arguments[2]:void 0,t=s()(t);if(!t.length)return!1;t=Math.round(t.offset().top-e.threshold/2-e.offset);s()("html, body").stop(!0).animate({scrollTop:t},e.animationDuration,e.animationEasing,function(){"function"==typeof n&&n()})}}],(e=[{key:"_setup",value:function(t,e){this.$element=t,this.options=s.a.extend({},o.defaults,this.$element.data(),e),this.className="SmoothScroll",this._init()}},{key:"_init",value:function(){var t=this.$element[0].id||Object(r.GetYoDigits)(6,"smooth-scroll");this.$element.attr({id:t}),this._events()}},{key:"_events",value:function(){this._linkClickListener=this._handleLinkClick.bind(this),this.$element.on("click.zf.smoothScroll",this._linkClickListener),this.$element.on("click.zf.smoothScroll",'a[href^="#"]',this._linkClickListener)}},{key:"_handleLinkClick",value:function(t){var e,n=this;s()(t.currentTarget).is('a[href^="#"]')&&(e=t.currentTarget.getAttribute("href"),this._inTransition=!0,o.scrollToLoc(e,this.options,function(){n._inTransition=!1}),t.preventDefault())}},{key:"_destroy",value:function(){this.$element.off("click.zf.smoothScroll",this._linkClickListener),this.$element.off("click.zf.smoothScroll",'a[href^="#"]',this._linkClickListener)}}])&&l(t.prototype,e),n&&l(t,n),o}();i.defaults={animationDuration:500,animationEasing:"linear",threshold:50,offset:0}},"./js/foundation.sticky.js":function(t,e,n){"use strict";n.r(e),n.d(e,"Sticky",function(){return i});var e=n("jquery"),a=n.n(e),s=n("./js/foundation.core.plugin.js"),r=n("./js/foundation.core.utils.js"),l=n("./js/foundation.util.mediaQuery.js"),u=n("./js/foundation.util.triggers.js");function o(t){return(o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function c(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}function f(t,e){return(f=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function d(n){var i=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],function(){})),!0}catch(t){return!1}}();return function(){var t,e=h(n);return function(t,e){{if(e&&("object"===o(e)||"function"==typeof e))return e;if(void 0!==e)throw new TypeError("Derived constructors may only return object or undefined")}return function(t){if(void 0!==t)return t;throw new ReferenceError("this hasn't been initialised - super() hasn't been called")}(t)}(this,i?(t=h(this).constructor,Reflect.construct(e,arguments,t)):e.apply(this,arguments))}}function h(t){return(h=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}var i=function(){!function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&f(t,e)}(o,s["Plugin"]);var t,e,n,i=d(o);function o(){return function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,o),i.apply(this,arguments)}return t=o,(e=[{key:"_setup",value:function(t,e){this.$element=t,this.options=a.a.extend({},o.defaults,this.$element.data(),e),this.className="Sticky",u.Triggers.init(a.a),this._init()}},{key:"_init",value:function(){l.MediaQuery._init();var t=this.$element.parent("[data-sticky-container]"),e=this.$element[0].id||Object(r.GetYoDigits)(6,"sticky"),n=this;t.length?this.$container=t:(this.wasWrapped=!0,this.$element.wrap(this.options.container),this.$container=this.$element.parent()),this.$container.addClass(this.options.containerClass),this.$element.addClass(this.options.stickyClass).attr({"data-resize":e,"data-mutate":e}),""!==this.options.anchor&&a()("#"+n.options.anchor).attr({"data-mutate":e}),this.scrollCount=this.options.checkEvery,this.isStuck=!1,this.onLoadListener=Object(r.onLoad)(a()(window),function(){n.containerHeight="none"===n.$element.css("display")?0:n.$element[0].getBoundingClientRect().height,n.$container.css("height",n.containerHeight),n.elemHeight=n.containerHeight,""!==n.options.anchor?n.$anchor=a()("#"+n.options.anchor):n._parsePoints(),n._setSizes(function(){var t=window.pageYOffset;n._calc(!1,t),n.isStuck||n._removeSticky(!(t>=n.topPoint))}),n._events(e.split("-").reverse().join("-"))})}},{key:"_parsePoints",value:function(){for(var t,e,n,i=[""===this.options.topAnchor?1:this.options.topAnchor,""===this.options.btmAnchor?document.documentElement.scrollHeight:this.options.btmAnchor],o={},s=0,r=i.length;s<r&&i[s];s++)"number"==typeof i[s]?n=i[s]:(t=i[s].split(":"),n=(e=a()("#".concat(t[0]))).offset().top,t[1]&&"bottom"===t[1].toLowerCase()&&(n+=e[0].getBoundingClientRect().height)),o[s]=n;this.points=o}},{key:"_events",value:function(t){var e=this,n=this.scrollListener="scroll.zf.".concat(t);this.isOn||(this.canStick&&(this.isOn=!0,a()(window).off(n).on(n,function(){0===e.scrollCount?(e.scrollCount=e.options.checkEvery,e._setSizes(function(){e._calc(!1,window.pageYOffset)})):(e.scrollCount--,e._calc(!1,window.pageYOffset))})),this.$element.off("resizeme.zf.trigger").on("resizeme.zf.trigger",function(){e._eventsHandler(t)}),this.$element.on("mutateme.zf.trigger",function(){e._eventsHandler(t)}),this.$anchor&&this.$anchor.on("mutateme.zf.trigger",function(){e._eventsHandler(t)}))}},{key:"_eventsHandler",value:function(t){var e=this,n=this.scrollListener="scroll.zf.".concat(t);e._setSizes(function(){e._calc(!1),e.canStick?e.isOn||e._events(t):e.isOn&&e._pauseListeners(n)})}},{key:"_pauseListeners",value:function(t){this.isOn=!1,a()(window).off(t),this.$element.trigger("pause.zf.sticky")}},{key:"_calc",value:function(t,e){if(t&&this._setSizes(),!this.canStick)return this.isStuck&&this._removeSticky(!0),!1;(e=e||window.pageYOffset)>=this.topPoint?e<=this.bottomPoint?this.isStuck||this._setSticky():this.isStuck&&this._removeSticky(!1):this.isStuck&&this._removeSticky(!0)}},{key:"_setSticky",value:function(){var t=this,e=this.options.stickTo,n="top"===e?"marginTop":"marginBottom",i="top"===e?"bottom":"top",o={};o[n]="".concat(this.options[n],"em"),o[e]=0,o[i]="auto",this.isStuck=!0,this.$element.removeClass("is-anchored is-at-".concat(i)).addClass("is-stuck is-at-".concat(e)).css(o).trigger("sticky.zf.stuckto:".concat(e)),this.$element.on("transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd",function(){t._setSizes()})}},{key:"_removeSticky",value:function(t){var e=this.options.stickTo,n={},i=(this.points?this.points[1]-this.points[0]:this.anchorHeight)-this.elemHeight,o=t?"top":"bottom";n["top"===e?"marginTop":"marginBottom"]=0,n.bottom="auto",n.top=t?0:i,this.isStuck=!1,this.$element.removeClass("is-stuck is-at-".concat(e)).addClass("is-anchored is-at-".concat(o)).css(n).trigger("sticky.zf.unstuckfrom:".concat(o))}},{key:"_setSizes",value:function(t){this.canStick=l.MediaQuery.is(this.options.stickyOn),this.canStick||t&&"function"==typeof t&&t();var e,n=this.$container[0].getBoundingClientRect().width,i=window.getComputedStyle(this.$container[0]),o=parseInt(i["padding-left"],10),i=parseInt(i["padding-right"],10);this.$anchor&&this.$anchor.length?this.anchorHeight=this.$anchor[0].getBoundingClientRect().height:this._parsePoints(),this.$element.css({"max-width":"".concat(n-o-i,"px")}),!this.options.dynamicHeight&&this.containerHeight||(e=this.$element[0].getBoundingClientRect().height||this.containerHeight,e="none"===this.$element.css("display")?0:e,this.$container.css("height",e),this.containerHeight=e),this.elemHeight=this.containerHeight,this.isStuck||this.$element.hasClass("is-at-bottom")&&(e=(this.points?this.points[1]-this.$container.offset().top:this.anchorHeight)-this.elemHeight,this.$element.css("top",e)),this._setBreakPoints(this.containerHeight,function(){t&&"function"==typeof t&&t()})}},{key:"_setBreakPoints",value:function(t,e){if(!this.canStick){if(!e||"function"!=typeof e)return!1;e()}var n=p(this.options.marginTop),i=p(this.options.marginBottom),o=this.points?this.points[0]:this.$anchor.offset().top,s=this.points?this.points[1]:o+this.anchorHeight,r=window.innerHeight;"top"===this.options.stickTo?(o-=n,s-=t+n):"bottom"===this.options.stickTo&&(o-=r-(t+i),s-=r-i),this.topPoint=o,this.bottomPoint=s,e&&"function"==typeof e&&e()}},{key:"_destroy",value:function(){this._removeSticky(!0),this.$element.removeClass("".concat(this.options.stickyClass," is-anchored is-at-top")).css({height:"",top:"",bottom:"","max-width":""}).off("resizeme.zf.trigger").off("mutateme.zf.trigger"),this.$anchor&&this.$anchor.length&&this.$anchor.off("change.zf.sticky"),this.scrollListener&&a()(window).off(this.scrollListener),this.onLoadListener&&a()(window).off(this.onLoadListener),this.wasWrapped?this.$element.unwrap():this.$container.removeClass(this.options.containerClass).css({height:""})}}])&&c(t.prototype,e),n&&c(t,n),o}();function p(t){return parseInt(window.getComputedStyle(document.body,null).fontSize,10)*t}i.defaults={container:"<div data-sticky-container></div>",stickTo:"top",anchor:"",topAnchor:"",btmAnchor:"",marginTop:1,marginBottom:1,stickyOn:"medium",stickyClass:"sticky",containerClass:"sticky-container",dynamicHeight:!0,checkEvery:-1}},"./js/foundation.tabs.js":function(t,e,n){"use strict";n.r(e),n.d(e,"Tabs",function(){return i});var e=n("jquery"),a=n.n(e),s=n("./js/foundation.core.plugin.js"),l=n("./js/foundation.core.utils.js"),r=n("./js/foundation.util.keyboard.js"),u=n("./js/foundation.util.imageLoader.js");function c(t){return(c="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function f(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}function d(t,e){return(d=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function h(n){var i=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],function(){})),!0}catch(t){return!1}}();return function(){var t,e=o(n);return function(t,e){{if(e&&("object"===c(e)||"function"==typeof e))return e;if(void 0!==e)throw new TypeError("Derived constructors may only return object or undefined")}return function(t){if(void 0!==t)return t;throw new ReferenceError("this hasn't been initialised - super() hasn't been called")}(t)}(this,i?(t=o(this).constructor,Reflect.construct(e,arguments,t)):e.apply(this,arguments))}}function o(t){return(o=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}var i=function(){!function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&d(t,e)}(o,s["Plugin"]);var t,e,n,i=h(o);function o(){return function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,o),i.apply(this,arguments)}return t=o,(e=[{key:"_setup",value:function(t,e){this.$element=t,this.options=a.a.extend({},o.defaults,this.$element.data(),e),this.className="Tabs",this._init(),r.Keyboard.register("Tabs",{ENTER:"open",SPACE:"open",ARROW_RIGHT:"next",ARROW_UP:"previous",ARROW_DOWN:"next",ARROW_LEFT:"previous"})}},{key:"_init",value:function(){var t,i=this,r=this;this._isInitializing=!0,this.$element.attr({role:"tablist"}),this.$tabTitles=this.$element.find(".".concat(this.options.linkClass)),this.$tabContent=a()('[data-tabs-content="'.concat(this.$element[0].id,'"]')),this.$tabTitles.each(function(){var t=a()(this),e=t.find("a"),n=t.hasClass("".concat(r.options.linkActiveClass)),i=e.attr("data-tabs-target")||e[0].hash.slice(1),o=e[0].id||"".concat(i,"-label"),s=a()("#".concat(i));t.attr({role:"presentation"}),e.attr({role:"tab","aria-controls":i,"aria-selected":n,id:o,tabindex:n?"0":"-1"}),s.attr({role:"tabpanel","aria-labelledby":o}),n&&(r._initialAnchor="#".concat(i)),n||s.attr("aria-hidden","true"),n&&r.options.autoFocus&&(r.onLoadListener=Object(l.onLoad)(a()(window),function(){a()("html, body").animate({scrollTop:t.offset().top},r.options.deepLinkSmudgeDelay,function(){e.focus()})}))}),this.options.matchHeight&&((t=this.$tabContent.find("img")).length?Object(u.onImagesLoaded)(t,this._setHeight.bind(this)):this._setHeight()),this._checkDeepLink=function(){var t=window.location.hash;if(!t.length){if(i._isInitializing)return;i._initialAnchor&&(t=i._initialAnchor)}var e=0<=t.indexOf("#")?t.slice(1):t,n=e&&a()("#".concat(e)),t=t&&i.$element.find('[href$="'.concat(t,'"],[data-tabs-target="').concat(e,'"]')).first();!n.length||!t.length||(n&&n.length&&t&&t.length?i.selectTab(n,!0):i._collapse(),i.options.deepLinkSmudge&&(e=i.$element.offset(),a()("html, body").animate({scrollTop:e.top-i.options.deepLinkSmudgeOffset},i.options.deepLinkSmudgeDelay)),i.$element.trigger("deeplink.zf.tabs",[t,n]))},this.options.deepLink&&this._checkDeepLink(),this._events(),this._isInitializing=!1}},{key:"_events",value:function(){this._addKeyHandler(),this._addClickHandler(),this._setHeightMqHandler=null,this.options.matchHeight&&(this._setHeightMqHandler=this._setHeight.bind(this),a()(window).on("changed.zf.mediaquery",this._setHeightMqHandler)),this.options.deepLink&&a()(window).on("hashchange",this._checkDeepLink)}},{key:"_addClickHandler",value:function(){var e=this;this.$element.off("click.zf.tabs").on("click.zf.tabs",".".concat(this.options.linkClass),function(t){t.preventDefault(),e._handleTabChange(a()(this))})}},{key:"_addKeyHandler",value:function(){var s=this;this.$tabTitles.off("keydown.zf.tabs").on("keydown.zf.tabs",function(t){var e,n,i,o;9!==t.which&&(e=a()(this),(n=e.parent("ul").children("li")).each(function(t){a()(this).is(e)&&(o=s.options.wrapOnKeys?(i=0===t?n.last():n.eq(t-1),t===n.length-1?n.first():n.eq(t+1)):(i=n.eq(Math.max(0,t-1)),n.eq(Math.min(t+1,n.length-1))))}),r.Keyboard.handleKey(t,"Tabs",{open:function(){e.find('[role="tab"]').focus(),s._handleTabChange(e)},previous:function(){i.find('[role="tab"]').focus(),s._handleTabChange(i)},next:function(){o.find('[role="tab"]').focus(),s._handleTabChange(o)},handled:function(){t.preventDefault()}}))})}},{key:"_handleTabChange",value:function(t,e){var n,i,o;t.hasClass("".concat(this.options.linkActiveClass))?this.options.activeCollapse&&this._collapse():(n=this.$element.find(".".concat(this.options.linkClass,".").concat(this.options.linkActiveClass)),i=(i=(o=t.find('[role="tab"]')).attr("data-tabs-target"))&&i.length?"#".concat(i):o[0].hash,o=this.$tabContent.find(i),this._collapseTab(n),this._openTab(t),this.options.deepLink&&!e&&(this.options.updateHistory?history.pushState({},"",i):history.replaceState({},"",i)),this.$element.trigger("change.zf.tabs",[t,o]),o.find("[data-mutate]").trigger("mutateme.zf.trigger"))}},{key:"_openTab",value:function(t){var e=t.find('[role="tab"]'),n=e.attr("data-tabs-target")||e[0].hash.slice(1),n=this.$tabContent.find("#".concat(n));t.addClass("".concat(this.options.linkActiveClass)),e.attr({"aria-selected":"true",tabindex:"0"}),n.addClass("".concat(this.options.panelActiveClass)).removeAttr("aria-hidden")}},{key:"_collapseTab",value:function(t){t=t.removeClass("".concat(this.options.linkActiveClass)).find('[role="tab"]').attr({"aria-selected":"false",tabindex:-1});a()("#".concat(t.attr("aria-controls"))).removeClass("".concat(this.options.panelActiveClass)).attr({"aria-hidden":"true"})}},{key:"_collapse",value:function(){var t=this.$element.find(".".concat(this.options.linkClass,".").concat(this.options.linkActiveClass));t.length&&(this._collapseTab(t),this.$element.trigger("collapse.zf.tabs",[t]))}},{key:"selectTab",value:function(t,e){var n,t="object"===c(t)?t[0].id:t;t.indexOf("#")<0?n="#".concat(t):t=(n=t).slice(1);t=this.$tabTitles.has('[href$="'.concat(n,'"],[data-tabs-target="').concat(t,'"]')).first();this._handleTabChange(t,e)}},{key:"_setHeight",value:function(){var i=0,o=this;this.$tabContent&&this.$tabContent.find(".".concat(this.options.panelClass)).css("min-height","").each(function(){var t=a()(this),e=t.hasClass("".concat(o.options.panelActiveClass));e||t.css({visibility:"hidden",display:"block"});var n=this.getBoundingClientRect().height;e||t.css({visibility:"",display:""}),i=i<n?n:i}).css("min-height","".concat(i,"px"))}},{key:"_destroy",value:function(){this.$element.find(".".concat(this.options.linkClass)).off(".zf.tabs").hide().end().find(".".concat(this.options.panelClass)).hide(),this.options.matchHeight&&null!=this._setHeightMqHandler&&a()(window).off("changed.zf.mediaquery",this._setHeightMqHandler),this.options.deepLink&&a()(window).off("hashchange",this._checkDeepLink),this.onLoadListener&&a()(window).off(this.onLoadListener)}}])&&f(t.prototype,e),n&&f(t,n),o}();i.defaults={deepLink:!1,deepLinkSmudge:!1,deepLinkSmudgeDelay:300,deepLinkSmudgeOffset:0,updateHistory:!1,autoFocus:!1,wrapOnKeys:!0,matchHeight:!1,activeCollapse:!1,linkClass:"tabs-title",linkActiveClass:"is-active",panelClass:"tabs-panel",panelActiveClass:"is-active"}},"./js/foundation.toggler.js":function(t,e,n){"use strict";n.r(e),n.d(e,"Toggler",function(){return i});var e=n("jquery"),s=n.n(e),r=n("./js/foundation.util.motion.js"),a=n("./js/foundation.core.plugin.js"),l=n("./js/foundation.core.utils.js"),u=n("./js/foundation.util.triggers.js");function o(t){return(o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function c(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}function f(t,e){return(f=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function d(n){var i=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],function(){})),!0}catch(t){return!1}}();return function(){var t,e=h(n);return function(t,e){{if(e&&("object"===o(e)||"function"==typeof e))return e;if(void 0!==e)throw new TypeError("Derived constructors may only return object or undefined")}return function(t){if(void 0!==t)return t;throw new ReferenceError("this hasn't been initialised - super() hasn't been called")}(t)}(this,i?(t=h(this).constructor,Reflect.construct(e,arguments,t)):e.apply(this,arguments))}}function h(t){return(h=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}var i=function(){!function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&f(t,e)}(o,a["Plugin"]);var t,e,n,i=d(o);function o(){return function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,o),i.apply(this,arguments)}return t=o,(e=[{key:"_setup",value:function(t,e){this.$element=t,this.options=s.a.extend({},o.defaults,t.data(),e),this.className="",this.className="Toggler",u.Triggers.init(s.a),this._init(),this._events()}},{key:"_init",value:function(){var t,i=this.$element[0].id,e=s()('[data-open~="'.concat(i,'"], [data-close~="').concat(i,'"], [data-toggle~="').concat(i,'"]'));if(this.options.animate)t=this.options.animate.split(" "),this.animationIn=t[0],this.animationOut=t[1]||null,e.attr("aria-expanded",!this.$element.is(":hidden"));else{if("string"!=typeof(t=this.options.toggler)||!t.length)throw new Error("The 'toggler' option containing the target class is required, got \"".concat(t,'"'));this.className="."===t[0]?t.slice(1):t,e.attr("aria-expanded",this.$element.hasClass(this.className))}e.each(function(t,e){var n=s()(e),e=n.attr("aria-controls")||"";new RegExp("\\b".concat(Object(l.RegExpEscape)(i),"\\b")).test(e)||n.attr("aria-controls",e?"".concat(e," ").concat(i):i)})}},{key:"_events",value:function(){this.$element.off("toggle.zf.trigger").on("toggle.zf.trigger",this.toggle.bind(this))}},{key:"toggle",value:function(){this[this.options.animate?"_toggleAnimate":"_toggleClass"]()}},{key:"_toggleClass",value:function(){this.$element.toggleClass(this.className);var t=this.$element.hasClass(this.className);t?this.$element.trigger("on.zf.toggler"):this.$element.trigger("off.zf.toggler"),this._updateARIA(t),this.$element.find("[data-mutate]").trigger("mutateme.zf.trigger")}},{key:"_toggleAnimate",value:function(){var t=this;this.$element.is(":hidden")?r.Motion.animateIn(this.$element,this.animationIn,function(){t._updateARIA(!0),this.trigger("on.zf.toggler"),this.find("[data-mutate]").trigger("mutateme.zf.trigger")}):r.Motion.animateOut(this.$element,this.animationOut,function(){t._updateARIA(!1),this.trigger("off.zf.toggler"),this.find("[data-mutate]").trigger("mutateme.zf.trigger")})}},{key:"_updateARIA",value:function(t){var e=this.$element[0].id;s()('[data-open="'.concat(e,'"], [data-close="').concat(e,'"], [data-toggle="').concat(e,'"]')).attr({"aria-expanded":!!t})}},{key:"_destroy",value:function(){this.$element.off(".zf.toggler")}}])&&c(t.prototype,e),n&&c(t,n),o}();i.defaults={toggler:void 0,animate:!1}},"./js/foundation.tooltip.js":function(t,e,n){"use strict";n.r(e),n.d(e,"Tooltip",function(){return i});var e=n("jquery"),s=n.n(e),r=n("./js/foundation.core.utils.js"),a=n("./js/foundation.util.mediaQuery.js"),l=n("./js/foundation.util.triggers.js"),u=n("./js/foundation.positionable.js");function o(t){return(o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function c(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}function f(t,e,n){return(f="undefined"!=typeof Reflect&&Reflect.get?Reflect.get:function(t,e,n){t=function(t,e){for(;!Object.prototype.hasOwnProperty.call(t,e)&&null!==(t=p(t)););return t}(t,e);if(t){e=Object.getOwnPropertyDescriptor(t,e);return e.get?e.get.call(n):e.value}})(t,e,n||t)}function d(t,e){return(d=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function h(n){var i=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],function(){})),!0}catch(t){return!1}}();return function(){var t,e=p(n);return function(t,e){{if(e&&("object"===o(e)||"function"==typeof e))return e;if(void 0!==e)throw new TypeError("Derived constructors may only return object or undefined")}return function(t){if(void 0!==t)return t;throw new ReferenceError("this hasn't been initialised - super() hasn't been called")}(t)}(this,i?(t=p(this).constructor,Reflect.construct(e,arguments,t)):e.apply(this,arguments))}}function p(t){return(p=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}var i=function(){!function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&d(t,e)}(o,u["Positionable"]);var t,e,n,i=h(o);function o(){return function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,o),i.apply(this,arguments)}return t=o,(e=[{key:"_setup",value:function(t,e){this.$element=t,this.options=s.a.extend({},o.defaults,this.$element.data(),e),this.className="Tooltip",this.isActive=!1,this.isClick=!1,l.Triggers.init(s.a),this._init()}},{key:"_init",value:function(){a.MediaQuery._init();var t=this.$element.attr("aria-describedby")||Object(r.GetYoDigits)(6,"tooltip");this.options.tipText=this.options.tipText||this.$element.attr("title"),this.template=this.options.template?s()(this.options.template):this._buildTemplate(t),(this.options.allowHtml?this.template.appendTo(document.body).html(this.options.tipText):this.template.appendTo(document.body).text(this.options.tipText)).hide(),this.$element.attr({title:"","aria-describedby":t,"data-yeti-box":t,"data-toggle":t,"data-resize":t}).addClass(this.options.triggerClass),f(p(o.prototype),"_init",this).call(this),this._events()}},{key:"_getDefaultPosition",value:function(){var t=this.$element[0].className,t=(t=this.$element[0]instanceof SVGElement?t.baseVal:t).match(/\b(top|left|right|bottom)\b/g);return t?t[0]:"top"}},{key:"_getDefaultAlignment",value:function(){return"center"}},{key:"_getHOffset",value:function(){return"left"===this.position||"right"===this.position?this.options.hOffset+this.options.tooltipWidth:this.options.hOffset}},{key:"_getVOffset",value:function(){return"top"===this.position||"bottom"===this.position?this.options.vOffset+this.options.tooltipHeight:this.options.vOffset}},{key:"_buildTemplate",value:function(t){var e="".concat(this.options.tooltipClass," ").concat(this.options.templateClasses).trim();return s()("<div></div>").addClass(e).attr({role:"tooltip","aria-hidden":!0,"data-is-active":!1,"data-is-focus":!1,id:t})}},{key:"_setPosition",value:function(){f(p(o.prototype),"_setPosition",this).call(this,this.$element,this.template)}},{key:"show",value:function(){if("all"!==this.options.showOn&&!a.MediaQuery.is(this.options.showOn))return!1;this.template.css("visibility","hidden").show(),this._setPosition(),this.template.removeClass("top bottom left right").addClass(this.position),this.template.removeClass("align-top align-bottom align-left align-right align-center").addClass("align-"+this.alignment),this.$element.trigger("closeme.zf.tooltip",this.template.attr("id")),this.template.attr({"data-is-active":!0,"aria-hidden":!1}),this.isActive=!0,this.template.stop().hide().css("visibility","").fadeIn(this.options.fadeInDuration,function(){}),this.$element.trigger("show.zf.tooltip")}},{key:"hide",value:function(){var t=this;this.template.stop().attr({"aria-hidden":!0,"data-is-active":!1}).fadeOut(this.options.fadeOutDuration,function(){t.isActive=!1,t.isClick=!1}),this.$element.trigger("hide.zf.tooltip")}},{key:"_events",value:function(){var t=this,e="ontouchstart"in window||void 0!==window.ontouchstart,n=!1;e&&this.options.disableForTouch||(this.options.disableHover||this.$element.on("mouseenter.zf.tooltip",function(){t.isActive||(t.timeout=setTimeout(function(){t.show()},t.options.hoverDelay))}).on("mouseleave.zf.tooltip",Object(r.ignoreMousedisappear)(function(){clearTimeout(t.timeout),n&&(!t.isClick||t.options.clickOpen)||t.hide()})),e&&this.$element.on("tap.zf.tooltip touchend.zf.tooltip",function(){t.isActive?t.hide():t.show()}),this.options.clickOpen?this.$element.on("mousedown.zf.tooltip",function(){t.isClick||(t.isClick=!0,!t.options.disableHover&&t.$element.attr("tabindex")||t.isActive||t.show())}):this.$element.on("mousedown.zf.tooltip",function(){t.isClick=!0}),this.$element.on({"close.zf.trigger":this.hide.bind(this)}),this.$element.on("focus.zf.tooltip",function(){return n=!0,t.isClick?(t.options.clickOpen||(n=!1),!1):void t.show()}).on("focusout.zf.tooltip",function(){n=!1,t.isClick=!1,t.hide()}).on("resizeme.zf.trigger",function(){t.isActive&&t._setPosition()}))}},{key:"toggle",value:function(){this.isActive?this.hide():this.show()}},{key:"_destroy",value:function(){this.$element.attr("title",this.template.text()).off(".zf.trigger .zf.tooltip").removeClass(this.options.triggerClass).removeClass("top right left bottom").removeAttr("aria-describedby data-disable-hover data-resize data-toggle data-tooltip data-yeti-box"),this.template.remove()}}])&&c(t.prototype,e),n&&c(t,n),o}();i.defaults={hoverDelay:200,fadeInDuration:150,fadeOutDuration:150,disableHover:!1,disableForTouch:!1,templateClasses:"",tooltipClass:"tooltip",triggerClass:"has-tip",showOn:"small",template:"",tipText:"",touchCloseText:"Tap to close.",clickOpen:!0,position:"auto",alignment:"auto",allowOverlap:!1,allowBottomOverlap:!1,vOffset:0,hOffset:0,tooltipHeight:14,tooltipWidth:12,allowHtml:!1}},"./js/foundation.util.box.js":function(t,e,n){"use strict";n.r(e),n.d(e,"Box",function(){return i});var i={ImNotTouchingYou:function(t,e,n,i,o){return 0===s(t,e,n,i,o)},OverlapArea:s,GetDimensions:f,GetExplicitOffsets:function(t,e,n,i,o,s,r){var a,l,u=f(t),c=e?f(e):null;if(null!==c){switch(n){case"top":a=c.offset.top-(u.height+o);break;case"bottom":a=c.offset.top+c.height+o;break;case"left":l=c.offset.left-(u.width+s);break;case"right":l=c.offset.left+c.width+s}switch(n){case"top":case"bottom":switch(i){case"left":l=c.offset.left+s;break;case"right":l=c.offset.left-u.width+c.width-s;break;case"center":l=r?s:c.offset.left+c.width/2-u.width/2+s}break;case"right":case"left":switch(i){case"bottom":a=c.offset.top-o+c.height-u.height;break;case"top":a=c.offset.top+o;break;case"center":a=c.offset.top+o+c.height/2-u.height/2}}}return{top:a,left:l}}};function s(t,e,n,i,o){var s,r,a,t=f(t);return t=e?(s=(e=f(e)).height+e.offset.top-(t.offset.top+t.height),r=t.offset.top-e.offset.top,a=t.offset.left-e.offset.left,e.width+e.offset.left-(t.offset.left+t.width)):(s=t.windowDims.height+t.windowDims.offset.top-(t.offset.top+t.height),r=t.offset.top-t.windowDims.offset.top,a=t.offset.left-t.windowDims.offset.left,t.windowDims.width-(t.offset.left+t.width)),s=o?0:Math.min(s,0),r=Math.min(r,0),a=Math.min(a,0),t=Math.min(t,0),n?a+t:i?r+s:Math.sqrt(r*r+s*s+a*a+t*t)}function f(t){if((t=t.length?t[0]:t)===window||t===document)throw new Error("I'm sorry, Dave. I'm afraid I can't do that.");var e=t.getBoundingClientRect(),n=t.parentNode.getBoundingClientRect(),i=document.body.getBoundingClientRect(),o=window.pageYOffset,t=window.pageXOffset;return{width:e.width,height:e.height,offset:{top:e.top+o,left:e.left+t},parentDims:{width:n.width,height:n.height,offset:{top:n.top+o,left:n.left+t}},windowDims:{width:i.width,height:i.height,offset:{top:o,left:t}}}}},"./js/foundation.util.imageLoader.js":function(t,e,n){"use strict";n.r(e),n.d(e,"onImagesLoaded",function(){return i});var e=n("jquery"),o=n.n(e);function i(t,e){var n=t.length;function i(){0===--n&&e()}0===n&&e(),t.each(function(){var t,e;this.complete&&void 0!==this.naturalWidth?i():(t=new Image,e="load.zf.images error.zf.images",o()(t).one(e,function t(){o()(this).off(e,t),i()}),t.src=o()(this).attr("src"))})}},"./js/foundation.util.keyboard.js":function(t,e,n){"use strict";n.r(e),n.d(e,"Keyboard",function(){return u});var e=n("jquery"),o=n.n(e),s=n("./js/foundation.core.utils.js"),i={9:"TAB",13:"ENTER",27:"ESCAPE",32:"SPACE",35:"END",36:"HOME",37:"ARROW_LEFT",38:"ARROW_UP",39:"ARROW_RIGHT",40:"ARROW_DOWN"},r={};function a(t){return!!t&&t.find("a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, *[tabindex], *[contenteditable]").filter(function(){return!(!o()(this).is(":visible")||o()(this).attr("tabindex")<0)}).sort(function(t,e){if(o()(t).attr("tabindex")===o()(e).attr("tabindex"))return 0;var n=parseInt(o()(t).attr("tabindex"),10),i=parseInt(o()(e).attr("tabindex"),10);return void 0===o()(t).attr("tabindex")&&0<i?1:void 0===o()(e).attr("tabindex")&&0<n?-1:0===n&&0<i?1:0===i&&0<n||n<i?-1:i<n?1:void 0})}function l(t){var e=(e=i[t.which||t.keyCode]||String.fromCharCode(t.which).toUpperCase()).replace(/\W+/,"");return t.shiftKey&&(e="SHIFT_".concat(e)),t.ctrlKey&&(e="CTRL_".concat(e)),e=(e=t.altKey?"ALT_".concat(e):e).replace(/_$/,"")}var u={keys:function(t){var e,n={};for(e in t)t.hasOwnProperty(e)&&(n[t[e]]=t[e]);return n}(i),parseKey:l,handleKey:function(t,e,n){var i=r[e],e=this.parseKey(t);if(!i)return console.warn("Component not defined!");!0!==t.zfIsKeyHandled&&((e=n[(void 0===i.ltr?i:Object(s.rtl)()?o.a.extend({},i.ltr,i.rtl):o.a.extend({},i.rtl,i.ltr))[e]])&&"function"==typeof e?(e=e.apply(),t.zfIsKeyHandled=!0,!n.handled&&"function"!=typeof n.handled||n.handled(e)):!n.unhandled&&"function"!=typeof n.unhandled||n.unhandled())},findFocusable:a,register:function(t,e){r[t]=e},trapFocus:function(t){var e=a(t),n=e.eq(0),i=e.eq(-1);t.on("keydown.zf.trapfocus",function(t){t.target===i[0]&&"TAB"===l(t)?(t.preventDefault(),n.focus()):t.target===n[0]&&"SHIFT_TAB"===l(t)&&(t.preventDefault(),i.focus())})},releaseFocus:function(t){t.off("keydown.zf.trapfocus")}}},"./js/foundation.util.mediaQuery.js":function(t,e,n){"use strict";n.r(e),n.d(e,"MediaQuery",function(){return c});var i,o,s,e=n("jquery"),r=n.n(e);function a(t){return(a="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function l(t,e){return function(t){if(Array.isArray(t))return t}(t)||function(t,e){var n=null==t?null:"undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"];if(null!=n){var i,o,s=[],r=!0,a=!1;try{for(n=n.call(t);!(r=(i=n.next()).done)&&(s.push(i.value),!e||s.length!==e);r=!0);}catch(t){a=!0,o=t}finally{try{r||null==n.return||n.return()}finally{if(a)throw o}}return s}}(t,e)||function(t,e){if(t){if("string"==typeof t)return u(t,e);var n=Object.prototype.toString.call(t).slice(8,-1);return"Map"===(n="Object"===n&&t.constructor?t.constructor.name:n)||"Set"===n?Array.from(t):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?u(t,e):void 0}}(t,e)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function u(t,e){(null==e||e>t.length)&&(e=t.length);for(var n=0,i=new Array(e);n<e;n++)i[n]=t[n];return i}window.matchMedia||(window.matchMedia=((s=window.styleMedia||window.media)||(i=document.createElement("style"),e=document.getElementsByTagName("script")[0],o=null,i.type="text/css",i.id="matchmediajs-test",e?e.parentNode.insertBefore(i,e):document.head.appendChild(i),o="getComputedStyle"in window&&window.getComputedStyle(i,null)||i.currentStyle,s={matchMedium:function(t){t="@media "+t+"{ #matchmediajs-test { width: 1px; } }";return i.styleSheet?i.styleSheet.cssText=t:i.textContent=t,"1px"===o.width}}),function(t){return{matches:s.matchMedium(t||"all"),media:t||"all"}}));var c={queries:[],current:"",_init:function(){if(!0===this.isInitialized)return this;this.isInitialized=!0;r()("meta.foundation-mq").length||r()('<meta class="foundation-mq" name="foundation-mq" content>').appendTo(document.head);var t,e,n,i=r()(".foundation-mq").css("font-family");for(n in e={},t="string"==typeof(i=i)&&(i=i.trim().slice(1,-1))?e=i.split("&").reduce(function(t,e){var n=e.replace(/\+/g," ").split("="),e=n[0],n=n[1],e=decodeURIComponent(e),n=void 0===n?null:decodeURIComponent(n);return t.hasOwnProperty(e)?Array.isArray(t[e])?t[e].push(n):t[e]=[t[e],n]:t[e]=n,t},{}):e,this.queries=[],t)t.hasOwnProperty(n)&&this.queries.push({name:n,value:"only screen and (min-width: ".concat(t[n],")")});this.current=this._getCurrentSize(),this._watcher()},_reInit:function(){this.isInitialized=!1,this._init()},atLeast:function(t){t=this.get(t);return!!t&&window.matchMedia(t).matches},only:function(t){return t===this._getCurrentSize()},upTo:function(t){t=this.next(t);return!t||!this.atLeast(t)},is:function(t){var e=l(t.trim().split(" ").filter(function(t){return!!t.length}),2),n=e[0],e=e[1],e=void 0===e?"":e;if("only"===e)return this.only(n);if(!e||"up"===e)return this.atLeast(n);if("down"===e)return this.upTo(n);throw new Error('\n      Invalid breakpoint passed to MediaQuery.is().\n      Expected a breakpoint name formatted like "<size> <modifier>", got "'.concat(t,'".\n    '))},get:function(t){for(var e in this.queries)if(this.queries.hasOwnProperty(e)){e=this.queries[e];if(t===e.name)return e.value}return null},next:function(e){var n=this,t=this.queries.findIndex(function(t){return n._getQueryName(t)===e});if(-1===t)throw new Error('\n        Unknown breakpoint "'.concat(e,'" passed to MediaQuery.next().\n        Ensure it is present in your Sass "$breakpoints" setting.\n      '));t=this.queries[t+1];return t?t.name:null},_getQueryName:function(t){if("string"==typeof t)return t;if("object"===a(t))return t.name;throw new TypeError('\n      Invalid value passed to MediaQuery._getQueryName().\n      Expected a breakpoint name (String) or a breakpoint query (Object), got "'.concat(t,'" (').concat(a(t),")\n    "))},_getCurrentSize:function(){for(var t,e=0;e<this.queries.length;e++){var n=this.queries[e];window.matchMedia(n.value).matches&&(t=n)}return t&&this._getQueryName(t)},_watcher:function(){var n=this;r()(window).on("resize.zf.trigger",function(){var t=n._getCurrentSize(),e=n.current;t!==e&&(n.current=t,r()(window).trigger("changed.zf.mediaquery",[t,e]))})}}},"./js/foundation.util.motion.js":function(t,e,n){"use strict";n.r(e),n.d(e,"Move",function(){return o}),n.d(e,"Motion",function(){return i});var e=n("jquery"),a=n.n(e),l=n("./js/foundation.core.utils.js"),u=["mui-enter","mui-leave"],c=["mui-enter-active","mui-leave-active"],i={animateIn:function(t,e,n){s(!0,t,e,n)},animateOut:function(t,e,n){s(!1,t,e,n)}};function o(n,i,o){var s,r,a=null;if(0===n)return o.apply(i),void i.trigger("finished.zf.animate",[i]).triggerHandler("finished.zf.animate",[i]);s=window.requestAnimationFrame(function t(e){r=e-(a=a||e),o.apply(i),r<n?s=window.requestAnimationFrame(t,i):(window.cancelAnimationFrame(s),i.trigger("finished.zf.animate",[i]).triggerHandler("finished.zf.animate",[i]))})}function s(t,e,n,i){var o,s;function r(){e[0].style.transitionDuration=0,e.removeClass("".concat(o," ").concat(s," ").concat(n))}(e=a()(e).eq(0)).length&&(o=t?u[0]:u[1],s=t?c[0]:c[1],r(),e.addClass(n).css("transition","none"),requestAnimationFrame(function(){e.addClass(o),t&&e.show()}),requestAnimationFrame(function(){e[0].offsetWidth,e.css("transition","").addClass(s)}),e.one(Object(l.transitionend)(e),function(){t||e.hide();r(),i&&i.apply(e)}))}},"./js/foundation.util.nest.js":function(t,e,n){"use strict";n.r(e),n.d(e,"Nest",function(){return i});var e=n("jquery"),l=n.n(e),i={Feather:function(t){var i=1<arguments.length&&void 0!==arguments[1]?arguments[1]:"zf";t.attr("role","menubar"),t.find("a").attr({role:"menuitem"});var t=t.find("li").attr({role:"none"}),o="is-".concat(i,"-submenu"),s="".concat(o,"-item"),r="is-".concat(i,"-submenu-parent"),a="accordion"!==i;t.each(function(){var t,e=l()(this),n=e.children("ul");n.length&&(e.addClass(r),a&&((t=e.children("a:first")).attr({"aria-haspopup":!0,"aria-label":t.attr("aria-label")||t.text()}),"drilldown"===i&&e.attr({"aria-expanded":!1})),n.addClass("submenu ".concat(o)).attr({"data-submenu":"",role:"menubar"}),"drilldown"===i&&n.attr({"aria-hidden":!0})),e.parent("[data-submenu]").length&&e.addClass("is-submenu-item ".concat(s))})},Burn:function(t,e){var n="is-".concat(e,"-submenu"),i="".concat(n,"-item"),e="is-".concat(e,"-submenu-parent");t.find(">li, > li > ul, .menu, .menu > li, [data-submenu] > li").removeClass("".concat(n," ").concat(i," ").concat(e," is-submenu-item submenu is-active")).removeAttr("data-submenu").css("display","")}}},"./js/foundation.util.timer.js":function(t,e,n){"use strict";function i(e,t,n){var i,o,s=this,r=t.duration,a=Object.keys(e.data())[0]||"timer",l=-1;this.isPaused=!1,this.restart=function(){l=-1,clearTimeout(o),this.start()},this.start=function(){this.isPaused=!1,clearTimeout(o),l=l<=0?r:l,e.data("paused",!1),i=Date.now(),o=setTimeout(function(){t.infinite&&s.restart(),n&&"function"==typeof n&&n()},l),e.trigger("timerstart.zf.".concat(a))},this.pause=function(){this.isPaused=!0,clearTimeout(o),e.data("paused",!0);var t=Date.now();l-=t-i,e.trigger("timerpaused.zf.".concat(a))}}n.r(e),n.d(e,"Timer",function(){return i})},"./js/foundation.util.touch.js":function(t,e,n){"use strict";n.r(e),n.d(e,"Touch",function(){return u});var e=n("jquery"),o=n.n(e);function s(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}var i,r,a,l,u={},c=!1,f=!1;function d(t){this.removeEventListener("touchmove",h),this.removeEventListener("touchend",d),f||(t=o.a.Event("tap",l||t),o()(this).trigger(t)),l=null,f=c=!1}function h(t){var e,n;!0===o.a.spotSwipe.preventDefault&&t.preventDefault(),c&&(e=t.touches[0].pageX,e=i-e,f=!0,a=(new Date).getTime()-r,(n=Math.abs(e)>=o.a.spotSwipe.moveThreshold&&a<=o.a.spotSwipe.timeThreshold?0<e?"left":"right":n)&&(t.preventDefault(),d.apply(this,arguments),o()(this).trigger(o.a.Event("swipe",Object.assign({},t)),n).trigger(o.a.Event("swipe".concat(n),Object.assign({},t)))))}function p(t){1===t.touches.length&&(i=t.touches[0].pageX,l=t,f=!(c=!0),r=(new Date).getTime(),this.addEventListener("touchmove",h,{passive:!0===o.a.spotSwipe.preventDefault}),this.addEventListener("touchend",d,!1))}function m(){this.addEventListener&&this.addEventListener("touchstart",p,{passive:!0})}var v=function(){function t(){!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t),this.version="1.0.0",this.enabled="ontouchstart"in document.documentElement,this.preventDefault=!1,this.moveThreshold=75,this.timeThreshold=200,this._init()}var e,n,i;return e=t,(n=[{key:"_init",value:function(){o.a.event.special.swipe={setup:m},o.a.event.special.tap={setup:m},o.a.each(["left","up","down","right"],function(){o.a.event.special["swipe".concat(this)]={setup:function(){o()(this).on("swipe",o.a.noop)}}})}}])&&s(e.prototype,n),i&&s(e,i),t}();u.setupSpotSwipe=function(){o.a.spotSwipe=new v(o.a)},u.setupTouchHandler=function(){o.a.fn.addTouch=function(){this.each(function(t,e){o()(e).bind("touchstart touchmove touchend touchcancel",function(t){n(t)})});var n=function(t){var e,n=t.changedTouches[0],t={touchstart:"mousedown",touchmove:"mousemove",touchend:"mouseup"}[t.type];"MouseEvent"in window&&"function"==typeof window.MouseEvent?e=new window.MouseEvent(t,{bubbles:!0,cancelable:!0,screenX:n.screenX,screenY:n.screenY,clientX:n.clientX,clientY:n.clientY}):(e=document.createEvent("MouseEvent")).initMouseEvent(t,!0,!0,window,1,n.screenX,n.screenY,n.clientX,n.clientY,!1,!1,!1,!1,0,null),n.target.dispatchEvent(e)}}},u.init=function(){void 0===o.a.spotSwipe&&(u.setupSpotSwipe(o.a),u.setupTouchHandler(o.a))}},"./js/foundation.util.triggers.js":function(t,e,n){"use strict";n.r(e),n.d(e,"Triggers",function(){return u});var e=n("jquery"),s=n.n(e),i=n("./js/foundation.core.utils.js"),o=n("./js/foundation.util.motion.js");function r(t){return(r="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function a(e,n){e.data(n).split(" ").forEach(function(t){s()("#".concat(t))["close"===n?"trigger":"triggerHandler"]("".concat(n,".zf.trigger"),[e])})}var l=function(){for(var t=["WebKit","Moz","O","Ms",""],e=0;e<t.length;e++)if("".concat(t[e],"MutationObserver")in window)return window["".concat(t[e],"MutationObserver")];return!1}(),u={Listeners:{Basic:{},Global:{}},Initializers:{}};function c(t,e,n){var i,o=Array.prototype.slice.call(arguments,3);s()(window).on(e,function(){i&&clearTimeout(i),i=setTimeout(function(){n.apply(null,o)},t||10)})}u.Listeners.Basic={openListener:function(){a(s()(this),"open")},closeListener:function(){s()(this).data("close")?a(s()(this),"close"):s()(this).trigger("close.zf.trigger")},toggleListener:function(){s()(this).data("toggle")?a(s()(this),"toggle"):s()(this).trigger("toggle.zf.trigger")},closeableListener:function(t){var e=s()(this).data("closable");t.stopPropagation(),""!==e?o.Motion.animateOut(s()(this),e,function(){s()(this).trigger("closed.zf")}):s()(this).fadeOut().trigger("closed.zf")},toggleFocusListener:function(){var t=s()(this).data("toggle-focus");s()("#".concat(t)).triggerHandler("toggle.zf.trigger",[s()(this)])}},u.Initializers.addOpenListener=function(t){t.off("click.zf.trigger",u.Listeners.Basic.openListener),t.on("click.zf.trigger","[data-open]",u.Listeners.Basic.openListener)},u.Initializers.addCloseListener=function(t){t.off("click.zf.trigger",u.Listeners.Basic.closeListener),t.on("click.zf.trigger","[data-close]",u.Listeners.Basic.closeListener)},u.Initializers.addToggleListener=function(t){t.off("click.zf.trigger",u.Listeners.Basic.toggleListener),t.on("click.zf.trigger","[data-toggle]",u.Listeners.Basic.toggleListener)},u.Initializers.addCloseableListener=function(t){t.off("close.zf.trigger",u.Listeners.Basic.closeableListener),t.on("close.zf.trigger","[data-closeable], [data-closable]",u.Listeners.Basic.closeableListener)},u.Initializers.addToggleFocusListener=function(t){t.off("focus.zf.trigger blur.zf.trigger",u.Listeners.Basic.toggleFocusListener),t.on("focus.zf.trigger blur.zf.trigger","[data-toggle-focus]",u.Listeners.Basic.toggleFocusListener)},u.Listeners.Global={resizeListener:function(t){l||t.each(function(){s()(this).triggerHandler("resizeme.zf.trigger")}),t.attr("data-events","resize")},scrollListener:function(t){l||t.each(function(){s()(this).triggerHandler("scrollme.zf.trigger")}),t.attr("data-events","scroll")},closeMeListener:function(t,e){t=t.namespace.split(".")[0];s()("[data-".concat(t,"]")).not('[data-yeti-box="'.concat(e,'"]')).each(function(){var t=s()(this);t.triggerHandler("close.zf.trigger",[t])})}},u.Initializers.addClosemeListener=function(t){var e=s()("[data-yeti-box]"),n=["dropdown","tooltip","reveal"];t&&("string"==typeof t?n.push(t):"object"===r(t)&&"string"==typeof t[0]?n=n.concat(t):console.error("Plugin names must be strings")),e.length&&(n=n.map(function(t){return"closeme.zf.".concat(t)}).join(" "),s()(window).off(n).on(n,u.Listeners.Global.closeMeListener))},u.Initializers.addResizeListener=function(t){var e=s()("[data-resize]");e.length&&c(t,"resize.zf.trigger",u.Listeners.Global.resizeListener,e)},u.Initializers.addScrollListener=function(t){var e=s()("[data-scroll]");e.length&&c(t,"scroll.zf.trigger",u.Listeners.Global.scrollListener,e)},u.Initializers.addMutationEventsListener=function(t){if(!l)return!1;function e(t){var e=s()(t[0].target);switch(t[0].type){case"attributes":"scroll"===e.attr("data-events")&&"data-events"===t[0].attributeName&&e.triggerHandler("scrollme.zf.trigger",[e,window.pageYOffset]),"resize"===e.attr("data-events")&&"data-events"===t[0].attributeName&&e.triggerHandler("resizeme.zf.trigger",[e]),"style"===t[0].attributeName&&(e.closest("[data-mutate]").attr("data-events","mutate"),e.closest("[data-mutate]").triggerHandler("mutateme.zf.trigger",[e.closest("[data-mutate]")]));break;case"childList":e.closest("[data-mutate]").attr("data-events","mutate"),e.closest("[data-mutate]").triggerHandler("mutateme.zf.trigger",[e.closest("[data-mutate]")]);break;default:return!1}}var n=t.find("[data-resize], [data-scroll], [data-mutate]");if(n.length)for(var i=0;i<=n.length-1;i++)new l(e).observe(n[i],{attributes:!0,childList:!0,characterData:!1,subtree:!0,attributeFilter:["data-events","style"]})},u.Initializers.addSimpleListeners=function(){var t=s()(document);u.Initializers.addOpenListener(t),u.Initializers.addCloseListener(t),u.Initializers.addToggleListener(t),u.Initializers.addCloseableListener(t),u.Initializers.addToggleFocusListener(t)},u.Initializers.addGlobalListeners=function(){var t=s()(document);u.Initializers.addMutationEventsListener(t),u.Initializers.addResizeListener(250),u.Initializers.addScrollListener(),u.Initializers.addClosemeListener()},u.init=function(t,e){Object(i.onLoad)(s()(window),function(){!0!==s.a.triggersInitialized&&(u.Initializers.addSimpleListeners(),u.Initializers.addGlobalListeners(),s.a.triggersInitialized=!0)}),e&&(e.Triggers=u,e.IHearYou=u.Initializers.addGlobalListeners)}},0:function(t,e,n){t.exports=n("./js/entries/foundation.js")},jquery:function(t,e){t.exports=n}},s={},o.m=i,o.c=s,o.d=function(t,e,n){o.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:n})},o.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},o.t=function(e,t){if(1&t&&(e=o(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(o.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var i in e)o.d(n,i,function(t){return e[t]}.bind(null,i));return n},o.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return o.d(e,"a",e),e},o.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},o.p="",o(o.s=0);function o(t){if(s[t])return s[t].exports;var e=s[t]={i:t,l:!1,exports:{}};return i[t].call(e.exports,e,e.exports,o),e.l=!0,e.exports}var i,s});
//# sourceMappingURL=foundation.min.js.map

/*! Magnific Popup - v1.1.0 - 2016-02-20
* http://dimsemenov.com/plugins/magnific-popup/
* Copyright (c) 2016 Dmitry Semenov; */
;(function (factory) { 
if (typeof define === 'function' && define.amd) { 
 // AMD. Register as an anonymous module. 
 define(['jquery'], factory); 
 } else if (typeof exports === 'object') { 
 // Node/CommonJS 
 factory(require('jquery')); 
 } else { 
 // Browser globals 
 factory(window.jQuery || window.Zepto); 
 } 
 }(function($) { 

/*>>core*/
/**
 * 
 * Magnific Popup Core JS file
 * 
 */


/**
 * Private static constants
 */
var CLOSE_EVENT = 'Close',
	BEFORE_CLOSE_EVENT = 'BeforeClose',
	AFTER_CLOSE_EVENT = 'AfterClose',
	BEFORE_APPEND_EVENT = 'BeforeAppend',
	MARKUP_PARSE_EVENT = 'MarkupParse',
	OPEN_EVENT = 'Open',
	CHANGE_EVENT = 'Change',
	NS = 'mfp',
	EVENT_NS = '.' + NS,
	READY_CLASS = 'mfp-ready',
	REMOVING_CLASS = 'mfp-removing',
	PREVENT_CLOSE_CLASS = 'mfp-prevent-close';


/**
 * Private vars 
 */
/*jshint -W079 */
var mfp, // As we have only one instance of MagnificPopup object, we define it locally to not to use 'this'
	MagnificPopup = function(){},
	_isJQ = !!(window.jQuery),
	_prevStatus,
	_window = $(window),
	_document,
	_prevContentType,
	_wrapClasses,
	_currPopupType;


/**
 * Private functions
 */
var _mfpOn = function(name, f) {
		mfp.ev.on(NS + name + EVENT_NS, f);
	},
	_getEl = function(className, appendTo, html, raw) {
		var el = document.createElement('div');
		el.className = 'mfp-'+className;
		if(html) {
			el.innerHTML = html;
		}
		if(!raw) {
			el = $(el);
			if(appendTo) {
				el.appendTo(appendTo);
			}
		} else if(appendTo) {
			appendTo.appendChild(el);
		}
		return el;
	},
	_mfpTrigger = function(e, data) {
		mfp.ev.triggerHandler(NS + e, data);

		if(mfp.st.callbacks) {
			// converts "mfpEventName" to "eventName" callback and triggers it if it's present
			e = e.charAt(0).toLowerCase() + e.slice(1);
			if(mfp.st.callbacks[e]) {
				mfp.st.callbacks[e].apply(mfp, $.isArray(data) ? data : [data]);
			}
		}
	},
	_getCloseBtn = function(type) {
		if(type !== _currPopupType || !mfp.currTemplate.closeBtn) {
			mfp.currTemplate.closeBtn = $( mfp.st.closeMarkup.replace('%title%', mfp.st.tClose ) );
			_currPopupType = type;
		}
		return mfp.currTemplate.closeBtn;
	},
	// Initialize Magnific Popup only when called at least once
	_checkInstance = function() {
		if(!$.magnificPopup.instance) {
			/*jshint -W020 */
			mfp = new MagnificPopup();
			mfp.init();
			$.magnificPopup.instance = mfp;
		}
	},
	// CSS transition detection, http://stackoverflow.com/questions/7264899/detect-css-transitions-using-javascript-and-without-modernizr
	supportsTransitions = function() {
		var s = document.createElement('p').style, // 's' for style. better to create an element if body yet to exist
			v = ['ms','O','Moz','Webkit']; // 'v' for vendor

		if( s['transition'] !== undefined ) {
			return true; 
		}
			
		while( v.length ) {
			if( v.pop() + 'Transition' in s ) {
				return true;
			}
		}
				
		return false;
	};



/**
 * Public functions
 */
MagnificPopup.prototype = {

	constructor: MagnificPopup,

	/**
	 * Initializes Magnific Popup plugin. 
	 * This function is triggered only once when $.fn.magnificPopup or $.magnificPopup is executed
	 */
	init: function() {
		var appVersion = navigator.appVersion;
		mfp.isLowIE = mfp.isIE8 = document.all && !document.addEventListener;
		mfp.isAndroid = (/android/gi).test(appVersion);
		mfp.isIOS = (/iphone|ipad|ipod/gi).test(appVersion);
		mfp.supportsTransition = supportsTransitions();

		// We disable fixed positioned lightbox on devices that don't handle it nicely.
		// If you know a better way of detecting this - let me know.
		mfp.probablyMobile = (mfp.isAndroid || mfp.isIOS || /(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent) );
		_document = $(document);

		mfp.popupsCache = {};
	},

	/**
	 * Opens popup
	 * @param  data [description]
	 */
	open: function(data) {

		var i;

		if(data.isObj === false) { 
			// convert jQuery collection to array to avoid conflicts later
			mfp.items = data.items.toArray();

			mfp.index = 0;
			var items = data.items,
				item;
			for(i = 0; i < items.length; i++) {
				item = items[i];
				if(item.parsed) {
					item = item.el[0];
				}
				if(item === data.el[0]) {
					mfp.index = i;
					break;
				}
			}
		} else {
			mfp.items = $.isArray(data.items) ? data.items : [data.items];
			mfp.index = data.index || 0;
		}

		// if popup is already opened - we just update the content
		if(mfp.isOpen) {
			mfp.updateItemHTML();
			return;
		}
		
		mfp.types = []; 
		_wrapClasses = '';
		if(data.mainEl && data.mainEl.length) {
			mfp.ev = data.mainEl.eq(0);
		} else {
			mfp.ev = _document;
		}

		if(data.key) {
			if(!mfp.popupsCache[data.key]) {
				mfp.popupsCache[data.key] = {};
			}
			mfp.currTemplate = mfp.popupsCache[data.key];
		} else {
			mfp.currTemplate = {};
		}



		mfp.st = $.extend(true, {}, $.magnificPopup.defaults, data ); 
		mfp.fixedContentPos = mfp.st.fixedContentPos === 'auto' ? !mfp.probablyMobile : mfp.st.fixedContentPos;

		if(mfp.st.modal) {
			mfp.st.closeOnContentClick = false;
			mfp.st.closeOnBgClick = false;
			mfp.st.showCloseBtn = false;
			mfp.st.enableEscapeKey = false;
		}
		

		// Building markup
		// main containers are created only once
		if(!mfp.bgOverlay) {

			// Dark overlay
			mfp.bgOverlay = _getEl('bg').on('click'+EVENT_NS, function() {
				mfp.close();
			});

			mfp.wrap = _getEl('wrap').attr('tabindex', -1).on('click'+EVENT_NS, function(e) {
				if(mfp._checkIfClose(e.target)) {
					mfp.close();
				}
			});

			mfp.container = _getEl('container', mfp.wrap);
		}

		mfp.contentContainer = _getEl('content');
		if(mfp.st.preloader) {
			mfp.preloader = _getEl('preloader', mfp.container, mfp.st.tLoading);
		}


		// Initializing modules
		var modules = $.magnificPopup.modules;
		for(i = 0; i < modules.length; i++) {
			var n = modules[i];
			n = n.charAt(0).toUpperCase() + n.slice(1);
			mfp['init'+n].call(mfp);
		}
		_mfpTrigger('BeforeOpen');


		if(mfp.st.showCloseBtn) {
			// Close button
			if(!mfp.st.closeBtnInside) {
				mfp.wrap.append( _getCloseBtn() );
			} else {
				_mfpOn(MARKUP_PARSE_EVENT, function(e, template, values, item) {
					values.close_replaceWith = _getCloseBtn(item.type);
				});
				_wrapClasses += ' mfp-close-btn-in';
			}
		}

		if(mfp.st.alignTop) {
			_wrapClasses += ' mfp-align-top';
		}

	

		if(mfp.fixedContentPos) {
			mfp.wrap.css({
				overflow: mfp.st.overflowY,
				overflowX: 'hidden',
				overflowY: mfp.st.overflowY
			});
		} else {
			mfp.wrap.css({ 
				top: _window.scrollTop(),
				position: 'absolute'
			});
		}
		if( mfp.st.fixedBgPos === false || (mfp.st.fixedBgPos === 'auto' && !mfp.fixedContentPos) ) {
			mfp.bgOverlay.css({
				height: _document.height(),
				position: 'absolute'
			});
		}

		

		if(mfp.st.enableEscapeKey) {
			// Close on ESC key
			_document.on('keyup' + EVENT_NS, function(e) {
				if(e.keyCode === 27) {
					mfp.close();
				}
			});
		}

		_window.on('resize' + EVENT_NS, function() {
			mfp.updateSize();
		});


		if(!mfp.st.closeOnContentClick) {
			_wrapClasses += ' mfp-auto-cursor';
		}
		
		if(_wrapClasses)
			mfp.wrap.addClass(_wrapClasses);


		// this triggers recalculation of layout, so we get it once to not to trigger twice
		var windowHeight = mfp.wH = _window.height();

		
		var windowStyles = {};

		if( mfp.fixedContentPos ) {
            if(mfp._hasScrollBar(windowHeight)){
                var s = mfp._getScrollbarSize();
                if(s) {
                    windowStyles.marginRight = s;
                }
            }
        }

		if(mfp.fixedContentPos) {
			if(!mfp.isIE7) {
				windowStyles.overflow = 'hidden';
			} else {
				// ie7 double-scroll bug
				$('body, html').css('overflow', 'hidden');
			}
		}

		
		
		var classesToadd = mfp.st.mainClass;
		if(mfp.isIE7) {
			classesToadd += ' mfp-ie7';
		}
		if(classesToadd) {
			mfp._addClassToMFP( classesToadd );
		}

		// add content
		mfp.updateItemHTML();

		_mfpTrigger('BuildControls');

		// remove scrollbar, add margin e.t.c
		$('html').css(windowStyles);
		
		// add everything to DOM
		mfp.bgOverlay.add(mfp.wrap).prependTo( mfp.st.prependTo || $(document.body) );

		// Save last focused element
		mfp._lastFocusedEl = document.activeElement;
		
		// Wait for next cycle to allow CSS transition
		setTimeout(function() {
			
			if(mfp.content) {
				mfp._addClassToMFP(READY_CLASS);
				mfp._setFocus();
			} else {
				// if content is not defined (not loaded e.t.c) we add class only for BG
				mfp.bgOverlay.addClass(READY_CLASS);
			}
			
			// Trap the focus in popup
			_document.on('focusin' + EVENT_NS, mfp._onFocusIn);

		}, 16);

		mfp.isOpen = true;
		mfp.updateSize(windowHeight);
		_mfpTrigger(OPEN_EVENT);

		return data;
	},

	/**
	 * Closes the popup
	 */
	close: function() {
		if(!mfp.isOpen) return;
		_mfpTrigger(BEFORE_CLOSE_EVENT);

		mfp.isOpen = false;
		// for CSS3 animation
		if(mfp.st.removalDelay && !mfp.isLowIE && mfp.supportsTransition )  {
			mfp._addClassToMFP(REMOVING_CLASS);
			setTimeout(function() {
				mfp._close();
			}, mfp.st.removalDelay);
		} else {
			mfp._close();
		}
	},

	/**
	 * Helper for close() function
	 */
	_close: function() {
		_mfpTrigger(CLOSE_EVENT);

		var classesToRemove = REMOVING_CLASS + ' ' + READY_CLASS + ' ';

		mfp.bgOverlay.detach();
		mfp.wrap.detach();
		mfp.container.empty();

		if(mfp.st.mainClass) {
			classesToRemove += mfp.st.mainClass + ' ';
		}

		mfp._removeClassFromMFP(classesToRemove);

		if(mfp.fixedContentPos) {
			var windowStyles = {marginRight: ''};
			if(mfp.isIE7) {
				$('body, html').css('overflow', '');
			} else {
				windowStyles.overflow = '';
			}
			$('html').css(windowStyles);
		}
		
		_document.off('keyup' + EVENT_NS + ' focusin' + EVENT_NS);
		mfp.ev.off(EVENT_NS);

		// clean up DOM elements that aren't removed
		mfp.wrap.attr('class', 'mfp-wrap').removeAttr('style');
		mfp.bgOverlay.attr('class', 'mfp-bg');
		mfp.container.attr('class', 'mfp-container');

		// remove close button from target element
		if(mfp.st.showCloseBtn &&
		(!mfp.st.closeBtnInside || mfp.currTemplate[mfp.currItem.type] === true)) {
			if(mfp.currTemplate.closeBtn)
				mfp.currTemplate.closeBtn.detach();
		}


		if(mfp.st.autoFocusLast && mfp._lastFocusedEl) {
			$(mfp._lastFocusedEl).focus(); // put tab focus back
		}
		mfp.currItem = null;	
		mfp.content = null;
		mfp.currTemplate = null;
		mfp.prevHeight = 0;

		_mfpTrigger(AFTER_CLOSE_EVENT);
	},
	
	updateSize: function(winHeight) {

		if(mfp.isIOS) {
			// fixes iOS nav bars https://github.com/dimsemenov/Magnific-Popup/issues/2
			var zoomLevel = document.documentElement.clientWidth / window.innerWidth;
			var height = window.innerHeight * zoomLevel;
			mfp.wrap.css('height', height);
			mfp.wH = height;
		} else {
			mfp.wH = winHeight || _window.height();
		}
		// Fixes #84: popup incorrectly positioned with position:relative on body
		if(!mfp.fixedContentPos) {
			mfp.wrap.css('height', mfp.wH);
		}

		_mfpTrigger('Resize');

	},

	/**
	 * Set content of popup based on current index
	 */
	updateItemHTML: function() {
		var item = mfp.items[mfp.index];

		// Detach and perform modifications
		mfp.contentContainer.detach();

		if(mfp.content)
			mfp.content.detach();

		if(!item.parsed) {
			item = mfp.parseEl( mfp.index );
		}

		var type = item.type;

		_mfpTrigger('BeforeChange', [mfp.currItem ? mfp.currItem.type : '', type]);
		// BeforeChange event works like so:
		// _mfpOn('BeforeChange', function(e, prevType, newType) { });

		mfp.currItem = item;

		if(!mfp.currTemplate[type]) {
			var markup = mfp.st[type] ? mfp.st[type].markup : false;

			// allows to modify markup
			_mfpTrigger('FirstMarkupParse', markup);

			if(markup) {
				mfp.currTemplate[type] = $(markup);
			} else {
				// if there is no markup found we just define that template is parsed
				mfp.currTemplate[type] = true;
			}
		}

		if(_prevContentType && _prevContentType !== item.type) {
			mfp.container.removeClass('mfp-'+_prevContentType+'-holder');
		}

		var newContent = mfp['get' + type.charAt(0).toUpperCase() + type.slice(1)](item, mfp.currTemplate[type]);
		mfp.appendContent(newContent, type);

		item.preloaded = true;

		_mfpTrigger(CHANGE_EVENT, item);
		_prevContentType = item.type;

		// Append container back after its content changed
		mfp.container.prepend(mfp.contentContainer);

		_mfpTrigger('AfterChange');
	},


	/**
	 * Set HTML content of popup
	 */
	appendContent: function(newContent, type) {
		mfp.content = newContent;

		if(newContent) {
			if(mfp.st.showCloseBtn && mfp.st.closeBtnInside &&
				mfp.currTemplate[type] === true) {
				// if there is no markup, we just append close button element inside
				if(!mfp.content.find('.mfp-close').length) {
					mfp.content.append(_getCloseBtn());
				}
			} else {
				mfp.content = newContent;
			}
		} else {
			mfp.content = '';
		}

		_mfpTrigger(BEFORE_APPEND_EVENT);
		mfp.container.addClass('mfp-'+type+'-holder');

		mfp.contentContainer.append(mfp.content);
	},


	/**
	 * Creates Magnific Popup data object based on given data
	 * @param  {int} index Index of item to parse
	 */
	parseEl: function(index) {
		var item = mfp.items[index],
			type;

		if(item.tagName) {
			item = { el: $(item) };
		} else {
			type = item.type;
			item = { data: item, src: item.src };
		}

		if(item.el) {
			var types = mfp.types;

			// check for 'mfp-TYPE' class
			for(var i = 0; i < types.length; i++) {
				if( item.el.hasClass('mfp-'+types[i]) ) {
					type = types[i];
					break;
				}
			}

			item.src = item.el.attr('data-mfp-src');
			if(!item.src) {
				item.src = item.el.attr('href');
			}
		}

		item.type = type || mfp.st.type || 'inline';
		item.index = index;
		item.parsed = true;
		mfp.items[index] = item;
		_mfpTrigger('ElementParse', item);

		return mfp.items[index];
	},


	/**
	 * Initializes single popup or a group of popups
	 */
	addGroup: function(el, options) {
		var eHandler = function(e) {
			e.mfpEl = this;
			mfp._openClick(e, el, options);
		};

		if(!options) {
			options = {};
		}

		var eName = 'click.magnificPopup';
		options.mainEl = el;

		if(options.items) {
			options.isObj = true;
			el.off(eName).on(eName, eHandler);
		} else {
			options.isObj = false;
			if(options.delegate) {
				el.off(eName).on(eName, options.delegate , eHandler);
			} else {
				options.items = el;
				el.off(eName).on(eName, eHandler);
			}
		}
	},
	_openClick: function(e, el, options) {
		var midClick = options.midClick !== undefined ? options.midClick : $.magnificPopup.defaults.midClick;


		if(!midClick && ( e.which === 2 || e.ctrlKey || e.metaKey || e.altKey || e.shiftKey ) ) {
			return;
		}

		var disableOn = options.disableOn !== undefined ? options.disableOn : $.magnificPopup.defaults.disableOn;

		if(disableOn) {
			if($.isFunction(disableOn)) {
				if( !disableOn.call(mfp) ) {
					return true;
				}
			} else { // else it's number
				if( _window.width() < disableOn ) {
					return true;
				}
			}
		}

		if(e.type) {
			e.preventDefault();

			// This will prevent popup from closing if element is inside and popup is already opened
			if(mfp.isOpen) {
				e.stopPropagation();
			}
		}

		options.el = $(e.mfpEl);
		if(options.delegate) {
			options.items = el.find(options.delegate);
		}
		mfp.open(options);
	},


	/**
	 * Updates text on preloader
	 */
	updateStatus: function(status, text) {

		if(mfp.preloader) {
			if(_prevStatus !== status) {
				mfp.container.removeClass('mfp-s-'+_prevStatus);
			}

			if(!text && status === 'loading') {
				text = mfp.st.tLoading;
			}

			var data = {
				status: status,
				text: text
			};
			// allows to modify status
			_mfpTrigger('UpdateStatus', data);

			status = data.status;
			text = data.text;

			mfp.preloader.html(text);

			mfp.preloader.find('a').on('click', function(e) {
				e.stopImmediatePropagation();
			});

			mfp.container.addClass('mfp-s-'+status);
			_prevStatus = status;
		}
	},


	/*
		"Private" helpers that aren't private at all
	 */
	// Check to close popup or not
	// "target" is an element that was clicked
	_checkIfClose: function(target) {

		if($(target).hasClass(PREVENT_CLOSE_CLASS)) {
			return;
		}

		var closeOnContent = mfp.st.closeOnContentClick;
		var closeOnBg = mfp.st.closeOnBgClick;

		if(closeOnContent && closeOnBg) {
			return true;
		} else {

			// We close the popup if click is on close button or on preloader. Or if there is no content.
			if(!mfp.content || $(target).hasClass('mfp-close') || (mfp.preloader && target === mfp.preloader[0]) ) {
				return true;
			}

			// if click is outside the content
			if(  (target !== mfp.content[0] && !$.contains(mfp.content[0], target))  ) {
				if(closeOnBg) {
					// last check, if the clicked element is in DOM, (in case it's removed onclick)
					if( $.contains(document, target) ) {
						return true;
					}
				}
			} else if(closeOnContent) {
				return true;
			}

		}
		return false;
	},
	_addClassToMFP: function(cName) {
		mfp.bgOverlay.addClass(cName);
		mfp.wrap.addClass(cName);
	},
	_removeClassFromMFP: function(cName) {
		this.bgOverlay.removeClass(cName);
		mfp.wrap.removeClass(cName);
	},
	_hasScrollBar: function(winHeight) {
		return (  (mfp.isIE7 ? _document.height() : document.body.scrollHeight) > (winHeight || _window.height()) );
	},
	_setFocus: function() {
		(mfp.st.focus ? mfp.content.find(mfp.st.focus).eq(0) : mfp.wrap).focus();
	},
	_onFocusIn: function(e) {
		if( e.target !== mfp.wrap[0] && !$.contains(mfp.wrap[0], e.target) ) {
			mfp._setFocus();
			return false;
		}
	},
	_parseMarkup: function(template, values, item) {
		var arr;
		if(item.data) {
			values = $.extend(item.data, values);
		}
		_mfpTrigger(MARKUP_PARSE_EVENT, [template, values, item] );

		$.each(values, function(key, value) {
			if(value === undefined || value === false) {
				return true;
			}
			arr = key.split('_');
			if(arr.length > 1) {
				var el = template.find(EVENT_NS + '-'+arr[0]);

				if(el.length > 0) {
					var attr = arr[1];
					if(attr === 'replaceWith') {
						if(el[0] !== value[0]) {
							el.replaceWith(value);
						}
					} else if(attr === 'img') {
						if(el.is('img')) {
							el.attr('src', value);
						} else {
							el.replaceWith( $('<img>').attr('src', value).attr('class', el.attr('class')) );
						}
					} else {
						el.attr(arr[1], value);
					}
				}

			} else {
				template.find(EVENT_NS + '-'+key).html(value);
			}
		});
	},

	_getScrollbarSize: function() {
		// thx David
		if(mfp.scrollbarSize === undefined) {
			var scrollDiv = document.createElement("div");
			scrollDiv.style.cssText = 'width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;';
			document.body.appendChild(scrollDiv);
			mfp.scrollbarSize = scrollDiv.offsetWidth - scrollDiv.clientWidth;
			document.body.removeChild(scrollDiv);
		}
		return mfp.scrollbarSize;
	}

}; /* MagnificPopup core prototype end */




/**
 * Public static functions
 */
$.magnificPopup = {
	instance: null,
	proto: MagnificPopup.prototype,
	modules: [],

	open: function(options, index) {
		_checkInstance();

		if(!options) {
			options = {};
		} else {
			options = $.extend(true, {}, options);
		}

		options.isObj = true;
		options.index = index || 0;
		return this.instance.open(options);
	},

	close: function() {
		return $.magnificPopup.instance && $.magnificPopup.instance.close();
	},

	registerModule: function(name, module) {
		if(module.options) {
			$.magnificPopup.defaults[name] = module.options;
		}
		$.extend(this.proto, module.proto);
		this.modules.push(name);
	},

	defaults: {

		// Info about options is in docs:
		// http://dimsemenov.com/plugins/magnific-popup/documentation.html#options

		disableOn: 0,

		key: null,

		midClick: false,

		mainClass: '',

		preloader: true,

		focus: '', // CSS selector of input to focus after popup is opened

		closeOnContentClick: false,

		closeOnBgClick: true,

		closeBtnInside: true,

		showCloseBtn: true,

		enableEscapeKey: true,

		modal: false,

		alignTop: false,

		removalDelay: 0,

		prependTo: null,

		fixedContentPos: 'auto',

		fixedBgPos: 'auto',

		overflowY: 'auto',

		closeMarkup: '<button title="%title%" type="button" class="mfp-close">&#215;</button>',

		tClose: 'Close (Esc)',

		tLoading: 'Loading...',

		autoFocusLast: true

	}
};



$.fn.magnificPopup = function(options) {
	_checkInstance();

	var jqEl = $(this);

	// We call some API method of first param is a string
	if (typeof options === "string" ) {

		if(options === 'open') {
			var items,
				itemOpts = _isJQ ? jqEl.data('magnificPopup') : jqEl[0].magnificPopup,
				index = parseInt(arguments[1], 10) || 0;

			if(itemOpts.items) {
				items = itemOpts.items[index];
			} else {
				items = jqEl;
				if(itemOpts.delegate) {
					items = items.find(itemOpts.delegate);
				}
				items = items.eq( index );
			}
			mfp._openClick({mfpEl:items}, jqEl, itemOpts);
		} else {
			if(mfp.isOpen)
				mfp[options].apply(mfp, Array.prototype.slice.call(arguments, 1));
		}

	} else {
		// clone options obj
		options = $.extend(true, {}, options);

		/*
		 * As Zepto doesn't support .data() method for objects
		 * and it works only in normal browsers
		 * we assign "options" object directly to the DOM element. FTW!
		 */
		if(_isJQ) {
			jqEl.data('magnificPopup', options);
		} else {
			jqEl[0].magnificPopup = options;
		}

		mfp.addGroup(jqEl, options);

	}
	return jqEl;
};

/*>>core*/

/*>>inline*/

var INLINE_NS = 'inline',
	_hiddenClass,
	_inlinePlaceholder,
	_lastInlineElement,
	_putInlineElementsBack = function() {
		if(_lastInlineElement) {
			_inlinePlaceholder.after( _lastInlineElement.addClass(_hiddenClass) ).detach();
			_lastInlineElement = null;
		}
	};

$.magnificPopup.registerModule(INLINE_NS, {
	options: {
		hiddenClass: 'hide', // will be appended with `mfp-` prefix
		markup: '',
		tNotFound: 'Content not found'
	},
	proto: {

		initInline: function() {
			mfp.types.push(INLINE_NS);

			_mfpOn(CLOSE_EVENT+'.'+INLINE_NS, function() {
				_putInlineElementsBack();
			});
		},

		getInline: function(item, template) {

			_putInlineElementsBack();

			if(item.src) {
				var inlineSt = mfp.st.inline,
					el = $(item.src);

				if(el.length) {

					// If target element has parent - we replace it with placeholder and put it back after popup is closed
					var parent = el[0].parentNode;
					if(parent && parent.tagName) {
						if(!_inlinePlaceholder) {
							_hiddenClass = inlineSt.hiddenClass;
							_inlinePlaceholder = _getEl(_hiddenClass);
							_hiddenClass = 'mfp-'+_hiddenClass;
						}
						// replace target inline element with placeholder
						_lastInlineElement = el.after(_inlinePlaceholder).detach().removeClass(_hiddenClass);
					}

					mfp.updateStatus('ready');
				} else {
					mfp.updateStatus('error', inlineSt.tNotFound);
					el = $('<div>');
				}

				item.inlineElement = el;
				return el;
			}

			mfp.updateStatus('ready');
			mfp._parseMarkup(template, {}, item);
			return template;
		}
	}
});

/*>>inline*/

/*>>ajax*/
var AJAX_NS = 'ajax',
	_ajaxCur,
	_removeAjaxCursor = function() {
		if(_ajaxCur) {
			$(document.body).removeClass(_ajaxCur);
		}
	},
	_destroyAjaxRequest = function() {
		_removeAjaxCursor();
		if(mfp.req) {
			mfp.req.abort();
		}
	};

$.magnificPopup.registerModule(AJAX_NS, {

	options: {
		settings: null,
		cursor: 'mfp-ajax-cur',
		tError: '<a href="%url%">The content</a> could not be loaded.'
	},

	proto: {
		initAjax: function() {
			mfp.types.push(AJAX_NS);
			_ajaxCur = mfp.st.ajax.cursor;

			_mfpOn(CLOSE_EVENT+'.'+AJAX_NS, _destroyAjaxRequest);
			_mfpOn('BeforeChange.' + AJAX_NS, _destroyAjaxRequest);
		},
		getAjax: function(item) {

			if(_ajaxCur) {
				$(document.body).addClass(_ajaxCur);
			}

			mfp.updateStatus('loading');

			var opts = $.extend({
				url: item.src,
				success: function(data, textStatus, jqXHR) {
					var temp = {
						data:data,
						xhr:jqXHR
					};

					_mfpTrigger('ParseAjax', temp);

					mfp.appendContent( $(temp.data), AJAX_NS );

					item.finished = true;

					_removeAjaxCursor();

					mfp._setFocus();

					setTimeout(function() {
						mfp.wrap.addClass(READY_CLASS);
					}, 16);

					mfp.updateStatus('ready');

					_mfpTrigger('AjaxContentAdded');
				},
				error: function() {
					_removeAjaxCursor();
					item.finished = item.loadError = true;
					mfp.updateStatus('error', mfp.st.ajax.tError.replace('%url%', item.src));
				}
			}, mfp.st.ajax.settings);

			mfp.req = $.ajax(opts);

			return '';
		}
	}
});

/*>>ajax*/

/*>>image*/
var _imgInterval,
	_getTitle = function(item) {
		if(item.data && item.data.title !== undefined)
			return item.data.title;

		var src = mfp.st.image.titleSrc;

		if(src) {
			if($.isFunction(src)) {
				return src.call(mfp, item);
			} else if(item.el) {
				return item.el.attr(src) || '';
			}
		}
		return '';
	};

$.magnificPopup.registerModule('image', {

	options: {
		markup: '<div class="mfp-figure">'+
					'<div class="mfp-close"></div>'+
					'<figure>'+
						'<div class="mfp-img"></div>'+
						'<figcaption>'+
							'<div class="mfp-bottom-bar">'+
								'<div class="mfp-title"></div>'+
								'<div class="mfp-counter"></div>'+
							'</div>'+
						'</figcaption>'+
					'</figure>'+
				'</div>',
		cursor: 'mfp-zoom-out-cur',
		titleSrc: 'title',
		verticalFit: true,
		tError: '<a href="%url%">The image</a> could not be loaded.'
	},

	proto: {
		initImage: function() {
			var imgSt = mfp.st.image,
				ns = '.image';

			mfp.types.push('image');

			_mfpOn(OPEN_EVENT+ns, function() {
				if(mfp.currItem.type === 'image' && imgSt.cursor) {
					$(document.body).addClass(imgSt.cursor);
				}
			});

			_mfpOn(CLOSE_EVENT+ns, function() {
				if(imgSt.cursor) {
					$(document.body).removeClass(imgSt.cursor);
				}
				_window.off('resize' + EVENT_NS);
			});

			_mfpOn('Resize'+ns, mfp.resizeImage);
			if(mfp.isLowIE) {
				_mfpOn('AfterChange', mfp.resizeImage);
			}
		},
		resizeImage: function() {
			var item = mfp.currItem;
			if(!item || !item.img) return;

			if(mfp.st.image.verticalFit) {
				var decr = 0;
				// fix box-sizing in ie7/8
				if(mfp.isLowIE) {
					decr = parseInt(item.img.css('padding-top'), 10) + parseInt(item.img.css('padding-bottom'),10);
				}
				item.img.css('max-height', mfp.wH-decr);
			}
		},
		_onImageHasSize: function(item) {
			if(item.img) {

				item.hasSize = true;

				if(_imgInterval) {
					clearInterval(_imgInterval);
				}

				item.isCheckingImgSize = false;

				_mfpTrigger('ImageHasSize', item);

				if(item.imgHidden) {
					if(mfp.content)
						mfp.content.removeClass('mfp-loading');

					item.imgHidden = false;
				}

			}
		},

		/**
		 * Function that loops until the image has size to display elements that rely on it asap
		 */
		findImageSize: function(item) {

			var counter = 0,
				img = item.img[0],
				mfpSetInterval = function(delay) {

					if(_imgInterval) {
						clearInterval(_imgInterval);
					}
					// decelerating interval that checks for size of an image
					_imgInterval = setInterval(function() {
						if(img.naturalWidth > 0) {
							mfp._onImageHasSize(item);
							return;
						}

						if(counter > 200) {
							clearInterval(_imgInterval);
						}

						counter++;
						if(counter === 3) {
							mfpSetInterval(10);
						} else if(counter === 40) {
							mfpSetInterval(50);
						} else if(counter === 100) {
							mfpSetInterval(500);
						}
					}, delay);
				};

			mfpSetInterval(1);
		},

		getImage: function(item, template) {

			var guard = 0,

				// image load complete handler
				onLoadComplete = function() {
					if(item) {
						if (item.img[0].complete) {
							item.img.off('.mfploader');

							if(item === mfp.currItem){
								mfp._onImageHasSize(item);

								mfp.updateStatus('ready');
							}

							item.hasSize = true;
							item.loaded = true;

							_mfpTrigger('ImageLoadComplete');

						}
						else {
							// if image complete check fails 200 times (20 sec), we assume that there was an error.
							guard++;
							if(guard < 200) {
								setTimeout(onLoadComplete,100);
							} else {
								onLoadError();
							}
						}
					}
				},

				// image error handler
				onLoadError = function() {
					if(item) {
						item.img.off('.mfploader');
						if(item === mfp.currItem){
							mfp._onImageHasSize(item);
							mfp.updateStatus('error', imgSt.tError.replace('%url%', item.src) );
						}

						item.hasSize = true;
						item.loaded = true;
						item.loadError = true;
					}
				},
				imgSt = mfp.st.image;


			var el = template.find('.mfp-img');
			if(el.length) {
				var img = document.createElement('img');
				img.className = 'mfp-img';
				if(item.el && item.el.find('img').length) {
					img.alt = item.el.find('img').attr('alt');
				}
				item.img = $(img).on('load.mfploader', onLoadComplete).on('error.mfploader', onLoadError);
				img.src = item.src;

				// without clone() "error" event is not firing when IMG is replaced by new IMG
				// TODO: find a way to avoid such cloning
				if(el.is('img')) {
					item.img = item.img.clone();
				}

				img = item.img[0];
				if(img.naturalWidth > 0) {
					item.hasSize = true;
				} else if(!img.width) {
					item.hasSize = false;
				}
			}

			mfp._parseMarkup(template, {
				title: _getTitle(item),
				img_replaceWith: item.img
			}, item);

			mfp.resizeImage();

			if(item.hasSize) {
				if(_imgInterval) clearInterval(_imgInterval);

				if(item.loadError) {
					template.addClass('mfp-loading');
					mfp.updateStatus('error', imgSt.tError.replace('%url%', item.src) );
				} else {
					template.removeClass('mfp-loading');
					mfp.updateStatus('ready');
				}
				return template;
			}

			mfp.updateStatus('loading');
			item.loading = true;

			if(!item.hasSize) {
				item.imgHidden = true;
				template.addClass('mfp-loading');
				mfp.findImageSize(item);
			}

			return template;
		}
	}
});

/*>>image*/

/*>>zoom*/
var hasMozTransform,
	getHasMozTransform = function() {
		if(hasMozTransform === undefined) {
			hasMozTransform = document.createElement('p').style.MozTransform !== undefined;
		}
		return hasMozTransform;
	};

$.magnificPopup.registerModule('zoom', {

	options: {
		enabled: false,
		easing: 'ease-in-out',
		duration: 300,
		opener: function(element) {
			return element.is('img') ? element : element.find('img');
		}
	},

	proto: {

		initZoom: function() {
			var zoomSt = mfp.st.zoom,
				ns = '.zoom',
				image;

			if(!zoomSt.enabled || !mfp.supportsTransition) {
				return;
			}

			var duration = zoomSt.duration,
				getElToAnimate = function(image) {
					var newImg = image.clone().removeAttr('style').removeAttr('class').addClass('mfp-animated-image'),
						transition = 'all '+(zoomSt.duration/1000)+'s ' + zoomSt.easing,
						cssObj = {
							position: 'fixed',
							zIndex: 9999,
							left: 0,
							top: 0,
							'-webkit-backface-visibility': 'hidden'
						},
						t = 'transition';

					cssObj['-webkit-'+t] = cssObj['-moz-'+t] = cssObj['-o-'+t] = cssObj[t] = transition;

					newImg.css(cssObj);
					return newImg;
				},
				showMainContent = function() {
					mfp.content.css('visibility', 'visible');
				},
				openTimeout,
				animatedImg;

			_mfpOn('BuildControls'+ns, function() {
				if(mfp._allowZoom()) {

					clearTimeout(openTimeout);
					mfp.content.css('visibility', 'hidden');

					// Basically, all code below does is clones existing image, puts in on top of the current one and animated it

					image = mfp._getItemToZoom();

					if(!image) {
						showMainContent();
						return;
					}

					animatedImg = getElToAnimate(image);

					animatedImg.css( mfp._getOffset() );

					mfp.wrap.append(animatedImg);

					openTimeout = setTimeout(function() {
						animatedImg.css( mfp._getOffset( true ) );
						openTimeout = setTimeout(function() {

							showMainContent();

							setTimeout(function() {
								animatedImg.remove();
								image = animatedImg = null;
								_mfpTrigger('ZoomAnimationEnded');
							}, 16); // avoid blink when switching images

						}, duration); // this timeout equals animation duration

					}, 16); // by adding this timeout we avoid short glitch at the beginning of animation


					// Lots of timeouts...
				}
			});
			_mfpOn(BEFORE_CLOSE_EVENT+ns, function() {
				if(mfp._allowZoom()) {

					clearTimeout(openTimeout);

					mfp.st.removalDelay = duration;

					if(!image) {
						image = mfp._getItemToZoom();
						if(!image) {
							return;
						}
						animatedImg = getElToAnimate(image);
					}

					animatedImg.css( mfp._getOffset(true) );
					mfp.wrap.append(animatedImg);
					mfp.content.css('visibility', 'hidden');

					setTimeout(function() {
						animatedImg.css( mfp._getOffset() );
					}, 16);
				}

			});

			_mfpOn(CLOSE_EVENT+ns, function() {
				if(mfp._allowZoom()) {
					showMainContent();
					if(animatedImg) {
						animatedImg.remove();
					}
					image = null;
				}
			});
		},

		_allowZoom: function() {
			return mfp.currItem.type === 'image';
		},

		_getItemToZoom: function() {
			if(mfp.currItem.hasSize) {
				return mfp.currItem.img;
			} else {
				return false;
			}
		},

		// Get element postion relative to viewport
		_getOffset: function(isLarge) {
			var el;
			if(isLarge) {
				el = mfp.currItem.img;
			} else {
				el = mfp.st.zoom.opener(mfp.currItem.el || mfp.currItem);
			}

			var offset = el.offset();
			var paddingTop = parseInt(el.css('padding-top'),10);
			var paddingBottom = parseInt(el.css('padding-bottom'),10);
			offset.top -= ( $(window).scrollTop() - paddingTop );


			/*

			Animating left + top + width/height looks glitchy in Firefox, but perfect in Chrome. And vice-versa.

			 */
			var obj = {
				width: el.width(),
				// fix Zepto height+padding issue
				height: (_isJQ ? el.innerHeight() : el[0].offsetHeight) - paddingBottom - paddingTop
			};

			// I hate to do this, but there is no another option
			if( getHasMozTransform() ) {
				obj['-moz-transform'] = obj['transform'] = 'translate(' + offset.left + 'px,' + offset.top + 'px)';
			} else {
				obj.left = offset.left;
				obj.top = offset.top;
			}
			return obj;
		}

	}
});



/*>>zoom*/

/*>>iframe*/

var IFRAME_NS = 'iframe',
	_emptyPage = '//about:blank',

	_fixIframeBugs = function(isShowing) {
		if(mfp.currTemplate[IFRAME_NS]) {
			var el = mfp.currTemplate[IFRAME_NS].find('iframe');
			if(el.length) {
				// reset src after the popup is closed to avoid "video keeps playing after popup is closed" bug
				if(!isShowing) {
					el[0].src = _emptyPage;
				}

				// IE8 black screen bug fix
				if(mfp.isIE8) {
					el.css('display', isShowing ? 'block' : 'none');
				}
			}
		}
	};

$.magnificPopup.registerModule(IFRAME_NS, {

	options: {
		markup: '<div class="mfp-iframe-scaler">'+
					'<div class="mfp-close"></div>'+
					'<iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe>'+
				'</div>',

		srcAction: 'iframe_src',

		// we don't care and support only one default type of URL by default
		patterns: {
			youtube: {
				index: 'youtube.com',
				id: 'v=',
				src: '//www.youtube.com/embed/%id%?autoplay=1'
			},
			vimeo: {
				index: 'vimeo.com/',
				id: '/',
				src: '//player.vimeo.com/video/%id%?autoplay=1'
			},
			gmaps: {
				index: '//maps.google.',
				src: '%id%&output=embed'
			}
		}
	},

	proto: {
		initIframe: function() {
			mfp.types.push(IFRAME_NS);

			_mfpOn('BeforeChange', function(e, prevType, newType) {
				if(prevType !== newType) {
					if(prevType === IFRAME_NS) {
						_fixIframeBugs(); // iframe if removed
					} else if(newType === IFRAME_NS) {
						_fixIframeBugs(true); // iframe is showing
					}
				}// else {
					// iframe source is switched, don't do anything
				//}
			});

			_mfpOn(CLOSE_EVENT + '.' + IFRAME_NS, function() {
				_fixIframeBugs();
			});
		},

		getIframe: function(item, template) {
			var embedSrc = item.src;
			var iframeSt = mfp.st.iframe;

			$.each(iframeSt.patterns, function() {
				if(embedSrc.indexOf( this.index ) > -1) {
					if(this.id) {
						if(typeof this.id === 'string') {
							embedSrc = embedSrc.substr(embedSrc.lastIndexOf(this.id)+this.id.length, embedSrc.length);
						} else {
							embedSrc = this.id.call( this, embedSrc );
						}
					}
					embedSrc = this.src.replace('%id%', embedSrc );
					return false; // break;
				}
			});

			var dataObj = {};
			if(iframeSt.srcAction) {
				dataObj[iframeSt.srcAction] = embedSrc;
			}
			mfp._parseMarkup(template, dataObj, item);

			mfp.updateStatus('ready');

			return template;
		}
	}
});



/*>>iframe*/

/*>>gallery*/
/**
 * Get looped index depending on number of slides
 */
var _getLoopedId = function(index) {
		var numSlides = mfp.items.length;
		if(index > numSlides - 1) {
			return index - numSlides;
		} else  if(index < 0) {
			return numSlides + index;
		}
		return index;
	},
	_replaceCurrTotal = function(text, curr, total) {
		return text.replace(/%curr%/gi, curr + 1).replace(/%total%/gi, total);
	};

$.magnificPopup.registerModule('gallery', {

	options: {
		enabled: false,
		arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
		preload: [0,2],
		navigateByImgClick: true,
		arrows: true,

		tPrev: 'Previous (Left arrow key)',
		tNext: 'Next (Right arrow key)',
		tCounter: '%curr% of %total%'
	},

	proto: {
		initGallery: function() {

			var gSt = mfp.st.gallery,
				ns = '.mfp-gallery';

			mfp.direction = true; // true - next, false - prev

			if(!gSt || !gSt.enabled ) return false;

			_wrapClasses += ' mfp-gallery';

			_mfpOn(OPEN_EVENT+ns, function() {

				if(gSt.navigateByImgClick) {
					mfp.wrap.on('click'+ns, '.mfp-img', function() {
						if(mfp.items.length > 1) {
							mfp.next();
							return false;
						}
					});
				}

				_document.on('keydown'+ns, function(e) {
					if (e.keyCode === 37) {
						mfp.prev();
					} else if (e.keyCode === 39) {
						mfp.next();
					}
				});
			});

			_mfpOn('UpdateStatus'+ns, function(e, data) {
				if(data.text) {
					data.text = _replaceCurrTotal(data.text, mfp.currItem.index, mfp.items.length);
				}
			});

			_mfpOn(MARKUP_PARSE_EVENT+ns, function(e, element, values, item) {
				var l = mfp.items.length;
				values.counter = l > 1 ? _replaceCurrTotal(gSt.tCounter, item.index, l) : '';
			});

			_mfpOn('BuildControls' + ns, function() {
				if(mfp.items.length > 1 && gSt.arrows && !mfp.arrowLeft) {
					var markup = gSt.arrowMarkup,
						arrowLeft = mfp.arrowLeft = $( markup.replace(/%title%/gi, gSt.tPrev).replace(/%dir%/gi, 'left') ).addClass(PREVENT_CLOSE_CLASS),
						arrowRight = mfp.arrowRight = $( markup.replace(/%title%/gi, gSt.tNext).replace(/%dir%/gi, 'right') ).addClass(PREVENT_CLOSE_CLASS);

					arrowLeft.click(function() {
						mfp.prev();
					});
					arrowRight.click(function() {
						mfp.next();
					});

					mfp.container.append(arrowLeft.add(arrowRight));
				}
			});

			_mfpOn(CHANGE_EVENT+ns, function() {
				if(mfp._preloadTimeout) clearTimeout(mfp._preloadTimeout);

				mfp._preloadTimeout = setTimeout(function() {
					mfp.preloadNearbyImages();
					mfp._preloadTimeout = null;
				}, 16);
			});


			_mfpOn(CLOSE_EVENT+ns, function() {
				_document.off(ns);
				mfp.wrap.off('click'+ns);
				mfp.arrowRight = mfp.arrowLeft = null;
			});

		},
		next: function() {
			mfp.direction = true;
			mfp.index = _getLoopedId(mfp.index + 1);
			mfp.updateItemHTML();
		},
		prev: function() {
			mfp.direction = false;
			mfp.index = _getLoopedId(mfp.index - 1);
			mfp.updateItemHTML();
		},
		goTo: function(newIndex) {
			mfp.direction = (newIndex >= mfp.index);
			mfp.index = newIndex;
			mfp.updateItemHTML();
		},
		preloadNearbyImages: function() {
			var p = mfp.st.gallery.preload,
				preloadBefore = Math.min(p[0], mfp.items.length),
				preloadAfter = Math.min(p[1], mfp.items.length),
				i;

			for(i = 1; i <= (mfp.direction ? preloadAfter : preloadBefore); i++) {
				mfp._preloadItem(mfp.index+i);
			}
			for(i = 1; i <= (mfp.direction ? preloadBefore : preloadAfter); i++) {
				mfp._preloadItem(mfp.index-i);
			}
		},
		_preloadItem: function(index) {
			index = _getLoopedId(index);

			if(mfp.items[index].preloaded) {
				return;
			}

			var item = mfp.items[index];
			if(!item.parsed) {
				item = mfp.parseEl( index );
			}

			_mfpTrigger('LazyLoad', item);

			if(item.type === 'image') {
				item.img = $('<img class="mfp-img" />').on('load.mfploader', function() {
					item.hasSize = true;
				}).on('error.mfploader', function() {
					item.hasSize = true;
					item.loadError = true;
					_mfpTrigger('LazyLoadError', item);
				}).attr('src', item.src);
			}


			item.preloaded = true;
		}
	}
});

/*>>gallery*/

/*>>retina*/

var RETINA_NS = 'retina';

$.magnificPopup.registerModule(RETINA_NS, {
	options: {
		replaceSrc: function(item) {
			return item.src.replace(/\.\w+$/, function(m) { return '@2x' + m; });
		},
		ratio: 1 // Function or number.  Set to 1 to disable.
	},
	proto: {
		initRetina: function() {
			if(window.devicePixelRatio > 1) {

				var st = mfp.st.retina,
					ratio = st.ratio;

				ratio = !isNaN(ratio) ? ratio : ratio();

				if(ratio > 1) {
					_mfpOn('ImageHasSize' + '.' + RETINA_NS, function(e, item) {
						item.img.css({
							'max-width': item.img[0].naturalWidth / ratio,
							'width': '100%'
						});
					});
					_mfpOn('ElementParse' + '.' + RETINA_NS, function(e, item) {
						item.src = st.replaceSrc(item, ratio);
					});
				}
			}

		}
	}
});

/*>>retina*/
 _checkInstance(); }));
$(document).foundation();
$(document).ready(function() {
  $('.popup-youtube').magnificPopup({
    type: 'iframe',
    mainClass: 'mfp-fade',
    removalDelay: 160,
    preloader: false,
    fixedContentPos: false,
  });

  // Internet Explorer 6-11 (http://stackoverflow.com/questions/9847580/how-to-detect-safari-chrome-ie-firefox-and-opera-browser)
  const isIE = /*@cc_on!@*/false || !!document.documentMode;
  if(isIE){
      $('#outdated-browser-container').html('<p class="browserupgrade">EMU Today does not support Internet Explorer 10 or below. Please download the latest versions of <a href="https://www.mozilla.org/en-US/firefox/new/?utm_medium=referral&utm_source=firefox-com" class="firefox">Firefox</a> or <a href="https://www.google.com/chrome/" class="chrome">Chrome</a> to improve your viewing experience.</p>');
  }

  $.getJSON( "https://www.emich.edu/admin/api/emergency_api.php", function( data ) {
    if(data.display == "yes"){
        $( "#emergency-bar" ).removeClass("no")
        $( "#emergency-title" ).html( data.title )
        $( "#emergency-message" ).html( data.message )
        $( "#emergency-bar-content").append('<h3 id="emergency-title">' + data.title + '</h3>')
        $( "#emergency-bar-content").append('<p id="emergency-message">' + data.message + '</p>')
        if( data.severity == "yellow" ){
            $("#emergency-bar").addClass("emergency-yellow")
        }
        if( data.severity == "red" ){
            $("#emergency-bar").addClass("emergency-red")
        }
    }
  })
})

// KEYBOARD BINDINGS
const map = {}; // Stores key that have been pressed
onkeydown = onkeyup = function(e){
	e = e || event; // to deal with IE
	map[e.keyCode] = e.type == "keydown";

	// Keybind to Admin lock button []\
	if(map[219] && map[220] && map[221]){
		document.getElementById("admin-area-lock").click();
	}
}
