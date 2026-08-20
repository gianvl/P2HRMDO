<?php

namespace App\Services;

/**
 * Turns per-academic-year totals into a time series a forecasting model can be
 * fitted on.
 *
 * Pure functions over academic year strings ("2024-2025"), with no knowledge of
 * how the series is later modelled.
 */
class AcademicYearSeries
{
    /**
     * The $count academic years ending at $ay, oldest first.
     *
     * "2024-2025" with a count of 3 gives
     * ["2022-2023", "2023-2024", "2024-2025"].
     */
    public static function window(string $ay, int $count): array
    {
        [$startYr, $endYr] = array_map('intval', explode('-', $ay));

        $years = [];
        for ($offset = $count - 1; $offset >= 0; $offset--) {
            $years[] = ($startYr - $offset) . '-' . ($endYr - $offset);
        }

        return $years;
    }

    /**
     * The unbroken run of academic years ending at the most recent year of
     * $window, as a plain list of totals.
     *
     * An academic year with no requisition is absent from $totals rather than
     * present as zero, and a model reads consecutive list entries as
     * consecutive periods. Closing a gap up would difference across the missing
     * years as though they were adjacent, and filling it with zero would invent
     * a requisition for nil that nobody submitted -- both distort the trend.
     * Using only the run leading up to the selected year avoids both, and keeps
     * a one-step forecast landing on the academic year that follows it.
     */
    public static function contiguous(array $totals, array $window): array
    {
        $series = [];

        foreach (array_reverse($window) as $ay) {
            if (! array_key_exists($ay, $totals)) {
                break;
            }

            array_unshift($series, $totals[$ay]);
        }

        return $series;
    }
}
