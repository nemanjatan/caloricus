<?php

namespace App\Nova;

use Benjaminhirsch\NovaSlugField\Slug;
use Benjaminhirsch\NovaSlugField\TextWithSlug;
use Ctessier\NovaAdvancedImageField\AdvancedImage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class Article extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Article::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'title', 'body'
    ];

    /**
     * Build an "index" query for the given resource.
     *
     * @param NovaRequest $request
     * @param  Builder  $query
     * @return Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        if ($request->user()->permissions()->contains('can_administrate')) {
            return $query;
        } else {
            return $query->where('user_id', $request->user()->id);
        }
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            TextWithSlug::make('Title')->rules([
                'required',
                'max:80',
            ])->slug('slug'),

            Slug::make('Slug')
                ->showUrlPreview('https://caloricus.com/articles')
                ->creationRules([
                    'required',
                    'max:80',
                    'unique:articles,slug',
                    'alpha_dash'
                ])->onlyOnForms(),

            Trix::make('Body')->rules([
                'required'
            ]),

            AdvancedImage::make('Featured Image')
                ->croppable()
                ->croppable(16/9)
                ->disableDownload()
                ->rules([
                    'max:2000'
                ])
                ->disk('public'),

            Boolean::make('Is Published')
                ->hideWhenCreating(function ($request) {
                    return !$request->user()->permissions()->contains('can_administrate');
                })
                ->hideWhenUpdating(function ($request) {
                    return !$request->user()->permissions()->contains('can_administrate');
                }),

            BelongsTo::make('User'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
