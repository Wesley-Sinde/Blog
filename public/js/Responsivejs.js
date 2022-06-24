(() => {
    var __webpack_modules__ = ({
        366: (() => {
            var hideAllOtherAccordionHeaderElements = function hideAllOtherAccordionHeaderElements(accordionHeaderElements, currentAccordionHeaderEl, activeClassesArray, inactiveClassesArray) {
                accordionHeaderElements.forEach(function (headerEl) {
                    if (currentAccordionHeaderEl !== headerEl) {
                        var bodyEl = document.querySelector(headerEl.getAttribute('data-accordion-target'));
                        headerEl.setAttribute('aria-expanded', false);
                        activeClassesArray.map(function (c) {
                            headerEl.classList.remove(c);
                        });
                        inactiveClassesArray.map(function (c) {
                            headerEl.classList.add(c);
                        });
                        bodyEl.classList.add('hidden');
                        if (headerEl.querySelector('[data-accordion-icon]')) {
                            headerEl.querySelector('[data-accordion-icon]').classList.remove('rotate-180');
                        }
                    }
                });
            };
            var rotateAccordionIcon = function rotateAccordionIcon(accordionHeaderEl) {
                if (accordionHeaderEl.querySelector('[data-accordion-icon]')) {
                    accordionHeaderEl.querySelector('[data-accordion-icon]').classList.toggle('rotate-180');
                }
            };
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('[data-accordion]').forEach(function (accordionEl) {
                    var accordionId = accordionEl.getAttribute('id');
                    var collapseAccordion = accordionEl.getAttribute('data-accordion');
                    var accordionHeaderElements = document.querySelectorAll('#' + accordionId + ' [data-accordion-target]');
                    var activeClasses = accordionEl.getAttribute('data-active-classes');
                    var inactiveClasses = accordionEl.getAttribute('data-inactive-classes');
                    var activeClassesArray = null;
                    if (activeClasses && activeClasses !== '') {
                        activeClassesArray = activeClasses.split(" ");
                    } else {
                        activeClassesArray = ['bg-gray-100', 'dark:bg-gray-800', 'text-gray-900', 'dark:text-white'];
                    }
                    var inactiveClassesArray = null;
                    if (inactiveClasses && inactiveClasses !== '') {
                        inactiveClassesArray = inactiveClasses.split(" ");
                    } else {
                        inactiveClassesArray = ['text-gray-500', 'dark:text-gray-400'];
                    }
                    accordionHeaderElements.forEach(function (accordionHeaderEl) {
                        var accordionBodyEl = document.querySelector(accordionHeaderEl.getAttribute('data-accordion-target'));
                        accordionHeaderEl.addEventListener('click', function () {
                            if (collapseAccordion === 'collapse') {
                                hideAllOtherAccordionHeaderElements(accordionHeaderElements, accordionHeaderEl, activeClassesArray, inactiveClassesArray);
                            }
                            if (accordionHeaderEl.getAttribute('aria-expanded') === 'true') {
                                accordionHeaderEl.setAttribute('aria-expanded', false);
                                activeClassesArray.map(function (c) {
                                    accordionHeaderEl.classList.remove(c);
                                });
                                inactiveClassesArray.map(function (c) {
                                    accordionHeaderEl.classList.add(c);
                                });
                                accordionBodyEl.classList.add('hidden');
                                rotateAccordionIcon(accordionHeaderEl);
                            } else {
                                accordionHeaderEl.setAttribute('aria-expanded', true);
                                activeClassesArray.map(function (c) {
                                    accordionHeaderEl.classList.add(c);
                                });
                                inactiveClassesArray.map(function (c) {
                                    accordionHeaderEl.classList.remove(c);
                                });
                                accordionBodyEl.classList.remove('hidden');
                                rotateAccordionIcon(accordionHeaderEl);
                            }
                        });
                    });
                });
            });
        }),
        791: (() => {
            function _toConsumableArray(arr) {
                return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread();
            }

            function _nonIterableSpread() {
                throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
            }

            function _unsupportedIterableToArray(o, minLen) {
                if (!o) return;
                if (typeof o === "string") return _arrayLikeToArray(o, minLen);
                var n = Object.prototype.toString.call(o).slice(8, -1);
                if (n === "Object" && o.constructor) n = o.constructor.name;
                if (n === "Map" || n === "Set") return Array.from(o);
                if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen);
            }

            function _iterableToArray(iter) {
                if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter);
            }

            function _arrayWithoutHoles(arr) {
                if (Array.isArray(arr)) return _arrayLikeToArray(arr);
            }

            function _arrayLikeToArray(arr, len) {
                if (len == null || len > arr.length) len = arr.length;
                for (var i = 0, arr2 = new Array(len); i < len; i++) {
                    arr2[i] = arr[i];
                }
                return arr2;
            }

            function _classCallCheck(instance, Constructor) {
                if (!(instance instanceof Constructor)) {
                    throw new TypeError("Cannot call a class as a function");
                }
            }

            function _defineProperties(target, props) {
                for (var i = 0; i < props.length; i++) {
                    var descriptor = props[i];
                    descriptor.enumerable = descriptor.enumerable || false;
                    descriptor.configurable = true;
                    if ("value" in descriptor) descriptor.writable = true;
                    Object.defineProperty(target, descriptor.key, descriptor);
                }
            }

            function _createClass(Constructor, protoProps, staticProps) {
                if (protoProps) _defineProperties(Constructor.prototype, protoProps);
                if (staticProps) _defineProperties(Constructor, staticProps);
                return Constructor;
            }
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('[data-carousel]').forEach(function (carouselEl) {
                    var interval = carouselEl.getAttribute('data-carousel-interval');
                    var slide = carouselEl.getAttribute('data-carousel') === 'slide' ? true : false;
                    var carousel = new Carousel(carouselEl.getAttribute('id'), {
                        interval: interval
                    });
                    if (slide) {
                        carousel.cycle();
                    }
                    var carouselNextEl = carouselEl.querySelector('[data-carousel-next]');
                    var carouselPrevEl = carouselEl.querySelector('[data-carousel-prev]');
                    if (carouselNextEl) {
                        carouselNextEl.addEventListener('click', function () {
                            carousel.nextSlide();
                        });
                    }
                    if (carouselPrevEl) {
                        carouselPrevEl.addEventListener('click', function () {
                            carousel.prevSlide();
                        });
                    }
                    carouselEl.querySelectorAll('[data-carousel-slide-to]').forEach(function (slideToEl) {
                        slideToEl.addEventListener('click', function () {
                            var id = slideToEl.getAttribute('data-carousel-slide-to');
                            carousel.slideTo(id);
                        });
                    });
                });
            });
            var Default = {
                interval: 3000
            };
            var Carousel = function () {
                function Carousel(id, options) {
                    _classCallCheck(this, Carousel);
                    this._el = document.getElementById(id);
                    this._items = _toConsumableArray(this._el.querySelectorAll('[data-carousel-item]')).length ? _toConsumableArray(this._el.querySelectorAll('[data-carousel-item]')).map(function (el, id) {
                        return {
                            id: id,
                            el: el,
                            active: el.getAttribute(['data-carousel-item']) === 'active' ? true : false
                        };
                    }) : [];
                    this._indicators = _toConsumableArray(this._el.querySelectorAll('[data-carousel-slide-to]')).length ? _toConsumableArray(this._el.querySelectorAll('[data-carousel-slide-to]')).map(function (el, id) {
                        return {
                            id: id,
                            el: el
                        };
                    }) : [];
                    this._interval = null;
                    this._intervalDuration = options.interval ? options.interval : Default.interval;
                    this._init();
                }
                _createClass(Carousel, [{
                    key: "_init",
                    value: function _init() {
                        var activeItem = this._getActiveItem();
                        this._items.map(function (item) {
                            item.el.classList.add('absolute', 'inset-0', 'transition-all', 'transform');
                        });
                        this.slideTo(activeItem.id);
                    }
                }, {
                    key: "slideTo",
                    value: function slideTo(id) {
                        var nextItem = this._items[id];
                        var rotationItems = {
                            'left': nextItem.id === 0 ? this._items[this._items.length - 1] : this._items[nextItem.id - 1],
                            'middle': nextItem,
                            'right': nextItem.id === this._items.length - 1 ? this._items[0] : this._items[nextItem.id + 1]
                        };
                        this._rotate(rotationItems);
                        this._setActiveItem(nextItem.id);
                        if (this._interval) {
                            this.pause();
                            this.cycle();
                        }
                    }
                }, {
                    key: "nextSlide",
                    value: function nextSlide() {
                        var activeItem = this._getActiveItem();
                        var nextItem = null;
                        if (activeItem.id === this._items.length - 1) {
                            nextItem = this._items[0];
                        } else {
                            nextItem = this._items[activeItem.id + 1];
                        }
                        this.slideTo(nextItem.id);
                    }
                }, {
                    key: "prevSlide",
                    value: function prevSlide() {
                        var activeItem = this._getActiveItem();
                        var prevItem = null;
                        if (activeItem.id === 0) {
                            prevItem = this._items[this._items.length - 1];
                        } else {
                            prevItem = this._items[activeItem.id - 1];
                        }
                        this.slideTo(prevItem.id);
                    }
                }, {
                    key: "_rotate",
                    value: function _rotate(rotationItems) {
                        this._items.map(function (item) {
                            item.el.classList.add('hidden');
                        });
                        rotationItems.left.el.classList.remove('-translate-x-full', 'translate-x-full', 'translate-x-0', 'hidden');
                        rotationItems.left.el.classList.add('-translate-x-full');
                        rotationItems.middle.el.classList.remove('-translate-x-full', 'translate-x-full', 'translate-x-0', 'hidden');
                        rotationItems.middle.el.classList.add('translate-x-0');
                        rotationItems.right.el.classList.remove('-translate-x-full', 'translate-x-full', 'translate-x-0', 'hidden');
                        rotationItems.right.el.classList.add('translate-x-full');
                    }
                }, {
                    key: "cycle",
                    value: function cycle(intervalDuration) {
                        var _this = this;
                        if (intervalDuration) {
                            this._intervalDuration = intervalDuration;
                        }
                        this._interval = setInterval(function () {
                            _this.nextSlide();
                        }, this._intervalDuration);
                    }
                }, {
                    key: "pause",
                    value: function pause() {
                        clearInterval(this._interval);
                    }
                }, {
                    key: "_getActiveItem",
                    value: function _getActiveItem() {
                        return this._items.filter(function (item) {
                            return item.active;
                        })[0];
                    }
                }, {
                    key: "_setActiveItem",
                    value: function _setActiveItem(id) {
                        this._items.map(function (item) {
                            item.active = false;
                            item.el.setAttribute('data-carousel-item', '');
                            if (item.id === id) {
                                item.active = true;
                                item.el.setAttribute('data-carousel-item', 'active');
                            }
                        });
                        this._indicators.map(function (indicator) {
                            indicator.el.setAttribute('aria-current', 'false');
                            indicator.el.classList.remove('bg-white', 'dark:bg-gray-800');
                            indicator.el.classList.add('bg-white/50', 'dark:bg-gray-800/50');
                            if (indicator.id === id) {
                                indicator.el.classList.add('bg-white', 'dark:bg-gray-800');
                                indicator.el.classList.remove('bg-white/50', 'dark:bg-gray-800/50');
                                indicator.el.setAttribute('aria-current', 'true');
                            }
                        });
                    }
                }]);
                return Carousel;
            }();
        }),
        540: (() => {
            var toggleCollapse = function toggleCollapse(elementId) {
                var show = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
                var collapseEl = document.getElementById(elementId);
                if (show) {
                    collapseEl.classList.remove('hidden');
                } else {
                    collapseEl.classList.add('hidden');
                }
            };
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('[data-collapse-toggle]').forEach(function (collapseToggleEl) {
                    var collapseId = collapseToggleEl.getAttribute('data-collapse-toggle');
                    collapseToggleEl.addEventListener('click', function () {
                        toggleCollapse(collapseId, document.getElementById(collapseId).classList.contains('hidden'));
                    });
                });
            });
            window.toggleCollapse = toggleCollapse;
        }),
        84: (() => {
            var toggleModal = function toggleModal(modalId) {
                var show = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
                var modalEl = document.getElementById(modalId);
                if (show) {
                    modalEl.classList.add('flex');
                    modalEl.classList.remove('hidden');
                    modalEl.setAttribute('aria-modal', 'true');
                    modalEl.setAttribute('role', 'dialog');
                    modalEl.removeAttribute('aria-hidden');
                    var backdropEl = document.createElement('div');
                    backdropEl.setAttribute('modal-backdrop', '');
                    backdropEl.classList.add('bg-gray-900', 'bg-opacity-50', 'dark:bg-opacity-80', 'fixed', 'inset-0', 'z-40');
                    document.querySelector('body').append(backdropEl);
                } else {
                    modalEl.classList.add('hidden');
                    modalEl.classList.remove('flex');
                    modalEl.setAttribute('aria-hidden', 'true');
                    modalEl.removeAttribute('aria-modal');
                    modalEl.removeAttribute('role');
                    document.querySelector('[modal-backdrop]').remove();
                }
            };
            window.toggleModal = toggleModal;
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('[data-modal-toggle]').forEach(function (modalToggleEl) {
                    var modalId = modalToggleEl.getAttribute('data-modal-toggle');
                    var modalEl = document.getElementById(modalId);
                    if (modalEl) {
                        if (!modalEl.hasAttribute('aria-hidden') && !modalEl.hasAttribute('aria-modal')) {
                            modalEl.setAttribute('aria-hidden', 'true');
                        }
                        modalToggleEl.addEventListener('click', function () {
                            toggleModal(modalId, modalEl.hasAttribute('aria-hidden', 'true'));
                        });
                    }
                });
            });
        }),
        97: (() => {
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('[data-tabs-toggle]').forEach(function (tabsToggleEl) {
                    var tabsToggleElementsId = tabsToggleEl.getAttribute('id');
                    var tabsToggleElements = document.querySelectorAll('#' + tabsToggleElementsId + ' [role="tab"]');
                    var activeTabToggleEl = null;
                    var activeTabContentEl = null;
                    tabsToggleElements.forEach(function (tabToggleEl) {
                        tabToggleEl.addEventListener('click', function (event) {
                            var tabToggleEl = event.target;
                            var tabTargetSelector = tabToggleEl.getAttribute('data-tabs-target');
                            var tabContentEl = document.querySelector(tabTargetSelector);
                            if (tabToggleEl !== activeTabToggleEl) {
                                if (!activeTabToggleEl && !activeTabContentEl) {
                                    activeTabToggleEl = document.querySelector('#' + tabsToggleElementsId + ' [aria-selected="true"]');
                                    activeTabContentEl = document.querySelector(activeTabToggleEl.getAttribute('data-tabs-target'));
                                }
                                tabToggleEl.classList.add('active');
                                tabToggleEl.setAttribute('aria-selected', true);
                                tabContentEl.classList.remove('hidden');
                                activeTabToggleEl.setAttribute('aria-selected', false);
                                activeTabToggleEl.classList.remove('active');
                                activeTabContentEl.classList.add('hidden');
                                activeTabToggleEl = tabToggleEl;
                                activeTabContentEl = tabContentEl;
                            }
                        });
                    });
                });
            });
        })
    });
    var __webpack_module_cache__ = {};

    function __webpack_require__(moduleId) {
        var cachedModule = __webpack_module_cache__[moduleId];
        if (cachedModule !== undefined) {
            return cachedModule.exports;
        }
        var module = __webpack_module_cache__[moduleId] = {
            exports: {}
        };
        __webpack_modules__[moduleId](module, module.exports, __webpack_require__);
        return module.exports;
    }
    var __webpack_exports__ = {};
    (() => {
        "use strict";
        var accordion = __webpack_require__(366);
        var collapse = __webpack_require__(540);
        var carousel = __webpack_require__(791);;

        function getWindow(node) {
            if (node == null) {
                return window;
            }
            if (node.toString() !== '[object Window]') {
                var ownerDocument = node.ownerDocument;
                return ownerDocument ? ownerDocument.defaultView || window : window;
            }
            return node;
        };

        function isElement(node) {
            var OwnElement = getWindow(node).Element;
            return node instanceof OwnElement || node instanceof Element;
        }

        function isHTMLElement(node) {
            var OwnElement = getWindow(node).HTMLElement;
            return node instanceof OwnElement || node instanceof HTMLElement;
        }

        function isShadowRoot(node) {
            if (typeof ShadowRoot === 'undefined') {
                return false;
            }
            var OwnElement = getWindow(node).ShadowRoot;
            return node instanceof OwnElement || node instanceof ShadowRoot;
        };
        var math_max = Math.max;
        var math_min = Math.min;
        var round = Math.round;;

        function getBoundingClientRect(element, includeScale) {
            if (includeScale === void 0) {
                includeScale = false;
            }
            var rect = element.getBoundingClientRect();
            var scaleX = 1;
            var scaleY = 1;
            if (isHTMLElement(element) && includeScale) {
                var offsetHeight = element.offsetHeight;
                var offsetWidth = element.offsetWidth;
                if (offsetWidth > 0) {
                    scaleX = round(rect.width) / offsetWidth || 1;
                }
                if (offsetHeight > 0) {
                    scaleY = round(rect.height) / offsetHeight || 1;
                }
            }
            return {
                width: rect.width / scaleX,
                height: rect.height / scaleY,
                top: rect.top / scaleY,
                right: rect.right / scaleX,
                bottom: rect.bottom / scaleY,
                left: rect.left / scaleX,
                x: rect.left / scaleX,
                y: rect.top / scaleY
            };
        };

        function getWindowScroll(node) {
            var win = getWindow(node);
            var scrollLeft = win.pageXOffset;
            var scrollTop = win.pageYOffset;
            return {
                scrollLeft: scrollLeft,
                scrollTop: scrollTop
            };
        };

        function getHTMLElementScroll(element) {
            return {
                scrollLeft: element.scrollLeft,
                scrollTop: element.scrollTop
            };
        };

        function getNodeScroll(node) {
            if (node === getWindow(node) || !isHTMLElement(node)) {
                return getWindowScroll(node);
            } else {
                return getHTMLElementScroll(node);
            }
        };

        function getNodeName(element) {
            return element ? (element.nodeName || '').toLowerCase() : null;
        };

        function getDocumentElement(element) {
            return ((isElement(element) ? element.ownerDocument : element.document) || window.document).documentElement;
        };

        function getWindowScrollBarX(element) {
            return getBoundingClientRect(getDocumentElement(element)).left + getWindowScroll(element).scrollLeft;
        };

        function getComputedStyle(element) {
            return getWindow(element).getComputedStyle(element);
        };

        function isScrollParent(element) {
            var _getComputedStyle = getComputedStyle(element),
                overflow = _getComputedStyle.overflow,
                overflowX = _getComputedStyle.overflowX,
                overflowY = _getComputedStyle.overflowY;
            return /auto|scroll|overlay|hidden/.test(overflow + overflowY + overflowX);
        };

        function isElementScaled(element) {
            var rect = element.getBoundingClientRect();
            var scaleX = round(rect.width) / element.offsetWidth || 1;
            var scaleY = round(rect.height) / element.offsetHeight || 1;
            return scaleX !== 1 || scaleY !== 1;
        }

        function getCompositeRect(elementOrVirtualElement, offsetParent, isFixed) {
            if (isFixed === void 0) {
                isFixed = false;
            }
            var isOffsetParentAnElement = isHTMLElement(offsetParent);
            var offsetParentIsScaled = isHTMLElement(offsetParent) && isElementScaled(offsetParent);
            var documentElement = getDocumentElement(offsetParent);
            var rect = getBoundingClientRect(elementOrVirtualElement, offsetParentIsScaled);
            var scroll = {
                scrollLeft: 0,
                scrollTop: 0
            };
            var offsets = {
                x: 0,
                y: 0
            };
            if (isOffsetParentAnElement || !isOffsetParentAnElement && !isFixed) {
                if (getNodeName(offsetParent) !== 'body' || isScrollParent(documentElement)) {
                    scroll = getNodeScroll(offsetParent);
                }
                if (isHTMLElement(offsetParent)) {
                    offsets = getBoundingClientRect(offsetParent, true);
                    offsets.x += offsetParent.clientLeft;
                    offsets.y += offsetParent.clientTop;
                } else if (documentElement) {
                    offsets.x = getWindowScrollBarX(documentElement);
                }
            }
            return {
                x: rect.left + scroll.scrollLeft - offsets.x,
                y: rect.top + scroll.scrollTop - offsets.y,
                width: rect.width,
                height: rect.height
            };
        };

        function getLayoutRect(element) {
            var clientRect = getBoundingClientRect(element);
            var width = element.offsetWidth;
            var height = element.offsetHeight;
            if (Math.abs(clientRect.width - width) <= 1) {
                width = clientRect.width;
            }
            if (Math.abs(clientRect.height - height) <= 1) {
                height = clientRect.height;
            }
            return {
                x: element.offsetLeft,
                y: element.offsetTop,
                width: width,
                height: height
            };
        };

        function getParentNode(element) {
            if (getNodeName(element) === 'html') {
                return element;
            }
            return (element.assignedSlot || element.parentNode || (isShadowRoot(element) ? element.host : null) || getDocumentElement(element));
        };

        function getScrollParent(node) {
            if (['html', 'body', '#document'].indexOf(getNodeName(node)) >= 0) {
                return node.ownerDocument.body;
            }
            if (isHTMLElement(node) && isScrollParent(node)) {
                return node;
            }
            return getScrollParent(getParentNode(node));
        };

        function listScrollParents(element, list) {
            var _element$ownerDocumen;
            if (list === void 0) {
                list = [];
            }
            var scrollParent = getScrollParent(element);
            var isBody = scrollParent === ((_element$ownerDocumen = element.ownerDocument) == null ? void 0 : _element$ownerDocumen.body);
            var win = getWindow(scrollParent);
            var target = isBody ? [win].concat(win.visualViewport || [], isScrollParent(scrollParent) ? scrollParent : []) : scrollParent;
            var updatedList = list.concat(target);
            return isBody ? updatedList : updatedList.concat(listScrollParents(getParentNode(target)));
        };

        function isTableElement(element) {
            return ['table', 'td', 'th'].indexOf(getNodeName(element)) >= 0;
        };

        function getTrueOffsetParent(element) {
            if (!isHTMLElement(element) || getComputedStyle(element).position === 'fixed') {
                return null;
            }
            return element.offsetParent;
        }

        function getContainingBlock(element) {
            var isFirefox = navigator.userAgent.toLowerCase().indexOf('firefox') !== -1;
            var isIE = navigator.userAgent.indexOf('Trident') !== -1;
            if (isIE && isHTMLElement(element)) {
                var elementCss = getComputedStyle(element);
                if (elementCss.position === 'fixed') {
                    return null;
                }
            }
            var currentNode = getParentNode(element);
            while (isHTMLElement(currentNode) && ['html', 'body'].indexOf(getNodeName(currentNode)) < 0) {
                var css = getComputedStyle(currentNode);
                if (css.transform !== 'none' || css.perspective !== 'none' || css.contain === 'paint' || ['transform', 'perspective'].indexOf(css.willChange) !== -1 || isFirefox && css.willChange === 'filter' || isFirefox && css.filter && css.filter !== 'none') {
                    return currentNode;
                } else {
                    currentNode = currentNode.parentNode;
                }
            }
            return null;
        }

        function getOffsetParent(element) {
            var window = getWindow(element);
            var offsetParent = getTrueOffsetParent(element);
            while (offsetParent && isTableElement(offsetParent) && getComputedStyle(offsetParent).position === 'static') {
                offsetParent = getTrueOffsetParent(offsetParent);
            }
            if (offsetParent && (getNodeName(offsetParent) === 'html' || getNodeName(offsetParent) === 'body' && getComputedStyle(offsetParent).position === 'static')) {
                return window;
            }
            return offsetParent || getContainingBlock(element) || window;
        };
        var enums_top = 'top';
        var bottom = 'bottom';
        var right = 'right';
        var left = 'left';
        var auto = 'auto';
        var basePlacements = [enums_top, bottom, right, left];
        var start = 'start';
        var end = 'end';
        var clippingParents = 'clippingParents';
        var viewport = 'viewport';
        var popper = 'popper';
        var reference = 'reference';
        var variationPlacements = basePlacements.reduce(function (acc, placement) {
            return acc.concat([placement + "-" + start, placement + "-" + end]);
        }, []);
        var enums_placements = [].concat(basePlacements, [auto]).reduce(function (acc, placement) {
            return acc.concat([placement, placement + "-" + start, placement + "-" + end]);
        }, []);
        var beforeRead = 'beforeRead';
        var read = 'read';
        var afterRead = 'afterRead';
        var beforeMain = 'beforeMain';
        var main = 'main';
        var afterMain = 'afterMain';
        var beforeWrite = 'beforeWrite';
        var write = 'write';
        var afterWrite = 'afterWrite';
        var modifierPhases = [beforeRead, read, afterRead, beforeMain, main, afterMain, beforeWrite, write, afterWrite];;

        function order(modifiers) {
            var map = new Map();
            var visited = new Set();
            var result = [];
            modifiers.forEach(function (modifier) {
                map.set(modifier.name, modifier);
            });

            function sort(modifier) {
                visited.add(modifier.name);
                var requires = [].concat(modifier.requires || [], modifier.requiresIfExists || []);
                requires.forEach(function (dep) {
                    if (!visited.has(dep)) {
                        var depModifier = map.get(dep);
                        if (depModifier) {
                            sort(depModifier);
                        }
                    }
                });
                result.push(modifier);
            }
            modifiers.forEach(function (modifier) {
                if (!visited.has(modifier.name)) {
                    sort(modifier);
                }
            });
            return result;
        }

        function orderModifiers(modifiers) {
            var orderedModifiers = order(modifiers);
            return modifierPhases.reduce(function (acc, phase) {
                return acc.concat(orderedModifiers.filter(function (modifier) {
                    return modifier.phase === phase;
                }));
            }, []);
        };

        function debounce(fn) {
            var pending;
            return function () {
                if (!pending) {
                    pending = new Promise(function (resolve) {
                        Promise.resolve().then(function () {
                            pending = undefined;
                            resolve(fn());
                        });
                    });
                }
                return pending;
            };
        };

        function mergeByName(modifiers) {
            var merged = modifiers.reduce(function (merged, current) {
                var existing = merged[current.name];
                merged[current.name] = existing ? Object.assign({}, existing, current, {
                    options: Object.assign({}, existing.options, current.options),
                    data: Object.assign({}, existing.data, current.data)
                }) : current;
                return merged;
            }, {});
            return Object.keys(merged).map(function (key) {
                return merged[key];
            });
        };
        var INVALID_ELEMENT_ERROR = 'Popper: Invalid reference or popper argument provided. They must be either a DOM element or virtual element.';
        var INFINITE_LOOP_ERROR = 'Popper: An infinite loop in the modifiers cycle has been detected! The cycle has been interrupted to prevent a browser crash.';
        var DEFAULT_OPTIONS = {
            placement: 'bottom',
            modifiers: [],
            strategy: 'absolute'
        };

        function areValidElements() {
            for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
                args[_key] = arguments[_key];
            }
            return !args.some(function (element) {
                return !(element && typeof element.getBoundingClientRect === 'function');
            });
        }

        function popperGenerator(generatorOptions) {
            if (generatorOptions === void 0) {
                generatorOptions = {};
            }
            var _generatorOptions = generatorOptions,
                _generatorOptions$def = _generatorOptions.defaultModifiers,
                defaultModifiers = _generatorOptions$def === void 0 ? [] : _generatorOptions$def,
                _generatorOptions$def2 = _generatorOptions.defaultOptions,
                defaultOptions = _generatorOptions$def2 === void 0 ? DEFAULT_OPTIONS : _generatorOptions$def2;
            return function createPopper(reference, popper, options) {
                if (options === void 0) {
                    options = defaultOptions;
                }
                var state = {
                    placement: 'bottom',
                    orderedModifiers: [],
                    options: Object.assign({}, DEFAULT_OPTIONS, defaultOptions),
                    modifiersData: {},
                    elements: {
                        reference: reference,
                        popper: popper
                    },
                    attributes: {},
                    styles: {}
                };
                var effectCleanupFns = [];
                var isDestroyed = false;
                var instance = {
                    state: state,
                    setOptions: function setOptions(setOptionsAction) {
                        var options = typeof setOptionsAction === 'function' ? setOptionsAction(state.options) : setOptionsAction;
                        cleanupModifierEffects();
                        state.options = Object.assign({}, defaultOptions, state.options, options);
                        state.scrollParents = {
                            reference: isElement(reference) ? listScrollParents(reference) : reference.contextElement ? listScrollParents(reference.contextElement) : [],
                            popper: listScrollParents(popper)
                        };
                        var orderedModifiers = orderModifiers(mergeByName([].concat(defaultModifiers, state.options.modifiers)));
                        state.orderedModifiers = orderedModifiers.filter(function (m) {
                            return m.enabled;
                        });
                        if (false) {
                            var _getComputedStyle, marginTop, marginRight, marginBottom, marginLeft, flipModifier, modifiers;
                        }
                        runModifierEffects();
                        return instance.update();
                    },
                    forceUpdate: function forceUpdate() {
                        if (isDestroyed) {
                            return;
                        }
                        var _state$elements = state.elements,
                            reference = _state$elements.reference,
                            popper = _state$elements.popper;
                        if (!areValidElements(reference, popper)) {
                            if (false) {}
                            return;
                        }
                        state.rects = {
                            reference: getCompositeRect(reference, getOffsetParent(popper), state.options.strategy === 'fixed'),
                            popper: getLayoutRect(popper)
                        };
                        state.reset = false;
                        state.placement = state.options.placement;
                        state.orderedModifiers.forEach(function (modifier) {
                            return state.modifiersData[modifier.name] = Object.assign({}, modifier.data);
                        });
                        var __debug_loops__ = 0;
                        for (var index = 0; index < state.orderedModifiers.length; index++) {
                            if (false) {}
                            if (state.reset === true) {
                                state.reset = false;
                                index = -1;
                                continue;
                            }
                            var _state$orderedModifie = state.orderedModifiers[index],
                                fn = _state$orderedModifie.fn,
                                _state$orderedModifie2 = _state$orderedModifie.options,
                                _options = _state$orderedModifie2 === void 0 ? {} : _state$orderedModifie2,
                                name = _state$orderedModifie.name;
                            if (typeof fn === 'function') {
                                state = fn({
                                    state: state,
                                    options: _options,
                                    name: name,
                                    instance: instance
                                }) || state;
                            }
                        }
                    },
                    update: debounce(function () {
                        return new Promise(function (resolve) {
                            instance.forceUpdate();
                            resolve(state);
                        });
                    }),
                    destroy: function destroy() {
                        cleanupModifierEffects();
                        isDestroyed = true;
                    }
                };
                if (!areValidElements(reference, popper)) {
                    if (false) {}
                    return instance;
                }
                instance.setOptions(options).then(function (state) {
                    if (!isDestroyed && options.onFirstUpdate) {
                        options.onFirstUpdate(state);
                    }
                });

                function runModifierEffects() {
                    state.orderedModifiers.forEach(function (_ref3) {
                        var name = _ref3.name,
                            _ref3$options = _ref3.options,
                            options = _ref3$options === void 0 ? {} : _ref3$options,
                            effect = _ref3.effect;
                        if (typeof effect === 'function') {
                            var cleanupFn = effect({
                                state: state,
                                name: name,
                                instance: instance,
                                options: options
                            });
                            var noopFn = function noopFn() {};
                            effectCleanupFns.push(cleanupFn || noopFn);
                        }
                    });
                }

                function cleanupModifierEffects() {
                    effectCleanupFns.forEach(function (fn) {
                        return fn();
                    });
                    effectCleanupFns = [];
                }
                return instance;
            };
        }
        var createPopper = (null && (popperGenerator()));;
        var passive = {
            passive: true
        };

        function effect(_ref) {
            var state = _ref.state,
                instance = _ref.instance,
                options = _ref.options;
            var _options$scroll = options.scroll,
                scroll = _options$scroll === void 0 ? true : _options$scroll,
                _options$resize = options.resize,
                resize = _options$resize === void 0 ? true : _options$resize;
            var window = getWindow(state.elements.popper);
            var scrollParents = [].concat(state.scrollParents.reference, state.scrollParents.popper);
            if (scroll) {
                scrollParents.forEach(function (scrollParent) {
                    scrollParent.addEventListener('scroll', instance.update, passive);
                });
            }
            if (resize) {
                window.addEventListener('resize', instance.update, passive);
            }
            return function () {
                if (scroll) {
                    scrollParents.forEach(function (scrollParent) {
                        scrollParent.removeEventListener('scroll', instance.update, passive);
                    });
                }
                if (resize) {
                    window.removeEventListener('resize', instance.update, passive);
                }
            };
        }
        const eventListeners = ({
            name: 'eventListeners',
            enabled: true,
            phase: 'write',
            fn: function fn() {},
            effect: effect,
            data: {}
        });;

        function getBasePlacement(placement) {
            return placement.split('-')[0];
        };

        function getVariation(placement) {
            return placement.split('-')[1];
        };

        function getMainAxisFromPlacement(placement) {
            return ['top', 'bottom'].indexOf(placement) >= 0 ? 'x' : 'y';
        };

        function computeOffsets(_ref) {
            var reference = _ref.reference,
                element = _ref.element,
                placement = _ref.placement;
            var basePlacement = placement ? getBasePlacement(placement) : null;
            var variation = placement ? getVariation(placement) : null;
            var commonX = reference.x + reference.width / 2 - element.width / 2;
            var commonY = reference.y + reference.height / 2 - element.height / 2;
            var offsets;
            switch (basePlacement) {
                case enums_top:
                    offsets = {
                        x: commonX,
                        y: reference.y - element.height
                    };
                    break;
                case bottom:
                    offsets = {
                        x: commonX,
                        y: reference.y + reference.height
                    };
                    break;
                case right:
                    offsets = {
                        x: reference.x + reference.width,
                        y: commonY
                    };
                    break;
                case left:
                    offsets = {
                        x: reference.x - element.width,
                        y: commonY
                    };
                    break;
                default:
                    offsets = {
                        x: reference.x,
                        y: reference.y
                    };
            }
            var mainAxis = basePlacement ? getMainAxisFromPlacement(basePlacement) : null;
            if (mainAxis != null) {
                var len = mainAxis === 'y' ? 'height' : 'width';
                switch (variation) {
                    case start:
                        offsets[mainAxis] = offsets[mainAxis] - (reference[len] / 2 - element[len] / 2);
                        break;
                    case end:
                        offsets[mainAxis] = offsets[mainAxis] + (reference[len] / 2 - element[len] / 2);
                        break;
                    default:
                }
            }
            return offsets;
        };

        function popperOffsets(_ref) {
            var state = _ref.state,
                name = _ref.name;
            state.modifiersData[name] = computeOffsets({
                reference: state.rects.reference,
                element: state.rects.popper,
                strategy: 'absolute',
                placement: state.placement
            });
        }
        const modifiers_popperOffsets = ({
            name: 'popperOffsets',
            enabled: true,
            phase: 'read',
            fn: popperOffsets,
            data: {}
        });;
        var unsetSides = {
            top: 'auto',
            right: 'auto',
            bottom: 'auto',
            left: 'auto'
        };

        function roundOffsetsByDPR(_ref) {
            var x = _ref.x,
                y = _ref.y;
            var win = window;
            var dpr = win.devicePixelRatio || 1;
            return {
                x: round(x * dpr) / dpr || 0,
                y: round(y * dpr) / dpr || 0
            };
        }

        function mapToStyles(_ref2) {
            var _Object$assign2;
            var popper = _ref2.popper,
                popperRect = _ref2.popperRect,
                placement = _ref2.placement,
                variation = _ref2.variation,
                offsets = _ref2.offsets,
                position = _ref2.position,
                gpuAcceleration = _ref2.gpuAcceleration,
                adaptive = _ref2.adaptive,
                roundOffsets = _ref2.roundOffsets,
                isFixed = _ref2.isFixed;
            var _ref3 = roundOffsets === true ? roundOffsetsByDPR(offsets) : typeof roundOffsets === 'function' ? roundOffsets(offsets) : offsets,
                _ref3$x = _ref3.x,
                x = _ref3$x === void 0 ? 0 : _ref3$x,
                _ref3$y = _ref3.y,
                y = _ref3$y === void 0 ? 0 : _ref3$y;
            var hasX = offsets.hasOwnProperty('x');
            var hasY = offsets.hasOwnProperty('y');
            var sideX = left;
            var sideY = enums_top;
            var win = window;
            if (adaptive) {
                var offsetParent = getOffsetParent(popper);
                var heightProp = 'clientHeight';
                var widthProp = 'clientWidth';
                if (offsetParent === getWindow(popper)) {
                    offsetParent = getDocumentElement(popper);
                    if (getComputedStyle(offsetParent).position !== 'static' && position === 'absolute') {
                        heightProp = 'scrollHeight';
                        widthProp = 'scrollWidth';
                    }
                }
                offsetParent = offsetParent;
                if (placement === enums_top || (placement === left || placement === right) && variation === end) {
                    sideY = bottom;
                    var offsetY = isFixed && win.visualViewport ? win.visualViewport.height : offsetParent[heightProp];
                    y -= offsetY - popperRect.height;
                    y *= gpuAcceleration ? 1 : -1;
                }
                if (placement === left || (placement === enums_top || placement === bottom) && variation === end) {
                    sideX = right;
                    var offsetX = isFixed && win.visualViewport ? win.visualViewport.width : offsetParent[widthProp];
                    x -= offsetX - popperRect.width;
                    x *= gpuAcceleration ? 1 : -1;
                }
            }
            var commonStyles = Object.assign({
                position: position
            }, adaptive && unsetSides);
            if (gpuAcceleration) {
                var _Object$assign;
                return Object.assign({}, commonStyles, (_Object$assign = {}, _Object$assign[sideY] = hasY ? '0' : '', _Object$assign[sideX] = hasX ? '0' : '', _Object$assign.transform = (win.devicePixelRatio || 1) <= 1 ? "translate(" + x + "px, " + y + "px)" : "translate3d(" + x + "px, " + y + "px, 0)", _Object$assign));
            }
            return Object.assign({}, commonStyles, (_Object$assign2 = {}, _Object$assign2[sideY] = hasY ? y + "px" : '', _Object$assign2[sideX] = hasX ? x + "px" : '', _Object$assign2.transform = '', _Object$assign2));
        }

        function computeStyles(_ref4) {
            var state = _ref4.state,
                options = _ref4.options;
            var _options$gpuAccelerat = options.gpuAcceleration,
                gpuAcceleration = _options$gpuAccelerat === void 0 ? true : _options$gpuAccelerat,
                _options$adaptive = options.adaptive,
                adaptive = _options$adaptive === void 0 ? true : _options$adaptive,
                _options$roundOffsets = options.roundOffsets,
                roundOffsets = _options$roundOffsets === void 0 ? true : _options$roundOffsets;
            if (false) {
                var transitionProperty;
            }
            var commonStyles = {
                placement: getBasePlacement(state.placement),
                variation: getVariation(state.placement),
                popper: state.elements.popper,
                popperRect: state.rects.popper,
                gpuAcceleration: gpuAcceleration,
                isFixed: state.options.strategy === 'fixed'
            };
            if (state.modifiersData.popperOffsets != null) {
                state.styles.popper = Object.assign({}, state.styles.popper, mapToStyles(Object.assign({}, commonStyles, {
                    offsets: state.modifiersData.popperOffsets,
                    position: state.options.strategy,
                    adaptive: adaptive,
                    roundOffsets: roundOffsets
                })));
            }
            if (state.modifiersData.arrow != null) {
                state.styles.arrow = Object.assign({}, state.styles.arrow, mapToStyles(Object.assign({}, commonStyles, {
                    offsets: state.modifiersData.arrow,
                    position: 'absolute',
                    adaptive: false,
                    roundOffsets: roundOffsets
                })));
            }
            state.attributes.popper = Object.assign({}, state.attributes.popper, {
                'data-popper-placement': state.placement
            });
        }
        const modifiers_computeStyles = ({
            name: 'computeStyles',
            enabled: true,
            phase: 'beforeWrite',
            fn: computeStyles,
            data: {}
        });;

        function applyStyles(_ref) {
            var state = _ref.state;
            Object.keys(state.elements).forEach(function (name) {
                var style = state.styles[name] || {};
                var attributes = state.attributes[name] || {};
                var element = state.elements[name];
                if (!isHTMLElement(element) || !getNodeName(element)) {
                    return;
                }
                Object.assign(element.style, style);
                Object.keys(attributes).forEach(function (name) {
                    var value = attributes[name];
                    if (value === false) {
                        element.removeAttribute(name);
                    } else {
                        element.setAttribute(name, value === true ? '' : value);
                    }
                });
            });
        }

        function applyStyles_effect(_ref2) {
            var state = _ref2.state;
            var initialStyles = {
                popper: {
                    position: state.options.strategy,
                    left: '0',
                    top: '0',
                    margin: '0'
                },
                arrow: {
                    position: 'absolute'
                },
                reference: {}
            };
            Object.assign(state.elements.popper.style, initialStyles.popper);
            state.styles = initialStyles;
            if (state.elements.arrow) {
                Object.assign(state.elements.arrow.style, initialStyles.arrow);
            }
            return function () {
                Object.keys(state.elements).forEach(function (name) {
                    var element = state.elements[name];
                    var attributes = state.attributes[name] || {};
                    var styleProperties = Object.keys(state.styles.hasOwnProperty(name) ? state.styles[name] : initialStyles[name]);
                    var style = styleProperties.reduce(function (style, property) {
                        style[property] = '';
                        return style;
                    }, {});
                    if (!isHTMLElement(element) || !getNodeName(element)) {
                        return;
                    }
                    Object.assign(element.style, style);
                    Object.keys(attributes).forEach(function (attribute) {
                        element.removeAttribute(attribute);
                    });
                });
            };
        }
        const modifiers_applyStyles = ({
            name: 'applyStyles',
            enabled: true,
            phase: 'write',
            fn: applyStyles,
            effect: applyStyles_effect,
            requires: ['computeStyles']
        });;

        function distanceAndSkiddingToXY(placement, rects, offset) {
            var basePlacement = getBasePlacement(placement);
            var invertDistance = [left, enums_top].indexOf(basePlacement) >= 0 ? -1 : 1;
            var _ref = typeof offset === 'function' ? offset(Object.assign({}, rects, {
                    placement: placement
                })) : offset,
                skidding = _ref[0],
                distance = _ref[1];
            skidding = skidding || 0;
            distance = (distance || 0) * invertDistance;
            return [left, right].indexOf(basePlacement) >= 0 ? {
                x: distance,
                y: skidding
            } : {
                x: skidding,
                y: distance
            };
        }

        function offset(_ref2) {
            var state = _ref2.state,
                options = _ref2.options,
                name = _ref2.name;
            var _options$offset = options.offset,
                offset = _options$offset === void 0 ? [0, 0] : _options$offset;
            var data = enums_placements.reduce(function (acc, placement) {
                acc[placement] = distanceAndSkiddingToXY(placement, state.rects, offset);
                return acc;
            }, {});
            var _data$state$placement = data[state.placement],
                x = _data$state$placement.x,
                y = _data$state$placement.y;
            if (state.modifiersData.popperOffsets != null) {
                state.modifiersData.popperOffsets.x += x;
                state.modifiersData.popperOffsets.y += y;
            }
            state.modifiersData[name] = data;
        }
        const modifiers_offset = ({
            name: 'offset',
            enabled: true,
            phase: 'main',
            requires: ['popperOffsets'],
            fn: offset
        });;
        var hash = {
            left: 'right',
            right: 'left',
            bottom: 'top',
            top: 'bottom'
        };

        function getOppositePlacement(placement) {
            return placement.replace(/left|right|bottom|top/g, function (matched) {
                return hash[matched];
            });
        };
        var getOppositeVariationPlacement_hash = {
            start: 'end',
            end: 'start'
        };

        function getOppositeVariationPlacement(placement) {
            return placement.replace(/start|end/g, function (matched) {
                return getOppositeVariationPlacement_hash[matched];
            });
        };

        function getViewportRect(element) {
            var win = getWindow(element);
            var html = getDocumentElement(element);
            var visualViewport = win.visualViewport;
            var width = html.clientWidth;
            var height = html.clientHeight;
            var x = 0;
            var y = 0;
            if (visualViewport) {
                width = visualViewport.width;
                height = visualViewport.height;
                if (!/^((?!chrome|android).)*safari/i.test(navigator.userAgent)) {
                    x = visualViewport.offsetLeft;
                    y = visualViewport.offsetTop;
                }
            }
            return {
                width: width,
                height: height,
                x: x + getWindowScrollBarX(element),
                y: y
            };
        };

        function getDocumentRect(element) {
            var _element$ownerDocumen;
            var html = getDocumentElement(element);
            var winScroll = getWindowScroll(element);
            var body = (_element$ownerDocumen = element.ownerDocument) == null ? void 0 : _element$ownerDocumen.body;
            var width = math_max(html.scrollWidth, html.clientWidth, body ? body.scrollWidth : 0, body ? body.clientWidth : 0);
            var height = math_max(html.scrollHeight, html.clientHeight, body ? body.scrollHeight : 0, body ? body.clientHeight : 0);
            var x = -winScroll.scrollLeft + getWindowScrollBarX(element);
            var y = -winScroll.scrollTop;
            if (getComputedStyle(body || html).direction === 'rtl') {
                x += math_max(html.clientWidth, body ? body.clientWidth : 0) - width;
            }
            return {
                width: width,
                height: height,
                x: x,
                y: y
            };
        };

        function contains(parent, child) {
            var rootNode = child.getRootNode && child.getRootNode();
            if (parent.contains(child)) {
                return true;
            } else if (rootNode && isShadowRoot(rootNode)) {
                var next = child;
                do {
                    if (next && parent.isSameNode(next)) {
                        return true;
                    }
                    next = next.parentNode || next.host;
                } while (next);
            }
            return false;
        };

        function rectToClientRect(rect) {
            return Object.assign({}, rect, {
                left: rect.x,
                top: rect.y,
                right: rect.x + rect.width,
                bottom: rect.y + rect.height
            });
        };

        function getInnerBoundingClientRect(element) {
            var rect = getBoundingClientRect(element);
            rect.top = rect.top + element.clientTop;
            rect.left = rect.left + element.clientLeft;
            rect.bottom = rect.top + element.clientHeight;
            rect.right = rect.left + element.clientWidth;
            rect.width = element.clientWidth;
            rect.height = element.clientHeight;
            rect.x = rect.left;
            rect.y = rect.top;
            return rect;
        }

        function getClientRectFromMixedType(element, clippingParent) {
            return clippingParent === viewport ? rectToClientRect(getViewportRect(element)) : isElement(clippingParent) ? getInnerBoundingClientRect(clippingParent) : rectToClientRect(getDocumentRect(getDocumentElement(element)));
        }

        function getClippingParents(element) {
            var clippingParents = listScrollParents(getParentNode(element));
            var canEscapeClipping = ['absolute', 'fixed'].indexOf(getComputedStyle(element).position) >= 0;
            var clipperElement = canEscapeClipping && isHTMLElement(element) ? getOffsetParent(element) : element;
            if (!isElement(clipperElement)) {
                return [];
            }
            return clippingParents.filter(function (clippingParent) {
                return isElement(clippingParent) && contains(clippingParent, clipperElement) && getNodeName(clippingParent) !== 'body' && (canEscapeClipping ? getComputedStyle(clippingParent).position !== 'static' : true);
            });
        }

        function getClippingRect(element, boundary, rootBoundary) {
            var mainClippingParents = boundary === 'clippingParents' ? getClippingParents(element) : [].concat(boundary);
            var clippingParents = [].concat(mainClippingParents, [rootBoundary]);
            var firstClippingParent = clippingParents[0];
            var clippingRect = clippingParents.reduce(function (accRect, clippingParent) {
                var rect = getClientRectFromMixedType(element, clippingParent);
                accRect.top = math_max(rect.top, accRect.top);
                accRect.right = math_min(rect.right, accRect.right);
                accRect.bottom = math_min(rect.bottom, accRect.bottom);
                accRect.left = math_max(rect.left, accRect.left);
                return accRect;
            }, getClientRectFromMixedType(element, firstClippingParent));
            clippingRect.width = clippingRect.right - clippingRect.left;
            clippingRect.height = clippingRect.bottom - clippingRect.top;
            clippingRect.x = clippingRect.left;
            clippingRect.y = clippingRect.top;
            return clippingRect;
        };

        function getFreshSideObject() {
            return {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            };
        };

        function mergePaddingObject(paddingObject) {
            return Object.assign({}, getFreshSideObject(), paddingObject);
        };

        function expandToHashMap(value, keys) {
            return keys.reduce(function (hashMap, key) {
                hashMap[key] = value;
                return hashMap;
            }, {});
        };

        function detectOverflow(state, options) {
            if (options === void 0) {
                options = {};
            }
            var _options = options,
                _options$placement = _options.placement,
                placement = _options$placement === void 0 ? state.placement : _options$placement,
                _options$boundary = _options.boundary,
                boundary = _options$boundary === void 0 ? clippingParents : _options$boundary,
                _options$rootBoundary = _options.rootBoundary,
                rootBoundary = _options$rootBoundary === void 0 ? viewport : _options$rootBoundary,
                _options$elementConte = _options.elementContext,
                elementContext = _options$elementConte === void 0 ? popper : _options$elementConte,
                _options$altBoundary = _options.altBoundary,
                altBoundary = _options$altBoundary === void 0 ? false : _options$altBoundary,
                _options$padding = _options.padding,
                padding = _options$padding === void 0 ? 0 : _options$padding;
            var paddingObject = mergePaddingObject(typeof padding !== 'number' ? padding : expandToHashMap(padding, basePlacements));
            var altContext = elementContext === popper ? reference : popper;
            var popperRect = state.rects.popper;
            var element = state.elements[altBoundary ? altContext : elementContext];
            var clippingClientRect = getClippingRect(isElement(element) ? element : element.contextElement || getDocumentElement(state.elements.popper), boundary, rootBoundary);
            var referenceClientRect = getBoundingClientRect(state.elements.reference);
            var popperOffsets = computeOffsets({
                reference: referenceClientRect,
                element: popperRect,
                strategy: 'absolute',
                placement: placement
            });
            var popperClientRect = rectToClientRect(Object.assign({}, popperRect, popperOffsets));
            var elementClientRect = elementContext === popper ? popperClientRect : referenceClientRect;
            var overflowOffsets = {
                top: clippingClientRect.top - elementClientRect.top + paddingObject.top,
                bottom: elementClientRect.bottom - clippingClientRect.bottom + paddingObject.bottom,
                left: clippingClientRect.left - elementClientRect.left + paddingObject.left,
                right: elementClientRect.right - clippingClientRect.right + paddingObject.right
            };
            var offsetData = state.modifiersData.offset;
            if (elementContext === popper && offsetData) {
                var offset = offsetData[placement];
                Object.keys(overflowOffsets).forEach(function (key) {
                    var multiply = [right, bottom].indexOf(key) >= 0 ? 1 : -1;
                    var axis = [enums_top, bottom].indexOf(key) >= 0 ? 'y' : 'x';
                    overflowOffsets[key] += offset[axis] * multiply;
                });
            }
            return overflowOffsets;
        };

        function computeAutoPlacement(state, options) {
            if (options === void 0) {
                options = {};
            }
            var _options = options,
                placement = _options.placement,
                boundary = _options.boundary,
                rootBoundary = _options.rootBoundary,
                padding = _options.padding,
                flipVariations = _options.flipVariations,
                _options$allowedAutoP = _options.allowedAutoPlacements,
                allowedAutoPlacements = _options$allowedAutoP === void 0 ? enums_placements : _options$allowedAutoP;
            var variation = getVariation(placement);
            var placements = variation ? flipVariations ? variationPlacements : variationPlacements.filter(function (placement) {
                return getVariation(placement) === variation;
            }) : basePlacements;
            var allowedPlacements = placements.filter(function (placement) {
                return allowedAutoPlacements.indexOf(placement) >= 0;
            });
            if (allowedPlacements.length === 0) {
                allowedPlacements = placements;
                if (false) {}
            }
            var overflows = allowedPlacements.reduce(function (acc, placement) {
                acc[placement] = detectOverflow(state, {
                    placement: placement,
                    boundary: boundary,
                    rootBoundary: rootBoundary,
                    padding: padding
                })[getBasePlacement(placement)];
                return acc;
            }, {});
            return Object.keys(overflows).sort(function (a, b) {
                return overflows[a] - overflows[b];
            });
        };

        function getExpandedFallbackPlacements(placement) {
            if (getBasePlacement(placement) === auto) {
                return [];
            }
            var oppositePlacement = getOppositePlacement(placement);
            return [getOppositeVariationPlacement(placement), oppositePlacement, getOppositeVariationPlacement(oppositePlacement)];
        }

        function flip(_ref) {
            var state = _ref.state,
                options = _ref.options,
                name = _ref.name;
            if (state.modifiersData[name]._skip) {
                return;
            }
            var _options$mainAxis = options.mainAxis,
                checkMainAxis = _options$mainAxis === void 0 ? true : _options$mainAxis,
                _options$altAxis = options.altAxis,
                checkAltAxis = _options$altAxis === void 0 ? true : _options$altAxis,
                specifiedFallbackPlacements = options.fallbackPlacements,
                padding = options.padding,
                boundary = options.boundary,
                rootBoundary = options.rootBoundary,
                altBoundary = options.altBoundary,
                _options$flipVariatio = options.flipVariations,
                flipVariations = _options$flipVariatio === void 0 ? true : _options$flipVariatio,
                allowedAutoPlacements = options.allowedAutoPlacements;
            var preferredPlacement = state.options.placement;
            var basePlacement = getBasePlacement(preferredPlacement);
            var isBasePlacement = basePlacement === preferredPlacement;
            var fallbackPlacements = specifiedFallbackPlacements || (isBasePlacement || !flipVariations ? [getOppositePlacement(preferredPlacement)] : getExpandedFallbackPlacements(preferredPlacement));
            var placements = [preferredPlacement].concat(fallbackPlacements).reduce(function (acc, placement) {
                return acc.concat(getBasePlacement(placement) === auto ? computeAutoPlacement(state, {
                    placement: placement,
                    boundary: boundary,
                    rootBoundary: rootBoundary,
                    padding: padding,
                    flipVariations: flipVariations,
                    allowedAutoPlacements: allowedAutoPlacements
                }) : placement);
            }, []);
            var referenceRect = state.rects.reference;
            var popperRect = state.rects.popper;
            var checksMap = new Map();
            var makeFallbackChecks = true;
            var firstFittingPlacement = placements[0];
            for (var i = 0; i < placements.length; i++) {
                var placement = placements[i];
                var _basePlacement = getBasePlacement(placement);
                var isStartVariation = getVariation(placement) === start;
                var isVertical = [enums_top, bottom].indexOf(_basePlacement) >= 0;
                var len = isVertical ? 'width' : 'height';
                var overflow = detectOverflow(state, {
                    placement: placement,
                    boundary: boundary,
                    rootBoundary: rootBoundary,
                    altBoundary: altBoundary,
                    padding: padding
                });
                var mainVariationSide = isVertical ? isStartVariation ? right : left : isStartVariation ? bottom : enums_top;
                if (referenceRect[len] > popperRect[len]) {
                    mainVariationSide = getOppositePlacement(mainVariationSide);
                }
                var altVariationSide = getOppositePlacement(mainVariationSide);
                var checks = [];
                if (checkMainAxis) {
                    checks.push(overflow[_basePlacement] <= 0);
                }
                if (checkAltAxis) {
                    checks.push(overflow[mainVariationSide] <= 0, overflow[altVariationSide] <= 0);
                }
                if (checks.every(function (check) {
                        return check;
                    })) {
                    firstFittingPlacement = placement;
                    makeFallbackChecks = false;
                    break;
                }
                checksMap.set(placement, checks);
            }
            if (makeFallbackChecks) {
                var numberOfChecks = flipVariations ? 3 : 1;
                var _loop = function _loop(_i) {
                    var fittingPlacement = placements.find(function (placement) {
                        var checks = checksMap.get(placement);
                        if (checks) {
                            return checks.slice(0, _i).every(function (check) {
                                return check;
                            });
                        }
                    });
                    if (fittingPlacement) {
                        firstFittingPlacement = fittingPlacement;
                        return "break";
                    }
                };
                for (var _i = numberOfChecks; _i > 0; _i--) {
                    var _ret = _loop(_i);
                    if (_ret === "break") break;
                }
            }
            if (state.placement !== firstFittingPlacement) {
                state.modifiersData[name]._skip = true;
                state.placement = firstFittingPlacement;
                state.reset = true;
            }
        }
        const modifiers_flip = ({
            name: 'flip',
            enabled: true,
            phase: 'main',
            fn: flip,
            requiresIfExists: ['offset'],
            data: {
                _skip: false
            }
        });;

        function getAltAxis(axis) {
            return axis === 'x' ? 'y' : 'x';
        };

        function within(min, value, max) {
            return math_max(min, math_min(value, max));
        }

        function withinMaxClamp(min, value, max) {
            var v = within(min, value, max);
            return v > max ? max : v;
        };

        function preventOverflow(_ref) {
            var state = _ref.state,
                options = _ref.options,
                name = _ref.name;
            var _options$mainAxis = options.mainAxis,
                checkMainAxis = _options$mainAxis === void 0 ? true : _options$mainAxis,
                _options$altAxis = options.altAxis,
                checkAltAxis = _options$altAxis === void 0 ? false : _options$altAxis,
                boundary = options.boundary,
                rootBoundary = options.rootBoundary,
                altBoundary = options.altBoundary,
                padding = options.padding,
                _options$tether = options.tether,
                tether = _options$tether === void 0 ? true : _options$tether,
                _options$tetherOffset = options.tetherOffset,
                tetherOffset = _options$tetherOffset === void 0 ? 0 : _options$tetherOffset;
            var overflow = detectOverflow(state, {
                boundary: boundary,
                rootBoundary: rootBoundary,
                padding: padding,
                altBoundary: altBoundary
            });
            var basePlacement = getBasePlacement(state.placement);
            var variation = getVariation(state.placement);
            var isBasePlacement = !variation;
            var mainAxis = getMainAxisFromPlacement(basePlacement);
            var altAxis = getAltAxis(mainAxis);
            var popperOffsets = state.modifiersData.popperOffsets;
            var referenceRect = state.rects.reference;
            var popperRect = state.rects.popper;
            var tetherOffsetValue = typeof tetherOffset === 'function' ? tetherOffset(Object.assign({}, state.rects, {
                placement: state.placement
            })) : tetherOffset;
            var normalizedTetherOffsetValue = typeof tetherOffsetValue === 'number' ? {
                mainAxis: tetherOffsetValue,
                altAxis: tetherOffsetValue
            } : Object.assign({
                mainAxis: 0,
                altAxis: 0
            }, tetherOffsetValue);
            var offsetModifierState = state.modifiersData.offset ? state.modifiersData.offset[state.placement] : null;
            var data = {
                x: 0,
                y: 0
            };
            if (!popperOffsets) {
                return;
            }
            if (checkMainAxis) {
                var _offsetModifierState$;
                var mainSide = mainAxis === 'y' ? enums_top : left;
                var altSide = mainAxis === 'y' ? bottom : right;
                var len = mainAxis === 'y' ? 'height' : 'width';
                var offset = popperOffsets[mainAxis];
                var min = offset + overflow[mainSide];
                var max = offset - overflow[altSide];
                var additive = tether ? -popperRect[len] / 2 : 0;
                var minLen = variation === start ? referenceRect[len] : popperRect[len];
                var maxLen = variation === start ? -popperRect[len] : -referenceRect[len];
                var arrowElement = state.elements.arrow;
                var arrowRect = tether && arrowElement ? getLayoutRect(arrowElement) : {
                    width: 0,
                    height: 0
                };
                var arrowPaddingObject = state.modifiersData['arrow#persistent'] ? state.modifiersData['arrow#persistent'].padding : getFreshSideObject();
                var arrowPaddingMin = arrowPaddingObject[mainSide];
                var arrowPaddingMax = arrowPaddingObject[altSide];
                var arrowLen = within(0, referenceRect[len], arrowRect[len]);
                var minOffset = isBasePlacement ? referenceRect[len] / 2 - additive - arrowLen - arrowPaddingMin - normalizedTetherOffsetValue.mainAxis : minLen - arrowLen - arrowPaddingMin - normalizedTetherOffsetValue.mainAxis;
                var maxOffset = isBasePlacement ? -referenceRect[len] / 2 + additive + arrowLen + arrowPaddingMax + normalizedTetherOffsetValue.mainAxis : maxLen + arrowLen + arrowPaddingMax + normalizedTetherOffsetValue.mainAxis;
                var arrowOffsetParent = state.elements.arrow && getOffsetParent(state.elements.arrow);
                var clientOffset = arrowOffsetParent ? mainAxis === 'y' ? arrowOffsetParent.clientTop || 0 : arrowOffsetParent.clientLeft || 0 : 0;
                var offsetModifierValue = (_offsetModifierState$ = offsetModifierState == null ? void 0 : offsetModifierState[mainAxis]) != null ? _offsetModifierState$ : 0;
                var tetherMin = offset + minOffset - offsetModifierValue - clientOffset;
                var tetherMax = offset + maxOffset - offsetModifierValue;
                var preventedOffset = within(tether ? math_min(min, tetherMin) : min, offset, tether ? math_max(max, tetherMax) : max);
                popperOffsets[mainAxis] = preventedOffset;
                data[mainAxis] = preventedOffset - offset;
            }
            if (checkAltAxis) {
                var _offsetModifierState$2;
                var _mainSide = mainAxis === 'x' ? enums_top : left;
                var _altSide = mainAxis === 'x' ? bottom : right;
                var _offset = popperOffsets[altAxis];
                var _len = altAxis === 'y' ? 'height' : 'width';
                var _min = _offset + overflow[_mainSide];
                var _max = _offset - overflow[_altSide];
                var isOriginSide = [enums_top, left].indexOf(basePlacement) !== -1;
                var _offsetModifierValue = (_offsetModifierState$2 = offsetModifierState == null ? void 0 : offsetModifierState[altAxis]) != null ? _offsetModifierState$2 : 0;
                var _tetherMin = isOriginSide ? _min : _offset - referenceRect[_len] - popperRect[_len] - _offsetModifierValue + normalizedTetherOffsetValue.altAxis;
                var _tetherMax = isOriginSide ? _offset + referenceRect[_len] + popperRect[_len] - _offsetModifierValue - normalizedTetherOffsetValue.altAxis : _max;
                var _preventedOffset = tether && isOriginSide ? withinMaxClamp(_tetherMin, _offset, _tetherMax) : within(tether ? _tetherMin : _min, _offset, tether ? _tetherMax : _max);
                popperOffsets[altAxis] = _preventedOffset;
                data[altAxis] = _preventedOffset - _offset;
            }
            state.modifiersData[name] = data;
        }
        const modifiers_preventOverflow = ({
            name: 'preventOverflow',
            enabled: true,
            phase: 'main',
            fn: preventOverflow,
            requiresIfExists: ['offset']
        });;
        var toPaddingObject = function toPaddingObject(padding, state) {
            padding = typeof padding === 'function' ? padding(Object.assign({}, state.rects, {
                placement: state.placement
            })) : padding;
            return mergePaddingObject(typeof padding !== 'number' ? padding : expandToHashMap(padding, basePlacements));
        };

        function arrow(_ref) {
            var _state$modifiersData$;
            var state = _ref.state,
                name = _ref.name,
                options = _ref.options;
            var arrowElement = state.elements.arrow;
            var popperOffsets = state.modifiersData.popperOffsets;
            var basePlacement = getBasePlacement(state.placement);
            var axis = getMainAxisFromPlacement(basePlacement);
            var isVertical = [left, right].indexOf(basePlacement) >= 0;
            var len = isVertical ? 'height' : 'width';
            if (!arrowElement || !popperOffsets) {
                return;
            }
            var paddingObject = toPaddingObject(options.padding, state);
            var arrowRect = getLayoutRect(arrowElement);
            var minProp = axis === 'y' ? enums_top : left;
            var maxProp = axis === 'y' ? bottom : right;
            var endDiff = state.rects.reference[len] + state.rects.reference[axis] - popperOffsets[axis] - state.rects.popper[len];
            var startDiff = popperOffsets[axis] - state.rects.reference[axis];
            var arrowOffsetParent = getOffsetParent(arrowElement);
            var clientSize = arrowOffsetParent ? axis === 'y' ? arrowOffsetParent.clientHeight || 0 : arrowOffsetParent.clientWidth || 0 : 0;
            var centerToReference = endDiff / 2 - startDiff / 2;
            var min = paddingObject[minProp];
            var max = clientSize - arrowRect[len] - paddingObject[maxProp];
            var center = clientSize / 2 - arrowRect[len] / 2 + centerToReference;
            var offset = within(min, center, max);
            var axisProp = axis;
            state.modifiersData[name] = (_state$modifiersData$ = {}, _state$modifiersData$[axisProp] = offset, _state$modifiersData$.centerOffset = offset - center, _state$modifiersData$);
        }

        function arrow_effect(_ref2) {
            var state = _ref2.state,
                options = _ref2.options;
            var _options$element = options.element,
                arrowElement = _options$element === void 0 ? '[data-popper-arrow]' : _options$element;
            if (arrowElement == null) {
                return;
            }
            if (typeof arrowElement === 'string') {
                arrowElement = state.elements.popper.querySelector(arrowElement);
                if (!arrowElement) {
                    return;
                }
            }
            if (false) {}
            if (!contains(state.elements.popper, arrowElement)) {
                if (false) {}
                return;
            }
            state.elements.arrow = arrowElement;
        }
        const modifiers_arrow = ({
            name: 'arrow',
            enabled: true,
            phase: 'main',
            fn: arrow,
            effect: arrow_effect,
            requires: ['popperOffsets'],
            requiresIfExists: ['preventOverflow']
        });;

        function getSideOffsets(overflow, rect, preventedOffsets) {
            if (preventedOffsets === void 0) {
                preventedOffsets = {
                    x: 0,
                    y: 0
                };
            }
            return {
                top: overflow.top - rect.height - preventedOffsets.y,
                right: overflow.right - rect.width + preventedOffsets.x,
                bottom: overflow.bottom - rect.height + preventedOffsets.y,
                left: overflow.left - rect.width - preventedOffsets.x
            };
        }

        function isAnySideFullyClipped(overflow) {
            return [enums_top, right, bottom, left].some(function (side) {
                return overflow[side] >= 0;
            });
        }

        function hide(_ref) {
            var state = _ref.state,
                name = _ref.name;
            var referenceRect = state.rects.reference;
            var popperRect = state.rects.popper;
            var preventedOffsets = state.modifiersData.preventOverflow;
            var referenceOverflow = detectOverflow(state, {
                elementContext: 'reference'
            });
            var popperAltOverflow = detectOverflow(state, {
                altBoundary: true
            });
            var referenceClippingOffsets = getSideOffsets(referenceOverflow, referenceRect);
            var popperEscapeOffsets = getSideOffsets(popperAltOverflow, popperRect, preventedOffsets);
            var isReferenceHidden = isAnySideFullyClipped(referenceClippingOffsets);
            var hasPopperEscaped = isAnySideFullyClipped(popperEscapeOffsets);
            state.modifiersData[name] = {
                referenceClippingOffsets: referenceClippingOffsets,
                popperEscapeOffsets: popperEscapeOffsets,
                isReferenceHidden: isReferenceHidden,
                hasPopperEscaped: hasPopperEscaped
            };
            state.attributes.popper = Object.assign({}, state.attributes.popper, {
                'data-popper-reference-hidden': isReferenceHidden,
                'data-popper-escaped': hasPopperEscaped
            });
        }
        const modifiers_hide = ({
            name: 'hide',
            enabled: true,
            phase: 'main',
            requiresIfExists: ['preventOverflow'],
            fn: hide
        });;
        var defaultModifiers = [eventListeners, modifiers_popperOffsets, modifiers_computeStyles, modifiers_applyStyles, modifiers_offset, modifiers_flip, modifiers_preventOverflow, modifiers_arrow, modifiers_hide];
        var popper_createPopper = popperGenerator({
            defaultModifiers: defaultModifiers
        });;
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('[data-dropdown-toggle]').forEach(function (dropdownToggleEl) {
                var dropdownMenuId = dropdownToggleEl.getAttribute('data-dropdown-toggle');
                var dropdownMenuEl = document.getElementById(dropdownMenuId);
                var placement = dropdownToggleEl.getAttribute('data-dropdown-placement');
                dropdownToggleEl.addEventListener('click', function (event) {
                    var element = event.target;
                    while (element.nodeName !== "BUTTON") {
                        element = element.parentNode;
                    }
                    popper_createPopper(element, dropdownMenuEl, {
                        placement: placement ? placement : 'bottom-start',
                        modifiers: [{
                            name: 'offset',
                            options: {
                                offset: [0, 10]
                            }
                        }]
                    });
                    dropdownMenuEl.classList.toggle('hidden');
                    dropdownMenuEl.classList.toggle('block');

                    function handleDropdownOutsideClick(event) {
                        var targetElement = event.target;
                        if (targetElement !== dropdownMenuEl && targetElement !== dropdownToggleEl && !dropdownToggleEl.contains(targetElement)) {
                            dropdownMenuEl.classList.add('hidden');
                            dropdownMenuEl.classList.remove('block');
                            document.body.removeEventListener('click', handleDropdownOutsideClick, true);
                        }
                    }
                    document.body.addEventListener('click', handleDropdownOutsideClick, true);
                });
            });
        });
        var tabs = __webpack_require__(97);
        var modal = __webpack_require__(84);;

        function _toConsumableArray(arr) {
            return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread();
        }

        function _nonIterableSpread() {
            throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
        }

        function _unsupportedIterableToArray(o, minLen) {
            if (!o) return;
            if (typeof o === "string") return _arrayLikeToArray(o, minLen);
            var n = Object.prototype.toString.call(o).slice(8, -1);
            if (n === "Object" && o.constructor) n = o.constructor.name;
            if (n === "Map" || n === "Set") return Array.from(o);
            if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen);
        }

        function _iterableToArray(iter) {
            if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter);
        }

        function _arrayWithoutHoles(arr) {
            if (Array.isArray(arr)) return _arrayLikeToArray(arr);
        }

        function _arrayLikeToArray(arr, len) {
            if (len == null || len > arr.length) len = arr.length;
            for (var i = 0, arr2 = new Array(len); i < len; i++) {
                arr2[i] = arr[i];
            }
            return arr2;
        }

        function ownKeys(object, enumerableOnly) {
            var keys = Object.keys(object);
            if (Object.getOwnPropertySymbols) {
                var symbols = Object.getOwnPropertySymbols(object);
                if (enumerableOnly) {
                    symbols = symbols.filter(function (sym) {
                        return Object.getOwnPropertyDescriptor(object, sym).enumerable;
                    });
                }
                keys.push.apply(keys, symbols);
            }
            return keys;
        }

        function _objectSpread(target) {
            for (var i = 1; i < arguments.length; i++) {
                var source = arguments[i] != null ? arguments[i] : {};
                if (i % 2) {
                    ownKeys(Object(source), true).forEach(function (key) {
                        _defineProperty(target, key, source[key]);
                    });
                } else if (Object.getOwnPropertyDescriptors) {
                    Object.defineProperties(target, Object.getOwnPropertyDescriptors(source));
                } else {
                    ownKeys(Object(source)).forEach(function (key) {
                        Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key));
                    });
                }
            }
            return target;
        }

        function _defineProperty(obj, key, value) {
            if (key in obj) {
                Object.defineProperty(obj, key, {
                    value: value,
                    enumerable: true,
                    configurable: true,
                    writable: true
                });
            } else {
                obj[key] = value;
            }
            return obj;
        }
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('[data-tooltip-target]').forEach(function (tooltipToggleEl) {
                var tooltipEl = document.getElementById(tooltipToggleEl.getAttribute('data-tooltip-target'));
                var placement = tooltipToggleEl.getAttribute('data-tooltip-placement');
                var trigger = tooltipToggleEl.getAttribute('data-tooltip-trigger');
                var popperInstance = popper_createPopper(tooltipToggleEl, tooltipEl, {
                    placement: placement ? placement : 'top',
                    modifiers: [{
                        name: 'offset',
                        options: {
                            offset: [0, 8]
                        }
                    }]
                });

                function show() {
                    tooltipEl.classList.remove('opacity-0');
                    tooltipEl.classList.add('opacity-100');
                    tooltipEl.classList.remove('invisible');
                    tooltipEl.classList.add('visible');
                    popperInstance.setOptions(function (options) {
                        return _objectSpread(_objectSpread({}, options), {}, {
                            modifiers: [].concat(_toConsumableArray(options.modifiers), [{
                                name: 'eventListeners',
                                enabled: true
                            }])
                        });
                    });
                    popperInstance.update();
                }

                function hide() {
                    tooltipEl.classList.remove('opacity-100');
                    tooltipEl.classList.add('opacity-0');
                    tooltipEl.classList.remove('visible');
                    tooltipEl.classList.add('invisible');
                    popperInstance.setOptions(function (options) {
                        return _objectSpread(_objectSpread({}, options), {}, {
                            modifiers: [].concat(_toConsumableArray(options.modifiers), [{
                                name: 'eventListeners',
                                enabled: false
                            }])
                        });
                    });
                }
                var showEvents = [];
                var hideEvents = [];
                switch (trigger) {
                    case 'hover':
                        showEvents = ['mouseenter', 'focus'];
                        hideEvents = ['mouseleave', 'blur'];
                        break;
                    case 'click':
                        showEvents = ['click', 'focus'];
                        hideEvents = ['focusout', 'blur'];
                        break;
                    default:
                        showEvents = ['mouseenter', 'focus'];
                        hideEvents = ['mouseleave', 'blur'];
                }
                showEvents.forEach(function (event) {
                    tooltipToggleEl.addEventListener(event, show);
                });
                hideEvents.forEach(function (event) {
                    tooltipToggleEl.addEventListener(event, hide);
                });
            });
        });;
    })();
})();