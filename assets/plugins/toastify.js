const icons = {
    error: `<svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.85839 3.04943C9.5719 1.75958 11.4262 1.75956 12.1398 3.04939L18.5946 14.7173C19.2859 15.967 18.382 17.4999 16.9539 17.4999H4.04468C2.61653 17.4999 1.71268 15.967 2.40398 14.7173L8.85839 3.04943ZM11.3314 14.1677C11.3314 13.7081 10.9588 13.3355 10.4992 13.3355C10.0396 13.3355 9.66699 13.7081 9.66699 14.1677C9.66699 14.6274 10.0396 15 10.4992 15C10.9588 15 11.3314 14.6274 11.3314 14.1677ZM11.1154 7.62336C11.0738 7.31833 10.8121 7.08341 10.4957 7.08366C10.1505 7.08394 9.87093 7.36398 9.87121 7.70916L9.87421 11.4605L9.87998 11.5453C9.92161 11.8503 10.1833 12.0852 10.4997 12.085C10.8449 12.0847 11.1245 11.8047 11.1242 11.4595L11.1212 7.70816L11.1154 7.62336Z" fill="var(--content-error-color)" />
            </svg>
    `,
    success: `
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
             xmlns="http://www.w3.org/2000/svg" style="margin-right: 8px;">
            <path d="M12 0C5.37195 0 0 5.37195 0 12C0 18.628 
                     5.37195 24 12 24C18.628 24 24 18.628 
                     24 12C24 5.37195 18.628 0 12 0ZM10.5858 
                     16.2426L5.75736 11.4142C5.36684 11.0237 
                     5.36684 10.3906 5.75736 10C6.14788 
                     9.60948 6.78105 9.60948 7.17157 
                     10L10.5858 13.4142L16.8284 7.17157C17.2189 
                     6.78105 17.8521 6.78105 18.2426 
                     7.17157C18.6331 7.56209 18.6331 8.19526 
                     18.2426 8.58578L11.4142 15.4142C11.0237 
                     15.8047 10.3906 15.8047 10 15.4142L6.17157 
                     11.5858C5.78105 11.1953 5.78105 10.5621 
                     6.17157 10.1716C6.56209 9.78105 7.19526 
                     9.78105 7.58578 10.1716L10.5858 
                     13.1716L16.2426 7.51472C16.6331 7.1242 
                     17.2663 7.1242 17.6568 7.51472C18.0474 
                     7.90524 18.0474 8.53841 17.6568 
                     8.92893L11.4142 15.1716C11.0237 
                     15.5621 10.3906 15.5621 10 
                     15.1716L10.5858 16.2426Z" fill="#FFFFFF"/>
        </svg>
    `,
    info: `
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
             xmlns="http://www.w3.org/2000/svg" style="margin-right: 8px;">
            <path d="M12 0C5.37258 0 0 5.37258 
                     0 12C0 18.6274 5.37258 24 
                     12 24C18.6274 24 24 18.6274 
                     24 12C24 5.37258 18.6274 0 12 0ZM13 
                     18H11V10H13V18ZM13 
                     8H11V6H13V8Z" fill="#FFFFFF"/>
        </svg>
    `
};
!(function (t, o) {
    "object" == typeof module && module.exports
        ? (module.exports = o())
        : (t.Toastify = o());
})(this, function (t) {
    let o = function (t) {
        return new o.lib.init(t);
    };
    function i(t, o) {
        return o.offset[t]
            ? isNaN(o.offset[t])
                ? o.offset[t]
                : o.offset[t] + "px"
            : "0px";
    }
    function s(t, o) {
        return (
            !(!t || "string" != typeof o) &&
            !!(t.className && t.className.trim().split(/\s+/gi).indexOf(o) > -1)
        );
    }
    return (
        (o.defaults = {
            oldestFirst: !0,
            text: "Toastify is awesome!",
            node: void 0,
            duration: 3e3,
            selector: void 0,
            callback: function () { },
            destination: void 0,
            newWindow: !1,
            close: !1,
            gravity: "toastify-top",
            positionLeft: !1,
            position: "",
            backgroundColor: "",
            avatar: "",
            className: "",
            stopOnFocus: !0,
            onClick: function () { },
            offset: { x: 0, y: 0 },
            escapeMarkup: !0,
            ariaLive: "polite",
            style: { background: "" },
        }),
        (o.lib = o.prototype =
        {
            toastify: "1.12.0",
            constructor: o,
            init: function (t) {
                return (
                    t || (t = {}),
                    (this.options = {}),
                    (this.toastElement = null),
                    (this.options.text = t.text || o.defaults.text),
                    (this.options.node = t.node || o.defaults.node),
                    (this.options.duration =
                        0 === t.duration ? 0 : t.duration || o.defaults.duration),
                    (this.options.selector = t.selector || o.defaults.selector),
                    (this.options.callback = t.callback || o.defaults.callback),
                    (this.options.destination =
                        t.destination || o.defaults.destination),
                    (this.options.newWindow = t.newWindow || o.defaults.newWindow),
                    (this.options.close = t.close || o.defaults.close),
                    (this.options.gravity =
                        "bottom" === t.gravity ? "toastify-bottom" : o.defaults.gravity),
                    (this.options.positionLeft =
                        t.positionLeft || o.defaults.positionLeft),
                    (this.options.position = t.position || o.defaults.position),
                    (this.options.backgroundColor =
                        t.backgroundColor || o.defaults.backgroundColor),
                    (this.options.avatar = t.avatar || o.defaults.avatar),
                    (this.options.className = t.className || o.defaults.className),
                    (this.options.stopOnFocus =
                        void 0 === t.stopOnFocus
                            ? o.defaults.stopOnFocus
                            : t.stopOnFocus),
                    (this.options.onClick = t.onClick || o.defaults.onClick),
                    (this.options.offset = t.offset || o.defaults.offset),
                    (this.options.escapeMarkup =
                        void 0 !== t.escapeMarkup
                            ? t.escapeMarkup
                            : o.defaults.escapeMarkup),
                    (this.options.ariaLive = t.ariaLive || o.defaults.ariaLive),
                    (this.options.style = t.style || o.defaults.style),
                    t.backgroundColor &&
                    (this.options.style.background = t.backgroundColor),
                    this
                );
            },
            buildToast: function () {
                if (!this.options) throw "Toastify is not initialized";
                let t = document.createElement("div");

                // Установка классов
                for (let o in (
                    (t.className =
                        "toastify on " + this.options.className),
                    this.options.position
                        ? (t.className += " toastify-" + this.options.position)
                        : !0 === this.options.positionLeft
                            ? ((t.className += " toastify-left"),
                                console.warn("Property `positionLeft` will be depreciated in further versions. Please use `position` instead."))
                            : (t.className += " toastify-right"),
                    (t.className += " " + this.options.gravity),
                    this.options.backgroundColor &&
                    console.warn('DEPRECATION NOTICE: "backgroundColor" is being deprecated. Please use the "style.background" property.'),
                    this.options.style
                )) {
                    t.style[o] = this.options.style[o];
                }

                // Установка aria-live
                if (this.options.ariaLive) {
                    t.setAttribute("aria-live", this.options.ariaLive);
                }

                if (this.options.node && this.options.node.nodeType === Node.ELEMENT_NODE) {
                    t.appendChild(this.options.node);
                } else {
                    let type = this.options.className || 'info';
                    let iconSVG = icons[type] || icons['info'];

                    let container = document.createElement("div");
                    container.className = "toast-content";
                    container.style.display = "flex";
                    container.style.alignItems = "center";

                    container.innerHTML = `${iconSVG}<span>${this.options.text}</span>`;

                    t.innerHTML = "";
                    t.appendChild(container);
                }

                if ("" !== this.options.avatar) {
                    let s = document.createElement("img");
                    s.src = this.options.avatar;
                    s.className = "toastify-avatar";
                    "left" == this.options.position ||
                        !0 === this.options.positionLeft
                        ? t.appendChild(s)
                        : t.insertAdjacentElement("afterbegin", s);
                }

                if (this.options.close === true) {
                    let e = document.createElement("button");
                    e.type = "button";
                    e.setAttribute("aria-label", "Close");
                    e.className = "toast-close";
                    e.innerHTML = `<svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" 
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.99486 7.00636C6.60433 7.39689 
                                        6.60433 8.03005 6.99486 8.42058L10.58 
                                        12.0057L6.99486 15.5909C6.60433 
                                        15.9814 6.60433 16.6146 6.99486 
                                        17.0051C7.38538 17.3956 8.01855 
                                        17.3956 8.40907 17.0051L11.9942 
                                        13.4199L15.5794 17.0051C15.9699 
                                        17.3956 16.6031 17.3956 16.9936 
                                        17.0051C17.3841 16.6146 17.3841 
                                        15.9814 16.9936 15.5909L13.4084 
                                        12.0057L16.9936 8.42059C17.3841 
                                        8.03007 17.3841 7.3969 16.9936 
                                        7.00638C16.603 6.61585 15.9699 
                                        6.61585 15.5794 7.00638L11.9942 
                                        10.5915L8.40907 7.00636C8.01855 
                                        6.61584 7.38538 6.61584 6.99486 
                                        7.00636Z" fill="currentColor"/>
                                      </svg>`;
                    e.addEventListener(
                        "click",
                        function (t) {
                            t.stopPropagation(),
                                this.removeElement(this.toastElement),
                                window.clearTimeout(this.toastElement.timeOutValue);
                        }.bind(this)
                    );
                    let n = window.innerWidth > 0 ? window.innerWidth : screen.width;
                    ("left" == this.options.position ||
                        !0 === this.options.positionLeft) &&
                        n > 360
                        ? t.insertAdjacentElement("afterbegin", e)
                        : t.appendChild(e);
                }

                // Обработка остановки таймера при наведении
                if (this.options.stopOnFocus && this.options.duration > 0) {
                    let a = this;
                    t.addEventListener("mouseover", function (o) {
                        window.clearTimeout(t.timeOutValue);
                    }),
                        t.addEventListener("mouseleave", function () {
                            t.timeOutValue = window.setTimeout(function () {
                                a.removeElement(t);
                            }, a.options.duration);
                        });
                }

                if (void 0 !== this.options.destination) {
                    t.addEventListener(
                        "click",
                        function (t) {
                            t.stopPropagation(),
                                !0 === this.options.newWindow
                                    ? window.open(this.options.destination, "_blank")
                                    : (window.location = this.options.destination);
                        }.bind(this)
                    );
                } else if ("function" == typeof this.options.onClick) {
                    t.addEventListener(
                        "click",
                        function (t) {
                            t.stopPropagation(), this.options.onClick();
                        }.bind(this)
                    );
                }

                // Обработка смещения
                if ("object" == typeof this.options.offset) {
                    let l = i("x", this.options),
                        r = i("y", this.options),
                        p = "left" == this.options.position ? l : "-" + l,
                        d = "toastify-top" == this.options.gravity ? r : "-" + r;
                    t.style.transform = "translate(" + p + "," + d + ")";
                }

                return t;
            },

            showToast: function () {
                let t;
                if (
                    ((this.toastElement = this.buildToast()),
                        !(t =
                            "string" == typeof this.options.selector
                                ? document.getElementById(this.options.selector)
                                : this.options.selector instanceof HTMLElement ||
                                    ("undefined" != typeof ShadowRoot &&
                                        this.options.selector instanceof ShadowRoot)
                                    ? this.options.selector
                                    : document.body))
                )
                    throw "Root element is not defined";
                let i = o.defaults.oldestFirst ? t.firstChild : t.lastChild;
                return (
                    t.insertBefore(this.toastElement, i),
                    o.reposition(),
                    this.options.duration > 0 &&
                    (this.toastElement.timeOutValue = window.setTimeout(
                        function () {
                            this.removeElement(this.toastElement);
                        }.bind(this),
                        this.options.duration
                    )),
                    this
                );
            },
            hideToast: function () {
                this.toastElement.timeOutValue &&
                    clearTimeout(this.toastElement.timeOutValue),
                    this.removeElement(this.toastElement);
            },
            removeElement: function (t) {
                (t.className = t.className.replace(" on", "")),
                    window.setTimeout(
                        function () {
                            this.options.node &&
                                this.options.node.parentNode &&
                                this.options.node.parentNode.removeChild(this.options.node),
                                t.parentNode && t.parentNode.removeChild(t),
                                this.options.callback.call(t),
                                o.reposition();
                        }.bind(this),
                        400
                    );
            },
        }),
        (o.reposition = function () {
            for (
                let t,
                o = { top: 15, bottom: 15 },
                i = { top: 15, bottom: 15 },
                e = { top: 15, bottom: 15 },
                n = document.getElementsByClassName("toastify"),
                a = 0;
                a < n.length;
                a++
            ) {
                t = !0 === s(n[a], "toastify-top") ? "toastify-top" : "toastify-bottom";
                let l = n[a].offsetHeight;
                t = t.substr(9, t.length - 1);
                (window.innerWidth > 0 ? window.innerWidth : screen.width) <= 360
                    ? ((n[a].style[t] = e[t] + "px"), (e[t] += l + 15))
                    : !0 === s(n[a], "toastify-left")
                        ? ((n[a].style[t] = o[t] + "px"), (o[t] += l + 15))
                        : ((n[a].style[t] = i[t] + "px"), (i[t] += l + 15));
            }
            return this;
        }),
        (o.lib.init.prototype = o.lib),
        o
    );
});
