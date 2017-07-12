<?php
namespace App\Repositories;

use App\Answer;

/**
 * Class AnswerRepository
 * @package App\Repositories
 */
class AnswerRepository
{

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return Answer::create($attributes);
    }
}