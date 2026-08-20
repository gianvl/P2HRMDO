/**
 * ARIMA(1,1,0) implementation for small datasets (< 10 data points).
 * Uses first-order differencing + AR(1) via least squares regression.
 */
function arimaSmallDataset(series) {
    if (series.length < 2) return series[0] || 0;
    if (series.length === 2) return series[1];

    // Step 1: First-order differencing (d=1)
    const diff = [];
    for (let i = 1; i < series.length; i++) {
        diff.push(series[i] - series[i - 1]);
    }

    // Step 2: Fit AR(1) on differenced series via least squares
    // Model: diff[t] = c + phi * diff[t-1]
    const n = diff.length - 1;
    if (n < 1) return series[series.length - 1];

    let sumX = 0, sumY = 0, sumXY = 0, sumXX = 0;
    for (let i = 0; i < n; i++) {
        sumX += diff[i];
        sumY += diff[i + 1];
        sumXY += diff[i] * diff[i + 1];
        sumXX += diff[i] * diff[i];
    }

    const denom = n * sumXX - sumX * sumX;
    let phi = 0, c = 0;
    if (Math.abs(denom) > 1e-10) {
        phi = (n * sumXY - sumX * sumY) / denom;
        c = (sumY - phi * sumX) / n;
    } else {
        c = n > 0 ? sumY / n : 0;
    }

    // Constrain phi to [-1, 1] for stationarity
    phi = Math.max(-1, Math.min(1, phi));

    // Step 3: Forecast next differenced value
    const nextDiff = c + phi * diff[diff.length - 1];

    // Step 4: Invert differencing
    return series[series.length - 1] + nextDiff;
}

try {
    const input = JSON.parse(process.argv[2]);
    const series = input.series;
    const steps = input.steps || 1;

    if (!Array.isArray(series) || series.length === 0) {
        throw new Error('input.series must be a non-empty array');
    }

    if (series.length < 10) {
        // Use manual ARIMA(1,1,0) for small datasets
        const forecast = Math.max(0, Math.round(arimaSmallDataset(series)));
        console.log(JSON.stringify({ forecast, model: 'ARIMA(1,1,0)' }));
    } else {
        // Required lazily: only this branch needs the package, so a missing
        // install cannot break the small-dataset path above.
        const ARIMA = require('arima');
        const arima = new ARIMA({ auto: true, verbose: false });
        arima.train(series);
        const [predicted] = arima.predict(steps);
        const forecast = Math.max(0, Math.round(predicted[0]));
        console.log(JSON.stringify({ forecast, model: 'ARIMA(auto)' }));
    }
} catch (e) {
    // Fail loudly. A forecast of 0 is a legitimate result, so errors must not be
    // reported through the same channel as a successful run.
    console.error(e.message);
    process.exit(1);
}
