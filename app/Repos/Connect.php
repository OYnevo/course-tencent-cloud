<?php

namespace App\Repos;

use App\Models\Connect as ConnectModel;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Resultset;
use Phalcon\Mvc\Model\ResultsetInterface;

class Connect extends Repository
{

    /**
     * @param array $where
     * @return ResultsetInterface|Resultset|ConnectModel[]
     */
    public function findAll($where = [])
    {
        $query = ConnectModel::query();

        $query->where('1 = 1');

        if (isset($where['user_id'])) {
            $query->andWhere('user_id = :user_id:', ['user_id' => $where['user_id']]);
        }

        if (isset($where['provider'])) {
            $query->andWhere('provider = :provider:', ['provider' => $where['provider']]);
        }

        if (isset($where['deleted'])) {
            $query->andWhere('deleted = :deleted:', ['deleted' => $where['deleted']]);
        }

        $query->orderBy('id DESC');

        return $query->execute();
    }

    /**
     * @param int $id
     * @return ConnectModel|Model|bool
     */
    public function findById($id)
    {
        return ConnectModel::findFirst($id);
    }

    /**
     * @param string $openId
     * @param int $provider
     * @return ConnectModel|Model|bool
     */
    public function findByOpenId($openId, $provider)
    {
        return ConnectModel::findFirst([
            'conditions' => 'open_id = ?1 and provider = ?2',
            'bind' => [1 => $openId, 2 => $provider],
        ]);
    }

}
