<?php

namespace App\Http\Controllers;

use App\Image;
use App\Voter;
use App\VoterImage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VoterController extends Controller
{
    /**
     * Проверяет есть ли голосоющий в бд
     * Если нет, то создает его
     *
     * @param Request $request
     * @return string
     */
    public function likePhoto(Request $request)
    {
        //sleep(2);
        $result = ['error' => 'Не корректный запрос', 'success' => false];
        $ip = $request->ip();

        if ($request->has('imageId')) {

            // Ищем голосовавшего по IP
            $voter = Voter::where('ip', $ip)->first();

            // Если IP голосующего уже есть
            if ($voter) {

                // Ищем, голосовал ли он за данную фотографию
                $hit = VoterImage::where('voter_id', $voter->id)
                                    ->where('image_id', $request->imageId)
                                    ->first();

                // Пользователь голосовал за фото
                if ($hit) {
                    // Проверяем, можно ли голосовать повторно
                    // Если дата последнего голосования больше чем сутки назад, то отказываем
                    if ($hit->last_hit > Carbon::parse('-1 day')) {
                        $result = ['success' => true, 'voter' => $voter->id, 'canLike' => false, 'lastHit' => $hit->last_hit];
                    } else {
                        // Иначе добаляем голос к фотографии
                        $image = Image::find($request->imageId);
                        $image->like = $image->like + 1;
                        $image->save();

                        // Обновляем дату последнего голосования за фото
                        $hit->last_hit = now();
                        $hit->save();

                        $result = ['success' => true, 'voter' => $voter->id, 'canLike' => true, 'lastHit' => $hit->last_hit, 'like' => $image->like];
                    }

                } else {
                    // Это первый голос голосующего за фото
                    // Добавляем голос к фотографии
                    $image = Image::find($request->imageId);
                    $image->like = $image->like + 1;
                    $image->save();

                    // Добаляем запись о том что голосующий отдал голос за фото, сейчас
                    $voterImage = new VoterImage();
                    $voterImage->voter_id = $voter->id;
                    $voterImage->image_id = $image->id;
                    $voterImage->last_hit = now();
                    $voterImage->save();

                    $result = ['success' => true, 'voter' => $voter->id, 'canLike' => true, 'lastHit' => $voterImage->last_hit, 'like' => $image->like];
                }

            } else {
                // Если IP голосующего нет, то записываем информацию о нем
                $voter = new Voter();
                $voter->ip = $request->ip();
                $voter->user_agent = $request->userAgent();
                $voter->photocontest_id = $request->photocontestId;
                $voter->save();

                // Добаляем голос к фотографии
                $image = Image::find($request->imageId);
                $image->like = $image->like + 1;
                $image->save();

                // Добаляем запись о том что голосующий отдал голос за фото, сейчас
                $voterImage = new VoterImage();
                $voterImage->voter_id = $voter->id;
                $voterImage->image_id = $image->id;
                $voterImage->last_hit = now();
                $voterImage->save();

                $result = ['success' => true, 'voter' => $voter->id, 'canLike' => true, 'lastHit' => $voterImage->last_hit, 'like' => $image->like];
            }
        }

        return response()->json($result);
    }

    /**
     * Возвращает IP запроса
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIp(Request $request) {

        $info = file_get_contents("http://ip-api.com/json/{$request->ip()}");
        //$info = file_get_contents("http://ip-api.com/json/195.208.34.43");
        return response($info);
    }
}
