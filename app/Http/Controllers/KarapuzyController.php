<?php

namespace App\Http\Controllers;

use App\Image;
use App\Participant;
use App\Repositories\ImageRepository;
use App\Voter;
use Intervention\Image\Facades\Image as Picture;
use App\Photocontest;
use Illuminate\Http\Request;
use App\Http\Requests\KarapuzyAddRequest;

class KarapuzyController extends Controller
{
    // Id фотоконкурса в БД
    private $ID = 1;

    private $imageRepository;

    private $endDate = '2019-09-15 00:00:00';

    public function __construct()
    {
        $this->imageRepository = app(ImageRepository::class);
    }

    /**
     * Главная станица фотоконкурса
     *
     * @return \Illuminate\Http\Response
     */
    public function karapuzy(Request $request)
    {
        $itemsOnPage = 12;
        $itemMenuActive = 'index';

        if ($request->has('sort')) {
            $column = $request->sort;
            $sortLinkActive = 'sort-by-date';
        } else {
            $column = 'like';
            $sortLinkActive = 'sort-by-like';
        }

        $showResult = now() > $this->endDate ? true : false;

        $winner = $this->imageRepository->getWinner($this->ID);

        $photocontest = Photocontest::find($this->ID);

        $images = $this->imageRepository->getAllForIndex($this->ID, $column, $itemsOnPage);

        return view('krpz/index', compact('photocontest', 'images', 'itemMenuActive', 'sortLinkActive', 'winner', 'showResult'));
    }


    /**
     * Страница просмотра всех изображений
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $itemsPerPage = 12;
        $itemMenuActive = 'all';
        $column = 'created_at';

        if ($request->has('sort')) {
            $column = $request->sort;
            $sortLinkActive = ($request->sort == 'like') ? 'sort-by-like' : 'sort-by-date';
        } else {
            $sortLinkActive = 'sort-by-date';
        }

        $images = $this->imageRepository->getAllActiveWithPaginate($this->ID, $itemsPerPage, $column);

        $showResult = now() > $this->endDate ? true : false;

        return view('krpz/all', compact( 'images', 'itemMenuActive', 'sortLinkActive', 'showResult'));
    }

    /**
     * Страница с формой добавления фотонрафии
     *
     * @return \Illuminate\Http\Response
     */
    public function participate()
    {
        $itemMenuActive = 'participate';
        $showResult = now() > $this->endDate ? true : false;

        if ($showResult) {
            return redirect()->route('krpz');
        } else {
            return view('krpz/participate', compact('itemMenuActive', 'showResult'));
        }
    }


    /**
     * О конкурсе
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        $itemMenuActive = 'about';
        $showResult = now() > $this->endDate ? true : false;

        return view('krpz/about', compact('itemMenuActive', 'showResult'));
    }

    /**
     * Страница на которую перейдет пользователь, после добавления фотографии
     *
     * @return \Illuminate\Http\Response
     */
    public function userInfo()
    {
        $itemMenuActive = '';
        $showResult = now() > $this->endDate ? true : false;

        return view('krpz/userinfo', compact('itemMenuActive', 'showResult'));
    }

    /**
     * Добавление фотографии
     *
     * @return \Illuminate\Http\Response
     */
    public function add(KarapuzyAddRequest $request)
    {
        $fileCount = 0;
        $showResult = now() > $this->endDate ? true : false;

        if ($showResult) {
            return redirect()->route('krpz');
        } else {
            if($request->hasFile('attachment')) {
                $files = $request->file('attachment');

                $participant = new Participant();
                $participant->name = $request->input('name');
                $participant->email = $request->has('email') ? $request->input('email') : 'Не указан';
                $participant->phone = $request->input('phone');
                $participant->save();


                foreach ($files as $file) {

                    $image = new Image();
                    $pic = Picture::make($file->getRealPath());
                    $realFilename = $image->getNameWithoutExt($file->getClientOriginalName());

                    $filename  = $image->generateRandomString() . '.' . $file->getClientOriginalExtension();

                    $image->photocontest_id = $this->ID;
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

}
