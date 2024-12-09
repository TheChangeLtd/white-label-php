import { watch, ref } from './reactive-system.js';
import { useCurrenciesService, useExchangeService, useAddressService, useOrderService } from './services.js';
import { errorToast, debounce, showLoader, showErrors, clearErrors, handleExchangeError, handleAddressError } from './utils.js';
import { CurrencyItem, CurrenciesPopup, render } from './components.js';

const currenciesService = useCurrenciesService();
const exchangeService = useExchangeService();
const addressService = useAddressService();
const orderService = useOrderService();

const { data: currenciesData, error: currenciesDataError } = await currenciesService.getCurrencies();

if (!currenciesData || currenciesDataError) {
    errorToast(`${error.message || 'Unable to load currencies'}`);
}

const fromCurrency = ref({ currency: '', network: '' });
const toCurrency = ref({ currency: '', network: '' });
const amount = ref();
const minAmount = ref();
const maxAmount = ref();
const address = ref("");

const userAgreement = ref(false);
const isAmount = ref(false);
const isAddress = ref(false);

watch(
    [() => fromCurrency.value, () => toCurrency.value],
    async ([newFrom, newTo]) => {
        isAmount.value = false;
        isAddress.value = false;

        updateUrlParams(newFrom, newTo, amount.value);
        clearErrors([$('#form-limit-min'), $('#form-limit-max'), $('#receive-amount'), $('#receive-address')]);
        showLoader(
            [
                $('.exchange__form-limit--min'),
                $('.exchange__form-limit--max'),
                $('#receive-amount'),
                $('.exchange__info-item-value-confirmation'),
                $('.exchange__info-item-value-fee'),
                $('.exchange__info-item-value-processing')
            ]);

        const fromContainer = document.querySelector(".exchange__form-currency.give-currency > .exchange__form-current-token");
        if (fromContainer) {
            render(
                () =>
                    CurrencyItem({
                        currency: newFrom.currency,
                        network: newFrom.network,
                    }),
                fromContainer,
                true
            );
        }

        const toContainer = document.querySelector(".exchange__form-currency.receive-currency > .exchange__form-current-token");
        if (toContainer) {
            render(
                () =>
                    CurrencyItem({
                        currency: newTo.currency,
                        network: newTo.network,
                    }),
                toContainer,
                true
            );
        }

        const pairRequest = exchangeService.exchangePair({
            send: newFrom.currency,
            receive: newTo.currency,
            sendNetwork: newFrom.network,
            receiveNetwork: newTo.network,
        });
        const rateRequest = exchangeService.exchangeRate({
            send: newFrom.currency,
            receive: newTo.currency,
            sendNetwork: newFrom.network,
            receiveNetwork: newTo.network,
            amount: amount.value,
        });

        let addressRequest = null;

        if (address.value) {
            addressRequest = addressService.addressValidate({
                currency: newTo.currency,
                address: address.value,
                network: newTo.network,
            });
        }

        const requests = [pairRequest, rateRequest];
        if (addressRequest) {
            requests.push(addressRequest);
        }

        const [pairResponse, rateResponse, addressResponse] = await Promise.all(requests);

        $('#receive-address').prop('disabled', false);

        if (pairResponse.error) {
            handleExchangeError(pairResponse.error);
            return;
        }

        minAmount.value = pairResponse.data.minimumAmount;
        maxAmount.value = pairResponse.data.maximumAmount;

        const minContainer = document.querySelector('.exchange__form-limit--min');
        render(() => document.createTextNode(pairResponse.data.minimumAmount), minContainer, true);

        const maxContainer = document.querySelector('.exchange__form-limit--max');
        render(() => document.createTextNode(pairResponse.data.maximumAmount), maxContainer, true);

        const confirmationContainer = document.querySelector('.exchange__info-item-value-confirmation');
        render(() => document.createTextNode(pairResponse.data.confirmations), confirmationContainer, true);

        const feeContainer = document.querySelector('.exchange__info-item-value-fee');
        render(() => document.createTextNode(`${pairResponse.data.networkFee} ${newFrom.currency}`), feeContainer, true);

        const processingContainer = document.querySelector('.exchange__info-item-value-processing');
        render(() => document.createTextNode(pairResponse.data.processingTime), processingContainer, true);

        if (rateResponse.error) {
            handleExchangeError(rateResponse.error);
            return;
        }

        const receiveValue = rateResponse.data.receiveAmount;

        const container = document.querySelector('#receive-amount');
        render(() => document.createTextNode(receiveValue), container, true);

        isAmount.value = true;

        if (!addressResponse) {
            return;
        }

        if (addressResponse.error) {
            handleAddressError(addressResponse.error);
            return;
        }
        isAddress.value = true;
    });

watch(() => amount.value, async (newValue) => {
    isAmount.value = false;
    updateUrlParams(fromCurrency.value, toCurrency.value, amount.value);
    clearErrors([$('#form-limit-min'), $('#form-limit-max'), $('#receive-amount')]);

    showLoader([$('#receive-amount')]);

    const numericValue = Number(newValue);
    const numericMin = Number(minAmount.value);
    const numericMax = Number(maxAmount.value);
    if (!numericMin || !numericMax) {
        showErrors(
            [
                $('#form-limit-min'),
                $('#form-limit-max'),
                $('#receive-amount')
            ]);
        return;
    }
    if (!numericValue || isNaN(numericValue)) {
        showErrors(
            [
                $('#form-limit-min'),
                $('#form-limit-max'),
                $('#receive-amount')
            ]);
        return;
    }

    if (numericValue < numericMin) {
        showErrors(
            [
                $('#form-limit-min'),
                $('#receive-amount')
            ]);
        return;
    }

    if (numericValue > numericMax) {
        showErrors(
            [
                $('#form-limit-max'),
                $('#receive-amount')
            ]);
        return;
    }

    const rateResponse = await exchangeService.exchangeRate({
        send: fromCurrency.value.currency,
        receive: toCurrency.value.currency,
        sendNetwork: fromCurrency.value.network,
        receiveNetwork: toCurrency.value.network,
        amount: newValue,
    });

    if (rateResponse.error) {
        handleExchangeError(rateResponse.error);
        return;
    }

    const receiveValue = rateResponse.data.receiveAmount;
    const container = document.querySelector('#receive-amount');

    render(() => document.createTextNode(receiveValue), container, true);
    isAmount.value = true;
});

watch(() => address.value, async (newValue, oldValue) => {
    isAddress.value = false;
    clearErrors([$('#receive-address')]);

    const container = document.querySelector('#receive-address');
    render(() => document.createTextNode(newValue), container, true);

    const addressResponse = await addressService.addressValidate({
        currency: toCurrency.value.currency,
        address: newValue,
        network: toCurrency.value.network,
    });

    if (addressResponse.error) {
        handleAddressError(addressResponse.error);
        return;
    }
    isAddress.value = true;
});

watch(
    [() => userAgreement.value, () => isAmount.value, () => isAddress.value],
    async ([newUserAgreement, newIsAmount, newIsAddress]) => {
        if (userAgreement.value && isAmount.value && isAddress.value) {
            $('#submit-order').prop('disabled', false);
            return
        }
        $('#submit-order').prop('disabled', true);
    }
);

$('#submit-order').on('click', async function () {
    isAmount.value = false;
    isAddress.value = false;

    showLoader([$('#submit-order')]);

    const hash = payloadHash.getHash();
    const payload = hash;

    const orderResponse = await orderService.placeOrder({
        send: fromCurrency.value.currency,
        sendNetwork: fromCurrency.value.network,
        receive: toCurrency.value.currency,
        receiveNetwork: toCurrency.value.network,
        amount: amount.value,
        receiveAddress: address.value,
        payload: payload
    });

    if (orderResponse.error) {
        handleExchangeError(orderResponse.error);
        return;
    }

    if (!orderResponse.data.id) {
        errorToast(`Internal error`);
        return
    }

    const id = orderResponse.data.id;

    isAmount.value = true;
    isAddress.value = true;

    const orderLink = `/order/${id}`;
    window.location.href = orderLink;
});

function amountInputHandle(event) {
    amount.value = event.target.value;
}
const debouncedInputHandler = debounce(amountInputHandle, 300);
$('#give-amount').on('input', debouncedInputHandler);

function updateUserAgreement(event) {
    userAgreement.value = event.target.checked;
}
$('#checkbox').on('change', updateUserAgreement);

function reverseCurrencies() {
    [fromCurrency.value, toCurrency.value] = [toCurrency.value, fromCurrency.value]
}
const debouncedReverseHandler = debounce(reverseCurrencies, 300);
$('#reverse-currency').on('click', debouncedReverseHandler);

function addressInputHandle(event) {
    address.value = event.target.value;
}
const debouncedAddressHandler = debounce(addressInputHandle, 300);
$('#receive-address').on('input', debouncedAddressHandler);

function initializeFromUrl() {
    const defaultFrom = { currency: 'BTC', network: 'BTC' };
    const defaultTo = { currency: 'BTC', network: 'BTC' };
    const defaultAmount = 1;

    const params = new URLSearchParams(window.location.search);

    const fromParam = params.get('from');
    const toParam = params.get('to');
    const amountParam = params.get('amount');

    function parseCurrencyParam(param) {
        if (!param) return null;
        const [currency, network] = param.split('-');
        return { currency, network };
    }

    amount.value = amountParam ? parseFloat(amountParam) : defaultAmount;
    $('#give-amount').val(amount.value);

    [fromCurrency.value, toCurrency.value] = [
        fromParam ? parseCurrencyParam(fromParam) : defaultFrom,
        toParam ? parseCurrencyParam(toParam) : defaultTo,
    ];
}
function updateUrlParams(from, to, amount) {
    const url = new URL(window.location);

    if (from) url.searchParams.set('from', `${from.currency}-${from.network}`);
    if (to) url.searchParams.set('to', `${to.currency}-${to.network}`);
    if (amount !== undefined) url.searchParams.set('amount', amount);

    window.history.pushState({}, '', url);
}
initializeFromUrl();

function initializeCurrencies() {
    const fromSelect = document.querySelector(".exchange__form-currency.give-currency");
    const triggerFromSelect = fromSelect.querySelector(".exchange__form-current-token");
    render(
        () =>
            CurrenciesPopup({
                model: fromCurrency,
                trigger: triggerFromSelect,
                currencies: currenciesData
            }),
        fromSelect
    );

    const toSelect = document.querySelector(".exchange__form-currency.receive-currency");
    const triggerToSelect = toSelect.querySelector(".exchange__form-current-token");
    render(
        () =>
            CurrenciesPopup({
                model: toCurrency,
                trigger: triggerToSelect,
                currencies: currenciesData
            }),
        toSelect
    );
}

$(document).ready(() => {
    initializeCurrencies();
});