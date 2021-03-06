<?php

namespace App\Http\Controllers\Api;

use App\Models\I18nLang;
use Dingo\Api\Transformer\Factory;
use Dingo\Api\Routing\UrlGenerator;
use App\Http\Requests\StoreI18nLangRequest;
use App\Http\Requests\UpdateI18nLangRequest;
use Dingo\Api\Exception\ValidationHttpException;
use App\Http\Transformers\Api\I18nLangTransformer;

/**
 * @resource I18nLang
 * @OpenApiOperationTag Manager:I18nLang
 */
class I18nLangController extends ApiController
{
    /**
     * I18nLangController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        // User group restrictions
        $this->middleware('verifyUserGroup:Developer', ['only' => ['store', 'update', 'destroy']]);
    }

    /**
     * Show i18n lang list.
     *
     * @OpenApiOperationId all
     * @OpenApiResponseSchemaRef #/components/schemas/I18nLangListResponse
     * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
     * @OpenApiResponseDescription A I18nLang list
     * @OpenApiExtraParameterRef #/components/parameters/Include
     * @OpenApiExtraParameterRef #/components/parameters/Search
     * @OpenApiExtraParameterRef #/components/parameters/PaginationPage
     * @OpenApiExtraParameterRef #/components/parameters/PaginationLimit
     * @OpenApiExtraParameterRef #/components/parameters/OrderBy
     *
     * @return \Dingo\Api\Http\Response
     */
    public function index()
    {
        $i18nLangs = I18nLang::applyRequestQueryString()->paginate();

        return $this->response->paginator($i18nLangs, new I18nLangTransformer);
    }

    /**
     * Get specified i18n lang.
     *
     * @OpenApiOperationId get
     * @OpenApiResponseSchemaRef #/components/schemas/I18nLangResponse
     * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
     * @OpenApiResponseDescription A I18nLang
     * @OpenApiExtraParameterRef #/components/parameters/Include
     *
     * @param string $i18nLangId I18n lang UUID
     * @return \Dingo\Api\Http\Response|void
     */
    public function show($i18nLangId)
    {
        $i18nLang = I18nLang::find($i18nLangId);

        if (! $i18nLang) {
            return $this->response->errorNotFound();
        }

        return $this->response->item($i18nLang, new I18nLangTransformer);
    }

    /**
     * Create and store new i18n lang.
     *
     * @ApiDocsNoCall
     *
     * @OpenApiOperationId create
     * @OpenApiResponseSchemaRef #/components/schemas/I18nLangResponse
     * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
     * @OpenApiResponseDescription A I18nLangResponse
     *
     * @param StoreI18nLangRequest $request
     * @return \Dingo\Api\Http\Response|void
     * @throws ValidationHttpException
     */
    public function store(StoreI18nLangRequest $request)
    {
        $i18nLang = I18nLang::create($request->all(), $request->getRealMethod());

        if ($i18nLang) {
            // Register model transformer for created/accepted responses
            // @link https://github.com/dingo/api/issues/1218
            app(Factory::class)->register(
                I18nLang::class,
                i18nLangTransformer::class
            );

            return $this->response->created(
                app(UrlGenerator::class)
                    ->version('v1')
                    ->route('i18nLang.show', $i18nLang->id),
                $i18nLang);
        }

        return $this->response->errorBadRequest();
    }

    /**
     * Update a i18n lang.
     *
     * @ApiDocsNoCall
     *
     * @OpenApiOperationId update
     * @OpenApiOperationTag Resource:I18nLang
     * @OpenApiResponseSchemaRef #/components/schemas/I18nLangResponse
     * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
     * @OpenApiResponseDescription The updated I18nLang
     *
     * @param UpdateI18nLangRequest $request
     * @param string $i18nLangId I18n lang UUID
     * @return \Dingo\Api\Http\Response|void
     */
    public function update(UpdateI18nLangRequest $request, $i18nLangId)
    {
        $i18nLang = I18nLang::find($i18nLangId);

        if (! $i18nLang) {
            return $this->response->errorNotFound();
        }

        $i18nLang->fill($request->all(), $request->getRealMethod());
        $i18nLang->save();

        return $this->response->item($i18nLang, new I18nLangTransformer);
    }

    /**
     * Delete specified i18n Lang.
     *
     * <aside class="warning">Avoid using this feature ! Check foreign keys constraints to remove dependent resources properly before.</aside>
     *
     * @ApiDocsNoCall
     *
     * @OpenApiOperationId delete
     * @OpenApiOperationTag Resource:I18nLang
     * @OpenApiResponseDescription Empty response
     * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
     *
     * @param string $i18nLangId I18n lang UUID
     * @return \Dingo\Api\Http\Response|void
     */
    public function destroy($i18nLangId)
    {
        $i18nLang = I18nLang::find($i18nLangId);

        if (! $i18nLang) {
            return $this->response->errorNotFound();
        }

        $i18nLang->delete();

        return $this->response->noContent();
    }
}
