<?php

namespace App\Nova;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Phone extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Phone>
     */
    public static $model = \App\Models\Phone::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'imei',
        'name',
        'variant.name',
        'owner.name',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [

            Text::make("Phone Name", "name")
                ->sortable()
                ->showWhenPeeking()
                ->rules("required"),

            Text::make("Color")
                ->sortable()
                ->showWhenPeeking()
                ->hideFromIndex()
                ->rules("required"),

            Markdown::make("Description")
                ->fullWidth(true)
                ->showWhenPeeking()
                ->sortable()
                ->nullable(),

            BelongsTo::make("Brand")
                ->showWhenPeeking()
                ->showCreateRelationButton()
                ->filterable(),

            BelongsTo::make("Variant", "variant")
                ->showWhenPeeking()
                ->showCreateRelationButton()
                ->dependsOn(['brand'], function (BelongsTo $field, NovaRequest $request, FormData $data){
                    if($data->brand === null){
                        $field->hide();
                    }

                    $field->relatableQueryUsing(function (NovaRequest $request, Builder $query) use ($data){
                        $query->where('brand_id', $data->brand);
                    });
                }),

            HasOne::make("Stock"),
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
        return [];
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
