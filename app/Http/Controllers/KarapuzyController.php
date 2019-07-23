<?php

namespace App\Http\Controllers;

use App\Image;
use App\Participant;
use App\Repositories\ImageRepository;
use Carbon\Carbon;
use Intervention\Image\Facades\Image as Picture;
use App\Photocontest;
use Illuminate\Http\Request;
use App\Http\Requests\KarapuzyAddRequest;

class KarapuzyController extends Controller
{
    // Id фотоконкурса в БД
    const ID = 1;

    private $imageRepository;

    public function __construct()
    {
        $this->imageRepository = app(ImageRepository::class);
    }

    /**
     * Главная станица фотоконкурса
     *
     * @return \Illuminate\Http\Response
     */
    public function karapuzy()
    {

        $itemMenuActive = 'index';

        $photocontest = Photocontest::find(self::ID);

        $images = $this->imageRepository->getAllActiveWithPaginate(30, 'like');

        return view('krpz/index', compact('photocontest', 'images', 'itemMenuActive'));
    }


    /**
     * Страница с формой добавления фотонрафии
     *
     * @return \Illuminate\Http\Response
     */
    public function participate()
    {
        $itemMenuActive = 'participate';

        return view('krpz/participate', compact('itemMenuActive'));
    }


    /**
     * О конкурсе
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        $itemMenuActive = 'about';

        return view('krpz/about', compact('itemMenuActive'));
    }


    public function userInfo()
    {
        $itemMenuActive = '';
        return view('krpz/userinfo', compact('itemMenuActive'));
    }

    /**
     * Добавление фотографии
     *
     * @return \Illuminate\Http\Response
     */
    public function add(KarapuzyAddRequest $request)
    {
        $fileCount = 0;

        if($request->hasFile('attachment'))
        {
            $files = $request->file('attachment');

            $participant = new Participant();
            $participant->ip = $request->ip();
            $participant->name = $request->input('name');
            $participant->email = $request->has('email') ? $request->input('email') : 'Не указан';
            $participant->phone = $request->input('phone');
            $participant->last_hit = Carbon::yesterday();
            $participant->save();


            foreach ($files as $file) {

                $image = new Image();
                $pic = Picture::make($file->getRealPath());
                $realFilename = $image->getNameWithoutExt($file->getClientOriginalName());

                $filename  = $image->generateRandomString() . '.' . $file->getClientOriginalExtension();

                $image->photocontest_id = 1;
                $image->participant_id = $participant->id;
                $image->file_name =  $filename;
                $image->mime = $file->getClientMimeType();
                $image->ext = $file->getClientOriginalExtension();
                $image->size = $file->getSize();
                $image->description = ($request->has($realFilename)) ? $request->input($realFilename) : '';
                $image->like = 0;
                $image->is_active = 0;
                $image->save();


                $path = public_path('/storage/' . $filename);

                if ($pic->width() > 640) {
                    $pic->resize(640, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }

                $pic->save($path);

                if ($fileCount === 2) {
                    break;
                } else {
                    $fileCount++;
                }
            }
        }

        return redirect()->route('krpz-user-info');
    }

}
