<?php
namespace App\Repositories;

use App\Message;

/**
 * Class MessageRepository
 * @package App\Repositories
 */
class MessageRepository
{
    /**
     * @param array $attributes
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    public function create(array $attributes)
    {
        return Message::create($attributes);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     */
    public function getAllMessage()
    {
    	return Message::where('to_user_id',user()->id)
            ->orWhere('from_user_id',user()->id)
            ->with(['fromUser' => function ($query) {
                return $query->select(['id','name','avatar']);
            },'toUser'  => function ($query) {
                return $query->select(['id','name','avatar']);
            }])->latest()->get();
    }

    /**
     * @param $dialogId
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     */
    public function getDialogMessagesBy($dialogId)
    {
    	return $messages = Message::where('dialog_id',$dialogId)->with(['fromUser' => function ($query) {
                return $query->select(['id','name','avatar']);
            },'toUser'  => function ($query) {
                return $query->select(['id','name','avatar']);
            }])->latest()->get();
    }

    /**
     * @param $dialogId
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function getSingleMessageBy($dialogId)
    {
    	return Message::where('dialog_id',$dialogId)->first();
    }
}