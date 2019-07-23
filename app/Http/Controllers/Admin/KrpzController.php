<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\ImageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class KrpzController extends Controller
{
    private $imageRepository;

    public function __construct()
    {
        $this->imageRepository = app(ImageRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = $this->imageRepository->getAllWithPaginate(30);

        return view('krpz/admin/index', compact('images'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $image = $this->imageRepository->getEdit($id);

        if (empty($image)) {
            abort(404);
        }

        return view('krpz/admin/edit', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'like' => 'required|integer'
        ]);

        $image = $this->imageRepository->getEdit($id);

        $data = $request->all();

        if (empty($image)) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }

        $image->update($data);


        return redirect()
            ->route('admin-krpz')
            ->with(['success' => 'Успешно сохранено!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = $this->imageRepository->getEdit($id);

        if (empty($image)) {
            abort(404);
        }

        $image->destroy($id);

        return redirect()
            ->back()
            ->with(['success' => 'Успешно удалено!']);
    }

    /**
     * Переключает активность изображения
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function controlImage(Request $request)
    {
        sleep(1);

        $result = [];

        if ($request->has('id')) {
            $image = $this->imageRepository->getEdit($request->id);

            $state = !$image->is_active;
            $image->is_active = $state;

            $image->save();

            $result = ['success' => true, 'status' => $state];
        }

        return response()->json($result);
    }

}
