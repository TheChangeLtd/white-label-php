import { debounce } from './utils.js';
import { watch, ref } from './reactive-system.js';

function NetworkButton({ currency, network, networkName, emit }) {
    return createElement('button', {
        class: 'exchange__form-network-option',
        onClick: (event) => {
            event.stopPropagation();
            if (emit) {
                emit({ currency, network, networkName });
            }
        }
    }, [
        createElement('img', {
            src: `/assets/images/coins/${currency}.svg`,
            class: 'exchange__form-network-icon',
            onError: function () {
                this.onerror = null;
                this.src = '/assets/icon.svg';
            }
        }),
        createElement('div', { class: 'exchange__form-network-text' }, [`${currency} - `]),
        createElement('div', { class: 'exchange__form-network-text' }, [networkName]),
    ]);
}

function CurrencyItem({ currency, network, networkName}) {
    return createElement('div', {
        class: 'exchange__form-current-item'
    }, [
        createElement('img', {
            src: `/assets/images/coins/${currency}.svg`,
            class: 'exchange__form-token-icon',
            onError: function () {
                this.onerror = null;
                this.src = '/assets/icon.svg';
            }
        }),
        createElement('div', { class: 'exchange__form-network-text' }, [`${currency} - `]),
        createElement('div', { class: 'exchange__form-network-text' }, [networkName])
    ]);
}
function CurrencyButton({ currency, emit }) {
    const customTrigger = (toggleContent) => {
        return createElement('button', {
            class: 'exchange__form-token-option',
            onClick: toggleContent
        }, [
            createElement('img', {
                src: `/assets/images/coins/${currency.currency}.svg`,
                class: 'exchange__form-token-icon',
                onError: function () {
                    this.onerror = null;
                    this.src = '/assets/icon.svg';
                }
            }),
            createElement('div', { class: 'exchange__form-token-text' }, [`${currency.currency}`]),
        ]);
    };

    const networks = currency.networkList;
    const networkButtons = [];

    for (const network of networks) {
        const button = NetworkButton({
            currency: currency.currency,
            network: network.network,
            networkName: network.name,
            emit: (data) => {
                if (emit) {
                    emit(data);
                }
            }
        });
        networkButtons.push(button);
    }

    return Collapsible({
        trigger: customTrigger,
        content: networkButtons
    });
}

function SearchIcon() {
    return createElement('svg', {
        class: 'exchange__form-dialog-search-icon',
        viewBox: '0 0 17 17',
        fill: 'none',
        xmlns: 'http://www.w3.org/2000/svg'
    }, [
        createElement('path', {
            'fill-rule': 'evenodd',
            'clip-rule': 'evenodd',
            d: 'M2.875 7.79167C2.875 5.07626 5.07626 2.875 7.79167 2.875C10.5071 2.875 12.7083 5.07626 12.7083 7.79167C12.7083 10.5071 10.5071 12.7083 7.79167 12.7083C5.07626 12.7083 2.875 10.5071 2.875 7.79167ZM7.79167 1.375C4.24784 1.375 1.375 4.24784 1.375 7.79167C1.375 11.3355 4.24784 14.2083 7.79167 14.2083C9.29334 14.2083 10.6745 13.6925 11.7677 12.8284L14.345 15.4057C14.6379 15.6985 15.1128 15.6985 15.4057 15.4057C15.6985 15.1128 15.6985 14.6379 15.4057 14.345L12.8284 11.7677C13.6925 10.6745 14.2083 9.29334 14.2083 7.79167C14.2083 4.24784 11.3355 1.375 7.79167 1.375Z',
            fill: 'currentColor'
        })
    ]);
} 
function CloseIcon() {
    return createElement('svg', {
        class: 'exchange__form-dialog-close-icon',
        viewBox: '0 0 11 11',
        fill: 'none',
        xmlns: 'http://www.w3.org/2000/svg'
    }, [
        createElement('path', {
            d: 'M0.847904 9.9278C1.26392 10.338 1.98462 10.3204 2.36548 9.93952L5.50025 6.80475L8.62329 9.93366C9.02759 10.338 9.72486 10.338 10.135 9.92194C10.551 9.50592 10.5569 8.80866 10.1526 8.40436L7.02954 5.27545L10.1526 2.15241C10.5569 1.74811 10.551 1.05084 10.135 0.640688C9.719 0.224672 9.02759 0.218813 8.62329 0.62311L5.50025 3.74616L2.36548 0.61725C1.98462 0.236391 1.26392 0.218813 0.847904 0.634828C0.437748 1.05084 0.449467 1.76569 0.836186 2.14655L3.97095 5.27545L0.836186 8.41022C0.449467 8.79108 0.431889 9.51178 0.847904 9.9278Z',
            fill: 'currentColor'
        })
    ]);
}
function SearchBar({ onSearch, togglePopup }) {
    return createElement('div', { class: 'exchange__form-dialog-search-container' }, [
        SearchIcon(),
        createElement('input', {
            class: 'exchange__form-dialog-search-input',
            type: 'text',
            placeholder: 'Token',
            onInput: onSearch,
        }),
        createElement('button', {
            class: 'popup__close-button',
            onClick: togglePopup,
        }, [
            CloseIcon()
        ])
    ])
}

function Collapsible({ trigger, content }) {

    const toggleContent = (event) => {
        const $contentEl = $(event.target).next();
        $contentEl.stop().slideToggle(300);
    };

    const deafaultTrigger = createElement("button", { onClick: toggleContent });

    return createElement("div", { class: "collapsible" }, [
        trigger ? trigger(toggleContent) : deafaultTrigger,
        createElement("div", { class: "content", style: "display: none;" }, [
            ...content,
        ]),
    ]);
}

function Popup({ trigger, open, content }) {
    const popupRef = createElement("div", { class: "exchange__form-dialog" }, content);

    watch(
        () => open.value,
        (newValue) => {
            const $popupEl = $(popupRef);
            if (newValue) {
                $popupEl.stop().slideDown(300);
            } else {
                $popupEl.stop().slideUp(300);
            }
        }
    );
    const handleClickOutside = (event) => {
        const $popupRef = $(popupRef);
        const $triggerEl = $(trigger);
        if (
            !$popupRef.is(event.target) &&
            $popupRef.has(event.target).length === 0 &&
            !$triggerEl.is(event.target) &&
            $triggerEl.has(event.target).length === 0
        ) {
            if (open.value) {
                open.value = !open.value;
            }
        }
    };
    document.addEventListener('click', handleClickOutside);
    return popupRef;
}

function CurrenciesPopup({ model, trigger, currencies }) {

    const isOpen = ref(false);

    const togglePopup = () => {
        isOpen.value = !isOpen.value;
    }

    trigger.addEventListener('click', () => {
        togglePopup();
    })

    const onSelect = (data) => {
        model.value = data;
        togglePopup();
    };

    const searchValue = ref("");
    const itemsPerBatch = 20;
    let renderedItems = 0;

    const onSearch = debounce((event) => {
        searchValue.value = event.target.value;
    }, 300);

    const getCurrencyButtons = (currencyList) => {
        const currencyButtons = [];
        for (const currency of currencyList) {
            const button = CurrencyButton({
                currency,
                emit: onSelect
            });
            currencyButtons.push(button);
        }
        return currencyButtons;
    }

    const initialButtons = getCurrencyButtons(currencies.slice(0, itemsPerBatch));
    renderedItems += itemsPerBatch;

    const onScroll = (event) => {
        const SEARCH_HEIGHT = 60;
        const buttonsContainer = event.target;
        const isAtBottom = buttonsContainer.scrollTop + buttonsContainer.clientHeight + SEARCH_HEIGHT >= buttonsContainer.scrollHeight;
        if (isAtBottom) {
            if (searchValue.value.trim() !== "") {
                return;
            }

            const nextCurrencies = currencies.slice(renderedItems, renderedItems + itemsPerBatch);
            const buttons = getCurrencyButtons(nextCurrencies);

            buttons.forEach(button => render(() => button, buttonsContainer));
            renderedItems += itemsPerBatch;
        }
    }

    const buttonsContainer = createElement('div', {
        class: 'exchange__currencies-container',
        onScroll
    }, [
        ...initialButtons
    ])

    watch(
        () => searchValue.value,
        (newValue) => {

            if (!newValue || newValue == null) {
                buttonsContainer.innerHTML = "";
                console.log('rerender');
                renderedItems = 0;

                const NextInitialSearchButtons = currencies.slice(0, renderedItems + itemsPerBatch);
                const InitialSearchButtons = getCurrencyButtons(NextInitialSearchButtons);

                InitialSearchButtons.forEach(InitialSearchButton => render(() => InitialSearchButton, buttonsContainer));
                renderedItems += itemsPerBatch;
                return;
            }

            const filteredCurrencies = currencies.filter((currency) =>
                currency.currency.toLowerCase().includes(newValue.toLowerCase())
            );

            if (filteredCurrencies.length === 0) {
                console.log(`Совпадений не найдено для "${newValue}"`);
                return;
            } else {
                console.log(`Найдено ${filteredCurrencies.length} совпадений`);
            }

            if (buttonsContainer) {
                buttonsContainer.innerHTML = "";
                renderedItems = 0;

                const initialButtons = getCurrencyButtons(
                    filteredCurrencies.slice(0, itemsPerBatch)
                );
                renderedItems += initialButtons.length;

                initialButtons.forEach(button => render(() => button, buttonsContainer));
            }
        },
        { immediate: false }
    );
    return Popup({
        trigger: trigger,
        open: isOpen,
        content: [
            SearchBar({ onSearch, togglePopup }),
            buttonsContainer
        ]
    });
}


function createElement(tag, props = {}, children = []) {
    const svgTags = ["svg", "path", "circle", "rect", "line", "polygon", "polyline", "ellipse", "g", "text"];

    const isSVG = svgTags.includes(tag);
    const element = isSVG
        ? document.createElementNS('http://www.w3.org/2000/svg', tag)
        : document.createElement(tag);

    for (const [key, value] of Object.entries(props)) {
        if (key.startsWith("on") && typeof value === "function") {
            const event = key.slice(2).toLowerCase();
            element.addEventListener(event, value);
        } else if (isSVG || !(key in element)) {
            element.setAttribute(key, value);
        } else {
            element[key] = value;
        }
    }
    children.forEach((child) => {
        if (typeof child === "string" || typeof child === "number") {
            element.appendChild(document.createTextNode(child));
        } else if (child instanceof Node) {
            element.appendChild(child);
        }
    });

    return element;
}

function render(template, container, replace = false) {
    const elements = template();

    if (replace) {
        container.innerHTML = ''; 
    }

    if (Array.isArray(elements)) {
        elements.forEach((el) => container.appendChild(el));
    } else {
        container.appendChild(elements); 
    }
}

export {
    CurrencyItem,
    CurrenciesPopup,
    render
}