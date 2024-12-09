const targetMap = new WeakMap();
let activeEffect = null;

const effectQueue = new Set();
let isFlushing = false;

function flushEffectQueue() {
    if (isFlushing) return;
    isFlushing = true;
    Promise.resolve().then(() => {
        effectQueue.forEach(effect => effect());
        effectQueue.clear();
        isFlushing = false;
    });
}

export function effect(eff) {
    activeEffect = eff;
    activeEffect();
    activeEffect = null;
}

function track(target, key) {
    if (activeEffect) {
        let dependenciesMap = targetMap.get(target);
        if (!dependenciesMap) {
            targetMap.set(target, (dependenciesMap = new Map()));
        }

        let dependency = dependenciesMap.get(key);
        if (!dependency) {
            dependenciesMap.set(key, (dependency = new Set()));
        }

        dependency.add(activeEffect);
    }
}

function trigger(target, key) {
    const dependenciesMap = targetMap.get(target);
    if (!dependenciesMap) return;

    let dependency = dependenciesMap.get(key);
    if (dependency) {
        dependency.forEach(effect => {
            effectQueue.add(effect);
        });
        flushEffectQueue();
    }
}

export function reactive(target) {
    const handler = {
        get(target, key, receiver) {
            let result = Reflect.get(target, key, receiver);
            track(target, key);
            return result;
        },
        set(target, key, value, receiver) {
            let oldValue = target[key];
            let result = Reflect.set(target, key, value, receiver);
            if (result && oldValue !== value) {
                trigger(target, key);
            }
            return result;
        }
    };
    return new Proxy(target, handler);
}

export function ref(raw) {
    const r = {
        get value() {
            track(r, 'value');
            return raw;
        },
        set value(newValue) {
            let oldValue = raw;
            raw = newValue;
            if (oldValue !== newValue) {
                trigger(r, 'value');
            }
        }
    };
    return r;
}

export function computed(getter) {
    let result = ref();
    effect(() => (result.value = getter()));
    return result;
}

export function watch(getter, callback, options = {}) {
    let oldValue;
    const { immediate = false } = options;

    const isArrayGetter = Array.isArray(getter);

    oldValue = isArrayGetter
        ? getter.map(fn => fn())
        : getter();

    const effectFn = () => {
        const newValue = isArrayGetter
            ? getter.map(fn => fn())
            : getter();

        const hasChanged = isArrayGetter
            ? newValue.some((val, index) => JSON.stringify(val) !== JSON.stringify(oldValue[index]))
            : newValue !== oldValue;

        if (hasChanged) {
            callback(newValue, oldValue);
            oldValue = newValue;
        }
    };

    if (immediate) {
        callback(oldValue, isArrayGetter ? oldValue.map(() => undefined) : undefined);
    }

    effect(effectFn);
}
