<?php

namespace Tests\Unit;

use App\Services\AcademicYearSeries;
use PHPUnit\Framework\TestCase;

class AcademicYearSeriesTest extends TestCase
{
    /** The window is what tells the series code which years should be present. */
    public function test_window_returns_the_requested_years_oldest_first(): void
    {
        $this->assertSame(
            ['2020-2021', '2021-2022', '2022-2023', '2023-2024', '2024-2025'],
            AcademicYearSeries::window('2024-2025', 5)
        );
    }

    public function test_window_honours_the_count(): void
    {
        $this->assertSame(
            ['2022-2023', '2023-2024', '2024-2025'],
            AcademicYearSeries::window('2024-2025', 3)
        );

        $this->assertSame(['2024-2025'], AcademicYearSeries::window('2024-2025', 1));
    }

    public function test_window_decrements_both_halves_of_the_academic_year(): void
    {
        $this->assertSame(
            ['1998-1999', '1999-2000', '2000-2001'],
            AcademicYearSeries::window('2000-2001', 3)
        );
    }

    public function test_contiguous_uses_every_year_when_none_are_missing(): void
    {
        $window = AcademicYearSeries::window('2024-2025', 5);
        $totals = [
            '2020-2021' => 4, '2021-2022' => 5, '2022-2023' => 6,
            '2023-2024' => 7, '2024-2025' => 8,
        ];

        $this->assertSame([4, 5, 6, 7, 8], AcademicYearSeries::contiguous($totals, $window));
    }

    /**
     * The bug this rule exists for: with 2022-2023 missing, flattening the
     * totals gives [4,5,7,8] and the model differences 2021-2022 against
     * 2023-2024 as though they were adjacent years.
     */
    public function test_contiguous_stops_at_a_gap_rather_than_closing_it(): void
    {
        $window = AcademicYearSeries::window('2024-2025', 5);
        $totals = ['2020-2021' => 4, '2021-2022' => 5, '2023-2024' => 7, '2024-2025' => 8];

        $this->assertSame([7, 8], AcademicYearSeries::contiguous($totals, $window));
    }

    public function test_contiguous_never_fills_a_gap_with_zero(): void
    {
        $window = AcademicYearSeries::window('2024-2025', 5);
        $totals = ['2020-2021' => 4, '2024-2025' => 8];

        $this->assertNotContains(0, AcademicYearSeries::contiguous($totals, $window));
        $this->assertSame([8], AcademicYearSeries::contiguous($totals, $window));
    }

    /**
     * A one-step forecast only lands on the following academic year if the
     * series actually ends at the selected one.
     */
    public function test_contiguous_is_empty_when_the_selected_year_is_missing(): void
    {
        $window = AcademicYearSeries::window('2024-2025', 5);
        $totals = ['2020-2021' => 4, '2021-2022' => 5, '2022-2023' => 6, '2023-2024' => 7];

        $this->assertSame([], AcademicYearSeries::contiguous($totals, $window));
    }

    public function test_contiguous_handles_a_short_run_and_no_data_at_all(): void
    {
        $window = AcademicYearSeries::window('2024-2025', 5);

        $this->assertSame([8], AcademicYearSeries::contiguous(['2024-2025' => 8], $window));
        $this->assertSame([], AcademicYearSeries::contiguous([], $window));
    }

    public function test_contiguous_ignores_years_outside_the_window(): void
    {
        $window = AcademicYearSeries::window('2024-2025', 5);
        $totals = ['2014-2015' => 99, '2023-2024' => 7, '2024-2025' => 8];

        $this->assertSame([7, 8], AcademicYearSeries::contiguous($totals, $window));
    }
}
