<?php namespace Modules\Backend\Http\Controllers;

use App\Models\Language;

class LanguageController extends AdminController
{

    function __construct()
    {
        parent::__construct();
        $this->set_middleware();
        $this->set_module('language');
        view()->share('lang', $this->set_lang());
        //$this->languageRepository = $languageRepo;
    }

    /**
     * Display a listing of the language.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index()
    {
        //return dd($this->get_auth_user());
        //return dd($this->middleware);
//        $input = $request->all();
//        $result = Language::_search($input);//$this->languageRepository->search($input);
//        $data = $result[0];
//        $att = $result[1];
//return dd($this->set_lang('language', $this->get_language_current_lang_code()));
        return view($this->view_index())
            ->with('route_create', $this->route_create())
            ->with('route_index', $this->route_index());
        //->with('route_edit', $this->route_edit())
        //->with('route_delete', $this->route_delete());
    }

    public function datatable()
    {
        $db = new \Illuminate\Support\Facades\DB;
        $db::statement($db::raw('set @rownum=0'));

        $data_module =  Language::select(array(
            $db::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id',
            'title',
            'native_name',
            'lang_code',
            'orders'
        ));

        $data_tables = \Yajra\Datatables\Datatables::of($data_module);
//        if ($keyword = $request->get('search')['value']) {
//            $data_tables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
//        }

        return $data_tables
            ->setRowId('id')
            ->addColumn('cmd',
                '<a href="{{ URL::route(\'language.edit\', [$id]) }}"><i class="glyphicon glyphicon-edit"></i></a>
                 <a class="delete-row" href="javascript:void(0)"><i class="glyphicon glyphicon-remove"></i></a>')
            ->make(true);
    }

    /**
     * Show the form for creating a new language.
     *
     * @return Response
     */
    public function create()
    {
//        $form_data = [1 => '1'];
        return view($this->view_create())
//            ->with('form_data', $form_data)
            ->with('lang_list', \App\Libraries\TMLib::get_all_directory(resource_path('lang')))
            ->with('route_create', $this->route_create())
            ->with('route_form', $this->route_store());
        //return dd($this->storage_disk('resources')->directories('lang/'));
        //return dd(TMLib::get_all_directory(resource_path('lang')));
    }

    /**
     * Store a newly created language in storage.
     *
     * @param CreatelanguageRequest $request
     *
     * @return Response
     */
    public function store(\Illuminate\Http\Request $request) //CreatelanguageRequest
    {

        $input = $request->all();
        validator($input, $this->validate_rules())->validate();
//        $this->validate($request,
//            [
//                'title' => 'required',
//                'lang_code' => 'required',
//                'currency' => 'numeric|min:0',
//                'orders' => 'required|numeric|min:0',
//                'flag' => 'required|numeric|min:0',
//                'images.*' => 'mimes:jpg,jpeg,png,gif,bmp'
//            ],
//            array_merge(
//                $this->validate_msg('title', 'required', $this->lang['entry_lang_name']),
//                $this->validate_msg('lang_code', 'required', $this->lang['entry_lang_code']),
//                $this->validate_msg('currency', 'numeric', $this->lang['entry_lang_currency']),
//                $this->validate_msg('currency', 'min', $this->lang['entry_lang_currency']),
//                $this->validate_msg('orders', 'required', $this->lang['entry_order']),
//                $this->validate_msg('orders', 'numeric', $this->lang['entry_order']),
//                $this->validate_msg('orders', 'min', $this->lang['entry_order']),
//                $this->validate_msg('flag', 'required', $this->lang['text_status']),
//                $this->validate_msg('flag', 'numeric', $this->lang['text_status']),
//                $this->validate_msg('flag', 'min', $this->lang['text_status']),
//                $this->validate_msg('images', 'images.mimes', $this->lang['entry_images'])
//            ));
//        [
//            'title.required' => '',
//            'lang_code.required' => '',
//            'currency.numeric' => '',
//            'currency.min' => '',
//            'orders.required' => '',
//            'orders.numeric' => '',
//            'orders.min' => '',
//            'flag.required' => '',
//            'flag.numeric' => '',
//            'flag.min' => '',
//            'images.mimes' => ''
//        ]

        $input['images'] = trim($this->upload_images_main('images', $request, $this->module, [128, 85], false), ',');
        $input['created_by'] = 'admin';
        $data_module =  Language::_create($input); //$this->languageRepository->store($input);

        \Flash::message($this->lang['msg_success_new']);

        if (intval($input['publish']) == 1)
            return redirect(route($this->route_index()));
        else if (intval($input['publish']) == 2)
            return redirect(route($this->route_create()));
        else
            return view($this->view_create())
                ->with('route_form', $this->route_store())
                ->with('form_data', $input);

        //return redirect(route($this->route_store()));
        //return response()->json([$input]);
    }

    /**
     * Display the specified language.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $data_module =  Language::_find_by_id($id);//$this->languageRepository->findlanguageById($id);

        if (empty($data_module)) {
            \Flash::error($this->lang['msg_not_found']);
            return redirect($this->route_index());
        }

        return view($this->view_show())->with('language', $data_module);
    }

    /**
     * Show the form for editing the specified language.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $data_module =  Language::_find_by_id($id);//$this->languageRepository->findlanguageById($id);

        if (empty($language)) {
            \Flash::error($this->lang['msg_not_found']);
            return redirect(route($this->route_index()));
        }
        //return dd($language->created_at->format('d/m/Y'));
        return view($this->view_create())
            ->with('lang_list', \App\Libraries\TMLib::get_all_directory(resource_path('lang')))
            ->with('route_form', $this->route_update())
            ->with('route_create', $this->route_create())
            ->with('form_data', $data_module);
    }

    /**
     * Update the specified language in storage.
     *
     * @param  int $id
     * @param CreatelanguageRequest $request
     *
     * @return Response
     */
    public function update($id, \Illuminate\Http\Request $request)
    {
        $input = $request->all();
        validator($input, $this->validate_rules())->validate();
        $data_module =  Language::_find_by_id($id);//$this->languageRepository->findlanguageById($id);

        if (empty($language)) {
            \Flash::error($this->lang['msg_not_found']);
            return redirect(route($this->route_index()));
        }

        $input['images'] = $language->images;

        $image = trim($this->upload_images_main('images', $request, $this->module, [128, 85], false), ',');

        if ($image)
            $input['images'] = $image;

        $input['updated_by'] = 'admin';
        $data_module =  Language::_update($language, $input);//$this->languageRepository->update($language, $request->all());

        \Flash::message($this->lang['msg_success_update']);
        if (intval($input['publish']) == 1)
            return redirect(route($this->route_index()));
        else
            return redirect(route($this->route_edit(), [$id]));
    }

    /**
     * Remove the specified language from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $data_module =  Language::_find_by_id($id);//$this->languageRepository->findlanguageById($id);

        if (empty($language)) {
            \Flash::error($this->lang['msg_not_found']);
            return redirect(route($this->route_index()));
        }

        $language->delete();
        //$this->flash_msg_success($this->lang['msg_success_delete']);
        //\Flash::message($this->lang['msg_success_delete']);
        return response()->json($this->lang['msg_success_delete']);
        //return redirect(route($this->route_index()));
    }

    public function set_language(\Illuminate\Http\Request $request)
    {
        $this->set_language_current($request->all()['language']);
        $this->set_lang('language', $this->get_language_current()['lang_code']);
        $this->flash_msg_success($this->lang['msg_not_change_lang']);
        return response()->json($this->lang['msg_not_change_lang']);
    }

    private function validate_rules()
    {
        return [
            'title' => 'required|unique:language,title',
            'lang_code' => 'required|unique:language,lang_code',
            'currency' => 'nullable|numeric|min:0',
            'orders' => 'required|numeric|min:0',
            'flag' => 'required|numeric|min:0',
            'images.*' => 'nullable|mimes:jpg,jpeg,png,gif,bmp'
        ];
    }
}
