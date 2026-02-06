
			<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
			<script type="speculationrules">
			    {"prefetch":[{"source":"document","where":{"and":[{"href_matches":"/gosolar/*"},{"not":{"href_matches":["/gosolar/wp-*.php","/gosolar/wp-admin/*","/gosolar/wp-content/uploads/sites/3/*","/gosolar/wp-content/*","/gosolar/wp-content/plugins/*","/gosolar/wp-content/themes/gosolar/*","/gosolar/*\\?(.+)"]}},{"not":{"selector_matches":"a[rel~=\"nofollow\"]"}},{"not":{"selector_matches":".no-prefetch, .no-prefetch a"}}]},"eagerness":"conservative"}]}
</script>
			<script type="text/html" id="wpb-modifications">
			    window.wpbCustomElement = 1;
			</script>




			<script type="text/javascript" id="rocket-browser-checker-js-after">
			    /* <![CDATA[ */
			    "use strict";
			    var _createClass = function () {
			        function defineProperties(target, props) {
			            for (var i = 0; i < props.length; i++) {
			                var descriptor = props[i];
			                descriptor.enumerable = descriptor.enumerable || !1, descriptor.configurable = !0, "value" in
			                    descriptor && (descriptor.writable = !0), Object.defineProperty(target, descriptor.key,
			                        descriptor)
			            }
			        }
			        return function (Constructor, protoProps, staticProps) {
			            return protoProps && defineProperties(Constructor.prototype, protoProps), staticProps &&
			                defineProperties(Constructor, staticProps), Constructor
			        }
			    }();

			    function _classCallCheck(instance, Constructor) {
			        if (!(instance instanceof Constructor)) throw new TypeError("Cannot call a class as a function")
			    }
			    var RocketBrowserCompatibilityChecker = function () {
			        function RocketBrowserCompatibilityChecker(options) {
			            _classCallCheck(this, RocketBrowserCompatibilityChecker), this.passiveSupported = !1, this
			                ._checkPassiveOption(this), this.options = !!this.passiveSupported && options
			        }
			        return _createClass(RocketBrowserCompatibilityChecker, [{
			            key: "_checkPassiveOption",
			            value: function (self) {
			                try {
			                    var options = {
			                        get passive() {
			                            return !(self.passiveSupported = !0)
			                        }
			                    };
			                    window.addEventListener("test", null, options), window.removeEventListener(
			                        "test",
			                        null, options)
			                } catch (err) {
			                    self.passiveSupported = !1
			                }
			            }
			        }, {
			            key: "initRequestIdleCallback",
			            value: function () {
			                !1 in window && (window.requestIdleCallback = function (cb) {
			                    var start = Date.now();
			                    return setTimeout(function () {
			                        cb({
			                            didTimeout: !1,
			                            timeRemaining: function () {
			                                return Math.max(0, 50 - (Date.now() -
			                                    start))
			                            }
			                        })
			                    }, 1)
			                }), !1 in window && (window.cancelIdleCallback = function (id) {
			                    return clearTimeout(id)
			                })
			            }
			        }, {
			            key: "isDataSaverModeOn",
			            value: function () {
			                return "connection" in navigator && !0 === navigator.connection.saveData
			            }
			        }, {
			            key: "supportsLinkPrefetch",
			            value: function () {
			                var elem = document.createElement("link");
			                return elem.relList && elem.relList.supports && elem.relList.supports(
			                    "prefetch") &&
			                    window.IntersectionObserver && "isIntersecting" in IntersectionObserverEntry
			                    .prototype
			            }
			        }, {
			            key: "isSlowConnection",
			            value: function () {
			                return "connection" in navigator && "effectiveType" in navigator.connection && (
			                    "2g" === navigator.connection.effectiveType || "slow-2g" === navigator
			                    .connection.effectiveType)
			            }
			        }]), RocketBrowserCompatibilityChecker
			    }();
			    //# sourceURL=rocket-browser-checker-js-after
			    /* ]]> */
			</script>
			<script type="text/javascript" id="rocket-preload-links-js-extra">
			    /* <![CDATA[ */
			    var RocketPreloadLinksConfig = {
			        "excludeUris": "/(?:.+/)?feed(?:/(?:.+/?)?)?$|/(?:.+/)?embed/|/gosolar/checkout/??(.*)|/gosolar/cart/?|http://(/%5B/%5D+)?/(index.php/)?(.*)wp-json(/.*|$)|/refer/|/go/|/recommend/|/recommends/",
			        "usesTrailingSlash": "1",
			        "imageExt": "jpg|jpeg|gif|png|tiff|bmp|webp|avif|pdf|doc|docx|xls|xlsx|php",
			        "fileExt": "jpg|jpeg|gif|png|tiff|bmp|webp|avif|pdf|doc|docx|xls|xlsx|php|html|htm",
			        "siteUrl": "https://demo.zozothemes.com/gosolar",
			        "onHoverDelay": "100",
			        "rateThrottle": "3"
			    };
			    //# sourceURL=rocket-preload-links-js-extra
			    /* ]]> */
			</script>
			<script type="text/javascript" id="rocket-preload-links-js-after">
			    /* <![CDATA[ */
			    (function () {
			        "use strict";
			        var r = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (e) {
			                return typeof e
			            } : function (e) {
			                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ?
			                    "symbol" : typeof e
			            },
			            e = function () {
			                function i(e, t) {
			                    for (var n = 0; n < t.length; n++) {
			                        var i = t[n];
			                        i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !
			                            0),
			                            Object.defineProperty(e, i.key, i)
			                    }
			                }
			                return function (e, t, n) {
			                    return t && i(e.prototype, t), n && i(e, n), e
			                }
			            }();

			        function i(e, t) {
			            if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
			        }
			        var t = function () {
			            function n(e, t) {
			                i(this, n), this.browser = e, this.config = t, this.options = this.browser.options, this
			                    .prefetched = new Set, this.eventTime = null, this.threshold = 1111, this.numOnHover = 0
			            }
			            return e(n, [{
			                key: "init",
			                value: function () {
			                    !this.browser.supportsLinkPrefetch() || this.browser
			                    .isDataSaverModeOn() ||
			                        this.browser.isSlowConnection() || (this.regex = {
			                            excludeUris: RegExp(this.config.excludeUris, "i"),
			                            images: RegExp(".(" + this.config.imageExt + ")$", "i"),
			                            fileExt: RegExp(".(" + this.config.fileExt + ")$", "i")
			                        }, this._initListeners(this))
			                }
			            }, {
			                key: "_initListeners",
			                value: function (e) {
			                    -1 < this.config.onHoverDelay && document.addEventListener("mouseover", e
			                            .listener.bind(e), e.listenerOptions), document.addEventListener(
			                            "mousedown", e.listener.bind(e), e.listenerOptions), document
			                        .addEventListener("touchstart", e.listener.bind(e), e
			                            .listenerOptions)
			                }
			            }, {
			                key: "listener",
			                value: function (e) {
			                    var t = e.target.closest("a"),
			                        n = this._prepareUrl(t);
			                    if (null !== n) switch (e.type) {
			                        case "mousedown":
			                        case "touchstart":
			                            this._addPrefetchLink(n);
			                            break;
			                        case "mouseover":
			                            this._earlyPrefetch(t, n, "mouseout")
			                    }
			                }
			            }, {
			                key: "_earlyPrefetch",
			                value: function (t, e, n) {
			                    var i = this,
			                        r = setTimeout(function () {
			                            if (r = null, 0 === i.numOnHover) setTimeout(function () {
			                                return i.numOnHover = 0
			                            }, 1e3);
			                            else if (i.numOnHover > i.config.rateThrottle) return;
			                            i.numOnHover++, i._addPrefetchLink(e)
			                        }, this.config.onHoverDelay);
			                    t.addEventListener(n, function e() {
			                        t.removeEventListener(n, e, {
			                            passive: !0
			                        }), null !== r && (clearTimeout(r), r = null)
			                    }, {
			                        passive: !0
			                    })
			                }
			            }, {
			                key: "_addPrefetchLink",
			                value: function (i) {
			                    return this.prefetched.add(i.href), new Promise(function (e, t) {
			                        var n = document.createElement("link");
			                        n.rel = "prefetch", n.href = i.href, n.onload = e, n
			                            .onerror = t,
			                            document.head.appendChild(n)
			                    }).catch(function () {})
			                }
			            }, {
			                key: "_prepareUrl",
			                value: function (e) {
			                    if (null === e || "object" !== (void 0 === e ? "undefined" : r(e)) || !
			                        1 in
			                        e || -1 === ["http:", "https:"].indexOf(e.protocol)) return null;
			                    var t = e.href.substring(0, this.config.siteUrl.length),
			                        n = this._getPathname(e.href, t),
			                        i = {
			                            original: e.href,
			                            protocol: e.protocol,
			                            origin: t,
			                            pathname: n,
			                            href: t + n
			                        };
			                    return this._isLinkOk(i) ? i : null
			                }
			            }, {
			                key: "_getPathname",
			                value: function (e, t) {
			                    var n = t ? e.substring(this.config.siteUrl.length) : e;
			                    return n.startsWith("../../index.html") || (n = "/" + n), this
			                        ._shouldAddTrailingSlash(n) ? n + "/" : n
			                }
			            }, {
			                key: "_shouldAddTrailingSlash",
			                value: function (e) {
			                    return this.config.usesTrailingSlash && !e.endsWith(
			                        "../../index.html") && !
			                        this.regex.fileExt.test(e)
			                }
			            }, {
			                key: "_isLinkOk",
			                value: function (e) {
			                    return null !== e && "object" === (void 0 === e ? "undefined" : r(e)) &&
			                        (!
			                            this.prefetched.has(e.href) && e.origin === this.config
			                            .siteUrl && -
			                            1 === e.href.indexOf("?") && -1 === e.href.indexOf("#") && !this
			                            .regex
			                            .excludeUris.test(e.href) && !this.regex.images.test(e.href))
			                }
			            }], [{
			                key: "run",
			                value: function () {
			                    "undefined" != typeof RocketPreloadLinksConfig && new n(
			                        new RocketBrowserCompatibilityChecker({
			                            capture: !0,
			                            passive: !0
			                        }), RocketPreloadLinksConfig).init()
			                }
			            }]), n
			        }();
			        t.run();
			    }());

			    //# sourceURL=rocket-preload-links-js-after
			    /* ]]> */
			</script>





			</body>

			</html>