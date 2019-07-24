<?php


namespace App\Repositories;

use App\Image as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ImageRepository
 *
 * @package App\Repositories
 */
class ImageRepository extends CoreRepository
{

    protected $columns = ['id', 'participant_id' , 'file_name', 'description', 'like', 'is_active', 'created_at'];

    /**
     * @return string
     */
    public function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получить модель для редактирования в админке
     *
     * @param integer $id
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    public function getAllForIndex($orderColumn, $limit, $photocontestId)
    {

        $result = $this->startConditions()
            ->select($this->columns)
            ->where('photocontest_id', $photocontestId)
            ->orderBy($orderColumn, 'DESC')
            ->with([
                'participant:id,name,phone'
            ])
            ->limit($limit)
            ->get();

        return $result;
    }

    /**
     * @param integer $photocontestId ID фотоконкурса
     * @param null $perPage Количество на странице
     * @param string $orderColumn По какму полю сортировать
     * @param string $der Направление сортировки
     * @return Collection
     */
    public function getAllWithPaginate($photocontestId, $perPage = null, $orderColumn = 'id', $der = 'DESC')
    {
        $result = $this->startConditions()
            ->select($this->columns)
            ->where('photocontest_id', $photocontestId)
            ->orderBy($orderColumn, $der)
            ->with([
                'participant:id,name,phone'
            ])
            ->paginate($perPage)
            ->appends(['sort' => $orderColumn]);

        return $result;
    }

    public function getAllActiveWithPaginate($perPage = null, $orderColumn = 'id', $der = 'DESC')
    {

        $result = $this->startConditions()
            ->select($this->columns)
            ->where('is_active', 1)
            ->orderBy($orderColumn, $der)
            ->with([
                'participant:id,name'
            ])
            ->paginate($perPage);

        return $result;
    }

    public function getForSearch($perPage, $isActive, $value)
    {
        $result = $this->startConditions()
            ->select($this->columns)
            ->whereIn('is_active', $isActive)
            ->orderBy('id', 'DESC')
            ->with([
                'participant:id,name,phone'
            ])
            ->paginate($perPage)
            ->appends('is_active', $value);

        return $result;
    }

    public function getCount()
    {
        $images = $this->startConditions()
            ->select(['is_active'])
            ->get();

        $result = [
            'all' => $images->count(),
            'active' => $images->filter(function ($value) {
                return $value->is_active == 1;
            })->count(),
            'nonActive' => $images->filter(function ($value) {
                return $value->is_active == 0;
            })->count(),
        ];

        return $result;
    }
}
