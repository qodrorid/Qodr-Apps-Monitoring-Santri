<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TrashController extends Controller
{

    public function index() 
    {
        $database = env('DB_DATABASE', 'qodr_smd');
        $query    = "SELECT TABLE_NAME as `table` FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '$database' AND COLUMN_NAME = 'deleted_at'";
        $tables   = DB::select($query);

        return view('pages.trash.index', compact('tables'));
    }

    public function view(Request $request)
    {
        if (!$request->ajax()) return abort(404);
        if (is_null($request->table) or is_null($request->showitem)) return abort(404);

        $table  = $request->table;
        $fields = DB::getSchemaBuilder()->getColumnListing($request->table);

        $datas  = DB::table($request->table)->where(function ($query) use ($request, $fields) {
            foreach ($fields as $field) {
                $query->orWhere($field, 'like', "%$request->keyword%");
            }
        })->whereNotNull('deleted_at')->paginate($request->showitem ?? 5);

        $datas->appends($request->query());

        return view('pages.trash.list', compact('datas', 'fields', 'table'));
    }

    public function restore(Request $request, int $id, string $table)
    {
        if (!$request->ajax()) return abort(404);

        try {
            DB::table($table)
                ->where('id', $id)
                ->update([
                    'deleted_at' => null
                ]);
            return $this->success('Successfuly restore data!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    public function delete(Request $request, int $id, string $table)
    {
        if (!$request->ajax()) return abort(404);

        try {
            DB::table($table)
                ->where('id', $id)
                ->delete();
            return $this->success('Successfuly delete data!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

}
