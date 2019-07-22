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

    public function getAllWithPaginate($perPage = null, $orderColumn = 'id', $der = 'DESC')
    {
        $columns = ['id', 'participant_id' , 'file_name', 'description', 'like', 'is_active', 'created_at'];

        $result = $this->startConditions()
            ->select($columns)
            ->orderBy($orderColumn, $der)
            ->with([
                'participant:id,name,phone'
            ])
            ->paginate($perPage);

        return $result;
    }

    public function getAllActiveWithPaginate($perPage = null, $orderColumn = 'id', $der = 'DESC')
    {
        $columns = ['id', 'participant_id' , 'file_name', 'description', 'like', 'created_at'];

        $result = $this->startConditions()
            ->select($columns)
            ->where('is_active', 1)
            ->orderBy($orderColumn, $der)
            ->with([
                'participant:id,name'
            ])
            ->paginate($perPage);

        return $result;
    }

}
