<?php

namespace App\Http\Controllers;

use App\Image as Img;
use App\Participant;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use App\Photocontest;
use Illuminate\Http\Request;
use App\Http\Requests\KarapuzyAddRequest;

class KarapuzyController extends Controller
{
    // Id фотоконкурса в БД
    const ID = 1;

    /**
     * Главная станица фотоконкурса
     *
     * @return \Illuminate\Http\Response
     */
    public function karapuzy()
    {

        $itemMenuActive = 'index';

        $photocontest = Photocontest::find(self::ID);

        $images = Img::where('photocontest_id',self::ID)
            ->where('is_active', 1)
            ->orderBy('like')
            ->paginate(30);

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


    /**
     * Добавление фотографии
     *
     * @return \Illuminate\Http\Response
     */
    public function add(KarapuzyAddRequest $request)
    {
        $message = 'Спасибо за участие! Ваши фото успешно добавлены!';
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

                $image = new Img();
                $pic = Image::make($file->getRealPath());
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

        session()->flash('flash_message', $message);

        return redirect('/karapuzy');
    }

    public function admin()
    {
        $images = Img::orderBy('created_at', 'DESC')
                    ->paginate(12);

        return view('krpz/admin/index', compact('images'));
    }
}
