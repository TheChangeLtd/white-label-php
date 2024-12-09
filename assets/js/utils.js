import { render } from './components.js';

export const debounce = (func, wait, immediate) => {
    let timeout;
    return function () {
        let context = this;
        let args = arguments;
        const callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(function () {
            timeout = undefined;
            if (!immediate) {
                func.apply(context, args);
            }
        }, wait);
        if (callNow) func.apply(context, args);
    };
};

/**
 * @param {string} message 
 */

export function errorToast(message) {
    Toastify({
        text: message,
        duration: 3000,
        close: true,
        gravity: "top",
        position: "center",
        stopOnFocus: true,
        className: "error",
        escapeMarkup: false,
        offset: {
            x: 0,
            y: 64
        }
    }).showToast();
}
export function successToast(message) {
    Toastify({
        text: message,
        duration: 1500,
        close: true,
        gravity: "top",
        position: "center",
        stopOnFocus: true,
        className: "success",
        escapeMarkup: true,
        offset: {
            x: 0,
            y: 64
        }
    }).showToast();
}
export function infoToast(message) {
    Toastify({
        text: message,
        duration: 1500,
        close: true,
        gravity: "top",
        position: "center",
        stopOnFocus: true,
        className: "info",
        escapeMarkup: true,
        offset: {
            x: 0,
            y: 64
        }
    }).showToast();
}
export function showLoader($elements) {

    const elements = Array.isArray($elements) ? $elements : [$elements];

    elements.forEach(($element) => {
        $element.empty();
        if ($element.find('.loader').length === 0) {
            const loaderHtml = '<div class="loader"></div>';
            $element.append(loaderHtml);
        }
    });
}

export async function FetchWrap(promise) {
    let data = null;
    let error = null;

    try {
        const response = await promise;

        if (response.ok) {
            data = await response.json();
            data = data.content;
        } else {
            error = await response.json();
        }
    } catch (err) {
        error = {
            message: err.message || 'Unexpected error occurred',
        };
    }

    return { data, error };
}

export function showErrors(errorElements, messages = {}) {
    const errorElementsArray = Array.isArray(errorElements) ? errorElements : [errorElements];

    errorElementsArray.forEach((element) => {
        element.addClass('error');
    });

    Object.entries(messages).forEach(([selector, messageData]) => {
        const { message, container } = messageData;

        const el = $(selector);
        if (el.length === 0) {
            console.error(`Элемент по селектору "${selector}" не найден`);
            return;
        }

        const targetContainer = container || el;

        if (message) {
            if (targetContainer.length > 0) {
                render(() => document.createTextNode(message), targetContainer[0], true);
            } else {
                console.error(`Контейнер для сообщения не найден: ${container}`);
            }
        }
    });
}

export function clearErrors(elements) {
    const elementArray = Array.isArray(elements) ? elements : [elements];

    elementArray.forEach((element) => {
        element.removeClass('error');
    });
}

export function handleExchangeError(error) {
    if (!error) return;

    const httpCode = error.content?.httpCode;
    switch (httpCode) {
        case 400:
            showErrors(
                [
                    $('#form-limit-min'),
                    $('#form-limit-max'),
                    $('#receive-amount')
                ],
                {
                    '#receive-amount': {
                        message: error.message
                    }
                }
            );
            break;

        default:
            errorToast(`${error.message || 'Internal error'}`);
    }
}

export function handleAddressError(error) {
    if (!error) return;

    const httpCode = error.content?.statusCode;
    switch (httpCode) {
        case 400:
            showErrors(
                [
                    $('#receive-address')
                ]
            );
            break;

        default:
            errorToast(`${error.message || 'Internal error'}`);
    }
}
