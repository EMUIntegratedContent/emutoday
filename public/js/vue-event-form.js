(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
module.exports = { "default": require("core-js/library/fn/json/stringify"), __esModule: true };
},{"core-js/library/fn/json/stringify":16}],2:[function(require,module,exports){
module.exports = { "default": require("core-js/library/fn/object/create"), __esModule: true };
},{"core-js/library/fn/object/create":17}],3:[function(require,module,exports){
module.exports = { "default": require("core-js/library/fn/object/define-properties"), __esModule: true };
},{"core-js/library/fn/object/define-properties":18}],4:[function(require,module,exports){
module.exports = { "default": require("core-js/library/fn/object/define-property"), __esModule: true };
},{"core-js/library/fn/object/define-property":19}],5:[function(require,module,exports){
module.exports = { "default": require("core-js/library/fn/object/get-own-property-descriptor"), __esModule: true };
},{"core-js/library/fn/object/get-own-property-descriptor":20}],6:[function(require,module,exports){
module.exports = { "default": require("core-js/library/fn/object/get-own-property-names"), __esModule: true };
},{"core-js/library/fn/object/get-own-property-names":21}],7:[function(require,module,exports){
module.exports = { "default": require("core-js/library/fn/object/get-own-property-symbols"), __esModule: true };
},{"core-js/library/fn/object/get-own-property-symbols":22}],8:[function(require,module,exports){
module.exports = { "default": require("core-js/library/fn/object/get-prototype-of"), __esModule: true };
},{"core-js/library/fn/object/get-prototype-of":23}],9:[function(require,module,exports){
module.exports = { "default": require("core-js/library/fn/object/is-extensible"), __esModule: true };
},{"core-js/library/fn/object/is-extensible":24}],10:[function(require,module,exports){
module.exports = { "default": require("core-js/library/fn/object/keys"), __esModule: true };
},{"core-js/library/fn/object/keys":25}],11:[function(require,module,exports){
module.exports = { "default": require("core-js/library/fn/object/prevent-extensions"), __esModule: true };
},{"core-js/library/fn/object/prevent-extensions":26}],12:[function(require,module,exports){
module.exports = { "default": require("core-js/library/fn/symbol"), __esModule: true };
},{"core-js/library/fn/symbol":27}],13:[function(require,module,exports){
module.exports = { "default": require("core-js/library/fn/symbol/iterator"), __esModule: true };
},{"core-js/library/fn/symbol/iterator":28}],14:[function(require,module,exports){
"use strict";

exports.__esModule = true;

var _iterator = require("../core-js/symbol/iterator");

var _iterator2 = _interopRequireDefault(_iterator);

var _symbol = require("../core-js/symbol");

var _symbol2 = _interopRequireDefault(_symbol);

var _typeof = typeof _symbol2.default === "function" && typeof _iterator2.default === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof _symbol2.default === "function" && obj.constructor === _symbol2.default && obj !== _symbol2.default.prototype ? "symbol" : typeof obj; };

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = typeof _symbol2.default === "function" && _typeof(_iterator2.default) === "symbol" ? function (obj) {
  return typeof obj === "undefined" ? "undefined" : _typeof(obj);
} : function (obj) {
  return obj && typeof _symbol2.default === "function" && obj.constructor === _symbol2.default && obj !== _symbol2.default.prototype ? "symbol" : typeof obj === "undefined" ? "undefined" : _typeof(obj);
};
},{"../core-js/symbol":12,"../core-js/symbol/iterator":13}],15:[function(require,module,exports){

},{}],16:[function(require,module,exports){
var core = require('../../modules/_core');
var $JSON = core.JSON || (core.JSON = { stringify: JSON.stringify });
module.exports = function stringify(it) { // eslint-disable-line no-unused-vars
  return $JSON.stringify.apply($JSON, arguments);
};

},{"../../modules/_core":34}],17:[function(require,module,exports){
require('../../modules/es6.object.create');
var $Object = require('../../modules/_core').Object;
module.exports = function create(P, D) {
  return $Object.create(P, D);
};

},{"../../modules/_core":34,"../../modules/es6.object.create":86}],18:[function(require,module,exports){
require('../../modules/es6.object.define-properties');
var $Object = require('../../modules/_core').Object;
module.exports = function defineProperties(T, D) {
  return $Object.defineProperties(T, D);
};

},{"../../modules/_core":34,"../../modules/es6.object.define-properties":87}],19:[function(require,module,exports){
require('../../modules/es6.object.define-property');
var $Object = require('../../modules/_core').Object;
module.exports = function defineProperty(it, key, desc) {
  return $Object.defineProperty(it, key, desc);
};

},{"../../modules/_core":34,"../../modules/es6.object.define-property":88}],20:[function(require,module,exports){
require('../../modules/es6.object.get-own-property-descriptor');
var $Object = require('../../modules/_core').Object;
module.exports = function getOwnPropertyDescriptor(it, key) {
  return $Object.getOwnPropertyDescriptor(it, key);
};

},{"../../modules/_core":34,"../../modules/es6.object.get-own-property-descriptor":89}],21:[function(require,module,exports){
require('../../modules/es6.object.get-own-property-names');
var $Object = require('../../modules/_core').Object;
module.exports = function getOwnPropertyNames(it) {
  return $Object.getOwnPropertyNames(it);
};

},{"../../modules/_core":34,"../../modules/es6.object.get-own-property-names":90}],22:[function(require,module,exports){
require('../../modules/es6.symbol');
module.exports = require('../../modules/_core').Object.getOwnPropertySymbols;

},{"../../modules/_core":34,"../../modules/es6.symbol":97}],23:[function(require,module,exports){
require('../../modules/es6.object.get-prototype-of');
module.exports = require('../../modules/_core').Object.getPrototypeOf;

},{"../../modules/_core":34,"../../modules/es6.object.get-prototype-of":91}],24:[function(require,module,exports){
require('../../modules/es6.object.is-extensible');
module.exports = require('../../modules/_core').Object.isExtensible;

},{"../../modules/_core":34,"../../modules/es6.object.is-extensible":92}],25:[function(require,module,exports){
require('../../modules/es6.object.keys');
module.exports = require('../../modules/_core').Object.keys;

},{"../../modules/_core":34,"../../modules/es6.object.keys":93}],26:[function(require,module,exports){
require('../../modules/es6.object.prevent-extensions');
module.exports = require('../../modules/_core').Object.preventExtensions;

},{"../../modules/_core":34,"../../modules/es6.object.prevent-extensions":94}],27:[function(require,module,exports){
require('../../modules/es6.symbol');
require('../../modules/es6.object.to-string');
require('../../modules/es7.symbol.async-iterator');
require('../../modules/es7.symbol.observable');
module.exports = require('../../modules/_core').Symbol;

},{"../../modules/_core":34,"../../modules/es6.object.to-string":95,"../../modules/es6.symbol":97,"../../modules/es7.symbol.async-iterator":98,"../../modules/es7.symbol.observable":99}],28:[function(require,module,exports){
require('../../modules/es6.string.iterator');
require('../../modules/web.dom.iterable');
module.exports = require('../../modules/_wks-ext').f('iterator');

},{"../../modules/_wks-ext":83,"../../modules/es6.string.iterator":96,"../../modules/web.dom.iterable":100}],29:[function(require,module,exports){
module.exports = function (it) {
  if (typeof it != 'function') throw TypeError(it + ' is not a function!');
  return it;
};

},{}],30:[function(require,module,exports){
module.exports = function () { /* empty */ };

},{}],31:[function(require,module,exports){
var isObject = require('./_is-object');
module.exports = function (it) {
  if (!isObject(it)) throw TypeError(it + ' is not an object!');
  return it;
};

},{"./_is-object":50}],32:[function(require,module,exports){
// false -> Array#indexOf
// true  -> Array#includes
var toIObject = require('./_to-iobject');
var toLength = require('./_to-length');
var toAbsoluteIndex = require('./_to-absolute-index');
module.exports = function (IS_INCLUDES) {
  return function ($this, el, fromIndex) {
    var O = toIObject($this);
    var length = toLength(O.length);
    var index = toAbsoluteIndex(fromIndex, length);
    var value;
    // Array#includes uses SameValueZero equality algorithm
    // eslint-disable-next-line no-self-compare
    if (IS_INCLUDES && el != el) while (length > index) {
      value = O[index++];
      // eslint-disable-next-line no-self-compare
      if (value != value) return true;
    // Array#indexOf ignores holes, Array#includes - not
    } else for (;length > index; index++) if (IS_INCLUDES || index in O) {
      if (O[index] === el) return IS_INCLUDES || index || 0;
    } return !IS_INCLUDES && -1;
  };
};

},{"./_to-absolute-index":75,"./_to-iobject":77,"./_to-length":78}],33:[function(require,module,exports){
var toString = {}.toString;

module.exports = function (it) {
  return toString.call(it).slice(8, -1);
};

},{}],34:[function(require,module,exports){
var core = module.exports = { version: '2.5.1' };
if (typeof __e == 'number') __e = core; // eslint-disable-line no-undef

},{}],35:[function(require,module,exports){
// optional / simple context binding
var aFunction = require('./_a-function');
module.exports = function (fn, that, length) {
  aFunction(fn);
  if (that === undefined) return fn;
  switch (length) {
    case 1: return function (a) {
      return fn.call(that, a);
    };
    case 2: return function (a, b) {
      return fn.call(that, a, b);
    };
    case 3: return function (a, b, c) {
      return fn.call(that, a, b, c);
    };
  }
  return function (/* ...args */) {
    return fn.apply(that, arguments);
  };
};

},{"./_a-function":29}],36:[function(require,module,exports){
// 7.2.1 RequireObjectCoercible(argument)
module.exports = function (it) {
  if (it == undefined) throw TypeError("Can't call method on  " + it);
  return it;
};

},{}],37:[function(require,module,exports){
// Thank's IE8 for his funny defineProperty
module.exports = !require('./_fails')(function () {
  return Object.defineProperty({}, 'a', { get: function () { return 7; } }).a != 7;
});

},{"./_fails":42}],38:[function(require,module,exports){
var isObject = require('./_is-object');
var document = require('./_global').document;
// typeof document.createElement is 'object' in old IE
var is = isObject(document) && isObject(document.createElement);
module.exports = function (it) {
  return is ? document.createElement(it) : {};
};

},{"./_global":43,"./_is-object":50}],39:[function(require,module,exports){
// IE 8- don't enum bug keys
module.exports = (
  'constructor,hasOwnProperty,isPrototypeOf,propertyIsEnumerable,toLocaleString,toString,valueOf'
).split(',');

},{}],40:[function(require,module,exports){
// all enumerable object keys, includes symbols
var getKeys = require('./_object-keys');
var gOPS = require('./_object-gops');
var pIE = require('./_object-pie');
module.exports = function (it) {
  var result = getKeys(it);
  var getSymbols = gOPS.f;
  if (getSymbols) {
    var symbols = getSymbols(it);
    var isEnum = pIE.f;
    var i = 0;
    var key;
    while (symbols.length > i) if (isEnum.call(it, key = symbols[i++])) result.push(key);
  } return result;
};

},{"./_object-gops":63,"./_object-keys":66,"./_object-pie":67}],41:[function(require,module,exports){
var global = require('./_global');
var core = require('./_core');
var ctx = require('./_ctx');
var hide = require('./_hide');
var PROTOTYPE = 'prototype';

var $export = function (type, name, source) {
  var IS_FORCED = type & $export.F;
  var IS_GLOBAL = type & $export.G;
  var IS_STATIC = type & $export.S;
  var IS_PROTO = type & $export.P;
  var IS_BIND = type & $export.B;
  var IS_WRAP = type & $export.W;
  var exports = IS_GLOBAL ? core : core[name] || (core[name] = {});
  var expProto = exports[PROTOTYPE];
  var target = IS_GLOBAL ? global : IS_STATIC ? global[name] : (global[name] || {})[PROTOTYPE];
  var key, own, out;
  if (IS_GLOBAL) source = name;
  for (key in source) {
    // contains in native
    own = !IS_FORCED && target && target[key] !== undefined;
    if (own && key in exports) continue;
    // export native or passed
    out = own ? target[key] : source[key];
    // prevent global pollution for namespaces
    exports[key] = IS_GLOBAL && typeof target[key] != 'function' ? source[key]
    // bind timers to global for call from export context
    : IS_BIND && own ? ctx(out, global)
    // wrap global constructors for prevent change them in library
    : IS_WRAP && target[key] == out ? (function (C) {
      var F = function (a, b, c) {
        if (this instanceof C) {
          switch (arguments.length) {
            case 0: return new C();
            case 1: return new C(a);
            case 2: return new C(a, b);
          } return new C(a, b, c);
        } return C.apply(this, arguments);
      };
      F[PROTOTYPE] = C[PROTOTYPE];
      return F;
    // make static versions for prototype methods
    })(out) : IS_PROTO && typeof out == 'function' ? ctx(Function.call, out) : out;
    // export proto methods to core.%CONSTRUCTOR%.methods.%NAME%
    if (IS_PROTO) {
      (exports.virtual || (exports.virtual = {}))[key] = out;
      // export proto methods to core.%CONSTRUCTOR%.prototype.%NAME%
      if (type & $export.R && expProto && !expProto[key]) hide(expProto, key, out);
    }
  }
};
// type bitmap
$export.F = 1;   // forced
$export.G = 2;   // global
$export.S = 4;   // static
$export.P = 8;   // proto
$export.B = 16;  // bind
$export.W = 32;  // wrap
$export.U = 64;  // safe
$export.R = 128; // real proto method for `library`
module.exports = $export;

},{"./_core":34,"./_ctx":35,"./_global":43,"./_hide":45}],42:[function(require,module,exports){
module.exports = function (exec) {
  try {
    return !!exec();
  } catch (e) {
    return true;
  }
};

},{}],43:[function(require,module,exports){
// https://github.com/zloirock/core-js/issues/86#issuecomment-115759028
var global = module.exports = typeof window != 'undefined' && window.Math == Math
  ? window : typeof self != 'undefined' && self.Math == Math ? self
  // eslint-disable-next-line no-new-func
  : Function('return this')();
if (typeof __g == 'number') __g = global; // eslint-disable-line no-undef

},{}],44:[function(require,module,exports){
var hasOwnProperty = {}.hasOwnProperty;
module.exports = function (it, key) {
  return hasOwnProperty.call(it, key);
};

},{}],45:[function(require,module,exports){
var dP = require('./_object-dp');
var createDesc = require('./_property-desc');
module.exports = require('./_descriptors') ? function (object, key, value) {
  return dP.f(object, key, createDesc(1, value));
} : function (object, key, value) {
  object[key] = value;
  return object;
};

},{"./_descriptors":37,"./_object-dp":58,"./_property-desc":69}],46:[function(require,module,exports){
var document = require('./_global').document;
module.exports = document && document.documentElement;

},{"./_global":43}],47:[function(require,module,exports){
module.exports = !require('./_descriptors') && !require('./_fails')(function () {
  return Object.defineProperty(require('./_dom-create')('div'), 'a', { get: function () { return 7; } }).a != 7;
});

},{"./_descriptors":37,"./_dom-create":38,"./_fails":42}],48:[function(require,module,exports){
// fallback for non-array-like ES3 and non-enumerable old V8 strings
var cof = require('./_cof');
// eslint-disable-next-line no-prototype-builtins
module.exports = Object('z').propertyIsEnumerable(0) ? Object : function (it) {
  return cof(it) == 'String' ? it.split('') : Object(it);
};

},{"./_cof":33}],49:[function(require,module,exports){
// 7.2.2 IsArray(argument)
var cof = require('./_cof');
module.exports = Array.isArray || function isArray(arg) {
  return cof(arg) == 'Array';
};

},{"./_cof":33}],50:[function(require,module,exports){
module.exports = function (it) {
  return typeof it === 'object' ? it !== null : typeof it === 'function';
};

},{}],51:[function(require,module,exports){
'use strict';
var create = require('./_object-create');
var descriptor = require('./_property-desc');
var setToStringTag = require('./_set-to-string-tag');
var IteratorPrototype = {};

// 25.1.2.1.1 %IteratorPrototype%[@@iterator]()
require('./_hide')(IteratorPrototype, require('./_wks')('iterator'), function () { return this; });

module.exports = function (Constructor, NAME, next) {
  Constructor.prototype = create(IteratorPrototype, { next: descriptor(1, next) });
  setToStringTag(Constructor, NAME + ' Iterator');
};

},{"./_hide":45,"./_object-create":57,"./_property-desc":69,"./_set-to-string-tag":71,"./_wks":84}],52:[function(require,module,exports){
'use strict';
var LIBRARY = require('./_library');
var $export = require('./_export');
var redefine = require('./_redefine');
var hide = require('./_hide');
var has = require('./_has');
var Iterators = require('./_iterators');
var $iterCreate = require('./_iter-create');
var setToStringTag = require('./_set-to-string-tag');
var getPrototypeOf = require('./_object-gpo');
var ITERATOR = require('./_wks')('iterator');
var BUGGY = !([].keys && 'next' in [].keys()); // Safari has buggy iterators w/o `next`
var FF_ITERATOR = '@@iterator';
var KEYS = 'keys';
var VALUES = 'values';

var returnThis = function () { return this; };

module.exports = function (Base, NAME, Constructor, next, DEFAULT, IS_SET, FORCED) {
  $iterCreate(Constructor, NAME, next);
  var getMethod = function (kind) {
    if (!BUGGY && kind in proto) return proto[kind];
    switch (kind) {
      case KEYS: return function keys() { return new Constructor(this, kind); };
      case VALUES: return function values() { return new Constructor(this, kind); };
    } return function entries() { return new Constructor(this, kind); };
  };
  var TAG = NAME + ' Iterator';
  var DEF_VALUES = DEFAULT == VALUES;
  var VALUES_BUG = false;
  var proto = Base.prototype;
  var $native = proto[ITERATOR] || proto[FF_ITERATOR] || DEFAULT && proto[DEFAULT];
  var $default = $native || getMethod(DEFAULT);
  var $entries = DEFAULT ? !DEF_VALUES ? $default : getMethod('entries') : undefined;
  var $anyNative = NAME == 'Array' ? proto.entries || $native : $native;
  var methods, key, IteratorPrototype;
  // Fix native
  if ($anyNative) {
    IteratorPrototype = getPrototypeOf($anyNative.call(new Base()));
    if (IteratorPrototype !== Object.prototype && IteratorPrototype.next) {
      // Set @@toStringTag to native iterators
      setToStringTag(IteratorPrototype, TAG, true);
      // fix for some old engines
      if (!LIBRARY && !has(IteratorPrototype, ITERATOR)) hide(IteratorPrototype, ITERATOR, returnThis);
    }
  }
  // fix Array#{values, @@iterator}.name in V8 / FF
  if (DEF_VALUES && $native && $native.name !== VALUES) {
    VALUES_BUG = true;
    $default = function values() { return $native.call(this); };
  }
  // Define iterator
  if ((!LIBRARY || FORCED) && (BUGGY || VALUES_BUG || !proto[ITERATOR])) {
    hide(proto, ITERATOR, $default);
  }
  // Plug for library
  Iterators[NAME] = $default;
  Iterators[TAG] = returnThis;
  if (DEFAULT) {
    methods = {
      values: DEF_VALUES ? $default : getMethod(VALUES),
      keys: IS_SET ? $default : getMethod(KEYS),
      entries: $entries
    };
    if (FORCED) for (key in methods) {
      if (!(key in proto)) redefine(proto, key, methods[key]);
    } else $export($export.P + $export.F * (BUGGY || VALUES_BUG), NAME, methods);
  }
  return methods;
};

},{"./_export":41,"./_has":44,"./_hide":45,"./_iter-create":51,"./_iterators":54,"./_library":55,"./_object-gpo":64,"./_redefine":70,"./_set-to-string-tag":71,"./_wks":84}],53:[function(require,module,exports){
module.exports = function (done, value) {
  return { value: value, done: !!done };
};

},{}],54:[function(require,module,exports){
module.exports = {};

},{}],55:[function(require,module,exports){
module.exports = true;

},{}],56:[function(require,module,exports){
var META = require('./_uid')('meta');
var isObject = require('./_is-object');
var has = require('./_has');
var setDesc = require('./_object-dp').f;
var id = 0;
var isExtensible = Object.isExtensible || function () {
  return true;
};
var FREEZE = !require('./_fails')(function () {
  return isExtensible(Object.preventExtensions({}));
});
var setMeta = function (it) {
  setDesc(it, META, { value: {
    i: 'O' + ++id, // object ID
    w: {}          // weak collections IDs
  } });
};
var fastKey = function (it, create) {
  // return primitive with prefix
  if (!isObject(it)) return typeof it == 'symbol' ? it : (typeof it == 'string' ? 'S' : 'P') + it;
  if (!has(it, META)) {
    // can't set metadata to uncaught frozen object
    if (!isExtensible(it)) return 'F';
    // not necessary to add metadata
    if (!create) return 'E';
    // add missing metadata
    setMeta(it);
  // return object ID
  } return it[META].i;
};
var getWeak = function (it, create) {
  if (!has(it, META)) {
    // can't set metadata to uncaught frozen object
    if (!isExtensible(it)) return true;
    // not necessary to add metadata
    if (!create) return false;
    // add missing metadata
    setMeta(it);
  // return hash weak collections IDs
  } return it[META].w;
};
// add metadata on freeze-family methods calling
var onFreeze = function (it) {
  if (FREEZE && meta.NEED && isExtensible(it) && !has(it, META)) setMeta(it);
  return it;
};
var meta = module.exports = {
  KEY: META,
  NEED: false,
  fastKey: fastKey,
  getWeak: getWeak,
  onFreeze: onFreeze
};

},{"./_fails":42,"./_has":44,"./_is-object":50,"./_object-dp":58,"./_uid":81}],57:[function(require,module,exports){
// 19.1.2.2 / 15.2.3.5 Object.create(O [, Properties])
var anObject = require('./_an-object');
var dPs = require('./_object-dps');
var enumBugKeys = require('./_enum-bug-keys');
var IE_PROTO = require('./_shared-key')('IE_PROTO');
var Empty = function () { /* empty */ };
var PROTOTYPE = 'prototype';

// Create object with fake `null` prototype: use iframe Object with cleared prototype
var createDict = function () {
  // Thrash, waste and sodomy: IE GC bug
  var iframe = require('./_dom-create')('iframe');
  var i = enumBugKeys.length;
  var lt = '<';
  var gt = '>';
  var iframeDocument;
  iframe.style.display = 'none';
  require('./_html').appendChild(iframe);
  iframe.src = 'javascript:'; // eslint-disable-line no-script-url
  // createDict = iframe.contentWindow.Object;
  // html.removeChild(iframe);
  iframeDocument = iframe.contentWindow.document;
  iframeDocument.open();
  iframeDocument.write(lt + 'script' + gt + 'document.F=Object' + lt + '/script' + gt);
  iframeDocument.close();
  createDict = iframeDocument.F;
  while (i--) delete createDict[PROTOTYPE][enumBugKeys[i]];
  return createDict();
};

module.exports = Object.create || function create(O, Properties) {
  var result;
  if (O !== null) {
    Empty[PROTOTYPE] = anObject(O);
    result = new Empty();
    Empty[PROTOTYPE] = null;
    // add "__proto__" for Object.getPrototypeOf polyfill
    result[IE_PROTO] = O;
  } else result = createDict();
  return Properties === undefined ? result : dPs(result, Properties);
};

},{"./_an-object":31,"./_dom-create":38,"./_enum-bug-keys":39,"./_html":46,"./_object-dps":59,"./_shared-key":72}],58:[function(require,module,exports){
var anObject = require('./_an-object');
var IE8_DOM_DEFINE = require('./_ie8-dom-define');
var toPrimitive = require('./_to-primitive');
var dP = Object.defineProperty;

exports.f = require('./_descriptors') ? Object.defineProperty : function defineProperty(O, P, Attributes) {
  anObject(O);
  P = toPrimitive(P, true);
  anObject(Attributes);
  if (IE8_DOM_DEFINE) try {
    return dP(O, P, Attributes);
  } catch (e) { /* empty */ }
  if ('get' in Attributes || 'set' in Attributes) throw TypeError('Accessors not supported!');
  if ('value' in Attributes) O[P] = Attributes.value;
  return O;
};

},{"./_an-object":31,"./_descriptors":37,"./_ie8-dom-define":47,"./_to-primitive":80}],59:[function(require,module,exports){
var dP = require('./_object-dp');
var anObject = require('./_an-object');
var getKeys = require('./_object-keys');

module.exports = require('./_descriptors') ? Object.defineProperties : function defineProperties(O, Properties) {
  anObject(O);
  var keys = getKeys(Properties);
  var length = keys.length;
  var i = 0;
  var P;
  while (length > i) dP.f(O, P = keys[i++], Properties[P]);
  return O;
};

},{"./_an-object":31,"./_descriptors":37,"./_object-dp":58,"./_object-keys":66}],60:[function(require,module,exports){
var pIE = require('./_object-pie');
var createDesc = require('./_property-desc');
var toIObject = require('./_to-iobject');
var toPrimitive = require('./_to-primitive');
var has = require('./_has');
var IE8_DOM_DEFINE = require('./_ie8-dom-define');
var gOPD = Object.getOwnPropertyDescriptor;

exports.f = require('./_descriptors') ? gOPD : function getOwnPropertyDescriptor(O, P) {
  O = toIObject(O);
  P = toPrimitive(P, true);
  if (IE8_DOM_DEFINE) try {
    return gOPD(O, P);
  } catch (e) { /* empty */ }
  if (has(O, P)) return createDesc(!pIE.f.call(O, P), O[P]);
};

},{"./_descriptors":37,"./_has":44,"./_ie8-dom-define":47,"./_object-pie":67,"./_property-desc":69,"./_to-iobject":77,"./_to-primitive":80}],61:[function(require,module,exports){
// fallback for IE11 buggy Object.getOwnPropertyNames with iframe and window
var toIObject = require('./_to-iobject');
var gOPN = require('./_object-gopn').f;
var toString = {}.toString;

var windowNames = typeof window == 'object' && window && Object.getOwnPropertyNames
  ? Object.getOwnPropertyNames(window) : [];

var getWindowNames = function (it) {
  try {
    return gOPN(it);
  } catch (e) {
    return windowNames.slice();
  }
};

module.exports.f = function getOwnPropertyNames(it) {
  return windowNames && toString.call(it) == '[object Window]' ? getWindowNames(it) : gOPN(toIObject(it));
};

},{"./_object-gopn":62,"./_to-iobject":77}],62:[function(require,module,exports){
// 19.1.2.7 / 15.2.3.4 Object.getOwnPropertyNames(O)
var $keys = require('./_object-keys-internal');
var hiddenKeys = require('./_enum-bug-keys').concat('length', 'prototype');

exports.f = Object.getOwnPropertyNames || function getOwnPropertyNames(O) {
  return $keys(O, hiddenKeys);
};

},{"./_enum-bug-keys":39,"./_object-keys-internal":65}],63:[function(require,module,exports){
exports.f = Object.getOwnPropertySymbols;

},{}],64:[function(require,module,exports){
// 19.1.2.9 / 15.2.3.2 Object.getPrototypeOf(O)
var has = require('./_has');
var toObject = require('./_to-object');
var IE_PROTO = require('./_shared-key')('IE_PROTO');
var ObjectProto = Object.prototype;

module.exports = Object.getPrototypeOf || function (O) {
  O = toObject(O);
  if (has(O, IE_PROTO)) return O[IE_PROTO];
  if (typeof O.constructor == 'function' && O instanceof O.constructor) {
    return O.constructor.prototype;
  } return O instanceof Object ? ObjectProto : null;
};

},{"./_has":44,"./_shared-key":72,"./_to-object":79}],65:[function(require,module,exports){
var has = require('./_has');
var toIObject = require('./_to-iobject');
var arrayIndexOf = require('./_array-includes')(false);
var IE_PROTO = require('./_shared-key')('IE_PROTO');

module.exports = function (object, names) {
  var O = toIObject(object);
  var i = 0;
  var result = [];
  var key;
  for (key in O) if (key != IE_PROTO) has(O, key) && result.push(key);
  // Don't enum bug & hidden keys
  while (names.length > i) if (has(O, key = names[i++])) {
    ~arrayIndexOf(result, key) || result.push(key);
  }
  return result;
};

},{"./_array-includes":32,"./_has":44,"./_shared-key":72,"./_to-iobject":77}],66:[function(require,module,exports){
// 19.1.2.14 / 15.2.3.14 Object.keys(O)
var $keys = require('./_object-keys-internal');
var enumBugKeys = require('./_enum-bug-keys');

module.exports = Object.keys || function keys(O) {
  return $keys(O, enumBugKeys);
};

},{"./_enum-bug-keys":39,"./_object-keys-internal":65}],67:[function(require,module,exports){
exports.f = {}.propertyIsEnumerable;

},{}],68:[function(require,module,exports){
// most Object methods by ES6 should accept primitives
var $export = require('./_export');
var core = require('./_core');
var fails = require('./_fails');
module.exports = function (KEY, exec) {
  var fn = (core.Object || {})[KEY] || Object[KEY];
  var exp = {};
  exp[KEY] = exec(fn);
  $export($export.S + $export.F * fails(function () { fn(1); }), 'Object', exp);
};

},{"./_core":34,"./_export":41,"./_fails":42}],69:[function(require,module,exports){
module.exports = function (bitmap, value) {
  return {
    enumerable: !(bitmap & 1),
    configurable: !(bitmap & 2),
    writable: !(bitmap & 4),
    value: value
  };
};

},{}],70:[function(require,module,exports){
module.exports = require('./_hide');

},{"./_hide":45}],71:[function(require,module,exports){
var def = require('./_object-dp').f;
var has = require('./_has');
var TAG = require('./_wks')('toStringTag');

module.exports = function (it, tag, stat) {
  if (it && !has(it = stat ? it : it.prototype, TAG)) def(it, TAG, { configurable: true, value: tag });
};

},{"./_has":44,"./_object-dp":58,"./_wks":84}],72:[function(require,module,exports){
var shared = require('./_shared')('keys');
var uid = require('./_uid');
module.exports = function (key) {
  return shared[key] || (shared[key] = uid(key));
};

},{"./_shared":73,"./_uid":81}],73:[function(require,module,exports){
var global = require('./_global');
var SHARED = '__core-js_shared__';
var store = global[SHARED] || (global[SHARED] = {});
module.exports = function (key) {
  return store[key] || (store[key] = {});
};

},{"./_global":43}],74:[function(require,module,exports){
var toInteger = require('./_to-integer');
var defined = require('./_defined');
// true  -> String#at
// false -> String#codePointAt
module.exports = function (TO_STRING) {
  return function (that, pos) {
    var s = String(defined(that));
    var i = toInteger(pos);
    var l = s.length;
    var a, b;
    if (i < 0 || i >= l) return TO_STRING ? '' : undefined;
    a = s.charCodeAt(i);
    return a < 0xd800 || a > 0xdbff || i + 1 === l || (b = s.charCodeAt(i + 1)) < 0xdc00 || b > 0xdfff
      ? TO_STRING ? s.charAt(i) : a
      : TO_STRING ? s.slice(i, i + 2) : (a - 0xd800 << 10) + (b - 0xdc00) + 0x10000;
  };
};

},{"./_defined":36,"./_to-integer":76}],75:[function(require,module,exports){
var toInteger = require('./_to-integer');
var max = Math.max;
var min = Math.min;
module.exports = function (index, length) {
  index = toInteger(index);
  return index < 0 ? max(index + length, 0) : min(index, length);
};

},{"./_to-integer":76}],76:[function(require,module,exports){
// 7.1.4 ToInteger
var ceil = Math.ceil;
var floor = Math.floor;
module.exports = function (it) {
  return isNaN(it = +it) ? 0 : (it > 0 ? floor : ceil)(it);
};

},{}],77:[function(require,module,exports){
// to indexed object, toObject with fallback for non-array-like ES3 strings
var IObject = require('./_iobject');
var defined = require('./_defined');
module.exports = function (it) {
  return IObject(defined(it));
};

},{"./_defined":36,"./_iobject":48}],78:[function(require,module,exports){
// 7.1.15 ToLength
var toInteger = require('./_to-integer');
var min = Math.min;
module.exports = function (it) {
  return it > 0 ? min(toInteger(it), 0x1fffffffffffff) : 0; // pow(2, 53) - 1 == 9007199254740991
};

},{"./_to-integer":76}],79:[function(require,module,exports){
// 7.1.13 ToObject(argument)
var defined = require('./_defined');
module.exports = function (it) {
  return Object(defined(it));
};

},{"./_defined":36}],80:[function(require,module,exports){
// 7.1.1 ToPrimitive(input [, PreferredType])
var isObject = require('./_is-object');
// instead of the ES6 spec version, we didn't implement @@toPrimitive case
// and the second argument - flag - preferred type is a string
module.exports = function (it, S) {
  if (!isObject(it)) return it;
  var fn, val;
  if (S && typeof (fn = it.toString) == 'function' && !isObject(val = fn.call(it))) return val;
  if (typeof (fn = it.valueOf) == 'function' && !isObject(val = fn.call(it))) return val;
  if (!S && typeof (fn = it.toString) == 'function' && !isObject(val = fn.call(it))) return val;
  throw TypeError("Can't convert object to primitive value");
};

},{"./_is-object":50}],81:[function(require,module,exports){
var id = 0;
var px = Math.random();
module.exports = function (key) {
  return 'Symbol('.concat(key === undefined ? '' : key, ')_', (++id + px).toString(36));
};

},{}],82:[function(require,module,exports){
var global = require('./_global');
var core = require('./_core');
var LIBRARY = require('./_library');
var wksExt = require('./_wks-ext');
var defineProperty = require('./_object-dp').f;
module.exports = function (name) {
  var $Symbol = core.Symbol || (core.Symbol = LIBRARY ? {} : global.Symbol || {});
  if (name.charAt(0) != '_' && !(name in $Symbol)) defineProperty($Symbol, name, { value: wksExt.f(name) });
};

},{"./_core":34,"./_global":43,"./_library":55,"./_object-dp":58,"./_wks-ext":83}],83:[function(require,module,exports){
exports.f = require('./_wks');

},{"./_wks":84}],84:[function(require,module,exports){
var store = require('./_shared')('wks');
var uid = require('./_uid');
var Symbol = require('./_global').Symbol;
var USE_SYMBOL = typeof Symbol == 'function';

var $exports = module.exports = function (name) {
  return store[name] || (store[name] =
    USE_SYMBOL && Symbol[name] || (USE_SYMBOL ? Symbol : uid)('Symbol.' + name));
};

$exports.store = store;

},{"./_global":43,"./_shared":73,"./_uid":81}],85:[function(require,module,exports){
'use strict';
var addToUnscopables = require('./_add-to-unscopables');
var step = require('./_iter-step');
var Iterators = require('./_iterators');
var toIObject = require('./_to-iobject');

// 22.1.3.4 Array.prototype.entries()
// 22.1.3.13 Array.prototype.keys()
// 22.1.3.29 Array.prototype.values()
// 22.1.3.30 Array.prototype[@@iterator]()
module.exports = require('./_iter-define')(Array, 'Array', function (iterated, kind) {
  this._t = toIObject(iterated); // target
  this._i = 0;                   // next index
  this._k = kind;                // kind
// 22.1.5.2.1 %ArrayIteratorPrototype%.next()
}, function () {
  var O = this._t;
  var kind = this._k;
  var index = this._i++;
  if (!O || index >= O.length) {
    this._t = undefined;
    return step(1);
  }
  if (kind == 'keys') return step(0, index);
  if (kind == 'values') return step(0, O[index]);
  return step(0, [index, O[index]]);
}, 'values');

// argumentsList[@@iterator] is %ArrayProto_values% (9.4.4.6, 9.4.4.7)
Iterators.Arguments = Iterators.Array;

addToUnscopables('keys');
addToUnscopables('values');
addToUnscopables('entries');

},{"./_add-to-unscopables":30,"./_iter-define":52,"./_iter-step":53,"./_iterators":54,"./_to-iobject":77}],86:[function(require,module,exports){
var $export = require('./_export');
// 19.1.2.2 / 15.2.3.5 Object.create(O [, Properties])
$export($export.S, 'Object', { create: require('./_object-create') });

},{"./_export":41,"./_object-create":57}],87:[function(require,module,exports){
var $export = require('./_export');
// 19.1.2.3 / 15.2.3.7 Object.defineProperties(O, Properties)
$export($export.S + $export.F * !require('./_descriptors'), 'Object', { defineProperties: require('./_object-dps') });

},{"./_descriptors":37,"./_export":41,"./_object-dps":59}],88:[function(require,module,exports){
var $export = require('./_export');
// 19.1.2.4 / 15.2.3.6 Object.defineProperty(O, P, Attributes)
$export($export.S + $export.F * !require('./_descriptors'), 'Object', { defineProperty: require('./_object-dp').f });

},{"./_descriptors":37,"./_export":41,"./_object-dp":58}],89:[function(require,module,exports){
// 19.1.2.6 Object.getOwnPropertyDescriptor(O, P)
var toIObject = require('./_to-iobject');
var $getOwnPropertyDescriptor = require('./_object-gopd').f;

require('./_object-sap')('getOwnPropertyDescriptor', function () {
  return function getOwnPropertyDescriptor(it, key) {
    return $getOwnPropertyDescriptor(toIObject(it), key);
  };
});

},{"./_object-gopd":60,"./_object-sap":68,"./_to-iobject":77}],90:[function(require,module,exports){
// 19.1.2.7 Object.getOwnPropertyNames(O)
require('./_object-sap')('getOwnPropertyNames', function () {
  return require('./_object-gopn-ext').f;
});

},{"./_object-gopn-ext":61,"./_object-sap":68}],91:[function(require,module,exports){
// 19.1.2.9 Object.getPrototypeOf(O)
var toObject = require('./_to-object');
var $getPrototypeOf = require('./_object-gpo');

require('./_object-sap')('getPrototypeOf', function () {
  return function getPrototypeOf(it) {
    return $getPrototypeOf(toObject(it));
  };
});

},{"./_object-gpo":64,"./_object-sap":68,"./_to-object":79}],92:[function(require,module,exports){
// 19.1.2.11 Object.isExtensible(O)
var isObject = require('./_is-object');

require('./_object-sap')('isExtensible', function ($isExtensible) {
  return function isExtensible(it) {
    return isObject(it) ? $isExtensible ? $isExtensible(it) : true : false;
  };
});

},{"./_is-object":50,"./_object-sap":68}],93:[function(require,module,exports){
// 19.1.2.14 Object.keys(O)
var toObject = require('./_to-object');
var $keys = require('./_object-keys');

require('./_object-sap')('keys', function () {
  return function keys(it) {
    return $keys(toObject(it));
  };
});

},{"./_object-keys":66,"./_object-sap":68,"./_to-object":79}],94:[function(require,module,exports){
// 19.1.2.15 Object.preventExtensions(O)
var isObject = require('./_is-object');
var meta = require('./_meta').onFreeze;

require('./_object-sap')('preventExtensions', function ($preventExtensions) {
  return function preventExtensions(it) {
    return $preventExtensions && isObject(it) ? $preventExtensions(meta(it)) : it;
  };
});

},{"./_is-object":50,"./_meta":56,"./_object-sap":68}],95:[function(require,module,exports){
arguments[4][15][0].apply(exports,arguments)
},{"dup":15}],96:[function(require,module,exports){
'use strict';
var $at = require('./_string-at')(true);

// 21.1.3.27 String.prototype[@@iterator]()
require('./_iter-define')(String, 'String', function (iterated) {
  this._t = String(iterated); // target
  this._i = 0;                // next index
// 21.1.5.2.1 %StringIteratorPrototype%.next()
}, function () {
  var O = this._t;
  var index = this._i;
  var point;
  if (index >= O.length) return { value: undefined, done: true };
  point = $at(O, index);
  this._i += point.length;
  return { value: point, done: false };
});

},{"./_iter-define":52,"./_string-at":74}],97:[function(require,module,exports){
'use strict';
// ECMAScript 6 symbols shim
var global = require('./_global');
var has = require('./_has');
var DESCRIPTORS = require('./_descriptors');
var $export = require('./_export');
var redefine = require('./_redefine');
var META = require('./_meta').KEY;
var $fails = require('./_fails');
var shared = require('./_shared');
var setToStringTag = require('./_set-to-string-tag');
var uid = require('./_uid');
var wks = require('./_wks');
var wksExt = require('./_wks-ext');
var wksDefine = require('./_wks-define');
var enumKeys = require('./_enum-keys');
var isArray = require('./_is-array');
var anObject = require('./_an-object');
var toIObject = require('./_to-iobject');
var toPrimitive = require('./_to-primitive');
var createDesc = require('./_property-desc');
var _create = require('./_object-create');
var gOPNExt = require('./_object-gopn-ext');
var $GOPD = require('./_object-gopd');
var $DP = require('./_object-dp');
var $keys = require('./_object-keys');
var gOPD = $GOPD.f;
var dP = $DP.f;
var gOPN = gOPNExt.f;
var $Symbol = global.Symbol;
var $JSON = global.JSON;
var _stringify = $JSON && $JSON.stringify;
var PROTOTYPE = 'prototype';
var HIDDEN = wks('_hidden');
var TO_PRIMITIVE = wks('toPrimitive');
var isEnum = {}.propertyIsEnumerable;
var SymbolRegistry = shared('symbol-registry');
var AllSymbols = shared('symbols');
var OPSymbols = shared('op-symbols');
var ObjectProto = Object[PROTOTYPE];
var USE_NATIVE = typeof $Symbol == 'function';
var QObject = global.QObject;
// Don't use setters in Qt Script, https://github.com/zloirock/core-js/issues/173
var setter = !QObject || !QObject[PROTOTYPE] || !QObject[PROTOTYPE].findChild;

// fallback for old Android, https://code.google.com/p/v8/issues/detail?id=687
var setSymbolDesc = DESCRIPTORS && $fails(function () {
  return _create(dP({}, 'a', {
    get: function () { return dP(this, 'a', { value: 7 }).a; }
  })).a != 7;
}) ? function (it, key, D) {
  var protoDesc = gOPD(ObjectProto, key);
  if (protoDesc) delete ObjectProto[key];
  dP(it, key, D);
  if (protoDesc && it !== ObjectProto) dP(ObjectProto, key, protoDesc);
} : dP;

var wrap = function (tag) {
  var sym = AllSymbols[tag] = _create($Symbol[PROTOTYPE]);
  sym._k = tag;
  return sym;
};

var isSymbol = USE_NATIVE && typeof $Symbol.iterator == 'symbol' ? function (it) {
  return typeof it == 'symbol';
} : function (it) {
  return it instanceof $Symbol;
};

var $defineProperty = function defineProperty(it, key, D) {
  if (it === ObjectProto) $defineProperty(OPSymbols, key, D);
  anObject(it);
  key = toPrimitive(key, true);
  anObject(D);
  if (has(AllSymbols, key)) {
    if (!D.enumerable) {
      if (!has(it, HIDDEN)) dP(it, HIDDEN, createDesc(1, {}));
      it[HIDDEN][key] = true;
    } else {
      if (has(it, HIDDEN) && it[HIDDEN][key]) it[HIDDEN][key] = false;
      D = _create(D, { enumerable: createDesc(0, false) });
    } return setSymbolDesc(it, key, D);
  } return dP(it, key, D);
};
var $defineProperties = function defineProperties(it, P) {
  anObject(it);
  var keys = enumKeys(P = toIObject(P));
  var i = 0;
  var l = keys.length;
  var key;
  while (l > i) $defineProperty(it, key = keys[i++], P[key]);
  return it;
};
var $create = function create(it, P) {
  return P === undefined ? _create(it) : $defineProperties(_create(it), P);
};
var $propertyIsEnumerable = function propertyIsEnumerable(key) {
  var E = isEnum.call(this, key = toPrimitive(key, true));
  if (this === ObjectProto && has(AllSymbols, key) && !has(OPSymbols, key)) return false;
  return E || !has(this, key) || !has(AllSymbols, key) || has(this, HIDDEN) && this[HIDDEN][key] ? E : true;
};
var $getOwnPropertyDescriptor = function getOwnPropertyDescriptor(it, key) {
  it = toIObject(it);
  key = toPrimitive(key, true);
  if (it === ObjectProto && has(AllSymbols, key) && !has(OPSymbols, key)) return;
  var D = gOPD(it, key);
  if (D && has(AllSymbols, key) && !(has(it, HIDDEN) && it[HIDDEN][key])) D.enumerable = true;
  return D;
};
var $getOwnPropertyNames = function getOwnPropertyNames(it) {
  var names = gOPN(toIObject(it));
  var result = [];
  var i = 0;
  var key;
  while (names.length > i) {
    if (!has(AllSymbols, key = names[i++]) && key != HIDDEN && key != META) result.push(key);
  } return result;
};
var $getOwnPropertySymbols = function getOwnPropertySymbols(it) {
  var IS_OP = it === ObjectProto;
  var names = gOPN(IS_OP ? OPSymbols : toIObject(it));
  var result = [];
  var i = 0;
  var key;
  while (names.length > i) {
    if (has(AllSymbols, key = names[i++]) && (IS_OP ? has(ObjectProto, key) : true)) result.push(AllSymbols[key]);
  } return result;
};

// 19.4.1.1 Symbol([description])
if (!USE_NATIVE) {
  $Symbol = function Symbol() {
    if (this instanceof $Symbol) throw TypeError('Symbol is not a constructor!');
    var tag = uid(arguments.length > 0 ? arguments[0] : undefined);
    var $set = function (value) {
      if (this === ObjectProto) $set.call(OPSymbols, value);
      if (has(this, HIDDEN) && has(this[HIDDEN], tag)) this[HIDDEN][tag] = false;
      setSymbolDesc(this, tag, createDesc(1, value));
    };
    if (DESCRIPTORS && setter) setSymbolDesc(ObjectProto, tag, { configurable: true, set: $set });
    return wrap(tag);
  };
  redefine($Symbol[PROTOTYPE], 'toString', function toString() {
    return this._k;
  });

  $GOPD.f = $getOwnPropertyDescriptor;
  $DP.f = $defineProperty;
  require('./_object-gopn').f = gOPNExt.f = $getOwnPropertyNames;
  require('./_object-pie').f = $propertyIsEnumerable;
  require('./_object-gops').f = $getOwnPropertySymbols;

  if (DESCRIPTORS && !require('./_library')) {
    redefine(ObjectProto, 'propertyIsEnumerable', $propertyIsEnumerable, true);
  }

  wksExt.f = function (name) {
    return wrap(wks(name));
  };
}

$export($export.G + $export.W + $export.F * !USE_NATIVE, { Symbol: $Symbol });

for (var es6Symbols = (
  // 19.4.2.2, 19.4.2.3, 19.4.2.4, 19.4.2.6, 19.4.2.8, 19.4.2.9, 19.4.2.10, 19.4.2.11, 19.4.2.12, 19.4.2.13, 19.4.2.14
  'hasInstance,isConcatSpreadable,iterator,match,replace,search,species,split,toPrimitive,toStringTag,unscopables'
).split(','), j = 0; es6Symbols.length > j;)wks(es6Symbols[j++]);

for (var wellKnownSymbols = $keys(wks.store), k = 0; wellKnownSymbols.length > k;) wksDefine(wellKnownSymbols[k++]);

$export($export.S + $export.F * !USE_NATIVE, 'Symbol', {
  // 19.4.2.1 Symbol.for(key)
  'for': function (key) {
    return has(SymbolRegistry, key += '')
      ? SymbolRegistry[key]
      : SymbolRegistry[key] = $Symbol(key);
  },
  // 19.4.2.5 Symbol.keyFor(sym)
  keyFor: function keyFor(sym) {
    if (!isSymbol(sym)) throw TypeError(sym + ' is not a symbol!');
    for (var key in SymbolRegistry) if (SymbolRegistry[key] === sym) return key;
  },
  useSetter: function () { setter = true; },
  useSimple: function () { setter = false; }
});

$export($export.S + $export.F * !USE_NATIVE, 'Object', {
  // 19.1.2.2 Object.create(O [, Properties])
  create: $create,
  // 19.1.2.4 Object.defineProperty(O, P, Attributes)
  defineProperty: $defineProperty,
  // 19.1.2.3 Object.defineProperties(O, Properties)
  defineProperties: $defineProperties,
  // 19.1.2.6 Object.getOwnPropertyDescriptor(O, P)
  getOwnPropertyDescriptor: $getOwnPropertyDescriptor,
  // 19.1.2.7 Object.getOwnPropertyNames(O)
  getOwnPropertyNames: $getOwnPropertyNames,
  // 19.1.2.8 Object.getOwnPropertySymbols(O)
  getOwnPropertySymbols: $getOwnPropertySymbols
});

// 24.3.2 JSON.stringify(value [, replacer [, space]])
$JSON && $export($export.S + $export.F * (!USE_NATIVE || $fails(function () {
  var S = $Symbol();
  // MS Edge converts symbol values to JSON as {}
  // WebKit converts symbol values to JSON as null
  // V8 throws on boxed symbols
  return _stringify([S]) != '[null]' || _stringify({ a: S }) != '{}' || _stringify(Object(S)) != '{}';
})), 'JSON', {
  stringify: function stringify(it) {
    if (it === undefined || isSymbol(it)) return; // IE8 returns string on undefined
    var args = [it];
    var i = 1;
    var replacer, $replacer;
    while (arguments.length > i) args.push(arguments[i++]);
    replacer = args[1];
    if (typeof replacer == 'function') $replacer = replacer;
    if ($replacer || !isArray(replacer)) replacer = function (key, value) {
      if ($replacer) value = $replacer.call(this, key, value);
      if (!isSymbol(value)) return value;
    };
    args[1] = replacer;
    return _stringify.apply($JSON, args);
  }
});

// 19.4.3.4 Symbol.prototype[@@toPrimitive](hint)
$Symbol[PROTOTYPE][TO_PRIMITIVE] || require('./_hide')($Symbol[PROTOTYPE], TO_PRIMITIVE, $Symbol[PROTOTYPE].valueOf);
// 19.4.3.5 Symbol.prototype[@@toStringTag]
setToStringTag($Symbol, 'Symbol');
// 20.2.1.9 Math[@@toStringTag]
setToStringTag(Math, 'Math', true);
// 24.3.3 JSON[@@toStringTag]
setToStringTag(global.JSON, 'JSON', true);

},{"./_an-object":31,"./_descriptors":37,"./_enum-keys":40,"./_export":41,"./_fails":42,"./_global":43,"./_has":44,"./_hide":45,"./_is-array":49,"./_library":55,"./_meta":56,"./_object-create":57,"./_object-dp":58,"./_object-gopd":60,"./_object-gopn":62,"./_object-gopn-ext":61,"./_object-gops":63,"./_object-keys":66,"./_object-pie":67,"./_property-desc":69,"./_redefine":70,"./_set-to-string-tag":71,"./_shared":73,"./_to-iobject":77,"./_to-primitive":80,"./_uid":81,"./_wks":84,"./_wks-define":82,"./_wks-ext":83}],98:[function(require,module,exports){
require('./_wks-define')('asyncIterator');

},{"./_wks-define":82}],99:[function(require,module,exports){
require('./_wks-define')('observable');

},{"./_wks-define":82}],100:[function(require,module,exports){
require('./es6.array.iterator');
var global = require('./_global');
var hide = require('./_hide');
var Iterators = require('./_iterators');
var TO_STRING_TAG = require('./_wks')('toStringTag');

var DOMIterables = ('CSSRuleList,CSSStyleDeclaration,CSSValueList,ClientRectList,DOMRectList,DOMStringList,' +
  'DOMTokenList,DataTransferItemList,FileList,HTMLAllCollection,HTMLCollection,HTMLFormElement,HTMLSelectElement,' +
  'MediaList,MimeTypeArray,NamedNodeMap,NodeList,PaintRequestList,Plugin,PluginArray,SVGLengthList,SVGNumberList,' +
  'SVGPathSegList,SVGPointList,SVGStringList,SVGTransformList,SourceBufferList,StyleSheetList,TextTrackCueList,' +
  'TextTrackList,TouchList').split(',');

for (var i = 0; i < DOMIterables.length; i++) {
  var NAME = DOMIterables[i];
  var Collection = global[NAME];
  var proto = Collection && Collection.prototype;
  if (proto && !proto[TO_STRING_TAG]) hide(proto, TO_STRING_TAG, NAME);
  Iterators[NAME] = Iterators.Array;
}

},{"./_global":43,"./_hide":45,"./_iterators":54,"./_wks":84,"./es6.array.iterator":85}],101:[function(require,module,exports){
"use strict";

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol ? "symbol" : typeof obj; };

var flatpickr = function flatpickr(selector, config) {
	var elements = void 0;

	var createInstance = function createInstance(element) {
		if (element._flatpickr) {
			element._flatpickr.destroy();
		}

		element._flatpickr = new flatpickr.init(element, config);
		return element._flatpickr;
	};

	if (selector.nodeName) {
		return createInstance(selector);
	}
	/*
 Utilize the performance of native getters if applicable
 https://jsperf.com/getelementsbyclassname-vs-queryselectorall/18
 https://jsperf.com/jquery-vs-javascript-performance-comparison/22
 */
	else if (/^#[a-zA-Z0-9\-_]*$/.test(selector)) {
			return createInstance(document.getElementById(selector.slice(1)));
		} else if (/^\.[a-zA-Z0-9\-_]*$/.test(selector)) {
			elements = document.getElementsByClassName(selector.slice(1));
		} else {
			elements = document.querySelectorAll(selector);
		}

	var instances = [];

	for (var i = 0; i < elements.length; i++) {
		instances.push(createInstance(elements[i]));
	}

	if (instances.length === 1) {
		return instances[0];
	}

	return {
		calendars: instances,
		byID: function byID(id) {
			return document.getElementById(id)._flatpickr;
		}
	};
};

/**
 * @constructor
 */
flatpickr.init = function (element, instanceConfig) {
	function createElement(tag, className, content) {
		var newElement = document.createElement(tag);

		if (content) {
			newElement.textContent = content;
		}

		if (className) {
			newElement.className = className;
		}

		return newElement;
	}

	var debounce = function debounce(func, wait, immediate) {
		var timeout = void 0;
		return function () {
			for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {
				args[_key] = arguments[_key];
			}

			var context = this;

			var later = function later() {
				timeout = null;
				if (!immediate) {
					func.apply(context, args);
				}
			};

			clearTimeout(timeout);
			timeout = setTimeout(later, wait);
			if (immediate && !timeout) {
				func.apply(context, args);
			}
		};
	};

	// functions
	var self = this;
	var parseConfig = void 0,
	    init = void 0,
	    wrap = void 0,
	    uDate = void 0,
	    equalDates = void 0,
	    pad = void 0,
	    monthToStr = void 0,
	    isEnabled = void 0,
	    buildMonthNavigation = void 0,
	    buildWeekdays = void 0,
	    buildCalendar = void 0,
	    buildDays = void 0,
	    buildWeeks = void 0,
	    buildTime = void 0,
	    timeWrapper = void 0,
	    yearScroll = void 0,
	    updateValue = void 0,
	    amPMToggle = void 0,
	    onKeyDown = void 0,
	    onResize = void 0,
	    updateNavigationCurrentMonth = void 0,
	    handleYearChange = void 0,
	    changeMonth = void 0,
	    getDaysinMonth = void 0,
	    documentClick = void 0,
	    selectDate = void 0,
	    getRandomCalendarIdStr = void 0,
	    bind = void 0,
	    triggerChange = void 0;

	// elements & variables
	var calendarContainer = void 0,
	    weekdayContainer = void 0,
	    timeContainer = void 0,
	    navigationCurrentMonth = void 0,
	    monthsNav = void 0,
	    prevMonthNav = void 0,
	    currentYearElement = void 0,
	    currentMonthElement = void 0,
	    nextMonthNav = void 0,
	    calendar = void 0,
	    weekNumbers = void 0,
	    now = new Date(),
	    wrapperElement = void 0,
	    clickEvt = void 0;

	self.formats = {
		// weekday name, short, e.g. Thu
		D: function D() {
			return self.l10n.weekdays.shorthand[self.formats.w()];
		},

		// full month name e.g. January
		F: function F() {
			return monthToStr(self.formats.n() - 1, false);
		},

		// hours with leading zero e.g. 03
		H: function H() {
			return pad(self.selectedDateObj.getHours());
		},

		// day (1-30) with ordinal suffix e.g. 1st, 2nd
		J: function J() {
			return self.formats.j() + self.l10n.ordinal(self.formats.j());
		},

		// AM/PM
		K: function K() {
			return self.selectedDateObj.getHours() > 11 ? "PM" : "AM";
		},

		// shorthand month e.g. Jan, Sep, Oct, etc
		M: function M() {
			return monthToStr(self.formats.n() - 1, true);
		},

		// seconds 00-59
		S: function S() {
			return pad(self.selectedDateObj.getSeconds());
		},

		// unix timestamp
		U: function U() {
			return self.selectedDateObj.getTime() / 1000;
		},

		// full year e.g. 2016
		Y: function Y() {
			return self.selectedDateObj.getFullYear();
		},

		// day in month, padded (01-30)
		d: function d() {
			return pad(self.formats.j());
		},

		// hour from 1-12 (am/pm)
		h: function h() {
			return self.selectedDateObj.getHours() % 12 ? self.selectedDateObj.getHours() % 12 : 12;
		},

		// minutes, padded with leading zero e.g. 09
		i: function i() {
			return pad(self.selectedDateObj.getMinutes());
		},

		// day in month (1-30)
		j: function j() {
			return self.selectedDateObj.getDate();
		},

		// weekday name, full, e.g. Thursday
		l: function l() {
			return self.l10n.weekdays.longhand[self.formats.w()];
		},

		// padded month number (01-12)
		m: function m() {
			return pad(self.formats.n());
		},

		// the month number (1-12)
		n: function n() {
			return self.selectedDateObj.getMonth() + 1;
		},

		// seconds 0-59
		s: function s() {
			return self.selectedDateObj.getSeconds();
		},

		// number of the day of the week
		w: function w() {
			return self.selectedDateObj.getDay();
		},

		// last two digits of year e.g. 16 for 2016
		y: function y() {
			return String(self.formats.Y()).substring(2);
		}
	};

	self.defaultConfig = {
		/* if true, dates will be parsed, formatted, and displayed in UTC.
  preloading date strings w/ timezones is recommended but not necessary */
		utc: false,

		// wrap: see https://chmln.github.io/flatpickr/#strap
		wrap: false,

		// enables week numbers
		weekNumbers: false,

		allowInput: false,

		/*
  	clicking on input opens the date(time)picker.
  	disable if you wish to open the calendar manually with .open()
  */
		clickOpens: true,

		// display time picker in 24 hour mode
		time_24hr: false,

		// enables the time picker functionality
		enableTime: false,

		// noCalendar: true will hide the calendar. use for a time picker along w/ enableTime
		noCalendar: false,

		// more date format chars at https://chmln.github.io/flatpickr/#dateformat
		dateFormat: "Y-m-d",

		// altInput - see https://chmln.github.io/flatpickr/#altinput
		altInput: false,

		// the created altInput element will have this class.
		altInputClass: "",

		// same as dateFormat, but for altInput
		altFormat: "F j, Y", // defaults to e.g. June 10, 2016

		// defaultDate - either a datestring or a date object. used for datetimepicker"s initial value
		defaultDate: null,

		// the minimum date that user can pick (inclusive)
		minDate: null,

		// the maximum date that user can pick (inclusive)
		maxDate: null,

		// dateparser that transforms a given string to a date object
		parseDate: null,

		// see https://chmln.github.io/flatpickr/#disable
		enable: [],

		// see https://chmln.github.io/flatpickr/#disable
		disable: [],

		// display the short version of month names - e.g. Sep instead of September
		shorthandCurrentMonth: false,

		// displays calendar inline. see https://chmln.github.io/flatpickr/#inline-calendar
		inline: false,

		// position calendar inside wrapper and next to the input element
		// leave at false unless you know what you"re doing
		static: false,

		// code for previous/next icons. this is where you put your custom icon code e.g. fontawesome
		prevArrow: "&lt;",
		nextArrow: "&gt;",

		// enables seconds in the time picker
		enableSeconds: false,

		// step size used when scrolling/incrementing the hour element
		hourIncrement: 1,

		// step size used when scrolling/incrementing the minute element
		minuteIncrement: 5,

		// onChange callback when user selects a date or time
		onChange: null, // function (dateObj, dateStr) {}

		// called every time calendar is opened
		onOpen: null, // function (dateObj, dateStr) {}

		// called every time calendar is closed
		onClose: null, // function (dateObj, dateStr) {}

		onValueUpdate: null
	};

	init = function init() {
		instanceConfig = instanceConfig || {};

		self.element = element;

		parseConfig();

		self.input = self.config.wrap ? element.querySelector("[data-input]") : element;
		self.input.classList.add("flatpickr-input");

		if (self.config.defaultDate) {
			self.config.defaultDate = uDate(self.config.defaultDate);
		}

		if (self.input.value || self.config.defaultDate) {
			self.selectedDateObj = uDate(self.config.defaultDate || self.input.value);
		}

		wrap();
		buildCalendar();
		bind();

		self.uDate = uDate;
		self.jumpToDate();
		updateValue();
	};

	parseConfig = function parseConfig() {
		self.config = {};

		Object.keys(self.defaultConfig).forEach(function (key) {
			if (instanceConfig.hasOwnProperty(key)) {
				self.config[key] = instanceConfig[key];
			} else if (self.element.dataset && self.element.dataset.hasOwnProperty(key.toLowerCase())) {
				self.config[key] = self.element.dataset[key.toLowerCase()];
			} else if (!self.element.dataset && self.element.hasAttribute("data-" + key)) {
				self.config[key] = self.element.getAttribute("data-" + key);
			} else {
				self.config[key] = flatpickr.init.prototype.defaultConfig[key] || self.defaultConfig[key];
			}

			if (typeof self.defaultConfig[key] === "boolean") {
				self.config[key] = self.config[key] === true || self.config[key] === "" || self.config[key] === "true";
			}

			if (key === "enableTime" && self.config[key]) {
				self.defaultConfig.dateFormat = !self.config.time_24hr ? "Y-m-d h:i K" : "Y-m-d H:i";
				self.defaultConfig.altFormat = !self.config.time_24hr ? "F j Y, h:i K" : "F j, Y H:i";
			} else if (key === "noCalendar" && self.config[key]) {
				self.defaultConfig.dateFormat = "h:i K";
				self.defaultConfig.altFormat = "h:i K";
			}
		});
	};

	getRandomCalendarIdStr = function getRandomCalendarIdStr() {
		var randNum = void 0,
		    idStr = void 0;
		do {
			randNum = Math.round(Math.random() * Math.pow(10, 10));
			idStr = "flatpickr-" + randNum;
		} while (document.getElementById(idStr) !== null);

		return idStr;
	};

	uDate = function uDate(date, timeless) {
		timeless = timeless || false;

		if (date === "today") {
			date = new Date();
			timeless = true;
		} else if (typeof date === "string") {
			date = date.trim();

			if (self.config.parseDate) {
				date = self.config.parseDate(date);
			} else if (/^\d\d\d\d\-\d{1,2}\-\d\d$/.test(date)) {
				// this utc datestring gets parsed, but incorrectly by Date.parse
				date = new Date(date.replace(/(\d)-(\d)/g, "$1/$2"));
			} else if (Date.parse(date)) {
				date = new Date(date);
			} else if (/^\d\d\d\d\-\d\d\-\d\d/.test(date)) {
				// disable special utc datestring
				date = new Date(date.replace(/(\d)-(\d)/g, "$1/$2"));
			} else if (/^(\d?\d):(\d\d)/.test(date)) {
				// time-only picker
				var matches = date.match(/^(\d?\d):(\d\d)(:(\d\d))?/),
				    seconds = matches[4] !== undefined ? matches[4] : 0;

				date = new Date();
				date.setHours(matches[1], matches[2], seconds, 0);
			} else {
				console.error("flatpickr: invalid date string " + date);
				console.info(self.element);
			}
		}

		if (!(date instanceof Date) || !date.getTime()) {
			return null;
		}

		if (self.config.utc && !date.fp_isUTC) {
			date = date.fp_toUTC();
		}

		if (timeless) {
			date.setHours(0, 0, 0, 0);
		}

		return date;
	};

	equalDates = function equalDates(date1, date2) {
		return date1.getDate() === date2.getDate() && date1.getMonth() === date2.getMonth() && date1.getFullYear() === date2.getFullYear();
	};

	wrap = function wrap() {
		wrapperElement = createElement("div", "flatpickr-wrapper");

		if (self.config.inline || self.config.static) {
			// Wrap input and place calendar underneath
			self.element.parentNode.insertBefore(wrapperElement, self.element);
			wrapperElement.appendChild(self.element);

			wrapperElement.classList.add(self.config.inline ? "inline" : "static");
		} else {
			// Insert at bottom of BODY tag to display outside
			// of relative positioned elements with css "overflow: hidden;"
			// property set.
			document.body.appendChild(wrapperElement);
		}

		if (self.config.altInput) {
			// replicate self.element
			self.altInput = createElement(self.input.nodeName, self.config.altInputClass + " flatpickr-input");
			self.altInput.placeholder = self.input.placeholder;
			self.altInput.type = "text";

			self.input.type = "hidden";
			self.input.parentNode.insertBefore(self.altInput, self.input.nextSibling);
		}
	};

	getDaysinMonth = function getDaysinMonth() {
		var month = arguments.length <= 0 || arguments[0] === undefined ? self.currentMonth : arguments[0];

		var yr = self.currentYear;

		if (month === 1 && (yr % 4 === 0 && yr % 100 !== 0 || yr % 400 === 0)) {
			return 29;
		}

		return self.l10n.daysInMonth[month];
	};

	updateValue = function updateValue(e) {
		if (self.config.noCalendar && !self.selectedDateObj) {
			// picking time only and method triggered from picker
			self.selectedDateObj = new Date();
		} else if (!self.selectedDateObj) {
			return;
		}

		if (e) {
			e.target.blur();
		}

		var timeHasChanged = void 0;

		if (self.config.enableTime) {
			var previousTimestamp = self.selectedDateObj.getTime();

			// update time
			var hours = parseInt(self.hourElement.value, 10) || 0,
			    seconds = void 0;

			var minutes = (60 + (parseInt(self.minuteElement.value, 10) || 0)) % 60;

			if (self.config.enableSeconds) {
				seconds = (60 + parseInt(self.secondElement.value, 10) || 0) % 60;
			}

			if (!self.config.time_24hr) {
				// the real number of hours for the date object
				hours = hours % 12 + 12 * (self.amPM.innerHTML === "PM");
			}

			self.selectedDateObj.setHours(hours, minutes, seconds === undefined ? self.selectedDateObj.getSeconds() : seconds);

			self.hourElement.value = pad(!self.config.time_24hr ? (12 + hours) % 12 + 12 * (hours % 12 === 0) : hours);
			self.minuteElement.value = pad(minutes);

			if (seconds !== undefined) {
				self.secondElement.value = pad(seconds);
			}

			timeHasChanged = self.selectedDateObj.getTime() !== previousTimestamp;
		}

		self.input.value = self.formatDate(self.config.dateFormat);

		if (self.altInput) {
			self.altInput.value = self.formatDate(self.config.altFormat);
		}

		if (e && (timeHasChanged || e.target.classList.contains("flatpickr-day"))) {
			triggerChange();
		}

		if (self.config.onValueUpdate) {
			self.config.onValueUpdate(self.selectedDateObj, self.input.value, self);
		}
	};

	pad = function pad(num) {
		return ("0" + num).slice(-2);
	};

	self.formatDate = function (dateFormat) {
		var formattedDate = "";
		var formatPieces = dateFormat.split("");

		for (var i = 0; i < formatPieces.length; i++) {
			var c = formatPieces[i];
			if (self.formats.hasOwnProperty(c) && formatPieces[i - 1] !== "\\") {
				formattedDate += self.formats[c]();
			} else if (c !== "\\") {
				formattedDate += c;
			}
		}

		return formattedDate;
	};

	monthToStr = function monthToStr(date, shorthand) {
		if (shorthand || self.config.shorthandCurrentMonth) {
			return self.l10n.months.shorthand[date];
		}

		return self.l10n.months.longhand[date];
	};

	isEnabled = function isEnabled(dateToCheck) {
		if (self.config.minDate && dateToCheck < self.config.minDate || self.config.maxDate && dateToCheck > self.config.maxDate) {
			return false;
		}

		dateToCheck = uDate(dateToCheck, true); // timeless

		var bool = self.config.enable.length > 0,
		    array = bool ? self.config.enable : self.config.disable;

		var d = void 0;

		for (var i = 0; i < array.length; i++) {
			d = array[i];

			if (d instanceof Function && d(dateToCheck)) {
				// disabled by function
				return bool;
			} else if ( // disabled weekday
			typeof d === "string" && /^wkd/.test(d) && dateToCheck.getDay() === (parseInt(d.slice(-1), 10) + self.l10n.firstDayOfWeek - 1) % 7) {
				return bool;
			} else if ((d instanceof Date || typeof d === "string" && !/^wkd/.test(d)) && uDate(d, true).getTime() === dateToCheck.getTime()) {
				// disabled by date string
				return bool;
			} else if ( // disabled by range
			(typeof d === "undefined" ? "undefined" : _typeof(d)) === "object" && d.hasOwnProperty("from") && dateToCheck >= uDate(d.from) && dateToCheck <= uDate(d.to)) {
				return bool;
			}
		}

		return !bool;
	};

	yearScroll = function yearScroll(event) {
		event.preventDefault();

		var delta = Math.max(-1, Math.min(1, event.wheelDelta || -event.deltaY));
		self.currentYear = event.target.value = parseInt(event.target.value, 10) + delta;
		self.redraw();
	};

	timeWrapper = function timeWrapper(e) {
		e.preventDefault();

		var min = parseInt(e.target.min, 10),
		    max = parseInt(e.target.max, 10),
		    step = parseInt(e.target.step, 10),
		    value = parseInt(e.target.value, 10);

		var newValue = value;

		if (e.type === "wheel") {
			newValue = value + step * Math.max(-1, Math.min(1, e.wheelDelta || -e.deltaY));
		}

		if (newValue <= min) {
			newValue = max - step;
		} else if (newValue >= max) {
			newValue = min + step;
		}

		e.target.value = pad(newValue);
	};

	updateNavigationCurrentMonth = function updateNavigationCurrentMonth() {
		currentMonthElement.textContent = monthToStr(self.currentMonth) + " ";
		currentYearElement.value = self.currentYear;
	};

	handleYearChange = function handleYearChange() {
		if (self.currentMonth < 0 || self.currentMonth > 11) {
			self.currentYear += self.currentMonth % 11;
			self.currentMonth = (self.currentMonth + 12) % 12;
		}
	};

	documentClick = function documentClick(e) {
		var isCalendarElement = wrapperElement.contains(e.relatedTarget || e.target),
		    isInput = self.element.contains(e.relatedTarget || e.target) || e.relatedTarget || e.target === self.altInput;

		if (self.isOpen && !isCalendarElement && !isInput) {
			self.close();
		}
	};

	changeMonth = function changeMonth(offset) {
		self.currentMonth += offset;

		handleYearChange();
		updateNavigationCurrentMonth();
		buildDays();
		(self.config.noCalendar ? timeContainer : calendar).focus();
	};

	selectDate = function selectDate(e) {
		e.preventDefault();
		e.stopPropagation();

		if (self.config.allowInput && e.target === (self.altInput || self.input) && e.which === 13) {
			self.setDate((self.altInput || self.input).value);
			self.redraw();
		} else if (e.target.classList.contains("flatpickr-day")) {
			var isPrevMonthDay = e.target.classList.contains("prevMonthDay"),
			    isNextMonthDay = e.target.classList.contains("nextMonthDay"),
			    monthNum = self.currentMonth - isPrevMonthDay + isNextMonthDay;

			if (isPrevMonthDay || isNextMonthDay) {
				changeMonth(+isNextMonthDay - isPrevMonthDay);
			}

			self.selectedDateObj = new Date(self.currentYear, monthNum, e.target.innerHTML);

			updateValue(e);
			buildDays();

			if (!self.config.enableTime) {
				self.close();
			}
		}
	};

	buildCalendar = function buildCalendar() {
		calendarContainer = createElement("div", "flatpickr-calendar");
		calendarContainer.id = getRandomCalendarIdStr();

		calendar = createElement("div", "flatpickr-days");
		calendar.tabIndex = -1;

		if (!self.config.noCalendar) {
			buildMonthNavigation();
			buildWeekdays();

			if (self.config.weekNumbers) {
				buildWeeks();
			}

			buildDays();

			calendarContainer.appendChild(calendar);
		}

		wrapperElement.appendChild(calendarContainer);

		if (self.config.enableTime) {
			buildTime();
		}
	};

	buildMonthNavigation = function buildMonthNavigation() {
		monthsNav = createElement("div", "flatpickr-month");

		prevMonthNav = createElement("span", "flatpickr-prev-month");
		prevMonthNav.innerHTML = self.config.prevArrow;

		currentMonthElement = createElement("span", "cur_month");

		currentYearElement = createElement("input", "cur_year");
		currentYearElement.type = "number";
		currentYearElement.title = self.l10n.scrollTitle;

		nextMonthNav = createElement("span", "flatpickr-next-month");
		nextMonthNav.innerHTML = self.config.nextArrow;

		navigationCurrentMonth = createElement("span", "flatpickr-current-month");
		navigationCurrentMonth.appendChild(currentMonthElement);
		navigationCurrentMonth.appendChild(currentYearElement);

		monthsNav.appendChild(prevMonthNav);
		monthsNav.appendChild(navigationCurrentMonth);
		monthsNav.appendChild(nextMonthNav);

		calendarContainer.appendChild(monthsNav);
		updateNavigationCurrentMonth();
	};

	buildWeekdays = function buildWeekdays() {
		weekdayContainer = createElement("div", "flatpickr-weekdays");
		var firstDayOfWeek = self.l10n.firstDayOfWeek;

		var weekdays = self.l10n.weekdays.shorthand.slice();

		if (firstDayOfWeek > 0 && firstDayOfWeek < weekdays.length) {
			weekdays = [].concat(weekdays.splice(firstDayOfWeek, weekdays.length), weekdays.splice(0, firstDayOfWeek));
		}

		if (self.config.weekNumbers) {
			weekdayContainer.innerHTML = "<span>" + self.l10n.weekAbbreviation + "</span>";
		}

		weekdayContainer.innerHTML += "<span>" + weekdays.join("</span><span>") + "</span>";

		calendarContainer.appendChild(weekdayContainer);
	};

	buildWeeks = function buildWeeks() {
		calendarContainer.classList.add("hasWeeks");

		weekNumbers = createElement("div", "flatpickr-weeks");
		calendarContainer.appendChild(weekNumbers);
	};

	buildDays = function buildDays() {
		var firstOfMonth = (new Date(self.currentYear, self.currentMonth, 1).getDay() - self.l10n.firstDayOfWeek + 7) % 7,
		    daysInMonth = getDaysinMonth(),
		    prevMonthDays = getDaysinMonth((self.currentMonth - 1 + 12) % 12),
		    days = document.createDocumentFragment();

		var dayNumber = prevMonthDays + 1 - firstOfMonth,
		    currentDate = void 0,
		    dateIsDisabled = void 0;

		if (self.config.weekNumbers) {
			weekNumbers.innerHTML = "";
		}

		calendar.innerHTML = "";

		self.config.minDate = uDate(self.config.minDate, true);
		self.config.maxDate = uDate(self.config.maxDate, true);

		// prepend days from the ending of previous month
		for (; dayNumber <= prevMonthDays; dayNumber++) {
			var curDate = new Date(self.currentYear, self.currentMonth - 1, dayNumber, 0, 0, 0, 0, 0),
			    dateIsEnabled = isEnabled(curDate),
			    dayElem = createElement("span", dateIsEnabled ? "flatpickr-day prevMonthDay" : "disabled", dayNumber);

			if (dateIsEnabled) {
				dayElem.tabIndex = 0;
			}

			days.appendChild(dayElem);
		}

		// Start at 1 since there is no 0th day
		for (dayNumber = 1; dayNumber <= daysInMonth; dayNumber++) {
			currentDate = new Date(self.currentYear, self.currentMonth, dayNumber, 0, 0, 0, 0, 0);

			if (self.config.weekNumbers && dayNumber % 7 === 1) {
				weekNumbers.appendChild(createElement("span", "disabled flatpickr-day", currentDate.fp_getWeek()));
			}

			dateIsDisabled = !isEnabled(currentDate);

			var dayElement = createElement("span", dateIsDisabled ? "disabled" : "flatpickr-day", dayNumber);

			if (!dateIsDisabled) {
				dayElement.tabIndex = 0;

				if (equalDates(currentDate, now)) {
					dayElement.classList.add("today");
				}

				if (self.selectedDateObj && equalDates(currentDate, self.selectedDateObj)) {
					dayElement.classList.add("selected");
				}
			}

			days.appendChild(dayElement);
		}

		// append days from the next month
		for (var dayNum = daysInMonth + 1; dayNum <= 42 - firstOfMonth; dayNum++) {
			var _curDate = new Date(self.currentYear, self.currentMonth + 1, dayNum % daysInMonth, 0, 0, 0, 0, 0),
			    _dateIsEnabled = isEnabled(_curDate),
			    _dayElement = createElement("span", _dateIsEnabled ? "nextMonthDay flatpickr-day" : "disabled", dayNum % daysInMonth);

			if (self.config.weekNumbers && dayNum % 7 === 1) {
				weekNumbers.appendChild(createElement("span", "disabled", _curDate.fp_getWeek()));
			}

			if (_dateIsEnabled) {
				_dayElement.tabIndex = 0;
			}

			days.appendChild(_dayElement);
		}

		calendar.appendChild(days);
	};

	buildTime = function buildTime() {
		timeContainer = createElement("div", "flatpickr-time");
		timeContainer.tabIndex = -1;
		var separator = createElement("span", "flatpickr-time-separator", ":");

		self.hourElement = createElement("input", "flatpickr-hour");
		self.minuteElement = createElement("input", "flatpickr-minute");

		self.hourElement.tabIndex = self.minuteElement.tabIndex = 0;
		self.hourElement.type = self.minuteElement.type = "number";

		self.hourElement.value = self.selectedDateObj ? pad(self.selectedDateObj.getHours()) : 12;

		self.minuteElement.value = self.selectedDateObj ? pad(self.selectedDateObj.getMinutes()) : "00";

		self.hourElement.step = self.config.hourIncrement;
		self.minuteElement.step = self.config.minuteIncrement;

		self.hourElement.min = -self.config.time_24hr;
		self.hourElement.max = self.config.time_24hr ? 24 : 13;

		self.minuteElement.min = -self.minuteElement.step;
		self.minuteElement.max = 60;

		self.hourElement.title = self.minuteElement.title = self.l10n.scrollTitle;

		timeContainer.appendChild(self.hourElement);
		timeContainer.appendChild(separator);
		timeContainer.appendChild(self.minuteElement);

		if (self.config.enableSeconds) {
			timeContainer.classList.add("has-seconds");

			self.secondElement = createElement("input", "flatpickr-second");
			self.secondElement.type = "number";
			self.secondElement.value = self.selectedDateObj ? pad(self.selectedDateObj.getSeconds()) : "00";

			self.secondElement.step = self.minuteElement.step;
			self.secondElement.min = self.minuteElement.min;
			self.secondElement.max = self.minuteElement.max;

			timeContainer.appendChild(createElement("span", "flatpickr-time-separator", ":"));
			timeContainer.appendChild(self.secondElement);
		}

		if (!self.config.time_24hr) {
			// add self.amPM if appropriate
			self.amPM = createElement("span", "flatpickr-am-pm", ["AM", "PM"][self.hourElement.value > 11 | 0]);
			self.amPM.title = self.l10n.toggleTitle;
			self.amPM.tabIndex = 0;
			timeContainer.appendChild(self.amPM);
		}

		calendarContainer.appendChild(timeContainer);
	};

	bind = function bind() {
		document.addEventListener("keydown", onKeyDown);
		window.addEventListener("resize", onResize);

		if (self.config.clickOpens) {
			(self.altInput || self.input).addEventListener("click", self.open);
			(self.altInput || self.input).addEventListener("focus", self.open);
		}

		if (self.config.wrap && self.element.querySelector("[data-open]")) {
			self.element.querySelector("[data-open]").addEventListener("click", self.open);
		}

		if (self.config.wrap && self.element.querySelector("[data-close]")) {
			self.element.querySelector("[data-close]").addEventListener("click", self.close);
		}

		if (self.config.wrap && self.element.querySelector("[data-toggle]")) {
			self.element.querySelector("[data-toggle]").addEventListener("click", self.toggle);
		}

		if (self.config.wrap && self.element.querySelector("[data-clear]")) {
			self.element.querySelector("[data-clear]").addEventListener("click", self.clear);
		}

		if (!self.config.noCalendar) {
			prevMonthNav.addEventListener("click", function () {
				changeMonth(-1);
			});

			nextMonthNav.addEventListener("click", function () {
				changeMonth(1);
			});

			currentYearElement.addEventListener("wheel", yearScroll);
			currentYearElement.addEventListener("focus", currentYearElement.select);

			currentYearElement.addEventListener("input", function (event) {
				self.currentYear = parseInt(event.target.value, 10);
				self.redraw();
			});

			calendar.addEventListener("click", selectDate);
		}

		document.addEventListener("click", documentClick, true);
		document.addEventListener("focus", documentClick, true);

		if (self.config.enableTime) {
			self.hourElement.addEventListener("wheel", timeWrapper);
			self.minuteElement.addEventListener("wheel", timeWrapper);

			self.hourElement.addEventListener("input", timeWrapper);
			self.minuteElement.addEventListener("input", timeWrapper);

			self.hourElement.addEventListener("mouseout", updateValue);
			self.minuteElement.addEventListener("mouseout", updateValue);

			self.hourElement.addEventListener("change", updateValue);
			self.minuteElement.addEventListener("change", updateValue);

			self.hourElement.addEventListener("focus", self.hourElement.select);
			self.minuteElement.addEventListener("focus", self.minuteElement.select);

			if (self.config.enableSeconds) {
				self.secondElement.addEventListener("wheel", timeWrapper);
				self.secondElement.addEventListener("input", timeWrapper);
				self.secondElement.addEventListener("mouseout", updateValue);
				self.secondElement.addEventListener("change", updateValue);
				self.secondElement.addEventListener("focus", self.secondElement.select);
			}

			if (!self.config.time_24hr) {
				self.amPM.addEventListener("click", amPMToggle);

				self.amPM.addEventListener("wheel", amPMToggle);
				self.amPM.addEventListener("mouseout", updateValue);

				self.amPM.addEventListener("keydown", function (e) {
					if (e.which === 38 || e.which === 40) {
						amPMToggle(e);
					}
				});
			}
		}

		if (document.createEvent) {
			clickEvt = document.createEvent("MouseEvent");
			// without all these args ms edge spergs out
			clickEvt.initMouseEvent("click", true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
		} else {
			clickEvt = new MouseEvent("click", {
				view: window,
				bubbles: true,
				cancelable: true
			});
		}
	};

	self.open = function () {
		if (self.isOpen || (self.altInput || self.input).disabled || self.config.inline) {
			return;
		} else if (!self.config.static) {
			self.positionCalendar();
		}

		self.isOpen = true;

		wrapperElement.classList.add("open");

		if (!self.config.allowInput) {
			(self.altInput || self.input).blur();
			(self.config.noCalendar ? timeContainer : calendar).focus();
		}

		(self.altInput || self.input).classList.add("active");

		if (self.config.onOpen) {
			self.config.onOpen(self.selectedDateObj, self.input.value, self);
		}
	};

	// For calendars inserted in BODY (as opposed to inline wrapper)
	// it"s necessary to properly calculate top/left position.
	self.positionCalendar = function () {
		var calendarHeight = calendarContainer.offsetHeight,
		    input = self.altInput || self.input,
		    inputBounds = input.getBoundingClientRect(),
		    distanceFromBottom = window.innerHeight - inputBounds.bottom + input.offsetHeight;

		var top = void 0,
		    left = window.pageXOffset + inputBounds.left;

		if (distanceFromBottom < calendarHeight) {
			top = window.pageYOffset - calendarHeight + inputBounds.top - 2;
			calendarContainer.classList.remove("arrowTop");
			calendarContainer.classList.add("arrowBottom");
		} else {
			top = window.pageYOffset + input.offsetHeight + inputBounds.top + 2;
			calendarContainer.classList.remove("arrowBottom");
			calendarContainer.classList.add("arrowTop");
		}

		wrapperElement.style.top = top + "px";
		wrapperElement.style.left = left + "px";
	};

	self.toggle = function () {
		if (self.isOpen) {
			self.close();
		} else {
			self.open();
		}
	};

	self.close = function () {
		self.isOpen = false;
		wrapperElement.classList.remove("open");
		(self.altInput || self.input).classList.remove("active");

		if (self.config.onClose) {
			self.config.onClose(self.selectedDateObj, self.input.value, self);
		}
	};

	self.clear = function () {
		self.input.value = "";

		if (self.altInput) {
			self.altInput.value = "";
		}

		self.selectedDateObj = null;

		triggerChange();
		self.jumpToDate();
	};

	triggerChange = function triggerChange() {
		self.input.dispatchEvent(clickEvt);

		if (self.config.onChange) {
			self.config.onChange(self.selectedDateObj, self.input.value, self);
		}
	};

	self.destroy = function () {
		document.removeEventListener("click", documentClick, false);

		if (self.altInput) {
			self.altInput.parentNode.removeChild(self.altInput);
		}

		if (self.config.inline) {
			var parent = self.element.parentNode,
			    removedElement = parent.removeChild(self.element);

			parent.removeChild(calendarContainer);
			parent.parentNode.replaceChild(removedElement, parent);
		} else {
			document.getElementsByTagName("body")[0].removeChild(wrapperElement);
		}
	};

	self.redraw = function () {
		if (self.config.noCalendar) {
			return;
		}

		updateNavigationCurrentMonth();
		buildDays();
	};

	self.jumpToDate = function (jumpDate) {
		jumpDate = uDate(jumpDate || self.selectedDateObj || self.config.defaultDate || self.config.minDate || now);

		self.currentYear = jumpDate.getFullYear();
		self.currentMonth = jumpDate.getMonth();
		self.redraw();
	};

	self.setDate = function (date, triggerChangeEvent) {
		date = uDate(date);

		if (date instanceof Date && date.getTime()) {
			self.selectedDateObj = uDate(date);
			self.jumpToDate(self.selectedDateObj);
			updateValue();

			if (triggerChangeEvent) {
				triggerChange();
			}
		}
	};

	self.setTime = function (hour, minute, triggerChangeEvent) {
		if (!self.selectedDateObj) {
			return;
		}

		self.hourElement.value = parseInt(hour, 10) % 24;
		self.minuteElement.value = parseInt(minute || 0, 10) % 60;

		if (!self.config.time_24hr) {
			self.amPM.innerHTML = hour > 11 ? "PM" : "AM";
		}

		updateValue();

		if (triggerChangeEvent) {
			triggerChange();
		}
	};

	self.set = function (key, value) {
		if (key in self.config) {
			self.config[key] = value;
			self.jumpToDate();
		}
	};

	amPMToggle = function amPMToggle(e) {
		e.preventDefault();
		self.amPM.textContent = ["AM", "PM"][self.amPM.innerHTML === "AM" | 0];
	};

	onKeyDown = function onKeyDown(e) {
		if (!self.isOpen || self.config.enableTime && timeContainer.contains(e.target)) {
			return;
		}

		switch (e.which) {
			case 13:
				selectDate(e);
				break;

			case 27:
				self.close();
				break;

			case 37:
				changeMonth(-1);
				break;

			case 38:
				e.preventDefault();
				self.currentYear++;
				self.redraw();
				break;

			case 39:
				changeMonth(1);
				break;

			case 40:
				e.preventDefault();
				self.currentYear--;
				self.redraw();
				break;

			default:
				break;
		}
	};

	onResize = debounce(function () {
		if (self.isOpen && !self.config.inline && !self.config.static) {
			self.positionCalendar();
		}
	}, 300);

	try {
		init();
	} catch (error) {
		// skip and carry on
		console.error(error);
		console.info(self.element);
	}

	return self;
};

flatpickr.init.prototype = {

	defaultConfig: {},

	l10n: {
		weekdays: {
			shorthand: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
			longhand: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
		},
		months: {
			shorthand: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
			longhand: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
		},
		daysInMonth: [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31],
		firstDayOfWeek: 0,
		ordinal: function ordinal(nth) {
			var s = nth % 100;
			if (s > 3 && s < 21) return "th";
			switch (s % 10) {
				case 1:
					return "st";
				case 2:
					return "nd";
				case 3:
					return "rd";
				default:
					return "th";
			}
		},
		weekAbbreviation: "Wk",
		scrollTitle: "Scroll to increment",
		toggleTitle: "Click to toggle"
	}

};

Date.prototype.fp_incr = function (days) {
	return new Date(this.getFullYear(), this.getMonth(), this.getDate() + parseInt(days, 10));
};

Date.prototype.fp_isUTC = false;
Date.prototype.fp_toUTC = function () {
	var newDate = new Date(this.getTime() + this.getTimezoneOffset() * 60000);
	newDate.fp_isUTC = true;

	return newDate;
};

Date.prototype.fp_getWeek = function () {
	var date = new Date(this.getTime());
	date.setHours(0, 0, 0, 0);

	// Thursday in current week decides the year.
	date.setDate(date.getDate() + 3 - (date.getDay() + 6) % 7);
	// January 4 is always in week 1.
	var week1 = new Date(date.getFullYear(), 0, 4);
	// Adjust to Thursday in week 1 and count number of weeks from date to week1.
	return 1 + Math.round(((date.getTime() - week1.getTime()) / 86400000 - 3 + (week1.getDay() + 6) % 7) / 7);
};

// classList polyfill
if (!("classList" in document.documentElement) && Object.defineProperty && typeof HTMLElement !== "undefined") {
	Object.defineProperty(HTMLElement.prototype, "classList", {
		get: function get() {
			var selfElements = this;
			function update(fn) {
				return function (value) {
					var classes = selfElements.className.split(/\s+/);
					var index = classes.indexOf(value);

					fn(classes, index, value);
					selfElements.className = classes.join(" ");
				};
			}

			var ret = {
				add: update(function (classes, index, value) {
					return ~index || classes.push(value);
				}),
				remove: update(function (classes, index) {
					return ~index && classes.splice(index, 1);
				}),
				toggle: update(function (classes, index, value) {
					if (~index) {
						classes.splice(index, 1);
					} else {
						classes.push(value);
					}
				}),
				contains: function contains(value) {
					return !! ~selfElements.className.split(/\s+/).indexOf(value);
				}
			};

			return ret;
		}
	});
}

if (typeof module !== "undefined") {
	module.exports = flatpickr;
}
},{}],102:[function(require,module,exports){
// shim for using process in browser
var process = module.exports = {};

// cached from whatever global is present so that test runners that stub it
// don't break things.  But we need to wrap it in a try catch in case it is
// wrapped in strict mode code which doesn't define any globals.  It's inside a
// function because try/catches deoptimize in certain engines.

var cachedSetTimeout;
var cachedClearTimeout;

function defaultSetTimout() {
    throw new Error('setTimeout has not been defined');
}
function defaultClearTimeout () {
    throw new Error('clearTimeout has not been defined');
}
(function () {
    try {
        if (typeof setTimeout === 'function') {
            cachedSetTimeout = setTimeout;
        } else {
            cachedSetTimeout = defaultSetTimout;
        }
    } catch (e) {
        cachedSetTimeout = defaultSetTimout;
    }
    try {
        if (typeof clearTimeout === 'function') {
            cachedClearTimeout = clearTimeout;
        } else {
            cachedClearTimeout = defaultClearTimeout;
        }
    } catch (e) {
        cachedClearTimeout = defaultClearTimeout;
    }
} ())
function runTimeout(fun) {
    if (cachedSetTimeout === setTimeout) {
        //normal enviroments in sane situations
        return setTimeout(fun, 0);
    }
    // if setTimeout wasn't available but was latter defined
    if ((cachedSetTimeout === defaultSetTimout || !cachedSetTimeout) && setTimeout) {
        cachedSetTimeout = setTimeout;
        return setTimeout(fun, 0);
    }
    try {
        // when when somebody has screwed with setTimeout but no I.E. maddness
        return cachedSetTimeout(fun, 0);
    } catch(e){
        try {
            // When we are in I.E. but the script has been evaled so I.E. doesn't trust the global object when called normally
            return cachedSetTimeout.call(null, fun, 0);
        } catch(e){
            // same as above but when it's a version of I.E. that must have the global object for 'this', hopfully our context correct otherwise it will throw a global error
            return cachedSetTimeout.call(this, fun, 0);
        }
    }


}
function runClearTimeout(marker) {
    if (cachedClearTimeout === clearTimeout) {
        //normal enviroments in sane situations
        return clearTimeout(marker);
    }
    // if clearTimeout wasn't available but was latter defined
    if ((cachedClearTimeout === defaultClearTimeout || !cachedClearTimeout) && clearTimeout) {
        cachedClearTimeout = clearTimeout;
        return clearTimeout(marker);
    }
    try {
        // when when somebody has screwed with setTimeout but no I.E. maddness
        return cachedClearTimeout(marker);
    } catch (e){
        try {
            // When we are in I.E. but the script has been evaled so I.E. doesn't  trust the global object when called normally
            return cachedClearTimeout.call(null, marker);
        } catch (e){
            // same as above but when it's a version of I.E. that must have the global object for 'this', hopfully our context correct otherwise it will throw a global error.
            // Some versions of I.E. have different rules for clearTimeout vs setTimeout
            return cachedClearTimeout.call(this, marker);
        }
    }



}
var queue = [];
var draining = false;
var currentQueue;
var queueIndex = -1;

function cleanUpNextTick() {
    if (!draining || !currentQueue) {
        return;
    }
    draining = false;
    if (currentQueue.length) {
        queue = currentQueue.concat(queue);
    } else {
        queueIndex = -1;
    }
    if (queue.length) {
        drainQueue();
    }
}

function drainQueue() {
    if (draining) {
        return;
    }
    var timeout = runTimeout(cleanUpNextTick);
    draining = true;

    var len = queue.length;
    while(len) {
        currentQueue = queue;
        queue = [];
        while (++queueIndex < len) {
            if (currentQueue) {
                currentQueue[queueIndex].run();
            }
        }
        queueIndex = -1;
        len = queue.length;
    }
    currentQueue = null;
    draining = false;
    runClearTimeout(timeout);
}

process.nextTick = function (fun) {
    var args = new Array(arguments.length - 1);
    if (arguments.length > 1) {
        for (var i = 1; i < arguments.length; i++) {
            args[i - 1] = arguments[i];
        }
    }
    queue.push(new Item(fun, args));
    if (queue.length === 1 && !draining) {
        runTimeout(drainQueue);
    }
};

// v8 likes predictible objects
function Item(fun, array) {
    this.fun = fun;
    this.array = array;
}
Item.prototype.run = function () {
    this.fun.apply(null, this.array);
};
process.title = 'browser';
process.browser = true;
process.env = {};
process.argv = [];
process.version = ''; // empty string to avoid regexp issues
process.versions = {};

function noop() {}

process.on = noop;
process.addListener = noop;
process.once = noop;
process.off = noop;
process.removeListener = noop;
process.removeAllListeners = noop;
process.emit = noop;
process.prependListener = noop;
process.prependOnceListener = noop;

process.listeners = function (name) { return [] }

process.binding = function (name) {
    throw new Error('process.binding is not supported');
};

process.cwd = function () { return '/' };
process.chdir = function (dir) {
    throw new Error('process.chdir is not supported');
};
process.umask = function() { return 0; };

},{}],103:[function(require,module,exports){
var Vue // late bind
var map = Object.create(null)
var shimmed = false
var isBrowserify = false

/**
 * Determine compatibility and apply patch.
 *
 * @param {Function} vue
 * @param {Boolean} browserify
 */

exports.install = function (vue, browserify) {
  if (shimmed) return
  shimmed = true

  Vue = vue
  isBrowserify = browserify

  exports.compatible = !!Vue.internalDirectives
  if (!exports.compatible) {
    console.warn(
      '[HMR] vue-loader hot reload is only compatible with ' +
      'Vue.js 1.0.0+.'
    )
    return
  }

  // patch view directive
  patchView(Vue.internalDirectives.component)
  console.log('[HMR] Vue component hot reload shim applied.')
  // shim router-view if present
  var routerView = Vue.elementDirective('router-view')
  if (routerView) {
    patchView(routerView)
    console.log('[HMR] vue-router <router-view> hot reload shim applied.')
  }
}

/**
 * Shim the view directive (component or router-view).
 *
 * @param {Object} View
 */

function patchView (View) {
  var unbuild = View.unbuild
  View.unbuild = function (defer) {
    if (!this.hotUpdating) {
      var prevComponent = this.childVM && this.childVM.constructor
      removeView(prevComponent, this)
      // defer = true means we are transitioning to a new
      // Component. Register this new component to the list.
      if (defer) {
        addView(this.Component, this)
      }
    }
    // call original
    return unbuild.call(this, defer)
  }
}

/**
 * Add a component view to a Component's hot list
 *
 * @param {Function} Component
 * @param {Directive} view - view directive instance
 */

function addView (Component, view) {
  var id = Component && Component.options.hotID
  if (id) {
    if (!map[id]) {
      map[id] = {
        Component: Component,
        views: [],
        instances: []
      }
    }
    map[id].views.push(view)
  }
}

/**
 * Remove a component view from a Component's hot list
 *
 * @param {Function} Component
 * @param {Directive} view - view directive instance
 */

function removeView (Component, view) {
  var id = Component && Component.options.hotID
  if (id) {
    map[id].views.$remove(view)
  }
}

/**
 * Create a record for a hot module, which keeps track of its construcotr,
 * instnaces and views (component directives or router-views).
 *
 * @param {String} id
 * @param {Object} options
 */

exports.createRecord = function (id, options) {
  if (typeof options === 'function') {
    options = options.options
  }
  if (typeof options.el !== 'string' && typeof options.data !== 'object') {
    makeOptionsHot(id, options)
    map[id] = {
      Component: null,
      views: [],
      instances: []
    }
  }
}

/**
 * Make a Component options object hot.
 *
 * @param {String} id
 * @param {Object} options
 */

function makeOptionsHot (id, options) {
  options.hotID = id
  injectHook(options, 'created', function () {
    var record = map[id]
    if (!record.Component) {
      record.Component = this.constructor
    }
    record.instances.push(this)
  })
  injectHook(options, 'beforeDestroy', function () {
    map[id].instances.$remove(this)
  })
}

/**
 * Inject a hook to a hot reloadable component so that
 * we can keep track of it.
 *
 * @param {Object} options
 * @param {String} name
 * @param {Function} hook
 */

function injectHook (options, name, hook) {
  var existing = options[name]
  options[name] = existing
    ? Array.isArray(existing)
      ? existing.concat(hook)
      : [existing, hook]
    : [hook]
}

/**
 * Update a hot component.
 *
 * @param {String} id
 * @param {Object|null} newOptions
 * @param {String|null} newTemplate
 */

exports.update = function (id, newOptions, newTemplate) {
  var record = map[id]
  // force full-reload if an instance of the component is active but is not
  // managed by a view
  if (!record || (record.instances.length && !record.views.length)) {
    console.log('[HMR] Root or manually-mounted instance modified. Full reload may be required.')
    if (!isBrowserify) {
      window.location.reload()
    } else {
      // browserify-hmr somehow sends incomplete bundle if we reload here
      return
    }
  }
  if (!isBrowserify) {
    // browserify-hmr already logs this
    console.log('[HMR] Updating component: ' + format(id))
  }
  var Component = record.Component
  // update constructor
  if (newOptions) {
    // in case the user exports a constructor
    Component = record.Component = typeof newOptions === 'function'
      ? newOptions
      : Vue.extend(newOptions)
    makeOptionsHot(id, Component.options)
  }
  if (newTemplate) {
    Component.options.template = newTemplate
  }
  // handle recursive lookup
  if (Component.options.name) {
    Component.options.components[Component.options.name] = Component
  }
  // reset constructor cached linker
  Component.linker = null
  // reload all views
  record.views.forEach(function (view) {
    updateView(view, Component)
  })
  // flush devtools
  if (window.__VUE_DEVTOOLS_GLOBAL_HOOK__) {
    window.__VUE_DEVTOOLS_GLOBAL_HOOK__.emit('flush')
  }
}

/**
 * Update a component view instance
 *
 * @param {Directive} view
 * @param {Function} Component
 */

function updateView (view, Component) {
  if (!view._bound) {
    return
  }
  view.Component = Component
  view.hotUpdating = true
  // disable transitions
  view.vm._isCompiled = false
  // save state
  var state = extractState(view.childVM)
  // remount, make sure to disable keep-alive
  var keepAlive = view.keepAlive
  view.keepAlive = false
  view.mountComponent()
  view.keepAlive = keepAlive
  // restore state
  restoreState(view.childVM, state, true)
  // re-eanble transitions
  view.vm._isCompiled = true
  view.hotUpdating = false
}

/**
 * Extract state from a Vue instance.
 *
 * @param {Vue} vm
 * @return {Object}
 */

function extractState (vm) {
  return {
    cid: vm.constructor.cid,
    data: vm.$data,
    children: vm.$children.map(extractState)
  }
}

/**
 * Restore state to a reloaded Vue instance.
 *
 * @param {Vue} vm
 * @param {Object} state
 */

function restoreState (vm, state, isRoot) {
  var oldAsyncConfig
  if (isRoot) {
    // set Vue into sync mode during state rehydration
    oldAsyncConfig = Vue.config.async
    Vue.config.async = false
  }
  // actual restore
  if (isRoot || !vm._props) {
    vm.$data = state.data
  } else {
    Object.keys(state.data).forEach(function (key) {
      if (!vm._props[key]) {
        // for non-root, only restore non-props fields
        vm.$data[key] = state.data[key]
      }
    })
  }
  // verify child consistency
  var hasSameChildren = vm.$children.every(function (c, i) {
    return state.children[i] && state.children[i].cid === c.constructor.cid
  })
  if (hasSameChildren) {
    // rehydrate children
    vm.$children.forEach(function (c, i) {
      restoreState(c, state.children[i])
    })
  }
  if (isRoot) {
    Vue.config.async = oldAsyncConfig
  }
}

function format (id) {
  var match = id.match(/[^\/]+\.vue$/)
  return match ? match[0] : id
}

},{}],104:[function(require,module,exports){
/*!
 * vue-resource v1.5.1
 * https://github.com/pagekit/vue-resource
 * Released under the MIT License.
 */

'use strict';

/**
 * Promises/A+ polyfill v1.1.4 (https://github.com/bramstein/promis)
 */

var RESOLVED = 0;
var REJECTED = 1;
var PENDING = 2;

function Promise$1(executor) {

    this.state = PENDING;
    this.value = undefined;
    this.deferred = [];

    var promise = this;

    try {
        executor(function (x) {
            promise.resolve(x);
        }, function (r) {
            promise.reject(r);
        });
    } catch (e) {
        promise.reject(e);
    }
}

Promise$1.reject = function (r) {
    return new Promise$1(function (resolve, reject) {
        reject(r);
    });
};

Promise$1.resolve = function (x) {
    return new Promise$1(function (resolve, reject) {
        resolve(x);
    });
};

Promise$1.all = function all(iterable) {
    return new Promise$1(function (resolve, reject) {
        var count = 0, result = [];

        if (iterable.length === 0) {
            resolve(result);
        }

        function resolver(i) {
            return function (x) {
                result[i] = x;
                count += 1;

                if (count === iterable.length) {
                    resolve(result);
                }
            };
        }

        for (var i = 0; i < iterable.length; i += 1) {
            Promise$1.resolve(iterable[i]).then(resolver(i), reject);
        }
    });
};

Promise$1.race = function race(iterable) {
    return new Promise$1(function (resolve, reject) {
        for (var i = 0; i < iterable.length; i += 1) {
            Promise$1.resolve(iterable[i]).then(resolve, reject);
        }
    });
};

var p = Promise$1.prototype;

p.resolve = function resolve(x) {
    var promise = this;

    if (promise.state === PENDING) {
        if (x === promise) {
            throw new TypeError('Promise settled with itself.');
        }

        var called = false;

        try {
            var then = x && x['then'];

            if (x !== null && typeof x === 'object' && typeof then === 'function') {
                then.call(x, function (x) {
                    if (!called) {
                        promise.resolve(x);
                    }
                    called = true;

                }, function (r) {
                    if (!called) {
                        promise.reject(r);
                    }
                    called = true;
                });
                return;
            }
        } catch (e) {
            if (!called) {
                promise.reject(e);
            }
            return;
        }

        promise.state = RESOLVED;
        promise.value = x;
        promise.notify();
    }
};

p.reject = function reject(reason) {
    var promise = this;

    if (promise.state === PENDING) {
        if (reason === promise) {
            throw new TypeError('Promise settled with itself.');
        }

        promise.state = REJECTED;
        promise.value = reason;
        promise.notify();
    }
};

p.notify = function notify() {
    var promise = this;

    nextTick(function () {
        if (promise.state !== PENDING) {
            while (promise.deferred.length) {
                var deferred = promise.deferred.shift(),
                    onResolved = deferred[0],
                    onRejected = deferred[1],
                    resolve = deferred[2],
                    reject = deferred[3];

                try {
                    if (promise.state === RESOLVED) {
                        if (typeof onResolved === 'function') {
                            resolve(onResolved.call(undefined, promise.value));
                        } else {
                            resolve(promise.value);
                        }
                    } else if (promise.state === REJECTED) {
                        if (typeof onRejected === 'function') {
                            resolve(onRejected.call(undefined, promise.value));
                        } else {
                            reject(promise.value);
                        }
                    }
                } catch (e) {
                    reject(e);
                }
            }
        }
    });
};

p.then = function then(onResolved, onRejected) {
    var promise = this;

    return new Promise$1(function (resolve, reject) {
        promise.deferred.push([onResolved, onRejected, resolve, reject]);
        promise.notify();
    });
};

p.catch = function (onRejected) {
    return this.then(undefined, onRejected);
};

/**
 * Promise adapter.
 */

if (typeof Promise === 'undefined') {
    window.Promise = Promise$1;
}

function PromiseObj(executor, context) {

    if (executor instanceof Promise) {
        this.promise = executor;
    } else {
        this.promise = new Promise(executor.bind(context));
    }

    this.context = context;
}

PromiseObj.all = function (iterable, context) {
    return new PromiseObj(Promise.all(iterable), context);
};

PromiseObj.resolve = function (value, context) {
    return new PromiseObj(Promise.resolve(value), context);
};

PromiseObj.reject = function (reason, context) {
    return new PromiseObj(Promise.reject(reason), context);
};

PromiseObj.race = function (iterable, context) {
    return new PromiseObj(Promise.race(iterable), context);
};

var p$1 = PromiseObj.prototype;

p$1.bind = function (context) {
    this.context = context;
    return this;
};

p$1.then = function (fulfilled, rejected) {

    if (fulfilled && fulfilled.bind && this.context) {
        fulfilled = fulfilled.bind(this.context);
    }

    if (rejected && rejected.bind && this.context) {
        rejected = rejected.bind(this.context);
    }

    return new PromiseObj(this.promise.then(fulfilled, rejected), this.context);
};

p$1.catch = function (rejected) {

    if (rejected && rejected.bind && this.context) {
        rejected = rejected.bind(this.context);
    }

    return new PromiseObj(this.promise.catch(rejected), this.context);
};

p$1.finally = function (callback) {

    return this.then(function (value) {
        callback.call(this);
        return value;
    }, function (reason) {
        callback.call(this);
        return Promise.reject(reason);
    }
    );
};

/**
 * Utility functions.
 */

var ref = {};
var hasOwnProperty = ref.hasOwnProperty;
var ref$1 = [];
var slice = ref$1.slice;
var debug = false, ntick;

var inBrowser = typeof window !== 'undefined';

function Util (ref) {
    var config = ref.config;
    var nextTick = ref.nextTick;

    ntick = nextTick;
    debug = config.debug || !config.silent;
}

function warn(msg) {
    if (typeof console !== 'undefined' && debug) {
        console.warn('[VueResource warn]: ' + msg);
    }
}

function error(msg) {
    if (typeof console !== 'undefined') {
        console.error(msg);
    }
}

function nextTick(cb, ctx) {
    return ntick(cb, ctx);
}

function trim(str) {
    return str ? str.replace(/^\s*|\s*$/g, '') : '';
}

function trimEnd(str, chars) {

    if (str && chars === undefined) {
        return str.replace(/\s+$/, '');
    }

    if (!str || !chars) {
        return str;
    }

    return str.replace(new RegExp(("[" + chars + "]+$")), '');
}

function toLower(str) {
    return str ? str.toLowerCase() : '';
}

function toUpper(str) {
    return str ? str.toUpperCase() : '';
}

var isArray = Array.isArray;

function isString(val) {
    return typeof val === 'string';
}

function isFunction(val) {
    return typeof val === 'function';
}

function isObject(obj) {
    return obj !== null && typeof obj === 'object';
}

function isPlainObject(obj) {
    return isObject(obj) && Object.getPrototypeOf(obj) == Object.prototype;
}

function isBlob(obj) {
    return typeof Blob !== 'undefined' && obj instanceof Blob;
}

function isFormData(obj) {
    return typeof FormData !== 'undefined' && obj instanceof FormData;
}

function when(value, fulfilled, rejected) {

    var promise = PromiseObj.resolve(value);

    if (arguments.length < 2) {
        return promise;
    }

    return promise.then(fulfilled, rejected);
}

function options(fn, obj, opts) {

    opts = opts || {};

    if (isFunction(opts)) {
        opts = opts.call(obj);
    }

    return merge(fn.bind({$vm: obj, $options: opts}), fn, {$options: opts});
}

function each(obj, iterator) {

    var i, key;

    if (isArray(obj)) {
        for (i = 0; i < obj.length; i++) {
            iterator.call(obj[i], obj[i], i);
        }
    } else if (isObject(obj)) {
        for (key in obj) {
            if (hasOwnProperty.call(obj, key)) {
                iterator.call(obj[key], obj[key], key);
            }
        }
    }

    return obj;
}

var assign = Object.assign || _assign;

function merge(target) {

    var args = slice.call(arguments, 1);

    args.forEach(function (source) {
        _merge(target, source, true);
    });

    return target;
}

function defaults(target) {

    var args = slice.call(arguments, 1);

    args.forEach(function (source) {

        for (var key in source) {
            if (target[key] === undefined) {
                target[key] = source[key];
            }
        }

    });

    return target;
}

function _assign(target) {

    var args = slice.call(arguments, 1);

    args.forEach(function (source) {
        _merge(target, source);
    });

    return target;
}

function _merge(target, source, deep) {
    for (var key in source) {
        if (deep && (isPlainObject(source[key]) || isArray(source[key]))) {
            if (isPlainObject(source[key]) && !isPlainObject(target[key])) {
                target[key] = {};
            }
            if (isArray(source[key]) && !isArray(target[key])) {
                target[key] = [];
            }
            _merge(target[key], source[key], deep);
        } else if (source[key] !== undefined) {
            target[key] = source[key];
        }
    }
}

/**
 * Root Prefix Transform.
 */

function root (options$$1, next) {

    var url = next(options$$1);

    if (isString(options$$1.root) && !/^(https?:)?\//.test(url)) {
        url = trimEnd(options$$1.root, '/') + '/' + url;
    }

    return url;
}

/**
 * Query Parameter Transform.
 */

function query (options$$1, next) {

    var urlParams = Object.keys(Url.options.params), query = {}, url = next(options$$1);

    each(options$$1.params, function (value, key) {
        if (urlParams.indexOf(key) === -1) {
            query[key] = value;
        }
    });

    query = Url.params(query);

    if (query) {
        url += (url.indexOf('?') == -1 ? '?' : '&') + query;
    }

    return url;
}

/**
 * URL Template v2.0.6 (https://github.com/bramstein/url-template)
 */

function expand(url, params, variables) {

    var tmpl = parse(url), expanded = tmpl.expand(params);

    if (variables) {
        variables.push.apply(variables, tmpl.vars);
    }

    return expanded;
}

function parse(template) {

    var operators = ['+', '#', '.', '/', ';', '?', '&'], variables = [];

    return {
        vars: variables,
        expand: function expand(context) {
            return template.replace(/\{([^{}]+)\}|([^{}]+)/g, function (_, expression, literal) {
                if (expression) {

                    var operator = null, values = [];

                    if (operators.indexOf(expression.charAt(0)) !== -1) {
                        operator = expression.charAt(0);
                        expression = expression.substr(1);
                    }

                    expression.split(/,/g).forEach(function (variable) {
                        var tmp = /([^:*]*)(?::(\d+)|(\*))?/.exec(variable);
                        values.push.apply(values, getValues(context, operator, tmp[1], tmp[2] || tmp[3]));
                        variables.push(tmp[1]);
                    });

                    if (operator && operator !== '+') {

                        var separator = ',';

                        if (operator === '?') {
                            separator = '&';
                        } else if (operator !== '#') {
                            separator = operator;
                        }

                        return (values.length !== 0 ? operator : '') + values.join(separator);
                    } else {
                        return values.join(',');
                    }

                } else {
                    return encodeReserved(literal);
                }
            });
        }
    };
}

function getValues(context, operator, key, modifier) {

    var value = context[key], result = [];

    if (isDefined(value) && value !== '') {
        if (typeof value === 'string' || typeof value === 'number' || typeof value === 'boolean') {
            value = value.toString();

            if (modifier && modifier !== '*') {
                value = value.substring(0, parseInt(modifier, 10));
            }

            result.push(encodeValue(operator, value, isKeyOperator(operator) ? key : null));
        } else {
            if (modifier === '*') {
                if (Array.isArray(value)) {
                    value.filter(isDefined).forEach(function (value) {
                        result.push(encodeValue(operator, value, isKeyOperator(operator) ? key : null));
                    });
                } else {
                    Object.keys(value).forEach(function (k) {
                        if (isDefined(value[k])) {
                            result.push(encodeValue(operator, value[k], k));
                        }
                    });
                }
            } else {
                var tmp = [];

                if (Array.isArray(value)) {
                    value.filter(isDefined).forEach(function (value) {
                        tmp.push(encodeValue(operator, value));
                    });
                } else {
                    Object.keys(value).forEach(function (k) {
                        if (isDefined(value[k])) {
                            tmp.push(encodeURIComponent(k));
                            tmp.push(encodeValue(operator, value[k].toString()));
                        }
                    });
                }

                if (isKeyOperator(operator)) {
                    result.push(encodeURIComponent(key) + '=' + tmp.join(','));
                } else if (tmp.length !== 0) {
                    result.push(tmp.join(','));
                }
            }
        }
    } else {
        if (operator === ';') {
            result.push(encodeURIComponent(key));
        } else if (value === '' && (operator === '&' || operator === '?')) {
            result.push(encodeURIComponent(key) + '=');
        } else if (value === '') {
            result.push('');
        }
    }

    return result;
}

function isDefined(value) {
    return value !== undefined && value !== null;
}

function isKeyOperator(operator) {
    return operator === ';' || operator === '&' || operator === '?';
}

function encodeValue(operator, value, key) {

    value = (operator === '+' || operator === '#') ? encodeReserved(value) : encodeURIComponent(value);

    if (key) {
        return encodeURIComponent(key) + '=' + value;
    } else {
        return value;
    }
}

function encodeReserved(str) {
    return str.split(/(%[0-9A-Fa-f]{2})/g).map(function (part) {
        if (!/%[0-9A-Fa-f]/.test(part)) {
            part = encodeURI(part);
        }
        return part;
    }).join('');
}

/**
 * URL Template (RFC 6570) Transform.
 */

function template (options) {

    var variables = [], url = expand(options.url, options.params, variables);

    variables.forEach(function (key) {
        delete options.params[key];
    });

    return url;
}

/**
 * Service for URL templating.
 */

function Url(url, params) {

    var self = this || {}, options$$1 = url, transform;

    if (isString(url)) {
        options$$1 = {url: url, params: params};
    }

    options$$1 = merge({}, Url.options, self.$options, options$$1);

    Url.transforms.forEach(function (handler) {

        if (isString(handler)) {
            handler = Url.transform[handler];
        }

        if (isFunction(handler)) {
            transform = factory(handler, transform, self.$vm);
        }

    });

    return transform(options$$1);
}

/**
 * Url options.
 */

Url.options = {
    url: '',
    root: null,
    params: {}
};

/**
 * Url transforms.
 */

Url.transform = {template: template, query: query, root: root};
Url.transforms = ['template', 'query', 'root'];

/**
 * Encodes a Url parameter string.
 *
 * @param {Object} obj
 */

Url.params = function (obj) {

    var params = [], escape = encodeURIComponent;

    params.add = function (key, value) {

        if (isFunction(value)) {
            value = value();
        }

        if (value === null) {
            value = '';
        }

        this.push(escape(key) + '=' + escape(value));
    };

    serialize(params, obj);

    return params.join('&').replace(/%20/g, '+');
};

/**
 * Parse a URL and return its components.
 *
 * @param {String} url
 */

Url.parse = function (url) {

    var el = document.createElement('a');

    if (document.documentMode) {
        el.href = url;
        url = el.href;
    }

    el.href = url;

    return {
        href: el.href,
        protocol: el.protocol ? el.protocol.replace(/:$/, '') : '',
        port: el.port,
        host: el.host,
        hostname: el.hostname,
        pathname: el.pathname.charAt(0) === '/' ? el.pathname : '/' + el.pathname,
        search: el.search ? el.search.replace(/^\?/, '') : '',
        hash: el.hash ? el.hash.replace(/^#/, '') : ''
    };
};

function factory(handler, next, vm) {
    return function (options$$1) {
        return handler.call(vm, options$$1, next);
    };
}

function serialize(params, obj, scope) {

    var array = isArray(obj), plain = isPlainObject(obj), hash;

    each(obj, function (value, key) {

        hash = isObject(value) || isArray(value);

        if (scope) {
            key = scope + '[' + (plain || hash ? key : '') + ']';
        }

        if (!scope && array) {
            params.add(value.name, value.value);
        } else if (hash) {
            serialize(params, value, key);
        } else {
            params.add(key, value);
        }
    });
}

/**
 * XDomain client (Internet Explorer).
 */

function xdrClient (request) {
    return new PromiseObj(function (resolve) {

        var xdr = new XDomainRequest(), handler = function (ref) {
                var type = ref.type;


                var status = 0;

                if (type === 'load') {
                    status = 200;
                } else if (type === 'error') {
                    status = 500;
                }

                resolve(request.respondWith(xdr.responseText, {status: status}));
            };

        request.abort = function () { return xdr.abort(); };

        xdr.open(request.method, request.getUrl());

        if (request.timeout) {
            xdr.timeout = request.timeout;
        }

        xdr.onload = handler;
        xdr.onabort = handler;
        xdr.onerror = handler;
        xdr.ontimeout = handler;
        xdr.onprogress = function () {};
        xdr.send(request.getBody());
    });
}

/**
 * CORS Interceptor.
 */

var SUPPORTS_CORS = inBrowser && 'withCredentials' in new XMLHttpRequest();

function cors (request) {

    if (inBrowser) {

        var orgUrl = Url.parse(location.href);
        var reqUrl = Url.parse(request.getUrl());

        if (reqUrl.protocol !== orgUrl.protocol || reqUrl.host !== orgUrl.host) {

            request.crossOrigin = true;
            request.emulateHTTP = false;

            if (!SUPPORTS_CORS) {
                request.client = xdrClient;
            }
        }
    }

}

/**
 * Form data Interceptor.
 */

function form (request) {

    if (isFormData(request.body)) {
        request.headers.delete('Content-Type');
    } else if (isObject(request.body) && request.emulateJSON) {
        request.body = Url.params(request.body);
        request.headers.set('Content-Type', 'application/x-www-form-urlencoded');
    }

}

/**
 * JSON Interceptor.
 */

function json (request) {

    var type = request.headers.get('Content-Type') || '';

    if (isObject(request.body) && type.indexOf('application/json') === 0) {
        request.body = JSON.stringify(request.body);
    }

    return function (response) {

        return response.bodyText ? when(response.text(), function (text) {

            var type = response.headers.get('Content-Type') || '';

            if (type.indexOf('application/json') === 0 || isJson(text)) {

                try {
                    response.body = JSON.parse(text);
                } catch (e) {
                    response.body = null;
                }

            } else {
                response.body = text;
            }

            return response;

        }) : response;

    };
}

function isJson(str) {

    var start = str.match(/^\s*(\[|\{)/);
    var end = {'[': /]\s*$/, '{': /}\s*$/};

    return start && end[start[1]].test(str);
}

/**
 * JSONP client (Browser).
 */

function jsonpClient (request) {
    return new PromiseObj(function (resolve) {

        var name = request.jsonp || 'callback', callback = request.jsonpCallback || '_jsonp' + Math.random().toString(36).substr(2), body = null, handler, script;

        handler = function (ref) {
            var type = ref.type;


            var status = 0;

            if (type === 'load' && body !== null) {
                status = 200;
            } else if (type === 'error') {
                status = 500;
            }

            if (status && window[callback]) {
                delete window[callback];
                document.body.removeChild(script);
            }

            resolve(request.respondWith(body, {status: status}));
        };

        window[callback] = function (result) {
            body = JSON.stringify(result);
        };

        request.abort = function () {
            handler({type: 'abort'});
        };

        request.params[name] = callback;

        if (request.timeout) {
            setTimeout(request.abort, request.timeout);
        }

        script = document.createElement('script');
        script.src = request.getUrl();
        script.type = 'text/javascript';
        script.async = true;
        script.onload = handler;
        script.onerror = handler;

        document.body.appendChild(script);
    });
}

/**
 * JSONP Interceptor.
 */

function jsonp (request) {

    if (request.method == 'JSONP') {
        request.client = jsonpClient;
    }

}

/**
 * Before Interceptor.
 */

function before (request) {

    if (isFunction(request.before)) {
        request.before.call(this, request);
    }

}

/**
 * HTTP method override Interceptor.
 */

function method (request) {

    if (request.emulateHTTP && /^(PUT|PATCH|DELETE)$/i.test(request.method)) {
        request.headers.set('X-HTTP-Method-Override', request.method);
        request.method = 'POST';
    }

}

/**
 * Header Interceptor.
 */

function header (request) {

    var headers = assign({}, Http.headers.common,
        !request.crossOrigin ? Http.headers.custom : {},
        Http.headers[toLower(request.method)]
    );

    each(headers, function (value, name) {
        if (!request.headers.has(name)) {
            request.headers.set(name, value);
        }
    });

}

/**
 * XMLHttp client (Browser).
 */

function xhrClient (request) {
    return new PromiseObj(function (resolve) {

        var xhr = new XMLHttpRequest(), handler = function (event) {

                var response = request.respondWith(
                'response' in xhr ? xhr.response : xhr.responseText, {
                    status: xhr.status === 1223 ? 204 : xhr.status, // IE9 status bug
                    statusText: xhr.status === 1223 ? 'No Content' : trim(xhr.statusText)
                });

                each(trim(xhr.getAllResponseHeaders()).split('\n'), function (row) {
                    response.headers.append(row.slice(0, row.indexOf(':')), row.slice(row.indexOf(':') + 1));
                });

                resolve(response);
            };

        request.abort = function () { return xhr.abort(); };

        xhr.open(request.method, request.getUrl(), true);

        if (request.timeout) {
            xhr.timeout = request.timeout;
        }

        if (request.responseType && 'responseType' in xhr) {
            xhr.responseType = request.responseType;
        }

        if (request.withCredentials || request.credentials) {
            xhr.withCredentials = true;
        }

        if (!request.crossOrigin) {
            request.headers.set('X-Requested-With', 'XMLHttpRequest');
        }

        // deprecated use downloadProgress
        if (isFunction(request.progress) && request.method === 'GET') {
            xhr.addEventListener('progress', request.progress);
        }

        if (isFunction(request.downloadProgress)) {
            xhr.addEventListener('progress', request.downloadProgress);
        }

        // deprecated use uploadProgress
        if (isFunction(request.progress) && /^(POST|PUT)$/i.test(request.method)) {
            xhr.upload.addEventListener('progress', request.progress);
        }

        if (isFunction(request.uploadProgress) && xhr.upload) {
            xhr.upload.addEventListener('progress', request.uploadProgress);
        }

        request.headers.forEach(function (value, name) {
            xhr.setRequestHeader(name, value);
        });

        xhr.onload = handler;
        xhr.onabort = handler;
        xhr.onerror = handler;
        xhr.ontimeout = handler;
        xhr.send(request.getBody());
    });
}

/**
 * Http client (Node).
 */

function nodeClient (request) {

    var client = require('got');

    return new PromiseObj(function (resolve) {

        var url = request.getUrl();
        var body = request.getBody();
        var method = request.method;
        var headers = {}, handler;

        request.headers.forEach(function (value, name) {
            headers[name] = value;
        });

        client(url, {body: body, method: method, headers: headers}).then(handler = function (resp) {

            var response = request.respondWith(resp.body, {
                status: resp.statusCode,
                statusText: trim(resp.statusMessage)
            });

            each(resp.headers, function (value, name) {
                response.headers.set(name, value);
            });

            resolve(response);

        }, function (error$$1) { return handler(error$$1.response); });
    });
}

/**
 * Base client.
 */

function Client (context) {

    var reqHandlers = [sendRequest], resHandlers = [];

    if (!isObject(context)) {
        context = null;
    }

    function Client(request) {
        while (reqHandlers.length) {

            var handler = reqHandlers.pop();

            if (isFunction(handler)) {

                var response = (void 0), next = (void 0);

                response = handler.call(context, request, function (val) { return next = val; }) || next;

                if (isObject(response)) {
                    return new PromiseObj(function (resolve, reject) {

                        resHandlers.forEach(function (handler) {
                            response = when(response, function (response) {
                                return handler.call(context, response) || response;
                            }, reject);
                        });

                        when(response, resolve, reject);

                    }, context);
                }

                if (isFunction(response)) {
                    resHandlers.unshift(response);
                }

            } else {
                warn(("Invalid interceptor of type " + (typeof handler) + ", must be a function"));
            }
        }
    }

    Client.use = function (handler) {
        reqHandlers.push(handler);
    };

    return Client;
}

function sendRequest(request) {

    var client = request.client || (inBrowser ? xhrClient : nodeClient);

    return client(request);
}

/**
 * HTTP Headers.
 */

var Headers = function Headers(headers) {
    var this$1 = this;


    this.map = {};

    each(headers, function (value, name) { return this$1.append(name, value); });
};

Headers.prototype.has = function has (name) {
    return getName(this.map, name) !== null;
};

Headers.prototype.get = function get (name) {

    var list = this.map[getName(this.map, name)];

    return list ? list.join() : null;
};

Headers.prototype.getAll = function getAll (name) {
    return this.map[getName(this.map, name)] || [];
};

Headers.prototype.set = function set (name, value) {
    this.map[normalizeName(getName(this.map, name) || name)] = [trim(value)];
};

Headers.prototype.append = function append (name, value) {

    var list = this.map[getName(this.map, name)];

    if (list) {
        list.push(trim(value));
    } else {
        this.set(name, value);
    }
};

Headers.prototype.delete = function delete$1 (name) {
    delete this.map[getName(this.map, name)];
};

Headers.prototype.deleteAll = function deleteAll () {
    this.map = {};
};

Headers.prototype.forEach = function forEach (callback, thisArg) {
        var this$1 = this;

    each(this.map, function (list, name) {
        each(list, function (value) { return callback.call(thisArg, value, name, this$1); });
    });
};

function getName(map, name) {
    return Object.keys(map).reduce(function (prev, curr) {
        return toLower(name) === toLower(curr) ? curr : prev;
    }, null);
}

function normalizeName(name) {

    if (/[^a-z0-9\-#$%&'*+.^_`|~]/i.test(name)) {
        throw new TypeError('Invalid character in header field name');
    }

    return trim(name);
}

/**
 * HTTP Response.
 */

var Response = function Response(body, ref) {
    var url = ref.url;
    var headers = ref.headers;
    var status = ref.status;
    var statusText = ref.statusText;


    this.url = url;
    this.ok = status >= 200 && status < 300;
    this.status = status || 0;
    this.statusText = statusText || '';
    this.headers = new Headers(headers);
    this.body = body;

    if (isString(body)) {

        this.bodyText = body;

    } else if (isBlob(body)) {

        this.bodyBlob = body;

        if (isBlobText(body)) {
            this.bodyText = blobText(body);
        }
    }
};

Response.prototype.blob = function blob () {
    return when(this.bodyBlob);
};

Response.prototype.text = function text () {
    return when(this.bodyText);
};

Response.prototype.json = function json () {
    return when(this.text(), function (text) { return JSON.parse(text); });
};

Object.defineProperty(Response.prototype, 'data', {

    get: function get() {
        return this.body;
    },

    set: function set(body) {
        this.body = body;
    }

});

function blobText(body) {
    return new PromiseObj(function (resolve) {

        var reader = new FileReader();

        reader.readAsText(body);
        reader.onload = function () {
            resolve(reader.result);
        };

    });
}

function isBlobText(body) {
    return body.type.indexOf('text') === 0 || body.type.indexOf('json') !== -1;
}

/**
 * HTTP Request.
 */

var Request = function Request(options$$1) {

    this.body = null;
    this.params = {};

    assign(this, options$$1, {
        method: toUpper(options$$1.method || 'GET')
    });

    if (!(this.headers instanceof Headers)) {
        this.headers = new Headers(this.headers);
    }
};

Request.prototype.getUrl = function getUrl () {
    return Url(this);
};

Request.prototype.getBody = function getBody () {
    return this.body;
};

Request.prototype.respondWith = function respondWith (body, options$$1) {
    return new Response(body, assign(options$$1 || {}, {url: this.getUrl()}));
};

/**
 * Service for sending network requests.
 */

var COMMON_HEADERS = {'Accept': 'application/json, text/plain, */*'};
var JSON_CONTENT_TYPE = {'Content-Type': 'application/json;charset=utf-8'};

function Http(options$$1) {

    var self = this || {}, client = Client(self.$vm);

    defaults(options$$1 || {}, self.$options, Http.options);

    Http.interceptors.forEach(function (handler) {

        if (isString(handler)) {
            handler = Http.interceptor[handler];
        }

        if (isFunction(handler)) {
            client.use(handler);
        }

    });

    return client(new Request(options$$1)).then(function (response) {

        return response.ok ? response : PromiseObj.reject(response);

    }, function (response) {

        if (response instanceof Error) {
            error(response);
        }

        return PromiseObj.reject(response);
    });
}

Http.options = {};

Http.headers = {
    put: JSON_CONTENT_TYPE,
    post: JSON_CONTENT_TYPE,
    patch: JSON_CONTENT_TYPE,
    delete: JSON_CONTENT_TYPE,
    common: COMMON_HEADERS,
    custom: {}
};

Http.interceptor = {before: before, method: method, jsonp: jsonp, json: json, form: form, header: header, cors: cors};
Http.interceptors = ['before', 'method', 'jsonp', 'json', 'form', 'header', 'cors'];

['get', 'delete', 'head', 'jsonp'].forEach(function (method$$1) {

    Http[method$$1] = function (url, options$$1) {
        return this(assign(options$$1 || {}, {url: url, method: method$$1}));
    };

});

['post', 'put', 'patch'].forEach(function (method$$1) {

    Http[method$$1] = function (url, body, options$$1) {
        return this(assign(options$$1 || {}, {url: url, method: method$$1, body: body}));
    };

});

/**
 * Service for interacting with RESTful services.
 */

function Resource(url, params, actions, options$$1) {

    var self = this || {}, resource = {};

    actions = assign({},
        Resource.actions,
        actions
    );

    each(actions, function (action, name) {

        action = merge({url: url, params: assign({}, params)}, options$$1, action);

        resource[name] = function () {
            return (self.$http || Http)(opts(action, arguments));
        };
    });

    return resource;
}

function opts(action, args) {

    var options$$1 = assign({}, action), params = {}, body;

    switch (args.length) {

        case 2:

            params = args[0];
            body = args[1];

            break;

        case 1:

            if (/^(POST|PUT|PATCH)$/i.test(options$$1.method)) {
                body = args[0];
            } else {
                params = args[0];
            }

            break;

        case 0:

            break;

        default:

            throw 'Expected up to 2 arguments [params, body], got ' + args.length + ' arguments';
    }

    options$$1.body = body;
    options$$1.params = assign({}, options$$1.params, params);

    return options$$1;
}

Resource.actions = {

    get: {method: 'GET'},
    save: {method: 'POST'},
    query: {method: 'GET'},
    update: {method: 'PUT'},
    remove: {method: 'DELETE'},
    delete: {method: 'DELETE'}

};

/**
 * Install plugin.
 */

function plugin(Vue) {

    if (plugin.installed) {
        return;
    }

    Util(Vue);

    Vue.url = Url;
    Vue.http = Http;
    Vue.resource = Resource;
    Vue.Promise = PromiseObj;

    Object.defineProperties(Vue.prototype, {

        $url: {
            get: function get() {
                return options(Vue.url, this, this.$options.url);
            }
        },

        $http: {
            get: function get() {
                return options(Vue.http, this, this.$options.http);
            }
        },

        $resource: {
            get: function get() {
                return Vue.resource.bind(this);
            }
        },

        $promise: {
            get: function get() {
                var this$1 = this;

                return function (executor) { return new Vue.Promise(executor, this$1); };
            }
        }

    });
}

if (typeof window !== 'undefined' && window.Vue) {
    window.Vue.use(plugin);
}

module.exports = plugin;

},{"got":15}],105:[function(require,module,exports){
"use strict";

var _stringify = require("babel-runtime/core-js/json/stringify");

var _stringify2 = _interopRequireDefault(_stringify);

var _getPrototypeOf = require("babel-runtime/core-js/object/get-prototype-of");

var _getPrototypeOf2 = _interopRequireDefault(_getPrototypeOf);

var _getOwnPropertyDescriptor = require("babel-runtime/core-js/object/get-own-property-descriptor");

var _getOwnPropertyDescriptor2 = _interopRequireDefault(_getOwnPropertyDescriptor);

var _defineProperties = require("babel-runtime/core-js/object/define-properties");

var _defineProperties2 = _interopRequireDefault(_defineProperties);

var _preventExtensions = require("babel-runtime/core-js/object/prevent-extensions");

var _preventExtensions2 = _interopRequireDefault(_preventExtensions);

var _isExtensible = require("babel-runtime/core-js/object/is-extensible");

var _isExtensible2 = _interopRequireDefault(_isExtensible);

var _getOwnPropertySymbols = require("babel-runtime/core-js/object/get-own-property-symbols");

var _getOwnPropertySymbols2 = _interopRequireDefault(_getOwnPropertySymbols);

var _getOwnPropertyNames = require("babel-runtime/core-js/object/get-own-property-names");

var _getOwnPropertyNames2 = _interopRequireDefault(_getOwnPropertyNames);

var _create = require("babel-runtime/core-js/object/create");

var _create2 = _interopRequireDefault(_create);

var _keys = require("babel-runtime/core-js/object/keys");

var _keys2 = _interopRequireDefault(_keys);

var _defineProperty = require("babel-runtime/core-js/object/define-property");

var _defineProperty2 = _interopRequireDefault(_defineProperty);

var _typeof2 = require("babel-runtime/helpers/typeof");

var _typeof3 = _interopRequireDefault(_typeof2);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

!function (t, e) {
  "object" == (typeof exports === "undefined" ? "undefined" : (0, _typeof3.default)(exports)) && "object" == (typeof module === "undefined" ? "undefined" : (0, _typeof3.default)(module)) ? module.exports = e() : "function" == typeof define && define.amd ? define([], e) : "object" == (typeof exports === "undefined" ? "undefined" : (0, _typeof3.default)(exports)) ? exports.VueSelect = e() : t.VueSelect = e();
}(undefined, function () {
  return function (t) {
    function e(r) {
      if (n[r]) return n[r].exports;var o = n[r] = { exports: {}, id: r, loaded: !1 };return t[r].call(o.exports, o, o.exports, e), o.loaded = !0, o.exports;
    }var n = {};return e.m = t, e.c = n, e.p = "/", e(0);
  }([function (t, e, n) {
    "use strict";
    function r(t) {
      return t && t.__esModule ? t : { "default": t };
    }Object.defineProperty(e, "__esModule", { value: !0 }), e.mixins = e.VueSelect = void 0;var o = n(85),
        i = r(o),
        s = n(41),
        u = r(s);e["default"] = i["default"], e.VueSelect = i["default"], e.mixins = u["default"];
  }, function (t, e) {
    var n = t.exports = "undefined" != typeof window && window.Math == Math ? window : "undefined" != typeof self && self.Math == Math ? self : Function("return this")();"number" == typeof __g && (__g = n);
  }, function (t, e, n) {
    t.exports = !n(9)(function () {
      return 7 != Object.defineProperty({}, "a", { get: function get() {
          return 7;
        } }).a;
    });
  }, function (t, e) {
    var n = {}.hasOwnProperty;t.exports = function (t, e) {
      return n.call(t, e);
    };
  }, function (t, e, n) {
    var r = n(11),
        o = n(33),
        i = n(25),
        s = _defineProperty2.default;e.f = n(2) ? _defineProperty2.default : function (t, e, n) {
      if (r(t), e = i(e, !0), r(n), o) try {
        return s(t, e, n);
      } catch (u) {}if ("get" in n || "set" in n) throw TypeError("Accessors not supported!");return "value" in n && (t[e] = n.value), t;
    };
  }, function (t, e, n) {
    var r = n(59),
        o = n(16);t.exports = function (t) {
      return r(o(t));
    };
  }, function (t, e) {
    var n = t.exports = { version: "2.4.0" };"number" == typeof __e && (__e = n);
  }, function (t, e, n) {
    var r = n(4),
        o = n(14);t.exports = n(2) ? function (t, e, n) {
      return r.f(t, e, o(1, n));
    } : function (t, e, n) {
      return t[e] = n, t;
    };
  }, function (t, e, n) {
    var r = n(23)("wks"),
        o = n(15),
        i = n(1).Symbol,
        s = "function" == typeof i,
        u = t.exports = function (t) {
      return r[t] || (r[t] = s && i[t] || (s ? i : o)("Symbol." + t));
    };u.store = r;
  }, function (t, e) {
    t.exports = function (t) {
      try {
        return !!t();
      } catch (e) {
        return !0;
      }
    };
  }, function (t, e, n) {
    var r = n(38),
        o = n(17);t.exports = _keys2.default || function (t) {
      return r(t, o);
    };
  }, function (t, e, n) {
    var r = n(13);t.exports = function (t) {
      if (!r(t)) throw TypeError(t + " is not an object!");return t;
    };
  }, function (t, e, n) {
    var r = n(1),
        o = n(6),
        i = n(56),
        s = n(7),
        u = "prototype",
        a = function a(t, e, n) {
      var c,
          l,
          f,
          p = t & a.F,
          d = t & a.G,
          h = t & a.S,
          v = t & a.P,
          y = t & a.B,
          b = t & a.W,
          g = d ? o : o[e] || (o[e] = {}),
          m = g[u],
          x = d ? r : h ? r[e] : (r[e] || {})[u];d && (n = e);for (c in n) {
        l = !p && x && void 0 !== x[c], l && c in g || (f = l ? x[c] : n[c], g[c] = d && "function" != typeof x[c] ? n[c] : y && l ? i(f, r) : b && x[c] == f ? function (t) {
          var e = function e(_e, n, r) {
            if (this instanceof t) {
              switch (arguments.length) {case 0:
                  return new t();case 1:
                  return new t(_e);case 2:
                  return new t(_e, n);}return new t(_e, n, r);
            }return t.apply(this, arguments);
          };return e[u] = t[u], e;
        }(f) : v && "function" == typeof f ? i(Function.call, f) : f, v && ((g.virtual || (g.virtual = {}))[c] = f, t & a.R && m && !m[c] && s(m, c, f)));
      }
    };a.F = 1, a.G = 2, a.S = 4, a.P = 8, a.B = 16, a.W = 32, a.U = 64, a.R = 128, t.exports = a;
  }, function (t, e) {
    t.exports = function (t) {
      return "object" == (typeof t === "undefined" ? "undefined" : (0, _typeof3.default)(t)) ? null !== t : "function" == typeof t;
    };
  }, function (t, e) {
    t.exports = function (t, e) {
      return { enumerable: !(1 & t), configurable: !(2 & t), writable: !(4 & t), value: e };
    };
  }, function (t, e) {
    var n = 0,
        r = Math.random();t.exports = function (t) {
      return "Symbol(".concat(void 0 === t ? "" : t, ")_", (++n + r).toString(36));
    };
  }, function (t, e) {
    t.exports = function (t) {
      if (void 0 == t) throw TypeError("Can't call method on  " + t);return t;
    };
  }, function (t, e) {
    t.exports = "constructor,hasOwnProperty,isPrototypeOf,propertyIsEnumerable,toLocaleString,toString,valueOf".split(",");
  }, function (t, e) {
    t.exports = {};
  }, function (t, e) {
    t.exports = !0;
  }, function (t, e) {
    e.f = {}.propertyIsEnumerable;
  }, function (t, e, n) {
    var r = n(4).f,
        o = n(3),
        i = n(8)("toStringTag");t.exports = function (t, e, n) {
      t && !o(t = n ? t : t.prototype, i) && r(t, i, { configurable: !0, value: e });
    };
  }, function (t, e, n) {
    var r = n(23)("keys"),
        o = n(15);t.exports = function (t) {
      return r[t] || (r[t] = o(t));
    };
  }, function (t, e, n) {
    var r = n(1),
        o = "__core-js_shared__",
        i = r[o] || (r[o] = {});t.exports = function (t) {
      return i[t] || (i[t] = {});
    };
  }, function (t, e) {
    var n = Math.ceil,
        r = Math.floor;t.exports = function (t) {
      return isNaN(t = +t) ? 0 : (t > 0 ? r : n)(t);
    };
  }, function (t, e, n) {
    var r = n(13);t.exports = function (t, e) {
      if (!r(t)) return t;var n, o;if (e && "function" == typeof (n = t.toString) && !r(o = n.call(t))) return o;if ("function" == typeof (n = t.valueOf) && !r(o = n.call(t))) return o;if (!e && "function" == typeof (n = t.toString) && !r(o = n.call(t))) return o;throw TypeError("Can't convert object to primitive value");
    };
  }, function (t, e, n) {
    var r = n(1),
        o = n(6),
        i = n(19),
        s = n(27),
        u = n(4).f;t.exports = function (t) {
      var e = o.Symbol || (o.Symbol = i ? {} : r.Symbol || {});"_" == t.charAt(0) || t in e || u(e, t, { value: s.f(t) });
    };
  }, function (t, e, n) {
    e.f = n(8);
  }, function (t, e) {
    "use strict";
    t.exports = { props: { loading: { type: Boolean, "default": !1 }, onSearch: { type: Function, "default": !1 }, debounce: { type: Number, "default": 0 } }, watch: { search: function search() {
          this.search.length > 0 && this.onSearch && this.onSearch(this.search, this.toggleLoading);
        } }, methods: { toggleLoading: function toggleLoading() {
          var t = arguments.length <= 0 || void 0 === arguments[0] ? null : arguments[0];return null == t ? this.loading = !this.loading : this.loading = t;
        } } };
  }, function (t, e) {
    "use strict";
    t.exports = { watch: { typeAheadPointer: function typeAheadPointer() {
          this.maybeAdjustScroll();
        } }, methods: { maybeAdjustScroll: function maybeAdjustScroll() {
          var t = this.pixelsToPointerTop(),
              e = this.pixelsToPointerBottom();return t <= this.viewport().top ? this.scrollTo(t) : e >= this.viewport().bottom ? this.scrollTo(this.viewport().top + this.pointerHeight()) : void 0;
        }, pixelsToPointerTop: function n() {
          for (var n = 0, t = 0; t < this.typeAheadPointer; t++) {
            n += this.$els.dropdownMenu.children[t].offsetHeight;
          }return n;
        }, pixelsToPointerBottom: function pixelsToPointerBottom() {
          return this.pixelsToPointerTop() + this.pointerHeight();
        }, pointerHeight: function pointerHeight() {
          var t = this.$els.dropdownMenu.children[this.typeAheadPointer];return t ? t.offsetHeight : 0;
        }, viewport: function viewport() {
          return { top: this.$els.dropdownMenu.scrollTop, bottom: this.$els.dropdownMenu.offsetHeight + this.$els.dropdownMenu.scrollTop };
        }, scrollTo: function scrollTo(t) {
          return this.$els.dropdownMenu.scrollTop = t;
        } } };
  }, function (t, e) {
    "use strict";
    t.exports = { data: function data() {
        return { typeAheadPointer: -1 };
      }, watch: { filteredOptions: function filteredOptions() {
          this.typeAheadPointer = 0;
        } }, methods: { typeAheadUp: function typeAheadUp() {
          this.typeAheadPointer > 0 && (this.typeAheadPointer--, this.maybeAdjustScroll && this.maybeAdjustScroll());
        }, typeAheadDown: function typeAheadDown() {
          this.typeAheadPointer < this.filteredOptions.length - 1 && (this.typeAheadPointer++, this.maybeAdjustScroll && this.maybeAdjustScroll());
        }, typeAheadSelect: function typeAheadSelect() {
          this.filteredOptions[this.typeAheadPointer] ? this.select(this.filteredOptions[this.typeAheadPointer]) : this.taggable && this.search.length && this.select(this.search), this.clearSearchOnSelect && (this.search = "");
        } } };
  }, function (t, e) {
    var n = {}.toString;t.exports = function (t) {
      return n.call(t).slice(8, -1);
    };
  }, function (t, e, n) {
    var r = n(13),
        o = n(1).document,
        i = r(o) && r(o.createElement);t.exports = function (t) {
      return i ? o.createElement(t) : {};
    };
  }, function (t, e, n) {
    t.exports = !n(2) && !n(9)(function () {
      return 7 != Object.defineProperty(n(32)("div"), "a", { get: function get() {
          return 7;
        } }).a;
    });
  }, function (t, e, n) {
    "use strict";
    var r = n(19),
        o = n(12),
        i = n(39),
        s = n(7),
        u = n(3),
        a = n(18),
        c = n(61),
        l = n(21),
        f = n(68),
        p = n(8)("iterator"),
        d = !([].keys && "next" in [].keys()),
        h = "@@iterator",
        v = "keys",
        y = "values",
        b = function b() {
      return this;
    };t.exports = function (t, e, n, g, m, x, w) {
      c(n, e, g);var S,
          O,
          _,
          j = function j(t) {
        if (!d && t in E) return E[t];switch (t) {case v:
            return function () {
              return new n(this, t);
            };case y:
            return function () {
              return new n(this, t);
            };}return function () {
          return new n(this, t);
        };
      },
          A = e + " Iterator",
          P = m == y,
          k = !1,
          E = t.prototype,
          M = E[p] || E[h] || m && E[m],
          T = M || j(m),
          C = m ? P ? j("entries") : T : void 0,
          $ = "Array" == e ? E.entries || M : M;if ($ && (_ = f($.call(new t())), _ !== Object.prototype && (l(_, A, !0), r || u(_, p) || s(_, p, b))), P && M && M.name !== y && (k = !0, T = function T() {
        return M.call(this);
      }), r && !w || !d && !k && E[p] || s(E, p, T), a[e] = T, a[A] = b, m) if (S = { values: P ? T : j(y), keys: x ? T : j(v), entries: C }, w) for (O in S) {
        O in E || i(E, O, S[O]);
      } else o(o.P + o.F * (d || k), e, S);return S;
    };
  }, function (t, e, n) {
    var r = n(11),
        o = n(65),
        i = n(17),
        s = n(22)("IE_PROTO"),
        u = function u() {},
        a = "prototype",
        _c = function c() {
      var t,
          e = n(32)("iframe"),
          r = i.length,
          o = ">";for (e.style.display = "none", n(58).appendChild(e), e.src = "javascript:", t = e.contentWindow.document, t.open(), t.write("<script>document.F=Object</script" + o), t.close(), _c = t.F; r--;) {
        delete _c[a][i[r]];
      }return _c();
    };t.exports = _create2.default || function (t, e) {
      var n;return null !== t ? (u[a] = r(t), n = new u(), u[a] = null, n[s] = t) : n = _c(), void 0 === e ? n : o(n, e);
    };
  }, function (t, e, n) {
    var r = n(38),
        o = n(17).concat("length", "prototype");e.f = _getOwnPropertyNames2.default || function (t) {
      return r(t, o);
    };
  }, function (t, e) {
    e.f = _getOwnPropertySymbols2.default;
  }, function (t, e, n) {
    var r = n(3),
        o = n(5),
        i = n(55)(!1),
        s = n(22)("IE_PROTO");t.exports = function (t, e) {
      var n,
          u = o(t),
          a = 0,
          c = [];for (n in u) {
        n != s && r(u, n) && c.push(n);
      }for (; e.length > a;) {
        r(u, n = e[a++]) && (~i(c, n) || c.push(n));
      }return c;
    };
  }, function (t, e, n) {
    t.exports = n(7);
  }, function (t, e, n) {
    var r = n(16);t.exports = function (t) {
      return Object(r(t));
    };
  }, function (t, e, n) {
    "use strict";
    function r(t) {
      return t && t.__esModule ? t : { "default": t };
    }Object.defineProperty(e, "__esModule", { value: !0 });var o = n(28),
        i = r(o),
        s = n(30),
        u = r(s),
        a = n(29),
        c = r(a);e["default"] = { ajax: i["default"], pointer: u["default"], pointerScroll: c["default"] };
  }, function (t, e, n) {
    "use strict";
    function r(t) {
      return t && t.__esModule ? t : { "default": t };
    }Object.defineProperty(e, "__esModule", { value: !0 });var o = n(44),
        i = r(o),
        s = n(47),
        u = r(s),
        a = n(48),
        c = r(a),
        l = n(29),
        f = r(l),
        p = n(30),
        d = r(p),
        h = n(28),
        v = r(h);e["default"] = { mixins: [f["default"], d["default"], v["default"]], props: { value: { "default": null }, options: { type: Array, "default": function _default() {
            return [];
          } }, maxHeight: { type: String, "default": "400px" }, searchable: { type: Boolean, "default": !0 }, multiple: { type: Boolean, "default": !1 }, placeholder: { type: String, "default": "" }, transition: { type: String, "default": "expand" }, clearSearchOnSelect: { type: Boolean, "default": !0 }, label: { type: String, "default": "label" }, getOptionLabel: { type: Function, "default": function _default(t) {
            return "object" === ("undefined" == typeof t ? "undefined" : (0, c["default"])(t)) && this.label && t[this.label] ? t[this.label] : t;
          } }, onChange: Function, taggable: { type: Boolean, "default": !1 }, pushTags: { type: Boolean, "default": !1 }, createOption: { type: Function, "default": function _default(t) {
            return "object" === (0, c["default"])(this.options[0]) ? (0, u["default"])({}, this.label, t) : t;
          } }, resetOnOptionsChange: { type: Boolean, "default": !1 } }, data: function data() {
        return { search: "", open: !1 };
      }, watch: { value: function value(t, e) {
          this.multiple ? this.onChange ? this.onChange(t) : null : this.onChange && t !== e ? this.onChange(t) : null;
        }, options: function options() {
          !this.taggable && this.resetOnOptionsChange && this.$set("value", this.multiple ? [] : null);
        }, multiple: function multiple(t) {
          this.$set("value", t ? [] : null);
        } }, methods: { select: function select(t) {
          this.isOptionSelected(t) ? this.deselect(t) : (this.taggable && !this.optionExists(t) && (t = this.createOption(t), this.pushTags && this.options.push(t)), this.multiple ? this.value ? this.value.push(t) : this.$set("value", [t]) : this.value = t), this.onAfterSelect(t);
        }, deselect: function deselect(t) {
          var e = this;if (this.multiple) {
            var n = -1;this.value.forEach(function (r) {
              (r === t || "object" === ("undefined" == typeof r ? "undefined" : (0, c["default"])(r)) && r[e.label] === t[e.label]) && (n = r);
            }), this.value.$remove(n);
          } else this.value = null;
        }, onAfterSelect: function onAfterSelect(t) {
          this.multiple || (this.open = !this.open, this.$els.search.blur()), this.clearSearchOnSelect && (this.search = "");
        }, toggleDropdown: function toggleDropdown(t) {
          t.target !== this.$els.openIndicator && t.target !== this.$els.search && t.target !== this.$els.toggle && t.target !== this.$el || (this.open ? this.$els.search.blur() : (this.open = !0, this.$els.search.focus()));
        }, isOptionSelected: function isOptionSelected(t) {
          var e = this;if (this.multiple && this.value) {
            var n = !1;return this.value.forEach(function (r) {
              "object" === ("undefined" == typeof r ? "undefined" : (0, c["default"])(r)) && r[e.label] === t[e.label] ? n = !0 : r === t && (n = !0);
            }), n;
          }return this.value === t;
        }, onEscape: function onEscape() {
          this.search.length ? this.search = "" : this.$els.search.blur();
        }, maybeDeleteValue: function maybeDeleteValue() {
          if (!this.$els.search.value.length && this.value) return this.multiple ? this.value.pop() : this.$set("value", null);
        }, optionExists: function optionExists(t) {
          var e = this,
              n = !1;return this.options.forEach(function (r) {
            "object" === ("undefined" == typeof r ? "undefined" : (0, c["default"])(r)) && r[e.label] === t ? n = !0 : r === t && (n = !0);
          }), n;
        } }, computed: { dropdownClasses: function dropdownClasses() {
          return { open: this.open, searchable: this.searchable, loading: this.loading };
        }, searchPlaceholder: function searchPlaceholder() {
          if (this.isValueEmpty && this.placeholder) return this.placeholder;
        }, filteredOptions: function filteredOptions() {
          var t = this.$options.filters.filterBy(this.options, this.search);return this.taggable && this.search.length && !this.optionExists(this.search) && t.unshift(this.search), t;
        }, isValueEmpty: function isValueEmpty() {
          return !this.value || ("object" === (0, c["default"])(this.value) ? !(0, i["default"])(this.value).length : !this.value.length);
        }, valueAsArray: function valueAsArray() {
          return this.multiple ? this.value : this.value ? [this.value] : [];
        } } };
  }, function (t, e, n) {
    t.exports = { "default": n(49), __esModule: !0 };
  }, function (t, e, n) {
    t.exports = { "default": n(50), __esModule: !0 };
  }, function (t, e, n) {
    t.exports = { "default": n(51), __esModule: !0 };
  }, function (t, e, n) {
    t.exports = { "default": n(52), __esModule: !0 };
  }, function (t, e, n) {
    "use strict";
    function r(t) {
      return t && t.__esModule ? t : { "default": t };
    }e.__esModule = !0;var o = n(43),
        i = r(o);e["default"] = function (t, e, n) {
      return e in t ? (0, i["default"])(t, e, { value: n, enumerable: !0, configurable: !0, writable: !0 }) : t[e] = n, t;
    };
  }, function (t, e, n) {
    "use strict";
    function r(t) {
      return t && t.__esModule ? t : { "default": t };
    }e.__esModule = !0;var o = n(46),
        i = r(o),
        s = n(45),
        u = r(s),
        a = "function" == typeof u["default"] && "symbol" == (0, _typeof3.default)(i["default"]) ? function (t) {
      return typeof t === "undefined" ? "undefined" : (0, _typeof3.default)(t);
    } : function (t) {
      return t && "function" == typeof u["default"] && t.constructor === u["default"] ? "symbol" : typeof t === "undefined" ? "undefined" : (0, _typeof3.default)(t);
    };e["default"] = "function" == typeof u["default"] && "symbol" === a(i["default"]) ? function (t) {
      return "undefined" == typeof t ? "undefined" : a(t);
    } : function (t) {
      return t && "function" == typeof u["default"] && t.constructor === u["default"] ? "symbol" : "undefined" == typeof t ? "undefined" : a(t);
    };
  }, function (t, e, n) {
    n(74);var r = n(6).Object;t.exports = function (t, e, n) {
      return r.defineProperty(t, e, n);
    };
  }, function (t, e, n) {
    n(75), t.exports = n(6).Object.keys;
  }, function (t, e, n) {
    n(78), n(76), n(79), n(80), t.exports = n(6).Symbol;
  }, function (t, e, n) {
    n(77), n(81), t.exports = n(27).f("iterator");
  }, function (t, e) {
    t.exports = function (t) {
      if ("function" != typeof t) throw TypeError(t + " is not a function!");return t;
    };
  }, function (t, e) {
    t.exports = function () {};
  }, function (t, e, n) {
    var r = n(5),
        o = n(72),
        i = n(71);t.exports = function (t) {
      return function (e, n, s) {
        var u,
            a = r(e),
            c = o(a.length),
            l = i(s, c);if (t && n != n) {
          for (; c > l;) {
            if (u = a[l++], u != u) return !0;
          }
        } else for (; c > l; l++) {
          if ((t || l in a) && a[l] === n) return t || l || 0;
        }return !t && -1;
      };
    };
  }, function (t, e, n) {
    var r = n(53);t.exports = function (t, e, n) {
      if (r(t), void 0 === e) return t;switch (n) {case 1:
          return function (n) {
            return t.call(e, n);
          };case 2:
          return function (n, r) {
            return t.call(e, n, r);
          };case 3:
          return function (n, r, o) {
            return t.call(e, n, r, o);
          };}return function () {
        return t.apply(e, arguments);
      };
    };
  }, function (t, e, n) {
    var r = n(10),
        o = n(37),
        i = n(20);t.exports = function (t) {
      var e = r(t),
          n = o.f;if (n) for (var s, u = n(t), a = i.f, c = 0; u.length > c;) {
        a.call(t, s = u[c++]) && e.push(s);
      }return e;
    };
  }, function (t, e, n) {
    t.exports = n(1).document && document.documentElement;
  }, function (t, e, n) {
    var r = n(31);t.exports = Object("z").propertyIsEnumerable(0) ? Object : function (t) {
      return "String" == r(t) ? t.split("") : Object(t);
    };
  }, function (t, e, n) {
    var r = n(31);t.exports = Array.isArray || function (t) {
      return "Array" == r(t);
    };
  }, function (t, e, n) {
    "use strict";
    var r = n(35),
        o = n(14),
        i = n(21),
        s = {};n(7)(s, n(8)("iterator"), function () {
      return this;
    }), t.exports = function (t, e, n) {
      t.prototype = r(s, { next: o(1, n) }), i(t, e + " Iterator");
    };
  }, function (t, e) {
    t.exports = function (t, e) {
      return { value: e, done: !!t };
    };
  }, function (t, e, n) {
    var r = n(10),
        o = n(5);t.exports = function (t, e) {
      for (var n, i = o(t), s = r(i), u = s.length, a = 0; u > a;) {
        if (i[n = s[a++]] === e) return n;
      }
    };
  }, function (t, e, n) {
    var r = n(15)("meta"),
        o = n(13),
        i = n(3),
        s = n(4).f,
        u = 0,
        a = _isExtensible2.default || function () {
      return !0;
    },
        c = !n(9)(function () {
      return a((0, _preventExtensions2.default)({}));
    }),
        l = function l(t) {
      s(t, r, { value: { i: "O" + ++u, w: {} } });
    },
        f = function f(t, e) {
      if (!o(t)) return "symbol" == (typeof t === "undefined" ? "undefined" : (0, _typeof3.default)(t)) ? t : ("string" == typeof t ? "S" : "P") + t;if (!i(t, r)) {
        if (!a(t)) return "F";if (!e) return "E";l(t);
      }return t[r].i;
    },
        p = function p(t, e) {
      if (!i(t, r)) {
        if (!a(t)) return !0;if (!e) return !1;l(t);
      }return t[r].w;
    },
        d = function d(t) {
      return c && h.NEED && a(t) && !i(t, r) && l(t), t;
    },
        h = t.exports = { KEY: r, NEED: !1, fastKey: f, getWeak: p, onFreeze: d };
  }, function (t, e, n) {
    var r = n(4),
        o = n(11),
        i = n(10);t.exports = n(2) ? _defineProperties2.default : function (t, e) {
      o(t);for (var n, s = i(e), u = s.length, a = 0; u > a;) {
        r.f(t, n = s[a++], e[n]);
      }return t;
    };
  }, function (t, e, n) {
    var r = n(20),
        o = n(14),
        i = n(5),
        s = n(25),
        u = n(3),
        a = n(33),
        c = _getOwnPropertyDescriptor2.default;e.f = n(2) ? c : function (t, e) {
      if (t = i(t), e = s(e, !0), a) try {
        return c(t, e);
      } catch (n) {}if (u(t, e)) return o(!r.f.call(t, e), t[e]);
    };
  }, function (t, e, n) {
    var r = n(5),
        o = n(36).f,
        i = {}.toString,
        s = "object" == (typeof window === "undefined" ? "undefined" : (0, _typeof3.default)(window)) && window && _getOwnPropertyNames2.default ? (0, _getOwnPropertyNames2.default)(window) : [],
        u = function u(t) {
      try {
        return o(t);
      } catch (e) {
        return s.slice();
      }
    };t.exports.f = function (t) {
      return s && "[object Window]" == i.call(t) ? u(t) : o(r(t));
    };
  }, function (t, e, n) {
    var r = n(3),
        o = n(40),
        i = n(22)("IE_PROTO"),
        s = Object.prototype;t.exports = _getPrototypeOf2.default || function (t) {
      return t = o(t), r(t, i) ? t[i] : "function" == typeof t.constructor && t instanceof t.constructor ? t.constructor.prototype : t instanceof Object ? s : null;
    };
  }, function (t, e, n) {
    var r = n(12),
        o = n(6),
        i = n(9);t.exports = function (t, e) {
      var n = (o.Object || {})[t] || Object[t],
          s = {};s[t] = e(n), r(r.S + r.F * i(function () {
        n(1);
      }), "Object", s);
    };
  }, function (t, e, n) {
    var r = n(24),
        o = n(16);t.exports = function (t) {
      return function (e, n) {
        var i,
            s,
            u = String(o(e)),
            a = r(n),
            c = u.length;return a < 0 || a >= c ? t ? "" : void 0 : (i = u.charCodeAt(a), i < 55296 || i > 56319 || a + 1 === c || (s = u.charCodeAt(a + 1)) < 56320 || s > 57343 ? t ? u.charAt(a) : i : t ? u.slice(a, a + 2) : (i - 55296 << 10) + (s - 56320) + 65536);
      };
    };
  }, function (t, e, n) {
    var r = n(24),
        o = Math.max,
        i = Math.min;t.exports = function (t, e) {
      return t = r(t), t < 0 ? o(t + e, 0) : i(t, e);
    };
  }, function (t, e, n) {
    var r = n(24),
        o = Math.min;t.exports = function (t) {
      return t > 0 ? o(r(t), 9007199254740991) : 0;
    };
  }, function (t, e, n) {
    "use strict";
    var r = n(54),
        o = n(62),
        i = n(18),
        s = n(5);t.exports = n(34)(Array, "Array", function (t, e) {
      this._t = s(t), this._i = 0, this._k = e;
    }, function () {
      var t = this._t,
          e = this._k,
          n = this._i++;return !t || n >= t.length ? (this._t = void 0, o(1)) : "keys" == e ? o(0, n) : "values" == e ? o(0, t[n]) : o(0, [n, t[n]]);
    }, "values"), i.Arguments = i.Array, r("keys"), r("values"), r("entries");
  }, function (t, e, n) {
    var r = n(12);r(r.S + r.F * !n(2), "Object", { defineProperty: n(4).f });
  }, function (t, e, n) {
    var r = n(40),
        o = n(10);n(69)("keys", function () {
      return function (t) {
        return o(r(t));
      };
    });
  }, function (t, e) {}, function (t, e, n) {
    "use strict";
    var r = n(70)(!0);n(34)(String, "String", function (t) {
      this._t = String(t), this._i = 0;
    }, function () {
      var t,
          e = this._t,
          n = this._i;return n >= e.length ? { value: void 0, done: !0 } : (t = r(e, n), this._i += t.length, { value: t, done: !1 });
    });
  }, function (t, e, n) {
    "use strict";
    var r = n(1),
        o = n(3),
        i = n(2),
        s = n(12),
        u = n(39),
        a = n(64).KEY,
        c = n(9),
        l = n(23),
        f = n(21),
        p = n(15),
        d = n(8),
        h = n(27),
        v = n(26),
        y = n(63),
        b = n(57),
        g = n(60),
        m = n(11),
        x = n(5),
        w = n(25),
        S = n(14),
        O = n(35),
        _ = n(67),
        j = n(66),
        A = n(4),
        P = n(10),
        k = j.f,
        E = A.f,
        M = _.f,
        _T = r.Symbol,
        C = r.JSON,
        $ = C && C.stringify,
        F = "prototype",
        N = d("_hidden"),
        B = d("toPrimitive"),
        I = {}.propertyIsEnumerable,
        L = l("symbol-registry"),
        z = l("symbols"),
        D = l("op-symbols"),
        V = Object[F],
        R = "function" == typeof _T,
        H = r.QObject,
        U = !H || !H[F] || !H[F].findChild,
        W = i && c(function () {
      return 7 != O(E({}, "a", { get: function get() {
          return E(this, "a", { value: 7 }).a;
        } })).a;
    }) ? function (t, e, n) {
      var r = k(V, e);r && delete V[e], E(t, e, n), r && t !== V && E(V, e, r);
    } : E,
        J = function J(t) {
      var e = z[t] = O(_T[F]);return e._k = t, e;
    },
        G = R && "symbol" == (0, _typeof3.default)(_T.iterator) ? function (t) {
      return "symbol" == (typeof t === "undefined" ? "undefined" : (0, _typeof3.default)(t));
    } : function (t) {
      return t instanceof _T;
    },
        K = function K(t, e, n) {
      return t === V && K(D, e, n), m(t), e = w(e, !0), m(n), o(z, e) ? (n.enumerable ? (o(t, N) && t[N][e] && (t[N][e] = !1), n = O(n, { enumerable: S(0, !1) })) : (o(t, N) || E(t, N, S(1, {})), t[N][e] = !0), W(t, e, n)) : E(t, e, n);
    },
        Y = function Y(t, e) {
      m(t);for (var n, r = b(e = x(e)), o = 0, i = r.length; i > o;) {
        K(t, n = r[o++], e[n]);
      }return t;
    },
        Z = function Z(t, e) {
      return void 0 === e ? O(t) : Y(O(t), e);
    },
        Q = function Q(t) {
      var e = I.call(this, t = w(t, !0));return !(this === V && o(z, t) && !o(D, t)) && (!(e || !o(this, t) || !o(z, t) || o(this, N) && this[N][t]) || e);
    },
        q = function q(t, e) {
      if (t = x(t), e = w(e, !0), t !== V || !o(z, e) || o(D, e)) {
        var n = k(t, e);return !n || !o(z, e) || o(t, N) && t[N][e] || (n.enumerable = !0), n;
      }
    },
        X = function X(t) {
      for (var e, n = M(x(t)), r = [], i = 0; n.length > i;) {
        o(z, e = n[i++]) || e == N || e == a || r.push(e);
      }return r;
    },
        tt = function tt(t) {
      for (var e, n = t === V, r = M(n ? D : x(t)), i = [], s = 0; r.length > s;) {
        !o(z, e = r[s++]) || n && !o(V, e) || i.push(z[e]);
      }return i;
    };R || (_T = function T() {
      if (this instanceof _T) throw TypeError("Symbol is not a constructor!");var t = p(arguments.length > 0 ? arguments[0] : void 0),
          e = function e(n) {
        this === V && e.call(D, n), o(this, N) && o(this[N], t) && (this[N][t] = !1), W(this, t, S(1, n));
      };return i && U && W(V, t, { configurable: !0, set: e }), J(t);
    }, u(_T[F], "toString", function () {
      return this._k;
    }), j.f = q, A.f = K, n(36).f = _.f = X, n(20).f = Q, n(37).f = tt, i && !n(19) && u(V, "propertyIsEnumerable", Q, !0), h.f = function (t) {
      return J(d(t));
    }), s(s.G + s.W + s.F * !R, { Symbol: _T });for (var et = "hasInstance,isConcatSpreadable,iterator,match,replace,search,species,split,toPrimitive,toStringTag,unscopables".split(","), nt = 0; et.length > nt;) {
      d(et[nt++]);
    }for (var et = P(d.store), nt = 0; et.length > nt;) {
      v(et[nt++]);
    }s(s.S + s.F * !R, "Symbol", { "for": function _for(t) {
        return o(L, t += "") ? L[t] : L[t] = _T(t);
      }, keyFor: function keyFor(t) {
        if (G(t)) return y(L, t);throw TypeError(t + " is not a symbol!");
      }, useSetter: function useSetter() {
        U = !0;
      }, useSimple: function useSimple() {
        U = !1;
      } }), s(s.S + s.F * !R, "Object", { create: Z, defineProperty: K, defineProperties: Y, getOwnPropertyDescriptor: q, getOwnPropertyNames: X, getOwnPropertySymbols: tt }), C && s(s.S + s.F * (!R || c(function () {
      var t = _T();return "[null]" != $([t]) || "{}" != $({ a: t }) || "{}" != $(Object(t));
    })), "JSON", { stringify: function stringify(t) {
        if (void 0 !== t && !G(t)) {
          for (var e, n, r = [t], o = 1; arguments.length > o;) {
            r.push(arguments[o++]);
          }return e = r[1], "function" == typeof e && (n = e), !n && g(e) || (e = function e(t, _e2) {
            if (n && (_e2 = n.call(this, t, _e2)), !G(_e2)) return _e2;
          }), r[1] = e, $.apply(C, r);
        }
      } }), _T[F][B] || n(7)(_T[F], B, _T[F].valueOf), f(_T, "Symbol"), f(Math, "Math", !0), f(r.JSON, "JSON", !0);
  }, function (t, e, n) {
    n(26)("asyncIterator");
  }, function (t, e, n) {
    n(26)("observable");
  }, function (t, e, n) {
    n(73);for (var r = n(1), o = n(7), i = n(18), s = n(8)("toStringTag"), u = ["NodeList", "DOMTokenList", "MediaList", "StyleSheetList", "CSSRuleList"], a = 0; a < 5; a++) {
      var c = u[a],
          l = r[c],
          f = l && l.prototype;f && !f[s] && o(f, s, c), i[c] = i.Array;
    }
  }, function (t, e, n) {
    e = t.exports = n(83)(), e.push([t.id, ".v-select{position:relative}.v-select .open-indicator{position:absolute;bottom:6px;right:10px;display:inline-block;cursor:pointer;pointer-events:all;-webkit-transition:all .15s cubic-bezier(1,-.115,.975,.855);transition:all .15s cubic-bezier(1,-.115,.975,.855);-webkit-transition-timing-function:cubic-bezier(1,-.115,.975,.855);transition-timing-function:cubic-bezier(1,-.115,.975,.855);opacity:1;-webkit-transition:opacity .1s;transition:opacity .1s}.v-select.loading .open-indicator{opacity:0}.v-select .open-indicator:before{border-color:rgba(60,60,60,.5);border-style:solid;border-width:.25em .25em 0 0;content:'';display:inline-block;height:10px;width:10px;vertical-align:top;-webkit-transform:rotate(133deg);transform:rotate(133deg);-webkit-transition:all .15s cubic-bezier(1,-.115,.975,.855);transition:all .15s cubic-bezier(1,-.115,.975,.855);-webkit-transition-timing-function:cubic-bezier(1,-.115,.975,.855);transition-timing-function:cubic-bezier(1,-.115,.975,.855)}.v-select.open .open-indicator{bottom:1px}.v-select.open .open-indicator:before{-webkit-transform:rotate(315deg);transform:rotate(315deg)}.v-select .dropdown-toggle{display:block;padding:0;background:none;border:1px solid rgba(60,60,60,.26);border-radius:4px;white-space:normal}.v-select.searchable .dropdown-toggle{cursor:text}.v-select.open .dropdown-toggle{border-bottom:none;border-bottom-left-radius:0;border-bottom-right-radius:0}.v-select>.dropdown-menu{margin:0;width:100%;overflow-y:scroll;border-top:none;border-top-left-radius:0;border-top-right-radius:0}.v-select .selected-tag{color:#333;background-color:#f0f0f0;border:1px solid #ccc;border-radius:4px;height:26px;margin:4px 1px 0 3px;padding:0 .25em;float:left;line-height:1.7em}.v-select .selected-tag .close{float:none;margin-right:0;font-size:20px}.v-select input[type=search],.v-select input[type=search]:focus{display:inline-block;border:none;outline:none;margin:0;padding:0 .5em;width:10em;max-width:100%;background:none;position:relative;box-shadow:none;float:left;clear:none}.v-select input[type=search]:disabled,.v-select li a{cursor:pointer}.v-select .active a{background:rgba(50,50,50,.1);color:#333}.v-select .highlight a,.v-select li:hover>a{background:#f0f0f0;color:#333}.v-select .spinner{opacity:0;position:absolute;top:5px;right:10px;font-size:5px;text-indent:-9999em;overflow:hidden;border-top:.9em solid hsla(0,0%,39%,.1);border-right:.9em solid hsla(0,0%,39%,.1);border-bottom:.9em solid hsla(0,0%,39%,.1);border-left:.9em solid rgba(60,60,60,.45);-webkit-transform:translateZ(0);transform:translateZ(0);-webkit-animation:vSelectSpinner 1.1s infinite linear;animation:vSelectSpinner 1.1s infinite linear;-webkit-transition:opacity .1s;transition:opacity .1s}.v-select.loading .spinner{opacity:1}.v-select .spinner,.v-select .spinner:after{border-radius:50%;width:5em;height:5em}@-webkit-keyframes vSelectSpinner{0%{-webkit-transform:rotate(0deg);transform:rotate(0deg)}to{-webkit-transform:rotate(1turn);transform:rotate(1turn)}}@keyframes vSelectSpinner{0%{-webkit-transform:rotate(0deg);transform:rotate(0deg)}to{-webkit-transform:rotate(1turn);transform:rotate(1turn)}}", ""]);
  }, function (t, e) {
    t.exports = function () {
      var t = [];return t.toString = function () {
        for (var t = [], e = 0; e < this.length; e++) {
          var n = this[e];n[2] ? t.push("@media " + n[2] + "{" + n[1] + "}") : t.push(n[1]);
        }return t.join("");
      }, t.i = function (e, n) {
        "string" == typeof e && (e = [[null, e, ""]]);for (var r = {}, o = 0; o < this.length; o++) {
          var i = this[o][0];"number" == typeof i && (r[i] = !0);
        }for (o = 0; o < e.length; o++) {
          var s = e[o];"number" == typeof s[0] && r[s[0]] || (n && !s[2] ? s[2] = n : n && (s[2] = "(" + s[2] + ") and (" + n + ")"), t.push(s));
        }
      }, t;
    };
  }, function (t, e) {
    t.exports = ' <div class="dropdown v-select" :class=dropdownClasses> <div v-el:toggle @mousedown.prevent=toggleDropdown class="dropdown-toggle clearfix" type=button> <span class=form-control v-if="!searchable && isValueEmpty"> {{ placeholder }} </span> <span class=selected-tag v-for="option in valueAsArray" track-by=$index> {{ getOptionLabel(option) }} <button v-if=multiple @click=select(option) type=button class=close> <span aria-hidden=true>&times;</span> </button> </span> <input v-el:search :debounce=debounce v-model=search v-show=searchable @keydown.delete=maybeDeleteValue @keyup.esc=onEscape @keydown.up.prevent=typeAheadUp @keydown.down.prevent=typeAheadDown @keyup.enter.prevent=typeAheadSelect @blur="open = false" @focus="open = true" type=search class=form-control :placeholder=searchPlaceholder :style="{ width: isValueEmpty ? \'100%\' : \'auto\' }"> <i v-el:open-indicator role=presentation class=open-indicator></i> <slot name=spinner> <div class=spinner v-show="onSearch && loading">Loading...</div> </slot> </div> <ul v-el:dropdown-menu v-show=open :transition=transition class=dropdown-menu :style="{ \'max-height\': maxHeight }"> <li v-for="option in filteredOptions" track-by=$index :class="{ active: isOptionSelected(option), highlight: $index === typeAheadPointer }" @mouseover="typeAheadPointer = $index"> <a @mousedown.prevent=select(option)> {{ getOptionLabel(option) }} </a> </li> <li transition=fade v-if=!filteredOptions.length class=divider></li> <li transition=fade v-if=!filteredOptions.length class=text-center> <slot name=no-options>Sorry, no matching options.</slot> </li> </ul> </div> ';
  }, function (t, e, n) {
    var r, o;n(87), r = n(42), o = n(84), t.exports = r || {}, t.exports.__esModule && (t.exports = t.exports["default"]), o && (("function" == typeof t.exports ? t.exports.options || (t.exports.options = {}) : t.exports).template = o);
  }, function (t, e, n) {
    function r(t, e) {
      for (var n = 0; n < t.length; n++) {
        var r = t[n],
            o = f[r.id];if (o) {
          o.refs++;for (var i = 0; i < o.parts.length; i++) {
            o.parts[i](r.parts[i]);
          }for (; i < r.parts.length; i++) {
            o.parts.push(a(r.parts[i], e));
          }
        } else {
          for (var s = [], i = 0; i < r.parts.length; i++) {
            s.push(a(r.parts[i], e));
          }f[r.id] = { id: r.id, refs: 1, parts: s };
        }
      }
    }function o(t) {
      for (var e = [], n = {}, r = 0; r < t.length; r++) {
        var o = t[r],
            i = o[0],
            s = o[1],
            u = o[2],
            a = o[3],
            c = { css: s, media: u, sourceMap: a };n[i] ? n[i].parts.push(c) : e.push(n[i] = { id: i, parts: [c] });
      }return e;
    }function i(t, e) {
      var n = h(),
          r = b[b.length - 1];if ("top" === t.insertAt) r ? r.nextSibling ? n.insertBefore(e, r.nextSibling) : n.appendChild(e) : n.insertBefore(e, n.firstChild), b.push(e);else {
        if ("bottom" !== t.insertAt) throw new Error("Invalid value for parameter 'insertAt'. Must be 'top' or 'bottom'.");n.appendChild(e);
      }
    }function s(t) {
      t.parentNode.removeChild(t);var e = b.indexOf(t);e >= 0 && b.splice(e, 1);
    }function u(t) {
      var e = document.createElement("style");return e.type = "text/css", i(t, e), e;
    }function a(t, e) {
      var n, r, o;if (e.singleton) {
        var i = y++;n = v || (v = u(e)), r = c.bind(null, n, i, !1), o = c.bind(null, n, i, !0);
      } else n = u(e), r = l.bind(null, n), o = function o() {
        s(n);
      };return r(t), function (e) {
        if (e) {
          if (e.css === t.css && e.media === t.media && e.sourceMap === t.sourceMap) return;r(t = e);
        } else o();
      };
    }function c(t, e, n, r) {
      var o = n ? "" : r.css;if (t.styleSheet) t.styleSheet.cssText = g(e, o);else {
        var i = document.createTextNode(o),
            s = t.childNodes;s[e] && t.removeChild(s[e]), s.length ? t.insertBefore(i, s[e]) : t.appendChild(i);
      }
    }function l(t, e) {
      var n = e.css,
          r = e.media,
          o = e.sourceMap;if (r && t.setAttribute("media", r), o && (n += "\n/*# sourceURL=" + o.sources[0] + " */", n += "\n/*# sourceMappingURL=data:application/json;base64," + btoa(unescape(encodeURIComponent((0, _stringify2.default)(o)))) + " */"), t.styleSheet) t.styleSheet.cssText = n;else {
        for (; t.firstChild;) {
          t.removeChild(t.firstChild);
        }t.appendChild(document.createTextNode(n));
      }
    }var f = {},
        p = function p(t) {
      var e;return function () {
        return "undefined" == typeof e && (e = t.apply(this, arguments)), e;
      };
    },
        d = p(function () {
      return (/msie [6-9]\b/.test(window.navigator.userAgent.toLowerCase())
      );
    }),
        h = p(function () {
      return document.head || document.getElementsByTagName("head")[0];
    }),
        v = null,
        y = 0,
        b = [];t.exports = function (t, e) {
      e = e || {}, "undefined" == typeof e.singleton && (e.singleton = d()), "undefined" == typeof e.insertAt && (e.insertAt = "bottom");var n = o(t);return r(n, e), function (t) {
        for (var i = [], s = 0; s < n.length; s++) {
          var u = n[s],
              a = f[u.id];a.refs--, i.push(a);
        }if (t) {
          var c = o(t);r(c, e);
        }for (var s = 0; s < i.length; s++) {
          var a = i[s];if (0 === a.refs) {
            for (var l = 0; l < a.parts.length; l++) {
              a.parts[l]();
            }delete f[a.id];
          }
        }
      };
    };var g = function () {
      var t = [];return function (e, n) {
        return t[e] = n, t.filter(Boolean).join("\n");
      };
    }();
  }, function (t, e, n) {
    var r = n(82);"string" == typeof r && (r = [[t.id, r, ""]]);n(86)(r, {});r.locals && (t.exports = r.locals);
  }]);
});

},{"babel-runtime/core-js/json/stringify":1,"babel-runtime/core-js/object/create":2,"babel-runtime/core-js/object/define-properties":3,"babel-runtime/core-js/object/define-property":4,"babel-runtime/core-js/object/get-own-property-descriptor":5,"babel-runtime/core-js/object/get-own-property-names":6,"babel-runtime/core-js/object/get-own-property-symbols":7,"babel-runtime/core-js/object/get-prototype-of":8,"babel-runtime/core-js/object/is-extensible":9,"babel-runtime/core-js/object/keys":10,"babel-runtime/core-js/object/prevent-extensions":11,"babel-runtime/helpers/typeof":14}],106:[function(require,module,exports){
(function (process){
/*!
 * Vue.js v1.0.28
 * (c) 2016 Evan You
 * Released under the MIT License.
 */
'use strict';

function set(obj, key, val) {
  if (hasOwn(obj, key)) {
    obj[key] = val;
    return;
  }
  if (obj._isVue) {
    set(obj._data, key, val);
    return;
  }
  var ob = obj.__ob__;
  if (!ob) {
    obj[key] = val;
    return;
  }
  ob.convert(key, val);
  ob.dep.notify();
  if (ob.vms) {
    var i = ob.vms.length;
    while (i--) {
      var vm = ob.vms[i];
      vm._proxy(key);
      vm._digest();
    }
  }
  return val;
}

/**
 * Delete a property and trigger change if necessary.
 *
 * @param {Object} obj
 * @param {String} key
 */

function del(obj, key) {
  if (!hasOwn(obj, key)) {
    return;
  }
  delete obj[key];
  var ob = obj.__ob__;
  if (!ob) {
    if (obj._isVue) {
      delete obj._data[key];
      obj._digest();
    }
    return;
  }
  ob.dep.notify();
  if (ob.vms) {
    var i = ob.vms.length;
    while (i--) {
      var vm = ob.vms[i];
      vm._unproxy(key);
      vm._digest();
    }
  }
}

var hasOwnProperty = Object.prototype.hasOwnProperty;
/**
 * Check whether the object has the property.
 *
 * @param {Object} obj
 * @param {String} key
 * @return {Boolean}
 */

function hasOwn(obj, key) {
  return hasOwnProperty.call(obj, key);
}

/**
 * Check if an expression is a literal value.
 *
 * @param {String} exp
 * @return {Boolean}
 */

var literalValueRE = /^\s?(true|false|-?[\d\.]+|'[^']*'|"[^"]*")\s?$/;

function isLiteral(exp) {
  return literalValueRE.test(exp);
}

/**
 * Check if a string starts with $ or _
 *
 * @param {String} str
 * @return {Boolean}
 */

function isReserved(str) {
  var c = (str + '').charCodeAt(0);
  return c === 0x24 || c === 0x5F;
}

/**
 * Guard text output, make sure undefined outputs
 * empty string
 *
 * @param {*} value
 * @return {String}
 */

function _toString(value) {
  return value == null ? '' : value.toString();
}

/**
 * Check and convert possible numeric strings to numbers
 * before setting back to data
 *
 * @param {*} value
 * @return {*|Number}
 */

function toNumber(value) {
  if (typeof value !== 'string') {
    return value;
  } else {
    var parsed = Number(value);
    return isNaN(parsed) ? value : parsed;
  }
}

/**
 * Convert string boolean literals into real booleans.
 *
 * @param {*} value
 * @return {*|Boolean}
 */

function toBoolean(value) {
  return value === 'true' ? true : value === 'false' ? false : value;
}

/**
 * Strip quotes from a string
 *
 * @param {String} str
 * @return {String | false}
 */

function stripQuotes(str) {
  var a = str.charCodeAt(0);
  var b = str.charCodeAt(str.length - 1);
  return a === b && (a === 0x22 || a === 0x27) ? str.slice(1, -1) : str;
}

/**
 * Camelize a hyphen-delimited string.
 *
 * @param {String} str
 * @return {String}
 */

var camelizeRE = /-(\w)/g;

function camelize(str) {
  return str.replace(camelizeRE, toUpper);
}

function toUpper(_, c) {
  return c ? c.toUpperCase() : '';
}

/**
 * Hyphenate a camelCase string.
 *
 * @param {String} str
 * @return {String}
 */

var hyphenateRE = /([^-])([A-Z])/g;

function hyphenate(str) {
  return str.replace(hyphenateRE, '$1-$2').replace(hyphenateRE, '$1-$2').toLowerCase();
}

/**
 * Converts hyphen/underscore/slash delimitered names into
 * camelized classNames.
 *
 * e.g. my-component => MyComponent
 *      some_else    => SomeElse
 *      some/comp    => SomeComp
 *
 * @param {String} str
 * @return {String}
 */

var classifyRE = /(?:^|[-_\/])(\w)/g;

function classify(str) {
  return str.replace(classifyRE, toUpper);
}

/**
 * Simple bind, faster than native
 *
 * @param {Function} fn
 * @param {Object} ctx
 * @return {Function}
 */

function bind(fn, ctx) {
  return function (a) {
    var l = arguments.length;
    return l ? l > 1 ? fn.apply(ctx, arguments) : fn.call(ctx, a) : fn.call(ctx);
  };
}

/**
 * Convert an Array-like object to a real Array.
 *
 * @param {Array-like} list
 * @param {Number} [start] - start index
 * @return {Array}
 */

function toArray(list, start) {
  start = start || 0;
  var i = list.length - start;
  var ret = new Array(i);
  while (i--) {
    ret[i] = list[i + start];
  }
  return ret;
}

/**
 * Mix properties into target object.
 *
 * @param {Object} to
 * @param {Object} from
 */

function extend(to, from) {
  var keys = Object.keys(from);
  var i = keys.length;
  while (i--) {
    to[keys[i]] = from[keys[i]];
  }
  return to;
}

/**
 * Quick object check - this is primarily used to tell
 * Objects from primitive values when we know the value
 * is a JSON-compliant type.
 *
 * @param {*} obj
 * @return {Boolean}
 */

function isObject(obj) {
  return obj !== null && typeof obj === 'object';
}

/**
 * Strict object type check. Only returns true
 * for plain JavaScript objects.
 *
 * @param {*} obj
 * @return {Boolean}
 */

var toString = Object.prototype.toString;
var OBJECT_STRING = '[object Object]';

function isPlainObject(obj) {
  return toString.call(obj) === OBJECT_STRING;
}

/**
 * Array type check.
 *
 * @param {*} obj
 * @return {Boolean}
 */

var isArray = Array.isArray;

/**
 * Define a property.
 *
 * @param {Object} obj
 * @param {String} key
 * @param {*} val
 * @param {Boolean} [enumerable]
 */

function def(obj, key, val, enumerable) {
  Object.defineProperty(obj, key, {
    value: val,
    enumerable: !!enumerable,
    writable: true,
    configurable: true
  });
}

/**
 * Debounce a function so it only gets called after the
 * input stops arriving after the given wait period.
 *
 * @param {Function} func
 * @param {Number} wait
 * @return {Function} - the debounced function
 */

function _debounce(func, wait) {
  var timeout, args, context, timestamp, result;
  var later = function later() {
    var last = Date.now() - timestamp;
    if (last < wait && last >= 0) {
      timeout = setTimeout(later, wait - last);
    } else {
      timeout = null;
      result = func.apply(context, args);
      if (!timeout) context = args = null;
    }
  };
  return function () {
    context = this;
    args = arguments;
    timestamp = Date.now();
    if (!timeout) {
      timeout = setTimeout(later, wait);
    }
    return result;
  };
}

/**
 * Manual indexOf because it's slightly faster than
 * native.
 *
 * @param {Array} arr
 * @param {*} obj
 */

function indexOf(arr, obj) {
  var i = arr.length;
  while (i--) {
    if (arr[i] === obj) return i;
  }
  return -1;
}

/**
 * Make a cancellable version of an async callback.
 *
 * @param {Function} fn
 * @return {Function}
 */

function cancellable(fn) {
  var cb = function cb() {
    if (!cb.cancelled) {
      return fn.apply(this, arguments);
    }
  };
  cb.cancel = function () {
    cb.cancelled = true;
  };
  return cb;
}

/**
 * Check if two values are loosely equal - that is,
 * if they are plain objects, do they have the same shape?
 *
 * @param {*} a
 * @param {*} b
 * @return {Boolean}
 */

function looseEqual(a, b) {
  /* eslint-disable eqeqeq */
  return a == b || (isObject(a) && isObject(b) ? JSON.stringify(a) === JSON.stringify(b) : false);
  /* eslint-enable eqeqeq */
}

var hasProto = ('__proto__' in {});

// Browser environment sniffing
var inBrowser = typeof window !== 'undefined' && Object.prototype.toString.call(window) !== '[object Object]';

// detect devtools
var devtools = inBrowser && window.__VUE_DEVTOOLS_GLOBAL_HOOK__;

// UA sniffing for working around browser-specific quirks
var UA = inBrowser && window.navigator.userAgent.toLowerCase();
var isIE = UA && UA.indexOf('trident') > 0;
var isIE9 = UA && UA.indexOf('msie 9.0') > 0;
var isAndroid = UA && UA.indexOf('android') > 0;
var isIOS = UA && /iphone|ipad|ipod|ios/.test(UA);

var transitionProp = undefined;
var transitionEndEvent = undefined;
var animationProp = undefined;
var animationEndEvent = undefined;

// Transition property/event sniffing
if (inBrowser && !isIE9) {
  var isWebkitTrans = window.ontransitionend === undefined && window.onwebkittransitionend !== undefined;
  var isWebkitAnim = window.onanimationend === undefined && window.onwebkitanimationend !== undefined;
  transitionProp = isWebkitTrans ? 'WebkitTransition' : 'transition';
  transitionEndEvent = isWebkitTrans ? 'webkitTransitionEnd' : 'transitionend';
  animationProp = isWebkitAnim ? 'WebkitAnimation' : 'animation';
  animationEndEvent = isWebkitAnim ? 'webkitAnimationEnd' : 'animationend';
}

/* istanbul ignore next */
function isNative(Ctor) {
  return (/native code/.test(Ctor.toString())
  );
}

/**
 * Defer a task to execute it asynchronously. Ideally this
 * should be executed as a microtask, so we leverage
 * MutationObserver if it's available, and fallback to
 * setTimeout(0).
 *
 * @param {Function} cb
 * @param {Object} ctx
 */

var nextTick = (function () {
  var callbacks = [];
  var pending = false;
  var timerFunc = undefined;

  function nextTickHandler() {
    pending = false;
    var copies = callbacks.slice(0);
    callbacks.length = 0;
    for (var i = 0; i < copies.length; i++) {
      copies[i]();
    }
  }

  // the nextTick behavior leverages the microtask queue, which can be accessed
  // via either native Promise.then or MutationObserver.
  // MutationObserver has wider support, however it is seriously bugged in
  // UIWebView in iOS >= 9.3.3 when triggered in touch event handlers. It
  // completely stops working after triggering a few times... so, if native
  // Promise is available, we will use it:
  /* istanbul ignore if */
  if (typeof Promise !== 'undefined' && isNative(Promise)) {
    var p = Promise.resolve();
    var noop = function noop() {};
    timerFunc = function () {
      p.then(nextTickHandler);
      // in problematic UIWebViews, Promise.then doesn't completely break, but
      // it can get stuck in a weird state where callbacks are pushed into the
      // microtask queue but the queue isn't being flushed, until the browser
      // needs to do some other work, e.g. handle a timer. Therefore we can
      // "force" the microtask queue to be flushed by adding an empty timer.
      if (isIOS) setTimeout(noop);
    };
  } else if (typeof MutationObserver !== 'undefined') {
    // use MutationObserver where native Promise is not available,
    // e.g. IE11, iOS7, Android 4.4
    var counter = 1;
    var observer = new MutationObserver(nextTickHandler);
    var textNode = document.createTextNode(String(counter));
    observer.observe(textNode, {
      characterData: true
    });
    timerFunc = function () {
      counter = (counter + 1) % 2;
      textNode.data = String(counter);
    };
  } else {
    // fallback to setTimeout
    /* istanbul ignore next */
    timerFunc = setTimeout;
  }

  return function (cb, ctx) {
    var func = ctx ? function () {
      cb.call(ctx);
    } : cb;
    callbacks.push(func);
    if (pending) return;
    pending = true;
    timerFunc(nextTickHandler, 0);
  };
})();

var _Set = undefined;
/* istanbul ignore if */
if (typeof Set !== 'undefined' && isNative(Set)) {
  // use native Set when available.
  _Set = Set;
} else {
  // a non-standard Set polyfill that only works with primitive keys.
  _Set = function () {
    this.set = Object.create(null);
  };
  _Set.prototype.has = function (key) {
    return this.set[key] !== undefined;
  };
  _Set.prototype.add = function (key) {
    this.set[key] = 1;
  };
  _Set.prototype.clear = function () {
    this.set = Object.create(null);
  };
}

function Cache(limit) {
  this.size = 0;
  this.limit = limit;
  this.head = this.tail = undefined;
  this._keymap = Object.create(null);
}

var p = Cache.prototype;

/**
 * Put <value> into the cache associated with <key>.
 * Returns the entry which was removed to make room for
 * the new entry. Otherwise undefined is returned.
 * (i.e. if there was enough room already).
 *
 * @param {String} key
 * @param {*} value
 * @return {Entry|undefined}
 */

p.put = function (key, value) {
  var removed;

  var entry = this.get(key, true);
  if (!entry) {
    if (this.size === this.limit) {
      removed = this.shift();
    }
    entry = {
      key: key
    };
    this._keymap[key] = entry;
    if (this.tail) {
      this.tail.newer = entry;
      entry.older = this.tail;
    } else {
      this.head = entry;
    }
    this.tail = entry;
    this.size++;
  }
  entry.value = value;

  return removed;
};

/**
 * Purge the least recently used (oldest) entry from the
 * cache. Returns the removed entry or undefined if the
 * cache was empty.
 */

p.shift = function () {
  var entry = this.head;
  if (entry) {
    this.head = this.head.newer;
    this.head.older = undefined;
    entry.newer = entry.older = undefined;
    this._keymap[entry.key] = undefined;
    this.size--;
  }
  return entry;
};

/**
 * Get and register recent use of <key>. Returns the value
 * associated with <key> or undefined if not in cache.
 *
 * @param {String} key
 * @param {Boolean} returnEntry
 * @return {Entry|*}
 */

p.get = function (key, returnEntry) {
  var entry = this._keymap[key];
  if (entry === undefined) return;
  if (entry === this.tail) {
    return returnEntry ? entry : entry.value;
  }
  // HEAD--------------TAIL
  //   <.older   .newer>
  //  <--- add direction --
  //   A  B  C  <D>  E
  if (entry.newer) {
    if (entry === this.head) {
      this.head = entry.newer;
    }
    entry.newer.older = entry.older; // C <-- E.
  }
  if (entry.older) {
    entry.older.newer = entry.newer; // C. --> E
  }
  entry.newer = undefined; // D --x
  entry.older = this.tail; // D. --> E
  if (this.tail) {
    this.tail.newer = entry; // E. <-- D
  }
  this.tail = entry;
  return returnEntry ? entry : entry.value;
};

var cache$1 = new Cache(1000);
var reservedArgRE = /^in$|^-?\d+/;

/**
 * Parser state
 */

var str;
var dir;
var len;
var index;
var chr;
var state;
var startState = 0;
var filterState = 1;
var filterNameState = 2;
var filterArgState = 3;

var doubleChr = 0x22;
var singleChr = 0x27;
var pipeChr = 0x7C;
var escapeChr = 0x5C;
var spaceChr = 0x20;

var expStartChr = { 0x5B: 1, 0x7B: 1, 0x28: 1 };
var expChrPair = { 0x5B: 0x5D, 0x7B: 0x7D, 0x28: 0x29 };

function peek() {
  return str.charCodeAt(index + 1);
}

function next() {
  return str.charCodeAt(++index);
}

function eof() {
  return index >= len;
}

function eatSpace() {
  while (peek() === spaceChr) {
    next();
  }
}

function isStringStart(chr) {
  return chr === doubleChr || chr === singleChr;
}

function isExpStart(chr) {
  return expStartChr[chr];
}

function isExpEnd(start, chr) {
  return expChrPair[start] === chr;
}

function parseString() {
  var stringQuote = next();
  var chr;
  while (!eof()) {
    chr = next();
    // escape char
    if (chr === escapeChr) {
      next();
    } else if (chr === stringQuote) {
      break;
    }
  }
}

function parseSpecialExp(chr) {
  var inExp = 0;
  var startChr = chr;

  while (!eof()) {
    chr = peek();
    if (isStringStart(chr)) {
      parseString();
      continue;
    }

    if (startChr === chr) {
      inExp++;
    }
    if (isExpEnd(startChr, chr)) {
      inExp--;
    }

    next();

    if (inExp === 0) {
      break;
    }
  }
}

/**
 * syntax:
 * expression | filterName  [arg  arg [| filterName arg arg]]
 */

function parseExpression() {
  var start = index;
  while (!eof()) {
    chr = peek();
    if (isStringStart(chr)) {
      parseString();
    } else if (isExpStart(chr)) {
      parseSpecialExp(chr);
    } else if (chr === pipeChr) {
      next();
      chr = peek();
      if (chr === pipeChr) {
        next();
      } else {
        if (state === startState || state === filterArgState) {
          state = filterState;
        }
        break;
      }
    } else if (chr === spaceChr && (state === filterNameState || state === filterArgState)) {
      eatSpace();
      break;
    } else {
      if (state === filterState) {
        state = filterNameState;
      }
      next();
    }
  }

  return str.slice(start + 1, index) || null;
}

function parseFilterList() {
  var filters = [];
  while (!eof()) {
    filters.push(parseFilter());
  }
  return filters;
}

function parseFilter() {
  var filter = {};
  var args;

  state = filterState;
  filter.name = parseExpression().trim();

  state = filterArgState;
  args = parseFilterArguments();

  if (args.length) {
    filter.args = args;
  }
  return filter;
}

function parseFilterArguments() {
  var args = [];
  while (!eof() && state !== filterState) {
    var arg = parseExpression();
    if (!arg) {
      break;
    }
    args.push(processFilterArg(arg));
  }

  return args;
}

/**
 * Check if an argument is dynamic and strip quotes.
 *
 * @param {String} arg
 * @return {Object}
 */

function processFilterArg(arg) {
  if (reservedArgRE.test(arg)) {
    return {
      value: toNumber(arg),
      dynamic: false
    };
  } else {
    var stripped = stripQuotes(arg);
    var dynamic = stripped === arg;
    return {
      value: dynamic ? arg : stripped,
      dynamic: dynamic
    };
  }
}

/**
 * Parse a directive value and extract the expression
 * and its filters into a descriptor.
 *
 * Example:
 *
 * "a + 1 | uppercase" will yield:
 * {
 *   expression: 'a + 1',
 *   filters: [
 *     { name: 'uppercase', args: null }
 *   ]
 * }
 *
 * @param {String} s
 * @return {Object}
 */

function parseDirective(s) {
  var hit = cache$1.get(s);
  if (hit) {
    return hit;
  }

  // reset parser state
  str = s;
  dir = {};
  len = str.length;
  index = -1;
  chr = '';
  state = startState;

  var filters;

  if (str.indexOf('|') < 0) {
    dir.expression = str.trim();
  } else {
    dir.expression = parseExpression().trim();
    filters = parseFilterList();
    if (filters.length) {
      dir.filters = filters;
    }
  }

  cache$1.put(s, dir);
  return dir;
}

var directive = Object.freeze({
  parseDirective: parseDirective
});

var regexEscapeRE = /[-.*+?^${}()|[\]\/\\]/g;
var cache = undefined;
var tagRE = undefined;
var htmlRE = undefined;
/**
 * Escape a string so it can be used in a RegExp
 * constructor.
 *
 * @param {String} str
 */

function escapeRegex(str) {
  return str.replace(regexEscapeRE, '\\$&');
}

function compileRegex() {
  var open = escapeRegex(config.delimiters[0]);
  var close = escapeRegex(config.delimiters[1]);
  var unsafeOpen = escapeRegex(config.unsafeDelimiters[0]);
  var unsafeClose = escapeRegex(config.unsafeDelimiters[1]);
  tagRE = new RegExp(unsafeOpen + '((?:.|\\n)+?)' + unsafeClose + '|' + open + '((?:.|\\n)+?)' + close, 'g');
  htmlRE = new RegExp('^' + unsafeOpen + '((?:.|\\n)+?)' + unsafeClose + '$');
  // reset cache
  cache = new Cache(1000);
}

/**
 * Parse a template text string into an array of tokens.
 *
 * @param {String} text
 * @return {Array<Object> | null}
 *               - {String} type
 *               - {String} value
 *               - {Boolean} [html]
 *               - {Boolean} [oneTime]
 */

function parseText(text) {
  if (!cache) {
    compileRegex();
  }
  var hit = cache.get(text);
  if (hit) {
    return hit;
  }
  if (!tagRE.test(text)) {
    return null;
  }
  var tokens = [];
  var lastIndex = tagRE.lastIndex = 0;
  var match, index, html, value, first, oneTime;
  /* eslint-disable no-cond-assign */
  while (match = tagRE.exec(text)) {
    /* eslint-enable no-cond-assign */
    index = match.index;
    // push text token
    if (index > lastIndex) {
      tokens.push({
        value: text.slice(lastIndex, index)
      });
    }
    // tag token
    html = htmlRE.test(match[0]);
    value = html ? match[1] : match[2];
    first = value.charCodeAt(0);
    oneTime = first === 42; // *
    value = oneTime ? value.slice(1) : value;
    tokens.push({
      tag: true,
      value: value.trim(),
      html: html,
      oneTime: oneTime
    });
    lastIndex = index + match[0].length;
  }
  if (lastIndex < text.length) {
    tokens.push({
      value: text.slice(lastIndex)
    });
  }
  cache.put(text, tokens);
  return tokens;
}

/**
 * Format a list of tokens into an expression.
 * e.g. tokens parsed from 'a {{b}} c' can be serialized
 * into one single expression as '"a " + b + " c"'.
 *
 * @param {Array} tokens
 * @param {Vue} [vm]
 * @return {String}
 */

function tokensToExp(tokens, vm) {
  if (tokens.length > 1) {
    return tokens.map(function (token) {
      return formatToken(token, vm);
    }).join('+');
  } else {
    return formatToken(tokens[0], vm, true);
  }
}

/**
 * Format a single token.
 *
 * @param {Object} token
 * @param {Vue} [vm]
 * @param {Boolean} [single]
 * @return {String}
 */

function formatToken(token, vm, single) {
  return token.tag ? token.oneTime && vm ? '"' + vm.$eval(token.value) + '"' : inlineFilters(token.value, single) : '"' + token.value + '"';
}

/**
 * For an attribute with multiple interpolation tags,
 * e.g. attr="some-{{thing | filter}}", in order to combine
 * the whole thing into a single watchable expression, we
 * have to inline those filters. This function does exactly
 * that. This is a bit hacky but it avoids heavy changes
 * to directive parser and watcher mechanism.
 *
 * @param {String} exp
 * @param {Boolean} single
 * @return {String}
 */

var filterRE = /[^|]\|[^|]/;
function inlineFilters(exp, single) {
  if (!filterRE.test(exp)) {
    return single ? exp : '(' + exp + ')';
  } else {
    var dir = parseDirective(exp);
    if (!dir.filters) {
      return '(' + exp + ')';
    } else {
      return 'this._applyFilters(' + dir.expression + // value
      ',null,' + // oldValue (null for read)
      JSON.stringify(dir.filters) + // filter descriptors
      ',false)'; // write?
    }
  }
}

var text = Object.freeze({
  compileRegex: compileRegex,
  parseText: parseText,
  tokensToExp: tokensToExp
});

var delimiters = ['{{', '}}'];
var unsafeDelimiters = ['{{{', '}}}'];

var config = Object.defineProperties({

  /**
   * Whether to print debug messages.
   * Also enables stack trace for warnings.
   *
   * @type {Boolean}
   */

  debug: false,

  /**
   * Whether to suppress warnings.
   *
   * @type {Boolean}
   */

  silent: false,

  /**
   * Whether to use async rendering.
   */

  async: true,

  /**
   * Whether to warn against errors caught when evaluating
   * expressions.
   */

  warnExpressionErrors: true,

  /**
   * Whether to allow devtools inspection.
   * Disabled by default in production builds.
   */

  devtools: process.env.NODE_ENV !== 'production',

  /**
   * Internal flag to indicate the delimiters have been
   * changed.
   *
   * @type {Boolean}
   */

  _delimitersChanged: true,

  /**
   * List of asset types that a component can own.
   *
   * @type {Array}
   */

  _assetTypes: ['component', 'directive', 'elementDirective', 'filter', 'transition', 'partial'],

  /**
   * prop binding modes
   */

  _propBindingModes: {
    ONE_WAY: 0,
    TWO_WAY: 1,
    ONE_TIME: 2
  },

  /**
   * Max circular updates allowed in a batcher flush cycle.
   */

  _maxUpdateCount: 100

}, {
  delimiters: { /**
                 * Interpolation delimiters. Changing these would trigger
                 * the text parser to re-compile the regular expressions.
                 *
                 * @type {Array<String>}
                 */

    get: function get() {
      return delimiters;
    },
    set: function set(val) {
      delimiters = val;
      compileRegex();
    },
    configurable: true,
    enumerable: true
  },
  unsafeDelimiters: {
    get: function get() {
      return unsafeDelimiters;
    },
    set: function set(val) {
      unsafeDelimiters = val;
      compileRegex();
    },
    configurable: true,
    enumerable: true
  }
});

var warn = undefined;
var formatComponentName = undefined;

if (process.env.NODE_ENV !== 'production') {
  (function () {
    var hasConsole = typeof console !== 'undefined';

    warn = function (msg, vm) {
      if (hasConsole && !config.silent) {
        console.error('[Vue warn]: ' + msg + (vm ? formatComponentName(vm) : ''));
      }
    };

    formatComponentName = function (vm) {
      var name = vm._isVue ? vm.$options.name : vm.name;
      return name ? ' (found in component: <' + hyphenate(name) + '>)' : '';
    };
  })();
}

/**
 * Append with transition.
 *
 * @param {Element} el
 * @param {Element} target
 * @param {Vue} vm
 * @param {Function} [cb]
 */

function appendWithTransition(el, target, vm, cb) {
  applyTransition(el, 1, function () {
    target.appendChild(el);
  }, vm, cb);
}

/**
 * InsertBefore with transition.
 *
 * @param {Element} el
 * @param {Element} target
 * @param {Vue} vm
 * @param {Function} [cb]
 */

function beforeWithTransition(el, target, vm, cb) {
  applyTransition(el, 1, function () {
    before(el, target);
  }, vm, cb);
}

/**
 * Remove with transition.
 *
 * @param {Element} el
 * @param {Vue} vm
 * @param {Function} [cb]
 */

function removeWithTransition(el, vm, cb) {
  applyTransition(el, -1, function () {
    remove(el);
  }, vm, cb);
}

/**
 * Apply transitions with an operation callback.
 *
 * @param {Element} el
 * @param {Number} direction
 *                  1: enter
 *                 -1: leave
 * @param {Function} op - the actual DOM operation
 * @param {Vue} vm
 * @param {Function} [cb]
 */

function applyTransition(el, direction, op, vm, cb) {
  var transition = el.__v_trans;
  if (!transition ||
  // skip if there are no js hooks and CSS transition is
  // not supported
  !transition.hooks && !transitionEndEvent ||
  // skip transitions for initial compile
  !vm._isCompiled ||
  // if the vm is being manipulated by a parent directive
  // during the parent's compilation phase, skip the
  // animation.
  vm.$parent && !vm.$parent._isCompiled) {
    op();
    if (cb) cb();
    return;
  }
  var action = direction > 0 ? 'enter' : 'leave';
  transition[action](op, cb);
}

var transition = Object.freeze({
  appendWithTransition: appendWithTransition,
  beforeWithTransition: beforeWithTransition,
  removeWithTransition: removeWithTransition,
  applyTransition: applyTransition
});

/**
 * Query an element selector if it's not an element already.
 *
 * @param {String|Element} el
 * @return {Element}
 */

function query(el) {
  if (typeof el === 'string') {
    var selector = el;
    el = document.querySelector(el);
    if (!el) {
      process.env.NODE_ENV !== 'production' && warn('Cannot find element: ' + selector);
    }
  }
  return el;
}

/**
 * Check if a node is in the document.
 * Note: document.documentElement.contains should work here
 * but always returns false for comment nodes in phantomjs,
 * making unit tests difficult. This is fixed by doing the
 * contains() check on the node's parentNode instead of
 * the node itself.
 *
 * @param {Node} node
 * @return {Boolean}
 */

function inDoc(node) {
  if (!node) return false;
  var doc = node.ownerDocument.documentElement;
  var parent = node.parentNode;
  return doc === node || doc === parent || !!(parent && parent.nodeType === 1 && doc.contains(parent));
}

/**
 * Get and remove an attribute from a node.
 *
 * @param {Node} node
 * @param {String} _attr
 */

function getAttr(node, _attr) {
  var val = node.getAttribute(_attr);
  if (val !== null) {
    node.removeAttribute(_attr);
  }
  return val;
}

/**
 * Get an attribute with colon or v-bind: prefix.
 *
 * @param {Node} node
 * @param {String} name
 * @return {String|null}
 */

function getBindAttr(node, name) {
  var val = getAttr(node, ':' + name);
  if (val === null) {
    val = getAttr(node, 'v-bind:' + name);
  }
  return val;
}

/**
 * Check the presence of a bind attribute.
 *
 * @param {Node} node
 * @param {String} name
 * @return {Boolean}
 */

function hasBindAttr(node, name) {
  return node.hasAttribute(name) || node.hasAttribute(':' + name) || node.hasAttribute('v-bind:' + name);
}

/**
 * Insert el before target
 *
 * @param {Element} el
 * @param {Element} target
 */

function before(el, target) {
  target.parentNode.insertBefore(el, target);
}

/**
 * Insert el after target
 *
 * @param {Element} el
 * @param {Element} target
 */

function after(el, target) {
  if (target.nextSibling) {
    before(el, target.nextSibling);
  } else {
    target.parentNode.appendChild(el);
  }
}

/**
 * Remove el from DOM
 *
 * @param {Element} el
 */

function remove(el) {
  el.parentNode.removeChild(el);
}

/**
 * Prepend el to target
 *
 * @param {Element} el
 * @param {Element} target
 */

function prepend(el, target) {
  if (target.firstChild) {
    before(el, target.firstChild);
  } else {
    target.appendChild(el);
  }
}

/**
 * Replace target with el
 *
 * @param {Element} target
 * @param {Element} el
 */

function replace(target, el) {
  var parent = target.parentNode;
  if (parent) {
    parent.replaceChild(el, target);
  }
}

/**
 * Add event listener shorthand.
 *
 * @param {Element} el
 * @param {String} event
 * @param {Function} cb
 * @param {Boolean} [useCapture]
 */

function on(el, event, cb, useCapture) {
  el.addEventListener(event, cb, useCapture);
}

/**
 * Remove event listener shorthand.
 *
 * @param {Element} el
 * @param {String} event
 * @param {Function} cb
 */

function off(el, event, cb) {
  el.removeEventListener(event, cb);
}

/**
 * For IE9 compat: when both class and :class are present
 * getAttribute('class') returns wrong value...
 *
 * @param {Element} el
 * @return {String}
 */

function getClass(el) {
  var classname = el.className;
  if (typeof classname === 'object') {
    classname = classname.baseVal || '';
  }
  return classname;
}

/**
 * In IE9, setAttribute('class') will result in empty class
 * if the element also has the :class attribute; However in
 * PhantomJS, setting `className` does not work on SVG elements...
 * So we have to do a conditional check here.
 *
 * @param {Element} el
 * @param {String} cls
 */

function setClass(el, cls) {
  /* istanbul ignore if */
  if (isIE9 && !/svg$/.test(el.namespaceURI)) {
    el.className = cls;
  } else {
    el.setAttribute('class', cls);
  }
}

/**
 * Add class with compatibility for IE & SVG
 *
 * @param {Element} el
 * @param {String} cls
 */

function addClass(el, cls) {
  if (el.classList) {
    el.classList.add(cls);
  } else {
    var cur = ' ' + getClass(el) + ' ';
    if (cur.indexOf(' ' + cls + ' ') < 0) {
      setClass(el, (cur + cls).trim());
    }
  }
}

/**
 * Remove class with compatibility for IE & SVG
 *
 * @param {Element} el
 * @param {String} cls
 */

function removeClass(el, cls) {
  if (el.classList) {
    el.classList.remove(cls);
  } else {
    var cur = ' ' + getClass(el) + ' ';
    var tar = ' ' + cls + ' ';
    while (cur.indexOf(tar) >= 0) {
      cur = cur.replace(tar, ' ');
    }
    setClass(el, cur.trim());
  }
  if (!el.className) {
    el.removeAttribute('class');
  }
}

/**
 * Extract raw content inside an element into a temporary
 * container div
 *
 * @param {Element} el
 * @param {Boolean} asFragment
 * @return {Element|DocumentFragment}
 */

function extractContent(el, asFragment) {
  var child;
  var rawContent;
  /* istanbul ignore if */
  if (isTemplate(el) && isFragment(el.content)) {
    el = el.content;
  }
  if (el.hasChildNodes()) {
    trimNode(el);
    rawContent = asFragment ? document.createDocumentFragment() : document.createElement('div');
    /* eslint-disable no-cond-assign */
    while (child = el.firstChild) {
      /* eslint-enable no-cond-assign */
      rawContent.appendChild(child);
    }
  }
  return rawContent;
}

/**
 * Trim possible empty head/tail text and comment
 * nodes inside a parent.
 *
 * @param {Node} node
 */

function trimNode(node) {
  var child;
  /* eslint-disable no-sequences */
  while ((child = node.firstChild, isTrimmable(child))) {
    node.removeChild(child);
  }
  while ((child = node.lastChild, isTrimmable(child))) {
    node.removeChild(child);
  }
  /* eslint-enable no-sequences */
}

function isTrimmable(node) {
  return node && (node.nodeType === 3 && !node.data.trim() || node.nodeType === 8);
}

/**
 * Check if an element is a template tag.
 * Note if the template appears inside an SVG its tagName
 * will be in lowercase.
 *
 * @param {Element} el
 */

function isTemplate(el) {
  return el.tagName && el.tagName.toLowerCase() === 'template';
}

/**
 * Create an "anchor" for performing dom insertion/removals.
 * This is used in a number of scenarios:
 * - fragment instance
 * - v-html
 * - v-if
 * - v-for
 * - component
 *
 * @param {String} content
 * @param {Boolean} persist - IE trashes empty textNodes on
 *                            cloneNode(true), so in certain
 *                            cases the anchor needs to be
 *                            non-empty to be persisted in
 *                            templates.
 * @return {Comment|Text}
 */

function createAnchor(content, persist) {
  var anchor = config.debug ? document.createComment(content) : document.createTextNode(persist ? ' ' : '');
  anchor.__v_anchor = true;
  return anchor;
}

/**
 * Find a component ref attribute that starts with $.
 *
 * @param {Element} node
 * @return {String|undefined}
 */

var refRE = /^v-ref:/;

function findRef(node) {
  if (node.hasAttributes()) {
    var attrs = node.attributes;
    for (var i = 0, l = attrs.length; i < l; i++) {
      var name = attrs[i].name;
      if (refRE.test(name)) {
        return camelize(name.replace(refRE, ''));
      }
    }
  }
}

/**
 * Map a function to a range of nodes .
 *
 * @param {Node} node
 * @param {Node} end
 * @param {Function} op
 */

function mapNodeRange(node, end, op) {
  var next;
  while (node !== end) {
    next = node.nextSibling;
    op(node);
    node = next;
  }
  op(end);
}

/**
 * Remove a range of nodes with transition, store
 * the nodes in a fragment with correct ordering,
 * and call callback when done.
 *
 * @param {Node} start
 * @param {Node} end
 * @param {Vue} vm
 * @param {DocumentFragment} frag
 * @param {Function} cb
 */

function removeNodeRange(start, end, vm, frag, cb) {
  var done = false;
  var removed = 0;
  var nodes = [];
  mapNodeRange(start, end, function (node) {
    if (node === end) done = true;
    nodes.push(node);
    removeWithTransition(node, vm, onRemoved);
  });
  function onRemoved() {
    removed++;
    if (done && removed >= nodes.length) {
      for (var i = 0; i < nodes.length; i++) {
        frag.appendChild(nodes[i]);
      }
      cb && cb();
    }
  }
}

/**
 * Check if a node is a DocumentFragment.
 *
 * @param {Node} node
 * @return {Boolean}
 */

function isFragment(node) {
  return node && node.nodeType === 11;
}

/**
 * Get outerHTML of elements, taking care
 * of SVG elements in IE as well.
 *
 * @param {Element} el
 * @return {String}
 */

function getOuterHTML(el) {
  if (el.outerHTML) {
    return el.outerHTML;
  } else {
    var container = document.createElement('div');
    container.appendChild(el.cloneNode(true));
    return container.innerHTML;
  }
}

var commonTagRE = /^(div|p|span|img|a|b|i|br|ul|ol|li|h1|h2|h3|h4|h5|h6|code|pre|table|th|td|tr|form|label|input|select|option|nav|article|section|header|footer)$/i;
var reservedTagRE = /^(slot|partial|component)$/i;

var isUnknownElement = undefined;
if (process.env.NODE_ENV !== 'production') {
  isUnknownElement = function (el, tag) {
    if (tag.indexOf('-') > -1) {
      // http://stackoverflow.com/a/28210364/1070244
      return el.constructor === window.HTMLUnknownElement || el.constructor === window.HTMLElement;
    } else {
      return (/HTMLUnknownElement/.test(el.toString()) &&
        // Chrome returns unknown for several HTML5 elements.
        // https://code.google.com/p/chromium/issues/detail?id=540526
        // Firefox returns unknown for some "Interactive elements."
        !/^(data|time|rtc|rb|details|dialog|summary)$/.test(tag)
      );
    }
  };
}

/**
 * Check if an element is a component, if yes return its
 * component id.
 *
 * @param {Element} el
 * @param {Object} options
 * @return {Object|undefined}
 */

function checkComponentAttr(el, options) {
  var tag = el.tagName.toLowerCase();
  var hasAttrs = el.hasAttributes();
  if (!commonTagRE.test(tag) && !reservedTagRE.test(tag)) {
    if (resolveAsset(options, 'components', tag)) {
      return { id: tag };
    } else {
      var is = hasAttrs && getIsBinding(el, options);
      if (is) {
        return is;
      } else if (process.env.NODE_ENV !== 'production') {
        var expectedTag = options._componentNameMap && options._componentNameMap[tag];
        if (expectedTag) {
          warn('Unknown custom element: <' + tag + '> - ' + 'did you mean <' + expectedTag + '>? ' + 'HTML is case-insensitive, remember to use kebab-case in templates.');
        } else if (isUnknownElement(el, tag)) {
          warn('Unknown custom element: <' + tag + '> - did you ' + 'register the component correctly? For recursive components, ' + 'make sure to provide the "name" option.');
        }
      }
    }
  } else if (hasAttrs) {
    return getIsBinding(el, options);
  }
}

/**
 * Get "is" binding from an element.
 *
 * @param {Element} el
 * @param {Object} options
 * @return {Object|undefined}
 */

function getIsBinding(el, options) {
  // dynamic syntax
  var exp = el.getAttribute('is');
  if (exp != null) {
    if (resolveAsset(options, 'components', exp)) {
      el.removeAttribute('is');
      return { id: exp };
    }
  } else {
    exp = getBindAttr(el, 'is');
    if (exp != null) {
      return { id: exp, dynamic: true };
    }
  }
}

/**
 * Option overwriting strategies are functions that handle
 * how to merge a parent option value and a child option
 * value into the final value.
 *
 * All strategy functions follow the same signature:
 *
 * @param {*} parentVal
 * @param {*} childVal
 * @param {Vue} [vm]
 */

var strats = config.optionMergeStrategies = Object.create(null);

/**
 * Helper that recursively merges two data objects together.
 */

function mergeData(to, from) {
  var key, toVal, fromVal;
  for (key in from) {
    toVal = to[key];
    fromVal = from[key];
    if (!hasOwn(to, key)) {
      set(to, key, fromVal);
    } else if (isObject(toVal) && isObject(fromVal)) {
      mergeData(toVal, fromVal);
    }
  }
  return to;
}

/**
 * Data
 */

strats.data = function (parentVal, childVal, vm) {
  if (!vm) {
    // in a Vue.extend merge, both should be functions
    if (!childVal) {
      return parentVal;
    }
    if (typeof childVal !== 'function') {
      process.env.NODE_ENV !== 'production' && warn('The "data" option should be a function ' + 'that returns a per-instance value in component ' + 'definitions.', vm);
      return parentVal;
    }
    if (!parentVal) {
      return childVal;
    }
    // when parentVal & childVal are both present,
    // we need to return a function that returns the
    // merged result of both functions... no need to
    // check if parentVal is a function here because
    // it has to be a function to pass previous merges.
    return function mergedDataFn() {
      return mergeData(childVal.call(this), parentVal.call(this));
    };
  } else if (parentVal || childVal) {
    return function mergedInstanceDataFn() {
      // instance merge
      var instanceData = typeof childVal === 'function' ? childVal.call(vm) : childVal;
      var defaultData = typeof parentVal === 'function' ? parentVal.call(vm) : undefined;
      if (instanceData) {
        return mergeData(instanceData, defaultData);
      } else {
        return defaultData;
      }
    };
  }
};

/**
 * El
 */

strats.el = function (parentVal, childVal, vm) {
  if (!vm && childVal && typeof childVal !== 'function') {
    process.env.NODE_ENV !== 'production' && warn('The "el" option should be a function ' + 'that returns a per-instance value in component ' + 'definitions.', vm);
    return;
  }
  var ret = childVal || parentVal;
  // invoke the element factory if this is instance merge
  return vm && typeof ret === 'function' ? ret.call(vm) : ret;
};

/**
 * Hooks and param attributes are merged as arrays.
 */

strats.init = strats.created = strats.ready = strats.attached = strats.detached = strats.beforeCompile = strats.compiled = strats.beforeDestroy = strats.destroyed = strats.activate = function (parentVal, childVal) {
  return childVal ? parentVal ? parentVal.concat(childVal) : isArray(childVal) ? childVal : [childVal] : parentVal;
};

/**
 * Assets
 *
 * When a vm is present (instance creation), we need to do
 * a three-way merge between constructor options, instance
 * options and parent options.
 */

function mergeAssets(parentVal, childVal) {
  var res = Object.create(parentVal || null);
  return childVal ? extend(res, guardArrayAssets(childVal)) : res;
}

config._assetTypes.forEach(function (type) {
  strats[type + 's'] = mergeAssets;
});

/**
 * Events & Watchers.
 *
 * Events & watchers hashes should not overwrite one
 * another, so we merge them as arrays.
 */

strats.watch = strats.events = function (parentVal, childVal) {
  if (!childVal) return parentVal;
  if (!parentVal) return childVal;
  var ret = {};
  extend(ret, parentVal);
  for (var key in childVal) {
    var parent = ret[key];
    var child = childVal[key];
    if (parent && !isArray(parent)) {
      parent = [parent];
    }
    ret[key] = parent ? parent.concat(child) : [child];
  }
  return ret;
};

/**
 * Other object hashes.
 */

strats.props = strats.methods = strats.computed = function (parentVal, childVal) {
  if (!childVal) return parentVal;
  if (!parentVal) return childVal;
  var ret = Object.create(null);
  extend(ret, parentVal);
  extend(ret, childVal);
  return ret;
};

/**
 * Default strategy.
 */

var defaultStrat = function defaultStrat(parentVal, childVal) {
  return childVal === undefined ? parentVal : childVal;
};

/**
 * Make sure component options get converted to actual
 * constructors.
 *
 * @param {Object} options
 */

function guardComponents(options) {
  if (options.components) {
    var components = options.components = guardArrayAssets(options.components);
    var ids = Object.keys(components);
    var def;
    if (process.env.NODE_ENV !== 'production') {
      var map = options._componentNameMap = {};
    }
    for (var i = 0, l = ids.length; i < l; i++) {
      var key = ids[i];
      if (commonTagRE.test(key) || reservedTagRE.test(key)) {
        process.env.NODE_ENV !== 'production' && warn('Do not use built-in or reserved HTML elements as component ' + 'id: ' + key);
        continue;
      }
      // record a all lowercase <-> kebab-case mapping for
      // possible custom element case error warning
      if (process.env.NODE_ENV !== 'production') {
        map[key.replace(/-/g, '').toLowerCase()] = hyphenate(key);
      }
      def = components[key];
      if (isPlainObject(def)) {
        components[key] = Vue.extend(def);
      }
    }
  }
}

/**
 * Ensure all props option syntax are normalized into the
 * Object-based format.
 *
 * @param {Object} options
 */

function guardProps(options) {
  var props = options.props;
  var i, val;
  if (isArray(props)) {
    options.props = {};
    i = props.length;
    while (i--) {
      val = props[i];
      if (typeof val === 'string') {
        options.props[val] = null;
      } else if (val.name) {
        options.props[val.name] = val;
      }
    }
  } else if (isPlainObject(props)) {
    var keys = Object.keys(props);
    i = keys.length;
    while (i--) {
      val = props[keys[i]];
      if (typeof val === 'function') {
        props[keys[i]] = { type: val };
      }
    }
  }
}

/**
 * Guard an Array-format assets option and converted it
 * into the key-value Object format.
 *
 * @param {Object|Array} assets
 * @return {Object}
 */

function guardArrayAssets(assets) {
  if (isArray(assets)) {
    var res = {};
    var i = assets.length;
    var asset;
    while (i--) {
      asset = assets[i];
      var id = typeof asset === 'function' ? asset.options && asset.options.name || asset.id : asset.name || asset.id;
      if (!id) {
        process.env.NODE_ENV !== 'production' && warn('Array-syntax assets must provide a "name" or "id" field.');
      } else {
        res[id] = asset;
      }
    }
    return res;
  }
  return assets;
}

/**
 * Merge two option objects into a new one.
 * Core utility used in both instantiation and inheritance.
 *
 * @param {Object} parent
 * @param {Object} child
 * @param {Vue} [vm] - if vm is present, indicates this is
 *                     an instantiation merge.
 */

function mergeOptions(parent, child, vm) {
  guardComponents(child);
  guardProps(child);
  if (process.env.NODE_ENV !== 'production') {
    if (child.propsData && !vm) {
      warn('propsData can only be used as an instantiation option.');
    }
  }
  var options = {};
  var key;
  if (child['extends']) {
    parent = typeof child['extends'] === 'function' ? mergeOptions(parent, child['extends'].options, vm) : mergeOptions(parent, child['extends'], vm);
  }
  if (child.mixins) {
    for (var i = 0, l = child.mixins.length; i < l; i++) {
      var mixin = child.mixins[i];
      var mixinOptions = mixin.prototype instanceof Vue ? mixin.options : mixin;
      parent = mergeOptions(parent, mixinOptions, vm);
    }
  }
  for (key in parent) {
    mergeField(key);
  }
  for (key in child) {
    if (!hasOwn(parent, key)) {
      mergeField(key);
    }
  }
  function mergeField(key) {
    var strat = strats[key] || defaultStrat;
    options[key] = strat(parent[key], child[key], vm, key);
  }
  return options;
}

/**
 * Resolve an asset.
 * This function is used because child instances need access
 * to assets defined in its ancestor chain.
 *
 * @param {Object} options
 * @param {String} type
 * @param {String} id
 * @param {Boolean} warnMissing
 * @return {Object|Function}
 */

function resolveAsset(options, type, id, warnMissing) {
  /* istanbul ignore if */
  if (typeof id !== 'string') {
    return;
  }
  var assets = options[type];
  var camelizedId;
  var res = assets[id] ||
  // camelCase ID
  assets[camelizedId = camelize(id)] ||
  // Pascal Case ID
  assets[camelizedId.charAt(0).toUpperCase() + camelizedId.slice(1)];
  if (process.env.NODE_ENV !== 'production' && warnMissing && !res) {
    warn('Failed to resolve ' + type.slice(0, -1) + ': ' + id, options);
  }
  return res;
}

var uid$1 = 0;

/**
 * A dep is an observable that can have multiple
 * directives subscribing to it.
 *
 * @constructor
 */
function Dep() {
  this.id = uid$1++;
  this.subs = [];
}

// the current target watcher being evaluated.
// this is globally unique because there could be only one
// watcher being evaluated at any time.
Dep.target = null;

/**
 * Add a directive subscriber.
 *
 * @param {Directive} sub
 */

Dep.prototype.addSub = function (sub) {
  this.subs.push(sub);
};

/**
 * Remove a directive subscriber.
 *
 * @param {Directive} sub
 */

Dep.prototype.removeSub = function (sub) {
  this.subs.$remove(sub);
};

/**
 * Add self as a dependency to the target watcher.
 */

Dep.prototype.depend = function () {
  Dep.target.addDep(this);
};

/**
 * Notify all subscribers of a new value.
 */

Dep.prototype.notify = function () {
  // stablize the subscriber list first
  var subs = toArray(this.subs);
  for (var i = 0, l = subs.length; i < l; i++) {
    subs[i].update();
  }
};

var arrayProto = Array.prototype;
var arrayMethods = Object.create(arrayProto)

/**
 * Intercept mutating methods and emit events
 */

;['push', 'pop', 'shift', 'unshift', 'splice', 'sort', 'reverse'].forEach(function (method) {
  // cache original method
  var original = arrayProto[method];
  def(arrayMethods, method, function mutator() {
    // avoid leaking arguments:
    // http://jsperf.com/closure-with-arguments
    var i = arguments.length;
    var args = new Array(i);
    while (i--) {
      args[i] = arguments[i];
    }
    var result = original.apply(this, args);
    var ob = this.__ob__;
    var inserted;
    switch (method) {
      case 'push':
        inserted = args;
        break;
      case 'unshift':
        inserted = args;
        break;
      case 'splice':
        inserted = args.slice(2);
        break;
    }
    if (inserted) ob.observeArray(inserted);
    // notify change
    ob.dep.notify();
    return result;
  });
});

/**
 * Swap the element at the given index with a new value
 * and emits corresponding event.
 *
 * @param {Number} index
 * @param {*} val
 * @return {*} - replaced element
 */

def(arrayProto, '$set', function $set(index, val) {
  if (index >= this.length) {
    this.length = Number(index) + 1;
  }
  return this.splice(index, 1, val)[0];
});

/**
 * Convenience method to remove the element at given index or target element reference.
 *
 * @param {*} item
 */

def(arrayProto, '$remove', function $remove(item) {
  /* istanbul ignore if */
  if (!this.length) return;
  var index = indexOf(this, item);
  if (index > -1) {
    return this.splice(index, 1);
  }
});

var arrayKeys = Object.getOwnPropertyNames(arrayMethods);

/**
 * By default, when a reactive property is set, the new value is
 * also converted to become reactive. However in certain cases, e.g.
 * v-for scope alias and props, we don't want to force conversion
 * because the value may be a nested value under a frozen data structure.
 *
 * So whenever we want to set a reactive property without forcing
 * conversion on the new value, we wrap that call inside this function.
 */

var shouldConvert = true;

function withoutConversion(fn) {
  shouldConvert = false;
  fn();
  shouldConvert = true;
}

/**
 * Observer class that are attached to each observed
 * object. Once attached, the observer converts target
 * object's property keys into getter/setters that
 * collect dependencies and dispatches updates.
 *
 * @param {Array|Object} value
 * @constructor
 */

function Observer(value) {
  this.value = value;
  this.dep = new Dep();
  def(value, '__ob__', this);
  if (isArray(value)) {
    var augment = hasProto ? protoAugment : copyAugment;
    augment(value, arrayMethods, arrayKeys);
    this.observeArray(value);
  } else {
    this.walk(value);
  }
}

// Instance methods

/**
 * Walk through each property and convert them into
 * getter/setters. This method should only be called when
 * value type is Object.
 *
 * @param {Object} obj
 */

Observer.prototype.walk = function (obj) {
  var keys = Object.keys(obj);
  for (var i = 0, l = keys.length; i < l; i++) {
    this.convert(keys[i], obj[keys[i]]);
  }
};

/**
 * Observe a list of Array items.
 *
 * @param {Array} items
 */

Observer.prototype.observeArray = function (items) {
  for (var i = 0, l = items.length; i < l; i++) {
    observe(items[i]);
  }
};

/**
 * Convert a property into getter/setter so we can emit
 * the events when the property is accessed/changed.
 *
 * @param {String} key
 * @param {*} val
 */

Observer.prototype.convert = function (key, val) {
  defineReactive(this.value, key, val);
};

/**
 * Add an owner vm, so that when $set/$delete mutations
 * happen we can notify owner vms to proxy the keys and
 * digest the watchers. This is only called when the object
 * is observed as an instance's root $data.
 *
 * @param {Vue} vm
 */

Observer.prototype.addVm = function (vm) {
  (this.vms || (this.vms = [])).push(vm);
};

/**
 * Remove an owner vm. This is called when the object is
 * swapped out as an instance's $data object.
 *
 * @param {Vue} vm
 */

Observer.prototype.removeVm = function (vm) {
  this.vms.$remove(vm);
};

// helpers

/**
 * Augment an target Object or Array by intercepting
 * the prototype chain using __proto__
 *
 * @param {Object|Array} target
 * @param {Object} src
 */

function protoAugment(target, src) {
  /* eslint-disable no-proto */
  target.__proto__ = src;
  /* eslint-enable no-proto */
}

/**
 * Augment an target Object or Array by defining
 * hidden properties.
 *
 * @param {Object|Array} target
 * @param {Object} proto
 */

function copyAugment(target, src, keys) {
  for (var i = 0, l = keys.length; i < l; i++) {
    var key = keys[i];
    def(target, key, src[key]);
  }
}

/**
 * Attempt to create an observer instance for a value,
 * returns the new observer if successfully observed,
 * or the existing observer if the value already has one.
 *
 * @param {*} value
 * @param {Vue} [vm]
 * @return {Observer|undefined}
 * @static
 */

function observe(value, vm) {
  if (!value || typeof value !== 'object') {
    return;
  }
  var ob;
  if (hasOwn(value, '__ob__') && value.__ob__ instanceof Observer) {
    ob = value.__ob__;
  } else if (shouldConvert && (isArray(value) || isPlainObject(value)) && Object.isExtensible(value) && !value._isVue) {
    ob = new Observer(value);
  }
  if (ob && vm) {
    ob.addVm(vm);
  }
  return ob;
}

/**
 * Define a reactive property on an Object.
 *
 * @param {Object} obj
 * @param {String} key
 * @param {*} val
 */

function defineReactive(obj, key, val) {
  var dep = new Dep();

  var property = Object.getOwnPropertyDescriptor(obj, key);
  if (property && property.configurable === false) {
    return;
  }

  // cater for pre-defined getter/setters
  var getter = property && property.get;
  var setter = property && property.set;

  var childOb = observe(val);
  Object.defineProperty(obj, key, {
    enumerable: true,
    configurable: true,
    get: function reactiveGetter() {
      var value = getter ? getter.call(obj) : val;
      if (Dep.target) {
        dep.depend();
        if (childOb) {
          childOb.dep.depend();
        }
        if (isArray(value)) {
          for (var e, i = 0, l = value.length; i < l; i++) {
            e = value[i];
            e && e.__ob__ && e.__ob__.dep.depend();
          }
        }
      }
      return value;
    },
    set: function reactiveSetter(newVal) {
      var value = getter ? getter.call(obj) : val;
      if (newVal === value) {
        return;
      }
      if (setter) {
        setter.call(obj, newVal);
      } else {
        val = newVal;
      }
      childOb = observe(newVal);
      dep.notify();
    }
  });
}



var util = Object.freeze({
	defineReactive: defineReactive,
	set: set,
	del: del,
	hasOwn: hasOwn,
	isLiteral: isLiteral,
	isReserved: isReserved,
	_toString: _toString,
	toNumber: toNumber,
	toBoolean: toBoolean,
	stripQuotes: stripQuotes,
	camelize: camelize,
	hyphenate: hyphenate,
	classify: classify,
	bind: bind,
	toArray: toArray,
	extend: extend,
	isObject: isObject,
	isPlainObject: isPlainObject,
	def: def,
	debounce: _debounce,
	indexOf: indexOf,
	cancellable: cancellable,
	looseEqual: looseEqual,
	isArray: isArray,
	hasProto: hasProto,
	inBrowser: inBrowser,
	devtools: devtools,
	isIE: isIE,
	isIE9: isIE9,
	isAndroid: isAndroid,
	isIOS: isIOS,
	get transitionProp () { return transitionProp; },
	get transitionEndEvent () { return transitionEndEvent; },
	get animationProp () { return animationProp; },
	get animationEndEvent () { return animationEndEvent; },
	nextTick: nextTick,
	get _Set () { return _Set; },
	query: query,
	inDoc: inDoc,
	getAttr: getAttr,
	getBindAttr: getBindAttr,
	hasBindAttr: hasBindAttr,
	before: before,
	after: after,
	remove: remove,
	prepend: prepend,
	replace: replace,
	on: on,
	off: off,
	setClass: setClass,
	addClass: addClass,
	removeClass: removeClass,
	extractContent: extractContent,
	trimNode: trimNode,
	isTemplate: isTemplate,
	createAnchor: createAnchor,
	findRef: findRef,
	mapNodeRange: mapNodeRange,
	removeNodeRange: removeNodeRange,
	isFragment: isFragment,
	getOuterHTML: getOuterHTML,
	mergeOptions: mergeOptions,
	resolveAsset: resolveAsset,
	checkComponentAttr: checkComponentAttr,
	commonTagRE: commonTagRE,
	reservedTagRE: reservedTagRE,
	get warn () { return warn; }
});

var uid = 0;

function initMixin (Vue) {
  /**
   * The main init sequence. This is called for every
   * instance, including ones that are created from extended
   * constructors.
   *
   * @param {Object} options - this options object should be
   *                           the result of merging class
   *                           options and the options passed
   *                           in to the constructor.
   */

  Vue.prototype._init = function (options) {
    options = options || {};

    this.$el = null;
    this.$parent = options.parent;
    this.$root = this.$parent ? this.$parent.$root : this;
    this.$children = [];
    this.$refs = {}; // child vm references
    this.$els = {}; // element references
    this._watchers = []; // all watchers as an array
    this._directives = []; // all directives

    // a uid
    this._uid = uid++;

    // a flag to avoid this being observed
    this._isVue = true;

    // events bookkeeping
    this._events = {}; // registered callbacks
    this._eventsCount = {}; // for $broadcast optimization

    // fragment instance properties
    this._isFragment = false;
    this._fragment = // @type {DocumentFragment}
    this._fragmentStart = // @type {Text|Comment}
    this._fragmentEnd = null; // @type {Text|Comment}

    // lifecycle state
    this._isCompiled = this._isDestroyed = this._isReady = this._isAttached = this._isBeingDestroyed = this._vForRemoving = false;
    this._unlinkFn = null;

    // context:
    // if this is a transcluded component, context
    // will be the common parent vm of this instance
    // and its host.
    this._context = options._context || this.$parent;

    // scope:
    // if this is inside an inline v-for, the scope
    // will be the intermediate scope created for this
    // repeat fragment. this is used for linking props
    // and container directives.
    this._scope = options._scope;

    // fragment:
    // if this instance is compiled inside a Fragment, it
    // needs to register itself as a child of that fragment
    // for attach/detach to work properly.
    this._frag = options._frag;
    if (this._frag) {
      this._frag.children.push(this);
    }

    // push self into parent / transclusion host
    if (this.$parent) {
      this.$parent.$children.push(this);
    }

    // merge options.
    options = this.$options = mergeOptions(this.constructor.options, options, this);

    // set ref
    this._updateRef();

    // initialize data as empty object.
    // it will be filled up in _initData().
    this._data = {};

    // call init hook
    this._callHook('init');

    // initialize data observation and scope inheritance.
    this._initState();

    // setup event system and option events.
    this._initEvents();

    // call created hook
    this._callHook('created');

    // if `el` option is passed, start compilation.
    if (options.el) {
      this.$mount(options.el);
    }
  };
}

var pathCache = new Cache(1000);

// actions
var APPEND = 0;
var PUSH = 1;
var INC_SUB_PATH_DEPTH = 2;
var PUSH_SUB_PATH = 3;

// states
var BEFORE_PATH = 0;
var IN_PATH = 1;
var BEFORE_IDENT = 2;
var IN_IDENT = 3;
var IN_SUB_PATH = 4;
var IN_SINGLE_QUOTE = 5;
var IN_DOUBLE_QUOTE = 6;
var AFTER_PATH = 7;
var ERROR = 8;

var pathStateMachine = [];

pathStateMachine[BEFORE_PATH] = {
  'ws': [BEFORE_PATH],
  'ident': [IN_IDENT, APPEND],
  '[': [IN_SUB_PATH],
  'eof': [AFTER_PATH]
};

pathStateMachine[IN_PATH] = {
  'ws': [IN_PATH],
  '.': [BEFORE_IDENT],
  '[': [IN_SUB_PATH],
  'eof': [AFTER_PATH]
};

pathStateMachine[BEFORE_IDENT] = {
  'ws': [BEFORE_IDENT],
  'ident': [IN_IDENT, APPEND]
};

pathStateMachine[IN_IDENT] = {
  'ident': [IN_IDENT, APPEND],
  '0': [IN_IDENT, APPEND],
  'number': [IN_IDENT, APPEND],
  'ws': [IN_PATH, PUSH],
  '.': [BEFORE_IDENT, PUSH],
  '[': [IN_SUB_PATH, PUSH],
  'eof': [AFTER_PATH, PUSH]
};

pathStateMachine[IN_SUB_PATH] = {
  "'": [IN_SINGLE_QUOTE, APPEND],
  '"': [IN_DOUBLE_QUOTE, APPEND],
  '[': [IN_SUB_PATH, INC_SUB_PATH_DEPTH],
  ']': [IN_PATH, PUSH_SUB_PATH],
  'eof': ERROR,
  'else': [IN_SUB_PATH, APPEND]
};

pathStateMachine[IN_SINGLE_QUOTE] = {
  "'": [IN_SUB_PATH, APPEND],
  'eof': ERROR,
  'else': [IN_SINGLE_QUOTE, APPEND]
};

pathStateMachine[IN_DOUBLE_QUOTE] = {
  '"': [IN_SUB_PATH, APPEND],
  'eof': ERROR,
  'else': [IN_DOUBLE_QUOTE, APPEND]
};

/**
 * Determine the type of a character in a keypath.
 *
 * @param {Char} ch
 * @return {String} type
 */

function getPathCharType(ch) {
  if (ch === undefined) {
    return 'eof';
  }

  var code = ch.charCodeAt(0);

  switch (code) {
    case 0x5B: // [
    case 0x5D: // ]
    case 0x2E: // .
    case 0x22: // "
    case 0x27: // '
    case 0x30:
      // 0
      return ch;

    case 0x5F: // _
    case 0x24:
      // $
      return 'ident';

    case 0x20: // Space
    case 0x09: // Tab
    case 0x0A: // Newline
    case 0x0D: // Return
    case 0xA0: // No-break space
    case 0xFEFF: // Byte Order Mark
    case 0x2028: // Line Separator
    case 0x2029:
      // Paragraph Separator
      return 'ws';
  }

  // a-z, A-Z
  if (code >= 0x61 && code <= 0x7A || code >= 0x41 && code <= 0x5A) {
    return 'ident';
  }

  // 1-9
  if (code >= 0x31 && code <= 0x39) {
    return 'number';
  }

  return 'else';
}

/**
 * Format a subPath, return its plain form if it is
 * a literal string or number. Otherwise prepend the
 * dynamic indicator (*).
 *
 * @param {String} path
 * @return {String}
 */

function formatSubPath(path) {
  var trimmed = path.trim();
  // invalid leading 0
  if (path.charAt(0) === '0' && isNaN(path)) {
    return false;
  }
  return isLiteral(trimmed) ? stripQuotes(trimmed) : '*' + trimmed;
}

/**
 * Parse a string path into an array of segments
 *
 * @param {String} path
 * @return {Array|undefined}
 */

function parse(path) {
  var keys = [];
  var index = -1;
  var mode = BEFORE_PATH;
  var subPathDepth = 0;
  var c, newChar, key, type, transition, action, typeMap;

  var actions = [];

  actions[PUSH] = function () {
    if (key !== undefined) {
      keys.push(key);
      key = undefined;
    }
  };

  actions[APPEND] = function () {
    if (key === undefined) {
      key = newChar;
    } else {
      key += newChar;
    }
  };

  actions[INC_SUB_PATH_DEPTH] = function () {
    actions[APPEND]();
    subPathDepth++;
  };

  actions[PUSH_SUB_PATH] = function () {
    if (subPathDepth > 0) {
      subPathDepth--;
      mode = IN_SUB_PATH;
      actions[APPEND]();
    } else {
      subPathDepth = 0;
      key = formatSubPath(key);
      if (key === false) {
        return false;
      } else {
        actions[PUSH]();
      }
    }
  };

  function maybeUnescapeQuote() {
    var nextChar = path[index + 1];
    if (mode === IN_SINGLE_QUOTE && nextChar === "'" || mode === IN_DOUBLE_QUOTE && nextChar === '"') {
      index++;
      newChar = '\\' + nextChar;
      actions[APPEND]();
      return true;
    }
  }

  while (mode != null) {
    index++;
    c = path[index];

    if (c === '\\' && maybeUnescapeQuote()) {
      continue;
    }

    type = getPathCharType(c);
    typeMap = pathStateMachine[mode];
    transition = typeMap[type] || typeMap['else'] || ERROR;

    if (transition === ERROR) {
      return; // parse error
    }

    mode = transition[0];
    action = actions[transition[1]];
    if (action) {
      newChar = transition[2];
      newChar = newChar === undefined ? c : newChar;
      if (action() === false) {
        return;
      }
    }

    if (mode === AFTER_PATH) {
      keys.raw = path;
      return keys;
    }
  }
}

/**
 * External parse that check for a cache hit first
 *
 * @param {String} path
 * @return {Array|undefined}
 */

function parsePath(path) {
  var hit = pathCache.get(path);
  if (!hit) {
    hit = parse(path);
    if (hit) {
      pathCache.put(path, hit);
    }
  }
  return hit;
}

/**
 * Get from an object from a path string
 *
 * @param {Object} obj
 * @param {String} path
 */

function getPath(obj, path) {
  return parseExpression$1(path).get(obj);
}

/**
 * Warn against setting non-existent root path on a vm.
 */

var warnNonExistent;
if (process.env.NODE_ENV !== 'production') {
  warnNonExistent = function (path, vm) {
    warn('You are setting a non-existent path "' + path.raw + '" ' + 'on a vm instance. Consider pre-initializing the property ' + 'with the "data" option for more reliable reactivity ' + 'and better performance.', vm);
  };
}

/**
 * Set on an object from a path
 *
 * @param {Object} obj
 * @param {String | Array} path
 * @param {*} val
 */

function setPath(obj, path, val) {
  var original = obj;
  if (typeof path === 'string') {
    path = parse(path);
  }
  if (!path || !isObject(obj)) {
    return false;
  }
  var last, key;
  for (var i = 0, l = path.length; i < l; i++) {
    last = obj;
    key = path[i];
    if (key.charAt(0) === '*') {
      key = parseExpression$1(key.slice(1)).get.call(original, original);
    }
    if (i < l - 1) {
      obj = obj[key];
      if (!isObject(obj)) {
        obj = {};
        if (process.env.NODE_ENV !== 'production' && last._isVue) {
          warnNonExistent(path, last);
        }
        set(last, key, obj);
      }
    } else {
      if (isArray(obj)) {
        obj.$set(key, val);
      } else if (key in obj) {
        obj[key] = val;
      } else {
        if (process.env.NODE_ENV !== 'production' && obj._isVue) {
          warnNonExistent(path, obj);
        }
        set(obj, key, val);
      }
    }
  }
  return true;
}

var path = Object.freeze({
  parsePath: parsePath,
  getPath: getPath,
  setPath: setPath
});

var expressionCache = new Cache(1000);

var allowedKeywords = 'Math,Date,this,true,false,null,undefined,Infinity,NaN,' + 'isNaN,isFinite,decodeURI,decodeURIComponent,encodeURI,' + 'encodeURIComponent,parseInt,parseFloat';
var allowedKeywordsRE = new RegExp('^(' + allowedKeywords.replace(/,/g, '\\b|') + '\\b)');

// keywords that don't make sense inside expressions
var improperKeywords = 'break,case,class,catch,const,continue,debugger,default,' + 'delete,do,else,export,extends,finally,for,function,if,' + 'import,in,instanceof,let,return,super,switch,throw,try,' + 'var,while,with,yield,enum,await,implements,package,' + 'protected,static,interface,private,public';
var improperKeywordsRE = new RegExp('^(' + improperKeywords.replace(/,/g, '\\b|') + '\\b)');

var wsRE = /\s/g;
var newlineRE = /\n/g;
var saveRE = /[\{,]\s*[\w\$_]+\s*:|('(?:[^'\\]|\\.)*'|"(?:[^"\\]|\\.)*"|`(?:[^`\\]|\\.)*\$\{|\}(?:[^`\\"']|\\.)*`|`(?:[^`\\]|\\.)*`)|new |typeof |void /g;
var restoreRE = /"(\d+)"/g;
var pathTestRE = /^[A-Za-z_$][\w$]*(?:\.[A-Za-z_$][\w$]*|\['.*?'\]|\[".*?"\]|\[\d+\]|\[[A-Za-z_$][\w$]*\])*$/;
var identRE = /[^\w$\.](?:[A-Za-z_$][\w$]*)/g;
var literalValueRE$1 = /^(?:true|false|null|undefined|Infinity|NaN)$/;

function noop() {}

/**
 * Save / Rewrite / Restore
 *
 * When rewriting paths found in an expression, it is
 * possible for the same letter sequences to be found in
 * strings and Object literal property keys. Therefore we
 * remove and store these parts in a temporary array, and
 * restore them after the path rewrite.
 */

var saved = [];

/**
 * Save replacer
 *
 * The save regex can match two possible cases:
 * 1. An opening object literal
 * 2. A string
 * If matched as a plain string, we need to escape its
 * newlines, since the string needs to be preserved when
 * generating the function body.
 *
 * @param {String} str
 * @param {String} isString - str if matched as a string
 * @return {String} - placeholder with index
 */

function save(str, isString) {
  var i = saved.length;
  saved[i] = isString ? str.replace(newlineRE, '\\n') : str;
  return '"' + i + '"';
}

/**
 * Path rewrite replacer
 *
 * @param {String} raw
 * @return {String}
 */

function rewrite(raw) {
  var c = raw.charAt(0);
  var path = raw.slice(1);
  if (allowedKeywordsRE.test(path)) {
    return raw;
  } else {
    path = path.indexOf('"') > -1 ? path.replace(restoreRE, restore) : path;
    return c + 'scope.' + path;
  }
}

/**
 * Restore replacer
 *
 * @param {String} str
 * @param {String} i - matched save index
 * @return {String}
 */

function restore(str, i) {
  return saved[i];
}

/**
 * Rewrite an expression, prefixing all path accessors with
 * `scope.` and generate getter/setter functions.
 *
 * @param {String} exp
 * @return {Function}
 */

function compileGetter(exp) {
  if (improperKeywordsRE.test(exp)) {
    process.env.NODE_ENV !== 'production' && warn('Avoid using reserved keywords in expression: ' + exp);
  }
  // reset state
  saved.length = 0;
  // save strings and object literal keys
  var body = exp.replace(saveRE, save).replace(wsRE, '');
  // rewrite all paths
  // pad 1 space here because the regex matches 1 extra char
  body = (' ' + body).replace(identRE, rewrite).replace(restoreRE, restore);
  return makeGetterFn(body);
}

/**
 * Build a getter function. Requires eval.
 *
 * We isolate the try/catch so it doesn't affect the
 * optimization of the parse function when it is not called.
 *
 * @param {String} body
 * @return {Function|undefined}
 */

function makeGetterFn(body) {
  try {
    /* eslint-disable no-new-func */
    return new Function('scope', 'return ' + body + ';');
    /* eslint-enable no-new-func */
  } catch (e) {
    if (process.env.NODE_ENV !== 'production') {
      /* istanbul ignore if */
      if (e.toString().match(/unsafe-eval|CSP/)) {
        warn('It seems you are using the default build of Vue.js in an environment ' + 'with Content Security Policy that prohibits unsafe-eval. ' + 'Use the CSP-compliant build instead: ' + 'http://vuejs.org/guide/installation.html#CSP-compliant-build');
      } else {
        warn('Invalid expression. ' + 'Generated function body: ' + body);
      }
    }
    return noop;
  }
}

/**
 * Compile a setter function for the expression.
 *
 * @param {String} exp
 * @return {Function|undefined}
 */

function compileSetter(exp) {
  var path = parsePath(exp);
  if (path) {
    return function (scope, val) {
      setPath(scope, path, val);
    };
  } else {
    process.env.NODE_ENV !== 'production' && warn('Invalid setter expression: ' + exp);
  }
}

/**
 * Parse an expression into re-written getter/setters.
 *
 * @param {String} exp
 * @param {Boolean} needSet
 * @return {Function}
 */

function parseExpression$1(exp, needSet) {
  exp = exp.trim();
  // try cache
  var hit = expressionCache.get(exp);
  if (hit) {
    if (needSet && !hit.set) {
      hit.set = compileSetter(hit.exp);
    }
    return hit;
  }
  var res = { exp: exp };
  res.get = isSimplePath(exp) && exp.indexOf('[') < 0
  // optimized super simple getter
  ? makeGetterFn('scope.' + exp)
  // dynamic getter
  : compileGetter(exp);
  if (needSet) {
    res.set = compileSetter(exp);
  }
  expressionCache.put(exp, res);
  return res;
}

/**
 * Check if an expression is a simple path.
 *
 * @param {String} exp
 * @return {Boolean}
 */

function isSimplePath(exp) {
  return pathTestRE.test(exp) &&
  // don't treat literal values as paths
  !literalValueRE$1.test(exp) &&
  // Math constants e.g. Math.PI, Math.E etc.
  exp.slice(0, 5) !== 'Math.';
}

var expression = Object.freeze({
  parseExpression: parseExpression$1,
  isSimplePath: isSimplePath
});

// we have two separate queues: one for directive updates
// and one for user watcher registered via $watch().
// we want to guarantee directive updates to be called
// before user watchers so that when user watchers are
// triggered, the DOM would have already been in updated
// state.

var queue = [];
var userQueue = [];
var has = {};
var circular = {};
var waiting = false;

/**
 * Reset the batcher's state.
 */

function resetBatcherState() {
  queue.length = 0;
  userQueue.length = 0;
  has = {};
  circular = {};
  waiting = false;
}

/**
 * Flush both queues and run the watchers.
 */

function flushBatcherQueue() {
  var _again = true;

  _function: while (_again) {
    _again = false;

    runBatcherQueue(queue);
    runBatcherQueue(userQueue);
    // user watchers triggered more watchers,
    // keep flushing until it depletes
    if (queue.length) {
      _again = true;
      continue _function;
    }
    // dev tool hook
    /* istanbul ignore if */
    if (devtools && config.devtools) {
      devtools.emit('flush');
    }
    resetBatcherState();
  }
}

/**
 * Run the watchers in a single queue.
 *
 * @param {Array} queue
 */

function runBatcherQueue(queue) {
  // do not cache length because more watchers might be pushed
  // as we run existing watchers
  for (var i = 0; i < queue.length; i++) {
    var watcher = queue[i];
    var id = watcher.id;
    has[id] = null;
    watcher.run();
    // in dev build, check and stop circular updates.
    if (process.env.NODE_ENV !== 'production' && has[id] != null) {
      circular[id] = (circular[id] || 0) + 1;
      if (circular[id] > config._maxUpdateCount) {
        warn('You may have an infinite update loop for watcher ' + 'with expression "' + watcher.expression + '"', watcher.vm);
        break;
      }
    }
  }
  queue.length = 0;
}

/**
 * Push a watcher into the watcher queue.
 * Jobs with duplicate IDs will be skipped unless it's
 * pushed when the queue is being flushed.
 *
 * @param {Watcher} watcher
 *   properties:
 *   - {Number} id
 *   - {Function} run
 */

function pushWatcher(watcher) {
  var id = watcher.id;
  if (has[id] == null) {
    // push watcher into appropriate queue
    var q = watcher.user ? userQueue : queue;
    has[id] = q.length;
    q.push(watcher);
    // queue the flush
    if (!waiting) {
      waiting = true;
      nextTick(flushBatcherQueue);
    }
  }
}

var uid$2 = 0;

/**
 * A watcher parses an expression, collects dependencies,
 * and fires callback when the expression value changes.
 * This is used for both the $watch() api and directives.
 *
 * @param {Vue} vm
 * @param {String|Function} expOrFn
 * @param {Function} cb
 * @param {Object} options
 *                 - {Array} filters
 *                 - {Boolean} twoWay
 *                 - {Boolean} deep
 *                 - {Boolean} user
 *                 - {Boolean} sync
 *                 - {Boolean} lazy
 *                 - {Function} [preProcess]
 *                 - {Function} [postProcess]
 * @constructor
 */
function Watcher(vm, expOrFn, cb, options) {
  // mix in options
  if (options) {
    extend(this, options);
  }
  var isFn = typeof expOrFn === 'function';
  this.vm = vm;
  vm._watchers.push(this);
  this.expression = expOrFn;
  this.cb = cb;
  this.id = ++uid$2; // uid for batching
  this.active = true;
  this.dirty = this.lazy; // for lazy watchers
  this.deps = [];
  this.newDeps = [];
  this.depIds = new _Set();
  this.newDepIds = new _Set();
  this.prevError = null; // for async error stacks
  // parse expression for getter/setter
  if (isFn) {
    this.getter = expOrFn;
    this.setter = undefined;
  } else {
    var res = parseExpression$1(expOrFn, this.twoWay);
    this.getter = res.get;
    this.setter = res.set;
  }
  this.value = this.lazy ? undefined : this.get();
  // state for avoiding false triggers for deep and Array
  // watchers during vm._digest()
  this.queued = this.shallow = false;
}

/**
 * Evaluate the getter, and re-collect dependencies.
 */

Watcher.prototype.get = function () {
  this.beforeGet();
  var scope = this.scope || this.vm;
  var value;
  try {
    value = this.getter.call(scope, scope);
  } catch (e) {
    if (process.env.NODE_ENV !== 'production' && config.warnExpressionErrors) {
      warn('Error when evaluating expression ' + '"' + this.expression + '": ' + e.toString(), this.vm);
    }
  }
  // "touch" every property so they are all tracked as
  // dependencies for deep watching
  if (this.deep) {
    traverse(value);
  }
  if (this.preProcess) {
    value = this.preProcess(value);
  }
  if (this.filters) {
    value = scope._applyFilters(value, null, this.filters, false);
  }
  if (this.postProcess) {
    value = this.postProcess(value);
  }
  this.afterGet();
  return value;
};

/**
 * Set the corresponding value with the setter.
 *
 * @param {*} value
 */

Watcher.prototype.set = function (value) {
  var scope = this.scope || this.vm;
  if (this.filters) {
    value = scope._applyFilters(value, this.value, this.filters, true);
  }
  try {
    this.setter.call(scope, scope, value);
  } catch (e) {
    if (process.env.NODE_ENV !== 'production' && config.warnExpressionErrors) {
      warn('Error when evaluating setter ' + '"' + this.expression + '": ' + e.toString(), this.vm);
    }
  }
  // two-way sync for v-for alias
  var forContext = scope.$forContext;
  if (forContext && forContext.alias === this.expression) {
    if (forContext.filters) {
      process.env.NODE_ENV !== 'production' && warn('It seems you are using two-way binding on ' + 'a v-for alias (' + this.expression + '), and the ' + 'v-for has filters. This will not work properly. ' + 'Either remove the filters or use an array of ' + 'objects and bind to object properties instead.', this.vm);
      return;
    }
    forContext._withLock(function () {
      if (scope.$key) {
        // original is an object
        forContext.rawValue[scope.$key] = value;
      } else {
        forContext.rawValue.$set(scope.$index, value);
      }
    });
  }
};

/**
 * Prepare for dependency collection.
 */

Watcher.prototype.beforeGet = function () {
  Dep.target = this;
};

/**
 * Add a dependency to this directive.
 *
 * @param {Dep} dep
 */

Watcher.prototype.addDep = function (dep) {
  var id = dep.id;
  if (!this.newDepIds.has(id)) {
    this.newDepIds.add(id);
    this.newDeps.push(dep);
    if (!this.depIds.has(id)) {
      dep.addSub(this);
    }
  }
};

/**
 * Clean up for dependency collection.
 */

Watcher.prototype.afterGet = function () {
  Dep.target = null;
  var i = this.deps.length;
  while (i--) {
    var dep = this.deps[i];
    if (!this.newDepIds.has(dep.id)) {
      dep.removeSub(this);
    }
  }
  var tmp = this.depIds;
  this.depIds = this.newDepIds;
  this.newDepIds = tmp;
  this.newDepIds.clear();
  tmp = this.deps;
  this.deps = this.newDeps;
  this.newDeps = tmp;
  this.newDeps.length = 0;
};

/**
 * Subscriber interface.
 * Will be called when a dependency changes.
 *
 * @param {Boolean} shallow
 */

Watcher.prototype.update = function (shallow) {
  if (this.lazy) {
    this.dirty = true;
  } else if (this.sync || !config.async) {
    this.run();
  } else {
    // if queued, only overwrite shallow with non-shallow,
    // but not the other way around.
    this.shallow = this.queued ? shallow ? this.shallow : false : !!shallow;
    this.queued = true;
    // record before-push error stack in debug mode
    /* istanbul ignore if */
    if (process.env.NODE_ENV !== 'production' && config.debug) {
      this.prevError = new Error('[vue] async stack trace');
    }
    pushWatcher(this);
  }
};

/**
 * Batcher job interface.
 * Will be called by the batcher.
 */

Watcher.prototype.run = function () {
  if (this.active) {
    var value = this.get();
    if (value !== this.value ||
    // Deep watchers and watchers on Object/Arrays should fire even
    // when the value is the same, because the value may
    // have mutated; but only do so if this is a
    // non-shallow update (caused by a vm digest).
    (isObject(value) || this.deep) && !this.shallow) {
      // set new value
      var oldValue = this.value;
      this.value = value;
      // in debug + async mode, when a watcher callbacks
      // throws, we also throw the saved before-push error
      // so the full cross-tick stack trace is available.
      var prevError = this.prevError;
      /* istanbul ignore if */
      if (process.env.NODE_ENV !== 'production' && config.debug && prevError) {
        this.prevError = null;
        try {
          this.cb.call(this.vm, value, oldValue);
        } catch (e) {
          nextTick(function () {
            throw prevError;
          }, 0);
          throw e;
        }
      } else {
        this.cb.call(this.vm, value, oldValue);
      }
    }
    this.queued = this.shallow = false;
  }
};

/**
 * Evaluate the value of the watcher.
 * This only gets called for lazy watchers.
 */

Watcher.prototype.evaluate = function () {
  // avoid overwriting another watcher that is being
  // collected.
  var current = Dep.target;
  this.value = this.get();
  this.dirty = false;
  Dep.target = current;
};

/**
 * Depend on all deps collected by this watcher.
 */

Watcher.prototype.depend = function () {
  var i = this.deps.length;
  while (i--) {
    this.deps[i].depend();
  }
};

/**
 * Remove self from all dependencies' subcriber list.
 */

Watcher.prototype.teardown = function () {
  if (this.active) {
    // remove self from vm's watcher list
    // this is a somewhat expensive operation so we skip it
    // if the vm is being destroyed or is performing a v-for
    // re-render (the watcher list is then filtered by v-for).
    if (!this.vm._isBeingDestroyed && !this.vm._vForRemoving) {
      this.vm._watchers.$remove(this);
    }
    var i = this.deps.length;
    while (i--) {
      this.deps[i].removeSub(this);
    }
    this.active = false;
    this.vm = this.cb = this.value = null;
  }
};

/**
 * Recrusively traverse an object to evoke all converted
 * getters, so that every nested property inside the object
 * is collected as a "deep" dependency.
 *
 * @param {*} val
 */

var seenObjects = new _Set();
function traverse(val, seen) {
  var i = undefined,
      keys = undefined;
  if (!seen) {
    seen = seenObjects;
    seen.clear();
  }
  var isA = isArray(val);
  var isO = isObject(val);
  if ((isA || isO) && Object.isExtensible(val)) {
    if (val.__ob__) {
      var depId = val.__ob__.dep.id;
      if (seen.has(depId)) {
        return;
      } else {
        seen.add(depId);
      }
    }
    if (isA) {
      i = val.length;
      while (i--) traverse(val[i], seen);
    } else if (isO) {
      keys = Object.keys(val);
      i = keys.length;
      while (i--) traverse(val[keys[i]], seen);
    }
  }
}

var text$1 = {

  bind: function bind() {
    this.attr = this.el.nodeType === 3 ? 'data' : 'textContent';
  },

  update: function update(value) {
    this.el[this.attr] = _toString(value);
  }
};

var templateCache = new Cache(1000);
var idSelectorCache = new Cache(1000);

var map = {
  efault: [0, '', ''],
  legend: [1, '<fieldset>', '</fieldset>'],
  tr: [2, '<table><tbody>', '</tbody></table>'],
  col: [2, '<table><tbody></tbody><colgroup>', '</colgroup></table>']
};

map.td = map.th = [3, '<table><tbody><tr>', '</tr></tbody></table>'];

map.option = map.optgroup = [1, '<select multiple="multiple">', '</select>'];

map.thead = map.tbody = map.colgroup = map.caption = map.tfoot = [1, '<table>', '</table>'];

map.g = map.defs = map.symbol = map.use = map.image = map.text = map.circle = map.ellipse = map.line = map.path = map.polygon = map.polyline = map.rect = [1, '<svg ' + 'xmlns="http://www.w3.org/2000/svg" ' + 'xmlns:xlink="http://www.w3.org/1999/xlink" ' + 'xmlns:ev="http://www.w3.org/2001/xml-events"' + 'version="1.1">', '</svg>'];

/**
 * Check if a node is a supported template node with a
 * DocumentFragment content.
 *
 * @param {Node} node
 * @return {Boolean}
 */

function isRealTemplate(node) {
  return isTemplate(node) && isFragment(node.content);
}

var tagRE$1 = /<([\w:-]+)/;
var entityRE = /&#?\w+?;/;
var commentRE = /<!--/;

/**
 * Convert a string template to a DocumentFragment.
 * Determines correct wrapping by tag types. Wrapping
 * strategy found in jQuery & component/domify.
 *
 * @param {String} templateString
 * @param {Boolean} raw
 * @return {DocumentFragment}
 */

function stringToFragment(templateString, raw) {
  // try a cache hit first
  var cacheKey = raw ? templateString : templateString.trim();
  var hit = templateCache.get(cacheKey);
  if (hit) {
    return hit;
  }

  var frag = document.createDocumentFragment();
  var tagMatch = templateString.match(tagRE$1);
  var entityMatch = entityRE.test(templateString);
  var commentMatch = commentRE.test(templateString);

  if (!tagMatch && !entityMatch && !commentMatch) {
    // text only, return a single text node.
    frag.appendChild(document.createTextNode(templateString));
  } else {
    var tag = tagMatch && tagMatch[1];
    var wrap = map[tag] || map.efault;
    var depth = wrap[0];
    var prefix = wrap[1];
    var suffix = wrap[2];
    var node = document.createElement('div');

    node.innerHTML = prefix + templateString + suffix;
    while (depth--) {
      node = node.lastChild;
    }

    var child;
    /* eslint-disable no-cond-assign */
    while (child = node.firstChild) {
      /* eslint-enable no-cond-assign */
      frag.appendChild(child);
    }
  }
  if (!raw) {
    trimNode(frag);
  }
  templateCache.put(cacheKey, frag);
  return frag;
}

/**
 * Convert a template node to a DocumentFragment.
 *
 * @param {Node} node
 * @return {DocumentFragment}
 */

function nodeToFragment(node) {
  // if its a template tag and the browser supports it,
  // its content is already a document fragment. However, iOS Safari has
  // bug when using directly cloned template content with touch
  // events and can cause crashes when the nodes are removed from DOM, so we
  // have to treat template elements as string templates. (#2805)
  /* istanbul ignore if */
  if (isRealTemplate(node)) {
    return stringToFragment(node.innerHTML);
  }
  // script template
  if (node.tagName === 'SCRIPT') {
    return stringToFragment(node.textContent);
  }
  // normal node, clone it to avoid mutating the original
  var clonedNode = cloneNode(node);
  var frag = document.createDocumentFragment();
  var child;
  /* eslint-disable no-cond-assign */
  while (child = clonedNode.firstChild) {
    /* eslint-enable no-cond-assign */
    frag.appendChild(child);
  }
  trimNode(frag);
  return frag;
}

// Test for the presence of the Safari template cloning bug
// https://bugs.webkit.org/showug.cgi?id=137755
var hasBrokenTemplate = (function () {
  /* istanbul ignore else */
  if (inBrowser) {
    var a = document.createElement('div');
    a.innerHTML = '<template>1</template>';
    return !a.cloneNode(true).firstChild.innerHTML;
  } else {
    return false;
  }
})();

// Test for IE10/11 textarea placeholder clone bug
var hasTextareaCloneBug = (function () {
  /* istanbul ignore else */
  if (inBrowser) {
    var t = document.createElement('textarea');
    t.placeholder = 't';
    return t.cloneNode(true).value === 't';
  } else {
    return false;
  }
})();

/**
 * 1. Deal with Safari cloning nested <template> bug by
 *    manually cloning all template instances.
 * 2. Deal with IE10/11 textarea placeholder bug by setting
 *    the correct value after cloning.
 *
 * @param {Element|DocumentFragment} node
 * @return {Element|DocumentFragment}
 */

function cloneNode(node) {
  /* istanbul ignore if */
  if (!node.querySelectorAll) {
    return node.cloneNode();
  }
  var res = node.cloneNode(true);
  var i, original, cloned;
  /* istanbul ignore if */
  if (hasBrokenTemplate) {
    var tempClone = res;
    if (isRealTemplate(node)) {
      node = node.content;
      tempClone = res.content;
    }
    original = node.querySelectorAll('template');
    if (original.length) {
      cloned = tempClone.querySelectorAll('template');
      i = cloned.length;
      while (i--) {
        cloned[i].parentNode.replaceChild(cloneNode(original[i]), cloned[i]);
      }
    }
  }
  /* istanbul ignore if */
  if (hasTextareaCloneBug) {
    if (node.tagName === 'TEXTAREA') {
      res.value = node.value;
    } else {
      original = node.querySelectorAll('textarea');
      if (original.length) {
        cloned = res.querySelectorAll('textarea');
        i = cloned.length;
        while (i--) {
          cloned[i].value = original[i].value;
        }
      }
    }
  }
  return res;
}

/**
 * Process the template option and normalizes it into a
 * a DocumentFragment that can be used as a partial or a
 * instance template.
 *
 * @param {*} template
 *        Possible values include:
 *        - DocumentFragment object
 *        - Node object of type Template
 *        - id selector: '#some-template-id'
 *        - template string: '<div><span>{{msg}}</span></div>'
 * @param {Boolean} shouldClone
 * @param {Boolean} raw
 *        inline HTML interpolation. Do not check for id
 *        selector and keep whitespace in the string.
 * @return {DocumentFragment|undefined}
 */

function parseTemplate(template, shouldClone, raw) {
  var node, frag;

  // if the template is already a document fragment,
  // do nothing
  if (isFragment(template)) {
    trimNode(template);
    return shouldClone ? cloneNode(template) : template;
  }

  if (typeof template === 'string') {
    // id selector
    if (!raw && template.charAt(0) === '#') {
      // id selector can be cached too
      frag = idSelectorCache.get(template);
      if (!frag) {
        node = document.getElementById(template.slice(1));
        if (node) {
          frag = nodeToFragment(node);
          // save selector to cache
          idSelectorCache.put(template, frag);
        }
      }
    } else {
      // normal string template
      frag = stringToFragment(template, raw);
    }
  } else if (template.nodeType) {
    // a direct node
    frag = nodeToFragment(template);
  }

  return frag && shouldClone ? cloneNode(frag) : frag;
}

var template = Object.freeze({
  cloneNode: cloneNode,
  parseTemplate: parseTemplate
});

var html = {

  bind: function bind() {
    // a comment node means this is a binding for
    // {{{ inline unescaped html }}}
    if (this.el.nodeType === 8) {
      // hold nodes
      this.nodes = [];
      // replace the placeholder with proper anchor
      this.anchor = createAnchor('v-html');
      replace(this.el, this.anchor);
    }
  },

  update: function update(value) {
    value = _toString(value);
    if (this.nodes) {
      this.swap(value);
    } else {
      this.el.innerHTML = value;
    }
  },

  swap: function swap(value) {
    // remove old nodes
    var i = this.nodes.length;
    while (i--) {
      remove(this.nodes[i]);
    }
    // convert new value to a fragment
    // do not attempt to retrieve from id selector
    var frag = parseTemplate(value, true, true);
    // save a reference to these nodes so we can remove later
    this.nodes = toArray(frag.childNodes);
    before(frag, this.anchor);
  }
};

/**
 * Abstraction for a partially-compiled fragment.
 * Can optionally compile content with a child scope.
 *
 * @param {Function} linker
 * @param {Vue} vm
 * @param {DocumentFragment} frag
 * @param {Vue} [host]
 * @param {Object} [scope]
 * @param {Fragment} [parentFrag]
 */
function Fragment(linker, vm, frag, host, scope, parentFrag) {
  this.children = [];
  this.childFrags = [];
  this.vm = vm;
  this.scope = scope;
  this.inserted = false;
  this.parentFrag = parentFrag;
  if (parentFrag) {
    parentFrag.childFrags.push(this);
  }
  this.unlink = linker(vm, frag, host, scope, this);
  var single = this.single = frag.childNodes.length === 1 &&
  // do not go single mode if the only node is an anchor
  !frag.childNodes[0].__v_anchor;
  if (single) {
    this.node = frag.childNodes[0];
    this.before = singleBefore;
    this.remove = singleRemove;
  } else {
    this.node = createAnchor('fragment-start');
    this.end = createAnchor('fragment-end');
    this.frag = frag;
    prepend(this.node, frag);
    frag.appendChild(this.end);
    this.before = multiBefore;
    this.remove = multiRemove;
  }
  this.node.__v_frag = this;
}

/**
 * Call attach/detach for all components contained within
 * this fragment. Also do so recursively for all child
 * fragments.
 *
 * @param {Function} hook
 */

Fragment.prototype.callHook = function (hook) {
  var i, l;
  for (i = 0, l = this.childFrags.length; i < l; i++) {
    this.childFrags[i].callHook(hook);
  }
  for (i = 0, l = this.children.length; i < l; i++) {
    hook(this.children[i]);
  }
};

/**
 * Insert fragment before target, single node version
 *
 * @param {Node} target
 * @param {Boolean} withTransition
 */

function singleBefore(target, withTransition) {
  this.inserted = true;
  var method = withTransition !== false ? beforeWithTransition : before;
  method(this.node, target, this.vm);
  if (inDoc(this.node)) {
    this.callHook(attach);
  }
}

/**
 * Remove fragment, single node version
 */

function singleRemove() {
  this.inserted = false;
  var shouldCallRemove = inDoc(this.node);
  var self = this;
  this.beforeRemove();
  removeWithTransition(this.node, this.vm, function () {
    if (shouldCallRemove) {
      self.callHook(detach);
    }
    self.destroy();
  });
}

/**
 * Insert fragment before target, multi-nodes version
 *
 * @param {Node} target
 * @param {Boolean} withTransition
 */

function multiBefore(target, withTransition) {
  this.inserted = true;
  var vm = this.vm;
  var method = withTransition !== false ? beforeWithTransition : before;
  mapNodeRange(this.node, this.end, function (node) {
    method(node, target, vm);
  });
  if (inDoc(this.node)) {
    this.callHook(attach);
  }
}

/**
 * Remove fragment, multi-nodes version
 */

function multiRemove() {
  this.inserted = false;
  var self = this;
  var shouldCallRemove = inDoc(this.node);
  this.beforeRemove();
  removeNodeRange(this.node, this.end, this.vm, this.frag, function () {
    if (shouldCallRemove) {
      self.callHook(detach);
    }
    self.destroy();
  });
}

/**
 * Prepare the fragment for removal.
 */

Fragment.prototype.beforeRemove = function () {
  var i, l;
  for (i = 0, l = this.childFrags.length; i < l; i++) {
    // call the same method recursively on child
    // fragments, depth-first
    this.childFrags[i].beforeRemove(false);
  }
  for (i = 0, l = this.children.length; i < l; i++) {
    // Call destroy for all contained instances,
    // with remove:false and defer:true.
    // Defer is necessary because we need to
    // keep the children to call detach hooks
    // on them.
    this.children[i].$destroy(false, true);
  }
  var dirs = this.unlink.dirs;
  for (i = 0, l = dirs.length; i < l; i++) {
    // disable the watchers on all the directives
    // so that the rendered content stays the same
    // during removal.
    dirs[i]._watcher && dirs[i]._watcher.teardown();
  }
};

/**
 * Destroy the fragment.
 */

Fragment.prototype.destroy = function () {
  if (this.parentFrag) {
    this.parentFrag.childFrags.$remove(this);
  }
  this.node.__v_frag = null;
  this.unlink();
};

/**
 * Call attach hook for a Vue instance.
 *
 * @param {Vue} child
 */

function attach(child) {
  if (!child._isAttached && inDoc(child.$el)) {
    child._callHook('attached');
  }
}

/**
 * Call detach hook for a Vue instance.
 *
 * @param {Vue} child
 */

function detach(child) {
  if (child._isAttached && !inDoc(child.$el)) {
    child._callHook('detached');
  }
}

var linkerCache = new Cache(5000);

/**
 * A factory that can be used to create instances of a
 * fragment. Caches the compiled linker if possible.
 *
 * @param {Vue} vm
 * @param {Element|String} el
 */
function FragmentFactory(vm, el) {
  this.vm = vm;
  var template;
  var isString = typeof el === 'string';
  if (isString || isTemplate(el) && !el.hasAttribute('v-if')) {
    template = parseTemplate(el, true);
  } else {
    template = document.createDocumentFragment();
    template.appendChild(el);
  }
  this.template = template;
  // linker can be cached, but only for components
  var linker;
  var cid = vm.constructor.cid;
  if (cid > 0) {
    var cacheId = cid + (isString ? el : getOuterHTML(el));
    linker = linkerCache.get(cacheId);
    if (!linker) {
      linker = compile(template, vm.$options, true);
      linkerCache.put(cacheId, linker);
    }
  } else {
    linker = compile(template, vm.$options, true);
  }
  this.linker = linker;
}

/**
 * Create a fragment instance with given host and scope.
 *
 * @param {Vue} host
 * @param {Object} scope
 * @param {Fragment} parentFrag
 */

FragmentFactory.prototype.create = function (host, scope, parentFrag) {
  var frag = cloneNode(this.template);
  return new Fragment(this.linker, this.vm, frag, host, scope, parentFrag);
};

var ON = 700;
var MODEL = 800;
var BIND = 850;
var TRANSITION = 1100;
var EL = 1500;
var COMPONENT = 1500;
var PARTIAL = 1750;
var IF = 2100;
var FOR = 2200;
var SLOT = 2300;

var uid$3 = 0;

var vFor = {

  priority: FOR,
  terminal: true,

  params: ['track-by', 'stagger', 'enter-stagger', 'leave-stagger'],

  bind: function bind() {
    if (process.env.NODE_ENV !== 'production' && this.el.hasAttribute('v-if')) {
      warn('<' + this.el.tagName.toLowerCase() + ' v-for="' + this.expression + '" v-if="' + this.el.getAttribute('v-if') + '">: ' + 'Using v-if and v-for on the same element is not recommended - ' + 'consider filtering the source Array instead.', this.vm);
    }

    // support "item in/of items" syntax
    var inMatch = this.expression.match(/(.*) (?:in|of) (.*)/);
    if (inMatch) {
      var itMatch = inMatch[1].match(/\((.*),(.*)\)/);
      if (itMatch) {
        this.iterator = itMatch[1].trim();
        this.alias = itMatch[2].trim();
      } else {
        this.alias = inMatch[1].trim();
      }
      this.expression = inMatch[2];
    }

    if (!this.alias) {
      process.env.NODE_ENV !== 'production' && warn('Invalid v-for expression "' + this.descriptor.raw + '": ' + 'alias is required.', this.vm);
      return;
    }

    // uid as a cache identifier
    this.id = '__v-for__' + ++uid$3;

    // check if this is an option list,
    // so that we know if we need to update the <select>'s
    // v-model when the option list has changed.
    // because v-model has a lower priority than v-for,
    // the v-model is not bound here yet, so we have to
    // retrive it in the actual updateModel() function.
    var tag = this.el.tagName;
    this.isOption = (tag === 'OPTION' || tag === 'OPTGROUP') && this.el.parentNode.tagName === 'SELECT';

    // setup anchor nodes
    this.start = createAnchor('v-for-start');
    this.end = createAnchor('v-for-end');
    replace(this.el, this.end);
    before(this.start, this.end);

    // cache
    this.cache = Object.create(null);

    // fragment factory
    this.factory = new FragmentFactory(this.vm, this.el);
  },

  update: function update(data) {
    this.diff(data);
    this.updateRef();
    this.updateModel();
  },

  /**
   * Diff, based on new data and old data, determine the
   * minimum amount of DOM manipulations needed to make the
   * DOM reflect the new data Array.
   *
   * The algorithm diffs the new data Array by storing a
   * hidden reference to an owner vm instance on previously
   * seen data. This allows us to achieve O(n) which is
   * better than a levenshtein distance based algorithm,
   * which is O(m * n).
   *
   * @param {Array} data
   */

  diff: function diff(data) {
    // check if the Array was converted from an Object
    var item = data[0];
    var convertedFromObject = this.fromObject = isObject(item) && hasOwn(item, '$key') && hasOwn(item, '$value');

    var trackByKey = this.params.trackBy;
    var oldFrags = this.frags;
    var frags = this.frags = new Array(data.length);
    var alias = this.alias;
    var iterator = this.iterator;
    var start = this.start;
    var end = this.end;
    var inDocument = inDoc(start);
    var init = !oldFrags;
    var i, l, frag, key, value, primitive;

    // First pass, go through the new Array and fill up
    // the new frags array. If a piece of data has a cached
    // instance for it, we reuse it. Otherwise build a new
    // instance.
    for (i = 0, l = data.length; i < l; i++) {
      item = data[i];
      key = convertedFromObject ? item.$key : null;
      value = convertedFromObject ? item.$value : item;
      primitive = !isObject(value);
      frag = !init && this.getCachedFrag(value, i, key);
      if (frag) {
        // reusable fragment
        frag.reused = true;
        // update $index
        frag.scope.$index = i;
        // update $key
        if (key) {
          frag.scope.$key = key;
        }
        // update iterator
        if (iterator) {
          frag.scope[iterator] = key !== null ? key : i;
        }
        // update data for track-by, object repeat &
        // primitive values.
        if (trackByKey || convertedFromObject || primitive) {
          withoutConversion(function () {
            frag.scope[alias] = value;
          });
        }
      } else {
        // new instance
        frag = this.create(value, alias, i, key);
        frag.fresh = !init;
      }
      frags[i] = frag;
      if (init) {
        frag.before(end);
      }
    }

    // we're done for the initial render.
    if (init) {
      return;
    }

    // Second pass, go through the old fragments and
    // destroy those who are not reused (and remove them
    // from cache)
    var removalIndex = 0;
    var totalRemoved = oldFrags.length - frags.length;
    // when removing a large number of fragments, watcher removal
    // turns out to be a perf bottleneck, so we batch the watcher
    // removals into a single filter call!
    this.vm._vForRemoving = true;
    for (i = 0, l = oldFrags.length; i < l; i++) {
      frag = oldFrags[i];
      if (!frag.reused) {
        this.deleteCachedFrag(frag);
        this.remove(frag, removalIndex++, totalRemoved, inDocument);
      }
    }
    this.vm._vForRemoving = false;
    if (removalIndex) {
      this.vm._watchers = this.vm._watchers.filter(function (w) {
        return w.active;
      });
    }

    // Final pass, move/insert new fragments into the
    // right place.
    var targetPrev, prevEl, currentPrev;
    var insertionIndex = 0;
    for (i = 0, l = frags.length; i < l; i++) {
      frag = frags[i];
      // this is the frag that we should be after
      targetPrev = frags[i - 1];
      prevEl = targetPrev ? targetPrev.staggerCb ? targetPrev.staggerAnchor : targetPrev.end || targetPrev.node : start;
      if (frag.reused && !frag.staggerCb) {
        currentPrev = findPrevFrag(frag, start, this.id);
        if (currentPrev !== targetPrev && (!currentPrev ||
        // optimization for moving a single item.
        // thanks to suggestions by @livoras in #1807
        findPrevFrag(currentPrev, start, this.id) !== targetPrev)) {
          this.move(frag, prevEl);
        }
      } else {
        // new instance, or still in stagger.
        // insert with updated stagger index.
        this.insert(frag, insertionIndex++, prevEl, inDocument);
      }
      frag.reused = frag.fresh = false;
    }
  },

  /**
   * Create a new fragment instance.
   *
   * @param {*} value
   * @param {String} alias
   * @param {Number} index
   * @param {String} [key]
   * @return {Fragment}
   */

  create: function create(value, alias, index, key) {
    var host = this._host;
    // create iteration scope
    var parentScope = this._scope || this.vm;
    var scope = Object.create(parentScope);
    // ref holder for the scope
    scope.$refs = Object.create(parentScope.$refs);
    scope.$els = Object.create(parentScope.$els);
    // make sure point $parent to parent scope
    scope.$parent = parentScope;
    // for two-way binding on alias
    scope.$forContext = this;
    // define scope properties
    // important: define the scope alias without forced conversion
    // so that frozen data structures remain non-reactive.
    withoutConversion(function () {
      defineReactive(scope, alias, value);
    });
    defineReactive(scope, '$index', index);
    if (key) {
      defineReactive(scope, '$key', key);
    } else if (scope.$key) {
      // avoid accidental fallback
      def(scope, '$key', null);
    }
    if (this.iterator) {
      defineReactive(scope, this.iterator, key !== null ? key : index);
    }
    var frag = this.factory.create(host, scope, this._frag);
    frag.forId = this.id;
    this.cacheFrag(value, frag, index, key);
    return frag;
  },

  /**
   * Update the v-ref on owner vm.
   */

  updateRef: function updateRef() {
    var ref = this.descriptor.ref;
    if (!ref) return;
    var hash = (this._scope || this.vm).$refs;
    var refs;
    if (!this.fromObject) {
      refs = this.frags.map(findVmFromFrag);
    } else {
      refs = {};
      this.frags.forEach(function (frag) {
        refs[frag.scope.$key] = findVmFromFrag(frag);
      });
    }
    hash[ref] = refs;
  },

  /**
   * For option lists, update the containing v-model on
   * parent <select>.
   */

  updateModel: function updateModel() {
    if (this.isOption) {
      var parent = this.start.parentNode;
      var model = parent && parent.__v_model;
      if (model) {
        model.forceUpdate();
      }
    }
  },

  /**
   * Insert a fragment. Handles staggering.
   *
   * @param {Fragment} frag
   * @param {Number} index
   * @param {Node} prevEl
   * @param {Boolean} inDocument
   */

  insert: function insert(frag, index, prevEl, inDocument) {
    if (frag.staggerCb) {
      frag.staggerCb.cancel();
      frag.staggerCb = null;
    }
    var staggerAmount = this.getStagger(frag, index, null, 'enter');
    if (inDocument && staggerAmount) {
      // create an anchor and insert it synchronously,
      // so that we can resolve the correct order without
      // worrying about some elements not inserted yet
      var anchor = frag.staggerAnchor;
      if (!anchor) {
        anchor = frag.staggerAnchor = createAnchor('stagger-anchor');
        anchor.__v_frag = frag;
      }
      after(anchor, prevEl);
      var op = frag.staggerCb = cancellable(function () {
        frag.staggerCb = null;
        frag.before(anchor);
        remove(anchor);
      });
      setTimeout(op, staggerAmount);
    } else {
      var target = prevEl.nextSibling;
      /* istanbul ignore if */
      if (!target) {
        // reset end anchor position in case the position was messed up
        // by an external drag-n-drop library.
        after(this.end, prevEl);
        target = this.end;
      }
      frag.before(target);
    }
  },

  /**
   * Remove a fragment. Handles staggering.
   *
   * @param {Fragment} frag
   * @param {Number} index
   * @param {Number} total
   * @param {Boolean} inDocument
   */

  remove: function remove(frag, index, total, inDocument) {
    if (frag.staggerCb) {
      frag.staggerCb.cancel();
      frag.staggerCb = null;
      // it's not possible for the same frag to be removed
      // twice, so if we have a pending stagger callback,
      // it means this frag is queued for enter but removed
      // before its transition started. Since it is already
      // destroyed, we can just leave it in detached state.
      return;
    }
    var staggerAmount = this.getStagger(frag, index, total, 'leave');
    if (inDocument && staggerAmount) {
      var op = frag.staggerCb = cancellable(function () {
        frag.staggerCb = null;
        frag.remove();
      });
      setTimeout(op, staggerAmount);
    } else {
      frag.remove();
    }
  },

  /**
   * Move a fragment to a new position.
   * Force no transition.
   *
   * @param {Fragment} frag
   * @param {Node} prevEl
   */

  move: function move(frag, prevEl) {
    // fix a common issue with Sortable:
    // if prevEl doesn't have nextSibling, this means it's
    // been dragged after the end anchor. Just re-position
    // the end anchor to the end of the container.
    /* istanbul ignore if */
    if (!prevEl.nextSibling) {
      this.end.parentNode.appendChild(this.end);
    }
    frag.before(prevEl.nextSibling, false);
  },

  /**
   * Cache a fragment using track-by or the object key.
   *
   * @param {*} value
   * @param {Fragment} frag
   * @param {Number} index
   * @param {String} [key]
   */

  cacheFrag: function cacheFrag(value, frag, index, key) {
    var trackByKey = this.params.trackBy;
    var cache = this.cache;
    var primitive = !isObject(value);
    var id;
    if (key || trackByKey || primitive) {
      id = getTrackByKey(index, key, value, trackByKey);
      if (!cache[id]) {
        cache[id] = frag;
      } else if (trackByKey !== '$index') {
        process.env.NODE_ENV !== 'production' && this.warnDuplicate(value);
      }
    } else {
      id = this.id;
      if (hasOwn(value, id)) {
        if (value[id] === null) {
          value[id] = frag;
        } else {
          process.env.NODE_ENV !== 'production' && this.warnDuplicate(value);
        }
      } else if (Object.isExtensible(value)) {
        def(value, id, frag);
      } else if (process.env.NODE_ENV !== 'production') {
        warn('Frozen v-for objects cannot be automatically tracked, make sure to ' + 'provide a track-by key.');
      }
    }
    frag.raw = value;
  },

  /**
   * Get a cached fragment from the value/index/key
   *
   * @param {*} value
   * @param {Number} index
   * @param {String} key
   * @return {Fragment}
   */

  getCachedFrag: function getCachedFrag(value, index, key) {
    var trackByKey = this.params.trackBy;
    var primitive = !isObject(value);
    var frag;
    if (key || trackByKey || primitive) {
      var id = getTrackByKey(index, key, value, trackByKey);
      frag = this.cache[id];
    } else {
      frag = value[this.id];
    }
    if (frag && (frag.reused || frag.fresh)) {
      process.env.NODE_ENV !== 'production' && this.warnDuplicate(value);
    }
    return frag;
  },

  /**
   * Delete a fragment from cache.
   *
   * @param {Fragment} frag
   */

  deleteCachedFrag: function deleteCachedFrag(frag) {
    var value = frag.raw;
    var trackByKey = this.params.trackBy;
    var scope = frag.scope;
    var index = scope.$index;
    // fix #948: avoid accidentally fall through to
    // a parent repeater which happens to have $key.
    var key = hasOwn(scope, '$key') && scope.$key;
    var primitive = !isObject(value);
    if (trackByKey || key || primitive) {
      var id = getTrackByKey(index, key, value, trackByKey);
      this.cache[id] = null;
    } else {
      value[this.id] = null;
      frag.raw = null;
    }
  },

  /**
   * Get the stagger amount for an insertion/removal.
   *
   * @param {Fragment} frag
   * @param {Number} index
   * @param {Number} total
   * @param {String} type
   */

  getStagger: function getStagger(frag, index, total, type) {
    type = type + 'Stagger';
    var trans = frag.node.__v_trans;
    var hooks = trans && trans.hooks;
    var hook = hooks && (hooks[type] || hooks.stagger);
    return hook ? hook.call(frag, index, total) : index * parseInt(this.params[type] || this.params.stagger, 10);
  },

  /**
   * Pre-process the value before piping it through the
   * filters. This is passed to and called by the watcher.
   */

  _preProcess: function _preProcess(value) {
    // regardless of type, store the un-filtered raw value.
    this.rawValue = value;
    return value;
  },

  /**
   * Post-process the value after it has been piped through
   * the filters. This is passed to and called by the watcher.
   *
   * It is necessary for this to be called during the
   * watcher's dependency collection phase because we want
   * the v-for to update when the source Object is mutated.
   */

  _postProcess: function _postProcess(value) {
    if (isArray(value)) {
      return value;
    } else if (isPlainObject(value)) {
      // convert plain object to array.
      var keys = Object.keys(value);
      var i = keys.length;
      var res = new Array(i);
      var key;
      while (i--) {
        key = keys[i];
        res[i] = {
          $key: key,
          $value: value[key]
        };
      }
      return res;
    } else {
      if (typeof value === 'number' && !isNaN(value)) {
        value = range(value);
      }
      return value || [];
    }
  },

  unbind: function unbind() {
    if (this.descriptor.ref) {
      (this._scope || this.vm).$refs[this.descriptor.ref] = null;
    }
    if (this.frags) {
      var i = this.frags.length;
      var frag;
      while (i--) {
        frag = this.frags[i];
        this.deleteCachedFrag(frag);
        frag.destroy();
      }
    }
  }
};

/**
 * Helper to find the previous element that is a fragment
 * anchor. This is necessary because a destroyed frag's
 * element could still be lingering in the DOM before its
 * leaving transition finishes, but its inserted flag
 * should have been set to false so we can skip them.
 *
 * If this is a block repeat, we want to make sure we only
 * return frag that is bound to this v-for. (see #929)
 *
 * @param {Fragment} frag
 * @param {Comment|Text} anchor
 * @param {String} id
 * @return {Fragment}
 */

function findPrevFrag(frag, anchor, id) {
  var el = frag.node.previousSibling;
  /* istanbul ignore if */
  if (!el) return;
  frag = el.__v_frag;
  while ((!frag || frag.forId !== id || !frag.inserted) && el !== anchor) {
    el = el.previousSibling;
    /* istanbul ignore if */
    if (!el) return;
    frag = el.__v_frag;
  }
  return frag;
}

/**
 * Create a range array from given number.
 *
 * @param {Number} n
 * @return {Array}
 */

function range(n) {
  var i = -1;
  var ret = new Array(Math.floor(n));
  while (++i < n) {
    ret[i] = i;
  }
  return ret;
}

/**
 * Get the track by key for an item.
 *
 * @param {Number} index
 * @param {String} key
 * @param {*} value
 * @param {String} [trackByKey]
 */

function getTrackByKey(index, key, value, trackByKey) {
  return trackByKey ? trackByKey === '$index' ? index : trackByKey.charAt(0).match(/\w/) ? getPath(value, trackByKey) : value[trackByKey] : key || value;
}

if (process.env.NODE_ENV !== 'production') {
  vFor.warnDuplicate = function (value) {
    warn('Duplicate value found in v-for="' + this.descriptor.raw + '": ' + JSON.stringify(value) + '. Use track-by="$index" if ' + 'you are expecting duplicate values.', this.vm);
  };
}

/**
 * Find a vm from a fragment.
 *
 * @param {Fragment} frag
 * @return {Vue|undefined}
 */

function findVmFromFrag(frag) {
  var node = frag.node;
  // handle multi-node frag
  if (frag.end) {
    while (!node.__vue__ && node !== frag.end && node.nextSibling) {
      node = node.nextSibling;
    }
  }
  return node.__vue__;
}

var vIf = {

  priority: IF,
  terminal: true,

  bind: function bind() {
    var el = this.el;
    if (!el.__vue__) {
      // check else block
      var next = el.nextElementSibling;
      if (next && getAttr(next, 'v-else') !== null) {
        remove(next);
        this.elseEl = next;
      }
      // check main block
      this.anchor = createAnchor('v-if');
      replace(el, this.anchor);
    } else {
      process.env.NODE_ENV !== 'production' && warn('v-if="' + this.expression + '" cannot be ' + 'used on an instance root element.', this.vm);
      this.invalid = true;
    }
  },

  update: function update(value) {
    if (this.invalid) return;
    if (value) {
      if (!this.frag) {
        this.insert();
      }
    } else {
      this.remove();
    }
  },

  insert: function insert() {
    if (this.elseFrag) {
      this.elseFrag.remove();
      this.elseFrag = null;
    }
    // lazy init factory
    if (!this.factory) {
      this.factory = new FragmentFactory(this.vm, this.el);
    }
    this.frag = this.factory.create(this._host, this._scope, this._frag);
    this.frag.before(this.anchor);
  },

  remove: function remove() {
    if (this.frag) {
      this.frag.remove();
      this.frag = null;
    }
    if (this.elseEl && !this.elseFrag) {
      if (!this.elseFactory) {
        this.elseFactory = new FragmentFactory(this.elseEl._context || this.vm, this.elseEl);
      }
      this.elseFrag = this.elseFactory.create(this._host, this._scope, this._frag);
      this.elseFrag.before(this.anchor);
    }
  },

  unbind: function unbind() {
    if (this.frag) {
      this.frag.destroy();
    }
    if (this.elseFrag) {
      this.elseFrag.destroy();
    }
  }
};

var show = {

  bind: function bind() {
    // check else block
    var next = this.el.nextElementSibling;
    if (next && getAttr(next, 'v-else') !== null) {
      this.elseEl = next;
    }
  },

  update: function update(value) {
    this.apply(this.el, value);
    if (this.elseEl) {
      this.apply(this.elseEl, !value);
    }
  },

  apply: function apply(el, value) {
    if (inDoc(el)) {
      applyTransition(el, value ? 1 : -1, toggle, this.vm);
    } else {
      toggle();
    }
    function toggle() {
      el.style.display = value ? '' : 'none';
    }
  }
};

var text$2 = {

  bind: function bind() {
    var self = this;
    var el = this.el;
    var isRange = el.type === 'range';
    var lazy = this.params.lazy;
    var number = this.params.number;
    var debounce = this.params.debounce;

    // handle composition events.
    //   http://blog.evanyou.me/2014/01/03/composition-event/
    // skip this for Android because it handles composition
    // events quite differently. Android doesn't trigger
    // composition events for language input methods e.g.
    // Chinese, but instead triggers them for spelling
    // suggestions... (see Discussion/#162)
    var composing = false;
    if (!isAndroid && !isRange) {
      this.on('compositionstart', function () {
        composing = true;
      });
      this.on('compositionend', function () {
        composing = false;
        // in IE11 the "compositionend" event fires AFTER
        // the "input" event, so the input handler is blocked
        // at the end... have to call it here.
        //
        // #1327: in lazy mode this is unecessary.
        if (!lazy) {
          self.listener();
        }
      });
    }

    // prevent messing with the input when user is typing,
    // and force update on blur.
    this.focused = false;
    if (!isRange && !lazy) {
      this.on('focus', function () {
        self.focused = true;
      });
      this.on('blur', function () {
        self.focused = false;
        // do not sync value after fragment removal (#2017)
        if (!self._frag || self._frag.inserted) {
          self.rawListener();
        }
      });
    }

    // Now attach the main listener
    this.listener = this.rawListener = function () {
      if (composing || !self._bound) {
        return;
      }
      var val = number || isRange ? toNumber(el.value) : el.value;
      self.set(val);
      // force update on next tick to avoid lock & same value
      // also only update when user is not typing
      nextTick(function () {
        if (self._bound && !self.focused) {
          self.update(self._watcher.value);
        }
      });
    };

    // apply debounce
    if (debounce) {
      this.listener = _debounce(this.listener, debounce);
    }

    // Support jQuery events, since jQuery.trigger() doesn't
    // trigger native events in some cases and some plugins
    // rely on $.trigger()
    //
    // We want to make sure if a listener is attached using
    // jQuery, it is also removed with jQuery, that's why
    // we do the check for each directive instance and
    // store that check result on itself. This also allows
    // easier test coverage control by unsetting the global
    // jQuery variable in tests.
    this.hasjQuery = typeof jQuery === 'function';
    if (this.hasjQuery) {
      var method = jQuery.fn.on ? 'on' : 'bind';
      jQuery(el)[method]('change', this.rawListener);
      if (!lazy) {
        jQuery(el)[method]('input', this.listener);
      }
    } else {
      this.on('change', this.rawListener);
      if (!lazy) {
        this.on('input', this.listener);
      }
    }

    // IE9 doesn't fire input event on backspace/del/cut
    if (!lazy && isIE9) {
      this.on('cut', function () {
        nextTick(self.listener);
      });
      this.on('keyup', function (e) {
        if (e.keyCode === 46 || e.keyCode === 8) {
          self.listener();
        }
      });
    }

    // set initial value if present
    if (el.hasAttribute('value') || el.tagName === 'TEXTAREA' && el.value.trim()) {
      this.afterBind = this.listener;
    }
  },

  update: function update(value) {
    // #3029 only update when the value changes. This prevent
    // browsers from overwriting values like selectionStart
    value = _toString(value);
    if (value !== this.el.value) this.el.value = value;
  },

  unbind: function unbind() {
    var el = this.el;
    if (this.hasjQuery) {
      var method = jQuery.fn.off ? 'off' : 'unbind';
      jQuery(el)[method]('change', this.listener);
      jQuery(el)[method]('input', this.listener);
    }
  }
};

var radio = {

  bind: function bind() {
    var self = this;
    var el = this.el;

    this.getValue = function () {
      // value overwrite via v-bind:value
      if (el.hasOwnProperty('_value')) {
        return el._value;
      }
      var val = el.value;
      if (self.params.number) {
        val = toNumber(val);
      }
      return val;
    };

    this.listener = function () {
      self.set(self.getValue());
    };
    this.on('change', this.listener);

    if (el.hasAttribute('checked')) {
      this.afterBind = this.listener;
    }
  },

  update: function update(value) {
    this.el.checked = looseEqual(value, this.getValue());
  }
};

var select = {

  bind: function bind() {
    var _this = this;

    var self = this;
    var el = this.el;

    // method to force update DOM using latest value.
    this.forceUpdate = function () {
      if (self._watcher) {
        self.update(self._watcher.get());
      }
    };

    // check if this is a multiple select
    var multiple = this.multiple = el.hasAttribute('multiple');

    // attach listener
    this.listener = function () {
      var value = getValue(el, multiple);
      value = self.params.number ? isArray(value) ? value.map(toNumber) : toNumber(value) : value;
      self.set(value);
    };
    this.on('change', this.listener);

    // if has initial value, set afterBind
    var initValue = getValue(el, multiple, true);
    if (multiple && initValue.length || !multiple && initValue !== null) {
      this.afterBind = this.listener;
    }

    // All major browsers except Firefox resets
    // selectedIndex with value -1 to 0 when the element
    // is appended to a new parent, therefore we have to
    // force a DOM update whenever that happens...
    this.vm.$on('hook:attached', function () {
      nextTick(_this.forceUpdate);
    });
    if (!inDoc(el)) {
      nextTick(this.forceUpdate);
    }
  },

  update: function update(value) {
    var el = this.el;
    el.selectedIndex = -1;
    var multi = this.multiple && isArray(value);
    var options = el.options;
    var i = options.length;
    var op, val;
    while (i--) {
      op = options[i];
      val = op.hasOwnProperty('_value') ? op._value : op.value;
      /* eslint-disable eqeqeq */
      op.selected = multi ? indexOf$1(value, val) > -1 : looseEqual(value, val);
      /* eslint-enable eqeqeq */
    }
  },

  unbind: function unbind() {
    /* istanbul ignore next */
    this.vm.$off('hook:attached', this.forceUpdate);
  }
};

/**
 * Get select value
 *
 * @param {SelectElement} el
 * @param {Boolean} multi
 * @param {Boolean} init
 * @return {Array|*}
 */

function getValue(el, multi, init) {
  var res = multi ? [] : null;
  var op, val, selected;
  for (var i = 0, l = el.options.length; i < l; i++) {
    op = el.options[i];
    selected = init ? op.hasAttribute('selected') : op.selected;
    if (selected) {
      val = op.hasOwnProperty('_value') ? op._value : op.value;
      if (multi) {
        res.push(val);
      } else {
        return val;
      }
    }
  }
  return res;
}

/**
 * Native Array.indexOf uses strict equal, but in this
 * case we need to match string/numbers with custom equal.
 *
 * @param {Array} arr
 * @param {*} val
 */

function indexOf$1(arr, val) {
  var i = arr.length;
  while (i--) {
    if (looseEqual(arr[i], val)) {
      return i;
    }
  }
  return -1;
}

var checkbox = {

  bind: function bind() {
    var self = this;
    var el = this.el;

    this.getValue = function () {
      return el.hasOwnProperty('_value') ? el._value : self.params.number ? toNumber(el.value) : el.value;
    };

    function getBooleanValue() {
      var val = el.checked;
      if (val && el.hasOwnProperty('_trueValue')) {
        return el._trueValue;
      }
      if (!val && el.hasOwnProperty('_falseValue')) {
        return el._falseValue;
      }
      return val;
    }

    this.listener = function () {
      var model = self._watcher.get();
      if (isArray(model)) {
        var val = self.getValue();
        var i = indexOf(model, val);
        if (el.checked) {
          if (i < 0) {
            self.set(model.concat(val));
          }
        } else if (i > -1) {
          self.set(model.slice(0, i).concat(model.slice(i + 1)));
        }
      } else {
        self.set(getBooleanValue());
      }
    };

    this.on('change', this.listener);
    if (el.hasAttribute('checked')) {
      this.afterBind = this.listener;
    }
  },

  update: function update(value) {
    var el = this.el;
    if (isArray(value)) {
      el.checked = indexOf(value, this.getValue()) > -1;
    } else {
      if (el.hasOwnProperty('_trueValue')) {
        el.checked = looseEqual(value, el._trueValue);
      } else {
        el.checked = !!value;
      }
    }
  }
};

var handlers = {
  text: text$2,
  radio: radio,
  select: select,
  checkbox: checkbox
};

var model = {

  priority: MODEL,
  twoWay: true,
  handlers: handlers,
  params: ['lazy', 'number', 'debounce'],

  /**
   * Possible elements:
   *   <select>
   *   <textarea>
   *   <input type="*">
   *     - text
   *     - checkbox
   *     - radio
   *     - number
   */

  bind: function bind() {
    // friendly warning...
    this.checkFilters();
    if (this.hasRead && !this.hasWrite) {
      process.env.NODE_ENV !== 'production' && warn('It seems you are using a read-only filter with ' + 'v-model="' + this.descriptor.raw + '". ' + 'You might want to use a two-way filter to ensure correct behavior.', this.vm);
    }
    var el = this.el;
    var tag = el.tagName;
    var handler;
    if (tag === 'INPUT') {
      handler = handlers[el.type] || handlers.text;
    } else if (tag === 'SELECT') {
      handler = handlers.select;
    } else if (tag === 'TEXTAREA') {
      handler = handlers.text;
    } else {
      process.env.NODE_ENV !== 'production' && warn('v-model does not support element type: ' + tag, this.vm);
      return;
    }
    el.__v_model = this;
    handler.bind.call(this);
    this.update = handler.update;
    this._unbind = handler.unbind;
  },

  /**
   * Check read/write filter stats.
   */

  checkFilters: function checkFilters() {
    var filters = this.filters;
    if (!filters) return;
    var i = filters.length;
    while (i--) {
      var filter = resolveAsset(this.vm.$options, 'filters', filters[i].name);
      if (typeof filter === 'function' || filter.read) {
        this.hasRead = true;
      }
      if (filter.write) {
        this.hasWrite = true;
      }
    }
  },

  unbind: function unbind() {
    this.el.__v_model = null;
    this._unbind && this._unbind();
  }
};

// keyCode aliases
var keyCodes = {
  esc: 27,
  tab: 9,
  enter: 13,
  space: 32,
  'delete': [8, 46],
  up: 38,
  left: 37,
  right: 39,
  down: 40
};

function keyFilter(handler, keys) {
  var codes = keys.map(function (key) {
    var charCode = key.charCodeAt(0);
    if (charCode > 47 && charCode < 58) {
      return parseInt(key, 10);
    }
    if (key.length === 1) {
      charCode = key.toUpperCase().charCodeAt(0);
      if (charCode > 64 && charCode < 91) {
        return charCode;
      }
    }
    return keyCodes[key];
  });
  codes = [].concat.apply([], codes);
  return function keyHandler(e) {
    if (codes.indexOf(e.keyCode) > -1) {
      return handler.call(this, e);
    }
  };
}

function stopFilter(handler) {
  return function stopHandler(e) {
    e.stopPropagation();
    return handler.call(this, e);
  };
}

function preventFilter(handler) {
  return function preventHandler(e) {
    e.preventDefault();
    return handler.call(this, e);
  };
}

function selfFilter(handler) {
  return function selfHandler(e) {
    if (e.target === e.currentTarget) {
      return handler.call(this, e);
    }
  };
}

var on$1 = {

  priority: ON,
  acceptStatement: true,
  keyCodes: keyCodes,

  bind: function bind() {
    // deal with iframes
    if (this.el.tagName === 'IFRAME' && this.arg !== 'load') {
      var self = this;
      this.iframeBind = function () {
        on(self.el.contentWindow, self.arg, self.handler, self.modifiers.capture);
      };
      this.on('load', this.iframeBind);
    }
  },

  update: function update(handler) {
    // stub a noop for v-on with no value,
    // e.g. @mousedown.prevent
    if (!this.descriptor.raw) {
      handler = function () {};
    }

    if (typeof handler !== 'function') {
      process.env.NODE_ENV !== 'production' && warn('v-on:' + this.arg + '="' + this.expression + '" expects a function value, ' + 'got ' + handler, this.vm);
      return;
    }

    // apply modifiers
    if (this.modifiers.stop) {
      handler = stopFilter(handler);
    }
    if (this.modifiers.prevent) {
      handler = preventFilter(handler);
    }
    if (this.modifiers.self) {
      handler = selfFilter(handler);
    }
    // key filter
    var keys = Object.keys(this.modifiers).filter(function (key) {
      return key !== 'stop' && key !== 'prevent' && key !== 'self' && key !== 'capture';
    });
    if (keys.length) {
      handler = keyFilter(handler, keys);
    }

    this.reset();
    this.handler = handler;

    if (this.iframeBind) {
      this.iframeBind();
    } else {
      on(this.el, this.arg, this.handler, this.modifiers.capture);
    }
  },

  reset: function reset() {
    var el = this.iframeBind ? this.el.contentWindow : this.el;
    if (this.handler) {
      off(el, this.arg, this.handler);
    }
  },

  unbind: function unbind() {
    this.reset();
  }
};

var prefixes = ['-webkit-', '-moz-', '-ms-'];
var camelPrefixes = ['Webkit', 'Moz', 'ms'];
var importantRE = /!important;?$/;
var propCache = Object.create(null);

var testEl = null;

var style = {

  deep: true,

  update: function update(value) {
    if (typeof value === 'string') {
      this.el.style.cssText = value;
    } else if (isArray(value)) {
      this.handleObject(value.reduce(extend, {}));
    } else {
      this.handleObject(value || {});
    }
  },

  handleObject: function handleObject(value) {
    // cache object styles so that only changed props
    // are actually updated.
    var cache = this.cache || (this.cache = {});
    var name, val;
    for (name in cache) {
      if (!(name in value)) {
        this.handleSingle(name, null);
        delete cache[name];
      }
    }
    for (name in value) {
      val = value[name];
      if (val !== cache[name]) {
        cache[name] = val;
        this.handleSingle(name, val);
      }
    }
  },

  handleSingle: function handleSingle(prop, value) {
    prop = normalize(prop);
    if (!prop) return; // unsupported prop
    // cast possible numbers/booleans into strings
    if (value != null) value += '';
    if (value) {
      var isImportant = importantRE.test(value) ? 'important' : '';
      if (isImportant) {
        /* istanbul ignore if */
        if (process.env.NODE_ENV !== 'production') {
          warn('It\'s probably a bad idea to use !important with inline rules. ' + 'This feature will be deprecated in a future version of Vue.');
        }
        value = value.replace(importantRE, '').trim();
        this.el.style.setProperty(prop.kebab, value, isImportant);
      } else {
        this.el.style[prop.camel] = value;
      }
    } else {
      this.el.style[prop.camel] = '';
    }
  }

};

/**
 * Normalize a CSS property name.
 * - cache result
 * - auto prefix
 * - camelCase -> dash-case
 *
 * @param {String} prop
 * @return {String}
 */

function normalize(prop) {
  if (propCache[prop]) {
    return propCache[prop];
  }
  var res = prefix(prop);
  propCache[prop] = propCache[res] = res;
  return res;
}

/**
 * Auto detect the appropriate prefix for a CSS property.
 * https://gist.github.com/paulirish/523692
 *
 * @param {String} prop
 * @return {String}
 */

function prefix(prop) {
  prop = hyphenate(prop);
  var camel = camelize(prop);
  var upper = camel.charAt(0).toUpperCase() + camel.slice(1);
  if (!testEl) {
    testEl = document.createElement('div');
  }
  var i = prefixes.length;
  var prefixed;
  if (camel !== 'filter' && camel in testEl.style) {
    return {
      kebab: prop,
      camel: camel
    };
  }
  while (i--) {
    prefixed = camelPrefixes[i] + upper;
    if (prefixed in testEl.style) {
      return {
        kebab: prefixes[i] + prop,
        camel: prefixed
      };
    }
  }
}

// xlink
var xlinkNS = 'http://www.w3.org/1999/xlink';
var xlinkRE = /^xlink:/;

// check for attributes that prohibit interpolations
var disallowedInterpAttrRE = /^v-|^:|^@|^(?:is|transition|transition-mode|debounce|track-by|stagger|enter-stagger|leave-stagger)$/;
// these attributes should also set their corresponding properties
// because they only affect the initial state of the element
var attrWithPropsRE = /^(?:value|checked|selected|muted)$/;
// these attributes expect enumrated values of "true" or "false"
// but are not boolean attributes
var enumeratedAttrRE = /^(?:draggable|contenteditable|spellcheck)$/;

// these attributes should set a hidden property for
// binding v-model to object values
var modelProps = {
  value: '_value',
  'true-value': '_trueValue',
  'false-value': '_falseValue'
};

var bind$1 = {

  priority: BIND,

  bind: function bind() {
    var attr = this.arg;
    var tag = this.el.tagName;
    // should be deep watch on object mode
    if (!attr) {
      this.deep = true;
    }
    // handle interpolation bindings
    var descriptor = this.descriptor;
    var tokens = descriptor.interp;
    if (tokens) {
      // handle interpolations with one-time tokens
      if (descriptor.hasOneTime) {
        this.expression = tokensToExp(tokens, this._scope || this.vm);
      }

      // only allow binding on native attributes
      if (disallowedInterpAttrRE.test(attr) || attr === 'name' && (tag === 'PARTIAL' || tag === 'SLOT')) {
        process.env.NODE_ENV !== 'production' && warn(attr + '="' + descriptor.raw + '": ' + 'attribute interpolation is not allowed in Vue.js ' + 'directives and special attributes.', this.vm);
        this.el.removeAttribute(attr);
        this.invalid = true;
      }

      /* istanbul ignore if */
      if (process.env.NODE_ENV !== 'production') {
        var raw = attr + '="' + descriptor.raw + '": ';
        // warn src
        if (attr === 'src') {
          warn(raw + 'interpolation in "src" attribute will cause ' + 'a 404 request. Use v-bind:src instead.', this.vm);
        }

        // warn style
        if (attr === 'style') {
          warn(raw + 'interpolation in "style" attribute will cause ' + 'the attribute to be discarded in Internet Explorer. ' + 'Use v-bind:style instead.', this.vm);
        }
      }
    }
  },

  update: function update(value) {
    if (this.invalid) {
      return;
    }
    var attr = this.arg;
    if (this.arg) {
      this.handleSingle(attr, value);
    } else {
      this.handleObject(value || {});
    }
  },

  // share object handler with v-bind:class
  handleObject: style.handleObject,

  handleSingle: function handleSingle(attr, value) {
    var el = this.el;
    var interp = this.descriptor.interp;
    if (this.modifiers.camel) {
      attr = camelize(attr);
    }
    if (!interp && attrWithPropsRE.test(attr) && attr in el) {
      var attrValue = attr === 'value' ? value == null // IE9 will set input.value to "null" for null...
      ? '' : value : value;

      if (el[attr] !== attrValue) {
        el[attr] = attrValue;
      }
    }
    // set model props
    var modelProp = modelProps[attr];
    if (!interp && modelProp) {
      el[modelProp] = value;
      // update v-model if present
      var model = el.__v_model;
      if (model) {
        model.listener();
      }
    }
    // do not set value attribute for textarea
    if (attr === 'value' && el.tagName === 'TEXTAREA') {
      el.removeAttribute(attr);
      return;
    }
    // update attribute
    if (enumeratedAttrRE.test(attr)) {
      el.setAttribute(attr, value ? 'true' : 'false');
    } else if (value != null && value !== false) {
      if (attr === 'class') {
        // handle edge case #1960:
        // class interpolation should not overwrite Vue transition class
        if (el.__v_trans) {
          value += ' ' + el.__v_trans.id + '-transition';
        }
        setClass(el, value);
      } else if (xlinkRE.test(attr)) {
        el.setAttributeNS(xlinkNS, attr, value === true ? '' : value);
      } else {
        el.setAttribute(attr, value === true ? '' : value);
      }
    } else {
      el.removeAttribute(attr);
    }
  }
};

var el = {

  priority: EL,

  bind: function bind() {
    /* istanbul ignore if */
    if (!this.arg) {
      return;
    }
    var id = this.id = camelize(this.arg);
    var refs = (this._scope || this.vm).$els;
    if (hasOwn(refs, id)) {
      refs[id] = this.el;
    } else {
      defineReactive(refs, id, this.el);
    }
  },

  unbind: function unbind() {
    var refs = (this._scope || this.vm).$els;
    if (refs[this.id] === this.el) {
      refs[this.id] = null;
    }
  }
};

var ref = {
  bind: function bind() {
    process.env.NODE_ENV !== 'production' && warn('v-ref:' + this.arg + ' must be used on a child ' + 'component. Found on <' + this.el.tagName.toLowerCase() + '>.', this.vm);
  }
};

var cloak = {
  bind: function bind() {
    var el = this.el;
    this.vm.$once('pre-hook:compiled', function () {
      el.removeAttribute('v-cloak');
    });
  }
};

// logic control
// two-way binding
// event handling
// attributes
// ref & el
// cloak
// must export plain object
var directives = {
  text: text$1,
  html: html,
  'for': vFor,
  'if': vIf,
  show: show,
  model: model,
  on: on$1,
  bind: bind$1,
  el: el,
  ref: ref,
  cloak: cloak
};

var vClass = {

  deep: true,

  update: function update(value) {
    if (!value) {
      this.cleanup();
    } else if (typeof value === 'string') {
      this.setClass(value.trim().split(/\s+/));
    } else {
      this.setClass(normalize$1(value));
    }
  },

  setClass: function setClass(value) {
    this.cleanup(value);
    for (var i = 0, l = value.length; i < l; i++) {
      var val = value[i];
      if (val) {
        apply(this.el, val, addClass);
      }
    }
    this.prevKeys = value;
  },

  cleanup: function cleanup(value) {
    var prevKeys = this.prevKeys;
    if (!prevKeys) return;
    var i = prevKeys.length;
    while (i--) {
      var key = prevKeys[i];
      if (!value || value.indexOf(key) < 0) {
        apply(this.el, key, removeClass);
      }
    }
  }
};

/**
 * Normalize objects and arrays (potentially containing objects)
 * into array of strings.
 *
 * @param {Object|Array<String|Object>} value
 * @return {Array<String>}
 */

function normalize$1(value) {
  var res = [];
  if (isArray(value)) {
    for (var i = 0, l = value.length; i < l; i++) {
      var _key = value[i];
      if (_key) {
        if (typeof _key === 'string') {
          res.push(_key);
        } else {
          for (var k in _key) {
            if (_key[k]) res.push(k);
          }
        }
      }
    }
  } else if (isObject(value)) {
    for (var key in value) {
      if (value[key]) res.push(key);
    }
  }
  return res;
}

/**
 * Add or remove a class/classes on an element
 *
 * @param {Element} el
 * @param {String} key The class name. This may or may not
 *                     contain a space character, in such a
 *                     case we'll deal with multiple class
 *                     names at once.
 * @param {Function} fn
 */

function apply(el, key, fn) {
  key = key.trim();
  if (key.indexOf(' ') === -1) {
    fn(el, key);
    return;
  }
  // The key contains one or more space characters.
  // Since a class name doesn't accept such characters, we
  // treat it as multiple classes.
  var keys = key.split(/\s+/);
  for (var i = 0, l = keys.length; i < l; i++) {
    fn(el, keys[i]);
  }
}

var component = {

  priority: COMPONENT,

  params: ['keep-alive', 'transition-mode', 'inline-template'],

  /**
   * Setup. Two possible usages:
   *
   * - static:
   *   <comp> or <div v-component="comp">
   *
   * - dynamic:
   *   <component :is="view">
   */

  bind: function bind() {
    if (!this.el.__vue__) {
      // keep-alive cache
      this.keepAlive = this.params.keepAlive;
      if (this.keepAlive) {
        this.cache = {};
      }
      // check inline-template
      if (this.params.inlineTemplate) {
        // extract inline template as a DocumentFragment
        this.inlineTemplate = extractContent(this.el, true);
      }
      // component resolution related state
      this.pendingComponentCb = this.Component = null;
      // transition related state
      this.pendingRemovals = 0;
      this.pendingRemovalCb = null;
      // create a ref anchor
      this.anchor = createAnchor('v-component');
      replace(this.el, this.anchor);
      // remove is attribute.
      // this is removed during compilation, but because compilation is
      // cached, when the component is used elsewhere this attribute
      // will remain at link time.
      this.el.removeAttribute('is');
      this.el.removeAttribute(':is');
      // remove ref, same as above
      if (this.descriptor.ref) {
        this.el.removeAttribute('v-ref:' + hyphenate(this.descriptor.ref));
      }
      // if static, build right now.
      if (this.literal) {
        this.setComponent(this.expression);
      }
    } else {
      process.env.NODE_ENV !== 'production' && warn('cannot mount component "' + this.expression + '" ' + 'on already mounted element: ' + this.el);
    }
  },

  /**
   * Public update, called by the watcher in the dynamic
   * literal scenario, e.g. <component :is="view">
   */

  update: function update(value) {
    if (!this.literal) {
      this.setComponent(value);
    }
  },

  /**
   * Switch dynamic components. May resolve the component
   * asynchronously, and perform transition based on
   * specified transition mode. Accepts a few additional
   * arguments specifically for vue-router.
   *
   * The callback is called when the full transition is
   * finished.
   *
   * @param {String} value
   * @param {Function} [cb]
   */

  setComponent: function setComponent(value, cb) {
    this.invalidatePending();
    if (!value) {
      // just remove current
      this.unbuild(true);
      this.remove(this.childVM, cb);
      this.childVM = null;
    } else {
      var self = this;
      this.resolveComponent(value, function () {
        self.mountComponent(cb);
      });
    }
  },

  /**
   * Resolve the component constructor to use when creating
   * the child vm.
   *
   * @param {String|Function} value
   * @param {Function} cb
   */

  resolveComponent: function resolveComponent(value, cb) {
    var self = this;
    this.pendingComponentCb = cancellable(function (Component) {
      self.ComponentName = Component.options.name || (typeof value === 'string' ? value : null);
      self.Component = Component;
      cb();
    });
    this.vm._resolveComponent(value, this.pendingComponentCb);
  },

  /**
   * Create a new instance using the current constructor and
   * replace the existing instance. This method doesn't care
   * whether the new component and the old one are actually
   * the same.
   *
   * @param {Function} [cb]
   */

  mountComponent: function mountComponent(cb) {
    // actual mount
    this.unbuild(true);
    var self = this;
    var activateHooks = this.Component.options.activate;
    var cached = this.getCached();
    var newComponent = this.build();
    if (activateHooks && !cached) {
      this.waitingFor = newComponent;
      callActivateHooks(activateHooks, newComponent, function () {
        if (self.waitingFor !== newComponent) {
          return;
        }
        self.waitingFor = null;
        self.transition(newComponent, cb);
      });
    } else {
      // update ref for kept-alive component
      if (cached) {
        newComponent._updateRef();
      }
      this.transition(newComponent, cb);
    }
  },

  /**
   * When the component changes or unbinds before an async
   * constructor is resolved, we need to invalidate its
   * pending callback.
   */

  invalidatePending: function invalidatePending() {
    if (this.pendingComponentCb) {
      this.pendingComponentCb.cancel();
      this.pendingComponentCb = null;
    }
  },

  /**
   * Instantiate/insert a new child vm.
   * If keep alive and has cached instance, insert that
   * instance; otherwise build a new one and cache it.
   *
   * @param {Object} [extraOptions]
   * @return {Vue} - the created instance
   */

  build: function build(extraOptions) {
    var cached = this.getCached();
    if (cached) {
      return cached;
    }
    if (this.Component) {
      // default options
      var options = {
        name: this.ComponentName,
        el: cloneNode(this.el),
        template: this.inlineTemplate,
        // make sure to add the child with correct parent
        // if this is a transcluded component, its parent
        // should be the transclusion host.
        parent: this._host || this.vm,
        // if no inline-template, then the compiled
        // linker can be cached for better performance.
        _linkerCachable: !this.inlineTemplate,
        _ref: this.descriptor.ref,
        _asComponent: true,
        _isRouterView: this._isRouterView,
        // if this is a transcluded component, context
        // will be the common parent vm of this instance
        // and its host.
        _context: this.vm,
        // if this is inside an inline v-for, the scope
        // will be the intermediate scope created for this
        // repeat fragment. this is used for linking props
        // and container directives.
        _scope: this._scope,
        // pass in the owner fragment of this component.
        // this is necessary so that the fragment can keep
        // track of its contained components in order to
        // call attach/detach hooks for them.
        _frag: this._frag
      };
      // extra options
      // in 1.0.0 this is used by vue-router only
      /* istanbul ignore if */
      if (extraOptions) {
        extend(options, extraOptions);
      }
      var child = new this.Component(options);
      if (this.keepAlive) {
        this.cache[this.Component.cid] = child;
      }
      /* istanbul ignore if */
      if (process.env.NODE_ENV !== 'production' && this.el.hasAttribute('transition') && child._isFragment) {
        warn('Transitions will not work on a fragment instance. ' + 'Template: ' + child.$options.template, child);
      }
      return child;
    }
  },

  /**
   * Try to get a cached instance of the current component.
   *
   * @return {Vue|undefined}
   */

  getCached: function getCached() {
    return this.keepAlive && this.cache[this.Component.cid];
  },

  /**
   * Teardown the current child, but defers cleanup so
   * that we can separate the destroy and removal steps.
   *
   * @param {Boolean} defer
   */

  unbuild: function unbuild(defer) {
    if (this.waitingFor) {
      if (!this.keepAlive) {
        this.waitingFor.$destroy();
      }
      this.waitingFor = null;
    }
    var child = this.childVM;
    if (!child || this.keepAlive) {
      if (child) {
        // remove ref
        child._inactive = true;
        child._updateRef(true);
      }
      return;
    }
    // the sole purpose of `deferCleanup` is so that we can
    // "deactivate" the vm right now and perform DOM removal
    // later.
    child.$destroy(false, defer);
  },

  /**
   * Remove current destroyed child and manually do
   * the cleanup after removal.
   *
   * @param {Function} cb
   */

  remove: function remove(child, cb) {
    var keepAlive = this.keepAlive;
    if (child) {
      // we may have a component switch when a previous
      // component is still being transitioned out.
      // we want to trigger only one lastest insertion cb
      // when the existing transition finishes. (#1119)
      this.pendingRemovals++;
      this.pendingRemovalCb = cb;
      var self = this;
      child.$remove(function () {
        self.pendingRemovals--;
        if (!keepAlive) child._cleanup();
        if (!self.pendingRemovals && self.pendingRemovalCb) {
          self.pendingRemovalCb();
          self.pendingRemovalCb = null;
        }
      });
    } else if (cb) {
      cb();
    }
  },

  /**
   * Actually swap the components, depending on the
   * transition mode. Defaults to simultaneous.
   *
   * @param {Vue} target
   * @param {Function} [cb]
   */

  transition: function transition(target, cb) {
    var self = this;
    var current = this.childVM;
    // for devtool inspection
    if (current) current._inactive = true;
    target._inactive = false;
    this.childVM = target;
    switch (self.params.transitionMode) {
      case 'in-out':
        target.$before(self.anchor, function () {
          self.remove(current, cb);
        });
        break;
      case 'out-in':
        self.remove(current, function () {
          target.$before(self.anchor, cb);
        });
        break;
      default:
        self.remove(current);
        target.$before(self.anchor, cb);
    }
  },

  /**
   * Unbind.
   */

  unbind: function unbind() {
    this.invalidatePending();
    // Do not defer cleanup when unbinding
    this.unbuild();
    // destroy all keep-alive cached instances
    if (this.cache) {
      for (var key in this.cache) {
        this.cache[key].$destroy();
      }
      this.cache = null;
    }
  }
};

/**
 * Call activate hooks in order (asynchronous)
 *
 * @param {Array} hooks
 * @param {Vue} vm
 * @param {Function} cb
 */

function callActivateHooks(hooks, vm, cb) {
  var total = hooks.length;
  var called = 0;
  hooks[0].call(vm, next);
  function next() {
    if (++called >= total) {
      cb();
    } else {
      hooks[called].call(vm, next);
    }
  }
}

var propBindingModes = config._propBindingModes;
var empty = {};

// regexes
var identRE$1 = /^[$_a-zA-Z]+[\w$]*$/;
var settablePathRE = /^[A-Za-z_$][\w$]*(\.[A-Za-z_$][\w$]*|\[[^\[\]]+\])*$/;

/**
 * Compile props on a root element and return
 * a props link function.
 *
 * @param {Element|DocumentFragment} el
 * @param {Array} propOptions
 * @param {Vue} vm
 * @return {Function} propsLinkFn
 */

function compileProps(el, propOptions, vm) {
  var props = [];
  var propsData = vm.$options.propsData;
  var names = Object.keys(propOptions);
  var i = names.length;
  var options, name, attr, value, path, parsed, prop;
  while (i--) {
    name = names[i];
    options = propOptions[name] || empty;

    if (process.env.NODE_ENV !== 'production' && name === '$data') {
      warn('Do not use $data as prop.', vm);
      continue;
    }

    // props could contain dashes, which will be
    // interpreted as minus calculations by the parser
    // so we need to camelize the path here
    path = camelize(name);
    if (!identRE$1.test(path)) {
      process.env.NODE_ENV !== 'production' && warn('Invalid prop key: "' + name + '". Prop keys ' + 'must be valid identifiers.', vm);
      continue;
    }

    prop = {
      name: name,
      path: path,
      options: options,
      mode: propBindingModes.ONE_WAY,
      raw: null
    };

    attr = hyphenate(name);
    // first check dynamic version
    if ((value = getBindAttr(el, attr)) === null) {
      if ((value = getBindAttr(el, attr + '.sync')) !== null) {
        prop.mode = propBindingModes.TWO_WAY;
      } else if ((value = getBindAttr(el, attr + '.once')) !== null) {
        prop.mode = propBindingModes.ONE_TIME;
      }
    }
    if (value !== null) {
      // has dynamic binding!
      prop.raw = value;
      parsed = parseDirective(value);
      value = parsed.expression;
      prop.filters = parsed.filters;
      // check binding type
      if (isLiteral(value) && !parsed.filters) {
        // for expressions containing literal numbers and
        // booleans, there's no need to setup a prop binding,
        // so we can optimize them as a one-time set.
        prop.optimizedLiteral = true;
      } else {
        prop.dynamic = true;
        // check non-settable path for two-way bindings
        if (process.env.NODE_ENV !== 'production' && prop.mode === propBindingModes.TWO_WAY && !settablePathRE.test(value)) {
          prop.mode = propBindingModes.ONE_WAY;
          warn('Cannot bind two-way prop with non-settable ' + 'parent path: ' + value, vm);
        }
      }
      prop.parentPath = value;

      // warn required two-way
      if (process.env.NODE_ENV !== 'production' && options.twoWay && prop.mode !== propBindingModes.TWO_WAY) {
        warn('Prop "' + name + '" expects a two-way binding type.', vm);
      }
    } else if ((value = getAttr(el, attr)) !== null) {
      // has literal binding!
      prop.raw = value;
    } else if (propsData && (value = propsData[name] || propsData[path]) !== null) {
      // has propsData
      prop.raw = value;
    } else if (process.env.NODE_ENV !== 'production') {
      // check possible camelCase prop usage
      var lowerCaseName = path.toLowerCase();
      value = /[A-Z\-]/.test(name) && (el.getAttribute(lowerCaseName) || el.getAttribute(':' + lowerCaseName) || el.getAttribute('v-bind:' + lowerCaseName) || el.getAttribute(':' + lowerCaseName + '.once') || el.getAttribute('v-bind:' + lowerCaseName + '.once') || el.getAttribute(':' + lowerCaseName + '.sync') || el.getAttribute('v-bind:' + lowerCaseName + '.sync'));
      if (value) {
        warn('Possible usage error for prop `' + lowerCaseName + '` - ' + 'did you mean `' + attr + '`? HTML is case-insensitive, remember to use ' + 'kebab-case for props in templates.', vm);
      } else if (options.required && (!propsData || !(name in propsData) && !(path in propsData))) {
        // warn missing required
        warn('Missing required prop: ' + name, vm);
      }
    }
    // push prop
    props.push(prop);
  }
  return makePropsLinkFn(props);
}

/**
 * Build a function that applies props to a vm.
 *
 * @param {Array} props
 * @return {Function} propsLinkFn
 */

function makePropsLinkFn(props) {
  return function propsLinkFn(vm, scope) {
    // store resolved props info
    vm._props = {};
    var inlineProps = vm.$options.propsData;
    var i = props.length;
    var prop, path, options, value, raw;
    while (i--) {
      prop = props[i];
      raw = prop.raw;
      path = prop.path;
      options = prop.options;
      vm._props[path] = prop;
      if (inlineProps && hasOwn(inlineProps, path)) {
        initProp(vm, prop, inlineProps[path]);
      }if (raw === null) {
        // initialize absent prop
        initProp(vm, prop, undefined);
      } else if (prop.dynamic) {
        // dynamic prop
        if (prop.mode === propBindingModes.ONE_TIME) {
          // one time binding
          value = (scope || vm._context || vm).$get(prop.parentPath);
          initProp(vm, prop, value);
        } else {
          if (vm._context) {
            // dynamic binding
            vm._bindDir({
              name: 'prop',
              def: propDef,
              prop: prop
            }, null, null, scope); // el, host, scope
          } else {
              // root instance
              initProp(vm, prop, vm.$get(prop.parentPath));
            }
        }
      } else if (prop.optimizedLiteral) {
        // optimized literal, cast it and just set once
        var stripped = stripQuotes(raw);
        value = stripped === raw ? toBoolean(toNumber(raw)) : stripped;
        initProp(vm, prop, value);
      } else {
        // string literal, but we need to cater for
        // Boolean props with no value, or with same
        // literal value (e.g. disabled="disabled")
        // see https://github.com/vuejs/vue-loader/issues/182
        value = options.type === Boolean && (raw === '' || raw === hyphenate(prop.name)) ? true : raw;
        initProp(vm, prop, value);
      }
    }
  };
}

/**
 * Process a prop with a rawValue, applying necessary coersions,
 * default values & assertions and call the given callback with
 * processed value.
 *
 * @param {Vue} vm
 * @param {Object} prop
 * @param {*} rawValue
 * @param {Function} fn
 */

function processPropValue(vm, prop, rawValue, fn) {
  var isSimple = prop.dynamic && isSimplePath(prop.parentPath);
  var value = rawValue;
  if (value === undefined) {
    value = getPropDefaultValue(vm, prop);
  }
  value = coerceProp(prop, value, vm);
  var coerced = value !== rawValue;
  if (!assertProp(prop, value, vm)) {
    value = undefined;
  }
  if (isSimple && !coerced) {
    withoutConversion(function () {
      fn(value);
    });
  } else {
    fn(value);
  }
}

/**
 * Set a prop's initial value on a vm and its data object.
 *
 * @param {Vue} vm
 * @param {Object} prop
 * @param {*} value
 */

function initProp(vm, prop, value) {
  processPropValue(vm, prop, value, function (value) {
    defineReactive(vm, prop.path, value);
  });
}

/**
 * Update a prop's value on a vm.
 *
 * @param {Vue} vm
 * @param {Object} prop
 * @param {*} value
 */

function updateProp(vm, prop, value) {
  processPropValue(vm, prop, value, function (value) {
    vm[prop.path] = value;
  });
}

/**
 * Get the default value of a prop.
 *
 * @param {Vue} vm
 * @param {Object} prop
 * @return {*}
 */

function getPropDefaultValue(vm, prop) {
  // no default, return undefined
  var options = prop.options;
  if (!hasOwn(options, 'default')) {
    // absent boolean value defaults to false
    return options.type === Boolean ? false : undefined;
  }
  var def = options['default'];
  // warn against non-factory defaults for Object & Array
  if (isObject(def)) {
    process.env.NODE_ENV !== 'production' && warn('Invalid default value for prop "' + prop.name + '": ' + 'Props with type Object/Array must use a factory function ' + 'to return the default value.', vm);
  }
  // call factory function for non-Function types
  return typeof def === 'function' && options.type !== Function ? def.call(vm) : def;
}

/**
 * Assert whether a prop is valid.
 *
 * @param {Object} prop
 * @param {*} value
 * @param {Vue} vm
 */

function assertProp(prop, value, vm) {
  if (!prop.options.required && ( // non-required
  prop.raw === null || // abscent
  value == null) // null or undefined
  ) {
      return true;
    }
  var options = prop.options;
  var type = options.type;
  var valid = !type;
  var expectedTypes = [];
  if (type) {
    if (!isArray(type)) {
      type = [type];
    }
    for (var i = 0; i < type.length && !valid; i++) {
      var assertedType = assertType(value, type[i]);
      expectedTypes.push(assertedType.expectedType);
      valid = assertedType.valid;
    }
  }
  if (!valid) {
    if (process.env.NODE_ENV !== 'production') {
      warn('Invalid prop: type check failed for prop "' + prop.name + '".' + ' Expected ' + expectedTypes.map(formatType).join(', ') + ', got ' + formatValue(value) + '.', vm);
    }
    return false;
  }
  var validator = options.validator;
  if (validator) {
    if (!validator(value)) {
      process.env.NODE_ENV !== 'production' && warn('Invalid prop: custom validator check failed for prop "' + prop.name + '".', vm);
      return false;
    }
  }
  return true;
}

/**
 * Force parsing value with coerce option.
 *
 * @param {*} value
 * @param {Object} options
 * @return {*}
 */

function coerceProp(prop, value, vm) {
  var coerce = prop.options.coerce;
  if (!coerce) {
    return value;
  }
  if (typeof coerce === 'function') {
    return coerce(value);
  } else {
    process.env.NODE_ENV !== 'production' && warn('Invalid coerce for prop "' + prop.name + '": expected function, got ' + typeof coerce + '.', vm);
    return value;
  }
}

/**
 * Assert the type of a value
 *
 * @param {*} value
 * @param {Function} type
 * @return {Object}
 */

function assertType(value, type) {
  var valid;
  var expectedType;
  if (type === String) {
    expectedType = 'string';
    valid = typeof value === expectedType;
  } else if (type === Number) {
    expectedType = 'number';
    valid = typeof value === expectedType;
  } else if (type === Boolean) {
    expectedType = 'boolean';
    valid = typeof value === expectedType;
  } else if (type === Function) {
    expectedType = 'function';
    valid = typeof value === expectedType;
  } else if (type === Object) {
    expectedType = 'object';
    valid = isPlainObject(value);
  } else if (type === Array) {
    expectedType = 'array';
    valid = isArray(value);
  } else {
    valid = value instanceof type;
  }
  return {
    valid: valid,
    expectedType: expectedType
  };
}

/**
 * Format type for output
 *
 * @param {String} type
 * @return {String}
 */

function formatType(type) {
  return type ? type.charAt(0).toUpperCase() + type.slice(1) : 'custom type';
}

/**
 * Format value
 *
 * @param {*} value
 * @return {String}
 */

function formatValue(val) {
  return Object.prototype.toString.call(val).slice(8, -1);
}

var bindingModes = config._propBindingModes;

var propDef = {

  bind: function bind() {
    var child = this.vm;
    var parent = child._context;
    // passed in from compiler directly
    var prop = this.descriptor.prop;
    var childKey = prop.path;
    var parentKey = prop.parentPath;
    var twoWay = prop.mode === bindingModes.TWO_WAY;

    var parentWatcher = this.parentWatcher = new Watcher(parent, parentKey, function (val) {
      updateProp(child, prop, val);
    }, {
      twoWay: twoWay,
      filters: prop.filters,
      // important: props need to be observed on the
      // v-for scope if present
      scope: this._scope
    });

    // set the child initial value.
    initProp(child, prop, parentWatcher.value);

    // setup two-way binding
    if (twoWay) {
      // important: defer the child watcher creation until
      // the created hook (after data observation)
      var self = this;
      child.$once('pre-hook:created', function () {
        self.childWatcher = new Watcher(child, childKey, function (val) {
          parentWatcher.set(val);
        }, {
          // ensure sync upward before parent sync down.
          // this is necessary in cases e.g. the child
          // mutates a prop array, then replaces it. (#1683)
          sync: true
        });
      });
    }
  },

  unbind: function unbind() {
    this.parentWatcher.teardown();
    if (this.childWatcher) {
      this.childWatcher.teardown();
    }
  }
};

var queue$1 = [];
var queued = false;

/**
 * Push a job into the queue.
 *
 * @param {Function} job
 */

function pushJob(job) {
  queue$1.push(job);
  if (!queued) {
    queued = true;
    nextTick(flush);
  }
}

/**
 * Flush the queue, and do one forced reflow before
 * triggering transitions.
 */

function flush() {
  // Force layout
  var f = document.documentElement.offsetHeight;
  for (var i = 0; i < queue$1.length; i++) {
    queue$1[i]();
  }
  queue$1 = [];
  queued = false;
  // dummy return, so js linters don't complain about
  // unused variable f
  return f;
}

var TYPE_TRANSITION = 'transition';
var TYPE_ANIMATION = 'animation';
var transDurationProp = transitionProp + 'Duration';
var animDurationProp = animationProp + 'Duration';

/**
 * If a just-entered element is applied the
 * leave class while its enter transition hasn't started yet,
 * and the transitioned property has the same value for both
 * enter/leave, then the leave transition will be skipped and
 * the transitionend event never fires. This function ensures
 * its callback to be called after a transition has started
 * by waiting for double raf.
 *
 * It falls back to setTimeout on devices that support CSS
 * transitions but not raf (e.g. Android 4.2 browser) - since
 * these environments are usually slow, we are giving it a
 * relatively large timeout.
 */

var raf = inBrowser && window.requestAnimationFrame;
var waitForTransitionStart = raf
/* istanbul ignore next */
? function (fn) {
  raf(function () {
    raf(fn);
  });
} : function (fn) {
  setTimeout(fn, 50);
};

/**
 * A Transition object that encapsulates the state and logic
 * of the transition.
 *
 * @param {Element} el
 * @param {String} id
 * @param {Object} hooks
 * @param {Vue} vm
 */
function Transition(el, id, hooks, vm) {
  this.id = id;
  this.el = el;
  this.enterClass = hooks && hooks.enterClass || id + '-enter';
  this.leaveClass = hooks && hooks.leaveClass || id + '-leave';
  this.hooks = hooks;
  this.vm = vm;
  // async state
  this.pendingCssEvent = this.pendingCssCb = this.cancel = this.pendingJsCb = this.op = this.cb = null;
  this.justEntered = false;
  this.entered = this.left = false;
  this.typeCache = {};
  // check css transition type
  this.type = hooks && hooks.type;
  /* istanbul ignore if */
  if (process.env.NODE_ENV !== 'production') {
    if (this.type && this.type !== TYPE_TRANSITION && this.type !== TYPE_ANIMATION) {
      warn('invalid CSS transition type for transition="' + this.id + '": ' + this.type, vm);
    }
  }
  // bind
  var self = this;['enterNextTick', 'enterDone', 'leaveNextTick', 'leaveDone'].forEach(function (m) {
    self[m] = bind(self[m], self);
  });
}

var p$1 = Transition.prototype;

/**
 * Start an entering transition.
 *
 * 1. enter transition triggered
 * 2. call beforeEnter hook
 * 3. add enter class
 * 4. insert/show element
 * 5. call enter hook (with possible explicit js callback)
 * 6. reflow
 * 7. based on transition type:
 *    - transition:
 *        remove class now, wait for transitionend,
 *        then done if there's no explicit js callback.
 *    - animation:
 *        wait for animationend, remove class,
 *        then done if there's no explicit js callback.
 *    - no css transition:
 *        done now if there's no explicit js callback.
 * 8. wait for either done or js callback, then call
 *    afterEnter hook.
 *
 * @param {Function} op - insert/show the element
 * @param {Function} [cb]
 */

p$1.enter = function (op, cb) {
  this.cancelPending();
  this.callHook('beforeEnter');
  this.cb = cb;
  addClass(this.el, this.enterClass);
  op();
  this.entered = false;
  this.callHookWithCb('enter');
  if (this.entered) {
    return; // user called done synchronously.
  }
  this.cancel = this.hooks && this.hooks.enterCancelled;
  pushJob(this.enterNextTick);
};

/**
 * The "nextTick" phase of an entering transition, which is
 * to be pushed into a queue and executed after a reflow so
 * that removing the class can trigger a CSS transition.
 */

p$1.enterNextTick = function () {
  var _this = this;

  // prevent transition skipping
  this.justEntered = true;
  waitForTransitionStart(function () {
    _this.justEntered = false;
  });
  var enterDone = this.enterDone;
  var type = this.getCssTransitionType(this.enterClass);
  if (!this.pendingJsCb) {
    if (type === TYPE_TRANSITION) {
      // trigger transition by removing enter class now
      removeClass(this.el, this.enterClass);
      this.setupCssCb(transitionEndEvent, enterDone);
    } else if (type === TYPE_ANIMATION) {
      this.setupCssCb(animationEndEvent, enterDone);
    } else {
      enterDone();
    }
  } else if (type === TYPE_TRANSITION) {
    removeClass(this.el, this.enterClass);
  }
};

/**
 * The "cleanup" phase of an entering transition.
 */

p$1.enterDone = function () {
  this.entered = true;
  this.cancel = this.pendingJsCb = null;
  removeClass(this.el, this.enterClass);
  this.callHook('afterEnter');
  if (this.cb) this.cb();
};

/**
 * Start a leaving transition.
 *
 * 1. leave transition triggered.
 * 2. call beforeLeave hook
 * 3. add leave class (trigger css transition)
 * 4. call leave hook (with possible explicit js callback)
 * 5. reflow if no explicit js callback is provided
 * 6. based on transition type:
 *    - transition or animation:
 *        wait for end event, remove class, then done if
 *        there's no explicit js callback.
 *    - no css transition:
 *        done if there's no explicit js callback.
 * 7. wait for either done or js callback, then call
 *    afterLeave hook.
 *
 * @param {Function} op - remove/hide the element
 * @param {Function} [cb]
 */

p$1.leave = function (op, cb) {
  this.cancelPending();
  this.callHook('beforeLeave');
  this.op = op;
  this.cb = cb;
  addClass(this.el, this.leaveClass);
  this.left = false;
  this.callHookWithCb('leave');
  if (this.left) {
    return; // user called done synchronously.
  }
  this.cancel = this.hooks && this.hooks.leaveCancelled;
  // only need to handle leaveDone if
  // 1. the transition is already done (synchronously called
  //    by the user, which causes this.op set to null)
  // 2. there's no explicit js callback
  if (this.op && !this.pendingJsCb) {
    // if a CSS transition leaves immediately after enter,
    // the transitionend event never fires. therefore we
    // detect such cases and end the leave immediately.
    if (this.justEntered) {
      this.leaveDone();
    } else {
      pushJob(this.leaveNextTick);
    }
  }
};

/**
 * The "nextTick" phase of a leaving transition.
 */

p$1.leaveNextTick = function () {
  var type = this.getCssTransitionType(this.leaveClass);
  if (type) {
    var event = type === TYPE_TRANSITION ? transitionEndEvent : animationEndEvent;
    this.setupCssCb(event, this.leaveDone);
  } else {
    this.leaveDone();
  }
};

/**
 * The "cleanup" phase of a leaving transition.
 */

p$1.leaveDone = function () {
  this.left = true;
  this.cancel = this.pendingJsCb = null;
  this.op();
  removeClass(this.el, this.leaveClass);
  this.callHook('afterLeave');
  if (this.cb) this.cb();
  this.op = null;
};

/**
 * Cancel any pending callbacks from a previously running
 * but not finished transition.
 */

p$1.cancelPending = function () {
  this.op = this.cb = null;
  var hasPending = false;
  if (this.pendingCssCb) {
    hasPending = true;
    off(this.el, this.pendingCssEvent, this.pendingCssCb);
    this.pendingCssEvent = this.pendingCssCb = null;
  }
  if (this.pendingJsCb) {
    hasPending = true;
    this.pendingJsCb.cancel();
    this.pendingJsCb = null;
  }
  if (hasPending) {
    removeClass(this.el, this.enterClass);
    removeClass(this.el, this.leaveClass);
  }
  if (this.cancel) {
    this.cancel.call(this.vm, this.el);
    this.cancel = null;
  }
};

/**
 * Call a user-provided synchronous hook function.
 *
 * @param {String} type
 */

p$1.callHook = function (type) {
  if (this.hooks && this.hooks[type]) {
    this.hooks[type].call(this.vm, this.el);
  }
};

/**
 * Call a user-provided, potentially-async hook function.
 * We check for the length of arguments to see if the hook
 * expects a `done` callback. If true, the transition's end
 * will be determined by when the user calls that callback;
 * otherwise, the end is determined by the CSS transition or
 * animation.
 *
 * @param {String} type
 */

p$1.callHookWithCb = function (type) {
  var hook = this.hooks && this.hooks[type];
  if (hook) {
    if (hook.length > 1) {
      this.pendingJsCb = cancellable(this[type + 'Done']);
    }
    hook.call(this.vm, this.el, this.pendingJsCb);
  }
};

/**
 * Get an element's transition type based on the
 * calculated styles.
 *
 * @param {String} className
 * @return {Number}
 */

p$1.getCssTransitionType = function (className) {
  /* istanbul ignore if */
  if (!transitionEndEvent ||
  // skip CSS transitions if page is not visible -
  // this solves the issue of transitionend events not
  // firing until the page is visible again.
  // pageVisibility API is supported in IE10+, same as
  // CSS transitions.
  document.hidden ||
  // explicit js-only transition
  this.hooks && this.hooks.css === false ||
  // element is hidden
  isHidden(this.el)) {
    return;
  }
  var type = this.type || this.typeCache[className];
  if (type) return type;
  var inlineStyles = this.el.style;
  var computedStyles = window.getComputedStyle(this.el);
  var transDuration = inlineStyles[transDurationProp] || computedStyles[transDurationProp];
  if (transDuration && transDuration !== '0s') {
    type = TYPE_TRANSITION;
  } else {
    var animDuration = inlineStyles[animDurationProp] || computedStyles[animDurationProp];
    if (animDuration && animDuration !== '0s') {
      type = TYPE_ANIMATION;
    }
  }
  if (type) {
    this.typeCache[className] = type;
  }
  return type;
};

/**
 * Setup a CSS transitionend/animationend callback.
 *
 * @param {String} event
 * @param {Function} cb
 */

p$1.setupCssCb = function (event, cb) {
  this.pendingCssEvent = event;
  var self = this;
  var el = this.el;
  var onEnd = this.pendingCssCb = function (e) {
    if (e.target === el) {
      off(el, event, onEnd);
      self.pendingCssEvent = self.pendingCssCb = null;
      if (!self.pendingJsCb && cb) {
        cb();
      }
    }
  };
  on(el, event, onEnd);
};

/**
 * Check if an element is hidden - in that case we can just
 * skip the transition alltogether.
 *
 * @param {Element} el
 * @return {Boolean}
 */

function isHidden(el) {
  if (/svg$/.test(el.namespaceURI)) {
    // SVG elements do not have offset(Width|Height)
    // so we need to check the client rect
    var rect = el.getBoundingClientRect();
    return !(rect.width || rect.height);
  } else {
    return !(el.offsetWidth || el.offsetHeight || el.getClientRects().length);
  }
}

var transition$1 = {

  priority: TRANSITION,

  update: function update(id, oldId) {
    var el = this.el;
    // resolve on owner vm
    var hooks = resolveAsset(this.vm.$options, 'transitions', id);
    id = id || 'v';
    oldId = oldId || 'v';
    el.__v_trans = new Transition(el, id, hooks, this.vm);
    removeClass(el, oldId + '-transition');
    addClass(el, id + '-transition');
  }
};

var internalDirectives = {
  style: style,
  'class': vClass,
  component: component,
  prop: propDef,
  transition: transition$1
};

// special binding prefixes
var bindRE = /^v-bind:|^:/;
var onRE = /^v-on:|^@/;
var dirAttrRE = /^v-([^:]+)(?:$|:(.*)$)/;
var modifierRE = /\.[^\.]+/g;
var transitionRE = /^(v-bind:|:)?transition$/;

// default directive priority
var DEFAULT_PRIORITY = 1000;
var DEFAULT_TERMINAL_PRIORITY = 2000;

/**
 * Compile a template and return a reusable composite link
 * function, which recursively contains more link functions
 * inside. This top level compile function would normally
 * be called on instance root nodes, but can also be used
 * for partial compilation if the partial argument is true.
 *
 * The returned composite link function, when called, will
 * return an unlink function that tearsdown all directives
 * created during the linking phase.
 *
 * @param {Element|DocumentFragment} el
 * @param {Object} options
 * @param {Boolean} partial
 * @return {Function}
 */

function compile(el, options, partial) {
  // link function for the node itself.
  var nodeLinkFn = partial || !options._asComponent ? compileNode(el, options) : null;
  // link function for the childNodes
  var childLinkFn = !(nodeLinkFn && nodeLinkFn.terminal) && !isScript(el) && el.hasChildNodes() ? compileNodeList(el.childNodes, options) : null;

  /**
   * A composite linker function to be called on a already
   * compiled piece of DOM, which instantiates all directive
   * instances.
   *
   * @param {Vue} vm
   * @param {Element|DocumentFragment} el
   * @param {Vue} [host] - host vm of transcluded content
   * @param {Object} [scope] - v-for scope
   * @param {Fragment} [frag] - link context fragment
   * @return {Function|undefined}
   */

  return function compositeLinkFn(vm, el, host, scope, frag) {
    // cache childNodes before linking parent, fix #657
    var childNodes = toArray(el.childNodes);
    // link
    var dirs = linkAndCapture(function compositeLinkCapturer() {
      if (nodeLinkFn) nodeLinkFn(vm, el, host, scope, frag);
      if (childLinkFn) childLinkFn(vm, childNodes, host, scope, frag);
    }, vm);
    return makeUnlinkFn(vm, dirs);
  };
}

/**
 * Apply a linker to a vm/element pair and capture the
 * directives created during the process.
 *
 * @param {Function} linker
 * @param {Vue} vm
 */

function linkAndCapture(linker, vm) {
  /* istanbul ignore if */
  if (process.env.NODE_ENV === 'production') {
    // reset directives before every capture in production
    // mode, so that when unlinking we don't need to splice
    // them out (which turns out to be a perf hit).
    // they are kept in development mode because they are
    // useful for Vue's own tests.
    vm._directives = [];
  }
  var originalDirCount = vm._directives.length;
  linker();
  var dirs = vm._directives.slice(originalDirCount);
  sortDirectives(dirs);
  for (var i = 0, l = dirs.length; i < l; i++) {
    dirs[i]._bind();
  }
  return dirs;
}

/**
 * sort directives by priority (stable sort)
 *
 * @param {Array} dirs
 */
function sortDirectives(dirs) {
  if (dirs.length === 0) return;

  var groupedMap = {};
  var i, j, k, l;
  var index = 0;
  var priorities = [];
  for (i = 0, j = dirs.length; i < j; i++) {
    var dir = dirs[i];
    var priority = dir.descriptor.def.priority || DEFAULT_PRIORITY;
    var array = groupedMap[priority];
    if (!array) {
      array = groupedMap[priority] = [];
      priorities.push(priority);
    }
    array.push(dir);
  }

  priorities.sort(function (a, b) {
    return a > b ? -1 : a === b ? 0 : 1;
  });
  for (i = 0, j = priorities.length; i < j; i++) {
    var group = groupedMap[priorities[i]];
    for (k = 0, l = group.length; k < l; k++) {
      dirs[index++] = group[k];
    }
  }
}

/**
 * Linker functions return an unlink function that
 * tearsdown all directives instances generated during
 * the process.
 *
 * We create unlink functions with only the necessary
 * information to avoid retaining additional closures.
 *
 * @param {Vue} vm
 * @param {Array} dirs
 * @param {Vue} [context]
 * @param {Array} [contextDirs]
 * @return {Function}
 */

function makeUnlinkFn(vm, dirs, context, contextDirs) {
  function unlink(destroying) {
    teardownDirs(vm, dirs, destroying);
    if (context && contextDirs) {
      teardownDirs(context, contextDirs);
    }
  }
  // expose linked directives
  unlink.dirs = dirs;
  return unlink;
}

/**
 * Teardown partial linked directives.
 *
 * @param {Vue} vm
 * @param {Array} dirs
 * @param {Boolean} destroying
 */

function teardownDirs(vm, dirs, destroying) {
  var i = dirs.length;
  while (i--) {
    dirs[i]._teardown();
    if (process.env.NODE_ENV !== 'production' && !destroying) {
      vm._directives.$remove(dirs[i]);
    }
  }
}

/**
 * Compile link props on an instance.
 *
 * @param {Vue} vm
 * @param {Element} el
 * @param {Object} props
 * @param {Object} [scope]
 * @return {Function}
 */

function compileAndLinkProps(vm, el, props, scope) {
  var propsLinkFn = compileProps(el, props, vm);
  var propDirs = linkAndCapture(function () {
    propsLinkFn(vm, scope);
  }, vm);
  return makeUnlinkFn(vm, propDirs);
}

/**
 * Compile the root element of an instance.
 *
 * 1. attrs on context container (context scope)
 * 2. attrs on the component template root node, if
 *    replace:true (child scope)
 *
 * If this is a fragment instance, we only need to compile 1.
 *
 * @param {Element} el
 * @param {Object} options
 * @param {Object} contextOptions
 * @return {Function}
 */

function compileRoot(el, options, contextOptions) {
  var containerAttrs = options._containerAttrs;
  var replacerAttrs = options._replacerAttrs;
  var contextLinkFn, replacerLinkFn;

  // only need to compile other attributes for
  // non-fragment instances
  if (el.nodeType !== 11) {
    // for components, container and replacer need to be
    // compiled separately and linked in different scopes.
    if (options._asComponent) {
      // 2. container attributes
      if (containerAttrs && contextOptions) {
        contextLinkFn = compileDirectives(containerAttrs, contextOptions);
      }
      if (replacerAttrs) {
        // 3. replacer attributes
        replacerLinkFn = compileDirectives(replacerAttrs, options);
      }
    } else {
      // non-component, just compile as a normal element.
      replacerLinkFn = compileDirectives(el.attributes, options);
    }
  } else if (process.env.NODE_ENV !== 'production' && containerAttrs) {
    // warn container directives for fragment instances
    var names = containerAttrs.filter(function (attr) {
      // allow vue-loader/vueify scoped css attributes
      return attr.name.indexOf('_v-') < 0 &&
      // allow event listeners
      !onRE.test(attr.name) &&
      // allow slots
      attr.name !== 'slot';
    }).map(function (attr) {
      return '"' + attr.name + '"';
    });
    if (names.length) {
      var plural = names.length > 1;

      var componentName = options.el.tagName.toLowerCase();
      if (componentName === 'component' && options.name) {
        componentName += ':' + options.name;
      }

      warn('Attribute' + (plural ? 's ' : ' ') + names.join(', ') + (plural ? ' are' : ' is') + ' ignored on component ' + '<' + componentName + '> because ' + 'the component is a fragment instance: ' + 'http://vuejs.org/guide/components.html#Fragment-Instance');
    }
  }

  options._containerAttrs = options._replacerAttrs = null;
  return function rootLinkFn(vm, el, scope) {
    // link context scope dirs
    var context = vm._context;
    var contextDirs;
    if (context && contextLinkFn) {
      contextDirs = linkAndCapture(function () {
        contextLinkFn(context, el, null, scope);
      }, context);
    }

    // link self
    var selfDirs = linkAndCapture(function () {
      if (replacerLinkFn) replacerLinkFn(vm, el);
    }, vm);

    // return the unlink function that tearsdown context
    // container directives.
    return makeUnlinkFn(vm, selfDirs, context, contextDirs);
  };
}

/**
 * Compile a node and return a nodeLinkFn based on the
 * node type.
 *
 * @param {Node} node
 * @param {Object} options
 * @return {Function|null}
 */

function compileNode(node, options) {
  var type = node.nodeType;
  if (type === 1 && !isScript(node)) {
    return compileElement(node, options);
  } else if (type === 3 && node.data.trim()) {
    return compileTextNode(node, options);
  } else {
    return null;
  }
}

/**
 * Compile an element and return a nodeLinkFn.
 *
 * @param {Element} el
 * @param {Object} options
 * @return {Function|null}
 */

function compileElement(el, options) {
  // preprocess textareas.
  // textarea treats its text content as the initial value.
  // just bind it as an attr directive for value.
  if (el.tagName === 'TEXTAREA') {
    // a textarea which has v-pre attr should skip complie.
    if (getAttr(el, 'v-pre') !== null) {
      return skip;
    }
    var tokens = parseText(el.value);
    if (tokens) {
      el.setAttribute(':value', tokensToExp(tokens));
      el.value = '';
    }
  }
  var linkFn;
  var hasAttrs = el.hasAttributes();
  var attrs = hasAttrs && toArray(el.attributes);
  // check terminal directives (for & if)
  if (hasAttrs) {
    linkFn = checkTerminalDirectives(el, attrs, options);
  }
  // check element directives
  if (!linkFn) {
    linkFn = checkElementDirectives(el, options);
  }
  // check component
  if (!linkFn) {
    linkFn = checkComponent(el, options);
  }
  // normal directives
  if (!linkFn && hasAttrs) {
    linkFn = compileDirectives(attrs, options);
  }
  return linkFn;
}

/**
 * Compile a textNode and return a nodeLinkFn.
 *
 * @param {TextNode} node
 * @param {Object} options
 * @return {Function|null} textNodeLinkFn
 */

function compileTextNode(node, options) {
  // skip marked text nodes
  if (node._skip) {
    return removeText;
  }

  var tokens = parseText(node.wholeText);
  if (!tokens) {
    return null;
  }

  // mark adjacent text nodes as skipped,
  // because we are using node.wholeText to compile
  // all adjacent text nodes together. This fixes
  // issues in IE where sometimes it splits up a single
  // text node into multiple ones.
  var next = node.nextSibling;
  while (next && next.nodeType === 3) {
    next._skip = true;
    next = next.nextSibling;
  }

  var frag = document.createDocumentFragment();
  var el, token;
  for (var i = 0, l = tokens.length; i < l; i++) {
    token = tokens[i];
    el = token.tag ? processTextToken(token, options) : document.createTextNode(token.value);
    frag.appendChild(el);
  }
  return makeTextNodeLinkFn(tokens, frag, options);
}

/**
 * Linker for an skipped text node.
 *
 * @param {Vue} vm
 * @param {Text} node
 */

function removeText(vm, node) {
  remove(node);
}

/**
 * Process a single text token.
 *
 * @param {Object} token
 * @param {Object} options
 * @return {Node}
 */

function processTextToken(token, options) {
  var el;
  if (token.oneTime) {
    el = document.createTextNode(token.value);
  } else {
    if (token.html) {
      el = document.createComment('v-html');
      setTokenType('html');
    } else {
      // IE will clean up empty textNodes during
      // frag.cloneNode(true), so we have to give it
      // something here...
      el = document.createTextNode(' ');
      setTokenType('text');
    }
  }
  function setTokenType(type) {
    if (token.descriptor) return;
    var parsed = parseDirective(token.value);
    token.descriptor = {
      name: type,
      def: directives[type],
      expression: parsed.expression,
      filters: parsed.filters
    };
  }
  return el;
}

/**
 * Build a function that processes a textNode.
 *
 * @param {Array<Object>} tokens
 * @param {DocumentFragment} frag
 */

function makeTextNodeLinkFn(tokens, frag) {
  return function textNodeLinkFn(vm, el, host, scope) {
    var fragClone = frag.cloneNode(true);
    var childNodes = toArray(fragClone.childNodes);
    var token, value, node;
    for (var i = 0, l = tokens.length; i < l; i++) {
      token = tokens[i];
      value = token.value;
      if (token.tag) {
        node = childNodes[i];
        if (token.oneTime) {
          value = (scope || vm).$eval(value);
          if (token.html) {
            replace(node, parseTemplate(value, true));
          } else {
            node.data = _toString(value);
          }
        } else {
          vm._bindDir(token.descriptor, node, host, scope);
        }
      }
    }
    replace(el, fragClone);
  };
}

/**
 * Compile a node list and return a childLinkFn.
 *
 * @param {NodeList} nodeList
 * @param {Object} options
 * @return {Function|undefined}
 */

function compileNodeList(nodeList, options) {
  var linkFns = [];
  var nodeLinkFn, childLinkFn, node;
  for (var i = 0, l = nodeList.length; i < l; i++) {
    node = nodeList[i];
    nodeLinkFn = compileNode(node, options);
    childLinkFn = !(nodeLinkFn && nodeLinkFn.terminal) && node.tagName !== 'SCRIPT' && node.hasChildNodes() ? compileNodeList(node.childNodes, options) : null;
    linkFns.push(nodeLinkFn, childLinkFn);
  }
  return linkFns.length ? makeChildLinkFn(linkFns) : null;
}

/**
 * Make a child link function for a node's childNodes.
 *
 * @param {Array<Function>} linkFns
 * @return {Function} childLinkFn
 */

function makeChildLinkFn(linkFns) {
  return function childLinkFn(vm, nodes, host, scope, frag) {
    var node, nodeLinkFn, childrenLinkFn;
    for (var i = 0, n = 0, l = linkFns.length; i < l; n++) {
      node = nodes[n];
      nodeLinkFn = linkFns[i++];
      childrenLinkFn = linkFns[i++];
      // cache childNodes before linking parent, fix #657
      var childNodes = toArray(node.childNodes);
      if (nodeLinkFn) {
        nodeLinkFn(vm, node, host, scope, frag);
      }
      if (childrenLinkFn) {
        childrenLinkFn(vm, childNodes, host, scope, frag);
      }
    }
  };
}

/**
 * Check for element directives (custom elements that should
 * be resovled as terminal directives).
 *
 * @param {Element} el
 * @param {Object} options
 */

function checkElementDirectives(el, options) {
  var tag = el.tagName.toLowerCase();
  if (commonTagRE.test(tag)) {
    return;
  }
  var def = resolveAsset(options, 'elementDirectives', tag);
  if (def) {
    return makeTerminalNodeLinkFn(el, tag, '', options, def);
  }
}

/**
 * Check if an element is a component. If yes, return
 * a component link function.
 *
 * @param {Element} el
 * @param {Object} options
 * @return {Function|undefined}
 */

function checkComponent(el, options) {
  var component = checkComponentAttr(el, options);
  if (component) {
    var ref = findRef(el);
    var descriptor = {
      name: 'component',
      ref: ref,
      expression: component.id,
      def: internalDirectives.component,
      modifiers: {
        literal: !component.dynamic
      }
    };
    var componentLinkFn = function componentLinkFn(vm, el, host, scope, frag) {
      if (ref) {
        defineReactive((scope || vm).$refs, ref, null);
      }
      vm._bindDir(descriptor, el, host, scope, frag);
    };
    componentLinkFn.terminal = true;
    return componentLinkFn;
  }
}

/**
 * Check an element for terminal directives in fixed order.
 * If it finds one, return a terminal link function.
 *
 * @param {Element} el
 * @param {Array} attrs
 * @param {Object} options
 * @return {Function} terminalLinkFn
 */

function checkTerminalDirectives(el, attrs, options) {
  // skip v-pre
  if (getAttr(el, 'v-pre') !== null) {
    return skip;
  }
  // skip v-else block, but only if following v-if
  if (el.hasAttribute('v-else')) {
    var prev = el.previousElementSibling;
    if (prev && prev.hasAttribute('v-if')) {
      return skip;
    }
  }

  var attr, name, value, modifiers, matched, dirName, rawName, arg, def, termDef;
  for (var i = 0, j = attrs.length; i < j; i++) {
    attr = attrs[i];
    name = attr.name.replace(modifierRE, '');
    if (matched = name.match(dirAttrRE)) {
      def = resolveAsset(options, 'directives', matched[1]);
      if (def && def.terminal) {
        if (!termDef || (def.priority || DEFAULT_TERMINAL_PRIORITY) > termDef.priority) {
          termDef = def;
          rawName = attr.name;
          modifiers = parseModifiers(attr.name);
          value = attr.value;
          dirName = matched[1];
          arg = matched[2];
        }
      }
    }
  }

  if (termDef) {
    return makeTerminalNodeLinkFn(el, dirName, value, options, termDef, rawName, arg, modifiers);
  }
}

function skip() {}
skip.terminal = true;

/**
 * Build a node link function for a terminal directive.
 * A terminal link function terminates the current
 * compilation recursion and handles compilation of the
 * subtree in the directive.
 *
 * @param {Element} el
 * @param {String} dirName
 * @param {String} value
 * @param {Object} options
 * @param {Object} def
 * @param {String} [rawName]
 * @param {String} [arg]
 * @param {Object} [modifiers]
 * @return {Function} terminalLinkFn
 */

function makeTerminalNodeLinkFn(el, dirName, value, options, def, rawName, arg, modifiers) {
  var parsed = parseDirective(value);
  var descriptor = {
    name: dirName,
    arg: arg,
    expression: parsed.expression,
    filters: parsed.filters,
    raw: value,
    attr: rawName,
    modifiers: modifiers,
    def: def
  };
  // check ref for v-for, v-if and router-view
  if (dirName === 'for' || dirName === 'router-view') {
    descriptor.ref = findRef(el);
  }
  var fn = function terminalNodeLinkFn(vm, el, host, scope, frag) {
    if (descriptor.ref) {
      defineReactive((scope || vm).$refs, descriptor.ref, null);
    }
    vm._bindDir(descriptor, el, host, scope, frag);
  };
  fn.terminal = true;
  return fn;
}

/**
 * Compile the directives on an element and return a linker.
 *
 * @param {Array|NamedNodeMap} attrs
 * @param {Object} options
 * @return {Function}
 */

function compileDirectives(attrs, options) {
  var i = attrs.length;
  var dirs = [];
  var attr, name, value, rawName, rawValue, dirName, arg, modifiers, dirDef, tokens, matched;
  while (i--) {
    attr = attrs[i];
    name = rawName = attr.name;
    value = rawValue = attr.value;
    tokens = parseText(value);
    // reset arg
    arg = null;
    // check modifiers
    modifiers = parseModifiers(name);
    name = name.replace(modifierRE, '');

    // attribute interpolations
    if (tokens) {
      value = tokensToExp(tokens);
      arg = name;
      pushDir('bind', directives.bind, tokens);
      // warn against mixing mustaches with v-bind
      if (process.env.NODE_ENV !== 'production') {
        if (name === 'class' && Array.prototype.some.call(attrs, function (attr) {
          return attr.name === ':class' || attr.name === 'v-bind:class';
        })) {
          warn('class="' + rawValue + '": Do not mix mustache interpolation ' + 'and v-bind for "class" on the same element. Use one or the other.', options);
        }
      }
    } else

      // special attribute: transition
      if (transitionRE.test(name)) {
        modifiers.literal = !bindRE.test(name);
        pushDir('transition', internalDirectives.transition);
      } else

        // event handlers
        if (onRE.test(name)) {
          arg = name.replace(onRE, '');
          pushDir('on', directives.on);
        } else

          // attribute bindings
          if (bindRE.test(name)) {
            dirName = name.replace(bindRE, '');
            if (dirName === 'style' || dirName === 'class') {
              pushDir(dirName, internalDirectives[dirName]);
            } else {
              arg = dirName;
              pushDir('bind', directives.bind);
            }
          } else

            // normal directives
            if (matched = name.match(dirAttrRE)) {
              dirName = matched[1];
              arg = matched[2];

              // skip v-else (when used with v-show)
              if (dirName === 'else') {
                continue;
              }

              dirDef = resolveAsset(options, 'directives', dirName, true);
              if (dirDef) {
                pushDir(dirName, dirDef);
              }
            }
  }

  /**
   * Push a directive.
   *
   * @param {String} dirName
   * @param {Object|Function} def
   * @param {Array} [interpTokens]
   */

  function pushDir(dirName, def, interpTokens) {
    var hasOneTimeToken = interpTokens && hasOneTime(interpTokens);
    var parsed = !hasOneTimeToken && parseDirective(value);
    dirs.push({
      name: dirName,
      attr: rawName,
      raw: rawValue,
      def: def,
      arg: arg,
      modifiers: modifiers,
      // conversion from interpolation strings with one-time token
      // to expression is differed until directive bind time so that we
      // have access to the actual vm context for one-time bindings.
      expression: parsed && parsed.expression,
      filters: parsed && parsed.filters,
      interp: interpTokens,
      hasOneTime: hasOneTimeToken
    });
  }

  if (dirs.length) {
    return makeNodeLinkFn(dirs);
  }
}

/**
 * Parse modifiers from directive attribute name.
 *
 * @param {String} name
 * @return {Object}
 */

function parseModifiers(name) {
  var res = Object.create(null);
  var match = name.match(modifierRE);
  if (match) {
    var i = match.length;
    while (i--) {
      res[match[i].slice(1)] = true;
    }
  }
  return res;
}

/**
 * Build a link function for all directives on a single node.
 *
 * @param {Array} directives
 * @return {Function} directivesLinkFn
 */

function makeNodeLinkFn(directives) {
  return function nodeLinkFn(vm, el, host, scope, frag) {
    // reverse apply because it's sorted low to high
    var i = directives.length;
    while (i--) {
      vm._bindDir(directives[i], el, host, scope, frag);
    }
  };
}

/**
 * Check if an interpolation string contains one-time tokens.
 *
 * @param {Array} tokens
 * @return {Boolean}
 */

function hasOneTime(tokens) {
  var i = tokens.length;
  while (i--) {
    if (tokens[i].oneTime) return true;
  }
}

function isScript(el) {
  return el.tagName === 'SCRIPT' && (!el.hasAttribute('type') || el.getAttribute('type') === 'text/javascript');
}

var specialCharRE = /[^\w\-:\.]/;

/**
 * Process an element or a DocumentFragment based on a
 * instance option object. This allows us to transclude
 * a template node/fragment before the instance is created,
 * so the processed fragment can then be cloned and reused
 * in v-for.
 *
 * @param {Element} el
 * @param {Object} options
 * @return {Element|DocumentFragment}
 */

function transclude(el, options) {
  // extract container attributes to pass them down
  // to compiler, because they need to be compiled in
  // parent scope. we are mutating the options object here
  // assuming the same object will be used for compile
  // right after this.
  if (options) {
    options._containerAttrs = extractAttrs(el);
  }
  // for template tags, what we want is its content as
  // a documentFragment (for fragment instances)
  if (isTemplate(el)) {
    el = parseTemplate(el);
  }
  if (options) {
    if (options._asComponent && !options.template) {
      options.template = '<slot></slot>';
    }
    if (options.template) {
      options._content = extractContent(el);
      el = transcludeTemplate(el, options);
    }
  }
  if (isFragment(el)) {
    // anchors for fragment instance
    // passing in `persist: true` to avoid them being
    // discarded by IE during template cloning
    prepend(createAnchor('v-start', true), el);
    el.appendChild(createAnchor('v-end', true));
  }
  return el;
}

/**
 * Process the template option.
 * If the replace option is true this will swap the $el.
 *
 * @param {Element} el
 * @param {Object} options
 * @return {Element|DocumentFragment}
 */

function transcludeTemplate(el, options) {
  var template = options.template;
  var frag = parseTemplate(template, true);
  if (frag) {
    var replacer = frag.firstChild;
    if (!replacer) {
      return frag;
    }
    var tag = replacer.tagName && replacer.tagName.toLowerCase();
    if (options.replace) {
      /* istanbul ignore if */
      if (el === document.body) {
        process.env.NODE_ENV !== 'production' && warn('You are mounting an instance with a template to ' + '<body>. This will replace <body> entirely. You ' + 'should probably use `replace: false` here.');
      }
      // there are many cases where the instance must
      // become a fragment instance: basically anything that
      // can create more than 1 root nodes.
      if (
      // multi-children template
      frag.childNodes.length > 1 ||
      // non-element template
      replacer.nodeType !== 1 ||
      // single nested component
      tag === 'component' || resolveAsset(options, 'components', tag) || hasBindAttr(replacer, 'is') ||
      // element directive
      resolveAsset(options, 'elementDirectives', tag) ||
      // for block
      replacer.hasAttribute('v-for') ||
      // if block
      replacer.hasAttribute('v-if')) {
        return frag;
      } else {
        options._replacerAttrs = extractAttrs(replacer);
        mergeAttrs(el, replacer);
        return replacer;
      }
    } else {
      el.appendChild(frag);
      return el;
    }
  } else {
    process.env.NODE_ENV !== 'production' && warn('Invalid template option: ' + template);
  }
}

/**
 * Helper to extract a component container's attributes
 * into a plain object array.
 *
 * @param {Element} el
 * @return {Array}
 */

function extractAttrs(el) {
  if (el.nodeType === 1 && el.hasAttributes()) {
    return toArray(el.attributes);
  }
}

/**
 * Merge the attributes of two elements, and make sure
 * the class names are merged properly.
 *
 * @param {Element} from
 * @param {Element} to
 */

function mergeAttrs(from, to) {
  var attrs = from.attributes;
  var i = attrs.length;
  var name, value;
  while (i--) {
    name = attrs[i].name;
    value = attrs[i].value;
    if (!to.hasAttribute(name) && !specialCharRE.test(name)) {
      to.setAttribute(name, value);
    } else if (name === 'class' && !parseText(value) && (value = value.trim())) {
      value.split(/\s+/).forEach(function (cls) {
        addClass(to, cls);
      });
    }
  }
}

/**
 * Scan and determine slot content distribution.
 * We do this during transclusion instead at compile time so that
 * the distribution is decoupled from the compilation order of
 * the slots.
 *
 * @param {Element|DocumentFragment} template
 * @param {Element} content
 * @param {Vue} vm
 */

function resolveSlots(vm, content) {
  if (!content) {
    return;
  }
  var contents = vm._slotContents = Object.create(null);
  var el, name;
  for (var i = 0, l = content.children.length; i < l; i++) {
    el = content.children[i];
    /* eslint-disable no-cond-assign */
    if (name = el.getAttribute('slot')) {
      (contents[name] || (contents[name] = [])).push(el);
    }
    /* eslint-enable no-cond-assign */
    if (process.env.NODE_ENV !== 'production' && getBindAttr(el, 'slot')) {
      warn('The "slot" attribute must be static.', vm.$parent);
    }
  }
  for (name in contents) {
    contents[name] = extractFragment(contents[name], content);
  }
  if (content.hasChildNodes()) {
    var nodes = content.childNodes;
    if (nodes.length === 1 && nodes[0].nodeType === 3 && !nodes[0].data.trim()) {
      return;
    }
    contents['default'] = extractFragment(content.childNodes, content);
  }
}

/**
 * Extract qualified content nodes from a node list.
 *
 * @param {NodeList} nodes
 * @return {DocumentFragment}
 */

function extractFragment(nodes, parent) {
  var frag = document.createDocumentFragment();
  nodes = toArray(nodes);
  for (var i = 0, l = nodes.length; i < l; i++) {
    var node = nodes[i];
    if (isTemplate(node) && !node.hasAttribute('v-if') && !node.hasAttribute('v-for')) {
      parent.removeChild(node);
      node = parseTemplate(node, true);
    }
    frag.appendChild(node);
  }
  return frag;
}



var compiler = Object.freeze({
	compile: compile,
	compileAndLinkProps: compileAndLinkProps,
	compileRoot: compileRoot,
	transclude: transclude,
	resolveSlots: resolveSlots
});

function stateMixin (Vue) {
  /**
   * Accessor for `$data` property, since setting $data
   * requires observing the new object and updating
   * proxied properties.
   */

  Object.defineProperty(Vue.prototype, '$data', {
    get: function get() {
      return this._data;
    },
    set: function set(newData) {
      if (newData !== this._data) {
        this._setData(newData);
      }
    }
  });

  /**
   * Setup the scope of an instance, which contains:
   * - observed data
   * - computed properties
   * - user methods
   * - meta properties
   */

  Vue.prototype._initState = function () {
    this._initProps();
    this._initMeta();
    this._initMethods();
    this._initData();
    this._initComputed();
  };

  /**
   * Initialize props.
   */

  Vue.prototype._initProps = function () {
    var options = this.$options;
    var el = options.el;
    var props = options.props;
    if (props && !el) {
      process.env.NODE_ENV !== 'production' && warn('Props will not be compiled if no `el` option is ' + 'provided at instantiation.', this);
    }
    // make sure to convert string selectors into element now
    el = options.el = query(el);
    this._propsUnlinkFn = el && el.nodeType === 1 && props
    // props must be linked in proper scope if inside v-for
    ? compileAndLinkProps(this, el, props, this._scope) : null;
  };

  /**
   * Initialize the data.
   */

  Vue.prototype._initData = function () {
    var dataFn = this.$options.data;
    var data = this._data = dataFn ? dataFn() : {};
    if (!isPlainObject(data)) {
      data = {};
      process.env.NODE_ENV !== 'production' && warn('data functions should return an object.', this);
    }
    var props = this._props;
    // proxy data on instance
    var keys = Object.keys(data);
    var i, key;
    i = keys.length;
    while (i--) {
      key = keys[i];
      // there are two scenarios where we can proxy a data key:
      // 1. it's not already defined as a prop
      // 2. it's provided via a instantiation option AND there are no
      //    template prop present
      if (!props || !hasOwn(props, key)) {
        this._proxy(key);
      } else if (process.env.NODE_ENV !== 'production') {
        warn('Data field "' + key + '" is already defined ' + 'as a prop. To provide default value for a prop, use the "default" ' + 'prop option; if you want to pass prop values to an instantiation ' + 'call, use the "propsData" option.', this);
      }
    }
    // observe data
    observe(data, this);
  };

  /**
   * Swap the instance's $data. Called in $data's setter.
   *
   * @param {Object} newData
   */

  Vue.prototype._setData = function (newData) {
    newData = newData || {};
    var oldData = this._data;
    this._data = newData;
    var keys, key, i;
    // unproxy keys not present in new data
    keys = Object.keys(oldData);
    i = keys.length;
    while (i--) {
      key = keys[i];
      if (!(key in newData)) {
        this._unproxy(key);
      }
    }
    // proxy keys not already proxied,
    // and trigger change for changed values
    keys = Object.keys(newData);
    i = keys.length;
    while (i--) {
      key = keys[i];
      if (!hasOwn(this, key)) {
        // new property
        this._proxy(key);
      }
    }
    oldData.__ob__.removeVm(this);
    observe(newData, this);
    this._digest();
  };

  /**
   * Proxy a property, so that
   * vm.prop === vm._data.prop
   *
   * @param {String} key
   */

  Vue.prototype._proxy = function (key) {
    if (!isReserved(key)) {
      // need to store ref to self here
      // because these getter/setters might
      // be called by child scopes via
      // prototype inheritance.
      var self = this;
      Object.defineProperty(self, key, {
        configurable: true,
        enumerable: true,
        get: function proxyGetter() {
          return self._data[key];
        },
        set: function proxySetter(val) {
          self._data[key] = val;
        }
      });
    }
  };

  /**
   * Unproxy a property.
   *
   * @param {String} key
   */

  Vue.prototype._unproxy = function (key) {
    if (!isReserved(key)) {
      delete this[key];
    }
  };

  /**
   * Force update on every watcher in scope.
   */

  Vue.prototype._digest = function () {
    for (var i = 0, l = this._watchers.length; i < l; i++) {
      this._watchers[i].update(true); // shallow updates
    }
  };

  /**
   * Setup computed properties. They are essentially
   * special getter/setters
   */

  function noop() {}
  Vue.prototype._initComputed = function () {
    var computed = this.$options.computed;
    if (computed) {
      for (var key in computed) {
        var userDef = computed[key];
        var def = {
          enumerable: true,
          configurable: true
        };
        if (typeof userDef === 'function') {
          def.get = makeComputedGetter(userDef, this);
          def.set = noop;
        } else {
          def.get = userDef.get ? userDef.cache !== false ? makeComputedGetter(userDef.get, this) : bind(userDef.get, this) : noop;
          def.set = userDef.set ? bind(userDef.set, this) : noop;
        }
        Object.defineProperty(this, key, def);
      }
    }
  };

  function makeComputedGetter(getter, owner) {
    var watcher = new Watcher(owner, getter, null, {
      lazy: true
    });
    return function computedGetter() {
      if (watcher.dirty) {
        watcher.evaluate();
      }
      if (Dep.target) {
        watcher.depend();
      }
      return watcher.value;
    };
  }

  /**
   * Setup instance methods. Methods must be bound to the
   * instance since they might be passed down as a prop to
   * child components.
   */

  Vue.prototype._initMethods = function () {
    var methods = this.$options.methods;
    if (methods) {
      for (var key in methods) {
        this[key] = bind(methods[key], this);
      }
    }
  };

  /**
   * Initialize meta information like $index, $key & $value.
   */

  Vue.prototype._initMeta = function () {
    var metas = this.$options._meta;
    if (metas) {
      for (var key in metas) {
        defineReactive(this, key, metas[key]);
      }
    }
  };
}

var eventRE = /^v-on:|^@/;

function eventsMixin (Vue) {
  /**
   * Setup the instance's option events & watchers.
   * If the value is a string, we pull it from the
   * instance's methods by name.
   */

  Vue.prototype._initEvents = function () {
    var options = this.$options;
    if (options._asComponent) {
      registerComponentEvents(this, options.el);
    }
    registerCallbacks(this, '$on', options.events);
    registerCallbacks(this, '$watch', options.watch);
  };

  /**
   * Register v-on events on a child component
   *
   * @param {Vue} vm
   * @param {Element} el
   */

  function registerComponentEvents(vm, el) {
    var attrs = el.attributes;
    var name, value, handler;
    for (var i = 0, l = attrs.length; i < l; i++) {
      name = attrs[i].name;
      if (eventRE.test(name)) {
        name = name.replace(eventRE, '');
        // force the expression into a statement so that
        // it always dynamically resolves the method to call (#2670)
        // kinda ugly hack, but does the job.
        value = attrs[i].value;
        if (isSimplePath(value)) {
          value += '.apply(this, $arguments)';
        }
        handler = (vm._scope || vm._context).$eval(value, true);
        handler._fromParent = true;
        vm.$on(name.replace(eventRE), handler);
      }
    }
  }

  /**
   * Register callbacks for option events and watchers.
   *
   * @param {Vue} vm
   * @param {String} action
   * @param {Object} hash
   */

  function registerCallbacks(vm, action, hash) {
    if (!hash) return;
    var handlers, key, i, j;
    for (key in hash) {
      handlers = hash[key];
      if (isArray(handlers)) {
        for (i = 0, j = handlers.length; i < j; i++) {
          register(vm, action, key, handlers[i]);
        }
      } else {
        register(vm, action, key, handlers);
      }
    }
  }

  /**
   * Helper to register an event/watch callback.
   *
   * @param {Vue} vm
   * @param {String} action
   * @param {String} key
   * @param {Function|String|Object} handler
   * @param {Object} [options]
   */

  function register(vm, action, key, handler, options) {
    var type = typeof handler;
    if (type === 'function') {
      vm[action](key, handler, options);
    } else if (type === 'string') {
      var methods = vm.$options.methods;
      var method = methods && methods[handler];
      if (method) {
        vm[action](key, method, options);
      } else {
        process.env.NODE_ENV !== 'production' && warn('Unknown method: "' + handler + '" when ' + 'registering callback for ' + action + ': "' + key + '".', vm);
      }
    } else if (handler && type === 'object') {
      register(vm, action, key, handler.handler, handler);
    }
  }

  /**
   * Setup recursive attached/detached calls
   */

  Vue.prototype._initDOMHooks = function () {
    this.$on('hook:attached', onAttached);
    this.$on('hook:detached', onDetached);
  };

  /**
   * Callback to recursively call attached hook on children
   */

  function onAttached() {
    if (!this._isAttached) {
      this._isAttached = true;
      this.$children.forEach(callAttach);
    }
  }

  /**
   * Iterator to call attached hook
   *
   * @param {Vue} child
   */

  function callAttach(child) {
    if (!child._isAttached && inDoc(child.$el)) {
      child._callHook('attached');
    }
  }

  /**
   * Callback to recursively call detached hook on children
   */

  function onDetached() {
    if (this._isAttached) {
      this._isAttached = false;
      this.$children.forEach(callDetach);
    }
  }

  /**
   * Iterator to call detached hook
   *
   * @param {Vue} child
   */

  function callDetach(child) {
    if (child._isAttached && !inDoc(child.$el)) {
      child._callHook('detached');
    }
  }

  /**
   * Trigger all handlers for a hook
   *
   * @param {String} hook
   */

  Vue.prototype._callHook = function (hook) {
    this.$emit('pre-hook:' + hook);
    var handlers = this.$options[hook];
    if (handlers) {
      for (var i = 0, j = handlers.length; i < j; i++) {
        handlers[i].call(this);
      }
    }
    this.$emit('hook:' + hook);
  };
}

function noop$1() {}

/**
 * A directive links a DOM element with a piece of data,
 * which is the result of evaluating an expression.
 * It registers a watcher with the expression and calls
 * the DOM update function when a change is triggered.
 *
 * @param {Object} descriptor
 *                 - {String} name
 *                 - {Object} def
 *                 - {String} expression
 *                 - {Array<Object>} [filters]
 *                 - {Object} [modifiers]
 *                 - {Boolean} literal
 *                 - {String} attr
 *                 - {String} arg
 *                 - {String} raw
 *                 - {String} [ref]
 *                 - {Array<Object>} [interp]
 *                 - {Boolean} [hasOneTime]
 * @param {Vue} vm
 * @param {Node} el
 * @param {Vue} [host] - transclusion host component
 * @param {Object} [scope] - v-for scope
 * @param {Fragment} [frag] - owner fragment
 * @constructor
 */
function Directive(descriptor, vm, el, host, scope, frag) {
  this.vm = vm;
  this.el = el;
  // copy descriptor properties
  this.descriptor = descriptor;
  this.name = descriptor.name;
  this.expression = descriptor.expression;
  this.arg = descriptor.arg;
  this.modifiers = descriptor.modifiers;
  this.filters = descriptor.filters;
  this.literal = this.modifiers && this.modifiers.literal;
  // private
  this._locked = false;
  this._bound = false;
  this._listeners = null;
  // link context
  this._host = host;
  this._scope = scope;
  this._frag = frag;
  // store directives on node in dev mode
  if (process.env.NODE_ENV !== 'production' && this.el) {
    this.el._vue_directives = this.el._vue_directives || [];
    this.el._vue_directives.push(this);
  }
}

/**
 * Initialize the directive, mixin definition properties,
 * setup the watcher, call definition bind() and update()
 * if present.
 */

Directive.prototype._bind = function () {
  var name = this.name;
  var descriptor = this.descriptor;

  // remove attribute
  if ((name !== 'cloak' || this.vm._isCompiled) && this.el && this.el.removeAttribute) {
    var attr = descriptor.attr || 'v-' + name;
    this.el.removeAttribute(attr);
  }

  // copy def properties
  var def = descriptor.def;
  if (typeof def === 'function') {
    this.update = def;
  } else {
    extend(this, def);
  }

  // setup directive params
  this._setupParams();

  // initial bind
  if (this.bind) {
    this.bind();
  }
  this._bound = true;

  if (this.literal) {
    this.update && this.update(descriptor.raw);
  } else if ((this.expression || this.modifiers) && (this.update || this.twoWay) && !this._checkStatement()) {
    // wrapped updater for context
    var dir = this;
    if (this.update) {
      this._update = function (val, oldVal) {
        if (!dir._locked) {
          dir.update(val, oldVal);
        }
      };
    } else {
      this._update = noop$1;
    }
    var preProcess = this._preProcess ? bind(this._preProcess, this) : null;
    var postProcess = this._postProcess ? bind(this._postProcess, this) : null;
    var watcher = this._watcher = new Watcher(this.vm, this.expression, this._update, // callback
    {
      filters: this.filters,
      twoWay: this.twoWay,
      deep: this.deep,
      preProcess: preProcess,
      postProcess: postProcess,
      scope: this._scope
    });
    // v-model with inital inline value need to sync back to
    // model instead of update to DOM on init. They would
    // set the afterBind hook to indicate that.
    if (this.afterBind) {
      this.afterBind();
    } else if (this.update) {
      this.update(watcher.value);
    }
  }
};

/**
 * Setup all param attributes, e.g. track-by,
 * transition-mode, etc...
 */

Directive.prototype._setupParams = function () {
  if (!this.params) {
    return;
  }
  var params = this.params;
  // swap the params array with a fresh object.
  this.params = Object.create(null);
  var i = params.length;
  var key, val, mappedKey;
  while (i--) {
    key = hyphenate(params[i]);
    mappedKey = camelize(key);
    val = getBindAttr(this.el, key);
    if (val != null) {
      // dynamic
      this._setupParamWatcher(mappedKey, val);
    } else {
      // static
      val = getAttr(this.el, key);
      if (val != null) {
        this.params[mappedKey] = val === '' ? true : val;
      }
    }
  }
};

/**
 * Setup a watcher for a dynamic param.
 *
 * @param {String} key
 * @param {String} expression
 */

Directive.prototype._setupParamWatcher = function (key, expression) {
  var self = this;
  var called = false;
  var unwatch = (this._scope || this.vm).$watch(expression, function (val, oldVal) {
    self.params[key] = val;
    // since we are in immediate mode,
    // only call the param change callbacks if this is not the first update.
    if (called) {
      var cb = self.paramWatchers && self.paramWatchers[key];
      if (cb) {
        cb.call(self, val, oldVal);
      }
    } else {
      called = true;
    }
  }, {
    immediate: true,
    user: false
  });(this._paramUnwatchFns || (this._paramUnwatchFns = [])).push(unwatch);
};

/**
 * Check if the directive is a function caller
 * and if the expression is a callable one. If both true,
 * we wrap up the expression and use it as the event
 * handler.
 *
 * e.g. on-click="a++"
 *
 * @return {Boolean}
 */

Directive.prototype._checkStatement = function () {
  var expression = this.expression;
  if (expression && this.acceptStatement && !isSimplePath(expression)) {
    var fn = parseExpression$1(expression).get;
    var scope = this._scope || this.vm;
    var handler = function handler(e) {
      scope.$event = e;
      fn.call(scope, scope);
      scope.$event = null;
    };
    if (this.filters) {
      handler = scope._applyFilters(handler, null, this.filters);
    }
    this.update(handler);
    return true;
  }
};

/**
 * Set the corresponding value with the setter.
 * This should only be used in two-way directives
 * e.g. v-model.
 *
 * @param {*} value
 * @public
 */

Directive.prototype.set = function (value) {
  /* istanbul ignore else */
  if (this.twoWay) {
    this._withLock(function () {
      this._watcher.set(value);
    });
  } else if (process.env.NODE_ENV !== 'production') {
    warn('Directive.set() can only be used inside twoWay' + 'directives.');
  }
};

/**
 * Execute a function while preventing that function from
 * triggering updates on this directive instance.
 *
 * @param {Function} fn
 */

Directive.prototype._withLock = function (fn) {
  var self = this;
  self._locked = true;
  fn.call(self);
  nextTick(function () {
    self._locked = false;
  });
};

/**
 * Convenience method that attaches a DOM event listener
 * to the directive element and autometically tears it down
 * during unbind.
 *
 * @param {String} event
 * @param {Function} handler
 * @param {Boolean} [useCapture]
 */

Directive.prototype.on = function (event, handler, useCapture) {
  on(this.el, event, handler, useCapture);(this._listeners || (this._listeners = [])).push([event, handler]);
};

/**
 * Teardown the watcher and call unbind.
 */

Directive.prototype._teardown = function () {
  if (this._bound) {
    this._bound = false;
    if (this.unbind) {
      this.unbind();
    }
    if (this._watcher) {
      this._watcher.teardown();
    }
    var listeners = this._listeners;
    var i;
    if (listeners) {
      i = listeners.length;
      while (i--) {
        off(this.el, listeners[i][0], listeners[i][1]);
      }
    }
    var unwatchFns = this._paramUnwatchFns;
    if (unwatchFns) {
      i = unwatchFns.length;
      while (i--) {
        unwatchFns[i]();
      }
    }
    if (process.env.NODE_ENV !== 'production' && this.el) {
      this.el._vue_directives.$remove(this);
    }
    this.vm = this.el = this._watcher = this._listeners = null;
  }
};

function lifecycleMixin (Vue) {
  /**
   * Update v-ref for component.
   *
   * @param {Boolean} remove
   */

  Vue.prototype._updateRef = function (remove) {
    var ref = this.$options._ref;
    if (ref) {
      var refs = (this._scope || this._context).$refs;
      if (remove) {
        if (refs[ref] === this) {
          refs[ref] = null;
        }
      } else {
        refs[ref] = this;
      }
    }
  };

  /**
   * Transclude, compile and link element.
   *
   * If a pre-compiled linker is available, that means the
   * passed in element will be pre-transcluded and compiled
   * as well - all we need to do is to call the linker.
   *
   * Otherwise we need to call transclude/compile/link here.
   *
   * @param {Element} el
   */

  Vue.prototype._compile = function (el) {
    var options = this.$options;

    // transclude and init element
    // transclude can potentially replace original
    // so we need to keep reference; this step also injects
    // the template and caches the original attributes
    // on the container node and replacer node.
    var original = el;
    el = transclude(el, options);
    this._initElement(el);

    // handle v-pre on root node (#2026)
    if (el.nodeType === 1 && getAttr(el, 'v-pre') !== null) {
      return;
    }

    // root is always compiled per-instance, because
    // container attrs and props can be different every time.
    var contextOptions = this._context && this._context.$options;
    var rootLinker = compileRoot(el, options, contextOptions);

    // resolve slot distribution
    resolveSlots(this, options._content);

    // compile and link the rest
    var contentLinkFn;
    var ctor = this.constructor;
    // component compilation can be cached
    // as long as it's not using inline-template
    if (options._linkerCachable) {
      contentLinkFn = ctor.linker;
      if (!contentLinkFn) {
        contentLinkFn = ctor.linker = compile(el, options);
      }
    }

    // link phase
    // make sure to link root with prop scope!
    var rootUnlinkFn = rootLinker(this, el, this._scope);
    var contentUnlinkFn = contentLinkFn ? contentLinkFn(this, el) : compile(el, options)(this, el);

    // register composite unlink function
    // to be called during instance destruction
    this._unlinkFn = function () {
      rootUnlinkFn();
      // passing destroying: true to avoid searching and
      // splicing the directives
      contentUnlinkFn(true);
    };

    // finally replace original
    if (options.replace) {
      replace(original, el);
    }

    this._isCompiled = true;
    this._callHook('compiled');
  };

  /**
   * Initialize instance element. Called in the public
   * $mount() method.
   *
   * @param {Element} el
   */

  Vue.prototype._initElement = function (el) {
    if (isFragment(el)) {
      this._isFragment = true;
      this.$el = this._fragmentStart = el.firstChild;
      this._fragmentEnd = el.lastChild;
      // set persisted text anchors to empty
      if (this._fragmentStart.nodeType === 3) {
        this._fragmentStart.data = this._fragmentEnd.data = '';
      }
      this._fragment = el;
    } else {
      this.$el = el;
    }
    this.$el.__vue__ = this;
    this._callHook('beforeCompile');
  };

  /**
   * Create and bind a directive to an element.
   *
   * @param {Object} descriptor - parsed directive descriptor
   * @param {Node} node   - target node
   * @param {Vue} [host] - transclusion host component
   * @param {Object} [scope] - v-for scope
   * @param {Fragment} [frag] - owner fragment
   */

  Vue.prototype._bindDir = function (descriptor, node, host, scope, frag) {
    this._directives.push(new Directive(descriptor, this, node, host, scope, frag));
  };

  /**
   * Teardown an instance, unobserves the data, unbind all the
   * directives, turn off all the event listeners, etc.
   *
   * @param {Boolean} remove - whether to remove the DOM node.
   * @param {Boolean} deferCleanup - if true, defer cleanup to
   *                                 be called later
   */

  Vue.prototype._destroy = function (remove, deferCleanup) {
    if (this._isBeingDestroyed) {
      if (!deferCleanup) {
        this._cleanup();
      }
      return;
    }

    var destroyReady;
    var pendingRemoval;

    var self = this;
    // Cleanup should be called either synchronously or asynchronoysly as
    // callback of this.$remove(), or if remove and deferCleanup are false.
    // In any case it should be called after all other removing, unbinding and
    // turning of is done
    var cleanupIfPossible = function cleanupIfPossible() {
      if (destroyReady && !pendingRemoval && !deferCleanup) {
        self._cleanup();
      }
    };

    // remove DOM element
    if (remove && this.$el) {
      pendingRemoval = true;
      this.$remove(function () {
        pendingRemoval = false;
        cleanupIfPossible();
      });
    }

    this._callHook('beforeDestroy');
    this._isBeingDestroyed = true;
    var i;
    // remove self from parent. only necessary
    // if parent is not being destroyed as well.
    var parent = this.$parent;
    if (parent && !parent._isBeingDestroyed) {
      parent.$children.$remove(this);
      // unregister ref (remove: true)
      this._updateRef(true);
    }
    // destroy all children.
    i = this.$children.length;
    while (i--) {
      this.$children[i].$destroy();
    }
    // teardown props
    if (this._propsUnlinkFn) {
      this._propsUnlinkFn();
    }
    // teardown all directives. this also tearsdown all
    // directive-owned watchers.
    if (this._unlinkFn) {
      this._unlinkFn();
    }
    i = this._watchers.length;
    while (i--) {
      this._watchers[i].teardown();
    }
    // remove reference to self on $el
    if (this.$el) {
      this.$el.__vue__ = null;
    }

    destroyReady = true;
    cleanupIfPossible();
  };

  /**
   * Clean up to ensure garbage collection.
   * This is called after the leave transition if there
   * is any.
   */

  Vue.prototype._cleanup = function () {
    if (this._isDestroyed) {
      return;
    }
    // remove self from owner fragment
    // do it in cleanup so that we can call $destroy with
    // defer right when a fragment is about to be removed.
    if (this._frag) {
      this._frag.children.$remove(this);
    }
    // remove reference from data ob
    // frozen object may not have observer.
    if (this._data && this._data.__ob__) {
      this._data.__ob__.removeVm(this);
    }
    // Clean up references to private properties and other
    // instances. preserve reference to _data so that proxy
    // accessors still work. The only potential side effect
    // here is that mutating the instance after it's destroyed
    // may affect the state of other components that are still
    // observing the same object, but that seems to be a
    // reasonable responsibility for the user rather than
    // always throwing an error on them.
    this.$el = this.$parent = this.$root = this.$children = this._watchers = this._context = this._scope = this._directives = null;
    // call the last hook...
    this._isDestroyed = true;
    this._callHook('destroyed');
    // turn off all instance listeners.
    this.$off();
  };
}

function miscMixin (Vue) {
  /**
   * Apply a list of filter (descriptors) to a value.
   * Using plain for loops here because this will be called in
   * the getter of any watcher with filters so it is very
   * performance sensitive.
   *
   * @param {*} value
   * @param {*} [oldValue]
   * @param {Array} filters
   * @param {Boolean} write
   * @return {*}
   */

  Vue.prototype._applyFilters = function (value, oldValue, filters, write) {
    var filter, fn, args, arg, offset, i, l, j, k;
    for (i = 0, l = filters.length; i < l; i++) {
      filter = filters[write ? l - i - 1 : i];
      fn = resolveAsset(this.$options, 'filters', filter.name, true);
      if (!fn) continue;
      fn = write ? fn.write : fn.read || fn;
      if (typeof fn !== 'function') continue;
      args = write ? [value, oldValue] : [value];
      offset = write ? 2 : 1;
      if (filter.args) {
        for (j = 0, k = filter.args.length; j < k; j++) {
          arg = filter.args[j];
          args[j + offset] = arg.dynamic ? this.$get(arg.value) : arg.value;
        }
      }
      value = fn.apply(this, args);
    }
    return value;
  };

  /**
   * Resolve a component, depending on whether the component
   * is defined normally or using an async factory function.
   * Resolves synchronously if already resolved, otherwise
   * resolves asynchronously and caches the resolved
   * constructor on the factory.
   *
   * @param {String|Function} value
   * @param {Function} cb
   */

  Vue.prototype._resolveComponent = function (value, cb) {
    var factory;
    if (typeof value === 'function') {
      factory = value;
    } else {
      factory = resolveAsset(this.$options, 'components', value, true);
    }
    /* istanbul ignore if */
    if (!factory) {
      return;
    }
    // async component factory
    if (!factory.options) {
      if (factory.resolved) {
        // cached
        cb(factory.resolved);
      } else if (factory.requested) {
        // pool callbacks
        factory.pendingCallbacks.push(cb);
      } else {
        factory.requested = true;
        var cbs = factory.pendingCallbacks = [cb];
        factory.call(this, function resolve(res) {
          if (isPlainObject(res)) {
            res = Vue.extend(res);
          }
          // cache resolved
          factory.resolved = res;
          // invoke callbacks
          for (var i = 0, l = cbs.length; i < l; i++) {
            cbs[i](res);
          }
        }, function reject(reason) {
          process.env.NODE_ENV !== 'production' && warn('Failed to resolve async component' + (typeof value === 'string' ? ': ' + value : '') + '. ' + (reason ? '\nReason: ' + reason : ''));
        });
      }
    } else {
      // normal component
      cb(factory);
    }
  };
}

var filterRE$1 = /[^|]\|[^|]/;

function dataAPI (Vue) {
  /**
   * Get the value from an expression on this vm.
   *
   * @param {String} exp
   * @param {Boolean} [asStatement]
   * @return {*}
   */

  Vue.prototype.$get = function (exp, asStatement) {
    var res = parseExpression$1(exp);
    if (res) {
      if (asStatement) {
        var self = this;
        return function statementHandler() {
          self.$arguments = toArray(arguments);
          var result = res.get.call(self, self);
          self.$arguments = null;
          return result;
        };
      } else {
        try {
          return res.get.call(this, this);
        } catch (e) {}
      }
    }
  };

  /**
   * Set the value from an expression on this vm.
   * The expression must be a valid left-hand
   * expression in an assignment.
   *
   * @param {String} exp
   * @param {*} val
   */

  Vue.prototype.$set = function (exp, val) {
    var res = parseExpression$1(exp, true);
    if (res && res.set) {
      res.set.call(this, this, val);
    }
  };

  /**
   * Delete a property on the VM
   *
   * @param {String} key
   */

  Vue.prototype.$delete = function (key) {
    del(this._data, key);
  };

  /**
   * Watch an expression, trigger callback when its
   * value changes.
   *
   * @param {String|Function} expOrFn
   * @param {Function} cb
   * @param {Object} [options]
   *                 - {Boolean} deep
   *                 - {Boolean} immediate
   * @return {Function} - unwatchFn
   */

  Vue.prototype.$watch = function (expOrFn, cb, options) {
    var vm = this;
    var parsed;
    if (typeof expOrFn === 'string') {
      parsed = parseDirective(expOrFn);
      expOrFn = parsed.expression;
    }
    var watcher = new Watcher(vm, expOrFn, cb, {
      deep: options && options.deep,
      sync: options && options.sync,
      filters: parsed && parsed.filters,
      user: !options || options.user !== false
    });
    if (options && options.immediate) {
      cb.call(vm, watcher.value);
    }
    return function unwatchFn() {
      watcher.teardown();
    };
  };

  /**
   * Evaluate a text directive, including filters.
   *
   * @param {String} text
   * @param {Boolean} [asStatement]
   * @return {String}
   */

  Vue.prototype.$eval = function (text, asStatement) {
    // check for filters.
    if (filterRE$1.test(text)) {
      var dir = parseDirective(text);
      // the filter regex check might give false positive
      // for pipes inside strings, so it's possible that
      // we don't get any filters here
      var val = this.$get(dir.expression, asStatement);
      return dir.filters ? this._applyFilters(val, null, dir.filters) : val;
    } else {
      // no filter
      return this.$get(text, asStatement);
    }
  };

  /**
   * Interpolate a piece of template text.
   *
   * @param {String} text
   * @return {String}
   */

  Vue.prototype.$interpolate = function (text) {
    var tokens = parseText(text);
    var vm = this;
    if (tokens) {
      if (tokens.length === 1) {
        return vm.$eval(tokens[0].value) + '';
      } else {
        return tokens.map(function (token) {
          return token.tag ? vm.$eval(token.value) : token.value;
        }).join('');
      }
    } else {
      return text;
    }
  };

  /**
   * Log instance data as a plain JS object
   * so that it is easier to inspect in console.
   * This method assumes console is available.
   *
   * @param {String} [path]
   */

  Vue.prototype.$log = function (path) {
    var data = path ? getPath(this._data, path) : this._data;
    if (data) {
      data = clean(data);
    }
    // include computed fields
    if (!path) {
      var key;
      for (key in this.$options.computed) {
        data[key] = clean(this[key]);
      }
      if (this._props) {
        for (key in this._props) {
          data[key] = clean(this[key]);
        }
      }
    }
    console.log(data);
  };

  /**
   * "clean" a getter/setter converted object into a plain
   * object copy.
   *
   * @param {Object} - obj
   * @return {Object}
   */

  function clean(obj) {
    return JSON.parse(JSON.stringify(obj));
  }
}

function domAPI (Vue) {
  /**
   * Convenience on-instance nextTick. The callback is
   * auto-bound to the instance, and this avoids component
   * modules having to rely on the global Vue.
   *
   * @param {Function} fn
   */

  Vue.prototype.$nextTick = function (fn) {
    nextTick(fn, this);
  };

  /**
   * Append instance to target
   *
   * @param {Node} target
   * @param {Function} [cb]
   * @param {Boolean} [withTransition] - defaults to true
   */

  Vue.prototype.$appendTo = function (target, cb, withTransition) {
    return insert(this, target, cb, withTransition, append, appendWithTransition);
  };

  /**
   * Prepend instance to target
   *
   * @param {Node} target
   * @param {Function} [cb]
   * @param {Boolean} [withTransition] - defaults to true
   */

  Vue.prototype.$prependTo = function (target, cb, withTransition) {
    target = query(target);
    if (target.hasChildNodes()) {
      this.$before(target.firstChild, cb, withTransition);
    } else {
      this.$appendTo(target, cb, withTransition);
    }
    return this;
  };

  /**
   * Insert instance before target
   *
   * @param {Node} target
   * @param {Function} [cb]
   * @param {Boolean} [withTransition] - defaults to true
   */

  Vue.prototype.$before = function (target, cb, withTransition) {
    return insert(this, target, cb, withTransition, beforeWithCb, beforeWithTransition);
  };

  /**
   * Insert instance after target
   *
   * @param {Node} target
   * @param {Function} [cb]
   * @param {Boolean} [withTransition] - defaults to true
   */

  Vue.prototype.$after = function (target, cb, withTransition) {
    target = query(target);
    if (target.nextSibling) {
      this.$before(target.nextSibling, cb, withTransition);
    } else {
      this.$appendTo(target.parentNode, cb, withTransition);
    }
    return this;
  };

  /**
   * Remove instance from DOM
   *
   * @param {Function} [cb]
   * @param {Boolean} [withTransition] - defaults to true
   */

  Vue.prototype.$remove = function (cb, withTransition) {
    if (!this.$el.parentNode) {
      return cb && cb();
    }
    var inDocument = this._isAttached && inDoc(this.$el);
    // if we are not in document, no need to check
    // for transitions
    if (!inDocument) withTransition = false;
    var self = this;
    var realCb = function realCb() {
      if (inDocument) self._callHook('detached');
      if (cb) cb();
    };
    if (this._isFragment) {
      removeNodeRange(this._fragmentStart, this._fragmentEnd, this, this._fragment, realCb);
    } else {
      var op = withTransition === false ? removeWithCb : removeWithTransition;
      op(this.$el, this, realCb);
    }
    return this;
  };

  /**
   * Shared DOM insertion function.
   *
   * @param {Vue} vm
   * @param {Element} target
   * @param {Function} [cb]
   * @param {Boolean} [withTransition]
   * @param {Function} op1 - op for non-transition insert
   * @param {Function} op2 - op for transition insert
   * @return vm
   */

  function insert(vm, target, cb, withTransition, op1, op2) {
    target = query(target);
    var targetIsDetached = !inDoc(target);
    var op = withTransition === false || targetIsDetached ? op1 : op2;
    var shouldCallHook = !targetIsDetached && !vm._isAttached && !inDoc(vm.$el);
    if (vm._isFragment) {
      mapNodeRange(vm._fragmentStart, vm._fragmentEnd, function (node) {
        op(node, target, vm);
      });
      cb && cb();
    } else {
      op(vm.$el, target, vm, cb);
    }
    if (shouldCallHook) {
      vm._callHook('attached');
    }
    return vm;
  }

  /**
   * Check for selectors
   *
   * @param {String|Element} el
   */

  function query(el) {
    return typeof el === 'string' ? document.querySelector(el) : el;
  }

  /**
   * Append operation that takes a callback.
   *
   * @param {Node} el
   * @param {Node} target
   * @param {Vue} vm - unused
   * @param {Function} [cb]
   */

  function append(el, target, vm, cb) {
    target.appendChild(el);
    if (cb) cb();
  }

  /**
   * InsertBefore operation that takes a callback.
   *
   * @param {Node} el
   * @param {Node} target
   * @param {Vue} vm - unused
   * @param {Function} [cb]
   */

  function beforeWithCb(el, target, vm, cb) {
    before(el, target);
    if (cb) cb();
  }

  /**
   * Remove operation that takes a callback.
   *
   * @param {Node} el
   * @param {Vue} vm - unused
   * @param {Function} [cb]
   */

  function removeWithCb(el, vm, cb) {
    remove(el);
    if (cb) cb();
  }
}

function eventsAPI (Vue) {
  /**
   * Listen on the given `event` with `fn`.
   *
   * @param {String} event
   * @param {Function} fn
   */

  Vue.prototype.$on = function (event, fn) {
    (this._events[event] || (this._events[event] = [])).push(fn);
    modifyListenerCount(this, event, 1);
    return this;
  };

  /**
   * Adds an `event` listener that will be invoked a single
   * time then automatically removed.
   *
   * @param {String} event
   * @param {Function} fn
   */

  Vue.prototype.$once = function (event, fn) {
    var self = this;
    function on() {
      self.$off(event, on);
      fn.apply(this, arguments);
    }
    on.fn = fn;
    this.$on(event, on);
    return this;
  };

  /**
   * Remove the given callback for `event` or all
   * registered callbacks.
   *
   * @param {String} event
   * @param {Function} fn
   */

  Vue.prototype.$off = function (event, fn) {
    var cbs;
    // all
    if (!arguments.length) {
      if (this.$parent) {
        for (event in this._events) {
          cbs = this._events[event];
          if (cbs) {
            modifyListenerCount(this, event, -cbs.length);
          }
        }
      }
      this._events = {};
      return this;
    }
    // specific event
    cbs = this._events[event];
    if (!cbs) {
      return this;
    }
    if (arguments.length === 1) {
      modifyListenerCount(this, event, -cbs.length);
      this._events[event] = null;
      return this;
    }
    // specific handler
    var cb;
    var i = cbs.length;
    while (i--) {
      cb = cbs[i];
      if (cb === fn || cb.fn === fn) {
        modifyListenerCount(this, event, -1);
        cbs.splice(i, 1);
        break;
      }
    }
    return this;
  };

  /**
   * Trigger an event on self.
   *
   * @param {String|Object} event
   * @return {Boolean} shouldPropagate
   */

  Vue.prototype.$emit = function (event) {
    var isSource = typeof event === 'string';
    event = isSource ? event : event.name;
    var cbs = this._events[event];
    var shouldPropagate = isSource || !cbs;
    if (cbs) {
      cbs = cbs.length > 1 ? toArray(cbs) : cbs;
      // this is a somewhat hacky solution to the question raised
      // in #2102: for an inline component listener like <comp @test="doThis">,
      // the propagation handling is somewhat broken. Therefore we
      // need to treat these inline callbacks differently.
      var hasParentCbs = isSource && cbs.some(function (cb) {
        return cb._fromParent;
      });
      if (hasParentCbs) {
        shouldPropagate = false;
      }
      var args = toArray(arguments, 1);
      for (var i = 0, l = cbs.length; i < l; i++) {
        var cb = cbs[i];
        var res = cb.apply(this, args);
        if (res === true && (!hasParentCbs || cb._fromParent)) {
          shouldPropagate = true;
        }
      }
    }
    return shouldPropagate;
  };

  /**
   * Recursively broadcast an event to all children instances.
   *
   * @param {String|Object} event
   * @param {...*} additional arguments
   */

  Vue.prototype.$broadcast = function (event) {
    var isSource = typeof event === 'string';
    event = isSource ? event : event.name;
    // if no child has registered for this event,
    // then there's no need to broadcast.
    if (!this._eventsCount[event]) return;
    var children = this.$children;
    var args = toArray(arguments);
    if (isSource) {
      // use object event to indicate non-source emit
      // on children
      args[0] = { name: event, source: this };
    }
    for (var i = 0, l = children.length; i < l; i++) {
      var child = children[i];
      var shouldPropagate = child.$emit.apply(child, args);
      if (shouldPropagate) {
        child.$broadcast.apply(child, args);
      }
    }
    return this;
  };

  /**
   * Recursively propagate an event up the parent chain.
   *
   * @param {String} event
   * @param {...*} additional arguments
   */

  Vue.prototype.$dispatch = function (event) {
    var shouldPropagate = this.$emit.apply(this, arguments);
    if (!shouldPropagate) return;
    var parent = this.$parent;
    var args = toArray(arguments);
    // use object event to indicate non-source emit
    // on parents
    args[0] = { name: event, source: this };
    while (parent) {
      shouldPropagate = parent.$emit.apply(parent, args);
      parent = shouldPropagate ? parent.$parent : null;
    }
    return this;
  };

  /**
   * Modify the listener counts on all parents.
   * This bookkeeping allows $broadcast to return early when
   * no child has listened to a certain event.
   *
   * @param {Vue} vm
   * @param {String} event
   * @param {Number} count
   */

  var hookRE = /^hook:/;
  function modifyListenerCount(vm, event, count) {
    var parent = vm.$parent;
    // hooks do not get broadcasted so no need
    // to do bookkeeping for them
    if (!parent || !count || hookRE.test(event)) return;
    while (parent) {
      parent._eventsCount[event] = (parent._eventsCount[event] || 0) + count;
      parent = parent.$parent;
    }
  }
}

function lifecycleAPI (Vue) {
  /**
   * Set instance target element and kick off the compilation
   * process. The passed in `el` can be a selector string, an
   * existing Element, or a DocumentFragment (for block
   * instances).
   *
   * @param {Element|DocumentFragment|string} el
   * @public
   */

  Vue.prototype.$mount = function (el) {
    if (this._isCompiled) {
      process.env.NODE_ENV !== 'production' && warn('$mount() should be called only once.', this);
      return;
    }
    el = query(el);
    if (!el) {
      el = document.createElement('div');
    }
    this._compile(el);
    this._initDOMHooks();
    if (inDoc(this.$el)) {
      this._callHook('attached');
      ready.call(this);
    } else {
      this.$once('hook:attached', ready);
    }
    return this;
  };

  /**
   * Mark an instance as ready.
   */

  function ready() {
    this._isAttached = true;
    this._isReady = true;
    this._callHook('ready');
  }

  /**
   * Teardown the instance, simply delegate to the internal
   * _destroy.
   *
   * @param {Boolean} remove
   * @param {Boolean} deferCleanup
   */

  Vue.prototype.$destroy = function (remove, deferCleanup) {
    this._destroy(remove, deferCleanup);
  };

  /**
   * Partially compile a piece of DOM and return a
   * decompile function.
   *
   * @param {Element|DocumentFragment} el
   * @param {Vue} [host]
   * @param {Object} [scope]
   * @param {Fragment} [frag]
   * @return {Function}
   */

  Vue.prototype.$compile = function (el, host, scope, frag) {
    return compile(el, this.$options, true)(this, el, host, scope, frag);
  };
}

/**
 * The exposed Vue constructor.
 *
 * API conventions:
 * - public API methods/properties are prefixed with `$`
 * - internal methods/properties are prefixed with `_`
 * - non-prefixed properties are assumed to be proxied user
 *   data.
 *
 * @constructor
 * @param {Object} [options]
 * @public
 */

function Vue(options) {
  this._init(options);
}

// install internals
initMixin(Vue);
stateMixin(Vue);
eventsMixin(Vue);
lifecycleMixin(Vue);
miscMixin(Vue);

// install instance APIs
dataAPI(Vue);
domAPI(Vue);
eventsAPI(Vue);
lifecycleAPI(Vue);

var slot = {

  priority: SLOT,
  params: ['name'],

  bind: function bind() {
    // this was resolved during component transclusion
    var name = this.params.name || 'default';
    var content = this.vm._slotContents && this.vm._slotContents[name];
    if (!content || !content.hasChildNodes()) {
      this.fallback();
    } else {
      this.compile(content.cloneNode(true), this.vm._context, this.vm);
    }
  },

  compile: function compile(content, context, host) {
    if (content && context) {
      if (this.el.hasChildNodes() && content.childNodes.length === 1 && content.childNodes[0].nodeType === 1 && content.childNodes[0].hasAttribute('v-if')) {
        // if the inserted slot has v-if
        // inject fallback content as the v-else
        var elseBlock = document.createElement('template');
        elseBlock.setAttribute('v-else', '');
        elseBlock.innerHTML = this.el.innerHTML;
        // the else block should be compiled in child scope
        elseBlock._context = this.vm;
        content.appendChild(elseBlock);
      }
      var scope = host ? host._scope : this._scope;
      this.unlink = context.$compile(content, host, scope, this._frag);
    }
    if (content) {
      replace(this.el, content);
    } else {
      remove(this.el);
    }
  },

  fallback: function fallback() {
    this.compile(extractContent(this.el, true), this.vm);
  },

  unbind: function unbind() {
    if (this.unlink) {
      this.unlink();
    }
  }
};

var partial = {

  priority: PARTIAL,

  params: ['name'],

  // watch changes to name for dynamic partials
  paramWatchers: {
    name: function name(value) {
      vIf.remove.call(this);
      if (value) {
        this.insert(value);
      }
    }
  },

  bind: function bind() {
    this.anchor = createAnchor('v-partial');
    replace(this.el, this.anchor);
    this.insert(this.params.name);
  },

  insert: function insert(id) {
    var partial = resolveAsset(this.vm.$options, 'partials', id, true);
    if (partial) {
      this.factory = new FragmentFactory(this.vm, partial);
      vIf.insert.call(this);
    }
  },

  unbind: function unbind() {
    if (this.frag) {
      this.frag.destroy();
    }
  }
};

var elementDirectives = {
  slot: slot,
  partial: partial
};

var convertArray = vFor._postProcess;

/**
 * Limit filter for arrays
 *
 * @param {Number} n
 * @param {Number} offset (Decimal expected)
 */

function limitBy(arr, n, offset) {
  offset = offset ? parseInt(offset, 10) : 0;
  n = toNumber(n);
  return typeof n === 'number' ? arr.slice(offset, offset + n) : arr;
}

/**
 * Filter filter for arrays
 *
 * @param {String} search
 * @param {String} [delimiter]
 * @param {String} ...dataKeys
 */

function filterBy(arr, search, delimiter) {
  arr = convertArray(arr);
  if (search == null) {
    return arr;
  }
  if (typeof search === 'function') {
    return arr.filter(search);
  }
  // cast to lowercase string
  search = ('' + search).toLowerCase();
  // allow optional `in` delimiter
  // because why not
  var n = delimiter === 'in' ? 3 : 2;
  // extract and flatten keys
  var keys = Array.prototype.concat.apply([], toArray(arguments, n));
  var res = [];
  var item, key, val, j;
  for (var i = 0, l = arr.length; i < l; i++) {
    item = arr[i];
    val = item && item.$value || item;
    j = keys.length;
    if (j) {
      while (j--) {
        key = keys[j];
        if (key === '$key' && contains(item.$key, search) || contains(getPath(val, key), search)) {
          res.push(item);
          break;
        }
      }
    } else if (contains(item, search)) {
      res.push(item);
    }
  }
  return res;
}

/**
 * Order filter for arrays
 *
 * @param {String|Array<String>|Function} ...sortKeys
 * @param {Number} [order]
 */

function orderBy(arr) {
  var comparator = null;
  var sortKeys = undefined;
  arr = convertArray(arr);

  // determine order (last argument)
  var args = toArray(arguments, 1);
  var order = args[args.length - 1];
  if (typeof order === 'number') {
    order = order < 0 ? -1 : 1;
    args = args.length > 1 ? args.slice(0, -1) : args;
  } else {
    order = 1;
  }

  // determine sortKeys & comparator
  var firstArg = args[0];
  if (!firstArg) {
    return arr;
  } else if (typeof firstArg === 'function') {
    // custom comparator
    comparator = function (a, b) {
      return firstArg(a, b) * order;
    };
  } else {
    // string keys. flatten first
    sortKeys = Array.prototype.concat.apply([], args);
    comparator = function (a, b, i) {
      i = i || 0;
      return i >= sortKeys.length - 1 ? baseCompare(a, b, i) : baseCompare(a, b, i) || comparator(a, b, i + 1);
    };
  }

  function baseCompare(a, b, sortKeyIndex) {
    var sortKey = sortKeys[sortKeyIndex];
    if (sortKey) {
      if (sortKey !== '$key') {
        if (isObject(a) && '$value' in a) a = a.$value;
        if (isObject(b) && '$value' in b) b = b.$value;
      }
      a = isObject(a) ? getPath(a, sortKey) : a;
      b = isObject(b) ? getPath(b, sortKey) : b;
    }
    return a === b ? 0 : a > b ? order : -order;
  }

  // sort on a copy to avoid mutating original array
  return arr.slice().sort(comparator);
}

/**
 * String contain helper
 *
 * @param {*} val
 * @param {String} search
 */

function contains(val, search) {
  var i;
  if (isPlainObject(val)) {
    var keys = Object.keys(val);
    i = keys.length;
    while (i--) {
      if (contains(val[keys[i]], search)) {
        return true;
      }
    }
  } else if (isArray(val)) {
    i = val.length;
    while (i--) {
      if (contains(val[i], search)) {
        return true;
      }
    }
  } else if (val != null) {
    return val.toString().toLowerCase().indexOf(search) > -1;
  }
}

var digitsRE = /(\d{3})(?=\d)/g;

// asset collections must be a plain object.
var filters = {

  orderBy: orderBy,
  filterBy: filterBy,
  limitBy: limitBy,

  /**
   * Stringify value.
   *
   * @param {Number} indent
   */

  json: {
    read: function read(value, indent) {
      return typeof value === 'string' ? value : JSON.stringify(value, null, arguments.length > 1 ? indent : 2);
    },
    write: function write(value) {
      try {
        return JSON.parse(value);
      } catch (e) {
        return value;
      }
    }
  },

  /**
   * 'abc' => 'Abc'
   */

  capitalize: function capitalize(value) {
    if (!value && value !== 0) return '';
    value = value.toString();
    return value.charAt(0).toUpperCase() + value.slice(1);
  },

  /**
   * 'abc' => 'ABC'
   */

  uppercase: function uppercase(value) {
    return value || value === 0 ? value.toString().toUpperCase() : '';
  },

  /**
   * 'AbC' => 'abc'
   */

  lowercase: function lowercase(value) {
    return value || value === 0 ? value.toString().toLowerCase() : '';
  },

  /**
   * 12345 => $12,345.00
   *
   * @param {String} sign
   * @param {Number} decimals Decimal places
   */

  currency: function currency(value, _currency, decimals) {
    value = parseFloat(value);
    if (!isFinite(value) || !value && value !== 0) return '';
    _currency = _currency != null ? _currency : '$';
    decimals = decimals != null ? decimals : 2;
    var stringified = Math.abs(value).toFixed(decimals);
    var _int = decimals ? stringified.slice(0, -1 - decimals) : stringified;
    var i = _int.length % 3;
    var head = i > 0 ? _int.slice(0, i) + (_int.length > 3 ? ',' : '') : '';
    var _float = decimals ? stringified.slice(-1 - decimals) : '';
    var sign = value < 0 ? '-' : '';
    return sign + _currency + head + _int.slice(i).replace(digitsRE, '$1,') + _float;
  },

  /**
   * 'item' => 'items'
   *
   * @params
   *  an array of strings corresponding to
   *  the single, double, triple ... forms of the word to
   *  be pluralized. When the number to be pluralized
   *  exceeds the length of the args, it will use the last
   *  entry in the array.
   *
   *  e.g. ['single', 'double', 'triple', 'multiple']
   */

  pluralize: function pluralize(value) {
    var args = toArray(arguments, 1);
    var length = args.length;
    if (length > 1) {
      var index = value % 10 - 1;
      return index in args ? args[index] : args[length - 1];
    } else {
      return args[0] + (value === 1 ? '' : 's');
    }
  },

  /**
   * Debounce a handler function.
   *
   * @param {Function} handler
   * @param {Number} delay = 300
   * @return {Function}
   */

  debounce: function debounce(handler, delay) {
    if (!handler) return;
    if (!delay) {
      delay = 300;
    }
    return _debounce(handler, delay);
  }
};

function installGlobalAPI (Vue) {
  /**
   * Vue and every constructor that extends Vue has an
   * associated options object, which can be accessed during
   * compilation steps as `this.constructor.options`.
   *
   * These can be seen as the default options of every
   * Vue instance.
   */

  Vue.options = {
    directives: directives,
    elementDirectives: elementDirectives,
    filters: filters,
    transitions: {},
    components: {},
    partials: {},
    replace: true
  };

  /**
   * Expose useful internals
   */

  Vue.util = util;
  Vue.config = config;
  Vue.set = set;
  Vue['delete'] = del;
  Vue.nextTick = nextTick;

  /**
   * The following are exposed for advanced usage / plugins
   */

  Vue.compiler = compiler;
  Vue.FragmentFactory = FragmentFactory;
  Vue.internalDirectives = internalDirectives;
  Vue.parsers = {
    path: path,
    text: text,
    template: template,
    directive: directive,
    expression: expression
  };

  /**
   * Each instance constructor, including Vue, has a unique
   * cid. This enables us to create wrapped "child
   * constructors" for prototypal inheritance and cache them.
   */

  Vue.cid = 0;
  var cid = 1;

  /**
   * Class inheritance
   *
   * @param {Object} extendOptions
   */

  Vue.extend = function (extendOptions) {
    extendOptions = extendOptions || {};
    var Super = this;
    var isFirstExtend = Super.cid === 0;
    if (isFirstExtend && extendOptions._Ctor) {
      return extendOptions._Ctor;
    }
    var name = extendOptions.name || Super.options.name;
    if (process.env.NODE_ENV !== 'production') {
      if (!/^[a-zA-Z][\w-]*$/.test(name)) {
        warn('Invalid component name: "' + name + '". Component names ' + 'can only contain alphanumeric characaters and the hyphen.');
        name = null;
      }
    }
    var Sub = createClass(name || 'VueComponent');
    Sub.prototype = Object.create(Super.prototype);
    Sub.prototype.constructor = Sub;
    Sub.cid = cid++;
    Sub.options = mergeOptions(Super.options, extendOptions);
    Sub['super'] = Super;
    // allow further extension
    Sub.extend = Super.extend;
    // create asset registers, so extended classes
    // can have their private assets too.
    config._assetTypes.forEach(function (type) {
      Sub[type] = Super[type];
    });
    // enable recursive self-lookup
    if (name) {
      Sub.options.components[name] = Sub;
    }
    // cache constructor
    if (isFirstExtend) {
      extendOptions._Ctor = Sub;
    }
    return Sub;
  };

  /**
   * A function that returns a sub-class constructor with the
   * given name. This gives us much nicer output when
   * logging instances in the console.
   *
   * @param {String} name
   * @return {Function}
   */

  function createClass(name) {
    /* eslint-disable no-new-func */
    return new Function('return function ' + classify(name) + ' (options) { this._init(options) }')();
    /* eslint-enable no-new-func */
  }

  /**
   * Plugin system
   *
   * @param {Object} plugin
   */

  Vue.use = function (plugin) {
    /* istanbul ignore if */
    if (plugin.installed) {
      return;
    }
    // additional parameters
    var args = toArray(arguments, 1);
    args.unshift(this);
    if (typeof plugin.install === 'function') {
      plugin.install.apply(plugin, args);
    } else {
      plugin.apply(null, args);
    }
    plugin.installed = true;
    return this;
  };

  /**
   * Apply a global mixin by merging it into the default
   * options.
   */

  Vue.mixin = function (mixin) {
    Vue.options = mergeOptions(Vue.options, mixin);
  };

  /**
   * Create asset registration methods with the following
   * signature:
   *
   * @param {String} id
   * @param {*} definition
   */

  config._assetTypes.forEach(function (type) {
    Vue[type] = function (id, definition) {
      if (!definition) {
        return this.options[type + 's'][id];
      } else {
        /* istanbul ignore if */
        if (process.env.NODE_ENV !== 'production') {
          if (type === 'component' && (commonTagRE.test(id) || reservedTagRE.test(id))) {
            warn('Do not use built-in or reserved HTML elements as component ' + 'id: ' + id);
          }
        }
        if (type === 'component' && isPlainObject(definition)) {
          if (!definition.name) {
            definition.name = id;
          }
          definition = Vue.extend(definition);
        }
        this.options[type + 's'][id] = definition;
        return definition;
      }
    };
  });

  // expose internal transition API
  extend(Vue.transition, transition);
}

installGlobalAPI(Vue);

Vue.version = '1.0.28';

// devtools global hook
/* istanbul ignore next */
setTimeout(function () {
  if (config.devtools) {
    if (devtools) {
      devtools.emit('init', Vue);
    } else if (process.env.NODE_ENV !== 'production' && inBrowser && /Chrome\/\d+/.test(window.navigator.userAgent)) {
      console.log('Download the Vue Devtools for a better development experience:\n' + 'https://github.com/vuejs/vue-devtools');
    }
  }
}, 0);

module.exports = Vue;
}).call(this,require('_process'))
},{"_process":102}],107:[function(require,module,exports){
var inserted = exports.cache = {}

exports.insert = function (css) {
  if (inserted[css]) return
  inserted[css] = true

  var elem = document.createElement('style')
  elem.setAttribute('type', 'text/css')

  if ('textContent' in elem) {
    elem.textContent = css
  } else {
    elem.styleSheet.cssText = css
  }

  document.getElementsByTagName('head')[0].appendChild(elem)
  return elem
}

},{}],108:[function(require,module,exports){
var __vueify_insert__ = require("vueify/lib/insert-css")
var __vueify_style__ = __vueify_insert__.insert("\n#submit-area[_v-3a158057]{\n  background: #e1e1e1;\n  margin:20px 0 0 0;\n}\np[_v-3a158057] {\n  margin:0;\n}\nlabel[_v-3a158057] {\n  margin-top: 3px;\n  margin-bottom: 3px;\n  display: block;\n}\n\nlabel > span[_v-3a158057] {\n  display: inline-block;\n  vertical-align: top;\n}\n\n.input-group input[type='text'][_v-3a158057] {\n  marging-bottom: 0;\n}\nlabel input[_v-3a158057] {\n  font-weight: 400;\n}\n\ninput[type='number'][_v-3a158057] {\n  marging-bottom: 0;\n}\n.valid-titleField[_v-3a158057] {\n  background-color: #fefefe;\n  border-color: #cacaca;\n}\n.no-input[_v-3a158057] {\n  background-color: #fefefe;\n  border-color: #cacaca;\n}\n.invalid-input[_v-3a158057] {\n  background-color: rgba(236, 88, 64, 0.1);\n  border: 1px dotted red;\n}\n.invalid[_v-3a158057] {\n  color: #ff0000;\n}\n.reqstar[_v-3a158057] {\n  font-size: .7rem;\n  color: #E33100;\n  vertical-align:text-top;\n}\n\nselect[_v-3a158057] {\n  margin: 0;\n}\n\n[type='submit'][_v-3a158057], [type='button'][_v-3a158057] {\n  margin-top: 0.8rem;\n}\ninput[type=\"number\"][_v-3a158057]{\n  margin: 0;\n}\ninput[type=\"text\"][_v-3a158057]{\n  margin: 0;\n}\nform[_v-3a158057] {\n  padding-bottom: 20px;\n}\n.yellowBtn[_v-3a158057] {\n  background: hsl(60, 70%, 50%);\n}\n.redBtn[_v-3a158057] {\n  background: hsl(0, 90%, 70%);\n}\nh5.form-control[_v-3a158057], .mockh5[_v-3a158057] {\n  margin: 0;\n  display: block;\n  width: 100%;\n  padding: .5rem;\n  font-size: 14px;\n  line-height: 1.42857143;\n  color: #222222;\n  background-color: #fff;\n  background-image: none;\n  border: 1px solid #ccc;\n  border-radius: 4px;\n  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\n  transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;\n}\ntextarea[_v-3a158057] {\n  resize: vertical !important;\n}\n")
"use strict";

var _stringify = require("babel-runtime/core-js/json/stringify");

var _stringify2 = _interopRequireDefault(_stringify);

var _flatpickr = require("flatpickr");

var _flatpickr2 = _interopRequireDefault(_flatpickr);

var _vueSelect = require("vue-select");

var _vueSelect2 = _interopRequireDefault(_vueSelect);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

module.exports = {
  directives: {},
  components: { vSelect: _vueSelect2.default },
  props: {
    recordexists: { default: false },
    recordid: { default: '' },
    framework: { default: 'foundation' },
    isadmin: { default: false }
  },
  data: function data() {
    return {
      minicalslist: [],
      dateObject: {
        startDateMin: '',
        startDateDefault: '',
        endDateMin: '',
        endDateDefault: '',
        startTimeDefault: '',
        endTimeDefault: '',
        regDateMin: '',
        regDateDefault: ''
      },
      startdatePicker: null,
      enddatePicker: null,
      starttimePicker: null,
      endtimePicker: null,
      regdeadlinePicker: null,
      sdate: '',
      edate: '',
      stime: '',
      rdate: '',
      ticketoptions: [{ label: 'Online', value: 'online' }, { label: 'Phone', value: 'phone' }, { label: 'Ticket Office', value: 'office' }, { label: 'Online, Phone and Ticket Office', value: 'all' }, { label: 'Other', value: 'other' }],
      participants: [{ label: 'Campus Only', value: 'campus' }, { label: 'Open to Public', value: 'public' }, { label: 'Students Only', value: 'students' }, { label: 'Invitation Only', value: 'invite' }, { label: 'Tickets Required', value: 'tickets' }],
      totalChars: {
        start: 0,
        title: 80,
        description: 255
      },
      building_in: [],
      building: null,
      buildings: [],
      zcategories: [],
      zcats: [],
      categories: {},
      minicals: null,
      minicalendars: {},
      record: {
        on_campus: 1,
        all_day: 0,
        no_end_time: 0,
        free: 0,
        title: '',
        description: '',
        mini_calendar: '',
        building: '',
        categories: [],
        is_canceled: 0,
        start_time: '12:00 PM',
        end_time: '12:00 PM',
        admin_pre_approved: false
      },
      response: {},
      formStatus: {},
      vModelLike: "",
      formMessage: {
        isOk: false,
        isErr: false,
        msg: ''
      },
      formInputs: {},
      formErrors: {}
    };
  },
  ready: function ready() {
    if (this.recordexists) {
      this.fetchCurrentRecord(this.recordid);
    }
    this.setupDatePickers();
    this.fetchMiniCalsList();
    this.fetchForSelectBuildingList("");
    this.fetchForSelectCategoriesList("");

    // Don't submit form on 'enter'
    $(document).on('keyup keypress', 'form input[type="text"]', function (e) {
      if (e.which == 13) {
        e.preventDefault();
        return false;
      }
    });
  },


  computed: {
    dropDownSelect: function dropDownSelect() {
      return this.framework == 'foundation' ? 'fdropdown' : '';
    },
    md6col: function md6col() {
      return this.framework == 'foundation' ? 'medium-6 columns' : 'col-md-6';
    },
    md12col: function md12col() {
      return this.framework == 'foundation' ? 'medium-12 columns' : 'col-md-12';
    },
    md8col: function md8col() {
      return this.framework == 'foundation' ? 'medium-8 columns' : 'col-md-8';
    },
    md4col: function md4col() {
      return this.framework == 'foundation' ? 'medium-4 columns' : 'col-md-4';
    },
    md2col: function md2col() {
      return this.framework == 'foundation' ? 'medium-2 columns' : 'col-md-2';
    },
    md10col: function md10col() {
      return this.framework == 'foundation' ? 'medium-10 columns' : 'col-md-10';
    },
    btnPrimary: function btnPrimary() {
      return this.framework == 'foundation' ? 'button button-primary' : 'btn btn-primary';
    },
    formGroup: function formGroup() {
      return this.framework == 'foundation' ? 'form-group' : 'form-group';
    },
    inputGroupLabel: function inputGroupLabel() {
      return this.framework == 'foundation' ? 'input-group-label' : 'input-group-addon';
    },
    iconStar: function iconStar() {
      return this.framework == 'foundation' ? 'fi-star' : 'fa fa-star';
    },
    calloutSuccess: function calloutSuccess() {
      return this.framework == 'foundation' ? 'callout success' : 'alert alert-success';
    },
    calloutFail: function calloutFail() {
      return this.framework == 'foundation' ? 'callout alert' : 'alert alert-danger';
    },
    submitBtnLabel: function submitBtnLabel() {
      return this.recordexists ? 'Update Event' : 'Submit For Approval';
    },
    computedLocation: function computedLocation() {
      var bldg = void 0,
          room = void 0;

      if (this.building) {
        this.record.building = this.building.name;
        bldg = this.record.building;
        room = this.record.room ? ' - ' + this.record.room : '';
      } else {
        bldg = '';
        room = '';
      }
      return bldg + room;
    },
    cancelStatus: function cancelStatus() {
      return this.record.is_canceled == 1 ? 'Uncancel Event' : 'Cancel Event';
    },
    isOnCampus: function isOnCampus() {
      return this.record.on_campus == 1 ? true : false;
    },
    realCost: function realCost() {
      if (this.record.free == 1) {
        return '0.00';
      } else {
        return '';
      }
    },
    hasCost: function hasCost() {
      if (this.record.free == 1) {
        this.record.cost = '0.00';
        return false;
      } else {
        return true;
      }
    },
    titleChars: function titleChars() {
      var str = this.record.title;
      var cclength = str.length;
      return this.totalChars.title - cclength;
    },
    descriptionChars: function descriptionChars() {
      var str = this.record.description;
      var cclength = str.length;
      return this.totalChars.description - cclength;
    },
    hasStartTime: function hasStartTime() {
      return this.record.all_day == 1 ? false : true;
    },
    hasEndTime: function hasEndTime() {
      return this.record.all_day == 1 || this.record.no_end_time == 1 ? false : true;
    },
    isAdmin: function isAdmin() {
      return window.location.href.indexOf("admin") > -1;
    }
  },
  methods: {
    refreshUserEventTable: function refreshUserEventTable() {
      $.get('/calendar/user/events', function (data) {
        data = $.parseJSON(data);
        $('#user-events-tables').html(data);
      });
    },

    fetchMiniCalsList: function fetchMiniCalsList() {
      var _this = this;

      this.$http.get('/api/minicalslist').then(function (response) {
        _this.$set('minicalslist', response.data);
      }, function (response) {
        //error callback
        console.log("ERRORS");
        _this.formErrors = response.data.error.message;
      }).bind(this);
    },
    setupDatePickers: function setupDatePickers() {
      var self = this;
      if (this.record.start_date === '') {
        this.dateObject.startDateMin = this.currentDate;
        this.dateObject.startDateDefault = null;

        this.dateObject.endDateMin = null;
        this.dateObject.endDateDefault = null;
      } else {
        this.dateObject.startDateMin = this.record.start_date;
        this.dateObject.startDateDefault = this.record.start_date;
        this.dateObject.endDateMin = this.record.start_date;
        this.dateObject.endDateDefault = this.record.end_date;
        this.dateObject.startTimeDefault = this.record.start_time;
        this.dateObject.endTimeDefault = this.record.end_time;
        this.dateObject.regDateMin = this.record.start_date;
        this.dateObject.regDateDefault = this.record.reg_deadline;
      }
      this.startdatePicker = (0, _flatpickr2.default)(document.getElementById("start-date"), {
        // minDate: self.dateObject.startDateMin,
        defaultDate: self.dateObject.startDateDefault,
        enableTime: false,
        // altFormat: "m-d-Y",
        altInput: true,
        altInputClass: "form-control",
        dateFormat: "Y-m-d",
        // minDate: new Date(),
        onChange: function onChange(dateObject, dateString) {
          self.enddatePicker.set("minDate", dateObject);
          self.record.start_date = dateString;
          self.startdatePicker.value = dateString;
        }
      });

      this.enddatePicker = (0, _flatpickr2.default)(document.getElementById("end-date"), {
        minDate: self.dateObject.endDateMin,
        defaultDate: self.dateObject.endDateDefault,
        enableTime: false,
        // altFormat: "m-d-Y",
        altInput: true,
        altInputClass: "form-control",
        dateFormat: "Y-m-d",
        // minDate: new Date(),
        onChange: function onChange(dateObject, dateString) {
          self.startdatePicker.set("maxDate", dateObject);
          self.record.end_date = dateString;
          self.enddatePicker.value = dateString;
        }
      });

      this.starttimePicker = (0, _flatpickr2.default)(document.getElementById("start-time"), {
        noCalendar: true,
        enableTime: true,
        defaultDate: self.dateObject.startTimeDefault,
        dateFormat: "h:i K",
        onChange: function onChange(timeObject, timeString) {
          self.record.start_time = timeString;
          self.starttimePicker.value = timeString;
        }
      });
      this.endtimePicker = (0, _flatpickr2.default)(document.getElementById("end-time"), {
        noCalendar: true,
        enableTime: true,
        defaultDate: self.dateObject.endTimeDefault,
        dateFormat: "h:i K",
        onChange: function onChange(timeObject, timeString) {
          self.record.end_time = timeString;
          self.endtimePicker.value = timeString;
        }
      });

      this.regdeadlinePicker = (0, _flatpickr2.default)(document.getElementById("reg-deadline"), {
        minDate: self.dateObject.regDateMin,
        defaultDate: self.dateObject.regDateDefault,
        enableTime: false,
        // altFormat: "m-d-Y",
        altInput: true,
        altInputClass: "form-control",
        dateFormat: "Y-m-d",
        onChange: function onChange(dateObject, dateString) {
          self.record.reg_deadline = dateString;
          self.regdeadlinePicker.value = dateString;
        }
      });
    },

    fetchSubmittedRecord: function fetchSubmittedRecord(recid) {
      // Sets params for update record, Passes an id to fetchCurrentRecord
      this.recordexists = true;
      this.formMessage.isOk = false;
      this.formMessage.isErr = false;
      this.recordid = recid;
      this.formErrors = {};
      this.fetchCurrentRecord();
    },

    cancelRecord: function cancelRecord(recid) {
      var _this2 = this;

      // toggles cancel
      this.formMessage.isOk = false;
      this.formMessage.msg = false;

      this.$http.patch('/api/event/' + recid + '/cancel').then(function (response) {
        _this2.formMessage.isOk = response.ok;
        _this2.formMessage.msg = response.body.message;
      }, function (response) {
        console.log((0, _stringify2.default)(response));
      }).bind(this);
      this.refreshUserEventTable();
    },

    fetchCurrentRecord: function fetchCurrentRecord() {
      var _this3 = this;

      this.$http.get('/api/event/' + this.recordid + '/edit').then(function (response) {
        _this3.$set('record', response.data.data);
        _this3.checkOverData();
        _this3.record.start_time = response.data.data.start_time;
      }, function (response) {
        //error callback
        console.log("FETCH ERRORS");
      }).bind(this);
    },
    checkOverData: function checkOverData() {
      // Used after fetching an event
      // Check event location
      // not null and has more than white space
      if (this.record.building != null && /\S/.test(this.record.building)) {
        // Is on campus
        this.record.on_campus = 1; // bool
        this.building = { id: 0, name: this.convertFromSlug(this.record.building) };
      } else {
        // Not on campus
        this.record.on_campus = 0; // bool
        this.record.locationoffcampus = this.record.location;
      }

      this.setupDatePickers();
    },
    fetchForSelectCategoriesList: function fetchForSelectCategoriesList(search, loading) {
      var _this4 = this;

      loading ? loading(true) : undefined;
      this.$http.get('/api/categorylist', {
        q: search
      }).then(function (resp) {
        _this4.zcats = resp.data;
        loading ? loading(true) : undefined;
      });
    },
    fetchForSelectBuildingList: function fetchForSelectBuildingList(search, loading) {
      var _this5 = this;

      loading ? loading(true) : undefined;
      this.$http.get('/api/buildinglist', {
        q: search
      }).then(function (resp) {
        _this5.buildings = resp.data;
        loading ? loading(true) : undefined;
      });
    },

    delEvent: function delEvent(e) {
      var _this6 = this;

      e.preventDefault();
      this.formMessage.isOk = false;
      this.formMessage.isErr = false;

      if (confirm('Would you like to delete this Event') == true) {
        $('html, body').animate({ scrollTop: 0 }, 'fast');

        this.currentRecordId ? tempid = this.currentRecordId : tempid = this.record.id;
        this.$http.post('/api/event/' + tempid + '/delete').then(function (response) {
          // If user admin
          if (window.location.href.indexOf("admin") > -1) {
            window.location.href = "/admin/event/queue";
          } else {
            // Not user admin
            // Clear out values;
            _this6.record = {
              on_campus: 1,
              all_day: 0,
              no_end_time: 0,
              free: 0,
              title: '',
              description: '',
              mini_calendar: '',
              building: '',
              categories: []
            };
            _this6.record.location = '';
            _this6.building = null;
            _this6.buildings = null;
            _this6.record.room = null;
            _this6.record.building = null;
            _this6.record.building_id = null;
            _this6.record.lbc_approved = false;
            _this6.record.sdate = '';
            _this6.record.edate = '';
            _this6.record.stime = '';
            _this6.record.rdate = '';
            _this6.formMessage.isOk = response.ok;
            _this6.formMessage.msg = response.body;
            _this6.recordexists = false;
            var d = new Date();
            var tempdate = d.getFullYear() + "-" + d.getMonth() + "-" + d.getDate();
            _this6.record.start_date = tempdate;
            _this6.record.end_date = tempdate;
            _this6.record.reg_deadline = tempdate;
            _this6.setupDatePickers();
          }
        }, function (response) {
          console.log('Error: ' + (0, _stringify2.default)(response));
        }).bind(this);
        this.refreshUserEventTable();
      }
    },

    cloneEvent: function cloneEvent(e) {
      e.preventDefault();
      this.recordexists = false;
      this.submitForm(e);
    },

    cancelEvent: function cancelEvent(e) {
      var _this7 = this;

      e.preventDefault();
      this.formMessage.isOk = false;
      this.formMessage.isErr = false;

      if (confirm('Would you like to cancel this Event') == true) {
        $('html, body').animate({ scrollTop: 0 }, 'fast');

        this.currentRecordId ? tempid = this.currentRecordId : tempid = this.record.id;
        this.$http.patch('/api/event/' + tempid + '/cancel').then(function (response) {
          if (_this7.record.is_canceled == 0) {
            _this7.record.is_canceled = 1;
          } else {
            _this7.record.is_canceled = 0;
          }

          _this7.formMessage.msg = "Event's status has been changed.";
          _this7.formMessage.isOk = response.ok;
        }, function (response) {
          console.log('Error: ' + (0, _stringify2.default)(response));
        }).bind(this);
        this.refreshUserEventTable();
      }
    },

    submitForm: function submitForm(e) {
      var _this8 = this;

      e.preventDefault();
      this.formMessage.isOk = false;
      this.formMessage.isErr = false;

      $('html, body').animate({ scrollTop: 0 }, 'fast');

      if (this.record.on_campus == true) {
        this.record.location = this.computedLocation;
      } else {
        this.record.location = this.record.locationoffcampus;
        // clearout these values
        this.record.building = null;
        this.record.building_id = null;
        this.record.room = null;
      }
      this.record.minicals = this.record.minicalendars ? this.record.minicalendars : null;
      this.record.categories = this.record.eventcategories;

      var method = this.recordexists ? 'put' : 'post';
      var route = this.recordexists ? '/api/event/' + this.recordid : '/api/event';

      this.$http[method](route, this.record).then(function (response) {
        response.status;
        _this8.formMessage.msg = response.data.message;
        _this8.formMessage.isOk = response.ok;
        _this8.formMessage.isErr = false;
        _this8.currentRecordId = response.data.newdata.record_id;
        _this8.record_id = response.data.newdata.record_id;
        _this8.recordid = response.data.newdata.record_id;
        _this8.recordexists = true;
        _this8.formErrors = {};
        _this8.refreshUserEventTable();
        _this8.fetchCurrentRecord(_this8.currentRecordId);
      }, function (response) {
        _this8.formMessage.isOk = false;
        _this8.formMessage.isErr = true;
        //error callback
        console.log("FORM ERRORS" + (0, _stringify2.default)(response));
        _this8.formErrors = response.data.error.message;
      }).bind(this);
    },
    convertToSlug: function convertToSlug(value) {
      return value.toLowerCase().replace(/[^a-z0-9-]+/g, '-').replace(/^-+|-+$/g, '');
    },
    convertFromSlug: function convertFromSlug(value) {

      /* READ: for some reason, buildings do not have foreign key relations to events;
       * they are merely being stored as slugs in the events table.
       * This causes problems when trying to reproduce names that have capital letters other than the first letter
       * (e.g. "McKenny Hall" or "Rec/IM Building")
       * In lieu of breaking the entire events table, whenever a slug has special formatting, just put it in a conditional statement
       *
       * CP 1/22/18
       */
      if (value == 'mckenny-hall') {
        return 'McKenny Hall';
      } else if (value == 'recim-building' || value == 'rec/im-building') {
        return 'Rec/IM Building';
      } else if (value == 'rec/im-softball-complex') {
        return 'Rec/IM Softball Complex';
      } else {
        return value.replace(/-/g, " ").replace(/\b[a-z]/g, function () {
          return arguments[0].toUpperCase();
        });
      }
    }
  }
};
if (module.exports.__esModule) module.exports = module.exports.default
;(typeof module.exports === "function"? module.exports.options: module.exports).template = "\n  <form _v-3a158057=\"\">\n    <slot name=\"csrf\" _v-3a158057=\"\"></slot>\n    {{ $route }}\n    <div class=\"row\" _v-3a158057=\"\">\n      <div v-bind:class=\"md12col\" _v-3a158057=\"\">\n        <div v-show=\"formMessage.isOk\" :class=\"calloutSuccess\" _v-3a158057=\"\">\n          <h5 _v-3a158057=\"\">{{formMessage.msg}}</h5>\n        </div>\n        <div v-show=\"formMessage.isErr\" :class=\"calloutFail\" _v-3a158057=\"\">\n          <h5 _v-3a158057=\"\">There are errors.</h5>\n        </div>\n        <div v-show=\"this.record.is_canceled == 1\" :class=\"calloutFail\" _v-3a158057=\"\">\n          <h5 _v-3a158057=\"\">This event has been canceled.</h5>\n        </div>\n        <div class=\"form-group\" _v-3a158057=\"\">\n          <label _v-3a158057=\"\">Title <span :class=\"iconStar\" class=\"reqstar\" _v-3a158057=\"\"></span></label>\n          <p class=\"help-text\" id=\"title-helptext\" _v-3a158057=\"\">Please enter a title ({{titleChars}} characters left)</p>\n          <input v-model=\"record.title\" class=\"form-control\" :class=\"[formErrors.title ? 'invalid-input' : '']\" name=\"title\" type=\"text\" maxlength=\"80\" autofocus=\"\" _v-3a158057=\"\">\n          <p v-if=\"formErrors.title\" class=\"help-text invalid\" _v-3a158057=\"\">\tPlease Include a Title!</p>\n        </div>\n        <div class=\"form-group\" _v-3a158057=\"\">\n          <label _v-3a158057=\"\">Short Title - for departmental use only</label>\n          <input v-model=\"record.short_title\" class=\"form-control\" type=\"text\" placeholder=\"Short Title\" name=\"short-title\" maxlength=\"80\" _v-3a158057=\"\">\n        </div>\n      </div><!-- /.md12col -->\n    </div><!-- /.row -->\n    <div class=\"row\" _v-3a158057=\"\">\n      <div :class=\"md12col\" _v-3a158057=\"\">\n        <div :class=\"formGroup\" _v-3a158057=\"\">\n          <label _v-3a158057=\"\">Description <span :class=\"iconStar\" class=\"reqstar\" _v-3a158057=\"\"></span> <p class=\"help-text\" id=\"description-helptext\" _v-3a158057=\"\">({{descriptionChars}} characters left)</p></label>\n          <textarea v-model=\"record.description\" class=\"form-control\" :class=\"[formErrors.description ? 'invalid-input' : '']\" name=\"description\" type=\"textarea\" rows=\"6\" maxlength=\"255\" _v-3a158057=\"\"></textarea>\n          <p v-if=\"formErrors.description\" class=\"help-text invalid\" _v-3a158057=\"\">Need a Description!</p>\n        </div>\n      </div><!-- /.md12col -->\n    </div><!-- /.row -->\n    <div class=\"row\" _v-3a158057=\"\">\n      <div :class=\"md6col\" _v-3a158057=\"\">\n        <div class=\"form-group\" _v-3a158057=\"\">\n          <label _v-3a158057=\"\">Is Event on Campus?\n            <input id=\"on-campus-yes\" name=\"on_campus\" type=\"checkbox\" value=\"1\" v-model=\"record.on_campus\" _v-3a158057=\"\">\n          </label>\n        </div>\n      </div><!-- /.md6col -->\n      <div :class=\"md6col\" _v-3a158057=\"\">\n\n      </div><!-- /.md6col -->\n    </div><!-- /.row -->\n    <div class=\"row\" _v-3a158057=\"\">\n      <div :class=\"md12col\" _v-3a158057=\"\">\n        <template v-if=\"isOnCampus\">\n          <div class=\"row\" _v-3a158057=\"\">\n            <div :class=\"md8col\" _v-3a158057=\"\">\n              <label _v-3a158057=\"\">Building</label>\n              <v-select :class=\"dropDownSelect\" is=\"bldg\" :debounce=\"250\" :value.sync=\"building\" :on-search=\"fetchForSelectBuildingList\" :options=\"buildings\" placeholder=\"Select a Building ...\" label=\"name\" _v-3a158057=\"\">\n            </v-select>\n        </div><!-- /.md8col -->\n        <div :class=\"md4col\" _v-3a158057=\"\">\n          <label _v-3a158057=\"\">Room</label>\n          <input v-model=\"record.room\" :class=\"[formErrors.room ? 'invalid-input' : '']\" name=\"room\" type=\"text\" class=\"mockh5\" maxlength=\"80\" _v-3a158057=\"\">\n        </div><!-- /.md4col -->\n      </div><!-- /.row -->\n    </template>\n    <div class=\"row\" _v-3a158057=\"\">\n      <div :class=\"md12col\" _v-3a158057=\"\">\n        <template v-if=\"isOnCampus\">\n          <label _v-3a158057=\"\">Location <span :class=\"iconStar\" class=\"reqstar\" _v-3a158057=\"\"></span></label>\n          <input v-model=\"computedLocation\" class=\"form-control\" :class=\"[formErrors.location ? 'invalid-input' : '']\" name=\"location\" type=\"text\" readonly=\"readonly\" _v-3a158057=\"\">\n        </template>\n        <template v-else=\"\">\n          <label _v-3a158057=\"\">Location <span :class=\"iconStar\" class=\"reqstar\" _v-3a158057=\"\"></span></label>\n          <input v-model=\"record.locationoffcampus\" class=\"form-control\" :class=\"[formErrors.location ? 'invalid-input' : '']\" name=\"location\" type=\"text\" maxlength=\"80\" _v-3a158057=\"\">\n        </template>\n      </div><!-- /.md12col -->\n    </div><!-- /.row -->\n  </div><!-- /.md12col -->\n</div><!-- /.row -->\n<div class=\"row\" _v-3a158057=\"\">\n  <div :class=\"md6col\" _v-3a158057=\"\">\n    <div class=\"form-group\" _v-3a158057=\"\">\n      <label for=\"start-date\" _v-3a158057=\"\">Event Start Date: <span :class=\"iconStar\" class=\"reqstar\" _v-3a158057=\"\"></span></label>\n      <input id=\"start-date\" :class=\"[formErrors.start_date ? 'invalid-input' : '']\" type=\"text\" v-model=\"record.start_date\" aria-describedby=\"errorStartDate\" _v-3a158057=\"\">\n      <p v-if=\"formErrors.start_date\" class=\"help-text invalid\" _v-3a158057=\"\">Need a Start Date</p>\n    </div><!--form-group -->\n  </div><!-- /.md6col -->\n  <div :class=\"md6col\" _v-3a158057=\"\">\n    <div class=\"form-group\" _v-3a158057=\"\">\n      <label for=\"end-date\" _v-3a158057=\"\">End Date: <span :class=\"iconStar\" class=\"reqstar\" _v-3a158057=\"\"></span></label>\n      <input id=\"end-date\" :class=\"[formErrors.end_date ? 'invalid-input' : '']\" type=\"text\" v-model=\"record.end_date\" aria-describedby=\"errorEndDate\" _v-3a158057=\"\">\n      <!-- <datepicker id=\"end-date\" :readonly=\"true\" format=\"YYYY-MM-DD\" name=\"end-date\" :value.sync=\"edate\"></datepicker> -->\n      <p v-if=\"formErrors.end_date\" class=\"help-text invalid\" _v-3a158057=\"\">Need an End Date</p>\n    </div><!--form-group -->\n  </div><!-- /.md6col -->\n</div><!-- /.row -->\n\n<div class=\"row\" _v-3a158057=\"\">\n  <div :class=\"md6col\" _v-3a158057=\"\">\n    <div class=\"form-group\" _v-3a158057=\"\">\n      <label for=\"all-day\" _v-3a158057=\"\">All Day Event:\n        <input id=\"all-day\" name=\"all_day\" type=\"checkbox\" value=\"1\" v-model=\"record.all_day\" _v-3a158057=\"\">\n      </label>\n    </div>\n  </div><!-- /.small-6 column -->\n  <div :class=\"md6col\" _v-3a158057=\"\">\n    <div v-show=\"hasStartTime\" class=\"form-group\" _v-3a158057=\"\">\n      <label for=\"no-end-time\" _v-3a158057=\"\">No End Time:</label>\n        <input id=\"no-end-time\" name=\"no_end_time\" type=\"checkbox\" value=\"1\" v-model=\"record.no_end_time\" _v-3a158057=\"\">\n    </div>\n  </div><!-- /.small-6 column -->\n  </div><!-- /.row -->\n  <div class=\"row\" _v-3a158057=\"\">\n    <div :class=\"md6col\" _v-3a158057=\"\">\n      <div v-show=\"hasStartTime\" class=\"form-group\" _v-3a158057=\"\">\n        <label for=\"start-time\" _v-3a158057=\"\">Start Time: <span :class=\"iconStar\" class=\"reqstar\" _v-3a158057=\"\"></span></label>\n        <input id=\"start-time\" class=\"form-control\" type=\"text\" v-model=\"record.start_time\" readonly=\"\" _v-3a158057=\"\">\n        <p v-if=\"formErrors.start_time\" class=\"help-text invalid\" _v-3a158057=\"\">Need a Start Time</p>\n      </div><!-- /.form-group -->\n    </div><!-- /.md6col -->\n    <div :class=\"md6col\" _v-3a158057=\"\">\n      <div v-show=\"hasEndTime\" class=\"form-group\" _v-3a158057=\"\">\n        <label for=\"end-time\" _v-3a158057=\"\">End Time: <span :class=\"iconStar\" class=\"reqstar\" _v-3a158057=\"\"></span></label>\n        <input id=\"end-time\" class=\"form-control\" type=\"text\" v-model=\"record.end_time\" readonly=\"\" _v-3a158057=\"\">\n      </div><!-- /.form-group -->\n    </div><!-- /.md6col -->\n  </div><!-- /.row -->\n  <div class=\"row\" _v-3a158057=\"\">\n    <div :class=\"md12col\" _v-3a158057=\"\">\n      <div class=\"form-group\" _v-3a158057=\"\">\n        <label _v-3a158057=\"\">Categories: <span :class=\"iconStar\" class=\"reqstar\" _v-3a158057=\"\"></span></label>\n        <v-select :class=\"[formErrors.categories ? 'invalid-input' : '']\" :debounce=\"250\" :value.sync=\"record.eventcategories\" :on-search=\"fetchForSelectCategoriesList\" :options=\"zcats\" :multiple=\"true\" placeholder=\"Select related categories ...\" label=\"category\" _v-3a158057=\"\">\n      </v-select>\n\n    </div><!-- /.form-group -->\n  </div><!-- /.md12col -->\n</div><!-- /.row -->\n<div class=\"row\" _v-3a158057=\"\">\n  <div :class=\"md6col\" _v-3a158057=\"\">\n    <div class=\"form-group\" _v-3a158057=\"\">\n      <label _v-3a158057=\"\">Contact Person: <span :class=\"iconStar\" class=\"reqstar\" _v-3a158057=\"\"></span><em _v-3a158057=\"\">(Jane Doe)</em></label>\n      <input v-model=\"record.contact_person\" class=\"form-control\" :class=\"[formErrors.contact_person ? 'invalid-input' : '']\" name=\"contact-person\" type=\"text\" maxlength=\"80\" _v-3a158057=\"\">\n      <p v-if=\"formErrors.contact_person\" class=\"help-text invalid\" _v-3a158057=\"\">Need a Contact Person!</p>\n\n    </div>\n  </div><!-- /.md6col -->\n  <div :class=\"md6col\" _v-3a158057=\"\">\n    <div class=\"form-group\" _v-3a158057=\"\">\n      <label _v-3a158057=\"\">Contact Email: <span :class=\"iconStar\" class=\"reqstar\" _v-3a158057=\"\"></span><em _v-3a158057=\"\">(ex.janedoe@emich.edu)</em></label>\n      <input v-model=\"record.contact_email\" class=\"form-control\" :class=\"[formErrors.contact_email ? 'invalid-input' : '']\" name=\"contact-email\" type=\"text\" maxlength=\"80\" _v-3a158057=\"\">\n      <p v-if=\"formErrors.contact_email\" class=\"help-text invalid\" _v-3a158057=\"\">Need a Contact Email!</p>\n\n    </div>\n  </div><!-- /.md6col -->\n</div><!-- /.row -->\n<div class=\"row\" _v-3a158057=\"\">\n  <div :class=\"md6col\" _v-3a158057=\"\">\n    <div class=\"form-group\" _v-3a158057=\"\">\n      <label _v-3a158057=\"\">Contact Phone: <span :class=\"iconStar\" class=\"reqstar\" _v-3a158057=\"\"></span> <em _v-3a158057=\"\">(ex. 734.487.1849)</em>\n        <input v-model=\"record.contact_phone\" class=\"form-control\" :class=\"[formErrors.contact_phone ? 'invalid-input' : '']\" name=\"contact-phone\" type=\"text\" maxlength=\"80\" _v-3a158057=\"\">\n        <p v-if=\"formErrors.contact_phone\" class=\"help-text invalid\" _v-3a158057=\"\">Need a Contact Phone!</p>\n      </label>\n    </div>\n  </div><!-- /.md6col -->\n  <div :class=\"md6col\" _v-3a158057=\"\">\n    <div class=\"form-group\" _v-3a158057=\"\">\n      <label _v-3a158057=\"\">Contact Fax: <em _v-3a158057=\"\">(ex. 734.487.1849)</em>\n        <input v-model=\"record.contact_fax\" class=\"form-control\" :class=\"[formErrors.contact_fax ? 'invalid-input' : '']\" name=\"contact-fax\" type=\"text\" maxlength=\"80\" _v-3a158057=\"\">\n      </label>\n    </div>\n  </div><!-- /.md6col -->\n</div><!-- /.row -->\n<!-- RELATED LINKS -->\n<div class=\"input-group\" style=\"width: 100%\" _v-3a158057=\"\">\n  <div class=\"row\" _v-3a158057=\"\">\n    <div :class=\"md12col\" _v-3a158057=\"\">\n      <div v-bind:class=\"formGroup\" _v-3a158057=\"\">\n        <label _v-3a158057=\"\">Related Link</label>\n        <p class=\"help-text\" id=\"title-helptext\" _v-3a158057=\"\">Please enter the url for your related web page. (ex. www.yourlink.com)</p>\n        <div class=\"input-group input-group-flat\" _v-3a158057=\"\">\n          <span :class=\"inputGroupLabel\" _v-3a158057=\"\">http://</span>\n          <input v-model=\"record.related_link_1\" class=\"form-control\" v-bind:class=\"[formErrors.related_link_1 ? 'invalid-input' : '']\" name=\"related_link_1\" type=\"text\" maxlength=\"255\" _v-3a158057=\"\">\n        </div>\n        <p v-if=\"formErrors.related_link_1\" class=\"help-text invalid\" _v-3a158057=\"\">Please make sure url is properly formed.</p>\n      </div>\n    </div><!-- /.col-md-4 -->\n  </div><!-- /.row -->\n  <div class=\"row\" v-show=\"record.related_link_1\" _v-3a158057=\"\">\n    <div :class=\"md4col\" _v-3a158057=\"\">\n      <div v-bind:class=\"formGroup\" _v-3a158057=\"\">\n        <label _v-3a158057=\"\">Please add descriptive text for link.<span :class=\"iconStar\" class=\"reqstar\" _v-3a158057=\"\"></span></label>\n        <p class=\"help-text\" id=\"link_txt-helptext\" _v-3a158057=\"\">(ex. The event webpage)</p>\n        <input v-model=\"record.related_link_1_txt\" class=\"form-control\" v-bind:class=\"[formErrors.related_link_1_txt ? 'invalid-input' : '']\" name=\"related_link_1_txt\" type=\"text\" maxlength=\"80\" _v-3a158057=\"\">\n        <p v-if=\"formErrors.related_link_1_txt\" class=\"help-text invalid\" _v-3a158057=\"\"> Please include a descriptive text for your related link.</p>\n      </div>\n    </div><!-- /.col-md-4 -->\n    <div :class=\"md8col\" _v-3a158057=\"\">\n      <div v-bind:class=\"formGroup\" _v-3a158057=\"\">\n        <label _v-3a158057=\"\">Example of Related Link</label>\n        <p class=\"help-text\" _v-3a158057=\"\">Below is how it may look. </p>\n        <h5 class=\"form-control\" _v-3a158057=\"\">For more information, visit <a href=\"#\" _v-3a158057=\"\"> {{record.related_link_1_txt}}</a>.</h5>\n      </div>\n    </div><!-- /.md6col -->\n  </div>\n  <!-- Two -->\n  <template v-if=\"record.related_link_1 &amp;&amp; record.related_link_1_txt\">\n    <br _v-3a158057=\"\">\n    <div class=\"row\" _v-3a158057=\"\">\n      <div :class=\"md12col\" _v-3a158057=\"\">\n        <div v-bind:class=\"formGroup\" _v-3a158057=\"\">\n          <label _v-3a158057=\"\">Related Link</label>\n          <p class=\"help-text\" id=\"title-helptext\" _v-3a158057=\"\">Please enter the url for your related web page. (ex. www.yourlink.com)</p>\n          <div class=\"input-group input-group-flat\" _v-3a158057=\"\">\n            <span :class=\"inputGroupLabel\" _v-3a158057=\"\">http://</span>\n            <input v-model=\"record.related_link_2\" class=\"form-control\" v-bind:class=\"[formErrors.related_link_2 ? 'invalid-input' : '']\" name=\"related_link_2\" type=\"text\" maxlength=\"255\" _v-3a158057=\"\">\n          </div>\n          <p v-if=\"formErrors.related_link_2\" class=\"help-text invalid\" _v-3a158057=\"\">Please make sure url is properly formed.</p>\n        </div>\n      </div><!-- /.col-md-4 -->\n    </div><!-- /.row -->\n    <div class=\"row\" v-show=\"record.related_link_2\" _v-3a158057=\"\">\n      <div :class=\"md4col\" _v-3a158057=\"\">\n        <div v-bind:class=\"formGroup\" _v-3a158057=\"\">\n          <label _v-3a158057=\"\">Please add descriptive text for link.<span :class=\"iconStar\" class=\"reqstar\" _v-3a158057=\"\"></span></label>\n          <p class=\"help-text\" id=\"link_txt-helptext\" _v-3a158057=\"\">(ex. The event webpage)</p>\n          <input v-model=\"record.related_link_2_txt\" class=\"form-control\" v-bind:class=\"[formErrors.related_link_2_txt ? 'invalid-input' : '']\" name=\"related_link_2_txt\" type=\"text\" maxlength=\"80\" _v-3a158057=\"\">\n          <p v-if=\"formErrors.related_link_2_txt\" class=\"help-text invalid\" _v-3a158057=\"\"> Please include a descriptive text for your related link.</p>\n        </div>\n      </div><!-- /.col-md-4 -->\n      <div :class=\"md8col\" _v-3a158057=\"\">\n        <div v-bind:class=\"formGroup\" _v-3a158057=\"\">\n          <label _v-3a158057=\"\">Example of Related Link</label>\n          <p class=\"help-text\" _v-3a158057=\"\">Below is how it may look. </p>\n          <h5 class=\"form-control\" _v-3a158057=\"\">For more information, visit: <a href=\"#\" _v-3a158057=\"\"> {{record.related_link_2_txt}}</a>.</h5>\n        </div>\n      </div><!-- /.md6col -->\n    </div>\n    <br _v-3a158057=\"\">\n  </template>\n  <!-- three -->\n  <template v-if=\"record.related_link_2 &amp;&amp; record.related_link_2_txt\">\n    <div class=\"row\" _v-3a158057=\"\">\n      <div :class=\"md12col\" _v-3a158057=\"\">\n        <div v-bind:class=\"formGroup\" _v-3a158057=\"\">\n          <label _v-3a158057=\"\">Related Link</label>\n          <p class=\"help-text\" id=\"title-helptext\" _v-3a158057=\"\">Please enter the url for your related web page. (ex. www.yourlink.com)</p>\n          <div class=\"input-group input-group-flat\" _v-3a158057=\"\">\n            <span :class=\"inputGroupLabel\" _v-3a158057=\"\">http://</span>\n            <input v-model=\"record.related_link_3\" class=\"form-control\" v-bind:class=\"[formErrors.related_link_3 ? 'invalid-input' : '']\" name=\"related_link_3\" type=\"text\" maxlength=\"255\" _v-3a158057=\"\">\n          </div>\n          <p v-if=\"formErrors.related_link_3\" class=\"help-text invalid\" _v-3a158057=\"\">Please make sure url is properly formed.</p>\n        </div>\n      </div><!-- /.col-md-4 -->\n    </div><!-- /.row -->\n    <div class=\"row\" v-show=\"record.related_link_3\" _v-3a158057=\"\">\n      <div :class=\"md4col\" _v-3a158057=\"\">\n        <div v-bind:class=\"formGroup\" _v-3a158057=\"\">\n          <label _v-3a158057=\"\">Please add descriptive text for link.<span :class=\"iconStar\" class=\"reqstar\" _v-3a158057=\"\"></span></label>\n          <p class=\"help-text\" id=\"link_txt-helptext\" _v-3a158057=\"\">(ex. The event webpage)</p>\n          <input v-model=\"record.related_link_3_txt\" class=\"form-control\" v-bind:class=\"[formErrors.related_link_3_txt ? 'invalid-input' : '']\" name=\"related_link_3_txt\" type=\"text\" maxlength=\"80\" _v-3a158057=\"\">\n          <p v-if=\"formErrors.related_link_3_txt\" class=\"help-text invalid\" _v-3a158057=\"\"> Please include a descriptive text for your related link.</p>\n        </div>\n      </div><!-- /.col-md-4 -->\n      <div :class=\"md8col\" _v-3a158057=\"\">\n        <div v-bind:class=\"formGroup\" _v-3a158057=\"\">\n          <label _v-3a158057=\"\">Example of Related Link</label>\n          <p class=\"help-text\" _v-3a158057=\"\">Below is how it may look. </p>\n          <h5 class=\"form-control\" _v-3a158057=\"\">For more information, visit: <a href=\"#\" _v-3a158057=\"\"> {{record.related_link_3_txt}}</a>.</h5>\n        </div>\n      </div><!-- /.md6col -->\n    </div>\n  </template>\n</div>\n<!-- RELATED LINKS -->\n<br v-if=\"framework == 'bootstrap'\" _v-3a158057=\"\">\n\n<div class=\"row\" _v-3a158057=\"\">\n  <div :class=\"md6col\" _v-3a158057=\"\">\n    <div class=\"form-group\" _v-3a158057=\"\">\n      <label for=\"reg-deadline\" _v-3a158057=\"\">Registration Deadline</label>\n      <input id=\"reg-deadline\" :class=\"[formErrors.reg_deadline ? 'invalid-input' : '']\" type=\"text\" v-model=\"record.reg_deadline\" aria-describedby=\"errorRegDeadline\" _v-3a158057=\"\">\n      <p v-if=\"formErrors.reg_deadline\" class=\"help-text invalid\" _v-3a158057=\"\">Error</p>\n    </div>\n  </div><!-- /.md6col-->\n</div><!-- /.row -->\n<div class=\"row\" _v-3a158057=\"\">\n  <div :class=\"md12col\" _v-3a158057=\"\">\n\n    <div class=\"row\" _v-3a158057=\"\">\n      <div :class=\"md2col\" _v-3a158057=\"\">\n        <label _v-3a158057=\"\">Free</label>\n        <div :class=\"formGroup\" _v-3a158057=\"\">\n          <input id=\"free\" name=\"free\" type=\"checkbox\" value=\"1\" v-model=\"record.free\" _v-3a158057=\"\">\n        </div><!-- /.form-group -->\n      </div><!-- /.md4col -->\n      <div :class=\"md10col\" _v-3a158057=\"\">\n        <label _v-3a158057=\"\">Event Cost <span :class=\"iconStar\" class=\"reqstar\" _v-3a158057=\"\"></span></label>\n        <div v-show=\"hasCost\" class=\"form-group\" _v-3a158057=\"\">\n          <div class=\"input-group\" _v-3a158057=\"\">\n            <span :class=\"inputGroupLabel\" _v-3a158057=\"\">$</span>\n            <input v-model=\"record.cost\" class=\"form-control\" :class=\"[formErrors.cost ? 'invalid-input' : '']\" name=\"event-cost\" type=\"number\" _v-3a158057=\"\">\n          </div><!-- /. input-group -->\n        </div>\n        <div v-else=\"\" :class=\"formGroup\" _v-3a158057=\"\">\n          <div class=\"input-group\" _v-3a158057=\"\">\n            <span :class=\"inputGroupLabel\" _v-3a158057=\"\">$</span>\n            <input v-model=\"record.cost\" class=\"form-control\" :class=\"[formErrors.cost ? 'invalid-input' : '']\" name=\"event-cost\" type=\"number\" readonly=\"readonly\" _v-3a158057=\"\">\n          </div><!-- /. input-group -->\n        </div>\n      </div><!-- /.md8col -->\n    </div><!-- /.row -->\n\n\n  </div><!-- /.medium-6 -->\n</div><!-- /.row -->\n<div class=\"row\" _v-3a158057=\"\">\n  <div :class=\"md12col\" _v-3a158057=\"\">\n    <div :class=\"formGroup\" _v-3a158057=\"\">\n      <label _v-3a158057=\"\">Tickets Available</label>\n      <select v-model=\"record.tickets\" class=\"form-control\" _v-3a158057=\"\">\n        <option v-for=\"ticketoption in ticketoptions\" :value=\"ticketoption.value\" _v-3a158057=\"\">\n          {{ ticketoption.label }}\n        </option>\n      </select>\n      <template v-if=\"record.tickets == 'online' || record.tickets == 'all'\">\n        <label _v-3a158057=\"\">Link: <em _v-3a158057=\"\">(ex. http://www.emich.edu/calendar)</em>\n          <input v-model=\"record.ticket_details_online\" class=\"form-control\" :class=\"[formErrors.ticket_details_online ? 'invalid-input' : '']\" name=\"ticket-details-online\" type=\"text\" _v-3a158057=\"\">\n        </label>\n      </template>\n      <template v-if=\"record.tickets == 'phone' || record.tickets == 'all'\">\n        <label _v-3a158057=\"\">Tickets by Phone <em _v-3a158057=\"\">(ex. 734.487.1849)</em>\n          <input v-model=\"record.ticket_details_phone\" class=\"form-control\" :class=\"[formErrors.ticket_details_phone ? 'invalid-input' : '']\" name=\"ticket-details-phone\" type=\"text\" _v-3a158057=\"\">\n        </label>\n      </template>\n      <template v-if=\"record.tickets == 'office' || record.tickets == 'all'\">\n        <label _v-3a158057=\"\">Address\n          <input v-model=\"record.ticket_details_office\" class=\"form-control\" :class=\"[formErrors.ticket_details_office ? 'invalid-input' : '']\" name=\"ticket-details-office\" type=\"text\" _v-3a158057=\"\">\n        </label>\n      </template>\n      <template v-if=\"record.tickets == 'other'\">\n        <label _v-3a158057=\"\">Other\n          <input v-model=\"record.ticket_details_other\" class=\"form-control\" :class=\"[formErrors.ticket_details_other ? 'invalid-input' : '']\" name=\"ticket-details-other\" type=\"text\" _v-3a158057=\"\">\n        </label>\n      </template>\n    </div><!-- /.form-group -->\n  </div><!-- /.md12col -->\n</div><!-- /.row -->\n<div class=\"row\" _v-3a158057=\"\">\n  <div :class=\"md12col\" _v-3a158057=\"\">\n    <div :class=\"formGroup\" _v-3a158057=\"\">\n      <label _v-3a158057=\"\">Participants</label>\n      <select v-model=\"record.participants\" class=\"form-control\" _v-3a158057=\"\">\n        <option v-for=\"participant in participants\" :value=\"participant.value\" _v-3a158057=\"\">\n          {{ participant.label }}\n        </option>\n      </select>\n  </div>\n</div><!--/.md12col -->\n</div><!-- /.row -->\n<div class=\"row\" _v-3a158057=\"\">\n  <div :class=\"md6col\" _v-3a158057=\"\">\n    <div :class=\"formGroup\" _v-3a158057=\"\">\n      <label for=\"lbc-approved\" _v-3a158057=\"\">Request for LBC\n        <input id=\"lbc-approved\" name=\"lbc-approved\" type=\"checkbox\" value=\"1\" v-model=\"record.lbc_approved\" _v-3a158057=\"\">\n      </label>\n    </div>\n  </div><!-- /.md6col -->\n  <div :class=\"md6col\" _v-3a158057=\"\">\n\n  </div><!-- /.md6col -->\n</div><!-- /.row -->\n<div class=\"row\" _v-3a158057=\"\">\n  <div :class=\"md12col\" _v-3a158057=\"\">\n</div><!-- /.md12col -->\n\n<div :class=\"md12col\" _v-3a158057=\"\">\n  <label for=\"minical\" _v-3a158057=\"\">Select your department's mini calendar(s)\n    <v-select id=\"minical\" :value.sync=\"record.minicalendars\" :options=\"minicalslist\" :multiple=\"true\" placeholder=\"Select Mini Calendar\" label=\"calendar\" _v-3a158057=\"\">\n    </v-select>\n  </label>\n</div><!-- /.md12col -->\n</div><!-- /.row -->\n<div class=\"row\" id=\"submit-area\" _v-3a158057=\"\">\n  <div v-if=\"isadmin\" :class=\"md4col\" _v-3a158057=\"\">\n    <div class=\"checkbox\" _v-3a158057=\"\">\n      <label _v-3a158057=\"\"><input type=\"checkbox\" v-model=\"record.admin_pre_approved\" _v-3a158057=\"\">Auto Approve</label>\n    </div>\n  </div>\n  <div :class=\"md8col\" _v-3a158057=\"\">\n    <div :class=\"formGroup\" _v-3a158057=\"\">\n      <button id=\"btn-event\" v-on:click=\"submitForm\" type=\"submit\" v-bind:class=\"btnPrimary\" _v-3a158057=\"\">{{submitBtnLabel}}</button>\n      <button v-if=\"recordexists\" id=\"btn-clone\" v-on:click=\"cloneEvent\" type=\"submit\" v-bind:class=\"btnPrimary\" _v-3a158057=\"\">Clone Event</button>\n      <button v-if=\"recordexists &amp;&amp; isAdmin\" id=\"btn-cancel\" v-on:click=\"cancelEvent\" type=\"submit\" v-bind:class=\"btnPrimary\" _v-3a158057=\"\">{{ cancelStatus }}</button>\n      <button v-if=\"recordexists\" id=\"btn-delete\" v-on:click=\"delEvent\" type=\"submit\" class=\"redBtn\" v-bind:class=\"btnPrimary\" _v-3a158057=\"\">Delete Event</button>\n    </div><!-- /.md12col -->\n  </div><!-- /.md12col -->\n  </div></form>\n\n\n"
if (module.hot) {(function () {  module.hot.accept()
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), true)
  if (!hotAPI.compatible) return
  module.hot.dispose(function () {
    __vueify_insert__.cache["\n#submit-area[_v-3a158057]{\n  background: #e1e1e1;\n  margin:20px 0 0 0;\n}\np[_v-3a158057] {\n  margin:0;\n}\nlabel[_v-3a158057] {\n  margin-top: 3px;\n  margin-bottom: 3px;\n  display: block;\n}\n\nlabel > span[_v-3a158057] {\n  display: inline-block;\n  vertical-align: top;\n}\n\n.input-group input[type='text'][_v-3a158057] {\n  marging-bottom: 0;\n}\nlabel input[_v-3a158057] {\n  font-weight: 400;\n}\n\ninput[type='number'][_v-3a158057] {\n  marging-bottom: 0;\n}\n.valid-titleField[_v-3a158057] {\n  background-color: #fefefe;\n  border-color: #cacaca;\n}\n.no-input[_v-3a158057] {\n  background-color: #fefefe;\n  border-color: #cacaca;\n}\n.invalid-input[_v-3a158057] {\n  background-color: rgba(236, 88, 64, 0.1);\n  border: 1px dotted red;\n}\n.invalid[_v-3a158057] {\n  color: #ff0000;\n}\n.reqstar[_v-3a158057] {\n  font-size: .7rem;\n  color: #E33100;\n  vertical-align:text-top;\n}\n\nselect[_v-3a158057] {\n  margin: 0;\n}\n\n[type='submit'][_v-3a158057], [type='button'][_v-3a158057] {\n  margin-top: 0.8rem;\n}\ninput[type=\"number\"][_v-3a158057]{\n  margin: 0;\n}\ninput[type=\"text\"][_v-3a158057]{\n  margin: 0;\n}\nform[_v-3a158057] {\n  padding-bottom: 20px;\n}\n.yellowBtn[_v-3a158057] {\n  background: hsl(60, 70%, 50%);\n}\n.redBtn[_v-3a158057] {\n  background: hsl(0, 90%, 70%);\n}\nh5.form-control[_v-3a158057], .mockh5[_v-3a158057] {\n  margin: 0;\n  display: block;\n  width: 100%;\n  padding: .5rem;\n  font-size: 14px;\n  line-height: 1.42857143;\n  color: #222222;\n  background-color: #fff;\n  background-image: none;\n  border: 1px solid #ccc;\n  border-radius: 4px;\n  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\n  transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;\n}\ntextarea[_v-3a158057] {\n  resize: vertical !important;\n}\n"] = false
    document.head.removeChild(__vueify_style__)
  })
  if (!module.hot.data) {
    hotAPI.createRecord("_v-3a158057", module.exports)
  } else {
    hotAPI.update("_v-3a158057", module.exports, (typeof module.exports === "function" ? module.exports.options : module.exports).template)
  }
})()}
},{"babel-runtime/core-js/json/stringify":1,"flatpickr":101,"vue":106,"vue-hot-reload-api":103,"vue-select":105,"vueify/lib/insert-css":107}],109:[function(require,module,exports){
'use strict';

var _vueResource = require('vue-resource');

var _vueResource2 = _interopRequireDefault(_vueResource);

var _EventForm = require('./components/EventForm.vue');

var _EventForm2 = _interopRequireDefault(_EventForm);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var Vue = require('vue');

Vue.use(_vueResource2.default);

// Remember the token we created in the <head> tags? Get it here.
var CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
Vue.http.headers.common['X-CSRF-TOKEN'] = CSRFToken;

var vm = new Vue({
  el: '#vue-event-form',
  components: { EventForm: _EventForm2.default },
  ready: function ready() {}
});

function assignEventListeners() {
  // Cancel and edit buttons need to call vue object methods
  $("#calendar-bar").on("click", ".editBtn", function (event) {
    vm.$refs.foo.fetchSubmittedRecord(this.parentNode.id);
  });
  $("#calendar-bar").on("click", ".cancelBtn", function (event) {
    vm.$refs.foo.cancelRecord(this.parentNode.id);
  });
}
assignEventListeners();

},{"./components/EventForm.vue":108,"vue":106,"vue-resource":104}]},{},[109]);

//# sourceMappingURL=vue-event-form.js.map
