import { FetchWrap } from './utils.js';

export const useCurrenciesService = () => {
    async function getCurrencies() {
        const endpoint = `/api/currencies`;
        const response = await FetchWrap(
            fetch(endpoint, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
        );
        return response;
    }
    return {
        getCurrencies,
    };
};

export const useExchangeService = () => {
    async function exchangePair(payload) {
        const params = getQueryParams(payload);
        const endpoint = `/api/exchange/pair?${params}`;
        const response = await FetchWrap(
            fetch(endpoint, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
        );
        return response;
    }
    async function exchangeRate(payload) {
        const params = getQueryParams(payload);
        const endpoint = `/api/exchange/rate?${params}`;
        const response = await FetchWrap(
            fetch(endpoint, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
        );
        return response;
    }
    return {
        exchangePair,
        exchangeRate,
    };
};

export const useAddressService = () => {
    async function addressValidate(payload) {
        const requestBody = JSON.stringify(payload);

        const endpoint = `/api/address/validate`;
        const response = await FetchWrap(
            fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: requestBody,
            })
        );
        return response;
    }

    return {
        addressValidate
    };
}

export const useOrderService = () => {
    async function placeOrder(payload) {
        const requestBody = JSON.stringify(payload);

        const endpoint = `/api/order`;
        const response = await FetchWrap(
            fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: requestBody,
            })
        );
        return response;
    }
    async function getOrderData(id) {
        const endpoint = `/api/order/${encodeURIComponent(id)}`;
        const response = await FetchWrap(
            fetch(endpoint, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
        );
        return response;
    }
    return {
        placeOrder,
        getOrderData
    };
}


function getQueryParams(payload) {
    return new URLSearchParams(payload).toString();
}
