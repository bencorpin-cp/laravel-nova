<?php

namespace App\Nova;

use App\Nova\Metrics\NewSales;
use App\Nova\Metrics\TotalSalesAmount;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;

class Sale extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Sale>
     */
    public static $model = \App\Models\Sale::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'customer.name',
    ];

    public static $tableStyle = "tight";

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make("Stock")
                ->filterable(),

            BelongsTo::make("Customer")
                ->searchable()
                ->showCreateRelationButton(),

            Number::make("Quantity")
                ->sortable()
                ->rules("required", "integer", "min:1"),

            Number::make("Phone Price", function () {
                $phonePrice = $this->stock->phone->price ?? 0;
                return number_format($phonePrice,2,".");
            })
                ->readonly(),

            Number::make("Total Price", function () {
                $totalPrice = $this->quantity * ($this->stock->phone->price ?? 0);
                return number_format($totalPrice,2, ".");
            })->readonly(),

            DateTime::make("Time Sold", "created_at")
                ->displayUsing(function ($value) {
              return $value->format("m/d/Y h:i A");
            })
                ->readonly()
            ->hideWhenCreating()
            ->hideWhenUpdating(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            new TotalSalesAmount(),
            new NewSales(),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
