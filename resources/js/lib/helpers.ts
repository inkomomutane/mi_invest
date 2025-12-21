import currency from "currency.js"

export const NUMBER = (value: any, precision: number = 2, symbol = '') : currency => {
    return currency(value, {
        symbol: symbol + ' ',
        precision: precision,
    });
};
