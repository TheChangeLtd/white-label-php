import { watch, ref } from './reactive-system.js';
import { useCurrenciesService, useExchangeService } from './services.js';
import { errorToast, debounce, showLoader, showErrors, clearErrors, handleExchangeError } from './utils.js';
import { CurrencyItem, CurrenciesPopup, render } from './components.js';

const currenciesService = useCurrenciesService();
const exchangeService = useExchangeService();

const { data: currenciesData, error: currenciesDataError } = await currenciesService.getCurrencies();

if (!currenciesData || currenciesDataError) {
    errorToast(`${error.message || 'Unable to load currencies'}`);
}

const fromCurrency = ref({ currency: 'BTC', network: 'BTC', networkName: 'BTC' });
const toCurrency = ref({ currency: 'ETH', network: 'ETH', networkName: 'ERC20' });
const amount = ref(1);
const minAmount = ref();
const maxAmount = ref();

watch(
    [() => fromCurrency.value, () => toCurrency.value],
    async ([newFrom, newTo]) => {
        clearErrors([$('#form-limit-min'), $('#form-limit-max'), $('#receive-amount')]);
        showLoader([$('.exchange__form-limit--min'), $('.exchange__form-limit--max'), $('#receive-amount')]);

        const fromContainer = document.querySelector(".exchange__form-currency.give-currency > .exchange__form-current-token");
        if (fromContainer) {
            render(
                () =>
                    CurrencyItem({
                        currency: newFrom.currency,
                        network: newFrom.network,
                        networkName: newFrom.networkName,
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
                        networkName: newTo.networkName,
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

        const [pairResponse, rateResponse] = await Promise.all([pairRequest, rateRequest]);

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

        if (rateResponse.error) {
            handleExchangeError(rateResponse.error);
            return;
        }

        const receiveValue = rateResponse.data.receiveAmount;

        const container = document.querySelector('#receive-amount');
        render(() => document.createTextNode(receiveValue), container, true);
    }, { immediate: true }
);

watch(() => amount.value, async (newValue) => {

    clearErrors([$('#form-limit-min'), $('#form-limit-max'), $('#receive-amount')]);

    showLoader([$('#receive-amount')]);

    const numericValue = Number(newValue);
    const numericMin = Number(minAmount.value);
    const numericMax = Number(maxAmount.value);

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
});

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

function handleAmountInput(event) {
    amount.value = event.target.value;
}
const debouncedInputHandler = debounce(handleAmountInput, 300);
$('#give-amount').on('input', debouncedInputHandler);

function reverseCurrencies() {
    [fromCurrency.value, toCurrency.value] = [toCurrency.value, fromCurrency.value]
}
const debouncedReverseHandler = debounce(reverseCurrencies, 300);
$('#reverse-currency').on('click', debouncedReverseHandler);

$('.exchange__form-button').on('click', (event) => {
    event.stopPropagation();
    const url = `/order?from=${fromCurrency.value.currency}-${fromCurrency.value.network}&to=${toCurrency.value.currency}-${toCurrency.value.network}&amount=${amount.value}&fromNetworkName=${fromCurrency.value.networkName}&toNetworkName=${toCurrency.value.networkName}`;
    window.location.href = url;
});

$(document).ready(() => {
    initializeCurrencies();
});